@extends('layouts.app')

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
        @include('frontend_v2.components.footer')
    </div>
@endsection