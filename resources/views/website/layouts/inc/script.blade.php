
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->

    <!-- Custom JS -->
<script>
    $(document).ready(function() {
        // Disable all animations during page load
        let isScrolling = false;

        // Navbar scroll effect
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $(".navbar").addClass("scrolled");
                $("#scrollTop").addClass("show");
            } else {
                $(".navbar").removeClass("scrolled");
                $("#scrollTop").removeClass("show");
            }
        });

        // Smooth scrolling for anchor links
        $('a[href^="#"]').on("click", function(event) {
            event.preventDefault();

            // Prevent multiple scroll animations
            if (isScrolling) return;

            var target = $(this.getAttribute("href"));
            if (target.length) {
                isScrolling = true;

                $("html, body")
                    .stop(true, true) // Stop any ongoing animations
                    .animate({
                        scrollTop: target.offset().top - 70,
                    }, {
                        duration: 1000,
                        easing: 'swing',
                        complete: function() {
                            isScrolling = false;
                        }
                    });
            }
        });

        // Scroll to top button - FIXED VERSION
        $("#scrollTop").on("click", function(e) {
            e.preventDefault();

            // Prevent multiple scroll animations
            if (isScrolling) return;

            isScrolling = true;

            $("html, body")
                .stop(true, true) // Stop any ongoing animations immediately
                .animate({
                    scrollTop: 0
                }, {
                    duration: 1000,
                    easing: 'swing', // Use swing for smoother easing
                    complete: function() {
                        isScrolling = false;
                    }
                });
        });

        // Animate progress bars on scroll - OPTIMIZED
        let progressBarsAnimated = [];

        function animateProgressBars() {
            $(".progress-bar").each(function(index) {
                var $this = $(this);
                var percent = $this.data("percent");
                var elementTop = $this.offset().top;
                var windowBottom = $(window).scrollTop() + $(window).height();

                if (elementTop < windowBottom && !progressBarsAnimated[index]) {
                    progressBarsAnimated[index] = true;
                    $this.css("width", "0%");
                    $this.animate({
                        width: percent + "%",
                    }, 1500);
                }
            });
        }

        // Throttle scroll events for better performance
        let scrollTimeout;
        $(window).on("scroll", function() {
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(function() {
                if (!isScrolling) {
                    animateProgressBars();
                    fadeInSections();
                }
            }, 50);
        });

        animateProgressBars();

        // Fade in sections on scroll - OPTIMIZED
        let sectionsAnimated = [];

        function fadeInSections() {
            $(".fade-in-section").each(function(index) {
                if (sectionsAnimated[index]) return;

                var elementTop = $(this).offset().top;
                var windowBottom = $(window).scrollTop() + $(window).height();

                if (elementTop < windowBottom - 100) {
                    sectionsAnimated[index] = true;
                    $(this).addClass("is-visible");
                }
            });
        }

        fadeInSections();

        // Contact form submission
        $("#contactForm").on("submit", function(e) {
            e.preventDefault();
            alert("Thank you for your message! I will get back to you soon.");
            this.reset();
        });

        // Mobile navbar collapse on link click
        $(".navbar-nav>li>a").on("click", function() {
            $(".navbar-collapse").collapse("hide");
        });
    });
</script>









<script>

document.addEventListener('DOMContentLoaded', function() {
    // Get all navigation links and sections
    const navLinks = document.querySelectorAll('.nav-link');
    const sections = document.querySelectorAll('section[id]');
    const navbar = document.querySelector('.navbar');

    // Navbar scroll effect
    function handleNavbarScroll() {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }

    // Function to remove active class from all nav links
    function removeActiveClasses() {
        navLinks.forEach(link => {
            link.classList.remove('active');
        });
    }

    // Function to add active class to current nav link
    function addActiveClass(id) {
        removeActiveClasses();
        const activeLink = document.querySelector(`.nav-link[href="#${id}"]`);
        if (activeLink) {
            activeLink.classList.add('active');
        }
    }

    // Intersection Observer for scroll detection
    const observerOptions = {
        root: null,
        rootMargin: '-50% 0px -50% 0px', // Trigger when section is in the middle of viewport
        threshold: 0
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const id = entry.target.getAttribute('id');
                addActiveClass(id);
            }
        });
    }, observerOptions);

    // Observe all sections
    sections.forEach(section => {
        observer.observe(section);
    });

    // Smooth scroll on nav link click
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            const targetId = this.getAttribute('href').substring(1);
            const targetSection = document.getElementById(targetId);

            if (targetSection) {
                // Remove active class from all links
                removeActiveClasses();

                // Add active class to clicked link
                this.classList.add('active');

                // Smooth scroll to target section
                const navbarHeight = navbar.offsetHeight;
                const targetPosition = targetSection.offsetTop - navbarHeight;

                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });

                // Close mobile menu if open
                const navbarCollapse = document.querySelector('.navbar-collapse');
                if (navbarCollapse && navbarCollapse.classList.contains('show')) {
                    const bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                        toggle: true
                    });
                }
            }
        });
    });

    // Handle scroll event for navbar styling
    window.addEventListener('scroll', handleNavbarScroll);

    // Initial check on page load
    handleNavbarScroll();

    // Set initial active state based on current scroll position
    if (sections.length > 0) {
        const firstSectionId = sections[0].getAttribute('id');
        addActiveClass(firstSectionId);
    }
});
</script>
