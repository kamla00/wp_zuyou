<?php
function wp_zuyou_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );

    register_nav_menus( array(
        'main-menu' => 'メインメニュー',
        'footer-menu' => 'フッターメニュー',
    ) );
}
add_action( 'after_setup_theme', 'wp_zuyou_setup' );

// /news URL 専用リライトルール（WPページ不要でpage-news.phpを提供）
add_action( 'init', function () {
    add_rewrite_rule( '^news/page/([0-9]+)/?$', 'index.php?wp_zuyou_news=1&paged=$matches[1]', 'top' );
    add_rewrite_rule( '^news/?$',               'index.php?wp_zuyou_news=1', 'top' );
} );

add_filter( 'query_vars', function ( $vars ) {
    $vars[] = 'wp_zuyou_news';
    return $vars;
} );

add_filter( 'template_include', function ( $template ) {
    if ( get_query_var( 'wp_zuyou_news' ) ) {
        $t = locate_template( 'page-news.php' );
        return $t ? $t : $template;
    }
    return $template;
} );

// リライトルール初回自動フラッシュ
add_action( 'init', function () {
    if ( ! get_option( 'wp_zuyou_rewrite_v1' ) ) {
        flush_rewrite_rules();
        update_option( 'wp_zuyou_rewrite_v1', true );
    }
}, 99 );

function wp_zuyou_scripts() {
    wp_enqueue_style( 'wp_zuyou-fonts', 'https://fonts.googleapis.com/css2?family=Outfit:wght@500&family=Zen+Kaku+Gothic+New:wght@400;500;700&family=Noto+Sans+JP:wght@400;500;700&family=Noto+Serif+JP:wght@400;600&display=swap', array(), null );
    wp_enqueue_style( 'splide-css', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css', array(), '4.1.4' );
    
    // Correct absolute paths for CSS files
    // mock/mock/style.css に header.css の全スタイルが含まれているため header.css は不要
    wp_enqueue_style( 'wp_zuyou-custom-style', get_template_directory_uri() . '/mock/mock/style.css', array(), filemtime( get_template_directory() . '/mock/mock/style.css' ) );
    wp_enqueue_style( 'wp_zuyou-style', get_stylesheet_uri(), array('wp_zuyou-custom-style'), filemtime( get_stylesheet_directory() . '/style.css' ) );
    
    wp_enqueue_script( 'splide-js', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js', array(), '4.1.4', true );
    wp_enqueue_script( 'wp_zuyou-script', get_template_directory_uri() . '/mock/mock/script.js', array('splide-js'), '1.0', true );
    // _includes.js は WordPress では不要（get_header()/get_footer() が代替するため除外）
}
add_action( 'wp_enqueue_scripts', 'wp_zuyou_scripts' );

// スクロール復元を最優先で無効化（リロード時のスクロール位置ずれ防止）
add_action( 'wp_head', function () {
    echo '<script>if("scrollRestoration" in history){history.scrollRestoration="manual";}document.documentElement.style.scrollBehavior="auto";window.scrollTo(0,0);document.documentElement.style.scrollBehavior="";</script>';
}, 1 );

// クラシックテーマではブロックエディタ関連のCSSは不要なため除去
function wp_zuyou_dequeue_block_styles() {
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'global-styles' );
    wp_dequeue_style( 'classic-theme-styles' );
    wp_dequeue_style( 'sbi-styles' );
    wp_deregister_style( 'sbi-styles' );
}
add_action( 'wp_enqueue_scripts', 'wp_zuyou_dequeue_block_styles', 100 );

// sbi-styles を確実に除去（プラグインが遅い優先度で登録する場合に対応）
add_action( 'wp_print_styles', function () {
    wp_dequeue_style( 'sbi-styles' );
    wp_deregister_style( 'sbi-styles' );
}, 100 );

// さらに強力な除去：最大優先度で複数フックをカバー
add_action( 'wp_enqueue_scripts', function () {
    wp_dequeue_style( 'sbi-styles' );
    wp_deregister_style( 'sbi-styles' );
}, 999 );
add_action( 'wp_print_styles', function () {
    wp_dequeue_style( 'sbi-styles' );
    wp_deregister_style( 'sbi-styles' );
}, 999 );

/**
 * HTMLの指定クラスを含む最初のdivの内側コンテンツをブラケット深さ計測で置換する
 */
function wp_zuyou_replace_div_inner( $html, $class_fragment, $new_inner ) {
    $pattern = '/<div\s+[^>]*class="[^"]*' . preg_quote( $class_fragment, '/' ) . '[^"]*"[^>]*>/';
    if ( ! preg_match( $pattern, $html, $match, PREG_OFFSET_CAPTURE ) ) {
        return $html;
    }
    $tag_end   = $match[0][1] + strlen( $match[0][0] );
    $depth     = 1;
    $pos       = $tag_end;
    $len       = strlen( $html );
    $close_pos = false;

    while ( $depth > 0 && $pos < $len ) {
        $next_open  = strpos( $html, '<div', $pos );
        $next_close = strpos( $html, '</div>', $pos );
        if ( $next_close === false ) break;
        if ( $next_open !== false && $next_open < $next_close ) {
            $depth++;
            $pos = $next_open + 4;
        } else {
            $depth--;
            if ( $depth === 0 ) $close_pos = $next_close;
            $pos = $next_close + 6;
        }
    }

    if ( $close_pos === false ) return $html;

    return substr( $html, 0, $tag_end )
         . "\n" . $new_inner . "\n"
         . substr( $html, $close_pos );
}

/**
 * WP投稿からニュースアイテムHTMLを生成（アコーディオン形式）
 *
 * @param array $query_args WP_Query引数（posts_per_page, paged, category_name 等）
 * @return array { 'items_html' => string, 'max_pages' => int }
 */
function wp_zuyou_news_query( $query_args = array() ) {
    $defaults = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 5,
        'orderby'        => 'date',
        'order'          => 'DESC',
    );
    $args  = wp_parse_args( $query_args, $defaults );
    $query = new WP_Query( $args );

    $items_html = '';
    if ( ! $query->have_posts() ) {
        $items_html = '<p style="padding:20px 0;text-align:center;">お知らせはありません。</p>';
    } else {
        while ( $query->have_posts() ) {
            $query->the_post();
            $cats         = get_the_category();
            $cat_name     = $cats ? esc_html( $cats[0]->name ) : 'お知らせ';
            $thumb_id     = get_post_thumbnail_id();
            $default_img  = get_template_directory_uri() . '/images/default.webp';
            ob_start();
            ?>
<article class="news-item js-accordion">
  <header class="news-item__header js-accordion-trigger">
    <div class="news-item__thumbnail" style="flex-shrink: 0; width: 140px; aspect-ratio: 16 / 9; margin-right: 15px; border-radius: 6px; overflow: hidden; background: #f5f5f5;">
      <?php if ( $thumb_id ) : ?>
        <?php echo get_the_post_thumbnail( null, 'medium_large', array( 'style' => 'width: 100%; height: 100%; object-fit: cover;' ) ); ?>
      <?php else : ?>
        <img src="<?php echo esc_url( $default_img ); ?>" alt="" style="width: 100%; height: 100%; object-fit: cover;">
      <?php endif; ?>
    </div>
    <div class="news-item__main">
      <div class="news-item__meta">
        <time class="news-date"><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></time>
        <span class="news-category"><?php echo $cat_name; ?></span>
      </div>
      <h3 class="news-item__title"><?php echo esc_html( get_the_title() ); ?></h3>
    </div>
    <div class="news-item__icon"></div>
  </header>
  <div class="news-item__content js-accordion-content">
    <div class="news-item__inner">
      <?php
      $excerpt = get_the_excerpt();
      if ( $excerpt ) {
          echo '<p>' . esc_html( $excerpt ) . '</p>';
      }
      ?>
      <div style="text-align: right; margin-top: 12px;">
        <a href="<?php the_permalink(); ?>" class="btn btn-primary news-item__more-btn">このお知らせを見る</a>
      </div>
    </div>
  </div>
</article>
            <?php
            $items_html .= ob_get_clean();
        }
    }
    $max_pages = $query->max_num_pages;
    wp_reset_postdata();
    return array(
        'items_html' => $items_html,
        'max_pages'  => (int) $max_pages,
    );
}

