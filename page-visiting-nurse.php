<?php
/**
 * Template Name: 訪問看護テンプレート
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
.nurse-text { font-size: 1.6rem; line-height: 1.8; color: #555; max-width: 860px; margin: 0 auto 60px; text-align: center; }
.nurse-sub-title { font-size: 2.2rem; font-weight: 700; color: var(--mh--color--primary-800); margin-bottom: 25px; text-align: center; }
.nurse-details .screening-service__icon { background: none; box-shadow: none; width: 32px; height: 32px; color: var(--mh--color--primary-400); }
.fbd { max-width: 660px; margin: 30px auto 0; }
.fbd__row { display: flex; justify-content: center; }
.fbd__row--parallel { gap: 20px; align-items: stretch; }
.fbd__item--center { width: 100%; max-width: 400px; display: flex; flex-direction: column; align-items: center; gap: 10px; }
.fbd__item--branch { flex: 1; display: flex; flex-direction: column; align-items: center; gap: 10px; }
.fbd__item--branch .fbd__card { flex: 1; }
.fbd__step { width: 60px; height: 60px; border-radius: 50%; background: var(--mh--color--primary-500); color: #fff; display: flex; flex-direction: column; align-items: center; justify-content: center; font-weight: 700; flex-shrink: 0; z-index: 1; }
.fbd__step--accent { background: var(--mh--color--primary-400); }
.fbd__step-lbl { font-size: 0.9rem; opacity: 0.85; line-height: 1.2; }
.fbd__step-num { font-size: 1.8rem; line-height: 1; }
.fbd__card { background: #fff; border: 1px solid var(--mh--color--primary-200); border-radius: 10px; padding: 16px 20px; box-shadow: 0 2px 10px rgba(60,105,156,0.07); width: 100%; text-align: left; box-sizing: border-box; }
.fbd__card--accent { border-color: var(--mh--color--primary-400); border-width: 2px; }
.fbd__tag { display: block; width: fit-content; background: var(--mh--color--primary-100); color: var(--mh--color--primary-500); font-size: 1.5rem; font-weight: 700; padding: 3px 12px; border-radius: 4px; margin: 0 auto 10px; text-align: center; }
.fbd__tag--accent { background: var(--mh--color--primary-400); color: #fff; }
.fbd__title { font-size: 2.0rem; font-weight: 700; color: var(--mh--color--primary-800); margin: 0 0 8px; text-align: center; }
.fbd__text { font-size: 1.5rem; color: #555; line-height: 1.8; margin: 0; }
.fbd__conn { position: relative; height: 50px; width: 100%; max-width: 660px; margin: 0 auto; }
.fbd__conn--down::before { content: ''; position: absolute; top: 0; bottom: 0; left: calc(50% - 1px); width: 2px; background: var(--mh--color--primary-200); }
.fbd__conn--fork::before { content: ''; position: absolute; top: 0; left: calc(50% - 1px); height: 20px; width: 2px; background: var(--mh--color--primary-200); }
.fbd__conn--fork::after { content: ''; position: absolute; top: 20px; left: 25%; right: 25%; height: 2px; background: var(--mh--color--primary-200); }
.fbd__conn-arm { position: absolute; width: 2px; background: var(--mh--color--primary-200); }
.fbd__conn--fork .fbd__conn-arm--left { top: 20px; bottom: 0; left: calc(25% - 1px); }
.fbd__conn--fork .fbd__conn-arm--right { top: 20px; bottom: 0; right: calc(25% - 1px); }
.fbd__conn--merge::after { content: ''; position: absolute; bottom: 20px; left: 25%; right: 25%; height: 2px; background: var(--mh--color--primary-200); }
.fbd__conn--merge::before { content: ''; position: absolute; bottom: 0; left: calc(50% - 1px); height: 20px; width: 2px; background: var(--mh--color--primary-200); }
.fbd__conn--merge .fbd__conn-arm--left { top: 0; bottom: 20px; left: calc(25% - 1px); }
.fbd__conn--merge .fbd__conn-arm--right { top: 0; bottom: 20px; right: calc(25% - 1px); }
.fbd__notes { margin-top: 80px; font-size: 1.8rem; color: #444; line-height: 1.85; max-width: 1100px; margin-left: auto; margin-right: auto; display: flex; align-items: center; gap: 0; position: relative; }
.fbd__notes-illu { flex-shrink: 0; width: 480px; height: 340px; position: relative; display: flex; align-items: center; justify-content: center; z-index: 1; }
.fbd__notes-illu-bg { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 110%; height: 110%; border-radius: 60% 40% 70% 30% / 30% 70% 30% 70%; opacity: 0.12; filter: blur(50px); z-index: 0; }
.fbd__notes-img { position: relative; z-index: 1; width: 100%; height: 100%; display: block; object-fit: cover; border-radius: 30px; filter: drop-shadow(0 12px 24px rgba(60,105,156,0.15)); transition: transform 0.6s cubic-bezier(0.165,0.84,0.44,1); }
.fbd__notes-body { flex: 1; background: var(--mh--color--primary-400); padding: 40px 50px; border-radius: 40px; box-shadow: 0 15px 35px rgba(0,0,0,0.08); margin-left: -60px; position: relative; z-index: 2; color: #fff; }
.fbd__notes-body p { margin: 0.5em 0; color: #fff; }
.fbd__notes-illu:hover .fbd__notes-img { transform: translateX(-10px) scale(1.02); }

/* --- 訪問看護サービス アコーディオン (3*3カラム) --- */
.nurse-details .screening-service-list {
  display: flex;
  flex-direction: column;
  gap: 0;
  margin-top: 0;
}
.nurse-details .screening-service {
  padding: 0;
  background: none;
  border: none;
  border-bottom: 1px solid var(--mh--color--primary-100);
  border-radius: 0;
  box-shadow: none;
  width: 100%;
  cursor: pointer;
  transition: background-color 0.2s ease;
}
.nurse-details .screening-service:hover {
  background-color: rgba(60, 105, 156, 0.02);
  transform: none !important;
  box-shadow: none !important;
}
@media (min-width: 1024px) {
  .nurse-details .screening-service-list {
    flex-direction: row;
    flex-wrap: wrap;
    gap: 0 40px; /* 横余白を狭くして3カラムを維持 */
    align-items: flex-start;
  }
  .nurse-details .screening-service {
    width: calc((100% - 80px) / 3); /* (100% - gap*2) / 3 */
    border-right: none;
  }
  .nurse-details .screening-service:nth-child(n+4) {
    border-top: none;
  }
  /* 1〜3個目には上線をつける */
  .nurse-details .screening-service:nth-child(-n+3) {
    border-top: 1px solid var(--mh--color--primary-100);
  }
}

