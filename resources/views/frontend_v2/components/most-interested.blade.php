@push('styles')
<style>

        @keyframes blink {

            0%,
            90% {
                opacity: 1;
                /* Phần tử hiển thị trong phần lớn thời gian */
                color: black;
                background: #ffd966;
            }

            95%,
            100% {
                opacity: 0;
                /* Chớp nháy nhanh trong khoảng thời gian ngắn */
                background-color: #ffd966;
            }
        }

        /* Tạo lớp với animation */
        .blink-effect {
            animation: blink 5s infinite;
            /* Hiệu ứng chớp nháy, lặp lại mãi mãi */
        }

        .blink-box {
            color: white;

        }
</style>
@endpush
<section id="most_interested" class="py-5">
    <div class="container">
        <h2 class="text-center services-title pb-3 pb-lg-5">{{__('base.Most_interested')}}</h2>
        <div class="table-responsive" style="max-height: 848px; overflow-y: auto;">
            <table id="most-interested-table" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-capitalize text-center text-nowrap">{{__('base.Signal_Open')}}</th>
                        <th class="text-capitalize text-center text-nowrap">{{__('base.Price_Open')}}</th>
                        <th class="text-capitalize text-center text-nowrap">{{__('base.Open_Time')}}</th>
                        <th class="text-capitalize text-center text-nowrap">{{__('base.Trend_Price')}}</th>
                        <th class="text-capitalize text-center text-nowrap">{{__('base.Markets')}}</th>
                        <th class="text-capitalize text-center text-nowrap">{{__('base.Symbol')}}</th>
                        <th class="text-capitalize text-center text-nowrap">{{__('base.Last_Sale')}}</th>
                        <th class="text-capitalize text-center text-nowrap">{{__('base.Profit')}}</th>
                        <th class="text-capitalize text-center text-nowrap">{{__('base.Signal_Close')}}</th>
                        <th class="text-capitalize text-center text-nowrap">{{__('base.Price_Close')}}</th>
                        <th class="text-capitalize text-center text-nowrap">{{__('base.Close_Time')}}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

</section>

