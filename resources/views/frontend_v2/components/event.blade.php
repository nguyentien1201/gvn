@push('styles')
    <style>
        .event-poster {
            position: relative;

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;

            min-height: 450px;

            border-radius: 12px;
            overflow: hidden;

            display: flex;
            align-items: center;
        }

   .event-poster::before {
    content: "";
    position: absolute;
    inset: 0;

        background: linear-gradient(
            90deg,
            rgba(255,255,255,0.85) 0%,
            rgba(255,255,255,0.65) 35%,
            rgba(255,255,255,0.1) 100%
        );
    }

.event-overlay {
    position: relative;
    z-index: 1;

    width: 100%;
    padding: 30px;
}

        .event-left {
            flex: 1;
        }

        .event-left h1 {
            color: #00b300;
            font-size: 42px;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 5px;
        }

        .event-left h2 {
            color: #00b300;
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .event-left ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .event-left li {
            font-size: 15px;
            margin-bottom: 8px;
            color: #333;
        }

        .event-topic {
            margin-top: 20px;

            color: #00b300;

            font-size: 28px;
            font-weight: 800;

            line-height: 1.3;
        }

        .event-btn {
            margin-top: 20px;

            background: #00b300;
            color: #fff;

            border: none;

            padding: 10px 24px;

            border-radius: 8px;

            font-size: 14px;
            font-weight: 600;
        }

        .event-btn:hover {
            background: #009900;
        }

        .event-right {
            flex-shrink: 0;
        }

        .event-right img {
            width: 180px;
            height: 180px;

            object-fit: cover;

            border-radius: 50%;

            border: 4px solid #00b300;
        }

        .event-content {
            margin-top: 15px;
            color: #333;
        }

        .event-content h2 {
            color: #00b300;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .event-content p {
            margin-bottom: 8px;
            font-size: 15px;
        }
    </style>
@endpush
@if($event)
    <section class="py-5">
        <div class="event-poster container"  style="background-image: url('{{ asset('storage/' . $event->thumbnail) }}')">

            <div class="event-left">

                <h1>CAFE ĐẦU TƯ</h1>

                <h2>CÙNG GVN-FINTRADE</h2>

                <div class="event-content">
                    {!! $event->content !!}
                </div>
                <button class="event-btn" data-bs-toggle="modal" data-bs-target="#registerModal">
                    ĐĂNG KÝ THAM GIA
                </button>

            </div>



        </div>

    </section>
    <div class="modal fade" id="registerModal">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">
                        Đăng ký tham gia sự kiện
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>

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

                            <textarea name="note" class="form-control" rows="3"></textarea>
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
