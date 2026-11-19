<?php if (count(get_included_files()) === 1) { http_response_code(403); exit; } ?>

<?php

// 制作実績データ（作品が増えたらこの配列に追加するだけでOKです）
$projects = [
    [
        'title' => 'Personal Training Gym LP',
        'category' => 'HTML / CSS / JS',
        'year' => '2026',
        'image' => '../images/ai-project.png', // 画像パスを指定してください
        'url' => 'https://masafuminogawa232.github.io/AIproject?v=12352', // 詳細ページや実際のサイトURL
        'description' => 'AIを用いてデザイン案を作成し、RIZAPの模写コーディングしたフィットネスジムのLP。視認性の高い情報設計と、各デバイス幅に美しく最適化されるレスポンシブ実装を取り入れました。'
    ],
    [
        'title' => 'Cozy Coffee Shop',
        'category' => 'HTML / CSS',
        'year' => '2026',
        'image' => '../images/cafe-site.png', // 画像パスを指定してください
        'url' => 'https://masafuminogawa232.github.io/cafe-site?v=12352', // 詳細ページや実際のサイトURL
        'description' => '自家焙煎コーヒーを提供するカフェの店舗紹介サイト。' .
            '心地よい空間と一杯のこだわりが伝わるよう、Google Fontsや落ち着いた配色を用いた' .
            '洗練されたデザイン・レスポンシブ設計を実装しました。'
    ],
    [
        'title' => 'Funiture Design',
        'category' => 'HTML / CSS / JS / PHP',
        'year' => '2026',
        'image' => '../images/chair.png',
        'url' => 'https://furniture-design-t11d.onrender.com/index.php',
        'description' => '家具デザイン会社のコーポレートサイト。' .
            'PHPを用いた動的なコンテンツ生成と、ユーザーが快適に閲覧できるように' .
            'レスポンシブデザインを採用しました。'
    ]
];
?>
