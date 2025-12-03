@extends('admin.dashboard')
@section('title', 'Edit Skill')

@section('admin_content')
<div class="page-content">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">

                    <!-- Tabs -->
                    <ul class="nav nav-pills mb-3" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="pill" href="#skill-section-tab"
                               role="tab" aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-bar-chart-alt-2 font-18 me-1'></i></div>
                                    <div class="tab-title">Update Skill</div>
                                </div>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="skill-section-tab" role="tabpanel">

                            <form id="skillUpdateForm" method="POST">
                                @csrf
                                @method('PUT')

                                {{-- Skill Name --}}
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Skill Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class='bx bx-badge-check'></i>
                                        </span>
                                        <input
                                            type="text"
                                            name="skill_name"
                                            class="form-control"
                                            value="{{  $skill->skill_name ?? ''}}"
                                            placeholder="e.g. Laravel, Vue.js, SEO"
                                        >
                                    </div>
                                </div>

                                {{-- Skill Value --}}
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Skill Value (in %)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class='bx bx-trending-up'></i>
                                        </span>
                                        <input
                                            type="text"
                                            name="skill_value"
                                            class="form-control"
                                            value="{{ old('skill_value', $skill->skill_value) }}"
                                            placeholder="e.g. 80 or 90"
                                        >
                                    </div>
                                </div>

                                {{-- Status --}}
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Status</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class='bx bx-toggle-left'></i>
                                        </span>
                                        <select name="status" class="form-control">
                                            <option value="1" {{ $skill->status == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $skill->status == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Submit --}}
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary" id="skillUpdateBtn">
                                        <span id="skillUpdateBtnText">Update Skill</span>
                                        <span id="skillUpdateBtnSpinner" class="spinner-border spinner-border-sm d-none"
                                              role="status" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div> <!-- /tab-content -->

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {

        $('#skillUpdateForm').on('submit', function (e) {
            e.preventDefault();

            let form = this;
            let formData = new FormData(form);

            let $btn        = $('#skillUpdateBtn');
            let $btnText    = $('#skillUpdateBtnText');
            let $btnSpinner = $('#skillUpdateBtnSpinner');

            $btn.prop('disabled', true);
            $btnText.text('Processing...');
            $btnSpinner.removeClass('d-none');

            $.ajax({
                url: "{{ route('admin.skills.update', $skill->id) }}", // Update route
                type: "POST", // _method=PUT যাবে formData এর মধ্যে
                data: formData,
                processData: false,
                contentType: false,

                success: function (response) {
                    $btn.prop('disabled', false);
                    $btnText.text('Update Skill');
                    $btnSpinner.addClass('d-none');

                    if (response.status === 'success') {
                        toastr.success(response.message || 'Skill updated successfully.');

                        // 1 second later redirect to index page
                        setTimeout(function () {
                            window.location.href = "{{ route('admin.skills.index') }}";
                        }, 1000);

                    } else {
                        toastr.error(response.message || 'An error occurred.');
                    }
                },

                error: function (xhr) {
                    $btn.prop('disabled', false);
                    $btnText.text('Update Skill');
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
