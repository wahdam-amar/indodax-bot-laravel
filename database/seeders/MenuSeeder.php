<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = array('Admin', 'User', 'Guest');

        foreach ($menus as $menu) {
            Menu::create([
                'name' => $menu,
                'status' => 'AC'
            ]);
        }
    }
}
