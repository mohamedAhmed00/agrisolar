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
            'water_amount' => [
                'numeric',
                'nullable',
                'required_without:select_existing_pump'
            ],
            'select_existing_pump' => [
                'numeric',
                'nullable',
                'required_without:water_amount'
            ],
            'dynamic_head' => [
                'numeric',
                'required_with:water_amount,location,cable_length,mounting_structure'
            ],
            'cable_length' => [
                'numeric',
                'required_with:water_amount,dynamic_head,mounting_structure,location',
                ],
            'location' => [
                'required_with:water_amount,dynamic_head,cable_length,mounting_structure|string'
            ],
            'mounting_structure' => [
                'required_with:water_amount,dynamic_head,cable_length,location',
                Rule::in(['Fixed', 'Tracking']),
            ],
            'module_name' => [
                'required_without:module',
                'nullable',
                'required_with:voc,vmpp,power_max'
            ],
            'voc' => [
                'required_without:module',
                'nullable',
                'required_with:module_name,vmpp,power_max'
            ],
            'vmpp' => [
                'required_without:module',
                'nullable',
                'required_with:voc,module_name,power_max'
            ],
            'power_max' => [
                'required_without:module',
                'nullable',
                'required_with:voc,vmpp,module_name'
            ],
        ];
    }

    public function messages()
    {
        return [
            'module_name.required_without' => 'module_name is required ',
            'voc.required_without' => 'voc is required ',
            'vmpp.required_without' => 'vmpp is required ',
            'power_max.required_without' => 'power max is required ',
        ];
    }
}
