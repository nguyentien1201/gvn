<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mission GVN</title>
    <!-- Bootstrap CSS -->

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-09NXCQGTBV"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-09NXCQGTBV');
</script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <!-- DataTables Responsive CSS -->
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
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <style>
        body {
            font-size: 0.9rem !important;
        }
        .carousel-item {

min-height: 300px;
background: no-repeat center center scroll;
background-size: cover;
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

        .footer {
            padding: 30px 0;
            background: #f1f1f1;
        }
        .ml-auto {
            margin-left: auto !important;
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


.main-timeline {
  font-family: tahoma;
  padding: 20px 0;
  position: relative;
}

.main-timeline::before,
.main-timeline::after {
  content: "";
  height: 40px;
  width: 40px;
  background-color: #e7e7e7;
  border-radius: 50%;
  border: 10px solid #303334;
  transform: translatex(-50%);
  position: absolute;
  left: 50%;
  top: -15px;
  z-index: 2;
}

.main-timeline::after {
  top: auto;
  bottom: 15px;
}

.main-timeline .timeline {
  padding: 35px 0;
  margin-top: -30px;
  position: relative;
  z-index: 1;
}

.main-timeline .timeline::before,
.main-timeline .timeline::after {
  content: "";
  height: 100%;
  width: 50%;
  border-radius: 110px 0 0 110px;
  border: 15px solid #46b2bc;
  border-right: none;
  position: absolute;
  left: 0;
  top: 0;
  z-index: -1;
}

.main-timeline .timeline::after {
  height: calc(100% - 30px);
  width: calc(50% - 12px);
  border-color: #65c7d0;
  left: 12px;
  top: 15px;
}

.main-timeline .timeline-content {
  display: inline-block;
  width: 100%;
}

.main-timeline .timeline-content:hover {
  text-decoration: none;
}

.main-timeline .timeline-year {
  color: #65c7d0;
  font-size: 50px;
  font-weight: 600;
  display: inline-block;
  transform: translatey(-50%);
  position: absolute;
  top: 50%;
  left: 10%;
}

.main-timeline .timeline-icon {
    color: #65c7d0;
    font-size: 70px;
    display: inline-block;
    transform: translateY(-50%);
    position: absolute;
    left: 34%;
    top: 50%;
}

.main-timeline .content {
  color: #909090;
  width: 50%;
  min-width: 50%;
  padding: 20px;
  display: inline-block;
  float: right;
  min-height: 80px;
}

.main-timeline .title {
  color: #65c7d0;
  font-size: 20px;
  font-weight: 600;
  text-transform: uppercase;
  margin: 0 0 5px 0;
}

.main-timeline .description {
  font-size: 16px;
  color:#000;
  margin: 0;
}

.main-timeline .timeline:nth-child(even)::before {
  left: auto;
  right: 0;
  border-radius: 0 110px 110px 0;
  border: 15px solid red;
  border-left: none;
}

.main-timeline .timeline:nth-child(even)::after {
  left: auto;
  right: 12px;
  border-radius: 0 100px 100px 0;
  border: 15px solid green;
  border-left: none;
}

.main-timeline .timeline:nth-child(even) .content {
  float: left;
}

.main-timeline .timeline:nth-child(even) .timeline-year {
    left: auto;
    right: 10%;
}

.main-timeline .timeline:nth-child(even) .timeline-icon {
  left: auto;
  right: 32%;
}

.main-timeline .timeline:nth-child(5n+1)::before {
  border-color: #46b2bc;
}

.main-timeline .timeline:nth-child(5n+1)::after {
  border-color: #65c7d0;
}

.main-timeline .timeline:nth-child(5n+1) .timeline-icon {
  color: #65c7d0;
}

.main-timeline .timeline:nth-child(5n+1) .timeline-year {
  color: #65c7d0;
}

.main-timeline .timeline:nth-child(5n+1) .title {
  color: #65c7d0;
}

.main-timeline .timeline:nth-child(5n+2)::before {
  border-color: #ea3c14;
}

.main-timeline .timeline:nth-child(5n+2)::after {
  border-color: #EF5720;
}

.main-timeline .timeline:nth-child(5n+2) .timeline-icon {
  color: #EA3C14;
}

.main-timeline .timeline:nth-child(5n+2) .timeline-year {
  color: #EA3C14;
}

.main-timeline .timeline:nth-child(5n+2) .title {
  color: #EA3C14;
}

.main-timeline .timeline:nth-child(5n+3)::before {
  border-color: #8CC63E;
}

.main-timeline .timeline:nth-child(5n+3)::after {
  border-color: #6CAF29;
}

.main-timeline .timeline:nth-child(5n+3) .timeline-icon
{
  color: #8CC63E;
}

.main-timeline .timeline:nth-child(5n+3) .timeline-year {
  color: #8CC63E;
}

.main-timeline .timeline:nth-child(5n+3) .title {
  color: #8CC63E;
}

.main-timeline .timeline:nth-child(5n+4)::before {
  border-color: #F99324;
}

.main-timeline .timeline:nth-child(5n+4)::after {
  border-color: #FBB03B;
}

.main-timeline .timeline:nth-child(5n+4) .timeline-icon {
  color: #F99324;
}

.main-timeline .timeline:nth-child(5n+4) .timeline-year {
  color: #F99324;
}

.main-timeline .timeline:nth-child(5n+4) .title {
  color: #F99324;
}

.main-timeline .timeline:nth-child(5n+5)::before {
  border-color: #0071BD;
}

.main-timeline .timeline:nth-child(5n+5)::after {
  border-color: #0050A3;
}

.main-timeline .timeline:nth-child(5n+5) .timeline-icon {
  color: #0071BD;
}

.main-timeline .timeline:nth-child(5n+5) .timeline-year {
  color: #0071BD;
}

.main-timeline .timeline:nth-child(5n+5) .title {
  color: #0071BD;
}

@media screen and (max-width:1200px){
    .main-timeline .timeline:after{ border-radius: 88px 0 0 88px; }
    .main-timeline .timeline:nth-child(even):after{ border-radius: 0 88px 88px 0; }
}
@media screen and (max-width:767px){
    .main-timeline .timeline{ margin-top: -19px; }
    .main-timeline .timeline:before {
        border-radius: 50px 0 0 50px;
        border-width: 10px;
    }
    .main-timeline .timeline:after {
        height: calc(100% - 18px);
        width: calc(50% - 9px);
        border-radius: 43px 0 0 43px;
        border-width:10px;
        top: 9px;
        left: 9px;
    }
    .main-timeline .timeline:nth-child(even):before {
        border-radius: 0 50px 50px 0;
        border-width: 10px;
    }
    .main-timeline .timeline:nth-child(even):after {
        height: calc(100% - 18px);
        width: calc(50% - 9px);
        border-radius: 0 43px 43px 0;
        border-width: 10px;
        top: 9px;
        right: 9px;
    }
    .main-timeline .timeline-icon{ font-size: 60px; }
    .main-timeline .timeline-year{ font-size: 40px; }
}
@media screen and (max-width:479px){
    .main-timeline .timeline-icon{
        font-size: 50px;
        transform:translateY(0);
        top: 25%;
        left: 10%;
    }
    .main-timeline .timeline-year{
        font-size: 25px;
        transform:translateY(0);
        top: 65%;
        left: 9%;
    }
    .main-timeline .content{
        width: 68%;
        padding: 10px;
    }
    .main-timeline .title{ font-size: 18px; }
    .main-timeline .timeline:nth-child(even) .timeline-icon{
        right: 10%;
    }
    .main-timeline .timeline:nth-child(even) .timeline-year{
        right: 9%;
    }
}
.carousel-item {
min-height: 300px;
background: no-repeat center center scroll;
background-size: cover;
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
<div class="sc-9qme4p-0 hELAUe"><button class="decription_telegram"><span class="sc-1ee9gtf-2 bxZLwE">{{__('base.chat_with_me')}}</span></button></div>
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
            <div class="carousel-item active" style="background-image: url({{url('images/banner_mission.jpg')}})">
            </div>
        </div>
    </div>
    <!-- Features Section -->
    <section class="text-center mt-5">

    <div class="container">
    <div class="row  mt-5">
        <p><i> {{__('base.mission_gvn')}}</i></p>
    </div>
    <div class="row mt-2 text-center" >
            <h4><b>{{__('base.maxim_gvn')}}</b> </h4>
    </div>
  <div class="row  mt-4">
    <div class="col">
      <div class="main-timeline">
        <div class="timeline">
          <div class="timeline-content">
            <span class="timeline-year">2023</span>
            <div class="content">
              <p class="description">{!!__('base.idea_gvn')!!}
              </p>
            </div>
          </div>
        </div>
        <div class="timeline">
          <a href="#" class="timeline-content">
            <span class="timeline-year">2022</span>

            <div class="content">
              <h3 class="title"></h3>
              <p class="description">{!!__('base.time_line_beta')!!}

              </p>
            </div>
          </a>
        </div>
        <div class="timeline">
          <a href="#" class="timeline-content">
            <span class="timeline-year">2021</span>

            <div class="content">
              <h3 class="title"></h3>
              <p class="description">
              {{__('base.time_line_greenstock')}}
              </p>
            </div>
          </a>
        </div>
        <div class="timeline">
          <a href="#" class="timeline-content">
            <span class="timeline-year">2020</span>

            <div class="content">
              <h3 class="title"></h3>
              <p class="description">{{__('base.time_line_greenstock_develop')}}

              </p>
            </div>
          </a>
        </div>
        <div class="timeline">
          <a href="#" class="timeline-content">
            <span class="timeline-year">2019</span>

            <div class="content">
              <h3 class="title"></h3>
              <p class="description">{{__('base.time_line_alpha_testing')}}

              </p>
            </div>
          </a>
        </div>
        <div class="timeline">
          <a href="#" class="timeline-content">
            <span class="timeline-year">2012-2018</span>

            <div class="content">
              <h3 class="title">{{__('base.start')}}</h3>
              <p class="description">{{__('base.time_line_start_alpha_beta')}}
              </p>
            </div>
          </a>
        </div>

      </div>
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
