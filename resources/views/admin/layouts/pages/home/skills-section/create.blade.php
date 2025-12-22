@extends('admin.dashboard')
@section('title', 'Skills')

@section('admin_content')
    <div class="page-content">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        <!-- Tabs -->
                        <ul class="nav nav-pills mb-3 d-flex justify-content-between" role="tablist">
                            <li class="nav-item d-flex" role="presentation">
                                <a class="nav-link active" data-bs-toggle="pill" href="#skill-section-tab" role="tab"
                                    aria-selected="true">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon"><i class='bx bx-bar-chart-alt-2 font-18 me-1'></i></div>
                                        <div class="tab-title">Create Skill</div>
                                    </div>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.skills.index') }}" class="btn btn-outline-primary px-5 rounded-0">
                                    All Skills
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="skill-section-tab" role="tabpanel">

                                <form id="skillCreateForm" method="POST">
                                    @csrf

                                    {{-- Category --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Category</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class='bx bx-category'></i></span>
                                            <select name="skill_category_id" class="form-control">
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <small class="text-danger error-text" data-error-for="skill_category_id"></small>
                                    </div>

                                    {{-- Skill Name --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Skill Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class='bx bx-badge-check'></i></span>
                                            <input type="text" name="name" class="form-control"
                                                placeholder="e.g. Laravel, HTML5, WordPress">
                                        </div>
                                        <small class="text-danger error-text" data-error-for="name"></small>
                                    </div>

                                    {{-- Percentage --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Skill Value (in %)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class='bx bx-trending-up'></i></span>
                                            <input type="number" name="percentage" class="form-control"
                                                placeholder="0 - 100" min="0" max="100">
                                        </div>
                                        <small class="text-danger error-text" data-error-for="percentage"></small>
                                    </div>

                                    {{-- Sort Order (optional) --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Sort Order (optional)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class='bx bx-sort'></i></span>
                                            <input type="number" name="sort_order" class="form-control" placeholder="0"
                                                min="0" value="0">
                                        </div>
                                        <small class="text-danger error-text" data-error-for="sort_order"></small>
                                    </div>

                                    {{-- Status --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Status</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class='bx bx-toggle-left'></i></span>
                                            <select name="status" class="form-control">
                                                <option value="1" selected>Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                        <small class="text-danger error-text" data-error-for="status"></small>
                                    </div>

                                    {{-- Submit --}}
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary" id="skillSubmitBtn">
                                            <span id="skillBtnText">Create Skill</span>
                                            <span id="skillBtnSpinner" class="spinner-border spinner-border-sm d-none"
                                                role="status" aria-hidden="true"></span>
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
                $('#skillCreateForm .is-invalid').removeClass('is-invalid');
            }

            function showFieldErrors(errors) {
                $.each(errors, function(field, messages) {
                    const msg = messages?.[0] ?? 'Invalid';

                    const $err = $(`[data-error-for="${field}"]`);
                    if ($err.length) $err.text(msg);

                    $(`#skillCreateForm [name="${field}"]`).addClass('is-invalid');
                });
            }

            $('#skillCreateForm').on('submit', function(e) {
                e.preventDefault();

                clearErrors();

                let form = this;
                let formData = new FormData(form);

                let $btn = $('#skillSubmitBtn');
                let $btnText = $('#skillBtnText');
                let $btnSpinner = $('#skillBtnSpinner');

                $btn.prop('disabled', true);
                $btnText.text('Processing...');
                $btnSpinner.removeClass('d-none');

                $.ajax({
                    url: "{{ route('admin.skills.store') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,

                    success: function(response) {
                        $btn.prop('disabled', false);
                        $btnText.text('Create Skill');
                        $btnSpinner.addClass('d-none');

                        if (response.status === 'success') {
                            toastr.success(response.message || 'Skill created successfully.');
                            form.reset();
                        } else {
                            toastr.error(response.message || 'An error occurred.');
                        }
                    },

                    error: function(xhr) {
                        $btn.prop('disabled', false);
                        $btnText.text('Create Skill');
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
