$(document).ready(function () {
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
        fixedColumns: true,
        fixedColumns: {
            leftColumns: 3 // Cố định cột đầu tiên (Tên sản phẩm)
        },
        paging: false,
        // scrollX:true,
        autoWidth: false,

        info: false,
        data: @json($signals),
        order: [[4, 'desc']],
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
                    $(td).css('border-color', '#fff');
                },
                render: function (data, type, full, meta) {
                    if(full.close_time != null){
                        return 'Closed';
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
                        return '<i style="color:green" class="fas fa-lock"></i>';
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
                label: 'Profit Nas100',
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
        paging: false,
        autoWidth: true,
        info: false,
        order: [[0, 'asc']],
        data: @json($green_data),
        columns: [
            { data: 'rating', title: 'RATING' },  // Apply bold formatting to the "PriceTrend" column data},
            { data: 'code', title: 'CHỨNG KHOÁN' },
            { data: 'point', title: 'RATING POINT' },
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
                targets:7, // Index of the open_time column
                render: function (data, type, row) {
                    if (type === 'display' || type === 'filter') {
                        return moment.utc(data).format('DD/MM/YYYY'); // Format as HH:mm
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
                label: 'Up',
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
