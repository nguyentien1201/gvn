

<script>
    $(document).ready(function () {
        console.log(@json($signals));
        var swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,
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
        breakpoints: {
            640: {   // When the width is >= 640px
            slidesPerView: 2,
            spaceBetween: 20
            },
            768: {   // When the width is >= 768px
            slidesPerView: 3,
            spaceBetween: 30
            },
            1024: {  // When the width is >= 1024px
            slidesPerView: 4,
            spaceBetween: 40
            }
        }
    });
        var indices = $('#indices-table').DataTable({
            searching: false,
            // lengthChange: false, //
            scrollX: true, // Kích hoạt cuộn ngang
            fixedColumns: {
                leftColumns: 2 // Cố định cột đầu tiên (Tên sản phẩm)
            },
            autoWidth: false,
            paging: false,
            // scrollX:true,


            info: false,
            data: @json($signals),
            order: [[4, 'desc']],
            columns: [
                { data: 'signal_open'},  // Apply bold formatting to the "PriceTrend" column data},
                { data: 'price_open' },
                { data: 'open_time'},
                { data: 'trend_price'},
                { data: 'group'},
                { data: 'code'},
                { data: 'last_sale'},
                { data: 'profit'},
                { data: 'signal_close' },
                { data: 'price_close' },
                { data: 'close_time'}
            ],
            columnDefs: [
                {
                    targets: 0, // Index of the date column
                    createdCell: function (td, cellData, rowData, row, col) {
                        signal_close = rowData.signal_close.trim().toLowerCase();
                        if (signal_close == 'hold') {
                            color = '#b6d7a8';
                        } else {
                            color = '#ffd966';
                        }
                        $(td).css('background-color', color);
                        $(td).css('box-shadow', 'none');
                        $(td).css('border-color', '#fff');
                    },
                    render: function (data, type, full, meta) {
                        signal_close = rowData.signal_close.trim().toLowerCase();
                        if(signal_close != 'hold'){
                            return 'CLOSED';
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
                            return parseFloat(data).toFixed(2);
                        }
                        return data; //

                    }
                },

                {
                    targets: 3, // Index of the date column

                    render: function (data, type, full, meta) {
                        if(data =='fas fa-lock'){
                            return '<i style="color:green" class="fas fa-lock"></i>';
                        }
                        return data; //

                    }
                },
                {
                    targets: 9, // Index of the date column
                    render: function (data, type, full, meta) {
                        if(data=='fas fa-lock'){
                            return '<i style="color:green" class="fas fa-lock"></i>';
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
                    targets: 10, // Index of the date column
                    render: function (data, type, full, meta) {
                        if(data =='fas fa-lock'){
                            return '<i style="color:green" class="fas fa-lock"></i>';
                        }
                        return data; //

                    }
                },
                {
                    targets: 7, // Index of the date column
                    createdCell: function (td, cellData, rowData, row, col) {
                        signal_close = rowData.signal_close.trim().toLowerCase();
                        if (signal_close == '' || signal_close ==null || signal_close == 'hold') {
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
                            return 'HOLD';
                        }
                        return `${data}`;
                    }
                },
                {
                    targets: 5, // Index of the 'code' column
                    createdCell: function (td, cellData, rowData, row, col) {
                        $(td).css('text-align', 'left');
                        $(td).css('font-weight', 'bold');
                        $(td).css('padding-left', '0.5em');
                        $(td).css('min-width', '100px');
                        $(td).css('padding-right', '0');


                    },
                    render: function(data, type, row) {
                        return  '<img src="images/logo/'+data+'.png" alt="Logo" style="max-width:2em;width:30px; margin-right:0.5em"> '+ data; // Adjust the path and style as needed
                    }
                },
                {
                    targets: 3, // Index of the date column
                    createdCell: function (td, cellData, rowData, row, col) {
                        trending_price = cellData.trim().toLowerCase();;

                            if (trending_price == 'uptrend') {
                                color = '#b6d7a8';
                            } else if (trending_price == 'downtrend') {
                                color = '#e06666';
                            } else {
                            color = '#ffd966';
                        }
                        $(td).css('font-weight', 'bold');
                        $(td).css('color', color);
                        $(td).css('box-shadow', 'none');
                    }
                },
            ],
            createdRow: function (row, data, dataIndex) {
                // Assuming 'code' is the property you want to use for data-id
                $(row).attr('data-id', data.id_code);
            }
        });
        // indices.columns.adjust().responsive.recalc();
        var ctxline = document.getElementById('lineChart').getContext('2d');
        lineChart = new Chart(ctxline, {
            type: 'line',
            data: {
                labels: @json($default_chart['nas100']['profit']).map((value, index) => index),
                datasets: [{
                    label: 'Cummulative Profit NAS100 From 2013',
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
            scrollX: true, // Kích hoạt cuộn ngang
            fixedColumns: {
                leftColumns: 2 // Cố định cột đầu tiên (Tên sản phẩm)
            },
            autoWidth: false,
            paging: false,

            info: false,
            order: [[0, 'asc']],
            data: @json($green_data),
            columns: [
                { data: 'rating', title: 'RATING' },  // Apply bold formatting to the "PriceTrend" column data},
                { data: 'code', title: 'CHỨNG KHOÁN' },
                { data: 'current_price', title: 'LastSale' },
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

                        return data; //

                    }
                },
                {
                    targets: 2, // Index of the date column
                    render: function (data, type, full, meta) {
                        if(data =='fas fa-lock'){
                            return '<i style="color:green" class="fas fa-lock"></i>';
                        }

                        if (type === 'display') {
                            return parseFloat(data).toFixed(2);
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
                    targets: 6, // Index of the date column
                    render: function (data, type, full, meta) {
                        if(data =='fas fa-lock'){
                            return '<i style="color:green" class="fas fa-lock"></i>';
                        }

                        if (type === 'display') {
                            return parseFloat(data).toFixed(2);
                        }
                        return data; //

                    }
                },
                {
                    targets:7, // Index of the open_time column
                    render: function (data, type, row) {
                        if(data =='fas fa-lock'){
                            return '<i style="color:green" class="fas fa-lock"></i>';
                        }
                        if (type === 'display' || type === 'filter') {
                            return moment.tz(data, 'Europe/Moscow').format('DD/MM/YYYY'); // Format as HH:mm
                        }
                        return data;
                    }
                },
            ],


        });
        // green_stock.columns.adjust().responsive.recalc();

        var ctxbar = document.getElementById('myChartById').getContext('2d');
    var data = @json($data_chart_default);
    data = data.data;
    barChart = new Chart(ctxbar, {
        type: 'bar',
        data: {
            labels: data.profitByMonth.lable,
            datasets: [{
                data: data.profitByMonth.profit,
                label: 'Monthly Profit NAS100',
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
                            formatter: function(value, context) {
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
    var barGroupctx = document.getElementById('groupStock').getContext('2d');
    var labelCount = @json($chart_group_data['labels']).length;
    barGroup = new Chart(barGroupctx, {
        type: 'bar',
        data: {
                labels: @json($chart_group_data['labels']),
                datasets: [{
                    label:'',
                    data: @json($chart_group_data['rate']),
                    backgroundColor: '#34a853',

                    fontweight: 600,
                }]
            },
            options: {
                indexAxis: 'y', // Chuyển sang biểu đồ cột ngang
                maintainAspectRatio: false, // Cho phép tùy chỉnh tỷ lệ
                lenged: {
                    display: true,

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
                            generateLabels: function(chart) {
                                return []; // Return an empty array to hide all labels
                            }
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
    });

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
                    label: 'UP',
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



</script>

<section class="features text-left mt-5">
    <div class="container">
        <h2 class="text-left mb-4 label-color color-home pb-3 d-flex" >{{__('front_end.most_interested')}} <a class="color-home" style="text-align:right;right: 0;
    " href="/green-beta"><i class="fas fa-chevron-right"></i></a></h2>
        <div class="row">
        <!-- Chart Section -->
        <div class="col-md-12 text-center form-group">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12 text-center">
                    <table class="table table-striped table-bordered display responsive nowrap" style="width:100%;margin-bottom: 0px;"
                        id="indices-table">
                        <thead>

                            <tr>
                                <th>{{__('front_end.signal_open')}}</th>
                                <th>{{__('front_end.price_open')}}</th>
                                <th>{{__('front_end.open_time')}}</th>
                                <th>{{__('front_end.trend_price')}}</th>
                                <th>{{__('front_end.markets')}}</th>
                                <th>{{__('front_end.symbol')}}</th>
                                <th>{{__('front_end.last_sale')}}</th>
                                <th>{{__('front_end.profit')}}</th>
                                <th>{{__('front_end.signal_close')}}</th>
                                <th>{{__('front_end.price_close')}}</th>
                                <th>{{__('front_end.close_time')}}</th>
                            </tr>
                    </table>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-4 text-left form-group">
                            <ul style="padding-left:0">
                                <li class="list-item">
                                    <button class="takeprofitbuy width-120" >{{__('front_end.BUY')}}</button>
                                    <span>{{__('front_end.trend_signal_open')}}</span>
                                </li>
                                <li class="list-item">
                                    <button class="hold width-120">{{__('front_end.CLOSED')}}</button>
                                    <span>{{__('front_end.trend_signal_closed')}}</span>
                                </li>

                            </ul>
                        </div>
                        <div class="col-md-4 text-left form-group">
                            <ul style="padding-left:0">
                            <li class="list-item">
                                    <button class="takeprofitbuy width-120">{{__('front_end.take_profit_buy')}}</button>
                                    <span>{{__('front_end.trend_signal_take_profit')}}</span>
                                </li>
                                <li class="list-item">
                                    <button class="hold width-120">{{__('front_end.HOLD')}}</button>
                                    <span>{{__('front_end.trend_signal_hold')}}</span>
                                </li>


                            </ul>
                        </div>
                        <div class="col-md-4 text-right form-group">
                            <ul style="padding-left:0">

                                <li class="list-item">
                                    <button class="cutlossbuy width-120">{{__('front_end.cut_loss_buy')}}</button>
                                    <span>{{__('front_end.trend_signal_cutloss')}}</span>
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
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <h2 class="text-left mb-4 pb-3  d-flex"><span class="title-trading-first label-color bold">{{__('front_end.title_green_beta')}}</span>
                    <a class="color-home" style="text-align:right ;right: 0;" href="/trading-system"><i class="fas fa-chevron-right"></i></a>
                </h2>
                <div class="card mb-4">
                    <div class="card-body">
                        <p class="font-face">
                      {{__('front_end.description_title_green_beta')}}
                    </p>
                        <h6 class="card-text font-face bold" style="font-weight:600">
                        {{__('front_end.description_title_end_green_beta')}}

                        </h6>

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
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <h2 class="text-left mb-4 color-home label-color pb-3">{{__('front_end.top_signal')}}</h2>
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
                       <!-- Add Pagination -->

                </div>
                        <!-- Add more slides as needed -->
            </div>

        </div>

    </div>

</section>
<section class="features text-left  mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <h2 class="text-left mb-4 pb-3 d-flex"><span class="title-trading-first label-color ">Giao dịch với GREEN ALPHA 10.0.1</span>
                    <a class="color-home" style="text-align:right;right: 0" href="/green-alpha"><i class="fas fa-chevron-right"></i></a>
                </h2>

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                        <!-- Data Section -->
                            <div class="col-md-9">

                            <p class="font-face">
                                {{__('front_end.description_title_green_alpha')}}

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
                            <canvas id="myChartById" style="width:100%" height="400"></canvas>
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
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <h2 class="text-left mb-4 pb-3 d-flex"><span class="title-trading-first label-color color-home">Top StockRating by GVN</span>
                <a class="color-home" style="text-align:right;right: 0" href="/greenstock-nas100"><i class="fas fa-chevron-right"></i></a>
            </h2>
            <!-- Data and Chart Section -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Data Section -->
                        <!-- Chart Section -->
                        <div class="col-md-12 text-center">
                        <table class="table table-striped table-bordered display responsive nowrap" style="margin-bottom: 0px; width:100%" id="green-stock-table">
                            <thead>

                                <tr>
                                    <th>{{__('front_end.RATING')}}</th>
                                    <th>{{__('front_end.STOCK')}}</th>
                                    <th>{{__('front_end.LAST_SALE')}}</th>
                                    <th>{{__('front_end.TREND')}}</th>
                                    <th>{{__('front_end.ACTION')}}</th>
                                    <th>{{__('front_end.PROFIT')}}</th>
                                    <th>{{__('front_end.PRICE')}}</th>
                                    <th>{{__('front_end.TIME')}}</th>
                                </tr>
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
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">

                <h2 class="text-left mb-4 pb-3"><span class="title-trading-first label-color">{{__('front_end.green_stock_100')}}</span>

                </h2>
            <!-- Data and Chart Section -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                    <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="card mb-4">
                                <div class=" text-left">
                                    <p class="font-face">
                                        {{__('front_end.description_title_green_stock')}}

                                    </p>
                                </div>
                            </div>
                    </div>
                    <div class="col-md-4 col-12 col-lg-4">
                        <img class="img-fluid" src="{{asset('images/bull_bear.jpg')}}" />
                    </div>
                    </div>
                    <div class="row">
                        <!-- Data Section -->
                        <div class="col-md-6 col-12 col-lg-6">
                        <div class="sidebar sidebar_1" style="text-align:center">
                                <div class="mb-4 center_flex">
                                    <canvas id="maChart"  height="350"></canvas>
                                    <canvas class="mt-5" id="pieChart" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- Chart Section -->
                        <div class="col-md-6 col-12 col-lg-6 text-center">
                            <div class="mb-4">
                                <canvas id="groupStock" height="780"></canvas>
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
      <h2 class="color-home label-color">{{__('front_end.service_us')}}</h2>
      <div class="row">
        <div class="col-md-4">
          <div class="card" style="height:100%">
            <div class="card-body">
              <h5 class="card-title color-home">  <i class="fas fa-laptop icon-Computer" style="margin-right:10px"> </i>{{__('front_end.service_1')}}</h5>
              <p class="card-text">{{__('front_end.description_service_1')}}</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="height:100%">
                <div class="card-body">
                <h5 class="card-title color-home"><i class="fas fa-chart-line" style="margin-right:10px"></i> {{__('front_end.service_2')}}</h5>
                <p class="card-text">{{__('front_end.description_service_2')}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
          <div class="card" style="height:100%">
            <div class="card-body">
              <h5 class="card-title color-home"><i class="fas fa-briefcase" style="margin-right:10px"> </i>{{__('front_end.service_3')}}</h5>
              <p class="card-text">{{__('front_end.description_service_3')}}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

