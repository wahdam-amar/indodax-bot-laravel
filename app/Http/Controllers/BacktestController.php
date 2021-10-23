<?php

namespace App\Http\Controllers;

use App\Models\Backtest;
use App\Models\User;
use Illuminate\Http\Request;

class BacktestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backtest  $backtest
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->id() !== (int) $id) {
            return redirect()->route('dashboard');
        }

        return view('backtest.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backtest  $backtest
     * @return \Illuminate\Http\Response
     */
    public function edit(Backtest $backtest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backtest  $backtest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Backtest $backtest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backtest  $backtest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Backtest $backtest)
    {
        //
    }
}
