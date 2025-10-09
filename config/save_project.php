<?php
$pdo = new PDO("mysql:host=localhost;dbname=daniel_portfolio;charset=utf8mb4", "root", "");

// Handle uploaded image
$imagePath = '';
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = '../uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $filename = time() . '_' . basename($_FILES['image']['name']);
    $targetPath = $uploadDir . $filename;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
        $imagePath = 'uploads/' . $filename;
    }
}

// Save to database
$stmt = $pdo->prepare("INSERT INTO projects (title, description, github_url, image, created_at) VALUES (?, ?, ?, ?, NOW())");
$stmt->execute([
    $_POST['title'],
    $_POST['description'],
    $_POST['github_url'],
    $imagePath
]);

// Redirect back to the project page
header("Location: ../project.php");
exit;