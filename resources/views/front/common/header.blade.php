

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-header header">
    <a class="navbar-brandbrand-logo" href="{{ route('front.home.index') }}">
        <img height="80" src="{{ asset('images/Logo-GVN-FinTrade-copy.png') }}" alt="Logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
                <a class="nav-link" href="{{ route('front.home.index') }}">{{ __('home.home') }} <span
                        class="sr-only">(current)</span></a>
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
  @include('front.common.header-banner')
