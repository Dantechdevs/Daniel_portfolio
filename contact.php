<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contact Us - Dantechdevs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts and Icons -->
    <link href="https://fonts.googleapis.com/css?family=Oleo+Script:400,700|Teko:400,700" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <style>
    html,
    body {
        height: 100%;
        margin: 0;
        font-family: 'Teko', sans-serif;
        scroll-behavior: smooth;
    }

    .page-wrapper {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    #contact {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 60px 0;
        background: linear-gradient(to left, #3a6186, #89253e);
        color: #fff;
    }

    .section-header {
        font-family: 'Oleo Script', cursive;
        color: #fcc500;
        font-size: 50px;
        margin-bottom: 10px;
        text-align: center;
    }

    h3 {
        font-size: 20px;
        text-align: center;
        margin-bottom: 40px;
    }

    label {
        font-size: 20px;
    }

    .form-control {
        font-size: 18px;
        padding: 12px;
        height: auto;
    }

    textarea.form-control {
        height: 180px;
    }

    .submit {
        font-size: 18px;
        float: right;
        width: 180px;
        background-color: transparent;
        color: #fff;
        border: 2px solid #fff;
        transition: 0.3s ease;
    }

    .submit:hover {
        background-color: #fcc500;
        color: #000;
    }

    .form-line {
        border-right: 1px solid #B29999;
    }

    #form-status {
        margin-top: 20px;
        font-size: 16px;
    }

    #notification {
        font-size: 18px;
        display: none;
    }

    #backToTop {
        position: fixed;
        bottom: 20px;
        right: 25px;
        background: #fcc500;
        color: #000;
        border: none;
        border-radius: 50%;
        width: 45px;
        height: 45px;
        display: none;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        z-index: 1000;
    }

    @media (max-width: 768px) {
        .form-line {
            border-right: none;
            border-bottom: 1px solid #ccc;
            margin-bottom: 20px;
        }
    }
    </style>
</head>

<body>

    <div class="page-wrapper">
        <section id="contact">
            <div class="container">
                <h1 class="section-header">Get in <span>Touch with us</span></h1>
                <h3>We’d love to hear from you. Send us a message below.</h3>

                <!-- Success Notification -->
                <div id="notification" class="alert alert-success"></div>

                <form id="contact-form">
                    <div class="row">
                        <div class="col-md-6 form-line">
                            <div class="form-group">
                                <label>Your name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter Email"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Mobile No.</label>
                                <input type="tel" class="form-control" name="phone" placeholder="e.g. +254712345678"
                                    pattern="^\+?[0-9\s\-]{7,20}$"
                                    title="Enter a valid phone number with optional country code">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Message</label>
                                <textarea class="form-control" name="message" placeholder="Enter Your Message"
                                    required></textarea>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-default submit">
                                    <i class="fa fa-paper-plane"></i> Send Message
                                </button>
                                <p id="form-status"></p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>

        <?php include 'includes/footer.php'; ?>
    </div>

    <!-- Scroll to Top Button -->
    <button id="backToTop" title="Go to top">
        <i class="fa fa-arrow-up"></i>
    </button>

    <!-- Scripts -->
    <script>
    document.getElementById("contact-form").addEventListener("submit", function(e) {
        e.preventDefault();
        const form = e.target;
        const status = document.getElementById("form-status");
        const notification = document.getElementById("notification");

        fetch("php/contact_handler.php", {
                method: "POST",
                body: new FormData(form)
            })
            .then(res => res.text())
            .then(response => {
                notification.innerText = response;
                notification.style.display = "block";
                notification.classList.add("alert-success");
                status.innerHTML = "";
                form.reset();
                setTimeout(() => {
                    notification.style.display = "none";
                }, 5000);
            })
            .catch(() => {
                status.innerHTML = "<span style='color: red;'>Oops! Something went wrong.</span>";
            });
    });

    window.onscroll = function() {
        const btn = document.getElementById("backToTop");
        btn.style.display = (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) ? "flex" :
            "none";
    };

    document.getElementById("backToTop").onclick = function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    };
    </script>

</body>

</html>