.nurse-details .screening-service-btn {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 20px 0;
  background: none;
  border: none;
  cursor: inherit;
  text-align: left;
  transition: opacity 0.3s ease;
}
.nurse-details .screening-service-btn:hover {
  opacity: 0.7;
}
.nurse-details .screening-service__head {
  margin-bottom: 0;
  padding-bottom: 0;
  pointer-events: none;
}
.nurse-details .screening-service-trigger-icon {
  width: 24px;
  height: 24px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--mh--color--primary-400);
  transition: transform 0.3s ease;
}
.nurse-details .screening-service-trigger-icon svg {
  width: 16px;
  height: 16px;
  transform: rotate(90deg); /* 閉じた状態: ＞ (右向きを回転させて下向きに) */
}
.nurse-details .is-active .screening-service-trigger-icon {
  transform: rotate(180deg); /* 開いた状態: ＞ (上向き) */
}
.nurse-details .screening-service__content {
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.3s ease;
}
.nurse-details .screening-service__inner {
  padding: 0px 15px 20px;
  font-size: 1.5rem;
  line-height: 1.85;
  color: #555;
}

.page-hero__container .page-hero__title { font-size: min(10vw, 5.0rem); }
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

  .page-hero__container .page-hero__title {
    font-size: 2.9rem;
    line-height: 1.2;
  }

  .page-hero__sub {
    font-size: 1.3rem;
    line-height: 1.75;
    padding-top: 12px;
  }

  .fbd__notes {
    flex-direction: column;
    gap: 20px;
    margin-top: 48px;
  }

  .fbd__notes-illu {
    width: 100%;
    max-width: 320px;
    height: auto;
    aspect-ratio: 4 / 3;
  }

  .fbd__notes-body {
    width: 100%;
    margin-left: 0;
    padding: 5px 10px;
    border-radius: 20px;
  }
}

