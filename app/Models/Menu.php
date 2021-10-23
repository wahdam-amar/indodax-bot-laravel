<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->belongsToMany(
            self::class,
            MenuItem::class,
            'menu_id',
            'child_id'
        )->where('status', 'AC');
    }

    public function hasChild(): bool
    {
        return $this->items()->exists();
    }
}
