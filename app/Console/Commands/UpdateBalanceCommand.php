<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Balance;
use App\Services\Indodax;
use Illuminate\Console\Command;

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

        foreach ($userWithApi as $user) {
            $balance = (new Indodax())->setUser($user)->getSaldoIdr();
            Balance::create([
                'user_id' => $user->id,
                'amount'  => (int) str_replace(',', '', $balance)
            ]);

            $this->info($user->name);
        }
    }
}
