@extends('layouts.app')
@section('title', 'Investment')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home_v2.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">

<link rel="stylesheet" href="{{ asset('css/green_stock.css') }}">
<style>
 .div-table { display: table; width: 100%; border: 1px solid #dee2e6; border-radius: .5rem; border-collapse: separate; }
    .div-row { display: table-row; }
    .div-header, .div-cell { display: table-cell; padding: .75rem; text-align: center; vertical-align: middle; border-bottom: 1px solid #dee2e6; border-right: 1px solid #dee2e6; }
    .div-header { font-weight: 600; background-color: #fff; }
    .div-cell:first-child, .div-header:first-child { background-color: #f0fcf5; }
    .div-header:first-child { border-top-left-radius: .5rem; }
    .div-header:last-child { border-top-right-radius: .5rem; }
    .div-row:last-child .div-cell:first-child { border-bottom-left-radius: .5rem; }
    .div-row:last-child .div-cell:last-child { border-bottom-right-radius: .5rem; }
    .div-cell:last-child, .div-header:last-child { border-right: none; }
    #popupDataTable_wrapper .dt-scroll-head{
   display: none !important;
}
 .cot-noi-dung {
            background-color: #e9ecef; /* Màu nền nhẹ */
            border: 1px solid #dee2e6;
            padding: 15px;
            margin-bottom: 15px; /* Khoảng cách giữa các cột khi xếp chồng */
            text-align: center;
        }
        /* Đảm bảo Container có lề trên */
        .container {
            margin-top: 20px;
        }
        #investment-table th,
    #investment-table td {
        /* Bắt buộc nội dung phải xuống dòng khi tràn ô */
        white-space: normal;
        min-width: 60px;
        /* Đảm bảo nội dung dài được ngắt từ bất kỳ đâu */
        word-break: break-word;
    }

    /* 2. Đảm bảo container không bị tràn */
    .table-responsive {
        /* Ghi đè lại hành vi cuộn ngang mặc định của Bootstrap */
        overflow-x: hidden !important;
    }

    /* 3. Tùy chọn: Đặt chiều rộng tối đa linh hoạt */
    #investment-table {
            border: 1px solid #ececec;
        width: 100%;
        table-layout: fixed;

    }
</style>
@endpush

@section('content')
    <div class="home-page inter-font-family">
        @include('front.common.header')
       <!-- Heading tab -->
       <div id="heroCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item container-heading active">
                <h3 class="heading-page">BẢNG THEO DÕI CÁC KHOẢN ĐẦU TƯ</h3>

            </div>
        </div>
    </div>
       <section id="most_interested" class="py-5">
            <div class="container-fluid">

                <h5 class="time-live mb-0 text-right">
                    <i><span class="date-js"></span> <span class="time-js"></span> (UTC+7)</i>
                </h5>
                <div class="table-responsive mt-5" >
                    <table id="investment-table" class="table table-striped table-hover" style="margin:none">
                        <thead>
                            <tr>

                                <th class="text-capitalize text-center align-middle">STT</th>
                                <th class="text-capitalize text-center align-middle">TÊN KHOẢN ĐẦU TƯ</th>
                                <th class="text-capitalize text-center align-middle">TỔNG GIÁ TRỊ VỐN GIẢI NGÂN (đồng)</th>
                                <th class="text-capitalize text-center align-middle">SỐ LƯỢNG CỔ PHIẾU</th>
                                <th class="text-capitalize text-center  align-middle">GIÁ VỐN TRUNG BÌNH/CỔ PHIẾU</th>
                                <th class="text-capitalize text-center align-middle">THỜI GIAN GIẢI NGÂN</th>
                                <th class="text-capitalize text-center align-middle">GIÁ HIỆN TẠI</th>
                                <th class="text-capitalize text-center align-middle">LÃI/LỖ HIỆN TẠI</th>
                                <th class="text-capitalize text-center align-middle">GIÁ THỰC HIỆN CHỐT LỜI/CẮT LỖ</th>
                                <th class="text-capitalize text-center align-middle">LÃI/LỖ CHỐT LỜI</th>
                                <th class="text-capitalize text-center align-middle">THỜI GIAN CHỐT LỜI DỰ KIẾN</th>
                                <th class="text-capitalize text-center align-middle">HIỆN TRẠNG ĐẦU TƯ</th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach($investments as $key => $invest)
                                <tr data-id="{{$invest->code}}">
                                    <td class="text-center align-middle">
                                       {{$key + 1}}
                                    </td>
                                    <td class="text-center align-middle">{{ $invest->name }}</td>

                                    <td class="text-center align-middle">{{number_format($invest->total_value, 0, ',', '.') }}</td>
                                    <td class="text-center align-middle">{{number_format($invest->total_shares, 0, ',', '.')}}</td>
                                    <td class="text-center align-middle">{{ $invest->avg_price }}</td>
                                    <td class="text-center align-middle">{{ $invest->invest_date }}</td>
                                    <td class="text-center align-middle">{{ $invest->current_price }}</td>
                                    <td class="text-center align-middle" style="font-weight: 500; color: {{ $invest->current_profit_percent > 0 ? 'green' : ($invest->current_profit_percent < 0 ? 'red' : 'inherit') }};">{{ !empty($invest->current_profit_percent) ? $invest->current_profit_percent . '%' : '' }}</td>
                                    <td class="text-center align-middle">{{ $invest->take_profit_price }}</td>
                                    <td class="text-center align-middle" style="font-weight: 500; color: {{ $invest->take_profit_percent > 0 ? 'green' : ($invest->take_profit_percent < 0 ? 'red' : 'inherit') }};"> {{ !empty($invest->take_profit_percent) ? $invest->take_profit_percent . '%' : '' }}</td>
                                    <td class="text-center align-middle">{{ $invest->take_profit_expected }}</td>
                                    <td class="text-center align-middle">
                                        {{ $invest->status == 0 ? 'ĐANG MỞ GỌI VỐN' : ($invest->status == 1 ? 'ĐANG NẮM GIỮ' : 'ĐÃ TẤT TOÁN CHO NHÀ ĐẦU TƯ') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </section>

  <div id="heroCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item container-heading active">
                <h3 class="heading-page">CƠ CẤU NGUỒN VỐN</h3>

            </div>
        </div>
    </div>
        <section class="py-2">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                    <div class="table-responsive mt-5 cot-noi-dung" >
                        <table class="table table-striped table-hover" style="margin:none">
                            <thead>
                                <tr id="code_header">
                                    <th colspan="6" style="text-align:center" class="code_header">
                                        {{ empty($investments_funds[0]) ? 'Khoản đầu tư chưa mở' : $investments_funds[0]->name }}
                                    </th>
                                </tr>
                                <tr>
                                    <th>NGÀY</th>
                                    <th>NAV</th>
                                    <th>GHI CHÚ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($investments_funds[0]))
                                    @if(!empty($investments_funds[0]->funds))
                                    @foreach($investments_funds[0]->funds as $key => $fund)
                                    <tr>
                                        <td>{{ $fund->date }}</td>
                                           <td>{{number_format($fund->nav, 0, ',', '.')}}</td>
                                        <td>{{$fund->note}}</td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <td class="text-center">Chưa có hợp đồng nào</td>
                                    @endif
                                @else
                                      <td class="text-center">Khoản đầu tư chưa mở</td>
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="table-responsive mt-5 cot-noi-dung" >
                        <table class="table table-striped table-hover" style="margin:none">
                            <thead>
                                <tr id="code_header">
                                    <th colspan="6" style="text-align:center" class="code_header">
                                        {{ empty($investments_funds[1]) ? 'Khoản đầu tư chưa mở': $investments_funds[1]->name }}
                                    </th>
                                </tr>
                                <tr>
                                    <th>NGÀY</th>
                                    <th>NAV</th>
                                    <th>GHI CHÚ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($investments_funds[1]))
                                    @if(!empty($investments_funds[1]->funds))
                                    @foreach($investments_funds[1]->funds as $key => $fund)
                                    <tr>
                                        <td>{{ $fund->date }}</td>
                                           <td>{{number_format($fund->nav, 0, ',', '.')}}</td>
                                        <td>{{$fund->note}}</td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <td class="text-center">Chưa có hợp đồng nào</td>
                                    @endif
                                @else
                                      <td class="text-center">Khoản đầu tư chưa mở</td>
                                @endif
                            </tbody>
                        </table>
                    </div>
            </div>

                    <div class="col-12 col-md-12 col-lg-4">
                         <div class="table-responsive mt-5 cot-noi-dung" >
                        <table class="table table-striped table-hover" style="margin:none">
                            <thead>
                                <tr id="code_header">
                                    <th colspan="6" style="text-align:center" class="code_header">
                                        {{ empty($investments_funds[2]) ? 'Khoản đầu tư chưa mở' :  $investments_funds[2]->name }}
                                    </th>
                                </tr>
                                <tr>
                                    <th>NGÀY</th>
                                    <th>NAV</th>
                                    <th>GHI CHÚ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($investments_funds[2]))
                                    @if(!empty($investments_funds[2]->funds))
                                        @foreach($investments_funds[2]->funds as $key => $fund)
                                        <tr>
                                            <td>{{ $fund->date }}</td>
                                            <td>{{number_format($fund->nav, 0, ',', '.')}}</td>
                                            <td>{{$fund->note}}</td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <td class="text-center">Chưa có hợp đồng nào</td>
                                    @endif
                                @else
                                      <td class="text-center">Khoản đầu tư chưa mở</td>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    </div>

                </div>
            </div>
        </section>
        @auth
            <div style="position: fixed; bottom: 20px; right: 20px; text-align: center; z-index: 1000;">
                <div class="sc-9qme4p-0 hELAUe">
                    <button class="decription_telegram"><span
                            class="sc-1ee9gtf-2 bxZLwE">{{__('front_end.chat_with_me')}}</span></button>
                </div>
                <a href="https://t.me/{{config('config.telegram_user')}}" target="_blank" style="text-decoration: none;">
                    <button style="
                float: right;
            background-color: #33a853;
            color: white;
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: background-color 0.3s ease;
            "
                        onmouseover="this.style.backgroundColor='#33a853';"
                        onmouseout="this.style.backgroundColor='#198754';">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/8/82/Telegram_logo.svg" alt="Telegram"
                            style="width: 30px; height: 30px;">
                    </button>
                </a>
            </div>
            @endauth
            @include('frontend_v2.components.footer')
    </div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0-rc/dist/chartjs-plugin-datalabels.min.js"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-09NXCQGTBV');
    function updateClock() {
        const now = new Date();
        // Lấy thời gian và ngày tháng theo múi giờ
        const dateOptions = {
            timeZone: 'Asia/Ho_Chi_Minh',
            year: 'numeric',
            month: '2-digit',
            day: '2-digit'
        };
        const timeOptions = {
            timeZone: 'Asia/Ho_Chi_Minh',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: false
        };

        let dateString = now.toLocaleDateString('en-US', dateOptions).replace(/\//g, '-');
        let timeString = now.toLocaleTimeString('en-US', timeOptions);

        const elmDates = document.getElementsByClassName('date-js');
        const elmTimes = document.getElementsByClassName('time-js');

        for (let i = 0; i < elmDates.length; i++) {
            elmDates[i].textContent = dateString;
        }
        for (let i = 0; i < elmDates.length; i++) {
            elmTimes[i].textContent = timeString;
        }
    }

    setInterval(updateClock, 1000); // Cập nhật mỗi giây
    const el = document.getElementById('timezone');
    if (el) {
        el.addEventListener('change', updateClock);
        updateClock();
    }
</script>

@endpush
