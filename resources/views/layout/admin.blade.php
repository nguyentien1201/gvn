<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Green Trading Invest | Dashboard</title>
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet"
          href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet"
          href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{asset('plugins/fullcalendar/main.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/fullcalendar-daygrid/main.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/fullcalendar-timegrid/main.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/fullcalendar-bootstrap/main.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    @yield('styles')
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
    </nav>
    @include('layout.sidebar')
    <div id="loading-icon" style="display: none;">
        <div class="lds-default">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <div id="loading" style="display:none">
        <img src="{{url('../images/loading.gif')}}" alt="Loading..."/>
    </div>
    <div class="content-wrapper">
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
        @yield('content')
    </div>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <script src="{{asset('plugins/moment/moment-with-locales.min.js')}}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script
        src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script
        src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}">
    </script>
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <!-- Select2 -->
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>

    <!-- fullCalendar 2.2.5 -->
    <script src="{{asset('plugins/fullcalendar/main.min.js')}}"></script>
    <script src="{{asset('plugins/fullcalendar-daygrid/main.min.js')}}"></script>
    <script src="{{asset('plugins/fullcalendar-timegrid/main.min.js')}}"></script>
    <script src="{{asset('plugins/fullcalendar-interaction/main.min.js')}}"></script>
    <script src="{{asset('plugins/fullcalendar-bootstrap/main.min.js')}}"></script>
    <script src="{{asset('plugins/pusher/pusher.min.js')}}"></script>
    @yield('scripts')
    <script>
        $(document).ready(function () {
            $(".select2-placeholder-multiple").select2({
                placeholder: "{{__('promotion.choose_recipient')}}",
            });
        })
    </script>
    <footer class="main-footer" style="padding:0;">
    </footer>
</div>
</body>

</html>
