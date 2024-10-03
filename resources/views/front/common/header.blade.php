<style>.dropdown-item {
    display: flex;
    align-items: center;
}

.dropdown-item .flag-icon {
    margin-right: 8px;
}</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.6/css/flag-icon.min.css">
<div class="container">
<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-header header" style="box-shadow: none;">
    <a class="navbar-brandbrand-logo" href="{{ route('front.home.index') }}">
        <img height="80" src="{{ asset('images/Logo-GVN-FinTrade-copy.png') }}" alt="Logo">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-bs-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('front.home.index') }}">{{ __('front_end.mainpage') }} <span
                        class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('front.home.trading-system')}}">{{ __('front_end.systems') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('front.home.mission')}}">{{ __('front_end.Mission') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('front.home.contact')}}">{{ __('front_end.Contact') }}</a>
            </li>
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('front_end.login') }}</a>
                </li>

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('front_end.register') }}</a>
                    </li>
                @endif
                <li class="nav-item">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @php
                    $locale = session('locale', config('app.locale'));
                    $flagClass = $locale == 'en' ? 'flag-icon-gb' : ($locale == 'vi' ? 'flag-icon-vn' : 'flag-icon-gb');
                    $languageName = $locale == 'en' ? 'English' : ($locale == 'vi' ? 'Vietnam' : 'English');
                @endphp
                <span class="flag-icon {{ $flagClass }}"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" style="right:0; left:inherit" aria-labelledby="navbarDropdown">
                <form action="{{ route('changeLanguage') }}" method="POST" id="language-form">
                    @csrf
                    <button type="submit" name="language" value="en" class="dropdown-item">
                        <span class="flag-icon flag-icon-gb"></span> English
                    </button>
                    <button type="submit" name="language" value="vi" class="dropdown-item">
                        <span class="flag-icon flag-icon-vn"></span> Vietnam
                    </button>
                    <!-- Add more languages as needed -->
                </form>
            </div>
                </li>


            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-bs-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('account') }}">
                            {{ __('front.my_page') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('front_end.logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest

      </ul>
    </div>
  </nav>
</div>



