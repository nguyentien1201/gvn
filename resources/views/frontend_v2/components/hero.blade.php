<!-- resources/views/components/hero.blade.php -->
<section id="banner-home">
    <div class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item container-heading active text-center">
                <h3 class="heading-page" style="font-size: 48px;">{{__('home.title_banner')}}</h3>
                <p class="content noto-sans-jp-font-family my-3">
                    <span>{{__('home.content_1')}}</span><br>
                    <span>{{__('home.content_2')}}</span>
                </p>
                <div class="container-button d-flex justify-content-center gap-3">
                    <button class="btn btn-primary">{{__('home.see_more')}}</button>
                    <button class="btn btn-outline-primary">{{__('home.contact')}}</button>
                </div>
                <div class="container background-banner">
                    <img height="400px" class="img-fluid w-100 d-block" src="{{asset('images/home/header-banner-1.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>