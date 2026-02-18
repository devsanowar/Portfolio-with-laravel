@extends('admin.layouts.app')
@section('title', 'Add Service')
@push('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush

@section('admin_content')
<div class="page-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="">Add Service</h5>
                        <a href="{{ route('admin.services.index') }}" class="btn btn-outline-primary px-5 rounded-0">
                            All Services
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form id="addServiceForm">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Service Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="service_name"
                                    placeholder="Enter Service Name">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Service Slug</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="service_slug"
                                    placeholder="auto-generate / optional">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Icon Class</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="icon_class" placeholder="e.g. bx bx-cog">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Short Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="short_description" rows="2"
                                    placeholder="Short summary"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Long Description</label>
                            <div class="col-sm-9">
                                <div id="editor" style="height: 220px;"></div>
                                <input type="hidden" name="long_description" id="long_description">
                            </div>
                        </div>

                        {{-- Features --}}
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Features</label>
                            <div class="col-sm-9">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <small class="text-muted">Add multiple features (one per input)</small>
                                    <button type="button" class="btn btn-outline-primary btn-sm rounded-0"
                                        id="addFeatureBtn">
                                        + Add
                                    </button>
                                </div>

                                <div id="featuresWrapper">
                                    <div class="input-group mb-2 feature-row">
                                        <input type="text" class="form-control feature-input"
                                            placeholder="e.g. Free Consultation">
                                        <button type="button"
                                            class="btn btn-outline-danger rounded-0 removeFeatureBtn">Delete</button>
                                    </div>
                                </div>

                                {{-- This hidden field will be submitted to DB --}}
                                <input type="hidden" name="features" id="features">
                            </div>
                        </div>


                        <div class="row mb-3 mt-5">
                            <label class="col-sm-3 col-form-label">Delivery Time</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="delivery_time"
                                    placeholder="e.g. 3 Days (optional)">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Complete Project</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="complete_project"
                                    placeholder="e.g. 120+ (optional)">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Rating</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="rating" placeholder="e.g. 4.9 (optional)">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Button One</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="button_one"
                                    placeholder="Button text (optional)">
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="button_one_url"
                                    placeholder="Button url (optional)">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Button Two</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="button_two"
                                    placeholder="Button text (optional)">
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="button_two_url"
                                    placeholder="Button url (optional)">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Sort Order</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="sort_order" value="0">
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
                                        <span id="btnSpinner"
                                            class="spinner-border spinner-border-sm d-none ms-2"></span>
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
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    function syncFeaturesToHidden() {
            let items = [];
            $('#featuresWrapper .feature-input').each(function() {
                let val = $(this).val().trim();
                if (val !== '') items.push(val);
            });
            $('#features').val(JSON.stringify(items));
        }

        function addFeatureRow(value = '') {
            let row = `
            <div class="input-group mb-2 feature-row">
                <input type="text" class="form-control feature-input" placeholder="e.g. Free Consultation" value="${value}">
                <button type="button" class="btn btn-outline-danger rounded-0 removeFeatureBtn">Delete</button>
            </div>
        `;
            $('#featuresWrapper').append(row);
        }

        // Add new row
        $(document).on('click', '#addFeatureBtn', function() {
            addFeatureRow('');
        });

        // Remove row
        $(document).on('click', '.removeFeatureBtn', function() {
            $(this).closest('.feature-row').remove();

            // Ensure at least 1 row exists
            if ($('#featuresWrapper .feature-row').length === 0) {
                addFeatureRow('');
            }

            syncFeaturesToHidden();
        });

        // Sync on typing
        $(document).on('input', '.feature-input', function() {
            syncFeaturesToHidden();
        });
</script>
<script>
    var quill = new Quill('#editor', {
            theme: 'snow'
        });

        $("#addServiceForm").on('submit', function(e) {
            e.preventDefault();

            $('#long_description').val(quill.root.innerHTML);

            let formData = new FormData(this);

            $('#btnText').text('Processing...');
            $('#btnSpinner').removeClass('d-none');
            $('#submitBtn').prop('disabled', true);

            $.ajax({
                url: "{{ route('admin.services.store') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $("#addServiceForm")[0].reset();
                    quill.setText('');

                    if (response.status === 'success') {
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message ?? 'Something went wrong!');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            toastr.error(value[0]);
                        });
                    } else {
                        toastr.error('An unexpected error occurred. Please try again.');
                    }
                },
                complete: function() {
                    $('#btnText').text('Submit');
                    $('#btnSpinner').addClass('d-none');
                    $('#submitBtn').prop('disabled', false);
                }
            });
        });
</script>
@endpush
