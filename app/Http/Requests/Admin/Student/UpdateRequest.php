<?php

namespace App\Http\Requests\Admin\Student;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'student_status' => ['nullable', 'max:30'],
            'surname' => ['required', 'string', 'min:2', 'max:256'], //255 if this is huge mistake I'll shoot video on it
            'middlename' => ['nullable', 'string', 'min:2', 'max:255'],
            'forename' => ['required', 'string', 'min:2', 'max:255'],
            'gender' => ['nullable', 'string', 'max:255'],
            'dob' => ['required', 'date'],
            
            'student_status' => ['nullable', 'string', 'max:255'],
            'status_date' => ['nullable', 'date'],
            'class' => ['nullable', 'integer'],

            'ethnicity' => ['nullable', 'string','max:255'],
            'other_ethnicity' => ['nullable', 'string', 'max:255'],
            'student_email' => ['nullable', 'email'],
            'student_telephone' => ['nullable', 'max:255'],
            'student_mobile' => ['nullable', 'max:255'],
            'fsm' => ['nullable', 'string', 'max:255'],
            'eal' => ['nullable', 'string', 'max:255'],
            'sen' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'integer'],
            'post_code' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'min:2', 'max:3000'],
            'lives_with' => ['nullable', 'string', 'max:255'],
            'pupil_lives_with' => ['nullable', 'string', 'max:255'],

            'doctor_name' => ['nullable', 'string', 'min:2', 'max:255'],
            'doctor_telephone' => ['nullable', 'string', 'max:255'],
            'doctor_address' => ['nullable', 'string', 'min:2', 'max:3000'],
            'medical_condition' => ['nullable', 'string', 'max:5000'],
            
            'emergency_contact_name_1' => ['nullable', 'string', 'min:2', 'max:255'],
            'emergency_relationship_to_pupil_1' => ['nullable', 'string', 'min:2', 'max:255'],
            'emergency_telephone_1' => ['nullable', 'string', 'min:2', 'max:255'],
            
            'emergency_contact_name_2' => ['nullable', 'string', 'min:2', 'max:255'],
            'emergency_relationship_to_pupil_2' => ['nullable', 'string', 'min:2', 'max:255'],
            'emergency_telephone_2' => ['nullable', 'string', 'min:2', 'max:255'],

            'emergency_contact_name_3' => ['nullable', 'string', 'min:2', 'max:255'],
            'emergency_relationship_to_pupil_3' => ['nullable', 'string', 'max:255'],
            'emergency_telephone_3' => ['nullable', 'string', 'min:2', 'max:255'],

            'father_name' => ['nullable', 'string', 'min:2', 'max:255'],
            'father_home_telephone' => ['nullable', 'string', 'max:255'],
            'father_work_telephone' => ['nullable', 'string', 'max:255'],
            'father_mobile' => ['nullable', 'string', 'max:255'],
            'father_ocuupation' => ['nullable', 'string', 'max:255'],
            'father_address' => ['nullable', 'string', 'min:2', 'max:3000'],

            'mother_name' => ['nullable', 'string', 'min:2', 'max:255'],
            'mother_home_telephone' => ['nullable', 'string', 'max:255'],
            'mother_work_telephone' => ['nullable', 'string', 'max:255'],
            'mother_mobile' => ['nullable', 'string', 'max:255'],
            'mother_ocuupation' => ['nullable', 'string', 'max:255'],
            'mother_address' => ['nullable', 'string', 'min:2', 'max:3000'],

            'previous_school_left_date' => ['nullable', 'date'],
            'previous_school' => ['nullable', 'string', 'min:2', 'max:255'],
            'previous_school_address' => ['nullable', 'string', 'max:3000'],
            'reason_for_leaving' => ['nullable', 'string', 'max:255'],

            'new_school' => ['nullable', 'string', 'min:2', 'max:255'],
            'new_school_address' => ['nullable', 'string', 'max:3000'],

            'student_missing_status' => ['nullable', 'integer', 'between:0,1'],
            'student_la_contacted' => ['nullable', 'integer', 'between:0,1'],
            'student_missing_note' => ['nullable', 'string', 'min:2', 'max:3000'],
            'student_missing_date' => ['nullable', 'date'],

            'consent_1' => ['nullable', 'integer', 'between:0,1'],
            'consent_2' => ['nullable', 'integer', 'between:0,1'],
            'consent_3' => ['nullable', 'integer', 'between:0,1'],
            'consent_4' => ['nullable', 'integer', 'between:0,1'],
            'consent_5' => ['nullable', 'integer', 'between:0,1']
        ];
    }
}
