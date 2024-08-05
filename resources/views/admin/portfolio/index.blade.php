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
                        <div class="table-responsive">
                        <table class="table table-bordered table-truncate table-striped projects">
                            <thead>
                            <tr>
                                <th width="5%" class="text-center">{{__('panel.no')}}</th>
                                <th width="15%">Month</th>
                                <th width="15%">Profit</th>

                            </tr>
                            </thead>
                            <tbody>
                            @forelse($portfolio as $idx => $signal)
                                <tr>
                                    <td width="5%" class="text-center">{{$idx + 1}}</td>
                                    <td width="15%">{{$signal->month_year}}</td>
                                    <td width="15%">{{$signal->profit}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">
                                        {{ __('panel.nodata') }}
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if(!empty($signals))
                        <div class="paginations mt-3">
                            {!! $signals->appends($_GET)->links() !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
