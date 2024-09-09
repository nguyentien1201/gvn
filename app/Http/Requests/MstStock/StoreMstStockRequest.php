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
           'group' => [
                'required'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => __('mst_stock.code') . __('panel.required'),
            'code.unique' => __('mst_stock.code') . __('panel.existed'),
            'name.required' => __('mst_stock.name') . __('panel.required'),
            'name.unique' => __('mst_stock.name') . __('panel.existed'),
            'group.required' => __('mst_stock.group') . __('panel.required'),
        ];
    }
}
