<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'api_key' => 'required|string|max:255',
            'secret_key' => 'required|string|max:255',
            'amount_trade' => 'required|numeric|min:0',
            'take_profit'   => 'required|numeric',
            'stop_loss'   => 'required|numeric',
        ];
    }
}
