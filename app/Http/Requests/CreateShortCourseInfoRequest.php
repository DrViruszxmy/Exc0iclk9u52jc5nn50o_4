<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateShortCourseInfoRequest extends FormRequest
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
             'course_name' => 'required',
             'days' => 'required',
             'date_start_end' => 'required',
             'time_start' => 'required',
             'time_end' => 'required',
             'description' => 'required',
        ];
    }

    public function messages()
    {
         return [
                'date_start_end.required' => 'Date range field is required.',
                'time_start.required' => 'Time start field is required.',
                'time_end.required' => 'Time end field is required.',
         ];
    }
}
