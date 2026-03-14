<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $websiteSetting->website_title }} | @yield(section: 'title')</title>
    <link rel="icon" href="{{ asset($websiteSetting->website_favicon ?? '/assets/images/favicon-32x32.png') }}" type="image/png"/>


    @include('website.layouts.inc.style')
</head>

<body>
    <!-- Background Elements -->
    <div class="bg-animation"></div>
    <div class="grid-overlay"></div>

    <!-- Navbar -->
    @include('website.layouts.inc.nav')

    @yield('website_content')

    <!-- Footer -->
    @include('website.layouts.inc.footer')

    <!-- Scroll to Top Button -->
    <button class="scroll-top" id="scrollTop">
        <i class="fas fa-arrow-up"></i>
    </button>


@include('website.layouts.inc.script')
</body>

</html>
