@extends('admin.dashboard')
@section('title', 'Edit Key Feature')

@section('admin_content')
<div class="page-content">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">

                    <!-- Tabs -->
                    <ul class="nav nav-pills mb-3 d-flex justify-content-between" role="tablist">
                        <li class="nav-item d-flex" role="presentation">
                            <a class="nav-link active" data-bs-toggle="pill" href="#key-feature-tab" role="tab"
                                aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-star font-18 me-1'></i></div>
                                    <div class="tab-title">Edit Key Feature</div>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.key-feature.index') }}" class="btn btn-outline-primary px-5 rounded-0">
                                All Key Features
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="key-feature-tab" role="tabpanel">

                            <form id="keyFeatureForm" method="POST">
                                @csrf
                                @method('PUT')

                                {{-- Title --}}
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Title</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class='bx bx-edit'></i></span>
                                        <input type="text" name="title" class="form-control" value="{{ old('title', $feature->title) }}" placeholder="Enter Feature Title">
                                    </div>
                                    <small class="text-danger error-text" data-error-for="title"></small>
                                </div>

                                {{-- Icon --}}
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Icon</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class='bx bx-image'></i></span>
                                        <input type="text" name="icon" class="form-control" value="{{ old('icon', $feature->icon) }}" placeholder="Enter icon class (optional)">
                                    </div>
                                    <small class="text-muted">Example: fa-solid fa-star</small>
                                    <small class="text-danger error-text" data-error-for="icon"></small>
                                </div>

                                {{-- Description --}}
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Description</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class='bx bx-edit'></i></span>
                                        <textarea name="description" class="form-control" rows="4" placeholder="Write short description...">{{ old('description', $feature->description) }}</textarea>
                                    </div>
                                    <small class="text-danger error-text" data-error-for="description"></small>
                                </div>

                                {{-- Sort Order --}}
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Sort Order (optional)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class='bx bx-sort'></i></span>
                                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $feature->sort_order) }}" placeholder="0" min="0">
                                    </div>
                                    <small class="text-danger error-text" data-error-for="sort_order"></small>
                                </div>

                                {{-- Status --}}
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Status</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class='bx bx-toggle-left'></i></span>
                                        <select name="status" class="form-control">
                                            <option value="1" {{ old('status', $feature->status) == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('status', $feature->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                    <small class="text-danger error-text" data-error-for="status"></small>
                                </div>

                                {{-- Submit --}}
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary" id="keyFeatureSubmitBtn">
                                        <span id="keyFeatureBtnText">Update Key Feature</span>
                                        <span id="keyFeatureBtnSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div><!-- /tab-content -->

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {

    function clearErrors() {
        $('.error-text').text('');
        $('#keyFeatureForm .is-invalid').removeClass('is-invalid');
    }

    function showFieldErrors(errors) {
        $.each(errors, function(field, messages) {
            const msg = messages?.[0] ?? 'Invalid';
            const $err = $(`[data-error-for="${field}"]`);
            if ($err.length) $err.text(msg);
            $(`#keyFeatureForm [name="${field}"]`).addClass('is-invalid');
        });
    }

    $('#keyFeatureForm').on('submit', function(e) {
        e.preventDefault();
        clearErrors();

        let form = this;
        let formData = new FormData(form);

        let $btn = $('#keyFeatureSubmitBtn');
        let $btnText = $('#keyFeatureBtnText');
        let $btnSpinner = $('#keyFeatureBtnSpinner');

        $btn.prop('disabled', true);
        $btnText.text('Processing...');
        $btnSpinner.removeClass('d-none');

        $.ajax({
            url: "{{ route('admin.key-feature.update', $feature->id) }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,

            success: function(response) {
                $btn.prop('disabled', false);
                $btnText.text('Update Key Feature');
                $btnSpinner.addClass('d-none');

                if (response.status === 'success') {
                    setTimeout(function() {
                        window.location.href = response.action_url;
                    }, 1000);
                    toastr.success(response.message || 'Key Feature updated successfully.');
                } else {
                    toastr.error(response.message || 'Something went wrong.');
                }
            },

            error: function(xhr) {
                $btn.prop('disabled', false);
                $btnText.text('Update Key Feature');
                $btnSpinner.addClass('d-none');

                if (xhr.status === 422 && xhr.responseJSON?.errors) {
                    showFieldErrors(xhr.responseJSON.errors);
                } else {
                    toastr.error(xhr.responseJSON?.message || 'Something went wrong!');
                }
            }
        });
    });

});
</script>
@endpush
