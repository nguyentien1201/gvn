<?php

namespace App\Http\Requests\MstStock;

use Illuminate\Foundation\Http\FormRequest;

class StoreMstStockRequest extends FormRequest
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
                'unique:mst_stocks,code,NULL,id,deleted_at,NULL',
            ],
           'name' => [
                'required',
                'unique:mst_stocks,name,NULL,id,deleted_at,NULL',
            ],
            'decription' => 'nullable|email|unique:customers,email,NULL,id,deleted_at,NULL',
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => __('stock.code') . __('panel.required'),
            'code.unique' => __('stock.code') . __('panel.existed'),
            'name.required' => __('stock.name') . __('panel.required'),
            'name.unique' => __('stock.name') . __('panel.existed'),
        ];
    }
}
