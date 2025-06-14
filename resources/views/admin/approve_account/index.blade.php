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
                    <div class="table-responsive">
                        <table class="table table-bordered table-truncate table-striped projects">
                            <thead>
                            <tr>
                                <th width="5%" class="text-center">{{__('panel.no')}}</th>
                                <th width="15%">{{ __('customer.name') }}</th>
                                <th width="15%">{{ __('customer.email') }}</th>
                                <th width="10%">{{ __('customer.phone_number') }}</th>

                                <th width="10%" class="text-nowrap text-center">{{ __('panel.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($customers as $idx => $customer)
                                <tr>
                                    <td width="5%" class="text-center">{{$idx + 1}}</td>
                                    <td width="15%">{{$customer->name}}</td>
                                    <td width="15%">{{$customer->email}}</td>
                                    <td width="10%">{{$customer->phone}}</td>
                                    <td width="10%" class="text-center text-nowrap">

                                    <a href="#confirmApprove"
                                            onclick="approveUser(this)"
                                            data-id="{{$customer->id}}"
                                            data-action="{{ route('admin.users.update', [$customer->id])}}"
                                            data-text-confirm="Do you want approve user ?"
                                            data-data='{"is_active": 1}'
                                            class="btn btn-danger btn-circle btn-sm remove"
                                            class="btn btn-primary btn-circle btn-sm">
                                            <i class="fas fa-user-check" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{ route('admin.users.edit', [$customer->id]) }}"
                                           class="btn btn-primary btn-circle btn-sm">
                                            <i class="fas fa-edit" aria-hidden="true"></i>
                                        </a>
                                         <a href="{{ route('admin.customers.list', [$customer->id]) }}"
                                           class="btn btn-primary btn-circle btn-sm">
                                            <i class="fas fa-users" aria-hidden="true"></i>
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
                     @include('partials.dialog-confirm-approve')
                   
                </div>
            </div>
        </div>
    </section>
@endsection
