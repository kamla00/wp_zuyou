<?php
/**
 * Template Name: 健診事業テンプレート
 */
add_action( 'wp_head', function () { ?>
<style>
@keyframes brightRipple {
  0%   { transform: translateY(-50%) scale(0.8); opacity: 1; }
  100% { transform: translateY(-50%) scale(1.5); opacity: 0; }
}
.section-header { padding: 30px 0; display: flex; justify-content: center; }
.section-header::before { display: none; }
.section-header__inner { position: relative; width: fit-content; display: flex; flex-direction: column; }
.section-header__inner::before {
  content: ''; position: absolute; left: -120px; top: 50%; transform: translateY(-50%);
  width: 260px; height: 220px;
  background:
    radial-gradient(circle 55px at 45% 55%, rgba(0, 212, 255, 0.35), transparent),
    radial-gradient(circle 45px at 35% 35%, rgba(139, 92, 246, 0.28), transparent),
    radial-gradient(circle 25px at 60% 25%, rgba(0, 145, 201, 0.25), transparent);
  z-index: 0; pointer-events: none; animation: brightRipple 2.5s ease-out infinite;
}
.section-header__inner p, .section-header__inner h2 { position: relative; z-index: 1; }
.dock-info-row__time {
  display: inline-flex;
  align-items: center;
  justify-content: flex-start;
  gap: 0.38em;
  text-align: left;
}
.dock-info-row__content {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  text-align: left;
}
.dock-info-row__time::before {
  content: '';
  width: 0.9em;
  height: 0.9em;
  flex-shrink: 0;
  background-color: currentColor;
  -webkit-mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Ccircle cx='12' cy='12' r='9' fill='none' stroke='black' stroke-width='2'/%3E%3Cpath d='M12 7v5l3 2' fill='none' stroke='black' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E") center / contain no-repeat;
  mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Ccircle cx='12' cy='12' r='9' fill='none' stroke='black' stroke-width='2'/%3E%3Cpath d='M12 7v5l3 2' fill='none' stroke='black' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E") center / contain no-repeat;
}

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

  .dock-info-card--full {
    padding: 18px 16px;
  }

  .dock-info-card__title {
    font-size: 1.8rem;
  }

  .dock-info-rows {
    gap: 12px;
  }

  .dock-info-row {
    gap: 10px;
    align-items: flex-start;
    font-size: 1.3rem;
    line-height: 1.75;
    flex-direction: column;
  }

  .dock-info-row__label {
    font-size: 1.2rem;
    line-height: 1.45;
    padding: 4px 10px;
  }

  .dock-info-row__time {
    font-size: 2.2rem;
    line-height: 1.3;
  }

  .dock-info-row__content {
    width: 100%;
  }

  .dock-info-row small {
    font-size: 1.2rem;
    line-height: 1.7;
    margin-top: 4px;
  }

  .dock-contact-actions {
    gap: 14px;
    align-items: flex-start;
    justify-content: flex-start;
  }

  .dock-contact-tel {
    font-size: 2.2rem;
    line-height: 1.2;
  }

  .dock-contact-tel svg {
    width: 22px;
    height: 22px;
  }

  .dock-contact-web-btn {
    font-size: 1.3rem;
    line-height: 1.4;
    padding: 11px 20px;
  }
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
        <p class="page-hero__label">Screening</p>
        <div class="page-hero__container">
          <h1 class="page-hero__title">健診事業</h1>
          <p class="page-hero__sub">地域の一環とした健康管理を行うために住民健診、事業所（職域）健診、学校健診、人間ドック、進学・就職等の健康診断を行っています。</p>
        </div>
      </div>
    </div>
  </section>

  <section class="section screening-category" id="juumin">
    <div class="container">
      <header class="section-header fade-in">
        <div class="section-header__inner">
          <p class="section-label">Resident Health</p>
          <h2 class="section-title">住民健診</h2>
        </div>
      </header>
      <p class="section-lead fade-in">地域住民の方々を対象に、各種の健康診断を行っています。</p>
      <div class="screening-service-list screening-service-list--dot fade-in">
        <div class="screening-service">
          <span class="screening-service__dot"></span>
          <div class="screening-service__body">
            <h3 class="screening-service__title">特定健康診査</h3>
            <p class="screening-service__text">集団方式による特定健診を行っています。</p>
          </div>
        </div>
        <div class="screening-service">
          <span class="screening-service__dot"></span>
          <div class="screening-service__body">
            <h3 class="screening-service__title">胃がん検診</h3>
            <p class="screening-service__text">胃部集団検診用レントゲン車2台で、逗子市・葉山町の住民や事業所の集団検診を行っています。更に内視鏡も行っています。</p>
          </div>
        </div>
        <div class="screening-service">
          <span class="screening-service__dot"></span>
          <div class="screening-service__body">
            <h3 class="screening-service__title">肺がん・結核検診</h3>
            <p class="screening-service__text">デジタル撮影装置を装備した集団検診車で、結核及び肺がんの検診を行っています。更に、車椅子の方にも安心してご利用いただけるよう自動昇降装置を配備しています。</p>
          </div>
        </div>
        <div class="screening-service">
          <span class="screening-service__dot"></span>
          <div class="screening-service__body">
            <h3 class="screening-service__title">乳がん検診</h3>
            <p class="screening-service__text">視触診とマンモグラフィ（乳房X線装置）による乳房X線検査を行っています。</p>
          </div>
        </div>
        <div class="screening-service">
          <span class="screening-service__dot"></span>
          <div class="screening-service__body">
            <h3 class="screening-service__title">大腸がん検診</h3>
            <p class="screening-service__text">大腸がんの予防、早期発見の指針として便による潜血反応検査を行っています。</p>
          </div>
        </div>
        <div class="screening-service">
          <span class="screening-service__dot"></span>
          <div class="screening-service__body">
            <h3 class="screening-service__title">前立腺がん検診</h3>
            <p class="screening-service__text">前立腺がんの早期発見のためのPSA検査（血液検査）を行っています。</p>
          </div>
        </div>
        <div class="screening-service">
          <span class="screening-service__dot"></span>
          <div class="screening-service__body">
            <h3 class="screening-service__title">骨粗しょう症検診</h3>
            <p class="screening-service__text">超音波で踵の骨の検査を行っています。骨密度を測定し、骨粗しょう症の早期発見・予防に役立てます。</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section screening-category screening-category--alt" id="jigyousho">
    <div class="wave-divider-top">
      <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0 L1200,0 L1200,20 C1000,50 800,-10 600,40 C400,90 200,30 0,110 Z" class="shape-fill" style="fill: #fff;"></path>
      </svg>
    </div>
    <div class="container">
      <header class="section-header fade-in">
        <div class="section-header__inner">
          <p class="section-label">Occupational Health</p>
          <h2 class="section-title">事業所（職域）健診</h2>
        </div>
      </header>
      <p class="section-lead fade-in">働く方々を対象に、各種の健康診断を人数の多少に関係なく行っています。<br>又、出張健診も行っています。</p>
      <div class="screening-service-list screening-service-list--dot fade-in">
        <div class="screening-service">
          <span class="screening-service__dot"></span>
          <div class="screening-service__body">
            <h3 class="screening-service__title">一般健康診断</h3>
            <p class="screening-service__text">労働安全衛生法に基づき年１回の受診が義務づけられている、一般健康診断を行うことができます。</p>
          </div>
        </div>
        <div class="screening-service">
          <span class="screening-service__dot"></span>
          <div class="screening-service__body">
            <h3 class="screening-service__title">雇入時健康診断</h3>
            <p class="screening-service__text">労働安全衛生法に基づき雇入時に義務づけられている、雇入時健康診断を行うことができます。</p>
          </div>
        </div>
        <div class="screening-service">
          <span class="screening-service__dot"></span>
          <div class="screening-service__body">
            <h3 class="screening-service__title">特殊健康診断</h3>
            <p class="screening-service__text">法令規則及び行政指導等に基づく健康診断で有害業務に従事している方が対象になる特殊健康診断を行うことができます。</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section screening-category" id="gakkou">
    <div class="wave-divider-top">
      <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0 L1200,0 L1200,20 C1000,50 800,-10 600,40 C400,90 200,30 0,110 Z" class="shape-fill" style="fill: var(--mh--color--secondary-500);"></path>
      </svg>
    </div>
    <div class="container">
      <header class="section-header fade-in">
        <div class="section-header__inner">
          <p class="section-label">School Health</p>
          <h2 class="section-title">学校健診</h2>
        </div>
      </header>
      <p class="section-lead fade-in">園児・児童・生徒を対象に、各種の健康診断を行っています。</p>
      <div class="screening-service-list screening-service-list--dot fade-in">
        <div class="screening-service">
          <span class="screening-service__dot"></span>
          <div class="screening-service__body">
            <h3 class="screening-service__title">心臓検診</h3>
            <p class="screening-service__text">小学校、中学校、高等学校の１年生に心電図検査による１次、２次検査及び専門医による判定会を行っています。</p>
          </div>
        </div>
        <div class="screening-service">
          <span class="screening-service__dot"></span>
          <div class="screening-service__body">
            <h3 class="screening-service__title">腎臓健診・糖尿病健診</h3>
            <p class="screening-service__text">幼稚園、小学校、中学校、高等学校の園児・児童・生徒に尿検査により腎臓健診は１次、２次検査を糖尿病健診は１次検査を行っています。</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section screening-category screening-category--blue" id="ningen-dock">
    <div class="wave-divider-top">
      <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0 L1200,0 L1200,20 C1000,50 800,-10 600,40 C400,90 200,30 0,110 Z" class="shape-fill" style="fill: #fff;"></path>
      </svg>
    </div>
    <div class="container">
      <header class="section-header fade-in">
        <div class="section-header__inner">
          <p class="section-label">Comprehensive Checkup</p>
          <h2 class="section-title">人間ドック</h2>
        </div>
      </header>
      <p class="section-lead fade-in">医療機関からの紹介、団体・個人の方のお申し込みなど、予約制で半日ドックを行っています。</p>
      <div class="dock-layout fade-in">
        <div class="dock-card dock-card--basic">
          <div class="dock-card__header">
            <h3 class="dock-card__title">基本コース</h3>
            <p class="dock-card__price">39,000<small>円（税別）</small></p>
          </div>
          <div class="dock-exam-list">
            <span class="dock-exam-cat">問診</span><span class="dock-exam-val">問診・触診・計測・血圧</span>
            <span class="dock-exam-cat">視力検査</span><span class="dock-exam-val">視力・聴力・眼底・眼圧</span>
            <span class="dock-exam-cat">胸部検査</span><span class="dock-exam-val">胸部X線・肺活量</span>
            <span class="dock-exam-cat">血液検査</span><span class="dock-exam-val">血液型（内分泌含む）</span>
            <span class="dock-exam-cat">血清生化学</span><span class="dock-exam-val">血清生化学・蛋白異常症</span>
            <span class="dock-exam-cat">尿検査</span><span class="dock-exam-val">尿定性・尿沈渣</span>
            <span class="dock-exam-cat">血糖・脂質</span><span class="dock-exam-val">総コレステロール・HDLコレステロール・中性脂肪・LDLコレステロール</span>
            <span class="dock-exam-cat">腎機能</span><span class="dock-exam-val">尿素窒素・クレアチニン</span>
            <span class="dock-exam-cat">糖尿病</span><span class="dock-exam-val">尿糖・HbA1C</span>
            <span class="dock-exam-cat">肝機能</span><span class="dock-exam-val">GOT・GPT・γ-GTP・ALP・LDH・アルブミン・ビリルビン・蛋白分画</span>
            <span class="dock-exam-cat">消化酵素</span><span class="dock-exam-val">AMY</span>
            <span class="dock-exam-cat">血液学的</span><span class="dock-exam-val">血液5種</span>
            <span class="dock-exam-cat">免疫学的</span><span class="dock-exam-val">CRP・RA・梅毒（RPR・TPHA）・HBs抗原</span>
            <span class="dock-exam-cat">前立腺（男性）</span><span class="dock-exam-val">PSA</span>
            <span class="dock-exam-cat">甲状腺（女性）</span><span class="dock-exam-val">TSH</span>
          </div>
        </div>
        <div class="dock-side">
          <div class="dock-card">
            <div class="dock-card__header">
              <h3 class="dock-card__title">オプションコース</h3>
            </div>
            <ul class="dock-option-list">
              <li class="dock-option">
                <div class="dock-option__body"><span class="dock-option__name">婦人科検査</span><span class="dock-option__detail">乳がん（視診・マンモグラフィ）<br>子宮がん（視診・細胞診）</span></div>
                <span class="dock-option__price">8,302円</span>
              </li>
              <li class="dock-option">
                <div class="dock-option__body"><span class="dock-option__name">骨粗しょう症検査</span><span class="dock-option__detail">骨密度測定</span></div>
                <span class="dock-option__price">1,598円</span>
              </li>
              <li class="dock-option">
                <div class="dock-option__body"><span class="dock-option__name">ウイルス性肝炎</span><span class="dock-option__detail">HCV分析</span></div>
                <span class="dock-option__price">2,560円</span>
              </li>
              <li class="dock-option">
                <div class="dock-option__body"><span class="dock-option__name">腫瘍マーカー</span><span class="dock-option__detail">CEA</span></div>
                <span class="dock-option__price">2,560円</span>
              </li>
              <li class="dock-option">
                <div class="dock-option__body"><span class="dock-option__name">血液型検査</span><span class="dock-option__detail">ABO・Rh</span></div>
                <span class="dock-option__price">1,000円</span>
              </li>
              <li class="dock-option">
                <div class="dock-option__body"><span class="dock-option__name">消化性胃検査</span><span class="dock-option__detail">ペプシノゲン検査</span></div>
                <span class="dock-option__price">1,598円</span>
              </li>
            </ul>
            <p class="dock-note">※別途消費税がかかります</p>
          </div>
        </div>
      </div>
      <div class="dock-info-card dock-info-card--full">
        <h3 class="dock-info-card__title">ご予約・お申込み</h3>
        <div class="dock-info-rows">
          <div class="dock-info-row">
            <span class="dock-info-row__label">健診時間</span>
            <span class="dock-info-row__content"><span class="dock-info-row__time">9:00〜12:00</span><small>受診者の都合や機器の状況により、終了時間が午後1時になる場合もあります</small></span>
          </div>
          <div class="dock-info-row">
            <span class="dock-info-row__label">お申込み</span>
            <div class="dock-contact-actions">
              <a href="tel:0468737752" class="dock-contact-tel">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.36 13 19.79 19.79 0 0 1 1.27 4.4 2 2 0 0 1 3.24 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21 16.92z"/></svg>
                046-873-7752
              </a>
              <a href="https://www.mrso.jp/mrs/zic/Plans/selectPlan" target="_blank" rel="noopener noreferrer" class="dock-contact-web-btn">健診WEB予約</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section screening-category" id="sonota">
    <div class="wave-divider-top">
      <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0 L1200,0 L1200,20 C1000,50 800,-10 600,40 C400,90 200,30 0,110 Z" class="shape-fill" style="fill: var(--mh--color--primary-100);"></path>
      </svg>
    </div>
    <div class="container">
      <header class="section-header fade-in">
        <div class="section-header__inner">
          <p class="section-label">Other</p>
          <h2 class="section-title">その他の健診</h2>
        </div>
      </header>
      <p class="section-lead fade-in">進学・就職・各種施設への入所時など、さまざまな場面に対応した健診を行っています。</p>
      <div class="screening-service-list screening-service-list--dot fade-in">
        <div class="screening-service">
          <span class="screening-service__dot"></span>
          <div class="screening-service__body">
            <h3 class="screening-service__title">進学・就職健診</h3>
            <p class="screening-service__text">大学・専門学校・企業への入学・入社時に必要な健康診断書を発行します。当日結果をお渡しできる場合もあります。</p>
          </div>
        </div>
        <div class="screening-service">
          <span class="screening-service__dot"></span>
          <div class="screening-service__body">
            <h3 class="screening-service__title">施設入所時健診</h3>
            <p class="screening-service__text">介護施設・グループホームなどへの入所時に必要な健康診断に対応しています。</p>
          </div>
        </div>
        <div class="screening-service">
          <span class="screening-service__dot"></span>
          <div class="screening-service__body">
            <h3 class="screening-service__title">各種証明書発行</h3>
            <p class="screening-service__text">健康診断書・健診結果証明書・その他各種証明書の発行を行っています。お気軽にご相談ください。</p>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>
<?php get_footer(); ?>
