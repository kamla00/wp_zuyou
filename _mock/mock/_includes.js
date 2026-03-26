/**
 * Component Loader - Header & Footer
 * WordPress化後は不要（get_header() / get_footer() に置き換え）
 */
(async function () {
  async function loadComponent(url, targetId) {
    const target = document.getElementById(targetId);
    if (!target) return;
    const res = await fetch(url);
    const html = await res.text();
    const tmp = document.createElement('div');
    tmp.innerHTML = html.trim();
    target.replaceWith(...tmp.childNodes);
  }

  await Promise.all([
    loadComponent('_header.html', 'site-header'),
    loadComponent('_footer.html', 'site-footer'),
  ]);

  // コンポーネント挿入後にページ初期化
  if (typeof window.pageInit === 'function') {
    window.pageInit();
  }

  // ナビゲーションのアクティブ状態を設定
  function setActiveNav() {
    const currentPage = location.pathname.split('/').pop() || 'index.html';
    const navLinks = document.querySelectorAll('.l-nav-list__item-link');
    navLinks.forEach(link => {
      const href = link.getAttribute('href');
      const hrefPage = href.split('?')[0]; // クエリパラメータを除去
      // URLの最後のファイル名と比較、またはハッシュで始まるパターンに対応
      if (hrefPage === currentPage || 
          (currentPage === '' && hrefPage === 'index.html') ||
          (currentPage.includes('.html') && hrefPage.includes(currentPage.replace('.html', '')))) {
        link.classList.add('is-active');
      }
    });
  }

  // setActiveNavを実行
  setActiveNav();
})();
