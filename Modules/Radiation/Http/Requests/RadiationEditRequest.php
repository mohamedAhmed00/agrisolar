<?php

namespace Modules\Radiation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RadiationEditRequest extends FormRequest
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
            'timing' => 'required|string',
            'january' => 'required|numeric',
            'february' => 'required|numeric',
            'march' => 'required|numeric',
            'april' => 'required|numeric',
            'may' => 'required|numeric',
            'june' => 'required|numeric',
            'july' => 'required|numeric',
            'august' => 'required|numeric',
            'september' => 'required|numeric',
            'october' => 'required|numeric',
            'november' => 'required|numeric',
            'december' => 'required|numeric',
        ];
    }
}
