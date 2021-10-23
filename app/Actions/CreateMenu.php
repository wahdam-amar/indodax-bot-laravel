<?php

namespace App\Actions;

use App\Models\Menu as MenuModel;
use Spatie\Menu\Link;
use Spatie\Menu\Menu;

class CreateMenu
{
    public function make()
    {
        $menus = MenuModel::all()->where('status', 'AC');
        $mainmenu = Menu::new()->addClass('nav-list');
        foreach ($menus as $menu) {
            $mainmenu->add(Link::to('#!', $menu->name));
            if ($menu->hasChild()) {
                foreach ($menu->items as $subitem) {
                    $mainmenu->add(
                        Menu::new()
                            ->link('#!', $subitem->name)->addClass('nav-dropdown')
                    );
                }
            }
        }

        return $mainmenu;
    }
}
