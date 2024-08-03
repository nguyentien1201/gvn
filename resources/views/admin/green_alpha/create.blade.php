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
                <div class="card-header">{{__('panel.add')}}</div>
                <div class="card-body">
                    <form class="add-edit-frm" action="{{route('admin.green-alpha.store')}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label>{{(__('signal.code'))}} <span class="red"> *</span></label>
                                <select name="code"
                                            class="form-control select2 @if($errors->has('code')) is-invalid @endif">
                                        <option value="">{{__('panel.please_choose')}}</option>
                                        @foreach($mstStocks as $mstStock)
                                            <option value="{{$mstStock['id']}}"
                                                    @if(old('code') == $mstStock['id']) selected @endif>{{$mstStock['code']}}</option>
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
                                    <input type="text" data-target="#date_action" name="open_time"
                                           value="{{old('open_time')}}" autocomplete="off"
                                           placeholder="{{__('signal.time_place')}}"
                                           class="form-control datetimepicker-input datetimepicker @if($errors->has('date_action')) is-invalid @endif">
                                    <div class="input-group-append" data-target="#date_action"
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
                                            @if(old('signal_close') != '' && old('signal_close') == 'TakeProfitBUY') selected @endif>TakeProfitBUY</option>
                                            <option value="CutLossBUY"
                                            @if(old('signal_close') != '' && old('signal_close') == 'CutLossBUY') selected @endif>CutLossBUY</option>
                                            <option value="TakeProfitSELL"
                                            @if(old('signal_close') != '' && old('signal_close') == 'TakeProfitSELL') selected @endif>TakeProfitSELL</option>
                                            <option value="CutLossSELL"
                                            @if(old('signal_close') != '' && old('signal_close') == 'CutLossSELL') selected @endif>CutLossSELL</option>
                                    </select>
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
                            <div class="col-md-3 form-group">
                                <label>{{(__('signal.profit'))}}</label>
                                <input step="0.01" readonly="true" type="number" name="profit" autocomplete="off"
                                        class="form-control"
                                        value="{{old('profit')}}">
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                    <label>Win Ratio</label>
                                    <div class="input-group date-time" id="close_time"
                                        data-target-input="nearest">
                                        <input type="number"  name="win_ratio"
                                            value="{{old('win_ratio')}}" autocomplete="off"
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
                                           value="{{old('total_trade')}}" autocomplete="off"
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
    var mstStocks = @json($mstStocks);

    console.log(mstStocks);
    if (!Array.isArray(mstStocks)) {
        mstStocks = Object.values(mstStocks);
    }
    $("input[name='price_close'],input[name='price_open']").change(function () {
        var price_close = $(this).val();
        var price_open = $("input[name='price_open']").val();
        var signal_open = $("select[name='signal_open']").val();
        var profit = null;
        if(signal_open.trim().toLowerCase() =='buy'){
            profit =price_close- price_open;
        }
        if(signal_open.trim().toLowerCase() =='sell'){
            profit =price_open - price_close;
        }
        if(profit){
            profit =profit/price_open*100;
            profit = profit.toFixed(2);
        }
        $("input[name='profit']").val(profit);
    });
    $("select[name='code']").change(function () {
        var code = $(this).val();
        console.log(code);
        var stock = mstStocks.filter(function(x) {
            return x.id == code;
        })[0];
        console.log(stock);
        if (stock) {
            $("input[name='win_ratio']").val(stock.win_ratio);
            $("input[name='total_trade']").val(stock.total_trade);
        }
    });
});
 </script>
