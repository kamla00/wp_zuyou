/**
 * 逗葉地域医療センター - トップページモック
 * JavaScript インタラクション
 */

// ブラウザのスクロール復元機能を無効化（リロード時にトップに戻す）
if ('scrollRestoration' in history) {
  history.scrollRestoration = 'manual';
}
// scroll-behavior: smooth を一時的に無効にして即座にトップへ
document.documentElement.style.scrollBehavior = 'auto';
window.scrollTo(0, 0);
document.documentElement.style.scrollBehavior = '';

document.addEventListener('DOMContentLoaded', () => {
  // _includes.js 経由でコンポーネント読み込み後に呼ばれる場合と
  // 直接呼ばれる場合の両方に対応
  if (!window._useComponents) {
    initAll();
  }
});

window.pageInit = function () {
  initAll();
};

function initAll() {
  // Initialize all components
  initPageEntrance();
  initHeaderScroll();
  initMobileMenu();
  initScrollFade();
  initFacilityCarousel();
  initSmoothScroll();
  initHeroInfo();
  initNewsAccordion();
  initPageTop();
}

/**
 * Page Entrance Animation Sequence
 */
function initPageEntrance() {
  const header = document.querySelector('.l-header');
  const heroContent = document.querySelector('.hero-content');
  const heroBg = document.querySelector('.hero-bg');

  // Step 1: Header Entrance
  setTimeout(() => {
    if (header) header.classList.add('is-shown');
  }, 300);

  // Step 2: Hero Entrance (Shortly after header)
  setTimeout(() => {
    if (heroContent) heroContent.classList.add('is-shown');
    if (heroBg) heroBg.classList.add('is-shown');
  }, 800);
}

/**
 * News Section Accordion Interaction
 */
function initNewsAccordion() {
  const accordionItems = document.querySelectorAll('.js-accordion');
  
  accordionItems.forEach(item => {
    const trigger = item.querySelector('.js-accordion-trigger');
    const content = item.querySelector('.js-accordion-content');
    
    if (!trigger || !content) return;
    
    trigger.addEventListener('click', () => {
      const isActive = item.classList.contains('is-active');
      
      // Close all other items (optional, depending on design preference)
      // accordionItems.forEach(otherItem => {
      //   if (otherItem !== item) {
      //     otherItem.classList.remove('is-active');
      //     otherItem.querySelector('.js-accordion-content').style.maxHeight = null;
      //   }
      // });
      
      // Toggle current item
      if (isActive) {
        item.classList.remove('is-active');
        content.style.maxHeight = null;
      } else {
        item.classList.add('is-active');
        // Using scrollHeight for smooth transition if needed or relying on CSS max-height
        content.style.maxHeight = content.scrollHeight + 'px';
      }
    });
  });
}

/**
 * Hero Info Tabs Interaction
 */
function initHeroInfo() {
  const heroInners = document.querySelectorAll('.hero-inner-content');

  if (!heroInners.length) return;

  heroInners.forEach(heroInner => {
    if (heroInner.dataset.heroInfoInitialized === 'true') return;

    const infoBtns = heroInner.querySelectorAll('.js-info-btn');
    const infoContents = heroInner.querySelectorAll('.js-info-content');
    const panel = heroInner.querySelector('.js-info-panel');

    if (!infoBtns.length || !infoContents.length || !panel) return;

    heroInner.dataset.heroInfoInitialized = 'true';

    infoBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        const target = btn.getAttribute('data-target');
        const isActive = btn.classList.contains('is-active');

        infoBtns.forEach(otherBtn => {
          otherBtn.classList.remove('is-active');
        });
        infoContents.forEach(content => {
          content.classList.remove('is-active');
        });

        if (!isActive) {
          btn.classList.add('is-active');
          const content = heroInner.querySelector(`#info-${target}`);
          if (content) content.classList.add('is-active');
        }

        panel.classList.toggle('is-open', !isActive);
      });
    });

    const hasActiveContent = heroInner.querySelector('.js-info-content.is-active');
    panel.classList.toggle('is-open', !!hasActiveContent);
  });
}

/**
 * Header Background Change and Show/Hide on Scroll
 */
