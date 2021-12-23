<?php

namespace App\Jobs;

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
        $rsi = optional($rsi)->result->value;

        if ($rsi >= 60) {
            return;
        }

        $macd = $signals->firstWhere('id', 'macd');
        $macd = optional($macd)->result;

        try {
            DB::table('macd')->insert([
                'value' => $macd->valueMACD,
                'signal' => $macd->valueMACDSignal,
                'hist' => $macd->valueMACDHist,
                'crossover' => $macd->valueMACD > $macd->valueMACDSignal ? '1' : '0',
                'created_at' => now()
            ]);
            Log::info('Signal created : ' . now());
        } catch (\Throwable $th) {
            Log::info('Error Create Signal: ' . $th);
        }
    }
}
