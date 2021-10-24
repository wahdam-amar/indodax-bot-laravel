<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Balance;
use App\Services\Indodax;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class UpdateBalanceJob implements ShouldQueue
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
        $userWithApi = User::whereHas('api', function ($api) {
            $api->whereNotNull(['api_key', 'secret_key']);
        })->get();

        try {
            foreach ($userWithApi as $user) {
                $balance = (new Indodax())->setUser($user)->getSaldoIdr();
                Balance::create([
                    'user_id' => $user->id,
                    'amount'  => (int) str_replace(',', '', $balance)
                ]);
            }
        } catch (\Throwable $th) {
            Log::warning('Error update balance job: ' . $th);
        }
    }
}
