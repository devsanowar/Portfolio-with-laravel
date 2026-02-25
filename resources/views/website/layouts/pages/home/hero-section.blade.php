<section id="home" class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="hero-content">
                    <h1 class="hero-title">{!! str_replace(' ', '<br>', $hero->title) !!}</h1>
                    <h2 class="hero-subtitle">{!! $hero->sub_title ?? '' !!}</h2>
                    <p class="hero-description">
                        {!! $hero->description ?? '' !!}
                    </p>
                    <div class="hero-buttons">
                        <a href="#projects" class="btn btn-custom">View Projects</a>
                        <a href="#contact" class="btn btn-custom btn-secondary-custom">Hire Me</a>
                    </div>
                    @php
                        $links = [
                            'github' => $hero->github_url ?? null,
                            'linkedin' => $hero->linkedin_url ?? null,
                            'facebook' => $hero->facebook_url ?? null,
                            'instagram' => $hero->instagram_url ?? null,
                            'pinterest' => $hero->pinterest_url ?? null,
                            'dribbble' => $hero->dribbble_url ?? null,
                        ];
                    @endphp

                    <div class="social-links">
                        @foreach ($links as $icon => $url)
                            @if (filled($url))
                                <div class="social-box">
                                    <a href="{{ $url }}" target="_blank" class="social-link">
                                        <i class="fa-brands fa-{{ $icon }}"></i>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
                <div class="code-animation">
                    <span class="code-line">&lt;html&gt;</span>
                    <span class="code-line"> &lt;body&gt;</span>
                    <span class="code-line"> &lt;div class="developer"&gt;</span>
                    <span class="code-line"> Building Dreams...</span>
                    <span class="code-line"> &lt;/div&gt;</span>
                </div>
            </div>
        </div>
    </div>
</section>
