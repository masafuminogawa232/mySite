document.addEventListener('DOMContentLoaded', () => {
    // ---------------------------------------------------------
    // 1. スクロールロック解除（オープニング演出用）
    // ---------------------------------------------------------
    const wrapper = document.querySelector('.screen-wrapper');
    if (wrapper) {
        // #about や #works などのアンカーリンク付きでアクセスされた場合は即座に解除
        if (window.location.hash) {
            wrapper.classList.remove('site-scroll-lock');
        } else {
            // 通常アクセス時は10秒後にロック解除
            setTimeout(() => {
                wrapper.classList.remove('site-scroll-lock');
            }, 10000);
        }
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
        // 発火タイミング（画面の下端から5%入った位置で早めに開始）
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

        // 監視を開始
        targetElements.forEach(el => {
            observer.observe(el);
        });
    }
});
