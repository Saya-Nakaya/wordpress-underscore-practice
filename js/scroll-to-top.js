/**
 * トップに戻るボタンの機能
 */
document.addEventListener('DOMContentLoaded', function() {
  const scrollToTopBtn = document.querySelector('.scroll-to-top');
  
  if (!scrollToTopBtn) return;

  // スクロール位置を監視してボタンの表示/非表示を制御
  window.addEventListener('scroll', function() {
    if (window.pageYOffset > 300) {
      scrollToTopBtn.classList.add('show');
    } else {
      scrollToTopBtn.classList.remove('show');
    }
  });

  // ボタンクリック時のスクロール処理
  scrollToTopBtn.addEventListener('click', function(e) {
    e.preventDefault();
    
    // ヘッダーまでスムーズスクロール
    const header = document.querySelector('#masthead');
    if (header) {
      header.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
      });
    } else {
      // ヘッダーが見つからない場合はページトップへ
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    }
  });
}); 