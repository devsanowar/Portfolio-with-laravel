@extends('admin.dashboard')
@section('title', 'About Section Settings')

@section('admin_content')
<div class="page-content">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">

                    <!-- Tab -->
                    <ul class="nav nav-pills mb-3" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="pill" href="#about-section-tab"
                               role="tab" aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-user font-18 me-1'></i></div>
                                    <div class="tab-title">About Section</div>
                                </div>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="about-section-tab" role="tabpanel">

                            <form id="aboutSectionForm" method="POST">
                                @csrf
                                @method('PUT')

                                {{-- Section Title --}}
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Section Title</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class='bx bx-font'></i></span>
                                        <input type="text" name="section_title" class="form-control"
                                               value="{{ $about->section_title ?? '' }}"
                                               placeholder="Enter section title">
                                    </div>
                                </div>

                                {{-- Section Subtitle --}}
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Section Subtitle</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class='bx bx-text'></i></span>
                                        <input type="text" name="section_subtitle" class="form-control"
                                               value="{{ $about->section_subtitle ?? '' }}"
                                               placeholder="Enter section subtitle">
                                    </div>
                                </div>

                                {{-- Description --}}
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Description</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class='bx bx-edit'></i></span>
                                        <textarea name="description" class="form-control" rows="4"
                                                  placeholder="Write about yourself...">{{ $about->description ?? '' }}</textarea>
                                    </div>
                                </div>

                                <hr>

                                {{-- Name --}}
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class='bx bx-user'></i></span>
                                        <input type="text" name="name" class="form-control"
                                               value="{{ $about->name ?? '' }}"
                                               placeholder="Your Name">
                                    </div>
                                </div>

                                {{-- Father Name --}}
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Father Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class='bx bx-male'></i></span>
                                        <input type="text" name="father_name" class="form-control"
                                               value="{{ $about->father_name ?? '' }}"
                                               placeholder="Father's Name">
                                    </div>
                                </div>

                                {{-- Mother Name --}}
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Mother Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class='bx bx-female'></i></span>
                                        <input type="text" name="mother_name" class="form-control"
                                               value="{{ $about->mother_name ?? '' }}"
                                               placeholder="Mother's Name">
                                    </div>
                                </div>

                                {{-- Date of Birth --}}
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Date of Birth</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class='bx bx-calendar'></i></span>
                                        <input type="date" name="date_of_birth" class="form-control"
                                               value="{{ $about->date_of_birth ?? '' }}">
                                    </div>
                                </div>

                                {{-- Age --}}
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Age</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class='bx bx-time'></i></span>
                                        <input type="text" name="age" class="form-control"
                                               value="{{ $about->age ?? '' }}"
                                               placeholder="Your age">
                                    </div>
                                </div>

                                {{-- Gender --}}
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Gender</label>
                                    <select name="gender" class="form-control">
                                        <option value="">Select Gender</option>
                                        <option value="Male"   {{ ($about->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ ($about->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Other"  {{ ($about->gender ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>

                                {{-- Email --}}
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class='bx bx-envelope'></i></span>
                                        <input type="email" name="email" class="form-control"
                                               value="{{ $about->email ?? '' }}"
                                               placeholder="example@gmail.com">
                                    </div>
                                </div>

                                {{-- Phone --}}
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Phone</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class='bx bx-phone'></i></span>
                                        <input type="text" name="phone" class="form-control"
                                               value="{{ $about->phone ?? '' }}"
                                               placeholder="017XXXXXXXX">
                                    </div>
                                </div>

                                {{-- Address --}}
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class='bx bx-map'></i></span>
                                        <input type="text" name="address" class="form-control"
                                               value="{{ $about->address ?? '' }}"
                                               placeholder="Enter address">
                                    </div>
                                </div>

                                {{-- Submit --}}
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary" id="aboutSubmitBtn">
                                        <span id="aboutBtnText">Submit</span>
                                        <span id="aboutBtnSpinner" class="spinner-border spinner-border-sm d-none"></span>
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script>
    $(document).ready(function () {

        $('#aboutSectionForm').submit(function(e){
            e.preventDefault();

            let form = this;
            let formData = new FormData(form);

            let $btn = $('#aboutSubmitBtn');
            $btn.prop('disabled', true);
            $('#aboutBtnText').text('Processing...');
            $('#aboutBtnSpinner').removeClass('d-none');

            $.ajax({
                url: "{{ route('admin.about.section.update') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,

                success: function(response){
                    $btn.prop('disabled', false);
                    $('#aboutBtnText').text('Submit');
                    $('#aboutBtnSpinner').addClass('d-none');

                    if(response.status === 'success'){
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },

                error: function(xhr){
                    $btn.prop('disabled', false);
                    $('#aboutBtnText').text('Submit');
                    $('#aboutBtnSpinner').addClass('d-none');

                    if(xhr.responseJSON?.errors){
                        $.each(xhr.responseJSON.errors, function(key, msg){
                            toastr.error(msg[0]);
                        });
                    } else {
                        toastr.error('Something went wrong!');
                    }
                }
            });

        });

    });
</script>
@endpush
