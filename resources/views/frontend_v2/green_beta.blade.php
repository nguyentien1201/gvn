@extends('layouts.app')
@section('title', 'Green Beta')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home_v2.css') }}">
@endpush

@section('content')
    <div class="home-page inter-font-family">
        @include('front.common.header')
        @include('frontend_v2.components.hero')
        <section id="trading-on" class="py-0 py-lg-5">
            <div class="container">
            <div class="row gy-4 gy-lg-0">
                        <div class="co-12 col-lg-6">
                            <div class="trading-on-content">
                                <div class="head-text">
                                    <span>{{__('home.trade_on_content.beta.head_text')}}</span>
                                </div>
                                <div class="last-text">
                                    <span>{{__('home.trade_on_content.beta.last_text')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="co-12 col-lg-6">
                            <img class="img-fluid" src="{{asset('images/robot-beta.png')}}" alt="{{asset('images/robot-alpha.png')}}">
                        </div>
                    </div>
            </div>
        </section>
        @include('frontend_v2.components.most-interested')
       
        <section id="table-chart" class="py-0 py-lg-5">
            <div class="container">
                <div class="row gy-4 gy-lg-0">
                    <div class="co-12 col-lg-6">
                    <div class="table-responsive" style="max-height: 428px; overflow-y: auto;">
                            <table id="popupDataTable" class="most-interested-table table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>{{__('front_end.symbol')}}</th>
                                        <th>{{__('front_end.price_open')}}</th>
                                        <th>{{__('front_end.open_time')}}</th>
                                        <th>{{__('front_end.price_close')}}</th>
                                        <th>{{__('front_end.close_time')}}</th>
                                        <th>{{__('front_end.profit')}}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="co-12 col-lg-6">
                        <div style="height: 428px;"
                            class="d-flex flex-column justify-content-center align-items-center chart-container">
                            <canvas id="green-beta-chart"></canvas>
                        </div>
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
    
        $(document).ready(function () {
            $('#popupDataTable').DataTable({
                responsive: false,
                autoWidth: false,
                paging: false,
                info: false,
                searching: false,
                
                data: @json($default_chart['list']),
                columns: [
                    { data: 'code' },
                    { data: 'price_open'},
                    { data: 'open_time' },
                    { data: 'price_close'},
                    { data: 'close_time'},
                    { data: 'profit'},
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
        const profitData = @json($default_chart['profit']);
        const ctxBetaChart = document.getElementById('green-beta-chart').getContext('2d');

        // Tạo gradient chiều dọc từ trên xuống dưới
        const greenGradient = ctxBetaChart.createLinearGradient(0, 0, 0, 400);
        greenGradient.addColorStop(0, '#9ACAB3');  // Màu nhạt trên
        greenGradient.addColorStop(1, '#fff');  // Màu đậm dưới

        const greenBetaChart = new Chart(ctxBetaChart, {
            type: 'line',
            data: {
                labels: profitData.map((_, index) => index),
                datasets: [{
                    label: 'Cumulative Profit NAS100 From 2013',
                    data: profitData,
                    backgroundColor: greenGradient,
                    borderColor: '#008000',
                    borderWidth: 0.5,
                    fill: true,
                    pointRadius: 0 // Tùy chọn: ẩn chấm tròn cho mượt
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        beginAtZero: false,
                        ticks: {
                            display: false // Ẩn nhãn trục X nếu cần
                        },
                        grid: {
                            display: false // Ẩn grid nếu muốn sạch biểu đồ
                        }
                    },
                    y: {
                        beginAtZero: false,
                        ticks: {
                            stepSize: 100 // Có thể tinh chỉnh nếu cần
                        },
                        grid: {
                            display: false // Ẩn grid nếu muốn sạch biểu đồ
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        align: 'end',
                        labels: {
                            font: {
                                family: 'Montserrat, sans-serif',
                                size: 14,
                                weight: '400'
                            },
                            color: '#008000',
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    }
                }
            }
        });
        });
</script>

@endpush