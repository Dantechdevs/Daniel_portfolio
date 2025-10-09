<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Invalid request.');
}

$pdo = new PDO("mysql:host=localhost;dbname=daniel_portfolio;charset=utf8mb4", "root", "");

// Handle image upload
$imagePath = '';
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . '.' . $ext;
    $destination = '../uploads/testimonials/' . $filename;

    // Ensure upload directory exists
    if (!file_exists('../uploads/testimonials')) {
        mkdir('../uploads/testimonials', 0777, true);
    }

    move_uploaded_file($_FILES['image']['tmp_name'], $destination);
    $imagePath = 'uploads/testimonials/' . $filename;
}

// Insert testimonial
$stmt = $pdo->prepare("INSERT INTO testimonials (name, company, message, rating, category, image)
                       VALUES (:name, :company, :message, :rating, :category, :image)");

$stmt->execute([
    ':name'     => $_POST['name'],
    ':company'  => $_POST['company'] ?? '',
    ':message'  => $_POST['message'],
    ':rating'   => $_POST['rating'],
    ':category' => $_POST['category'] ?? '',
    ':image'    => $imagePath
]);

header('Location: ../testimonial.php?success=1');
exit;
