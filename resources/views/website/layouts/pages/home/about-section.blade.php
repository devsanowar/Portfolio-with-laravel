<section id="about" class="section fade-in-section">
    <div class="container">
        <h2 class="section-title">About Me</h2>
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="about-image-container">
                    <div class="profile-image">
                        @if ($about->image)
                        <img src="{{ asset($about->image) }}" alt="">
                        @else
                        <i class="fas fa-user-circle"></i>
                        @endif
                    </div>
                    <div class="about-info-cards">
                        <div class="info-card">
                            <i class="fas fa-briefcase"></i>
                            <div>
                                <h5>Experience</h5>
                                <p>{{ $about->experience ?? '' }}+ Years</p>
                            </div>
                        </div>
                        <div class="info-card">
                            <i class="fas fa-project-diagram"></i>
                            <div>
                                <h5>Projects</h5>
                                <p>{{ $about->projects ?? '' }}+ Completed</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="about-content">
                    <h3 class="about-subtitle">{{ $about->title ?? '' }}</h3>
                    <p class="about-text">
                        {!! $about->description !!}
                    </p>
                    @php
                        $skills = json_decode($about->skills, true);
                    @endphp
                    <div class="expertise-grid">
                        @foreach ($skills as $skill)
                            <div class="expertise-item">
                                <i class="fas fa-check-circle"></i>
                                <span>{{ $skill }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="resume-download">
                        <a href="{{ $about->pdf ?? '' }}" class="btn btn-custom" download>
                            <i class="fas fa-download"></i> Download Resume
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
