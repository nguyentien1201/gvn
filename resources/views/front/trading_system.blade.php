<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GVN</title>
    <!-- Bootstrap CSS -->


    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- DataTables Responsive CSS -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{asset('plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="
https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js
"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0-rc/dist/chartjs-plugin-datalabels.min.js"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <script
        src="https://cdn.datatables.net/v/bs5/dt-2.0.8/date-1.5.2/fc-5.0.1/fh-4.0.1/r-3.0.2/datatables.min.js"></script>
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" rel="stylesheet">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <style>
        body {
            font-size: 0.9rem !important;
        }

        .ml-auto {
            margin-left: auto !important;
        }
        #navbarNav .nav-link {
            font-size: 1.1rem;
            color: #000;
            font-weight: 600;
        }

        .hero {
            background: url('https://via.placeholder.com/1500x800') no-repeat center center;
            background-size: cover;
            color: white;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .cta {
            background-color: #007bff;
            color: white;
            padding: 60px 0;
        }

        .footer {
            padding: 30px 0;
        }



        .carousel-caption {
            background: rgba(0, 0, 0, 0.6);
            padding: 20px;
            border-radius: 10px;
        }

        .features {
            background: #f9f9f9;
        }

        .features .card {
            border: none;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .features .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .features .card-body {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .cta {
            background: linear-gradient(45deg, #007bff, #0056b3);
            color: white;
            padding: 60px 0;
        }

        .cta .btn {
            background: white;
            color: #007bff;
            border: none;
            transition: background-color 0.3s, color 0.3s;
        }

        .cta .btn:hover {
            background: #007bff;
            color: white;
        }
        .carousel-item {
            min-height: 300px;
            background: no-repeat center center scroll;
            background-size: cover;
        }
        .footer {
            padding: 30px 0;
            background: #f1f1f1;
        }

        .header {
            position: relative;
            width: 100%;
            z-index: 1000;
            transition: all 0.5s ease;
            /* Smooth transition for any changes */
        }

        .fixed-header {
            top: 0;
            background-color: rgba(255, 255, 255, 0.9);
            /* Slightly transparent or any effect */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            /* Optional: adds shadow for better visibility */
        }

        .pricing-table {
            display: flex;
            justify-content: center;  /* Căn giữa theo chiều ngang */
            gap: 20px;
        }
        .basic {
            background-color: #4f4fee;
            color: white;

        }
        .standard {

                background-color: #4caf50;
                color: white;
            }
            .premium {
                background-color: #f44336;
                color: white;
            }
        .pricing-card {
            background-color: white;
            padding: 20px;
            border-radius: 150px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
        }

        .pricing-card h3 {
            font-size: 24px;
            color: #333;
        }

        .pricing-card .price {
            font-size: 48px;
            margin: 20px 0;
            padding: 10px;
            border: none;
            border-radius: 50px;  /* Bo tròn góc */
            display: inline-block; /* Để giới hạn phần tử theo kích thước nội dung */
        }

        .pricing-card ul {
            list-style-type: none;
            margin: 1rem 0;
        }

        .pricing-card ul li {
            font-size: 16px;
            margin: 10px 0;
            text-align: left;
            display: flex;
            align-items: center;
        }

        .pricing-card ul li span {
            margin-right: 10px;
            color: green;
        }

        .pricing-card ul li span:nth-child(1):contains('✖') {
            color: red;
        }

        .pricing-card .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 60px;

            color: white;
            text-decoration: none;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .pricing-card .btn:hover {
            /* background-color: #0056b3; */
        }

        /* Specific styles for each card */


        .basic .btn {
            background-color: #4f4fee;
        }

        .standard .btn {
            background-color: #4caf50;
        }

        .premium .btn {
            background-color: #f44336;
        }
        .price_block{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .tick {
            color: green; /* Đổi màu thành xanh lá */
            font-weight: bold;
            margin-right: 10px;
        }

        /* Not Tick (Red) */
        .not-tick {
            color: red; /* Đổi màu thành đỏ */
            font-weight: bold;
            margin-right: 10px;
        }
    </style>

</head>

<body>

    <!-- Navigation Bar -->

    @include('front.common.header')
    <div id="heroCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active" style="background-image: url({{url('images/banner_tranding_view.jpg')}})">
      </div>
    </div>
  </div>
    <!-- Features Section -->
    <section>
        <div class="container">
            <div class="row">
                <h3 class="text-center mt-5">The trend is your friend” (Xu hướng chính là bạn) - Benjamin Graham</h3>
                <div class="col-md-6">
                    <p class="text-center mt-3 " style="font-size: larger;">Xác định xu hướng là kim chỉ nam trước mỗi hành động đầu tư và chiếm tới
                        70% khả năng chiến thắng của nhà đầu tư trên thị trường tài chính.
                        Robot Green Beta của GVN là sự kết hợp giữa việc tìm kiếm xu hướng tăng giá bằng thuật toán và
                        tự thích ứng khi xu hướng có dấu hiệu thay đổi.
                        Với tỉ tệ chính xác xu hướng trung bình từ 70-80% trên các chỉ số.</p>

                </div>
                <div class="col-md-6">
                    <img src="{{ asset('images/trading-system.jpg') }}" alt="Trading System" class="img-fluid">
                </div>

            </div>
            <div class="row">

                <img src="{{ asset('images/history_beta.jpg') }}" alt="history_beta" class="img-fluid">
                <h4 class="text-center mt-5" style="font-size: larger;">Green Beta có thể làm việc trên 20 chỉ số ở các thị trường Chứng khoán,
                    Hàng hóa và Tiền điện tử, cho nhà đầu tư một cái nhìn rõ nét hơn về xu hướng thay đổi dòng tiền của
                    cá mập trên thị trường toàn cầu.</h4>
            </div>
        </div>
        <div class="container pb-3" style="background: #f9f9f9;">
            <div class="row">
                <div class="col-md-12 text-center price_block">
                    <h2 class="text-center mt-5">PRICE TABLE TEMPLATE</h2>
                    <div class=" pricing-table mt-3">
                    <div class="pricing-card">
                        <h3>1 Tháng</h3>
                        <p class="price basic">$0</p>
                        <ul style="min-height:120px">
                            <li><i class="fas fa-check tick"></i>Phiên bản dùng thử</li>

                        </ul>
                        <a href="#" class="btn basic">Buy Now</a>
                    </div>

                    <div class="pricing-card">
                        <h3>3 Tháng</h3>
                        <p class="price standard">$0</p>
                        <ul style="min-height:120px">
                            <li><i class="fas fa-check tick"></i>Phiên bản dùng thử</li>
                        </ul>
                        <a href="#" class="btn standard">Buy Now</a>
                    </div>

                    <div class="pricing-card">
                        <h3>3 Tháng</h3>
                        <p class="price premium">$0</p>
                        <ul style="min-height:120px">
                            <li><i class="fas fa-check tick"></i>Phiên bản dùng thử</li>
                        </ul>
                        <a href="#" class="btn premium">Buy Now</a>
                    </div>
                </div>
                </div>

            </div>
        </div>
    </section>
    <section>
    <div class="container">
            <div class="row">
                <h3 class="text-center mt-5">Bạn đúng hay sai, điều đó không quan trọng, cái chính là bạn kiếm được bao nhiêu khi đúng và mất bao nhiêu khi bạn sai." – George Soros</h3>
                <div class="col-md-9">
                    <p class="text-center mt-3 " style="font-size: larger;">Bạn không thể kiểm soát thị trường, nhưng bạn có thể kiểm soát cách bạn phản ứng với nó, kiểm soát cảm xúc, kỷ luật trong đầu tư là cách tốt nhất để chiến thắng trong Trading. Một sản phẩm của GVN với các nhà đầu tư dành phần lớn thời gian hằng ngày giao dịch trên các thị trường, Robot Green Alpha phân tích xung lực của thị trường trong phiên, xác định điểm xu hướng  và cho ra các hành động giao dịch cụ thể</p>
                </div>
                <div class="col-md-3">
                    <img src="{{ asset('images/signal_stock.jpg') }}" alt="Trading System" class="img-fluid">
                </div>

            </div>
            <div class="row">
            <div class="col-md-6">

                <img src="{{ asset('images/alpha_history.jpg') }}" alt="history_alpha" class="img-fluid">
                <h4 class="text-center mt-5">TÍCH LŨY HIỆU QUẢ DÀI HẠNG </h4>
            </div>
                <div class="col-md-6">
                <h4 class="text-center mt-5"3>THEO DÕI HIỆU QUẢ TÍN HIÊU MỖI THÁNG</h4>
                    <img src="{{ asset('images/chart_profit.jpg') }}" alt="Trading System" class="img-fluid">

                </div>


            </div>
        </div>
        <div class="container pb-3" style="background: #f9f9f9;">
            <div class="row">
                <div class="col-md-12 text-center price_block">

                    <div class=" pricing-table mt-3">
                    <div class="pricing-card">
                        <h3>1 Tháng</h3>
                        <p class="price basic">$0</p>
                        <ul style="min-height:120px">
                            <li><i class="fas fa-check tick"></i>Phiên bản dùng thử</li>

                        </ul>
                        <a href="#" class="btn basic">Buy Now</a>
                    </div>

                    <div class="pricing-card">
                        <h3>6 Tháng</h3>
                        <p class="price standard">$0</p>
                        <ul style="min-height:120px">
                            <li><i class="fas fa-check tick"></i>Phiên bản dùng thử</li>
                        </ul>
                        <a href="#" class="btn standard">Buy Now</a>
                    </div>

                    <div class="pricing-card">
                        <h3>1 Năm</h3>
                        <p class="price premium">$0</p>
                        <ul style="min-height:120px">
                            <li><i class="fas fa-check tick"></i>Phiên bản dùng thử</li>
                        </ul>
                        <a href="#" class="btn premium">Buy Now</a>
                    </div>
                </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Call to Action Section -->
    <section>
    <div class="container">
            <div class="row">
                <h3 class="text-center mt-5">"Thay vì cố gắng dự đoán thị trường, hãy tập trung vào việc tìm kiếm cơ hội đầu tư." - John Templeton</h3>

                <div class="col-md-8 ">
                    <img src="{{ asset('images/system_greenstock.jpg') }}" alt="Trading System" class="img-fluid">
                </div>
                <div class="col-md-4" style="justify-content: center;align-items: center;display: flex;">
                    <p class="text-center mt-3 " style="font-size: larger;">Hệ thống GreenStock-NAS100 tự động sắp xếp các cổ phiếu theo độ mạnh xung lực dòng tiền và xu hướng cổ phiếu trong rổ NAS100 hằng ngày, đưa ra hành động để nhà đầu tư theo dõi </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <img src="{{ asset('images/system_profit_greenstock.jpg') }}" alt="history_alpha" class="img-fluid">
                </div>
                <div class="col-md-4"  style="justify-content: center;align-items: center;display: flex;">
                        <p class="text-center mt-3" style="font-size: larger;">
                        Hệ thống sắp xếp các nhóm cổ phiếu có hiệu suất sinh lời trong khoảng thời gian năm, quý, tháng tốt hơn thị trường chung
                        </p>

                </div>


            </div>
        </div>
        <div class="container pb-3" style="background: #f9f9f9;">
            <div class="row">
                <div class="col-md-12 text-center price_block">
                    <h2 class="text-center mt-5">PRICE TABLE TEMPLATE</h2>
                    <div class=" pricing-table mt-3">
                    <div class="pricing-card">
                        <h3>1 Tháng</h3>
                        <p class="price basic">$0</p>
                        <ul style="min-height:120px">
                            <li><i class="fas fa-check tick"></i>Phiên bản dùng thử</li>

                        </ul>
                        <a href="#" class="btn basic">Buy Now</a>
                    </div>

                    <div class="pricing-card">
                        <h3>3 Tháng</h3>
                        <p class="price standard">$0</p>
                        <ul style="min-height:120px">
                            <li><i class="fas fa-check tick"></i>Phiên bản dùng thử</li>
                        </ul>
                        <a href="#" class="btn standard">Buy Now</a>
                    </div>

                    <div class="pricing-card">
                        <h3>3 Tháng</h3>
                        <p class="price premium">$0</p>
                        <ul style="min-height:120px">
                            <li><i class="fas fa-check tick"></i>Phiên bản dùng thử</li>
                        </ul>
                        <a href="#" class="btn premium">Buy Now</a>
                    </div>
                </div>
                </div>

            </div>
        </div>
    </section>
    <section class="text-center mt-5">
        @include('front.common.footer')
    </section>
    <!-- Footer -->


    <!-- Bootstrap JS and dependencies -->


</body>

</html>
