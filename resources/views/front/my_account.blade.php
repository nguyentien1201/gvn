<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GVN</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.datatables.net/1.11.1/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</head>


<style>
    .tg {
        --bg-primary: #207ba1;
        --text-primary: #207ba1;
    }

    .tg-account .account-banner {
        background: #008000 ;
        width: 100%;
        float: left;
        padding: 70px 0 0;
    }

    .tg-account .account-banner .inner-banner .detail * {
        color: #fff;
    }

    .tg-account .account-banner .inner-banner .profile {
        text-align: center;
    }

    .tg-account .account-banner .inner-banner .profile span.image img {
        width: 130px;
        border-radius: 50%;
        box-shadow: 0px 0px 15px -10px #000;
    }

    .tg-account .account-banner .inner-banner .detail h3.user-name {
        font-size: 20px;
        margin-top: 20px;
    }

    .tg-account .account-banner .inner-banner .nav-area {
        width: 100%;
        float: left;
        margin-top: 45px;
    }

    .tg-account .account-banner .inner-banner .nav-area ul li a {
        background: rgba(255, 255, 255, .4);
        color: #fff;
        font-weight: 500;
        border-radius: 0px;
        font-size: 16px;
        border: none;
        padding: 10px 28px;
        min-width: 120px;
        display: block;
        transition: .4s;
        text-align: center;
    }

    .tg-account .account-banner .inner-banner .nav-area ul li {
        margin-right: 7px;
    }

    .tg-account .account-banner .inner-banner .nav-area ul li a.active,
    .tg-account .account-banner .inner-banner .nav-area ul li a:hover {
        color: var(--text-primary);
        background: #fff;
    }

    .tg-tabs-content-wrapp {
        width: 100%;
        float: left;
        padding: 30px 0;
    }

    div#my-orders-table_length {
        width: fit-content;
        float: left;
    }

    div#my-orders-table_filter {
        width: fit-content;
        float: right;
    }

    div#my-orders-table_length select,
    div#my-orders-table_filter input {
        border: 1px solid #207ba1;
        padding: 5px 15px;
    }

    div#my-orders-table_length,
    div#my-orders-table_filter {
        margin-bottom: 22px;
    }

    .tg-tabs-content-wrapp form.tg-form {
        width: 100%;
        float: left;
        background: #f7f7f7;
        padding: 30px 30px 60px;
        border: 1px solid #eaeaea;
    }

    .tg-tabs-content-wrapp form.tg-form button {
        background: var(--bg-primary);
        border: none;
        padding: 10px 32px;
        cursor: pointer;
        margin: 13px 0 0;
    }

    .tg-tabs-content-wrapp .my-account-dashboard .card img {
        max-width: 80px;
    }

    .tg-tabs-content-wrapp .my-account-dashboard .card {
        text-align: center;
    }

    .tg-tabs-content-wrapp .my-account-dashboard .card h2 {
        font-size: 20px;
        margin-top: 14px;
    }

    .tg-tabs-content-wrapp .my-account-dashboard .card p {
        font-size: 15px;
    }

    div#my-orders-table_info {
        float: left;
    }

    div#my-orders-table_paginate {
        float: right;
    }

    .page-item.active .page-link {
        background-color: lightgrey !important;
        border: 1px solid black;
    }

    .page-link {
        color: black !important;
    }

    div#my-orders-table_paginate a {
        background: #e6e6e6;
        margin: 0 2px;
        padding: 3px 11px;
        display: inline-block;
        cursor: pointer;
        text-decoration: none;
        color: #000;
    }

    div#my-orders-table_paginate {
        margin-top: 8px;
    }

    div#my-orders-table_paginate span a.current {
        color: #fff !important;
        background: var(--primary);
    }

    .tg-tabs-content-wrapp .my-account-dashboard .card {
        cursor: pointer;
    }

    .tg-tabs-content-wrapp .my-account-dashboard .card:hover,
    .tg-tabs-content-wrapp .my-account-dashboard .card.active {
        background: var(--text-primary);
    }

    .tg-tabs-content-wrapp .my-account-dashboard .card:hover *,
    .tg-tabs-content-wrapp .my-account-dashboard .card.active * {
        color: #fff;
    }

    .tg-tabs-content-wrapp .my-account-dashboard .card {
        transition: .4s;
        border-radius: 0px;
        box-shadow: 0px 2px 7px -5px;
    }

    table#my-orders-table a.view-order {
        background: var(--text-primary);
        cursor: pointer;
        text-decoration: none;
        color: #fff;
        padding: 4px 11px;
        border-radius: 3px;
    }

    @media(min-width:768px) {

        table#my-orders-table td.action,
        table#my-orders-table th.action {
            text-align: center;
        }
    }

    @media(max-width:768px) {
        .tg-account .account-banner .inner-banner .nav-area ul li a {
            min-width: auto !important;
            padding: 8px 15px;
        }
    }

    @media(max-width:600px) {
        .tg-account .account-banner .inner-banner .nav-area ul li a span {
            display: none;
        }

        .tg-account .account-banner .inner-banner .nav-area ul li a {
            min-width: auto;
            padding: 8px 20px;
        }

        .tg-account .account-banner .inner-banner .nav-area ul {
            text-align: center;
            margin: 0 auto;
            width: fit-content;
        }

        .tg-account .detail {
            text-align: center;
        }

        div#my-orders-table_length select,
        div#my-orders-table_filter input {
            max-width: 120px;
            font-size: 14px;
        }

        div#my-orders-table_length label,
        div#my-orders-table_filter label {
            font-size: 0px;
        }
    }
