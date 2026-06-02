@extends('layout.admin')

@section('content')

<div class="card">

    <div class="card-header">

        <a href="{{ route('admin.timeline.create') }}"
           class="btn btn-success">

            Add Timeline

        </a>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>
            <tr>
                <th>ID</th>
                <th>Time</th>
                <th>Title</th>
                <th>Sort</th>
                <th>Status</th>
                <th width="180">Action</th>
            </tr>
            </thead>

            <tbody>

            @foreach($timelines as $item)

                <tr>

                    <td>{{ $item->id }}</td>

                    <td>{{ $item->year }}</td>

                    <td>{{ $item->title }}</td>

                    <td>{{ $item->sort_order }}</td>

                    <td>
                        {!! $item->status
                            ? '<span class="badge badge-success">Active</span>'
                            : '<span class="badge badge-danger">Inactive</span>' !!}
                    </td>

                    <td>

                        <a href="{{ route('admin.timeline.edit',$item->id) }}"
                           class="btn btn-warning btn-sm">

                            Edit

                        </a>

                        <form method="POST"
                              action="{{ route('admin.timeline.destroy',$item->id) }}"
                              style="display:inline">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete ?')">

                                Delete

                            </button>

                        </form>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

        {{ $timelines->links() }}

    </div>

</div>

@endsection
