<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">


<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-2.0.8/date-1.5.2/fc-5.0.1/fh-4.0.1/r-3.0.2/datatables.min.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<style>
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
            order: [[3, 'desc']],
            data: @json($signals),

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
                    }
                },
                {
                    targets: 1, // Index of the date column

                    render: function (data, type, full, meta) {
                        if(data =='fas fa-lock'){
                            return '<i class="fas fa-lock"></i>';
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
                            return '<i class="fas fa-lock"></i>';
                        }
                        return data; //
                    }
                },
                {
                    targets: 6, // Index of the date column
                    render: function (data, type, full, meta) {
                        if(data=='fas fa-lock'){
                            return '<i class="fas fa-lock"></i>';
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
                            console.log(rowData.signal_close);
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
        <!-- Chart Section -->
        <div class="col-md-12 text-center form-group">

            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-bordered" style="margin-bottom: 0px;"
                        id="indices-table">
                    </table>
                    <div class="row mt-4">
                        <div class="col-md-8 text-left form-group">
                            <ul style="padding-left:0">
                                <li class="list-item">
                                    <button class="takeprofitbuy width-120">Buy</button>
                                    <span>Tín hiệu xu hướng đang mở.</span>
                                </li>
                                <li class="list-item">
                                    <button class="hold width-120">Buy</button>
                                    <span>Tín hiệu xu hướng đã đóng.</span>
                                </li>

                            </ul>
                        </div>
                        <div class="col-md-4 text-right form-group">
                            <ul style="padding-left:0">
                                <li class="list-item">
                                    <button class="hold width-120">Hold</button>
                                    <span>Tín hiệu đang ở trạng thái giữ.</span>
                                </li>
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
                        <h5 class="card-title color-home">Green Beta</h5>
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
                                                        <div class="app-name color-home">Green-Beta</div>
                                                        <div class="notification-time">{{ $signal->updated_at ? date('m-d-Y', strtotime($signal->closeupdated_at_time)) : ''}}</div>
                                                    </div>
                                                </div>
                                                <div class="notification-body">
                                                    <div class="bold">GREEN BETA</div>
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
                    <span class="title-trading-second color-home label-color">Green Alpha 10.0.1</span>
                </h2>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title color-home">Green Alpha</h5>
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
                            <img class="img-fluid" style="width:100%" src="{{asset('images/ratingbygvn.jpg')}}" />
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

