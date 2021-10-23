<?php

use App\Http\Controllers\TestMenu;
use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BacktestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [Dashboard::class, 'main'])->name('dashboard');
    Route::resource('backtest', BacktestController::class);
    Route::view('profile', 'profile.index')->name('profile');
});




require __DIR__ . '/auth.php';
