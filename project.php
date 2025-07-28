<?php include('includes/header.php'); ?>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<section class="projects-section" style="background-color: #0f0f1b; color: #fff; padding: 60px 20px;">
    <div class="container">
        <h2 class="text-center mb-5" style="font-size: 36px; color: #f65a5a;">🚀 My Projects</h2>

        <?php
        function fetchGitHubProjects($username, $limit = 3)
        {
            $apiUrl = "https://api.github.com/users/$username/repos?per_page=$limit";
            $context = stream_context_create(['http' => ['user_agent' => 'portfolio-site']]);
            $response = @file_get_contents($apiUrl, false, $context);
            return $response ? json_decode($response, true) : [];
        }

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
                <div class="p-3 rounded h-100" style="background:#1f1f2f; display: flex; flex-direction: column;">
                    <?php if (!empty($proj['image'])): ?>
                    <div class="mb-3 d-flex align-items-center justify-content-center"
                        style="height: 200px; background:#2a2a40; overflow: hidden;">
                        <img src="<?= htmlspecialchars(basename($proj['image'])) ?>"
                            alt="<?= htmlspecialchars($proj['title']) ?>" class="img-fluid rounded"
                            style="max-height: 100%; object-fit: contain;">
                    </div>
                    <?php endif; ?>
                    <h4 style="color: #f65a5a;"><?= htmlspecialchars($proj['title']) ?></h4>
                    <p style="color: #ccc;">
                        <?= nl2br(htmlspecialchars($proj['description'])) ?: '<em>No description available.</em>' ?></p>
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
                        <?= nl2br(htmlspecialchars($repo['description'] ?? 'No description available.')) ?></p>
                    <a href="<?= htmlspecialchars($repo['html_url']) ?>" target="_blank"
                        style="color: #ffd700; text-decoration: underline;">🔗 View on GitHub</a>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <p class="text-center text-muted">Unable to fetch GitHub repositories.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init();
</script>

<?php include('includes/footer.php'); ?>