/* --- 受付日時 & 波状区切り --- */
.wave-divider-top {
  position: absolute;
  top: -1px;
  left: 0;
  width: 100%;
  height: 60px;
  z-index: 1;
  pointer-events: none;
}
@media (min-width: 768px) {
  .wave-divider-top { height: 120px; }
}
.wave-divider-top svg { display: block; width: 100%; height: 100%; }

/* セクションごとの背景色指定 */
#home-care {
  background-color: #f4f4f0 !important; /* ベージュ */
}
#contact-section {
  background-color: #fff !important; /* 白 */
}
#home-care, #contact-section {
  padding-top: 100px;
}
@media (min-width: 768px) {
  #home-care, #contact-section {
    padding-top: 160px;
  }
}

.reception-info {
  margin-top: 60px;
  background: #fff;
  padding: 40px;
  border-radius: 12px;
  border: 1px solid var(--mh--color--primary-100);
}
.reception-info__title-sub {
  font-size: 2.22rem;
  font-weight: 700;
  color: var(--mh--color--primary-800);
  margin-bottom: 25px;
  padding-bottom: 12px;
  border-bottom: 2px solid var(--mh--color--secondary-600);
}
.reception-info__table { width: 100%; border-collapse: collapse; }
.reception-info__table th, .reception-info__table td {
  padding: 15px;
  border-bottom: 1px solid rgba(0,0,0,0.05);
  text-align: left;
  font-size: 1.8rem;
  line-height: 1.7;
}
.reception-info__table td small { font-size: 1.8rem; color: inherit; display: inline-block; margin-top: 5px; }
.reception-contact-link { color: var(--mh--color--primary-500) !important; font-weight: 600; text-decoration: underline !important; text-underline-offset: 3px; transition: color 0.2s, opacity 0.2s; }
.reception-contact-link:hover { color: var(--mh--color--primary-300) !important; opacity: 0.75; }
.reception-info__table th { width: 140px; color: var(--mh--color--primary-700); font-weight: 700; vertical-align: top; white-space: nowrap; }

@media (max-width: 1023px) {
  .reception-info { padding: 25px 20px; }
  .reception-info__table th, .reception-info__table td { display: block; width: 100%; padding: 10px 0; }
  .reception-info__table th { padding-bottom: 5px; color: var(--mh--color--primary-800); font-size: 1.7rem; border-bottom: none; }
  .reception-info__table td { padding-top: 0; padding-bottom: 20px; font-size: 1.6rem; }
  .reception-info__table td small { font-size: 1.5rem; }
  .reception-info__table tr:last-child td { padding-bottom: 0; border-bottom: none; }
  
  /* 連絡先内の連結を、非常に狭い画面では縦に並べる */
  @media (max-width: 480px) {
    .reception-info__table td span[style*="flex"] {
      flex-direction: column !important;
      align-items: flex-start !important;
      gap: 12px !important;
    }
  }
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const containers = document.querySelectorAll('.nurse-details .screening-service');
  containers.forEach(container => {
    container.addEventListener('click', function() {
      const content = this.querySelector('.screening-service__content');
      const isActive = this.classList.contains('is-active');

      if (isActive) {
        this.classList.remove('is-active');
        content.style.maxHeight = '0';
      } else {
        this.classList.add('is-active');
        content.style.maxHeight = content.scrollHeight + 'px';
      }
    });
  });
});
</script>
<?php }, 20 );
add_action( 'wp_footer', 'wp_zuyou_print_particle_canvas', 20 );

