<?php include('includes/header.php'); ?>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<section class="projects-section" style="background-color:#0f0f1b; color:#fff; padding:60px 20px;">
    <div class="container">
        <h2 class="text-center mb-5" style="font-size:36px; color:#f65a5a;">🚀 Latest GitHub Projects</h2>

        <?php
        // ===== Fetch Repositories from GitHub API =====
        function fetchGitHubRepos($username, $limit = 5)
        {
            $url = "https://api.github.com/users/$username/repos?sort=updated&per_page=$limit";
            $context = stream_context_create([
                'http' => [
                    'user_agent' => 'Dantechdevs-Portfolio',
                    'timeout' => 10
                ]
            ]);
            $response = @file_get_contents($url, false, $context);
            return $response ? json_decode($response, true) : [];
        }

        $repos = fetchGitHubRepos('Dantechdevs', 5);
        ?>

        <div class="row g-4 justify-content-center">
            <?php if (!empty($repos)): ?>
                <?php foreach ($repos as $repo): ?>
                    <?php
                    $name = htmlspecialchars($repo['name']);
                    $desc = htmlspecialchars($repo['description'] ?? 'No description available.');
                    $url = htmlspecialchars($repo['html_url']);
                    $lang = htmlspecialchars($repo['language'] ?? 'Unknown');
                    $stars = htmlspecialchars($repo['stargazers_count']);
                    $owner = htmlspecialchars($repo['owner']['login']);

                    // Try to load repo image (common screenshot name)
                    $imageUrl = "https://raw.githubusercontent.com/$owner/$name/main/screenshot.png";
                    $headers = @get_headers($imageUrl);
                    if (!$headers || strpos($headers[0], '200') === false) {
                        $imageUrl = "assets/img/project-placeholder.jpg"; // fallback image
                    }
                    ?>
                    <div class="col-md-6 col-lg-4" data-aos="fade-up">
                        <div class="p-3 rounded h-100 shadow" style="background:#1f1f2f; display:flex; flex-direction:column;">
                            <div class="mb-3 d-flex align-items-center justify-content-center"
                                style="height:200px; background:#2a2a40; overflow:hidden; border-radius:10px;">
                                <img src="<?= $imageUrl ?>" alt="<?= $name ?>" class="img-fluid"
                                    style="max-height:100%; object-fit:cover;">
                            </div>
                            <h4 style="color:#f65a5a;"><?= $name ?></h4>
                            <p style="color:#ccc;"><?= $desc ?></p>
                            <p style="color:#aaa; font-size:14px;">
                                <strong>Language:</strong> <?= $lang ?> |
                                ⭐ <?= $stars ?>
                            </p>
                            <a href="<?= $url ?>" target="_blank"
                                style="color:#ffd700; text-decoration:underline;">🔗 View on GitHub</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center text-muted">⚠️ Unable to fetch repositories. Please check your internet connection or GitHub API limit.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>

<?php include('includes/footer.php'); ?>