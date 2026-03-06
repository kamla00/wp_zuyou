<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <!-- SVG Organic Clip Paths (Required for Header/Hero shapes) -->
  <svg width="0" height="0" style="position: absolute;">
    <defs>
      <!-- Header Curve Clip -->
      <clipPath id="header-curve-clip" clipPathUnits="objectBoundingBox">
        <path d="M0.2,0 L1,0 L1,1 L0.55,1 C0.25,1, 0,0.4, 0.2,0 Z" />
      </clipPath>
      <!-- Hero Wave Clip -->
      <clipPath id="hero-wave-clip" clipPathUnits="objectBoundingBox">
        <path d="M0.52, 0.18 C 0.72, 0.18, 0.88, 0.33, 0.88, 0.53 C 0.88, 0.73, 0.68, 0.88, 0.48, 0.88 C 0.28, 0.88, 0.12, 0.77, 0.12, 0.57 C 0.12, 0.37, 0.32, 0.18, 0.52, 0.18 Z" />
      </clipPath>
    </defs>
  </svg>

  <header class="js-header l-header is-mv">
    <div class="l-header__inner">
      <h1 class="l-header-logo">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="l-header-logo__link u-alpha">
          <div class="l-header-logo__img">
            <img src="<?php echo get_template_directory_uri(); ?>/mock/mock/images/ch-no-bg.png" alt="<?php bloginfo( 'name' ); ?>" class="logo-image">
          </div>
          <div class="l-header-logo__titles">
            <span class="l-header-logo__txt u-text-x4s u-tracking-md">公益財団法人</span>
            <span class="l-header-logo__site-name">逗葉地域医療センター</span>
          </div>
        </a>
      </h1>
      <button class="js-nav-btn l-nav-btn u-hidden-xl-up">
        <span class="l-nav-btn__line"></span>
        <span class="l-nav-btn__line"></span>
      </button>
      <nav class="js-nav-content l-nav">
        <ul class="l-nav-list">
          <?php
          $req_path = rtrim( strtok( $_SERVER['REQUEST_URI'], '?' ), '/' );
          $base_path = rtrim( parse_url( home_url('/'), PHP_URL_PATH ), '/' );
          $nav_pages = array(
            array( 'slug' => '',               'text' => 'ホーム' ),
            array( 'slug' => 'screening',      'text' => '健診事業' ),
            array( 'slug' => 'emergency',      'text' => '急患診療' ),
            array( 'slug' => 'visiting-nurse', 'text' => '訪問看護' ),
            array( 'slug' => 'home-care',      'text' => '在宅医療' ),
            array( 'slug' => 'news',           'text' => 'お知らせ' ),
            array( 'slug' => 'contact',        'text' => 'お問合せ' ),
          );
          foreach ( $nav_pages as $page ) :
            $link_path = $base_path . ( $page['slug'] ? '/' . $page['slug'] : '' );
            $is_active = ( $req_path === $link_path );
            $active_class = $is_active ? ' is-active' : '';
          ?>
          <li class="l-nav-list__item">
            <a href="<?php echo esc_url( home_url( '/' . $page['slug'] ) ); ?>" class="l-nav-list__item-link u-link-text<?php echo $active_class; ?>">
              <span class="l-nav-list__item-txt"><?php echo esc_html( $page['text'] ); ?></span>
            </a>
          </li>
          <?php endforeach; ?>
        </ul>
        <ul class="l-nav-cv">
          <li class="l-nav-cv__btn c-cv-btn is-hd"><a class="c-cv-btn__link" href="https://www.mrso.jp/mrs/zic/Plans/selectPlan" target="_blank" rel="noopener noreferrer">
            <span class="c-cv-btn__in">
              <span class="c-cv-btn__txt">健診WEB予約</span>
            </span>
          </a></li>
        </ul>
      </nav>
    </div>
  </header>
