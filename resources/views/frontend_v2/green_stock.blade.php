@extends('layouts.app')
@section('title', 'Greenstock Nas100')
@push('styles')
<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">

<!-- App CSS -->
<link rel="stylesheet" href="{{ asset('css/green_stock.css') }}">
@endpush
@push('scripts')
<!-- Chart.js + Plugin -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0-rc/dist/chartjs-plugin-datalabels.min.js"></script>

<!-- DataTables with Bootstrap 5 styling -->
<script src="https://cdn.datatables.net/v/bs5/dt-2.0.8/date-1.5.2/fc-5.0.1/fh-4.0.1/r-3.0.2/datatables.min.js"></script>

<!-- Date & Time libraries -->
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment-timezone@0.5.34/builds/moment-timezone-with-data.min.js"></script>

<!-- Feather Icons -->
<script src="https://unpkg.com/feather-icons"></script>

<!-- JS load data and event -->
<script>
    const logoBaseUrl = "{{ asset('images') }}"; // trả ra đường dẫn base
    $('#select-stock').on('select2:select', function(e) {
        let stock_id = $(this).val();
        if (stock_id.trim()) {
            // Gọi AJAX thủ công khi nhấn Enter
            $.ajax({
                url: '{{url("follow-stock")}}/' + stock_id,
                method: 'GET',
                data: {
                    'id': stock_id,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    showAlert(response.message, 'success');
                    if (response.data) {
                        result = JSON.parse(response.data);
                        let code = result.code;
                        let codeImg = logoBaseUrl + '/nas100/' + code + ".svg";

                        var newRow = `
                            <tr data-id="` + result.id + `" >
                                <td>
                                    <div class="code d-flex align-items-center gap-2">
                                        <img style="width: 25px; height: 25px; object-fit: cover;" src="${codeImg}" alt="${codeImg}" class="rounded-circle">
                                        <span>${code}</span>
                                    </div>
                                </td>
                                <td class="text-center">` + result.rating + `</td>
                                <td class="text-center">` + result.price + `</td>
                                <td class="text-center">` + result.current_price + `</td>
                                <td class="text-center"><button class="btn btn-delete btn-sm"><i class="far fa-trash-alt"></i></button></td>
                            </tr>
                        `;
                        $('#my_watch_list tbody').append(newRow);
                    }
                },
                error: function(err) {
                    console.error('Error:', err);
                }
            });
        }
    })

    var isCall = false;
    $(document).ready(function() {

        $('#select-stock').select2({
            placeholder: 'Select an option',
            theme: 'bootstrap-5', // Áp dụng theme Bootstrap 5
            width: '100%' // Đảm bảo Select2 chiếm toàn bộ chiều rộng của element
        });
        $(document).on('click', '.btn-delete', function() {
            var row = $(this).closest('tr'); // Lấy dòng <tr> chứa nút xóa
            var stock_id = row.data('id'); // Lấy ID từ thuộc tính data-id của dòng

            // Hiển thị cảnh báo xác nhận trước khi xóa
            if (confirm('Are you sure you want to unfollow this stock ?')) {
                // Gửi yêu cầu AJAX để xóa bản ghi
                $.ajax({
                    url: '{{url("unfollow-stock")}}/' + stock_id, // Đường dẫn tới controller (sửa cho phù hợp với Laravel route)
                    type: 'DELETE', // Phương thức DELETE
                    data: {
                        "_token": "{{ csrf_token() }}" // CSRF token bảo vệ
                    },
                    success: function(response) {
                        if (response.success) {
                            // Xóa dòng trong bảng nếu xóa thành công
                            row.remove();
                            alert('Record deleted successfully!');
                        } else {
                            alert('Error deleting record.');
                        }
                    },
                    error: function() {
                        alert('Something went wrong.');
                    }
                });
            }
        });
        var ctx = document.getElementById('pieChart').getContext('2d');
        var myPieChart = new Chart(ctx, {
            type: 'pie', // Kiểu biểu đồ là 'pie' (tròn)
            data: {
                labels: @json($labels),
                datasets: [{
                    data: @json($chart_signal), // Dữ liệu cho từng phần của biểu đồ
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
                        display: true, // Hiển thị giá trị

                        formatter: function(value, context) {
                            return value + '%';
                        },
                        labels: {
                            value: {
                                color: 'white'
                            }
                        }
                    },
                    legend: {
                        position: 'bottom', // 👈 Legend xuống dưới chart
                        labels: {
                            font: {
                                family: 'Montserrat, sans-serif', // 👈 Font chữ
                                size: 16, // 👈 Kích thước chữ (px)
                                weight: '400' // 👈 Font-weight (bold/400/600...)
                            },
                            color: '#000C2A',
                            usePointStyle: true, // 👈 Sử dụng hình tròn thay vì hình vuông
                            pointStyle: 'circle', // 👈 Kiểu là hình tròn
                            pointStyleWidth: 8, // 👈 Thu nhỏ width marker (mặc định là ~10-12)
                            boxHeight: 5, // 👈 Thu nhỏ height marker (mặc định là ~10-12)
                            padding: 20 // (Tuỳ chọn) Khoảng cách giữa các legend item
                        }
                    }
                }

            },
            plugins: [ChartDataLabels]
        });

        let limitDefault = $('#selectLimitIndiceTable option:first').val();
        var indices = $('#indices-table').DataTable({
            lengthChange: false, // Ẩn dropdown mặc định
            pageLength: limitDefault,
            paging: true,
            searching: false,
            responsive: false,
            autoWidth: false,
            info: false,
            order: [
                [0, 'asc']
            ],
            data: @json($signals),
            columns: [{
                    data: 'rating'
                }, // Apply bold formatting to the "PriceTrend" column data},
                {
                    data: 'code'
                },
                {
                    data: 'current_price'
                },
                {
                    data: 'trending'
                },
                {
                    data: 'signal'
                },
                {
                    data: 'profit'
                },
                {
                    data: 'post_sale_discount'
                },
                {
                    data: 'price'
                },
                {
                    data: 'time'
                },
            ],
            columnDefs: [{
                    targets: 0, // Index of the date column
                    createdCell: function(td, cellData, rowData, row, col) {
                        bold = '';
                        if (cellData <= 30) {
                            bold = 'bold';
                        }
                        $(td).addClass('text-center');
                        $(td).css('font-weight', bold);
                    },
                },
                {
                    targets: 1, // Index of the date column
                    createdCell: function(td, cellData, rowData, row, col) {
                        $(td).css('font-weight', 'bold');
                        var company = rowData.company_name;

                        $(td).hover(
                            function() {
                                $(this).addClass('row-hover');
                                // Show custom tooltip
                                $('<div class="custom-tooltip">' + company + '</div>').appendTo('body').fadeIn('slow');
                            },
                            function() {
                                $(this).removeClass('row-hover');
                                // Hide custom tooltip
                                $('.custom-tooltip').remove();
                            }
                        ).mousemove(function(e) {
                            // Move tooltip with mouse
                            $('.custom-tooltip').css({
                                top: e.pageY + 15 + 'px',
                                left: e.pageX + 20 + 'px'
                            });
                        });
                    },
                    render: function(data, type, row) {
                        let code = data;
                        let codeImg = logoBaseUrl + '/nas100/' + code + ".svg";
                        let imgHtml = `<img style="width: 25px; height: 25px; object-fit: cover;" src="${codeImg}" alt="${codeImg}" class="rounded-circle">`;
                        let htmlCode = `<div class="code d-flex align-items-center gap-2">${imgHtml}
                                <span>${code}</span>
                            </div>`;
                        return htmlCode;
                    }
                },
                {
                    targets: 2, // Index of the date column
                    createdCell: function(td, cellData, rowData, row, col) {
                        $(td).addClass('text-center');
                    },
                },
                {
                    targets: 3, // Index of the date column
                    createdCell: function(td, cellData, rowData, row, col) {
                        trending = '';
                        color = '';
                        background = '';
                        if (rowData.trending != null) {
                            trending = rowData.trending.trim().toLowerCase();
                        }
                        if (trending == 'breaking high price') {
                            color = '#9B54FF';
                            background = '#E9DBFD';
                        } else if (trending == 'build up') {
                            color = '#F1C32A';
                            background = '#FFF4CE';
                        } else if (trending == 'go up') {
                            color = '#008000';
                            background = '#CCFFCC';
                        } else if (trending == 'bottom fishing') {
                            color = '#008AD9';
                            background = '#BFE8FF';
                        } else if (trending == 'go down') {
                            color = '#FC2F31';
                            background = '#FED6D6';
                        } else if (trending == 'recovery') {
                            color = '#E76A36';
                            background = '#FFDACA';
                        } else if (trending == 'breaking low price') {
                            color = '#F65D60';
                            background = '#FFC1C2';
                        }
                        $(td).html(`<span class="trend text-capitalize" style="
                                display: inline-block;
                                border-radius: 4px;
                                background-color: ${background};
                                color: ${color};
                                border: 1px solid ${color};
                                font-size: 13px;
                                padding: 4px 16px;
                                width: 176px;
                            ">${trending}</span>`);
                        $(td).css('witdh', '176px');
                        $(td).addClass('text-center');
                    }
                },
                {
                    targets: 4, // Index of the date column
                    createdCell: function(td, cellData, rowData, row, col) {
                        signal = '';
                        color = '';
                        background = '';
                        if (cellData != null) {
                            signal = cellData.trim().toLowerCase();
                        }
                        if (signal == 'buy') {
                            color = '#157347';
                            background = '#69E872';
                        } else if (signal == 'hold') {
                            color = '#157347';
                            background = '#CCFFCC';
                        } else if (signal == 'cash') {
                            color = '#F1C32A';
                            background = '#F7EFAF';
                        } else if (signal == 'sell') {
                            color = 'rgb(227, 123, 113)';
                            background = '';
                        }
                        $(td).addClass('text-center');
                        $(td).html(`<span class="action text-capitalize" style="
                                display: inline-block;
                                border-radius: 4px;
                                background-color: ${background};
                                color: ${color};
                                border: 1px solid ${color};
                                font-size: 14px;
                                padding: 4px 16px;
                            ">${signal}</span>`);
                    }
                },
                {
                    targets: 5, // Index of the date column
                    createdCell: function(td, cellData, rowData, row, col) {
                        color = '';
                        if (cellData > 0) {
                            color = '#277248';
                        } else if (cellData < 0) {
                            color = '#EF5657';
                        }
                        $(td).addClass('text-center');
                        $(td).css('color', color);
                    },
                    render: function(data, type, full, meta) {
                        return `${data}%`;
                    }
                },
                {
                    targets: 6, // Index of the date column
                    createdCell: function(td, cellData, rowData, row, col) {
                        color = '';
                        if (cellData > 0) {
                            color = '#277248';
                        } else if (cellData < 0) {
                            color = '#EF5657';
                        }
                        $(td).addClass('text-center');
                        $(td).css('color', color);
                    },

                    render: function(data, type, full, meta) {
                        if (data == 'fas fa-lock') {
                            return '<i style="color:green" class="fas fa-lock"></i>';
                        }
                        if (type === 'display') {
                            return isNaN(parseFloat(data)) ? "" : parseFloat(data).toFixed(2);
                        }
                        return data; //

                    }

                },
                {
                    targets: 7, // Index of the date column
                    createdCell: function(td, cellData, rowData, row, col) {
                        $(td).addClass('text-center');
                    },
                    render: function(data, type, full, meta) {
                        if (data == 'fas fa-lock') {
                            return '<i style="color:#277248" class="fas fa-lock"></i>';
                        }
                        if (type === 'display') {
                            return parseFloat(data).toFixed(2);
                        }
                        return data; //
                    }
                },
                {
                    targets: 8, // Index of the open_time column
                    render: function(data, type, row) {
                        if (data == 'fas fa-lock') {
                            return '<i style="color:green" class="fas fa-lock"></i>';
                        }
                        if (type === 'display' || type === 'filter') {
                            return moment.tz(data, 'Europe/Moscow').format('DD/MM/YYYY'); // Format as HH:mm
                        }
                        return data;
                    }
                },
            ],
            createdRow: function(row, data, dataIndex) {
                if (data.code == 'NAS100') {
                    $(row).css('background-color', 'palegreen');
                }
            }
        });

        $('#selectLimitIndiceTable').on('change', function() {
            const length = parseInt($(this).val());
            indices.page.len(length).draw();
        });
        // Khi user thay đổi dropdown
        // $('#selectLimitIndiceTable').on('change', function () {
        //     const selectedValue = parseInt($(this).val(), 50);
        //     indices.page.len(selectedValue).draw(); // 👈 Cập nhật số dòng hiển thị
        // });

        var barGroupctx = document.getElementById('groupStock').getContext('2d');
        var labelCount = @json($chart_group_data['labels']).length;
        barGroup = new Chart(barGroupctx, {
            type: 'bar',
            data: {
                labels: @json($chart_group_data['labels']),
                datasets: [{
                    label: '',
                    data: @json($chart_group_data['rate']),
                    backgroundColor: '#008000',
                    // fontweight: 600,
                    barThickness: 20,
                }]
            },
            options: {
                indexAxis: 'y', // Chuyển sang biểu đồ cột ngang
                maintainAspectRatio: false, // Cho phép tùy chỉnh tỷ lệ
                lenged: {
                    display: true
                },
                scales: {
                    x: {
                        ticks: {
                            font: {
                                family: 'Montserrat, sans-serif', // 👈 Font chữ
                                size: 12, // 👈 Kích thước chữ (px)
                                weight: '400' // 👈 Font-weight (bold/400/600...)
                            },
                            color: '#000C2A',
                        },
                    },
                    y: {
                        ticks: {
                            font: {
                                family: 'Montserrat, sans-serif', // 👈 Font chữ
                                size: 12, // 👈 Kích thước chữ (px)
                                weight: '400' // 👈 Font-weight (bold/400/600...)
                            },
                            color: '#000C2A',
                        },
                    }
                },
                plugins: {
                    datalabels: {
                        display: true, // Hiển thị giá trị
                        formatter: function(value, context) {
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

        // 🔧 Plugin vẽ đường kẻ ngang & dọc nét đứt
        const dashedGridLinesPlugin = {
            id: 'dashedGridLinesPlugin',
            beforeDatasetsDraw(chart, args, pluginOptions) {
                const {
                    ctx,
                    chartArea,
                    scales
                } = chart;

                const dash = pluginOptions.dash || [4, 2];
                const color = pluginOptions.color || '#ccc';
                const lineWidth = pluginOptions.lineWidth || 0.5;
                const drawX = pluginOptions.drawX !== false;
                const drawY = pluginOptions.drawY !== false;
                const drawEdgeLines = pluginOptions.drawEdgeLines !== false;

                ctx.save();
                ctx.setLineDash(dash);
                ctx.strokeStyle = color;
                ctx.lineWidth = lineWidth;

                // 🔹 Grid ngang (trục Y)
                if (drawY) {
                    scales.y.ticks.forEach((tick) => {
                        const y = scales.y.getPixelForValue(tick.value);
                        ctx.beginPath();
                        ctx.moveTo(chartArea.left, y);
                        ctx.lineTo(chartArea.right, y);
                        ctx.stroke();
                    });
                }

                // 🔹 Grid dọc (trục X)
                if (drawX) {
                    scales.x.ticks.forEach((tick) => {
                        const x = scales.x.getPixelForValue(tick.value);
                        ctx.beginPath();
                        ctx.moveTo(x, chartArea.bottom);
                        ctx.lineTo(x, chartArea.top);
                        ctx.stroke();
                    });
                }

                // 🔹 Đường biên trái & phải (cạnh trục Y)
                // if (drawEdgeLines) {
                //     ctx.beginPath();
                //     ctx.moveTo(chartArea.left, chartArea.top);
                //     ctx.lineTo(chartArea.left, chartArea.bottom);
                //     ctx.stroke();
                //
                //     ctx.beginPath();
                //     ctx.moveTo(chartArea.right, chartArea.top);
                //     ctx.lineTo(chartArea.right, chartArea.bottom);
                //     ctx.stroke();
                // }

                ctx.restore();
            }
        };

        const ctxMaChart = document.getElementById('maChart').getContext('2d');
        const maChart = new Chart(ctxMaChart, {
            type: 'bar',
            data: {
                labels: ['MA50', 'MA200'],
                datasets: [

                    {
                        label: 'DOWN',
                        data: @json($ma['down']),
                        backgroundColor: '#EF5657',
                    },
                    {
                        label: 'UP',
                        data: @json($ma['up']),
                        backgroundColor: '#008000',
                    }
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                        position: 'bottom', // 👈 Legend xuống dưới chart
                        labels: {
                            font: {
                                family: 'Montserrat, sans-serif', // 👈 Font chữ
                                size: 16, // 👈 Kích thước chữ (px)
                                weight: '400' // 👈 Font-weight (bold/400/600...)
                            },
                            color: '#000C2A',
                            usePointStyle: true, // 👈 Sử dụng hình tròn thay vì hình vuông
                            pointStyle: 'circle', // 👈 Kiểu là hình tròn
                            pointStyleWidth: 8, // 👈 Thu nhỏ width marker (mặc định là ~10-12)
                            boxHeight: 5, // 👈 Thu nhỏ height marker (mặc định là ~10-12)
                            padding: 20 // (Tuỳ chọn) Khoảng cách giữa các legend item
                        }
                    },
                    datalabels: {
                        display: true, // Hiển thị giá trị
                        formatter: function(value, context) {
                            return value + '%';
                        },
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
                        drawEdgeLines: true // 👈 Đường viền trái & phải
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            font: {
                                family: 'Montserrat, sans-serif', // 👈 Font chữ
                                size: 16, // 👈 Kích thước chữ (px)
                                weight: '400' // 👈 Font-weight (bold/400/600...)
                            },
                            color: '#000C2A',
                        },
                        stacked: true,
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        ticks: {
                            display: false // 👈 Tắt số trục Y
                        },
                        stacked: true,
                        beginAtZero: true,
                        grid: {
                            display: false
                        }
                    }
                },

            },
            plugins: [dashedGridLinesPlugin, ChartDataLabels]
        });

    });

    $(document).on('click', '#pills-market-overview-tab', function() {
        if (isCall == true) return;
        const endColorDown = "rgb(255, 0, 0)"; // Red
        const startColorDown = "rgb(255, 255, 0)"; // Yellow
        const steps = 5;
        const startColorUp = "rgb(5, 100, 40)"; // Red
        const endColorUp = "rgb(8, 190, 75)"; // Yellow
        var barCurentMonthGroup = null;

        function showChart(index) {
            // Ẩn tất cả các datasets
            barCurentMonthGroup.data.datasets.forEach((dataset, i) => {
                dataset.hidden = true;
            });

            // Hiển thị dataset theo index
            barCurentMonthGroup.data.datasets[index].hidden = false;

            // Cập nhật biểu đồ
            barCurentMonthGroup.update();
        }

        // Mặc định hiển thị biểu đồ đầu tiên
        var url = '/api/get-market-greenstock';
        $.ajax({
            url: url,
            type: 'GET',
            success: function(data) {
                isCall = true;
                var result = data.data;
                // Generate market cap items
                var market_cap_data = result.market_cap;
                if (market_cap_data) {
                    // Remove old content before append new content
                    $('.market-capital-container .row').html('');
                    market_cap_data.forEach(item => {
                        // Map group -> order
                        const orderMap = {
                            'Large Cap': 1,
                            'NAS100': 2,
                            'Mega Cap': 3,
                            'Mid Cap': 4,
                            'Small Cap': 5
                        };
                        // Map group -> màu class
                        const colorMap = {
                            'Large Cap': '#008000',
                            'NAS100': '#ECC546',
                            'Mega Cap': '#F4A953',
                            'Mid Cap': '#FC8B3A',
                            'Small Cap': '#EF5657'
                        };
                        const orderClass = orderMap[item.group] || ''; // default rỗng nếu không khớp
                        const backgroundStyle = colorMap[item.group] || ''; // default rỗng nếu không khớp

                        var html = `
                            <div class="col ${orderClass}">
                                <div style="background: ${backgroundStyle}" class="card-market-capital d-flex justify-content-between gap-2">
                                    <div class="content-dynamic d-flex flex-column">
                                        <span class="title">${item.group}</span>
                                        <span class="percent">${item.avg_day}%</span>
                                    </div>
                                    <div class="content-static d-flex justify-content-end flex-column">
                                        <span>Avg. Group/Day</span>
                                    </div>
                                </div>
                            </div>
                        `;
                        $('.market-capital-container .row').append(html);
                    })
                }

                const ctxcapChart = document.getElementById('capChart').getContext('2d');
                // Plugin custom để vẽ label nằm cuối cột, có màu theo cột
                const customLabelPlugin = {
                    id: 'customLabels',
                    afterDatasetsDraw(chart) {
                        const ctx = chart.ctx;
                        ctx.save();
                        chart.data.datasets.forEach((dataset, datasetIndex) => {
                            const meta = chart.getDatasetMeta(datasetIndex);
                            if (!meta || !meta.data) return;
                            meta.data.forEach((bar, index) => {
                                const value = dataset.data[index];
                                if (value === null || value === undefined || value === 0) return;
                                const label = value.toLocaleString('vi-VN');
                                const x = value > 0 ? bar.x + bar.width / 4 : bar.x - bar.width / 4;
                                const y = value > 0 ? bar.y - 8 : bar.y - bar.height - 8;
                                // 🎨 Lấy màu từ function hoặc mảng/backgroundColor
                                let color = '#000';
                                if (typeof dataset.backgroundColor === 'function') {
                                    color = dataset.backgroundColor({
                                        chart,
                                        dataset,
                                        dataIndex: index
                                    }) || '#000';
                                } else if (Array.isArray(dataset.backgroundColor)) {
                                    color = dataset.backgroundColor[index] || '#000';
                                } else if (typeof dataset.backgroundColor === 'string') {
                                    color = dataset.backgroundColor;
                                }
                                ctx.font = '500 14px Montserrat, sans-serif';
                                ctx.fillStyle = color;
                                ctx.textAlign = 'center';
                                ctx.textBaseline = 'middle';
                                ctx.fillText(label, x, y);
                            });
                        });
                        ctx.restore();
                    }
                };

                const capChart = new Chart(ctxcapChart, {
                    type: 'bar',
                    data: {
                        labels: ['Tổng dòng tiền lời 5 phiên', 'Tổng dòng tiền lỗ 5 phiên'],
                        datasets: [{
                                data: [result.cap[0], null],
                                label: 'WIN',
                                backgroundColor: function(context) {
                                    const data = context?.dataset?.data;
                                    const value = data ? data[context.dataIndex] : null;
                                    if (value === null || value === undefined) return 'transparent';
                                    return value < 0 ? '#EF5657' : '#008000';
                                },
                                borderColor: 'rgba(255, 99, 132, 0)', // Ẩn border bằng cách đặt alpha = 0
                                borderWidth: 0, // Đặt borderWidth thành 0 để ẩn hoàn toàn đường viền
                                barPercentage: 2.0,
                                categoryPercentage: 2.0
                            },
                            {
                                data: [null, result.cap[1]],
                                label: 'LOSS',
                                backgroundColor: '#EF5657',
                                borderColor: 'rgba(255, 99, 132, 0)', // Ẩn border bằng cách đặt alpha = 0
                                borderWidth: 0, // Đặt borderWidth thành 0 để ẩn hoàn toàn đường viền
                                barPercentage: 2.0,
                                categoryPercentage: 2.0
                            },
                        ]
                    },
                    options: {
                        maintainAspectRatio: false,
                        responsive: true,
                        plugins: {
                            legend: {
                                onHover: function(event, legendItem, legend) {
                                    event.native.target.style.cursor = 'pointer';
                                },
                                onLeave: function(event, legendItem, legend) {
                                    event.native.target.style.cursor = 'default';
                                },
                                onClick: () => {}, // ✅ Vô hiệu hóa sự kiện click legend
                                display: true,
                                position: 'bottom', // 👈 Legend xuống dưới chart
                                labels: {
                                    font: {
                                        family: 'Montserrat, sans-serif', // 👈 Font chữ
                                        size: 16, // 👈 Kích thước chữ (px)
                                        weight: '400' // 👈 Font-weight (bold/400/600...)
                                    },
                                    color: '#000C2A',
                                    usePointStyle: true, // 👈 Sử dụng hình tròn thay vì hình vuông
                                    pointStyle: 'circle', // 👈 Kiểu là hình tròn
                                    pointStyleWidth: 8, // 👈 Thu nhỏ width marker (mặc định là ~10-12)
                                    boxHeight: 5, // 👈 Thu nhỏ height marker (mặc định là ~10-12)
                                    padding: 20 // (Tuỳ chọn) Khoảng cách giữa các legend item
                                }
                            },
                            // datalabels: {
                            //     display: true, // Hiển thị giá trị
                            //     anchor: 'center', // neo ở giữa cột
                            //     align: function (context) {
                            //         if (context.dataIndex === 0) return 'end';    // label1 → phải
                            //         if (context.dataIndex === 1) return 'start';  // label2 → trái
                            //         return 'center';
                            //     },
                            //     offset: 100, // khoảng cách ra khỏi cột
                            //     formatter: function (value, context) {
                            //         if (value === null || value === 0) return ''; // 👈 ẩn label nếu null/0
                            //         return value.toLocaleString();
                            //     },
                            //     labels: {
                            //         value: {
                            //             font: {
                            //                 family: 'Montserrat, sans-serif',   // 👈 Font chữ
                            //                 size: 14,                           // 👈 Kích thước chữ (px)
                            //                 weight: '600'                       // 👈 Font-weight (bold/400/600...)
                            //             },
                            //             color: '#008000',
                            //         }
                            //     }
                            // },
                        },
                        scales: {
                            x: {
                                ticks: {
                                    display: false,
                                }
                            },
                            y: {
                                ticks: {
                                    font: {
                                        family: 'Montserrat, sans-serif', // 👈 Font chữ
                                        size: 14, // 👈 Kích thước chữ (px)
                                        weight: '400' // 👈 Font-weight (bold/400/600...)
                                    },
                                    color: '#000C2A',
                                }
                            }
                        }
                    },
                    plugins: [customLabelPlugin]
                });

                var current_monthctx = document.getElementById('current_month').getContext('2d');
                barCurentMonthGroup = new Chart(current_monthctx, {
                    type: 'bar',
                    barPercentage: 0.5,
                    barThickness: 20,
                    categoryPercentage: 0.5,
                    data: {
                        labels: result.chart_group_data.current_month.labels,
                        datasets: [{
                                label: 'Current Month',
                                data: result.chart_group_data.current_month.values,
                                backgroundColor: '#008000',
                                fontweight: 600,
                                minBarLength: 5,
                                hidden: false // Hiển thị mặc định
                            },
                            {
                                label: 'Current Quarter',
                                data: result.chart_group_data.quarter.values,
                                backgroundColor: '#008000',
                                fontweight: 600,
                                minBarLength: 5,
                                hidden: true // Hiển thị mặc định
                            },
                            {
                                label: 'Current Year',
                                data: result.chart_group_data.current_year.values,
                                backgroundColor: '#008000',
                                fontweight: 600,
                                minBarLength: 5,
                                hidden: true // Hiển thị mặc định
                            },
                        ]
                    },
                    options: {
                        indexAxis: 'y', // Chuyển sang biểu đồ cột ngang
                        responsive: true, // Cho phép tùy chỉnh tỷ lệ
                        maintainAspectRatio: false, // Cho phép tự điều chỉnh theo container
                        lenged: {
                            onHover: function(event, legendItem, legend) {
                                event.native.target.style.cursor = 'pointer';
                            },
                            onLeave: function(event, legendItem, legend) {
                                event.native.target.style.cursor = 'default';
                            },
                            display: true,
                        },
                        plugins: {
                            tooltip: {
                                enabled: true, // Bật tooltip
                                position: 'nearest', // Vị trí mặc định là gần nhất
                                yAlign: 'bottom', // Vị trí tooltip phía dưới
                                xAlign: 'center', // Vị trí trung tâm theo trục x
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return `Giá trị: ${tooltipItem.raw}`;
                                    }
                                }
                            },
                            datalabels: {
                                display: true, // Hiển thị giá trị
                                anchor: function(context) {
                                    const value = context.dataset.data[context.dataIndex];
                                    return value > 0 ? 'end' : 'start'; // Nếu giá trị > 0, đặt ở cuối cột, ngược lại đặt ở đầu cột
                                },
                                align: function(context) {
                                    const value = context.dataset.data[context.dataIndex];
                                    return value > 0 ? 'end' : 'start'; // Nếu giá trị > 0, căn chỉnh với cuối cột, ngược lại căn chỉnh với đầu cột
                                },
                                formatter: function(value, context) {
                                    return window.innerWidth < 768 ? "" : value + '%';
                                },
                                labels: {
                                    value: {
                                        color: '#008000',
                                        family: 'Montserrat, sans-serif', // 👈 Font chữ
                                        size: 10,
                                        weight: 500,
                                    }
                                }
                            },
                            legend: {
                                position: 'bottom', // 👈 Legend xuống dưới chart
                                labels: {
                                    font: {
                                        family: 'Montserrat, sans-serif', // 👈 Font chữ
                                        size: 16, // 👈 Kích thước chữ (px)
                                        weight: '400' // 👈 Font-weight (bold/400/600...)
                                    },
                                    color: '#000C2A',
                                    usePointStyle: true, // 👈 Sử dụng hình tròn thay vì hình vuông
                                    pointStyle: 'circle', // 👈 Kiểu là hình tròn
                                    pointStyleWidth: 8, // 👈 Thu nhỏ width marker (mặc định là ~10-12)
                                    boxHeight: 5, // 👈 Thu nhỏ height marker (mặc định là ~10-12)
                                    padding: 20 // (Tuỳ chọn) Khoảng cách giữa các legend item
                                },
                                onClick: (e, legendItem, legend) => {
                                    // Xử lý sự kiện khi nhấp vào nhãn trong legend
                                    const datasetIndex = legendItem.datasetIndex;
                                    showChart(datasetIndex);
                                }
                            },
                        },
                        scales: {
                            y: {
                                ticks: {
                                    display: false,
                                },
                                grid: {
                                    display: false // Ẩn lưới dọc
                                }
                            }
                        },
                        onHover: (event, chartElement) => {
                            const targetCanvas = event.native.target;
                            // Nếu có phần tử dưới con trỏ chuột, thay đổi con trỏ thành pointer
                            if (chartElement.length) {
                                targetCanvas.style.cursor = 'pointer';
                            } else {
                                // Nếu không có phần tử nào, đặt lại con trỏ mặc định
                                targetCanvas.style.cursor = 'default';
                            }
                        },
                        onClick: function(evt) {
                            let activePoints = barCurentMonthGroup.getElementsAtEventForMode(evt, 'nearest', {
                                intersect: true
                            }, true);
                            if (activePoints.length > 0) {
                                let clickedDatasetIndex = activePoints[0].datasetIndex;
                                let clickedElementIndex = activePoints[0].index;
                                let label = barCurentMonthGroup.data.labels[clickedElementIndex];
                                let value = barCurentMonthGroup.data.datasets[clickedDatasetIndex].data[clickedElementIndex];

                                // Gọi AJAX khi click vào phần tử
                                $.ajax({
                                    url: '/api/get-top-stock',
                                    method: 'GET',
                                    type: 'GET',
                                    data: {
                                        label: label
                                    },
                                    success: function(response) {
                                        data = response.data;
                                        if ($.fn.dataTable.isDataTable('#top_stock')) {
                                            $('#top_stock').DataTable().destroy();
                                        }
                                        top_stock = $('#top_stock').DataTable({
                                            searching: false,
                                            lengthChange: false, //
                                            responsive: false,
                                            paging: false,
                                            autoWidth: false,
                                            info: false,
                                            order: [
                                                [0, 'asc']
                                            ],
                                            data: data,
                                            columns: [{
                                                    data: 'rating'
                                                }, // Apply bold formatting to the "PriceTrend" column data},
                                                {
                                                    data: 'code',
                                                },
                                                {
                                                    data: 'current_price'
                                                },
                                                {
                                                    data: 'trending'
                                                },
                                                {
                                                    data: 'signal'
                                                },
                                                {
                                                    data: 'profit'
                                                },
                                                {
                                                    data: 'post_sale_discount',
                                                },
                                                {
                                                    data: 'price'
                                                },
                                                {
                                                    data: 'time'
                                                },
                                            ],
                                            columnDefs: [{
                                                    targets: 0, // Index of the date column
                                                    createdCell: function(td, cellData, rowData, row, col) {
                                                        bold = '';
                                                        if (cellData <= 30) {
                                                            bold = 'bold';
                                                        }
                                                        $(td).addClass('text-center');
                                                        $(td).css('font-weight', bold);
                                                    },
                                                },
                                                {
                                                    targets: 1, // Index of the date column
                                                    createdCell: function(td, cellData, rowData, row, col) {
                                                        $(td).css('font-weight', 'bold');

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
                                                    render: function(data, type, row) {
                                                        if (data == 'fas fa-lock') {
                                                            return '<i style="color:green" class="fas fa-lock"></i>';
                                                        }
                                                        let code = data;
                                                        let codeImg = logoBaseUrl + '/nas100/' + code + ".svg";
                                                        let codeHtml = `<div class="code d-flex align-items-center gap-2">
                                                                <img style="width: 25px; height: 25px; object-fit: cover;" src="${codeImg}" alt="${codeImg}" class="rounded-circle">
                                                                <span>${code}</span>
                                                            </div>`;
                                                        return codeHtml;
                                                    }
                                                },
                                                {
                                                    targets: 3, // Index of the date column
                                                    createdCell: function(td, cellData, rowData, row, col) {
                                                        trending = '';
                                                        color = '';
                                                        background = '';
                                                        if (rowData.trending != null) {
                                                            trending = rowData.trending.trim().toLowerCase();
                                                        }
                                                        if (trending == 'breaking high price') {
                                                            color = '#9B54FF';
                                                            background = '#E9DBFD';
                                                        } else if (trending == 'build up') {
                                                            color = '#F1C32A';
                                                            background = '#FFF4CE';
                                                        } else if (trending == 'go up') {
                                                            color = '#008000';
                                                            background = '#CCFFCC';
                                                        } else if (trending == 'bottom fishing') {
                                                            color = '#008AD9';
                                                            background = '#BFE8FF';
                                                        } else if (trending == 'go down') {
                                                            color = '#FC2F31';
                                                            background = '#FED6D6';
                                                        } else if (trending == 'recovery') {
                                                            color = '#E76A36';
                                                            background = '#FFDACA';
                                                        } else if (trending == 'breaking low price') {
                                                            color = '#F65D60';
                                                            background = '#FFC1C2';
                                                        }
                                                        $(td).addClass('text-center');
                                                        $(td).html(`<span class="trend text-capitalize" style="
                                                            display: inline-block;
                                                            border-radius: 4px;
                                                            background-color: ${background};
                                                            color: ${color};
                                                            border: 1px solid ${color};
                                                            font-size: 13px;
                                                            padding: 4px 16px;
                                                            width: 176px;
                                                        ">${trending}</span>`);
                                                        $(td).css('witdh', '176px');
                                                    }
                                                },
                                                {
                                                    targets: 4, // Index of the date column
                                                    createdCell: function(td, cellData, rowData, row, col) {
                                                        signal = '';
                                                        color = '';
                                                        background = '';
                                                        if (cellData != null) {
                                                            signal = cellData.trim().toLowerCase();
                                                        }
                                                        if (signal == 'buy') {
                                                            color = '#157347';
                                                            background = '#69E872';
                                                        } else if (signal == 'hold') {
                                                            color = '#157347';
                                                            background = '#CCFFCC';
                                                        } else if (signal == 'cash') {
                                                            color = '#F1C32A';
                                                            background = '#F7EFAF';
                                                        } else if (signal == 'sell') {
                                                            color = 'rgb(227, 123, 113)';
                                                            background = '';
                                                        }
                                                        $(td).addClass('text-center');
                                                        $(td).html(`<span class="action text-capitalize" style="
                                                            display: inline-block;
                                                            border-radius: 4px;
                                                            background-color: ${background};
                                                            color: ${color};
                                                            border: 1px solid ${color};
                                                            font-size: 14px;
                                                            padding: 4px 16px;
                                                        ">${signal}</span>`);
                                                    }
                                                },
                                                {
                                                    targets: 5, // Index of the date column
                                                    createdCell: function(td, cellData, rowData, row, col) {
                                                        color = '';
                                                        if (cellData > 0) {
                                                            color = '#277248';
                                                        } else if (cellData < 0) {
                                                            color = '#EF5657';
                                                        }
                                                        $(td).css('color', color);
                                                    },
                                                    render: function(data, type, full, meta) {
                                                        return `${data}%`;
                                                    }
                                                },
                                                {
                                                    targets: 6, // Index of the date column
                                                    createdCell: function(td, cellData, rowData, row, col) {
                                                        color = '';
                                                        if (cellData > 0) {
                                                            color = '#277248';
                                                        } else if (cellData < 0) {
                                                            color = '#EF5657';
                                                        }
                                                        $(td).css('color', color);
                                                    },
                                                    render: function(data, type, full, meta) {
                                                        if (data == 'fas fa-lock') {
                                                            return '<i style="color:green" class="fas fa-lock"></i>';
                                                        }
                                                        if (type === 'display') {
                                                            return isNaN(parseFloat(data)) ? "" : parseFloat(data).toFixed(2);
                                                        }
                                                        return data; //

                                                    }
                                                },
                                                {
                                                    targets: 7, // Index of the price column
                                                    render: function(data, type, full, meta) {
                                                        if (type === 'display') {
                                                            return parseFloat(data).toFixed(2);
                                                        }
                                                        return data; //

                                                    }
                                                },
                                                {
                                                    targets: 8, // Index of the open_time column
                                                    render: function(data, type, row) {
                                                        if (data == 'fas fa-lock') {
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
                                    }
                                })
                            }
                        }
                    },
                    plugins: [ChartDataLabels]
                });

                showChart(0);
                var top_stock = $('#top_stock').DataTable({
                    searching: false,
                    lengthChange: false, //
                    responsive: true,
                    paging: false,
                    autoWidth: false,
                    info: false,
                    order: [
                        [0, 'asc']
                    ],
                    data: result.top_stock,
                    columns: [{
                            data: 'rating'
                        }, // Apply bold formatting to the "PriceTrend" column data},
                        {
                            data: 'code'
                        },
                        {
                            data: 'current_price'
                        },
                        {
                            data: 'trending'
                        },
                        {
                            data: 'signal'
                        },
                        {
                            data: 'profit'
                        },
                        {
                            data: 'post_sale_discount'
                        },
                        {
                            data: 'price'
                        },
                        {
                            data: 'time'
                        },
                    ],
                    columnDefs: [{
                            targets: 0, // Index of the date column
                            createdCell: function(td, cellData, rowData, row, col) {
                                bold = '';
                                if (cellData <= 30) {
                                    bold = 'bold';
                                }
                                $(td).addClass('text-center');
                                $(td).css('font-weight', bold);
                            },
                        },
                        {
                            targets: 1, // Index of the date column
                            createdCell: function(td, cellData, rowData, row, col) {
                                $(td).css('font-weight', 'bold');
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
                            render: function(data, type, row) {
                                if (data == 'fas fa-lock') {
                                    return '<i style="color:green" class="fas fa-lock"></i>';
                                }
                                let code = data;
                                let codeImg = logoBaseUrl + '/nas100/' + code + ".svg";
                                let codeHtml = `<div class="code d-flex align-items-center gap-2">
                                        <img style="width: 25px; height: 25px; object-fit: cover;" src="${codeImg}" alt="${codeImg}" class="rounded-circle">
                                        <span>${code}</span>
                                    </div>`;
                                return codeHtml;
                            }
                        },
                        {
                            targets: 3, // Index of the date column
                            createdCell: function(td, cellData, rowData, row, col) {
                                trending = '';
                                color = '';
                                background = '';
                                if (rowData.trending != null) {
                                    trending = rowData.trending.trim().toLowerCase();
                                }
                                if (trending == 'breaking high price') {
                                    color = '#9B54FF';
                                    background = '#E9DBFD';
                                } else if (trending == 'build up') {
                                    color = '#F1C32A';
                                    background = '#FFF4CE';
                                } else if (trending == 'go up') {
                                    color = '#008000';
                                    background = '#CCFFCC';
                                } else if (trending == 'bottom fishing') {
                                    color = '#008AD9';
                                    background = '#BFE8FF';
                                } else if (trending == 'go down') {
                                    color = '#FC2F31';
                                    background = '#FED6D6';
                                } else if (trending == 'recovery') {
                                    color = '#E76A36';
                                    background = '#FFDACA';
                                } else if (trending == 'breaking low price') {
                                    color = '#F65D60';
                                    background = '#FFC1C2';
                                }
                                $(td).addClass('text-center');
                                $(td).html(`<span class="trend text-capitalize" style="
                                display: inline-block;
                                border-radius: 4px;
                                background-color: ${background};
                                color: ${color};
                                border: 1px solid ${color};
                                font-size: 13px;
                                padding: 4px 16px;
                                width: 176px;
                            ">${trending}</span>`);
                                $(td).css('witdh', '176px');
                            }
                        },
                        {
                            targets: 4, // Index of the date column
                            createdCell: function(td, cellData, rowData, row, col) {
                                signal = '';
                                color = '';
                                background = '';
                                if (cellData != null) {
                                    signal = cellData.trim().toLowerCase();
                                }
                                if (signal == 'buy') {
                                    color = '#157347';
                                    background = '#69E872';
                                } else if (signal == 'hold') {
                                    color = '#157347';
                                    background = '#CCFFCC';
                                } else if (signal == 'cash') {
                                    color = '#F1C32A';
                                    background = '#F7EFAF';
                                } else if (signal == 'sell') {
                                    color = 'rgb(227, 123, 113)';
                                    background = '';
                                }
                                $(td).addClass('text-center');
                                $(td).html(`<span class="action text-capitalize" style="
                                    display: inline-block;
                                    border-radius: 4px;
                                    background-color: ${background};
                                    color: ${color};
                                    border: 1px solid ${color};
                                    font-size: 14px;
                                    padding: 4px 16px;
                                ">${signal}</span>`);
                            }
                        },
                        {
                            targets: 5, // Index of the date column
                            createdCell: function(td, cellData, rowData, row, col) {
                                color = '';
                                if (cellData > 0) {
                                    color = '#277248';
                                } else if (cellData < 0) {
                                    color = '#EF5657';
                                }
                                $(td).css('color', color);
                            },
                            render: function(data, type, full, meta) {
                                return `${data}%`;
                            }
                        },
                        {
                            targets: 6, // Index of the date column
                            createdCell: function(td, cellData, rowData, row, col) {
                                color = '';
                                if (cellData > 0) {
                                    color = '#277248';
                                } else if (cellData < 0) {
                                    color = '#EF5657';
                                }
                                $(td).css('color', color);
                            },
                            render: function(data, type, full, meta) {
                                if (data == 'fas fa-lock') {
                                    return '<i style="color:green" class="fas fa-lock"></i>';
                                }
                                if (type === 'display') {
                                    return isNaN(parseFloat(data)) ? "" : parseFloat(data).toFixed(2);
                                }
                                return data; //

                            }
                        },
                        {
                            targets: 7, // Index of the price column
                            render: function(data, type, full, meta) {
                                if (type === 'display') {
                                    return parseFloat(data).toFixed(2);
                                }
                                return data; //

                            }
                        },
                        {
                            targets: 8, // Index of the open_time column
                            render: function(data, type, row) {
                                if (data == 'fas fa-lock') {
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
                // top_stock
                var ctxavg_cap = document.getElementById('avg_cap').getContext('2d');
                var mappedLabels = [];
                var rawLabels = result.chart_group_data.avg_cap?.labels; // optional chaining

                if (Array.isArray(rawLabels)) {
                    mappedLabels = rawLabels
                        .filter(label => typeof label === 'string') // lọc an toàn
                        .map(label => customSplit(label));
                }
                avg_capBar = new Chart(ctxavg_cap, {
                    type: 'bar',
                    data: {
                        labels: mappedLabels,
                        datasets: [{
                            data: result.chart_group_data.avg_cap.values,
                            label: '',
                            backgroundColor: '#008000',
                            borderWidth: 1,
                            fontweight: 400,
                            borderRadius: 4,
                            barThickness: 40,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                onHover: function(event, legendItem, legend) {
                                    event.native.target.style.cursor = 'pointer';
                                },
                                onLeave: function(event, legendItem, legend) {
                                    event.native.target.style.cursor = 'default';
                                },
                                display: false,
                            },
                            datalabels: {
                                display: false, // Hiển thị giá trị
                                anchor: 'end',
                                align: 'end',
                                formatter: function(value, context) {
                                    return value + '%';
                                },
                                labels: {
                                    value: {
                                        color: '#008000',
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
                                        style: 'normal', // 👈 bỏ italic
                                        family: 'Montserrat, sans-serif', // 👈 Font chữ
                                        size: 12, // 👈 Kích thước chữ (px)
                                        weight: '400' // 👈 Font-weight (bold/400/600...)
                                    },
                                    color: '#000C2A',
                                    maxRotation: 0,
                                    minRotation: 0
                                },
                            },
                            y: {
                                ticks: {
                                    font: {
                                        family: 'Montserrat, sans-serif', // 👈 Font chữ
                                        size: 14, // 👈 Kích thước chữ (px)
                                        weight: '400' // 👈 Font-weight (bold/400/600...)
                                    },
                                    color: '#000C2A',
                                }
                            }
                        }

                    },
                    plugins: [ChartDataLabels]
                });

                function customSplit(str) {
                    if (typeof str !== 'string') return [];

                    const parts = str.trim().split(' ');
                    const result = [];

                    for (let part of parts) {
                        if (part.includes('/')) {
                            // Tách từng phần có /
                            const split = part.split('/');
                            for (let i = 0; i < split.length; i++) {
                                const p = split[i];
                                if (p) {
                                    if (i < split.length - 1) {
                                        result.push(p + '/'); // giữ dấu /
                                    } else {
                                        result.push(p);
                                    }
                                }
                            }
                        } else {
                            result.push(part);
                        }
                    }

                    return result;
                }

                var ctx_ma = document.getElementById('group_ma').getContext('2d');
                var mappedMaLabels = [];
                var rawMaLabels = result.ma?.labels; // optional chaining

                if (Array.isArray(rawMaLabels)) {
                    mappedMaLabels = rawMaLabels
                        .filter(label => typeof label === 'string') // lọc an toàn
                        .map(label => customSplit(label));
                }
                const chart = new Chart(ctx_ma, {
                    type: 'line',
                    data: {
                        labels: mappedMaLabels,
                        datasets: [{
                                label: 'Index',
                                data: result.ma.nas100_values,
                                borderColor: '#EF5657',
                                backgroundColor: '#EF5657',
                                yAxisID: 'y', // Gắn với trục y đầu tiên
                                color: 'white',
                                borderWidth: 1,
                                pointRadius: 0,
                                fill: false
                            },
                            {
                                label: 'MA200',
                                data: result.ma.ma200_values,
                                borderColor: '#008000',
                                backgroundColor: '#008000',
                                yAxisID: 'y1', // Gắn với trục y thứ hai
                                color: 'white',
                                borderWidth: 1,
                                pointRadius: 0,
                                fill: false
                            },
                            {
                                label: 'MA50',
                                data: result.ma.ma50_values,
                                borderColor: '#F1C32A',
                                backgroundColor: '#F1C32A',
                                yAxisID: 'y1', // Gắn với trục y thứ hai
                                color: 'white',
                                borderWidth: 1,
                                pointRadius: 0,
                                fill: false
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                onHover: function(event, legendItem, legend) {
                                    event.native.target.style.cursor = 'pointer';
                                },
                                onLeave: function(event, legendItem, legend) {
                                    event.native.target.style.cursor = 'default';
                                },
                                display: true,
                                labels: {
                                    font: {
                                        family: 'Montserrat, sans-serif', // 👈 Font chữ
                                        size: 16, // 👈 Kích thước chữ (px)
                                        weight: '400' // 👈 Font-weight (bold/400/600...)
                                    },
                                    color: '#000C2A',
                                    usePointStyle: true, // 👈 Sử dụng hình tròn thay vì hình vuông
                                    pointStyle: 'circle', // 👈 Kiểu là hình tròn
                                    pointStyleWidth: 8, // 👈 Thu nhỏ width marker (mặc định là ~10-12)
                                    boxHeight: 5, // 👈 Thu nhỏ height marker (mặc định là ~10-12)
                                    padding: 20 // (Tuỳ chọn) Khoảng cách giữa các legend item
                                }
                            },
                        },
                        scales: {
                            x: {
                                ticks: {
                                    maxRotation: 0,
                                    minRotation: 0,
                                    // callback: function(value) {
                                    //     const month = parseInt(this.getLabelForValue(value));
                                    //     if (month === 12) {
                                    //         return '2024'; // hoặc new Date().getFullYear()
                                    //     }
                                    //
                                    //     // Tạo Date object tạm để lấy tên tháng viết tắt
                                    //     const date = new Date(2023, month - 1); // tháng trong JS là 0-indexed
                                    //     return date.toLocaleString('en-US', { month: 'short' }); // Jan, Feb, ...
                                    // },
                                    font: {
                                        family: 'Montserrat, sans-serif', // 👈 Font chữ
                                        size: 12, // 👈 Kích thước chữ (px)
                                        weight: '400' // 👈 Font-weight (bold/400/600...)
                                    },
                                    color: '#000C2A',
                                }
                            },
                            y: {
                                type: 'linear',
                                position: 'left', // Trục y đầu tiên ở bên trái
                                ticks: {
                                    stepSize: 100,
                                }
                            },
                            y1: {
                                type: 'linear',
                                position: 'right', // Trục y thứ hai ở bên phải
                                ticks: {
                                    beginAtZero: false
                                },
                                grid: {
                                    drawOnChartArea: false, // Loại bỏ các đường kẻ ngang từ trục y1 để tránh lẫn với y
                                }
                            }
                        }
                    }
                });

                function lightenColor(hex, percent) {
                    // Chuyển HEX sang RGB
                    const num = parseInt(hex.replace('#', ''), 16);
                    let r = (num >> 16);
                    let g = (num >> 8) & 0x00FF;
                    let b = (num) & 0x0000FF;

                    // Làm nhạt màu bằng cách pha trắng (255,255,255)
                    r = Math.round(r + (255 - r) * percent);
                    g = Math.round(g + (255 - g) * percent);
                    b = Math.round(b + (255 - b) * percent);

                    // Trả về dạng HEX
                    return `#${((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1)}`;
                }

                function generateColors(count) {
                    // Danh sách màu border chính xác (có thể tuỳ biến)
                    const baseColors = [
                        '#0d99ff', '#e83e8c', '#28a745', '#ffc107', '#6f42c1',
                        '#20c997', '#fd7e14', '#dc3545', '#6610f2', '#198754'
                    ];

                    const colors = [];

                    for (let i = 0; i < count; i++) {
                        const borderColor = baseColors[i % baseColors.length];
                        const backgroundColor = lightenColor(borderColor, 0.7); // Làm nhạt ~70%

                        colors.push({
                            borderColor,
                            backgroundColor
                        });
                    }

                    return colors;
                }

                var currentCapLabels = result.current_cap.labels;
                var currentCapData = result.current_cap.data;
                var currentCapGroupNames = result.current_cap.groupNames;
                const generatedColors = generateColors(currentCapData.length);
                const currentCapDatasets = currentCapData.map((item, i) => ({
                    borderColor: generatedColors[i].borderColor,
                    backgroundColor: generatedColors[i].backgroundColor,
                    fill: true,
                    borderWidth: 1,
                    pointRadius: 0,
                    tension: 0.1,
                    label: currentCapGroupNames[i],
                    data: item,
                    ...item // 👈 cuối cùng mới merge
                }));
                var ctx_current_cap = document.getElementById('current_cap').getContext('2d');
                const current_cap = new Chart(ctx_current_cap, {
                    type: 'line',
                    data: {
                        labels: currentCapLabels,
                        datasets: currentCapDatasets
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                type: 'linear',
                                position: 'left',
                                stacked: true,
                                min: 0,
                                max: 100,
                                beginAtZero: true,
                                ticks: {
                                    font: {
                                        family: 'Montserrat, sans-serif', // 👈 Font chữ
                                        size: 12, // 👈 Kích thước chữ (px)
                                        weight: '400' // 👈 Font-weight (bold/400/600...)
                                    },
                                    color: '#000C2A',
                                }
                            },
                            x: {
                                ticks: {
                                    font: {
                                        family: 'Montserrat, sans-serif', // 👈 Font chữ
                                        size: 12, // 👈 Kích thước chữ (px)
                                        weight: '400' // 👈 Font-weight (bold/400/600...)
                                    },
                                    color: '#000C2A',
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                onHover: function(event, legendItem, legend) {
                                    event.native.target.style.cursor = 'pointer';
                                },
                                onLeave: function(event, legendItem, legend) {
                                    event.native.target.style.cursor = 'default';
                                },
                                display: true,
                                position: 'right',
                                labels: {
                                    boxWidth: 20, // Điều chỉnh kích thước hộp màu
                                    padding: 8, // Điều chỉnh khoảng cách giữa các mục
                                }
                            },
                            tooltip: {
                                enabled: true, // Tooltip được bật mặc định
                                mode: 'nearest', // Hiển thị tooltip cho điểm gần nhất khi di chuột
                                intersect: false, // Hiển thị tooltip khi di chuột qua bất cứ điểm nào trên trục x (không cần phải chạm vào điểm cụ thể)
                                callbacks: {
                                    label: function(tooltipItem) {
                                        const label = tooltipItem.dataset.label || '';
                                        const value = tooltipItem.raw;
                                        return `${label}: ${value}%`;
                                    }
                                }
                            }
                        }
                    }
                });
            }
        });
    });

    // current_cap
    function calculateFontSize() {
        const screenWidth = window.innerWidth;

        if (screenWidth < 1200) {
            return 8;
        }
        return 12;
    }

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

    // Chạy ngay khi load trang
    function showAlert(message, type) {
        const alertContainer = document.getElementById('alert-container');

        // Create the alert div
        const alertDiv = document.createElement('div');
        alertDiv.className = `custom-alert ${type} alert d-flex align-items-center justify-content-between fade show`;
        alertDiv.innerHTML = `
            <span>${message}</span>
            <button type="button" class="btn-close" aria-label="Close"></button>
        `;

        // Add the alert to the container
        alertContainer.appendChild(alertDiv);

        // Auto-close the alert after 5 seconds
        setTimeout(() => {
            alertDiv.classList.remove('show');
            alertDiv.classList.add('fade-out');
            setTimeout(() => alertDiv.remove(), 300); // Remove after fade-out animation
        }, 5000);

        // Close the alert when the close button is clicked
        alertDiv.querySelector('.btn-close').addEventListener('click', () => {
            alertDiv.remove();
        });
    }

    // Fix lỗi table khi chuyển tabs
    $('a[data-bs-toggle="pill"]').on('shown.bs.tab', function() {
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();
    });
</script>
@endpush

@section('content')
<div class="green-stock-NAS100-page montserrat-font-family">
    @include('front.common.header')
    <div id="heroCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item container-heading active">
                <h3 class="heading-page">{{ __('green_stock.gs_nas100') }}</h3>
                <div class="tabs-green">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active btn-tab me-2" id="pills-stock-rating-tab"
                                data-bs-toggle="pill"
                                data-bs-target="#pills-stock-rating"
                                type="button" role="tab"
                                aria-controls="pills-stock-rating"
                                aria-selected="true">{{__('green_stock.stock_rating')}}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link btn-tab" id="pills-market-overview-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-market-overview" type="button" role="tab"
                                aria-controls="pills-market-overview"
                                aria-selected="false">{{__('green_stock.market_overview')}}</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section id="contentDiv" class="text-left">
        <div class="full-width-container">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-stock-rating" role="tabpanel"
                    aria-labelledby="pills-stock-rating-tab">
                    <!-- Heading tab -->
                    <div class="container-tab-heading">
                        <h3 class="heading-page pb-1 mb-0">"The trend is your friend" - Benjamin Graham</h3>
                       
                    </div>
                    <!-- End heading tab -->

                    <!-- Top 5 stocks -->
                    <div class="top-5-stocks">
                        <div class="container">
                            <h4 class="title-top-stock">{{__('green_stock.top_5_stock')}}</h4>
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 gy-4 stocks">
                                @forelse($top_stock as $stock)
                                <div class="col">
                                    <div class="stock-container d-flex justify-content-between align-items-center">
                                        <div class="stock d-flex align-items-center gap-2">

                                            <img src="{{asset('images/nas100/'. $stock->code.'.svg')}}"
                                                class="rounded-circle img-fluid stock-image"
                                                alt="stock-gild-img">
                                            <span class="stock-name">{{ $stock->code }}</span>
                                        </div>
                                        <div class="stock-percent">{{ $stock->profit }}%</div>
                                    </div>
                                </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <!-- End top 5 stocks -->

                    <!-- Content tab -->
                    <div class="content-stock-rating">
                        <div class="container">
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
                                            <div class="container-content">
                                                <div id="alert-container"></div>
                                                <h4 class="title-my-watchlist text-center">{{__('front_end.my_watchlist')}}</h4>
                                                <div class="select-container my-4">
                                                    <select id="select-stock" class="form-select">
                                                        @foreach($list_stock as $key => $stock)
                                                        <option value="{{$key}}">{{$stock}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="table-responsive"
                                                    style="max-height: 265px; overflow-y: auto;">
                                                    <table class="table table-striped table-hover"
                                                        id="my_watch_list">
                                                        <thead>
                                                            <th>{{__('front_end.STOCK')}}</th>
                                                            <th class="text-center text-nowrap">{{__('front_end.GVN_Rating')}}</th>
                                                            <th class="text-center text-nowrap">{{__('front_end.price_buy_sell')}}</th>
                                                            <th class="text-center text-nowrap">{{__('front_end.last_sale')}}</th>
                                                            <th class="text-center text-nowrap">{{__('green_stock.action')}}</th>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($list_folow as $stock)
                                                            <tr data-id="{{$stock->id}}">
                                                                <td class="fw-bold">
                                                                    <div class="code d-flex align-items-center gap-2">
                                                                        <img style="width: 25px; height: 25px; object-fit: cover;" src="{{ asset('images/nas100/' . $stock->code . '.svg') }}" alt="{{ asset('images/nas100/' . $stock->code . 'svg') }}" class="rounded-circle">
                                                                        <span>{{ $stock->code }}</span>
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">{{ $stock->rating }}</td>
                                                                <td class="text-center">{{ $stock->price }}</td>
                                                                <td class="text-center">{{ $stock->current_price }}</td>
                                                                <td class="text-center">
                                                                    <button class="btn btn-delete btn-sm">
                                                                        <i class="far fa-trash-alt"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="container-chart">
                                                <h4 class="title-chart-best-top-10 text-uppercase text-center mb-5">{{ __('green_stock.best_top_10') }}</h4>
                                                <div style="height: 423px;"
                                                    class="d-flex flex-column justify-content-center align-items-center chart-container">
                                                    <canvas id="groupStock"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="border-primary my-80">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="select-limit-items d-flex align-items-center flex-row gap-2">
                                        <span>{{__('green_stock.showing')}}</span>
                                        @php
                                        $limitOptions = [30, 50, 75, 100,-1];
                                        @endphp
                                        <select id="selectLimitIndiceTable" class="form-select w-auto">
                                            @for($i = 0; $i < count($limitOptions); $i++)
                                                <option value="{{$limitOptions[$i]}}">{{$limitOptions[$i] ==-1 ? 'All':$limitOptions[$i]}}</option>
                                                @endfor
                                        </select>
                                    </div>
                                    <div class="table-responsive" style="overflow-y: auto;">
                                        <table class="table table-striped table-hover" id="indices-table">
                                            <thead>
                                                <tr>
                                                    <th class="text-capitalize text-center text-nowrap">{{__('green_stock.rating')}}</th>
                                                    <th class="text-capitalize text-center text-nowrap">{{__('green_stock.stock')}}</th>
                                                    <th class="text-capitalize text-center text-nowrap">{{__('green_stock.last_sale')}}</th>
                                                    <th class="text-capitalize text-center text-nowrap">{{__('green_stock.trend')}}</th>
                                                    <th class="text-capitalize text-center text-nowrap">{{__('green_stock.action')}}</th>
                                                    <th class="text-capitalize text-center text-nowrap">{{__('green_stock.profit')}}</th>
                                                    <th class="text-capitalize text-center text-nowrap">{{__('green_stock.after_sell')}}</th>
                                                    <th class="text-capitalize text-center text-nowrap">{{__('green_stock.price')}}</th>
                                                    <th class="text-capitalize text-center text-nowrap">{{__('green_stock.time')}}</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End content tab -->
                </div>
                <div class="tab-pane fade" id="pills-market-overview" role="tabpanel"
                    aria-labelledby="pills-green-stock-tab">
                    <!-- Heading tab -->
                    <div class="container-tab-heading">
                        <h3 class="heading-page pb-1 mb-0">{{ __('green_stock.market_overview') }}</h3>
                        <h5 class="time-live mb-0">
                            <i><span class="date-js"></span> <span class="time-js"></span> (UTC+3)</i>
                        </h5>
                    </div>
                    <!-- End heading tab -->

                    <!-- Content tab -->
                    <div class="content-overview">
                        <div class="container">
                            <h4 class="title-up-down-market-capital">
                                {{__('green_stock.up_down_market_capital')}}
                            </h4>
                            <div class="market-capital-container my-4">
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 gy-4">
                                    <!-- JS append col items -->
                                </div>
                            </div>
                            <div class="row gx-custom g-custom">
                                <!-- Current month chart -->
                                <div class="col-12 col-md-5 d-flex">
                                    <div class="container-chart h-100 w-100" style="padding: 32px 32px !important;">
                                        <h4 class="title-chart text-uppercase text-center mb-5">{{__('green_stock.chart_title_trading_day')}}</h4>
                                        <div class="d-flex flex-column justify-content-center align-items-center chart-container">
                                            <canvas id="capChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <!-- cap Chart -->
                                <div class="col-12 col-md-7 d-flex">
                                    <div class="container-chart h-100 w-100" style="padding: 32px 60px !important;">
                                        <h4 class="title-chart text-uppercase text-center mb-5">{{__('green_stock.sector')}}</h4>
                                        <div class="d-flex flex-column justify-content-center align-items-center chart-container">
                                            <canvas id="current_month"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="border-primary my-80" style="margin-bottom: 64px !important;">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive" style="max-height: 295px; overflow-y: auto;">
                                        <table class="table table-striped table-hover" id="top_stock">
                                            <thead>
                                                <th class="text-capitalize text-center text-nowrap">{{__('green_stock.rating')}}</th>
                                                <th class="text-capitalize text-center text-nowrap">{{__('green_stock.stock')}}</th>
                                                <th class="text-capitalize text-center text-nowrap">{{__('green_stock.last_sale')}}</th>
                                                <th class="text-capitalize text-center text-nowrap">{{__('green_stock.trend')}}</th>
                                                <th class="text-capitalize text-center text-nowrap">{{__('green_stock.action')}}</th>
                                                <th class="text-capitalize text-center text-nowrap">{{__('green_stock.profit')}}</th>
                                                <th class="text-capitalize text-center text-nowrap">{{__('green_stock.after_sell')}}</th>
                                                <th class="text-capitalize text-center text-nowrap">{{__('green_stock.price')}}</th>
                                                <th class="text-capitalize text-center text-nowrap">{{__('green_stock.time')}}</th>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="border-primary my-80">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="container-chart" style="padding: 32px 32px !important;">
                                        <h4 class="title-chart text-uppercase text-center">{{__('front_end.top_10_trading_value')}}</h4>
                                        <div style="height: 425px;"
                                            class="chart-contianer d-flex flex-column justify-content-center align-items-center">
                                            <canvas id="avg_cap"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="border-primary my-80">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="container-chart" style="padding: 32px 32px !important;">
                                        <h4 class="title-chart text-uppercase text-center">{{__('front_end.market_with_MA')}}</h4>
                                        <div style="height:394.5px;"
                                            class="chart-container d-flex flex-column justify-content-center align-items-center">
                                            <canvas id="group_ma"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="my-80"></div>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="container-chart" style="padding: 32px 32px !important;">
                                        <h4 class="title-chart text-uppercase text-center">{{__('front_end.trading_value_ratio')}}</h4>
                                        <div style="height: 867px;"
                                            class="chart-container d-flex flex-column justify-content-center align-items-center">
                                            <canvas id="current_cap"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- End content tab -->
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