<table class="table table-bordered table-truncate table-striped projects">
    <thead>
    <tr>
        <th width="5%" class="text-ellipsis text-center">{{__('panel.no')}}</th>
        <th width="15%" class="text-ellipsis">
            <span>{{ __('review_setting.website') }}</span><br>
            <span class="text-sm text-gray">{{ __('review_setting.review_link') }}</span>
        </th>
        <th width="30%" class="text-ellipsis">{{ __('review_setting.message') }}</th>
        <th width="15%" class="text-ellipsis">{{ __('review_setting.google_place_id') }}</th>
        <th width="15%" class="text-ellipsis">{{ __('review_setting.facebook_review_link') }}</th>
        <th width="15%" class="text-ellipsis">{{ __('review_setting.yelp_review_link') }}</th>
        <th width="5%" class="text-nowrap text-center">{{ __('panel.action') }}</th>
    </tr>
    </thead>
    <tbody>
    @forelse($reviewSettings as $idx => $reviewSetting)
        <tr>
            <td width="5%" class="text-center">{{$idx + 1}}</td>
            <td width="15%">
                <span>{{$reviewSetting->website}}</span><br>
                <span class="text-sm text-gray">{{$reviewSetting->review_link}}</span>
            </td>
            <td width="30%">{{$reviewSetting->message}}</td>
            <td width="15%" class="text-ellipsis">{{$reviewSetting->google_place_id}}</td>
            <td width="15%" class="text-ellipsis">{{$reviewSetting->facebook_review_link}}</td>
            <td width="15%" class="text-ellipsis">{{$reviewSetting->yelp_review_link}}</td>
            <td width="5%" align="center" class="text-center text-nowrap th-sticky-right">
                @if(Auth::user()->role_id == \App\Models\ConstantModel::ROLES['admin'])
                    <a href="{{ route('admin.review_settings.edit',[$reviewSetting->id])}}"
                       class="btn btn-primary btn-circle btn-sm">
                        <i class="fas fa-edit" aria-hidden="true"></i>
                    </a>
                        <a href="#confirmDelete" data-toggle="modal"
                           onclick="removeItem(this)"
                           data-id="{{$reviewSetting->id}}"
                           data-action="{{ route('admin.review_settings.destroy', [$reviewSetting->id])}}"
                           class="btn btn-danger btn-circle btn-sm remove">
                            <i class="fas fa-trash" aria-hidden="true"></i>
                        </a>
                @endif
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="text-center">
                {{ __('panel.nodata') }}
            </td>
        </tr>
    @endforelse
    </tbody>
</table>
