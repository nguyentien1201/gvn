@extends('layout.admin')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Cập nhật sự kiện</h3>
    </div>

    <div class="card-body">

        <form method="POST"
              action="{{ route('admin.events.update',[ $event->id]) }}"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            @include('admin.events.form')

            <button type="submit" class="btn btn-primary">
                Cập nhật
            </button>

        </form>

    </div>
</div>

@endsection
