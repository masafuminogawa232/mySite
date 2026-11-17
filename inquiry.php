<?php
session_start();

// ==========================================
// 1. 設定エリア（ここをご自身の環境に合わせて変更してください）
// ==========================================
$admin_email = 'masafuminogawa@icloud.com'; // 受信するあなたのメールアドレス
$site_name   = 'NOGAWA PORTFOLIO';              // サイト名（メール件名等に使用）

// ==========================================
// 2. 初期化・CSRFトークン生成
// ==========================================
$errors = [];
$is_sent = false;

$name    = '';
$email   = '';
$subject = '';
$message = '';

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

// ==========================================
// 3. フォーム送信時の処理
// ==========================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRFトークン検証
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $errors[] = '不正なリクエストが検出されました。画面を再読み込みして再度お試しください。';
    } else {
        // 入力値の取得と前後の空白削除
        $name    = trim($_POST['name'] ?? '');
        $email   = trim($_POST['email'] ?? '');
        $subject = trim($_POST['subject'] ?? '');
        $message = trim($_POST['message'] ?? '');

        // バリデーション（入力チェック）
        if ($name === '') {
            $errors[] = 'お名前を入力してください。';
        }
        if ($email === '') {
            $errors[] = 'メールアドレスを入力してください。';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = '正しいメールアドレスの形式で入力してください。';
        }
        if ($message === '') {
            $errors[] = 'お問い合わせ内容を入力してください。';
        }

        // エラーがなければメール送信実行
        if (empty($errors)) {
            mb_language('Japanese');
            mb_internal_encoding('UTF-8');

            $mail_subject = "【{$site_name}】お問い合わせがありました";
            
            $mail_body  = "ポートフォリオサイトよりお問い合わせがありました。\n\n";
            $mail_body .= "--------------------------------------------------\n";
            $mail_body .= "お名前： {$name}\n";
            $mail_body .= "メールアドレス： {$email}\n";
            $mail_body .= "ご用件： " . ($subject !== '' ? $subject : '（未選択）') . "\n";
            $mail_body .= "--------------------------------------------------\n\n";
            $mail_body .= "【お問い合わせ内容】\n";
            $mail_body .= "{$message}\n";

            // 送信元ヘッダー（サーバーの仕様に合わせ、Fromは自ドメイン推奨・Reply-Toに相手先を設定）
            $headers  = "From: {$admin_email}\r\n";
            $headers .= "Reply-To: {$email}\r\n";

            if (mb_send_mail($admin_email, $mail_subject, $mail_body, $headers)) {
                $is_sent = true;
                // 二重送信防止のためトークンを再生成し、入力値をクリア
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                $name = $email = $subject = $message = '';
            } else {
                $errors[] = 'メールの送信に失敗しました。時間をおいて再度お試しください。';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONTACT | <?php echo htmlspecialchars($site_name, ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="icon" href="./images/favicon.ico" type="image/x-icon">
    <!-- 外部スタイルシートの読み込み（フォルダ構成に合わせてパスを調整してください） -->
    <link rel="stylesheet" href="./css/ress.min.css">
    <link rel="stylesheet" href="./css/inquiry.css">
</head>
<body>

<main class="contact-page">
    <a href="index.php" class="back-link">← BACK TO HOME</a>

    <header class="page-header">
        <h1 class="page-title">CONTACT</h1>
        <p class="page-subtitle">GET IN TOUCH</p>
        <?php if (!$is_sent): ?>
            <p class="page-lead">
                制作のご依頼、お見積もりのご相談など、下記フォームよりお気軽にお問い合わせください。<br>
                内容を確認のうえ、通常2〜3営業日以内にご返信いたします。
            </p>
        <?php endif; ?>
    </header>

    <?php if ($is_sent): ?>
        <!-- 送信完了メッセージ -->
        <div class="thanks-box">
            <h2 class="thanks-title">お問い合わせを受け付けました</h2>
            <p class="thanks-text">
                ご連絡いただき誠にありがとうございます。<br>
                お送りいただいた内容を確認のうえ、担当者より折り返しご連絡いたします。
            </p>
            <a href="index.php" class="btn-submit btn-return">RETURN TO TOP</a>
        </div>

    <?php else: ?>
        <!-- エラー表示 -->
        <?php if (!empty($errors)): ?>
            <div class="error-box">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- 入力フォーム -->
        <form action="inquiry.php" method="POST" novalidate>
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token, ENT_QUOTES, 'UTF-8'); ?>">

            <div class="form-group">
                <label for="name" class="form-label">お名前<span class="badge-required">必須</span></label>
                <input type="text" id="name" name="name" class="form-control" placeholder="例：山田 太郎" value="<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">メールアドレス<span class="badge-required">必須</span></label>
                <input type="email" id="email" name="email" class="form-control" placeholder="例：info@example.com" value="<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="form-group">
                <label for="subject" class="form-label">ご用件<span class="badge-optional">任意</span></label>
                <select id="subject" name="subject" class="form-control">
                    <option value="">選択してください</option>
                    <option value="Webサイト制作のご依頼" <?php if ($subject === 'Webサイト制作のご依頼') echo 'selected'; ?>>Webサイト制作のご依頼</option>
                    <option value="コーディング・システム開発のご相談" <?php if ($subject === 'コーディング・システム開発のご相談') echo 'selected'; ?>>コーディング・システム開発のご相談</option>
                    <option value="お見積もりのご依頼" <?php if ($subject === 'お見積もりのご依頼') echo 'selected'; ?>>お見積もりのご依頼</option>
                    <option value="その他のお問い合わせ" <?php if ($subject === 'その他のお問い合わせ') echo 'selected'; ?>>その他のお問い合わせ</option>
                </select>
            </div>

            <div class="form-group">
                <label for="message" class="form-label">お問い合わせ内容<span class="badge-required">必須</span></label>
                <textarea id="message" name="message" class="form-control" placeholder="ご相談内容やご予算、ご希望の納期などがございましたらご記入ください。" required><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></textarea>
            </div>

            <div class="form-submit">
                <button type="submit" class="btn-submit">SEND MESSAGE →</button>
            </div>
        </form>
    <?php endif; ?>
</main>

</body>
</html>
