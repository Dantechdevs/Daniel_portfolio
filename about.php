<?php include('includes/header.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>About - Daniel Ngwasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap and Font Awesome -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">

    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
    body {
        background: #0f0f1b;
        color: #eaeaea;
        font-family: 'Inter', sans-serif;
    }

    .about-section {
        padding: 60px 20px;
    }

    .hero {
        background: linear-gradient(145deg, #1f1f2f, #181828);
        border-radius: 16px;
        padding: 50px 30px;
        margin-bottom: 50px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        text-align: center;
    }

    .hero h1 {
        font-size: 2.5rem;
        color: #f65a5a;
        margin-bottom: 15px;
    }

    .hero p {
        font-size: 1.1rem;
        max-width: 800px;
        margin: 0 auto;
        color: #c0c0c0;
    }

    .btn-sponsor {
        display: inline-block;
        background-color: #f44336;
        color: white;
        padding: 12px 25px;
        border-radius: 30px;
        text-decoration: none;
        font-weight: bold;
        font-size: 16px;
        box-shadow: 0 4px 12px rgba(246, 90, 90, 0.3);
        transition: all 0.3s ease;
        margin-top: 20px;
    }

    .btn-sponsor:hover {
        background-color: #e53935;
        box-shadow: 0 6px 20px rgba(246, 90, 90, 0.5);
    }

    .section-header {
        font-size: 1.75rem;
        text-align: center;
        margin-bottom: 30px;
        color: #ffffff;
    }

    .tech-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 20px;
        margin-bottom: 60px;
    }

    .tech-item {
        background: rgba(255, 255, 255, 0.05);
        padding: 15px;
        border-radius: 12px;
        text-align: center;
        transition: transform 0.2s ease;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .tech-item:hover {
        transform: scale(1.05);
        background: rgba(255, 255, 255, 0.08);
    }

    .tech-item img {
        height: 30px;
        margin-bottom: 8px;
    }

    .tech-item span {
        font-size: 14px;
        color: #d0d0d0;
    }

    .social-buttons {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .social-buttons a {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 10px 20px;
        background-color: #2c2c3f;
        color: #00ffff;
        border-radius: 30px;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.3s ease;
    }

    .social-buttons a:hover {
        background-color: #f65a5a;
        color: #fff;
    }

    .social-buttons i {
        font-size: 18px;
    }
    </style>
</head>

<body>

    <section class="about-section">
        <div class="container">

            <!-- About Me Hero -->
            <div class="hero" data-aos="fade-up">
                <h1>💫 About Me</h1>
                <p>
                    Hi, I'm <strong>Daniel Ngwasi</strong>, a passionate self-taught full stack web developer and
                    freelance designer from Kenya.
                    I love turning ideas into elegant, functional interfaces with clean code and modern design.
                    I'm also an open-source enthusiast, always learning and sharing.
                </p>
                <a href="https://github.com/sponsors/laike9m" class="btn-sponsor" target="_blank">❤️ Sponsor Me</a>
            </div>

            <!-- Tech Stack -->
            <div data-aos="fade-up">
                <h2 class="section-header">💻 Tech Stack</h2>
                <div class="tech-grid">
                    <?php
                    $techs = [
                        ["pandas", "pandas-%23150458", "Pandas"],
                        ["numpy", "numpy-%23013243", "NumPy"],
                        ["plotly", "Plotly-%233F4F75", "Plotly"],
                        ["pytorch", "PyTorch-%23EE4C2C", "PyTorch"],
                        ["microsoft sql server", "Microsoft%20SQL%20Sever-CC2927", "SQL Server"],
                        ["mysql", "mysql-%2300f", "MySQL"],
                        ["apache", "apache-%23D42029", "Apache"],
                        ["django", "django-%23092E20", "Django"],
                        ["laravel", "laravel-%23FF2D20", "Laravel"],
                        ["react native", "react_native-%2320232a", "React Native"],
                        ["react", "react-%2320232a", "React"],
                        ["c#", "c%23-%23239120", "C#"],
                        ["c", "c-%2300599C", "C"],
                        ["c++", "c++-%2300599C", "C++"],
                        ["css3", "css3-%231572B6", "CSS3"],
                        ["html5", "html5-%23E34F26", "HTML5"],
                        ["javascript", "javascript-%23323330", "JavaScript"],
                        ["php", "php-%23777BB4", "PHP"],
                        ["python", "python-3670A0", "Python"],
                        ["google cloud", "Google%20Cloud-%234285F4", "Google Cloud"],
                    ];

                    foreach ($techs as $tech) {
                        $logo = strtolower($tech[0]);
                        $badge = $tech[1];
                        $label = $tech[2];
                        echo "
            <div class='tech-item'>
              <img src='https://img.shields.io/badge/{$badge}.svg?style=for-the-badge&logo={$logo}&logoColor=white' alt='{$label}' />
              <span>{$label}</span>
            </div>
          ";
                    }
                    ?>
                </div>
            </div>

            <!-- Social Links -->
            <div data-aos="fade-up">
                <h2 class="section-header">🌐 Connect With Me</h2>
                <div class="social-buttons">
                    <a href="https://web.facebook.com/daniel.ngwasi.9/" target="_blank"><i
                            class="fab fa-facebook-f"></i> Facebook</a>
                    <a href="https://www.linkedin.com/in/daniel-n-29924a69/" target="_blank"><i
                            class="fab fa-linkedin"></i> LinkedIn</a>
                    <a href="https://twitter.com/Ngwasidaniel" target="_blank"><i class="fab fa-twitter"></i>
                        Twitter</a>
                </div>
            </div>

        </div>
    </section>

    <?php include('includes/footer.php'); ?>

    <!-- JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init();
    </script>

</body>

</html>