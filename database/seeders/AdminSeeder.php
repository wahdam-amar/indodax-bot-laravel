<?php

namespace Database\Seeders;

use App\Models\Balance;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create(['name' => 'Super-Admin']);
        $userRole = Role::create(['name' => 'User']);

        $admin = \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'dev@admin.com',
            'password' => Hash::make('admindev')
        ]);
        $user = \App\Models\User::factory()->create([
            'name' => 'User',
            'email' => 'User@admin.com',
            'password' => Hash::make('admindev')
        ]);

        $admin->assignRole($adminRole);
        $user->assignRole($userRole);
    }
}
