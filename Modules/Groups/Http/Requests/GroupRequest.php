<?php

namespace Modules\Groups\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GroupRequest extends FormRequest
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
            'name' => 'required|string|unique:groups,name',
            'show_pump' => 'nullable|' .  Rule::in(['true']),
            'create_pump' => 'nullable|' .  Rule::in(['true']),
            'edit_pump' => 'nullable|' .  Rule::in(['true']),
            'delete_pump' => 'nullable|' .  Rule::in(['true']),
            'show_pump_height' => 'nullable|' .  Rule::in(['true']),
            'create_pump_height' => 'nullable|' .  Rule::in(['true']),
            'edit_pump_height' => 'nullable|' .  Rule::in(['true']),
            'delete_pump_height' => 'nullable|' .  Rule::in(['true']),
            'show_settings' => 'nullable|' .  Rule::in(['true']),
            'create_settings' => 'nullable|' .  Rule::in(['true']),
            'edit_settings' => 'nullable|' .  Rule::in(['true']),
            'delete_settings' => 'nullable|' .  Rule::in(['true']),
            'show_groups' => 'nullable|' .  Rule::in(['true']),
            'create_groups' => 'nullable|' .  Rule::in(['true']),
            'edit_groups' => 'nullable|' .  Rule::in(['true']),
            'delete_groups' => 'nullable|' .  Rule::in(['true']),
            'show_user' => 'nullable|' .  Rule::in(['true']),
            'create_user' => 'nullable|' .  Rule::in(['true']),
            'edit_user' => 'nullable|' .  Rule::in(['true']),
            'delete_user' => 'nullable|' .  Rule::in(['true']),
        ];
    }
}
