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
        th{
            text-align:center !important;
        }
        .table-responsive {
            overflow-  x: hidden !important;
        }
        td{
            text-align:center !important;
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
                                        <span class="comment-div-left" style="font-size:1.4em"> Em tên là <b>Green Stock
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
    <section id="contentDiv" class="text-left">
        <div class="container">
            <div class="row">
                <div class="col-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="rating-tab" data-toggle="tab" href="#rating" role="tab" aria-controls="rating" aria-selected="true">StockRating</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="false">Market Overview</a>
                    </li>

                </ul>
                <!-- Tab panes -->
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="rating" role="tabpanel" aria-labelledby="rating-tab">
                        <table class="table table-striped table-bordered" style="margin-bottom: 0px;" id="indices-table">

                        </table>
                    </div>
                    <div class="tab-pane fade" id="overview" role="tabpanel" aria-labelledby="profile-tab">
                    <img src="{{url('images/marketoverview.jpg')}}" alt="Stock Rating" style="width:100%">
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-2.0.8/date-1.5.2/fc-5.0.1/fh-4.0.1/r-3.0.2/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
    $(document).ready(function () {
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
                { data: 'rating', title: 'Rating' },  // Apply bold formatting to the "PriceTrend" column data},
                { data: 'code', title: 'Chứng khoán' },
                { data: 'point', title: 'Rating Point' },
                { data: 'trending', title: 'Xu hướng' },
                { data: 'signal', title: 'Hành động' },
                { data: 'profit', title: 'profit' },
                { data: 'post_sale_discount', title: 'Giảm sau bán' },
                { data: 'price', title: 'price' },
                { data: 'time', title: 'Thời gian' },
            ],
            columnDefs: [
                {
                targets: 0, // Index of the date column
                    createdCell: function (td, cellData, rowData, row, col) {
                        color  = '';
                        bold='';
                        if (cellData <= 30) {
                            color = '#7eb18f';
                            bold ='bold';
                        }
                        $(td).css('color', color);
                        $(td).css('font-weight',bold);
                    },
                },
                {
                    targets: 3, // Index of the date column
                    createdCell: function (td, cellData, rowData, row, col) {
                        trending ='';
                        color  = '';
                        if(rowData.trending != null){
                            trending = rowData.trending.trim().toLowerCase();
                        }
                        if (trending == 'breaking high price') {
                            color = '#917dc4';
                        } else if (trending == 'build up') {
                            color = '#fde69c';
                        } else if (trending == 'go up') {
                            color = '#badfcd';
                        }else if (trending == 'bottom fishing') {
                            color ='#03feff'
                        } else if(trending == 'go down'){
                            color = '#e99a97';
                        } else if(trending == 'recovery'){
                            color = '#fe9a3c';
                        } else if(trending == 'breaking low price'){
                            color ='#cc0611';
                        }
                        $(td).css('background-color', color);
                        $(td).css('box-shadow', 'none');
                    }
                },
           {
                targets: 4, // Index of the date column
                    createdCell: function (td, cellData, rowData, row, col) {
                        signal ='';
                        color  = '';
                        if(cellData != null){
                            signal = cellData.trim().toLowerCase();
                        }
                        if (signal == 'buy') {
                            color = '#66a74c';
                        } else if (signal == 'hold') {
                            color = '#93c480';
                        } else if (signal == 'cash') {
                            color = '#fee49d';
                        }else if (signal == 'sell') {
                            color ='#ffffff'
                        }
                        $(td).css('background-color', color);
                        $(td).css('box-shadow', 'none');
                    }
                },
                {
                targets: 5, // Index of the date column
                    createdCell: function (td, cellData, rowData, row, col) {
                        color  = '';
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
                        color  = '';
                        if (cellData > 0) {
                            color = '#b8dfcd';
                        } else if (cellData < 0) {
                            color = '#e37b71';
                        }
                        $(td).css('color', color);
                        $(td).css('box-shadow', 'none');
                    },
                    render: function (data, type, full, meta) {
                        if(data != null){
                            return `${data}%`;
                        }
                        return '';
                    },

                },
                {
                    targets:8, // Index of the open_time column
                    render: function (data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            return moment.utc(data).format('DD/MM/YYYY'); // Format as HH:mm
                        }
                        return data;
                    }
                },
            ],

            //
            createdRow: function (row, data, dataIndex) {
                // Assuming 'code' is the property you want to use for data-id
                $(row).attr('data-id', data.id_code);
            }
        });
        indices.columns.adjust().responsive.recalc();
    });

</script>
