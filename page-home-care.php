<?php
/**
 * Template Name: 在宅医療テンプレート
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
.home-care-intro { max-width: 900px; margin: 0 auto 60px; text-align: center; }
.info-box { background: #fff; border: 1px solid var(--mh--color--secondary-600); border-radius: 12px; padding: 30px; margin-top: 40px; position: relative; }
.info-box__title { color: #244e6d; font-size: 1.2rem; font-weight: 700; margin-bottom: 10px; display: flex; align-items: center; gap: 10px; }
.info-box__title::before { content: 'Notice'; font-size: 0.7rem; background: var(--mh--color--secondary-500); padding: 2px 8px; border-radius: 4px; color: var(--mh--color--primary-800); }
.info-box__text { font-size: 1rem; line-height: 1.6; color: #4d4d4d; }
.info-box__contact { margin-top: 15px; padding-top: 15px; border-top: 1px dashed var(--mh--color--secondary-600); display: flex; flex-wrap: wrap; gap: 20px; font-weight: 700; color: #244e6d; }
.reception-info { margin-top: 60px; background: #fff; padding: 40px; border-radius: 12px; border: 1px solid var(--mh--color--primary-100); }
.reception-info__title-sub { font-size: 2.2rem; font-weight: 700; color: var(--mh--color--primary-800); margin-bottom: 25px; padding-bottom: 12px; border-bottom: 2px solid var(--mh--color--secondary-600); }
@media (max-width: 1023px) {
  .reception-info__title-sub { font-size: 1.8rem; }
}
.reception-info__table { width: 100%; border-collapse: collapse; }
.reception-info__table th, .reception-info__table td { padding: 15px; border-bottom: 1px solid rgba(0,0,0,0.05); text-align: left; font-size: 1.8rem; line-height: 1.7; }
.reception-info__table td small { font-size: 1.8rem; color: inherit; display: inline-block; margin-top: 5px; }
.reception-contact-link { color: var(--mh--color--primary-500) !important; font-weight: 600; text-decoration: underline !important; text-underline-offset: 3px; transition: color 0.2s, opacity 0.2s; }
.reception-contact-link:hover { color: var(--mh--color--primary-300) !important; opacity: 0.75; }
.reception-info__table th { width: 140px; color: var(--mh--color--primary-700); font-weight: 700; vertical-align: top; white-space: nowrap; }
.inclusive-center-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 60px; margin-top: 40px; }
.inclusive-center-area__title { font-size: 2.22rem; font-weight: 700; color: #3c699c; margin-bottom: 25px; display: flex; align-items: center; gap: 10px; border-bottom: 2px solid #3c699c; padding-bottom: 12px; }
@media (max-width: 767px) {
  .inclusive-center-area__title { font-size: 1.8rem; }
}
.inclusive-center-item { margin-bottom: 25px; }
.inclusive-center-item__name { font-size: 1.8rem; font-weight: 700; color: #244e6d; margin-bottom: 6px; display: block; }
.inclusive-center-item__detail { font-size: 1.6rem; color: #555; line-height: 1.7; }
.counter-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-top: 60px; }
.counter-card { background: #fff; border: 1px solid var(--mh--color--primary-200); padding: 30px; border-radius: 12px; transition: transform 0.3s; display: flex; gap: 20px; align-items: center; text-decoration: none; }
.counter-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
.counter-card__icon { flex-shrink: 0; width: 80px; height: 80px; display: flex; align-items: center; justify-content: center; }
.counter-card__icon img { max-width: 100%; max-height: 100%; object-fit: contain; }
.counter-card__body { flex: 1; }
.counter-card__label { font-size: 1.5rem; font-weight: 700; color: var(--mh--color--primary-400); margin-bottom: 5px; display: block; letter-spacing: 0.05em; }
.counter-card__name { font-size: 2.0rem; font-weight: 700; color: var(--mh--color--primary-800); margin-bottom: 15px; display: block; line-height: 1.4; }
@media (max-width: 767px) {
  .counter-card__name { font-size: 1.8rem; }
}
.counter-card__link { display: inline-flex; align-items: center; color: #3c699c; text-decoration: none; font-weight: 700; gap: 8px; font-size: 1.6rem; }
.counter-card__link:hover { text-decoration: underline; }
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
}
@media (max-width: 1023px) {
  .inclusive-center-grid, .counter-grid { grid-template-columns: 1fr; }
  .reception-info { padding: 25px 20px; }
  .reception-info__title-sub { font-size: 1.8rem; }
  .reception-info__table th, .reception-info__table td { display: block; width: 100%; padding: 10px 0; }
  .reception-info__table th { padding-bottom: 5px; color: var(--mh--color--primary-800); font-size: 1.6rem; border-bottom: none; }
  .reception-info__table td { padding-top: 0; padding-bottom: 20px; font-size: 1.5rem; }
  .reception-info__table td small { font-size: 1.4rem; }
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
a.inclusive-center-item__name {
  color: #244e6d;
  transition: opacity 0.2s ease;
}
a.inclusive-center-item__name:hover {
  opacity: 0.5;
}
.calendar-wrapper { display: grid; grid-template-columns: 1fr; gap: 40px; }
@media (min-width: 1280px) {
  .calendar-wrapper { grid-template-columns: 1fr 1fr; }
}
.calendar-item { background: #fff; border: 1px solid var(--mh--color--primary-100); border-radius: 12px; padding: 24px; box-shadow: 0 2px 12px rgba(60,105,156,0.07); }
.calendar-item__title { font-size: 1.8rem; font-weight: 700; color: var(--mh--color--primary-700); margin: 0 0 16px; padding-bottom: 12px; border-bottom: 2px solid var(--mh--color--primary-100); }
.calendar-item iframe { display: block; width: 100%; border-radius: 6px; }
</style>
<?php }, 20 );
add_action( 'wp_footer', 'wp_zuyou_print_particle_canvas', 20 );

$_t = get_template_directory_uri();
$news = wp_zuyou_news_query( array( 'posts_per_page' => 3, 'category_name' => '在宅医療' ) );
get_header(); ?>
<main>

  <section class="page-hero page-hero--particle">
    <canvas class="page-hero__canvas" id="js-hero-canvas"></canvas>
    <div class="page-hero__inner">
      <div class="container">
        <p class="page-hero__label">Home Care</p>
        <div class="page-hero__container">
          <h1 class="page-hero__title">在宅医療</h1>
          <p class="page-hero__sub">逗葉地域在宅医療・介護連携相談室は、逗子市・葉山町の皆様が安心して在宅医療を受けながら生活を送れるよう支援する窓口です。専門の看護師が対応いたします。</p>
        </div>
      </div>
    </div>
  </section>

  <section class="section screening-category">
    <div class="container">
      <header class="section-header fade-in">
        <div class="section-header__inner">
          <p class="section-label">Coordination Office</p>
          <h2 class="section-title">逗葉地域在宅医療<br>介護連携相談室</h2>
        </div>
      </header>
      <div class="screening-service-list screening-service-list--dot fade-in">
        <div class="screening-service">
          <span class="screening-service__dot"></span>
          <div class="screening-service__body">
            <h3 class="screening-service__title">在宅医療・介護に関するご相談
            </h3>
            <p class="screening-service__text">逗葉地域在宅医療・介護連携相談室は、医療・介護・福祉の関係者の方からの在宅医療・介護に関する相談を受けています。お電話やメールでご相談に応じますが、内容に応じて来所・訪問いたします。事前にご連絡ください。</p>
          </div>
        </div>
        <div class="screening-service">
          <span class="screening-service__dot"></span>
          <div class="screening-service__body">
            <h3 class="screening-service__title">もしバナゲーム ワークショップ</h3>
            <p class="screening-service__text">地域のサロンや事業所に出向き、出張ワークショップを開催しています。「もしもの時」を考えるきっかけとなる、カードゲームです。終活のスタートにもご活用いただける内容です。ご興味がある方はご連絡ください。</p>
          </div>
        </div>
        <div class="screening-service">
          <span class="screening-service__dot"></span>
          <div class="screening-service__body">
            <h3 class="screening-service__title">各種資料のダウンロード</h3>
            <p class="screening-service__text">資料はこちらからダウンロードしてご利用ください。</p>
            <a href="https://drive.google.com/drive/folders/1hNSM9JjMQ-VXMUX-odZhR69emZbxu4UO?usp=sharing" target="_blank" rel="noopener noreferrer" class="btn btn-primary" style="display: inline-flex; margin-top: 14px; font-size: 1.6rem; padding: 12px 28px;">ダウンロードはこちらから</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section screening-category" id="news">
    <div class="container">
      <div class="news-center-wrapper" style="max-width: 700px; margin: 0 auto;">
        <header class="section-header fade-in">
          <div class="section-header__inner">
            <p class="section-label">News &amp; Events</p>
            <h2 class="section-title">お知らせ・イベント</h2>
          </div>
        </header>
        <div class="news-list fade-in">
          <?php echo $news['items_html']; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="section screening-category calendar-section" id="calendar">
    <div class="container">
      <div class="section-header fade-in">
        <div class="section-header__inner">
          <p class="section-label">Calendar</p>
          <h2 class="section-title">相談室事業イベントカレンダー</h2>
        </div>
      </div>
      <div class="calendar-wrapper fade-in">
        <div class="calendar-item">
          <h3 class="calendar-item__title">今月の予定</h3>
          <iframe src="https://calendar.google.com/calendar/embed?src=zuyou.kensyu%40gmail.com&ctz=Asia%2FTokyo"
                  style="border: 0;" width="100%" height="500" frameborder="0" scrolling="no"></iframe>
        </div>
        <div class="calendar-item">
          <h3 class="calendar-item__title">来月の予定</h3>
          <iframe id="js-next-month-calendar" src=""
                  style="border: 0;" width="100%" height="500" frameborder="0" scrolling="no"></iframe>
        </div>
      </div>
      <script>
      (function () {
        var calendarId = 'zuyou.kensyu@gmail.com';
        var encodedId = encodeURIComponent(calendarId);
        var now = new Date();
        var nextMonthFirst = new Date(now.getFullYear(), now.getMonth() + 1, 1);
        var nextMonthLast  = new Date(now.getFullYear(), now.getMonth() + 2, 0);
        var pad = function (n) { return String(n).padStart(2, '0'); };
        var fmt = function (d) { return d.getFullYear() + pad(d.getMonth() + 1) + pad(d.getDate()); };
        var dateRange = fmt(nextMonthFirst) + '/' + fmt(nextMonthLast);
        var url = 'https://calendar.google.com/calendar/embed?src=' + encodedId + '&ctz=Asia%2FTokyo&dates=' + dateRange;
        document.getElementById('js-next-month-calendar').src = url;
      })();
      </script>
    </div>
  </section>

  <section class="section screening-category">
    <div class="container">
      <header class="section-header fade-in">
        <div class="section-header__inner">
          <p class="section-label">Consultation &amp; Support</p>
          <h2 class="section-title">相談・支援業務について</h2>
        </div>
      </header>
      <div class="screening-service-list screening-service-list--dot fade-in">
        <div class="screening-service">
          <span class="screening-service__dot"></span>
          <div class="screening-service__body">
            <h3 class="screening-service__title">三師会との連携</h3>
            <p class="screening-service__text">逗葉医師会在宅医療相談窓口・逗葉歯科医師会・地域歯科医療連携室及び逗葉薬剤師会対応薬局等と密に連携し、最適なサポート体制を整えています。</p>
          </div>
        </div>
        <div class="screening-service">
          <span class="screening-service__dot"></span>
          <div class="screening-service__body">
            <h3 class="screening-service__title">退院時支援</h3>
            <p class="screening-service__text">医療依存度の高い方が退院される際、病院と連携してスムーズに在宅療養へ移行できるよう、関係機関との調整や支援を行います。</p>
          </div>
        </div>
        <div class="screening-service">
          <span class="screening-service__dot"></span>
          <div class="screening-service__body">
            <h3 class="screening-service__title">多職種からの相談</h3>
            <p class="screening-service__text">地域包括支援センターやケアマネジャー等からの、医療ニーズの高い利用者に関する相談や、医療全般にわたる専門的な支援・アドバイスを行います。</p>
          </div>
        </div>
      </div>
      <div class="reception-info fade-in">
        <h3 class="reception-info__title-sub">受付日時について</h3>
        <table class="reception-info__table">
          <tr>
            <th>受付曜日</th>
            <td>月曜日 〜 金曜日<br><small>（土日祝・年末年始12/29〜1/3を除く）</small></td>
          </tr>
          <tr>
            <th>連絡先</th>
            <td><span style="display: flex; align-items: center; gap: 24px; flex-wrap: wrap;">電話番号：046-870-1070<a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="reception-contact-link">お問合せフォーム</a></span></td>
          </tr>
          <tr>
            <th>受付時間</th>
            <td>8:30 〜 17:15</td>
          </tr>
          <tr>
            <th>相談方法</th>
            <td>基本的には電話でのご相談に対応いたします。<br>相談内容に応じて、来所での相談や、医療機関・事業所等へ訪問することも可能です。事前にご連絡下さい。</td>
          </tr>
        </table>
      </div>
    </div>
  </section>

  <section class="section screening-category" style="padding-bottom: 0;">
    <div class="container">
      <header class="section-header fade-in">
        <div class="section-header__inner">
          <p class="section-label">Local Counters</p>
          <h2 class="section-title">お近くの窓口</h2>
        </div>
      </header>
      <div class="inclusive-center-grid fade-in">
        <div class="inclusive-center-area">
          <h3 class="inclusive-center-area__title">地域包括支援センター（逗子市）</h3>
          <div class="inclusive-center-item">
            <a href="https://www.aoki-hospital.or.jp/sup/" class="inclusive-center-item__name" target="_blank" rel="noopener noreferrer" style="text-decoration: underline; text-underline-offset: 3px;">東部地域包括支援センター</a>
            <span class="inclusive-center-item__detail">桜山3・4・5丁目（35〜37番、葉山団地を除く）、沼間、池子</span>
          </div>
          <div class="inclusive-center-item">
            <a href="https://zushi-shakyo.com/business/bus-008/" class="inclusive-center-item__name" target="_blank" rel="noopener noreferrer" style="text-decoration: underline; text-underline-offset: 3px;">中部地域包括支援センター</a>
            <span class="inclusive-center-item__detail">逗子、桜山1・2・5丁目（35〜37番、葉山団地のみ）・6〜9丁目、山の根、新宿1〜3丁目、新宿4丁目1〜5番（2番29〜59番を除く）、新宿4丁目6番38〜42号、新宿5丁目</span>
          </div>
          <div class="inclusive-center-item">
            <a href="http://www.syonankinenhp.or.jp/departments/supportcenter" class="inclusive-center-item__name" target="_blank" rel="noopener noreferrer" style="text-decoration: underline; text-underline-offset: 3px;">西部地域包括支援センター</a>
            <span class="inclusive-center-item__detail">久木、小坪、新宿4丁目2番29〜59号、新宿4丁目6番1〜16番（6番38〜42号を除く）</span>
          </div>
        </div>
        <div class="inclusive-center-area">
          <h3 class="inclusive-center-area__title">地域包括支援センター（葉山町）</h3>
          <div class="inclusive-center-item">
            <a href="https://www.hayamashakyo.com/projects/hokatu/" class="inclusive-center-item__name" target="_blank" rel="noopener noreferrer" style="text-decoration: underline; text-underline-offset: 3px;">葉山町地域包括支援センター</a>
            <span class="inclusive-center-item__detail">堀内、長柄地区</span>
          </div>
          <div class="inclusive-center-item">
            <a href="https://www.hakuou.or.jp/hayama/serv_home_care.php#localcenter" class="inclusive-center-item__name" target="_blank" rel="noopener noreferrer" style="text-decoration: underline; text-underline-offset: 3px;">葉山町地域包括支援センター清寿苑</a>
            <span class="inclusive-center-item__detail">木古庭、上山口、下山口、一色地区</span>
          </div>
        </div>
      </div>
      <div class="counter-grid fade-in">
        <a href="https://www.city.zushi.kanagawa.jp/kenkofukushi/iryo/1004002/1004005.html" class="counter-card" target="_blank" rel="noopener noreferrer">
          <div class="counter-card__icon"><img src="<?php echo $_t; ?>/images/zushi-city.gif" alt="逗子市"></div>
          <div class="counter-card__body">
            <span class="counter-card__label">逗子市役所</span>
            <span class="counter-card__name">逗子市 在宅医療・介護連携</span>
            <span class="counter-card__link">
              <span>公式サイトを確認する</span>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6M15 3h6v6M10 14L21 3"/></svg>
            </span>
          </div>
        </a>
        <a href="https://www.town.hayama.lg.jp/soshiki/choumin/1/iryokikan/9490.html" class="counter-card" target="_blank" rel="noopener noreferrer">
          <div class="counter-card__icon"><img src="<?php echo $_t; ?>/images/hayama-town.png" alt="葉山町"></div>
          <div class="counter-card__body">
            <span class="counter-card__label">葉山町役場</span>
            <span class="counter-card__name">葉山町 在宅医療・介護連携相談窓口</span>
            <span class="counter-card__link">
              <span>公式サイトを確認する</span>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6M15 3h6v6M10 14L21 3"/></svg>
            </span>
          </div>
        </a>
      </div>
    </div>
    <div class="facility-carousel fade-in" style="margin-top: 60px;">
      <div id="facility-splide" class="splide">
        <div class="splide__track">
          <ul class="splide__list">
            <li class="splide__slide"><div class="facility-slide"><img src="<?php echo $_t; ?>/images/zi1.webp" alt="院内の様子1"></div></li>
            <li class="splide__slide"><div class="facility-slide"><img src="<?php echo $_t; ?>/images/zi2.webp" alt="院内の様子2"></div></li>
            <li class="splide__slide"><div class="facility-slide"><img src="<?php echo $_t; ?>/images/zi3.webp" alt="院内の様子3"></div></li>
          </ul>
        </div>
      </div>
    </div>
  </section>

</main>
<?php get_footer(); ?>
