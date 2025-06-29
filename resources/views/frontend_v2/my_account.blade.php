@extends('layouts.app')
@section('title', 'My Page')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home_v2.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">

    <link rel="stylesheet" href="{{ asset('css/green_stock.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        .table>tbody>tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .table>tbody>tr:hover {
            background-color: #e6f7e6;
        }

        .nav-pills .nav-link.active {
            background: linear-gradient(to right, #007f00, #00c851);
            color: white;
        }

        .card-price {
            background: linear-gradient(to right, #007f00, #00c851);
            color: white;
            border-radius: 10px;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f2f7fd;
        }

        .edit-icon {
            cursor: pointer;
            color: #888;
        }

        .edit-icon:hover {
            color: #000;
        }

        .section-title {
            font-size: 14px;
            font-weight: 500;
            color: #1E1E1E;
            margin-bottom: 12px;
        }

        .section-divider {
            border-bottom: 1px solid #eee;
            margin-bottom: 24px;
        }

        .avatar {
            width: 100px;
            height: 100px;
            object-fit: cover;
            /* Giữ tỉ lệ ảnh, không méo */
            border-radius: 50%;
            /* Bo tròn hoàn toàn */
        }

        /* Mặc định */
        .page-item .page-link {
            color: #198754;
            border: 1px solid #198754;
            background-color: #fff;
            transition: 0.3s;
        }

        /* Hover */
        .page-item .page-link:hover {
            color: #fff;
            background-color: #198754;
            border-color: #198754;
        }

        /* Active */
        .page-item.active .page-link {
            color: #fff;
            background-color: #198754;
            border-color: #198754;
        }

        .form-label.required::after {
            content: " *";
            color: red;
        }

        .custom-success-alert {
            background-color: #e6ffe6;
            /* Light green background */
            border: 1px solid #ccebcc;
            /* Slightly darker green border */
            color: #008000;
            /* Dark green text */
            padding: 10px 15px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 20px;
            /* Adjust as needed */
            width: fit-content;
            /* Make it fit its content */
        }

        .custom-success-alert .icon-check {
            color: #008000;
            /* Green checkmark */
            margin-right: 10px;
            font-size: 1.2em;
        }

        .custom-success-alert .close-btn {
            background: none;
            border: none;
            font-size: 1.2em;
            color: #008000;
            cursor: pointer;
        }
    </style>
@endpush
@section('content')
    <div class="home-page inter-font-family">
        @include('front.common.header')
        <!-- Heading tab -->

        <div class="container mt-5 bg-white">
            <p class="section-title">Account Setting</p>
            <div class="section-divider"></div>
            <div class="tabs-green">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active btn-tab me-2" id="pills-dashboard-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-dashboard" type="button" role="tab" aria-controls="pills-dashboard"
                            aria-selected="true">Dashboard</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link btn-tab" id="pills-my-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-my-profile" type="button" role="tab" aria-controls="pills-my-profile"
                            aria-selected="false">My Profile</button>
                    </li>
                    @auth
                        @if (Auth::user()->role_id == 2)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link btn-tab" id="pills-user-management-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-user-management" type="button" role="tab"
                                    aria-controls="pills-user-management" aria-selected="false">User Management</button>
                            </li>
                        @endif
                    @endauth
                    <li class="nav-item" role="presentation">
                        <button class="nav-link btn-tab" id="pills-voucher-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-voucher" type="button" role="tab" aria-controls="pills-voucher"
                            aria-selected="false">Voucher</button>
                    </li>
                </ul>
            </div>

            <section id="contentDiv" class="text-left">
                <div class="full-width-container">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade pt-3 show active" id="pills-dashboard" role="tabpanel"
                            aria-labelledby="pills-dashboard-tab">
                            <!-- My Orders -->
                            <div class="col-md-2 fw-semibold pb-3">My order</div>
                            <div class="row g-3 mb-4">
                                <div class="col-md-3">
                                    <div class="card card-price p-3" data-bs-toggle="modal" data-bs-target="#planModal"
                                        data-type="alpha">
                                        <h6>Green Alpha</h6>
                                        <div class="fs-4">${{ $price_product['alpha']['six_month_price'] }}</div>
                                        <small>Business plan/6 month</small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card card-price p-3" data-bs-toggle="modal" data-bs-target="#planModal"
                                        data-type="beta">
                                        <h6>Green Beta</h6>
                                        <div class="fs-4">${{ $price_product['beta']['six_month_price'] }}</div>
                                        <small>Business plan/6 month</small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card card-price p-3" data-bs-toggle="modal" data-bs-target="#planModal"
                                        data-type="greenstock-nas100">
                                        <h6>Green Stock-Nas100</h6>
                                        <div class="fs-4">${{ $price_product['greenstock-nas100']['six_month_price'] }}</div>
                                        <small>Business plan/6 month</small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card card-price p-3" data-bs-toggle="modal" data-bs-target="#planModal"
                                        data-type="greenstock-vnindex">
                                        <h6>Green Stock-VNIndex</h6>
                                        <div class="fs-4">${{ $price_product['greenstock-vnindex']['six_month_price'] }}</div>
                                        <small>Business plan/6 month</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Table -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-capitalize text-center text-nowrap">No.</th>
                                            <th class="text-capitalize text-center text-nowrap">Product Name</th>
                                            <th class="text-capitalize text-center text-nowrap">Start Date</th>
                                            <th class="text-capitalize text-center text-nowrap">End Date</th>
                                            <th class="text-capitalize text-center text-nowrap">Version</th>
                                            <th class="text-capitalize text-center text-nowrap">Gia Hạn</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($subscriptions as $idx => $subscription)
                                            <tr>
                                                <td>{{$idx + 1}}</td>
                                                <td>{{$subscription->product->name}}</td>
                                                <td>{{$subscription->start_date}}</td>
                                                <td>{{$subscription->end_date}}</td>
                                                <td>{{$subscription->is_trial == 0 ? 'Thương mại' : 'Dùng Thử'}}</td>
                                                <td><i class="bi bi-pencil edit-icon" data-bs-toggle="modal"
                                                        data-bs-target="#purchar"></i></td>
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
                        </div>
                        <div class="tab-pane fade pt-3" id="pills-my-profile" role="tabpanel"
                            aria-labelledby="pills-my-profile-tab">
                            <!-- My Orders -->

                            <div class="row">
                                <div class="col-md-2 fw-semibold pb-3">Edit profile</div>
                                <div class="col-md-10">
                                    <div class="mb-4 d-flex align-items-center gap-3">
                                        <img src="{{asset('images/Logo-GVN-FinTrade-nobg.png')}}" alt="avatar"
                                            class="avatar img-thumbnail">
                                        <div class="d-flex gap-2 common">
                                            <button class="btn btn-outline-primary">Upload new picture</button>
                                            <button class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>

                                    <form class="tg-form" action="{{route('account.update')}}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">FullName <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ $info->profile->name ?? ''}}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control" value="{{ $info->email ?? '' }}"
                                                    name="email">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Phone number <span
                                                        class="text-danger">*</span></label>
                                                <input name="phone" type="text" class="form-control"
                                                    value="{{ $info->profile->phone ?? '' }}" placeholder="Enter your Phone">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Birthdate <span
                                                        class="text-danger">*</span></label>
                                                <input name="birthday" value="{{ $info->profile->birthday ?? ''}}"
                                                    type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-md-6">
                                                <label class="form-label">Address <span class="text-danger">*</span></label>
                                                <input type="text" name="address" class="form-control"
                                                    value="{{ $info->profile->address ?? ''}}"
                                                    placeholder="Enter your address">
                                            </div>
                                            @auth
                                                @if (Auth::user()->role_id == 3)
                                                    <div class="col-md-6">
                                                        <label class="form-label">Quản Lý</label>
                                                        <input type="email" name="manager" class="form-control"
                                                            value="{{$info->profile->UserManager->email ?? ''}}"
                                                            placeholder="Enter your email manager">
                                                    </div>
                                                @endif
                                            @endauth
                                        </div>
                                        <button type="submit" class="btn btn-success px-4">Save Profile</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @auth
                            @if (Auth::user()->role_id == 2)
                                <div class="tab-pane fade pt-3" id="pills-user-management" role="tabpanel"
                                    aria-labelledby="pills-user-management-tab">
                                    <!-- My Orders -->
                                    <div class="col-md-2 fw-semibold pb-2">User Management</div>
                                    <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
                                        <input type="text" class="form-control" placeholder="Search Username, email,..."
                                            style="max-width: 280px;">
                                        <button class="btn btn-success">Search</button>
                                        <button class="btn btn-outline-secondary">Reset</button>
                                        <button class="btn btn-success ms-auto" data-bs-toggle="modal"
                                            data-bs-target="#addUserModal">Add User</button>
                                    </div>


                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>No.</th>
                                                    <th>User name</th>
                                                    <th>Email</th>
                                                    <th>Phone number</th>
                                                    <th>Created At</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                 @forelse($customers as $idx => $customer)
                                <tr>
                                    <td width="5%" class="text-center">{{$idx + 1}}</td>
                                    <td width="15%">{{$customer->name}}</td>
                                    <td width="15%">{{$customer->email}}</td>
                                    <td width="10%">{{$customer->profile->phone ?? ''}}</td>
                                     <td width="10%">{{$customer->profile->address ?? ''}}</td>
                                    <td width="10%" class="text-center text-nowrap">

                                    </td>
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
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        {{ $customers->links() }}
                                    </div>
                                </div>
                            @endif
                        @endauth
                        <div class="tab-pane fade pt-3" id="pills-voucher" role="tabpanel"
                            aria-labelledby="pills-voucher-tab">
                            <!-- My Orders -->
                            <div class="col-md-2 fw-semibold pb-3">Voucher</div>
                            <div class="d-flex mb-3">
                                <button class="btn btn-generate btn-success me-2">Generate New Code</button>

                                <select class="form-select w-auto">
                                    <option>All Code</option>
                                    <option>Used</option>
                                    <option>Unused</option>
                                </select>
                            </div>

                            <table class="table voucher-table">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Status</th>
                                        <th>User by</th>
                                        <th>Used at</th>
                                        <th>Expiration Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <tr>
                                    <td colspan="6" class="text-center">
                                        {{ __('panel.nodata') }}
                                    </td>
                                </tr>
                                    <!-- thêm các hàng khác -->
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-end mt-3">
                                <ul class="pagination">

                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

        </div>
        <!-- Modal -->
        <div class="modal fade" id="planModal" tabindex="-1" aria-labelledby="planModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content rounded-4">
                    <div class="modal-header border-bottom">
                        <h5 class="modal-title">Extend the service</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-4 text-center">
                            <!-- Card item -->
                            <div class="col-md-4">
                                <div class="border rounded-4 p-4 h-100 shadow-sm">
                                    <h6 class="text-success fw-bold">Basic plan</h6>
                                    <small class="text-muted d-block mb-2">Our most popular plan.</small>
                                    <div class="fs-2 fw-bold" id="price_month">$2</div>
                                    <small class="text-muted">/month</small>
                                    <ul class="list-unstyled mt-3 text-start">
                                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản phẩm dùng thử</li>
                                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời hạn 1 tháng</li>
                                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản phẩm dùng thử</li>
                                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời hạn 1 tháng</li>
                                    </ul>
                                    <button aria-disabled="true" onclick="return false;"
                                        style="cursor: default;  pointer-events: none;"
                                        class="btn btn-success w-100 rounded mt-3" >Buy</button>
                                </div>
                            </div>
                            <!-- Lặp lại 2 card tiếp theo tương tự -->
                            <div class="col-md-4">
                                <div class="border rounded-4 p-4 h-100 shadow-sm">
                                    <h6 class="text-success fw-bold">Business plan</h6>
                                    <small class="text-muted d-block mb-2">Our most popular plan.</small>
                                    <div class="fs-2 fw-bold" id="price_6month">$10</div>
                                    <small class="text-muted">/6month</small>
                                    <ul class="list-unstyled mt-3 text-start">
                                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản phẩm dùng thử</li>
                                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời hạn 1 tháng</li>
                                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản phẩm dùng thử</li>
                                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời hạn 1 tháng</li>
                                    </ul>
                                    <a class="btn btn-success w-100 rounded mt-3" id="action_buy" data-month="6">Buy</a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="border rounded-4 p-4 h-100 shadow-sm">
                                    <h6 class="text-success fw-bold">Enterprise plan</h6>
                                    <small class="text-muted d-block mb-2">Our most popular plan.</small>
                                    <div class="fs-2 fw-bold" id="price_year">$20</div>
                                    <small class="text-muted">/year</small>
                                    <ul class="list-unstyled mt-3 text-start">
                                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản phẩm dùng thử</li>
                                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời hạn 1 năm</li>
                                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản phẩm dùng thử</li>
                                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời hạn 1 tháng</li>
                                    </ul>
                                    <button aria-disabled="true" onclick="return false;"
                                        style="cursor: default;  pointer-events: none;"
                                        class="btn btn-success w-100 rounded mt-3">Buy</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="purchar" tabindex="-1" aria-labelledby="planModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Payment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="cardNumber" class="form-label required">Card number</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="cardNumber" placeholder="Enter card number">
                                    <span class="input-group-text">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Visa_Inc._logo.svg/1280px-Visa_Inc._logo.svg.png"
                                            alt="Visa" style="height: 1.2em; margin-right: 5px;">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/800px-Mastercard-logo.svg.png"
                                            alt="Mastercard" style="height: 1.2em;">
                                    </span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="nameOnCard" class="form-label required">Name on card</label>
                                <input type="text" class="form-control" id="nameOnCard" placeholder="Enter name on card">
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="expirationDate" class="form-label required">Expiration date</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                        <input type="text" class="form-control" id="expirationDate" placeholder="MM/YY">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="cvvCvc" class="form-label required">CVV/CVC</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-credit-card-fill"></i></span>
                                        <input type="text" class="form-control" id="cvvCvc" placeholder="CVV/CVC">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="billingAddress" class="form-label required">Billing address</label>
                                <input type="text" class="form-control" id="billingAddress"
                                    placeholder="Enter billing address">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Payment</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addUserForm" method="POST" data-url="{{ route('create-user') }}">
                            @csrf
                            <input type="hidden" name="manager_id" value="{{ Auth::user()->id }}">
                              <input type="hidden" name="role_id" value="3">
                            @if ($errors->any())
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
                                    <ul class="list-disc list-inside text-sm">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="mb-3">
                                <label class="form-label">Username <span class="text-danger">*</span></label>
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required>
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>

                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                <div class="input-group has-validation">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>


                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" class="form-control  @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="new-password"
                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                        title="Must contain at least one number, one uppercase and lowercase letter, and at least 8 or more characters" placeholder="
                                        Password">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                </div>

                                <small class="form-text text-muted">
                                    Must contain at least one number, one uppercase and lowercase letter, and at least 8 or
                                    more characters.
                                </small>
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-3">
                                <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input name="confirm_password" type="password" class="form-control">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>

                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-end" style="border-top: none;">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                <button class="btn btn-success">Register</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>


        <div aria-live="polite" aria-atomic="true" class="position-relative">
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
            </div>
        </div>
        @include('frontend_v2.components.footer')
    </div>
