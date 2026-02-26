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
                                <p>your.email@example.com</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <div class="contact-item-content">
                                <h5>Phone</h5>
                                <p>+880 1234 567890</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="contact-item-content">
                                <h5>Location</h5>
                                <p>Dhaka, Bangladesh</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <form id="contactForm">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" placeholder="Your Name" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="email" class="form-control" placeholder="Your Email" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Subject" required />
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" rows="5" placeholder="Your Message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-custom">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
