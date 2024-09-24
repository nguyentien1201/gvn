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
                            <a href="{{ route('admin.green-beta.create') }}"
                               class="btn btn-primary">
                                {{ __('panel.add') }}
                            </a>
                        </div>
                        <div class="col-md-12 form-group">
                        <form class="d-flex justify-content-center" action="{{route('admin.green-beta.import')}}" method="post"
                              enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" accept=".xlsx, .xls, .csv" name="select_file" class="custom-file-input" id="inputGroupFile04" required>
                                    <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <button class="d-flex btn btn-primary" type="submit">
                                       <span><i class="fa fa-upload mr-1"></i>{{__('panel.import')}}</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                        </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-truncate table-striped projects">
                            <thead>
                            <tr>
                                <th width="5%" class="text-center">{{__('panel.no')}}</th>
                                <th width="15%">{{ __('signal.code') }}</th>
                                <th width="15%">{{ __('signal.signal_open') }}</th>
                                <th width="10%">{{ __('signal.price_open') }}</th>
                                <th width="10%">{{ __('signal.price_close') }}</th>
                                <th width="15%">{{ __('signal.open_time') }}</th>
                                <th width="15%">{{ __('signal.close_time') }}</th>
                                <th width="20%">{{ __('signal.profit') }}</th>
                                <th width="10%" class="text-nowrap text-center">{{ __('panel.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($signals as $idx => $signal)
                                <tr>
                                    <td width="5%" class="text-center">{{$idx + 1}}</td>
                                    <td width="15%">{{$signal->MstStock->code}}</td>
                                    <td width="15%">{{ $signal->signal_open }}</td>
                                    <td width="10%">{{$signal->price_open}}</td>
                                    <td width="10%">{{$signal->price_close}}</td>
                                    <td width="15%">{{ $signal->open_time ?? ''}}</td>
                                    <td width="15%">{{ $signal->close_time ?? ''}}</td>
                                    <td width="20%"style="background-color:@if($signal->profit >0) green @endif
                                        @if($signal->profit < 0) red @endif
                                         @if($signal->profit == 0) yellow @endif
                                    ">{{ $signal->calculateProfit()}}</td>
                                    <td width="10%" class="text-center text-nowrap">
                                        <a href="{{ route('admin.green-beta.edit', [$signal->id]) }}"
                                           class="btn btn-primary btn-circle btn-sm">
                                            <i class="fas fa-edit" aria-hidden="true"></i>
                                        </a>
                                        <a href="#confirmDelete" data-toggle="modal"
                                           onclick="removeItem(this)"
                                           data-id="{{$signal->id}}"
                                           data-action="{{ route('admin.green-beta.destroy', [$signal->id])}}"
                                           class="btn btn-danger btn-circle btn-sm remove">
                                            <i class="fas fa-trash" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">
                                        {{ __('panel.nodata') }}
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if(!empty($signals))
                        <div class="paginations mt-3">
                            {!! $signals->appends($_GET)->links() !!}
                        </div>
                    @endif
                    @include('partials.dialog-confirm-delete')
                </div>
            </div>
        </div>
    </section>
@endsection
