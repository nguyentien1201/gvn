<section id="top-signals">
    <div class="container">
        <div class="top-signals-container">
            <h2 class="text-center top-signals-title">{{__('home.top_signal_previous_session')}}</h2>
            <div class="row g-4">
                @php
                    $topSignals = 12;
                @endphp
                @foreach ($last_signal as $signal)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="top-signal gap-2 d-flex flex-column justify-content-center align-items-center">
                            <img class="top-signal-icon" src="{{asset('images/icons/previuos.png')}}" alt="{{asset('images/icons/previuos.png')}}">
                            <div class="signal-name">Green Alpha</div>
                            <div class="signal-code d-flex justify-content-center gap-2 w-100" style="width: 20px; height: 20px; object-fit: cover;">
                                <img src="{{asset('images/logo/'.$signal->MstStock->code.'.png')}}" alt="{{asset('images/logo/'.$signal->MstStock->code.'.png')}}">
                                <span class="code">{{ $signal->MstStock->code }}</span>
                            </div>
                            <div class="profit-sell d-flex justify-content-between w-100">
                                <span class="label-profit-sell">{{$signal->signal_close }}:</span>
                                <span class="profit" style="color: {{ $signal->profit < 0 ? 'red' : 'green' }}">{{!empty($signal->profit) ? $signal->profit .'%'  : ''}}</span>
                            </div>
                            <span class="last-time">{{$signal->close_time ? $signal->close_time :$signal->open_time }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

