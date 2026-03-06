<?php
add_action( 'wp_head', function () { ?>
<style>
@keyframes brightRipple {
  0%   { transform: translateY(-50%) scale(0.8); opacity: 1; }
  100% { transform: translateY(-50%) scale(1.5); opacity: 0; }
}
.section-header { padding: 30px 0; display: flex; justify-content: center; }
.section-header, .section-header.is-left { text-align: center; display: flex; justify-content: center; }
.section-header::before { display: none; }
.section-header__inner { position: relative; width: fit-content; display: flex; flex-direction: column; align-items: center; }
.section-header__inner::before {
  content: ''; position: absolute; left: -120px; top: 50%; transform: translateY(-50%);
  width: 260px; height: 220px;
  background:
    radial-gradient(circle 55px at 45% 55%, rgba(0, 212, 255, 0.35), transparent),
    radial-gradient(circle 45px at 35% 35%, rgba(139, 92, 246, 0.28), transparent),
    radial-gradient(circle 25px at 60% 25%, rgba(0, 145, 201, 0.25), transparent);
  z-index: 0; pointer-events: none; animation: brightRipple 2.5s ease-out infinite;
}
.section-header__inner p, .section-header__inner h2 { position: relative; z-index: 1; margin-left: 0; margin-right: 0; text-align: center; }
.hero-scroll { pointer-events: auto; text-decoration: none; }
.hero-scroll:hover { opacity: 0.7; }
html { scroll-behavior: smooth; }
.news-section { scroll-margin-top: 160px; }
.news-item__more-btn:hover { background-color: var(--mh--color--primary-400) !important; color: #fff !important; border-color: var(--mh--color--primary-400) !important; box-shadow: 0 4px 12px rgba(60,105,156,0.25); }

/* === Hero 修復: WP グローバルスタイルとの競合対策 === */
/* タイトルテキストの折り返し防止 */
.hero-title-content { display: flex !important; flex-direction: column !important; justify-content: center !important; }
.hero-title__blue,
.hero-title__black { display: block !important; white-space: nowrap !important; overflow-wrap: normal !important; word-break: normal !important; }
/* 情報パネルのデフォルト非表示を強制 */
.hero-info-content { opacity: 0 !important; visibility: hidden !important; pointer-events: none !important; }
.hero-info-content.is-active { opacity: 1 !important; visibility: visible !important; pointer-events: auto !important; animation: heroInfoFadeIn 0.3s ease forwards; }
@keyframes heroInfoFadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
/* ヒーローエントランスアニメーションの基底状態を確保 */
.hero-content { opacity: 0; transform: translateY(30px); }
.hero-content.is-shown { opacity: 1 !important; transform: translateY(0) !important; }
.hero-bg { opacity: 0; }
.hero-bg.is-shown { opacity: 1 !important; transform: scale(1) !important; }

/* ヒーロー写真のアスペクト比固定: clip-path を __inner に移し、常に正方形ベースの楕円を保つ */
@media (min-width: 768px) {
  .hero-bg {
    clip-path: none !important;
    overflow: hidden !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
  }
  .hero-bg__inner {
    position: relative !important;
    top: auto !important;
    left: auto !important;
    width: min(95%, 95vh) !important;
    height: auto !important;
    aspect-ratio: 1 / 1 !important;
    clip-path: url(#hero-wave-clip) !important;
    flex-shrink: 0 !important;
  }
  .hero-bg::after { display: none !important; }
}
</style>
<?php }, 100 );

$_t = get_template_directory_uri();
$news = wp_zuyou_news_query( array( 'posts_per_page' => 3 ) );
get_header(); ?>
<main>

  <svg width="0" height="0" style="position: absolute;">
    <defs>
      <clipPath id="hero-organic-clip" clipPathUnits="objectBoundingBox">
        <path d="M0.2,0 C0.4,0.05, 0.5,-0.05, 1,0 L1,1 C0.8,0.98, 0.4,1.05, 0,0.9 C0.05,0.6, 0.12,0.35, 0.2,0 Z" />
      </clipPath>
      <clipPath id="header-curve-clip" clipPathUnits="objectBoundingBox">
        <path d="M0.2,0 L1,0 L1,1 L0.55,1 C0.25,1, 0,0.4, 0.2,0 Z" />
      </clipPath>
      <clipPath id="hero-wave-clip" clipPathUnits="objectBoundingBox">
        <path d="M0.52, 0.18 C 0.72, 0.18, 0.88, 0.33, 0.88, 0.53 C 0.88, 0.73, 0.68, 0.88, 0.48, 0.88 C 0.28, 0.88, 0.12, 0.77, 0.12, 0.57 C 0.12, 0.37, 0.32, 0.18, 0.52, 0.18 Z" />
      </clipPath>
    </defs>
  </svg>

  <section class="hero" id="hero">
    <div class="hero-content">
      <div class="hero-inner-content">
        <div class="hero-title-wrapper">
          <span class="hero-accent-line"></span>
          <div class="hero-title-content">
            <span class="hero-subtitle">Supporting Community Health</span>
            <h1 class="hero-title">
              <span class="hero-title__blue">公益財団法人</span>
              <span class="hero-title__black">逗葉地域医療センター</span>
            </h1>
          </div>
        </div>
        <p class="hero-text">
          逗葉地域医療センターは、健診や急患診療をはじめとした<br>
          地域に根差した医療サービスをみなさまにご提供します。
        </p>
        <div class="hero-buttons">
          <button class="hero-info-btn btn btn-primary js-info-btn" data-target="fever">
            <span>発熱の方へ</span>
            <span class="hero-info-btn__icon"></span>
          </button>
          <button class="hero-info-btn btn btn-outline js-info-btn" data-target="items">
            <span>持参頂くもの</span>
            <span class="hero-info-btn__icon"></span>
          </button>
        </div>
        <div class="hero-info-panel js-info-panel">
          <div id="info-fever" class="hero-info-content js-info-content">
            <div class="hero-info-inner">
              発熱されて直ぐに来られても検査結果が陰性になる可能性があります。検査ご希望の方は、発熱から12時間以上経過してからお越し頂くと陽性が検出しやすく正確な検査結果が得られます。
            </div>
          </div>
          <div id="info-items" class="hero-info-content js-info-content">
            <div class="hero-info-inner">
              ・マイナンバーカードまたは資格確認証<br>
              ・公費医療証（お持ちの方のみ）<br>・お薬手帳<br>※お忘れの場合は、自費扱いとなり後日、返金となります。
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="hero-bg">
      <div class="hero-bg__inner">
        <img src="<?php echo $_t; ?>/images/hero.png" alt="逗葉地域医療センター 玄関1">
        <img src="<?php echo $_t; ?>/images/hero1.png" alt="逗葉地域医療センター 玄関2">
        <img src="<?php echo $_t; ?>/images/hero2.jpg" alt="逗葉地域医療センター 玄関3">
      </div>
    </div>
    <a href="#news" class="hero-scroll">
      <span class="hero-scroll__text">More</span>
      <div class="hero-scroll__icon">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M12 5V19M12 19L19 12M12 19L5 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
    </a>
  </section>

  <section class="section news-section" id="news">
    <div class="container">
      <div class="news-flex-wrapper">
        <div class="news-left">
          <header class="section-header fade-in is-left">
            <div class="section-header__inner">
              <p class="section-label">News</p>
              <h2 class="section-title">最新のお知らせ</h2>
            </div>
          </header>
          <div class="news-list fade-in">
            <?php echo $news['items_html']; ?>
          </div>
        </div>
        <div class="news-right">
          <header class="section-header fade-in is-left">
            <div class="section-header__inner">
              <p class="section-label">Medical Hours</p>
              <h2 class="section-title">急患診療</h2>
            </div>
          </header>
          <div class="medical-hours fade-in">
            <div class="medical-hours__table-wrapper">
              <table class="medical-hours__table">
                <thead>
                  <tr>
                    <th colspan="2">診療時間</th>
                    <th>月</th><th>火</th><th>水</th><th>木</th><th>金</th><th>土</th>
                    <th>日・祝 / 年末年始</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td rowspan="2" class="td-subject">内科（小児科）</td>
                    <td>10:00~17:00</td>
                    <td></td><td></td><td></td><td></td><td></td><td>○</td><td>○</td>
                  </tr>
                  <tr>
                    <td>20:00~23:00</td>
                    <td>○</td><td>○</td><td>○</td><td>○</td><td>○</td><td>○</td><td>○</td>
                  </tr>
                  <tr>
                    <td rowspan="2" class="td-subject">外科</td>
                    <td>10:00~17:00</td>
                    <td></td><td></td><td></td><td></td><td></td><td>○</td><td>○</td>
                  </tr>
                  <tr>
                    <td>20:00~23:00</td>
                    <td>○</td><td>○</td><td>○</td><td>○</td><td>○</td><td>○</td><td>○</td>
                  </tr>
                  <tr>
                    <td class="td-subject">歯科</td>
                    <td>10:00~17:00</td>
                    <td></td><td></td><td></td><td></td><td></td><td>○</td><td>○</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <p class="medical-hours__note">※診療時間の終了、15分前までにお入り下さいますようお願いします。<br>※年末年始：12月29日〜1月3日</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section services-section" id="services">
    <div class="wave-divider-top">
      <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0 L1200,0 L1200,20 C1000,50 800,-10 600,40 C400,90 200,30 0,110 Z" class="shape-fill" style="fill: #fff;"></path>
      </svg>
    </div>
    <div class="container">
      <header class="section-header fade-in">
        <div class="section-header__inner">
          <p class="section-label">Services</p>
          <h2 class="section-title">各種サービス</h2>
        </div>
      </header>
      <div class="services-list">
        <article class="service-card fade-in">
          <div class="service-card__left">
            <div class="service-card__head">
              <div class="service-card__number"><span>01</span></div>
              <div class="service-card__title-group">
                <h3 class="service-card__title">健診事業</h3>
                <p class="service-card__subtitle">Health Checkup</p>
              </div>
            </div>
            <div class="service-card__illu-wrap">
              <div class="service-card__illu-bg" style="background-color: #ffd966;"></div>
              <div class="service-card__illu-content"><img src="<?php echo $_t; ?>/images/健康診断.png" alt="健康診断"></div>
            </div>
          </div>
          <div class="service-card__body">
            <h4 class="service-card__main-lead">住民健診から人間ドックまで、高度な検査体制で健康をサポート</h4>
            <p class="service-card__description">地域の一環とした健康管理を行うために住民健診、事業所（職域）健診、学校健診、人間ドック、進学・就職等の健康診断を行っています。<br><br><strong>お問い合わせ：Tel.046-873-7752</strong></p>
            <div class="service-card__more">
              <a href="<?php echo home_url('/screening/'); ?>" class="service-card__more-btn"><span>もっと見る</span></a>
              <a href="https://www.mrso.jp/mrs/zic/Plans/selectPlan" target="_blank" rel="noopener noreferrer" class="service-card__more-btn service-card__more-btn--reserve"><span>健診WEB予約</span></a>
            </div>
          </div>
        </article>
        <article class="service-card fade-in">
          <div class="service-card__left">
            <div class="service-card__head">
              <div class="service-card__number"><span>02</span></div>
              <div class="service-card__title-group">
                <h3 class="service-card__title">急患診療</h3>
                <p class="service-card__subtitle">Emergency Care</p>
              </div>
            </div>
            <div class="service-card__illu-wrap">
              <div class="service-card__illu-bg" style="background-color: #ffb3b3;"></div>
              <div class="service-card__illu-content"><img src="<?php echo $_t; ?>/images/急患診療.png" alt="急患診療"></div>
            </div>
          </div>
          <div class="service-card__body">
            <h4 class="service-card__main-lead">夜間・休日の緊急診療</h4>
            <p class="service-card__description">夜間や休日の診療を行っています。内科（小児科）・外科・歯科の応急処置に対応し、必要に応じて高度医療機関への紹介も迅速に行います。</p>
            <div class="service-card__more">
              <a href="<?php echo home_url('/emergency/'); ?>" class="service-card__more-btn"><span>もっと見る</span></a>
            </div>
          </div>
        </article>
        <article class="service-card fade-in">
          <div class="service-card__left">
            <div class="service-card__head">
              <div class="service-card__number"><span>03</span></div>
              <div class="service-card__title-group">
                <h3 class="service-card__title">訪問看護</h3>
                <p class="service-card__subtitle">Visiting Nursing</p>
              </div>
            </div>
            <div class="service-card__illu-wrap">
              <div class="service-card__illu-bg" style="background-color: #a2d2ff;"></div>
              <div class="service-card__illu-content"><img src="<?php echo $_t; ?>/images/訪問看護.jpg" alt="訪問看護"></div>
            </div>
          </div>
          <div class="service-card__body">
            <h4 class="service-card__main-lead">訪問看護・居宅介護支援サービスを行っています。</h4>
            <p class="service-card__description">訪問看護事業として、訪問看護・居宅介護支援の2つのサービスを提供しております。介護保険サービスの利用については『どうやって利用すればいいの？』『どんなサービスが使えるの？』などなど、難しくて分からないことがたくさんあると思います。どうぞ、お気軽にご相談下さい。</p>
            <div class="service-card__more">
              <a href="<?php echo home_url('/visiting-nurse/'); ?>" class="service-card__more-btn"><span>もっと見る</span></a>
            </div>
          </div>
        </article>
        <article class="service-card fade-in">
          <div class="service-card__left">
            <div class="service-card__head">
              <div class="service-card__number"><span>04</span></div>
              <div class="service-card__title-group">
                <h3 class="service-card__title">在宅医療</h3>
                <p class="service-card__subtitle">Home Care</p>
              </div>
            </div>
            <div class="service-card__illu-wrap">
              <div class="service-card__illu-bg" style="background-color: #b9e4c9;"></div>
              <div class="service-card__illu-content"><img src="<?php echo $_t; ?>/images/在宅医療.png" alt="在宅医療"></div>
            </div>
          </div>
          <div class="service-card__body">
            <h4 class="service-card__main-lead">逗葉地域在宅医療・介護連携相談室</h4>
            <p class="service-card__description">逗葉地域在宅医療・介護連携相談室は、逗子市・葉山町の皆様が安心して在宅医療を行いながら生活を送れるよう支援する窓口です。専門の看護師が対応いたします。</p>
            <div class="service-card__more">
              <a href="<?php echo home_url('/home-care/'); ?>" class="service-card__more-btn"><span>もっと見る</span></a>
            </div>
          </div>
        </article>
      </div>
    </div>
  </section>

  <section class="section about-section" id="about">
    <div class="wave-divider-top">
      <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0 L1200,0 L1200,20 C1000,50 800,-10 600,40 C400,90 200,30 0,110 Z" class="shape-fill" style="fill: var(--mh--color--secondary-500);"></path>
      </svg>
    </div>
    <div class="container">
      <header class="section-header fade-in">
        <div class="section-header__inner">
          <p class="section-label">Overview</p>
          <h2 class="section-title">施設概要</h2>
        </div>
      </header>
      <div class="about-intro fade-in">
        <div class="about-intro__image"><img src="<?php echo $_t; ?>/images/hero1.png" alt="施設外観"></div>
        <div class="about-intro__content">
          <p class="about-intro__text">逗子市および葉山町が行う地域医療対策の円滑な推進を図るため、一般社団法人逗葉医師会、一般社団法人逗葉歯科医師会、逗葉薬剤師会の協力の下に急患診療事業、特定健診事業、介護予防検診事業および訪問看護事業を行い、もって逗子市民及び葉山町民の健康保持増進と福祉の向上に寄与することを目的としています。</p>
        </div>
      </div>
      <div class="about-grid fade-in">
        <div class="about-history">
          <h3 class="about-sub-title">沿革</h3>
          <dl class="history-list">
            <div class="history-item">
              <dt class="history-date">昭和58年4月</dt>
              <dd class="history-desc">逗葉地域医療センター設立。逗葉医師会の急患診療事業を継承し、逗子市池子1-6-11にて事業開始。</dd>
            </div>
            <div class="history-item">
              <dt class="history-date">昭和61年11月</dt>
              <dd class="history-desc">逗葉医師会公衆衛生センターにかかる事業及び従業員・設備等を逗葉医師会より継承し、次の事業等を開始。<br>1.胃部・胸部集団検診及び精密検診<br>2.乳がん検診<br>3.医療相談<br>4.老健法に基づく一般健康診査及び事業所健診</dd>
            </div>
            <div class="history-item">
              <dt class="history-date">平成6年6月</dt>
              <dd class="history-desc">神奈川県より老人訪問看護事業者の指定を受け、老人訪問看護ステーションを開設。在宅の寝たきりの老人等に対して看護サービスの提供を開始。</dd>
            </div>
            <div class="history-item">
              <dt class="history-date">平成13年4月</dt>
              <dd class="history-desc">現住所(逗子市池子字桟敷戸1892-6)へ移転。休日急患歯科診療を逗葉歯科医師会より継承すると共に、障害者歯科診療を開始。</dd>
            </div>
          </dl>
        </div>
        <div class="about-business">
          <h3 class="about-sub-title">事業内容</h3>
          <div class="business-grid">
            <a href="<?php echo home_url('/screening/'); ?>" class="business-item">
              <span class="business-item__icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg></span>
              <span class="business-item__text">健診事業</span>
            </a>
            <div class="business-item">
              <span class="business-item__icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></svg></span>
              <span class="business-item__text">休日・夜間急患診療</span>
            </div>
            <div class="business-item">
              <span class="business-item__icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg></span>
              <span class="business-item__text">訪問看護ステーション</span>
            </div>
            <a href="<?php echo home_url('/home-care/'); ?>" class="business-item">
              <span class="business-item__icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><path d="M8 10h.01"/><path d="M12 10h.01"/><path d="M16 10h.01"/></svg></span>
              <span class="business-item__text">在宅医療相談室</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section facility-section" id="facility">
    <div class="wave-divider-top">
      <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0 L1200,0 L1200,20 C1000,50 800,-10 600,40 C400,90 200,30 0,110 Z" class="shape-fill" style="fill: #fff;"></path>
      </svg>
    </div>
    <div class="container">
      <header class="section-header fade-in">
        <div class="section-header__inner">
          <p class="section-label">Facility</p>
          <h2 class="section-title">院内・設備紹介</h2>
        </div>
      </header>
    </div>
    <div class="facility-carousel fade-in">
      <div id="facility-splide" class="splide">
        <div class="splide__track">
          <ul class="splide__list">
            <li class="splide__slide"><div class="facility-slide"><img src="<?php echo $_t; ?>/images/sl.jpg" alt="院内の様子1"></div></li>
            <li class="splide__slide"><div class="facility-slide"><img src="<?php echo $_t; ?>/images/sl2.webp" alt="院内の様子2"></div></li>
            <li class="splide__slide"><div class="facility-slide"><img src="<?php echo $_t; ?>/images/sl3.jpg" alt="院内の様子3"></div></li>
            <li class="splide__slide"><div class="facility-slide"><img src="<?php echo $_t; ?>/images/hero.png" alt="院内の様子4"></div></li>
            <li class="splide__slide"><div class="facility-slide"><img src="<?php echo $_t; ?>/images/hero1.png" alt="院内の様子5"></div></li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section class="section access-section" id="access">
    <div class="wave-divider-top">
      <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0 L1200,0 L1200,20 C1000,50 800,-10 600,40 C400,90 200,30 0,110 Z" class="shape-fill" style="fill: var(--mh--color--primary-100);"></path>
      </svg>
    </div>
    <div class="container">
      <header class="section-header fade-in">
        <div class="section-header__inner">
          <p class="section-label">Access</p>
          <h2 class="section-title">アクセス</h2>
        </div>
      </header>
      <div class="access-wrapper">
        <div class="access-info fade-in">
          <h3 class="access-info__name">公益財団法人 逗葉地域医療センター</h3>
          <dl class="access-detail">
            <dt>所在地</dt>
            <dd>〒249-0003<br>神奈川県逗子市池子字桟敷戸1892番地6</dd>
          </dl>
          <dl class="access-detail">
            <dt>電話番号</dt>
            <dd>046-873-7752</dd>
          </dl>
          <dl class="access-detail">
            <dt>アクセス</dt>
            <dd>
              <div class="access-sub-item">
                <span class="access-label">電車</span>
                <span>京急神武寺駅から徒歩10分</span>
              </div>
              <div class="access-sub-item">
                <span class="access-label">バス</span>
                <span>JR逗子駅前バスターミナル3番のりば「アザリエ循環・笹倉」で、"池子十字路"下車。徒歩5分</span>
              </div>
            </dd>
          </dl>
          <dl class="access-detail">
            <dt>駐車場</dt>
            <dd>15台（うち障害者専用1台）</dd>
          </dl>
        </div>
        <div class="access-map fade-in">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3255.485188849688!2d139.5864815764022!3d35.30224515041775!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x601846eaaa93b2cf%3A0xa3909c8cd55cacdc!2z6YCv6JGJ5Zyw5Z-f5Yy755mC44K744Oz44K_44O8!5e0!3m2!1sja!2sjp!4v1739175440000!5m2!1sja!2sjp"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="逗葉地域医療センター 地図">
          </iframe>
        </div>
      </div>
    </div>
  </section>

  <section class="section calendar-section" id="calendar">
    <div class="wave-divider-top">
      <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0 L1200,0 L1200,20 C1000,50 800,-10 600,40 C400,90 200,30 0,110 Z" class="shape-fill" style="fill: #fff;"></path>
      </svg>
    </div>
    <div class="container">
      <div class="section-header fade-in">
        <div class="section-header__inner">
          <p class="section-label">Calendar</p>
          <h2 class="section-title">在宅医療イベントカレンダー</h2>
        </div>
      </div>
      <div class="calendar-wrapper fade-in">
        <div class="calendar-item"><img src="<?php echo $_t; ?>/images/カレンダー1.png" alt="診療カレンダー1"></div>
        <div class="calendar-item"><img src="<?php echo $_t; ?>/images/カレンダー2.png" alt="診療カレンダー2"></div>
      </div>
    </div>
  </section>

</main>
<?php get_footer(); ?>

