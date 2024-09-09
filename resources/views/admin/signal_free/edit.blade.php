@extends('layout.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('panel.stock_free') }}</h1>
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
                    <form class="add-edit-frm" action="{{route('admin.freesignal.update', [$signalsFree->id])}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$signalsFree->id}}"/>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>{{(__('signal.code'))}} <span class="red"> *</span></label>
                                <select name="code"  disabled
                                            class="form-control select2 @if($errors->has('code')) is-invalid @endif">
                                        <option value="">{{__('panel.please_choose')}}</option>
                                        @foreach($mstStocks as $mstStock)
                                            <option value="{{$mstStock->id}}"
                                            @if($signalsFree->code == $mstStock->id) selected @endif
                                                    @if(old('code') == $mstStock->id) selected @endif>{{$mstStock->code}}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="code" value="{{$signalsFree->code}}">
                                @if($errors->has('code'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('code') }}
                                    </p>
                                @endif
                            </div>

                            <div class="col-md-4 form-group">
                                <label>{{(__('signal.trend_price'))}} <span class="red"> *</span></label>
                                <select
                                    class="form-control select2 @if($errors->has('trend_price')) is-invalid @endif"
                                    name="trend_price" autocomplete="off" value="{{$signalsFree->trend_price}}">
                                        <option value="">{{__('panel.please_choose')}}</option>
                                            <option value="1"
                                            @if($signalsFree->trend_price == 1) selected @endif
                                            @if(old('trend_price') != '' && old('trend_price') == 1) selected @endif>UpTrend</option>
                                            <option value="2"
                                            @if($signalsFree->trend_price == 2) selected @endif
                                            @if(old('trend_price') != '' && old('trend_price') == 2) selected @endif>DownTrend</option>
                                            <option value="3"
                                            @if($signalsFree->trend_price == 3) selected @endif
                                            @if(old('trend_price') != '' && old('trend_price') == 3) selected @endif>SideWay</option>

                                    </select>
                                @if($errors->has('trend_price'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('trend_price') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>{{(__('signal.last_sale'))}} <span class="red"> *</span></label>
                                <input  step="0.01" type="number" name="last_sale" autocomplete="off"
                                        class="form-control @if($errors->has('last_sale')) is-invalid @endif"
                                        value="{{ $signalsFree->last_sale}}">
                                @if($errors->has('last_sale'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('last_sale') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-4 form-group">
                                <label>{{(__('signal.time'))}} <span class="red"> *</span></label>
                                <div class="input-group date-time" id="date_action"
                                     data-target-input="nearest">
                                    <input type="text" data-target="#date_action" name="date_action"
                                           value="{{$signalsFree->date_action ? date('m-d-Y H:i', strtotime($signalsFree->date_action)) : ''}}" autocomplete="off"
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
                        <a href="{{route('admin.freesignal.index')}}" class="btn btn-secondary">
                            {{__('panel.back')}}
                        </a>
                        <button type="submit" class="btn btn-primary">{{__('panel.save')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script type="text/javascript">

$(document).ready(function () {
    $("input[name='price_action'],input[name='price_stoploss']").change(function () {
        var price_stoploss = $("input[name='price_stoploss']").val();
        var price_action = $("input[name='price_action']").val();
        var profit =price_stoploss- price_action;
        $("input[name='profit']").val(profit);
    });
});
 </script>
