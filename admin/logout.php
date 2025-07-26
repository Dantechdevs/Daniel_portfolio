<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
} else {
    // If accessed directly, do not logout
    header("Location: dashboard.php");
    exit;
}