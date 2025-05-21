@extends('layouts.app')
@section('title', 'My Page')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home_v2.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">

    <link rel="stylesheet" href="{{ asset('css/green_stock.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
                    <li class="nav-item" role="presentation">
                        <button class="nav-link btn-tab" id="pills-user-management-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-user-management" type="button" role="tab"
                            aria-controls="pills-user-management" aria-selected="false">User Management</button>
                    </li>
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
                                <div class="col-md-4">
                                    <div class="card card-price p-3" data-bs-toggle="modal" data-bs-target="#planModal">
                                        <h6>Green Alpha</h6>
                                        <div class="fs-4">$2</div>
                                        <small>Basic plan /month</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-price p-3" data-bs-toggle="modal" data-bs-target="#planModal">
                                        <h6>Green Beta</h6>
                                        <div class="fs-4">$2</div>
                                        <small>Basic plan /month</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-price p-3" data-bs-toggle="modal" data-bs-target="#planModal">
                                        <h6>Green Stock</h6>
                                        <div class="fs-4">$2</div>
                                        <small>Basic plan /month</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Table -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No.</th>
                                            <th>Product Name</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Version</th>
                                            <th>Gia Hạn</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Green Beta 1.3.3</td>
                                            <td>2020-05-06 11:24:08</td>
                                            <td>2020-05-05 10:21:13</td>
                                            <td>Thương mại</td>
                                            <td><i class="bi bi-pencil edit-icon"></i></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Green Stock</td>
                                            <td>2020-05-03 08:14:01</td>
                                            <td>2020-05-01 06:05:46</td>
                                            <td>Thương mại</td>
                                            <td><i class="bi bi-pencil edit-icon"></i></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Green Alpha</td>
                                            <td>2020-05-02 07:10:15</td>
                                            <td>2020-05-04 09:18:16</td>
                                            <td>Thương mại</td>
                                            <td><i class="bi bi-pencil edit-icon"></i></td>
                                        </tr>
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

                                    <form>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">FullName <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" value="Tien Nguyen">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control" value="nguyentien1201@gmail.com">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Phone number <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="Enter your name">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Birthdate <span
                                                        class="text-danger">*</span></label>
                                                <input type="date" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Address <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="Enter your address">
                                        </div>
                                        <button type="submit" class="btn btn-success px-4">Save Profile</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade pt-3" id="pills-user-management" role="tabpanel"
                            aria-labelledby="pills-user-management-tab">
                            <!-- My Orders -->
                            <div class="col-md-2 fw-semibold pb-2">User Management</div>
                            <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
                                <input type="text" class="form-control" placeholder="Search Username, email,..."
                                    style="max-width: 280px;">
                                <button class="btn btn-success">Search</button>
                                <button class="btn btn-outline-secondary">Reset</button>
                                <button class="btn btn-success ms-auto">Add User</button>
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
                                        <tr>
                                            <td>1</td>
                                            <td>Ronald Richards</td>
                                            <td>kenzi.lawson@example.com</td>
                                            <td>(629) 555-0129</td>
                                            <td>2020-05-05 10:21:13</td>
                                            <td><i class="bi bi-trash text-danger" role="button"></i></td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Ronald Richards</td>
                                            <td>kenzi.lawson@example.com</td>
                                            <td>(629) 555-0129</td>
                                            <td>2020-05-05 10:21:13</td>
                                            <td><i class="bi bi-trash text-danger" role="button"></i></td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Ronald Richards</td>
                                            <td>kenzi.lawson@example.com</td>
                                            <td>(629) 555-0129</td>
                                            <td>2020-05-05 10:21:13</td>
                                            <td><i class="bi bi-trash text-danger" role="button"></i></td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Ronald Richards</td>
                                            <td>kenzi.lawson@example.com</td>
                                            <td>(629) 555-0129</td>
                                            <td>2020-05-05 10:21:13</td>
                                            <td><i class="bi bi-trash text-danger" role="button"></i></td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Ronald Richards</td>
                                            <td>kenzi.lawson@example.com</td>
                                            <td>(629) 555-0129</td>
                                            <td>2020-05-05 10:21:13</td>
                                            <td><i class="bi bi-trash text-danger" role="button"></i></td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Ronald Richards</td>
                                            <td>kenzi.lawson@example.com</td>
                                            <td>(629) 555-0129</td>
                                            <td>2020-05-05 10:21:13</td>
                                            <td><i class="bi bi-trash text-danger" role="button"></i></td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Ronald Richards</td>
                                            <td>kenzi.lawson@example.com</td>
                                            <td>(629) 555-0129</td>
                                            <td>2020-05-05 10:21:13</td>
                                            <td><i class="bi bi-trash text-danger" role="button"></i></td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Ronald Richards</td>
                                            <td>kenzi.lawson@example.com</td>
                                            <td>(629) 555-0129</td>
                                            <td>2020-05-05 10:21:13</td>
                                            <td><i class="bi bi-trash text-danger" role="button"></i></td>
                                        </tr>
                                        <!-- Thêm các dòng khác ở đây tương tự -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <div class="text-muted">Show 1–10 items</div>
                                <nav>
                                    <ul class="pagination mb-0">
                                        <li class="btn-success page-item disabled"><a class="page-link" href="#">«</a></li>
                                        <li class="btn-success page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="btn-success page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item disabled"><span class="page-link">...</span></li>
                                        <li class="page-item"><a class="page-link" href="#">10</a></li>
                                        <li class="page-item"><a class="page-link" href="#">»</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
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
                                        <td>HP:0003456</td>
                                        <td><span class="status-unused">Unused</span></td>
                                        <td></td>
                                        <td></td>
                                        <td>2025-05-21 10:21:13</td>
                                        <td>
                                            <i class="action-icon bi bi-files"></i>
                                            <i class="action-icon delete bi bi-trash ms-2"></i>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>HP:0012461</td>
                                        <td><span class="status-used">Used</span></td>
                                        <td>Kathryn Murphy</td>
                                        <td>2025-05-21 10:21:13</td>
                                        <td>2025-05-21 10:21:13</td>
                                        <td>
                                            <i class="action-icon bi bi-files"></i>
                                            <i class="action-icon delete bi bi-trash ms-2"></i>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>HP:0012461</td>
                                        <td><span class="status-used">Used</span></td>
                                        <td>Kathryn Murphy</td>
                                        <td>2025-05-21 10:21:13</td>
                                        <td>2025-05-21 10:21:13</td>
                                        <td>
                                            <i class="action-icon bi bi-files"></i>
                                            <i class="action-icon delete bi bi-trash ms-2"></i>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>HP:0012461</td>
                                        <td><span class="status-used">Used</span></td>
                                        <td>Kathryn Murphy</td>
                                        <td>2025-05-21 10:21:13</td>
                                        <td>2025-05-21 10:21:13</td>
                                        <td>
                                            <i class="action-icon bi bi-files"></i>
                                            <i class="action-icon delete bi bi-trash ms-2"></i>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>HP:0012461</td>
                                        <td><span class="status-used">Used</span></td>
                                        <td>Kathryn Murphy</td>
                                        <td>2025-05-21 10:21:13</td>
                                        <td>2025-05-21 10:21:13</td>
                                        <td>
                                            <i class="action-icon bi bi-files"></i>
                                            <i class="action-icon delete bi bi-trash ms-2"></i>
                                        </td>
                                    </tr>
                                    <!-- thêm các hàng khác -->
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-end mt-3">
                                <ul class="pagination">
                                    <li class="page-item disabled"><a class="page-link">«</a></li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">»</a></li>
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
              <div class="fs-2 fw-bold">$2</div>
              <small class="text-muted">/month</small>
              <ul class="list-unstyled mt-3 text-start">
                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản phẩm dùng thử</li>
                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời hạn 1 tháng</li>
                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản phẩm dùng thử</li>
                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời hạn 1 tháng</li>
              </ul>
              <button class="btn btn-success w-100 rounded mt-3">Buy</button>
            </div>
          </div>
          <!-- Lặp lại 2 card tiếp theo tương tự -->
          <div class="col-md-4">
            <div class="border rounded-4 p-4 h-100 shadow-sm">
              <h6 class="text-success fw-bold">Business plan</h6>
              <small class="text-muted d-block mb-2">Our most popular plan.</small>
              <div class="fs-2 fw-bold">$10</div>
              <small class="text-muted">/6month</small>
              <ul class="list-unstyled mt-3 text-start">
                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản phẩm dùng thử</li>
                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời hạn 1 tháng</li>
                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản phẩm dùng thử</li>
                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời hạn 1 tháng</li>
              </ul>
              <button class="btn btn-success w-100 rounded mt-3">Buy</button>
            </div>
          </div>
          <div class="col-md-4">
            <div class="border rounded-4 p-4 h-100 shadow-sm">
              <h6 class="text-success fw-bold">Enterprise plan</h6>
              <small class="text-muted d-block mb-2">Our most popular plan.</small>
              <div class="fs-2 fw-bold">$20</div>
              <small class="text-muted">/year</small>
              <ul class="list-unstyled mt-3 text-start">
                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản phẩm dùng thử</li>
                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời hạn 1 năm</li>
                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sản phẩm dùng thử</li>
                <li><i class="bi bi-check-circle-fill text-success me-2"></i> Thời hạn 1 tháng</li>
              </ul>
              <button class="btn btn-success w-100 rounded mt-3">Buy</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

        @include('frontend_v2.components.footer')
    </div>
@endsection


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush
