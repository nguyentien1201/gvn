@extends('layout.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('panel.product') }}</h1>
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
                            <a href="{{ route('admin.product.create') }}"
                               class="btn btn-primary">
                                {{ __('panel.add') }}
                            </a>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-truncate table-striped projects">
                            <thead>
                            <tr>
                                <th width="5%" class="text-center">{{__('panel.no')}}</th>
                                <th width="15%">{{ __('product.name') }}</th>
                                <th width="15%">{{ __('product.monthly_price') }}</th>
                                <th width="10%">{{ __('product.six_month_price') }}</th>
                                <th width="15%">{{ __('product.yearly_price') }}</th>
                                <th width="20%">{{ __('product.system') }}</th>
                                <th width="20%">{{ __('product.description') }}</th>
                                <th width="10%" class="text-nowrap text-center">{{ __('panel.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($products as $idx => $product)
                                <tr>
                                    <td width="5%" class="text-center">{{$idx + 1}}</td>
                                    <td width="15%">{{$product->name}}</td>
                                    <td width="15%">{{$product->monthly_price}}</td>
                                    <td width="10%">{{$product->six_month_price}}</td>
                                    <td width="15%">{{$product->yearly_price}}</td>
                                    <td width="20%">{{$product->system}}</td>
                                    <td width="20%">{{$product->description}}</td>
                                    <td width="10%" class="text-center text-nowrap">
                                        <a href="{{ route('admin.product.edit', [$product->id]) }}"
                                           class="btn btn-primary btn-circle btn-sm">
                                            <i class="fas fa-edit" aria-hidden="true"></i>
                                        </a>
                                        <a href="#confirmDelete" data-toggle="modal"
                                           onclick="removeItem(this)"
                                           data-id="{{$product->id}}"
                                           data-action="{{ route('admin.product.destroy', [$product->id])}}"
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
