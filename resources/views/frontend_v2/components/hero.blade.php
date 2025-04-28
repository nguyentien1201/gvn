<!-- resources/views/components/hero.blade.php -->
<section id="banner-home">
    <div class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item container-heading active text-center">
                <h3 class="heading-page">{{__('home.title_banner')}}</h3>
                <p class="content noto-sans-jp-font-family my-3">
                    <span>{{__('home.content_1')}}</span><br>
                    <span>{{__('home.content_2')}}</span>
                </p>
                <div class="container-button d-flex justify-content-center gap-3">
                    <button class="btn btn-primary">{{__('home.see_more')}}</button>
                    <button class="btn btn-outline-primary">{{__('home.contact')}}</button>
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
                renderer: 'svg', // có thể là 'svg', 'canvas', hoặc 'html'
                loop: true, // lặp vô tận
                autoplay: true, // tự động chạy
                path: logoBaseUrl+'/data.json', // đường dẫn tới file JSON
                rendererSettings: {
                    preserveAspectRatio: 'none' // <<-- cực kỳ quan trọng
                }
            });
            animation.setSpeed(1.5);
        </script>
@endpush