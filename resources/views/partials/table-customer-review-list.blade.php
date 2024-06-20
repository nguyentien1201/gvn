<table class="table table-bordered table-truncate table-striped projects">
    <thead>
    <tr>
        <th width="5%" class="text-ellipsis text-center">{{__('panel.no')}}</th>
        <th width="15%" class="text-ellipsis">{{ __('customer_review.website') }}</th>
        <th width="10%" class="text-ellipsis text-center">{{ __('customer_review.social_media_type') }}</th>
        <th width="10%" class="text-ellipsis">{{ __('customer_review.order_code') }}</th>
        <th width="13%" class="text-ellipsis">{{ __('customer_review.star_rated') }}</th>
        <th width="25%" class="text-ellipsis">{{ __('customer_review.content_rated') }}</th>
        <th width="15%" class="text-ellipsis text-center">{{ __('customer_review.review_dated') }}</th>
        <th width="7%" class="text-nowrap text-center">{{ __('panel.action') }}</th>
    </tr>
    </thead>
    <tbody>
    @forelse($customerReviews as $idx => $customerReview)
        <tr>
            <td width="5%" class="text-center">{{$idx + 1}}</td>
            <td width="15%">{{$customerReview->website}}</td>
            <td width="10%">
                <span
                    class="btn btn-md btn-sm btn-primary">
                    {{__('customer_review.' . array_search($customerReview->social_media_type, $reviewTypes))}}
                </span>
            </td>
            <td width="10%">{{$customerReview->order_id}}</td>
            <td width="13%">
                @for($i = 1; $i <= 5; $i++)
                    <i class="text-yellow fa-star fa-sm @if($i <= $customerReview->star_rated) fas @else far @endif"
                       aria-hidden="true"></i>
                @endfor
            </td>
            <td width="25%">{{$customerReview->content_rated}}</td>
            <td width="15%"
                class="text-center">{{$customerReview->created_at ? date('m/d/Y', strtotime($customerReview->created_at)) : ''}}</td>
            <td width="7%" class="text-center text-nowrap">

            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8" class="text-center">
                {{ __('panel.nodata') }}
            </td>
        </tr>
    @endforelse
    </tbody>
</table>
