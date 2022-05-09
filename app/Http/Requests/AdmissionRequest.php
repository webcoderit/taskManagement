<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdmissionRequest extends FormRequest
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
            's_name' => 'required',
            'f_name' => 'required',
            'm_name' => 'required',
            's_phone' => 'required',
            'f_phone' => 'required',
            'dob' => 'required',
            'profession' => 'required',
            'gender' => 'required',
            'blood_group' => 'required',
            'qualification' => 'required',
            'nid' => 'required',
            'present_address' => 'required',
            'permanent_address' => 'required',
            'course' => 'required',
            'batch_no' => 'required',
            'batch_type' => 'required',
            'class_shedule' => 'required',
            'class_time' => 'required',
        ];
    }
}
