<?php

namespace Modules\Cable\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CableRequest extends FormRequest
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
            'motor_hp' => 'string|nullable',
            'c_3x1_5' => 'string|nullable',
            'c_3x2_5' => 'string|nullable',
            'c_3x4' => 'string|nullable',
            'c_3x6' => 'string|nullable',
            'c_3x10' => 'string|nullable',
            'c_3x16' => 'string|nullable',
            'c_3x25' => 'string|nullable',
            'c_3x35' => 'string|nullable',
            'c_3x50' => 'string|nullable',
            'c_3x70' => 'string|nullable',
            'c_3x95' => 'string|nullable',
        ];
    }
}
