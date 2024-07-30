@extends('layout.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Green Alpha</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- result -->
    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header">Import Portfolio </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <a href="{{ route('admin.green-alpha.create') }}"
                               class="btn btn-primary">
                                {{ __('panel.add') }}
                            </a>
                        </div>
                        <div class="col-md-12 form-group">
                        <form class="d-flex justify-content-center" action="{{route('admin.green-alpha.import-portfolio')}}" method="post"
                              enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" accept=".xlsx, .xls, .csv" name="select_file" class="custom-file-input" id="inputGroupFile04" required>
                                    <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <button class="d-flex btn btn-primary" type="submit">
                                       <span><i class="fa fa-upload mr-1"></i>{{__('panel.import')}}</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                        </div>

                </div>
            </div>
        </div>
    </section>
@endsection
