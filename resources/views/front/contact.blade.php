<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <!-- Bootstrap CSS -->


    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{asset('plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="
https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js
"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0-rc/dist/chartjs-plugin-datalabels.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script
        src="https://cdn.datatables.net/v/bs5/dt-2.0.8/date-1.5.2/fc-5.0.1/fh-4.0.1/r-3.0.2/datatables.min.js"></script>
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" rel="stylesheet">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <!-- Thêm Google Maps API vào -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-09NXCQGTBV"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-09NXCQGTBV');
</script>
    <style>

        .ml-auto {
            margin-left: auto !important;
        }
        #navbarNav .nav-link {
            /* font-size: 1.1rem; */
            color: #000;
            font-weight: 600;
        }

        .hero {
            background: url('https://via.placeholder.com/1500x800') no-repeat center center;
            background-size: cover;
            color: white;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .cta {
            background-color: #007bff;
            color: white;
            padding: 60px 0;
        }

        .footer {
            padding: 30px 0;
        }

        .carousel-item {
            min-height: 300px;
            background: no-repeat center center scroll;
            background-size: cover;
        }

        .carousel-caption {
            background: rgba(0, 0, 0, 0.6);
            padding: 20px;
            border-radius: 10px;
        }

        .features {
            background: #f9f9f9;
        }

        .features .card {
            border: none;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .features .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .features .card-body {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .cta {
            background: linear-gradient(45deg, #007bff, #0056b3);
            color: white;
            padding: 60px 0;
        }

        .cta .btn {
            background: white;
            color: #007bff;
            border: none;
            transition: background-color 0.3s, color 0.3s;
        }

        .cta .btn:hover {
            background: #007bff;
            color: white;
        }

        .footer {
            padding: 30px 0;
            background: #f1f1f1;
        }

        .header {
            position: relative;
            width: 100%;
            z-index: 1000;
            transition: all 0.5s ease;
            /* Smooth transition for any changes */
        }

        .fixed-header {
            top: 0;
            background-color: rgba(255, 255, 255, 0.9);
            /* Slightly transparent or any effect */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            /* Optional: adds shadow for better visibility */
        }
        #map {
            height: 500px;
            width: 100%;
        }
        .contact-info i {
            color: #28a745; /* Đổi màu icon sang xanh lá */
            font-size: 16px; /* Tăng kích thước icon */
        }
         .contact-form {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);

            width: 100%;
        }

        .contact-form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .contact-form label {
            font-size: medium;
            color: #666;
            font-weight: bold
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-group {
            display: flex;
            margin-bottom: 15px;
            align-items: center;
        }

        .form-group label {

            font-size: medium;
            color: #666;
            margin-right: 1rem; /* Khoảng cách giữa label và input */
            text-align: left;
            font-weight: bold
        }

        .contact-form .form-group select {
            flex: 1; /* Chiếm phần còn lại của dòng */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .contact-form button {
            background-color: #28a745;
            color: white;
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .contact-form button:hover {
            background-color: #218838;
        }

        .contact-form .required {
            color: red;
        }
        .decription_telegram {

padding: 0.75rem;
  border: 0px;
  width: max-content;
  max-width: 280px;
  overflow-wrap: break-word;
  word-break: break-word;
  background: rgb(255, 255, 255);
  color: rgb(0, 0, 0);
  border-radius: 1.25rem;
  text-align: initial;
}
    </style>

</head>

<body>
@auth
    <div style="position: fixed; bottom: 20px; right: 20px; text-align: center; z-index: 1000;">
<div class="sc-9qme4p-0 hELAUe"><button class="decription_telegram"><span class="sc-1ee9gtf-2 bxZLwE">{{__('front_end.chat_with_me')}}</span></button></div>
  <a href="https://t.me/{{config('config.telegram_user')}}" target="_blank" style="text-decoration: none;">
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
      <img src="https://upload.wikimedia.org/wikipedia/commons/8/82/Telegram_logo.svg" alt="Telegram" style="width: 30px; height: 30px;">
    </button>
  </a>
</div>
    @endauth
    <!-- Navigation Bar -->

    @include('front.common.header')
    <div id="heroCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" style="background-image: url({{url('images/banner_contact.jpg')}})">
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <section class="text-left mt-5">

    <div class="container">
    @if(session('success'))
            <div class="mb-2">
                <div class="col-lg-12">
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                </div>
            </div>
        @endif
        @if(session('fail'))
            <div class="mb-2">
                <div class="col-lg-12">
                    <div class="alert alert-danger" role="alert">{{ session('fail') }}</div>
                </div>
            </div>
        @endif
        <div class="row  mt-5">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <p style="font-size:larger">{!!__('front_end.note_contact')!!}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-7 col-lg-7">
            <div class="contact-form">
            <form action="{{route('contact')}}" method="POST">
            @csrf
                <label for="name">{{__('front_end.my_name')}} <span class="required">*</span></label>
                <input type="text" id="name" name="name" placeholder="{!!__('front_end.placeholder_name')!!}" required>

                <label for="email">Email <span class="required">*</span></label>
                <input type="email" id="email" name="email" placeholder="{{__('front_end.placeholder_email')}}" required>

                <div class="form-group">
                    <label for="product">{{__('front_end.name_product')}}</label>
                    <select id="product" name="product">
                        <option value="">{{__('front_end.select_product')}}</option>
                        <option value="1">Green Alpha</option>
                        <option value="2">Green Beta</option>
                        <option value="3">Green Stock</option>

                    </select>
                </div>

                <label for="message">{{__('front_end.message')}} <span class="required">*</span></label>
                <textarea id="message" name="message" placeholder="{{__('front_end.placeholder_note')}}" rows="5" required></textarea>
                <button type="submit">{{__('front_end.send')}}</button>
            </form>
        </div>
            </div>
            <div class="col-12 col-sm-12 col-md-5 col-lg-5 contact-info" style="font-weight:bold">
                <p style="font-size:larger"> <i>{{__('front_end.contact_info')}}</i></p>
                <p><i class="fas fa-map-marker-alt"></i>{{__('front_end.address_info')}}</p>
                <p><i class="fas fa-phone"></i>{{__('front_end.phone_contact')}}:(+84)354848375</p>
                <p><i class="fas fa-envelope"></i> Email: admin@gvn-fintrade.com</p>
                <p><i class="fas fa-clock"></i>  Mon-Sat</p>

            </div>

        </div>
        <div class="row  mt-5">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div id="map"></div>
            </div>
        </div>
    </div>
    </section>
    <!-- Call to Action Section -->

    <section class="text-center mt-5">
        @include('front.common.footer')
    </section>
    <!-- Footer -->


    <!-- Bootstrap JS and dependencies -->


</body>

</html>
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

    </script>
