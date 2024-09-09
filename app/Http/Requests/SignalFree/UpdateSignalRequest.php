<?php

namespace App\Http\Requests\SignalFree;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSignalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => [
                'required',
            ],
            'trend_price' => [
                'required'],
            'last_sale' => [
                'required'],
            'date_action'=>'required|date',
        ];

    }

    public function messages(): array
    {
        return [
            'code.required' => __('signal.code') . __('panel.required'),
            'trend_price.required' => __('signal.trend_price') . __('panel.required'),
            'last_sale.required' => __('last_sale.trend') . __('panel.required'),
            'date_action.required' => __('signal.date_action') . __('panel.required'),
            'date_action.date' => __('signal.date_action') . __('panel.date'),
        ];
    }
}
