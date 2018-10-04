<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class StoreUserPost extends FormRequest
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
        if ($this->isMethod('GET'))
        {
            return [];
        }
        if (Route::currentRouteName() == 'user.edit')
        {
            return [
                'name' => 'sometimes|required|unique:users',
                'email' => 'sometimes|required|email|unique:users',
                'mobile' => ['sometimes', 'required', 'regex:/^1(3|4|5|7|8)[0-9]{9}$/', 'unique:profiles'],
                'number' => ['sometimes', 'required', 'regex:/^(H|h)[0-9]{4}$/', 'unique:profiles'],
                'birthdate' => 'sometimes|required|date|before_or_equal:' . date('Y-m-d', time()),
                'gender' => 'sometimes|required|integer|min:1|max:2',
                'branch_id' => 'sometimes|required|integer',
                'role_id' => 'sometimes|required|integer',
            ];
        }
    }

    public function attributes()
    {
        return [
            'name' => __('auth.name'),
            'email' => __('auth.email'),
            'number' => __('lieplus.number'),
            'mobile' => __('lieplus.mobile'),
            'birthdate' => __('lieplus.birthdate'),
            'branch_id' => __('lieplus.branch'),
            'role_id' => __('lieplus.role'),
        ];
    }

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    protected function validationData()
    {
        if (Route::currentRouteName() == 'user.edit') {
            $data = $this->all();
            return [$data['name'] => $data['value']];
        }
        return $this->all();
    }
}
