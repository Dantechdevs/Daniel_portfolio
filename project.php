<?php include('includes/header.php'); ?>

<!-- AOS CSS for animations -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<section class="projects-section" style="background-color:#0f0f1b; color:#fff; padding:80px 20px;">
    <div class="container">

        <!-- Page Title -->
        <h2 class="text-center mb-5" style="font-size:3rem; color:#f65a5a;">🚀 My Projects</h2>
        <p class="text-center mb-5" style="color:#ccc; font-size:1.1rem;">
            A curated selection of my GitHub repositories and commercial projects.
        </p>

        <?php
        // ===== GitHub Projects =====
        function fetchGitHubRepos($username, $limit = 5)
        {
            $cacheDir = __DIR__ . '/cache';
            if (!is_dir($cacheDir)) mkdir($cacheDir, 0777, true);

            $cacheFile = $cacheDir . '/github_repos.json';
            if (file_exists($cacheFile) && time() - filemtime($cacheFile) < 3600) {
                return json_decode(file_get_contents($cacheFile), true);
            }

            $context = stream_context_create(['http' => ['user_agent' => 'Portfolio']]);
            $response = @file_get_contents("https://api.github.com/users/$username/repos?sort=updated&per_page=$limit", false, $context);
            if (!$response) return [];
            file_put_contents($cacheFile, $response);
            return json_decode($response, true);
        }

        $githubRepos = fetchGitHubRepos('Dantechdevs', 5);

        // ===== Commercial Projects =====
        $commercialProjects = [
            [
                'name' => 'DantePOS',
                'desc' => 'A full-featured POS system with 3 versions: Basic, Standard, and Enterprise.',
                'url' => '#',
                'tech' => ['PHP', 'MySQL', 'JavaScript', 'Bootstrap', 'Tailwind']
            ],
            [
                'name' => 'School Management System',
                'desc' => 'A complete system to manage students, teachers, classes, and exams efficiently.',
                'url' => '#',
                'tech' => ['PHP', 'MySQL', 'JavaScript', 'Bootstrap', 'Tailwind']
            ],
            [
                'name' => 'Loan Management System',
                'desc' => 'A secure system to handle loan applications, approvals, and repayments for clients.',
                'url' => '#',
                'tech' => ['PHP', 'MySQL', 'JavaScript', 'Bootstrap', 'Tailwind']
            ]
        ];

        // Helper: render tech badges
        function renderTechBadges($techArray)
        {
            foreach ($techArray as $tech) {
                echo "<span style='display:inline-block; background:#1f1f2f; color:#f65a5a; font-size:0.8rem; padding:3px 8px; border-radius:5px; margin:2px;'>{$tech}</span> ";
            }
        }
        ?>

        <!-- ===== Projects Grid ===== -->
        <div class="row g-4">

            <!-- GitHub Projects Section -->
            <div class="col-12 mb-4">
                <h3 style="color:#ffd700;">💻 GitHub Projects</h3>
                <hr style="border-color:#333;">
            </div>

            <?php foreach ($githubRepos as $repo): ?>
                <div class="col-md-6 col-lg-4" data-aos="fade-up">
                    <div style="background:#1f1f2f; border-radius:10px; padding:25px; height:100%; display:flex; flex-direction:column; justify-content:space-between; transition:all 0.3s; box-shadow:0 5px 15px rgba(0,0,0,0.3);">
                        <div>
                            <h4 style="color:#f65a5a; margin-bottom:10px; font-size:1.5rem;"><?= htmlspecialchars($repo['name']) ?></h4>
                            <p style="color:#ccc; min-height:70px;"><?= htmlspecialchars($repo['description'] ?? 'No description available.') ?></p>
                        </div>
                        <div>
                            <p style="color:#aaa; font-size:0.85rem; margin-bottom:8px;">
                                <strong>Language:</strong> <?= htmlspecialchars($repo['language'] ?? 'Unknown') ?> |
                                ⭐ <?= htmlspecialchars($repo['stargazers_count']) ?>
                            </p>
                            <a href="<?= htmlspecialchars($repo['html_url']) ?>" target="_blank" style="color:#ffd700; text-decoration:none; font-weight:500;">🔗 View on GitHub</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Commercial Projects Section -->
            <div class="col-12 mt-5 mb-4">
                <h3 style="color:#ffd700;">🏢 Commercial Projects</h3>
                <hr style="border-color:#333;">
            </div>

            <?php foreach ($commercialProjects as $project): ?>
                <div class="col-md-6 col-lg-4" data-aos="fade-up">
                    <div style="background:#1f1f2f; border-radius:10px; padding:25px; height:100%; display:flex; flex-direction:column; justify-content:space-between; transition:all 0.3s; box-shadow:0 5px 15px rgba(0,0,0,0.3);">
                        <div>
                            <h4 style="color:#f65a5a; margin-bottom:10px; font-size:1.5rem;"><?= $project['name'] ?></h4>
                            <p style="color:#ccc; min-height:70px;"><?= $project['desc'] ?></p>
                            <div class="mt-2">
                                <?php renderTechBadges($project['tech']); ?>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="<?= $project['url'] ?>" target="_blank" style="color:#ffd700; text-decoration:none; font-weight:500;">🔗 View Project</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>

<!-- AOS JS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 700,
        once: true
    });
</script>

<?php include('includes/footer.php'); ?>