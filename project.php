<?php include('includes/header.php'); ?>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<section class="projects-section" style="background-color: #0f0f1b; color: #fff; padding: 60px 20px;">
    <div class="container">
        <h2 class="text-center mb-5" style="font-size: 36px; color: #f65a5a;">🚀 My Projects</h2>

        <?php
        // GitHub fetch function
        function fetchGitHubProjects($username, $limit = 3)
        {
            $apiUrl = "https://api.github.com/users/$username/repos?per_page=$limit";
            $context = stream_context_create([
                'http' => ['user_agent' => 'portfolio-site']
            ]);
            $response = @file_get_contents($apiUrl, false, $context);
            return $response ? json_decode($response, true) : [];
        }

        // Local projects from DB
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=daniel_portfolio;charset=utf8mb4", "root", "");
            $stmt = $pdo->query("SELECT * FROM projects ORDER BY created_at DESC LIMIT 6");
            $localProjects = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $localProjects = [];
        }

        $githubProjects = fetchGitHubProjects('Dantechdevs', 3);
        ?>

        <div class="row g-4 justify-content-center">
            <!-- Local Projects -->
            <?php if (!empty($localProjects)): ?>
            <?php foreach ($localProjects as $proj): ?>
            <div class="col-md-6 col-lg-4" data-aos="fade-up">
                <div class="p-3 rounded h-100" style="background:#1f1f2f;">
                    <?php if (!empty($proj['image'])): ?>
                    <img src="<?= htmlspecialchars($proj['image']) ?>" alt="<?= htmlspecialchars($proj['title']) ?>"
                        class="img-fluid rounded mb-3" style="height: 200px; object-fit: contain; background:#2a2a40;">
                    <?php endif; ?>
                    <h4 style="color: #f65a5a;"><?= htmlspecialchars($proj['title']) ?></h4>
                    <p style="color: #ccc;"><?= nl2br(htmlspecialchars($proj['description'])) ?></p>
                    <?php if (!empty($proj['github_url'])): ?>
                    <a href="<?= htmlspecialchars($proj['github_url']) ?>" target="_blank"
                        style="color: #ffd700; text-decoration: underline;">🔗 View on GitHub</a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <p class="text-center text-muted">No local projects found.</p>
            <?php endif; ?>

            <!-- GitHub Projects -->
            <?php if (!empty($githubProjects)): ?>
            <?php foreach ($githubProjects as $repo): ?>
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="p-3 rounded h-100" style="background:#1f1f2f;">
                    <h4 style="color: #f65a5a;"><?= htmlspecialchars($repo['name']) ?></h4>
                    <p style="color: #ccc;">
                        <?= nl2br(htmlspecialchars($repo['description'] ?? 'No description available.')) ?>
                    </p>
                    <a href="<?= htmlspecialchars($repo['html_url']) ?>" target="_blank"
                        style="color: #ffd700; text-decoration: underline;">🔗 View on GitHub</a>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <p class="text-center text-muted">Unable to fetch GitHub repositories.</p>
            <?php endif; ?>
        </div>

        <!-- Upload Form -->
        <div class="mt-5 mx-auto" style="max-width: 600px;">
            <h3 class="text-center mb-3">📤 Upload a Project</h3>

            <?php if (isset($_GET['success']) && $_GET['success'] === "1"): ?>
            <div class="alert alert-success text-center">
                ✅ Project uploaded successfully!
            </div>
            <?php endif; ?>

            <form action="php/save_project.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="title" placeholder="Project Title" required
                    class="form-control mb-3 bg-dark text-light border-0 rounded-3">
                <textarea name="description" placeholder="Project Description" required rows="3"
                    class="form-control mb-3 bg-dark text-light border-0 rounded-3"></textarea>
                <input type="url" name="github_url" placeholder="GitHub URL (optional)"
                    class="form-control mb-3 bg-dark text-light border-0 rounded-3">
                <input type="file" name="image" accept="image/*"
                    class="form-control mb-3 bg-dark text-light border-0 rounded-3">
                <button type="submit" class="btn w-100 fw-bold"
                    style="background-color: #f65a5a; color: white; border-radius: 8px;">
                    Upload Project
                </button>
            </form>
        </div>
    </div>
</section>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init();
</script>

<?php include('includes/footer.php'); ?>