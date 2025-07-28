<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

$pdo = new PDO("mysql:host=localhost;dbname=daniel_portfolio;charset=utf8mb4", "root", "");

// Fetch admin details
$stmt = $pdo->prepare("SELECT * FROM admins WHERE email = ?");
$stmt->execute([$_SESSION['admin_email']]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

$adminEmail = $admin['email'] ?? 'Admin';
$adminName = $admin['name'] ?? 'Admin';
$profileImage = !empty($admin['profile_image']) ? $admin['profile_image'] : 'default.png';

/* Handle profile actions */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update profile info
    if (isset($_POST['update_profile'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $stmt = $pdo->prepare("UPDATE admins SET name=?, email=? WHERE email=?");
        $stmt->execute([$name, $email, $_SESSION['admin_email']]);
        $_SESSION['admin_email'] = $email;
        header("Location: dashboard.php");
        exit;
    }

    // Change password
    if (isset($_POST['change_password'])) {
        $hashed = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE admins SET password=? WHERE email=?");
        $stmt->execute([$hashed, $_SESSION['admin_email']]);
        header("Location: dashboard.php");
        exit;
    }

    // Change profile picture
    if (isset($_POST['change_picture']) && isset($_FILES['profile_pic'])) {
        $targetDir = __DIR__ . '/../assets/img/';
        $fileName = time() . "_" . basename($_FILES["profile_pic"]["name"]);
        $targetFile = $targetDir . $fileName;
        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $targetFile)) {
            $stmt = $pdo->prepare("UPDATE admins SET profile_image=? WHERE email=?");
            $stmt->execute([$fileName, $_SESSION['admin_email']]);
        }
        header("Location: dashboard.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
    body {
        margin: 0;
        font-family: 'Segoe UI', sans-serif;
        background-color: #0f0f1b;
        color: #fff;
        display: flex;
        height: 100vh;
    }

    /* Sidebar */
    .sidebar {
        width: 240px;
        background-color: #1f1f2f;
        display: flex;
        flex-direction: column;
        padding: 20px 0;
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
    }

    .sidebar h2 {
        text-align: center;
        color: #f65a5a;
        margin-bottom: 30px;
        font-size: 22px;
    }

    .sidebar a {
        display: block;
        padding: 12px 20px;
        color: #ccc;
        text-decoration: none;
        transition: background 0.3s ease;
    }

    .sidebar a:hover,
    .sidebar a.active {
        background-color: #f65a5a;
        color: #fff;
        font-weight: bold;
    }

    /* Main content scrollable */
    .main-content {
        margin-left: 240px;
        padding: 20px;
        flex: 1;
        height: 100vh;
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: #f65a5a #1f1f2f;
    }

    .main-content::-webkit-scrollbar {
        width: 8px;
    }

    .main-content::-webkit-scrollbar-track {
        background: #1f1f2f;
    }

    .main-content::-webkit-scrollbar-thumb {
        background-color: #f65a5a;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    .main-content::-webkit-scrollbar-thumb:hover {
        background-color: #ffd700;
        /* golden hover */
    }

    .header-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .header-bar h1 {
        font-size: 28px;
        color: #f65a5a;
        margin: 0;
    }

    /* Profile dropdown */
    .profile-info {
        position: relative;
        cursor: pointer;
    }

    .profile-info img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 2px solid #f65a5a;
    }

    .profile-dropdown {
        display: none;
        position: absolute;
        right: 0;
        top: 50px;
        background: #1f1f2f;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        width: 250px;
        z-index: 999;
        padding: 10px;

        /* Animation */
        opacity: 0;
        transform: translateY(-10px);
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .profile-dropdown.show {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }

    .profile-dropdown h3 {
        text-align: center;
        color: #ffd700;
        margin: 10px 0;
    }

    .profile-dropdown form {
        display: flex;
        flex-direction: column;
        margin-bottom: 10px;
    }

    .profile-dropdown input[type="text"],
    .profile-dropdown input[type="email"],
    .profile-dropdown input[type="password"],
    .profile-dropdown input[type="file"] {
        margin-bottom: 8px;
        padding: 8px;
        border-radius: 5px;
        border: none;
        font-size: 14px;
    }

    .profile-dropdown button {
        background: #f65a5a;
        border: none;
        padding: 8px;
        border-radius: 5px;
        color: #fff;
        cursor: pointer;
        margin-bottom: 5px;
        transition: background-color 0.3s ease;
    }

    .profile-dropdown button:hover {
        background: #e54e4e;
    }

    .strength {
        height: 5px;
        border-radius: 3px;
        background: #333;
        margin-bottom: 5px;
    }

    .strength.weak {
        background: red;
    }

    .strength.medium {
        background: orange;
    }

    .strength.strong {
        background: green;
    }

    /* Cards */
    .card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 50px;
    }

    .card {
        background-color: #1f1f2f;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
    }

    .card h2 {
        color: #ffd700;
        margin-bottom: 10px;
    }

    .card p {
        color: #aaa;
        margin-bottom: 20px;
    }

    .card a {
        display: inline-block;
        padding: 10px 15px;
        background-color: #f65a5a;
        color: #fff;
        border-radius: 6px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .card a:hover {
        background-color: #e54e4e;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .sidebar {
            width: 200px;
        }

        .main-content {
            margin-left: 200px;
        }
    }

    @media (max-width: 576px) {
        .sidebar {
            position: relative;
            width: 100%;
            flex-direction: row;
            justify-content: space-around;
        }

        .main-content {
            margin-left: 0;
            margin-top: 60px;
        }
    }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="manage_blogs.php">Blogs</a>
        <a href="add_blog.php">Add Blog</a>
        <a href="edit_blog.php">Edit Blog</a>
        <a href="delete_blog.php">Delete Blog</a>
        <a href="manage_blog.php">Manage Blog</a>
        <a href="manage_admins.php">Manage Admins</a>
        <a href="upload_project.php" class="active">Upload Project</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header-bar">
            <h1>Welcome, <?= htmlspecialchars($adminName) ?> 👋</h1>
            <div class="profile-info" onclick="toggleDropdown()">
                <img src="../assets/img/<?= htmlspecialchars($profileImage) ?>" alt="Profile">
                <div class="profile-dropdown" id="profileDropdown">
                    <!-- Edit Profile -->
                    <form method="POST">
                        <h3>Edit Profile</h3>
                        <input type="text" name="name" value="<?= htmlspecialchars($adminName) ?>" required>
                        <input type="email" name="email" value="<?= htmlspecialchars($adminEmail) ?>" required>
                        <button type="submit" name="update_profile">Save</button>
                    </form>
                    <!-- Change Picture -->
                    <form method="POST" enctype="multipart/form-data">
                        <h3>Change Picture</h3>
                        <input type="file" name="profile_pic" accept="image/*" onchange="previewImage(event)">
                        <img id="preview" style="width:100%;border-radius:8px;display:none;margin-bottom:5px;">
                        <button type="submit" name="change_picture">Upload</button>
                    </form>
                    <!-- Change Password -->
                    <form method="POST">
                        <h3>Change Password</h3>
                        <input type="password" name="new_password" placeholder="New Password" id="passwordInput"
                            required>
                        <div class="strength" id="strengthBar"></div>
                        <button type="submit" name="change_password">Update Password</button>
                    </form>
                    <!-- Logout -->
                    <form action="logout.php" method="POST">
                        <button type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </div>

        <p>Manage all sections of your portfolio website from here.</p>

        <div class="card-grid">
            <div class="card">
                <h2>📝 Blog Posts</h2>
                <p>Manage, edit and create blog posts for visitors.</p>
                <a href="manage_blogs.php">Go to Blogs</a>
            </div>
            <div class="card">
                <h2>➕ Add Blog</h2>
                <p>Create a new blog post with title, category and content.</p>
                <a href="add_blog.php">Add Blog</a>
            </div>
            <div class="card">
                <h2>📂 Manage Blogs</h2>
                <p>View and organize all blog posts in one place.</p>
                <a href="manage_blog.php">Manage Blogs</a>
            </div>
            <div class="card">
                <h2>👤 Manage Admins</h2>
                <p>Add or remove administrators from the system.</p>
                <a href="manage_admins.php">Manage Admins</a>
            </div>
        </div>
    </div>

    <script>
    function toggleDropdown() {
        const dropdown = document.getElementById('profileDropdown');
        dropdown.classList.toggle('show');
    }
    window.addEventListener('click', function(e) {
        if (!e.target.closest('.profile-info')) {
            document.getElementById('profileDropdown').classList.remove('show');
        }
    });

    // Live password strength check
    const passwordInput = document.getElementById('passwordInput');
    const strengthBar = document.getElementById('strengthBar');
    passwordInput.addEventListener('input', () => {
        const val = passwordInput.value;
        let strength = 0;
        if (val.length >= 6) strength++;
        if (/[A-Z]/.test(val)) strength++;
        if (/[0-9]/.test(val)) strength++;
        if (/[^A-Za-z0-9]/.test(val)) strength++;
        strengthBar.className = 'strength ' + (strength <= 1 ? 'weak' : strength == 2 ? 'medium' : 'strong');
    });

    // Preview profile image
    function previewImage(event) {
        const preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(event.target.files[0]);
        preview.style.display = 'block';
    }
    </script>
</body>
<?php include '../includes/footer.php'; ?>

</html>