<?php

namespace App\Http\Requests\MstStock;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMstStockRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => 'unique:mst_stocks,code,' . request('id') . ',id,deleted_at,NULL',
            'name' => 'unique:mst_stocks,name,' . request('id') . ',id,deleted_at,NULL',
            'group' => 'required',
        ];

    }

    public function messages(): array
    {
        return [
            'code.required' => __('mst_stock.code') . __('panel.required'),
            'code.unique' => __('mst_stock.name') . __('panel.existed'),
            'name.required' => __('mst_stock.name') . __('panel.required'),
            'name.unique' => __('mst_stock.name') . __('panel.existed'),
            'group.required' => __('mst_stock.group') . __('panel.required'),
        ];
    }
}
