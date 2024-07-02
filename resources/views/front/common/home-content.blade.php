<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<section class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-left mb-4">Quan tâm nhiều nhất</h2>
                <div class="most-interested">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <div class="table-responsive">
                                    <div class="">
                                        <table class="table table-hover" id="favourite">
                                            <thead>
                                                <tr>
                                                    <th colspan="1" class="">
                                                        Name
                                                    </th>
                                                    <th colspan="1" class="">
                                                        Trend
                                                    </th>
                                                    <th colspan="1" class="">
                                                        PriceTrend
                                                    </th>
                                                    <th colspan="1" class="">
                                                        TimeStart
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6 form-group">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="indicestab-tab" data-bs-toggle="tab"
                                            data-bs-target="#indicestab" type="button" role="tab"
                                            aria-controls="indicestab" aria-selected="true">Indices Futures</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="commoditiestab-tab" data-bs-toggle="tab"
                                            data-bs-target="#commoditiestab" type="button" role="tab"
                                            aria-controls="commoditiestab" aria-selected="false">Commodities</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="cryptocurrencies-tab" data-bs-toggle="tab"
                                            data-bs-target="#cryptocurrencies" type="button" role="tab"
                                            aria-controls="cryptocurrencies"
                                            aria-selected="true">Cryptocurrencies</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="forextab-tab" data-bs-toggle="tab"
                                            data-bs-target="#forextab" type="button" role="tab" aria-controls="forextab"
                                            aria-selected="true">Forex</button>
                                    </li>
                                </ul>

                                <!-- Tab Content -->
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="indicestab" role="tabpanel"
                                        aria-labelledby="indicestab-tab">
                                        <div class="table-responsive">
                                            <div class="indices-futures">
                                                <table class="table table-hover" id="indices">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="1" class="">
                                                                Name
                                                            </th>
                                                            <th colspan="1" class="">
                                                                Trend
                                                            </th>
                                                            <th colspan="1" class="">
                                                                PriceTrend
                                                            </th>
                                                            <th colspan="1" class="">
                                                                TimeStart
                                                            </th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="commoditiestab" role="tabpanel"
                                        aria-labelledby="commoditiestab-tab">
                                        <!-- Content for Profile tab -->
                                        <div class="table-responsive">
                                            <div class="commodities">
                                                <table class="table table-hover scrollable-table-container"
                                                    id="commodities">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="1" class="">
                                                                Name
                                                            </th>
                                                            <th colspan="1" class="">
                                                                Trend
                                                            </th>
                                                            <th colspan="1" class="">
                                                                PriceTrend
                                                            </th>
                                                            <th colspan="1" class="">
                                                                TimeStart
                                                            </th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @foreach($signals['commodities'] as $key => $signal)
                                                            <tr class="">
                                                                <th rowspan="1" colspan="1" class="">

                                                                    {{$signal['code']}}
                                                                </th>
                                                                <td rowspan="1" colspan="1" class="">

                                                                    {{$signal['trend_price']}}
                                                                </td>
                                                                <td rowspan="1" colspan="1" class="">

                                                                    {{$signal['last_sale']}}
                                                                </td>
                                                                <td rowspan="1" colspan="1" class="">

                                                                    {{ $signal['date_action'] ? date('m-d-Y H:i', strtotime($signal['date_action'])) : ''}}
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="cryptocurrencies" role="tabpanel"
                                        aria-labelledby="cryptocurrencies-tab">
                                        <div class="table-responsive">
                                            <div class="top-cryptocurrencies">

                                                <table class="table table-hover" id="crypto">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="1" class="sortable">
                                                                Name
                                                            </th>
                                                            <th colspan="1" class="">
                                                                Trend
                                                            </th>
                                                            <th colspan="1" class="sortable-header">
                                                                PriceTrend
                                                            </th>
                                                            <th colspan="1" class="sortable-header">
                                                                TimeStart
                                                            </th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @foreach($signals['crypto'] as $key => $signal)
                                                            <tr class="">
                                                                <th rowspan="1" colspan="1" class="">

                                                                    {{$signal['code']}}
                                                                </th>
                                                                <td rowspan="1" colspan="1" class="">

                                                                    {{$signal['trend_price']}}
                                                                </td>
                                                                <td rowspan="1" colspan="1" class="">

                                                                    {{$signal['last_sale']}}
                                                                </td>
                                                                <td rowspan="1" colspan="1" class="">

                                                                    {{ $signal['date_action'] ? date('m-d-Y H:i', strtotime($signal['date_action'])) : ''}}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="forextab" role="tabpanel"
                                        aria-labelledby="forextab-tab">
                                        <!-- Content for Profile tab -->
                                        <div class="table-responsive">
                                            <div class="leading-stocks">

                                                <table class="table table-hover" id="forex">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="1" class="">
                                                                Name
                                                            </th>
                                                            <th colspan="1" class="">
                                                                Trend
                                                            </th>
                                                            <th colspan="1" class="">
                                                                PriceTrend
                                                            </th>
                                                            <th colspan="1" class="">
                                                                TimeStart
                                                            </th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
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
<section class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-left mb-4"><span class="title-trading-first">Giao dịch với</span>
                    <span class="title-trading-second">Green Beta 1.2.3</span>
                </h2>
                <div class="trading-green-beta">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <img class="img-fluid" src="{{asset('images/Green-Beta.png')}}"
                                    alt="{{asset('images/Green-Beta.png')}}">
                                <div class="content-trading">
                                    <ul>
                                        <li>Phương pháp giao dịch: Position Trading</li>
                                        <li>Thời gian đầu tư: Nắm giữ trung hạn và dài hạn</li>
                                        <li>Chỉ số giao dịch: Stock Index, Commondity, Cryto…</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="text-performance">
                                    <p class="text-plus-percent text-bold">Total Return</p>
                                    <p class="percent text-bold">+1075%</p>
                                    <p class="text-plus-percent text-bold">Outperformance</p>
                                    <p class="percent text-bold">+816%</p>
                                    <p class="text-plus-percent text-bold">Annualized Return</p>
                                    <p class="percent text-bold">+35%</p>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <canvas id="myChartBeta" width="400" height="230"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-left mb-4">Top tín hiệu phiên trước đó</h2>
                <div class="top-session-before-signal">
                    <swiper-container class="mySwiper" loop="true" space-between="30" slides-per-group="4"
                        slides-per-view="4" navigation="true">
                        <swiper-slide>
                            <img class="border-radius-13px" src="{{asset('images/1.jpg')}}"
                                alt="{{asset('images/1.jpg')}}">
                        </swiper-slide>
                        <swiper-slide>
                            <img class="border-radius-13px" src="{{asset('images/2.jpg')}}"
                                alt="{{asset('images/2.jpg')}}">
                        </swiper-slide>
                        <swiper-slide>
                            <img class="border-radius-13px" src="{{asset('images/3.jpg')}}"
                                alt="{{asset('images/3.jpg')}}">
                        </swiper-slide>
                        <swiper-slide>
                            <img class="border-radius-13px" src="{{asset('images/4.jpg')}}"
                                alt="{{asset('images/4.jpg')}}">
                        </swiper-slide>
                        <swiper-slide>
                            <img class="border-radius-13px" src="{{asset('images/1.jpg')}}"
                                alt="{{asset('images/1.jpg')}}">
                        </swiper-slide>
                        <swiper-slide>
                            <img class="border-radius-13px" src="{{asset('images/2.jpg')}}"
                                alt="{{asset('images/2.jpg')}}">
                        </swiper-slide>
                        <swiper-slide>
                            <img class="border-radius-13px" src="{{asset('images/3.jpg')}}"
                                alt="{{asset('images/3.jpg')}}">
                        </swiper-slide>
                        <swiper-slide>
                            <img class="border-radius-13px" src="{{asset('images/4.jpg')}}"
                                alt="{{asset('images/4.jpg')}}">
                        </swiper-slide>
                    </swiper-container>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-left mb-4">  <span class="title-trading-first">Giao dịch với</span>
                <span class="title-trading-second">Green Alpha 10.0.1</span></h2>
                <div class="trading-green-alpha">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="content-trading">
                                    <ul>
                                        <li>Phương pháp giao dịch: Day Trading</li>
                                        <li>Thời gian đầu tư: Trong ngày, không giữ lệnh qua đêm</li>
                                        <li>Chỉ số giao dịch: Nasdaq, SPX500, US30</li>
                                    </ul>
                                </div>
                                <img class="img-fluid" src="{{asset('images/robot-chatbot-icon-sign-free-vector.png')}}"
                                    alt="{{asset('images/robot-chatbot-icon-sign-free-vector.png')}}">
                            </div>
                            <div class="col-md-8">
                                <div class="chart-trading-green-beta">
                                    <select class="select2 form-control" name="chart-type" id="chartType">
                                        <option value="area">Area</option>
                                        <option value="bar">Column</option>
                                        <option value="line">Line</option>
                                    </select>
                                </div>
                                <canvas id="myChart" width="400" height="230"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<div class="services-our">
    <h3 class="mb-5 text-center">
        <span class="title-trading-first">Dịch vụ</span>
        <span class="title-trading-second">của chúng tôi</span>
    </h3>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h4>
                    <i class="fa fa-line-chart color-primary-custom" aria-hidden="true"></i>
                    <span class="text-bold">Giải pháp tự động hóa phân tích thị trường</span>
                </h4>
                <p>Dịch vụ tự động hóa phân tích cung cấp một cái nhìn khách quan nhất về xu hướng thị trường.
                </p>
            </div>
            <div class="col-md-4">
                <h4>
                    <i class="fa fa-line-chart color-primary-custom" aria-hidden="true"></i>
                    <span class="text-bold">Cung cấp các phân tích, xu hướng thị trường đến nhà đầu tư</span>
                </h4>
                <p>Các tín hiệu Buy-Sell sẽ được hệ thống tự động gửi đến điện thoại khách hàng trong khoản thời
                    gian giao dịch thật</p>
            </div>
            <div class="col-md-4">
                <h4>
                    <i class="fa fa-line-chart color-primary-custom" aria-hidden="true"></i>
                    <span class="text-bold">Tư vấn giải pháp cho nhà đầu tư hiệu quả thời gian</span>
                </h4>
                <p>Dịch vụ Giải pháp đầu tư cung cấp các giải pháp và công cụ hỗ trợ cho nhà đầu tư đạt hiệu quả
                    đầu tư tốt nhất</p>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        var data =
            $('#forex').DataTable({
                searching: false,
                lengthChange: false, //
                paging: false,
                info: false,
                data: @json($signals['forex']),
                scrollY: '300px',
                scrollCollapse: true,
                columns: [
                    { data: 'code' },  // Apply bold formatting to the "PriceTrend" column data},
                    { data: 'trend_price' },
                    { data: 'last_sale' },
                    { data: 'date_action' }
                ],
                order: [[3, 'desc']]
            });
        $('#crypto').DataTable({
            searching: false,
            lengthChange: false, //
            paging: false,
            info: false,
            scrollY: '300px',
            scrollCollapse: true,
            order: [[3, 'desc']],
            data: @json($signals['crypto']),
            columnDefs: [{
                targets: 'code', // Assuming 'code' is a class applied to the <th> of the column you want to make bold
                render: function (data, type, full, meta) {
                    console.log(data);
                }
            }],
            columns: [
                { data: 'code' },
                { data: 'trend_price' },
                { data: 'last_sale' },
                { data: 'date_action' }
            ]
        });
        $('#commodities').DataTable({
            searching: false,
            lengthChange: false, //
            paging: false,
            info: false,

            order: [[3, 'desc']],
            data: @json($signals['commodities']),
            scrollY: '300px',
            scrollCollapse: true,
            columns: [
                { data: 'code' },
                { data: 'trend_price' },
                { data: 'last_sale' },
                { data: 'date_action' }
            ]
        });
        $('#indices').DataTable({
            searching: false,
            lengthChange: false, //
            paging: false,
            info: false,
            order: [[3, 'desc']],
            data: @json($signals['indices']),
            scrollY: '300px',
            scrollCollapse: true,
            columnDefs: [{
                targets: 'code', // Assuming 'code' is a class applied to the <th> of the column you want to make bold
                render: function (data, type, full, meta) {
                    return `<strong>${data}</strong>`;
                }
            }],
            columns: [
                { data: 'code' },
                { data: 'trend_price' },
                { data: 'last_sale' },
                { data: 'date_action' }
            ],
        });
        $('#favourite').DataTable({
            searching: false,
            lengthChange: false, //
            paging: false,
            info: false,
            order: [[3, 'desc']],
            data: @json($signals['indices']),
            scrollY: '300px',
            scrollCollapse: true,
            columnDefs: [{
                targets: 'code', // Assuming 'code' is a class applied to the <th> of the column you want to make bold
                render: function (data, type, full, meta) {
                    return `<strong>${data}</strong>`;
                }
            }],
            columns: [
                { data: 'code' },
                { data: 'trend_price' },
                { data: 'last_sale' },
                { data: 'date_action' }
            ],
        });
    });
</script>