@endsection


@push('scripts')

    <script>
$(document).ready(function () {
    $('#addUserForm').submit(function (e) {
        e.preventDefault();

        let $form = $(this);
        let formData = $form.serialize();
        let url = $form.data('url');

        // Clear old errors
        $form.find('.is-invalid').removeClass('is-invalid');
        $form.find('.invalid-feedback').remove();
        $form.find('.alert-danger').remove();

        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            success: function (response) {
                // Close modal
                $('#addUserModal').modal('hide');

                // Optional: show a success message
                alert('User registered successfully!');
                $form[0].reset();
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;

                    // Loop through errors and show them
                    for (let field in errors) {
                        let input = $form.find(`[name="${field}"]`);
                        input.addClass('is-invalid');

                    }

                    // Show full error list
                    let errorList = '<ul class="list-disc list-inside text-sm">';
                    for (let field in errors) {
                        errorList += `<li>${errors[field][0]}</li>`;
                    }
                    errorList += '</ul>';

                    $form.prepend(`
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4 alert-danger">
                            ${errorList}
                        </div>
                    `);
                } else {
                    alert('Something went wrong. Please try again.');
                }
            }
        });
    });
});


        const modalElement = document.getElementById('planModal');

        modalElement.addEventListener('show.bs.modal', function (event) {
            // Button hoặc element đã kích hoạt modal
            const button = event.relatedTarget;

            // Lấy data từ button
            const type = button.getAttribute('data-type');
            const data = @json($price_product);
            // Set data vào modal
            modalElement.querySelector('#price_month').textContent = `${data[type].monthly_price}`;
            modalElement.querySelector('#price_6month').textContent = `${data[type].six_month_price}`;
            modalElement.querySelector('#price_year').textContent = `${data[type].yearly_price}`;
            modalElement.querySelector('#action_buy').setAttribute('data-type', 'trial');
            modalElement.querySelector('#action_buy').setAttribute('data-product', type);
            modalElement.querySelector('#action_buy').setAttribute('data-id', `${data[type].id}`);
        });
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });
        $(document).on('click', '#action_buy', function (e) {
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
                success: function (data) {
                    if (data.status == 'success') {
                        alert(data.message);
                        if (product == 'alpha') {
                            window.open("{{ route('front.home.green-alpha') }}", '_blank');
                        }
                        if (product == 'beta') {
                            window.open("{{ route('front.home.green-beta') }}", '_blank');
                        }
                        if (product == 'greenstock') {
                            window.open(`{{ route('front.home.green-stock') }}`, '_blank');
                        }
                    } else {
                        alert(data.message);
                    }
                }
            });
        });
    </script>
@endpush
