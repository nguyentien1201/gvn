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
                                <th width="15%">{{ __('customer.name') }}</th>
                                <th width="15%">{{ __('customer.email') }}</th>
                                <th width="10%">{{ __('customer.phone_number') }}</th>
<th width="10%">{{ __('customer.address') }}</th>
                                <th width="10%" class="text-nowrap text-center">{{ __('panel.action') }}</th>
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
                                        <a href="{{ route('admin.users.edit', [$customer->profile->user_id ?? '']) }}"
                                           class="btn btn-primary btn-circle btn-sm">
                                            <i class="fas fa-edit" aria-hidden="true"></i>
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
