<?php
// クリックジャッキング対策（他サイトのiframe内での表示を禁止）
header('X-Frame-Options: DENY');
// MIMEタイプスニッフィング対策（ファイルの誤認実行を防止）
header('X-Content-Type-Options: nosniff');
// リファラー情報の制限（外部リンク遷移時の情報漏洩を防止）
header('Referrer-Policy: strict-origin-when-cross-origin');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masafumi Nogawa | Portfolio</title>
    <meta name="description" content="The site of Masafumi Nogawa">
    <link rel="icon" href="./images/favicon.ico" type="image/x-icon">
    
    <!-- CSSファイルの読み込み -->
    <link rel="stylesheet" href="./css/ress.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/mainvisual.css">
    <link rel="stylesheet" href="./css/intro.css">
    <link rel="stylesheet" href="./css/works.css">
    <link rel="stylesheet" href="./css/contact.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500&family=Cormorant+Garamond:wght@400&display=swap" rel="stylesheet">
    <script src="./js/main.js" defer></script>
</head>
<body>
    <div class="screen-wrapper">
        <main class="container">
            
            <!-- ① 一幕目：タイトル（0秒〜3秒） -->
            <div class="title-area">
                <h1 class="antique-text">Works by Masafumi Nogawa</h1>
            </div>
            
            <!-- ② 二幕目：文章（3秒〜5秒） -->
            <div class="main-content">
                <p>美しいコードと、使いやすさを両立させる。</p>
            </div>

            <!-- ③ 三幕目：文章（5秒〜9秒） -->
            <div class="works-content">
                <h2 class="reveal-text">
                    <span class="reveal-text__inner">目的を達成するためのWebサイト構築を。</span>
                </h2>
            </div>

            <!-- ④ 四幕目（本編）：ここから下へスクロール可能になります -->
            <div class="site-main-content">
                
                <?php include __DIR__ . '/includes/header.php'; ?>
                
                <?php include __DIR__ . '/includes/mainvisual.php'; ?>
                    
                <?php include __DIR__ . '/includes/intro.php'; ?>

                <?php include __DIR__ . '/includes/projects.php'; ?>

                <?php include __DIR__ . '/includes/works.php'; ?>

            </div>

        </main>
    </div>
</body>
</html>
