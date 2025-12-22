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
                                                value="{{ $heroSection->title ?? '' }}" placeholder="Enter hero title">
                                        </div>
                                        <div class="invalid-feedback d-block" data-error-for="title"></div>
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
                                        <div class="invalid-feedback d-block" data-error-for="sub_title"></div>
                                    </div>

                                    {{-- Description --}}
                                    <div class="col-md-12 mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class='bx bx-edit'></i></span>
                                            <textarea name="description" class="form-control" id="description" rows="4"
                                                placeholder="Short description for hero section...">{{ $heroSection->description ?? '' }}</textarea>
                                        </div>
                                        <div class="invalid-feedback d-block" data-error-for="description"></div>
                                    </div>

                                    <hr class="my-4">

                                    {{-- Social Links --}}
                                    <div class="col-md-12 mb-3">
                                        <label for="github_url" class="form-label">GitHub URL</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class='bx bxl-github'></i></span>
                                            <input type="url" name="github_url" class="form-control" id="github_url"
                                                value="{{ $heroSection->github_url ?? '' }}"
                                                placeholder="https://github.com/username">
                                        </div>
                                        <div class="invalid-feedback d-block" data-error-for="github_url"></div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="facebook_url" class="form-label">Facebook URL</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class='bx bxl-facebook'></i></span>
                                            <input type="url" name="facebook_url" class="form-control" id="facebook_url"
                                                value="{{ $heroSection->facebook_url ?? '' }}"
                                                placeholder="https://facebook.com/username">
                                        </div>
                                        <div class="invalid-feedback d-block" data-error-for="facebook_url"></div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="instagram_url" class="form-label">Instagram URL</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class='bx bxl-instagram'></i></span>
                                            <input type="url" name="instagram_url" class="form-control"
                                                id="instagram_url" value="{{ $heroSection->instagram_url ?? '' }}"
                                                placeholder="https://instagram.com/username">
                                        </div>
                                        <div class="invalid-feedback d-block" data-error-for="instagram_url"></div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="linkedin_url" class="form-label">LinkedIn URL</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class='bx bxl-linkedin'></i></span>
                                            <input type="url" name="linkedin_url" class="form-control"
                                                id="linkedin_url" value="{{ $heroSection->linkedin_url ?? '' }}"
                                                placeholder="https://linkedin.com/in/username">
                                        </div>
                                        <div class="invalid-feedback d-block" data-error-for="linkedin_url"></div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="pinterest_url" class="form-label">Pinterest URL</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class='bx bxl-pinterest'></i></span>
                                            <input type="url" name="pinterest_url" class="form-control"
                                                id="pinterest_url" value="{{ $heroSection->pinterest_url ?? '' }}"
                                                placeholder="https://pinterest.com/username">
                                        </div>
                                        <div class="invalid-feedback d-block" data-error-for="pinterest_url"></div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="medium_url" class="form-label">Medium URL</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class='bx bxl-medium'></i></span>
                                            <input type="url" name="medium_url" class="form-control" id="medium_url"
                                                value="{{ $heroSection->medium_url ?? '' }}"
                                                placeholder="https://medium.com/@username">
                                        </div>
                                        <div class="invalid-feedback d-block" data-error-for="medium_url"></div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="dribble_url" class="form-label">Dribbble URL</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class='bx bxl-dribbble'></i></span>
                                            <input type="url" name="dribble_url" class="form-control"
                                                id="dribble_url" value="{{ $heroSection->dribble_url ?? '' }}"
                                                placeholder="https://dribbble.com/username">
                                        </div>
                                        <div class="invalid-feedback d-block" data-error-for="dribble_url"></div>
                                    </div>



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

    function clearHeroErrors() {
        // remove invalid style
        $('#heroSectionForm .is-invalid').removeClass('is-invalid');

        // clear messages
        $('#heroSectionForm [data-error-for]').text('');
    }

    function showHeroErrors(errors) {
        // errors = { field: ["msg1", ...], ... }
        $.each(errors, function (field, messages) {
            const $field = $('#heroSectionForm [name="' + field + '"]');

            // add red border to input/textarea
            $field.addClass('is-invalid');

            // show message under field
            $('#heroSectionForm [data-error-for="' + field + '"]').text(messages[0]);
        });
    }

    $('#heroSectionForm').on('submit', function (e) {
        e.preventDefault();

        clearHeroErrors();

        let form = this;
        let formData = new FormData(form);

        let $submitBtn   = $('#heroSubmitBtn');
        let $btnText     = $('#heroBtnText');
        let $btnSpinner  = $('#heroBtnSpinner');

        $submitBtn.prop('disabled', true);
        $btnText.text('Processing...');
        $btnSpinner.removeClass('d-none');

        $.ajax({
            url: "{{ route('admin.hero.section.update') }}",
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
                } else {
                    toastr.error(response.message || 'An error occurred.');
                }
            },
            error: function (xhr) {
                $submitBtn.prop('disabled', false);
                $btnText.text('Submit');
                $btnSpinner.addClass('d-none');

                if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                    showHeroErrors(xhr.responseJSON.errors);
                } else {
                    toastr.error(xhr.responseJSON?.message || 'Something went wrong!');
                }
            }
        });
    });
});
</script>

@endpush
