<style>
  /* Ẩn checkbox mặc định */
  input[type="checkbox"] {
            display: none;
        }

        /* Tạo giao diện toggle switch */
        .toggle-switch {
            position: relative;
            width: 60px;
            height: 30px;
            background-color: #ccc;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        /* Tạo vòng tròn di chuyển bên trong toggle switch */
        .toggle-switch:before {
            content: "";
            position: absolute;
            top: 2px;
            left: 2px;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background-color: white;
            transition: transform 0.3s ease;
        }

        /* Hiệu ứng khi toggle được bật */
        input[type="checkbox"]:checked + .toggle-switch {
            background-color: #4CAF50;
        }

        input[type="checkbox"]:checked + .toggle-switch:before {
            transform: translateX(30px);
        }

        /* Hiệu ứng khi hover */
        .toggle-switch:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
</style>
@extends('layout.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>VNINDEX</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- result -->
    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header">{{__('panel.list')}}</div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12 form-group">
                        <form class="d-flex justify-content-center" action="{{route('admin.vnindex.import')}}" method="post"
                              enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="input-group">
                                <input type="checkbox" id="toggle" name="isCompany">
                                <label for="toggle" class="toggle-switch"></label>
                            </div>
                            <div class="input-group">
                                <span class="input-group-append">
                                <button type="submit" class="btn btn-primary">Sync Data</button>
                                </span>
                            </div>
                        </form>
                        </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-truncate table-striped projects">
                            <thead>
                            <tr>
                                <th  class="text-center">Rating</th>
                                <th >Chứng khoán</th>
                                <th>Rating Point</th>
                                <th >Xu hướng</th>
                                <th >Hành động</th>
                                <th >Profit</th>
                                <th >Giảm sau bán</th>
                                <th >Giá</th>
                                <th>Thời gian</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($signals as $idx => $signal)
                                <tr>
                                    <td width="5%" class="text-center">{{$signal->rating}}</td>
                                    <td width="10%">{{$signal->code}}</td>
                                    <td width="10%">{{ $signal->point }}</td>
                                    <td width="15%">{{$signal->trending}}</td>
                                    <td width="10%">{{$signal->signal}}</td>
                                    <td width="10%"style="background-color:@if($signal->profit >0) green @endif
                                        @if($signal->profit < 0) red @endif
                                         @if($signal->profit == 0) yellow @endif
                                    ">{{ $signal->profit}}</td>
                                     <td width="10%">{{ $signal->post_sale_discount ?? ''}}</td>
                                     <td width="10%">{{ $signal->price ?? ''}}</td>
                                      <td width="15%">{{ $signal->time ? date('m-d-Y', strtotime($signal->time)) : ''}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">
                                        {{ __('panel.nodata') }}
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if(!empty($signals))
                        <div class="paginations mt-3">
                            {!! $signals->appends($_GET)->links() !!}
                        </div>
                    @endif
                    @include('partials.dialog-confirm-delete')
                </div>
            </div>
        </div>
    </section>
@endsection
