@extends('admin.layouts.app')
@section('title', 'Add Project')

@section('admin_content')
<div class="page-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="">Add Project</h5>
                        <a href="{{ route('admin.project.index') }}" class="btn btn-outline-primary px-5 rounded-0">
                            All Projects
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form id="projectCreateForm">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Project Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="project_title" placeholder="Enter Project Title">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Icon Class</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="icon_class" placeholder="e.g. bx bx-code">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="description" rows="4" placeholder="Write description..."></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Project Url (Optional)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="project_url" placeholder="e.g. example.com">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Tools</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="tools" rows="3" placeholder="Example: Laravel, Vue, MySQL"></textarea>
                                <small class="text-muted">Comma separated</small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Sort Order</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="sort_order" value="0" min="0">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="status">
                                    <option value="1">Active</option>
                                    <option value="0" selected>DeActive</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-md-9">
                                <div class="d-flex justify-content-end align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-5 rounded-0" id="submitBtn">
                                        <span id="btnText">Submit</span>
                                        <span id="btnSpinner" class="spinner-border spinner-border-sm d-none ms-2"></span>
                                    </button>
                                </div>
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
$(document).ready(function(){

    $("#projectCreateForm").on("submit", function(e){
        e.preventDefault();

        let formData = new FormData(this);

        $('#btnText').text('Processing...');
        $('#btnSpinner').removeClass('d-none');
        $('#submitBtn').prop('disabled', true);

        $.ajax({
            url: "{{ route('admin.project.store') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,

            success: function(response){
                $("#projectCreateForm")[0].reset();
                if(response.status === 'success'){
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message ?? 'Something went wrong!');
                }
            },

            error: function(xhr){
                if(xhr.status === 422){
                    $.each(xhr.responseJSON.errors, function(key, value){
                        toastr.error(value[0]);
                    });
                } else {
                    toastr.error('An unexpected error occurred. Please try again.');
                }
            },

            complete: function(){
                $('#btnText').text('Submit');
                $('#btnSpinner').addClass('d-none');
                $('#submitBtn').prop('disabled', false);
            }
        });

    });

});
</script>
@endpush
