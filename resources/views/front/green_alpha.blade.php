<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-09NXCQGTBV"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'G-09NXCQGTBV');
    </script>
    <!-- End Google Tag Manager -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Alpha</title>
    <!-- Bootstrap CSS -->


    <!-- DataTables Responsive CSS -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{asset('plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.0.1/css/fixedColumns.dataTables.min.css">

    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <style>
        /* Định nghĩa animation chớp nháy */
        @keyframes blink {

            0%,
            90% {
                opacity: 1;
                /* Phần tử hiển thị trong phần lớn thời gian */
                color: black;
                background: #ffd966;
            }

            95%,
            100% {
                opacity: 0;
                /* Chớp nháy nhanh trong khoảng thời gian ngắn */
                background-color: #ffd966;
            }
        }

        /* Tạo lớp với animation */
        .blink-effect {
            animation: blink 5s infinite;
            /* Hiệu ứng chớp nháy, lặp lại mãi mãi */
        }

        .blink-box {
            color: black;

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
            <div class="sc-9qme4p-0 hELAUe"><button class="decription_telegram"><span
                        class="sc-1ee9gtf-2 bxZLwE">{{__('front_end.chat_with_me')}}</span></button></div>
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
        " onmouseover="this.style.backgroundColor='#33a853';" onmouseout="this.style.backgroundColor='#198754';">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/8/82/Telegram_logo.svg" alt="Telegram"
                        style="width: 30px; height: 30px;">
                </button>
            </a>
        </div>
    @endauth
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K38F4SGX" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!-- Navigation Bar -->
    <!-- green-beta-slider.jpg -->
    @include('front.common.header')

    <!-- Hero Section -->

    <!-- Hero Section with Slider -->
    <div id="heroCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" style="background-image: url({{url('images/green-alpha-banner.jpg')}})">
            </div>
        </div>
    </div>
    <section id="contentDiv" class="text-left">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <!-- Data and Chart Section -->
                    <div class="card" style="border:none">
                        <div class="card-body">
                            <div class="row">
                                <!-- Data Section -->
                                <div class="col-md-3 mt-3">
                                    <img width="100%" src="{{url('images/logo-robot-alpha.jpg')}}" alt="Logo" />
                                </div>
                                <!-- Chart Section -->
                                <div class="col-md-9" style="font-size:0.9rem !important; margin-top:4rem">

                                    <p>
                                        <span class="comment-div-left"
                                            style="font-size:1.4em">{!!__('front_end.description_green_alpha')!!}</span>
                                    </p>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>


    <!-- Features Section -->

    <section class="features text-left mt-3">
        <div class="container">

            <div class="row">
                <div class="ol-12 col-sm-12 col-md-12 col-lg-12">
                    <h2 class="text-center mb-4"><span
                            class="title-trading-first label-color color-home">{{__('front_end.SIGNAL_DASHBOARD')}}</span>
                    </h2>
                    <!-- Data and Chart Section -->
                    <h5 class="color-home" style="padding:15px; text-align: right;"> <i><span id="date"></span> <span
                                id="time"> </span> (UTC+3)</i></h5>
                    <div class="row">
                        <!-- Chart Section -->
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center form-group">

                            <div class="card">
                                <div class="card-body">
                                    <div class="col-md-12 text-center">
                                        <table class="table table-striped table-bordered display responsive nowrap"
                                            style="margin-bottom: 0px; width:100%" id="indices-table">
                                        </table>
                                    </div>

                                    <div class="row mt-4">

                                        <div class="col-md-4 text-left form-group">
                                            <ul style="padding-left:0">
                                                <li class="list-item">
                                                    <button class="takeprofitbuy width-120">BUY</button>
                                                    <span>{{__('front_end.trend_signal_buy_open')}}</span>
                                                </li>
                                                <li class="list-item">
                                                    <button class="cutlossbuy width-120">SELL</button>
                                                    <span>{{__('front_end.trend_signal_sell_open')}}</span>
                                                </li>


                                            </ul>
                                        </div>
                                        <div class="col-md-4 text-right form-group">
                                            <ul style="padding-left:0">

                                                <li class="list-item">
                                                    <button class="takeprofitbuy width-120">TakeProfitBUY/SELL</button>
                                                    <span>{{__('front_end.take_profit_BUY_SELL')}}</span>
                                                </li>
                                                <li class="list-item">
                                                    <button class="cutlossbuy width-120">CutLossBUY/SELL</button>
                                                    <span>{{__('front_end.cutLoss_BUY_SELL')}}</span>
                                                </li>
                                            </ul>

                                        </div>
                                        <div class="col-md-4 text-left form-group">
                                            <ul style="padding-left:0">
                                                <li class="list-item">
                                                    <button class="width-120"
                                                        style="background-color:#ffd966">HOLD</button>
                                                    <span>{{__('front_end.trend_signal_hold')}}</span>
                                                </li>

                                                <li class="list-item">
                                                    <button class="hold width-120">CLOSED</button>
                                                    <span>{{__('front_end.trend_signal_closed')}}</span>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="features text-left mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Data and Chart Section -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <!-- Chart Section -->
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center m-auto">
                                    <canvas id="myChart" style="width:100%" width="400" height="230"></canvas>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="features text-left mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center mb-4"><span
                            class="title-trading-first label-color color-home">{{__('front_end.HISTORICAL_PERFORMANCE')}}</span>

                    </h2>
                    <!-- Data and Chart Section -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center m-auto">
                                    <canvas id="myChartById" style="width:100%" width="400" height="230"></canvas>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <!-- Data Section -->
                                <div class="col-md-6 text-center">
                                    <table style="width:100%"
                                        class="table table-striped table-bordered display responsive nowrap"
                                        id="popupDataTable">
                                        <thead>
                                            <tr id="code_header">
                                                <th colspan="6" style="text-align:center" class="code_header"></th>
                                            </tr>
                                            <tr>
                                                <th>Signal</th>
                                                <th>Price Open</th>
                                                <th>Open Time</th>
                                                <th>Price Close</th>
                                                <th>Close Time</th>
                                                <th>Profit</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>

                                </div>
                                <!-- Chart Section -->
                                <div class="col-md-6 mt-3">
                                    <canvas id="lineChart" style="width:100%;max-height:490px" width="400"
                                        height="450"></canvas>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <!-- Modal -->

    <style>

    </style>
    <section class="text-center mt-5">
        @include('front.common.footer')
    </section>
    <!-- Footer -->



</body>

</html>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/4.0.1/js/dataTables.fixedColumns.min.js"></script>

<script
    src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0-rc/dist/chartjs-plugin-datalabels.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment-timezone@0.5.34/builds/moment-timezone-with-data.min.js"></script>
<style>
    .carousel-item {
        min-height: 300px;
        height: 300px;
        background: no-repeat center center scroll;
        background-size: cover;
    }
</style>
<script>
    $(document).ready(function () {

        let lineChart = null;
        let barChart = null;
        var data = @json($data_chart_default);
        data = data.data;
        isData = data.list.length;

        if (isData > 0) {
            var code = data.list[0].code;
            $('.code_header').text(code);
        }
        var popupDataTable = $('#popupDataTable').DataTable({
            destroy: true,
            data: data.list,
            searching: false,
            lengthChange: false,
            responsive: true,
            paging: false,
            info: false,
            scrollX: true, // Kích hoạt cuộn ngang
            fixedColumns: {
                leftColumns: 2 // Cố định cột đầu tiên (Tên sản phẩm)
            },
            scrollCollapse: true,
            autoWidth: false,
            scrollY: '400px',
            autoWidth: true,
            order: [[4, 'desc']],
            language: {
                emptyTable: "No data available"
            },
            columns: [
                { data: 'signal_open' },
                { data: 'price_open' },
                { data: 'open_time' },
                { data: 'price_close' },
                { data: 'close_time' },
                { data: 'profit' },
            ],
            columnDefs: [
                {
                    targets: 2, // Index of the open_time column
                    render: function (data, type, row) {

                        if (type === 'display' || type === 'filter') {
                            return moment.tz(data, 'Europe/Moscow').format('MM-DD-YYYY HH:mm'); // Format as HH:mm
                        }
                        return data;
                    }
                },
                {
                    targets: 1, // Index of the date column
                    render: function (data, type, full, meta) {

                        if (type === 'display') {
                            return parseFloat(data).toFixed(2);
                        }
                        return data; //

                    }
                },
                {
                    targets: 4, // Index of the open_time column
                    render: function (data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            return moment.tz(data, 'Europe/Moscow').format('MM-DD-YYYY HH:mm'); // Format as HH:mm
                        }
                        return data;
                    }
                },
                {
                    targets: 5, // Index of the date column
                    createdCell: function (td, cellData, rowData, row, col) {
                        if (cellData >= 0) {
                            color = '#b6d7a8';
                        } else {
                            color = '#e06666';
                        }
                        $(td).css('background-color', color);
                        $(td).css('box-shadow', 'none');
                    },
                    render: function (data, type, full, meta) {
                        return `${data}%`;
                    }
                },
            ],
            headerCallback: function (thead, data, start, end, display) {
                $(thead).find('th').css({
                    'text-align': 'center',
                    'font-size': 'small'
                });
            },
            // createdRow: function (row, data, dataIndex) {
            //     $('td', row).css('font-size', '0.95em');
            // }
        });
        popupDataTable.columns.adjust().draw();
        // $('#contentDiv').on('shown.bs.toggle', function () {
        //     popupDataTable.columns.adjust().responsive.recalc();

        // });
        if (lineChart) {
            // If it exists, destroy it before creating a new one
            lineChart.destroy();
        }
        var ctxlineAjax = document.getElementById('lineChart').getContext('2d');
        lineChart = new Chart(ctxlineAjax, {
            type: 'line',
            destroy: true,
            data: {
                labels: data.profit.map((value, index) => index),
                datasets: [{
                    label: 'Profit',
                    data: data.profit,
                    backgroundColor: '#34a853',
                    borderColor: 'green',
                    borderWidth: 0.5,
                    fill: true,

                }]
            },
            options: {
                responsive: true, // Make chart responsive
                scales: {
                    x: {
                        beginAtZero: true // Ẩn nhãn và đường biểu đồ của trục x
                    }
                },

            }

        });
        if (barChart) {
            // If it exists, destroy it before creating a new one
            barChart.destroy();
        }
        var ctx = document.getElementById('myChartById').getContext('2d');
        barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.profitByMonth.lable,
                datasets: [{
                    data: data.profitByMonth.profit,
                    label: 'Profit By Month',
                    backgroundColor: '#34a853',
                    borderWidth: 1,
                    fontweight: 600,
                }]
            },
            options: {
                plugins: {
                    datalabels: {
                        display: true, // Hiển thị giá trị
                        anchor: 'end',
                        align: 'end',
                        formatter: function (value, context) {
                            return window.innerWidth < 768 ? "" : value + '%';
                        },
                        labels: {
                            value: {
                                color: 'green',
                                font: {
                                    weight: 'bold'
                                }
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            font: {
                                weight: 'bold' // Makes x-axis labels bold
                            }
                        }
                    },
                    y: {
                        ticks: {
                            font: {
                                weight: 'bold' // Makes y-axis labels bold
                            }
                        }
                    }
                }

            },
            plugins: [ChartDataLabels]

        });
        $(document).on('click', '.dataTable tbody tr', function () {

            var dataId = $(this).data('id');
            if (dataId == undefined) {
                return;
            }

            $.ajax({
                url: '/api/get-history-alpha/' + dataId,
                type: 'GET',
                success: function (data) {
                    data = data.data;
                    isData = data.list.length;
                    if (isData > 0) {
                        var code = data.list[0].code;
                        $('.code_header').text(code);
                    }
                    var popupDataTable = $('#popupDataTable').DataTable({
                        destroy: true,
                        data: data.list,
                        searching: false,
                        lengthChange: false,
                        paging: false,
                        info: false,
                        scrollX: true, // Kích hoạt cuộn ngang
                        fixedColumns: {
                            leftColumns: 2 // Cố định cột đầu tiên (Tên sản phẩm)
                        },
                        scrollCollapse: true,
                        autoWidth: false,
                        scrollY: '400px',
                        columns: [
                            { data: 'signal_open' },
                            { data: 'price_open', title: 'Price Open' },
                            { data: 'open_time', title: 'Open Time' },
                            { data: 'price_close', title: 'Price Close' },
                            { data: 'close_time', title: 'Close Time' },
                            { data: 'profit', title: 'Profit' },
                        ],
                        order: [[4, 'desc']],
                        columnDefs: [
                            {
                                targets: 0, // Index of the 'code' column
                                createdCell: function (td, cellData, rowData, row, col) {
                                    $(td).css('font-weight', 'bold');

                                },
                            },
                            {
                                targets: 2, // Index of the open_time column
                                render: function (data, type, row) {
                                    if (type === 'display' || type === 'filter') {
                                        return moment.tz(data, 'Europe/Moscow').format('MM-DD-YYYY HH:mm'); // Format as HH:mm
                                    }
                                    return data;
                                }
                            },
                            {
                                targets: 4, // Index of the open_time column
                                render: function (data, type, row) {
                                    if (type === 'display' || type === 'filter') {
                                        return moment.tz(data, 'Europe/Moscow').format('MM-DD-YYYY HH:mm'); // Format as HH:mm
                                    }
                                    return data;
                                }
                            },
                            {
                                targets: 5, // Index of the date column
                                createdCell: function (td, cellData, rowData, row, col) {
                                    if (cellData >= 0) {
                                        color = '#b6d7a8';
                                    } else {
                                        color = '#e06666';
                                    }
                                    $(td).css('background-color', color);
                                    $(td).css('box-shadow', 'none');
                                },
                                render: function (data, type, full, meta) {
                                    return `${data}%`;
                                }
                            },
                        ],
                        headerCallback: function (thead, data, start, end, display) {
                            $(thead).find('th').css({
                                'text-align': 'center',
                                'font-size': 'small'
                            });
                        },
                        // createdRow: function (row, data, dataIndex) {
                        //     $('td', row).css('font-size', '0.95em');
                        // }
                    });
                    popupDataTable.columns.adjust().draw();
                    // $('#contentDiv').on('shown.bs.toggle', function () {
                    //     popupDataTable.columns.adjust().responsive.recalc();

                    // });
                    if (lineChart) {
                        // If it exists, destroy it before creating a new one
                        lineChart.destroy();
                    }
                    var ctxlineAjax = document.getElementById('lineChart').getContext('2d');
                    lineChart = new Chart(ctxlineAjax, {
                        type: 'line',
                        destroy: true,
                        data: {
                            labels: data.profit.map((value, index) => index),
                            datasets: [{
                                label: 'Profit',
                                data: data.profit,
                                backgroundColor: '#34a853',
                                borderColor: 'green',
                                borderWidth: 0.5,
                                fill: true,

                            }]
                        },
                        options: {
                            scales: {
                                x: {
                                    beginAtZero: true // Ẩn nhãn và đường biểu đồ của trục x
                                }
                            },

                        }

                    });
                    if (barChart) {
                        // If it exists, destroy it before creating a new one
                        barChart.destroy();
                    }
                    var ctx = document.getElementById('myChartById').getContext('2d');
                    barChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.profitByMonth.lable,
                            datasets: [{
                                data: data.profitByMonth.profit,
                                label: 'Profit By Month',
                                backgroundColor: '#34a853',
                                borderWidth: 1,
                                fontweight: 600,
                            }]
                        },
                        options: {
                            plugins: {
                                datalabels: {
                                    display: true, // Hiển thị giá trị
                                    anchor: 'end',
                                    align: 'end',
                                    formatter: function (value, context) {
                                        return window.innerWidth < 768 ? "" : value + '%';
                                    },
                                    labels: {
                                        value: {
                                            color: 'green',
                                            font: {
                                                weight: 'bold'
                                            }
                                        }
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    ticks: {
                                        font: {
                                            weight: 'bold' // Makes x-axis labels bold
                                        }
                                    }
                                },
                                y: {
                                    ticks: {
                                        font: {
                                            weight: 'bold' // Makes y-axis labels bold
                                        }
                                    }
                                }
                            }

                        },
                        plugins: [ChartDataLabels]

                    });
                    $('#dataTableModal').modal('show');
                },
                error: function (error) {


                }
            });

        });
        var indices = $('#indices-table').DataTable({
            searching: false,
            lengthChange: false, //
            paging: false,
            scrollX: true, // Kích hoạt cuộn ngang
            fixedColumns: {
                leftColumns: 2 // Cố định cột đầu tiên (Tên sản phẩm)
            },
            scrollCollapse: true,
            autoWidth: false,
            info: false,
            order: [[3, 'desc']],
            data: @json($signals),
            columns: [
                { data: 'code', title: 'Symbol' },
                { data: 'signal_open', title: 'Signal Open' },  // Apply bold formatting to the "PriceTrend" column data},
                { data: 'price_open', title: 'Price Open' },
                { data: 'open_time', title: 'Open Time' },
                { data: 'signal_close', title: 'Signal Close' },
                { data: 'price_close', title: 'Price Close' },
                { data: 'close_time', title: 'Close Time' },
                { data: 'profit', title: 'Profit' },
                { data: 'no_trading', title: 'No.Trading' },
                { data: 'profit_today', title: 'Profit Today' }

            ],
            columnDefs: [
                {
                    targets: 7, // Index of the date column
                    createdCell: function (td, cellData, rowData, row, col) {
                        if (cellData >= 0) {
                            color = '#008000';
                        } else {
                            color = '#e06666';
                        }
                        $(td).css('font-weight', 'bold');
                        $(td).css('color', color);
                    },
                    render: function (data, type, full, meta) {
                        if (data != '') {
                            return `${parseFloat(data).toFixed(2)}%`;
                        }
                        return '';
                    }
                },
                {
                    targets: 9, // Index of the date column
                    createdCell: function (td, cellData, rowData, row, col) {
                        if (cellData >= 0) {
                            color = '#008000';
                        } else {
                            color = '#e06666';
                        }
                        $(td).css('font-weight', 'bold');
                        $(td).css('color', color);
                    },
                    render: function (data, type, full, meta) {
                        if (data != '') {
                            return `${parseFloat(data).toFixed(2)}%`;
                        }
                        return '';
                    }
                },
                {
                    targets: 1, // Index of the date column
                    createdCell: function (td, cellData, rowData, row, col) {

                        if (cellData == '') return false;
                        signal = cellData.trim().toLowerCase();
                        if (rowData.close_time == '' || rowData.close_time == null) {
                            color = '#ffd966';
                            if (signal == 'buy') {
                                color = '#b6d7a8';
                            }
                            if (signal == 'sell') {
                                color = '#e06666';

                            }
                        } else {
                            color = '#ffd966';
                        }
                        $(td).css('background-color', color);
                        $(td).css('box-shadow', 'none');
                    },
                    render: function (data, type, full, meta) {
                        if (full.close_time != "") {
                            return 'CLOSED';
                        }
                        return data; //
                    }
                },
                {
                    targets: 4, // Index of the date column
                    render: function (data, type, full, meta) {
                        if (full.signal_close == "" && full.signal_open != "") {
                            return 'HOLD';
                        }
                        return data; //
                    },
                    createdCell: function (td, cellData, rowData, row, col) {
                        signal_close = ''
                        if (rowData.signal_close != null) {
                            signal_close = rowData.signal_close.trim().toLowerCase();
                        }
                        if (signal_close == 'takeprofitbuy' || signal_close == 'takeprofitsell') {
                            color = '#b6d7a8';
                        } else if (signal_close == 'cutlossbuy' || signal_close == 'cutlosssell') {
                            color = '#e06666';
                        } else {
                            color = '';
                        }
                        if (signal_close == "" && rowData.signal_open != "") {
                            color = '#ffd966';
                        }
                        $(td).css('background-color', color);

                    }
                },
                {
                    targets: 3, // Index of the open_time column
                    render: function (data, type, row) {
                        if (data == 'fas fa-lock') {
                            return '<i style="color:green" class="fas fa-lock"></i>';
                        }
                        if (data == null || data == '') return '';
                        if (type === 'display' || type === 'filter') {
                            return moment.tz(data, 'Europe/Moscow').format('HH:mm'); // Format as HH:mm
                        }
                        return data;
                    }
                },
                {
                    targets: 2, // Index of the date column
                    render: function (data, type, full, meta) {
                        if (data == "") return '';
                        if (data == 'fas fa-lock') {
                            return '<i style="color:green" class="fas fa-lock"></i>';
                        }
                        if (type === 'display') {
                            return parseFloat(data).toFixed(2);
                        }
                        return data; //

                    }
                },
                {
                    targets: 6, // Index of the open_time column
                    render: function (data, type, row) {
                        if (data == null || data == '') return '';
                        if (type === 'display' || type === 'filter') {
                            return moment.tz(data, 'Europe/Moscow').format('HH:mm'); // Format as HH:mm
                        }
                        return data;
                    }
                },
                {
                    targets: 0, // Index of the 'code' column
                    createdCell: function (td, cellData, rowData, row, col) {
                        $(td).css('text-align', 'left');
                        $(td).css('font-weight', 'bold');
                        $(td).css('padding-left', '0.5em');
                        $(td).css('width', 'auto');
                        $(td).css('padding-right', '0');
                        $(td).css('min-width', '95px');
                    },
                    render: function (data, type, row) {
                        return '<img src="images/logo/' + data + '.png" alt="Logo" style=" height:20px; max-width:27px;width:30px;; margin-right:0.8em"> ' + data; // Adjust the path and style as needed
                    }
                }
            ],
            headerCallback: function (thead, data, start, end, display) {
                $(thead).find('th').eq(7).css({
                    'padding': '.5em .5em'
                });
            },
            createdRow: function (row, data, dataIndex) {
                // Assuming 'code' is the property you want to use for data-id
                $(row).attr('data-id', data.id_code);
            }
        });
        // indices.columns.adjust().responsive.recalc();
        function highlightColumn(columnIndex) {
            // Add a class to all cells in the specified column

            var columnNodes = indices.column(4).nodes().to$();

            // Extract text content from each cell in the column
            var columnValues = columnNodes.map(function () {
                let value = $(this).text();
                if (value == "HOLD") {
                    $(this).addClass('blink-box blink-effect');
                }
                // or .html() if you want to get the HTML content
            }).get();  //
        }

        // Delay for 5 seconds, then highlight the 3rd column (index starts from 0)
        setTimeout(function () {
            highlightColumn(4);  // Highlight the third column (index 2)
        }, 5000); // 5000 milliseconds = 5 seconds

    });

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($dataChartProfit['lable']),
            datasets: [{
                data: @json($dataChartProfit['profitWeek']),
                label: 'Profit Week Current',
                backgroundColor: '#40f35c',
                borderWidth: 1,
                fontweight: 600,
            },
            {
                data: @json($dataChartProfit['profitMonth']),
                label: 'Profit Month Current',
                backgroundColor: '#34a853',
                borderWidth: 1,
                fontweight: 600,
            }]
        },
        options: {
            plugins: {
                datalabels: {
                    display: true, // Hiển thị giá trị
                    anchor: 'end',
                    align: 'end',
                    formatter: function (value, context) {
                        return window.innerWidth < 768 ? "" : value + '%';
                    },
                    labels: {
                        value: {
                            color: 'green'
                        }
                    }
                }
            },
            scales: getChartOptions(),

        },
        plugins: [ChartDataLabels]
    });
    function getChartOptions() {
        const isMobile = window.innerWidth < 768; // Check if the screen width is below 768px

        return {
            x: {
                ticks: {
                    display: !isMobile, // Hide x-axis labels on mobile
                    font: {
                        weight: 'bold' // Makes x-axis labels bold
                    }
                }
            },
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function (value) {
                        return value.toFixed(2) + '%'; // Thêm ký hiệu % vào các giá trị trên trục y
                    }
                }
            }

        };
    }
    $(document).ready(function () {
        function updateClock() {
            const now = new Date();
            // Lấy thời gian và ngày tháng theo múi giờ
            const dateOptions = { timeZone: 'Europe/Moscow', year: 'numeric', month: '2-digit', day: '2-digit' };
            const timeOptions = { timeZone: 'Europe/Moscow', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
            let dateString = now.toLocaleDateString('en-US', dateOptions).replace(/\//g, '-');
            let timeString = now.toLocaleTimeString('en-US', timeOptions);
            document.getElementById('date').textContent = dateString;
            document.getElementById('time').textContent = timeString;


        }

        setInterval(updateClock, 1000); // Cập nhật mỗi giây
        updateClock(); // Chạy ngay khi load trang
    });

</script>
