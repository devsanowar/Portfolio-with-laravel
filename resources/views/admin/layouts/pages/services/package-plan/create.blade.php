@extends('admin.dashboard')
@section('title', 'Package Pricing')

@section('admin_content')
    <div class="page-content">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        {{-- Tabs --}}
                        <ul class="nav nav-pills mb-3 d-flex justify-content-between" role="tablist">
                            <li class="nav-item d-flex" role="presentation">
                                <a class="nav-link active" data-bs-toggle="pill" href="#package-pricing-tab" role="tab"
                                   aria-selected="true">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon"><i class='bx bx-package font-18 me-1'></i></div>
                                        <div class="tab-title">Create Package Pricing</div>
                                    </div>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.package_pricings.index') }}"
                                   class="btn btn-outline-primary px-5 rounded-0">
                                    All Packages
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="package-pricing-tab" role="tabpanel">

                                <form id="packagePricingCreateForm" method="POST">
                                    @csrf

                                    {{-- Service --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Service</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class='bx bx-grid-alt'></i></span>
                                            <select name="service_id" class="form-control">
                                                <option value="">Select Service</option>
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <small class="text-danger error-text" data-error-for="service_id"></small>
                                    </div>

                                    {{-- Package Name --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Package Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class='bx bx-badge-check'></i></span>
                                            <input type="text" name="name" class="form-control"
                                                   placeholder="e.g. Basic, Standard, Premium">
                                        </div>
                                        <small class="text-danger error-text" data-error-for="name"></small>
                                    </div>

                                    {{-- Price --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Price</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class='bx bx-dollar-circle'></i></span>
                                            <input type="number" step="0.01" min="0" name="price" class="form-control"
                                                   placeholder="e.g. 49.99">
                                        </div>
                                        <small class="text-danger error-text" data-error-for="price"></small>
                                    </div>

                                    {{-- Features (JSON-friendly textarea or line-break list) --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">
                                            Package Features
                                            <small class="text-muted">(one per line)</small>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class='bx bx-list-check'></i></span>
                                            <textarea name="features" class="form-control" rows="4"
                                                      placeholder="e.g.&#10;10 Pages Website&#10;Free SSL&#10;24/7 Support"></textarea>
                                        </div>
                                        <small class="text-danger error-text" data-error-for="features"></small>
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
                                                <option value="active" selected>Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                        </div>
                                        <small class="text-danger error-text" data-error-for="status"></small>
                                    </div>

                                    {{-- Submit --}}
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary" id="packagePricingSubmitBtn">
                                            <span id="packagePricingBtnText">Create Package</span>
                                            <span id="packagePricingBtnSpinner"
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
                $('#packagePricingCreateForm .is-invalid').removeClass('is-invalid');
            }

            function showFieldErrors(errors) {
                $.each(errors, function(field, messages) {
                    const msg = messages?.[0] ?? 'Invalid';
                    const $err = $(`[data-error-for="${field}"]`);
                    if ($err.length) $err.text(msg);
                    $(`#packagePricingCreateForm [name="${field}"]`).addClass('is-invalid');
                });
            }

            $('#packagePricingCreateForm').on('submit', function(e) {
                e.preventDefault();

                clearErrors();

                let form = this;
                let formData = new FormData(form);

                let $btn = $('#packagePricingSubmitBtn');
                let $btnText = $('#packagePricingBtnText');
                let $btnSpinner = $('#packagePricingBtnSpinner');

                $btn.prop('disabled', true);
                $btnText.text('Processing...');
                $btnSpinner.removeClass('d-none');

                $.ajax({
                    url: "{{ route('admin.package_pricings.store') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,

                    success: function(response) {
                        $btn.prop('disabled', false);
                        $btnText.text('Create Package');
                        $btnSpinner.addClass('d-none');

                        if (response.status === 'success') {
                            toastr.success(response.message || 'Package created successfully.');
                            form.reset();
                        } else {
                            toastr.error(response.message || 'An error occurred.');
                        }
                    },

                    error: function(xhr) {
                        $btn.prop('disabled', false);
                        $btnText.text('Create Package');
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
