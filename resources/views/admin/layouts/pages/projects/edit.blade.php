@extends('admin.layouts.app')
@section('title', 'Edit Project')

@section('admin_content')
<div class="page-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="">Edit Project</h5>
                        <a href="{{ route('admin.project.index') }}" class="btn btn-outline-primary px-5 rounded-0">
                            All Projects
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form id="projectEditForm">
                        @csrf
                        @method('PUT') {{-- method spoofing for PUT route [web:203] --}}

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Project Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="project_title"
                                       value="{{ $project->project_title }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Icon Class</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="icon_class"
                                       value="{{ $project->icon_class }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="description" rows="4">{{ $project->description }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Project Url (Optional)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="project_url"
                                       value="{{ $project->project_url }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Tools</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="tools" rows="3">{{ $project->tools }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Sort Order</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="sort_order"
                                       value="{{ $project->sort_order }}" min="0">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="status">
                                    <option value="1" @selected($project->status == 1)>Active</option>
                                    <option value="0" @selected($project->status == 0)>DeActive</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-md-9">
                                <div class="d-flex justify-content-end align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-5 rounded-0" id="submitBtn">
                                        <span id="btnText">Update</span>
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

    $("#projectEditForm").on("submit", function(e){
        e.preventDefault();

        let formData = new FormData(this);

        $('#btnText').text('Processing...');
        $('#btnSpinner').removeClass('d-none');
        $('#submitBtn').prop('disabled', true);

        $.ajax({
            url: "{{ route('admin.project.update', $project->id) }}",
            type: "POST", // method spoof via @method('PUT') [web:203]
            data: formData,
            contentType: false,
            processData: false,

            success: function(response){
                if(response.status === 'success'){
                    toastr.success(response.message);
                    if(response.action_url){
                        setTimeout(() => window.location.href = response.action_url, 800);
                    }
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
                $('#btnText').text('Update');
                $('#btnSpinner').addClass('d-none');
                $('#submitBtn').prop('disabled', false);
            }
        });

    });

});
</script>
@endpush
