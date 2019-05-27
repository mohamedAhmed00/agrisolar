<?php

namespace Modules\Pumps\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PumpRequest extends FormRequest
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
            'model' => 'required|string|unique:pumps,model,' . $this->id,
            'motor' => 'required|numeric',
            'stages' => 'required|numeric',
            'q_min' => 'required|numeric',
            'q_max' => 'required|numeric',
            'h_min' => 'required|numeric',
            'h_max' => 'required|numeric',
        ];
    }
}
