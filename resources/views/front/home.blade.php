<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GVN</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{asset('plugins/fullcalendar/main.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/fullcalendar-daygrid/main.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/fullcalendar-timegrid/main.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/fullcalendar-bootstrap/main.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        /* Custom navbar color */

        .navbar-custom .navbar-nav .nav-link {
            font-weight: 700;
            color: #000000; /* Adjust for better contrast */
        }
        .navbar-custom .navbar-nav .nav-link:hover {
            color: #cccccc; /* Lighter shade for hover effect */
        }
        .navbar-custom .navbar-nav .nav-link:active{
            color: #3ab54a ;
        }
    </style>
    @yield('styles')
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
</head>

<body>

    <div class="container">
        <!-- Header -->
        <header class="row">
            <div class="col-12">
                @include('front.common.header')
            </div>
        </header>


        <!-- Main Content -->
        <main class="row">
            <div class="col-12">
                @include('front.common.home-content')
            </div>
        </main>

        <!-- Footer -->
        <footer class="row">
            <div class="col-12">
                @include('front.common.footer')
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <script src="{{asset('plugins/moment/moment-with-locales.min.js')}}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlafont-awesomeyScrollbars.min.js') }}"></script>
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
    <script src="{{asset('pusher/pusher.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
    @yield('scripts')
    <script>
        $(document).ready(function () {
            $(".select2-placeholder-multiple").select2({
                placeholder: "{{__('promotion.choose_recipient')}}",
            });
        })

        // Chart js config
        var ctx = document.getElementById('myChartBeta').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['11/22', '11/25', '11/29', '03/23', '04/25', '06/28'],
                datasets: [{
                    fill: false,
                    label: 'Green Alpha 10.0.1',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        '#3ab54a',
                        '#3ab54a',
                        '#3ab54a',
                        '#3ab54a',
                        '#3ab54a',
                        '#3ab54a'
                    ],
                    borderColor: [
                        '#3ab54a'
                    ],
                    borderWidth: 2
                },
                {
                    fill: false,
                    label: 'NASDAQ',
                    data: [5, 14, -3, -5, 6, -3],
                    backgroundColor: [
                        '#7a7a7a',
                        '#7a7a7a',
                        '#7a7a7a',
                        '#7a7a7a',
                        '#7a7a7a',
                        '#7a7a7a'
                    ],
                    borderColor: [
                        '#7a7a7a'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: 'rgb(255, 99, 132)'
                        }
                    }
                }
            }
        });

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['11/22', '11/25', '11/29', '03/23', '04/25', '06/28'],
                datasets: [{
                    fill: 'origin',
                    label: 'Green Alpha 10.0.1',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: '#4ac12c94',
                    borderColor: '#3ab54a',
                    borderWidth: 2
                },
                {
                    fill: 'origin',
                    label: 'NASDAQ',
                    data: [-12, -19, -3, -5, -2, -3],
                    backgroundColor: '#00000066',
                    borderColor: '#7a7a7a',
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: 'rgb(255, 99, 132)'
                        }
                    }
                }
            }
        });

        $('#chartType').on('select2:select', function (e) {
            var typeChart = e.params.data.id;
            changeChartType(typeChart)
        });
        function changeChartType(typeChart) {
            switch (typeChart) {
                case 'bar':
                    myChart.config.type = 'bar';
                    myChart.data.datasets = [{
                        fill: false,
                        label: 'Green Alpha 10.0.1',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            '#3ab54a',
                            '#3ab54a',
                            '#3ab54a',
                            '#3ab54a',
                            '#3ab54a',
                            '#3ab54a'
                        ],
                        borderColor: [
                            '#3ab54a'
                        ],
                        borderWidth: 2
                    },
                    {
                        fill: false,
                        label: 'NASDAQ',
                        data: [-12, -19, -3, -5, -2, -3],
                        backgroundColor: [
                            '#7a7a7a',
                            '#7a7a7a',
                            '#7a7a7a',
                            '#7a7a7a',
                            '#7a7a7a',
                            '#7a7a7a'
                        ],
                        borderColor: [
                            '#7a7a7a'
                        ],
                        borderWidth: 2
                    }]
                    break;
                case 'area':
                    myChart.config.type = 'line';
                    myChart.data.datasets = [{
                        fill: true,
                        label: 'Green Alpha 10.0.1',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: '#4ac12c94',
                        borderColor: '#3ab54a',
                        borderWidth: 2
                    },
                    {
                        fill: true,
                        label: 'NASDAQ',
                        data: [-12, -19, -3, -5, -2, -3],
                        backgroundColor: '#00000066',
                        borderColor: '#7a7a7a',
                        borderWidth: 2
                    }]
                    break;
                default:
                    myChart.config.type = 'line';
                    myChart.data.datasets = [{
                        fill: false,
                        label: 'Green Alpha 10.0.1',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            '#3ab54a',
                            '#3ab54a',
                            '#3ab54a',
                            '#3ab54a',
                            '#3ab54a',
                            '#3ab54a'
                        ],
                        borderColor: [
                            '#3ab54a'
                        ],
                        borderWidth: 2
                    },
                    {
                        fill: false,
                        label: 'NASDAQ',
                        data: [-12, -19, -3, -5, -2, -3],
                        backgroundColor: [
                            '#7a7a7a',
                            '#7a7a7a',
                            '#7a7a7a',
                            '#7a7a7a',
                            '#7a7a7a',
                            '#7a7a7a'
                        ],
                        borderColor: [
                            '#7a7a7a'
                        ],
                        borderWidth: 2
                    }]
                    break;
            }
            myChart.update();
        }
    </script>
</body>

</html>
