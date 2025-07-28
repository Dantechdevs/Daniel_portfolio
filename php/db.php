<?php
// Database credentials
$host = "localhost";       // or 127.0.0.1
$dbname = "daniel_portfolio"; // Your portfolio database name
$username = "root";        // Default XAMPP username
$password = "";            // Default XAMPP password is empty

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle connection error
    die("Database connection failed: " . $e->getMessage());
}