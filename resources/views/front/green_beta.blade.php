<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <!-- Bootstrap CSS -->


    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- DataTables Responsive CSS -->


    <link rel="stylesheet" href="{{asset('plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <style>
        body {
            font-size: 0.9rem !important;
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
            height: 100vh;
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

        .dt-scroll-head {
            width: 99% !important;
        }

        #indices-table>thead,
        #commodities-table>thead,
        #crypto>thead,
        #forex-table>thead,
        #popupDataTable>thead {
            display: none;
        }

        .dataTable {
            margin-bottom: 0 !important;
            font-weight: 600;
        }

        table thead {
            background-color: #008000;
            /* Change the background color */
            color: white;
            /* Change the text color */
        }
    </style>

</head>

<body>

    <!-- Navigation Bar -->

    @include('front.common.header')


    <!-- Features Section -->

    <section class="features text-left mt-5">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <h2 class="text-center mb-4"><span class="title-trading-first label-color">Green Beta Signal</span>

                    </h2>
                    <!-- Data and Chart Section -->

                    <div class="row">
                        <!-- Chart Section -->
                        <div class="col-md-12 text-center form-group">

                            <div class="card">
                                <div class="card-body">
                                <table class="table table-striped table-bordered"
                                    style="margin-bottom: 0px;" id="indices-table">
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
                <div class="col-12">

                    <!-- Data and Chart Section -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <!-- Chart Section -->
                                <div class="col-md-12 text-center m-auto">
                                    <canvas  id="myChart" style="width:100%;padding-left: 5.5em;"  width="400" height="230"></canvas>
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
    <div class="modal fade" id="dataTableModal" tabindex="-1" aria-labelledby="dataTableModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dataTableModalLabel">History Signal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Table -->
                    <table style="width:100%" class="table table-striped table-bordered" id="popupDataTable"> </table>
                </div>
            </div>
        </div>
    </div>
    <style>

    </style>
    <section class="text-center mt-5">
        @include('front.common.footer')
    </section>
    <!-- Footer -->



</body>

</html>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-2.0.8/date-1.5.2/fc-5.0.1/fh-4.0.1/r-3.0.2/datatables.min.js"></script>
<script>
    $(document).ready(function () {
        $(document).on('click', '.dataTable tbody tr', function () {
            var dataId = $(this).data('id');
            if (dataId == undefined) {
                return;
            }
            $.ajax({
                url: 'api/get-history-signal/' + dataId,
                type: 'GET',
                success: function (data) {
                    console.log(data.data);
                    var popupDataTable = $('#popupDataTable').DataTable({
                        destroy: true,
                        data: data.data,
                        searching: false,
                        lengthChange: false,
                        responsive: true,
                        paging: false,
                        info: false,
                        scrollY: '500px',
                        columns: [
                            { data: 'code', title: 'Symbol' },
                            { data: 'signal_open', title: 'Signal Open' },  // Apply bold formatting to the "PriceTrend" column data},
                            { data: 'price_open', title: 'Price Open' },
                            { data: 'trend_price', title: 'Trend Price' },
                            { data: 'open_time', title: 'Open Time' },
                            { data: 'close_time', title: 'Close Time' },
                            { data: 'profit', title: 'Profit' },
                        ],
                        columnDefs: [

                            {
                                targets: 6, // Index of the date column
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
                    $('#dataTableModal').on('shown.bs.modal', function () {
                        popupDataTable.columns.adjust().draw();
                    });
                    $('#dataTableModal').modal('show');
                },
                error: function (error) {
                    console.log(error);
                }
            });

        });

        var indices = $('#indices-table').DataTable({
            searching: false,
            scrollCollapse: true,
            lengthChange: false, //
            responsive: true,
            paging: false,
            autoWidth: true,
            info: false,
            order: [[3, 'desc']],
            data: @json($signals),
            scrollY: '500px',
            columns: [
                { data: 'signal_open', title: 'Signal Open' },  // Apply bold formatting to the "PriceTrend" column data},
                { data: 'price_open', title: 'Price Open' },
                { data: 'open_time', title: 'Open Time' },
                { data: 'trend_price', title: 'Trend Price' },
                { data: 'price_better_buy', title: 'Price Better Buy' },
                { data: 'code', title: 'Symbol' },
                { data: 'last_sale', title: 'Last Sale' },
                { data: 'profit', title: 'Profit' },
                { data: 'signal_close', title: 'Signal Close' },
                { data: 'price_close', title: 'Price Close' },
                { data: 'close_time', title: 'Close Time' }
            ],
            columnDefs: [
                {
                    targets: 9,
                    visible: false
                },
                {
                    targets: 0, // Index of the date column
                    createdCell: function (td, cellData, rowData, row, col) {
                        if (rowData.close_time == '') {
                            color = '#b6d7a8';
                        } else {
                            color = '#ffd966';
                        }
                        $(td).css('background-color', color);
                        $(td).css('box-shadow', 'none');
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
                        if (rowData.close_time == '') {
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
                    targets: 8, // Index of the date column
                    createdCell: function (td, cellData, rowData, row, col) {
                        signal_close = rowData.signal_close.trim().toLowerCase();
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
                    }
                }
            ],
            createdRow: function (row, data, dataIndex) {
                // Assuming 'code' is the property you want to use for data-id
                $(row).attr('data-id', data.id_code);
            }
        });
        indices.columns.adjust().responsive.recalc();


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

    });
</script>
