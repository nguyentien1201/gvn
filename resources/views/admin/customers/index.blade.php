@extends('layout.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('panel.customer') }}</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- result -->
    <section class="content">
        <div class="container-fluid">
            <form class="search-frm search-frm-customer" method="GET" action="{{ route("admin.customers.index") }}"
                  enctype="multipart/form-data">
                <div class="card card-primary collapsed-card">
                    <div class="card-header">`
                        <h3 class="card-title">{{__('panel.search')}}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col-md-6">
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label>{{(__('customer.first_name'))}}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="first_name" value="{{request('first_name')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label>{{(__('customer.last_name'))}}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="last_name" value="{{request('last_name')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label>{{(__('customer.phone_number'))}}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select class="form-control select2" name="phone_number" autocomplete="off">
                                            <option value="">{{__('panel.please_choose')}}</option>
                                            @foreach($searchCustomers as $key => $searchCustomer)
                                                <option value="{{$searchCustomer->phone_number}}"
                                                        @if(request('phone_number') != '' && request('phone_number') == $searchCustomer->phone_number) selected @endif>{{$searchCustomer->phone_number}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label>{{(__('customer.email'))}}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select class="form-control select2" name="email" autocomplete="off">
                                            <option value="">{{__('panel.please_choose')}}</option>
                                            @foreach($searchCustomers as $key => $searchCustomer)
                                                @if($searchCustomer->email)
                                                <option value="{{$searchCustomer->email}}"
                                                        @if(request('email') != '' && request('email') == $searchCustomer->email) selected @endif>{{$searchCustomer->email}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary">{{__('panel.search')}}</button>
                        <button type="button" class="btn btn-warning btn-reset-search">{{ __('panel.reset') }}</button>
                    </div>
                </div>
            </form>
            <div class="card">
                <div class="card-header">{{__('panel.list')}}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <a href="{{ route('admin.customers.create') }}"
                               class="btn btn-primary">
                                {{ __('panel.add') }}
                            </a>
                        </div>
                        <div class="col-md-12 form-group">
                        <form class="d-flex justify-content-center" action="{{route('admin.customers.import')}}" method="post"
                              enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" accept=".xlsx, .xls, .csv" name="select_file" class="custom-file-input" id="inputGroupFile04" required>
                                    <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <button class="d-flex btn btn-primary" type="submit">
                                       <span><i class="fa fa-upload mr-1"></i>{{__('panel.import')}}</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-truncate table-striped projects">
                            <thead>
                            <tr>
                                <th width="5%" class="text-center">{{__('panel.no')}}</th>
                                <th width="15%">{{ __('customer.first_name') }}</th>
                                <th width="15%">{{ __('customer.last_name') }}</th>
                                <th width="10%">{{ __('customer.phone_number') }}</th>
                                <th width="15%">{{ __('customer.email') }}</th>
                                <th width="20%">{{ __('customer.address') }}</th>
                                <th width="20%">{{ __('customer.note') }}</th>
                                <th width="10%" class="text-nowrap text-center">{{ __('panel.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($customers as $idx => $customer)
                                <tr>
                                    <td width="5%" class="text-center">{{$idx + 1}}</td>
                                    <td width="15%">{{$customer->first_name}}</td>
                                    <td width="15%">{{$customer->last_name}}</td>
                                    <td width="10%">{{$customer->phone_number}}</td>
                                    <td width="15%">{{$customer->email}}</td>
                                    <td width="20%">{{$customer->address}}</td>
                                    <td width="20%">{{$customer->note}}</td>
                                    <td width="10%" class="text-center text-nowrap">
                                        <a href="{{ route('admin.customers.edit', [$customer->id]) }}"
                                           class="btn btn-primary btn-circle btn-sm">
                                            <i class="fas fa-edit" aria-hidden="true"></i>
                                        </a>
                                        <a href="#confirmDelete" data-toggle="modal"
                                           onclick="removeItem(this)"
                                           data-id="{{$customer->id}}"
                                           data-action="{{ route('admin.customers.destroy', [$customer->id])}}"
                                           class="btn btn-danger btn-circle btn-sm remove">
                                            <i class="fas fa-trash" aria-hidden="true"></i>
                                        </a>
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
                    @include('partials.dialog-confirm-delete')
                </div>
            </div>
        </div>
    </section>
@endsection
