<?php

namespace App\Models\Backtest;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BacktestBalance extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function backtest()
    {
        return $this->belongsTo(\App\Models\Backtest\Backtest::class);
    }
}
