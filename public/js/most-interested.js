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
})
