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
            justify-content:center;
            text-align: center;
            width:100px;
            align-items: center;
            color:white;
            font-weight: bold;
            padding: 5px 0 5px 0;
        }
        .container_layout {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px; /* Khoảng cách giữa các block */
        }

        .block {
            background-color: #f2f2f2;
            padding: 20px;
            text-align: center;
            border: 1px solid #ccc;
        }

        /* Đảm bảo các block xếp dọc khi màn hình nhỏ hơn 768px */
        @media (max-width: 768px) {
            .container_layout {
                grid-template-columns: 1fr; /* Chuyển thành 1 cột */
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
                <i>{{ (new DateTime('now', new DateTimeZone('GMT')))->format('Y-m-d H:i:s') }} GMT</i></h5>
            <div class="col-md-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a style="font-weight:bold; font-size:1.2em" class="nav-link active" id="rating-tab"
                            data-toggle="tab" href="#rating" role="tab" aria-controls="rating"
                            aria-selected="true">StockRating</a>
                    </li>
                    <li class="nav-item">
                        <a style="font-weight:bold; font-size:1.2em" class="nav-link" id="overview-tab"
                            data-toggle="tab" href="#overview" role="tab" aria-controls="overview"
                            aria-selected="false">Market Overview</a>
                    </li>

                </ul>
                <!-- Tab panes -->
                <div class="tab-content" id="myTabContent">
                    <div class=" tab-pane fade show active" id="rating" role="tabpanel" aria-labelledby="rating-tab">
                        <section id="contentDiv container_layout" class="text-left">
                            <div class="row">
                                <div class="col-md-4 center_flex">
                                    <img src="{{url('images/bull_bear.jpg')}}" alt="Stock Rating" style="width:100%">
                                    <div class="mb-4 center_flex">
                                        <canvas id="pieChart" width="300"></canvas>
                                        <div class="row mt-5">
                                            <div class="col-md-6 mt-4  justify-content-center align-items-center" style="height: 210px; max-height:200px;display:inline-grid">
                                                <div class="ma50 chart_column" style="background-color:green;min-height:{{$ma['upMA50'] * 2}}px">Up MA50<br> {{$ma['upMA50']}}%</div>
                                                <div class="ma50 chart_column" style="background-color:red;min-height:{{$ma['downMA50'] * 2}}px">Down MA50 <br> {{$ma['downMA50']}}%</div>
                                            </div>

                                            <div class="col-md-5 mt-4 justify-content-center align-items-center" style="height: 210px;max-height:200px;display:inline-grid">
                                            <div class="ma50 chart_column" style="text-align: center;width:100px;background-color:green;min-height:{{$ma['upMA200'] * 2 -15.5}}px">Up MA200 <br> {{$ma['upMA200']}}%</div>
                                            <div class="ma50 chart_column" style="text-align: center;width:100px;background-color:red;min-height:{{$ma['downMA200'] * 2}}px">Down MA200<br> {{$ma['downMA200']}}%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 ">
                                    <h5 style="text-align:center;padding:10px" class="color-home">My watch List</h5>
                                    <table class="table table-striped table-bordered" style="margin-bottom: 0px;">
                                        <thead>
                                            <th>No</th>
                                            <th>Chứng Khoán</th>
                                            <th>Gvn-Rating</th>
                                            <th>Ngành</th>
                                            <th>Giá mua/bán</th>
                                            <th>Giá hiện tại</th>
                                        </thead>
                                        <tbody>
                                            @foreach($top_stock as $key => $stock)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $stock->code }}</td>
                                                    <td>{{ $stock->rating }}</td>
                                                    <td>{{ $stock->group ?? '' }}</td>
                                                    <td>{{ $stock->price }}</td>
                                                    <td>{{ $stock->current_price }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <h5 style="text-align:center;padding:10px" class="color-home">Top 5 Stock</h5>
                                    <table class="table table-striped table-bordered top-stock-table"
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
                                    <div class="col-md-12 text-center">
                                        <div class="mb-4">
                                            <canvas id="groupStock" height="650"></canvas>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </section>
                        <section>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped table-bordered" style="margin-bottom: 0px;"
                                        id="indices-table">
                                    </table>
                                </div>

                            </div>
                        </section>


                    </div>
                    <div class="tab-pane fade" id="overview" role="tabpanel" aria-labelledby="profile-tab">
                        <img src="{{url('images/marketoverview.jpg')}}" alt="Stock Rating" style="width:100%">
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
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0-rc/dist/chartjs-plugin-datalabels.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-2.0.8/date-1.5.2/fc-5.0.1/fh-4.0.1/r-3.0.2/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
    $(document).ready(function () {
        var ctx = document.getElementById('pieChart').getContext('2d');
        var gradientRed = ctx.createLinearGradient(0, 0, 0, 400);
        gradientRed.addColorStop(0, 'rgba(255, 99, 132, 1)');
        gradientRed.addColorStop(1, 'rgba(255, 99, 132, 0.5)');

        var gradientBlue = ctx.createLinearGradient(0, 0, 0, 400);
        gradientBlue.addColorStop(0, 'rgba(54, 162, 235, 1)');
        gradientBlue.addColorStop(1, 'rgba(54, 162, 235, 0.5)');

        var gradientYellow = ctx.createLinearGradient(0, 0, 0, 400);
        gradientYellow.addColorStop(0, 'rgba(255, 206, 86, 1)');
        gradientYellow.addColorStop(1, 'rgba(255, 206, 86, 0.5)');
        var myPieChart = new Chart(ctx, {
    type: 'pie', // Kiểu biểu đồ là 'pie' (tròn)
    data: {
        labels: @json($labels),
        datasets: [{

            data: @json($chart_signal), // Dữ liệu cho từng phần của biểu đồ
            backgroundColor: [
                gradientRed,
                gradientBlue,
                gradientYellow

            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 5
        }]
    },
    options: {
        responsive: false,
        plugins: {
                    datalabels: {
                        display: true, // Hiển thị giá trị

                            formatter: function(value, context) {
                                return value + '%';
                            },
                            labels: {
                            value: {
                            color: 'white'
                            }
                        }
                        }
                }

    },plugins: [ChartDataLabels]
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
                    label:'Profit',
                    data: @json($chart_group_data['rate']),
                    backgroundColor: '#34a853',
                    fontweight: 600,
                }]
            },
            options: {
                indexAxis: 'y', // Chuyển sang biểu đồ cột ngang
                maintainAspectRatio: false, // Cho phép tùy chỉnh tỷ lệ
                plugins: {
                    datalabels: {
                        display: true, // Hiển thị giá trị

                            align: 'end',
                            formatter: function(value, context) {
                                return value + '%';
                            },
                            labels: {
                            value: {
                            color: 'white'
                            }
                        }
                        }
                }
            },
            plugins: [ChartDataLabels]
    });
    });

</script>