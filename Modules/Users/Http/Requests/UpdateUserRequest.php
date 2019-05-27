<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email,' . $this->id,
            'password' => 'nullable|confirmed',
            'phone_number' => 'nullable|string|unique:users,phone_number,' . $this->id,
            'image' => 'nullable|image|max:500000|min:1',
            'group_id' => 'required|integer',
        ];
    }
}
