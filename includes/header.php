<?php if (count(get_included_files()) === 1) { http_response_code(403); exit; } ?>

<!-- ヘッダーコンポーネント -->
<header class="site-header">
    <a href="index.php" class="logo">M. NOGAWA</a>
    <nav class="site-nav" aria-label="メインナビゲーション">
        <ul>
            <li><a href="index.php#about">About</a></li>
            <li><a href="index.php#works">Works</a></li>
            <li><a href="inquiry.php" class="btn-contact">Contact</a></li>
        </ul>
    </nav>
</header>
