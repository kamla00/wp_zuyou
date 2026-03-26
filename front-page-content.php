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
              発熱されて直ぐに来られても検査結果が陰性になる可能性があります。検査ご希望の方は、発熱から12時間以上経過してからお越し頂くと陽性が検出しやすく 正確な検査結果が得られます。
            </div>
          </div>
          <div id="info-items" class="hero-info-content js-info-content">
            <div class="hero-info-inner">
              ・マイナンバーカードまたは資格確認証<br/>
              ・公費医療証（お持ちの方のみ）<br/>・お薬手帳<br/>※お忘れの場合は、自費扱いとなり後日、返金となります。
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="hero-bg">
      <div class="hero-bg__inner">
        <img src="<?php echo get_template_directory_uri(); ?>/images/hero.webp" alt="逗葉地域医療センター 玄関1">
        <img src="<?php echo get_template_directory_uri(); ?>/images/hero1.webp" alt="逗葉地域医療センター 玄関2">
        <img src="<?php echo get_template_directory_uri(); ?>/images/hero2.webp" alt="逗葉地域医療センター 玄関3">
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

  <!-- News Section -->
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
            <?php
            // functions.php の共通関数を使用
            $news_data = wp_zuyou_news_query( array( 'posts_per_page' => 3 ) );
            echo $news_data['items_html'];
            ?>
          </div>
          <div style="margin-top: 20px; text-align: right;">
            <a href="<?php echo get_post_type_archive_link( 'post' ); ?>" class="u-link-text" style="color: var(--mh--color--primary-500); font-weight: 500;">お知らせ一覧を見る &rarr;</a>
          </div>
        </div>

        <div class="news-right">
          <!-- 急患診療テーブルなどはそのまま静的に保持するか、カスタムフィールドなどで対応 -->
          <header class="section-header fade-in is-left">
            <div class="section-header__inner">
              <p class="section-label">Medical Hours</p>
              <h2 class="section-title">急患診療</h2>
            </div>
          </header>
          <div class="medical-hours fade-in">
            <!-- テーブル内容はHTMLからコピー -->
            <div class="medical-hours__table-wrapper">
                <table class="medical-hours__table">
                    <thead>
                      <tr>
                        <th colspan="2">診療時間</th>
                        <th>月</th><th>火</th><th>水</th><th>木</th><th>金</th><th>土</th><th>日・祝</th><th>年末<br>年始</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr><td rowspan="2" class="td-subject">内科(小児科)</td><td>10:00~17:00</td><td></td><td></td><td></td><td></td><td></td><td>○</td><td>○</td><td>○</td></tr>
                      <tr><td>20:00~23:00</td><td>○</td><td>○</td><td>○</td><td>○</td><td>○</td><td>○</td><td>○</td><td>○</td></tr>
                      <tr><td rowspan="2" class="td-subject">外科</td><td>10:00~17:00</td><td></td><td></td><td></td><td></td><td></td><td>○</td><td>○</td><td>○</td></tr>
                      <tr><td>20:00~23:00</td><td>○</td><td>○</td><td>○</td><td>○</td><td>○</td><td>○</td><td>○</td><td>○</td></tr>
                      <tr><td class="td-subject">歯科</td><td>10:00~17:00</td><td></td><td></td><td></td><td></td><td></td><td>○</td><td>○</td><td>○</td></tr>
                    </tbody>
                </table>
            </div>
            <p class="medical-hours__note">※診療時間の終了、15分前までにお入り下さいますようお願いします。</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 各種サービスセクション -->
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
        <!-- サービスカード 01 -->
        <article class="service-card fade-in">
          <div class="service-card__left">
            <div class="service-card__head">
              <div class="service-card__number"><span>01</span></div>
              <div class="service-card__title-group"><h3 class="service-card__title">健診事業</h3><p class="service-card__subtitle">Health Checkup</p></div>
            </div>
            <div class="service-card__illu-wrap">
              <div class="service-card__illu-bg" style="background-color: #ffd966;"></div>
              <div class="service-card__illu-content"><img src="<?php echo get_template_directory_uri(); ?>/images/health-checkup.webp" alt="健康診断"></div>
            </div>
          </div>
          <div class="service-card__body">
            <h4 class="service-card__main-lead">健診事業</h4>
            <p class="service-card__description">住民健診から人間ドックまで、高度な検査体制で健康をサポートします。</p>
            <p class="service-card__tel"><a href="tel:0468737752">046-873-7752</a></p>
            <div class="service-card__more"><a href="<?php echo home_url('/screening'); ?>" class="service-card__more-btn"><span>もっと見る</span></a></div>
          </div>
        </article>
        <!-- サービスカード 02 -->
        <article class="service-card fade-in">
          <div class="service-card__left">
            <div class="service-card__head">
              <div class="service-card__number"><span>02</span></div>
              <div class="service-card__title-group"><h3 class="service-card__title">急患診療</h3><p class="service-card__subtitle">Emergency Care</p></div>
            </div>
            <div class="service-card__illu-wrap">
              <div class="service-card__illu-bg" style="background-color: #ffb3b3;"></div>
              <div class="service-card__illu-content"><img src="<?php echo get_template_directory_uri(); ?>/images/emergency-care.webp" alt="急患診療"></div>
            </div>
          </div>
          <div class="service-card__body">
            <h4 class="service-card__main-lead">急患診療</h4>
            <p class="service-card__description">夜間・休日の急な病気やけがに対応する急患診療を行っています。</p>
            <div class="service-card__more"><a href="<?php echo home_url('/emergency'); ?>" class="service-card__more-btn"><span>もっと見る</span></a></div>
          </div>
        </article>
        <!-- サービスカード 03 -->
        <article class="service-card fade-in">
          <div class="service-card__left">
            <div class="service-card__head">
              <div class="service-card__number"><span>03</span></div>
              <div class="service-card__title-group"><h3 class="service-card__title">訪問看護</h3><p class="service-card__subtitle">Visiting Nurse</p></div>
            </div>
            <div class="service-card__illu-wrap">
              <div class="service-card__illu-bg" style="background-color: #b3d9f7;"></div>
              <div class="service-card__illu-content"><img src="<?php echo get_template_directory_uri(); ?>/images/visiting-nurse.webp" alt="訪問看護"></div>
            </div>
          </div>
          <div class="service-card__body">
            <h4 class="service-card__main-lead">訪問看護</h4>
            <p class="service-card__description">経験豊富な看護師がご自宅を訪問し、療養生活をトータルでサポートします。</p>
            <p class="service-card__tel"><a href="tel:0468717693">046-871-7693</a></p>
            <div class="service-card__more"><a href="<?php echo home_url('/visiting-nurse'); ?>" class="service-card__more-btn"><span>もっと見る</span></a></div>
          </div>
        </article>
        <!-- サービスカード 04 -->
        <article class="service-card fade-in">
          <div class="service-card__left">
            <div class="service-card__head">
              <div class="service-card__number"><span>04</span></div>
              <div class="service-card__title-group"><h3 class="service-card__title">逗葉地域在宅医療<br>介護連携相談室</h3><p class="service-card__subtitle">Home Care</p></div>
            </div>
            <div class="service-card__illu-wrap">
              <div class="service-card__illu-bg" style="background-color: #b3e0cc;"></div>
              <div class="service-card__illu-content"><img src="<?php echo get_template_directory_uri(); ?>/images/home-medical.webp" alt="在宅医療"></div>
            </div>
          </div>
          <div class="service-card__body">
            <h4 class="service-card__main-lead">逗葉地域在宅医療<br>介護連携相談室</h4>
            <p class="service-card__description">医療・介護の専門スタッフが連携し、安心して在宅療養できるよう支援します。</p>
            <p class="service-card__tel"><a href="tel:0468701070">046-870-1070</a></p>
            <div class="service-card__more"><a href="<?php echo home_url('/home-care'); ?>" class="service-card__more-btn"><span>もっと見る</span></a></div>
          </div>
        </article>
      </div>
    </div>
  </section>
  
  <!-- Facility Carousel -->
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
            <?php for($i=1; $i<=5; $i++): ?>
            <li class="splide__slide">
              <div class="facility-slide">
                <img src="<?php echo get_template_directory_uri(); ?>/images/sl<?php echo $i===1?'':$i; ?>.jpg" alt="院内の様子">
              </div>
            </li>
            <?php endfor; ?>
          </ul>
        </div>
      </div>
    </div>
  </section>