function initHeaderScroll() {
  const header = document.querySelector('.js-header');
  const hero = document.querySelector('.hero');
  const navBtn = document.querySelector('.js-nav-btn');
  if (!header) return;

  // Toggle .is-mv based on hero section visibility (IntersectionObserver)
  if (hero) {
    const heroObserver = new IntersectionObserver((entries) => {
      if (entries[0].isIntersecting) {
        header.classList.add('is-mv');
      } else {
        header.classList.remove('is-mv');
      }
    }, {
      root: null,
      rootMargin: '50% 0px 0px 0px',
      threshold: 0
    });
    heroObserver.observe(hero);
  }

  let lastScrollTop = 0;
  
  const handleScroll = () => {
    const currentScroll = window.pageYOffset || document.documentElement.scrollTop;
    const isMenuOpen = navBtn && navBtn.classList.contains('is-open');

    // Horizontal scroll support
    header.style.left = -window.scrollX + 'px';

    if (currentScroll <= 0) {
      header.classList.add('is-shown');
      lastScrollTop = 0;
      return;
    }

    if (currentScroll > lastScrollTop && currentScroll > 100 && !isMenuOpen) {
      // Scrolling down - hide
      header.classList.remove('is-shown');
    } else {
      // Scrolling up - show
      header.classList.add('is-shown');
    }
    
    lastScrollTop = currentScroll;
  };

  window.addEventListener('scroll', handleScroll, { passive: true });
  // Initial check
  handleScroll();
}

/**
 * Scroll Fade Animation using Intersection Observer
 */
function initScrollFade() {
  const fadeElements = document.querySelectorAll('.fade-in');
  if (!fadeElements.length) return;

  const observerOptions = {
    root: null,
    rootMargin: '0px 0px -50px 0px',
    threshold: 0.1
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  fadeElements.forEach(el => observer.observe(el));
}

/**
 * Facility Carousel using Splide
 */
function initFacilityCarousel() {
  const splideElement = document.getElementById('facility-splide');
  if (!splideElement) return;

  new Splide('#facility-splide', {
    type: 'loop',
    perPage: 3,
    perMove: 1,
    gap: '30px',
    padding: { left: '5%', right: '5%' },
    arrows: false,
    pagination: true,
    autoplay: true,
    interval: 4000,
    pauseOnHover: true,
    breakpoints: {
      1024: {
        perPage: 2,
        gap: '20px',
      },
      768: {
        perPage: 1,
        padding: { left: '10%', right: '10%' },
      },
    },
  }).mount();
}

/**
 * Smooth Scroll for Anchor Links
 */
function initSmoothScroll() {
  const anchorLinks = document.querySelectorAll('a[href^="#"]');
  
  anchorLinks.forEach(link => {
    link.addEventListener('click', (e) => {
      const href = link.getAttribute('href');
      if (href === '#') return;

      const target = document.querySelector(href);
      if (!target) return;

      e.preventDefault();

      const headerHeight = document.querySelector('.js-header')?.offsetHeight || 0;
      const targetPosition = target.getBoundingClientRect().top + window.scrollY - headerHeight - 60;

      window.scrollTo({
        top: targetPosition,
        behavior: 'smooth'
      });
    });
  });
}

/**
 * Page Top Button
 */
function initPageTop() {
  const btn = document.getElementById('js-page-top');
  if (!btn) return;

  window.addEventListener('scroll', () => {
    if (window.scrollY > 300) {
      btn.classList.add('is-visible');
    } else {
      btn.classList.remove('is-visible');
    }
  }, { passive: true });

  btn.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
}

/**
 * Mobile Menu Toggle
 */
function initMobileMenu() {
  const navBtn = document.querySelector('.l-nav-btn');
  const nav = document.querySelector('.l-nav');
  
  if (!navBtn || !nav) return;

  const closeMenu = () => {
    navBtn.classList.remove('is-open');
    nav.classList.remove('is-open');
    document.body.style.overflow = '';
  };

  const openMenu = () => {
    navBtn.classList.add('is-open');
    nav.classList.add('is-open');
    document.body.style.overflow = 'hidden';
  };

  navBtn.addEventListener('click', event => {
    event.stopPropagation();

    if (nav.classList.contains('is-open')) {
      closeMenu();
    } else {
      openMenu();
    }
  });

  document.addEventListener('click', event => {
    if (!nav.classList.contains('is-open')) return;

    if (event.target.closest('.l-nav-btn')) return;

    closeMenu();
  });
  
  // Close when clicking links
  nav.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
        closeMenu();
    });
  });
}
