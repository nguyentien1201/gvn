<style>
  @media (max-width: 576px) {
    .login-box, .register-box {
        width: 360px !important;

    }
}
.color-home{
    color:#008000 !important;
}
</style>
@extends('layout.master-no-header')
@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="/">
                <img src="{{asset('images/Logo-GVN-FinTrade-nobg.png')}}" width="100%">
            </a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <h3 class="login-box-msg">{{__('panel.login_title')}}</h3>
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
                <div class="w-100 text-center mt-3">
                    <span class="mt-3" ><a style="font-weight:bold" class="color-home" href="{{ route('register') }}"><i>{{__('auth.register')}}</i></a></span>
                    <span>|</span>
                    <a href="{{ route('password.request') }}" style="font-weight:bold" class="color-home" >{{__('auth.forgot_password')}}</a>
                </div>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@endsection
