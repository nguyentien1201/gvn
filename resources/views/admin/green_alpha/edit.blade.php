@extends('layout.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('panel.alpha') }}</h1>
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
                    <form class="add-edit-frm" action="{{route('admin.green-alpha.update', [$signal->id])}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$signal->id}}"/>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label>{{(__('signal.code'))}} <span class="red"> *</span></label>
                                <select name="code" value="{{$signal->code}}" disabled="true" aria-disabled="true"
                                            class="form-control custom-select @if($errors->has('code')) is-invalid @endif">
                                        <option value="">{{__('panel.please_choose')}}</option>
                                        @foreach($mstStocks as $mstStock)
                                            <option value="{{$mstStock->id}}"
                                            @if($signal->code == $mstStock->id) selected @endif
                                                    @if(old('code') == $mstStock->id) selected @endif>{{$mstStock->code}}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="code" value="{{$signal->code}}">
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
                                            @if($signal->signal_open == 'BUY') selected @endif
                                            @if(old('signal_open') != '' && old('signal_open') == 'BUY') selected @endif>Buy</option>
                                            <option value="SELL"
                                            @if($signal->signal_open == "SELL") selected @endif
                                            @if(old('signal_open') != '' && old('signal_open') == 'SELL') selected @endif>Sell</option>
                                            <option value="SIDEWAY"
                                            @if($signal->signal_open == "SIDEWAY") selected @endif
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
                                        value="{{$signal->price_open}}">
                                @if($errors->has('price_open'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('price_open') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-3 form-group">
                                <label>{{(__('signal.open_time'))}} <span class="red"> *</span></label>
                                <div class="input-group date-time" id="open_time"
                                     data-target-input="nearest">
                                    <input type="text" data-target="#open_time" name="open_time"
                                           value="{{old('open_time', $signal->open_time ? date('m-d-Y H:i', strtotime($signal->open_time)) : '')}}" autocomplete="off"
                                           placeholder="{{__('signal.open_time')}}"
                                           class="form-control datetimepicker-input datetimepicker @if($errors->has('open_time')) is-invalid @endif">
                                    <div class="input-group-append" data-target="#open_time"
                                         data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    @if($errors->has('open_time'))
                                        <p class="invalid-feedback">
                                            {{ $errors->first('open_time') }}
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
                                            @if($signal->signal_close == 'TakeProfitBUY') selected @endif>TakeProfitBUY</option>
                                            <option value="CutLossBUY"
                                            @if($signal->signal_close == 'CutLossBUY') selected @endif >CutLossBUY</option>
                                            <option value="TakeProfitSELL"
                                            @if($signal->signal_close == 'TakeProfitSELL') selected @endif >TakeProfitSELL</option>
                                            <option value="CutLossSELL"
                                            @if($signal->signal_close == 'CutLossSELL') selected @endif >CutLossSELL</option>
                                    </select>
                            </div>

                            <div class="col-md-3 form-group">
                                <label>{{(__('signal.price_close'))}} <span class="red"> *</span></label>
                                <input  step="0.01" type="number" name="price_close" autocomplete="off"
                                        class="form-control @if($errors->has('price_close')) is-invalid @endif"
                                        value="{{$signal->price_close}}">
                                @if($errors->has('price_close'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('price_close') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-3 form-group">
                                <label>{{(__('signal.close_time'))}} <span class="red"> *</span></label>
                                <div class="input-group date-time" id="close_time"
                                     data-target-input="nearest">
                                    <input type="text" data-target="#close_time" name="close_time"
                                           value="{{old('date_action', $signal->close_time ? date('m-d-Y H:i', strtotime($signal->close_time)) : '')}}" autocomplete="off"
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

                            <div class="col-md-3 form-group">
                                <label>{{(__('signal.profit'))}}</label>
                                <input step="0.01" readonly="true" type="number" name="profit" autocomplete="off"
                                        class="form-control"
                                        value="{{$signal->profit}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                    <label>Win Ratio</label>
                                    <div class="input-group date-time" id="close_time"
                                        data-target-input="nearest">
                                        <input type="number"  name="win_ratio"
                                            value="{{ $signal->win_ratio ?? '' }}" autocomplete="off"
                                            placeholder="Win Ratio"
                                            step="1"  type="number"
                                            class="form-control  @if($errors->has('win_ratio')) is-invalid @endif">
                                        @if($errors->has('win_ratio'))
                                            <p class="invalid-feedback">
                                                {{ $errors->first('win_ratio') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3 form-group">
                                <label>Total Trade</label>
                                <div class="input-group date-time" id="close_time"
                                     data-target-input="nearest">
                                    <input type="number"  name="total_trade"
                                           value="{{ $signal->total_trade ?? '' }}" autocomplete="off"
                                           placeholder="Total Trade"
                                           step="1"  type="number"
                                           class="form-control  @if($errors->has('total_trade')) is-invalid @endif">
                                    @if($errors->has('total_trade'))
                                        <p class="invalid-feedback">
                                            {{ $errors->first('total_trade') }}
                                        </p>
                                    @endif
                                </div>
                            </div>


                        </div>

                        <a href="{{route('admin.green-alpha.index')}}" class="btn btn-secondary">
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
