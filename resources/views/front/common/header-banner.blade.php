
<!-- Hero Section -->
<style>
    .carousel-item {
      height: 100vh;
      min-height: 300px;
      background: no-repeat center center scroll;
      background-size: cover;
    }
    .carousel-caption {
        bottom: 6rem !important;
    }
  </style>
 <!-- Hero Section with Slider -->
 <div id="heroCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active" style="background-image: url({{url('images/banner-1.jpg')}})">
        <div class="container">
          <div class="carousel-caption text-left">
            <h1> Chúng tôi tạo ra các hệ thống để phục vụ nhu cầu của nhà đầu tư</h1>
            <p> Giảm thời gian theo dõi thị trường và tăng hiệu quả đầu tư của khách hàng.</p>
            <p>
            <button class="btn btn-lg btn-dark text-white mx-2"> Tìm hiểu thêm</button>
            <button class="btn btn-lg btn-success mx-2"> Liên hệ</button></p>
          </div>
        </div>
      </div>
      <div class="carousel-item" style="background-image: url({{url('images/artificial-intelligence-ai-robot-big-data-bull-market-stock-chart-getty.jpg')}})">
        <div class="container">
        <div class="carousel-caption text-left">
            <h1> Chúng tôi tạo ra các hệ thống để phục vụ nhu cầu của nhà đầu tư</h1>
            <p> Giảm thời gian theo dõi thị trường và tăng hiệu quả đầu tư của khách hàng.</p>
            <p>
            <button class="btn btn-lg btn-dark text-white mx-2"> Tìm hiểu thêm</button>
            <button class="btn btn-lg btn-success mx-2"> Liên hệ</button></p>
          </div>
        </div>
      </div>
      <div class="carousel-item" style="background-image: url({{url('images/stock-trading-bot.webp')}})">
        <div class="container">
        <div class="carousel-caption text-left">
            <h1> Chúng tôi tạo ra các hệ thống để phục vụ nhu cầu của nhà đầu tư</h1>
            <p> Giảm thời gian theo dõi thị trường và tăng hiệu quả đầu tư của khách hàng.</p>
            <p>
            <button class="btn btn-lg btn-dark text-white mx-2"> Tìm hiểu thêm</button>
            <button class="btn btn-lg btn-success mx-2"> Liên hệ</button></p>
          </div>
        </div>
      </div>
    </div>

  </div>
  <script>
$(document).ready(function() {
    // Hero Carousel
    $('#heroCarousel').carousel({
        interval: 2000
    });
});
</script>
