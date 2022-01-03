<?php

namespace App\Jobs;

use App\Models\User;
use App\Signals\Rsi;
use App\Services\Indodax;
use Illuminate\Bus\Queueable;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Log;
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

                $amuontTrade = $user->setting()->exists() ? $user->setting->amount_trade : 100000;

                $price = (new Indodax)->getCoinPrice('eth');

                $backtest = new BacktestAccount;

                $backtest->setUser($user);

                $backtest->putOrder('eth', $price, $amuontTrade);
            }
        } catch (\Throwable $th) {
            Log::warning('Error make order : ' . $th);
        }
    }
}
