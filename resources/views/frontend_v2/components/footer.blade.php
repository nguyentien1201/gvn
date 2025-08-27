<footer class="inter-font-family">
    <div class="top-footer py-4">
        <div class="container">
            <div class="row">
                <!-- Logo & Contact -->
                <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <img src="{{ asset('images/logo.png') }}" alt="GVN Fin Trade" style="max-width: 180px;" class="mb-4">
                    <ul class="list-unstyled small text-muted">
                        <li class="mb-2 d-flex align-items-start gap-2">
                            <img width="24" height="24" class="img-fluid object-contain" src="{{asset('images/icons/2marker-pin-03.png')}}" alt="">
                            <span>An Khanh ward, Thu Duc district, Ho Chi Minh city, Viet Nam</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center gap-2">
                            <img width="24" height="24" class="img-fluid" src="{{asset('images/icons/2phone.png')}}" alt="">
                            <span>(+84)354848375</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center gap-2">
                            <img width="24" height="24" class="img-fluid" src="{{asset('images/icons/2mail-02.png')}}" alt="">
                            <span>admin@gvn-fintrade.com</span>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-lg-6 ms-auto">
                    <div class="row">
                        <!-- My Company -->
                        <div class="col-6 col-lg-6">
                            <h6 class="blocks-title mb-3">{{__('base.My_Company')}}</h6>
                            <ul class="list-unstyled">
                                <li><a href="{{route('front.home.mission')}}" class="text-decoration-none text-muted d-block mb-2">{{__('base.About_Us')}}</a></li>
                                <li><a href="{{route('front.home.trading-system')}}" class="text-decoration-none text-muted d-block mb-2">{{__('base.My_System')}}</a></li>
                                <li><a href="{{route('front.home.contact')}}" class="text-decoration-none text-muted d-block">{{__('base.Our_Service')}}</a></li>
                            </ul>
                        </div>
                        <!-- Useful references -->
                        <div class="col-6 col-lg-6">
                            <h6 class="blocks-title mb-3">{{__('base.Useful_references')}}</h6>
                            <ul class="list-unstyled">
                                <li><a href="{{route('front.home.contact')}}" class="text-decoration-none text-muted d-block mb-2">{{__('base.Our_Performance')}}</a></li>
                                <li><a href="{{route('front.home.mission')}}" class="text-decoration-none text-muted d-block mb-2">{{__('base.How_It_Work')}}</a></li>
                                <li><a href="#" class="text-decoration-none text-muted d-block">{{__('base.Research_Investment')}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom py-4">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center small">
                <p class="mb-2 mb-md-0 text-muted">Copyright 2023 © GVN-Fintrade</p>
                <div class="social-icons d-flex gap-3">
                    <a href="#" class="text-dark">
                        <img width="24" height="24" class="img-fluid" src="{{asset('images/icons/x.png')}}" alt="">
                    </a>
                    <a href="#" class="text-dark">
                        <img width="24" height="24" class="img-fluid" src="{{asset('images/icons/facebook.png')}}" alt="">
                    </a>
                    <a href="#" class="text-dark">
                        <img width="24" height="24" class="img-fluid" src="{{asset('images/icons/youtube.png')}}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
