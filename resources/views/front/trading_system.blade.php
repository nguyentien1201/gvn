<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Trading System</title>
    <!-- Bootstrap CSS -->


    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <!-- DataTables Responsive CSS -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{asset('plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-09NXCQGTBV"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-09NXCQGTBV');
</script>
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
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <style>
        .disabled-link {
            opacity: 0.5;
    pointer-events: none;
    cursor: not-allowed;
    color: #6c757d; /* Optional: Change the color to indicate it's disabled */
    text-decoration: none; /* Optional: Remove underline */
    background-color: #e9ecef; /* Optional: Change background color */
    border: 1px solid #ced4da; /* Optional: Add border */
    padding: 0.5rem 1rem; /* Optional: Add padding */
    border-radius: 0.25rem; /* Optional: Add border radius */
}
           .carousel-item {

min-height: 300px;
background: no-repeat center center scroll;
background-size: cover;
}

        body {
            font-size: 0.9rem !important;
        }

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
        .carousel-item {
            min-height: 300px;
            background: no-repeat center center scroll;
            background-size: cover;
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

        .pricing-table {
            display: flex;
            justify-content: center;  /* Căn giữa theo chiều ngang */

        }
        .basic {
            background-color: #4f4fee;
            color: white;

        }
        .standard {

                background-color: #4caf50;
                color: white;
            }
            .premium {
                background-color: #f44336;
                color: white;
            }
        .pricing-card {
            background-color: white;
            padding: 20px;
            border-radius: 150px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
        }

        .pricing-card h3 {
            font-size: large;
            color: #333;
        }

        .pricing-card .price {
            font-size: x-large;
            margin: 20px 0;
            padding: 10px;
            border: none;
            border-radius: 50px;  /* Bo tròn góc */
            display: inline-block; /* Để giới hạn phần tử theo kích thước nội dung */
        }

        .pricing-card ul {
            list-style-type: none;
            margin: 1rem 0;
        }

        .pricing-card ul li {
            font-size: 16px;
            margin: 10px 0;
            text-align: left;
            display: flex;
            align-items: center;
        }

        .pricing-card ul li span {
            margin-right: 10px;
            color: green;
        }

        .pricing-card ul li span:nth-child(1):contains('✖') {
            color: red;
        }

        .pricing-card .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 60px;

            color: white;
            text-decoration: none;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .pricing-card .btn:hover {
            /* background-color: #0056b3; */
        }

        /* Specific styles for each card */


        .basic .btn {
            background-color: #4f4fee;
        }

        .standard .btn {
            background-color: #4caf50;
        }

        .premium .btn {
            background-color: #f44336;
        }
        .price_block{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .tick {
            color: green; /* Đổi màu thành xanh lá */
            font-weight: bold;
            margin-right: 10px;
        }

        /* Not Tick (Red) */
        .not-tick {
            color: red; /* Đổi màu thành đỏ */
            font-weight: bold;
            margin-right: 10px;
        }




        .pricing-table {
  display: flex;
  flex-flow: row wrap;
  width: 100%;
  max-width: 1100px;
  margin: 0 auto;
  background: #ffffff;
}

.pricing-table .ptable-item {

  padding: 0 15px;
  margin-bottom: 30px;
}



.pricing-table .ptable-single {
  position: relative;
  width: 100%;
  overflow: hidden;
}

.pricing-table .ptable-header,
.pricing-table .ptable-body,
.pricing-table .ptable-footer {
  position: relative;
  width: 100%;
  text-align: center;
  overflow: hidden;
}

.pricing-table .ptable-status ,
.pricing-table .ptable-title,
.pricing-table .ptable-price,
.pricing-table .ptable-description,
.pricing-table .ptable-action {
  position: relative;
  width: 100%;
  text-align: center;
}

.pricing-table .ptable-single {
  background: #f6f8fa;
}

.pricing-table .ptable-single:hover {
  box-shadow: 0 0 10px #999999;
}

.pricing-table .ptable-header {
  margin: 0 30px;
  padding: 30px 0 45px 0;
  width: auto;
  background: #4f4fee;
}

.pricing-table .ptable-header::before,
.pricing-table .ptable-header::after {
  content: "";
  position: absolute;
  bottom: 0;
  width: 0;
  height: 0;
  border-bottom: 100px solid #f6f8fa;
}

.pricing-table .ptable-header::before {
  right: 50%;
  border-right: 250px solid transparent;
}

.pricing-table .ptable-header::after {
  left: 50%;
  border-left: 250px solid transparent;
}

.pricing-table .ptable-item.featured-item .ptable-header {
  background: #4caf50;
}

.pricing-table .ptable-item.premium-item .ptable-header {
  background: #f44336;
}
.pricing-table .ptable-status {
  margin-top: -30px;
}

.pricing-table .ptable-status span {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 30px;
  padding: 5px 0;
  text-align: center;
  color: #4caf50;
  font-size: 14px;
  font-weight: 300;
  letter-spacing: 1px;
  background: #FFD700;
}

.pricing-table .ptable-status span::before,
.pricing-table .ptable-status span::after {
  content: "";
  position: absolute;
  bottom: 0;
  width: 0;
  height: 0;
  border-bottom: 10px solid #4caf50;
}

.pricing-table .ptable-status span::before {
  right: 50%;
  border-right: 25px solid transparent;
}

.pricing-table .ptable-status span::after {
  left: 50%;
  border-left: 25px solid transparent;
}

.pricing-table .ptable-title h2 {
  color: #ffffff;
  font-size: 24px;
  font-weight: 300;
  letter-spacing: 2px;
}

.pricing-table .ptable-price h2 {
  margin: 0;
  color: #ffffff;
  font-size: 45px;
  font-weight: 700;
  margin-left: 15px;
}

.pricing-table .ptable-price h2 small {
  position: absolute;
  font-size: 18px;
  font-weight: 300;
  margin-top: 16px;
  margin-left: -15px;
}

.pricing-table .ptable-price h2 span {
  margin-left: 3px;
  font-size: 16px;
  font-weight: 300;
}

.pricing-table .ptable-body {
  padding: 20px 0;
}

.pricing-table .ptable-description ul {
  margin: 0;
  padding: 0;
  list-style: none;
}

.pricing-table .ptable-description ul li {
  color: #2A293E;
  font-size: 14px;
  font-weight: 300;
  letter-spacing: 1px;
  padding: 7px;
  border-bottom: 1px solid #dedede;
}

.pricing-table .ptable-description ul li:last-child {
  border: none;
}

.pricing-table .ptable-footer {
  padding-bottom: 30px;
}

.pricing-table .ptable-action a {
  display: inline-block;
  padding: 10px 20px;
  color: #ffffff;
  font-size: 14px;
  font-weight: 500;
  letter-spacing: 2px;
  text-decoration: none;
  background: #0d6efd;
  cursor: pointer;
}

.pricing-table .ptable-action a:hover {
  color: white;
  background: #0d6efd;
}

.pricing-table .ptable-item.featured-item .ptable-action a {
  color: white;
  background: #4caf50;
}

.pricing-table .ptable-item.featured-item .ptable-action a:hover {
  color: white;
  background: #4caf50;
}
.pricing-table .ptable-item.premium-item .ptable-action a {
  color: white;
  background: #f44336;
}

.pricing-table .ptable-item.premium-item .ptable-action a:hover {
  color: white;
  background: #f44336;
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
      <div class="carousel-item active" style="background-image: url({{url('images/banner_tranding_view.jpg')}})">
      </div>
    </div>
  </div>
    <!-- Features Section -->
    <section>
        <div class="container">
            <div class="row">
                <h3 class="text-center mt-5">{{__('front_end.quote_benjamin')}}</h3>
                <div class="col-md-6">
                    <p class="text-center mt-3 " style="font-size: larger;">{{__('front_end.description_quote_benjamin')}}</p>

                </div>
                <div class="col-md-6">
                    <img src="{{ asset('images/trading-system.jpg') }}" alt="Trading System" class="img-fluid">
                </div>

            </div>
            <div class="row">

                <img src="{{ asset('images/history_beta.jpg') }}" alt="history_beta" class="img-fluid">
                <h4 class="text-center mt-5" style="font-size: larger;">{{__('front_end.description_greenbeta')}}</h4>
            </div>
        </div>
        <div class="container pb-3 mt-5" style="background: #f9f9f9;">
            <div class="row">
            <div class="pricing-table">
            <div class="ptable-item col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="ptable-single">
                <div class="ptable-header">
                    <div class="ptable-title">

                    <h2>{{__('front_end.1_month')}}</h2>
                    </div>
                    <div class="ptable-price">
                    <h2><small>$</small>{{$price_product['beta']->monthly_price}}<span></span></h2>
                    </div>
                </div>
                <div class="ptable-body">
                    <div class="ptable-description">
                    <ul>
                        <li>{{__('front_end.product_free')}}</li>
                        <li>{{__('front_end.1_month')}}</li>
                    </ul>
                    </div>
                </div>
                <div class="ptable-footer">
                    <div class="ptable-action">
                        @if (Auth::check())
                            <a class="subscription"  data-product="beta"  data-id={{$price_product['beta']->id}} data-type="trial" data-month="1">Trial</a>
                        @else
                            <a href="{{ route('login') }}">{{__('front_end.login')}}</a>
                        @endif
                    </div>
                </div>
                </div>
            </div>

            <div class="ptable-item featured-item col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="ptable-single">
                <div class="ptable-header">
                    <!-- <div class="ptable-status">
                    <span>Hot</span>
                    </div> -->
                    <div class="ptable-title">
                    <h2>{{__('front_end.6_month')}}</h2>
                    </div>
                    <div class="ptable-price">
                    <h2><small>$</small>{{$price_product['beta']->six_month_price}}<span></span></h2>
                    </div>
                </div>
                <div class="ptable-body">
                    <div class="ptable-description">
                    <ul>
                        <li>{{__('front_end.comming_soon')}}</li>
                        <li>{{__('front_end.6_month')}}</li>
                    </ul>
                    </div>
                </div>
                <div class="ptable-footer">
                    <div class="ptable-action">
                        @if (Auth::check())
                        <a class="subscription" data-product="beta"  data-id={{$price_product['beta']->id}} data-type="trial" data-month="1">Trial</a>
                          <!-- <a class=""  href="{{ route('front.home.payment', [$price_product['beta']->id])}}" >Buy</a> -->
                            <!-- <a class="subscription disabled-link" data-id={{$price_product['beta']->id}} data-type="buy" data-month="2">Buy</a> -->
                        @else
                            <a disabled href="{{ route('login') }}">{{__('front_end.login')}}</a>
                        @endif
                    </div>
                </div>
                </div>
            </div>

            <div class="ptable-item premium-item col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="ptable-single">
                <div class="ptable-header">
                    <div class="ptable-title">
                    <h2>{{__('front_end.1_year')}}</h2>
                    </div>
                    <div class="ptable-price">
                    <h2><small>$</small>{{$price_product['beta']->yearly_price}}<span></span></h2>
                    </div>
                </div>
                <div class="ptable-body">
                    <div class="ptable-description">
                    <ul>
                        <li>{{__('front_end.comming_soon')}}</li>
                        <li>{{__('front_end.1_year')}}</li>
                    </ul>
                    </div>
                </div>
                <div class="ptable-footer">
                    <div class="ptable-action">
                    @if (Auth::check())
                    <a class="subscription"  data-product="beta" data-id={{$price_product['beta']->id}} data-type="trial" data-month="1">Trial</a>
                            <!-- <a class="subscription"  href="{{ route('front.home.payment', [$price_product['beta']->id])}}" >Buy</a> -->
                        @else
                            <a href="{{ route('login') }}">{{__('front_end.login')}}</a>
                        @endif
                    </div>
                </div>
                </div>
            </div>
            </div>

            </div>
        </div>
    </section>
    <section>
    <div class="container">
            <div class="row">
                <h3 class="text-center mt-5"> {{__('front_end.quote_soros')}}</h3>
                <div class="col-12 col-sm-12 col-md-8 col-lg-9">
                    <p class="text-center mt-3 " style="font-size: larger;">{{__('front_end.description_quote_soros')}}</p>
                </div>
                <div class=" col-12 col-sm-12 col-md-4 col-lg-3">
                    <img src="{{ asset('images/signal_stock.jpg') }}" width="100%" alt="Trading System" class="img-fluid">
                </div>

            </div>
            <div class="row">
            <div class="col-md-6">

                <img src="{{ asset('images/alpha_history.jpg') }}" alt="history_alpha" class="img-fluid">
                <h4 class="text-center mt-5">{{__('front_end.profit_accumulation')}}</h4>
            </div>
                <div class="col-md-6">
                <h4 class="text-center mt-5"3>{{__('front_end.manage_profit_month')}}</h4>
                    <img src="{{ asset('images/chart_profit.jpg') }}" alt="Trading System" class="img-fluid">

                </div>


            </div>
        </div>
        <div class="container pb-3 mt-5" style="background: #f9f9f9;">
            <div class="row">
            <div class="pricing-table">
            <div class="ptable-item col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="ptable-single">
                <div class="ptable-header">
                    <div class="ptable-title">
                    <h2>{{__('front_end.1_month')}}</h2>
                    </div>
                    <div class="ptable-price">
                    <h2><small>$</small>{{$price_product['alpha']->monthly_price}}<span></span></h2>
                    </div>
                </div>
                <div class="ptable-body">
                    <div class="ptable-description">
                    <ul>
                        <li>{{__('front_end.product_free')}}</li>
                        <li>{{__('front_end.1_month')}}</li>
                    </ul>
                    </div>
                </div>
                <div class="ptable-footer">
                    <div class="ptable-action">
                        @if (Auth::check())
                            <!-- <a class="subscription" data-id={{$price_product['alpha']->id}} data-type="buy" data-month="1">Buy</a> -->
                            <a class="subscription"  data-product="alpha" data-id={{$price_product['alpha']->id}} data-type="trial" data-month="1">Trial</a>
                        @else
                            <a href="{{ route('login') }}">{{__('front_end.login')}}</a>
                        @endif
                    </div>
                </div>
                </div>
            </div>

            <div class="ptable-item featured-item col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="ptable-single">
                <div class="ptable-header">
                    <!-- <div class="ptable-status">
                    <span>Hot</span>
                    </div> -->
                    <div class="ptable-title">
                    <h2>{{__('front_end.6_month')}}</h2>
                    </div>
                    <div class="ptable-price">
                    <h2><small>$</small>{{$price_product['alpha']->six_month_price}}<span></span></h2>
                    </div>
                </div>
                <div class="ptable-body">
                    <div class="ptable-description">
                    <ul>
                        <li>{{__('front_end.comming_soon')}}</li>
                        <li>{{__('front_end.6_month')}}</li>
                    </ul>
                    </div>
                </div>
                <div class="ptable-footer">
                    <div class="ptable-action">
                    @if (Auth::check())
                    <a class="subscription"  data-product="alpha" data-id={{$price_product['alpha']->id}} data-type="trial" data-month="1">Trial</a>
                            <!-- <a class="subscription"  href="{{ route('front.home.payment', [$price_product['alpha']->id])}}" >Buy</a> -->

                        @else
                            <a href="{{ route('login') }}">{{__('front_end.login')}}</a>
                        @endif
                    </div>
                </div>
                </div>
            </div>

            <div class="ptable-item premium-item col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="ptable-single">
                <div class="ptable-header">
                    <div class="ptable-title">
                    <h2>{{__('front_end.1_year')}}</h2>
                    </div>
                    <div class="ptable-price">
                    <h2><small>$</small>{{$price_product['alpha']->yearly_price}}<span></span></h2>
                    </div>
                </div>
                <div class="ptable-body">
                    <div class="ptable-description">
                    <ul>
                        <li>{{__('front_end.product_free')}}</li>
                        <li>{{__('front_end.1_month')}}</li>
                    </ul>
                    </div>
                </div>
                <div class="ptable-footer">
                    <div class="ptable-action">
                        @if (Auth::check())
                        <a class="subscription" data-product="alpha" data-id={{$price_product['alpha']->id}} data-type="trial" data-month="1">Trial</a>
                        <!-- <a class="subscription"  href="{{ route('front.home.payment', [$price_product['alpha']->id])}}" >Buy</a> -->

                        @else
                            <a href="{{ route('login') }}">{{__('front_end.login')}}</a>
                        @endif
                    </div>
                </div>
                </div>
            </div>
            </div>

            </div>
        </div>
    </section>
    <!-- Call to Action Section -->
    <section>
    <div class="container">
            <div class="row">
                <h3 class="text-center mt-5">{{__('front_end.quote_templeton')}}</h3>

                <div class="col-md-8 ">
                    <img src="{{ asset('images/system_greenstock.jpg') }}" alt="Trading System" class="img-fluid">
                </div>
                <div class="col-md-4" style="justify-content: center;align-items: center;display: flex;">
                    <p class="text-center mt-3 " style="font-size: larger;">{{__('front_end.description_greenstock')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <img src="{{ asset('images/system_profit_greenstock.jpg') }}" alt="history_alpha" class="img-fluid">
                </div>
                <div class="col-md-4"  style="justify-content: center;align-items: center;display: flex;">
                        <p class="text-center mt-3" style="font-size: larger;">{{__('front_end.system_product')}}

                        </p>

                </div>


            </div>
        </div>
        <div class="container pb-3 mt-5" style="background: #f9f9f9;">
            <div class="row">
            <div class="pricing-table">
            <div class="ptable-item col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="ptable-single">
                <div class="ptable-header">
                    <div class="ptable-title">
                    <h2>{{__('front_end.1_month')}}</h2>
                    </div>
                    <div class="ptable-price">
                    <h2><small>$</small>{{$price_product['greenstock']->monthly_price}}<span></span></h2>
                    </div>
                </div>
                <div class="ptable-body">
                    <div class="ptable-description">
                    <ul>
                        <li>{{__('front_end.product_free')}}</li>
                        <li>{{__('front_end.1_month')}}</li>
                    </ul>
                    </div>
                </div>
                <div class="ptable-footer">
                    <div class="ptable-action">
                        @if (Auth::check())
                        <a class="subscription" data-product="greenstock" data-id={{$price_product['greenstock']->id}} data-type="trial" data-month="1">Trial</a>
                        <!-- <a class="subscription"  href="{{ route('front.home.payment', [$price_product['greenstock']->id])}}" >Buy</a> -->

                        @else
                            <a href="{{ route('login') }}">{{__('front_end.login')}}</a>
                        @endif
                    </div>
                </div>
                </div>
            </div>

            <div class="ptable-item featured-item col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="ptable-single">
                <div class="ptable-header">
                    <!-- <div class="ptable-status">
                    <span>Hot</span>
                    </div> -->
                    <div class="ptable-title">
                    <h2>{{__('front_end.6_month')}}</h2>
                    </div>
                    <div class="ptable-price">
                    <h2><small>$</small>{{$price_product['greenstock']->six_month_price}}<span></span></h2>
                    </div>
                </div>
                <div class="ptable-body">
                    <div class="ptable-description">
                    <ul>
                        <li>{{__('front_end.product_free')}}</li>
                        <li>{{__('front_end.1_month')}}</li>
                    </ul>
                    </div>
                </div>
                <div class="ptable-footer">
                    <div class="ptable-action">
                        @if (Auth::check())
                        <a class="subscription" data-product="greenstock" data-id={{$price_product['greenstock']->id}} data-type="trial" data-month="1">Trial</a>
                        <!-- <a class="subscription"  href="{{ route('front.home.payment', [$price_product['greenstock']->id])}}" >Buy</a> -->

                        @else
                            <a href="{{ route('login') }}">{{__('front_end.login')}}</a>
                        @endif
                    </div>
                </div>
                </div>
            </div>

            <div class="ptable-item premium-item col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="ptable-single">
                <div class="ptable-header">
                    <div class="ptable-title">
                    <h2>{{__('front_end.1_year')}}</h2>
                    </div>
                    <div class="ptable-price">
                    <h2><small>$</small>{{$price_product['greenstock']->yearly_price}}<span></span></h2>
                    </div>
                </div>
                <div class="ptable-body">
                    <div class="ptable-description">
                    <ul>
                        <li>{{__('front_end.product_free')}}</li>
                        <li>{{__('front_end.1_month')}}</li>
                    </ul>
                    </div>
                </div>
                <div class="ptable-footer">
                    <div class="ptable-action">
                        @if (Auth::check())
                        <a class="subscription" data-product="greenstock" data-id={{$price_product['greenstock']->id}} data-type="trial" data-month="1">Trial</a>
                        <!-- <a class="subscription"  href="{{ route('front.home.payment', [$price_product['greenstock']->id])}}" >Buy</a> -->
                        @else
                            <a href="{{ route('login') }}">{{__('front_end.login')}}</a>
                        @endif
                    </div>
                </div>
                </div>
            </div>
            </div>

            </div>
        </div>
    </section>
    <section class="text-center mt-5">
        @include('front.common.footer')
    </section>
    <!-- Footer -->


    <!-- Bootstrap JS and dependencies -->
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.ptable-action .subscription').click(function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let type = $(this).data('type');
            let month = $(this).data('month');
            let product = $(this).data('product');
            $.ajax({
                url: "{{ route('api.buy-product') }}",
                type: 'POST',
                data: {
                    id: id,
                    type: type,
                    month: month
                },
                success: function(data) {
                    if (data.status == 'success') {
                        alert('Buy product success');
                        if(product == 'alpha') {
                            window.open( "{{ route('front.home.green-alpha') }}", '_blank');
                        }
                        if(product=='beta'){
                            window.open("{{ route('front.home.green-beta') }}", '_blank');
                        }
                        if(product=='greenstock'){
                            window.open(`{{ route('front.home.green-stock') }}`, '_blank');
                        }
                    } else {
                        alert('Buy product fail');
                    }
                }
            });
        });
    });
</script>

</body>

</html>
