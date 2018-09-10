<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdmissionRequest extends FormRequest
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
            // 'student.mname' => 'required',
            'student.cit_id' => 'required',
            // 'stud_id' => 'required|unique:stud_sch_info',
            'student.program' => 'required',
            // 'student.contact.*.phone_number' => 'nullable|numeric|regex:/^(09)[0-9]{9}$/|unique:phone_numbers',
            'junior_high.*.sch_name' => 'required',
            'junior_high.*.sch_year' => 'required',
            'junior_high.*.sector' => 'required',

            // 'junior_high.*.presentAddress.country_id' => 'required',
            // 'junior_high.*.presentAddress.reg_id' => 'required',
            // 'junior_high.*.presentAddress.province_id' => 'required',
            // 'junior_high.*.presentAddress.city_id' => 'required',
            // 'junior_high.*.presentAddress.brgy_id' => 'required',
            // 'junior_high.*.presentAddress.street' => 'required',

        ];
    }

    public function messages()
    {
         return [
                'student.lname.required' => 'Last name is required.',
                'student.fname.required' => 'First name is required.',
                'student.mname.required' => 'Middle name is required.',
                'student.cit_id.required' => 'Citizenship is required.',
                'student.program.required' => 'Course is required.',
                'student.contact.*.phone_number.unique' => 'This contact no. has already been taken.',
                'student.contact.*.phone_number.regex' => 'Must be a valid contact number. Ex. 09091234567',
                'student.contact.*.phone_number.numeric' => 'must be a number.',
                'stud_id.required' => 'Student id is required.',
                'stud_id.unique' => 'Student Id has already been taken.',
                'junior_high.*.sch_name.required' => 'School name is required.',
                'junior_high.*.sch_year.required' => 'School year is required.',
                'junior_high.*.sector.required' => 'Sector is required.',
                'junior_high.*.status.required' => 'School year is required.',

                'junior_high.*.presentAddress.country_id.required' => 'Country is required.',
                'junior_high.*.presentAddress.reg_id.required' => 'Region is required.',
                'junior_high.*.presentAddress.province_id.required' => 'Province is required.',
                'junior_high.*.presentAddress.city_id.required' => 'City is required.',
                'junior_high.*.presentAddress.brgy_id.required' => 'Barangay is required.',
                'junior_high.*.presentAddress.street.required' => 'Street is required.',
         ];
    }
}