</style>
<script>
    $('#myTab a').on('click', function (e) {
        e.preventDefault()
        $(this).tab('show')
    });

    /**
     * Datatable call
     */
    $(document).ready(function () {
        $('#my-orders-table').DataTable();
    });

    /**
     * My account nav click
     */
    $(document).ready(function () {
        $('.tg-tabs-content-wrapp .my-account-dashboard .card').click(function () {

            var ariaClick = $(this).attr('area-toggle');
            $('.tg-account .account-banner .nav-area  a#' + ariaClick).click();
        });
    });
</script>
@include('front.common.header')
        <div class="content-wrapper">
        @if(session('success'))
            <div class="mb-2">
                <div class="col-lg-12">
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                </div>
            </div>
        @endif
        @if(session('fail'))
            <div class="mb-2">
                <div class="col-lg-12">
                    <div class="alert alert-danger" role="alert">{{ session('fail') }}</div>
                </div>
            </div>
        @endif
        @yield('content')
    </div>
<section class="tg-may-account-wrapp tg">
    <div class="inner">
        <div class="tg-account">

            <!-- Accont banner start -->
            <div class="account-banner">
                <div class="inner-banner">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 detail">
                                <div class="inner">
                                    <h1 class="page-title">My Account</h1>
                                    <h3 class="user-name">Hello {{$info->profile->fullname ?? $info->name}}</h3>

                                </div>
                            </div>
                            <!-- Column end -->
                            <div class="col-md-4 profile">
                                <div class="profile">
                                    <span class="image">
                                        <img src="https://res.cloudinary.com/templategalaxy/image/upload/v1631257421/codepen-my-account/images/profile_pdpo9w.png"
                                            alt="Yash">
                                    </span>
                                </div>
                            </div>
                            <!-- Column end -->
                        </div>
                        <!-- Row end -->

                        <!-- Navbar Start -->
                        <div class="nav-area">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="dashboard-link" data-toggle="tab" href="#dashboard"
                                        role="tab" aria-controls="dashboard" aria-selected="true"><i
                                            class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="my-order" data-toggle="tab" href="#my-orders" role="tab"
                                        aria-controls="my-orders" aria-selected="false"><i
                                            class="fas fa-file-invoice"></i> <span>Orders</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="account-detail" data-toggle="tab" href="#account-details"
                                        role="tab" aria-controls="account-details" aria-selected="false"><i
                                            class="fas fa-user-alt"></i> <span>Profile</span></a>
                                </li>
                                <li class="nav-item">

                                    <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();" class="nav-link" id="logout" data-toggle="tab" href="#logout" role="tab"
                                        aria-controls="logout" aria-selected="false"><i class="fas fa-sign-out-alt"></i>
                                        <span>Logout</span></a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <!-- Navbar End -->
                    </div>
                </div>
            </div>
            <!-- Banner end   -->

            <!-- Tabs Content start -->
            <div class="tabs tg-tabs-content-wrapp">
                <div class="inner">
                    <div class="container">
                        <div class="inner">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="dashboard" role="tabpanel"
                                    aria-labelledby="dashboard-link">
                                    <div class="my-account-dashboard">
                                        <div class="inner">
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <div class="card" area-toggle="my-order">
                                                        <div class="card-body">
                                                            <div class="text-center">
                                                                <a><img
                                                                        src="https://res.cloudinary.com/templategalaxy/image/upload/v1631257421/codepen-my-account/images/orders_n2aopq.png"></a>
                                                            </div>
                                                            <h2>Your Orders</h2>
                                                            <p>Quản lý các sản phẩm đã đăng ký</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-3">
                                                    <div class="card" area-toggle="account-detail">
                                                        <div class="card-body">
                                                            <div class="text-center">
                                                                <a><img
                                                                        src="https://res.cloudinary.com/templategalaxy/image/upload/v1631257421/codepen-my-account/images/login_aq9v9z.png"></a>
                                                            </div>
                                                            <h2>Account Details</h2>
                                                            <p>Thông tin tài khoản</p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="my-orders" role="tabpanel" aria-labelledby="my-order">
                                    <table id="my-orders-table"
                                        class="table table-striped table-bordered dt-responsive nowrap"
                                        style="width:100%">
                                        <thead>
                            <tr>
                                <th width="5%" class="text-center">{{__('panel.no')}}</th>
                                <th width="15%">{{ __('subscription.product_name') }}</th>
                                <th width="10%">{{ __('subscription.start_date') }}</th>
                                <th width="15%">{{ __('subscription.end_date') }}</th>
                                <td>Bản sử dụng</td>
                                <th width="10%" class="text-nowrap text-center">{{ __('Gia Hạn') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($subscriptions as $idx => $subscription)
                                <tr>
                                    <td width="5%" class="text-center">{{$idx + 1}}</td>
                                    <td width="15%">{{$subscription->product->name}}</td>
                                    <td width="10%">{{$subscription->start_date}}</td>
                                    <td width="15%">{{$subscription->end_date}}</td>
                                    <td>{{$subscription->is_trial == 0 ? 'Thương mại' : 'Dùng Thử'}}</td>
                                    <td width="10%" class="text-center text-nowrap">
                                        <a href="#confirmExtend" data-toggle="modal"  data-id="{{$subscription->id}}" data-product_id="{{$subscription->product_id}}"
                                           class="btn btn-primary btn-circle btn-sm">
                                            <i class="fas fa-edit" aria-hidden="true"></i>
                                        </a>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">
                                        {{ __('panel.nodata') }}
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="account-details" role="tabpanel"
                                    aria-labelledby="account-detail">
                                    <div class="account-detail-form">
                                        <div class="inner">
                                            <form class="tg-form" action="{{route('account.update')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="fullname">FullName</label>
                                                        <input name="fullname" value="{{$info->profile->fullname ?? ''}}" type="text" class="form-control" id="fullname"
                                                            placeholder="FullName">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="address">Address</label>
                                                        <input name="address" value="{{$info->profile->address ?? ''}}" type="text" class="form-control" id="address"
                                                            placeholder="Address">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="phone">Phone</label>
                                                        <input name="phone"  value="{{$info->profile->phone ?? ''}}" type="text" class="form-control" id="phone"
                                                            placeholder="Number Phone">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="email">Email</label>
                                                        <input readonly value="{{$info->email ?? ''}}" type="email" class="form-control" id="email"
                                                            placeholder="Email">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="birthday">Birthdate</label>
                                                        <input name="birthday" value="{{$info->profile->birthday ?? ''}}" type="text" class="form-control" id="birthday"
                                                            placeholder="MM/DD/YYYY">
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @include('partials.dialog-confirm-extend')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
<script>
    $(document).ready(function(){
        $('#confirmExtend').on('show.bs.modal', function (e) {
            // Perform AJAX request to get data
            $.ajax({
            url: '/api/get-product', // Replace with your data source URL
            method: 'GET',
            data: {
                id: $(e.relatedTarget).data('id'),
                product_id: $(e.relatedTarget).data('product_id')
            },
            success: function(data) {
                // Load the data into the modal body

                let product = data.product;
                $('#product_id').val(product.id);
                $('#sub_price_id').val($(e.relatedTarget).data('id'));
                $('#yearly_price').text(product.yearly_price);
                $('#six_month_price').text(product.six_month_price);
                $('#monthly_price').text(product.monthly_price);
            },
            error: function() {
                $('#modal-data').html('<p>Error loading data</p>');
            }
            });
        });
    });
</script>
</html>
