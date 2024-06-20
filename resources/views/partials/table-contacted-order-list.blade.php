<table class="table table-bordered table-truncate table-striped projects">
    <thead>
    <tr>
        <th width="5%" class="text-ellipsis text-center">{{__('panel.no')}}</th>
        <th width="8%" class="text-ellipsis">{{ __('order.order_id') }}</th>
        <th width="8%" class="text-ellipsis text-center">{{ __('order.status') }}</th>
        <th width="10%" class="text-ellipsis">{{ __('order.website') }}</th>
        <th width="8%" class="text-ellipsis">{{ __('order.first_name') }}</th>
        <th width="8%" class="text-ellipsis">{{ __('order.last_name') }}</th>
        <th width="12%" class="text-ellipsis">{{ __('order.email') }}</th>
        <th width="8%" class="text-ellipsis">{{ __('order.phone') }}</th>
        <th width="10%" class="text-ellipsis text-center">{{ __('order.created_date') }}</th>
        <th width="10%" class="text-ellipsis text-center">{{ __('order.latest_contact') }}</th>
        <th width="6%" class="text-ellipsis text-center">{{ __('order.days') }}</th>
        <th width="6%" class="text-nowrap text-center">{{ __('panel.action') }}</th>
    </tr>
    </thead>
    <tbody>
    @forelse($orders as $idx => $order)
        <tr class="{{$order->days > 90 ? 'warning' : ''}}">
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
            <td class="text-center">{{$order->latest_contact_date ? date('m/d/Y', strtotime($order->latest_contact_date)) : ''}}</td>
            <td class="text-center">{{$order->days ?? ''}}</td>
            <td class="text-center text-nowrap">
                <a href="javascript:void(0)" onclick="addContactNote(this)"
                   data-id="{{$order->id}}" data-website="{{$order->website}}"
                   data-contact_note="{{$order->contact_note}}"
                   data-latest_contact_date="{{$order->latest_contact_date ? date('m/d/Y', strtotime($order->latest_contact_date)) : ''}}"
                   data-action="{{ route('admin.orders.contact_note')}}"
                   class="btn btn-success btn-circle btn-sm remove">
                    <i class="fas fa-sticky-note" aria-hidden="true"></i>
                </a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="12" class="text-center">
                {{ __('panel.nodata') }}
            </td>
        </tr>
    @endforelse
    </tbody>
    @include('partials.dialog-contact-note')
</table>
