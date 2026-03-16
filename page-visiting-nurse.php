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
.nurse-sub-title { font-size: 2.2rem; font-weight: 700; color: var(--mh--color--primary-800); margin-bottom: 25px; padding-bottom: 12px; border-bottom: 2px solid var(--mh--color--secondary-600); text-align: center; }
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
    padding: 28px 24px;
    border-radius: 24px;
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
        <div class="screening-service-list fade-in" style="margin-top: 30px;">
          <?php
          $nurse_services = ['症状、障害、全身状態の観察','清拭などの清潔に関する援助','褥瘡予防、処置','リハビリテーション','ターミナルケア','認知症患者の看護','療養生活指導、栄養指導','医師の指示による医療処置','その他、ご相談に応じます'];
          foreach ($nurse_services as $s) : ?>
          <div class="screening-service">
            <div class="screening-service__head">
              <span class="screening-service__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
              </span>
              <h4 class="screening-service__title"><?php echo esc_html($s); ?></h4>
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

  <section class="section screening-category" id="home-care">
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

</main>
<?php get_footer(); ?>
