<?php

namespace App\Http\Controllers;

use App\Actions\CreateMenu;

class TestMenu extends Controller
{
    private $menu;

    public function __construct(CreateMenu $menu)
    {
        $this->menu = $menu->make();
    }

    public function main()
    {
        return view('TestMenu')->with('menus', $this->menu);
    }
}