/**
 * モックHTMLファイルを読み込み、WP用に変換して出力する共通関数
 * - <head>内の<style>ブロックを抽出して出力（ripple・セクションCSSなど）
 * - <body>内コンテンツを抽出
 * - ヘッダー・フッター・プレースホルダーを除去
 * - 外部scriptタグ・_useComponentsフラグを除去
 * - SVG defs除去（header.phpで定義済み）
 * - 画像パスをWP用に修正
 * - .htmlリンクをWPルートに変換
 * - $div_replacements: クラス名フラグメント => 置換HTML の連想配列（任意）
 */
function wp_zuyou_render_mock( $filename, $div_replacements = array() ) {
    $file_path = get_template_directory() . '/mock/' . $filename;
    if ( ! file_exists( $file_path ) ) {
        echo '<p>Mock file not found: ' . esc_html( $filename ) . '</p>';
        return;
    }

    $html = file_get_contents( $file_path );

    // --- <head> 内の <style> を全て抽出 ---
    $head_styles = '';
    if ( preg_match( '/<head[^>]*>(.*?)<\/head>/is', $html, $head_matches ) ) {
        if ( preg_match_all( '/<style[^>]*>.*?<\/style>/is', $head_matches[1], $style_matches ) ) {
            $head_styles = implode( "\n", $style_matches[0] );
        }
    }

    // --- <body> 内コンテンツ抽出 ---
    if ( ! preg_match( '/<body[^>]*>(.*?)<\/body>/is', $html, $body_matches ) ) return;
    $content = $body_matches[1];

    // モックのプレースホルダーdivを除去（2種類の命名に対応）
    $content = preg_replace( '/<div\s+id="site-header"[^>]*>\s*<\/div>/is', '', $content );
    $content = preg_replace( '/<div\s+id="site-footer"[^>]*>\s*<\/div>/is', '', $content );
    $content = preg_replace( '/<div\s+id="header-placeholder"[^>]*>\s*<\/div>/is', '', $content );
    $content = preg_replace( '/<div\s+id="footer-placeholder"[^>]*>\s*<\/div>/is', '', $content );

    // 外部scriptタグを除去（src属性を持つもの）
    $content = preg_replace( '/<script\b[^>]+src=[^>]*>\s*<\/script>/is', '', $content );

    // _useComponentsフラグを除去
    $content = str_replace( '<script>window._useComponents = true;</script>', '', $content );

    // SVG defs ブロックを除去（header.phpで定義済み）
    $content = preg_replace( '/<svg\s[^>]*width="0"[^>]*height="0"[^>]*>.*?<\/svg>/is', '', $content );

    // 画像パスを修正
    $mock_uri = get_template_directory_uri() . '/mock/';
    $content = str_replace( 'src="images/', 'src="' . $mock_uri . 'images/', $content );

    // .htmlリンクをWPルートに変換
    $home = home_url( '/' );
    $content = preg_replace( '/href="([^"#][^"]*?)\.html"/', 'href="' . $home . '$1"', $content );
    $content = str_replace( 'href="' . $home . 'index"', 'href="' . $home . '"', $content );

    // divコンテンツ置換（WP投稿からの動的コンテンツ注入）
    foreach ( $div_replacements as $class_fragment => $new_inner ) {
        $content = wp_zuyou_replace_div_inner( $content, $class_fragment, $new_inner );
    }

    // 出力
    if ( $head_styles ) {
        echo $head_styles . "\n";
    }
    echo $content;
}

