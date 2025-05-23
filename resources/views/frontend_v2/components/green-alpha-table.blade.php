<section id="most_interested" class="py-5">
    <div class="container">
        <h2 class="text-center services-title pb-3 pb-lg-2">{{__('front_end.SIGNAL_DASHBOARD')}}</h2>
        <h5 class="time-live mb-0 text-right">
            <i><span class="date-js"></span> <span class="time-js"></span> (UTC+3)</i>
        </h5>
        @include('frontend_v2.components.sumary-list-alpha')
        <div class="table-responsive" style="max-height: 848px; overflow-y: auto;">
            <table id="green-beta-table" class="table table-striped table-hover">

            </table>
        </div>
    </div>

</section>


@push('scripts')
    <script>
        $(document).ready(function () {
            const logoBaseUrl = "{{ asset('images/logo') }}"; // trả ra đường dẫn base
            var indices = $('#green-beta-table').DataTable({
                searching: false,
                lengthChange: false, //
                paging: false,
                scrollX: true, // Kích hoạt cuộn ngang
                fixedColumns: {
                    leftColumns: 2 // Cố định cột đầu tiên (Tên sản phẩm)
                },
                scrollCollapse: true,
                autoWidth: false,
                info: false,
                order: [[3, 'desc']],
                data: @json($signals),
                columns: [
                    { data: 'code', title: 'Symbol' },
                    { data: 'signal_open', title: 'Signal Open' },  // Apply bold formatting to the "PriceTrend" column data},
                    { data: 'price_open', title: 'Price Open' },
                    { data: 'open_time', title: 'Open Time' },
                    { data: 'signal_close', title: 'Signal Close' },
                    { data: 'price_close', title: 'Price Close' },
                    { data: 'close_time', title: 'Close Time' },
                    { data: 'profit', title: 'Profit' },
                    { data: 'no_trading', title: 'No.Trading' },
                    { data: 'profit_today', title: 'Profit Today' }

                ],
                columnDefs: [
                    {
                        targets: 7, // Index of the date column
                        createdCell: (td, cellData, rowData, row, col) => {
                            const trendPrice = rowData.trend_price;
                            const profit = rowData.profit ? rowData.profit + '%' : '';
                            let colorClass = "";
                            if (rowData.profit > 0) {
                                colorClass += "up-trend";
                            }
                            else if (rowData.profit < 0) {
                                colorClass += "down-trend";
                            } else {
                                colorClass += "sideway";
                            }

                            $(td).html(`<span class="profit ${colorClass}">${profit}</span>`);
                            $(td).addClass('text-center');
                        }
                    },
                    {
                        targets: 9, // Index of the date column
                        createdCell: (td, cellData, rowData, row, col) => {

                            let profit = rowData.profit_today ? rowData.profit_today + '%' : '';
                            let colorClass = "";
                            if (rowData.profit_today >= 0) {
                                colorClass += "up-trend";
                            }
                            else if (rowData.profit_today < 0) {
                                colorClass += "down-trend";
                            } else {
                                colorClass += "sideway";
                            }
                            if (rowData.profit_today) {
                                profit = `${parseFloat(rowData.profit_today).toFixed(2)}%`
                            }
                            $(td).html(`<span class="profit ${colorClass}">${profit}</span>`);
                            $(td).addClass('text-center');
                        }
                    },
                    {
                        targets: 1, // Index of the date column
                        createdCell: function (td, cellData, rowData, row, col) {
                            if (rowData.signal_open == "") return false
                            let signalOpenText = '';
                            let signalOpenClass = '';
                            if (rowData.signal_open === "SELL") {
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
                        targets: 4, // Index of the date column

                        createdCell: (td, cellData, rowData, row, col) => {
                            let signalClose = rowData.signal_close;
                            let signalOpen = rowData.signal_open;
                            if (signalOpen == "") {
                                return false;
                            }
                            if (signalClose == null || signalClose == '' || signalClose == undefined || signalClose == 'Hold') {
                                signalClose = "Hold";
                            }
                            if (signalClose != '' || signalClose != null) {
                                signal_close = signalClose.trim().toLowerCase();
                            }


                            let colorClass = "";
                            if (signal_close === "takeprofitbuy" || signal_close === "takeprofitsell") {
                                colorClass += "profit-buy";
                            }
                            else if (signal_close === "cutlossbuy" || signal_close === "cutlosssell") {
                                colorClass += "loss-buy";
                            } else {
                                colorClass += "hold";
                            }

                            if (signalClose) {
                                $(td).html(`<span class="signal-close ${colorClass}">${signalClose}</span>`);
                                $(td).addClass('text-center');
                            }
                        }

                    },
                    {
                        targets: 3, // Index of the open_time column
                        render: function (data, type, row) {
                            if (data == 'fas fa-lock') {
                                return '<i style="color:green" class="fas fa-lock"></i>';
                            }
                            if (data == null || data == '') return '';
                            if (type === 'display' || type === 'filter') {
                                return moment.tz(data, 'Europe/Moscow').format('HH:mm'); // Format as HH:mm
                            }
                            return data;
                        }
                    },
                    {
                        targets: 2, // Index of the date column
                        render: function (data, type, full, meta) {
                            if (data == "") return '';
                            if (data == 'fas fa-lock') {
                                return '<i style="color:green" class="fas fa-lock"></i>';
                            }
                            if (type === 'display') {
                                return parseFloat(data).toFixed(2);
                            }
                            return data; //

                        }
                    },
                    {
                        targets: 6, // Index of the open_time column
                        render: function (data, type, row) {
                            if (data == null || data == '') return '';
                            if (type === 'display' || type === 'filter') {
                                return moment.tz(data, 'Europe/Moscow').format('HH:mm'); // Format as HH:mm
                            }
                            return data;
                        }
                    },
                    {
                        targets: 0, // Index of the 'code' column
                        render: function (data, type, row) {
                            let code = data;
                            let codeImg = logoBaseUrl + '/' + code + ".png";
                            let html = `<div class="code d-flex align-items-center gap-2">
                                    <img style="width: 25px; height: 25px; object-fit: cover;" src="${codeImg}" alt="${codeImg}" class="rounded-circle">
                                    <span>${code}</span>
                                </div>`;
                            return html;
                        }
                    }
                ],
                headerCallback: function (thead, data, start, end, display) {
                    $(thead).find('th').eq(7).css({
                        'padding': '.5em .5em'
                    });
                },
                createdRow: function (row, data, dataIndex) {
                    // Assuming 'code' is the property you want to use for data-id
                    $(row).attr('data-id', data.id_code);
                }
            });
            // indices.columns.adjust().responsive.recalc();
            function highlightColumn(columnIndex) {
                // Add a class to all cells in the specified column

                var columnNodes = indices.column(4).nodes().to$();

                // Extract text content from each cell in the column
                var columnValues = columnNodes.map(function () {
                    let value = $(this).text();
                    if (value == "Hold") {
                        $(this).addClass('blink-box blink-effect');
                    }
                    // or .html() if you want to get the HTML content
                }).get();  //
            }

            // Delay for 5 seconds, then highlight the 3rd column (index starts from 0)
            setTimeout(function () {
                highlightColumn(4);  // Highlight the third column (index 2)
            }, 5000);
        })

    </script>


@endpush
