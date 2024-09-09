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
                <div class="card-header">{{__('panel.edit')}}</div>
                <div class="card-body">
                    <form class="add-edit-frm" action="{{route('admin.tokens.update', [$token->id])}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$token->id}}"/>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>{{(__('token.website'))}} <span class="red"> *</span></label>
                                <input type="text" name="website" autocomplete="off"
                                       readonly
                                       class="form-control @if($errors->has('website')) is-invalid @endif"
                                       value="{{old('website', $token->website)}}">
                                @if($errors->has('website'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('website') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{(__('token.domain'))}} <span class="red"> *</span></label>
                                <input type="text" name="domain" autocomplete="off"
                                       class="form-control @if($errors->has('domain')) is-invalid @endif"
                                       value="{{old('domain',$token->domain)}}">
                                @if($errors->has('domain'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('domain') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{(__('token.consumer_key'))}} <span class="red"> *</span></label>
                                <input type="text" name="consumer_key" autocomplete="off"
                                       class="form-control @if($errors->has('consumer_key')) is-invalid @endif"
                                       value="{{old('consumer_key', $token->consumer_key)}}">
                                @if($errors->has('consumer_key'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('consumer_key') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{(__('token.consumer_secret'))}} <span class="red"> *</span></label>
                                <input type="text" name="consumer_secret" autocomplete="off"
                                       class="form-control @if($errors->has('consumer_secret')) is-invalid @endif"
                                       value="{{old('consumer_secret', $token->consumer_secret)}}">
                                @if($errors->has('consumer_secret'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('consumer_secret') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{(__('token.access_token'))}} <span class="red"> *</span></label>
                                <input type="text" name="access_token" autocomplete="off"
                                       class="form-control @if($errors->has('access_token')) is-invalid @endif"
                                       value="{{old('access_token', $token->access_token)}}">
                                @if($errors->has('access_token'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('access_token') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{(__('token.access_token_secret'))}} <span class="red"> *</span></label>
                                <input type="text" name="access_token_secret" autocomplete="off"
                                       class="form-control @if($errors->has('access_token_secret')) is-invalid @endif"
                                       value="{{old('access_token_secret', $token->access_token_secret)}}">
                                @if($errors->has('access_token_secret'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('access_token_secret') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <a href="{{route('admin.tokens.index')}}" class="btn btn-secondary">
                            {{__('panel.back')}}
                        </a>
                        <button type="submit" class="btn btn-primary">{{__('panel.save')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
