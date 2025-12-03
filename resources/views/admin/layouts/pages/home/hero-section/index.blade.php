@extends('admin.dashboard')
@section('title', 'Hero Section Settings')

@section('admin_content')
<div class="page-content">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">

                    {{-- Nav Pills (একটা ট্যাবই রাখা হলো) --}}
                    <ul class="nav nav-pills mb-3" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="pill" href="#primary-pills-hero-section"
                               role="tab" aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-image font-18 me-1'></i></div>
                                    <div class="tab-title">Hero Section</div>
                                </div>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="primary-pills-hero-section" role="tabpanel">
                            <form id="heroSectionForm" method="POST">
                                @csrf
                                @method('PUT')

                                {{-- Title --}}
                                <div class="col-md-12 mb-3">
                                    <label for="title" class="form-label">Hero Title</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class='bx bx-font'></i></span>
                                        <input type="text" name="title" class="form-control" id="title"
                                               value="{{ $heroSection->title ?? '' }}"
                                               placeholder="Enter hero title">
                                    </div>
                                </div>

                                {{-- Sub Title --}}
                                <div class="col-md-12 mb-3">
                                    <label for="sub_title" class="form-label">Hero Sub Title</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class='bx bx-text'></i></span>
                                        <input type="text" name="sub_title" class="form-control" id="sub_title"
                                               value="{{ $heroSection->sub_title ?? '' }}"
                                               placeholder="Enter hero sub title">
                                    </div>
                                </div>

                                {{-- Description --}}
                                <div class="col-md-12 mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class='bx bx-edit'></i></span>
                                        <textarea name="description" class="form-control" id="description" rows="4"
                                                  placeholder="Short description for hero section...">{{ $heroSection->description ?? '' }}</textarea>
                                    </div>
                                </div>

                                {{-- Hero Image --}}
                                <div class="col-md-12 mb-3">
                                    <label for="image" class="form-label">Hero Image</label>
                                    <input class="form-control" type="file" name="image" id="image">

                                    @if($heroSection && $heroSection->image)
                                        <img id="preview_hero_image"
                                             src="{{ asset($heroSection->image) }}" alt="hero image"
                                             class="mt-2" width="150">
                                    @endif
                                </div>

                                {{-- PDF File --}}
                                <div class="col-md-12 mb-3">
                                    <label for="pdf" class="form-label">PDF (optional)</label>
                                    <input class="form-control" type="file" name="pdf" id="pdf">

                                    @if($heroSection && $heroSection->pdf)
                                        <a id="preview_hero_pdf" href="{{ asset($heroSection->pdf) }}" target="_blank"
                                           class="d-block mt-2">
                                            <i class="bx bxs-file-pdf"></i> View Current PDF
                                        </a>
                                    @endif
                                </div>

                                {{-- Button One Text --}}
                                <div class="col-md-12 mb-3">
                                    <label for="button_text" class="form-label">Button One Text</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class='bx bx-text'></i></span>
                                        <input type="text" name="button_text" class="form-control" id="button_text"
                                               value="{{ $heroSection->button_text ?? '' }}"
                                               placeholder="e.g. Get a Quote">
                                    </div>
                                </div>

                                {{-- Button One URL --}}
                                <div class="col-md-12 mb-3">
                                    <label for="button_url" class="form-label">Button One URL</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class='bx bx-link'></i></span>
                                        <input type="text" name="button_url" class="form-control" id="button_url"
                                               value="{{ $heroSection->button_url ?? '' }}"
                                               placeholder="https://yoursite.com/contact">
                                    </div>
                                </div>

                                {{-- Button Two Text --}}
                                <div class="col-md-12 mb-3">
                                    <label for="button_text_two" class="form-label">Button Two Text (optional)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class='bx bx-text'></i></span>
                                        <input type="text" name="button_text_two" class="form-control" id="button_text_two"
                                               value="{{ $heroSection->button_text_two ?? '' }}"
                                               placeholder="e.g. Learn More">
                                    </div>
                                </div>

                                {{-- Button Two URL --}}
                                {{-- <div class="col-md-12 mb-3">
                                    <label for="button_url_two" class="form-label">Button Two URL (optional)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class='bx bx-link'></i></span>
                                        <input type="text" name="button_url_two" class="form-control" id="button_url_two"
                                               value="{{ $heroSection->button_url_two ?? '' }}"
                                               placeholder="https://yoursite.com/services">
                                    </div>
                                </div> --}}

                                {{-- Submit --}}
                                <div class="col-md-12">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        <button type="submit" class="btn btn-primary" id="heroSubmitBtn">
                                            <span id="heroBtnText">Submit</span>
                                            <span id="heroBtnSpinner" class="spinner-border spinner-border-sm d-none"
                                                  role="status" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div> {{-- /tab-pane --}}
                    </div> {{-- /tab-content --}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#heroSectionForm').on('submit', function (e) {
            e.preventDefault();

            let form = this;
            let formData = new FormData(form);

            let $submitBtn   = $('#heroSubmitBtn');
            let $btnText     = $('#heroBtnText');
            let $btnSpinner  = $('#heroBtnSpinner');

            $submitBtn.prop('disabled', true);
            $btnText.text('Processing...');
            $btnSpinner.removeClass('d-none');

            $.ajax({
                url: "{{ route('admin.hero.section.update') }}", // 👉 তোমার hero update route
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $submitBtn.prop('disabled', false);
                    $btnText.text('Submit');
                    $btnSpinner.addClass('d-none');

                    if (response.status === 'success') {
                        toastr.success(response.message || 'Hero section updated successfully.');

                        if (response.data) {
                            if (response.data.image) {
                                $('#preview_hero_image').attr('src', response.data.image + '?t=' + new Date().getTime());
                            }
                            if (response.data.pdf) {
                                $('#preview_hero_pdf')
                                    .attr('href', response.data.pdf + '?t=' + new Date().getTime())
                                    .removeClass('d-none');
                            }
                        }
                    } else {
                        toastr.error(response.message || 'An error occurred.');
                    }
                },
                error: function (xhr) {
                    $submitBtn.prop('disabled', false);
                    $btnText.text('Submit');
                    $btnSpinner.addClass('d-none');

                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        $.each(xhr.responseJSON.errors, function (key, messages) {
                            toastr.error(messages[0]);
                        });
                    } else {
                        toastr.error(xhr.responseJSON?.message || 'Something went wrong!');
                    }
                }
            });
        });
    });
</script>
@endpush
