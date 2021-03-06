<?php

namespace App\Models\Backtest;

use App\Models\User;
use App\Models\UserSetting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Backtest extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function balance()
    {
        return $this->hasOne(BacktestBalance::class);
    }

    public function setting()
    {
        return $this->hasOneThrough(UserSetting::class, User::class, 'id', 'user_id', 'user_id', 'id');
    }
}
