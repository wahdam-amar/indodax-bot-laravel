<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Backtest\Backtest;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Backtest\BacktestBalance;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function balance()
    {
        return $this->hasMany(Balance::class);
    }

    public function pendingOrder()
    {
        return $this->hasMany(Order::class);
    }

    public function api()
    {
        return $this->hasOne(Api::class, 'user_id', 'id');
    }

    public function backtest()
    {
        return $this->hasOne(Backtest::class);
    }

    public function setting()
    {
        return $this->hasOne(UserSetting::class);
    }

    public function backtestBalance()
    {
        return $this->hasOne(BacktestBalance::class);
    }
}
