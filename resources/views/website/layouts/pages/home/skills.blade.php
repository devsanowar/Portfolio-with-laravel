@php
    $skillsByCategory = $skills->groupBy(fn($skill) => $skill->category->title);
@endphp

<section id="skills" class="section fade-in-section">
    <div class="container">
        <h2 class="section-title">Technical Skills</h2>
        <div class="row">

            @foreach($skillsByCategory as $categoryTitle => $categorySkills)
                <div class="col-lg-4 col-md-6">
                    <div class="skill-card">
                        {{-- category icon --}}
                        <i class="{{ $categorySkills->first()->category->icon ?? 'fas fa-code' }} skill-icon"></i>

                        <h3 class="skill-title">{{ $categoryTitle }}</h3>

                        <p class="skill-description">
                            {{ $categorySkills->first()->category->description ?? '' }}
                        </p>

                        <div class="skill-progress">
                            @foreach($categorySkills as $skill)
                                <div class="progress-item">
                                    <div class="progress-label">
                                        <span>{{ $skill->name }}</span>
                                        <span>{{ $skill->percentage }}%</span>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar"
                                             style="width: {{ $skill->percentage }}%"
                                             data-percent="{{ $skill->percentage }}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>
