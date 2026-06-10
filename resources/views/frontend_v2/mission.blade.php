@extends('layouts.app')
@section('title', 'Mission')
@push('styles')
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">

    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('css/mission.css') }}">

    <style>
        .fintrade-timeline{
    position:relative;
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin:120px 0;
}

.fintrade-timeline::before{
    content:'';
    position:absolute;
    left:0;
    right:0;
    top:50%;
    height:4px;
    border-radius:100px;
    background:linear-gradient(
        90deg,
        #0f5132,
        #11ae39,
        #28c76f
    );
}

.timeline-node{
    position:relative;
    width:16%;
    text-align:center;
    z-index:2;
}

.timeline-dot{
    width:20px;
    height:20px;
    border-radius:50%;
    background:#11ae39;
    border:4px solid #fff;
    box-shadow:0 0 20px rgba(17,174,57,.4);
    margin:auto;
}

.timeline-card{
    position:absolute;
    width:260px;
    left:50%;
    transform:translateX(-50%);
    background:#fff;
    border-radius:24px;
    padding:24px;
    box-shadow:
        0 10px 40px rgba(0,0,0,.08);
    transition:.3s;
}

.timeline-card:hover{
    transform:
        translateX(-50%)
        translateY(-8px);
}

.timeline-node.top .timeline-card{
    bottom:50px;
}

.timeline-node.bottom .timeline-card{
    top:50px;
}

.timeline-icon{
    width:60px;
    height:60px;
    margin:auto auto 20px;
    border-radius:50%;
    background:#11ae39;
    display:flex;
    justify-content:center;
    align-items:center;
}

.timeline-icon img{
    width:36px;
    height:36px;
    object-fit:contain;
}

.timeline-year{
    font-size:32px;
    font-weight:800;
    color:#11ae39;
    margin:10px 0;
}

.timeline-card h4{
    font-size:22px;
    font-weight:700;
    color:#0f172a;
}

.timeline-card p{
    color:#64748b;
    line-height:1.7;
}
    </style>
@endpush
@push('scripts')
   <script>
      function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-09NXCQGTBV');
   </script>
@endpush

@section('content')
    <div class="mision-page inter-font-family">
        @include('front.common.header')
        <div id="heroCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item container-heading active">
                    <h3 class="heading-page">{{ __('base.our_mission') }}</h3>
                </div>
            </div>
        </div>
        <div class="container  px-5">
            <div id="our-team">
            <h3 class="text-center heading-page">{{__('base.Our_Team')}}</h3>

            <div class="container-our-team container container-xxl my-3">
                <div class="row gy-4">
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="member flex flex-column gap-2">
                                <img class="img-fluid" src="{{asset('images/mission/danh.jpg')}}"
                                     alt="{{asset('images/mission/danh.jpg')}}">
                                <h3 class="member-name">{{__('base.intro_contact.danh_contact.name')}}</h3>
                                <h4 class="member-position">{{__('base.intro_contact.danh_contact.position')}}</h4>
                                <p class="member-introduce">{{__('base.intro_contact.danh_contact.bio')}}</p>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="member flex flex-column gap-2">
                                <img class="img-fluid" src="{{asset('images/mission/thong.jpg')}}"
                                     alt="{{asset('images/mission/thong.jpg')}}">
                                 <h3 class="member-name">{{__('base.intro_contact.thong_contact.name')}}</h3>
                                <h4 class="member-position">{{__('base.intro_contact.thong_contact.position')}}</h4>
                                <p class="member-introduce">{{__('base.intro_contact.thong_contact.bio')}}</p>
                            </div>
                        </div>
                        <!-- <div class="col-6 col-md-4 col-lg-3">
                            <div class="member flex flex-column gap-2">
                                <img class="img-fluid" src="{{asset('images/mission/member.png')}}"
                                     alt="{{asset('images/mission/member.png')}}">
                                <h3 class="member-name">{{__('base.intro_contact.d')}}</h3>
                                <h4 class="member-position">Chief Technology Officer</h4>
                                <p class="member-introduce">20 years in finance, founded GVN to empower investors.
                                    Ex-Senior Executive at a hedge fund.</p>
                            </div>
                        </div> -->
                </div>
            </div>
        </div>
            <div class="content-our-mission mb-4">
                <h3 class="heading-page my-5">{{ __('base.maxim_gvn') }}</h3>

                <p class="text-center des-title">
                    {{ __('base.mission_gvn') }}
                </p>

            </div>
            <hr>
            <h3 class="text-center heading-page my-4">{{__('mission.timeline')}}</h3>
            <div class="timeline-container">
            <div class="fintrade-timeline">

                @foreach($timelines as $key => $timeline)

                    <div class="timeline-node {{ $key % 2 == 0 ? 'bottom' : 'top' }}">

                        <div class="timeline-dot"></div>

                        <div class="timeline-card">

                            @if(!empty($timeline['image']))
                                <div class="timeline-icon">
                                    <img
                                        src="{{ asset('storage/'.$timeline['image']) }}"
                                        alt="{{ $timeline['timeline_name'] }}">
                                </div>
                            @endif

                            <h4>
                                {{ $timeline['timeline_name'] }}
                            </h4>

                            <div class="timeline-year">
                                {{ $timeline['timeline_time'] }}
                            </div>

                            <p>
                                {{ $timeline['timeline_des'] }}
                            </p>

                        </div>

                    </div>

                @endforeach

            </div>
            </div>
        </div>
        <hr>
        <!--Our Team -->

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
