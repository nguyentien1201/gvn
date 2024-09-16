<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <!-- Bootstrap CSS -->


    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- DataTables Responsive CSS -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">

    <link rel="stylesheet" href="{{asset('plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <style>
        .color-home {
            color: #008000 !important;
        }

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

        .dt-scroll-head {
            width: 99% !important;
        }


        #popupDataTable>thead {
            display: none;
        }

        .dataTable {
            margin-bottom: 0 !important;
        }

        table thead {
            background-color: #008000;
            /* Change the background color */
            color: white;
            /* Change the text color */
        }

        .comment-div-left {
            margin-right: 10px;
            width: 50px;

            text-align: center;
        }

        .comment-div-right {
            margin-left: 10px;
            width: 100px;

            text-align: center;
        }

        .hold {
            background-color: #ffd966;
        }

        .takeprofitbuy {
            background-color: #b6d7a8;
        }

        .cutlossbuy {
            background-color: #e06666;
        }

        .list-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .list-item button {
            cursor: none;
            padding: 5px 10px;
            border: none;
            margin-right: 10px;
        }

        .width-120 {
            width: 120px;
        }

        th {
            text-align: center !important;
        }

        .table-responsive {
            overflow-x: scroll !important;
        }
        @media (max-width: 1268px) {
            body {
                font-size: x-small !important   ;
            },
            thead th , td {
                /* min-width:80px !important ; */
                /* font-size: xx-small; */
                }
        }
    </style>

</head>

