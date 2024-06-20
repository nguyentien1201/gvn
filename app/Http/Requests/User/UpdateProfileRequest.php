<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'regex:/(^([a-zA-Z0-9]+)(\d+)?$)/u',
                'unique:users,name,' . request('id') . ',id,deleted_at,NULL',
            ],
            'email' => ['required',
                'email',
                'unique:users,name,' . request('id') . ',id,deleted_at,NULL',
            ],
            'password' => 'nullable|min:8',
            'confirm_password' => 'same:password',
            'role_id' => 'required'
        ];

    }

    public function messages(): array
    {
        return [
            'name.required' => __('user.name') . __('panel.required'),
            'name.regex' => __('user.name_regex'),
            'email.required' => __('user.email') . __('panel.required'),
            'email.email' => __('panel.format_email'),
            'password.min' => __('user.min_password'),
            'confirm_password.same' => __('user.same_password'),
            'name.unique' => __('user.name') . __('panel.existed'),
            'email.unique' => __('user.email') . __('panel.existed'),
            'role_id.required' => __('user.role') . __('panel.required'),
        ];
    }
}
