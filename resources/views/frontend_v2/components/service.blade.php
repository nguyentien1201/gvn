<section id="services" class="py-5">
    <div class="container">
        <h2 class="text-center services-title pb-3 pb-lg-5">{{ __('base.Our_Service') }}</h2>
        <div class="row align-items-center gx-4 gy-4 gy-lg-0">
        @php
            $services = [
                [
                    'icon' => 'candlestick-chart.png',
                    'title' => __('base.service_1'),
                    'text' => __('base.description_service_1'),
                    'image' => 'service.png'
                ],
                [
                    'icon' => 'laptop.png',
                    'title' => __('base.service_2'),
                    'text' => __('base.description_service_2'),
                    'image' => 'service2.png'
                ],
                [
                    'icon' => 'briefcase.png',
                    'title' => __('base.service_3'),
                    'text' => __('base.description_service_3'),
                    'image' => 'service3.png'
                ]
            ];
        @endphp

        <!-- Left: Tab content (vertical nav pills) -->
            <div class="col-12 col-lg-6">
                <div class="d-flex align-items-start">
                    <div class="nav flex-column nav-pills me-3 w-100" id="service-tab" role="tablist" aria-orientation="vertical">
                        @foreach($services as $index => $service)
                            <div class="service nav-link d-flex text-start gap-3 p-3 {{ $index === 0 ? 'active' : '' }}"
                                    id="service-tab-{{ $index }}"
                                    data-bs-toggle="pill"
                                    data-bs-target="#service-content-{{ $index }}"
                                    role="tab"
                                    aria-controls="service-content-{{ $index }}"
                                    aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                <div class="service-icon">
                                    <img src="{{ asset('images/icons/' . $service['icon']) }}" alt="Analysis Icon">
                                </div>
                                <div class="service-content">
                                    <h6 class="service-title mb-2">
                                        {{ $service['title'] }}
                                    </h6>
                                    <p class="service-text">
                                        {{ $service['text'] }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right: Tab image -->
            <div class="col-12 col-lg-6 text-center">
                <div class="tab-content" id="service-tabContent">
                    @foreach($services as $index => $service)
                        <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}"
                             id="service-content-{{ $index }}"
                             role="tabpanel"
                             aria-labelledby="service-tab-{{ $index }}">
                            <img src="{{ asset('images/home/' . $service['image']) }}"
                                 alt="Service image {{ $index }}"
                                 class="img-fluid services-img">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabs = document.querySelectorAll('.nav-link');

            function updateBeforeWidths(activeIndex) {
                tabs.forEach((tab, index) => {
                    const beforeEl = tab;
                    if (index === activeIndex) {
                        beforeEl.style.setProperty('--before-width', '35%');
                    } else if (index < activeIndex) {
                        beforeEl.style.setProperty('--before-width', '100%');
                    } else {
                        beforeEl.style.setProperty('--before-width', '0%');
                    }

                    // Gán width vào pseudo-element bằng cách dùng style biến custom
                    beforeEl.style.setProperty('--before-width', beforeEl.style.getPropertyValue('--before-width'));
                });
            }

            // Observer tab click
            tabs.forEach((tab, index) => {
                tab.addEventListener('click', () => {
                    updateBeforeWidths(index);
                });
            });

            // Khởi tạo trạng thái ban đầu
            const initialActive = Array.from(tabs).findIndex(tab => tab.classList.contains('active'));
            updateBeforeWidths(initialActive);
        });
    </script>
@endpush