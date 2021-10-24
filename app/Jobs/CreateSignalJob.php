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
        $signals = (new \App\Services\Indicators)
            ->symbol('ETH/USDT')
            ->interval('15m')->get()
            ->firstWhere('id', 'macd');

        $signal = optional($signals)->result;

        try {
            DB::table('macd')->insert([
                'value' => $signal->valueMACD,
                'signal' => $signal->valueMACDSignal,
                'hist' => $signal->valueMACDHist,
                'crossover' => $signal->valueMACD > $signal->valueMACDSignal ? '1' : '0',
            ]);
        } catch (\Throwable $th) {
            Log::info('Error Create Signal: ' . $th);
        }
    }
}
