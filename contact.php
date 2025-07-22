<?php include('includes/header.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contact Us - Dantechdevs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts and Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        font-family: 'Inter', sans-serif;
        background: #0f0f1b;
        color: #ffffff;
    }

    .contact-section {
        padding: 60px 20px;
        background: linear-gradient(145deg, #1f1f2f, #181828);
        border-radius: 20px;
        margin: 40px auto;
        max-width: 1000px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
    }

    .contact-section h1 {
        font-size: 2.5rem;
        color: #f65a5a;
        margin-bottom: 10px;
        text-align: center;
    }

    .contact-section h3 {
        text-align: center;
        color: #ccc;
        font-size: 1.1rem;
        margin-bottom: 30px;
    }

    .form-control {
        background: #2b2b3d;
        border: 1px solid #444;
        color: #fff;
    }

    .form-control:focus {
        background: #2b2b3d;
        color: #fff;
        border-color: #f65a5a;
        box-shadow: 0 0 0 0.25rem rgba(246, 90, 90, 0.25);
    }

    label {
        margin-bottom: 5px;
    }

    .btn-send {
        background-color: #f65a5a;
        color: #fff;
        border: none;
        font-weight: 600;
        padding: 10px 25px;
        transition: background 0.3s ease;
    }

    .btn-send:hover {
        background-color: #ff4d4d;
    }

    #notification {
        display: none;
        margin-top: 15px;
    }

    #backToTop {
        position: fixed;
        bottom: 25px;
        right: 30px;
        background-color: #f65a5a;
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 45px;
        height: 45px;
        display: none;
        justify-content: center;
        align-items: center;
        font-size: 18px;
        z-index: 1000;
    }
    </style>
</head>

<body>

    <section class="contact-section container">
        <h1>Contact Us</h1>
        <h3>We’d love to hear from you. Fill out the form below.</h3>

        <div id="notification" class="alert alert-success text-center"></div>

        <form id="contact-form">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="phone">Mobile No.</label>
                        <input type="tel" class="form-control" name="phone" id="phone" placeholder="+254712345678"
                            pattern="^\+?[0-9\s\-]{7,20}$" title="Enter a valid phone number">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group h-100 d-flex flex-column">
                        <label for="message">Message</label>
                        <textarea class="form-control flex-grow-1" name="message" id="message" rows="8"
                            required></textarea>
                        <button type="submit" class="btn btn-send mt-3 align-self-end">
                            <i class="fa fa-paper-plane"></i> Send Message
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <!-- Scroll to Top Button -->
    <button id="backToTop" title="Go to top">
        <i class="fa fa-arrow-up"></i>
    </button>

    <?php include('includes/footer.php'); ?>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    const form = document.getElementById("contact-form");
    const notification = document.getElementById("notification");
    const backToTopBtn = document.getElementById("backToTop");

    form.addEventListener("submit", function(e) {
        e.preventDefault();
        const formData = new FormData(form);

        fetch("php/contact_handler.php", {
                method: "POST",
                body: formData
            })
            .then(res => res.text())
            .then(response => {
                notification.innerText = response;
                notification.style.display = "block";
                notification.classList.add("alert-success");
                form.reset();
                setTimeout(() => notification.style.display = "none", 5000);
            })
            .catch(() => {
                notification.innerText = "Oops! Something went wrong.";
                notification.style.display = "block";
                notification.classList.remove("alert-success");
                notification.classList.add("alert-danger");
            });
    });

    window.onscroll = () => {
        backToTopBtn.style.display = (window.scrollY > 300) ? "flex" : "none";
    };

    backToTopBtn.onclick = () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    };
    </script>

</body>

</html>