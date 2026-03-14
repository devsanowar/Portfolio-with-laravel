@extends('website.layouts.app')
@section('title', 'Home')
@section('website_content')
    <!-- Hero Section -->
    @include('website.layouts.pages.home.hero-section')

    <!-- About Section -->
    @include('website.layouts.pages.home.about-section')

    <!-- Skills Section -->
    @include('website.layouts.pages.home.skills')


    <!-- Services Section -->
    @include('website.layouts.pages.home.services')

    <!-- Projects Section -->
    @include('website.layouts.pages.home.project')

    <!-- Blog Section -->
    @include('website.layouts.pages.home.blog')

    <!-- Contact Section -->
    <section id="contact" class="section contact-section fade-in-section">
        <div class="container">
            <h2 class="section-title">Get In Touch</h2>
            <div class="row">
                <div class="col-lg-5 mb-4">
                    <div class="contact-info">
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <div class="contact-item-content">
                                <h5>Email</h5>
                                <p>{{ $websiteSetting->website_email_one ?? 'example@gmail.com' }}</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <div class="contact-item-content">
                                <h5>Phone</h5>
                                <p>{{ $websiteSetting->website_phone_number_one ?? '017xxxxxx' }}</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="contact-item-content">
                                <h5>Location</h5>
                                <p>{{ $websiteSetting->website_address ?? 'Dhaka, Bangladesh' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <form id="contactForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" name="name" placeholder="Your Name"
                                    required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Your Email"
                                    required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="subject" class="form-control" placeholder="Subject" required />
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="message" rows="5" placeholder="Your Message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-custom" id="submitBtn">Send Message</button>

                        <!-- Message container -->
                        <div id="formMessage" class="mt-3" style="display: none;"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>


@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#contactForm').on('submit', function(e) {

                e.preventDefault();

                let formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('contact.send') }}",
                    type: "POST",
                    data: formData,

                    success: function(response) {
                        $('#formMessage')
                            .removeClass()
                            .addClass('alert alert-success')
                            .html(response.message)
                            .fadeIn();

                        $('#contactForm')[0].reset();

                        // Auto hide after 2 second
                        setTimeout(function() {
                            $('#formMessage').fadeOut();
                        }, 2000);
                    },

                    error: function(xhr) {
                        console.log(xhr.responseText);

                        // Error message and auto hide
                        let errorMsg = 'Any problem. Please try again!';

                        if (xhr.status === 422 && xhr.responseJSON?.errors) {
                            let errors = Object.values(xhr.responseJSON.errors).flat();
                            errorMsg = errors.join('<br>');
                        }

                        $('#formMessage')
                            .removeClass()
                            .addClass('alert alert-danger')
                            .html(errorMsg)
                            .fadeIn();

                        // Error and Hide after 2 second
                        setTimeout(function() {
                            $('#formMessage').fadeOut();
                        }, 2000);
                    }


                });

            });

        });
    </script>
@endpush
