<section id="most_interested" class="py-5">
    <div class="container">
        <h2 class="text-center services-title pb-5">{{__('home.most_interested')}}</h2>
        <div class="table-responsive" style="max-height: 848px; overflow-y: auto;">
            <table id="most-interested-table" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-capitalize text-center">Signal Open</th>
                        <th class="text-capitalize">Price Open</th>
                        <th class="text-capitalize">Open Time</th>
                        <th class="text-capitalize text-center">Trend Price</th>
                        <th class="text-capitalize">Market</th>
                        <th class="text-capitalize">Symbol</th>
                        <th class="text-capitalize text-center">Last Sale</th>
                        <th class="text-capitalize text-right">Profit</th>
                        <th class="text-capitalize text-center">Signal Close</th>
                        <th class="text-capitalize">Price Close</th>
                        <th class="text-capitalize">Close Time</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

</section>

@push('scripts')
    <!-- DataTables with Bootstrap 5 styling -->
    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.8/date-1.5.2/fc-5.0.1/fh-4.0.1/r-3.0.2/datatables.min.js"></script>

    <script>
        $(document).ready(function () {
            console.log(@json($signals));
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
                            let signalOpenText = (rowData.signal_open === "Close") ? "CLOSED" : "BUY";
                            let signalOpenClass = (rowData.signal_open === "Close") ? "closed" : "buy";
                            $(td).html(`<span class="text-capitalize signal-open ${signalOpenClass}">${signalOpenText}</span>`);
                            $(td).addClass('text-center');
                        }
                    },
                    {
                        targets: 1,
                        createdCell: function (td, cellData, rowData, row, col) {
                            let priceOpen = rowData.price_open ;
                            $(td).html(`<span>${priceOpen}</span>`);
                            $(td).addClass('text-right');
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
                            $(td).addClass('text-right');
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
                            $(td).addClass('text-right');
                        }
                    },
                    {
                        targets: 8,
                        createdCell: (td, cellData, rowData, row, col) => {
                            const signalClose = rowData.signal_close;
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
                    }
                ]
            });
        });
    </script>
@endpush
