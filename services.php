<?php include('includes/header.php'); ?>

<section class="services-section">
    <div class="container">
        <div style="text-align: center; margin-bottom: 40px;">
            <button onclick="document.getElementById('contact').scrollIntoView({ behavior: 'smooth' });"
                class="btn btn-service" style="font-size: 24px; padding: 12px 30px; border: none; cursor: pointer;">
                Services I Offer
            </button>
        </div>

        <div class="services-grid">

            <div class="service-box">
                <i class="fas fa-globe"></i>
                <h3>Website Development</h3>
                <p>Fully responsive business, blog, and portfolio websites using HTML, CSS, JS, and PHP.</p>
            </div>

            <div class="service-box">
                <i class="fas fa-laptop-code"></i>
                <h3>Web Applications</h3>
                <p>End-to-end apps built using Laravel or Django with user login, dashboard, and APIs.</p>
            </div>

            <div class="service-box">
                <i class="fas fa-server"></i>
                <h3>Backend API Systems</h3>
                <p>Powerful RESTful APIs in Django REST or Laravel, secured with token or JWT authentication.</p>
            </div>

            <div class="service-box">
                <i class="fas fa-tools"></i>
                <h3>Management Systems</h3>
                <p>Custom systems for schools, clinics, inventory, and Wi-Fi billing using Laravel or Django.</p>
            </div>

            <div class="service-box">
                <i class="fas fa-fingerprint"></i>
                <h3>Authentication & Security</h3>
                <p>Secure login, 2FA, password resets, and role-based access with Laravel or Django Auth.</p>
            </div>

            <div class="service-box">
                <i class="fas fa-search"></i>
                <h3>Live Search & Pagination</h3>
                <p>AJAX-powered filters, DataTables integration, and dynamic content loaders.</p>
            </div>

            <div class="service-box">
                <i class="fas fa-file-pdf"></i>
                <h3>PDF/Excel Export</h3>
                <p>Generate clean PDF reports or Excel sheets using TCPDF, Laravel Excel, or Django tools.</p>
            </div>

            <div class="service-box">
                <i class="fas fa-mobile-alt"></i>
                <h3>Responsive UI/UX</h3>
                <p>Clean and mobile-first frontend design using Bootstrap, Tailwind, and vanilla JavaScript.</p>
            </div>

            <div class="service-box">
                <i class="fas fa-money-bill-wave"></i>
                <h3>M-PESA Integration</h3>
                <p>Seamless Daraja API integration for STK Push, payment tracking, and SMS alerts.</p>
            </div>

            <div class="service-box">
                <i class="fas fa-cloud-upload-alt"></i>
                <h3>Hosting & Deployment</h3>
                <p>Deploy Laravel/Django apps to cPanel or VPS with Nginx, SSL, Git hooks, and .env configs.</p>
            </div>

            <div class="service-box">
                <i class="fas fa-tools"></i>
                <h3>Computer & Phone Repair</h3>
                <p>Troubleshooting, repair, and maintenance of laptops, desktops, and smartphones.</p>
            </div>

            <div class="service-box">
                <i class="fas fa-school"></i>
                <h3>School Software Systems</h3>
                <p>Student information, exams, attendance, and fee management built in Laravel or Django.</p>
            </div>

        </div>

        <div style="margin-top: 40px; text-align: center;">
            <a href="#contact" class="btn btn-service">Request a Quote</a>
        </div>
    </div>
</section>

<!-- Quote Form Section -->
<section id="contact" style="background: #2a2a40; padding: 60px 20px; scroll-margin-top: 100px;">
    <div class="container" style="max-width: 700px; margin: auto;">
        <h2 class="section-title">Request a Quote</h2>
        <form method="post" action="#">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" class="form-control" placeholder="Your Name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" class="form-control" placeholder="you@example.com" required>
            </div>
            <div class="form-group">
                <label for="service">Service Interested In</label>
                <input type="text" id="service" class="form-control" placeholder="E.g. Clinic System in Django"
                    required>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" class="form-control" placeholder="Tell me more about your project..."
                    rows="4"></textarea>
            </div>
            <div style="text-align: center; margin-top: 20px;">
                <button type="submit" class="btn btn-service">Submit Request</button>
            </div>
        </form>
    </div>
</section>

<script>
// Smooth scroll
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) target.scrollIntoView({
            behavior: 'smooth'
        });
    });
});
</script>

<?php include('includes/footer.php'); ?>