@push('styles')
    <style>
   .event-poster{
    position: relative;
    text-align: center;
}

.event-image{
    width: 100%;
    height: auto;
    display: block;
    border-radius: 12px;
}

.event-btn{
    position: absolute;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
}
    </style>
@endpush
@if($event)
<section class="py-5">

    <div class="event-poster container">
    <img
        src="{{ asset('storage/' . $event->thumbnail) }}"
        class="event-image"
        alt=""
    >

    <button class="event-btn"
            data-bs-toggle="modal"
            data-bs-target="#registerModal">
        ĐĂNG KÝ THAM GIA
    </button>
</div>
</section>

<!-- Modal đăng ký -->
<div class="modal fade" id="registerModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Đăng ký tham gia sự kiện</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="eventRegisterForm">
                    @csrf

                    <input type="hidden" name="event_id" value="{{ $event->id }}">

                    <div class="mb-3">
                        <label>Họ tên</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Số điện thoại</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Ghi chú</label>
                        <textarea name="note" class="form-control"></textarea>
                    </div>

                    <button type="submit" class="btn btn-success w-100">
                        Đăng ký
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endif


@push('scripts')
    <script>
        $('#eventRegisterForm').on('submit', function (e) {

            e.preventDefault();

            $.ajax({

                url: "{{ route('event.register') }}",

                method: "POST",

                data: $(this).serialize(),

                success: function (response) {

                    if (response.success) {

                        alert(response.message);

                        $('#registerModal').modal('hide');

                        $('#eventRegisterForm')[0].reset();
                    }
                },

                error: function (xhr) {

                    alert('Có lỗi xảy ra.');
                }
            });

        });

    </script>

@endpush
