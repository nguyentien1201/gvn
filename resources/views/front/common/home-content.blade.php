<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-2.0.8/date-1.5.2/fc-5.0.1/fh-4.0.1/r-3.0.2/datatables.min.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<style>
     tbody >tr:hover {
            cursor: pointer;
            background-color: #f5f5f5;
            box-shadow: 0 0px 0px rgba(0, 0, 0, 0.1);
            transform: scale(1.008);
        }
       .color-home{
            color:#008000 !important;
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
        .hold{
            background-color :#ffd966;
        }
        .takeprofitbuy{
            background-color :#b6d7a8;
        }
        .cutlossbuy{
            background-color :#e06666;
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
        .width-120{
            width: 120px;
        }
        .table-responsive{
            overflow-x: hidden !important;
        }
        td {
            text-align: center;
        }
        thead th {
            text-align: center;
        }
</style>
<script>


    $(document).ready(function () {
        var indices = $('#indices-table').DataTable({
            searching: false,
            lengthChange: false, //
            responsive: true,
            paging: false,
            autoWidth: true,
            info: false,
            data: @json($signals),
            order: [[4, 'desc']],
            columns: [
                { data: 'signal_open', title: 'Signal Open' },  // Apply bold formatting to the "PriceTrend" column data},
                { data: 'price_open', title: 'Price Open' },
                { data: 'open_time', title: 'Open Time' },
                { data: 'trend_price', title: 'Trend Price' },
                { data: 'group', title: 'Markets' },
                { data: 'code', title: 'Symbol' },
                { data: 'last_sale', title: 'Last Sale' },
                { data: 'profit', title: 'Profit' },
                { data: 'signal_close', title: 'Signal Close' },
                { data: 'price_close', title: 'Price Close' },
                { data: 'close_time', title: 'Close Time' }
            ],
            columnDefs: [

                {
                    targets: 0, // Index of the date column
                    createdCell: function (td, cellData, rowData, row, col) {
                        if (rowData.close_time == null) {
                            color = '#b6d7a8';
                        } else {
                            color = '#ffd966';
                        }
                        $(td).css('background-color', color);
                        $(td).css('box-shadow', 'none');
                        $(td).css('border-color', '#fff');
                    },
                    render: function (data, type, full, meta) {
                        if(full.close_time != null){
                            return 'Closed';
                        }

                        return data; //

                    }
                },
                {
                    targets: 1, // Index of the date column

                    render: function (data, type, full, meta) {
                        if(data =='fas fa-lock'){
                            return '<i style="color:green" class="fas fa-lock"></i>';
                        }
                        if (type === 'display') {
                            const numberFormatter = new Intl.NumberFormat('en-US', { maximumFractionDigits: 0 }); // No decimal places
                            const formattedNumber = numberFormatter.format(data); // Format the number with commas
                            return formattedNumber;
                        }
                        return data; //

                    }
                },
                {
                    targets: 2, // Index of the date column
                    render: function (data, type, full, meta) {
                        if(data=='fas fa-lock'){
                            return '<i style="color:green" class="fas fa-lock"></i>';
                        }
                        return data; //
                    }
                },

                {
                    targets: 9, // Index of the date column
                    render: function (data, type, full, meta) {
                        if(data <= 0){
                            return '';
                        }
                        if (type === 'display') {
                            const numberFormatter = new Intl.NumberFormat('en-US', { maximumFractionDigits: 0 }); // No decimal places
                            const formattedNumber = numberFormatter.format(data); // Format the number with commas
                            return formattedNumber;
                        }
                        return data; //

                    }
                },
                {
                    targets: 7, // Index of the date column
                    createdCell: function (td, cellData, rowData, row, col) {
                        if (rowData.close_time == '' || rowData.close_time ==null) {
                            if (cellData >= 0) {
                                color = '#b6d7a8';
                            } else {
                                color = '#e06666';
                            }
                        } else {
                            color = '#ffd966';
                        }
                        $(td).css('background-color', color);
                        $(td).css('box-shadow', 'none');
                    },
                    render: function (data, type, full, meta) {
                        if(data=='fas fa-lock'){
                            return '<i class="fas fa-lock"></i>';
                        }
                        return `${data}%`;
                    }
                },
                {
                    targets: 8, // Index of the date column
                    createdCell: function (td, cellData, rowData, row, col) {
                        signal_close =''
                        if(rowData.signal_close != null){
                            signal_close = rowData.signal_close.trim().toLowerCase();
                        }
                        if (signal_close == 'takeprofitbuy') {
                            color = '#b6d7a8';
                        } else if (signal_close == 'cutlossbuy') {
                            color = '#e06666';
                        } else {
                            color = '#ffd966';
                        }
                        $(td).css('background-color', color);
                        $(td).css('box-shadow', 'none');
                    },
                    render: function (data, type, full, meta) {
                        if(data == null || data == '' || data == undefined || data == 'Hold'){
                            return 'Hold';
                        }
                        return `${data}`;
                    }
                },
                {
                    targets: 5, // Index of the 'code' column
                    createdCell: function (td, cellData, rowData, row, col) {
                        $(td).css('text-align', 'left');
                        $(td).css('font-weight', 'bold');
                        $(td).css('padding', '.5em .8em');
                    },
                    render: function(data, type, row) {
                        return  '<img src="images/logo/'+data+'.png" alt="Logo" style=" height:20px; max-width:27px;width:30px;; margin-right:0.8em"> '+ data; // Adjust the path and style as needed
                    }
                }
            ],
            createdRow: function (row, data, dataIndex) {
                // Assuming 'code' is the property you want to use for data-id
                $(row).attr('data-id', data.id_code);
            }
        });
        indices.columns.adjust().responsive.recalc();
        var ctxline = document.getElementById('lineChart').getContext('2d');
        lineChart = new Chart(ctxline, {
            type: 'line',
            data: {
                labels: @json($default_chart['nas100']['profit']).map((value, index) => index),
                datasets: [{
                    label: 'Profit Nas100',
                    data: @json($default_chart['nas100']['profit']),
                    backgroundColor: '#34a853',
                    borderColor: 'green',
                    borderWidth: 0.5,
                    fill: true,

                }]
            },
            options: {
                scales: {
                    x: {
                        beginAtZero: false,
                        min: @json($default_chart['nas100']['profit']) // Ẩn nhãn và đường biểu đồ của trục x
                    }
                },

            }

        });
        var green_stock = $('#green-stock-table').DataTable({

            searching: false,

            lengthChange: false, //
            responsive: true,
            paging: false,
            autoWidth: true,
            info: false,
            order: [[0, 'asc']],
            data: @json($green_data),
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
                targets: 1, // Index of the date column
                    createdCell: function (td, cellData, rowData, row, col) {
                        $(td).css('font-weight','bold');
                        var company = rowData.company_name;

                        $(td).hover(
                            function() {
                                $(this).addClass('row-hover');
                                // Show custom tooltip
                                $('<div class="custom-tooltip">' + company + '</div>').appendTo('body').fadeIn('slow');
                            },
                            function() {
                                $(this).removeClass('row-hover');
                                $('.custom-tooltip').remove();
                            }
                        ).mousemove(function(e) {
                            $('.custom-tooltip').css({
                                top: e.pageY + 15 + 'px',
                                left: e.pageX + 20 + 'px'
                            });
                        });
                    },
                    render: function (data, type, full, meta) {
                        if(data =='fas fa-lock'){
                            return '<i style="color:green" class="fas fa-lock"></i>';
                        }
                        if (type === 'display') {
                            const numberFormatter = new Intl.NumberFormat('en-US', { maximumFractionDigits: 0 }); // No decimal places
                            const formattedNumber = numberFormatter.format(data); // Format the number with commas
                            return formattedNumber;
                        }
                        return data; //

                    }
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
                    targets:7, // Index of the open_time column
                    render: function (data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            return moment.utc(data).format('DD/MM/YYYY'); // Format as HH:mm
                        }
                        return data;
                    }
                },
            ],


        });
        green_stock.columns.adjust().responsive.recalc();

        var ctxbar = document.getElementById('myChartById').getContext('2d');
    var data = @json($data_chart_default);
    data = data.data;
    barChart = new Chart(ctxbar, {
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
    });

    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 4,
        spaceBetween: 10,
        loop: true,
        autoplay: {
            delay: 5000, // Delay between transitions in milliseconds
            disableOnInteraction: false, // Enable/disable autoplay on swiper interaction
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });

