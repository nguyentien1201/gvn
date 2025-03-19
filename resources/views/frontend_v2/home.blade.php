@extends('layouts.app')

@section('content')
    @include('frontend_v2.components.header')
    @include('frontend_v2.components.hero')
    @include('frontend_v2.components.service')
    @include('frontend_v2.components.most-interested')
    @include('frontend_v2.components.trade-tab')
    @include('frontend_v2.components.footer')
@endsection
