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
                <div class="card-header">{{__('panel.add')}}</div>
                <div class="card-body">
                    <form class="add-edit-frm" action="{{route('admin.green-beta.store')}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label>{{(__('signal.code'))}} <span class="red"> *</span></label>
                                <select name="code"
                                            class="form-control select2 @if($errors->has('code')) is-invalid @endif">
                                        <option value="">{{__('panel.please_choose')}}</option>
                                        @foreach($mstStocks as $mstStock)
                                            <option value="{{$mstStock->id}}"
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
                                <label>{{(__('signal.signal_open'))}} <span class="red"> *</span></label>
                                <select
                                    class="form-control select2 @if($errors->has('signal_open')) is-invalid @endif"
                                    name="signal_open" autocomplete="off">
                                        <option value="">{{__('panel.please_choose')}}</option>
                                            <option value="BUY"
                                            @if(old('signal_open') != '' && old('signal_open') == 'BUY') selected @endif>Buy</option>
                                            <option value="SELL"
                                            @if(old('signal_open') != '' && old('signal_open') == 'SELL') selected @endif>Sell</option>
                                            <option value="SIDEWAY"
                                            @if(old('signal_open') != '' && old('signal_open') == 'SIDEWAY') selected @endif>SideWay</option>

                                    </select>
                                @if($errors->has('signal_open'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('signal_open') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-3 form-group">
                                <label>{{(__('signal.price_open'))}} <span class="red"> *</span></label>
                                <input  step="0.01" type="number" name="price_open" autocomplete="off"
                                        class="form-control @if($errors->has('price_open')) is-invalid @endif"
                                        value="{{old('price_open')}}">
                                @if($errors->has('price_open'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('price_open') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-3 form-group">
                                <label>{{(__('signal.open_time'))}} <span class="red"> *</span></label>
                                <div class="input-group date-time" id="date_action"
                                     data-target-input="nearest">
                                    <input type="text" data-target="#date_action" name="date_action"
                                           value="{{old('date_action')}}" autocomplete="off"
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
                        <div class="col-md-3 form-group">
                                <label>{{(__('signal.signal_close'))}} <span class="red"> *</span></label>
                                <select
                                    class="form-control select2 @if($errors->has('signal_close')) is-invalid @endif"
                                    name="signal_close" autocomplete="off">
                                        <option value="">{{__('panel.please_choose')}}</option>
                                            <option value="TakeProfitBUY"
                                            @if(old('signal_close') != '' && old('signal_close') == 'TakeProfitBUY') selected @endif>TakeProfitBUY</option>
                                            <option value="CutLossBUY"
                                            @if(old('signal_close') != '' && old('signal_close') == 'CutLossBUY') selected @endif>CutLossBUY</option>
                                            <option value="Hold"
                                            @if(old('signal_close') != '' && old('signal_close') == 'Hold') selected @endif>Hold</option>
                                    </select>
                                @if($errors->has('trend'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('trend') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-3 form-group">
                                <label>{{(__('signal.price_cumulative_from'))}}</label>
                                <input step="0.01" type="number" name="price_cumulative_from" autocomplete="off"
                                        class="form-control @if($errors->has('price_cumulative_from')) is-invalid @endif"
                                        value="{{old('price_cumulative_from')}}">
                                @if($errors->has('price_cumulative_from'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('price_cumulative_from') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-3 form-group">
                                <label>{{(__('signal.price_cumulative_to'))}}</label>
                                <input  step="0.01" type="number" name="price_cumulative_to" autocomplete="off"
                                        class="form-control @if($errors->has('price_cumulative_to')) is-invalid @endif"
                                        value="{{old('price_cumulative_to')}}">
                                @if($errors->has('price_cumulative_to'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('price_cumulative_to') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-3 form-group">
                                <label>{{(__('signal.price_close'))}} <span class="red"> *</span></label>
                                <input  step="0.01" type="number" name="price_close" autocomplete="off"
                                        class="form-control @if($errors->has('price_close')) is-invalid @endif"
                                        value="{{old('price_close')}}">
                                @if($errors->has('price_close'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('price_close') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label>{{(__('signal.profit'))}}</label>
                                <input step="0.01" readonly="true" type="number" name="profit" autocomplete="off"
                                        class="form-control"
                                        value="{{old('profit')}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>{{(__('signal.close_time'))}} <span class="red"> *</span></label>
                                <div class="input-group date-time" id="close_time"
                                     data-target-input="nearest">
                                    <input type="text" data-target="#close_time" name="close_time"
                                           value="{{old('close_time')}}" autocomplete="off"
                                           placeholder="{{__('signal.close_time')}}"
                                           class="form-control datetimepicker-input datetimepicker @if($errors->has('close_time')) is-invalid @endif">
                                    <div class="input-group-append" data-target="#close_time"
                                         data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    @if($errors->has('close_time'))
                                        <p class="invalid-feedback">
                                            {{ $errors->first('close_time') }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <a href="{{route('admin.green-beta.index')}}" class="btn btn-secondary">
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
    $("input[name='price_close'],input[name='price_open']").change(function () {
        var price_close = $(this).val();
        var price_open = $("input[name='price_open']").val();
        var profit =price_close- price_open;
        $("input[name='profit']").val(profit);
    });
});
 </script>
