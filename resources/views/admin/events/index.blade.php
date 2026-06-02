{{-- resources/views/admin/events/index.blade.php --}}

@extends('layout.admin')

@section('content')

<div class="card">

    <div class="card-header">
        <a href="{{ route('admin.events.create') }}"
           class="btn btn-primary">
            Thêm sự kiện
        </a>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tiêu đề</th>
                    <th>Bắt đầu</th>
                    <th>Trạng thái</th>
                    <th width="150">Action</th>
                </tr>
            </thead>

            <tbody>

            @foreach($events as $event)

                <tr>

                    <td>{{ $event->id }}</td>

                    <td>
                        @if($event->thumbnail)
                            <img src="{{ asset('storage/'.$event->thumbnail) }}"
                                 width="100">
                        @endif
                    </td>

                    <td>{{ $event->title }}</td>

                    <td>
                        {{ optional($event->start_date)->format('d/m/Y') }}
                    </td>

                    <td>
                        {!! $event->status
                            ? '<span class="badge badge-success">Hiện</span>'
                            : '<span class="badge badge-danger">Ẩn</span>' !!}
                    </td>

                    <td>

                        <a href="{{ route('admin.events.edit',$event) }}"
                           class="btn btn-warning btn-sm">
                            Sửa
                        </a>

                        <form method="POST"
                              action="{{ route('admin.events.destroy',$event) }}"
                              style="display:inline">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm">
                                Xóa
                            </button>

                        </form>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

        {{ $events->links() }}

    </div>

</div>

@endsection
