<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <!-- Bootstrap CSS -->


    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- DataTables Responsive CSS -->


    <link rel="stylesheet" href="{{asset('plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <style>
        #contentDiv{
            overflow: hidden;
        }
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
            overflow- x: hidden !important;
        }

        td {
            text-align: center !important;
        }

        tbody>tr:hover {
            cursor: pointer;
            background-color: #f5f5f5;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transform: scale(1.01);
        }

        .custom-tooltip {
            position: absolute;
            background-color: #fff;
            color: #333;
            padding: 0.5em;
            border-radius: 5px;
            font-size: 1.3em;
            display: none;
            z-index: 1000;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
        }

        .full-width-container {
            width: 100%;
            margin: 0;
            padding: 0;
        }

        .top-stock-table td {
            font-size: 1.1em;
            font-weight: bold;

            text-align: center;

        }

        .top-stock-table td:first-child {
            background-color: #148e46;
        }

        .top-stock-table td:nth-child(2) {
            background-color: #43ac4d;
        }

        .top-stock-table td:nth-child(3) {
            background-color: #70b852;
        }

        .top-stock-table td:nth-child(4) {
            background-color: #8ec784;
        }

        .top-stock-table td:nth-child(5) {
            background-color: #bce8cb;
        }

        .center_flex {
            display: inline-grid;
            justify-content: center;
            align-items: center;
        }

        .chart_column {
            display: flex;
            justify-content: center;
            text-align: center;
            width: 100px;
            align-items: center;
            color: white;
            font-weight: bold;
            padding: 5px 0 5px 0;
        }

        .container_layout {
            display: flex;
            flex-wrap: wrap;
        }

        .sidebar {
            max-width: 450px;
            flex: 1.5;
            /* Chiếm một phần nhỏ */

            /* Chiều rộng tối thiểu của sidebar */
            padding: 10px;
            text-align: center;

        }

        .sidebar_overview_cap>.cap {
            padding: 1rem;
            width: 100%;
        }
    .sidebar_overview_cap {
        flex: 2;
    }
    .sidebar_overview_chart {
        flex: 2;
    }
        .sidebar_overview {
            max-width: 1000px;
            flex: 1;
            /* Chiếm một phần nhỏ */

            /* Chiều rộng tối thiểu của sidebar */
            padding: 10px;
            text-align: center;
        }

        .main {
            flex: 4;
            /* Chiếm phần lớn ở giữa */
            min-width: 300px;
            /* Chiều rộng tối thiểu của main */
            padding: 10px;
            text-align: center;


        }



        /* Đảm bảo các block xếp dọc khi màn hình nhỏ hơn 768px */
        @media (max-width: 768px) {
            .container_layout {
                flex-direction: column;
                /* Xếp dọc các phần tử */
            }

            .sidebar {
                padding-bottom: 2rem;
                max-width: inherit;
                order: 1;
                /* Sidebar 1 ở vị trí đầu */
            }

            .container_layout .main {
                order: 3;
                /* Đặt cột chính ở vị trí cuối cùng */
            }

            .center_flex {
                padding-bottom: 5rem;
            }

        }

        @media (min-width: 768px) and (max-width: 1680px) {
            .center_box {
            align-items: center;
            justify-content: center;
            display: flex;
        }
            .container_layout {
                flex-direction: row;
                /* Xếp ngang các phần tử */
            }


            .sidebar_overview_cap>.cap {
                padding: 1rem;
                width: 100%;
            }

            .sidebar {

                max-width: inherit;
                width: 50%;
                /* Cả hai sidebar sẽ chiếm 50% chiều rộng */
            }


            .container_layout .main {
                flex-basis: 100%;
                /* Main cũng chiếm 100% chiều rộng */
                order: 3;
                /* Đặt main ở vị trí cuối cùng */
                /* Đặt cột chính ở vị trí cuối cùng */
            }
        }
        .container_flex {
    display: flex;
    flex-wrap: wrap; /* Cho phép các cột xuống dòng nếu không đủ chỗ */
    justify-content: space-between; /* Khoảng cách giữa các cột */
    padding: 20px;
}
#current_month{
    height: 700px !important;
}
.column {
    flex: 1; /* Mỗi cột chiếm cùng một phần không gian */
    margin: 10px;
    padding: 20px;
    background-color: #f4f4f4;
    border: 1px solid #ccc;
    border-radius: 5px;
    min-width: 300px; /* Chiều rộng tối thiểu của mỗi cột */
}
.chart-container {
        position: relative;
        height: 700px !important;
        width: 100%;
    }

    @media (max-width: 768px) {
        .chart-container {
            height: 80vh;
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
            <div class="carousel-item active" style="background-image: url({{url('images/banner_greenstock.jpg')}})">
            </div>
        </div>
    </div>


    <section id="contentDiv" class="text-left">
        <div class="full-width-container">
            <h5 class="color-home" style="text-align:right">
                <i>{{ (new DateTime('now', new DateTimeZone('GMT')))->format('Y-m-d H:i:s') }} GMT</i>
            </h5>
            <div class="col-md-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a style="font-weight:bold; font-size:1.2em" class="nav-link active" id="rating-tab"
                            data-toggle="tab" href="#rating" role="tab" aria-controls="rating"
                            aria-selected="true">STOCK RATING</a>
                    </li>
                    <li class="nav-item">
                        <a style="font-weight:bold; font-size:1.2em" class="nav-link" id="overview-tab"
                            data-toggle="tab" href="#overview" role="tab" aria-controls="overview"
                            aria-selected="false">MARKET OVERVIEW</a>
                    </li>

                </ul>
                <!-- Tab panes -->
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="rating" role="tabpanel" aria-labelledby="rating-tab">
                        <div class="container_layout">
                            <div class="sidebar sidebar_1">
                                <img src="{{url('images/bull_bear.jpg')}}" alt="Stock Rating" style="width:80%">
                                <div class="mb-4 center_flex">
                                    <canvas id="pieChart" width="400"></canvas>
                                    <canvas class="mt-5" id="maChart" width="450" height="350"></canvas>
                                </div>
                            </div>

                            <div class="main">
                                <table class="table table-striped table-bordered" style="margin-bottom: 0px;"
                                    id="indices-table">
                                </table>
                            </div>
                            <div class="sidebar mt-2">
                                <h5 style="text-align:center;padding:10px" class="color-home">My Watchlist</h5>
                                <table class="table table-striped table-bordered" style="margin-bottom: 0px;">
                                    <thead>
                                        <th>No</th>
                                        <th>Chứng Khoán</th>
                                        <th>Gvn-Rating</th>

                                        <th>Giá mua/bán</th>
                                        <th>Giá hiện tại</th>
                                    </thead>
                                    <tbody>
                                        @foreach($top_stock as $key => $stock)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $stock->code }}</td>
                                                <td>{{ $stock->rating }}</td>

                                                <td>{{ $stock->price }}</td>
                                                <td>{{ $stock->current_price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <h5 class="mt-5 color-home" style="text-align:center;padding:10px">Top 5 Stock</h5>
                                <table class="table table-striped table-bordered top-stock-table mb-3"
                                    style="margin-bottom: 0px;">
                                    <tr>
                                        <td>1</td>
                                        <td>2</td>
                                        <td>3</td>
                                        <td>4</td>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        @foreach($top_stock as $key => $stock)
                                            <td style="font-weight:bold">{{ $stock->code }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        @foreach($top_stock as $key => $stock)
                                            <td style="color:white;font-weight:bold">{{ $stock->profit }}%</td>
                                        @endforeach
                                    </tr>
                                </table>
                                <div class="col-md-12 text-center mt-5">
                                    <h5 style="text-align:center;padding:10px" class="color-home">Best Top 10</h5>
                                    <div class="mb-3">
                                        <canvas id="groupStock" height="450"></canvas>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="overview" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="container_layout">
                            <div class="sidebar sidebar_1">
                                <table style="width:100%" class="table table-striped table-bordered"
                                    id="market_cap">
                                    <thead>
                                        <tr id="code_header">
                                            <th colspan="2" style="text-align:center" class="code_header">Tăng/Giảm
                                                theo nhóm vốn hóa</th>
                                        </tr>
                                        <tr>
                                            <th>Nhóm</th>
                                            <th>Trung bình ngày</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>

                            </div>
                            <div class="main">
                                    <h5 style="text-align:center;padding:10px" class="color-home">Phân Nhóm</h5>
                                    <div class="chart-container">
                                        <canvas id="current_month"></canvas>
                                    </div>

                                </div>
                            <div class="sidebar center_box">
                                <canvas class="mt-1" id="capChart" width="490" height="300"></canvas>
                            </div>
                        </div>
                        <div class="">
                            <table class="table table-striped table-bordered" style="margin-bottom: 0px; width:100%"
                                id="top_stock">
                            </table>
                            <div class="container_flex">
                                <div class="column column-left">
                                <canvas class="mt-5" id="avg_cap" height="400"></canvas>
                                </div>
                                <div class="column column-right">
                                <canvas class="mt-5" id="group_ma" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <canvas class="mt-5" id="current_cap" ></canvas>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
    <style>

    </style>
    <section class="text-center mt-5">
        @include('front.common.footer')
    </section>
    <!-- Footer -->



</body>

</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"
    integrity="sha512-U6K1YLIFUWcvuw5ucmMtT9HH4t0uz3M366qrF5y4vnyH6dgDzndlcGvH/Lz5k8NFh80SN95aJ5rqGZEdaQZ7ZQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>


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
    var isCall = false;
    $(document).ready(function () {
        var ctx = document.getElementById('pieChart').getContext('2d');

        var myPieChart = new Chart(ctx, {
            type: 'pie', // Kiểu biểu đồ là 'pie' (tròn)
            data: {
                labels: @json($labels),
                datasets: [{
                    data: @json($chart_signal), // Dữ liệu cho từng phần của biểu đồ
                    backgroundColor: [
                        'rgb(102, 167, 76)',
                        'rgb(254, 228, 157)',
                        'rgb(147, 196, 128)',
                        'rgb(255, 0, 0)'
                    ],

                    borderWidth: 1
                }]
            },
            options: {
                responsive: false,
                plugins: {
                    datalabels: {
                        display: true, // Hiển thị giá trị

                        formatter: function (value, context) {
                            return value + '%';
                        },
                        labels: {
                            value: {
                                color: 'white'
                            }
                        }
                    },

                }

            }, plugins: [ChartDataLabels]
        });
        var indices = $('#indices-table').DataTable({
            searching: false,
            lengthChange: false, //
            responsive: true,
            paging: false,
            autoWidth: true,
            info: false,
            order: [[0, 'asc']],
            data: @json($signals),
            columns: [
                { data: 'rating', title: 'RATING' },  // Apply bold formatting to the "PriceTrend" column data},
                { data: 'code', title: 'CHỨNG KHOÁN' },
                { data: 'point', title: 'RATING POINT' },
                { data: 'trending', title: 'XU HƯỚNG' },
                { data: 'signal', title: 'HÀNH ĐỘNG' },
                { data: 'profit', title: 'PROFIT' },
                { data: 'post_sale_discount', title: 'GIẢM SAU BÁN' },
                { data: 'price', title: 'PRICE' },
                { data: 'time', title: 'THỜI GIAN' },
            ],
            columnDefs: [
                {
                    targets: 0, // Index of the date column
                    createdCell: function (td, cellData, rowData, row, col) {
                        color = '';
                        bold = '';
                        if (cellData <= 30) {
                            color = '#7eb18f';
                            bold = 'bold';
                        }
                        $(td).css('color', color);
                        $(td).css('font-weight', bold);
                    },
                },
                {
                    targets: 1, // Index of the date column
                    createdCell: function (td, cellData, rowData, row, col) {
                        $(td).css('font-weight', 'bold');
                        var company = rowData.company_name;

                        $(td).hover(
                            function () {
                                $(this).addClass('row-hover');
                                // Show custom tooltip
                                $('<div class="custom-tooltip">' + company + '</div>').appendTo('body').fadeIn('slow');
                            },
                            function () {
                                $(this).removeClass('row-hover');
                                // Hide custom tooltip
                                $('.custom-tooltip').remove();
                            }
                        ).mousemove(function (e) {
                            // Move tooltip with mouse
                            $('.custom-tooltip').css({
                                top: e.pageY + 15 + 'px',
                                left: e.pageX + 20 + 'px'
                            });
                        });
                    },
                },
                {
                    targets: 3, // Index of the date column
                    createdCell: function (td, cellData, rowData, row, col) {
                        trending = '';
                        color = '';
                        if (rowData.trending != null) {
                            trending = rowData.trending.trim().toLowerCase();
                        }
                        if (trending == 'breaking high price') {
                            color = '#917dc4';
                        } else if (trending == 'build up') {
                            color = '#fde69c';
                        } else if (trending == 'go up') {
                            color = '#badfcd';
                        } else if (trending == 'bottom fishing') {
                            color = '#03feff'
                        } else if (trending == 'go down') {
                            color = '#e99a97';
                        } else if (trending == 'recovery') {
                            color = '#fe9a3c';
                        } else if (trending == 'breaking low price') {
                            color = '#cc0611';
                        }
                        $(td).css('background-color', color);
                        $(td).css('box-shadow', 'none');
                    }
                },
                {
                    targets: 4, // Index of the date column
                    createdCell: function (td, cellData, rowData, row, col) {
                        signal = '';
                        color = '';
                        if (cellData != null) {
                            signal = cellData.trim().toLowerCase();
                        }
                        if (signal == 'buy') {
                            color = '#66a74c';
                        } else if (signal == 'hold') {
                            color = '#93c480';
                        } else if (signal == 'cash') {
                            color = '#fee49d';
                        } else if (signal == 'sell') {
                            color = 'rgb(227, 123, 113)'
                        }
                        $(td).css('background-color', color);
                        $(td).css('box-shadow', 'none');
                    }
                },
                {
                    targets: 5, // Index of the date column
                    createdCell: function (td, cellData, rowData, row, col) {
                        color = '';
                        if (cellData > 0) {
                            color = '#b8dfcd';
                        } else if (cellData < 0) {
                            color = '#e37b71';
                        }
                        $(td).css('background-color', color);
                        $(td).css('box-shadow', 'none');
                    },
                    render: function (data, type, full, meta) {
                        return `${data}%`;
                    }
                },
                {
                    targets: 6, // Index of the date column
                    createdCell: function (td, cellData, rowData, row, col) {
                        color = '';
                        if (cellData > 0) {
                            color = '#b8dfcd';
                        } else if (cellData < 0) {
                            color = '#e37b71';
                        }
                        $(td).css('color', color);
                        $(td).css('box-shadow', 'none');
                    },
                    render: function (data, type, full, meta) {
                        if (data != null) {
                            return `${data}%`;
                        }
                        return '';
                    },

                },
                {
                    targets: 8, // Index of the open_time column
                    render: function (data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            return moment.utc(data).format('DD/MM/YYYY'); // Format as HH:mm
                        }
                        return data;
                    }
                },
            ],
            createdRow: function (row, data, dataIndex) {
                if (data.code == 'NAS100') {
                    $(row).css('background-color', 'palegreen');
                }
            }


        });
        indices.columns.adjust().responsive.recalc();
        var barGroupctx = document.getElementById('groupStock').getContext('2d');
        var labelCount = @json($chart_group_data['labels']).length;
        barGroup = new Chart(barGroupctx, {
            type: 'bar',
            data: {
                labels: @json($chart_group_data['labels']),
                datasets: [{
                    label: '',
                    data: @json($chart_group_data['rate']),
                    backgroundColor: '#34a853',
                    fontweight: 600,
                    barThickness: 20,
                }]
            },
            options: {
                indexAxis: 'y', // Chuyển sang biểu đồ cột ngang
                maintainAspectRatio: false, // Cho phép tùy chỉnh tỷ lệ
                lenged: {
                    display: true
                },
                plugins: {
                    datalabels: {
                        display: true, // Hiển thị giá trị

                        formatter: function (value, context) {
                            return value + '%';
                        },
                        labels: {
                            value: {
                                color: 'white'
                            }
                        }
                    },
                    legend: {
                        labels: {
                            generateLabels: function (chart) {
                                return []; // Return an empty array to hide all labels
                            }
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
        const ctxMaChart = document.getElementById('maChart').getContext('2d');
        const maChart = new Chart(ctxMaChart, {
            type: 'bar',
            data: {
                labels: ['MA50', 'MA200'],

                datasets: [{
                    label: 'DOWN',
                    data: @json($ma['down']),
                    backgroundColor: 'Red',
                    borderColor: 'rgba(255, 99, 132, 0)', // Ẩn border bằng cách đặt alpha = 0
                    borderWidth: 0 // Đặt borderWidth thành 0 để ẩn hoàn toàn đường viền
                },
                {
                    label: 'Up',
                    data: @json($ma['up']),
                    backgroundColor: 'Green',
                    borderColor: 'rgba(255, 99, 132, 0)', // Ẩn border bằng cách đặt alpha = 0
                    borderWidth: 0 // Đặt borderWidth thành 0 để ẩn hoàn toàn đường viền
                }]
            },

            options: {
                plugins: {
                    legend: {
                        display: true
                    },
                    datalabels: {
                        display: true, // Hiển thị giá trị
                        formatter: function (value, context) {
                            return value + '%';
                        },
                        labels: {
                            value: {
                                color: 'white'
                            }
                        }
                    },
                },
                scales: {
                    x: {
                        stacked: true, // Enable stacking for X axis
                        ticks: {
                            color: 'green', // Màu sắc của nhãn trục X
                            font: {
                                size: 14, // Kích thước phông chữ của nhãn trục X

                                weight: 'bold'
                            }
                        },
                        barPercentage: 0.5, // Giảm giá trị này để tăng khoảng cách giữa các cột
                        categoryPercentage: 0.5 // Giảm giá trị này để tăng khoảng
                    },
                    y: {
                        display: false, // Ẩn trục Y
                        beginAtZero: true,
                        stacked: true // Enable stacking for Y axis
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    });
    $(document).on('click', '#overview-tab', function () {
        if(isCall == true) return;
        var index_up =0;
        var index_down = 0;
        const endColorDown = "rgb(255, 0, 0)"; // Red
        const startColorDown = "rgb(255, 255, 0)"; // Yellow
        const steps = 5;
        const rangeDown = generateGradient(startColorDown, endColorDown, steps);
        const startColorUp = "rgb(5, 100, 40)"; // Red
        const endColorUp = "rgb(8, 190, 75)"; // Yellow

        const rangeUp = generateGradient(startColorUp, endColorUp, steps);
        var url = '/api/get-market-greenstock';
        $.ajax({
            url: url,
            type: 'GET',
            success: function (data) {
                isCall =true;
                var result = data.data;
                var market_cap = $('#market_cap').DataTable({
                    searching: false,
                    lengthChange: false, //
                    responsive: true,
                    paging: false,
                    autoWidth: true,
                    info: false,
                    order: false,
                    data: result.market_cap,
                    columns: [
                        { data: 'group', title: 'NHÓM' },  // Apply bold formatting to the "PriceTrend" column data},
                        { data: 'avg_day', title: 'TRUNG BÌNH NGÀY' },
                    ],
                    //
                    columnDefs: [
                        {
                            targets: 0, // Index of the date column

                            createdCell: function (td, cellData, rowData, row, col) {
                                var color = 'aliceblue';
                                $(td).css('background-color', color);
                                $(td).css('font-weight', 'bold');
                            }
                        },
                        {
                            targets: 1, // Index of the date column
                            render: function (data, type, full, meta) {
                                return `${data}%`;
                            },
                            createdCell: function (td, cellData, rowData, row, col) {
                                var color = '';
                                if (cellData < 0) {
                                    color = rangeDown[row];
                                } else {
                                    color = rangeUp[row] // Green color for positive values
                                }
                                $(td).css('background-color', color);
                            }
                        },
                    ],
                });
                const ctxcapChart = document.getElementById('capChart').getContext('2d');
                const capChart = new Chart(ctxcapChart, {
                    type: 'bar',
                    data: {
                        labels: ['Tổng dòng tiền lời 5 phiên', 'Tổng dòng tiền lỗ 5 phiên'],
                        datasets: [{
                            data: result.cap,
                            label: 'Tổng dòng tiền',
                            backgroundColor: function (context) {
                                const value = context.dataset.data[context.dataIndex];
                                return value < 0 ? 'red' : 'green'; // Nếu giá trị < 0 thì màu đỏ, ngược lại màu xanh lá
                            },
                            borderColor: 'rgba(255, 99, 132, 0)', // Ẩn border bằng cách đặt alpha = 0
                            borderWidth: 0 // Đặt borderWidth thành 0 để ẩn hoàn toàn đường viền
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        responsive: false, //
                        plugins: {
                            datalabels: {
                                display: true, // Hiển thị giá trị
                                anchor: 'end',
                                align: 'end',
                                formatter: function (value, context) {
                                    return value;
                                },
                                labels: {
                                    value: {
                                        color: 'green',
                                        font: {
                                            weight: 'bold'
                                        }
                                    }
                                }
                            },

                        },
                        scales: {
                            x: {
                                ticks: {
                                    display: false,

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
                var current_monthctx = document.getElementById('current_month').getContext('2d');

                barCurentMonthGroup = new Chart(current_monthctx, {
                    type: 'bar',
                    barPercentage: 0.5,
                    barThickness:20,
                    categoryPercentage: 0.5,
                    data: {
                        labels: result.chart_group_data.current_month.labels,
                        datasets: [{
                            label: '',
                            data: result.chart_group_data.current_month.values,
                            backgroundColor: '#34a853',
                            fontweight: 600,
                            barThickness: 5,
                        }]
                    },
                    options: {
                        indexAxis: 'y', // Chuyển sang biểu đồ cột ngang
                        responsive: true, // Cho phép tùy chỉnh tỷ lệ
                        maintainAspectRatio: true, // Cho phép tùy chỉnh tỷ lệ
                        lenged: {
                            display: true
                        },
                        plugins: {
                            datalabels: {
                                display: true, // Hiển thị giá trị
                                anchor: function (context) {
                                    const value = context.dataset.data[context.dataIndex];
                                    return value > 0 ? 'end' : 'start'; // Nếu giá trị > 0, đặt ở cuối cột, ngược lại đặt ở đầu cột
                                },
                                align: function (context) {
                                    const value = context.dataset.data[context.dataIndex];
                                    return value > 0 ? 'end' : 'start'; // Nếu giá trị > 0, căn chỉnh với cuối cột, ngược lại căn chỉnh với đầu cột
                                },
                                formatter: function (value, context) {
                                    return value + '%';
                                },
                                labels: {
                                    value: {
                                        color: 'green'
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                ticks: {
                                    display: true,

                                    font: {
                                        size: calculateFontSize()  // Kích thước font của nhãn trục y
                                    }
                                }
                            }
                        }
                    },
                    plugins: [ChartDataLabels]
                });

                var top_stock = $('#top_stock').DataTable({
                    searching: false,
                    lengthChange: false, //
                    responsive: true,
                    paging: false,
                    autoWidth: true,
                    info: false,
                    order: [[0, 'asc']],
                    data: result.top_stock,
                    columns: [
                        { data: 'rating', title: 'RATING' },  // Apply bold formatting to the "PriceTrend" column data},
                        { data: 'code', title: 'CHỨNG KHOÁN' },
                        { data: 'point', title: 'RATING POINT' },
                        { data: 'trending', title: 'XU HƯỚNG' },
                        { data: 'signal', title: 'HÀNH ĐỘNG' },
                        { data: 'profit', title: 'PROFIT' },
                        { data: 'price', title: 'PRICE' },
                        { data: 'time', title: 'THỜI GIAN' },
                    ],
                    columnDefs: [
                        {
                            targets: 0, // Index of the date column
                            createdCell: function (td, cellData, rowData, row, col) {
                                color = '';
                                bold = '';
                                if (cellData <= 30) {
                                    color = '#7eb18f';
                                    bold = 'bold';
                                }
                                $(td).css('color', color);
                                $(td).css('font-weight', bold);
                            },
                        },
                        {
                            targets: 1, // Index of the date column
                            createdCell: function (td, cellData, rowData, row, col) {
                                $(td).css('font-weight', 'bold');
                                var company = rowData.company_name;

                                $(td).hover(
                                    function () {
                                        $(this).addClass('row-hover');
                                        // Show custom tooltip
                                        $('<div class="custom-tooltip">' + company + '</div>').appendTo('body').fadeIn('slow');
                                    },
                                    function () {
                                        $(this).removeClass('row-hover');
                                        $('.custom-tooltip').remove();
                                    }
                                ).mousemove(function (e) {
                                    $('.custom-tooltip').css({
                                        top: e.pageY + 15 + 'px',
                                        left: e.pageX + 20 + 'px'
                                    });
                                });
                            },
                            render: function (data, type, full, meta) {
                                if (data == 'fas fa-lock') {
                                    return '<i style="color:green" class="fas fa-lock"></i>';
                                }

                                return data; //

                            }
                        },
                        {
                            targets: 3, // Index of the date column
                            createdCell: function (td, cellData, rowData, row, col) {
                                trending = '';
                                color = '';
                                if (rowData.trending != null) {
                                    trending = rowData.trending.trim().toLowerCase();
                                }
                                if (trending == 'breaking high price') {
                                    color = '#917dc4';
                                } else if (trending == 'build up') {
                                    color = '#fde69c';
                                } else if (trending == 'go up') {
                                    color = '#badfcd';
                                } else if (trending == 'bottom fishing') {
                                    color = '#03feff'
                                } else if (trending == 'go down') {
                                    color = '#e99a97';
                                } else if (trending == 'recovery') {
                                    color = '#fe9a3c';
                                } else if (trending == 'breaking low price') {
                                    color = '#cc0611';
                                }
                                $(td).css('background-color', color);
                                $(td).css('box-shadow', 'none');
                            }
                        },
                        {
                            targets: 4, // Index of the date column
                            createdCell: function (td, cellData, rowData, row, col) {
                                signal = '';
                                color = '';
                                if (cellData != null) {
                                    signal = cellData.trim().toLowerCase();
                                }
                                if (signal == 'buy') {
                                    color = '#66a74c';
                                } else if (signal == 'hold') {
                                    color = '#93c480';
                                } else if (signal == 'cash') {
                                    color = '#fee49d';
                                } else if (signal == 'sell') {
                                    color = '#ffffff'
                                }
                                $(td).css('background-color', color);
                                $(td).css('box-shadow', 'none');
                            }
                        },
                        {
                            targets: 5, // Index of the date column
                            createdCell: function (td, cellData, rowData, row, col) {
                                color = '';
                                if (cellData > 0) {
                                    color = '#b8dfcd';
                                } else if (cellData < 0) {
                                    color = '#e37b71';
                                }
                                $(td).css('background-color', color);
                                $(td).css('box-shadow', 'none');
                            },
                            render: function (data, type, full, meta) {
                                return `${data}%`;
                            }
                        },

                        {
                            targets: 7, // Index of the open_time column
                            render: function (data, type, row) {
                                if (type === 'display' || type === 'filter') {
                                    return moment.utc(data).format('DD/MM/YYYY'); // Format as HH:mm
                                }
                                return data;
                            }
                        },
                    ],


                });
                top_stock.columns.adjust().responsive.recalc();
                // top_stock
                var ctxavg_cap = document.getElementById('avg_cap').getContext('2d');
                avg_capBar = new Chart(ctxavg_cap, {
                    type: 'bar',
                    data: {
                        labels: result.chart_group_data.avg_cap.labels,
                        datasets: [{
                            data: result.chart_group_data.avg_cap.values,
                            label: '',
                            backgroundColor: '#34a853',
                            borderWidth: 1,
                            fontweight: 600,
                        }]
                    },
                    options: {
                        plugins: {
                            datalabels: {
                                display: false, // Hiển thị giá trị
                                anchor: 'end',
                                align: 'end',
                                formatter: function (value, context) {
                                    return value + '%';
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
                                },
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
                var ctx_ma = document.getElementById('group_ma').getContext('2d');
                const chart = new Chart(ctx_ma, {
                    type: 'line',
                    data: {
                        labels: result.ma.labels,
                        datasets: [
                            {
                                label: 'Index',
                                data: result.ma.nas100_values,
                                borderColor: 'purple',
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                yAxisID: 'y',  // Gắn với trục y đầu tiên
                                color: 'white'
                            },
                            {
                                label: 'MA200',
                                data: result.ma.ma200_values,
                                borderColor: 'orange',
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                yAxisID: 'y1',  // Gắn với trục y thứ hai
                                color: 'white'
                            },
                            {
                                label: 'MA50',
                                data: result.ma.ma50_values,
                                borderColor: 'Green',
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                yAxisID: 'y1',  // Gắn với trục y thứ hai
                                color: 'white'
                            }
                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                type: 'linear',
                                position: 'left',  // Trục y đầu tiên ở bên trái
                                ticks: {
                                    stepSize: 100,
                                }
                            },
                            y1: {
                                type: 'linear',
                                position: 'right',  // Trục y thứ hai ở bên phải
                                ticks: {
                                    beginAtZero: false
                                },
                                grid: {
                                    drawOnChartArea: false, // Loại bỏ các đường kẻ ngang từ trục y1 để tránh lẫn với y
                                }
                            }
                        }
                    }
                });

                var ctx_current_cap = document.getElementById('current_cap').getContext('2d');
                const current_cap = new Chart(ctx_current_cap, {
                    type: 'line',
                    data: {
                        labels: result.current_cap.labels,
                        datasets: result.current_cap.data.map((item, index) => {
                            return {
                                label: result.current_cap.groupNames[index],
                                data: item,
                                fill: true,
                                borderWidth:0,
                                pointRadius: 0,        // Loại bỏ các điểm trên đường
                                pointHoverRadius: 0,   // Loại bỏ các điểm khi hover
                            };
                        })
                    },
                    options: {
                        responsive: true,
            scales: {
                y: {
                    type: 'linear',
                    position: 'left',
                    stacked: true,
                    min: 0,
                    max:100,
                    beginAtZero: true
                }

            },
            plugins: {
                legend: {
                    display: true,
                    position: 'right',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return `${tooltipItem.dataset.label}: ${tooltipItem.raw}`;
                        }
                    }
                }
            }
                    }
                });
            }
        });
    });
//     // current_cap
    function calculateFontSize() {
        const screenWidth = window.innerWidth;

        if (screenWidth < 1200) {
            return 8;
        }
        return 12;
    }
    function generateGradient(startColor, endColor, steps) {
    // Parse the RGB values from the start and end colors
        const startRGB = startColor.match(/\d+/g).map(Number);
        const endRGB = endColor.match(/\d+/g).map(Number);

        const gradient = [];
        for (let i = 0; i <= steps; i++) {
            const r = Math.round(startRGB[0] + (i * (endRGB[0] - startRGB[0]) / steps));
            const g = Math.round(startRGB[1] + (i * (endRGB[1] - startRGB[1]) / steps));
            const b = Math.round(startRGB[2] + (i * (endRGB[2] - startRGB[2]) / steps));
            gradient.push(`rgb(${r}, ${g}, ${b})`);
        }

        return gradient;
    }

</script>
