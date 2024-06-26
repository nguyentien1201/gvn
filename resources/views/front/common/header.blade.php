<div id="header">
    <div class="container">
{{--        <div class="row">--}}
            <nav class="navbar navbar-expand-lg navbar-light bg-white">
                <a class="brand-logo" href="{{route('front.home.index')}}">
                    <img height="80" src="{{asset('images/Logo-GVN-FinTrade-copy.png')}}" alt="{{asset('images/Logo-GVN-FinTrade-copy.png')}}">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{route('front.home.index')}}">{{ __('home.home')}} <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#trading_system">{{ __('home.trading_system') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#mission">{{ __('home.mission') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">{{ __('home.contact') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#account">{{ __('home.account') }}</a>
                        </li>
                    </ul>
                </div>
            </nav>
{{--        </div>--}}
    </div>
    @include('front.common.header-banner')
</div>
