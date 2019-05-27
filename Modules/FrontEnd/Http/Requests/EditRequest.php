<?php

namespace Modules\FrontEnd\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            'phone_number' => 'required|string|unique:users,phone_number,' . auth()->user()->id,
            'password' => 'required|string|confirmed',
            'password_confirmation' => 'required|string',
        ];
    }
}
