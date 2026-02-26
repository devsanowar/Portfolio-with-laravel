<section id="projects" class="section fade-in-section">
    <div class="container">
        <h2 class="section-title">Featured Projects</h2>

        <div class="row">
            @foreach ($projects as $project)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="project-card">
                        <div class="project-image">
                            {{-- icon_class থেকে icon --}}
                            <i class="{{ $project->icon_class }}"></i>
                        </div>

                        <div class="project-content">
                            <h3 class="project-title"
                                onclick="openProjectModal({{ $project->id }}, '{{ e($project->project_title) }}')">
                                {{ $project->project_title }}
                            </h3>

                            <p class="project-description">
                                {{ $project->description }}
                            </p>

                            @php
                                $tools = array_filter(array_map('trim', explode(',', $project->tools)));
                            @endphp

                            @if (count($tools))
                                <div class="project-tags">
                                    @foreach ($tools as $tool)
                                        <span class="project-tag">{{ $tool }}</span>
                                    @endforeach
                                </div>
                            @endif


                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
