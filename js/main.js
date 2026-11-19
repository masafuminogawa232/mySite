// =========================================================
// 【最優先】スクリプト読み込み直後に # を消して一番上に戻す
// =========================================================
if ('scrollRestoration' in history) {
    history.scrollRestoration = 'manual';
}

if (window.location.hash) {
    // ブラウザが #about へジャンプする前にURLからハッシュを削除
    history.replaceState(null, null, window.location.pathname + window.location.search);
}
window.scrollTo(0, 0);


document.addEventListener('DOMContentLoaded', () => {
    // 念のためDOM構築完了時にも一番上へ戻す
    window.scrollTo(0, 0);

    // ---------------------------------------------------------
    // 1. スクロールロック解除（オープニング演出用）
    // ---------------------------------------------------------
    const wrapper = document.querySelector('.screen-wrapper');
    let lockTimer = null;

    const unlockScroll = () => {
        if (wrapper && wrapper.classList.contains('site-scroll-lock')) {
            wrapper.classList.remove('site-scroll-lock');
        }
        if (lockTimer) {
            clearTimeout(lockTimer);
            lockTimer = null;
        }
    };

    if (wrapper) {
        lockTimer = setTimeout(unlockScroll, 10000);
    }

    // ---------------------------------------------------------
    // 2. スクロール連動アニメーション（IntersectionObserver）
    // ---------------------------------------------------------
    const targetElements = document.querySelectorAll(
        '.works-section .section-header, ' +
        '.works-section .work-card, ' +
        '.intro-section .eyecatch-circle, ' +
        '.intro-section .intro-caption, ' +
        '.intro-section .intro-lead p, ' +
        '.intro-section .scroll-arrow-line'
    );

    if (targetElements.length > 0) {
        const observerOptions = {
            root: null,
            rootMargin: '0px 0px -5% 0px',
            threshold: 0
        };

        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    obs.unobserve(entry.target);
                }
            });
        }, observerOptions);

        targetElements.forEach(el => {
            observer.observe(el);
        });
    }

    // ---------------------------------------------------------
    // 3. ページ内リンクのスムーススクロール（URLに # を付けない）
    // ---------------------------------------------------------
    const anchorLinks = document.querySelectorAll('a[href^="#"]');

    anchorLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            const href = link.getAttribute('href');

            unlockScroll();

            if (href === '#' || href === '#top') {
                e.preventDefault();
                window.scrollTo({ top: 0, behavior: 'smooth' });
                return;
            }

            const targetElement = document.querySelector(href);
            if (targetElement) {
                e.preventDefault();
                targetElement.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
});

// 画像などの読み込み完了後にも念押しでリセット
window.addEventListener('load', () => {
    window.scrollTo(0, 0);
});
