@extends('layouts.app')
@section('title', 'Home Page')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home_v2.css') }}">
@endpush

@section('content')
    <div class="home-page inter-font-family">
        @include('front.common.header')
        @include('frontend_v2.components.hero')
        @include('frontend_v2.components.service')
        @include('frontend_v2.components.most-interested')
        @include('frontend_v2.components.trade-tab')
        @include('frontend_v2.components.top-signals')
        @include('frontend_v2.components.scan-qr')
        @include('frontend_v2.components.stock-rating-tabs')
        @include('frontend_v2.components.trading-green-stock-NAS100')
        @include('frontend_v2.components.footer')
    </div>
@endsection
@push('scripts')
   <script>
      function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-09NXCQGTBV');
   </script>
@endpush