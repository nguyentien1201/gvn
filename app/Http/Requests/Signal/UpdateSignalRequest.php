<?php

namespace App\Http\Requests\Signal;

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
            'price_current' =>[
                'required'],
            'trend' => [
                'required'],
            'signal' => [
                'required'],
            'price_action' => [
                'required',
                ],
            'price_cumulative_from' => [
                'required',
                ],
            'price_cumulative_to' => [
                'required',
                ],
            'price_stoploss' => [
                'required',
                ],
            'price_target' => [
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
            'price_cumulative_from.required' => __('signal.price_cumulative_from') . __('panel.required'),
            'price_cumulative_to.required' => __('signal.price_cumulative_to') . __('panel.required'),
            'price_stoploss.required' => __('signal.price_stoploss') . __('panel.required'),
            'price_target.required' => __('signal.price_target') . __('panel.required'),
            'date_action.required' => __('signal.date_action') . __('panel.required'),
            'date_action.date' => __('signal.date_action') . __('panel.date'),
        ];
    }
}
