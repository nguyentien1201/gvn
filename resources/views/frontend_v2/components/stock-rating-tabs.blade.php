<section id="top-stock-rating-by-gvn">
    <div class="container">
        <h2 class="text-center rating-title">{{__('base.GVN_Rating')}}</h2>
        <div class="tabs-green mb-3">
            <ul class="nav nav-pills" id="pills-tab1" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active btn-tab me-2" id="pills-green-stock-NAS100-tab"
                            data-bs-toggle="pill"
                            data-bs-target="#pills-green-stock-NAS100"
                            type="button" role="tab"
                            aria-controls="pills-green-stock-NAS100"
                            aria-selected="true">Green Stock NAS100</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link btn-tab" id="pills-green-stock-vn-index-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-green-stock-vn-index" type="button" role="tab"
                            aria-controls="pills-green-stock-vn-index"
                            aria-selected="false">Green Stock VNINDEX</button>
                </li>
            </ul>
        </div>
        <div class="tab-content" id="pills-tabContent1">
            <div class="tab-pane fade show active" id="pills-green-stock-NAS100" role="tabpanel"
                 aria-labelledby="pills-green-stock-NAS100-tab">
                <div class="table-responsive" style="max-height: 848px; overflow-y: auto;">
                    <table id="green-stock-NAS100-table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-capitalize text-center text-nowrap">{{__('const_signal.RATING')}}</th>
                                <th class="text-capitalize text-center text-nowrap">{{__('const_signal.STOCK')}}</th>
                                <th class="text-capitalize text-center text-nowrap">{{__('const_signal.LAST_SALE')}}</th>
                                <th class="text-capitalize text-center text-nowrap">{{__('const_signal.TREND')}}</th>
                                <th class="text-capitalize text-center text-nowrap">{{__('const_signal.ACTION')}}</th>
                                <th class="text-capitalize text-center text-nowrap">{{__('const_signal.PROFIT')}}</th>
                                <th class="text-capitalize text-center text-nowrap">{{__('const_signal.AFTER_SELL')}}</th>
                                <th class="text-capitalize text-center text-nowrap">{{__('const_signal.PRICE')}}</th>
                                <th class="text-capitalize text-center text-nowrap">{{__('const_signal.TIME')}}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-green-stock-vn-index" role="tabpanel"
                 aria-labelledby="pills-green-stock-vn-index-tab">
                <div class="table-responsive" style="max-height: 848px; overflow-y: auto; position: relative">
                    <table id="green-stock-vn-index-table" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="text-capitalize text-center text-nowrap">{{__('const_signal.RATING')}}</th>
                            <th class="text-capitalize text-center text-nowrap">{{__('const_signal.STOCK')}}</th>
                            <th class="text-capitalize text-center text-nowrap">{{__('const_signal.LAST_SALE')}}</th>
                            <th class="text-capitalize text-center text-nowrap">{{__('const_signal.TREND')}}</th>
                            <th class="text-capitalize text-center text-nowrap">{{__('const_signal.ACTION')}}</th>
                            <th class="text-capitalize text-center text-nowrap">{{__('const_signal.PROFIT')}}</th>
                            <th class="text-capitalize text-center text-nowrap">{{__('const_signal.AFTER_SELL')}}</th>
                            <th class="text-capitalize text-center text-nowrap">{{__('const_signal.PRICE')}}</th>
                            <th class="text-capitalize text-center text-nowrap">{{__('const_signal.TIME')}}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@push('scripts')
    <script>
                            function slugify(str) {
  return str
    .toLowerCase()
    .normalize('NFD')                   // chuẩn hóa ký tự có dấu
    .replace(/[\u0300-\u036f]/g, '')
    .replace(/đ/g, 'd')                   // Tùy chọn: đổi "đ" thành "d"
    .replace(/Đ/g, 'D')        // xóa dấu
    .replace(/[^a-z0-9 -]/g, '')        // loại bỏ ký tự đặc biệt
    .replace(/\s+/g, '-')               // thay khoảng trắng bằng "-"
    .replace(/-+/g, '-')
    .replace(/^-+|-+$/g, '');           // xóa "-" ở đầu và cuối
}
        $(document).ready(function () {
            const logoBaseUrl = "{{ asset('images') }}"; // trả ra đường dẫn base
            $('#green-stock-NAS100-table').DataTable({
                pageLength: 50,         // Giá trị mặc định
                lengthChange: false,
                paging: false,
                searching: false,
                responsive: false,
                autoWidth: false,
                info: false,
                order: [[0, 'asc']],
                data: @json($green_data),
                columns: [
                    {data: 'rating'},  // Apply bold formatting to the "PriceTrend" column data},
                    {data: 'code'},
                    {data: 'current_price'},
                    {data: 'trending'},
                    {data: 'signal'},
                    {data: 'profit'},
                    {data: 'post_sale_discount'},
                    {data: 'price'},
                    {data: 'time'},
                ],
                columnDefs: [
                    {
                        targets: 0, // Index of the date column
                        createdCell: function (td, cellData, rowData, row, col) {
                            bold = '';
                            if (cellData <= 30) {
                                bold = 'bold';
                            }
                            $(td).addClass('text-center');
                            $(td).css('font-weight', bold);
                        },
                    },
                    {
                        targets: 1, // Index of the date column
                        createdCell: function (td, cellData, rowData, row, col) {
                            $(td).css('font-weight', 'bold');
                            var company = rowData.company_name;

                            $(td).hover(
                                function () {
                                    $(this).addClass('row-hover');
                                    // Show custom tooltip
                                    $('<div class="custom-tooltip">' + company + '</div>').appendTo('body').fadeIn('slow');
                                },
                                function () {
                                    $(this).removeClass('row-hover');
                                    // Hide custom tooltip
                                    $('.custom-tooltip').remove();
                                }
                            ).mousemove(function (e) {
                                // Move tooltip with mouse
                                $('.custom-tooltip').css({
                                    top: e.pageY + 15 + 'px',
                                    left: e.pageX + 20 + 'px'
                                });
                            });
                        },
                        render: function(data, type, row) {
                            let code = data;
                            let codeImg = logoBaseUrl + '/nas100/' + code + ".svg";
                            let codeHtml = `<div class="code d-flex align-items-center gap-2">
                                <img style="width: 25px; height: 25px; object-fit: cover;" src="${codeImg}" alt="${codeImg}" class="rounded-circle">
                                <span>${code}</span>
                            </div>`;
                            return codeHtml;
                        }
                    },
                    {
                        targets: 2, // Index of the date column
                        createdCell: function (td, cellData, rowData, row, col) {
                            $(td).addClass('text-center');
                        },
                    },
                    {
                        targets: 3, // Index of the date column
                        createdCell: function (td, cellData, rowData, row, col) {
                            let string_key_language =''
                            trending = '';
                            color = '';
                            background = '';
                            if (rowData.trending != null) {
                                trending = rowData.trending.trim().toLowerCase();
                                string_key_language =  trending.replace(/ /g, "_");
                                string_key_language = string_key_language.trim().toUpperCase()
                                
                            }
                            if (trending == 'breaking high price') {
                                color = '#9B54FF';
                                background = '#E9DBFD';
                            } else if (trending == 'build up') {
                                color = '#F1C32A';
                                background = '#FFF4CE';
                            } else if (trending == 'go up') {
                                color = '#008000';
                                background = '#CCFFCC';
                            } else if (trending == 'bottom fishing') {
                                color = '#008AD9';
                                background = '#BFE8FF';
                            } else if (trending == 'go down') {
                                color = '#FC2F31';
                                background = '#FED6D6';
                            } else if (trending == 'recovery') {
                                color = '#E76A36';
                                background = '#FFDACA';
                            } else if (trending == 'breaking low price') {
                                color = '#F65D60';
                                background = '#FFC1C2';
                            }
                            $(td).html(`<span class="trend text-capitalize" style="
                                display: inline-block;
                                border-radius: 4px;
                                background-color: ${background};
                                color: ${color};
                                border: 1px solid ${color};
                                font-size: 13px;
                                padding: 4px 16px;
                                width: 176px;
                            ">${i18nKey[string_key_language]}</span>`);
                            $(td).css('witdh', '176px');
                            $(td).addClass('text-center');
                        }
                    },
                    {
                        targets: 4, // Index of the date column
                        createdCell: function (td, cellData, rowData, row, col) {
                            signal = '';
                            color = '';
                            let string_key_language ='';
                            background = '';
                            if (cellData != null) {
                                signal = cellData.trim().toLowerCase();
                                string_key_language = signal.trim().toUpperCase()
                            }
                            if (signal == 'buy') {
                                color = '#157347';
                                background = '#69E872';
                            } else if (signal == 'hold') {
                                color = '#157347';
                                background = '#CCFFCC';
                            } else if (signal == 'cash') {
                                color = '#F1C32A';
                                background = '#F7EFAF';
                            } else if (signal == 'sell') {
                                color = 'rgb(227, 123, 113)';
                                background = '';
                            }
                            $(td).addClass('text-center');
                            $(td).html(`<span class="action text-capitalize" style="
                                display: inline-block;
                                border-radius: 4px;
                                background-color: ${background};
                                color: ${color};
                                border: 1px solid ${color};
                                font-size: 14px;
                                padding: 4px 16px;
                            ">${i18nKey[string_key_language]}</span>`);
                        }
                    },
                    {
                        targets: 5, // Index of the date column
                        createdCell: function (td, cellData, rowData, row, col) {
                            color = '';
                            if (cellData > 0) {
                                color = '#277248';
                            } else if (cellData < 0) {
                                color = '#EF5657';
                            }
                            $(td).addClass('text-center');
                            $(td).css('color', color);
                        },
                        render: function (data, type, full, meta) {
                            return `${data}%`;
                        }
                    },
                    {
                        targets: 6, // Index of the date column
                        createdCell: function (td, cellData, rowData, row, col) {
                            color = '';
                            if (cellData > 0) {
                                color = '#277248';
                            } else if (cellData < 0) {
                                color = '#EF5657';
                            }
                            $(td).addClass('text-center');
                            $(td).css('color', color);
                        },
                        render: function (data, type, full, meta) {
                            if (data != null) {
                                return `${data}%`;
                            }
                            return '';
                        },

                    },
                    {
                        targets: 7, // Index of the date column
                        createdCell: function (td, cellData, rowData, row, col) {
                            $(td).addClass('text-center');
                        },
                        render: function (data, type, full, meta) {
                            if (data == 'fas fa-lock') {
                                return '<i style="color:#277248" class="fas fa-lock"></i>';
                            }
                            if (type === 'display') {
                                return parseFloat(data).toFixed(2);
                            }
                            return data; //
                        }
                    },
                    {
                        targets: 8, // Index of the open_time column
                        render: function (data, type, row) {
                            if (data == 'fas fa-lock') {
                                return '<i style="color:green" class="fas fa-lock"></i>';
                            }
                            if (type === 'display' || type === 'filter') {
                                return moment.tz(data, 'Europe/Moscow').format('DD/MM/YYYY'); // Format as HH:mm
                            }
                            return data;
                        }
                    },
                ],
                createdRow: function (row, data, dataIndex) {
                    if (data.code == 'NAS100') {
                        $(row).css('background-color', 'palegreen');
                    }
                }
            });

            $('#green-stock-vn-index-table').DataTable({
                pageLength: 50,         // Giá trị mặc định
                lengthChange: false,
                paging: false,
                searching: false,
                responsive: false,
                autoWidth: false,
                info: false,
                order: [[0, 'asc']],
                data: @json($green_vnindex),
                columns: [
                    {data: 'rating'},  // Apply bold formatting to the "PriceTrend" column data},
                    {data: 'code'},
                    {data: 'current_price'},
                    {data: 'trending'},
                    {data: 'signal'},
                    {data: 'profit'},
                    {data: 'post_sale_discount'},
                    {data: 'price'},
                    {data: 'time'},
                ],
                columnDefs: [
                    {
                        targets: 0, // Index of the date column
                        createdCell: function (td, cellData, rowData, row, col) {
                            bold = '';
                            if (cellData <= 30) {
                                bold = 'bold';
                            }
                            $(td).addClass('text-center');
                            $(td).css('font-weight', bold);
                        },
                    },
                    {
                        targets: 1, // Index of the date column
                        createdCell: function (td, cellData, rowData, row, col) {
                            $(td).css('font-weight', 'bold');
                            var company = rowData.company_name;

                            $(td).hover(
                                function () {
                                    $(this).addClass('row-hover');
                                    // Show custom tooltip
                                    $('<div class="custom-tooltip">' + company + '</div>').appendTo('body').fadeIn('slow');
                                },
                                function () {
                                    $(this).removeClass('row-hover');
                                    // Hide custom tooltip
                                    $('.custom-tooltip').remove();
                                }
                            ).mousemove(function (e) {
                                // Move tooltip with mouse
                                $('.custom-tooltip').css({
                                    top: e.pageY + 15 + 'px',
                                    left: e.pageX + 20 + 'px'
                                });
                            });
                        },
                        render: function(data, type, row) {
                            let code = data;
                            let codeImg = logoBaseUrl + '/VNindexlogo/' + code + ".jpg";
                            let codeHtml = `<div class="code d-flex align-items-center gap-2">
                                <img style="width: 25px; height: 25px; object-fit: cover;" src="${codeImg}" alt="${codeImg}" class="rounded-circle">
                                <span>${code}</span>
                            </div>`;
                            return codeHtml;
                        }
                    },
                    {
                        targets: 2, // Index of the date column
                        createdCell: function (td, cellData, rowData, row, col) {
                            $(td).addClass('text-center');
                        },
                    },
                    {
                        targets: 3, // Index of the date column
                        createdCell: function (td, cellData, rowData, row, col) {
                            trending = '';
                            color = '';
                            background = '';
                            if (rowData.trending != null) {
                                trending = rowData.trending.trim().toLowerCase();
                            }
                            let signal_slug = slugify(trending);
                            if (signal_slug == 'vuot-dinh') {
                                color = '#9B54FF';
                                background = '#E9DBFD';
                            } else if (signal_slug == 'tich-luy') {
                                color = '#F1C32A';
                                background = '#FFF4CE';
                            } else if (signal_slug == 'tang') {
                                color = '#008000';
                                background = '#CCFFCC';
                            } else if (signal_slug == 'bat-day') {
                                color = '#008AD9';
                                background = '#BFE8FF';
                            } else if (signal_slug == 'giam') {
                                color = '#FC2F31';
                                background = '#FED6D6';
                            } else if (signal_slug == 'phuc-hoi') {
                                color = '#E76A36';
                                background = '#FFDACA';
                            } else if (signal_slug == 'thung-day') {
                                color = '#F65D60';
                                background = '#FFC1C2';
                            }
                            $(td).html(`<span class="trend text-capitalize" style="
                                display: inline-block;
                                border-radius: 4px;
                                background-color: ${background};
                                color: ${color};
                                border: 1px solid ${color};
                                font-size: 13px;
                                padding: 4px 16px;
                                width: 176px;
                            ">${trending}</span>`);
                            $(td).css('witdh', '176px');
                            $(td).addClass('text-center');
                        }
                    },
                    {
                        targets: 4, // Index of the date column
                        createdCell: function (td, cellData, rowData, row, col) {
                            signal = '';
                            color = '';
                            background = '';
                            if (cellData != null) {
                                signal = cellData.trim().toLowerCase();
                            }
                            let signal_slug = slugify(signal);
                            if (signal_slug == 'mua') {
                                color = '#157347';
                                background = '#69E872';
                            } else if (signal_slug == 'nam-giu') {
                                color = '#157347';
                                background = '#CCFFCC';
                            } else if (signal_slug == 'tien-mat') {
                                color = '#F1C32A';
                                background = '#F7EFAF';
                            } else if (signal_slug == 'ban') {
                                color = 'rgb(227, 123, 113)';
                                background = '';
                            }
                            $(td).addClass('text-center');
                            $(td).html(`<span class="action text-capitalize" style="
                                display: inline-block;
                                border-radius: 4px;
                                background-color: ${background};
                                color: ${color};
                                border: 1px solid ${color};
                                font-size: 14px;
                                padding: 4px 16px;
                            ">${signal}</span>`);
                        }
                    },
                    {
                        targets: 5, // Index of the date column
                        createdCell: function (td, cellData, rowData, row, col) {
                            color = '';
                            if (cellData > 0) {
                                color = '#277248';
                            } else if (cellData < 0) {
                                color = '#EF5657';
                            }
                            $(td).addClass('text-center');
                            $(td).css('color', color);
                        },
                        render: function (data, type, full, meta) {
                            return `${data}%`;
                        }
                    },
                    {
                        targets: 6, // Index of the date column
                        createdCell: function (td, cellData, rowData, row, col) {
                            color = '';
                            if (cellData > 0) {
                                color = '#277248';
                            } else if (cellData < 0) {
                                color = '#EF5657';
                            }
                            $(td).addClass('text-center');
                            $(td).css('color', color);
                        },
                        render: function (data, type, full, meta) {
                            if (data != null) {
                                return `${data}%`;
                            }
                            return '';
                        },

                    },
                    {
                        targets: 7, // Index of the date column
                        createdCell: function (td, cellData, rowData, row, col) {
                            $(td).addClass('text-center');
                        },
                        render: function (data, type, full, meta) {
                            if (data == 'fas fa-lock') {
                                return '<i style="color:#277248" class="fas fa-lock"></i>';
                            }
                            if (type === 'display') {
                                return parseFloat(data).toFixed(2);
                            }
                            return data; //
                        }
                    },
                    {
                        targets: 8, // Index of the open_time column
                        render: function (data, type, row) {
                            if (data == 'fas fa-lock') {
                                return '<i style="color:green" class="fas fa-lock"></i>';
                            }
                            if (type === 'display' || type === 'filter') {
                                return moment.tz(data, 'Europe/Moscow').format('DD/MM/YYYY'); // Format as HH:mm
                            }
                            return data;
                        }
                    },
                ],
                createdRow: function (row, data, dataIndex) {
                    if (data.code == 'NAS100') {
                        $(row).css('background-color', 'palegreen');
                    }
                }
            });

        });
    </script>
@endpush

