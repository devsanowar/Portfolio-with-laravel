@extends('admin.layouts.app')
@section('title', 'Edit CTA')

@section('admin_content')
<div class="page-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="">Edit CTA</h5>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form id="ctaEditForm" method="POST">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="title"
                                       value="{{ $cta->title ?? '' }}">
                                <small class="text-danger error-text" data-error-for="title"></small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="description" rows="4">{{ $cta->description ?? '' }}</textarea>
                                <small class="text-danger error-text" data-error-for="description"></small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Button One</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="button_one_name"
                                       value="{{ $cta->button_one_name ?? '' }}" placeholder="Name (optional)">
                                <small class="text-danger error-text" data-error-for="button_one_name"></small>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="button_one_url"
                                       value="{{ $cta->button_one_url ?? '' }}" placeholder="URL (optional)">
                                <small class="text-danger error-text" data-error-for="button_one_url"></small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Button Two</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="button_two_name"
                                       value="{{ $cta->button_two_name ?? '' }}" placeholder="Name (optional)">
                                <small class="text-danger error-text" data-error-for="button_two_name"></small>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="button_two_url"
                                       value="{{ $cta->button_two_url ?? '' }}" placeholder="URL (optional)">
                                <small class="text-danger error-text" data-error-for="button_two_url"></small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="status">
                                    <option value="1" @selected(($cta?->status ?? 0) == 1)>Active</option>
                                    <option value="0" @selected(($cta?->status ?? 0) == 0)>Inactive</option>
                                </select>

                                <small class="text-danger error-text" data-error-for="status"></small>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-md-9">
                                <button type="submit" class="btn btn-primary px-5 rounded-0" id="submitBtn">
                                    <span id="btnText">Update</span>
                                    <span id="btnSpinner" class="spinner-border spinner-border-sm d-none ms-2"></span>
                                </button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {

    function clearErrors() {
        $('.error-text').text('');
        $('#ctaEditForm .is-invalid').removeClass('is-invalid');
    }

    function showFieldErrors(errors) {
        $.each(errors, function(field, messages) {
            const msg = messages?.[0] ?? 'Invalid';
            const $err = $(`[data-error-for="${field}"]`);
            if ($err.length) $err.text(msg);
            $(`#ctaEditForm [name="${field}"]`).addClass('is-invalid');
        });
    }

    $('#ctaEditForm').on('submit', function(e){
        e.preventDefault();
        clearErrors();

        let formData = new FormData(this);

        $('#btnText').text('Processing...');
        $('#btnSpinner').removeClass('d-none');
        $('#submitBtn').prop('disabled', true);

        $.ajax({
            url: "{{ route('admin.cta.save') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(res){
                if(res.status === 'success'){
                    toastr.success(res.message);
                } else {
                    toastr.error(res.message ?? 'Something went wrong!');
                }
            },
            error: function(xhr){
                if(xhr.status === 422 && xhr.responseJSON?.errors){
                    showFieldErrors(xhr.responseJSON.errors);
                } else {
                    toastr.error(xhr.responseJSON?.message ?? 'An unexpected error occurred.');
                }
            },
            complete: function(){
                $('#btnText').text('Update');
                $('#btnSpinner').addClass('d-none');
                $('#submitBtn').prop('disabled', false);
            }
        });
    });

});
</script>
@endpush
