<!-- resources/views/components/most-interested.blade.php -->
<section class="py-12 bg-white">
    <div class="container mx-auto">
        <h2 class="text-xl font-semibold text-center mb-6">Most interested 🔵</h2>

        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full border-collapse border border-gray-300 text-center justify-start text-[#4d5b7c] text-base font-medium font-['Inter'] leading-tight" id="indices-table">
                <thead class="bg-green-600 text-white">
                    <tr>
                        <th class="p-3 border border-gray-300 text-center">Signal Open</th>
                        <th class="p-3 border border-gray-300 text-center">Price Open</th>
                        <th class="p-3 border border-gray-300 text-center">Open Time</th>
                        <th class="p-3 border border-gray-300 text-center">Trend Price</th>
                        <th class="p-3 border border-gray-300 text-center">Market</th>
                        <th class="p-3 border border-gray-300 text-center">Symbol</th>
                        <th class="p-3 border border-gray-300 text-center">Last Sale</th>
                        <th class="p-3 border border-gray-300 text-center">Profit</th>
                        <th class="p-3 border border-gray-300 text-center">Signal Close</th>
                        <th class="p-3 border border-gray-300 text-center">Price Close</th>
                        <th class="p-3 border border-gray-300 text-center">Close Time</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">

        </tbody>
            </table>
        </div>
    </div>
</section>

@push('scripts')
<script>
    $(document).ready(function() {
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
                // createdCell: function (td, cellData, rowData, row, col) {
                //     if (rowData.close_time == null) {
                //         color = '#b6d7a8';
                //     } else {
                //         color = '#ffd966';
                //     }
                //     $(td).css('background-color', color);
                //     $(td).css('box-shadow', 'none');
                //     $(td).css('border-color', '#fff');
                // },

                render: function (data, type, full, meta) {
                    if(full.close_time != null){
                        return '<div class="text-center"><span class="inline-block text-center w-24 px-2 py-1 text-xs font-bold text-white bg-yellow-500 rounded">CLOSED</span></div>';
                    }

                    return '<div class="text-center"><span class="inline-block text-center w-24 px-2 py-1 text-xs font-bold text-white bg-green-600 rounded">BUY</span></div>';

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
                targets: 8,
                // createdCell: function (td, cellData, rowData, row, col) {
                //     signal_close =''
                //     if(rowData.signal_close != null){
                //         signal_close = rowData.signal_close.trim().toLowerCase();
                //     }
                //     if (signal_close == 'takeprofitbuy') {
                //         color = '#b6d7a8';
                //     } else if (signal_close == 'cutlossbuy') {
                //         color = '#e06666';
                //     } else {
                //         color = '#ffd966';
                //     }
                //     $(td).css('background-color', color);
                //     $(td).css('box-shadow', 'none');
                // },
                render: function (data, type, full, meta) {
                    console.log(data);
                    let className = '';
                    switch(data) {
                    case 'Hold':
                        className = 'bg-yellow-400 text-white';
                        break;
                    case 'TakeProfitBUY':
                        className = 'border border-green-500 text-green-600 bg-white';
                        break;
                    case 'CutLossBuy':
                        className = 'border border-red-300 text-red-600 bg-red-100';
                        break;
                    default:
                        data = 'Hold';
                        className = 'bg-yellow-400 text-white';
                    }
                    // if(data == null || data == '' || data == undefined || data == 'Hold'){
                    //     return 'Hold';
                    // }
                    // return `${data}`;
                    return `<div class="text-center">
                        <span class="inline-block w-24 text-center px-2 py-1 text-xs font-bold rounded-md ${className}">
                            ${data}
                        </span>
                        </div>`;
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
})

</script>
@endpush
