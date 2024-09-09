@extends('layout.master-no-header')
@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html">
                <img src="{{asset('images/logo.png')}}" width="100%">
            </a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">{{__('panel.login_title')}}</p>

                <form action="{{route('login')}}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input name="email" type="text" class="form-control @error('email') is-invalid @enderror"
                               placeholder="{{__('panel.login_username')}}" value="{{ old('email') }}" required
                               autocomplete="email" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input name="password" type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="{{__('panel.password')}}" required autocomplete="current-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">{{__('panel.login')}}</button>
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@endsection
