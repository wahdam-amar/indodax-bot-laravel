<?php

namespace App\Jobs;

use Illuminate\Foundation\Bus\Dispatchable;

class CreateSignalJob
{
    use Dispatchable;

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
        $signal = (new \App\Services\Indicators)
            ->symbol('ETH/USDT')
            ->interval('15m')->get()
            ->firstWhere('id', 'macd');

        if ($signal) {
            \Illuminate\Support\Facades\DB::table('macd')->insert([
                'value' => $signal->valueMACD,
                'signal' => $signal->valueMACDSignal,
                'hist' => $signal->valueMACDHist,
                'crossover' => $signal->valueMACD > $signal->valueMACDSignal ? 'Y' : 'N',
            ]);
        }
    }
}
