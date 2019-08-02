<?php

namespace Modules\Pumps\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HeightPumpRequest extends FormRequest
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
            'head'=> 'required',
            'c0' => 'required|numeric',
            'c1' => 'required|numeric',
            'c2' => 'required|numeric',
            'c3' => 'required|numeric',
            'c4' => 'required|numeric',
            'c5' => 'required|numeric',
            'q_max' => 'required|numeric',
            'q_min' => 'required|numeric',
            'p_min' => 'required|numeric',
            'p_max' => 'required|numeric',
        ];
    }
}
