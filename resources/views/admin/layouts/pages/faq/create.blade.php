@extends('admin.dashboard')
@section('title', 'Create FAQ')

@section('admin_content')
    <div class="page-content">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        {{-- Tabs --}}
                        <ul class="nav nav-pills mb-3 d-flex justify-content-between" role="tablist">
                            <li class="nav-item d-flex" role="presentation">
                                <a class="nav-link active" data-bs-toggle="pill" href="#faq-tab" role="tab"
                                   aria-selected="true">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon">
                                            <i class='bx bx-help-circle font-18 me-1'></i>
                                        </div>
                                        <div class="tab-title">Create FAQ</div>
                                    </div>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.faqs.index') }}"
                                   class="btn btn-outline-primary px-5 rounded-0">
                                    All FAQs
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="faq-tab" role="tabpanel">

                                <form id="faqCreateForm" method="POST">
                                    @csrf

                                    {{-- Question --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Question</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class='bx bx-help-circle'></i>
                                            </span>
                                            <input type="text" name="question" class="form-control"
                                                   placeholder="Write FAQ question">
                                        </div>
                                        <small class="text-danger error-text" data-error-for="question"></small>
                                    </div>

                                    {{-- Answer --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Answer</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class='bx bx-message-rounded-detail'></i>
                                            </span>
                                            <textarea name="answer" class="form-control" rows="4"
                                                      placeholder="Write FAQ answer"></textarea>
                                        </div>
                                        <small class="text-danger error-text" data-error-for="answer"></small>
                                    </div>

                                    {{-- Sort Order (optional) --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Sort Order (optional)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class='bx bx-sort'></i></span>
                                            <input type="number" name="sort_order" class="form-control"
                                                   placeholder="0" min="0" value="0">
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
                                        <button type="submit" class="btn btn-primary" id="faqSubmitBtn">
                                            <span id="faqBtnText">Create FAQ</span>
                                            <span id="faqBtnSpinner"
                                                  class="spinner-border spinner-border-sm d-none"
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
                $('#faqCreateForm .is-invalid').removeClass('is-invalid');
            }

            function showFieldErrors(errors) {
                $.each(errors, function(field, messages) {
                    const msg = messages?.[0] ?? 'Invalid';
                    const $err = $(`[data-error-for="${field}"]`);
                    if ($err.length) $err.text(msg);
                    $(`#faqCreateForm [name="${field}"]`).addClass('is-invalid');
                });
            }

            $('#faqCreateForm').on('submit', function(e) {
                e.preventDefault();

                clearErrors();

                let form = this;
                let formData = new FormData(form);

                let $btn = $('#faqSubmitBtn');
                let $btnText = $('#faqBtnText');
                let $btnSpinner = $('#faqBtnSpinner');

                $btn.prop('disabled', true);
                $btnText.text('Processing...');
                $btnSpinner.removeClass('d-none');

                $.ajax({
                    url: "{{ route('admin.faqs.store') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,

                    success: function(response) {
                        $btn.prop('disabled', false);
                        $btnText.text('Create FAQ');
                        $btnSpinner.addClass('d-none');

                        if (response.status === 'success') {
                            toastr.success(response.message || 'FAQ created successfully.');
                            form.reset();
                        } else {
                            toastr.error(response.message || 'An error occurred.');
                        }
                    },

                    error: function(xhr) {
                        $btn.prop('disabled', false);
                        $btnText.text('Create FAQ');
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
