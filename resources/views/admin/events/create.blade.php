@extends('layout.admin')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Thêm sự kiện</h3>
    </div>

    <div class="card-body">

        <form method="POST"
              action="{{ route('admin.events.store') }}"
              enctype="multipart/form-data">

            @csrf

            @include('admin.events.form')

            <button type="submit" class="btn btn-primary">
                Lưu
            </button>

        </form>

    </div>
</div>

@endsection
