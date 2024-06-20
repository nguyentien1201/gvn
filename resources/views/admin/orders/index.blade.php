@extends('layout.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        {{ \Illuminate\Support\Facades\Lang::get(!request('is_contact') ? 'order.list'  : __('order.contact_list'), ['website' => request('website')])}}
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <!-- result -->
    <section class="content">
        <div class="container-fluid">
            <form class="search-frm search-frm-order" method="GET" action="{{ route("admin.orders.index") }}"
                  enctype="multipart/form-data">
                <input type="hidden" name="is_contact" value="{{request('is_contact') ?? 0}}">
                <input type="hidden" name="website" value="{{request('website') ?? ''}}">
                <div class="card card-primary collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('panel.search')}}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col-md-6">
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label>{{(__('order.order_id'))}}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="order_id" value="{{request('order_id')}}"
                                               class="form-control" autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label>{{(__('order.status'))}}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select class="form-control select2" name="status" autocomplete="off">
                                            <option value="">{{__('panel.please_choose')}}</option>
                                            @foreach($status as $idx => $sta)
                                                <option value="{{$idx}}"
                                                        @if(request('status') != '' && request('status') == $idx) selected @endif>{{$sta}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label>{{(__('order.first_name'))}}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="first_name" value="{{request('first_name')}}"
                                               class="form-control" autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label>{{(__('order.last_name'))}}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="last_name" value="{{request('last_name')}}"
                                               class="form-control" autocomplete="off"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label>{{(__('user.email'))}}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="email" value="{{request('email')}}"
                                               class="form-control"/>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label>{{(__('order.phone'))}}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" name="phone"
                                                   class="form-control"
                                                   value="{{request('phone')}}"
                                                   data-inputmask='"mask": "9999999999"' data-mask>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>{{(__('order.created_date'))}}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group date" id="created_date"
                                             data-target-input="nearest">
                                            <input type="text" data-target="#created_date" name="created_date"
                                                   value="{{request('created_date')}}" autocomplete="off"
                                                   class="form-control datetimepicker-input datetimepicker">
                                            <div class="input-group-append" data-target="#created_date"
                                                 data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary">{{__('panel.search')}}</button>
                        <button type="button" class="btn btn-warning btn-reset-search">{{ __('panel.reset') }}</button>
                    </div>
                </div>
            </form>
            <div class="card">
                <div class="card-header">
                    {{__('panel.list')}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if (!request('is_contact'))
                            @include('partials.table-order-list')
                        @else
                            @include('partials.table-contacted-order-list')
                        @endif
                    </div>
                    @if(!empty($orders))
                        <div class="paginations mt-3">
                            {!! $orders->appends($_GET)->links() !!}
                        </div>
                    @endif
                    @include('partials.dialog-confirm-delete')
                </div>
            </div>
        </div>
    </section>
@endsection
