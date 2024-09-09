<?php

namespace App\Http\Requests\Promotion;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class UpdatePromotionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required',
            'execution_time' => 'required',
            'message' => 'required',
            'customer_ids.*' => 'required',
            'customer_ids' => 'array|required'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => __('promotion.title') . __('panel.required'),
            'execution_time.required' => __('promotion.execution_time') . __('panel.required'),
            'message.required' => __('promotion.message') . __('panel.required'),
            'customer_ids.required' => __('promotion.recipients') . __('panel.required'),
        ];
    }
}
