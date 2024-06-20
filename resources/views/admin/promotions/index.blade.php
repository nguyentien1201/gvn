@extends('layout.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('panel.promotion')}}</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- result -->
    <section class="content">
        <div class="container-fluid">
            <form class="search-frm search-frm-order" method="GET" action="{{ route("admin.promotions.index") }}"
                  enctype="multipart/form-data">
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
                                        <label>{{(__('promotion.title'))}}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="title" value="{{request('title')}}" placeholder="{{__('promotion.title_place')}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>{{(__('promotion.start_time'))}}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group date-time" id="start_time"
                                             data-target-input="nearest">
                                            <input type="text" data-target="#start_time" name="start_time"
                                                   value="{{request('start_time')}}" autocomplete="off"
                                                   class="form-control datetimepicker-input datetimepicker">
                                            <div class="input-group-append" data-target="#start_time"
                                                 data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label>{{(__('promotion.status'))}}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select class="form-control select2" name="status" autocomplete="off">
                                            <option value="">{{__('panel.please_choose')}}</option>
                                            @foreach($status as $key => $value)
                                                <option value="{{$value}}"
                                                        @if(request('status') != '' && request('status') == $value) selected @endif>{{__('promotion.'.$key)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>{{(__('promotion.end_time'))}}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group date-time" id="end_time"
                                             data-target-input="nearest">
                                            <input type="text" data-target="#end_time" name="end_time"
                                                   value="{{request('end_time')}}" autocomplete="off"
                                                   class="form-control datetimepicker-input datetimepicker">
                                            <div class="input-group-append" data-target="#end_time"
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
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <a href="{{ route('admin.promotions.create') }}"
                               class="btn btn-primary">
                                {{ __('panel.add') }}
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-truncate table-striped projects">
                            <thead>
                            <tr>
                                <th width="5%" class="text-center">{{__('panel.no')}}</th>
                                <th width="10%">{{ __('promotion.title') }}</th>
                                <th width="40%">{{ __('promotion.message') }}</th>
                                <th width="12%" class="text-center">{{ __('promotion.execution_time') }}</th>
                                <th width="8%" class="text-center">{{ __('promotion.status') }}</th>
                                <th width="10%" class="text-center">{{ __('promotion.amount_sent') }}</th>
                                <th width="10%" class="text-nowrap text-center">{{ __('panel.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($promotions as $idx => $promotion)
                                <tr>
                                    <td width="5%" class="text-center">{{$idx + 1}}</td>
                                    <td width="10%">{{$promotion->title}}</td>
                                    <td width="40%">
                                        {!! nl2br($promotion->message) !!}
                                    </td>
                                    <td width="12%"
                                        class="text-center">{{$promotion->execution_time ? date('m/d/Y H:i', strtotime($promotion->execution_time)) : ''}}</td>
                                    <td width="8%" class="text-center">
                                        <a href="javascript:void(0)"
                                           class="btn btn-{{$promotionBtn[$promotion->status] ?? ''}} btn-sm">
                                            {{__('promotion.'.array_search($promotion->status, $status))}}
                                        </a>
                                    </td>
                                    <td width="10%"
                                        class="text-center">{{$promotion->sent . '/'. $promotion->total}}</td>
                                    <td class="text-center text-nowrap">
                                        @if($promotion->status == $status['reserve'])
                                            <a href="{{ route('admin.promotions.edit', [$promotion->id]) }}"
                                               class="btn btn-primary btn-circle btn-sm">
                                                <i class="fas fa-edit" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                        <a href="#confirmDelete" data-toggle="modal"
                                           onclick="removeItem(this)"
                                           data-id="{{$promotion->id}}"
                                           data-action="{{ route('admin.promotions.destroy', [$promotion->id])}}"
                                           class="btn btn-danger btn-circle btn-sm remove">
                                            <i class="fas fa-trash" aria-hidden="true"></i>
                                        </a>

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
                    </div>
                    @if(!empty($promotions))
                        <div class="paginations mt-3">
                            {!! $promotions->appends($_GET)->links() !!}
                        </div>
                    @endif
                    @include('partials.dialog-confirm-delete')
                </div>
            </div>
        </div>
    </section>
@endsection
