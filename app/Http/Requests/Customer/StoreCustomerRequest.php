<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone_number' => [
                'required',
                'unique:customers,phone_number,NULL,id,deleted_at,NULL',
            ],
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'nullable|email|unique:customers,email,NULL,id,deleted_at,NULL',
        ];
    }

    public function messages(): array
    {
        return [
            'phone_number.required' => __('customer.phone_number') . __('panel.required'),
            'phone_number.unique' => __('customer.phone_number') . __('panel.existed'),
            'email.unique' => __('customer.email') . __('panel.existed'),
            'first_name.required' => __('customer.first_name') . __('panel.required'),
            'last_name.required' => __('customer.last_name') . __('panel.required'),
        ];
    }
}
