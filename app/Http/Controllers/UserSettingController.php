<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserSettingRequest;
use App\Models\Api;
use App\Models\UserSetting;
use Illuminate\Http\Request;

class UserSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userApi = Api::where('user_id', auth()->user()->id)->first();
        $userSetting = UserSetting::where('user_id', auth()->user()->id)->first();

        return view('profile.index')
            ->with('userApi', $userApi)
            ->with('userSetting', $userSetting);
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
     * @param  \App\Models\UserSetting  $userSetting
     * @return \Illuminate\Http\Response
     */
    public function show(UserSetting $userSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserSetting  $userSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(UserSetting $userSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserSetting  $userSetting
     * @return \Illuminate\Http\Response
     */
    public function update(UserSettingRequest $request, UserSetting $userSetting)
    {

        // dd($request->all());

        $userApi = Api::updateOrCreate(
            [
                'user_id'   => auth()->user()->id,
            ],
            [
                'user_id' => auth()->user()->id,
                'api_key' => $request->api_key,
                'secret_key' => $request->secret_key
            ]
        );

        $userSetting = UserSetting::updateOrCreate(
            [
                'user_id'   => auth()->user()->id,
            ],
            [
                'user_id' => auth()->user()->id,
                'amount_trade' => $request->amount_trade,
                'take_profit' => (string) $request->take_profit,
                'stop_loss' => (string) $request->stop_loss
            ]
        );



        return back()
            ->with('userApi', $userApi)
            ->with('userSetting', $userSetting);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserSetting  $userSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserSetting $userSetting)
    {
        //
    }
}
