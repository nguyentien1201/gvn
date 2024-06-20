<div class="table-responsive table-head-fixed">
    <table class="table table-bordered table-truncate table-striped projects">
        <thead>
        <tr>
            <th class="text-ellipsis" style="width: 5%">{{__('panel.no')}}</th>
            <th class="text-ellipsis" style="width: 30%">{{ __('product.product_name') }}</th>
            <th class="text-ellipsis">{{ __('product.price') }}</th>
            <th class="text-ellipsis">{{ __('product.quantity') }}</th>
            <th class="text-ellipsis">{{ __('product.unit') }}</th>
            <th class="text-ellipsis">{{ __('product.total') }}</th>
        </tr>
        </thead>
        <tbody>
        @forelse($products as $idx => $product)
            <tr>
                <td>{{$idx + 1}}</td>
                <td class="text-ellipsis">{{$product->product_name}}</td>
                <td class="text-ellipsis">{{$product->price ? number_format($product->price, 2, ',', '.') : ''}}</td>
                <td class="text-ellipsis">{{$product->quantity}}</td>
                <td class="text-ellipsis">{{$product->unit}}</td>
                <td class="text-ellipsis">{{$product->total ? number_format($product->total, 2, ',', '.') : ''}}</td>
            </tr>
        @empty
            <tr>
                <td colspan="10" class="text-center">
                    {{ __('panel.nodata') }}
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
