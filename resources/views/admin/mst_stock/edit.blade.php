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
                    <form class="add-edit-frm" action="{{route('admin.mst-stock.update', [$mst_stock->id])}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$mst_stock->id}}"/>
                        <div class="row">
                        <div class="col-md-4 form-group">
                                <label>{{(__('mst_stock.code'))}} <span class="red"> *</span></label>
                                <input type="text" name="code" autocomplete="off"
                                       class="form-control @if($errors->has('code')) is-invalid @endif"
                                       value="{{old('code', $mst_stock->code)}}">
                                @if($errors->has('code'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('code') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-4 form-group">
                                <label>{{(__('mst_stock.name'))}} <span class="red"> *</span></label>
                                <input type="text" name="name" autocomplete="off"
                                       class="form-control @if($errors->has('name')) is-invalid @endif"
                                       value="{{old('name', $mst_stock->name)}}">
                                @if($errors->has('name'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </p>
                                @endif
                            </div>

                            <div class="col-md-3 form-group">
                                <label>{{(__('mst_stock.group'))}} <span class="red"> *</span></label>
                                <select
                                    class="form-control select2 @if($errors->has('group')) is-invalid @endif"
                                    name="group" autocomplete="off">
                                        <option value="">{{__('panel.please_choose')}}</option>
                                        @foreach($listGroup as $key=> $group)
                                            <option value="{{$group}}"
                                            @if($mst_stock->group == $group) selected @endif>{{$group}}</option>
                                        @endforeach

                                    </select>
                                @if($errors->has('group'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('group') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <a href="{{route('admin.mst-stock.index')}}" class="btn btn-secondary">
                            {{__('panel.back')}}
                        </a>
                        <button type="submit" class="btn btn-primary">{{__('panel.save')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
