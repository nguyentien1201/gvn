<style>
    input[type="checkbox"] {
            display: none;
        }

        /* Tạo giao diện toggle switch */
        .toggle-switch {
            position: relative;
            width: 60px;
            height: 30px;
            background-color: #ccc;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        /* Tạo vòng tròn di chuyển bên trong toggle switch */
        .toggle-switch:before {
            content: "";
            position: absolute;
            top: 2px;
            left: 2px;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background-color: white;
            transition: transform 0.3s ease;
        }

        /* Hiệu ứng khi toggle được bật */
        input[type="checkbox"]:checked + .toggle-switch {
            background-color: #4CAF50;
        }

        input[type="checkbox"]:checked + .toggle-switch:before {
            transform: translateX(30px);
        }

        /* Hiệu ứng khi hover */
        .toggle-switch:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
</style>
@extends('layout.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('panel.product') }}</h1>
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
                <form class="add-edit-frm" action="{{route( 'admin.product-version.update', [$product->id])}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$product->id}}"/>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>{{(__('product.name_product'))}} <span class="red"> *</span></label>
                                <input type="text" name="name_product" autocomplete="off"
                                       class="form-control @if($errors->has('name_product')) is-invalid @endif"
                                       value="{{old('name_product' , $product->name_product )}}">
                                @if($errors->has('name_product'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('name_product') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-2 form-group">
                                <label>{{(__('product.version_number'))}} <span class="red"> *</span></label>
                                <input  type="text" name="version_number" autocomplete="off"
                                       class="form-control @if($errors->has('version_number')) is-invalid @endif"
                                       value="{{old('version_number',$product->version_number)}}">
                                @if($errors->has('version_number'))
                                    <p class="invalid-feedback">
                                        {{ $errors->first('version_number') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-2 form-group">
                                <label>{{(__('product.release_date'))}} <span class="red"> *</span></label>
                                <div class="input-group date-time" id="release_date"
                                     data-target-input="nearest">
                                    <input type="text" data-target="#release_date" name="release_date"
                                           value="{{old('release_date', $product->release_date ?? '')}}" autocomplete="off"
                                           placeholder="{{__('product.release_date')}}"
                                           class="form-control datetimepicker-input datetimepicker @if($errors->has('release_date')) is-invalid @endif">
                                    <div class="input-group-append" data-target="#release_date"
                                         data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    @if($errors->has('release_date'))
                                        <p class="invalid-feedback">
                                            {{ $errors->first('release_date') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-2 form-group">
                                <label>{{(__('product.set_current'))}}</label>
                                <div class="input-group">
                                    <input type="checkbox" id="toggle" name="is_current"  {{ old('is_current', $product->is_current) ? 'checked' : '' }}>
                                    <label for="toggle" class="toggle-switch"></label>
                                </div>
                            </div>
                        </div>

                        <a href="{{route('admin.product-version.index')}}" class="btn btn-secondary">
                            {{__('panel.back')}}
                        </a>
                        <button type="submit" class="btn btn-primary">{{__('panel.save')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
