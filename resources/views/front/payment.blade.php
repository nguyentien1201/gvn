


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

    <div class="container py-5">
    <!-- Product Information Section -->
    <h2 class="text-center mb-4">Product Information</h2>
    <div class="row justify-content-center">

    </div>

    <!-- Month Selection and Payment Form Section -->
    <div class="row justify-content-center mt-4">
    <div class="col-md-6">
            <div class="card">
                <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="Product Image">
                <div class="card-body">
                    <h5 class="card-title">{{$product->name}}</h5>
                    <p class="card-text">{{$product->description}}</p>
                    <p class="card-text"><strong>Price:</strong>${{$product->monthly_price}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <form>
                <!-- Month Selection -->
                <div class="mb-3">
                    <label for="monthSelect" class="form-label">Select Option</label>
                    <select class="form-select" id="monthSelect" required>
                        <option value="" selected disabled>Choose a package</option>
                        <option value="1" data-price={{$product->monthly_price}}>1 Month</option>
                        <option value="2" data-price={{$product->six_month_price}}>6 Month</option>
                        <option value="3" data-price={{$product->yearly_price}}>1 Year</option>
                    </select>
                </div>

                <!-- Cardholder Name -->
                <div class="mb-3">
                    <label for="cardholderName" class="form-label">Cardholder Name</label>
                    <input type="text" class="form-control" id="cardholderName" placeholder="John Doe" required>
                </div>

                <!-- Card Number -->
                <div class="mb-3">
                    <label for="cardNumber" class="form-label">Card Number</label>
                    <input type="text" class="form-control" id="cardNumber" placeholder="1234 5678 9012 3456" required>
                </div>

                <!-- Expiry Date and CVV -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="expiryDate" class="form-label">Expiry Date</label>
                        <input type="text" class="form-control" id="expiryDate" placeholder="MM/YY" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cvv" class="form-label">CVV</label>
                        <input type="text" class="form-control" id="cvv" placeholder="123" required>
                    </div>
                </div>

                <!-- Payment Amount -->
                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="text" class="form-control" id="amount" value="{{$product->monthly_price}}" readonly>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100">Submit Payment</button>
            </form>
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

          $('#monthSelect').on('change',function(){

            const selectedOption = $('#monthSelect option:selected');
            const amount = selectedOption.data('price');
            $('#amount').val(amount);
          })
        })
    </script>
