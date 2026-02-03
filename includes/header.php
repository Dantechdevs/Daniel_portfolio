<?php
// Detect current page for active nav link
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dantechdevs Portfolio</title>

    <!-- Meta Info -->
    <meta name="description" content="Portfolio of Dantechdevs showcasing web development projects and services.">
    <meta name="author" content="Dantechdevs">

    <!-- Styles -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
</head>

<body>

    <!-- ===== Header Navigation ===== -->
    <header>
        <!-- Logo -->
        <a href="index.php" class="logo">Dantechdevs</a>

        <!-- Hamburger Toggle (Mobile) -->
        <button class="menu-toggle" id="menuToggle" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Navigation Links -->
        <nav class="navbar" id="navbar">
            <a href="index.php" class="<?= $currentPage === 'index.php' ? 'active' : '' ?>">Home</a>
            <a href="about.php" class="<?= $currentPage === 'about.php' ? 'active' : '' ?>">About</a>
            <a href="services.php" class="<?= $currentPage === 'services.php' ? 'active' : '' ?>">Services</a>
            <a href="project.php" class="<?= $currentPage === 'project.php' ? 'active' : '' ?>">Projects</a>
            <a href="experience.php" class="<?= $currentPage === 'experience.php' ? 'active' : '' ?>">Experience</a>
            <a href="contact.php" class="<?= $currentPage === 'contact.php' ? 'active' : '' ?>">Contact</a>
        </nav>
    </header>

    <!-- ===== Header JavaScript ===== -->
    <script>
        const menuToggle = document.getElementById("menuToggle");
        const navbar = document.getElementById("navbar");
        const icon = menuToggle.querySelector("i");

        // Toggle menu
        menuToggle.addEventListener("click", () => {
            navbar.classList.toggle("active");

            if (navbar.classList.contains("active")) {
                icon.classList.remove("fa-bars");
                icon.classList.add("fa-xmark");
            } else {
                icon.classList.remove("fa-xmark");
                icon.classList.add("fa-bars");
            }
        });

        // Close menu when clicking a nav link (mobile UX)
        document.querySelectorAll(".navbar a").forEach(link => {
            link.addEventListener("click", () => {
                navbar.classList.remove("active");
                icon.classList.remove("fa-xmark");
                icon.classList.add("fa-bars");
            });
        });

        // Close menu on window resize (prevents stuck state)
        window.addEventListener("resize", () => {
            if (window.innerWidth > 768) {
                navbar.classList.remove("active");
                icon.classList.remove("fa-xmark");
                icon.classList.add("fa-bars");
            }
        });
    </script>