// ナビゲーションメニューのリンクにクラスを追加するフィルター
function add_menu_link_class( $atts, $item, $args ) {
    if ( property_exists( $args, 'theme_location' ) ) {
        if ( 'main-menu' === $args->theme_location ) {
            $atts['class'] = 'l-nav-list__item-link u-link-text';
        }
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_menu_link_class', 10, 3 );

// ナビゲーションメニューのテキストをスパンで囲むフィルター
function wrap_menu_text( $title, $item, $args, $depth ) {
    if ( property_exists( $args, 'theme_location' ) ) {
        if ( 'main-menu' === $args->theme_location ) {
            return '<span class="l-nav-list__item-txt">' . $title . '</span>';
        }
    }
    return $title;
}
add_filter( 'nav_menu_item_title', 'wrap_menu_text', 10, 4 );

/**
 * サブページ共通: ページヒーローのパーティクル(浮かぶプラス)canvasスクリプトを出力する
 * 各サブページテンプレートで add_action('wp_footer', 'wp_zuyou_print_particle_canvas', 20) を呼ぶ
 */
function wp_zuyou_print_particle_canvas() {
    ?>
<script>
(function () {
  const canvas = document.getElementById('js-hero-canvas');
  if (!canvas) return;
  const ctx = canvas.getContext('2d');
  function resize() {
    canvas.width  = canvas.parentElement.offsetWidth;
    canvas.height = canvas.parentElement.offsetHeight;
  }
  resize();
  window.addEventListener('resize', resize);
  const crosses = Array.from({ length: 34 }, () => ({
    x:     Math.random() * canvas.width,
    y:     Math.random() * canvas.height,
    vx:    (Math.random() - 0.5) * 0.28,
    vy:    (Math.random() - 0.5) * 0.28,
    size:  Math.random() * 14 + 5,
    alpha: Math.random() * 0.3 + 0.12,
    rot:   Math.random() * Math.PI * 2,
    vrot:  (Math.random() - 0.5) * 0.006,
  }));
  function drawCross(x, y, size, alpha, rot) {
    ctx.save();
    ctx.translate(x, y);
    ctx.rotate(rot);
    ctx.strokeStyle = `rgba(255,255,255,${alpha})`;
    ctx.lineWidth   = Math.max(size * 0.18, 1.2);
    ctx.lineCap     = 'round';
    ctx.beginPath();
    ctx.moveTo(-size / 2, 0); ctx.lineTo(size / 2, 0);
    ctx.moveTo(0, -size / 2); ctx.lineTo(0,  size / 2);
    ctx.stroke();
    ctx.restore();
  }
  function draw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    crosses.forEach(c => {
      c.x   += c.vx;  c.y   += c.vy;  c.rot += c.vrot;
      if (c.x < -20) c.x = canvas.width  + 20;
      if (c.x > canvas.width  + 20) c.x = -20;
      if (c.y < -20) c.y = canvas.height + 20;
      if (c.y > canvas.height + 20) c.y = -20;
      drawCross(c.x, c.y, c.size, c.alpha, c.rot);
    });
    requestAnimationFrame(draw);
  }
  draw();
})();
</script>
    <?php
}
?>
