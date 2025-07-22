<?php include('includes/header.php'); ?>

<section class="testimonials-section" style="background-color: #0f0f1b; color: #fff; padding: 60px 20px;">
    <div class="container">
        <h2 class="section-title" style="text-align:center; font-size: 36px; margin-bottom: 50px; color: #f65a5a;">
            🌟 Client Testimonials</h2>

        <?php
        $pdo = new PDO("mysql:host=localhost;dbname=daniel_portfolio;charset=utf8mb4", "root", "");

        // Combine priority and latest testimonials using subqueries
        $stmt = $pdo->query("
            SELECT * FROM (
                SELECT id, name, company, message, rating, image, category 
                FROM testimonials 
                WHERE name IN ('Susan', 'Dr Mercy', 'Fredrick') AND image IS NOT NULL
                UNION
                SELECT id, name, company, message, rating, image, category 
                FROM testimonials 
                WHERE name NOT IN ('Susan', 'Dr Mercy', 'Fredrick') 
                ORDER BY id DESC LIMIT 3
            ) AS combined
            ORDER BY id DESC
        ");

        $categories = $pdo->query("SELECT DISTINCT category FROM testimonials WHERE category IS NOT NULL AND category != ''")->fetchAll(PDO::FETCH_COLUMN);
        $avgStmt = $pdo->query("SELECT AVG(rating) AS avg_rating FROM testimonials");
        $avgRating = round($avgStmt->fetchColumn(), 1);
        ?>

        <!-- Average Rating -->
        <div style="text-align: center; margin-bottom: 20px; font-size: 18px; color: #ccc;">
            ⭐ Average Rating: <strong style="color: #ffd700;"><?= $avgRating ?>/5</strong>
        </div>

        <!-- Testimonial Slider -->
        <div class="testimonial-slider" id="testimonialSlider"
            style="display: flex; overflow-x: auto; gap: 20px; scroll-snap-type: x mandatory;">
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $stars = str_repeat('★', $row['rating']) . str_repeat('☆', 5 - $row['rating']);
                echo "
                <div class='testimonial-card' style='min-width: 300px; flex: 0 0 auto; scroll-snap-align: start; background-color: #1f1f2f; padding: 20px; border-radius: 12px; text-align: center; box-shadow: 0 0 10px rgba(0,0,0,0.3);'>
                    <img src='{$row['image']}' alt='{$row['name']}' class='testimonial-avatar' style='width: 60px; height: 60px; border-radius: 50%; object-fit: cover; margin-bottom: 10px;'>
                    <p class='testimonial-message' style='font-style: italic;'>\"{$row['message']}\"</p>
                    <div class='testimonial-stars' style='color: #ffd700; margin-bottom: 10px;'>{$stars}</div>
                    <div class='testimonial-author' style='font-weight: bold;'>- {$row['name']}<br><small style='color: #aaa'>{$row['company']}</small></div>
                </div>
                ";
            } ?>
        </div>

        <!-- Submit Button -->
        <div style="text-align: center; margin-top: 60px;">
            <a href="#testimonial-form" class="btn btn-primary"
                style="padding: 12px 25px; background-color: #f65a5a; border-radius: 30px; color: white; font-weight: bold; text-decoration: none;">Submit
                a Testimonial</a>
        </div>
    </div>
</section>

<!-- Testimonial Form -->
<section id="testimonial-form" style="background-color: #1f1f2f; padding: 60px 20px; color: #fff; margin-top: 60px;">
    <div class="container" style="max-width: 600px; margin: auto;">
        <h3 style="text-align:center; font-size: 28px; margin-bottom: 30px;">📝 Submit a Testimonial</h3>

        <form action="php/save_testimonial.php" method="POST" enctype="multipart/form-data">
            <div class="form-group" style="margin-bottom: 20px;">
                <label>Name <span style="color: #f65a5a">*</span></label>
                <input type="text" name="name" required class="form-control"
                    style="padding: 10px; width: 100%; background: #2a2a40; color: #fff; border: none; border-radius: 8px;">
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label>Company</label>
                <input type="text" name="company" class="form-control"
                    style="padding: 10px; width: 100%; background: #2a2a40; color: #fff; border: none; border-radius: 8px;">
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label>Message <span style="color: #f65a5a">*</span></label>
                <textarea name="message" required rows="4" class="form-control"
                    style="padding: 10px; width: 100%; background: #2a2a40; color: #fff; border: none; border-radius: 8px;"></textarea>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label>Rating (1-5 Stars) <span style="color: #f65a5a">*</span></label>
                <select name="rating" required class="form-control"
                    style="padding: 10px; width: 100%; background: #2a2a40; color: #fff; border: none; border-radius: 8px;">
                    <option value="">-- Select Rating --</option>
                    <option value="5">⭐⭐⭐⭐⭐ - Excellent</option>
                    <option value="4">⭐⭐⭐⭐ - Very Good</option>
                    <option value="3">⭐⭐⭐ - Good</option>
                    <option value="2">⭐⭐ - Fair</option>
                    <option value="1">⭐ - Poor</option>
                </select>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label>Category</label>
                <input type="text" name="category" class="form-control"
                    placeholder="e.g. Web Development, Billing System"
                    style="padding: 10px; width: 100%; background: #2a2a40; color: #fff; border: none; border-radius: 8px;">
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label>Profile Image (optional)</label>
                <input type="file" name="image" accept="image/*" class="form-control"
                    style="background: #2a2a40; color: #fff; padding: 10px; border: none; border-radius: 8px;">
            </div>

            <div style="text-align:center;">
                <button type="submit" class="btn btn-primary"
                    style="padding: 12px 25px; background-color: #f65a5a; border-radius: 30px; color: white; font-weight: bold;">Submit
                    Testimonial</button>
            </div>
        </form>
    </div>
</section>

<script>
// Auto-scroll slider
setInterval(() => {
    const slider = document.getElementById('testimonialSlider');
    if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth) {
        slider.scrollTo({
            left: 0,
            behavior: 'smooth'
        });
    } else {
        slider.scrollBy({
            left: 320,
            behavior: 'smooth'
        });
    }
}, 5000);
</script>

<?php include('includes/footer.php'); ?>