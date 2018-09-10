<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUncreditedSubjectsRequest extends FormRequest
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
            'uncredited_subject.school_id' => 'required',
            'uncredited_subject.sch_year' => 'required',
            'uncredited_subject.subj_code' => 'required',
            'uncredited_subject.subj_name' => 'required',
            'uncredited_subject.subj_desc' => 'required',
            'uncredited_subject.subj_credit_number' => 'required',
            'uncredited_subject.subj_type' => 'required',
            'uncredited_subject.uncredited_grades.gen_ave' => 'required|numeric',
            'uncredited_subject.uncredited_grades.final_grade' => 'required|numeric',
        ];
    }

    public function messages()
    {
         return [
                'uncredited_subject.school_id.required' => 'Select a school.',
                'uncredited_subject.sch_year.required' => 'Select a school year.',
                'uncredited_subject.subj_code.required' => 'Subject code field is required.',
                'uncredited_subject.subj_name.required' => 'Subject name field is required.',
                'uncredited_subject.subj_desc.required' => 'Subject description field is required.',
                'uncredited_subject.subj_credit_number.required' => 'Subject credit number field is required.',
                'uncredited_subject.subj_type.required' => 'Subject type field is required.',
                'uncredited_subject.uncredited_grades.gen_ave.required' => 'Subject grade field is required.',
                'uncredited_subject.uncredited_grades.final_grade.required' => 'Subject final grade field is required.',

                'uncredited_subject.uncredited_grades.gen_ave.numeric' => 'Must be a number.',
                'uncredited_subject.uncredited_grades.final_grade.numeric' => 'Must be a number.',
         ];
    }
}
