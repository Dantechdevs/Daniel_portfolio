<?php include('includes/header.php'); ?>

<section class="experience-section" style="padding: 60px 20px; background: #0f0f1b; color: #fff;">
    <div class="container">
        <h2 class="section-title" style="text-align:center; font-size: 36px; margin-bottom: 60px; color: #f65a5a;">🚀
            Experience & Projects</h2>

        <div class="experience-grid">
            <!-- WiFi Billing System -->
            <div class="experience-card">
                <div class="experience-icon"><i class="fas fa-wifi"></i></div>
                <div class="experience-content">
                    <h3>WiFi Billing System</h3>
                    <p>Built a full-featured hotspot billing system with user sign-up, bandwidth control, admin
                        dashboard, and payment tracking via M-PESA STK Push. Backend powered by Django and frontend with
                        Bootstrap.</p>
                </div>
            </div>

            <!-- Hospital Management System -->
            <div class="experience-card">
                <div class="experience-icon"><i class="fas fa-hospital"></i></div>
                <div class="experience-content">
                    <h3>Hospital Management System</h3>
                    <p>Developed for clinics and hospitals to manage patients, appointments, staff, pharmacy inventory,
                        and lab results. Secured login with role-based access. Built using Laravel, MySQL, and AJAX.</p>
                </div>
            </div>

            <!-- School Information System -->
            <div class="experience-card">
                <div class="experience-icon"><i class="fas fa-school"></i></div>
                <div class="experience-content">
                    <h3>School Management System</h3>
                    <p>Designed a platform for managing student records, results, attendance, fee payments, timetables,
                        and teacher profiles. Includes PDF report generation and SMS notifications. Tech stack: Laravel
                        & Vue.js.</p>
                </div>
            </div>

            <!-- Portfolio & Business Websites -->
            <div class="experience-card">
                <div class="experience-icon"><i class="fas fa-laptop-code"></i></div>
                <div class="experience-content">
                    <h3>Portfolio and Business Websites</h3>
                    <p>Delivered 15+ responsive websites for businesses and personal portfolios using HTML, Tailwind
                        CSS, PHP, and JavaScript. SEO-optimized and mobile-first approach.</p>
                </div>
            </div>

            <!-- Inventory & POS Systems -->
            <div class="experience-card">
                <div class="experience-icon"><i class="fas fa-boxes"></i></div>
                <div class="experience-content">
                    <h3>Inventory & POS Systems</h3>
                    <p>Created systems for small businesses to manage products, stock levels, sales receipts, and
                        supplier orders. Export to Excel/PDF and user authentication included.</p>
                </div>
            </div>

            <!-- Hosting & Deployment -->
            <div class="experience-card">
                <div class="experience-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                <div class="experience-content">
                    <h3>Hosting & Deployment</h3>
                    <p>Configured and deployed Laravel and Django apps to cPanel, shared hosting, and VPS
                        (Nginx/Apache). Included SSL setup, Git-based CI/CD, and domain management.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.experience-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
    max-width: 1200px;
    margin: auto;
}

.experience-card {
    background: #1a1a2e;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
    transition: transform 0.3s ease;
}

.experience-card:hover {
    transform: translateY(-6px);
}

.experience-icon {
    font-size: 30px;
    color: #f65a5a;
    margin-bottom: 15px;
}

.experience-content h3 {
    color: #f65a5a;
    font-size: 20px;
    margin-bottom: 10px;
}

.experience-content p {
    color: #ccc;
    font-size: 15px;
    line-height: 1.6;
    margin: 0;
}
</style>

<?php include('includes/footer.php'); ?>