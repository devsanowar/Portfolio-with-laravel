@extends('website.layouts.app')
@section('title', 'Home')
@section('website_content')
<!-- Hero Section -->
    @include('website.layouts.pages.home.hero-section')

    <!-- About Section -->
    @include('website.layouts.pages.home.about-section')

    <!-- Skills Section -->
    <section id="skills" class="section fade-in-section">
        <div class="container">
            <h2 class="section-title">Technical Skills</h2>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="skill-card">
                        <i class="fas fa-code skill-icon"></i>
                        <h3 class="skill-title">Frontend</h3>
                        <p class="skill-description">
                            Creating responsive and interactive user interfaces with modern
                            frameworks and libraries.
                        </p>
                        <div class="skill-progress">
                            <div class="progress-item">
                                <div class="progress-label">
                                    <span>HTML5</span>
                                    <span>95%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 95%" data-percent="95"></div>
                                </div>
                            </div>
                            <div class="progress-item">
                                <div class="progress-label">
                                    <span>CSS3</span>
                                    <span>90%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 90%" data-percent="90"></div>
                                </div>
                            </div>
                            <div class="progress-item">
                                <div class="progress-label">
                                    <span>Bootstrap</span>
                                    <span>92%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 92%" data-percent="92"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="skill-card">
                        <i class="fas fa-server skill-icon"></i>
                        <h3 class="skill-title">Backend</h3>
                        <p class="skill-description">
                            Building robust server-side applications with efficient database
                            management and API development.
                        </p>
                        <div class="skill-progress">
                            <div class="progress-item">
                                <div class="progress-label">
                                    <span>PHP</span>
                                    <span>88%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 88%" data-percent="88"></div>
                                </div>
                            </div>
                            <div class="progress-item">
                                <div class="progress-label">
                                    <span>Laravel</span>
                                    <span>85%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 85%" data-percent="85"></div>
                                </div>
                            </div>
                            <div class="progress-item">
                                <div class="progress-label">
                                    <span>JavaScript</span>
                                    <span>87%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 87%" data-percent="87"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="skill-card">
                        <i class="fab fa-wordpress skill-icon"></i>
                        <h3 class="skill-title">CMS</h3>
                        <p class="skill-description">
                            Customizing WordPress themes and developing plugins for content
                            management systems.
                        </p>
                        <div class="skill-progress">
                            <div class="progress-item">
                                <div class="progress-label">
                                    <span>WordPress</span>
                                    <span>90%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 90%" data-percent="90"></div>
                                </div>
                            </div>
                            <div class="progress-item">
                                <div class="progress-label">
                                    <span>Theme Dev</span>
                                    <span>85%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 85%" data-percent="85"></div>
                                </div>
                            </div>
                            <div class="progress-item">
                                <div class="progress-label">
                                    <span>Plugin Dev</span>
                                    <span>80%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 80%" data-percent="80"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Services Section -->
    <section id="services" class="services-section">
        <div class="container">
            <!-- Section Header -->
            <div class="section-header">
                <div class="section-subtitle">
                    <span class="subtitle-line"></span>
                    <span class="subtitle-text">What I Provide</span>
                    <span class="subtitle-line"></span>
                </div>
                <h2 class="section-title">Professional Services</h2>
                <p class="section-description">
                    Delivering cutting-edge web solutions with expertise in modern technologies
                    and best practices to bring your digital vision to life.
                </p>
            </div>

            <!-- Services Grid -->
            <div class="row g-4">
                <!-- Service 1: Web Development -->
                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-code"></i>
                            <div class="icon-bg"></div>
                        </div>
                        <h3 class="service-title">Web Development</h3>
                        <p class="service-description">
                            Building responsive and scalable web applications using modern frameworks
                            like React, Vue.js, and Laravel. From concept to deployment, creating
                            solutions that drive results.
                        </p>
                        <ul class="service-features">
                            <li><i class="fas fa-check-circle"></i> Responsive Design</li>
                            <li><i class="fas fa-check-circle"></i> Modern Frameworks</li>
                            <li><i class="fas fa-check-circle"></i> Scalable Architecture</li>
                        </ul>
                        <a href="service-single.html" class="service-link">
                            Learn More <i class="fas fa-arrow-right"></i>
                        </a>
                        <div class="service-number">01</div>
                    </div>
                </div>

                <!-- Service 2: UI/UX Design -->
                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-palette"></i>
                            <div class="icon-bg"></div>
                        </div>
                        <h3 class="service-title">UI/UX Design</h3>
                        <p class="service-description">
                            Creating intuitive and engaging user interfaces that provide exceptional
                            user experiences. Focusing on aesthetics, usability, and conversion
                            optimization.
                        </p>
                        <ul class="service-features">
                            <li><i class="fas fa-check-circle"></i> User Research</li>
                            <li><i class="fas fa-check-circle"></i> Wireframing & Prototyping</li>
                            <li><i class="fas fa-check-circle"></i> Visual Design</li>
                        </ul>
                        <a href="service-single.html" class="service-link">
                            Learn More <i class="fas fa-arrow-right"></i>
                        </a>
                        <div class="service-number">02</div>
                    </div>
                </div>

                <!-- Service 3: API Development -->
                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-exchange-alt"></i>
                            <div class="icon-bg"></div>
                        </div>
                        <h3 class="service-title">API Development</h3>
                        <p class="service-description">
                            Developing robust RESTful and GraphQL APIs that power your applications.
                            Secure, documented, and optimized for performance and scalability.
                        </p>
                        <ul class="service-features">
                            <li><i class="fas fa-check-circle"></i> RESTful APIs</li>
                            <li><i class="fas fa-check-circle"></i> GraphQL Integration</li>
                            <li><i class="fas fa-check-circle"></i> API Security</li>
                        </ul>
                        <a href="service-single.html" class="service-link">
                            Learn More <i class="fas fa-arrow-right"></i>
                        </a>
                        <div class="service-number">03</div>
                    </div>
                </div>

                <!-- Service 4: Database Design -->
                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-database"></i>
                            <div class="icon-bg"></div>
                        </div>
                        <h3 class="service-title">Database Design</h3>
                        <p class="service-description">
                            Designing and optimizing database architectures for performance and
                            reliability. Expert in MySQL, PostgreSQL, MongoDB, and Redis.
                        </p>
                        <ul class="service-features">
                            <li><i class="fas fa-check-circle"></i> Schema Design</li>
                            <li><i class="fas fa-check-circle"></i> Query Optimization</li>
                            <li><i class="fas fa-check-circle"></i> Data Migration</li>
                        </ul>
                        <a href="service-single.html" class="service-link">
                            Learn More <i class="fas fa-arrow-right"></i>
                        </a>
                        <div class="service-number">04</div>
                    </div>
                </div>

                <!-- Service 5: E-Commerce Solutions -->
                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-shopping-cart"></i>
                            <div class="icon-bg"></div>
                        </div>
                        <h3 class="service-title">E-Commerce Solutions</h3>
                        <p class="service-description">
                            Building powerful online stores with secure payment integration,
                            inventory management, and seamless checkout experiences.
                        </p>
                        <ul class="service-features">
                            <li><i class="fas fa-check-circle"></i> Payment Gateway</li>
                            <li><i class="fas fa-check-circle"></i> Shopping Cart</li>
                            <li><i class="fas fa-check-circle"></i> Order Management</li>
                        </ul>
                        <a href="service-single.html" class="service-link">
                            Learn More <i class="fas fa-arrow-right"></i>
                        </a>
                        <div class="service-number">05</div>
                    </div>
                </div>

                <!-- Service 6: Performance Optimization -->
                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-rocket"></i>
                            <div class="icon-bg"></div>
                        </div>
                        <h3 class="service-title">Performance Optimization</h3>
                        <p class="service-description">
                            Improving website speed and performance through code optimization,
                            caching strategies, and CDN implementation for better user experience.
                        </p>
                        <ul class="service-features">
                            <li><i class="fas fa-check-circle"></i> Speed Optimization</li>
                            <li><i class="fas fa-check-circle"></i> Caching Strategy</li>
                            <li><i class="fas fa-check-circle"></i> Load Balancing</li>
                        </ul>
                        <a href="service-single.html" class="service-link">
                            Learn More <i class="fas fa-arrow-right"></i>
                        </a>
                        <div class="service-number">06</div>
                    </div>
                </div>

                <!-- Service 7: Cloud Services -->
                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-cloud"></i>
                            <div class="icon-bg"></div>
                        </div>
                        <h3 class="service-title">Cloud Services</h3>
                        <p class="service-description">
                            Deploying and managing applications on cloud platforms like AWS, Azure,
                            and Google Cloud. Scalable, secure, and cost-effective solutions.
                        </p>
                        <ul class="service-features">
                            <li><i class="fas fa-check-circle"></i> Cloud Deployment</li>
                            <li><i class="fas fa-check-circle"></i> Server Management</li>
                            <li><i class="fas fa-check-circle"></i> Auto Scaling</li>
                        </ul>
                        <a href="service-single.html" class="service-link">
                            Learn More <i class="fas fa-arrow-right"></i>
                        </a>
                        <div class="service-number">07</div>
                    </div>
                </div>

                <!-- Service 8: Security Solutions -->
                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-shield-alt"></i>
                            <div class="icon-bg"></div>
                        </div>
                        <h3 class="service-title">Security Solutions</h3>
                        <p class="service-description">
                            Implementing robust security measures to protect your applications and
                            data. From SSL certificates to advanced threat protection.
                        </p>
                        <ul class="service-features">
                            <li><i class="fas fa-check-circle"></i> Security Audits</li>
                            <li><i class="fas fa-check-circle"></i> SSL/TLS Setup</li>
                            <li><i class="fas fa-check-circle"></i> Data Encryption</li>
                        </ul>
                        <a href="service-single.html" class="service-link">
                            Learn More <i class="fas fa-arrow-right"></i>
                        </a>
                        <div class="service-number">08</div>
                    </div>
                </div>

                <!-- Service 9: Maintenance & Support -->
                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-tools"></i>
                            <div class="icon-bg"></div>
                        </div>
                        <h3 class="service-title">Maintenance & Support</h3>
                        <p class="service-description">
                            Providing ongoing maintenance and technical support to ensure your
                            applications run smoothly. Quick response time and reliable service.
                        </p>
                        <ul class="service-features">
                            <li><i class="fas fa-check-circle"></i> 24/7 Monitoring</li>
                            <li><i class="fas fa-check-circle"></i> Bug Fixes</li>
                            <li><i class="fas fa-check-circle"></i> Regular Updates</li>
                        </ul>
                        <a href="service-single.html" class="service-link">
                            Learn More <i class="fas fa-arrow-right"></i>
                        </a>
                        <div class="service-number">09</div>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="services-cta">
                <div class="cta-content">
                    <h3 class="cta-title">Ready to Start Your Project?</h3>
                    <p class="cta-description">
                        Let's discuss how I can help bring your ideas to life with professional
                        web development services.
                    </p>
                </div>
                <div class="cta-buttons">
                    <a href="#contact" class="btn btn-custom">
                        <i class="fas fa-paper-plane"></i> Get in Touch
                    </a>
                    <a href="#portfolio" class="btn btn-custom btn-secondary-custom">
                        <i class="fas fa-eye"></i> View Portfolio
                    </a>
                </div>
            </div>
        </div>

        <!-- Background Elements -->
        <div class="bg-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="section fade-in-section">
        <div class="container">
            <h2 class="section-title">Featured Projects</h2>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="project-card">
                        <div class="project-image">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="project-content">
                            <h3 class="project-title" onclick="openProjectModal(1, 'E-Commerce Platform')">
                                E-Commerce Platform
                            </h3>
                            <p class="project-description">
                                A full-featured online shopping platform built with Laravel
                                and modern frontend technologies.
                            </p>
                            <div class="project-tags">
                                <span class="project-tag">Laravel</span>
                                <span class="project-tag">Bootstrap</span>
                                <span class="project-tag">MySQL</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="project-card">
                        <div class="project-image">
                            <i class="fas fa-blog"></i>
                        </div>
                        <div class="project-content">
                            <h3 class="project-title" onclick="openProjectModal(2, 'Blog Management System')">
                                Blog Management
                            </h3>
                            <p class="project-description">
                                Custom WordPress theme with advanced features and optimized
                                performance for content creators.
                            </p>
                            <div class="project-tags">
                                <span class="project-tag">WordPress</span>
                                <span class="project-tag">PHP</span>
                                <span class="project-tag">jQuery</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="project-card">
                        <div class="project-image">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <div class="project-content">
                            <h3 class="project-title" onclick="openProjectModal(3, 'Task Manager App')">
                                Task Manager App
                            </h3>
                            <p class="project-description">
                                Real-time task management application with team collaboration
                                features and notifications.
                            </p>
                            <div class="project-tags">
                                <span class="project-tag">Laravel</span>
                                <span class="project-tag">JavaScript</span>
                                <span class="project-tag">Ajax</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="project-card">
                        <div class="project-image">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="project-content">
                            <h3 class="project-title">Analytics Dashboard</h3>
                            <p class="project-description">
                                Interactive dashboard for data visualization and business
                                intelligence with real-time updates.
                            </p>
                            <div class="project-tags">
                                <span class="project-tag">PHP</span>
                                <span class="project-tag">Chart.js</span>
                                <span class="project-tag">API</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="project-card">
                        <div class="project-image">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <div class="project-content">
                            <h3 class="project-title">Responsive Portfolio</h3>
                            <p class="project-description">
                                Modern and creative portfolio website with smooth animations
                                and mobile-first design approach.
                            </p>
                            <div class="project-tags">
                                <span class="project-tag">HTML5</span>
                                <span class="project-tag">CSS3</span>
                                <span class="project-tag">jQuery</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="project-card">
                        <div class="project-image">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="project-content">
                            <h3 class="project-title">LMS Platform</h3>
                            <p class="project-description">
                                Learning Management System with course creation, student
                                tracking, and certification features.
                            </p>
                            <div class="project-tags">
                                <span class="project-tag">Laravel</span>
                                <span class="project-tag">Bootstrap</span>
                                <span class="project-tag">MySQL</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <!-- Blog Section -->
    <section id="blog" class="section fade-in-section">
        <div class="container">
            <h2 class="section-title">Latest Blog Posts</h2>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="blog-card">
                        <div class="blog-image">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span class="blog-date"><i class="far fa-calendar"></i> Jan 15, 2024</span>
                                <span class="blog-category"><i class="far fa-folder"></i> Development</span>
                            </div>
                            <h3 class="blog-title">Modern Web Development Trends 2024</h3>
                            <p class="blog-excerpt">
                                Explore the latest trends in web development including AI
                                integration, progressive web apps, and serverless
                                architecture.
                            </p>
                            <a href="#" class="blog-read-more">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="blog-card">
                        <div class="blog-image">
                            <i class="fas fa-database"></i>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span class="blog-date"><i class="far fa-calendar"></i> Dec 28, 2023</span>
                                <span class="blog-category"><i class="far fa-folder"></i> Database</span>
                            </div>
                            <h3 class="blog-title">
                                Optimizing Laravel Database Performance
                            </h3>
                            <p class="blog-excerpt">
                                Learn advanced techniques to optimize database queries and
                                improve Laravel application performance.
                            </p>
                            <a href="#" class="blog-read-more">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="blog-card">
                        <div class="blog-image">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span class="blog-date"><i class="far fa-calendar"></i> Nov 20, 2023</span>
                                <span class="blog-category"><i class="far fa-folder"></i> Security</span>
                            </div>
                            <h3 class="blog-title">Web Security Best Practices 2024</h3>
                            <p class="blog-excerpt">
                                Essential security practices every web developer should
                                implement to protect applications from threats.
                            </p>
                            <a href="#" class="blog-read-more">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="blog.html" class="btn btn-custom">
                    <i class="fas fa-newspaper"></i> View All Blog Posts
                </a>
            </div>
        </div>
    </section>

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
