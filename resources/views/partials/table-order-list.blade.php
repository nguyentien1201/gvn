<table class="table table-bordered table-truncate table-striped projects">
    <thead>
    <tr>
        <th width="5%" class="text-ellipsis text-center">{{__('panel.no')}}</th>
        <th width="7%" class="text-ellipsis">{{ __('order.order_id') }}</th>
        <th width="10%" class="text-ellipsis text-center">{{ __('order.status') }}</th>
        <th width="12%" class="text-ellipsis">{{ __('order.website') }}</th>
        <th width="9%" class="text-ellipsis">{{ __('order.first_name') }}</th>
        <th width="9%" class="text-ellipsis">{{ __('order.last_name') }}</th>
        <th width="13%" class="text-ellipsis">{{ __('order.email') }}</th>
        <th width="10%" class="text-ellipsis">{{ __('order.phone') }}</th>
        <th width="10%" class="text-ellipsis text-center">{{ __('order.created_date') }}</th>
        <th width="8%" class="text-nowrap text-center">{{ __('panel.action') }}</th>
    </tr>
    </thead>
    <tbody>
    @forelse($orders as $idx => $order)
        <tr>
            <td class="text-center">{{$idx + 1}}</td>
            <td>{{$order->order_id}}</td>
            <td class="text-center">
                <a href="javascript:void(0)"
                   class="btn btn-{{$background[$order->status] ?? ''}} btn-sm">
                    {{$status[$order->status] ?? ''}}
                </a>
            </td>
            <td>{{$order->website}}</td>
            <td>{{$order->first_name}}</td>
            <td>{{$order->last_name}}</td>
            <td>{{$order->email}}</td>
            <td>{{$order->phone}}</td>
            <td class="text-center">{{$order->created_date ? date('m/d/Y', strtotime($order->created_date)) : ''}}</td>
            <td class="text-center text-nowrap">
                <a href="{{ route('admin.orders.edit',['id' => $order->id, 'website' => $order->website]) }}"
                   class="btn btn-primary btn-circle btn-sm">
                    <i class="fas fa-edit" aria-hidden="true"></i>
                </a>
                @if(Auth::user()->role_id == \App\Models\ConstantModel::ROLES['admin'])
                    <a href="#confirmDelete" data-toggle="modal"
                       onclick="removeItem(this)"
                       data-id="{{$order->id}}"
                       data-website="{{$order->website}}"
                       data-text-confirm="{{$order->confirm_delete}}"
                       data-action="{{ route('admin.orders.destroy', [$order->id])}}"
                       class="btn btn-danger btn-circle btn-sm remove">
                        <i class="fas fa-trash" aria-hidden="true"></i>
                    </a>
                @endif
            </td>
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
