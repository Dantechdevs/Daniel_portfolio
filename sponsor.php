<?php include('includes/header.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sponsor Me - Daniel Ngwasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts and Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #0f0f1b;
            font-family: 'Inter', sans-serif;
            color: #f0f0f0;
        }

        .sponsor-section {
            max-width: 900px;
            margin: 60px auto;
            background: linear-gradient(145deg, #1f1f2f, #181828);
            padding: 50px 30px;
            border-radius: 16px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        .sponsor-section h1 {
            color: #f65a5a;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .sponsor-section p {
            font-size: 1.1rem;
            color: #c0c0c0;
            max-width: 700px;
            margin: 0 auto 30px;
        }

        .sponsor-btn {
            display: inline-block;
            background-color: #f44336;
            color: white;
            padding: 14px 30px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            font-size: 18px;
            transition: all 0.3s ease;
            margin: 10px;
        }

        .sponsor-btn:hover {
            background-color: #ff3e3e;
            box-shadow: 0 0 15px rgba(255, 70, 70, 0.6);
        }

        .sponsor-grid {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .benefits {
            margin-top: 40px;
            text-align: left;
        }

        .benefits h3 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: #ffffff;
        }

        .benefits ul {
            padding-left: 20px;
        }

        .benefits li {
            margin-bottom: 12px;
            font-size: 1rem;
            color: #dddddd;
        }
    </style>
</head>

<body>

    <section class="sponsor-section">
        <h1>❤️ Sponsor Me</h1>
        <p>
            I'm Daniel Ngwasi — a passionate full-stack developer and open-source contributor. Sponsoring my work helps me dedicate more time to building free tools, sharing knowledge, and mentoring others in tech.
        </p>

        <div class="sponsor-grid">
            <a href="https://github.com/sponsors/laike9m" class="sponsor-btn" target="_blank">
                <i class="fab fa-github"></i> GitHub Sponsor
            </a>
            <a href="https://www.paypal.me/yourusername" class="sponsor-btn" target="_blank">
                <i class="fab fa-paypal"></i> PayPal
            </a>
            <a href="https://www.patreon.com/yourusername" class="sponsor-btn" target="_blank">
                <i class="fab fa-patreon"></i> Patreon
            </a>
            <a href="#" onclick="alert('Use Till Number 123456 - Daniel Ngwasi')" class="sponsor-btn">
                <i class="fas fa-mobile-alt"></i> M-PESA
            </a>
        </div>

        <div class="benefits mt-5">
            <h3>🎯 What Your Support Helps With:</h3>
            <ul>
                <li>Improving open-source tools and libraries</li>
                <li>Creating free educational content</li>
                <li>Mentoring new developers in Africa and beyond</li>
                <li>Covering development infrastructure and hosting</li>
                <li>Building community-driven tech solutions</li>
            </ul>
        </div>
    </section>

    <?php include('includes/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>