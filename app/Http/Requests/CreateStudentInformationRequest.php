<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class CreateStudentInformationRequest extends FormRequest
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
            'student.lname' => 'required',
            'student.fname' => 'required',
            'student.mname' => 'required',
            'student.program' => 'required',
            // 'student.email.*.email' => 'email|unique:emails',
            // 'student.email.*.email' => [
            //     'required',
            //     Rule::unique('emails')->ignore($this->email_id, 'email_id'),
            // ],
            // 'student.presentAddress_country' => 'required',
            // 'student.pre_province' => 'required',
            // 'student.pre_city' => 'required',
            // 'student.pre_barangay' => 'required',
            // 'student.pre_street' => 'required',
            // 'student.permanentAddress_country' => 'required',
            // 'student.perma_province' => 'required',
            // 'student.perma_city' => 'required',
            // 'student.perma_barangay' => 'required',
            // 'student.perma_street' => 'required',
            'student.cit_id' => 'required',
            // 'student.height' => 'required',
            // 'student.weight' => 'required',
            // 'student.birthdate' => 'required',
            // 'student.birthplace' => 'required',
            // 'student.religion' => 'required',
            // 'student_email.*.email' => 'email|unique:emails',

            // 'father.lname' => 'required',
            // 'father.fname' => 'required',
            // 'father.mname' => 'required',
            // 'father.country' => 'required',
            // 'father.pre_province' => 'required',
            // 'father.pre_city' => 'required',
            // 'father.pre_barangay' => 'required',
            // 'father.pre_street' => 'required',
            // // 'father.birthdate' => 'required',
            // 'father.occupation' => 'required',
            // 'father.office_address' => 'required',

            // 'mother.lname' => 'required',
            // 'mother.fname' => 'required',
            // 'mother.mname' => 'required',
            // 'mother.country' => 'required',
            // 'mother.pre_province' => 'required',
            // 'mother.pre_city' => 'required',
            // 'mother.pre_barangay' => 'required',
            // 'mother.pre_street' => 'required',
            // // 'mother.birthdate' => 'required',
            // 'mother.occupation' => 'required',
            // 'mother.office_address' => 'required',

            // 'guardian.relationship' => 'required',
            // 'guardian.lname' => 'required',
            // 'guardian.fname' => 'required',
            // 'guardian.mname' => 'required',
            // 'guardian.country' => 'required',
            // 'guardian.pre_province' => 'required',
            // 'guardian.pre_city' => 'required',
            // 'guardian.pre_barangay' => 'required',
            // 'guardian.pre_street' => 'required',
            // 'guardian.birthdate' => 'required',
            // 'guardian.occupation' => 'required',
            // 'guardian.office_address' => 'required',
            // 'elementary.*.sch_name' => 'required',
            // 'junior_high.*.sch_name' => 'required',
            // 'senior_high.*.sch_name' => 'required',
        ];
    }

    public function messages()
    {
         return [
                'student.lname.required' => 'The Last Name field is required.',
                // 'student.lname.min' => 'The student Last Name must be at least 3 characters.',
                'student.fname.required' => 'The First Name field is required.',
                'student.mname.required' => 'The Middle Name field is required.',
                'student.program.required' => 'The Course field is required.',
                'student.birthdate.required' => 'The birthdate field is required.',
                'student.presentAddress_country.required' => 'The present country field is required.',
                'student.pre_province.required' => 'The present province field is required.',
                'student.pre_city.required' => 'The present city field is required.',
                'student.pre_barangay.required' => 'The present barangay field is required.',
                'student.pre_street.required' => 'The present street field is required.',
                'student.permanentAddress_country.required' => 'The permanent country field is required.',
                'student.perma_province.required' => 'The permanent province field is required.',
                'student.perma_city.required' => 'The permanent city field is required.',
                'student.perma_barangay.required' => 'The permanent barangay field is required.',
                'student.perma_street.required' => 'The permanent street field is required.',
                'student.cit_id.required' => 'The citizenship field is required.',
                'student.height.required' => 'The height field is required.',
                'student.weight.required' => 'The weight field is required.',
                'student.religion.required' => 'The religion field is required.',
                
                'father.lname.required' => 'The Last Name field is required.',
                // 'father.lname.min' => 'The father Last Name must be at least 3 characters.',
                'father.fname.required' => 'The First Name field is required.',
                'father.mname.required' => 'The Middle Name field is required.',

                // 'student.birthdate.required' => 'The birthdate field is required.',
                'student.contact.*.phone_number' => 'Must be a valid contact number.',
                'student.contact.*.phone_number.unique' => 'This contact no. has already been taken.',

                'student.email.*.email' => 'The email must be a valid email address.',
                'student.email.*.email.unique' => 'The email has already been taken.',


                'student.birthplace.required' => 'The birthplace field is required.',
                'elementary.*.sch_name.required' => 'The elementary school name field is required.',
                'junior_high.*.sch_name.required' => 'The junior high school name field is required.',
                'senior_high.*.sch_name.required' => 'The senior high school name field is required.',
         ];
    }

    
}
