@extends('layout.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('panel.promotion') }}</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- result -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">{{__('panel.add')}}</div>
                <div class="card-body">
                    <form class="add-edit-frm" action="{{route('admin.promotions.store')}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>{{(__('promotion.title'))}} <span class="red"> *</span></label>
                                <input type="text" name="title"
                                       value="{{old('title')}}" autocomplete="off"
                                       placeholder="{{__('promotion.title_place')}}"
                                       class="form-control @if($errors->has('title')) is-invalid @endif">
                                @if($errors->has('title'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('title') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{(__('promotion.recipients'))}} <span class="red"> *</span></label>
                                <select
                                    id="customer_ids"
                                    class="form-control select2 select2-placeholder-multiple @if($errors->has('customer_ids')) is-invalid @endif"
                                    multiple="multiple" name="customer_ids[]" autocomplete="off">
                                    @foreach($customers as $customer)
                                        @if($customer->phone_number)
                                            <option value="{{$customer->id}}">
                                                {{$customer->first_name . ' ' . $customer->last_name . ' ('. $customer->phone_number . ')'}}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="cb-all-customer">
                                    <label class="custom-control-label font-weight-normal" for="cb-all-customer">{{__('promotion.all')}}</label>
                                </div>
                                @if($errors->has('customer_ids'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('customer_ids') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{(__('promotion.execution_time'))}} <span class="red"> *</span></label>
                                <div class="input-group date-time" id="execution_time"
                                     data-target-input="nearest">
                                    <input type="text" data-target="#execution_time" name="execution_time"
                                           value="{{old('execution_time')}}" autocomplete="off"
                                           placeholder="{{__('promotion.execution_place')}}"
                                           class="form-control datetimepicker-input datetimepicker @if($errors->has('execution_time')) is-invalid @endif">
                                    <div class="input-group-append" data-target="#execution_time"
                                         data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    @if($errors->has('execution_time'))
                                        <p class="invalid-feedback">
                                            {{ $errors->first('execution_time') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 form-group">
                                <label>{{(__('promotion.message'))}}<span class="red"> *</span></label>
                                <textarea id="message" rows="4" name="message" autocomplete="off"
                                          class="form-control @if($errors->has('message')) is-invalid @endif"
                                          placeholder="{{__('promotion.message_place')}}">{{old('message')}}</textarea>
                                @if($errors->has('message'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('message') }}
                                    </p>
                                @endif
                                <div class="order-tags mt-2">
                                    @foreach($orderTags as $tagKey => $orderTag)
                                        <span class="btn btn-sm btn-primary"
                                              data-tag="{{$tagKey}}" onclick="addTag(this)">{{$orderTag}}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <a href="{{route('admin.promotions.index')}}" class="btn btn-secondary">
                            {{__('panel.back')}}
                        </a>
                        <button type="submit" class="btn btn-primary">{{__('panel.save')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
