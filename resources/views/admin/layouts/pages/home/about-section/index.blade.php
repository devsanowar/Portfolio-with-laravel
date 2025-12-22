@extends('admin.dashboard')
@section('title', 'About Section Settings')
@push('styles')
    <link href="{{ asset('backend/assets/css/quill.snow.css') }}" rel="stylesheet">
@endpush
@section('admin_content')
    <div class="page-content">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        <ul class="nav nav-pills mb-3" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-bs-toggle="pill" href="#about-section-tab" role="tab"
                                    aria-selected="true">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon"><i class='bx bx-user font-18 me-1'></i></div>
                                        <div class="tab-title">About Section</div>
                                    </div>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="about-section-tab" role="tabpanel">

                                <form id="aboutSectionForm" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    {{-- Title --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Title</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class='bx bx-font'></i></span>
                                            <input type="text" name="title" class="form-control"
                                                value="{{ $about->title ?? '' }}" placeholder="Enter title">
                                        </div>
                                        <small class="text-danger error-text" data-error-for="title"></small>
                                    </div>

                                    {{-- Description --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Description</label>

                                        <div id="editor">{!! $about->description ?? '' !!}</div>
                                        <textarea name="description" id="description" style="display:none"></textarea>
                                        <small class="text-danger error-text" data-error-for="description"></small>

                                    </div>

                                    <div class="row">
                                        {{-- Experience --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Experience</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class='bx bx-time'></i></span>
                                                <input type="number" min="0" name="experience" class="form-control"
                                                    value="{{ $about->experience ?? 0 }}" placeholder="0">
                                            </div>
                                            <small class="text-danger error-text" data-error-for="experience"></small>
                                        </div>

                                        {{-- Projects --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Projects</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class='bx bx-briefcase'></i></span>
                                                <input type="number" min="0" name="projects" class="form-control"
                                                    value="{{ $about->projects ?? 0 }}" placeholder="0">
                                            </div>
                                            <small class="text-danger error-text" data-error-for="projects"></small>
                                        </div>
                                    </div>

                                    {{-- Skills --}}
                                    @php
                                        $skills = [];
                                        if (!empty($about->skills)) {
                                            $decoded = json_decode($about->skills, true);
                                            $skills = is_array($decoded) ? $decoded : [];
                                        }
                                    @endphp

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label d-flex align-items-center justify-content-between">
                                            <span>Skills</span>
                                            <button type="button" class="btn btn-sm btn-outline-primary" id="addSkillBtn">
                                                + Add Skill
                                            </button>
                                        </label>

                                        <div id="skillsWrapper">
                                            @forelse($skills as $i => $skill)
                                                <div class="skill-row mb-2 d-flex gap-2">
                                                    <input type="text" name="skills[]" class="form-control"
                                                        value="{{ $skill }}" placeholder="e.g. RESTful API Design">
                                                    <button type="button"
                                                        class="btn btn-outline-danger remove-skill">Remove</button>
                                                </div>
                                                <small class="text-danger error-text d-block"
                                                    data-error-for="skills.{{ $i }}"></small>
                                            @empty
                                                <div class="skill-row mb-2 d-flex gap-2">
                                                    <input type="text" name="skills[]" class="form-control"
                                                        value="" placeholder="e.g. RESTful API Design">
                                                    <button type="button"
                                                        class="btn btn-outline-danger remove-skill">Remove</button>
                                                </div>
                                                <small class="text-danger error-text d-block"
                                                    data-error-for="skills.0"></small>
                                            @endforelse
                                        </div>

                                        <small class="text-danger error-text" data-error-for="skills"></small>
                                    </div>


                                    <div class="row">
                                        {{-- Image --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Image</label>
                                            <input type="file" name="image" class="form-control" accept="image/*">
                                            <small class="text-danger error-text" data-error-for="image"></small>

                                            @if (!empty($about->image))
                                                <div class="mt-2">
                                                    <img src="{{ asset($about->image) }}" alt="About Image"
                                                        style="max-height: 80px;">
                                                </div>
                                            @endif
                                        </div>

                                        {{-- PDF --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">PDF</label>
                                            <input type="file" name="pdf" class="form-control"
                                                accept="application/pdf">
                                            <small class="text-danger error-text" data-error-for="pdf"></small>

                                            @if (!empty($about->pdf))
                                                <div class="mt-2">
                                                    <a href="{{ asset($about->pdf) }}" target="_blank">View current
                                                        PDF</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary" id="aboutSubmitBtn">
                                            <span id="aboutBtnText">Submit</span>
                                            <span id="aboutBtnSpinner"
                                                class="spinner-border spinner-border-sm d-none"></span>
                                        </button>
                                    </div>

                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('backend/assets/js/quill.js') }}"></script>

    <script>
        $(document).ready(function() {

            // ✅ Quill init (আপনার যদি আগেই থাকে, তাহলে এই অংশ বাদ দিন)
            const quill = new Quill('#editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{
                            header: [1, 2, 3, false]
                        }],
                        ['bold', 'italic', 'underline'],
                        ['link'],
                        [{
                            list: 'ordered'
                        }, {
                            list: 'bullet'
                        }],
                        ['clean']
                    ]
                }
            });

            // ✅ Paste: plain text only (extra tag/formatting আসবে না)
            quill.clipboard.addMatcher(Node.ELEMENT_NODE, function(node, delta) {
                const text = node.innerText || '';
                return {
                    ops: [{
                        insert: text
                    }]
                };
            });

            function clearErrors() {
                $('.error-text').text('');
                $('#aboutSectionForm .is-invalid').removeClass('is-invalid');
            }

            function showFieldErrors(errors) {
                $.each(errors, function(field, messages) {
                    const msg = messages?.[0] ?? 'Invalid';

                    const $err = $(`[data-error-for="${field}"]`);
                    if ($err.length) {
                        $err.text(msg);
                    } else {
                        // fallback
                        $(`[data-error-for="${field.split('.')[0]}"]`).text(msg);
                    }

                    if (field.startsWith('skills.')) {
                        const index = parseInt(field.split('.')[1], 10);
                        const $input = $('#skillsWrapper input[name="skills[]"]').eq(index);
                        $input.addClass('is-invalid');
                    } else {
                        $(`#aboutSectionForm [name="${field}"]`).addClass('is-invalid');
                    }
                });
            }

            // ✅ Quill content -> hidden textarea
            function syncQuillToForm() {
                let html = quill.root.innerHTML;

                // Empty check: Quill empty হলে "<p><br></p>" থাকে
                const plain = quill.getText().trim();
                if (!plain) {
                    html = '';
                }

                $('#description').val(html);
            }

            $('#aboutSectionForm').on('submit', function(e) {
                e.preventDefault();

                clearErrors();

                syncQuillToForm();

                let formData = new FormData(this);

                let $btn = $('#aboutSubmitBtn');
                $btn.prop('disabled', true);
                $('#aboutBtnText').text('Processing...');
                $('#aboutBtnSpinner').removeClass('d-none');

                $.ajax({
                    url: "{{ route('admin.about.section.update') }}",
                    type: "POST", // @method('PUT') থাকলে POST OK
                    data: formData,
                    processData: false,
                    contentType: false,

                    success: function(response) {
                        $btn.prop('disabled', false);
                        $('#aboutBtnText').text('Submit');
                        $('#aboutBtnSpinner').addClass('d-none');

                        if (response.status === 'success') {
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message || 'Something went wrong!');
                        }
                    },

                    error: function(xhr) {
                        $btn.prop('disabled', false);
                        $('#aboutBtnText').text('Submit');
                        $('#aboutBtnSpinner').addClass('d-none');

                        if (xhr.status === 422 && xhr.responseJSON?.errors) {
                            showFieldErrors(xhr.responseJSON.errors);
                        } else {
                            toastr.error(xhr.responseJSON?.message || 'Something went wrong!');
                        }
                    }
                });
            });

            // ---- skills repeater same as yours ----
            function rebuildSkillErrorSlots() {
                $('#skillsWrapper .skill-row').each(function(index) {
                    let $err = $(this).next('.error-text');
                    if ($err.length) {
                        $err.attr('data-error-for', 'skills.' + index);
                    } else {
                        $(this).after(
                            '<small class="text-danger error-text d-block" data-error-for="skills.' +
                            index + '"></small>');
                    }
                });
            }

            $('#addSkillBtn').on('click', function() {
                $('#skillsWrapper').append(`
            <div class="skill-row mb-2 d-flex gap-2">
                <input type="text" name="skills[]" class="form-control" placeholder="e.g. Performance Optimization">
                <button type="button" class="btn btn-outline-danger remove-skill">Remove</button>
            </div>
            <small class="text-danger error-text d-block"></small>
        `);
                rebuildSkillErrorSlots();
            });

            $(document).on('click', '.remove-skill', function() {
                $(this).closest('.skill-row').next('.error-text').remove();
                $(this).closest('.skill-row').remove();
                rebuildSkillErrorSlots();
            });

        });
    </script>
@endpush