</script>

<style>
      /* Style for Swiper Container */
      table thead {
        width: 100% !important;
      }
      .swiper-container {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            padding-right: 20px;
        }

        /* Style for Swiper Slides */
        .swiper-slide {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-right: 15px;
            transition: transform 0.3s ease, opacity 0.3s ease;
            opacity: 0.8;
        }

        /* Hover effect on Swiper Slides */
        .swiper-slide:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            opacity: 1;
        }

        /* Style for Card Title */
        .card-title {
            color: #007bff;
            font-size: 1.25rem;
        }
        .swiper-slide .card {
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Style for Card Text */
        .card-text {
            color: #555;
        }

        /* Default style for Stock Signal Background */
        .stock-signal {
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 10px;
            color: #fff; /* Text color white for better contrast */
        }

        /* Background color based on stock signal */
        .buy {
            background-color: #28a745; /* Green background for Buy */
        }

        .sell {
            background-color: #dc3545; /* Red background for Sell */
        }

        .hold {
            background-color: rgb(255, 217, 102); /* Yellow background for Hold */
            color: #000; /* Text color black for better contrast on yellow */
        }

        /* Pagination Styles */
        .swiper-pagination {
            bottom: 10px;
        }
        .swiper-pagination-bullet {
            background-color: #007bff;
            opacity: 0.5;
        }
        .swiper-pagination-bullet-active {
            opacity: 1;
        }

        /* Navigation Buttons */
        .swiper-button-next, .swiper-button-prev {
            color: #007bff;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .swiper-button-next:hover, .swiper-button-prev:hover {
            color: #fff;
            background-color: #007bff;
        }

        /* Animation for Swiper Slide Entering */
        .swiper-slide-active {
            animation: fadeIn 0.8s ease;
            opacity: 1 !important;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .notification {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 12px;


            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .notification-header {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-bottom: 8px;
        }
        .app-icon {
            width: 40px;
            height: 40px;
            margin-right: 8px;
        }
        .app-name {
            font-weight: bold;
            font-size: 16px;
        }
        .notification-time {
            font-size: 12px;
            color: #888;
        }
        .notification-body {
            font-size: 14px;
        }
        .notification-body b {
            font-weight: bold;
        }

 .label-color:{
    color:#008000 !important;
    font-weight: bold;
 }
 .color-home{
    color:#008000 !important;
 }

</style>
<section class="features text-left mt-5">
    <div class="container">
        <h2 class="text-left mb-4 label-color color-home" >Quan tâm nhiều nhất</h2>
        <div class="row">
        <!-- Chart Section -->
        <div class="col-md-12 text-center form-group">

            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-bordered" style="margin-bottom: 0px;"
                        id="indices-table">
                    </table>
                    <div class="row mt-4">
                        <div class="col-md-4 text-left form-group">
                            <ul style="padding-left:0">
                                <li class="list-item">
                                    <button class="takeprofitbuy width-120" >Buy</button>
                                    <span>Tín hiệu xu hướng đang mở.</span>
                                </li>
                                <li class="list-item">
                                    <button class="hold width-120">Closed</button>
                                    <span>Tín hiệu xu hướng đã đóng.</span>
                                </li>

                            </ul>
                        </div>
                        <div class="col-md-4 text-left form-group">
                            <ul style="padding-left:0">
                            <li class="list-item">
                                    <button class="takeprofitbuy width-120">TakeProfitBuy</button>
                                    <span>Tín hiệu đã ở trạng thái chốt lời.</span>
                                </li>
                                <li class="list-item">
                                    <button class="hold width-120">Hold</button>
                                    <span>Tín hiệu đang ở trạng thái giữ.</span>
                                </li>


                            </ul>
                        </div>
                        <div class="col-md-4 text-right form-group">
                            <ul style="padding-left:0">

                                <li class="list-item">
                                    <button class="cutlossbuy width-120">CutLossBuy</button>
                                    <span>Tín hiệu đã ở trạng thái cắt lỗ.</span>
                                </li>
                            </ul>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    </div>
</section>
<section class="features text-left  mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-left mb-4"><span class="title-trading-first label-color bold">Giao dịch với</span>
                    <span class="title-trading-second  color-home">GREEN BETA 1.3.3</span>
                </h2>
                <div class="card mb-4">
                    <div class="card-body">
                        <p class="card-text">
                            <li>Phương pháp giao dịch: Position Trading</li>
                            <li>Thời gian đầu tư: Nắm giữ trung hạn và dài hạn</li>
                            <li>Chỉ số giao dịch: Stock Index, Commondity, Cryto…</li>
                        </p>
                    </div>
                </div>

            <!-- Data and Chart Section -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Data Section -->
                        <div class="col-md-4">
                            <img class="img-fluid" src="{{asset('images/robo-green-beta.png')}}"
                            alt="{{asset('images/Green-Beta.png')}}">
                        </div>
                        <!-- Chart Section -->
                        <div class="col-md-8">
                            <canvas id="lineChart" width="400" height="230"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>
<section class="features text-left  mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-left mb-4 color-home label-color">Top tín hiệu phiên trước đó</h2>

                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <!-- Slide 1 -->
                            @foreach ($last_signal as $signal)
                                <div class="swiper-slide col-md-3">
                                    <div class="card">
                                        <div class="card-body">
                                        <div class="notification">
                                                <div class="notification-header">
                                                    <img src="{{asset('images/metatrader-icon.png')}}" alt="MetaTrader 4" class="app-icon">
                                                    <div style="text-align:right">
                                                        <div class="app-name color-home" style="text-align:right">Green Alpha</div>
                                                        <div class="bold color-home" ><b>{{$signal->MstStock->code}}</b></div>
                                                    <div> <b>{{$signal->signal_close }}:</b> <span style="color: {{ $signal->profit < 0 ? 'red' : 'green' }}"> {{!empty($signal->profit) ? $signal->profit .'%'  : ''}}</span></div>
                                                    <div>{{$signal->close_time ? $signal->close_time :$signal->open_time }}</div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                    </div>
                </div>
                        <!-- Add more slides as needed -->
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </div>
    </div>
</section>
<section class="features text-left  mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-left mb-4"><span class="title-trading-first label-color">Giao dịch với</span>
                    <span class="title-trading-second color-home label-color">Green Alpha 10.0.1</span>
                </h2>

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                        <!-- Data Section -->
                            <div class="col-md-9">
                            <h5 class="card-title color-home">Green Alpha</h5>
                        <p class="card-text"> <li>Phương pháp giao dịch: Day Trading</li>
                                            <li>Thời gian đầu tư: Trong ngày, không giữ lệnh qua đêm</li>
                                            <li>Chỉ số giao dịch: Nasdaq, SPX500, US30 ...</li>
                        </p>
                            </div>
                            <!-- Chart Section -->
                            <div class="col-md-3">
                                <img class="img-fluid" src="{{asset('images/logo-robot-alpha.jpg')}}"
                                alt="{{asset('images/logo-robot-alpha.jpg')}}">
                            </div>
                        </div>

                    </div>
                </div>

            <!-- Data and Chart Section -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Data Section -->

                        <!-- Chart Section -->
                        <div class="col-md-12">
                            <canvas id="myChartById" style="width:100%" width="400" height="230"></canvas>
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
                <h2 class="text-left mb-4"><span class="title-trading-first label-color color-home">Top StockRating by GVN</span>
                </h2>
            <!-- Data and Chart Section -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Data Section -->
                        <!-- Chart Section -->
                        <div class="col-md-12 text-center">
                        <table class="table table-striped table-bordered" style="margin-bottom: 0px;" id="green-stock-table">

                        </table>
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
                <h2 class="text-left mb-4"><span class="title-trading-first label-color">Giao dịch với</span>
                    <span class="title-trading-second color-home label-color">Green Stock NAS100</span>
                </h2>
            <!-- Data and Chart Section -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Data Section -->
                        <div class="col-md-8">
                            <div class="card mb-4">
                                <div class="card-body text-left">
                                    <p class="card-text">
                                        GreenStock-NAS100 là hệ thống phân tích các.
                                        Cổ phiếu trong rổ cổ phiếu NASDAQ100
                                        Hệ thống tự động xếp hạng rating theo kỹ thuật
                                        Đưa ra hành động xu hướng giá cho nhà đầu tư
                                    </p>
                                </div>
                            </div>
                            <div class="container">
                                <div class="row">
                                        <div class="col-md-6 text-left">
                                            <img class="img-fluid" src="{{asset('images/Capture3.png')}}"
                                            alt="{{asset('images/Green-Beta.png')}}">
                                        </div>
                                        <div class="col-md-6 text-left">
                                        <img class="img-fluid" src="{{asset('images/Capture2.png')}}"
                                        alt="{{asset('images/Green-Beta.png')}}">
                                        </div>

                                    </div>

                            </div>


                            <div class="container">
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <img class="img-fluid" src="{{asset('images/Capture4.png')}}"
                                    alt="{{asset('images/Green-Beta.png')}}">
                                </div>
                            </div></div>



                        </div>
                        <!-- Chart Section -->
                        <div class="col-md-4 text-center">
                            <div class="mb-4">
                            <img class="img-fluid" src="{{asset('images/von-hoa.jpg')}}" />
                            </div>
                            <div class="mb-4">
                            <img class="img-fluid" style="width:100%" src="{{asset('images/green-stock.jpg')}}" />
                                </div>

                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>
<section class="features text-center  mt-5">
    <div class="container">
      <h2 class="color-home label-color">Dịch vụ của chúng tôi</h2>
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">

              <h5 class="card-title color-home">  <i class="fas fa-laptop icon-Computer" style="margin-right:10px"> </i>Giải pháp tự động hóa phân tích thị trường</h5>
              <p class="card-text">Dịch vụ tự động hóa phân tích cung cấp một cái nhìn khách quan nhất về xu hướng thị trường.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">

              <h5 class="card-title color-home"><i class="fas fa-chart-line" style="margin-right:10px"></i> Cung cấp các phân tích, xu hướng thị trường đến nhà đầu tư</h5>
              <p class="card-text">Các tín hiệu Buy-Sell sẽ được hệ thống tự động gửi đến điện thoại khách hàng trong khoản thời
              gian giao dịch thật</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title color-home"><i class="fas fa-briefcase" style="margin-right:10px"> </i>Tư vấn giải pháp cho nhà đầu tư hiệu quả thời gian</h5>
              <p class="card-text">Dịch vụ Giải pháp đầu tư cung cấp các giải pháp và công cụ hỗ trợ cho nhà đầu tư đạt hiệu quả
              đầu tư tốt nhất</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

