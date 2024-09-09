<?php

namespace App\Http\Requests\Token;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class UpdateTokenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'website' => [
                'required',
                'unique:tokens,website,' . request('id') . ',id,deleted_at,NULL',
            ],
            'domain' => 'required',
            'consumer_key' => 'required',
            'consumer_secret' => 'required',
            'access_token' => 'required',
            'access_token_secret' => 'required',
        ];

    }

    public function messages(): array
    {
        return [
            'website.required' => __('token.website') . __('panel.required'),
            'website.unique' => __('token.website') . __('panel.existed'),
            'domain.required' => __('token.domain') . __('panel.required'),
            'consumer_key.required' => __('token.consumer_key') . __('panel.required'),
            'consumer_secret.required' => __('token.consumer_secret') . __('panel.required'),
            'access_token.required' => __('token.access_token') . __('panel.required'),
            'access_token_secret.required' => __('token.access_token_secret') . __('panel.required'),
        ];
    }
}
