@push('styles')
<style>

   .dataTables_scrollHeadInner .table {
    margin: 0;
   }
</style>
@endpush
<section id="most_interested" class="py-5">
    <div class="container">
        <h2 class="text-center services-title pb-3 pb-lg-2">{{__('front_end.SIGNAL_DASHBOARD')}}</h2>
        <h5 class="time-live mb-0 text-right">
            <i><span class="date-js"></span> <span class="time-js"></span> (UTC+3)</i>
        </h5>
        @include('frontend_v2.components.sumary-list')
        <div class="table-responsive mt-5" >
            <table id="green-beta-table" class="table table-striped table-hover" style="margin:none">
                <thead>
                    <tr>
                        <th class="text-capitalize text-center text-nowrap">{{__('base.Signal_Open')}}</th>
                        <th class="text-capitalize text-center text-nowrap">{{__('base.Price_Open')}}</th>
                        <th class="text-capitalize text-center text-nowrap">{{__('base.Open_Time')}}</th>
                        <th class="text-capitalize text-center text-nowrap">{{__('base.Trend_Price')}}</th>
                        <th class="text-capitalize text-center text-nowrap">{{__('base.Market')}}</th>
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
             var indices = $('#green-beta-table').DataTable({
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
                             if(priceOpen =='fas fa-lock'){
                                    $(td).html('<i style="color:green" class="fas fa-lock"></i>');
                                }else{
                                     $(td).html(`<span>${priceOpen}</span>`);
                                }

                            $(td).addClass('text-center');
                        }
                    },
                    {
                        targets: 2,
                        createdCell: function (td, cellData, rowData, row, col) {
                            let openTime = rowData.open_time ;
                             if(openTime =='fas fa-lock'){
                                  $(td).html('<i style="color:green" class="fas fa-lock"></i>');
                             }else {
                                 $(td).html(`<span class="text-nowrap">${openTime}</span>`);
                             }

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

                            const profit = rowData.profit ? rowData.profit + '%' : '';
                            let colorClass = "";
                            if(rowData.profit >= 0) {
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
                ],
                createdRow: function (row, data, dataIndex) {
                // Assuming 'code' is the property you want to use for data-id
                $(row).attr('data-id', data.id_code);
            }
            });
                   function highlightColumn(columnIndex) {
                // Add a class to all cells in the specified column

                var columnNodes = indices.column(8).nodes().to$();

                // Extract text content from each cell in the column
                var columnValues = columnNodes.map(function () {
                    let value = $(this).text();
                    if (value == "HOLD") {
                        $(this).find('span').addClass('blink-box blink-effect');
                    }
                    // or .html() if you want to get the HTML content
                }).get();  //
            }

            // Delay for 5 seconds, then highlight the 3rd column (index starts from 0)
            setTimeout(function () {
                highlightColumn(8);  // Highlight the third column (index 2)
            }, 5000);
        });
    </script>
@endpush
