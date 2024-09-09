<div class="row">
    <div class="col-md-12 form-group">
        <a href="#add-update-item" data-toggle="modal"
           onclick="addUpdateItem(this)"
           data-action="{{ route('admin.alerts.store')}}" class="btn btn-primary">
            {{ __('panel.add') }}
        </a>
    </div>
</div>
<div class="table-responsive table-head-fixed">
    <table class="table table-bordered table-truncate table-striped projects">
        <thead>
        <tr>
            <th class="text-ellipsis" style="width: 5%">{{__('panel.no')}}</th>
            <th class="text-ellipsis" style="width: 50%">{{ __('alert.content') }}</th>
            <th class="text-ellipsis">{{ __('alert.publish_time') }}</th>
            <th class="text-ellipsis text-center">{{ __('alert.status') }}</th>
            <th class="text-center" style="width: 10%">{{ __('panel.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @forelse($alerts as $idx => $alert)
            <tr>
                <td>{{$idx + 1}}</td>
                <td>{{$alert->content}}</td>
                <td>{{$alert->publish_time ? date('m/d/Y H:i', strtotime($alert->publish_time)) : ''}}</td>
                <td class="text-center">
                    <a href="javascript:void(0)"
                       class="btn btn-{{$alertStatusBackground[$alert->status]}} btn-sm">
                        {{$alertStatus[$alert->status]}}
                    </a>
                </td>
                <td class="text-center text-nowrap">
                    <a href="#add-update-item" data-toggle="modal"
                       data-id="{{$alert->id}}"
                       data-content="{{$alert->content}}"
                       data-status="{{$alert->status}}"
                       data-publish_time="{{$alert->publish_time ? date('m/d/Y H:i', strtotime($alert->publish_time)) : ''}}"
                       data-action="{{ route('admin.alerts.update', [$alert->id]) }}"
                       onclick="addUpdateItem(this)"
                       class="btn btn-primary btn-circle btn-sm">
                        <i class="fas fa-edit" aria-hidden="true"></i>
                    </a>
                    @if($alert->status == 0)
                        <a href="#confirmDelete" data-toggle="modal"
                           onclick="removeItem(this)"
                           data-website="{{$alert->website}}"
                           data-id="{{$alert->id}}"
                           data-action="{{ route('admin.alerts.destroy', [$alert->id])}}"
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
</div>
@include('partials.dialog-confirm-delete')
@include('partials.dialog-update-alert')
