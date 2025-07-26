<footer class="site-footer">
    <style>
    /* Sticky Layout Support */
    html,
    body {
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column;
    }

    main {
        flex: 1;
        /* Pushes footer to bottom */
    }

    /* Footer Styling */
    .site-footer {
        background: linear-gradient(135deg, #1a1a1a, #0f0f1b);
        color: #e0e0e0;
        text-align: center;
        padding: 25px 10px;
        font-size: 16px;
        border-top: 3px solid #f65a5a;
        box-shadow: 0 -3px 8px rgba(0, 0, 0, 0.4);
        width: 100%;
    }

    .site-footer .container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .site-footer p {
        margin: 5px 0;
    }

    .site-footer strong {
        color: #f65a5a;
    }

    .site-footer a {
        color: #fcc500;
        font-weight: bold;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .site-footer a:hover {
        color: #fff;
        text-decoration: underline;
    }
    </style>

    <div class="container">
        <p>&copy; <?= date('Y'); ?> - <strong>DANTE SOFTWARES LTD</strong>. All Rights Reserved.</p>
        <p>
            Terms and Conditions apply. Contact:
            <a href="mailto:dantechdevs@gmail.com">dantechdevs@gmail.com</a>
        </p>
    </div>
</footer>