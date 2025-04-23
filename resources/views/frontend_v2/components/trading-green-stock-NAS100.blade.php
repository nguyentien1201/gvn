<section id="trading-green-stock-NAS100">
    <div class="container">
        <h2 class="text-center NAS100-title">{{__('home.trading_on_green_stock_nas100')}}</h2>
        <div class="trading-container mb-5 d-flex align-items-center justify-content-around">
            <div class="row gy-4 gy-lg-0">
                <div class="co-12 col-lg-6">
                    <img class="img-fluid" src="{{asset('images/home/green-stock-NAS100.png')}}" alt="{{asset('images/home/green-stock-NAS100.png')}}">
                </div>
                <div class="co-12 col-lg-6 d-flex flex-column justify-content-center">
                    <div class="trading-on-content">
                        <div class="head-text mb-2">
                            <span>{{__('home.trading_green_stock_NAS100.title')}}</span>
                        </div>
                        <div class="last-text">
                            <span>
                                {{__('home.trading_green_stock_NAS100.text')}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-stock-rating">
            <div class="row g-custom">
                    <div class="col-12 col-md-12 col-lg-5">
                        <div class="row g-custom">
                            <div class="col-12">
                                <div class="container-chart">
                                    <h4 class="title-chart-buy-cash-hold-sell text-uppercase text-center mb-4 mb-lg-5">{{ __('green_stock.buy_cash_hold_sell') }}</h4>
                                    <div style="height: 363px;"
                                         class="d-flex flex-column justify-content-center align-items-center chart-container">
                                        <canvas id="pieChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="container-chart">
                                    <h4 class="title-chart-buy-cash-hold-sell text-uppercase text-center mb-5">{{ __('green_stock.down_up') }}</h4>
                                    <div style="height: 363px;"
                                         class="d-flex flex-column justify-content-center align-items-center chart-container">
                                        <canvas id="maChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-7">
                        <div class="row g-custom">
                            <div class="col-12">
                                <div class="container-chart">
                                    <h4 class="title-chart-best-top-10 text-uppercase text-center mb-5">{{ __('green_stock.best_top_10') }}</h4>
                                    <div style="height: 900px;"
                                         class="d-flex flex-column justify-content-center align-items-center chart-container">
                                        <canvas id="groupStock"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</section>
@push('scripts')
    <script>
        $(document).ready(function () {
            // pie chart
            const ctx = document.getElementById('pieChart').getContext('2d');
            const myPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: @json($labels),
                    datasets: [{
                        data: @json($chart_signal),
                        backgroundColor: [
                            '#F1C32A',
                            '#198754',
                            '#008000',
                            '#EF5657'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        datalabels: {
                            display: true,
                            formatter: (value) => `${value}%`,
                            labels: {
                                value: {
                                    color: 'white'
                                }
                            }
                        },
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: {
                                    family: 'Montserrat, sans-serif',
                                    size: 16,
                                    weight: '400'
                                },
                                color: '#000C2A',
                                usePointStyle: true,
                                pointStyle: 'circle',
                                pointStyleWidth: 8,
                                boxHeight: 5,
                                padding: 20
                            }
                        }
                    }
                },
                plugins: [ChartDataLabels]
            });

            // ma chart
            const ctxMaChart = document.getElementById('maChart').getContext('2d');
            const fontStyleMaChart = {
                family: 'Montserrat, sans-serif',
                size: 16,
                weight: '400'
            };
            const maChart = new Chart(ctxMaChart, {
                type: 'bar',
                data: {
                    labels: ['MA50', 'MA200'],
                    datasets: [

                        {
                            label: 'UP',
                            data: @json($ma['up']),
                            backgroundColor: '#008000',
                        },
                        {
                            label: 'DOWN',
                            data: @json($ma['down']),
                            backgroundColor: '#EF5657',
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom',
                            labels: {
                                font: fontStyleMaChart,
                                color: '#000C2A',
                                usePointStyle: true,
                                pointStyle: 'circle',
                                pointStyleWidth: 8,
                                boxHeight: 5,
                                padding: 20
                            }
                        },
                        datalabels: {
                            display: true,
                            formatter: value => `${value}%`,
                            labels: {
                                value: {
                                    color: 'white'
                                }
                            }
                        },
                        dashedGridLinesPlugin: {
                            dash: [4, 2],
                            color: '#00000040',
                            lineWidth: 0.5,
                            drawX: true,
                            drawY: true,
                            drawEdgeLines: true
                        }
                    },
                    scales: {
                        x: {
                            stacked: true,
                            ticks: {
                                font: fontStyleMaChart,
                                color: '#000C2A'
                            },
                            grid: { display: false }
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true,
                            ticks: { display: false },
                            grid: { display: false }
                        }
                    }
                },
                plugins: [dashedGridLinesPlugin, ChartDataLabels]
            });

            // group stock
            const barGroupctx = document.getElementById('groupStock').getContext('2d');
            const fontStyleBarGroup = {
                family: 'Montserrat, sans-serif',
                size: 12,
                weight: '400'
            };
            const barGroup = new Chart(barGroupctx, {
                type: 'bar',
                data: {
                    labels: @json($chart_group_data['labels']),
                    datasets: [{
                        label: '', // Ẩn label vì không dùng
                        data: @json($chart_group_data['rate']),
                        backgroundColor: '#008000',
                        barThickness: 20
                    }]
                },
                options: {
                    indexAxis: 'y', // Cột ngang
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            ticks: {
                                font: fontStyleBarGroup,
                                color: '#000C2A'
                            }
                        },
                        y: {
                            ticks: {
                                font: fontStyleBarGroup,
                                color: '#000C2A'
                            }
                        }
                    },
                    plugins: {
                        datalabels: {
                            display: true,
                            formatter: value => `${value}%`,
                            labels: {
                                value: {
                                    color: 'white'
                                }
                            }
                        },
                        legend: {
                            display: false // Ẩn hoàn toàn
                        }
                    }
                },
                plugins: [ChartDataLabels]
            });
        });
    </script>
@endpush

