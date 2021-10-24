<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Order;
use App\Models\Balance;
use App\Services\Indodax;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateBalanceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'balance:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update users balance';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $userWithApi = User::whereHas('api', function ($api) {
            $api->whereNotNull(['api_key', 'secret_key']);
        })->get();

        try {
            $this->info($userWithApi->count());

            foreach ($userWithApi as $user) {
                Order::create([
                    'user_id' => $user->id,
                    'coin' => 'from command',
                    'amount' => $user->id,
                    'price_buy' => $user->id,
                    'price_sell' => $user->id,
                    'profit' => $user->id,
                    'status' => 1,
                ]);

                $this->info($user->name);
            }
        } catch (\Throwable $th) {
            Log::warning('Error UpdateBalanceCommand with ' . $userWithApi->count() . ' ' . $th);
        }
    }
}
