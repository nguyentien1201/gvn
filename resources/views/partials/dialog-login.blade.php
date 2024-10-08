<style>
    .promo-box {

        color: white;
        padding: 2rem 1rem 1rem 1rem;
        border-radius: 5px;
        text-align: left;
    }
    #promo-box::after {
    content: '';
    position: absolute;
    top: 50%;
    right: -20px; /* Đặt mũi tên ở bên phải */
    transform: translateY(-50%);
    border-width: 10px;
    border-style: solid;
    border-color: transparent transparent transparent #4caf50; /* Mũi tên hướng trái */
}
    .promo-box h3 {
        font-weight: bold;
    }
.hand-right {
    display: inline-block; /* Đảm bảo icon được định dạng chính xác */
            transform: rotate(90deg); /* Xoay icon 90 độ sang phải */
            margin-right: 0.4rem; /* Thêm khoảng cách giữa văn bản và icon */
}
    .promo-box ul {
        list-style-type: none;
        padding-left: 0;
    }

    .promo-box ul li {
        margin-bottom: 10px;
    }
    #promo-box{
        align-items: inherit !important;
    }
    .login-logo a,.login-card-body a{
        border: none;
        padding: inherit !important;
    }
    .input-group-text{
        height: 100%;
        border-radius: inherit;
    }
    .login-box-msg{
        text-align: center;
    }
    .custom-color-hand{
        color:#15aa3d;
    }
    .icon-background {
            background-color: white; /* Màu nền cho icon */
            padding: 5px; /* Khoảng cách bên trong */
            border-radius: 50%; /* Đường viền tròn */
            display: inline-flex; /* Để căn giữa icon */
            align-items: center; /* Canh giữa theo chiều dọc */
            justify-content: center; /* Canh giữa theo chiều ngang */
            margin-left: 5px; /* Khoảng cách giữa văn bản và icon */
        }
</style>


<div class="modal fade" id="loginModal" role="dialog" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 d-flex align-items-center justify-content-center" id="promo-box" style="background:#0a381d">
                        <div class="promo-box">
                            <h3> {!! __('front_end.login_and_get') !!}</h3>
                            <ul class="mt-5">
                                <li><i class="bi bi-hand-index-thumb-fill hand-right custom-color-hand"></i></span></i>{!! __('front_end.follow_trendprice')!!}</li>
                                <li><i class="bi bi-hand-index-thumb-fill hand-right custom-color-hand"></i>{!! __('front_end.get_trial')!!}</li>
                                <li><i class="bi bi-hand-index-thumb-fill hand-right custom-color-hand"></i>{!! __('front_end.personalize_stock')!!}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex align-items-center justify-content-center">
                        <div class="login-box">
                            <div class="login-logo">
                                <a href="/">
                                    <img src="{{asset('images/Logo-GVN-FinTrade-nobg.png')}}" width="100%">
                                </a>
                            </div>
                            <!-- /.login-logo -->
                            <div class="card" style="border:none">
                                <div class="card-body login-card-body">
                                    <h3 class="login-box-msg">{{__('panel.login_title')}}</h3>
                                    <form action="{{route('login')}}" method="post">
                                        @csrf
                                        <div class="input-group mb-3">
                                            <input name="email" type="text"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="{{__('panel.login_username')}}" value="{{ old('email') }}"
                                                required autocomplete="email" autofocus>
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
                                                placeholder="{{__('panel.password')}}" required
                                                autocomplete="current-password">
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
                                        <a href="{{ route('password.request') }}" style="font-weight:bold" class="color-home" id="register">{{__('auth.forgot_password')}}</a>
                                    </div>


                                </div>
                                <!-- /.login-card-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
