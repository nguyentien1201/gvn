<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GVN</title>
    <!-- Bootstrap CSS -->


    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- DataTables Responsive CSS -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.jpg') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{asset('plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
 <!-- Thêm jQuery vào -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Thêm Google Maps API vào -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

    <style>
        body {
            font-size: 0.9rem !important;
        }
        .ml-auto {
            margin-left: auto !important;
        }
        #navbarNav .nav-link {
            font-size: 1.1rem;
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
    </style>

</head>

<body>

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
        <div class="row  mt-5">
            <h2>Liên Hệ:</h2>
            <div class="col-md-12">
                <p style="font-size:larger"> <i><b>Gửi nhà đầu tư</b></i></p>
                <p> <i><b>GVN Fin Trade luôn mong muốn được kết nối với Quý Nhà đầu tư và cung cấp cho Quý vị những công cụ hỗ trợ đầu tư giúp kiểm soát cảm xúc và nâng cao giá trị đầu tư nhằm mang đến những giải pháp tối ưu tiết kiệm thời gian và trí tuệ. Nếu Quý vị có bất gì thắc mắc nào, vui lòng liên hệ với chúng tôi: investment@gvn.com</b></i></p>
            </div>
        </div>
        <div class="row  mt-5">
            <div class="col-md-6">
                    <div id="map"></div>
            </div>
            <div class="col-md-6" style="font-weight:bold">
                <p style="font-size:larger"> <i>Thông tin liên hệ</i></p>
                <p>Thành phố Hồ Chí Minh
                Lô CD, Chung cư Bình Khánh, P. An Khánh, Quận 2</p>
                <p>Điện thoại:  0909 889 889(Mr.Danh)</p>
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
