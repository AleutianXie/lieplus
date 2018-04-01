<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResumePost extends FormRequest
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
        if ($this->isMethod('POST')) {
            return [
                'name'          => 'required',
                'gender'        => 'required',
                'mobile'        => ['required', 'regex:/^1(3|4|5|7|8)[0-9]{9}$/', 'unique:resumes'],
                'email'         => 'required|email|unique:resumes',
                'birthdate'     => 'required|date|before_or_equal:' . date('Y-m-d', time()),
                'start_work_date' => 'required|date|before_or_equal:' . date('Y-m-d', time()) . '|after_or_equal:' . date('Y-m-d', strtotime('-20 years')),
            ];
        }
        return [];
    }
}