@push('scripts')
    <script>
        $(document).ready(function () {
            const logoBaseUrl = "{{ asset('images/logo') }}"; // trả ra đường dẫn base
             var indices =  $('#most-interested-table').DataTable({
                responsive: false,
                autoWidth: false,
                paging: false,
                info: false,
                searching: false,
                data: @json($signals),
                order: [[4, 'desc']],
                columns: [
                    { data: "signal_open"},
                    { data: "price_open"},
                    { data: "open_time"},
                    { data: "trend_price"},
                    { data: "group"},
                    { data: "code"},
                    { data: "last_sale"},
                    { data: "profit"},
                    { data: "signal_close"},
                    { data: "price_close"},
                    { data: "close_time"}
                ],
                columnDefs: [
                    {
                        targets: 0,
                        createdCell: function (td, cellData, rowData, row, col) {
                            let signalOpenText = '';
                            let signalOpenClass = '';
                            if(rowData.close_time != null) {
                                signalOpenText = "CLOSED";
                                signalOpenClass = "closed";
                            } else {
                                signalOpenText = "BUY";
                                signalOpenClass = "buy";
                            }
                    

                            $(td).html(`<span class="text-capitalize signal-open ${signalOpenClass}">${i18nKey[signalOpenText]}</span>`);
                            $(td).addClass('text-center');
                        }
                    },
                    {
                        targets: 1,
                        createdCell: function (td, cellData, rowData, row, col) {
                            let priceOpen = rowData.price_open ;
                            $(td).html(`<span>${priceOpen}</span>`);
                            $(td).addClass('text-center');
                        }
                    },
                    {
                        targets: 2,
                        createdCell: function (td, cellData, rowData, row, col) {
                            let openTime = rowData.open_time ;
                            $(td).html(`<span class="text-nowrap">${openTime}</span>`);
                        }
                    },
                    {
                        targets: 3,
                        createdCell: (td, cellData, rowData, row, col) => {
                            let trendPrice = rowData.trend_price;
                            if(trendPrice != null || trendPrice != '' || trendPrice != undefined) {
                                trend_text = trendPrice.trim().toLowerCase();
                            }
                            let colorClass = "trend ";
                                if(trend_text == "uptrend") {
                                colorClass += "up-trend";
                            }
                            else if(trend_text == "downtrend") {
                                colorClass += "down-trend";
                            } else {
                                colorClass += "sideway";
                            }
                            $(td).html(`<span class="trend ${colorClass}">${i18nKey[trendPrice]}</span>`);
                            $(td).addClass('text-center');
                        }
                    },
                    {
                        targets: 5,
                        render: function(data, type, row) {
                            let code = data;
                            let codeImg = logoBaseUrl + '/' + code + ".png";
                            let html = `<div class="code d-flex align-items-center gap-2">
                                <img style="width: 25px; height: 25px; object-fit: cover;" src="${codeImg}" alt="${codeImg}" class="rounded-circle">
                                <span>${code}</span>
                            </div>`;
                            return html;
                        }
                    },
                    {
                        targets: 6,
                        createdCell: function (td, cellData, rowData, row, col) {
                            let lastSale = rowData.last_sale ? rowData.last_sale : '';
                            $(td).html(`<span>${lastSale}</span>`);
                            $(td).addClass('text-center');
                        }
                    },
                    {
                        targets: 7,
                        createdCell: (td, cellData, rowData, row, col) => {
                            const trendPrice = rowData.trend_price;
                            const profit = rowData.profit ? rowData.profit + '%' : '';
                            let colorClass = "";
                            if(rowData.profit > 0 ) {
                                colorClass += "up-trend";
                            }
                            else if(rowData.profit < 0 ) {
                                colorClass += "down-trend";
                            } else {
                                colorClass += "sideway";
                            }

                            $(td).html(`<span class="profit ${colorClass}">${profit}</span>`);
                            $(td).addClass('text-center');
                        }
                    },
                    {
                        targets: 8,
                        createdCell: (td, cellData, rowData, row, col) => {
                            let signalClose = rowData.signal_close;
                            if(signalClose == null || signalClose == '' || signalClose == undefined || signalClose == 'Hold'){
                                signalClose = "HOLD";
                            }
                             if(signalClose !='' || signalClose != null){
                                signal_close = signalClose.trim().toLowerCase();
                            }
                            let colorClass = "";
                            if(signal_close === "takeprofitbuy") {
                                colorClass += "profit-buy";
                            }
                            else if(signal_close === "cutlossbuy") {
                                colorClass += "loss-buy";
                            } else {
                                colorClass += "hold";
                            }
                            if(signalClose) {
                                $(td).html(`<span class="signal-close ${colorClass}">${i18nKey[signalClose]}</span>`);
                                $(td).addClass('text-center');
                            }
                        }
                    },
                    {
                        targets: 10,
                        createdCell: function (td, cellData, rowData, row, col) {
                            let closeTime = rowData.close_time ? rowData.close_time : '';
                            $(td).html(`<span class="text-nowrap">${closeTime}</span>`);
                        }
                    },
                ]
            });
               function highlightColumn(columnIndex) {
    // Add a class to all cells in the specified column

    var columnNodes = indices.column(8).nodes().to$();

    // Extract text content from each cell in the column
    var columnValues = columnNodes.map(function () {
        let value = $(this).text();
        if (value == "Hold" || value == "HOLD") {
            $(this).find('span').addClass('blink-box blink-effect');
        }
        // or .html() if you want to get the HTML content
    }).get();  //
}

// Delay for 5 seconds, then highlight the 3rd column (index starts from 0)
            setInterval(function () {
                highlightColumn(8);  // Highlight the third column (index 2)
            }, 5000);
        });
    </script>
@endpush
