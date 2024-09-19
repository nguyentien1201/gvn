<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <!-- Bootstrap CSS -->




    <!-- DataTables Responsive CSS -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">

    <link rel="stylesheet" href="{{asset('plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.0.1/css/fixedColumns.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/4.0.1/js/dataTables.fixedColumns.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0-rc/dist/chartjs-plugin-datalabels.min.js"></script>

    <style>
.carousel-item {
    min-height: 300px;
    height: 300px;
    background: no-repeat center center scroll;
    background-size: cover;
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
      <div class="carousel-item active" style="background-image: url({{url('images/green-beta-slider.jpg')}})">
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
                                    <img width="100%" src="{{url('images/robo-green-beta.png')}}" alt="Logo" />
                                </div>
                                <!-- Chart Section -->
                                <div class="col-md-9" style="font-size:0.9rem !important; margin-top:4rem">
                                    <h5 class="text-center" style="font-size:1.5em"><span class="title-trading-first label-color">Xin chào anh chị,</span></h5>
                                    <p>
                                    <span class="comment-div-left" style="font-size:1.4em"> Em tên là <b>Green Beta - 1.3.3</b>, một robot với khả năng phân tích và tìm xu hướng tăng của thị trường tài chính, hiện tại ở bảng phía dưới là 13 chỉ số thị trường em đang phân tích.</span>
                                    </p>
                                    <p style="font-size:1.25em">
                                    <span><i>Chúc anh chị có một ngày đầu tư thật nhiều thuận lợi và nếu có thêm góp ý, anh chị hãy gửi cho các sếp nhà GVN của em nhé!</i> </span>
                                    </p>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

<script>
    $(document).ready(function(){
        function updateClock() {
            const now = new Date();
            // Lấy thời gian và ngày tháng theo múi giờ
            const dateOptions = { timeZone: 'GMT', year: 'numeric', month: '2-digit', day: '2-digit' };
            const timeOptions = { timeZone: 'GMT', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };

            let dateString = now.toLocaleDateString('en-GB', dateOptions);
            let timeString = now.toLocaleTimeString('en-GB', timeOptions);
            document.getElementById('date').textContent = dateString;
            document.getElementById('time').textContent = timeString;


        }

        setInterval(updateClock, 1000); // Cập nhật mỗi giây
        updateClock(); // Chạy ngay khi load trang
    });

</script>
    <!-- Features Section -->

    <section class="features text-left mt-3">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center mb-4"><span class="title-trading-first label-color color-home">SIGNAL DASHBOARD</span>

                    </h2>
                    <!-- Data and Chart Section -->
                    <h5 class="color-home" style="padding:15px; text-align: right;"> <i><span id="date"></span>  <span id="time"> GMT</span> </i></h5>
                    <div class="row">
                        <!-- Chart Section -->
                        <div class="col-md-12 text-center form-group">

                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                    <table class="table table-striped table-bordered display responsive nowrap" style="margin-bottom: 0px; width:100%"
                                        id="indices-table">
                                    </table>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-4 text-left form-group">
                                            <ul style="padding-left:0">
                                                <li class="list-item">
                                                    <button class="takeprofitbuy width-120">Buy</button>
                                                    <span>Tín hiệu xu hướng đang mở.</span>
                                                </li>
                                                <li class="list-item">
                                                    <button class="hold width-120">Close</button>
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
            </div>
        </div>
    </section>


    <section id="contentDiv" class="features text-left  mt-5">
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
                                <!-- Data Section -->
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table style="width:100%"  class="table table-striped table-bordered display responsive nowrap"
                                            id="popupDataTable"> </table>
                                    </div>
                                </div>
                                <!-- Chart Section -->
                                <div class="col-md-6">
                                    <canvas id="lineChart" style="width:100%;max-height:480px" width="400"
                                        height="440"></canvas>
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
                                <div class="col-md-12 text-center m-auto">
                                    <canvas id="myChart" style="width:100%"
                                        height="230"></canvas>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center m-auto">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="chart_table">
                                            <tr>
                                                <td style="font-weight:600">Total Trade</td>
                                                @foreach ($chart_data['total'] as $item)
                                                    <td>{{$item}}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td style="font-weight:600">Win Ratio</td>
                                                @foreach ($chart_data['winratio'] as $item)
                                                    <td>{{$item}}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td style="font-weight:600">Time Start</td>
                                                @foreach ($chart_data['startDate'] as $item)
                                                    <td>{{ (new DateTime($item))->format('Y') }}</td>
                                                @endforeach
                                            </tr>
                                        </table>
                                    </div>

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

<script>
    $(document).ready(function () {
        let lineChart = null;
        $(document).on('click', '.dataTable tbody tr', function () {
            var dataId = $(this).data('id');

            if (dataId == undefined) {
                return;
            }
            $.ajax({
                url: 'api/get-history-signal/' + dataId,
                type: 'GET',

                success: function (data) {
                    data = data.data;

                    var dataTable = $('#popupDataTable').DataTable({
                        destroy: true,
                        data: data.list,
                        searching: false,
                        scrollX: true, // Kích hoạt cuộn ngang
                        fixedColumns: {
                            leftColumns: 2 // Cố định cột đầu tiên (Tên sản phẩm)
                        },
                        scrollCollapse: true,
                        autoWidth: false,
                        paging: false,
                        info: false,
                        scrollY: '400px',
                        columns: [
                            { data: 'code', title: 'Symbol' },
                            { data: 'price_open', title: 'Price Open' },
                            { data: 'open_time', title: 'Open Time' },
                            { data: 'price_close', title: 'Price Close' },
                            { data: 'close_time', title: 'Close Time' },
                            { data: 'profit', title: 'Profit' },
                        ],
                        columnDefs: [

                            {
                                targets: 4, // Assuming `close_time` is the 5th column
                                type: 'date', // Specify the type
                                // Specify the date format if necessary
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
                        createdRow: function (row, data, dataIndex) {
                            $('td', row).css('font-size', 'xx-small');
                        }
                    });

                    // popupDataTable.columns.adjust().draw();
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

                },
                error: function (error) {
                    console.log(error);
                }
            });


        });
        var popupDataTable = $('#popupDataTable').DataTable({
            destroy: true,
            data: @json($default_chart['list']),
            searching: false,
            scrollX: true, // Kích hoạt cuộn ngang
            fixedColumns: {
                leftColumns: 2 // Cố định cột đầu tiên (Tên sản phẩm)
            },
            autoWidth: false,
            paging: false,
            info: false,
            scrollY: '400px',
            columns: [
                { data: 'code', title: 'Symbol' },
                { data: 'price_open', title: 'Price Open' },
                { data: 'open_time', title: 'Open Time' },
                { data: 'price_close', title: 'Price Close' },
                { data: 'close_time', title: 'Close Time' },
                { data: 'profit', title: 'Profit' },
            ],
            columnDefs: [
                {
                    targets: 0, // Index of the 'code' column
                    createdCell: function (td, cellData, rowData, row, col) {
                        $(td).css('font-weight', 'bold');
                    }
                },
                {
                    targets: 4, // Assuming `close_time` is the 5th column
                    type: 'date', // Specify the type
                    // Specify the date format if necessary
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


        });

        var ctxline = document.getElementById('lineChart').getContext('2d');
        lineChart = new Chart(ctxline, {
            type: 'line',
            data: {
                labels: @json($default_chart['profit']).map((value, index) => index),
                datasets: [{
                    label: 'Profit',
                    data: @json($default_chart['profit']),
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
                        min: @json($default_chart['profit']) // Ẩn nhãn và đường biểu đồ của trục x
                    }
                },

            }

        });
        var indices = $('#indices-table').DataTable({
            searching: false,
            scrollX: true, // Kích hoạt cuộn ngang
            fixedColumns: {
                leftColumns: 2 // Cố định cột đầu tiên (Tên sản phẩm)
            },
            autoWidth: false,
            lengthChange: false, //
            paging: false,
            info: false,
            order: [[4, 'desc']],
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
                    },
                    render: function (data, type, full, meta) {
                        if(full.close_time != null){
                            return 'Close';
                        }

                        return data; //

                    }
                },
                {
                    targets: 1, // Index of the date column
                    render: function (data, type, full, meta) {
                        if (type === 'display') {
                            const numberFormatter = new Intl.NumberFormat('en-US', { maximumFractionDigits: 0 }); // No decimal places
                            const formattedNumber = numberFormatter.format(data); // Format the number with commas
                            return formattedNumber;
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
                        return `${data}%`;
                    }
                },
                {
                    targets: 3, // Index of the date column
                    createdCell: function (td, cellData, rowData, row, col) {
                        trending_price = cellData.trim().toLowerCase();;
                        // b6d7a8
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
                        $(td).css('padding-left', '0.5em');
                        $(td).css('min-width', '100px');
                        $(td).css('padding-right', '0');
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


    });
</script>
<script>

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($chart_data['code']),
            datasets: [{
                data: @json($chart_data['winratio']),
                label: 'Win Ratio',
                backgroundColor: '#34a853',
                borderWidth: 1,
                fontweight: 600,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // Allows the chart to stretch vertically
            plugins: {
                datalabels: {
                    display: true, // Hiển thị giá trị
                    anchor: 'end',
                    align: 'end',
                    formatter: function(value, context) {
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
</script>
