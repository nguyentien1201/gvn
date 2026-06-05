@extends('layout.admin')

@section('content')

<div class="card">

    <div class="card-header">

        <h3>
            Danh sách đăng ký:
            {{ $event->title }}
        </h3>

        <a
            href="{{ route('admin.events.index') }}"
            class="btn btn-secondary">

            Quay lại

        </a>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Họ tên</th>
                    <th>SĐT</th>
                    <th>Email</th>
                    <th>Ghi chú</th>
                    <th>Ngày đăng ký</th>
                </tr>

            </thead>

            <tbody>

            @forelse($registrations as $item)

                <tr>

                    <td>{{ $item->id }}</td>

                    <td>{{ $item->name }}</td>

                    <td>{{ $item->phone }}</td>

                    <td>{{ $item->email }}</td>

                    <td>{{ $item->note }}</td>

                    <td>
                        {{ $item->created_at }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6" class="text-center">

                        Chưa có người đăng ký

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

        {{ $registrations->links() }}

    </div>

</div>

@endsection
