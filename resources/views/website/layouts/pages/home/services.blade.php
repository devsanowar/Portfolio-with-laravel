<section id="services" class="services-section">
    <div class="container">
        <!-- Section Header -->
        <div class="section-header">
            <div class="section-subtitle">
                <span class="subtitle-line"></span>
                <span class="subtitle-text">What I Provide</span>
                <span class="subtitle-line"></span>
            </div>
            <h2 class="section-title">Professional Services</h2>
            <p class="section-description">
                Delivering cutting-edge web solutions with expertise in modern technologies
                and best practices to bring your digital vision to life.
            </p>
        </div>

        <!-- Services Grid -->
        <div class="row g-4">
            @foreach ($services as $index => $service)
                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="{{ $service->icon_class }}"></i>
                            <div class="icon-bg"></div>
                        </div>

                        <h3 class="service-title">{{ $service->service_name }}</h3>

                        <p class="service-description">
                            {{ $service->short_description }}
                        </p>


                        @if (!empty($service->features) && is_array($service->features))
                            <ul class="service-features">
                                @foreach ($service->features as $feature)
                                    <li>
                                        <i class="fas fa-check-circle"></i> {{ $feature }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <div class="service-number">
                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- নিচের CTA অংশটা আগের মতোই রেখে দাও -->
        <div class="services-cta">
            <div class="cta-content">
                <h3 class="cta-title">{{ $cta->title ?? '' }}</h3>
                <p class="cta-description">
                    {!! $cta->description ?? '' !!}
                </p>
            </div>
            <div class="cta-buttons">
                <a href="#{{ $cta->button_one_url ?? '' }}" class="btn btn-custom">
                    <i class="fas fa-paper-plane"></i> {{ $cta->button_one_name ?? '' }}
                </a>
                <a href="#{{ $cta->button_two_url ?? '' }}" class="btn btn-custom btn-secondary-custom">
                    <i class="fas fa-eye"></i> {{ $cta->button_two_name ?? '' }}
                </a>
            </div>
        </div>

        <div class="bg-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
    </div>
</section>
