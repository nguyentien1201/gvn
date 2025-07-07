<!-- resources/views/components/hero.blade.php -->
<section id="banner-home">
    <div class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item container-heading active text-center">
                <h3 class="heading-page">{{__('base.title_banner')}}</h3>
                <p class="content noto-sans-jp-font-family my-3">
                    <span>{{__('base.content_1')}}</span><br>
                    <span>{{__('base.content_2')}}</span>
                </p>
                <div class="container-button d-flex justify-content-center gap-3">
                    <a class="btn btn-primary" href="{{ route('front.home.trading-system') }}">{{__('base.see_more')}}</a>
                    <a class="btn btn-outline-primary"  href="{{ route('front.home.contact') }}">{{__('base.contact')}}</a>
                </div>
                <div class="container background-banner">
                    <div id="lottie-container" style="height:400px;" class="img-fluid w-100 d-block" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
@push('scripts')
    <script>
                 const logoBaseUrl = "{{ asset('images/animation') }}";
        var animation = lottie.loadAnimation({
                container: document.getElementById('lottie-container'), // id của div
                renderer: 'canvas', // có thể là 'svg', 'canvas', hoặc 'html'
                loop: true, // lặp vô tận
                autoplay: true, // tự động chạy
                path: logoBaseUrl+'/data.json', // đường dẫn tới file JSON
                rendererSettings: {
                    preserveAspectRatio: 'none' // <<-- cực kỳ quan trọng
                }
            });
            animation.addEventListener('enterFrame', function(e) {
            if (e.currentTime < 120) {
                animation.setSpeed(3); // trước frame 60 chạy nhanh
            } else {
                animation.setSpeed(1.5); // sau frame 60 chạy bình thường
            }
            });

        </script>
@endpush