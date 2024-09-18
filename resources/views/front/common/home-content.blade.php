
<style>

    @font-face {
        font-family: 'UVN Gia Dinh';
        src: url('/fonts/unicode.publish.UVNGiaDinh_R.ttf') format('truetype');
        font-weight: normal;
        font-style: normal;
    }
    .font-face{
        font-size: 1.1rem !important;
        font-family: 'UVN Gia Dinh', sans-serif;
    }
    .dt-scroll-head {
       overflow: scroll !important;
    }
    tbody >tr:hover {
            cursor: pointer;
            background-color: #f5f5f5;
            box-shadow: 0 0px 0px rgba(0, 0, 0, 0.1);
            transform: scale(1.008);
        }
        tbody >tr>td {
            padding: 0.5em 0.5em;
            font-size: 0.9em;
        }
       .color-home{
            color:#008000 !important;
        }
        body {
            font-size: 0.9rem;
        }

        .ml-auto {
            margin-left: auto !important;
        }

        #navbarNav .nav-link {
            font-size: 1.1rem;
            color: #000;
            font-weight: 600;
        }


        .cta {
            background-color: #007bff;
            color: white;
            padding: 60px 0;
        }

        .footer {
            padding: 30px 0;
        }

        .carousel-item {

            min-height: 300px;
            background: no-repeat center center scroll;
            background-size: cover;
        }

        .carousel-caption {
            background: rgba(0, 0, 0, 0.6);
            padding: 20px;
            border-radius: 10px;
        }

        .features {
            background: #f9f9f9;
        }

        .features .card {
            border: none;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .features .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .features .card-body {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .cta {
            background: linear-gradient(45deg, #007bff, #0056b3);
            color: white;
            padding: 60px 0;
        }

        .cta .btn {
            background: white;
            color: #007bff;
            border: none;
            transition: background-color 0.3s, color 0.3s;
        }

        .cta .btn:hover {
            background: #007bff;
            color: white;
        }

        .footer {
            padding: 30px 0;
            background: #f1f1f1;
        }

        #popupDataTable>thead {
            display: none;
        }

        .dataTable {
            margin-bottom: 0 !important;
        }

        table thead {
            background-color: #008000;
            /* Change the background color */
            color: white;
            /* Change the text color */
        }
        .comment-div-left {
            margin-right: 10px;
            width: 50px;

            text-align: center;
        }
        .comment-div-right {
            margin-left: 10px;
            width: 100px;

            text-align: center;
        }
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
        .table-responsive{
            overflow-x: hidden !important;
        }
        td {
            text-align: center;
        }
        thead th {
            text-align: center;
        }
            /* Custom styles */

            .custom-tooltip {
            position: absolute;
            background-color: #fff;
            color: #333;
            padding: 0.5em;
            border-radius: 5px;
            font-size: 1.3em;
            display: none;
            z-index: 1000;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
        }

        .chart_column {
            display: flex;
            justify-content: center;
            text-align: center;
            width: 100px;
            align-items: center;
            color: white;
            font-weight: bold;
            padding: 5px 0 5px 0;
        }
        .center_flex {
            display: inline-grid;
            justify-content: center;
            align-items: center;
        }
        @media (max-width: 1268px) {
            body {
                font-size: x-small !important   ;
            }
            thead th{
                min-width:80px !important ;
                /* font-size: xx-small; */
                }
            }

</style>

<script>
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
                leftColumns: 1 // Cố định cột đầu tiên (Tên sản phẩm)
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
        indices.columns.adjust().responsive.recalc();
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
        green_stock.columns.adjust().responsive.recalc();

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
            font-size: medium;
        }
        .swiper-slide .card {
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Style for Card Text */
        .card-text {
            color: #000;
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
            background-color: rgb(255, 217, 102); /* Yellow background for Hold */
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
 h2 {
            font-size: 24px;
            color: #333;
            position: relative;
            padding-bottom: 10px;
            margin-bottom: 20px;
            border-bottom: 2px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        h2 a {
            font-size: 16px;
            text-decoration: none;
            color: #007bff;
            font-weight: normal;
            padding: 8px 15px;
            border: 1px solid #008000;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        h2 a:hover {
            color: white  !important;
            background-color: #008000;
        }

        /* Optional: Responsive design */
        @media (max-width: 600px) {
            h2 {
                flex-direction: column;
                align-items: flex-start;
            }

            h2 a {
                margin-top: 10px;
            }
        }
        table.dataTable td {
            white-space: nowrap;
        }

        /* Chỉnh sửa để phần cột cố định nhìn đẹp */
        div.dataTables_wrapper {
            width: 100%;
            margin: 0 auto;
        }
</style>
<section class="features text-left mt-5">
    <div class="container">
        <h2 class="text-left mb-4 label-color color-home" >Quan tâm nhiều nhất  <a class="color-home" style="text-align:right" href="/green-beta"><i class="fas fa-chevron-right"></i><i>  Xem Thêm</i> </a></h2>
        <div class="row">
        <!-- Chart Section -->
        <div class="col-md-12 text-center form-group">

            <div class="card">
                <div class="card-body" style="overflow-x: auto;">
                    <table class="table table-striped table-bordered display responsive nowrap" style="width:100%;margin-bottom: 0px;"
                        id="indices-table">
                    </table>
                    <div class="row mt-4">
                        <div class="col-md-4 text-left form-group">
                            <ul style="padding-left:0">
                                <li class="list-item">
                                    <button class="takeprofitbuy width-120" >Buy</button>
                                    <span>Tín hiệu xu hướng đang mở.</span>
                                </li>
                                <li class="list-item">
                                    <button class="hold width-120">Closed</button>
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
</section>
<section class="features text-left  mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <h2 class="text-left mb-4"><span class="title-trading-first label-color bold">Giao dịch với <span class="title-trading-second color-home">GREEN BETA 1.3.3</span></span>
                    <a class="color-home" style="text-align:right" href="/green-beta"><i class="fas fa-chevron-right"></i><i>  Xem Thêm</i> </a>
                </h2>
                <div class="card mb-4">
                    <div class="card-body">
                        <p class="font-face">
                        Phương pháp giao dịch của Green Beta là Position Trading, tìm những điểm có xác suất chiến thắng cao nhất và nắm giữ trung và dài hạn vị thế đó cho đến khi xuất hiện các tín hiệu chốt lời và cắt lỗ từ thị trường. Green Beta được phát triển có thể thích nghi hầu hết các chỉ số tài chính trên toàn thị trường như Index Future,Crypto, Commodity...

                    </p>
                        <h6 class="card-text font-face bold" style="font-weight:600">
                        Tìm kiếm sự dịch chuyển dòng tiền, tìm kiếm lợi thế lợi thế gia tăng tài sản của bạn!
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
                <h2 class="text-left mb-4"><span class="title-trading-first label-color">Giao dịch với  <span class="title-trading-second color-home label-color">GREEN ALPHA 10.0.1</span></span>
                    <a class="color-home" style="text-align:right" href="/green-alpha"><i class="fas fa-chevron-right"></i><i>  Xem Thêm</i> </a>
                </h2>

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                        <!-- Data Section -->
                            <div class="col-md-9">

                            <p class="font-face">
                                Green Alpha là một robot với sự tích hợp đa tầng của các Indicator ngắn hạn, giao dịch với phương pháp Day Trading, là một robot giao dịch ngắn hạn trong phiên giao dịch,  tìm kiếm những điểm vào có xác suất chiến thắng cao và được lặp lại trong nhiều phiên. Green Alpha thích hợp cho các nhà đầu tư tìm kiếm các cơ hội nhanh, các nhà đầu tư dành phần lớn thời gian cho việc giao dịch và yêu thích sự phấn khích của nhịp độ thị trường hằng ngày.
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
                <h2 class="text-left mb-4"><span class="title-trading-first label-color color-home">Top StockRating by GVN</span>
                <a class="color-home" style="text-align:right" href="/greenstock-nas100"><i class="fas fa-chevron-right"></i><i>  Xem Thêm</i> </a>
            </h2>
            <!-- Data and Chart Section -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Data Section -->
                        <!-- Chart Section -->
                        <div class="col-md-12 text-center">
                        <table class="table table-striped table-bordered" style="margin-bottom: 0px;" id="green-stock-table">

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

                <h2 class="text-left mb-4"><span class="title-trading-first label-color">Giao dịch với</span>
                    <span class="title-trading-second color-home label-color">GREENSTOCK-NAS100</span>
                </h2>
            <!-- Data and Chart Section -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                    <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="card mb-4">
                                <div class=" text-left">
                                    <p class="font-face">
                                    GreenStock-NAS100 là hệ thống phân tích các cổ phiếu trong rổ cổ phiếu NASDAQ100 của thị trường chứng khoán Mỹ. Hệ thống sẽ tự động phân tích xu hướng ngắn hạn và dài hạn của các cổ phiếu, xếp hạng xu hướng và xung lực dòng tiền trên từng cổ phiếu, từ đó tạo ra bảng điểm Rating theo kỹ thuật để đưa ra nhận định hành động cho người dùng. Một vòng tròn hành động trong việc đầu tư của người dùng: BUY-HOLD-SELL-CASH
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
      <h2 class="color-home label-color">Dịch vụ của chúng tôi</h2>
      <div class="row">
        <div class="col-md-4">
          <div class="card" style="height:100%">
            <div class="card-body">
              <h5 class="card-title color-home">  <i class="fas fa-laptop icon-Computer" style="margin-right:10px"> </i>Giải pháp tự động hóa phân tích thị trường</h5>
              <p class="card-text">Dịch vụ tự động hóa phân tích cung cấp một cái nhìn khách quan nhất về xu hướng thị trường.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="height:100%">
                <div class="card-body">
                <h5 class="card-title color-home"><i class="fas fa-chart-line" style="margin-right:10px"></i> Cung cấp các phân tích, xu hướng thị trường đến nhà đầu tư</h5>
                <p class="card-text">Các tín hiệu Buy-Sell sẽ được hệ thống tự động gửi đến điện thoại khách hàng trong khoản thời
                gian giao dịch thật</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
          <div class="card" style="height:100%">
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

