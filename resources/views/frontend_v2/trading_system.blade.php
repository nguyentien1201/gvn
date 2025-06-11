@extends('layouts.app')
@section('title', 'Trading System')
@push('styles')
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">

    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('css/mission.css') }}">


    <style>
        .banner-container {
            max-width: 650px;
            position: relative;
        }

        .trend-btn {
            font-size: 12px;
            font-weight: 700;
            padding: 6px 12px;
            border-radius: 6px;
            color: white;
        }

        .btn-uptrend {
            background-color: #15E52E;
            box-shadow: 0 0 8px rgba(8, 244, 8, 0.8);
        }

        .btn-sideway {
            background-color: #FFF600;
            color: #00262E;
            box-shadow: 0 0 8px rgba(224, 178, 26, 0.8);
        }

        .btn-downtrend {
            background-color: #D80027;
            box-shadow: 0 0 10px rgba(216, 0, 39, 0.8);
        }

        .banner-text-alpha {
            top: 20px;
            left: 20px !important;
        }

        .banner-text {
            position: absolute;
            bottom: 20px;
            right: 20px;
            color: white;
            font-weight: 600;
            font-size: 20px;
        }

        .banner-buttons {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
        }

        .rounded-banner {
            border-radius: 12px;
        }

        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
        }

        .card-title {
            font-weight: 600;
        }

        .price {
            font-size: 2.5rem;
            font-weight: 700;
        }

        .popular-wrapper {
            margin-top: -2.5rem;
            position: relative;
            z-index: 2;
        }

        .popular-badge {
            background-color: #057a1f;
            color: white;
            font-weight: 500;
            font-size: 0.875rem;
            text-align: center;
            padding: 0.5rem 1rem;
            border-top-left-radius: 0.75rem;
            border-top-right-radius: 0.75rem;
            width: 100%;
            position: absolute;
            top: -2rem;
            left: 0;
            z-index: 2;
        }

        .btn-green {
            background-color: #057a1f;
            color: white;
            border-radius: 0.5rem;
            border: 2px solid #057a1f;
            transition: all 0.2s ease-in-out;
        }

        .btn-green:hover {
            background-color: #fff;
            color: #057a1f;
            border-color: #057a1f;
        }

        .btn-primary {
            border-radius: 20px;
        }

        @media (max-width: 576px) {
            .banner-text {
                font-size: 16px;
            }

            .trend-btn {
                font-size: 10px;
                padding: 4px 8px;
            }
        }
    </style>
@endpush