$_t = get_template_directory_uri();
get_header(); ?>
<main>

  <section class="page-hero page-hero--particle">
    <canvas class="page-hero__canvas" id="js-hero-canvas"></canvas>
    <div class="page-hero__inner">
      <div class="container">
        <p class="page-hero__label">Visiting Nurse</p>
        <div class="page-hero__container">
          <h1 class="page-hero__title">訪問看護</h1>
          <p class="page-hero__sub">訪問看護・居宅介護支援の2つのサービスを提供しております。『どうやって利用すればいいの？』『どんなサービスが使えるの？』など、難しくて分からないことがたくさんあると思います。どうぞ、お気軽にご相談下さい。</p>
        </div>
      </div>
    </div>
  </section>

  <section class="section screening-category">
    <div class="container">
      <header class="section-header fade-in">
        <div class="section-header__inner">
          <p class="section-label">Visiting Nurse</p>
          <h2 class="section-title">訪問看護</h2>
        </div>
      </header>
      <p class="nurse-text fade-in">高齢者の方や病気やけが等により在宅療養を必要とされる方に対して、経験豊富な看護師が看護サービスを提供致します。サービスの内容は主治医の指示の下、ご本人やご家族のご希望を考慮した上で看護計画を立ててご提供致します。</p>
      <div class="nurse-details fade-in">
        <h3 class="nurse-sub-title">訪問看護サービスの内容</h3>
        <div class="screening-service-list fade-in">
          <?php
          $nurse_services = [
            '症状、障害、全身状態の観察' => '疾病の状態や身体状況、心身の健康状態、血圧、体温、脈拍等のチェックを行い、異常の早期発見に努めます。',
            '清拭などの清潔に関する援助' => '入浴介助や清拭、洗髪、足浴、口腔ケア等を行い、身体の清潔を維持・向上させます。',
            '褥瘡予防、処置' => '体位変換やマッサージ、患部の処置等を行い、床ずれの予防や早期治癒を支援します。',
            'リハビリテーション' => 'ADL（日常生活動作）の維持・回復、呼吸リハビリ、嚥下訓練等をご自宅で行います。',
            'ターミナルケア' => 'ご自宅で最期までその人らしく過ごせるよう、痛み緩和や精神的なケアをサポートします。',
            '認知症患者の看護' => '生活リズムの調整や事故防止のアドバイスを行い、認知症の方への適切な対応を支援します。',
            '療養生活指導、栄養指導' => '食事や服薬、排泄等の介助や指導を行い、安全で適切な療養環境を整えます。',
            '医師の指示による医療処置' => '点滴、カテーテル管理、インスリン注射、吸引、在宅酸素の管理等の医療処置を行います。',
            'その他、ご相談に応じます' => '介護に関するお悩みや、制度の利用方法等、どんなことでもお気軽にご相談ください。'
          ];
          foreach ($nurse_services as $title => $desc) : ?>
          <div class="screening-service">
            <button class="screening-service-btn js-accordion-trigger">
              <div class="screening-service__head">
                <span class="screening-service__icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                </span>
                <h4 class="screening-service__title"><?php echo esc_html($title); ?></h4>
              </div>
              <div class="screening-service-trigger-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
              </div>
            </button>
            <div class="screening-service__content">
              <div class="screening-service__inner">
                <p><?php echo esc_html($desc); ?></p>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="nurse-mechanism fade-in" style="margin-top: 80px;">
        <h3 class="nurse-sub-title">訪問看護サービス利用の仕組み</h3>
        <div class="fbd">
          <div class="fbd__row">
            <div class="fbd__item--center">
              <div class="fbd__step"><span class="fbd__step-lbl">STEP</span><span class="fbd__step-num">1</span></div>
              <div class="fbd__card">
                <span class="fbd__tag">ご利用者</span>
                <h4 class="fbd__title">相談・依頼</h4>
                <p class="fbd__text">訪問看護のご利用を希望される方は、居宅介護支援事業者（ケアマネジャー）またはかかりつけ医にご相談ください。</p>
              </div>
            </div>
          </div>
          <div class="fbd__conn fbd__conn--fork">
            <span class="fbd__conn-arm fbd__conn-arm--left"></span>
            <span class="fbd__conn-arm fbd__conn-arm--right"></span>
          </div>
          <div class="fbd__row fbd__row--parallel">
            <div class="fbd__item--branch">
              <div class="fbd__step"><span class="fbd__step-lbl">STEP</span><span class="fbd__step-num">2</span></div>
              <div class="fbd__card">
                <span class="fbd__tag">居宅介護支援事業者</span>
                <h4 class="fbd__title">提供票の発行</h4>
                <p class="fbd__text">ケアマネジャーがケアプランを作成し、サービス提供票を訪問看護ステーションへ発行します。</p>
              </div>
            </div>
            <div class="fbd__item--branch">
              <div class="fbd__step"><span class="fbd__step-lbl">STEP</span><span class="fbd__step-num">3</span></div>
              <div class="fbd__card">
                <span class="fbd__tag">かかりつけ医</span>
                <h4 class="fbd__title">訪問看護指示書の発行</h4>
                <p class="fbd__text">主治医が訪問看護指示書を作成し、訪問看護ステーションへ交付します。</p>
              </div>
            </div>
          </div>
          <div class="fbd__conn fbd__conn--merge">
            <span class="fbd__conn-arm fbd__conn-arm--left"></span>
            <span class="fbd__conn-arm fbd__conn-arm--right"></span>
          </div>
          <div class="fbd__row">
            <div class="fbd__item--center">
              <div class="fbd__step fbd__step--accent"><span class="fbd__step-lbl">STEP</span><span class="fbd__step-num">4</span></div>
              <div class="fbd__card fbd__card--accent">
                <span class="fbd__tag fbd__tag--accent">訪問看護ステーション</span>
                <h4 class="fbd__title">サービスの提供開始</h4>
                <p class="fbd__text">看護計画を作成の上、ご自宅へ訪問してサービスを開始します。</p>
              </div>
            </div>
          </div>
        </div>
        <div class="fbd__notes">
          <div class="fbd__notes-illu">
            <div class="fbd__notes-illu-bg" style="background-color: var(--mh--color--primary-400);"></div>
            <img src="<?php echo $_t; ?>/images/訪問看護.jpg" alt="" class="fbd__notes-img">
          </div>
          <div class="fbd__notes-body">
            <p>※居宅介護支援事業所を併設しておりますので、ご相談下さい。</p>
            <p>※かかりつけ医がいらっしゃらない場合は、ご相談下さい。</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section screening-category screening-category--alt" id="home-care">
    <div class="wave-divider-top">
      <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0 L1200,0 L1200,20 C1000,50 800,-10 600,40 C400,90 200,30 0,110 Z" class="shape-fill" style="fill: #fff;"></path>
      </svg>
    </div>
    <div class="container">
      <header class="section-header fade-in">
        <div class="section-header__inner">
          <p class="section-label">Home Care Support</p>
          <h2 class="section-title">居宅介護支援について</h2>
        </div>
      </header>
      <p class="nurse-text fade-in">ケアマネジャーが利用者ご本人やそのご家族のご希望をお伺いし、身体の状態を踏まえた上で、その方に合ったサービスを計画致します。また、サービス提供事業者との連絡・調整を行うことで、サービスの利用をスムーズに進めます。</p>
      <div class="fbd-wrapper fade-in">
        <h3 class="nurse-sub-title">介護サービス計画の作成からサービス開始までの流れ</h3>
        <div class="fbd">
          <div class="fbd__row">
            <div class="fbd__item--center">
              <div class="fbd__step"><span class="fbd__step-lbl">STEP</span><span class="fbd__step-num">1</span></div>
              <div class="fbd__card">
                <h4 class="fbd__title">ケアマネジャーへの依頼</h4>
                <p class="fbd__text">居宅介護支援事業者へご依頼ください。</p>
              </div>
            </div>
          </div>
          <div class="fbd__conn fbd__conn--down"></div>
          <div class="fbd__row">
            <div class="fbd__item--center">
              <div class="fbd__step"><span class="fbd__step-lbl">STEP</span><span class="fbd__step-num">2</span></div>
              <div class="fbd__card">
                <h4 class="fbd__title">現状把握・計画原案作成</h4>
                <p class="fbd__text">問題点や現状を把握するため、ケアマネジャーがお伺いします。内容を基に、計画の原案を作成します。</p>
              </div>
            </div>
          </div>
          <div class="fbd__conn fbd__conn--down"></div>
          <div class="fbd__row">
            <div class="fbd__item--center">
              <div class="fbd__step"><span class="fbd__step-lbl">STEP</span><span class="fbd__step-num">3</span></div>
              <div class="fbd__card">
                <h4 class="fbd__title">検討・調整</h4>
                <p class="fbd__text">担当のケアマネジャーを中心に、ご本人・ご家族・サービス事業者の3者で検討・調整を行います。</p>
              </div>
            </div>
          </div>
          <div class="fbd__conn fbd__conn--down"></div>
          <div class="fbd__row">
            <div class="fbd__item--center">
              <div class="fbd__step fbd__step--accent"><span class="fbd__step-lbl">STEP</span><span class="fbd__step-num">4</span></div>
              <div class="fbd__card fbd__card--accent">
                <h4 class="fbd__title">同意・サービス開始</h4>
                <p class="fbd__text">サービス計画の内容について同意を頂いた上で、サービスが開始されます。</p>
              </div>
            </div>
          </div>
        </div>
        <div class="fbd__notes">
          <div class="fbd__notes-illu">
            <div class="fbd__notes-illu-bg" style="background-color: var(--mh--color--secondary-500);"></div>
            <img src="<?php echo $_t; ?>/images/居宅.png" alt="" class="fbd__notes-img">
          </div>
          <div class="fbd__notes-body">
            <p>※サービスの提供が開始された後でも、必要に応じてサービス計画の見直しを致しますので、お気軽にご相談下さい。</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section screening-category" id="contact-section">
    <div class="wave-divider-top">
      <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0 L1200,0 L1200,20 C1000,50 800,-10 600,40 C400,90 200,30 0,110 Z" class="shape-fill" style="fill: #f4f4f0;"></path>
      </svg>
    </div>
    <div class="container">
      <header class="section-header fade-in">
        <div class="section-header__inner">
          <p class="section-label">Contact</p>
          <h2 class="section-title">ご利用のお問合せ</h2>
        </div>
      </header>
      <div class="screening-service-list screening-service-list--dot fade-in">
        <div class="screening-service">
          <span class="screening-service__dot"></span>
          <div class="screening-service__body">
            <h3 class="screening-service__title">24時間緊急対応</h3>
            <p class="screening-service__text">地域の医療機関と密に連携し、24時間体制で緊急時の対応を行っています。</p>
          </div>
        </div>
        <div class="screening-service">
          <span class="screening-service__dot"></span>
          <div class="screening-service__body">
            <h3 class="screening-service__title">訪問看護（看取りを含む）のご提供</h3>
            <p class="screening-service__text">難病や癌末期の方を中心に、ご自宅での訪問看護サービス（看取りを含む）をご提供しています。</p>
          </div>
        </div>
        <div class="screening-service">
          <span class="screening-service__dot"></span>
          <div class="screening-service__body">
            <h3 class="screening-service__title">ケアマネージャーの有資格者が兼務します。</h3>
            <p class="screening-service__text">ケアマネージャーの資格を持つスタッフが、医療・介護の両面からご相談に対応します。</p>
          </div>
        </div>
      </div>
      <div class="reception-info fade-in">
        <h3 class="reception-info__title-sub">受付日時について</h3>
        <table class="reception-info__table">
          <tr>
            <th>住所</th>
            <td>〒249-0003逗子市池子字桟敷戸1892-6</td>
          </tr>
          <tr>
            <th>営業時間</th>
            <td>月曜日 〜 金曜日　8:30 〜 17:15<br><small>（土日・祝日・年末年始 12/29〜1/3 を除く）</small></td>
          </tr>
          <tr>
            <th>連絡先</th>
            <td><span style="display: flex; align-items: center; gap: 24px; flex-wrap: wrap;">電話番号：046-870-1070　FAX：046-871-6497<a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="reception-contact-link">お問合せフォームはこちら</a></span></td>
          </tr>
          <tr>
            <th>訪問エリア</th>
            <td>逗子市全域、葉山町全域</td>
          </tr>
          <tr>
            <th>事業所番号</th>
            <td>1462590008</td>
          </tr>          
          <tr>
            <th>その他の備考等</th>
            <td>サンプルテキストＸＸＸＸＸサンプルテキストＸＸＸＸＸサンプルテキストＸＸＸＸＸサンプルテキストＸＸＸＸＸ</td>
          </tr>
        </table>
      </div>
    </div>
  </section>

</main>
<?php get_footer(); ?>
