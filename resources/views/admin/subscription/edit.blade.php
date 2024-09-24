@extends('layout.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('panel.subscription') }}</h1>
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
                    <form class="add-edit-frm" action="{{route('admin.subscription.update', [$subscription->id])}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$subscription->id}}"/>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>{{(__('subscription.name'))}} <span class="red"> *</span></label>
                                <input type="text" name="name" autocomplete="off"
                                       class="form-control @if($errors->has('name')) is-invalid @endif"
                                       value="{{old('name' , $subscription->name )}}">
                                @if($errors->has('name'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-2 form-group">
                                <label>{{(__('subscription.monthly_price'))}} <span class="red"> *</span></label>
                                <input step="0.01" type="number" name="monthly_price" autocomplete="off"
                                       class="form-control @if($errors->has('monthly_price')) is-invalid @endif"
                                       value="{{old('monthly_price',$subscription->monthly_price)}}">
                                @if($errors->has('monthly_price'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('monthly_price') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-2 form-group">
                                <label>{{(__('subscription.six_month_price'))}} <span class="red"> *</span></label>
                                <input step="0.01" type="number" name="six_month_price" autocomplete="off"
                                       class="form-control @if($errors->has('six_month_price')) is-invalid @endif"
                                       value="{{old('six_month_price',$subscription->six_month_price)}}">
                                @if($errors->has('six_month_price'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('six_month_price') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-2 form-group">
                                <label>{{(__('subscription.yearly_price'))}}</label>
                                <input step="0.01" type="number" name="yearly_price" autocomplete="off"
                                       class="form-control @if($errors->has('yearly_price')) is-invalid @endif"
                                       value="{{old('yearly_price',$subscription->yearly_price)}}">
                                @if($errors->has('yearly_price'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('yearly_price') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-2 form-group">
                                <label>{{(__('subscription.system'))}}</label>
                                <select  value="{{$subscription->system}}"  class="form-control custom-select @if($errors->has('code')) is-invalid @endif" name="system" autocomplete="off">
                                    <option value="">{{__('panel.please_choose')}}</option>
                                    <option value="alpha">Green AlPha</option>
                                    <option value="beta">Green Beta</option>
                                    <option value="greenstock">Green Stock</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>{{(__('subscription.description'))}}</label>
                                <textarea  class="form-control" name="description" placeholder="Thông Tin sản phẩm" rows="5" >{{isset($subscription->description) ? $subscription->description : ''}}</textarea>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-md-6 form-group">
                                <label>{{(__('subscription.first_name'))}} <span class="red"> *</span></label>
                                <input type="text" name="first_name" autocomplete="off"
                                       class="form-control @if($errors->has('first_name')) is-invalid @endif"
                                       value="{{old('first_name', $subscription->first_name)}}">
                                @if($errors->has('first_name'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('first_name') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{(__('subscription.last_name'))}} <span class="red"> *</span></label>
                                <input type="text" name="last_name" autocomplete="off"
                                       class="form-control @if($errors->has('last_name')) is-invalid @endif"
                                       value="{{old('last_name', $subscription->last_name)}}">
                                @if($errors->has('last_name'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('last_name') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{(__('subscription.phone_number'))}} <span class="red"> *</span></label>
                                <input type="text" name="phone_number" autocomplete="off"
                                       class="form-control @if($errors->has('phone_number')) is-invalid @endif"
                                       value="{{old('phone_number', $subscription->phone_number)}}">
                                @if($errors->has('phone_number'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('phone_number') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{(__('subscription.email'))}}</label>
                                <input type="text" name="email" autocomplete="off"
                                       class="form-control @if($errors->has('email')) is-invalid @endif"
                                       value="{{old('email', $subscription->email)}}">
                                @if($errors->has('email'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{(__('subscription.address'))}}</label>
                                <textarea class="form-control textarea"
                                          cols="30" rows="6"
                                          name="address">{{isset($subscription->address) ? $subscription->address : ''}}</textarea>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{(__('subscription.note'))}}</label>
                                <textarea class="form-control textarea"
                                          cols="30" rows="6"
                                          name="note">{{isset($subscription->note) ? $subscription->note : ''}}</textarea>
                            </div>
                        </div> -->
                        <a href="{{route('admin.subscription.index')}}" class="btn btn-secondary">
                            {{__('panel.back')}}
                        </a>
                        <button type="submit" class="btn btn-primary">{{__('panel.save')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
