<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">


<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-2.0.8/date-1.5.2/fc-5.0.1/fh-4.0.1/r-3.0.2/datatables.min.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>


    $(document).ready(function () {


    var forex = $('#forex-table').DataTable({
        searching: false,
            lengthChange: false, //

            responsive: true,
            paging: false,
            info: false,
                data: @json($signals['forex']),
                scrollY: '300px',

                columns: [
                    { data: 'code' },  // Apply bold formatting to the "PriceTrend" column data},
                    { data: 'trend_price' },
                    { data: 'last_sale' },
                    { data: 'date_action' }
                ],
                columnDefs: [
                {
                    targets: 1, // Index of the date column
                    createdCell: function(td, cellData, rowData, row, col) {
                        // Or apply inline styles
                        color ='yellow';
                        if(cellData =='UPTREND') {
                            color='green';
                        };
                        if(cellData =='DOWNTREND') {
                            color='red';
                        };
                        $(td).css('background-color', color);
                    }
                }],
                    order: [[3, 'desc']]
            });
            forex.columns.adjust().draw();
            var crypto = $('#crypto').DataTable({

                searching: false,
            lengthChange: false, //
            responsive: true,
            paging: false,
            info: false,
            scrollY: '300px',

            order: [[3, 'desc']],
            data: @json($signals['crypto']),

            columns: [
                { data: 'code' },  // Apply bold formatting to the "PriceTrend" column data},
                    { data: 'trend_price' },
                    { data: 'last_sale' },
                    { data: 'date_action' }
            ],
            columnDefs: [
                {
                    targets: 1, // Index of the date column
                    createdCell: function(td, cellData, rowData, row, col) {



                        // Or apply inline styles
                        color ='yellow';
                        if(cellData =='UPTREND') {
                            color='green';
                        };
                        if(cellData =='DOWNTREND') {
                            color='red';
                        };
                        $(td).css('background-color', color);
                    }
                }],
        });
        forex.columns.adjust().draw();
        var commodities = $('#commodities-table').DataTable({
            searching: false,
            lengthChange: false, //
            responsive: true,
            paging: false,
            info: false,
            scrollY: '300px',

            data: @json($signals['commodities']),
            order: [[3, 'desc']],

            columns: [
                { data: 'code' },  // Apply bold formatting to the "PriceTrend" column data},
                    { data: 'trend_price' },
                    { data: 'last_sale' },
                    { data: 'date_action' }
                ],
            columnDefs: [
                {
                    targets: 1, // Index of the date column
                    createdCell: function(td, cellData, rowData, row, col) {



                        // Or apply inline styles
                        color ='yellow';
                        if(cellData =='UPTREND') {
                            color='green';
                        };
                        if(cellData =='DOWNTREND') {
                            color='red';
                        };
                        $(td).css('background-color', color);
                    }
                }],
        });
        commodities.columns.adjust().draw();
        var indices=  $('#indices-table').DataTable({
            searching: false,

            lengthChange: false, //
            responsive: true,
            paging: false,
            info: false,
            order: [[3, 'desc']],
            data: @json($signals['indices']),
            scrollY: '300px',

            columnDefs: [{
                targets: 'code', // Assuming 'code' is a class applied to the <th> of the column you want to make bold
                render: function (data, type, full, meta) {
                    return `<strong>${data}</strong>`;
                }
            }],
            columns: [
                { data: 'code' },  // Apply bold formatting to the "PriceTrend" column data},
                    { data: 'trend_price' },
                    { data: 'last_sale' },
                    { data: 'date_action' }
            ],
            columnDefs: [
                {
                    targets: 1, // Index of the date column
                    createdCell: function(td, cellData, rowData, row, col) {


                        // Or apply inline styles
                        color ='yellow';
                        if(cellData =='UPTREND') {
                            color='green';
                        };
                        if(cellData =='DOWNTREND') {
                            color='red';
                        };
                        $(td).css('background-color', color);
                    }
                }],
        });
        indices.columns.adjust().draw();
        $('#favourite').DataTable({
            searching: false,
            lengthChange: false, //
            paging: false,
            info: false,
            order: [[3, 'desc']],
            data: @json($favorite),
            responsive: true,
            scrollY: '338px',

            columns: [
                { data: 'code' },
                { data: 'signal_open' },
                { data: 'last_sale' },
                { data: 'price_open' },
                { data: 'open_time' }

            ]
        });
        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            target = e.target.getAttribute("href") // activated tab
            console.log(target);
    // Trigger DataTable redraw when tab becomes active
    commodities.columns.adjust().responsive.recalc();
    indices.columns.adjust().responsive.recalc();
    forex.columns.adjust().responsive.recalc();
    crypto.columns.adjust().responsive.recalc();

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
            background-color: #ffc107; /* Yellow background for Hold */
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
            <div class="col-md-6 form-group">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title label-color color-home">Ưa thích</h5>
                            <table class="table table-striped table-bordered" id="favourite">
                                <thead>


                                    <th class="">Name</th>
                                    <th class="">Action</th>
                                    <th class="">Last Sale</th>
                                    <th class="">Price Open</th>
                                    <th class="">Time</th>
                                </thead>
                            </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6 form-group">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title label-color color-home">Tín hiệu miễn phí</h5>
                        <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" id="indices-tab" data-bs-toggle="tab" href="#indices" >indices</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="commodities-tab" data-bs-toggle="tab" href="#commodities" >Commodities</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="cryptocurrencies-tab" data-bs-toggle="tab" href="#cryptocurrencies" >Cryptocurrencies</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="forex-tab" data-bs-toggle="tab" href="#forex">Forex</a>
                        </li>
                    </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active in" id="indices">
                                    <table class="table table-striped table-bordered"  id="indices-table">
                                        <thead>

                                                <th class="sortable" class="name">
                                                    Name
                                                </th>
                                                <th class="" class="trend">
                                                    Trend
                                                </th>
                                                <th class="sortable-header" class="trendprice">
                                                    PriceTrend
                                                </th>
                                                <th class="sortable-header" class="trendprice">
                                                    TimeStart
                                                </th>

                                        </thead>
                                    </table>
                            </div>
                            <div class="tab-pane fade" id="commodities">
                                <!-- Content for Profile tab -->
                                <table class="table table-striped table-bordered" id="commodities-table" >
                                    <thead>
                                        <th class="sortable">
                                            Name
                                        </th>
                                        <th class="">
                                            Trend
                                        </th>
                                        <th class="sortable-header">
                                            PriceTrend
                                        </th>
                                        <th class="sortable-header">
                                            TimeStart
                                        </th>
                                    </thead>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="cryptocurrencies">
                                <table class="table table-striped table-bordered"  id="crypto">
                                    <thead>

                                        <th class="sortable" width="20%">
                                            Name
                                        </th>
                                        <th class="" width="25%">
                                            Trend
                                        </th>
                                        <th class="sortable-header"  width="25%">
                                            PriceTrend
                                        </th>
                                        <th class="sortable-header"  width="30%">
                                            TimeStart
                                        </th>

                                    </thead>
                                </table>

                            </div>
                            <div class="tab-pane fade" id="forex">
                                <table class="table table-striped table-bordered" id="forex-table">
                                    <thead >

                                            <th class="sortable">
                                                Name
                                            </th>
                                            <th class="">
                                                Trend
                                            </th>
                                            <th class="sortable-header">
                                                PriceTrend
                                            </th>
                                            <th class="sortable-header">
                                                TimeStart
                                            </th>

                                    </thead>
                                </table>
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
                <h2 class="text-left mb-4"><span class="title-trading-first label-color color-home">Giao dịch với</span>
                    <span class="title-trading-second bold">Green Beta 1.2.3</span>
                </h2>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Green Beta</h5>
                        <p class="card-text"> <li>Phương pháp giao dịch: Position Trading</li>
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
                            <img class="img-fluid" src="{{asset('images/Green-Beta.png')}}"
                            alt="{{asset('images/Green-Beta.png')}}">
                        </div>
                        <!-- Chart Section -->
                        <div class="col-md-8">
                            <canvas id="myChartBeta" width="400" height="230"></canvas>
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
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Green Beta</h5>
                        <p class="card-text"> <li>Phương pháp giao dịch: Position Trading</li>
                                            <li>Thời gian đầu tư: Nắm giữ trung hạn và dài hạn</li>
                                            <li>Chỉ số giao dịch: Stock Index, Commondity, Cryto…</li>
                        </p>
                    </div>
                </div>
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
                                                <div>
                                                    <div class="app-name">Green-Beta</div>
                                                    <div class="notification-time">{{ $signal->updated_at ? date('m-d-Y', strtotime($signal->closeupdated_at_time)) : ''}}</div>
                                                </div>
                                            </div>
                                            <div class="notification-body">
                                                <div>GREEN BETA</div>
                                                <div><b>{{$signal->signal_close ? $signal->signal_close :$signal->signal_open }}:</b> {{$signal->MstStock->code}} {{$signal->price_close ? $signal->price_close :$signal->price_open }}</div>
                                                <div>{{$signal->close_time ? $signal->close_time :$signal->open_time }}</div>
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
                    <span class="title-trading-second color-home label-color">Green Beta 10.0.1</span>
                </h2>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Green Beta</h5>
                        <p class="card-text"> <li>Phương pháp giao dịch: Day Trading</li>
                                            <li>Thời gian đầu tư: Trong ngày, không giữ lệnh qua đêm</li>
                                            <li>Chỉ số giao dịch: Nasdaq, SPX500, US30 ...</li>
                        </p>
                    </div>
                </div>

            <!-- Data and Chart Section -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Data Section -->
                        <div class="col-md-4">
                            <img class="img-fluid" src="{{asset('images/Green-Beta.png')}}"
                            alt="{{asset('images/Green-Beta.png')}}">
                        </div>
                        <!-- Chart Section -->
                        <div class="col-md-8">
                            <canvas id="myChartAnpha" width="400" height="230"></canvas>
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
              <h5 class="card-title color-home">Giải pháp tự động hóa phân tích thị trường</h5>
              <p class="card-text">Dịch vụ tự động hóa phân tích cung cấp một cái nhìn khách quan nhất về xu hướng thị trường.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title color-home">Cung cấp các phân tích, xu hướng thị trường đến nhà đầu tư</h5>
              <p class="card-text">Các tín hiệu Buy-Sell sẽ được hệ thống tự động gửi đến điện thoại khách hàng trong khoản thời
              gian giao dịch thật</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title color-home">Tư vấn giải pháp cho nhà đầu tư hiệu quả thời gian</h5>
              <p class="card-text">Dịch vụ Giải pháp đầu tư cung cấp các giải pháp và công cụ hỗ trợ cho nhà đầu tư đạt hiệu quả
              đầu tư tốt nhất</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

