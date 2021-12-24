<?php

namespace App\Http\Controllers;

use App\Signals\Rsi;
use Illuminate\Pipeline\Pipeline;

class Dashboard extends Controller
{
    public function main()
    {
        return view('asset');
    }
}
