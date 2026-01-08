<section id="trading-on" class="py-0 py-lg-5">
    <div class="container">
        <h2 class="text-center services-title py-4 py-lg-5">{{__('base.trade_on')}}</h2>
        <div class="tabs-green">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active btn-tab me-2" id="pills-green-beta-tab"
                            data-bs-toggle="pill"
                            data-bs-target="#pills-green-beta"
                            type="button" role="tab"
                            aria-controls="pills-green-beta"
                            aria-selected="true">{{__('base.green_beta_trading_on')}}</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link btn-tab" id="pills-green-alpha-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-green-alpha" type="button" role="tab"
                            aria-controls="pills-green-alpha"
                            aria-selected="false">{{__('base.green_alpha_trading_on')}}</button>
                </li>
            </ul>
        </div>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-green-beta" role="tabpanel"
                 aria-labelledby="pills-green-beta-tab">
                <div class="trading-container my-3 my-lg-5">
                    <div class="row gy-4 gy-lg-0">
                        <div class="co-12 col-lg-6">
                            <div class="trading-on-content">
                                <div class="head-text">
                                    <span>{{__('base.description_title_green_beta')}}</span>
                                </div>
                                <div class="last-text">
                                    <span>{{__('base.description_title_end_green_beta')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="co-12 col-lg-6">
                            <img class="img-fluid services-img"  src="{{asset('images/robotbeta.jpg')}}" alt="{{asset('images/robotbeta.jpg')}}">
                        </div>
                    </div>
                </div>
                <div style="height: 428px;"
                     class="d-flex flex-column justify-content-center align-items-center chart-container">
                    <canvas id="green-beta-chart"></canvas>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-green-alpha" role="tabpanel"
                 aria-labelledby="pills-green-alpha-tab">
                <div class="trading-container my-4">
                    <div class="row gy-4 gy-lg-0">
                        <div class="co-12 col-lg-6">
                            <img   class="img-fluid services-img" src="{{asset('images/robot-alpha.png')}}" alt="{{asset('images/robot-alpha.png')}}">
                        </div>
                        <div class="co-12 col-lg-6">
                            <div class="trading-on-content">
                                <div class="head-text">
                                    <span>{{__('base.description_title_green_alpha')}}</span>
                                </div>
                                <div class="last-text">
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="height: 428px;"
                     class="d-flex flex-column justify-content-center align-items-center chart-container">
                    <canvas id="green-alpha-chart"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>
@push('scripts')
    <!-- Chart.js + Plugin -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0-rc/dist/chartjs-plugin-datalabels.min.js"></script>

    <script>
        // beta chart

        const profitData = @json($default_chart['nas100']['profit']);
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

        // alpha chart
        // 🔧 Plugin vẽ đường kẻ ngang & dọc nét đứt
        const dashedGridLinesPlugin = {
            id: 'dashedGridLinesPlugin',
            beforeDatasetsDraw(chart, args, pluginOptions) {
                const { ctx, chartArea, scales } = chart;
                if (!chartArea) return; // Bảo vệ khi chart chưa render xong

                // Các tuỳ chọn mặc định
                const {
                    dash = [4, 2],
                    color = '#ccc',
                    lineWidth = 0.5,
                    drawX = true,
                    drawY = true,
                    drawEdgeLines = false
                } = pluginOptions;

                ctx.save();
                ctx.setLineDash(dash);
                ctx.strokeStyle = color;
                ctx.lineWidth = lineWidth;

                // 🔹 Vẽ các đường ngang theo trục Y
                if (drawY) {
                    const yTicks = scales.y.getTicks(); // Chart.js v3+
                    yTicks.forEach(tick => {
                        const y = scales.y.getPixelForValue(tick.value);
                        ctx.beginPath();
                        ctx.moveTo(chartArea.left, y);
                        ctx.lineTo(chartArea.right, y);
                        ctx.stroke();
                    });
                }

                // 🔹 Vẽ các đường dọc theo trục X
                if (drawX) {
                    const xTicks = scales.x.getTicks();
                    xTicks.forEach(tick => {
                        const x = scales.x.getPixelForValue(tick.value);
                        ctx.beginPath();
                        ctx.moveTo(x, chartArea.top);
                        ctx.lineTo(x, chartArea.bottom);
                        ctx.stroke();
                    });
                }

                // 🔹 Tuỳ chọn vẽ đường biên trái/phải
                if (drawEdgeLines) {
                    // Trái
                    ctx.beginPath();
                    ctx.moveTo(chartArea.left, chartArea.top);
                    ctx.lineTo(chartArea.left, chartArea.bottom);
                    ctx.stroke();

                    // Phải
                    ctx.beginPath();
                    ctx.moveTo(chartArea.right, chartArea.top);
                    ctx.lineTo(chartArea.right, chartArea.bottom);
                    ctx.stroke();
                }

                ctx.restore();
            }
        };


        const rawData = @json($data_chart_default);
        const monthlyData = rawData.data.profitByMonth;
        const ctxAlphaChart = document.getElementById('green-alpha-chart').getContext('2d');
        const greenAlphaChart = new Chart(ctxAlphaChart, {
            type: 'bar',
            data: {
                labels: monthlyData.lable,
                datasets: [{
                    label: 'Monthly Profit NAS100',
                    data: monthlyData.profit,
                    backgroundColor: '#008000',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    datalabels: {
                        display: true,
                        anchor: 'end',
                        align: 'end',
                        formatter: value => value + '%',
                        labels: {
                            value: {
                                color: '#008000',
                                font: {
                                    weight: 'bold'
                                }
                            }
                        }
                    },
                    legend: {
                        display: false,
                        labels: {
                            font: {
                                weight: 'bold'
                            }
                        }
                    },
                    dashedGridLinesPlugin: {
                        dash: [4, 2],
                        color: '#00000040',
                        lineWidth: 0.5,
                        drawX: true,
                        drawY: true,
                        drawEdgeLines: true // 👈 Đường viền trái & phải
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            font: {
                                weight: 'bold'
                            }
                        },
                        grid: {
                            display: true // Ẩn grid nếu muốn sạch biểu đồ
                        }
                    },
                    y: {
                        ticks: {
                            font: {
                                weight: 'bold'
                            }
                        },
                        grid: {
                            display: true // Ẩn grid nếu muốn sạch biểu đồ
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    </script>
@endpush

