<section id="most_interested" class="py-5">
    <div class="container">
        <h2 class="text-center services-title pb-3 pb-lg-5">{{__('home.most_interested')}}</h2>
        <div class="table-responsive" style="max-height: 848px; overflow-y: auto;">
            <table id="most-interested-table" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-capitalize text-center text-nowrap">Signal Open</th>
                        <th class="text-capitalize text-center text-nowrap">Price Open</th>
                        <th class="text-capitalize text-center text-nowrap">Open Time</th>
                        <th class="text-capitalize text-center text-nowrap">Trend Price</th>
                        <th class="text-capitalize text-center text-nowrap">Market</th>
                        <th class="text-capitalize text-center text-nowrap">Symbol</th>
                        <th class="text-capitalize text-center text-nowrap">Last Sale</th>
                        <th class="text-capitalize text-center text-nowrap">Profit</th>
                        <th class="text-capitalize text-center text-nowrap">Signal Close</th>
                        <th class="text-capitalize text-center text-nowrap">Price Close</th>
                        <th class="text-capitalize text-center text-nowrap">Close Time</th>
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
            $('#most-interested-table').DataTable({
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
                            if(rowData.signal_open === "Close") {
                                signalOpenText = "CLOSED";
                                signalOpenClass = "closed";
                            } else {
                                signalOpenText = "BUY";
                                signalOpenClass = "buy";
                            }
                            $(td).html(`<span class="text-capitalize signal-open ${signalOpenClass}">${signalOpenText}</span>`);
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
                            const trendPrice = rowData.trend_price;
                            let colorClass = "trend ";
                                if(trendPrice === "UPTREND") {
                                colorClass += "up-trend";
                            }
                            else if(trendPrice === "DOWNTREND") {
                                colorClass += "down-trend";
                            } else {
                                colorClass += "sideway";
                            }
                            $(td).html(`<span class="trend ${colorClass}">${trendPrice}</span>`);
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
                            if(trendPrice === "UPTREND") {
                                colorClass += "up-trend";
                            }
                            else if(trendPrice === "DOWNTREND") {
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
                            const signalClose = rowData.signal_close;
                            if(signalClose == null || signalClose == '' || signalClose == undefined || signalClose == 'Hold'){
                                $signalClose = "Hold";
                            }
                            let colorClass = "";
                            if(signalClose === "TakeProfitBUY") {
                                colorClass += "profit-buy";
                            }
                            else if(signalClose === "CutLossBuy") {
                                colorClass += "loss-buy";
                            } else {
                                colorClass += "hold";
                            }

                            if(signalClose) {
                                $(td).html(`<span class="signal-close ${colorClass}">${signalClose}</span>`);
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
        });
    </script>
@endpush
