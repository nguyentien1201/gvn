@extends('layout.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('panel.customers') }}</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- result -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">{{__('panel.edit')}}</div>
                <div class="card-body">
                    <form class="add-edit-frm" action="{{route('admin.customers.update', [$customer->id])}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$customer->id}}"/>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>{{(__('customer.first_name'))}} <span class="red"> *</span></label>
                                <input type="text" name="first_name" autocomplete="off"
                                       class="form-control @if($errors->has('first_name')) is-invalid @endif"
                                       value="{{old('first_name', $customer->first_name)}}">
                                @if($errors->has('first_name'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('first_name') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{(__('customer.last_name'))}} <span class="red"> *</span></label>
                                <input type="text" name="last_name" autocomplete="off"
                                       class="form-control @if($errors->has('last_name')) is-invalid @endif"
                                       value="{{old('last_name', $customer->last_name)}}">
                                @if($errors->has('last_name'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('last_name') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{(__('customer.phone_number'))}} <span class="red"> *</span></label>
                                <input type="text" name="phone_number" autocomplete="off"
                                       class="form-control @if($errors->has('phone_number')) is-invalid @endif"
                                       value="{{old('phone_number', $customer->phone_number)}}">
                                @if($errors->has('phone_number'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('phone_number') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{(__('customer.email'))}}</label>
                                <input type="text" name="email" autocomplete="off"
                                       class="form-control @if($errors->has('email')) is-invalid @endif"
                                       value="{{old('email', $customer->email)}}">
                                @if($errors->has('email'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{(__('customer.address'))}}</label>
                                <textarea class="form-control textarea"
                                          cols="30" rows="6"
                                          name="address">{{isset($customer->address) ? $customer->address : ''}}</textarea>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{(__('customer.note'))}}</label>
                                <textarea class="form-control textarea"
                                          cols="30" rows="6"
                                          name="note">{{isset($customer->note) ? $customer->note : ''}}</textarea>
                            </div>
                        </div>
                        <a href="{{route('admin.customers.index')}}" class="btn btn-secondary">
                            {{__('panel.back')}}
                        </a>
                        <button type="submit" class="btn btn-primary">{{__('panel.save')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
