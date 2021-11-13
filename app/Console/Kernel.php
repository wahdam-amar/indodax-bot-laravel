<?php

namespace App\Console;

use App\Models\Order;
use App\Jobs\MakeOrder;
use App\Services\Indodax;
use App\Jobs\PruneSignalJob;
use App\Services\Indicators;
use App\Jobs\CreateSignalJob;
use App\Jobs\UpdateOrdersJob;
use App\Jobs\UpdateBalanceJob;
use App\Services\OrderBacktest;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->job(new UpdateBalanceJob)->hourly();
        $schedule->job(new UpdateOrdersJob)->everyFiveMinutes();
        $schedule->job(new PruneSignalJob)->daily();
        $schedule->job(new CreateSignalJob)->everyFifteenMinutes()->appendOutputTo(storage_path('logs/CreateSignalJob.log'))->after(function () {
            MakeOrder::dispatch();
        });
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
