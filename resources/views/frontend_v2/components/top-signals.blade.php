<section id="top-signals">
    <div class="container">
        <div class="top-signals-container">
            <h2 class="text-center top-signals-title">{{__('home.top_signal_previous_session')}}</h2>
            <div class="row g-4">
                @php
                    $topSignals = 12;
                @endphp
                @for($i = 1; $i <= $topSignals; $i++)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="top-signal gap-2 d-flex flex-column justify-content-center align-items-center">
                            <img class="top-signal-icon" src="{{asset('images/icons/previuos.png')}}" alt="{{asset('images/icons/previuos.png')}}">
                            <div class="signal-name">Green Alpha</div>
                            <div class="signal-code d-flex justify-content-center gap-2 w-100" style="width: 20px; height: 20px; object-fit: cover;">
                                <img src="{{asset('images/logo/NAS100.png')}}" alt="{{asset('images/logo/NAS100.png')}}">
                                <span class="code">NAS100</span>
                            </div>
                            <div class="profit-sell d-flex justify-content-between w-100">
                                <span class="label-profit-sell">Take Profit SeLL:</span>
                                <span class="profit">0.52%</span>
                            </div>
                            <span class="last-time">2025-03-10 12:34:00</span>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
</section>

