
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
            <h1> {{__('front_end.header_banner')}}</h1>
            <p> {{__('front_end.header_note_banner')}}</p>
            <p>
            <a class="btn btn-lg btn-dark text-white mx-2" href="/trading-system">{{__('front_end.see_more')}}</a>
            <a class="btn btn-lg btn-success mx-2" href="/contact">{{__('front_end.Contact')}}</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item" style="background-image: url({{url('images/artificial-intelligence-ai-robot-big-data-bull-market-stock-chart-getty.jpg')}})">
        <div class="container">
        <div class="carousel-caption text-left">
            <h1>{{__('front_end.header_banner')}}</h1>
            <p>{{__('front_end.header_note_banner')}}</p>
            <p>
            <a class="btn btn-lg btn-dark text-white mx-2" href="/trading-system">{{__('front_end.see_more')}}</a>
            <a class="btn btn-lg btn-success mx-2" href="/contact">{{__('front_end.Contact')}}</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item" style="background-image: url({{url('images/stock-trading-bot.webp')}})">
        <div class="container">
        <div class="carousel-caption text-left">
            <h1>  {{__('front_end.header_banner')}}</h1>
            <p>{{__('front_end.header_note_banner')}}</p>
            <p>
            <a class="btn btn-lg btn-dark text-white mx-2" href="/trading-system">{{__('front_end.see_more')}}</a>
            <a class="btn btn-lg btn-success mx-2" href="/contact">{{__('front_end.Contact')}}</a></p>
          </div>
        </div>
      </div>
    </div>

  </div>
  <script>
$(document).ready(function() {
    // Hero Carousel
    $('#heroCarousel').carousel({
        interval: 8000,
        ride: 'carousel', // Ensure it auto-plays
        pause: 'false'    // Prevent pausing on hover
    });
});
</script>
