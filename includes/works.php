<!-- WORKS セクション -->
<section id="works" class="works-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">WORKS</h2>
            <p class="section-subtitle">SELECTED PROJECTS</p>
        </div>

        <!-- 作品一覧グリッド -->
        <div class="works-grid">
            <?php foreach ($projects as $project): ?>
                <article class="work-card">
                    <a href="<?php echo htmlspecialchars($project['url'], ENT_QUOTES, 'UTF-8'); ?>" class="work-link">
                        <div class="work-image-wrapper">
                            <img src="<?php echo htmlspecialchars($project['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                        <div class="work-meta">
                            <span class="work-category"><?php echo htmlspecialchars($project['category'], ENT_QUOTES, 'UTF-8'); ?></span>
                            <span class="work-year"><?php echo htmlspecialchars($project['year'], ENT_QUOTES, 'UTF-8'); ?></span>
                        </div>
                        <h3 class="work-title"><?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p class="work-desc"><?php echo htmlspecialchars($project['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                    </a>
                </article>
            <?php endforeach; ?>
        </div>

        <!-- 将来作品が増えた時用のアーカイブボタン（必要に応じてコメント解除） -->
        <!--
        <div class="works-more">
            <a href="works.php" class="btn-outline">VIEW ALL ARCHIVES</a>
        </div>
        -->
    </div>
</section>