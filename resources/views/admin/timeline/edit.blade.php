@extends('layout.admin')

@section('content')

<div class="card">

    <div class="card-header">
        <h3>Edit Timeline</h3>
    </div>

    <div class="card-body">

        <form method="POST"
              action="{{ route('admin.timeline.update',$timeline->id) }}">

            @csrf
            @method('PUT')

            @include('admin.timeline.form')

            <button class="btn btn-primary">
                Update
            </button>

        </form>

    </div>

</div>

@endsection
