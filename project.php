<?php include('includes/header.php'); ?>

<section class="projects-section" style="background-color: #0f0f1b; color: #fff; padding: 60px 20px;">
    <div class="container">
        <h2 style="text-align:center; font-size: 36px; margin-bottom: 50px; color: #f65a5a;">🚀 My Projects</h2>

        <?php
        // GitHub fetch function
        function fetchGitHubProjects($username, $limit = 3)
        {
            $apiUrl = "https://api.github.com/users/$username/repos?per_page=$limit";
            $context = stream_context_create([
                'http' => ['user_agent' => 'portfolio-site']
            ]);
            $response = file_get_contents($apiUrl, false, $context);
            return json_decode($response, true);
        }

        // Local projects
        $pdo = new PDO("mysql:host=localhost;dbname=daniel_portfolio;charset=utf8mb4", "root", "");
        $stmt = $pdo->query("SELECT * FROM projects ORDER BY created_at DESC LIMIT 6");
        $localProjects = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // GitHub Projects
        $githubProjects = fetchGitHubProjects('your-github-username', 3); // Replace with your GitHub username
        ?>

        <div class="projects-grid"
            style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
            <!-- Local Projects -->
            <?php foreach ($localProjects as $proj): ?>
            <div style="background: #1f1f2f; padding: 20px; border-radius: 12px; box-shadow: 0 0 10px rgba(0,0,0,0.3);">
                <?php if (!empty($proj['image'])): ?>
                <img src="<?= htmlspecialchars($proj['image']) ?>" alt="<?= htmlspecialchars($proj['title']) ?>"
                    style="width: 100%; height: 200px; object-fit: contain; border-radius: 8px; margin-bottom: 10px; background-color: #2a2a40;">
                <?php endif; ?>
                <h4 style="color: #f65a5a;"><?= htmlspecialchars($proj['title']) ?></h4>
                <p style="color: #ccc;"><?= nl2br(htmlspecialchars($proj['description'])) ?></p>
                <?php if (!empty($proj['github_url'])): ?>
                <a href="<?= htmlspecialchars($proj['github_url']) ?>" target="_blank"
                    style="color: #ffd700; text-decoration: underline;">View on GitHub</a>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>

            <!-- GitHub Projects -->
            <?php foreach ($githubProjects as $repo): ?>
            <div style="background: #1f1f2f; padding: 20px; border-radius: 12px; box-shadow: 0 0 10px rgba(0,0,0,0.3);">
                <h4 style="color: #f65a5a;"><?= htmlspecialchars($repo['name']) ?></h4>
                <p style="color: #ccc;">
                    <?= nl2br(htmlspecialchars($repo['description'] ?? 'No description available.')) ?></p>
                <a href="<?= htmlspecialchars($repo['html_url']) ?>" target="_blank"
                    style="color: #ffd700; text-decoration: underline;">View on GitHub</a>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Upload Project Form -->
        <div style="max-width: 600px; margin: auto; margin-top: 80px;">
            <h3 style="text-align: center; font-size: 24px; margin-bottom: 20px;">📤 Upload a Project</h3>
            <form action="php/save_project.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="title" placeholder="Project Title" required
                    style="padding: 10px; width: 100%; background: #2a2a40; color: #fff; margin-bottom: 10px; border: none; border-radius: 8px;">
                <textarea name="description" placeholder="Project Description" required rows="3"
                    style="padding: 10px; width: 100%; background: #2a2a40; color: #fff; margin-bottom: 10px; border: none; border-radius: 8px;"></textarea>
                <input type="url" name="github_url" placeholder="GitHub URL (optional)"
                    style="padding: 10px; width: 100%; background: #2a2a40; color: #fff; margin-bottom: 10px; border: none; border-radius: 8px;">
                <input type="file" name="image" accept="image/*"
                    style="padding: 10px; width: 100%; background: #2a2a40; color: #fff; border: none; border-radius: 8px; margin-bottom: 10px;">
                <button type="submit" class="btn btn-primary"
                    style="width: 100%; padding: 12px; background-color: #f65a5a; border-radius: 8px; color: white; font-weight: bold; border: none;">
                    Upload Project
                </button>
            </form>
        </div>
    </div>
</section>

<?php include('includes/footer.php'); ?>