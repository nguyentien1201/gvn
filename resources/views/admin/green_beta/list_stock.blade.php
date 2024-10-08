@extends('layout.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách mã</h1>
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
                            <div style="display:inline-block">
                                <form class="d-flex justify-content-center" action="{{route('admin.green-beta.import-by-drive')}}" method="post"
                                    enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="input-group">
                                        <span class="input-group-append">
                                        <button type="submit" class="btn btn-primary">Sync Data</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-truncate table-striped projects">
                            <thead>
                            <tr>
                                <th width="5%" class="text-center">{{__('panel.no')}}</th>
                                <th width="15%">{{ __('signal.code') }}</th>
                                <th width="10%" class="text-nowrap text-center">{{ __('panel.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($signals as $idx => $signal)
                                <tr>
                                    <td width="5%" class="text-center">{{$idx + 1}}</td>
                                    <td width="15%">{{$signal->code}}</td>
                                    <td width="10%" class="text-center text-nowrap">
                                        <a href="{{ route('admin.green-beta.list-stock', [$signal->id]) }}"
                                           class="btn btn-primary btn-circle btn-sm">
                                            <i class="fas fa-edit" aria-hidden="true"></i>
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