<body>

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
                                    <h5 class="text-center" style="font-size:1.5em"><span
                                            class="title-trading-first label-color">Xin chào anh chị,</span></h5>
                                    <p>
                                        <span class="comment-div-left" style="font-size:1.4em"> Em tên là <b>Green Alpha
                                                - 9.5.8</b>, hãy để em tìm giúp anh chị xem có cơ hội nào để anh chị
                                            giao dịch kiếm lợi nhuận ngay trong ngày hôm nay không nhé. </span>
                                    </p>
                                    <p style="font-size:1.25em">
                                        <span><i>Người ta nói "Đồng tiền đi liền khúc ruột", nếu anh chị có đau ruột hôm
                                                nay thì đừng ngần ngại gửi ý kiến đến các sếp nhà GVN của em!</i>
                                        </span>
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
                    <h2 class="text-center mb-4"><span class="title-trading-first label-color color-home">SIGNAL
                            DASHBOARD</span>
                    </h2>
                    <!-- Data and Chart Section -->
                    <h3 class="color-home"> <i><span id="date"></span>  <span id="time"> GMT</span> </i></h3>
                    <div class="row">
                        <!-- Chart Section -->
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center form-group">

                            <div class="card">
                                <div class="card-body">

                                    <table class="table table-striped table-bordered" style="margin-bottom: 0px;"
                                        id="indices-table">
                                    </table>
                                    <div class="row mt-4">

                                        <div class="col-md-4 text-left form-group">
                                            <ul style="padding-left:0">
                                                <li class="list-item">
                                                    <button class="takeprofitbuy width-120">Buy</button>
                                                    <span>Tín hiệu vị thế Buy đang mở.</span>
                                                </li>
                                                <li class="list-item">
                                                    <button class="cutlossbuy width-120">Sell</button>
                                                    <span>Tín hiệu vị thế Sell đang mở.</span>
                                                </li>


                                            </ul>
                                        </div>
                                        <div class="col-md-4 text-right form-group">
                                            <ul style="padding-left:0">

                                                <li class="list-item">
                                                    <button class="takeprofitbuy width-120">TakeProfitBuy</button>
                                                    <span>Tín hiệu đã ở trạng thái chốt lời.</span>
                                                </li>
                                                <li class="list-item">
                                                    <button class="cutlossbuy width-120">CutLossBuy</button>
                                                    <span>Tín hiệu đã ở trạng thái cắt lỗ.</span>
                                                </li>
                                            </ul>

                                        </div>
                                        <div class="col-md-4 text-left form-group">
                                            <ul style="padding-left:0">
                                                <li class="list-item">
                                                    <button class="width-120">Hold</button>
                                                    <span>Tín hiệu đang ở trạng thái giữ.</span>
                                                </li>

                                                <li class="list-item">
                                                    <button class="hold width-120">Sell/Buy</button>
                                                    <span>Tín hiệu xu hướng đã đóng.</span>
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
                    <h2 class="text-center mb-4"><span class="title-trading-first label-color color-home">HISTORICAL
                            PERFORMANCE</span>

                    </h2>
                    <!-- Data and Chart Section -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center m-auto">
                                    <canvas id="myChartById" style="width:100%" width="400" height="230"></canvas>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Data Section -->
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table style="width:100%" class="table table-striped table-bordered"
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
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" rel="stylesheet">
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
<script src="
https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js
"></script>
<script
    src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0-rc/dist/chartjs-plugin-datalabels.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-2.0.8/date-1.5.2/fc-5.0.1/fh-4.0.1/r-3.0.2/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
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
            scrollX: false,
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
                            return moment.utc(data).format('YYYY-MM-DD HH:mm'); // Format as HH:mm
                        }
                        return data;
                    }
                },
                {
                    targets: 4, // Index of the open_time column
                    render: function (data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            return moment.utc(data).format('YYYY-MM-DD HH:mm'); // Format as HH:mm
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
            createdRow: function (row, data, dataIndex) {
                $('td', row).css('font-size', '0.95em');
            }
        });
        popupDataTable.columns.adjust().draw();
        $('#contentDiv').on('shown.bs.toggle', function () {
            popupDataTable.columns.adjust().responsive.recalc();

        });
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
                url: 'api/get-history-alpha/' + dataId,
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
                        responsive: true,
                        paging: false,
                        info: false,
                        scrollX: false,
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
                                        return moment.utc(data).format('YYYY-MM-DD HH:mm'); // Format as HH:mm
                                    }
                                    return data;
                                }
                            },
                            {
                                targets: 4, // Index of the open_time column
                                render: function (data, type, row) {
                                    if (type === 'display' || type === 'filter') {
                                        return moment.utc(data).format('YYYY-MM-DD HH:mm'); // Format as HH:mm
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
                        createdRow: function (row, data, dataIndex) {
                            $('td', row).css('font-size', '0.95em');
                        }
                    });
                    popupDataTable.columns.adjust().draw();
                    $('#contentDiv').on('shown.bs.toggle', function () {
                        popupDataTable.columns.adjust().responsive.recalc();

                    });
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
            responsive: true,
            paging: false,
            autoWidth: true,
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
                            color = '#b6d7a8';
                        } else {
                            color = '#e06666';
                        }
                        $(td).css('font-weight', 'bold');
                        $(td).css('color', color);
                    }
                },
                {
                    targets: 9, // Index of the date column
                    createdCell: function (td, cellData, rowData, row, col) {
                        if (cellData >= 0) {
                            color = '#b6d7a8';
                        } else {
                            color = '#e06666';
                        }
                        $(td).css('font-weight', 'bold');
                        $(td).css('color', color);
                    }
                },
                {
                    targets: 1, // Index of the date column
                    createdCell: function (td, cellData, rowData, row, col) {
                        signal = cellData.trim().toLowerCase();

                        if (cellData == '') return false;
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
                    }
                },
                {
                    targets: 4, // Index of the date column
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
                        $(td).css('background-color', color);

                    }
                },
                {
                    targets: 3, // Index of the open_time column
                    render: function (data, type, row) {
                        if (data == null || data == '') return '';
                        if (type === 'display' || type === 'filter') {
                            return moment.utc(data).format('HH:mm'); // Format as HH:mm
                        }
                        return data;
                    }
                },
                {
                    targets: 6, // Index of the open_time column
                    render: function (data, type, row) {
                        if (data == null || data == '') return '';
                        if (type === 'display' || type === 'filter') {
                            return moment.utc(data).format('HH:mm'); // Format as HH:mm
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
        indices.columns.adjust().responsive.recalc();


    });

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($dataChartProfit['lable']),
            datasets: [{
                data: @json($dataChartProfit['profitMonth']),
                label: 'Profit Month Current',
                backgroundColor: '#40f35c',
                borderWidth: 1,
                fontweight: 600,
            },
            {
                data: @json($dataChartProfit['profitYear']),
                label: 'Profit Year Current',
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
                                callback: function(value) {
                                    return value + '%'; // Thêm ký hiệu % vào các giá trị trên trục y
                                }
                            }
                        }

            };
        }

  function updateClock() {
    const now = new Date();

    // Lấy thời gian và ngày tháng theo múi giờ
    const dateOptions = { timeZone: 'GMT', year: 'numeric', month: '2-digit', day: '2-digit' };
    const timeOptions = { timeZone: 'GMT', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };

    const dateString = now.toLocaleDateString('en-GB', dateOptions);
    const timeString = now.toLocaleTimeString('en-GB', timeOptions);

    document.getElementById('date').textContent = dateString;
    document.getElementById('time').textContent = timeString;
}

setInterval(updateClock, 1000); // Cập nhật mỗi giây
document.getElementById('timezone').addEventListener('change', updateClock); // Cập nhật khi đổi múi giờ
updateClock(); // Chạy ngay khi load trang
</script>



 < tien> #000</tien>
