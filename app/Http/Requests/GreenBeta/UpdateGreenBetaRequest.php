<?php

namespace App\Http\Requests\GreenBeta;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGreenBetaRequest extends FormRequest
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
            'price_close' => [
                'required'
            ],
            'price_open' => [
                'required'
            ],
            'open_time' => [
                'required',
            ],
            'signal_close' => [
                'required',
            ],
            'profit' => [
                'required',
            ],
            'close_time' => [
                'required',
            ],
            'signal_open' => [
                'required',
            ]
        ];

    }

    public function messages(): array
    {
        return [
           'code.required' => __('signal.code') . __('panel.required'),
            'price_close.required' => __('signal.price_close') . __('panel.required'),
            'price_open.required' => __('signal.price_open') . __('panel.required'),
            'open_time.required' => __('signal.open_time') . __('panel.required'),
            'signal_close.required' => __('signal.signal_close') . __('panel.required'),
            'profit.required' => __('signal.profit') . __('panel.required'),
            'close_time.required' => __('signal.close_time') . __('panel.required'),
            'signal_open.required' => __('signal.signal_open') . __('panel.required'),
        ];
    }
}
