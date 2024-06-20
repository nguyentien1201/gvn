@extends('layout.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('panel.signal') }}</h1>
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
                    <form class="add-edit-frm" action="{{route('admin.signal.update', [$signal->id])}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$signal->id}}"/>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label>{{(__('signal.code'))}} <span class="red"> *</span></label>
                                <select name="code"
                                            class="form-control custom-select @if($errors->has('code')) is-invalid @endif">
                                        <option value="">{{__('panel.please_choose')}}</option>
                                        @foreach($mstStocks as $mstStock)
                                            <option value="{{$mstStock->id}}"
                                            @if($signal->code == $mstStock->id) selected @endif
                                                    @if(old('code') == $mstStock->id) selected @endif>{{$mstStock->code}}</option>
                                        @endforeach
                                    </select>
                                @if($errors->has('code'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('code') }}
                                    </p>
                                @endif
                            </div>

                            <div class="col-md-3 form-group">
                                <label>{{(__('signal.trend'))}} <span class="red"> *</span></label>
                                <select
                                    class="form-control select2 @if($errors->has('trend')) is-invalid @endif"
                                    name="trend" autocomplete="off">
                                        <option value="">{{__('panel.please_choose')}}</option>
                                            <option value="1"
                                            @if($signal->trend == 1) selected @endif
                                            @if(old('trend') != '' && old('trend') == 1) selected @endif>UpTrend</option>
                                            <option value="2"
                                            @if($signal->trend == 2) selected @endif
                                            @if(old('trend') != '' && old('trend') == 2) selected @endif>DownTrend</option>

                                    </select>
                                @if($errors->has('trend'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('trend') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-3 form-group">
                                <label>{{(__('signal.signal'))}} <span class="red"> *</span></label>
                                <select
                                    class="form-control select2 @if($errors->has('signal')) is-invalid @endif"
                                    name="signal" autocomplete="off">
                                        <option value="">{{__('panel.please_choose')}}</option>
                                            <option value="1"
                                            @if($signal->signal == 1) selected @endif
                                            @if(old('signal') != '' && old('signal') == 1) selected @endif>Buy</option>
                                            <option value="2"
                                            @if($signal->signal == 2) selected @endif
                                            @if(old('signal') != '' && old('signal') == 2) selected @endif>Sale</option>

                                    </select>
                                @if($errors->has('signal'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('signal') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>{{(__('signal.price_current'))}} <span class="red"> *</span></label>
                                <input type="number" name="price_current" autocomplete="off"
                                        class="form-control @if($errors->has('price_current')) is-invalid @endif"
                                        value="{{  $signal->price_current}}">
                                @if($errors->has('price_current'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('price_current') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{(__('signal.price_action'))}} <span class="red"> *</span></label>
                                <input type="number" name="price_action" autocomplete="off"
                                        class="form-control @if($errors->has('price_action')) is-invalid @endif"
                                        value="{{$signal->price_action}}">
                                @if($errors->has('price_action'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('price_action') }}
                                    </p>
                                @endif
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>{{(__('signal.price_cumulative_from'))}} <span class="red"> *</span></label>
                                <input type="number" name="price_cumulative_from" autocomplete="off"
                                        class="form-control @if($errors->has('price_cumulative_from')) is-invalid @endif"
                                        value="{{$signal->price_cumulative_from}}">
                                @if($errors->has('price_cumulative_from'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('price_cumulative_from') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{(__('signal.price_cumulative_to'))}} <span class="red"> *</span></label>
                                <input type="number" name="price_cumulative_to" autocomplete="off"
                                        class="form-control @if($errors->has('price_cumulative_to')) is-invalid @endif"
                                        value="{{$signal->price_cumulative_to}}">
                                @if($errors->has('price_cumulative_to'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('price_cumulative_to') }}
                                    </p>
                                @endif
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label>{{(__('signal.price_stoploss'))}} <span class="red"> *</span></label>
                                <input type="number" name="price_stoploss" autocomplete="off"
                                        class="form-control @if($errors->has('price_stoploss')) is-invalid @endif"
                                        value="{{$signal->price_stoploss}}">
                                @if($errors->has('price_stoploss'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('price_stoploss') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-3 form-group">
                                <label>{{(__('signal.price_target'))}} <span class="red"> *</span></label>
                                <input type="number" name="price_target" autocomplete="off"
                                        class="form-control @if($errors->has('price_target')) is-invalid @endif"
                                        value="{{$signal->price_target}}">
                                @if($errors->has('price_target'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('price_target') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-3 form-group">
                                <label>{{(__('signal.time'))}} <span class="red"> *</span></label>
                                <div class="input-group date-time" id="date_action"
                                     data-target-input="nearest">
                                    <input type="text" data-target="#date_action" name="date_action"
                                           value="{{$signal->date_action}}" autocomplete="off"
                                           placeholder="{{__('signal.time_place')}}"
                                           class="form-control datetimepicker-input datetimepicker @if($errors->has('date_action')) is-invalid @endif">
                                    <div class="input-group-append" data-target="#date_action"
                                         data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    @if($errors->has('date_action'))
                                        <p class="invalid-feedback">
                                            {{ $errors->first('date_action') }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="row">
                        <div class="col-md-6 form-group">
                                <label>{{(__('signal.description'))}}</label>
                                <textarea class="form-control textarea"
                                          cols="30" rows="3"
                                          name="description"></textarea>
                            </div>
                        </div>
                        <a href="{{route('admin.signal.index')}}" class="btn btn-secondary">
                            {{__('panel.back')}}
                        </a>
                        <button type="submit" class="btn btn-primary">{{__('panel.save')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
