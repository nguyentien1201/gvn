@extends('layouts.app')
@section('title', 'Contact')
@push('styles')
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">

    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('css/mission.css') }}">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <style>
         .card-icon {
      font-size: 1.2rem;
      margin-right: 0.5rem;
    }
    .form-select,
    .form-control {
      border-radius: 0.5rem;
    }
    iframe {
      width: 100%;
      height: 350px;
      border: none;
      border-radius: 0.5rem;
    }
     #map {
      width: 100%;
      height: 350px;
      border-radius: 0.5rem;
    }
    </style>
@endpush


@section('content')
    <div class="mision-page inter-font-family">
        @include('front.common.header')
        <div id="heroCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item container-heading active">
                    <h3 class="heading-page">{{ __('front_end.contact_us') }}</h3>
                </div>
            </div>
        </div>
        <div class="container py-5">
    <div class="row g-4">
      <!-- Left Column: Contact Info -->
      <div class="col-md-5">
        <div class="card shadow-sm p-4 h-100 rounded">
            <p>{{__('base.note_contact')}}</p>
            <p><i class="bi bi-geo-alt-fill text-success me-2"></i><strong>{{__('base.Location')}}</strong><br />{{__('base.address_company')}}</p>
            <p> <i class="bi bi-telephone-fill text-success me-2"></i><strong>{{__('base.phone')}}</strong><br />(+84)354848375</p>
            <p><i class="bi bi-envelope-fill text-success me-2"></i><strong>Email</strong><br />admin@gvn-fintrade.com</p>
            <div class="d-flex gap-3 mt-3">
                <a href="#"><i class="bi bi-facebook fs-4 text-primary"></i></a>
                <a href="#"><i class="bi bi-youtube fs-4 text-danger"></i></a>
            </div>
        </div>
      </div>

      <!-- Right Column: Contact Form -->
      <div class="col-md-7">
        <div class="bg-white p-4 shadow-sm rounded h-100">
          <h5>Get in Touch</h5>
            <form action="{{route('contact')}}" method="POST">
            @csrf
            <div class="row g-3">
              <div class="col-md-6">
                <label for="name" class="form-label">{{__('base.My_Name_contact')}}</label>
                <input type="text" class="form-control" name="name"  id="name" placeholder="{!!__('front_end.placeholder_name')!!}" required />
              </div>
              <div class="col-md-6">
                <label for="email" class="form-label">Email *</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="{{__('front_end.placeholder_email')}}"  required />
              </div>
              <div class="col-12">
                <label for="product" class="form-label">{__('base.Product_contract')}}</label>
                <select class="form-select" id="product" name="product" required>
                    <option selected disabled value="">{{__('front_end.select_product')}}</option>
                    <option value="1">Green Alpha</option>
                    <option value="2">Green Beta</option>
                    <option value="3">Green Stock</option>
                </select>
              </div>
              <div class="col-12">
                <label for="message" class="form-label">{{__('base.Message_contract')}}</label>
                <textarea class="form-control" id="message" rows="4" name="message" placeholder="{{__('front_end.placeholder_note')}}" required></textarea>
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-success px-4">{{__('base.Send_Message')}}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Map Section -->
    <div class="row mt-5">
      <div class=" col-12 col-sm-12 col-md-12 col-lg-12">
          <div id="map"></div>
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
@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-09NXCQGTBV"></script>
    <script>
        $(document).ready(function() {

            var map = L.map('map').setView([10.7875262, 106.7387953], 15); // Tọa độ Hà Nội, Việt Nam

            // Tải các lớp bản đồ từ OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Thêm một marker
            L.marker([10.7875262, 106.7387953]).addTo(map)
                .bindPopup('Lô CD, Chung cư Bình Khánh')
                .openPopup();
        });
      function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-09NXCQGTBV');
    </script>
@endpush
