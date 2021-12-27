<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Signal;
use App\Services\Indodax;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CreateSignalJob implements ShouldQueue
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
        $signals = indicator()
            ->symbol('ETH/USDT')
            ->interval('15m')->get();

        $rsi = $signals->firstWhere('id', 'rsi');
        $rsi = optional($rsi)->result->value ?? null;

        if (!$rsi) {
            Log::info('No RSI');
            return;
        }

        $userWithApi = User::whereHas('api')->first();

        if (!$userWithApi) {
            Log::info('No user with api');
            return;
        }

        $indodax = (new Indodax)->setUser($userWithApi);

        $macd = $signals->firstWhere('id', 'macd');
        $macd = optional($macd)->result;

        $stoch = $signals->firstWhere('id', 'stoch');

        try {

            $signal = new Signal;
            $signal->macd_value = $macd->valueMACD;
            $signal->macd_signal = $macd->valueMACDSignal;
            $signal->macd_hist = $macd->valueMACDHist;
            $signal->macd_crossover = $macd->valueMACD > $macd->valueMACDSignal ? '1' : '0';
            $signal->rsi_value = $rsi;
            $signal->stoch_k = $stoch->result->valueK ?? null;
            $signal->stoch_d = $stoch->result->valueD ?? null;
            $signal->market_price = $indodax->getCoinPrice('eth');
            $signal->coin_name = 'ETH/USDT';
            $signal->via = 'binance';
            $signal->save();

            Log::info('Signal created : ' . now());
        } catch (\Throwable $th) {
            Log::info('Error Create Signal: ' . $th);
        }
    }
}
