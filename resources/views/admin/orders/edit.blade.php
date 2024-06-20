@extends('layout.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('panel.order') }}</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- result -->
    <section class="content">
        <div class="container-fluid">
            <form method="POST" action="{{ route("admin.orders.update") }}"
                  enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <input type="hidden" name="id" value="{{$order->id}}">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">{{__('panel.info')}}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label>{{(__('order.order_id'))}}<span class="red"> *</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="order_id" value="{{old('order_id', $order->order_id)}}"
                                               class="form-control @if($errors->has('order_id')) is-invalid @endif"
                                               autocomplete="off" readonly/>
                                        @if($errors->has('order_id'))
                                            <p class="invalid-feedback">
                                                {{ $errors->first('order_id') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label>{{(__('order.website'))}}<span class="red"> *</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="website" value="{{$order->website}}" readonly>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label>{{(__('order.status'))}}<span class="red"> *</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <select
                                            class="form-control select2 @if($errors->has('status')) is-invalid @endif"
                                            name="status" autocomplete="off">
                                            <option value="">{{__('panel.please_choose')}}</option>
                                            @foreach($status as $idx => $sta)
                                                <option value="{{$idx}}"
                                                        @if(old('status', $order->status) !== '' && old('status', $order->status) == $idx) selected @endif>{{$sta}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('status'))
                                            <p class="invalid-feedback">
                                                {{ $errors->first('status') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label>{{(__('order.first_name'))}}<span class="red"> *</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="first_name"
                                               value="{{old('first_name', $order->first_name)}}"
                                               class="form-control @if($errors->has('first_name')) is-invalid @endif"
                                               autocomplete="off"/>
                                        @if($errors->has('first_name'))
                                            <p class="invalid-feedback">
                                                {{ $errors->first('first_name') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label>{{(__('order.last_name'))}}<span class="red"> *</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="last_name"
                                               value="{{old('last_name', $order->last_name)}}"
                                               class="form-control @if($errors->has('last_name')) is-invalid @endif"
                                               autocomplete="off"/>
                                        @if($errors->has('last_name'))
                                            <p class="invalid-feedback">
                                                {{ $errors->first('last_name') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label>{{(__('user.email'))}}<span class="red"> *</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="email" name="email" value="{{old('email',$order->email)}}"
                                               class="form-control @if($errors->has('email')) is-invalid @endif"/>
                                        @if($errors->has('email'))
                                            <p class="invalid-feedback">
                                                {{ $errors->first('email') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label>{{(__('order.phone'))}}<span class="red"> *</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" name="phone"
                                                   class="form-control @if($errors->has('phone')) is-invalid @endif"
                                                   value="{{old('phone', $order->phone)}}"
                                                   data-inputmask='"mask": "9999999999"' data-mask>
                                            @if($errors->has('email'))
                                                <p class="invalid-feedback">
                                                    {{ $errors->first('email') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label>{{(__('order.birthday'))}}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group date-month" id="birthday"
                                             data-target-input="nearest">
                                            <input type="text" data-target="#birthday" name="birthday"
                                                   value="{{old('birthday', isset($order->birthday) ? date('m/d', strtotime($order->birthday)) : '')}}"
                                                   autocomplete="off" data-inputmask-alias="datetime"
                                                   data-inputmask-inputformat="mm/dd" data-mask
                                                   class="form-control datetimepicker-input datetimepicker @if($errors->has('birthday')) is-invalid @endif">
                                            <div class="input-group-append" data-target="#birthday"
                                                 data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                            @if($errors->has('birthday'))
                                                <p class="invalid-feedback">
                                                    {{ $errors->first('birthday') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label>{{(__('order.company'))}}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="company"
                                               value="{{old('company', $order->company)}}"
                                               class="form-control @if($errors->has('company')) is-invalid @endif"
                                               autocomplete="off"/>
                                        @if($errors->has('company'))
                                            <p class="invalid-feedback">
                                                {{ $errors->first('company') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label>{{(__('order.address'))}}<span class="red"> *</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <textarea name="address"
                                                  class="form-control @if($errors->has('address')) is-invalid @endif">{{old('address', $order->address)}}</textarea>
                                        @if($errors->has('address'))
                                            <p class="invalid-feedback">
                                                {{ $errors->first('address') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label>{{(__('order.responsible'))}}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="responsible"
                                               value="{{old('responsible', $order->responsible)}}"
                                               class="form-control @if($errors->has('responsible')) is-invalid @endif"
                                               autocomplete="off"/>
                                        @if($errors->has('responsible'))
                                            <p class="invalid-feedback">
                                                {{ $errors->first('responsible') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label>{{(__('order.created_date'))}}<span class="red"> *</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group date" id="created_date"
                                             data-target-input="nearest">
                                            <input type="text" data-target="#created_date" name="created_date"
                                                   value="{{old('created_date', date('m/d/Y', strtotime($order->created_date)))}}"
                                                   autocomplete="off" data-inputmask-alias="datetime"
                                                   data-inputmask-inputformat="mm/dd/yyyy" data-mask
                                                   class="form-control datetimepicker-input datetimepicker @if($errors->has('created_date')) is-invalid @endif">
                                            <div class="input-group-append" data-target="#created_date"
                                                 data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                            @if($errors->has('created_date'))
                                                <p class="invalid-feedback">
                                                    {{ $errors->first('created_date') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label>{{(__('order.note'))}}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <textarea name="note"
                                                  class="form-control @if($errors->has('note')) is-invalid @endif">{{old('note', $order->note)}}</textarea>
                                        @if($errors->has('note'))
                                            <p class="invalid-feedback">
                                                {{ $errors->first('note') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{route('admin.orders.index', ['website' => request('website')])}}"
                                        class="btn btn-secondary">{{__('panel.back')}}</a>
                                <button type="submit"
                                        class="btn btn-success">{{__('panel.update')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link @if(!request('is_alert')) active @endif"
                               href="{{route('admin.orders.edit', ['id' => $order->id, 'website' => $order->website])}}">
                                {{__('panel.products')}}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link @if(request('is_alert')) active @endif"
                               href="{{route('admin.orders.edit', ['id' => $order->id, 'website' => $order->website, 'is_alert' => 1])}}">
                                {{__('panel.alerts')}}
                            </a>
                        </li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active">
                            @if(!request('is_alert'))
                                @include('partials.list-products')
                            @else
                                @include('partials.list-alerts')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
