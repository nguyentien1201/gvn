@extends('layout.admin')

@section('content')

<div class="card">

    <div class="card-header">
        <h3>Create Timeline</h3>
    </div>

    <div class="card-body">

        <form method="POST"  enctype="multipart/form-data"
              action="{{ route('admin.timeline.store') }}">

            @csrf

            @include('admin.timeline.form')

            <button class="btn btn-success">
                Save
            </button>

        </form>

    </div>

</div>

@endsection
