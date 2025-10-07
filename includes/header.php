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

    <!-- CSS Styles -->
    <link rel="stylesheet" href="/style.css" />

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    <style>
        /* ====== Fixed Header and Global Padding ====== */
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: #0f0f1b;
            z-index: 1000;
            padding: 15px 20px;
            border-bottom: 2px solid #f65a5a;
        }

        body {
            padding-top: 80px;
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