@section('content')
    <div class="mision-page inter-font-family">
        @include('front.common.header')
        <div id="heroCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item container-heading active">
                    <h3 class="heading-page">{{ __('front_end.systems') }}</h3>
                    <div class="tabs-green">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active btn-tab me-2" id="pills-green-beta-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-green-beta" type="button" role="tab"
                                    aria-controls="pills-green-beta" aria-selected="true">Green Beta</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link btn-tab" id="pills-green-alpha-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-green-alpha" type="button" role="tab"
                                    aria-controls="pills-green-alpha" aria-selected="false">Green Alpha</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link btn-tab" id="pills-green-stock-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-green-stock" type="button" role="tab"
                                    aria-controls="pills-green-stock" aria-selected="false">Green Stock</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <section id="contentDiv" class="text-left">
            <div class="full-width-container">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-green-beta" role="tabpanel"
                        aria-labelledby="pills-green-beta-tab">
                        <div class="container text-center py-5">
                            <h2 class="mb-4">"The trend is your friend" - <span class="text-success">Benjamin Graham</span>

                            </h2>

                            <div class="banner-container mx-auto mb-4">
                                <img src="{{asset('images/banner-beta.png')}}" alt="GVN Banner"
                                    class="img-fluid w-100 rounded-banner" />


                            </div>

                            <div class="des-title my-3 text-muted mb-3" style=" margin: 0 auto;font-size:16px">
                                Identifying the correct trend is the golden key that opens the door to success in trading
                                and accounts for up to 70% of the chance of winning. Getting the right market trend is a key
                                factor for every investor in the financial market. GVN’s Green Beta Robot is a combined
                                engineering of searching for bullish trends with smart algorithms and self-adapting when
                                market trends show signs of change. With an average trend prediction accuracy rate of
                                70-80%, Green Beta Robot is a great assistant for every investor.
                            </div>

                            <div class=" des-title my-3 fw-medium" style=" margin: 0 auto;font-size:16px">
                                Green Beta is able to work on different 20 indicators in Stock, Commodity and Cryptocurrency
                                markets, giving investors a holistic view of the changing trends of shark’s money flow in
                                the global market.
                            </div>

                        </div>
                        <div class="container my-5">
                            <img src="{{ asset('images/history_beta.png') }}" alt="Trading System" class="img-fluid">
                        </div>
                        <div class="container py-5">
                            <div class="row g-4 justify-content-center">

                                <!-- Basic Plan -->
                                <div class="col-12 col-md-4">
                                    <div class="card text-center p-4 h-100">
                                        <h5 class="card-title">Basic plan</h5>
                                        <p class="text-muted">Our most popular plan.</p>
                                        <div class="price">${{$price_product['beta']['monthly_price'] ?? 0}}</div>
                                        <p class="text-muted">/month</p>
                                        <ul class="list-unstyled text-start px-4 mb-4">
                                            <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản phẩm dùng thử
                                            </li>
                                            <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời hạn 1 năm
                                            </li>
                                            <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản phẩm dùng thử
                                            </li>
                                            <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời hạn 1 tháng
                                            </li>
                                        </ul>
                                        <a aria-disabled="true" onclick="return false;" style="cursor: default;  pointer-events: none;" class="btn btn-green w-75 mx-auto">Get started</a>
                                    </div>
                                </div>

                                <!-- Business Plan - Most Popular -->
                                <div class="col-12 col-md-4 d-flex position-relative">
                                    <div class="card p-4 w-100 popular position-relative">
                                        <div class="popular-badge">Most Popular plan</div>
                                        <div class="card-body d-flex flex-column">
                                            <div class="card-content text-center ptable-action">
                                                <h5 class="card-title">Business plan</h5>
                                                <p class="text-muted">Our most popular plan.</p>
                                                <div class="price text-success">
                                                    ${{$price_product['beta']['six_month_price'] ?? 0}}</div>
                                                <p class="text-muted">/6 month</p>
                                                <ul class="list-unstyled text-start px-4 mb-4">
                                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản phẩm
                                                        dùng thử</li>
                                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời hạn 1
                                                        năm</li>
                                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản phẩm
                                                        dùng thử</li>
                                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời hạn 1
                                                        tháng</li>
                                                </ul>
                                            </div>
                                            @if (Auth::check())
                                                <button class="register-product btn btn-green w-75 mx-auto mt-auto"  data-product="beta"  data-id="{{$price_product['beta']->id}}" data-type="trial" data-month="6">Get started</button>
                                            @else
                                                <a  class="btn btn-green w-75 mx-auto mt-auto" href="{{ route('login') }}">Get started</a>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                <!-- Enterprise Plan -->
                                <div class="col-12 col-md-4">
                                    <div class="card text-center p-4 h-100">
                                        <h5 class="card-title">Enterprise plan</h5>
                                        <p class="text-muted">Our most popular plan.</p>
                                        <div class="price">{{$price_product['beta']['yearly_price'] ?? 0}}</div>
                                        <p class="text-muted">/year</p>
                                        <ul class="list-unstyled text-start px-4 mb-4">
                                            <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản phẩm dùng thử
                                            </li>
                                            <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời hạn 1 năm
                                            </li>
                                            <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản phẩm dùng thử
                                            </li>
                                            <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời hạn 1 tháng
                                            </li>
                                        </ul>
                                        <a href="#" class="btn btn-green w-75 mx-auto" aria-disabled="true" onclick="return false;" style="cursor: default;  pointer-events: none;">Get started</a>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- End heading tab -->
                    </div>
                    <div class="tab-pane fade" id="pills-green-alpha" role="tabpanel"
                        aria-labelledby="pills-green-alpha-tab">
                        <!-- Heading tab -->
                        <div class="container-tab-heading">
                            <div class="container text-center py-5">
                                <h2 class="mb-4">“It’s not whether you’re right or wrong, but how much money you make when
                                    you’re right and how much you lose when you’re wrong.”
                                    <h3 class="text-success">George Soros</h3>
                                </h2>
                                <div class="row align-items-center g-4 flex-column-reverse flex-md-row">
                                    <div class="col-md-6 col-6">
                                        <p class="text-secondary fs-6">
                                            You can't control the market, but you can control yourself.
                                            GVN's Green Alpha Robot will be a powerful tool to help you master your
                                            emotions, make disciplined trading decisions and achieve high efficiency in
                                            Trading.
                                            GVN's Green Alpha Robot analyzes the market's momentum during the session,
                                            identifies trends and gives specific trading actions.
                                            Green Beta Robot is suitable for Day trader in the markets.
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="banner-container mx-auto mb-4">
                                            <img src="{{asset('images/banner-alpha.png')}}" alt="GVN Banner"
                                                class="img-fluid w-100 rounded-banner" />
                                        </div>
                                    </div>
                                </div>




                            </div>
                            <div class="container my-5">
                                <img src="{{ asset('images/profit-month.png') }}" alt="Trading System" class="img-fluid" style="width: 100%; ">
                            </div>
                            <div class="container py-5">
                                <div class="row g-4 justify-content-center">

                                    <!-- Basic Plan -->
                                    <div class="col-12 col-md-4">
                                        <div class="card text-center p-4 h-100">
                                            <h5 class="card-title">Basic plan</h5>
                                            <p class="text-muted">Our most popular plan.</p>
                                            <div class="price">${{$price_product['alpha']['monthly_price'] ?? 0}}</div>
                                            <p class="text-muted">/month</p>
                                            <ul class="list-unstyled text-start px-4 mb-4">
                                                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản phẩm dùng
                                                    thử</li>
                                                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời hạn 1 năm
                                                </li>
                                                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản phẩm dùng
                                                    thử</li>
                                                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời hạn 1
                                                    tháng</li>
                                            </ul>
                                              <a href="#" class="btn btn-green w-75 mx-auto" aria-disabled="true" onclick="return false;" style="cursor: default;  pointer-events: none;">Get started</a>
                                        </div>
                                    </div>

                                    <!-- Business Plan - Most Popular -->
                                    <div class="col-12 col-md-4 d-flex position-relative">
                                        <div class="card p-4 w-100 popular position-relative">
                                            <div class="popular-badge">Most Popular plan</div>
                                            <div class="card-body d-flex flex-column">
                                                <div class="card-content text-center">
                                                    <h5 class="card-title">Business plan</h5>
                                                    <p class="text-muted">Our most popular plan.</p>
                                                    <div class="price text-success">
                                                        ${{$price_product['alpha']['six_month_price'] ?? 0}}</div>
                                                    <p class="text-muted">/6 month</p>
                                                    <ul class="list-unstyled text-start px-4 mb-4">
                                                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản
                                                            phẩm dùng thử</li>
                                                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời
                                                            hạn 1 năm</li>
                                                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản
                                                            phẩm dùng thử</li>
                                                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời
                                                            hạn 1 tháng</li>
                                                    </ul>
                                                </div>
                                                 @if (Auth::check())
                                                <button class="register-product btn btn-green w-75 mx-auto mt-auto"  data-product="alpha"  data-id="{{$price_product['alpha']->id}}" data-type="trial" data-month="6">Get started</button>
                                            @else
                                                <a  class="btn btn-green w-75 mx-auto mt-auto" href="{{ route('login') }}">Get started</a>
                                            @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Enterprise Plan -->
                                    <div class="col-12 col-md-4">
                                        <div class="card text-center p-4 h-100">
                                            <h5 class="card-title">Enterprise plan</h5>
                                            <p class="text-muted">Our most popular plan.</p>
                                            <div class="price">${{$price_product['alpha']['yearly_price'] ?? 0}}</div>
                                            <p class="text-muted">/year</p>
                                            <ul class="list-unstyled text-start px-4 mb-4">
                                                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản phẩm dùng
                                                    thử</li>
                                                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời hạn 1 năm
                                                </li>
                                                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản phẩm dùng
                                                    thử</li>
                                                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời hạn 1
                                                    tháng</li>
                                            </ul>
                                             <a href="#" class="btn btn-green w-75 mx-auto" aria-disabled="true" onclick="return false;" style="cursor: default;  pointer-events: none;">Get started</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- End heading tab -->
                    </div>
                    <div class="tab-pane fade" id="pills-green-stock" role="tabpanel"
                        aria-labelledby="pills-green-stock-tab">
                        <div class="tabs-green mt-3">
                        <ul class="nav nav-pills mb-3 " id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active btn-tab me-2" style="font-size: 11px;" id="pills-green-stock-nas100-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-green-stock-nas100" type="button" role="tab"
                                    aria-controls="pills-green-stock-nas100" aria-selected="true">Green Stock-NAS100</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link btn-tab" style="font-size: 11px;" id="pills-green-stock-vnindex-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-green-stock-vnindex" type="button" role="tab"
                                    aria-controls="pills-green-stock-vnindex" aria-selected="false">Green Stock-VNindex</button>
                            </li>

                        </ul>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-green-stock-nas100" role="tabpanel"
                            aria-labelledby="pills-green-stock-nas100-tab">
                                <div class="container-tab-heading">
                            <div class="container text-center py-5">
                                <h2 class="mb-4">“Instead of predicting the market, let focus on finding investment
                                    opportunities.”
                                    <h3 class="text-success">John Templeton</h3>
                                </h2>
                                <div class="row align-items-center g-4 flex-column-reverse flex-md-row">
                                    <div class="col-md-6 col-6">
                                        <p class="text-secondary fs-6">
                                            The Green Stock-NAS100 system automatically sorts stocks by cash flow momentum
                                            strength and stock trends in the NAS100 index daily, provides actions for
                                            investors to update.
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="banner-container mx-auto mb-4">
                                            <img src="{{asset('images/device.png')}}" alt="GVN Banner"
                                                class="img-fluid w-100 rounded-banner" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center g-4 flex-column-reverse flex-md-row">
                                    <div class="col-md-6 col-6">
                                        <div class="banner-container mx-auto mb-4">
                                            <img src="{{asset('images/greenstock-banner-2.png')}}" alt="GVN Banner"
                                                class="img-fluid w-100 rounded-banner" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="text-secondary fs-6">
                                            The system sorts groups of stocks with better profitability over a period of
                                            year, quarter, or month than the overall market.
                                        </p>

                                    </div>
                                </div>

                            </div>

                            <div class="container py-5">
                                <div class="row g-4 justify-content-center">

                                    <!-- Basic Plan -->
                                    <div class="col-12 col-md-4">
                                        <div class="card text-center p-4 h-100">
                                            <h5 class="card-title">Basic plan</h5>
                                            <p class="text-muted">Our most popular plan.</p>
                                            <div class="price">${{$price_product['greenstock-nas100']['monthly_price'] ?? 0}}</div>
                                            <p class="text-muted">/month</p>
                                            <ul class="list-unstyled text-start px-4 mb-4">
                                                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản phẩm dùng
                                                    thử</li>
                                                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời hạn 1 năm
                                                </li>
                                                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản phẩm dùng
                                                    thử</li>
                                                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời hạn 1
                                                    tháng</li>
                                            </ul>
                                              <a href="#" class="btn btn-green w-75 mx-auto" aria-disabled="true" onclick="return false;" style="cursor: default;  pointer-events: none;">Get started</a>
                                        </div>
                                    </div>

                                    <!-- Business Plan - Most Popular -->
                                    <div class="col-12 col-md-4 d-flex position-relative">
                                        <div class="card p-4 w-100 popular position-relative">
                                            <div class="popular-badge">Most Popular plan</div>
                                            <div class="card-body d-flex flex-column">
                                                <div class="card-content text-center">
                                                    <h5 class="card-title">Business plan</h5>
                                                    <p class="text-muted">Our most popular plan.</p>
                                                    <div class="price text-success">
                                                        ${{$price_product['greenstock-nas100']['six_month_price'] ?? 0}}</div>
                                                    <p class="text-muted">/month</p>
                                                    <ul class="list-unstyled text-start px-4 mb-4">
                                                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản
                                                            phẩm dùng thử</li>
                                                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời
                                                            hạn 1 năm</li>
                                                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản
                                                            phẩm dùng thử</li>
                                                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời
                                                            hạn 1 tháng</li>
                                                    </ul>
                                                </div>
                                                @if (Auth::check())
                                                <button class="register-product btn btn-green w-75 mx-auto mt-auto"  data-product="greenstock-nas100"  data-id="{{$price_product['greenstock-nas100']->id}}" data-type="trial" data-month="6">Get started</button>
                                            @else
                                                <a  class="btn btn-green w-75 mx-auto mt-auto" href="{{ route('login') }}">Get started</a>
                                            @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Enterprise Plan -->
                                    <div class="col-12 col-md-4">
                                        <div class="card text-center p-4 h-100">
                                            <h5 class="card-title">Enterprise plan</h5>
                                            <p class="text-muted">Our most popular plan.</p>
                                            <div class="price">${{$price_product['greenstock-nas100']['yearly_price'] ?? 0}}</div>
                                            <p class="text-muted">/year</p>
                                            <ul class="list-unstyled text-start px-4 mb-4">
                                                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản phẩm dùng
                                                    thử</li>
                                                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời hạn 1 năm
                                                </li>
                                                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản phẩm dùng
                                                    thử</li>
                                                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời hạn 1
                                                    tháng</li>
                                            </ul>
                                              <a href="#" class="btn btn-green w-75 mx-auto" aria-disabled="true" onclick="return false;" style="cursor: default;  pointer-events: none;">Get started</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="tab-pane fade" id="pills-green-stock-vnindex" role="tabpanel"
                            aria-labelledby="pills-green-stock-vnindex-tab">
                            <div class="container-tab-heading">
                            <div class="container text-center py-5">
                                <h2 class="mb-4">“Instead of predicting the market, let focus on finding investment
                                    opportunities.”
                                    <h3 class="text-success">John Templeton</h3>
                                </h2>
                                <div class="row align-items-center g-4 flex-column-reverse flex-md-row">
                                    <div class="col-md-6 col-6">
                                        <p class="text-secondary fs-6">
                                            The Green Stock-VNindex system automatically sorts stocks by cash flow momentum
                                            strength and stock trends in the VNindex index daily, provides actions for
                                            investors to update.
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="banner-container mx-auto mb-4">
                                            <img src="{{asset('images/device.png')}}" alt="GVN Banner"
                                                class="img-fluid w-100 rounded-banner" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center g-4 flex-column-reverse flex-md-row">
                                    <div class="col-md-6 col-6">
                                        <div class="banner-container mx-auto mb-4">
                                            <img src="{{asset('images/greenstock-banner-2.png')}}" alt="GVN Banner"
                                                class="img-fluid w-100 rounded-banner" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="text-secondary fs-6">
                                            The system sorts groups of stocks with better profitability over a period of
                                            year, quarter, or month than the overall market.
                                        </p>

                                    </div>
                                </div>

                            </div>

                            <div class="container py-5">
                                <div class="row g-4 justify-content-center">

                                    <!-- Basic Plan -->
                                    <div class="col-12 col-md-4">
                                        <div class="card text-center p-4 h-100">
                                            <h5 class="card-title">Basic plan</h5>
                                            <p class="text-muted">Our most popular plan.</p>
                                            <div class="price">${{$price_product['greenstock-vnindex']['monthly_price'] ?? 0}}</div>
                                            <p class="text-muted">/month</p>
                                            <ul class="list-unstyled text-start px-4 mb-4">
                                                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản phẩm dùng
                                                    thử</li>
                                                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời hạn 1 năm
                                                </li>
                                                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản phẩm dùng
                                                    thử</li>
                                                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời hạn 1
                                                    tháng</li>
                                            </ul>
                                              <a href="#" class="btn btn-green w-75 mx-auto" aria-disabled="true" onclick="return false;" style="cursor: default;  pointer-events: none;">Get started</a>
                                        </div>
                                    </div>

                                    <!-- Business Plan - Most Popular -->
                                    <div class="col-12 col-md-4 d-flex position-relative">
                                        <div class="card p-4 w-100 popular position-relative">
                                            <div class="popular-badge">Most Popular plan</div>
                                            <div class="card-body d-flex flex-column">
                                                <div class="card-content text-center">
                                                    <h5 class="card-title">Business plan</h5>
                                                    <p class="text-muted">Our most popular plan.</p>
                                                    <div class="price text-success">
                                                        ${{$price_product['greenstock-vnindex']['six_month_price'] ?? 0}}</div>
                                                    <p class="text-muted">/month</p>
                                                    <ul class="list-unstyled text-start px-4 mb-4">
                                                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản
                                                            phẩm dùng thử</li>
                                                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời
                                                            hạn 1 năm</li>
                                                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản
                                                            phẩm dùng thử</li>
                                                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời
                                                            hạn 1 tháng</li>
                                                    </ul>
                                                </div>
                                                @if (Auth::check())
                                                <button class="register-product btn btn-green w-75 mx-auto mt-auto"  data-product="greenstock-vnindex"  data-id="{{$price_product['greenstock-vnindex']->id}}" data-type="trial" data-month="6">Get started</button>
                                            @else
                                                <a  class="btn btn-green w-75 mx-auto mt-auto" href="{{ route('login') }}">Get started</a>
                                            @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Enterprise Plan -->
                                    <div class="col-12 col-md-4">
                                        <div class="card text-center p-4 h-100">
                                            <h5 class="card-title">Enterprise plan</h5>
                                            <p class="text-muted">Our most popular plan.</p>
                                            <div class="price">${{$price_product['greenstock-vnindex']['yearly_price'] ?? 0}}</div>
                                            <p class="text-muted">/year</p>
                                            <ul class="list-unstyled text-start px-4 mb-4">
                                                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản phẩm dùng
                                                    thử</li>
                                                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời hạn 1 năm
                                                </li>
                                                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản phẩm dùng
                                                    thử</li>
                                                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời hạn 1
                                                    tháng</li>
                                            </ul>
                                              <a href="#" class="btn btn-green w-75 mx-auto" aria-disabled="true" onclick="return false;" style="cursor: default;  pointer-events: none;">Get started</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        </div>
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
            " onmouseover="this.style.backgroundColor='#33a853';" onmouseout="this.style.backgroundColor='#198754';">
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
<script type="text/javascript">
        $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    });
    $(document).on('click', '.register-product', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let type = $(this).data('type');
            let month = $(this).data('month');
            let product = $(this).data('product');
            $.ajax({
                url: "{{ route('api.buy-product') }}",
                type: 'POST',
                data: {
                    id: id,
                    type: type,
                    month: month
                },
                success: function(data) {
                    if (data.status == 'success') {
                        alert(data.message);
                        if(product == 'alpha') {
                            window.open( "{{ route('front.home.green-alpha') }}", '_blank');
                        }
                        if(product=='beta'){
                            window.open("{{ route('front.home.green-beta') }}", '_blank');
                        }
                        if(product=='greenstock-nas100'){
                            window.open(`{{ route('front.home.green-stock') }}`, '_blank');
                        }
                        if(product=='greenstock-vnindex'){
                            window.open(`{{ route('front.home.vnindex') }}`, '_blank');
                        }
                    } else {
                         alert(data.message);
                    }
                }
            });
        });
        </script>
@endpush
