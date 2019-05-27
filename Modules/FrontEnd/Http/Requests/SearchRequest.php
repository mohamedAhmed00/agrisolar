<?php

namespace Modules\FrontEnd\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'water_amount' => 'required|numeric',
            'dynamic_head' => 'required|numeric',
            'cable_length' => 'required|numeric',
            'location' => 'required|string',
            'mounting_structure' => [
                'required',
                Rule::in(['Fixed', 'Tracking']),
            ],
            'module_name' => 'nullable|string',
            'voc' => 'nullable|numeric',
            'vmpp' => 'nullable|numeric',
            'power_max' => 'nullable|numeric',
        ];
    }
}
