
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
                <a class="nav-link" href="{{ route('front.home.index') }}">{{ __('home.home') }} <span
                        class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('front.home.trading-system')}}">{{ __('home.trading_system') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('front.home.mission')}}">{{ __('home.mission') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('front.home.contact')}}">{{ __('home.contact') }}</a>
            </li>
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-bs-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
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



