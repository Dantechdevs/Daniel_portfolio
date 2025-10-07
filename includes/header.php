<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dantechdevs Portfolio</title>

    <!-- Primary Meta -->
    <meta name="description"
        content="Dantechdevs portfolio showcasing services, projects, blogs, and experience in modern web development.">
    <meta name="keywords" content="Dantechdevs, Portfolio, Web Development, PHP, Projects, Blogs">
    <meta name="author" content="Dantechdevs">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Dantechdevs Portfolio">
    <meta property="og:description"
        content="Explore Dantechdevs portfolio: services, blogs, and projects in modern web development.">
    <meta property="og:image" content="/daniel-portfolio/uploads/default-og.jpg">
    <meta property="og:url" content="http://localhost/daniel-portfolio/">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Dantechdevs Portfolio">
    <meta name="twitter:description"
        content="Explore Dantechdevs portfolio: services, blogs, and projects in modern web development.">
    <meta name="twitter:image" content="/daniel-portfolio/uploads/default-og.jpg">

    <!-- External Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="/style.css" />

    <style>
    /* ====== Header Styling ====== */
    header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background: #0f0f1b;
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px 25px;
        border-bottom: 2px solid #f65a5a;
    }

    .logo {
        color: #fff;
        font-size: 1.4rem;
        font-weight: 700;
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .navbar {
        display: flex;
        gap: 25px;
    }

    .navbar a {
        color: #fff;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .navbar a:hover {
        color: #f65a5a;
    }

    /* ====== Mobile Toggle ====== */
    .menu-toggle {
        background: none;
        border: none;
        color: #fff;
        font-size: 1.8rem;
        cursor: pointer;
        display: none;
    }

    /* ====== Mobile View ====== */
    @media (max-width: 768px) {
        .menu-toggle {
            display: block;
        }

        .navbar {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background: #0f0f1b;
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
            padding: 15px 25px;
            border-top: 1px solid #f65a5a;
            display: none;
        }

        .navbar.active {
            display: flex;
            animation: slideDown 0.3s ease forwards;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    }

    body {
        background: #fff;
        margin: 0;
        padding-top: 85px;
        /* For fixed header spacing */
        font-family: 'Poppins', sans-serif;
    }

    @media (max-width: 768px) {
        body {
            padding-top: 100px;
        }
    }
    </style>
</head>

<body>
    <!-- Header & Navigation -->
    <header>
        <a href="/index.php" class="logo">Dantechdevs</a>
        <button class="menu-toggle" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <nav class="navbar">
            <a href="/index.php">Home</a>
            <a href="/about.php">About</a>
            <a href="/services.php">Services</a>
            <a href="/project.php">Projects</a>
            <a href="/blog.php">Blog</a>
            <a href="/experience.php">Experience</a>
            <a href="/testimonial.php">Testimonials</a>
            <a href="/sponsor.php">Sponsor Me</a>
            <a href="/contact.php">Contact</a>
        </nav>
    </header>

    <!-- Toggle Script -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const menuToggle = document.querySelector(".menu-toggle");
        const navbar = document.querySelector(".navbar");

        menuToggle.addEventListener("click", () => {
            navbar.classList.toggle("active");
            // Toggle icon between bars and close
            const icon = menuToggle.querySelector("i");
            icon.classList.toggle("fa-bars");
            icon.classList.toggle("fa-times");
        });
    });
    </script>
</body>

</html>