<?php

namespace App\Jobs;

use App\Models\User;
use App\Signals\Rsi;
use App\Models\Order;
use App\Models\Backtest;
use App\Services\Indodax;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\Account\LiveAccount;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\Account\BacktestAccount;
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

        $indicators = collect();

        $pipe = app(Pipeline::class)
            ->send($indicators)
            ->via('buy')
            ->through([
                Rsi::class
            ])
            ->then(function ($indicators) {
                return $indicators;
            });

        if (!$pipe->get('should_buy')) {
            return;
        }

        $userWithApi = User::whereHas('api', function ($api) {
            $api->whereNotNull(['api_key', 'secret_key']);
        })->get();

        // Todo : make backtest order

        try {
            foreach ($userWithApi as $user) {

                $price = (new Indodax())->setUser($user->id)->getCoinPrice('eth');

                $backtest = new BacktestAccount;
                $backtest->putOrder('eth', $price, '5000000');

                // $account = new LiveAccount($user->id);
                // $account->putOrder('eth', $price, '500000');
            }
        } catch (\Throwable $th) {
            Log::warning('Error make order : ' . $th);
        }
    }
}
