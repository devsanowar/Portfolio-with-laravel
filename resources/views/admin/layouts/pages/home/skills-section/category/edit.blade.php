@extends('admin.dashboard')
@section('title', 'Edit Skills Category')

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
                                        <div class="tab-title">Edit Skill Category</div>
                                    </div>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.skills.category.index') }}"
                                    class="btn btn-outline-primary px-5 rounded-0">
                                    All Category
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="skill-section-tab" role="tabpanel">

                                <form id="categorySkillsForm" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    {{-- Title --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Skill Category Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class='bx bx-badge-check'></i></span>
                                            <input type="text" name="title" class="form-control"
                                                value="{{ old('title', $category->title) }}"
                                                placeholder="e.g. Frontend, Backend, CMS">
                                        </div>
                                        <small class="text-danger error-text" data-error-for="title"></small>
                                    </div>

                                    {{-- Icon (Boxicons class) --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Icon (Boxicons Class)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class='bx bx-palette'></i></span>
                                            <input type="text" name="icon" class="form-control"
                                                value="{{ old('icon', $category->icon) }}"
                                                placeholder="e.g. bx bx-code-alt (or bx bxl-wordpress)">
                                        </div>

                                        <small class="text-muted d-block mt-1">
                                            Example: <code>bx bx-code-alt</code>, <code>bx bx-server</code>, <code>bx
                                                bxl-wordpress</code>
                                        </small>

                                        {{-- Preview (optional) --}}
                                        @if (!empty($category->icon))
                                            <div class="mt-2">
                                                <span class="text-muted">Preview:</span>
                                                <i class="{{ $category->icon }}"
                                                    style="font-size:22px; margin-left:6px;"></i>
                                            </div>
                                        @endif

                                        <small class="text-danger error-text" data-error-for="icon"></small>
                                    </div>

                                    {{-- Description --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Description</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class='bx bx-edit'></i></span>
                                            <textarea name="description" class="form-control" rows="4" placeholder="Write short description...">{{ old('description', $category->description) }}</textarea>
                                        </div>
                                        <small class="text-danger error-text" data-error-for="description"></small>
                                    </div>

                                    <div class="row">
                                        {{-- Sort Order --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Sort Order</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class='bx bx-sort'></i></span>
                                                <input type="number" name="sort_order" class="form-control"
                                                    value="{{ old('sort_order', $category->sort_order ?? 0) }}"
                                                    placeholder="0" min="0">
                                            </div>
                                            <small class="text-danger error-text" data-error-for="sort_order"></small>
                                        </div>

                                        {{-- Status --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Status</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class='bx bx-toggle-left'></i></span>
                                                <select name="status" class="form-control">
                                                    <option value="0"
                                                        {{ (string) old('status', $category->status) === '0' ? 'selected' : '' }}>
                                                        Inactive</option>
                                                    <option value="1"
                                                        {{ (string) old('status', $category->status) === '1' ? 'selected' : '' }}>
                                                        Active</option>
                                                </select>
                                            </div>
                                            <small class="text-danger error-text" data-error-for="status"></small>
                                        </div>
                                    </div>

                                    {{-- Submit --}}
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary" id="skillSubmitBtn">
                                            <span id="skillBtnText">Update Category</span>
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
                $('#categorySkillsForm .is-invalid').removeClass('is-invalid');
            }

            function showFieldErrors(errors) {
                $.each(errors, function(field, messages) {
                    const msg = messages?.[0] ?? 'Invalid';
                    $(`[data-error-for="${field}"]`).text(msg);
                    $(`#categorySkillsForm [name="${field}"]`).addClass('is-invalid');
                });
            }

            $('#categorySkillsForm').on('submit', function(e) {
                e.preventDefault();
                clearErrors();

                const form = this;
                const formData = new FormData(form);

                let $btn = $('#skillSubmitBtn');
                let $btnText = $('#skillBtnText');
                let $btnSpinner = $('#skillBtnSpinner');

                $btn.prop('disabled', true);
                $btnText.text('Processing...');
                $btnSpinner.removeClass('d-none');

                $.ajax({
                    url: "{{ route('admin.skills.category.update', $category->id) }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,

                    success: function(response) {
                        $btn.prop('disabled', false);
                        $btnText.text('Update Category');
                        $btnSpinner.addClass('d-none');

                        if (response.status === 'success') {
                            toastr.success(response.message ||
                            'Category updated successfully.');
                        } else {
                            toastr.error(response.message || 'An error occurred.');
                        }
                    },

                    error: function(xhr) {
                        $btn.prop('disabled', false);
                        $btnText.text('Update Category');
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
