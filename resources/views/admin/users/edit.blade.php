@extends('layout.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ isset($isProfile) ? __('user.profile') : __('panel.user') }}</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- result -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">{{__('panel.update')}}</div>
                        <div class="card-body">
                            <div class="col-md-10">
                                <form method="POST"
                                      action="{{ isset($isProfile) ? route('admin.profile.update', [$user->id]) : route('admin.users.update', [$user->id]) }}"
                                      enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="id" value="{{$user->id}}"/>
                                    <div class="form-group row">
                                        <label for="full_name"
                                               class="col-sm-3 col-form-label">{{(__('user.name'))}}
                                            <span class="red"> *</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" autocomplete="off"
                                                   class="form-control @if($errors->has('name')) is-invalid @endif"
                                                   value="{{old('name', $user->name)}}">
                                            @if($errors->has('name'))
                                                <p class="invalid-feedback">
                                                    {{ $errors->first('name') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="full_name"
                                               class="col-sm-3 col-form-label">{{(__('user.email'))}}
                                            <span class="red"> *</span></label>
                                        <div class="col-sm-9">
                                            <input type="email" name="email" autocomplete="off"
                                                   class="form-control @if($errors->has('email')) is-invalid @endif"
                                                   value="{{old('email', $user->email)}}">
                                            @if($errors->has('email'))
                                                <p class="invalid-feedback">
                                                    {{ $errors->first('email') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="full_name"
                                               class="col-sm-3 col-form-label">{{(__('user.password'))}}
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="password" name="password" autocomplete="off"
                                                   class="form-control @if($errors->has('password')) is-invalid @endif">
                                            @if($errors->has('password'))
                                                <p class="invalid-feedback">
                                                    {{ $errors->first('password') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="full_name"
                                               class="col-sm-3 col-form-label">{{(__('user.confirm_password'))}}
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="password" name="confirm_password" autocomplete="off"
                                                   class="form-control @if($errors->has('confirm_password')) is-invalid @endif">
                                            @if($errors->has('confirm_password'))
                                                <p class="invalid-feedback">
                                                    {{ $errors->first('confirm_password') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    @if (isset($isProfile))
                                        <input type="hidden" name="role_id" value="{{$roles['admin']}}"/>
                                    @else
                                        <div class="form-group row">
                                            <label for="role"
                                                   class="col-sm-3 col-form-label">{{(__('user.role'))}}
                                                <span class="red"> *</span>
                                            </label>
                                            <div class="col-sm-9">
                                                <select name="role_id"
                                                        class="form-control custom-select @if($errors->has('role_id')) is-invalid @endif">
                                                    <option value="">{{__('panel.please_choose')}}</option>
                                                    @foreach($roles as $name => $id)
                                                        <option value="{{$id}}"
                                                                @if(old('role_id', $user->role_id) == $id) selected @endif>{{ucfirst($name)}}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('role_id'))
                                                    <p class="invalid-feedback">
                                                        {{ $errors->first('role_id') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-sm-9">
                                            @if(Auth::user()->role_id == $roles['admin'])
                                                <a href="{{route('admin.users.index')}}" class="btn btn-secondary">
                                                    {{__('panel.back')}}
                                                </a>
                                            @endif
                                            <button type="submit"
                                                    class="btn btn-primary">{{__('panel.save')}}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
