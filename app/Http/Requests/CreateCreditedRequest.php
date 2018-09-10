<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCreditedRequest extends FormRequest
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
            'curriculum.yearSem.*.curriculum_subject.*.grade' => 'nullable|numeric|between:1,5',
        ];
    }

    public function messages()
    {
         return [
                'curriculum.yearSem.*.curriculum_subject.*.grade.numeric' => 'Must be a number.',
                'curriculum.yearSem.*.curriculum_subject.*.grade.between' => 'Must be between 1 and 5.',
         ];
    }
}
