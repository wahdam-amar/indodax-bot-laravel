<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Order;
use App\Services\Account\LiveAccount;
use App\Services\Indodax;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class MakeOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $macd = DB::table('macd')->latest()->take(3)->get();

        if ($macd->count() < 3) {
            return;
        }

        $first = collect($macd->slice(0, 1))->first()->crossover;
        $second = collect($macd->slice(1, 1))->first()->crossover;
        $third = collect($macd->slice(2, 1))->first()->crossover;

        $placeOrder = $first == 1 && $second == 0 && $third == 0;

        $userWithApi = User::whereHas('api', function ($api) {
            $api->whereNotNull(['api_key', 'secret_key']);
        })->get();

        try {
            foreach ($userWithApi as $user) {

                $price = (new Indodax())->setUser($user->id)->getCoinPrice('eth');

                $account = new LiveAccount($user->id);

                if ($placeOrder) {
                    $account->putOrder('eth', $price, '500000');
                }
            }
        } catch (\Throwable $th) {
            Log::warning('Error make order : ' . $th);
        }
    }
}
