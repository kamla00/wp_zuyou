<?php
/**
 * Template Name: 急患診療テンプレート
 */
add_action( 'wp_head', function () { ?>
<style>
@keyframes brightRipple {
  0%   { transform: translateY(-50%) scale(0.8); opacity: 1; }
  100% { transform: translateY(-50%) scale(1.5); opacity: 0; }
}
.section-header { padding: 30px 0; display: flex; justify-content: center; }
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
.section-header__inner p, .section-header__inner h2 { position: relative; z-index: 1; text-align: center; }
.medical-hours { max-width: 700px; margin-left: auto; margin-right: auto; }
.reception-info { margin-top: 0; padding: 0; background: transparent; }
.reception-info__title-sub { font-size: 2.2rem; font-weight: 700; color: var(--mh--color--primary-800); margin-bottom: 25px; padding-bottom: 12px; border-bottom: 2px solid var(--mh--color--secondary-600); display: flex; align-items: center; gap: 10px; }
@media (max-width: 1023px) {
  .reception-info__title-sub { font-size: 1.8rem; }
}
.reception-info__table { width: 100%; border-collapse: collapse; }
.reception-info__table th, .reception-info__table td { padding: 15px; border-bottom: 1px solid var(--mh--color--primary-200); font-size: 1.7rem; text-align: left; }
.reception-info__table th { width: 110px; font-weight: 700; color: var(--mh--color--primary-800); white-space: nowrap; }
.reception-info__table td { color: var(--mh--color--primary-700); }
.treatment-note { background: var(--mh--color--primary-50); padding: 30px; border-radius: 12px; margin-bottom: 30px; border-left: 5px solid var(--mh--color--secondary-500); }
.treatment-note__title { font-size: 2rem; font-weight: 700; color: var(--mh--color--primary-800); margin-bottom: 15px; }
.treatment-note__list { list-style: none; padding: 0; margin: 0; }
.treatment-note__list li { font-size: 1.6rem; line-height: 1.8; position: relative; padding-left: 25px; margin-bottom: 12px; color: var(--mh--color--primary-800); }
.treatment-note__list li::before { content: ''; position: absolute; left: 0; top: 0.7em; width: 8px; height: 8px; background-color: var(--mh--color--secondary-600); border-radius: 50%; }
.service-card__tel { display: flex; align-items: center; gap: 10px; margin-top: 20px; }
.service-card__tel-label { font-size: 1.3rem; font-weight: 700; color: #fff; background: var(--mh--color--primary-400); padding: 3px 10px; border-radius: 4px; letter-spacing: 0.05em; white-space: nowrap; }
.service-card__tel-number { font-size: 2.2rem; font-weight: 700; color: var(--mh--color--primary-800); text-decoration: none; font-family: 'Outfit', sans-serif; letter-spacing: 0.03em; transition: color var(--mh--duration) var(--mh--easing); }
.service-card__tel-number:hover { color: var(--mh--color--secondary-600); }
.service-card__schedule { border-collapse: collapse; margin-top: 16px; font-size: 1.6rem; width: auto; }
.service-card__schedule th { font-weight: 700; color: var(--mh--color--primary-800); white-space: nowrap; padding: 4px 16px 4px 0; vertical-align: top; text-align: left; }
.service-card__schedule td { color: var(--mh--color--grayscale-800); padding: 4px 0; text-align: left; }
.emergency-notes { list-style: none; padding: 0; margin: 0 0 50px; display: flex; flex-direction: row; gap: 20px; max-width: 960px; margin-left: auto; margin-right: auto; }
.emergency-notes__item { flex: 1; display: flex; flex-direction: column; align-items: center; text-align: center; gap: 14px; background: #fff; border-radius: 16px 4px 16px 4px; padding: 28px 22px; box-shadow: 0 4px 20px rgba(69,149,199,0.15); border-top: 4px solid var(--mh--color--primary-400); }
.emergency-notes__icon { flex-shrink: 0; width: 36px; height: 36px; color: var(--mh--color--primary-400); }
.emergency-notes__icon svg { width: 100%; height: 100%; }
.emergency-notes__text { font-size: 1.5rem; line-height: 1.8; color: var(--mh--color--primary-800); margin: 0; }
@media (max-width: 767px) {
  .page-hero {
    height: auto;
    min-height: 0;
  }

  .page-hero__inner {
    padding-top: calc(var(--mh--header--height) + 28px);
    padding-bottom: 28px;
  }

  .page-hero__label {
    margin-bottom: 6px;
  }

  .page-hero__title {
    font-size: 2.9rem;
    line-height: 1.2;
  }

  .page-hero__sub {
    font-size: 1.3rem;
    line-height: 1.75;
    padding-top: 12px;
  }

  .emergency-notes { flex-direction: column; }
  .reception-info__table th, .reception-info__table td { padding: 12px 10px; font-size: 1.5rem; }
  .reception-info__table th { width: 90px; }
}
</style>
<?php }, 20 );
add_action( 'wp_footer', 'wp_zuyou_print_particle_canvas', 20 );

$_t = get_template_directory_uri();
get_header(); ?>
<main>

  <section class="page-hero page-hero--particle">
    <canvas class="page-hero__canvas" id="js-hero-canvas"></canvas>
    <div class="page-hero__inner">
      <div class="container">
        <p class="page-hero__label">Emergency Care</p>
        <div class="page-hero__container">
          <h1 class="page-hero__title">急患診療</h1>
          <p class="page-hero__sub">夜間や休日の診療を行っています。内科（小児科）・外科・歯科の応急処置に対応し、必要に応じて高度医療機関への紹介も迅速に行います。</p>
        </div>
      </div>
    </div>
  </section>

  <section class="section screening-category">
    <div class="container">
      <header class="section-header fade-in">
        <div class="section-header__inner">
          <p class="section-label">Medical Treatment</p>
          <h2 class="section-title">診療時間について</h2>
        </div>
      </header>
      <div class="medical-hours fade-in">
        <div class="medical-hours__table-wrapper">
          <table class="medical-hours__table">
            <thead>
              <tr>
                <th colspan="2">診療時間</th>
                <th>月</th><th>火</th><th>水</th><th>木</th><th>金</th><th>土</th><th>日・祝</th><th>年末年始</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td rowspan="2" class="td-subject">内科<br class="medical-hours-sp-break">（小児科）</td>
                <td>10:00~<br class="medical-hours-sp-break">17:00</td>
                <td></td><td></td><td></td><td></td><td></td><td></td><td>○</td><td>○</td>
              </tr>
              <tr>
                <td>20:00~<br class="medical-hours-sp-break">23:00</td>
                <td>○</td><td>○</td><td>○</td><td>○</td><td>○</td><td>○</td><td>○</td><td>○</td>
              </tr>
              <tr>
                <td rowspan="2" class="td-subject">外科</td>
                <td>10:00~<br class="medical-hours-sp-break">17:00</td>
                <td></td><td></td><td></td><td></td><td></td><td></td><td>○</td><td>○</td>
              </tr>
              <tr>
                <td>20:00~<br class="medical-hours-sp-break">23:00</td>
                <td>○</td><td>○</td><td>○</td><td>○</td><td>○</td><td>○</td><td>○</td><td>○</td>
              </tr>
              <tr>
                <td class="td-subject">歯科</td>
                <td>10:00~<br class="medical-hours-sp-break">17:00</td>
                <td></td><td></td><td></td><td></td><td></td><td></td><td>○</td><td>○</td>
              </tr>
            </tbody>
          </table>
        </div>
        <p class="medical-hours__note">※診療時間の終了、15分前までにお入り下さいますようお願いします。<br>※年末年始：12月29日〜1月3日</p>
      </div>
      <div class="screening-service-list screening-service-list--dot fade-in">
        <div class="screening-service">
          <span class="screening-service__dot"></span>
          <div class="screening-service__body">
            <h3 class="screening-service__title">発熱の方へ</h3>
            <p class="screening-service__text">発熱されて直ぐに来られても検査結果が陰性になる可能性があります。検査ご希望の方は、発熱から12時間以上経過してからお越し頂くと陽性が検出しやすく正確な検査結果が得られます。</p>
          </div>
        </div>
        <div class="screening-service">
          <span class="screening-service__dot"></span>
          <div class="screening-service__body">
            <h3 class="screening-service__title">持参頂くもの</h3>
            <p class="screening-service__text">・マイナンバーカードまたは資格確認証<br>・公費医療証（お持ちの方のみ）<br>・お薬手帳<br>※お忘れの場合は、自費扱いとなり後日、返金となります。</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section screening-category">
    <div class="container">
      <header class="section-header fade-in">
        <div class="section-header__inner">
          <p class="section-label">Medical Departments</p>
          <h2 class="section-title">診療科目</h2>
        </div>
      </header>
      <ul class="emergency-notes fade-in">
        <li class="emergency-notes__item">
          <span class="emergency-notes__icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/><line x1="6" y1="15" x2="9" y2="15"/></svg>
          </span>
          <p class="emergency-notes__text">マイナンバーカードまたは資格確認証・医療証を必ずご持参ください。</p>
        </li>
        <li class="emergency-notes__item">
          <span class="emergency-notes__icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m10.5 20.5 10-10a4.95 4.95 0 1 0-7-7l-10 10a4.95 4.95 0 1 0 7 7Z"/><path d="m8.5 8.5 7 7"/></svg>
          </span>
          <p class="emergency-notes__text">服用中のお薬がある場合はお薬手帳とともにご持参ください。</p>
        </li>
        <li class="emergency-notes__item">
          <span class="emergency-notes__icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          </span>
          <p class="emergency-notes__text">当診療は応急処置です。翌日、かかりつけ医療機関にて改めて受診してください。</p>
        </li>
      </ul>
      <div class="services-list">
        <article class="service-card fade-in">
          <div class="service-card__left">
            <div class="service-card__head">
              <div class="service-card__number"><span>01</span></div>
              <div class="service-card__title-group">
                <h3 class="service-card__title">内科（小児科）</h3>
                <p class="service-card__subtitle">Internal Medicine / Pediatrics</p>
              </div>
            </div>
            <div class="service-card__illu-wrap">
              <div class="service-card__illu-bg" style="background-color: #ffd966;"></div>
              <div class="service-card__illu-content">
                <img src="<?php echo $_t; ?>/images/emergency-care.webp" alt="内科（小児科）">
              </div>
            </div>
          </div>
          <div class="service-card__body">
            <h4 class="service-card__main-lead">夜間・休日の内科（小児科）診療</h4>
            <p class="service-card__description">内科・小児科全般の応急診療を行っています。</p>
            <div class="service-card__tel">
              <span class="service-card__tel-label">TEL</span>
              <a href="tel:0468737752" class="service-card__tel-number">046-873-7752</a>
            </div>
          </div>
        </article>
        <article class="service-card fade-in">
          <div class="service-card__left">
            <div class="service-card__head">
              <div class="service-card__number"><span>02</span></div>
              <div class="service-card__title-group">
                <h3 class="service-card__title">外科</h3>
                <p class="service-card__subtitle">Surgery</p>
              </div>
            </div>
            <div class="service-card__illu-wrap">
              <div class="service-card__illu-bg" style="background-color: #ffb3b3;"></div>
              <div class="service-card__illu-content">
                <img src="<?php echo $_t; ?>/images/surgery.webp" alt="外科">
              </div>
            </div>
          </div>
          <div class="service-card__body">
            <h4 class="service-card__main-lead">外傷・急性症状への迅速な外科対応</h4>
            <p class="service-card__description">切り傷・打撲・骨折・火傷など、緊急を要する外科的処置に対応します。</p>
            <div class="service-card__tel">
              <span class="service-card__tel-label">TEL</span>
              <a href="tel:0468737752" class="service-card__tel-number">046-873-7752</a>
            </div>
          </div>
        </article>
        <article class="service-card fade-in">
          <div class="service-card__left">
            <div class="service-card__head">
              <div class="service-card__number"><span>03</span></div>
              <div class="service-card__title-group">
                <h3 class="service-card__title">歯科</h3>
                <p class="service-card__subtitle">Dentistry</p>
              </div>
            </div>
            <div class="service-card__illu-wrap">
              <div class="service-card__illu-bg" style="background-color: #a2d2ff;"></div>
              <div class="service-card__illu-content">
                <img src="<?php echo $_t; ?>/images/dental.webp" alt="歯科">
              </div>
            </div>
          </div>
          <div class="service-card__body">
            <h4 class="service-card__main-lead">休日の歯科応急診療</h4>
            <p class="service-card__description">休日における歯の痛みや詰め物の脱落など、歯科の応急処置を行っています。</p>
            <h4 class="service-card__main-lead" style="margin-top: 10px;">障害者歯科健診</h4>
            <table class="service-card__schedule">
              <tr><th>診療日</th><td>水曜日、木曜日（予約制）</td></tr>
              <tr><th>診療時間</th><td>13:00～17:00</td></tr>
            </table>
            <div class="service-card__tel" style="margin-top: 30px;">
              <span class="service-card__tel-label">TEL</span>
              <a href="tel:0468732368" class="service-card__tel-number">046-873-2368</a>
            </div>
          </div>
        </article>
      </div>
    </div>
  </section>

</main>
<?php get_footer(); ?>
