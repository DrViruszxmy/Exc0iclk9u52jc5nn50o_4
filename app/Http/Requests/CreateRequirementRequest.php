<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequirementRequest extends FormRequest
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
            'requirement.requirements' => 'required',
            'requirement.quantity' => 'required',
        ];
    }

    public function messages()
    {
         return [
                'requirement.requirements.required' => 'Requirement field is required.',
                'requirement.quantity.required' => 'Quantity field is required.',
         ];
    }
}
