<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdmissionUpdateRequest extends FormRequest
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
            's_email' => 'required|unique:admission_forms,s_email,'.$this->id,
            'f_name' => 'required',
            'm_name' => 'required',
            's_phone' => 'required|unique:admission_forms,s_phone,'.$this->id,
            'f_phone' => 'required',
            'dob' => 'required',
            'profession' => 'required',
            'gender' => 'required',
            'blood_group' => 'required',
            'qualification' => 'required',
            'nid' => 'required',
            'present_address' => 'required',
            'course' => 'required',
            'batch_no' => 'required',
            'batch_type' => 'required',
            'class_schedule' => 'required',
            'class_time' => 'required',
            'total_fee' => 'required',
            'advance' => 'required',
            'due' => 'required',
            'admission_date' => 'required',
            'fb_id' => 'required',
            'reference' => 'required'
        ];
    }
}