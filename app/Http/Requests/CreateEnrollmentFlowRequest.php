<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEnrollmentFlowRequest extends FormRequest
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
            'flow_name' => 'required',
            'level' => 'required',
            'student_type' => 'required',
            'version' => 'required',
            'steps.*.steps_title' => 'required',
            'steps.*.location' => 'required',
            'steps.*.mod_id' => 'required',
        ];
    }

    public function messages()
    {
         return [
                'steps.*.steps_title.required' => 'Step title field is required.',
                'steps.*.location.required' => 'Location field is required.',
                'steps.*.mod_id.required' => 'Portal is required.',
         ];
    }
}
