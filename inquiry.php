<?php
// セキュリティヘッダの付与
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');

// ==========================================
// 1. 設定エリア
// ==========================================
$site_name       = 'NOGAWA PORTFOLIO';
$google_form_url = getenv('FORM_URL') ?: 'https://docs.google.com/forms/d/e/1FAIpQLScNTDV2-XgnI9MoCjcA8H4bVkwB8F9ZHzF534zr1NVSYMMnIQ/viewform?embedded=true';

// 安全なGoogleフォームのURLかチェック
$is_valid_url = (strpos($google_form_url, 'https://docs.google.com/forms/') === 0);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONTACT | <?php echo htmlspecialchars($site_name, ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="icon" href="./images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./css/ress.min.css">
    <link rel="stylesheet" href="./css/inquiry.css">
    <style>
        /* Googleフォーム埋め込み用の調整スタイル */
        .google-form-wrapper {
            width: 100%;
            background-color: #FFFFFF;
            border: 1px solid rgba(142, 135, 126, 0.25);
            padding: 16px 0;
            overflow: hidden;
        }
        .google-form-iframe {
            width: 100%;
            min-height: 820px;
            border: none;
            display: block;
        }
    </style>
</head>
<body>

<main class="contact-page">
    <a href="index.php" class="back-link">← BACK TO HOME</a>

    <header class="page-header">
        <h1 class="page-title">CONTACT</h1>
        <p class="page-subtitle">GET IN TOUCH</p>
        <p class="page-lead">
            制作のご依頼、お見積もりのご相談など、下記フォームよりお気軽にお問い合わせください。<br>
            内容を確認のうえ、通常2〜3営業日以内にご返信いたします。
        </p>
    </header>

    <?php if ($is_valid_url): ?>
        <!-- Googleフォーム埋め込みエリア -->
        <div class="google-form-wrapper">
            <iframe
                src="<?php echo htmlspecialchars($google_form_url, ENT_QUOTES, 'UTF-8'); ?>"
                class="google-form-iframe"
                title="お問い合わせフォーム"
                loading="lazy">
                読み込んでいます…
            </iframe>
        </div>
    <?php else: ?>
        <div class="error-box">
            <p>現在お問い合わせフォームの準備中です。</p>
        </div>
    <?php endif; ?>

</main>

</body>
</html>
