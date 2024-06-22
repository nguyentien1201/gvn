<?php

namespace App\Http\Requests\Signal;

use Illuminate\Foundation\Http\FormRequest;

class StoreSignalRequest extends FormRequest
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
            'trend' => [
                'required'],
            'signal' => [
                'required'],
            'price_action' => [
                'required',
                ],
            'price_stoploss' => [
                'required',
                ],
            'description' => 'nullable',
            'date_action'=>'required|date',
        ];
    }

    public function messages(): array
    {

        return [
            'code.required' => __('signal.code') . __('panel.required'),
            'price_current.required' => __('signal.price_current') . __('panel.required'),
            'trend.required' => __('signal.trend') . __('panel.required'),
            'signal.required' => __('signal.signal') . __('panel.required'),
            'price_action.required' => __('signal.price_action') . __('panel.required'),
            'price_stoploss.required' => __('signal.price_stoploss') . __('panel.required'),
            'date_action.required' => __('signal.date_action') . __('panel.required'),
            'date_action.date' => __('signal.date_action') . __('panel.date'),

        ];
    }
}
