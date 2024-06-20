@extends('layout.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('panel.token') }}</h1>
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
                            <a href="{{ route('admin.tokens.create') }}"
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
                                <th width="15%">{{ __('token.website') }}</th>
                                <th width="20%">{{ __('token.domain') }}</th>
                                <th width="15%">{{ __('token.consumer_key') }}</th>
                                <th width="15%">{{ __('token.consumer_secret') }}</th>
                                <th width="15%">{{ __('token.access_token') }}</th>
                                <th width="15%">{{ __('token.access_token_secret') }}</th>
                                <th width="10%" class="text-nowrap text-center">{{ __('panel.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($tokens as $idx => $token)
                                <tr>
                                    <td class="text-center">{{$idx + 1}}</td>
                                    <td>{{$token->website}}</td>
                                    <td>{{$token->domain}}</td>
                                    <td>{{$token->consumer_key}}</td>
                                    <td>{{$token->consumer_secret}}</td>
                                    <td>{{$token->access_token}}</td>
                                    <td>{{$token->access_token_secret}}</td>
                                    <td class="text-center text-nowrap">
                                        <a href="{{ route('admin.tokens.edit', [$token->id]) }}"
                                           class="btn btn-primary btn-circle btn-sm">
                                            <i class="fas fa-edit" aria-hidden="true"></i>
                                        </a>
                                        <a href="#confirmDelete" data-toggle="modal"
                                           onclick="removeItem(this)"
                                           data-id="{{$token->id}}"
                                           data-action="{{ route('admin.tokens.destroy', [$token->id])}}"
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
