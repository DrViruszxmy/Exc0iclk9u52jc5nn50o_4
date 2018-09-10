<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProgramRequest extends FormRequest
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
            'prog_name' => 'required',
            'prog_abv' => 'required',
            'prog_code' => 'required',
            'dep_id' => 'required',
            'prog_type' => 'required',
            'level' => 'required',
            'senior_high_track' => 'required',
        ];
    }

     public function messages()
    {
         return [
                'prog_name.required' => 'The program name field is required.',
                'prog_abv.required' => 'The program abvrevation field is required.',
                'prog_code.required' => 'The program code field is required.',
                'dep_id.required' => 'The department field is required.',
                'prog_type.required' => 'The program type field is required.',
                'level.required' => 'The level field is required.',
         ];
    }
}
