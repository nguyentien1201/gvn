<header class="sticky-top bg-white shadow-sm">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-header header shadow-none">
            <a class="navbar-brand brand-logo" href="{{ route('front.home.index') }}">
                <img src="{{ asset('images/Logo-GVN-FinTrade-copy.png') }}" alt="Logo"
                     class="img-fluid d-inline-block align-text-top" style="max-height: 46px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                {{-- Menu center --}}
                <ul class="navbar-nav gap-4 mx-auto align-items-lg-center">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('front.home.index') }}">
                            {{ __('front_end.mainpage') }} <span class="visually-hidden">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ route('front.home.trading-system') }}">{{ __('front_end.systems') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.home.mission') }}">{{ __('front_end.Mission') }}</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            {{ __('front_end.product') }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('front.home.green-beta') }}">Green Beta</a>
                            <a class="dropdown-item" href="{{ route('front.home.green-alpha') }}">Green Alpha</a>
                            <a class="dropdown-item" href="{{ route('front.home.green-stock') }}">Green Stock-NAS100</a>
                            <a class="dropdown-item" href="{{ route('front.home.vnindex') }}">Green Stock-Vnindex</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.home.contact') }}">{{ __('front_end.Contact') }}</a>
                    </li>
                </ul>

                {{-- Language + Auth --}}
                <div class="d-flex flex-column flex-lg-row align-items-lg-center gap-3 w-100 w-lg-auto mt-3 mt-lg-0">

                    {{-- Language Switcher --}}
                    <div class="dropdown ml-2">
                        @php
                            $locale = session('locale', config('app.locale'));
                            $flags = ['en' => 'flag-icon-gb', 'vi' => 'flag-icon-vn'];
                            $flagClass = $flags[$locale] ?? 'flag-icon-gb';
                        @endphp
                        <div class="dropdown-toggle" id="langDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="flag-icon {{ $flagClass }}"></span>
                        </div>
                        <div class="dropdown-menu dropdown-menu" aria-labelledby="langDropdown">
                            <form action="{{ route('changeLanguage') }}" method="POST" id="language-form">
                                @csrf
                                <button type="submit" name="language" value="en" class="dropdown-item">
                                    <span class="flag-icon flag-icon-gb"></span> English
                                </button>
                                <button type="submit" name="language" value="vi" class="dropdown-item">
                                    <span class="flag-icon flag-icon-vn"></span> Vietnam
                                </button>
                                <button type="submit" name="language" value="zh" class="dropdown-item">
                                    <span class="flag-icon flag-icon-cn"></span> China
                                </button>
                                <button type="submit" name="language" value="es" class="dropdown-item">
                                    <span class="flag-icon flag-icon-es"></span> Spain
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Auth Buttons --}}
                    @guest
                        <a class="btn btn-outline-primary btn-outline-custom w-100 w-lg-auto" href="{{ route('login') }}">
                            {{ __('front_end.login') }}
                        </a>

                        @if (Route::has('register'))
                            <a class="btn btn-primary btn-custom w-100 w-lg-auto" href="{{ route('register') }}">
                                {{ __('front_end.register') }}
                            </a>
                        @endif
                    @else
                        <div class="dropdown w-100 w-lg-auto">
                            <button class="btn d-flex align-items-center gap-2 dropdown-toggle w-100 w-lg-auto"
                                    type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ Auth::user()->avatar_url ?? asset('images/default-avatar.png') }}"
                                     alt="Avatar"
                                     class="rounded-circle"
                                     style="width: 32px; height: 32px; object-fit: cover;">
                                <span class="text-truncate" style="max-width: 120px;">{{ Auth::user()->name }}</span>
                            </button>

                            <ul class="dropdown-menu dropdown-menu dropdown-menu-lg-end" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('account') }}">
                                        <i class="bi bi-person-circle"></i> {{ __('front_end.my_page') }}
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right"></i> {{ __('front_end.logout') }}
                                    </a>
                                </li>
                            </ul>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    @endguest
                </div>
            </div>
        </nav>
    </div>
</header>
