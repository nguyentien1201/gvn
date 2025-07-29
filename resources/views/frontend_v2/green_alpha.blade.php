@extends('layouts.app')
@section('title', 'Green Alpha')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home_v2.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">

<link rel="stylesheet" href="{{ asset('css/green_stock.css') }}">
<style>
 .div-table { display: table; width: 100%; border: 1px solid #dee2e6; border-radius: .5rem; border-collapse: separate; }
    .div-row { display: table-row; }
    .div-header, .div-cell { display: table-cell; padding: .75rem; text-align: center; vertical-align: middle; border-bottom: 1px solid #dee2e6; border-right: 1px solid #dee2e6; }
    .div-header { font-weight: 600; background-color: #fff; }
    .div-cell:first-child, .div-header:first-child { background-color: #f0fcf5; }
    .div-header:first-child { border-top-left-radius: .5rem; }
    .div-header:last-child { border-top-right-radius: .5rem; }
    .div-row:last-child .div-cell:first-child { border-bottom-left-radius: .5rem; }
    .div-row:last-child .div-cell:last-child { border-bottom-right-radius: .5rem; }
    .div-cell:last-child, .div-header:last-child { border-right: none; }
    #popupDataTable_wrapper .dt-scroll-head{
   display: none !important;
}
.code_header{
    border-bottom: 1px solid #fff !important;
}
.blink-effect {
    animation: blink 5s infinite; /* Hiệu ứng chớp nháy, lặp lại mãi mãi */
}

               @keyframes blink {

            0%,
            90% {
                opacity: 1;
                /* Phần tử hiển thị trong phần lớn thời gian */
                color: white;
                border: 1px solid #fff;
                background: #ffd966;
            }

            95%,
            100% {
                opacity: 0;
                /* Chớp nháy nhanh trong khoảng thời gian ngắn */
                background-color: #ffd966;
            }
        }
</style>
@endpush

@section('content')
    <div class="home-page inter-font-family">
        @include('front.common.header')
       <!-- Heading tab -->
       <div id="heroCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item container-heading active">
                <h3 class="heading-page">Green Alpha</h3>

            </div>
        </div>
    </div>

                    <!-- End heading tab -->
        <section id="trading-on" class="py-0 py-lg-5 common-services" style="border-bottom: 1px solid #eff4f1;">
            <div class="container">
            <div class="row gy-4 gy-lg-0">

                        <div class="co-12 col-lg-6">
                            <img class="img-fluid" src="{{asset('images/robot-alpha.png')}}" alt="{{asset('images/robot-alpha.png')}}">
                        </div>
                        <div class="co-12 col-lg-6 trading-container">
                            <div class="trading-on-content">
                                <div class="head-text">
                                    <span>{{__('base.description_title_green_alpha')}}</span>
                                </div>

                            </div>
                        </div>
                    </div>
            </div>
        </section>

        @include('frontend_v2.components.green-alpha-table')
        <section id="green-stock" class="py-0 py-lg-5 common-services">
                <div class="container">
                <div class="row mb-2">
                                <!-- Chart Section -->
                                <div class="col-md-12 text-center m-auto">
                                <div class="container-chart">
                                    <canvas id="myChart" style="width:100%"
                                        height="260"></canvas>
                                </div>
                                </div>
                            </div>
                    </div>
        </section>
        <section id="table-chart" class="py-0 py-lg-5 common-services">
            <div class="container common">

                    <h3 class="text-center services-title pb-3 pb-lg-2 color-home">{{__('base.HISTORICAL_PERFORMANCE')}}</h3>
                <div class="row gy-4 gy-lg-0">
                    <div class="co-12 col-lg-6">

                    <table style="width:100%" class="table table-striped table-bordered display responsive nowrap"
                                            id="popupDataTable">
                                            <thead>
                                                <tr id="code_header">
                                                    <th colspan="6" style="text-align:center" class="code_header"></th>
                                                </tr>
                                                <tr>
                                                    <th>{{__('base.Signal_Open')}}</th>
                                                    <th>{{__('base.Price_Open')}}</th>
                                                    <th>{{__('base.Open_Time')}}</th>
                                                    <th>{{__('base.Price_Close')}}</th>
                                                    <th>{{__('base.Close_Time')}}</th>
                                                    <th>{{__('base.Profit')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                    </div>
                    <div class="co-12 col-lg-6">
                        <div style="height: 470px;"
                            class="d-flex flex-column justify-content-center align-items-center chart-container">
                            <canvas id="lineChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center m-auto">
                        <canvas id="myChartById" style="width:100%" width="400" height="230"></canvas>
                    </div>
                </div>
            </div>
        </section>
@auth
            <div style="position: fixed; bottom: 20px; right: 20px; text-align: center; z-index: 1000;">
                <div class="sc-9qme4p-0 hELAUe">
                    <button class="decription_telegram"><span
                            class="sc-1ee9gtf-2 bxZLwE">{{__('front_end.chat_with_me')}}</span></button>
                </div>
                <a href="https://t.me/{{config('config.telegram_user')}}" target="_blank" style="text-decoration: none;">
                    <button style="
                float: right;
            background-color: #33a853;
            color: white;
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: background-color 0.3s ease;
            "
                        onmouseover="this.style.backgroundColor='#33a853';"
                        onmouseout="this.style.backgroundColor='#198754';">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/8/82/Telegram_logo.svg" alt="Telegram"
                            style="width: 30px; height: 30px;">
                    </button>
                </a>
            </div>
            @endauth
            @include('frontend_v2.components.footer')
    </div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0-rc/dist/chartjs-plugin-datalabels.min.js"></script>
<script>
    window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-09NXCQGTBV');

    function updateClock() {
        const now = new Date();
        // Lấy thời gian và ngày tháng theo múi giờ
        const dateOptions = {
            timeZone: 'Europe/Moscow',
            year: 'numeric',
            month: '2-digit',
            day: '2-digit'
        };
        const timeOptions = {
            timeZone: 'Europe/Moscow',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: false
        };

        let dateString = now.toLocaleDateString('en-US', dateOptions).replace(/\//g, '-');
        let timeString = now.toLocaleTimeString('en-US', timeOptions);

        const elmDates = document.getElementsByClassName('date-js');
        const elmTimes = document.getElementsByClassName('time-js');

        for (let i = 0; i < elmDates.length; i++) {
            elmDates[i].textContent = dateString;
        }
        for (let i = 0; i < elmDates.length; i++) {
            elmTimes[i].textContent = timeString;
        }
    }

    setInterval(updateClock, 1000); // Cập nhật mỗi giây
    const el = document.getElementById('timezone');
    if (el) {
        el.addEventListener('change', updateClock);
        updateClock();
    }
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
            scrollX: true, // Kích hoạt cuộn ngang

            fixedColumns: {
                leftColumns: 2 // Cố định cột đầu tiên (Tên sản phẩm)
            },
            scrollCollapse: true,
            autoWidth: false,
            scrollY: '280px',
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
                    targets:0,
                    createdCell: function (td, cellData, rowData, row, col) {
                        if(rowData.signal_open =="") return false
                            let signalOpenText = '';
                            let signalOpenClass = '';
                            if(rowData.signal_open === "SELL") {
                                signalOpenText = "SELL";
                                signalOpenClass = "sell";
                            } else {
                                signalOpenText = "BUY";
                                signalOpenClass = "buy";
                            }
                            $(td).html(`<span class="text-capitalize signal-open ${signalOpenClass}">${signalOpenText}</span>`);
                            $(td).addClass('text-center');
                    }
                },
                {
                    targets: 2, // Index of the open_time column
                    render: function (data, type, row) {

                        if (type === 'display' || type === 'filter') {
                            return moment.tz(data, 'Europe/Moscow').format('MM-DD-YYYY HH:mm'); // Format as HH:mm
                        }
                        return data;
                    }
                },
                {
                    targets: 1, // Index of the date column
                    render: function (data, type, full, meta) {

                        if (type === 'display') {
                            return parseFloat(data).toFixed(2);
                        }
                        return data; //

                    }
                },
                {
                    targets: 4, // Index of the open_time column
                    render: function (data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            return moment.tz(data, 'Europe/Moscow').format('MM-DD-YYYY HH:mm'); // Format as HH:mm
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
            // createdRow: function (row, data, dataIndex) {
            //     $('td', row).css('font-size', '0.95em');
            // }
        });
        var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($dataChartProfit['lable']),
            datasets: [{
                data: @json($dataChartProfit['profitWeek']),
                label: 'Profit Week Current',
                backgroundColor: '#40f35c',
                borderWidth: 1,
                fontweight: 600,
            },
            {
                data: @json($dataChartProfit['profitMonth']),
                label: 'Profit Month Current',
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


        },
        plugins: [ChartDataLabels]
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
    url:  '/api/get-history-alpha/' + dataId,
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
            paging: false,
            info: false,
            scrollX: true, // Kích hoạt cuộn ngang
            fixedColumns: {
                leftColumns: 2 // Cố định cột đầu tiên (Tên sản phẩm)
            },
            scrollCollapse: true,
            autoWidth: false,
              scrollY: '280px',
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
                        if(rowData.signal_open =="") return false
                            let signalOpenText = '';
                            let signalOpenClass = '';
                            if(rowData.signal_open === "SELL") {
                                signalOpenText = "SELL";
                                signalOpenClass = "sell";
                            } else {
                                signalOpenText = "BUY";
                                signalOpenClass = "buy";
                            }
                            $(td).html(`<span class="text-capitalize signal-open ${signalOpenClass}">${signalOpenText}</span>`);
                            $(td).addClass('text-center');
                    }
                },
                {
                    targets: 2, // Index of the open_time column
                    render: function (data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            return moment.tz(data, 'Europe/Moscow').format('MM-DD-YYYY HH:mm'); // Format as HH:mm
                        }
                        return data;
                    }
                },
                {
                    targets: 4, // Index of the open_time column
                    render: function (data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            return moment.tz(data, 'Europe/Moscow').format('MM-DD-YYYY HH:mm'); // Format as HH:mm
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
            // createdRow: function (row, data, dataIndex) {
            //     $('td', row).css('font-size', '0.95em');
            // }
        });
        popupDataTable.columns.adjust().draw();
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
        $('#dataTableModal').modal('show');
    },
    error: function (error) {


    }
});

});
    })

</script>
@endpush
