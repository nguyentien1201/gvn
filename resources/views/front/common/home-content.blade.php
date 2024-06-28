<div id="home-content">
    <div class="container">
        <div class="top-session-before-signal">
            <h5 class="custom-title">Top tín hiệu phiên trước đó</h5>
            <swiper-container class="mySwiper" loop="true" space-between="30" slides-per-group="4" slides-per-view="4"
                              navigation="true">
                <swiper-slide>
                    <img class="border-radius-13px" src="{{asset('images/1.jpg')}}" alt="{{asset('images/1.jpg')}}">
                </swiper-slide>
                <swiper-slide>
                    <img class="border-radius-13px" src="{{asset('images/2.jpg')}}" alt="{{asset('images/2.jpg')}}">
                </swiper-slide>
                <swiper-slide>
                    <img class="border-radius-13px" src="{{asset('images/3.jpg')}}" alt="{{asset('images/3.jpg')}}">
                </swiper-slide>
                <swiper-slide>
                    <img class="border-radius-13px" src="{{asset('images/4.jpg')}}" alt="{{asset('images/4.jpg')}}">
                </swiper-slide>
                <swiper-slide>
                    <img class="border-radius-13px" src="{{asset('images/1.jpg')}}" alt="{{asset('images/1.jpg')}}">
                </swiper-slide>
                <swiper-slide>
                    <img class="border-radius-13px" src="{{asset('images/2.jpg')}}" alt="{{asset('images/2.jpg')}}">
                </swiper-slide>
                <swiper-slide>
                    <img class="border-radius-13px" src="{{asset('images/3.jpg')}}" alt="{{asset('images/3.jpg')}}">
                </swiper-slide>
                <swiper-slide>
                    <img class="border-radius-13px" src="{{asset('images/4.jpg')}}" alt="{{asset('images/4.jpg')}}">
                </swiper-slide>
            </swiper-container>
        </div>
        <div class="most-interested">
            <h5 class="custom-title">Quan tâm nhiều nhất</h5>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th colspan="1" class="">
                        Name
                    </th>
                    <th colspan="1" class="">
                        Action
                    </th>
                    <th colspan="1" class="">
                        Price
                    </th>
                    <th colspan="1" class="">
                        %
                    </th>
                    <th colspan="1" class="">
                        Time Today
                    </th>
                    <th colspan="1" class="">
                        Trend
                    </th>
                    <th colspan="1" class="">
                        PriceTrend
                    </th>
                    <th colspan="1" class="">
                        TimeStart
                    </th>
                </tr>
                </thead>

                <tbody>
                <tr class="">
                    <th rowspan="1" colspan="1" class="">

                        NAS100
                    </th>
                    <td rowspan="1" colspan="1" class="">

                        BUY
                    </td>
                    <td rowspan="1" colspan="1" class="">

                        18746.33
                    </td>
                    <td rowspan="1" colspan="1" class="">

                        0.1%
                    </td>
                    <td rowspan="1" colspan="1" class="">

                        12:35
                    </td>
                    <td rowspan="1" colspan="1" class="">

                        UPTREND
                    </td>
                    <td rowspan="1" colspan="1" class="">

                        15366
                    </td>
                    <td rowspan="1" colspan="1" class="">

                        01/01/2024
                    </td>
                </tr>
                <tr class="">
                    <th rowspan="1" colspan="1" class="">

                        US30
                    </th>
                    <td rowspan="1" colspan="1" class="">

                        BUY
                    </td>
                    <td rowspan="1" colspan="1" class="">

                        18746.33
                    </td>
                    <td rowspan="1" colspan="1" class="">

                        0.1%
                    </td>
                    <td rowspan="1" colspan="1" class="">

                        12:45
                    </td>
                    <td rowspan="1" colspan="1" class="">

                        UPTREND
                    </td>
                    <td rowspan="1" colspan="1" class="">

                        15366
                    </td>
                    <td rowspan="1" colspan="1" class="">

                        01/01/2024
                    </td>
                </tr>
                <tr class="">
                    <th rowspan="1" colspan="1" class="">

                        S&amp;P500
                    </th>
                </tr>
                <tr class="">
                    <th rowspan="1" colspan="1" class="">

                        XAU
                    </th>
                </tr>
                <tr class="">
                    <th rowspan="1" colspan="1" class="">

                        USOIL
                    </th>
                </tr>
                <tr class="">
                    <th rowspan="1" colspan="1" class="">

                        EURUSD
                    </th>
                </tr>
                <tr class="">
                    <th rowspan="1" colspan="1" class="">

                        GBPUSD
                    </th>
                </tr>
                <tr class="">
                    <th rowspan="1" colspan="1" class="">

                        USDOLLAR
                    </th>
                </tr>
                <tr class="">
                    <th rowspan="1" colspan="1" class="">

                        BTCUSD
                    </th>
                </tr>
                <tr class="">
                    <th rowspan="1" colspan="1" class="">

                        ETHUSD
                    </th>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="trading-green-alpha mb-5">
            <h3 class="mb-4">
                <span class="title-trading-first">Giao dịch với</span>
                <span class="title-trading-second">Green Alpha 10.0.1</span>
            </h3>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="content-trading">
                            <ul>
                                <li>Phương pháp giao dịch: Day Trading</li>
                                <li>Thời gian đầu tư: Trong ngày, không giữ lệnh qua đêm</li>
                                <li>Chỉ số giao dịch: Nasdaq, SPX500, US30</li>
                            </ul>
                        </div>
                        <img class="img-fluid" src="{{asset('images/robot-chatbot-icon-sign-free-vector.png')}}" alt="{{asset('images/robot-chatbot-icon-sign-free-vector.png')}}">
                    </div>
                    <div class="col-md-8">
                        <div class="chart-trading-green-beta">
                            <select class="select2 form-control" name="chart-type" id="chartType">
                                <option value="area">Area</option>
                                <option value="bar">Column</option>
                                <option value="line">Line</option>
                            </select>
                        </div>
                        <canvas id="myChart" width="400" height="230"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="trading-green-beta mb-5">
            <h3 class="mb-4">
                <span class="title-trading-first">Giao dịch với</span>
                <span class="title-trading-second">Green Beta 1.2.3</span>
            </h3>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <img class="img-fluid" src="{{asset('images/Green-Beta.png')}}" alt="{{asset('images/Green-Beta.png')}}">
                        <div class="content-trading">
                            <ul>
                                <li>Phương pháp giao dịch: Position Trading</li>
                                <li>Thời gian đầu tư: Nắm giữ trung hạn và dài hạn</li>
                                <li>Chỉ số giao dịch: Stock Index, Commondity, Cryto…</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="text-performance">
                            <p class="text-plus-percent text-bold">Total Return</p>
                            <p class="percent text-bold">+1075%</p>
                            <p class="text-plus-percent text-bold">Outperformance</p>
                            <p class="percent text-bold">+816%</p>
                            <p class="text-plus-percent text-bold">Annualized Return</p>
                            <p class="percent text-bold">+35%</p>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <canvas id="myChartBeta" width="400" height="230"></canvas>
                    </div>
                </div>
            </div>
        </div>
       <div class="tables-content mb-5">
           <div class="container">
               <div class="row">
                   <div class="col-md-6">
                       <div class="indices-futures">
                           <h5 class="custom-title">Indices Futures</h5>
                           <table class="table table-hover">
                               <thead>
                               <tr>
                                   <th colspan="1" class="">
                                       Name
                                   </th>
                                   <th colspan="1" class="">
                                       Trend
                                   </th>
                                   <th colspan="1" class="">
                                       PriceTrend
                                   </th>
                                   <th colspan="1" class="">
                                       TimeStart
                                   </th>
                               </tr>
                               </thead>

                               <tbody>
                               <tr class="">
                                   <th rowspan="1" colspan="1" class="">

                                       NAS100
                                   </th>
                                   <td rowspan="1" colspan="1" class="">

                                       UPTREND
                                   </td>
                                   <td rowspan="1" colspan="1" class="">

                                       15366
                                   </td>
                                   <td rowspan="1" colspan="1" class="">

                                       01/01/2024
                                   </td>
                               </tr>
                               <tr class="">
                                   <th rowspan="1" colspan="1" class="">

                                       US30
                                   </th>
                                   <td rowspan="1" colspan="1" class="">

                                       UPTREND
                                   </td>
                                   <td rowspan="1" colspan="1" class="">

                                       15366
                                   </td>
                                   <td rowspan="1" colspan="1" class="">

                                       01/01/2024
                                   </td>
                               </tr>
                               <tr class="">
                                   <th rowspan="1" colspan="1" class="">

                                       S&amp;P500
                                   </th>
                               </tr>
                               <tr class="">
                                   <th rowspan="1" colspan="1" class="">

                                       GER30
                                   </th>
                               </tr>
                               <tr class="">
                                   <th rowspan="1" colspan="1" class="">

                                       UK100
                                   </th>
                               </tr>
                               <tr class="">
                                   <th rowspan="1" colspan="1" class="">

                                       JPN225
                                   </th>
                               </tr>
                               <tr class="">
                                   <th rowspan="1" colspan="1" class="">

                                       HKG33
                                   </th>
                               </tr>
                               </tbody>
                           </table>
                       </div>
                   </div>
                   <div class="col-md-6">
                       <div class="commodities">
                           <h5 class="custom-title">Commodities</h5>
                           <table class="table table-hover">
                               <thead>
                               <tr>
                                   <th colspan="1" class="">
                                       Name
                                   </th>
                                   <th colspan="1" class="">
                                       Trend
                                   </th>
                                   <th colspan="1" class="">
                                       PriceTrend
                                   </th>
                                   <th colspan="1" class="">
                                       TimeStart
                                   </th>
                               </tr>
                               </thead>

                               <tbody>
                               <tr class="">
                                   <th rowspan="1" colspan="1" class="">

                                       NAS100
                                   </th>
                                   <td rowspan="1" colspan="1" class="">

                                       UPTREND
                                   </td>
                                   <td rowspan="1" colspan="1" class="">

                                       15366
                                   </td>
                                   <td rowspan="1" colspan="1" class="">

                                       01/01/2024
                                   </td>
                               </tr>
                               <tr class="">
                                   <th rowspan="1" colspan="1" class="">

                                       US30
                                   </th>
                                   <td rowspan="1" colspan="1" class="">

                                       UPTREND
                                   </td>
                                   <td rowspan="1" colspan="1" class="">

                                       15366
                                   </td>
                                   <td rowspan="1" colspan="1" class="">

                                       01/01/2024
                                   </td>
                               </tr>
                               <tr class="">
                                   <th rowspan="1" colspan="1" class="">

                                       S&amp;P500
                                   </th>
                               </tr>
                               <tr class="">
                                   <th rowspan="1" colspan="1" class="">

                                       GER30
                                   </th>
                               </tr>
                               <tr class="">
                                   <th rowspan="1" colspan="1" class="">

                                       UK100
                                   </th>
                               </tr>
                               <tr class="">
                                   <th rowspan="1" colspan="1" class="">

                                       JPN225
                                   </th>
                               </tr>
                               <tr class="">
                                   <th rowspan="1" colspan="1" class="">

                                       HKG33
                                   </th>
                               </tr>
                               </tbody>
                           </table>
                       </div>
                   </div>
                   <div class="col-md-6">
                       <div class="top-cryptocurrencies">
                           <h5 class="custom-title">Top Cryptocurrencies</h5>
                           <table class="table table-hover">
                               <thead>
                               <tr>
                                   <th colspan="1" class="">
                                       Name
                                   </th>
                                   <th colspan="1" class="">
                                       Trend
                                   </th>
                                   <th colspan="1" class="">
                                       PriceTrend
                                   </th>
                                   <th colspan="1" class="">
                                       TimeStart
                                   </th>
                               </tr>
                               </thead>

                               <tbody>
                               <tr class="">
                                   <th rowspan="1" colspan="1" class="">

                                       NAS100
                                   </th>
                                   <td rowspan="1" colspan="1" class="">

                                       UPTREND
                                   </td>
                                   <td rowspan="1" colspan="1" class="">

                                       15366
                                   </td>
                                   <td rowspan="1" colspan="1" class="">

                                       01/01/2024
                                   </td>
                               </tr>
                               <tr class="">
                                   <th rowspan="1" colspan="1" class="">

                                       US30
                                   </th>
                                   <td rowspan="1" colspan="1" class="">

                                       UPTREND
                                   </td>
                                   <td rowspan="1" colspan="1" class="">

                                       15366
                                   </td>
                                   <td rowspan="1" colspan="1" class="">

                                       01/01/2024
                                   </td>
                               </tr>
                               <tr class="">
                                   <th rowspan="1" colspan="1" class="">

                                       S&amp;P500
                                   </th>
                               </tr>
                               <tr class="">
                                   <th rowspan="1" colspan="1" class="">

                                       GER30
                                   </th>
                               </tr>
                               <tr class="">
                                   <th rowspan="1" colspan="1" class="">

                                       UK100
                                   </th>
                               </tr>
                               <tr class="">
                                   <th rowspan="1" colspan="1" class="">

                                       JPN225
                                   </th>
                               </tr>
                               <tr class="">
                                   <th rowspan="1" colspan="1" class="">

                                       HKG33
                                   </th>
                               </tr>
                               </tbody>
                           </table>
                       </div>
                   </div>
                   <div class="col-md-6">
                       <div class="leading-stocks">
                           <h5 class="custom-title">Leading Stocks</h5>
                           <table class="table table-hover">
                               <thead>
                               <tr>
                                   <th colspan="1" class="">
                                       Name
                                   </th>
                                   <th colspan="1" class="">
                                       Trend
                                   </th>
                                   <th colspan="1" class="">
                                       PriceTrend
                                   </th>
                                   <th colspan="1" class="">
                                       TimeStart
                                   </th>
                               </tr>
                               </thead>

                               <tbody>
                               <tr class="">
                                   <th rowspan="1" colspan="1" class="">

                                       NAS100
                                   </th>
                                   <td rowspan="1" colspan="1" class="">

                                       UPTREND
                                   </td>
                                   <td rowspan="1" colspan="1" class="">

                                       15366
                                   </td>
                                   <td rowspan="1" colspan="1" class="">

                                       01/01/2024
                                   </td>
                               </tr>
                               <tr class="">
                                   <th rowspan="1" colspan="1" class="">

                                       US30
                                   </th>
                                   <td rowspan="1" colspan="1" class="">

                                       UPTREND
                                   </td>
                                   <td rowspan="1" colspan="1" class="">

                                       15366
                                   </td>
                                   <td rowspan="1" colspan="1" class="">

                                       01/01/2024
                                   </td>
                               </tr>
                               <tr class="">
                                   <th rowspan="1" colspan="1" class="">

                                       S&amp;P500
                                   </th>
                               </tr>
                               <tr class="">
                                   <th rowspan="1" colspan="1" class="">

                                       GER30
                                   </th>
                               </tr>
                               <tr class="">
                                   <th rowspan="1" colspan="1" class="">

                                       UK100
                                   </th>
                               </tr>
                               <tr class="">
                                   <th rowspan="1" colspan="1" class="">

                                       JPN225
                                   </th>
                               </tr>
                               <tr class="">
                                   <th rowspan="1" colspan="1" class="">

                                       HKG33
                                   </th>
                               </tr>
                               </tbody>
                           </table>
                       </div>
                   </div>
               </div>
           </div>
       </div>
        <div class="services-our mb-5">
            <h3 class="mb-5 text-center">
                <span class="title-trading-first">Dịch vụ</span>
                <span class="title-trading-second">của chúng tôi</span>
            </h3>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h4>
                            <i class="fa fa-line-chart color-primary-custom" aria-hidden="true"></i>
                            <span class="text-bold">Giải pháp tự động hóa phân tích thị trường</span>
                        </h4>
                        <p>Dịch vụ tự động hóa phân tích cung cấp một cái nhìn khách quan nhất về xu hướng thị trường.</p>
                    </div>
                    <div class="col-md-4">
                        <h4>
                            <i class="fa fa-line-chart color-primary-custom" aria-hidden="true"></i>
                            <span class="text-bold">Cung cấp các phân tích, xu hướng thị trường đến nhà đầu tư</span>
                        </h4>
                        <p>Các tín hiệu Buy-Sell sẽ được hệ thống tự động gửi đến điện thoại khách hàng trong khoản thời gian giao dịch thật</p>
                    </div>
                    <div class="col-md-4">
                        <h4>
                            <i class="fa fa-line-chart color-primary-custom" aria-hidden="true"></i>
                            <span class="text-bold">Tư vấn giải pháp cho nhà đầu tư hiệu quả thời gian</span>
                        </h4>
                        <p>Dịch vụ Giải pháp đầu tư cung cấp các giải pháp và công cụ hỗ trợ cho nhà đầu tư đạt hiệu quả đầu tư tốt nhất</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
