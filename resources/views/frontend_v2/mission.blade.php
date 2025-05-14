@extends('layouts.app')
@section('title', 'Mission')
@push('styles')
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">

    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('css/mission.css') }}">
@endpush
@push('scripts')

@endpush

@section('content')
    <div class="mision-page inter-font-family">
        @include('front.common.header')
        <div id="heroCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item container-heading active">
                    <h3 class="heading-page">{{ __('mission.our_mission') }}</h3>
                </div>
            </div>
        </div>
        <div class="container  px-5">
            <div class="content-our-mission mb-4">
                <h3 class="heading-page my-5">{{ __('mission.descipline_responsibility_efficiency') }}</h3>
                <img class="m-auto img-fluid" src="{{ asset('images/mission/device-macbook-air.png') }}"
                     alt="{{ asset('images/mission/device-macbook-air.png') }}">
                <p class="text-center des-title">
                    {{ __('mission.mission_content') }}
                </p>
            </div>
            <hr>
            <h3 class="text-center heading-page my-4">{{__('mission.timeline')}}</h3>
            <div class="timeline-container">
                <img class="w-100 vector" src="{{asset('images/mission/vector.svg')}}" alt="">

                <!--Time line -->
                <div class="timeline flex flex-row">
                    @foreach($timelines as $key => $timeline)
                        @if(!($key % 2) || $key == 0)
                            <div class="d-flex flex-column align-items-center timeline-item">
                                <div class="position-relative">
                                    <img src="{{asset('images/mission/timeline/'.$timeline['image'])}}"
                                         alt="{{$timeline['timeline_name']}}">
                                    <svg width="110" height="89" viewBox="0 0 5 89" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M2.49219 2.20898V86.709"
                                                stroke="{{$timeline['color']}}"
                                                stroke-width="4"
                                                stroke-linecap="round"
                                                stroke-dasharray="8 8"
                                        />
                                    </svg>
                                </div>
                                <h5 style="color: {{$timeline['color']}};"
                                    class="time-range mt-3 mb-1">{{$timeline['timeline_time']}}</h5>
                                <h6 style="color: {{$timeline['color']}};"
                                    class="time-name text-center">{{$timeline['timeline_name']}}</h6>
                                <p class="text-center time-des">
                                    {{$timeline['timeline_des']}}
                                </p>
                            </div>
                        @else
                            <div class="d-flex flex-column-reverse align-items-center timeline-item">

                                <div class="position-relative">
                                    <svg width="110" height="89" viewBox="0 0 5 89" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M2.49219 2.20898V86.709"
                                                stroke="{{$timeline['color']}}"
                                                stroke-width="4"
                                                stroke-linecap="round"
                                                stroke-dasharray="8 8"
                                        />
                                    </svg>
                                    <img src="{{asset('images/mission/timeline/'.$timeline['image'])}}"
                                         alt="{{$timeline['timeline_name']}}">

                                </div>
                                <p class="text-center time-des mb-3 mt-1">
                                    {{$timeline['timeline_des']}}
                                </p>
                                <h5 style="color: {{$timeline['color']}};"
                                    class="time-range mt-3 mb-1">{{$timeline['timeline_time']}}</h5>
                                <h6 style="color: {{$timeline['color']}};"
                                    class="time-name text-center">{{$timeline['timeline_name']}}</h6>

                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="timeline-mobile d-md-none">
                    <img class="img-fluid" src="{{asset('images/mission/vector-mobile.svg')}}" alt="">
                    @foreach($timelines as $key => $timeline)
                        <div class="d-flex flex-row timeline-item">
                            <div class="timeline-img">
                                <img class="img-fluid" src="{{asset('images/mission/timeline/'.$timeline['image'])}}"
                                     alt="{{$timeline['timeline_name']}}">
                            </div>
                            <div class="timeline-info d-flex flex-column">
                                <h5 style="color: {{$timeline['color']}};"
                                    class="time-range">{{$timeline['timeline_time']}}</h5>
                                <h6 style="color: {{$timeline['color']}};"
                                    class="time-name">{{$timeline['timeline_name']}}</h6>
                                <p class="time-des">
                                    {{$timeline['timeline_des']}}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <hr>
            <!--Our Team -->
            <div id="our-team">
                <h3 class="text-center heading-page">{{__('mission.our_team')}}</h3>
                <p class="text-center des-title">{{__('mission.text_title')}}</p>
                <div class="container-our-team my-3">
                    <div class="row gy-4">
                        @for($i = 1; $i <= 8; $i++)
                            <div class="col-6 col-md-4 col-lg-3">
                                <div class="member flex flex-column gap-2">
                                    <img class="img-fluid" src="{{asset('images/mission/member.png')}}"
                                         alt="{{asset('images/mission/member.png')}}">
                                    <h3 class="member-name">Darrell Steward</h3>
                                    <h4 class="member-position">Chief Technology Officer</h4>
                                    <p class="member-introduce">20 years in finance, founded GVN to empower investors.
                                        Ex-Senior Executive at a hedge fund.</p>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
        @auth
            <div style="position: fixed; bottom: 20px; right: 20px; text-align: center; z-index: 1000;">
                <div class="sc-9qme4p-0 hELAUe">
                    <button class="decription_telegram"><span
                                class="sc-1ee9gtf-2 bxZLwE">{{__('front_end.chat_with_me')}}</span></button>
                </div>
                <a href="https://t.me/{{config('config.telegram_user')}}" target="_blank"
                   style="text-decoration: none;">
                    <button style="
        float: right;
      background-color: #33a853;
      color: white;
      border: none;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      cursor: pointer;
      transition: background-color 0.3s ease;
    "
                            onmouseover="this.style.backgroundColor='#33a853';"
                            onmouseout="this.style.backgroundColor='#198754';">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/8/82/Telegram_logo.svg" alt="Telegram"
                             style="width: 30px; height: 30px;">
                    </button>
                </a>
            </div>
        @endauth
        @include('frontend_v2.components.footer')

    </div>
@endsection
