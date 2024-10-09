<style>
    .promo-box {

        color: white;
        padding: 30px;
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

    .promo-box ul {
        list-style-type: none;
        padding-left: 0;
    }

    .promo-box ul li {
        margin-bottom: 10px;
    }
    .d-flex a{
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
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var loginModal = new bootstrap.Modal(document.getElementById('loginModal'), {
            backdrop: 'static', // Optional: Set backdrop to 'static' to prevent closing the modal by clicking outside
            keyboard: false     // Optional: Disable closing the modal with the keyboard
        });
        // Example: Show the modal when a button is clicked
        document.getElementById('showLoginModalButton').addEventListener('click', function () {
            loginModal.show();
        });
    });
</script>
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
                            <h3>Đăng nhập MIỄN PHÍ và nhận ngay:</h3>
                            <ul>
                                <li>Xu hướng giá của các thị trường tài chính lớn</li>
                                <li>Dùng thử 3 sản phẩm của GVN trong 1 tháng</li>
                                <li>Cá nhân hóa các cổ phiếu quan tâm trong GreenStock</li>
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
                                    <span class="mt-3 d-block" >Bạn chưa có tài khoản <a style="font-weight:bold" class="color-home" href="{{ route('register') }}"><i>Đăng ký</i></a></span>

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
