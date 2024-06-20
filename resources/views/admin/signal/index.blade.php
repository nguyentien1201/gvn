@extends('layout.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('panel.signal') }}</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- result -->
    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header">{{__('panel.list')}}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <a href="{{ route('admin.signal.create') }}"
                               class="btn btn-primary">
                                {{ __('panel.add') }}
                            </a>
                        </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-truncate table-striped projects">
                            <thead>
                            <tr>
                                <th width="5%" class="text-center">{{__('panel.no')}}</th>
                                <th width="15%">{{ __('signal.code') }}</th>
                                <th width="15%">{{ __('signal.trend') }}</th>
                                <th width="10%">{{ __('signal.signal') }}</th>
                                <th width="15%">{{ __('signal.price_current') }}</th>
                                <th width="15%">{{ __('signal.price_action') }}</th>
                                <th width="20%">{{ __('signal.profit') }}</th>
                                <th width="10%" class="text-nowrap text-center">{{ __('panel.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($signals as $idx => $signal)
                                <tr>
                                    <td width="5%" class="text-center">{{$idx + 1}}</td>
                                    <td width="15%">{{$signal->mstStock->code}}</td>
                                    <td width="15%">{{$signal->trend ==1 ? 'Uptrend':'Downtrend'}}</td>
                                    <td width="10%">{{$signal->signal ==1 ? 'Buy': 'Sale'}}</td>
                                    <td width="15%">{{$signal->price_current}}</td>
                                    <td width="15%">{{$signal->price_action}}</td>
                                    <td width="20%">{{abs($signal->price_action - $signal->price_current) }}</td>
                                    <td width="10%" class="text-center text-nowrap">
                                        <a href="{{ route('admin.signal.edit', [$signal->id]) }}"
                                           class="btn btn-primary btn-circle btn-sm">
                                            <i class="fas fa-edit" aria-hidden="true"></i>
                                        </a>
                                        <a href="#confirmDelete" data-toggle="modal"
                                           onclick="removeItem(this)"
                                           data-id="{{$signal->id}}"
                                           data-action="{{ route('admin.customers.destroy', [$signal->id])}}"
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
                    @include('partials.dialog-confirm-delete')
                </div>
            </div>
        </div>
    </section>
@endsection
