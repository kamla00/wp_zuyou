<?php
/**
 * Template Name: お知らせテンプレート
 */
add_action( 'wp_head', function () { ?>
<style>
.news-page { padding: 80px 0 120px; background-color: #fff; }
.news-container { max-width: 1400px; margin: 0 auto; padding: 0 20px; }
.news-grid { display: grid; grid-template-columns: 1fr; }
@media (min-width: 640px) { .news-grid { grid-template-columns: repeat(2, 1fr); column-gap: 60px; } }
@media (min-width: 960px) { .news-grid { grid-template-columns: repeat(3, 1fr); column-gap: 80px; } }
.news-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px; }
.news-card { display: flex; flex-direction: column; align-items: stretch; gap: 0; padding: 0; background: #fff; border-radius: 12px; box-shadow: 0 4px 15px rgba(60,105,156,0.06); border: 1px solid var(--mh--color--primary-100); margin-bottom: 0; width: 100%; text-decoration: none; color: inherit; transition: transform 0.25s, box-shadow 0.25s; overflow: hidden; height: 100%; position: relative; }
.news-card:hover { transform: translateY(-5px); box-shadow: 0 8px 25px rgba(60,105,156,0.12); opacity: 1; }
.news-card__thumbnail { width: 100%; aspect-ratio: 16 / 9; overflow: hidden; background: #f5f5f5; flex-shrink: 0; }
.news-card__thumbnail img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
.news-card:hover .news-card__thumbnail img { transform: scale(1.05); }
.news-card__body { padding: 20px; display: flex; flex-direction: column; flex: 1; min-width: 0; }
.news-card__meta { display: flex; align-items: center; gap: 8px; margin-bottom: 12px; }
.news-date { font-size: 1.3rem; color: var(--mh--color--primary-400); font-weight: 500; }
.news-category { font-size: 1.1rem; padding: 2px 10px; border-radius: 4px; background: var(--mh--color--primary-100); color: var(--mh--color--primary-500); font-weight: 700; display: inline-block; }
.news-card__title { font-size: 1.6rem; font-weight: 700; color: var(--mh--color--primary-800); line-height: 1.6; margin: 0; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }

@media (max-width: 1023px) {
  .news-grid { grid-template-columns: repeat(2, 1fr); gap: 24px; border-top: 1px solid var(--mh--color--primary-100); }
  .news-card {
    flex-direction: row !important;
    align-items: flex-start !important;
    height: auto !important;
    border: none !important;
    border-radius: 0 !important;
    box-shadow: none !important;
    border-bottom: 1px solid var(--mh--color--primary-100) !important;
    padding: 16px 0 !important;
    transition: none !important;
  }
  .news-card:hover { transform: none !important; background: rgba(60,105,156,0.02); }
  .news-card__thumbnail {
    flex: 0 0 120px !important;
    width: 120px !important;
    aspect-ratio: 16 / 9 !important;
    height: auto !important;
    border-radius: 4px;
  }
  .news-card__body { padding: 0 0 0 16px !important; }
  .news-card__meta { margin-bottom: 8px !important; gap: 10px !important; }
  .news-date { font-size: 1.2rem !important; color: var(--mh--color--primary-400) !important; font-weight: 700 !important; }
  .news-category { font-size: 1.0rem !important; padding: 2px 8px !important; background: var(--mh--color--primary-100) !important; color: var(--mh--color--primary-500) !important; border-radius: 4px !important; font-weight: 700 !important; display: inline-block !important; }
  .news-card__title { font-size: 1.4rem !important; line-height: 1.5 !important; -webkit-line-clamp: 2 !important; color: var(--mh--color--primary-900) !important; }
}
@media (max-width: 767px) {
  .news-grid { grid-template-columns: 1fr; gap: 0; }
  .news-card { padding: 12px 0 !important; }
  .news-card__thumbnail { flex: 0 0 100px !important; width: 100px !important; }
  .news-card__body { padding: 0 0 0 12px !important; }
  .news-date { font-size: 1.1rem !important; }
  .news-category { font-size: 0.9rem !important; padding: 1px 6px !important; }
  .news-card__title { font-size: 1.35rem !important; }
}
.news-pagination { margin-top: 60px; display: flex; justify-content: center; gap: 10px; }
.pagination-item { display: flex; justify-content: center; align-items: center; width: 40px; height: 40px; border-radius: 50%; border: 1px solid var(--mh--color--primary-200); color: var(--mh--color--primary-500); text-decoration: none; transition: all 0.3s; font-weight: 500; }
.pagination-item:hover, .pagination-item.is-active { background-color: var(--mh--color--primary-500); color: #fff; border-color: var(--mh--color--primary-500); }
.contact-intro { display: flex; align-items: center; justify-content: center; gap: 30px; margin-bottom: 50px; flex-wrap: wrap; }
.contact-balloon { position: relative; background: #fff; border: 2px solid var(--mh--color--primary-200); border-radius: 15px; padding: 20px 25px; max-width: 450px; box-shadow: 0 4px 12px rgba(60,105,156,0.08); }
.contact-balloon::after { content: ""; position: absolute; top: 50%; right: -10px; margin-top: -10px; border-style: solid; border-width: 10px 0 10px 10px; border-color: transparent transparent transparent #fff; z-index: 2; }
.contact-balloon::before { content: ""; position: absolute; top: 50%; right: -12px; margin-top: -11px; border-style: solid; border-width: 11px 0 11px 11px; border-color: transparent transparent transparent #c6e0ec; z-index: 1; }
.contact-balloon__text { font-size: 1.5rem; line-height: 1.6; color: var(--mh--color--primary-800); font-weight: 500; margin: 0; }
.contact-intro__img { max-width: 150px; width: 100%; height: auto; }
.news-filter-row { display: flex; align-items: center; justify-content: space-between; gap: 20px; margin-bottom: 40px; flex-wrap: wrap; }
.news-filter { display: flex; flex-wrap: wrap; gap: 10px; }
.news-filter__btn { padding: 8px 22px; border-radius: 20px; border: 1px solid var(--mh--color--primary-200); color: var(--mh--color--primary-500); text-decoration: none; font-size: 1.5rem; font-weight: 500; transition: background 0.25s, color 0.25s, border-color 0.25s; white-space: nowrap; }
.news-filter__btn:hover, .news-filter__btn.is-active { background: var(--mh--color--primary-500); color: #fff; border-color: var(--mh--color--primary-500); }
.news-search { display: flex; align-items: center; border: 1px solid var(--mh--color--primary-200); border-radius: 20px; overflow: hidden; background: #fff; }
.news-search__input { border: none; outline: none; padding: 8px 16px; font-size: 1.5rem; color: var(--mh--color--primary-800); width: 200px; background: transparent; }
.news-search__btn { border: none; background: none; cursor: pointer; padding: 8px 14px; color: var(--mh--color--primary-400); display: flex; align-items: center; transition: color 0.2s; }
.news-search__btn:hover { color: var(--mh--color--primary-600); }
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
@media (max-width: 767px) { .news-filter-row { flex-direction: column; align-items: flex-start; } .news-search { width: 100%; } .news-search__input { flex: 1; } }
@media (max-width: 767px) {
  .contact-intro { flex-direction: column-reverse; }
  .contact-balloon::after { top: -10px; right: 50%; margin-right: -10px; margin-top: 0; border-width: 0 10px 12px 10px; border-color: transparent transparent #fff transparent; }
  .contact-balloon::before { top: -13px; right: 50%; margin-right: -11px; margin-top: 0; border-width: 0 11px 13px 11px; border-color: transparent transparent var(--mh--color--primary-200) transparent; }
}
</style>
<?php }, 20 );
add_action( 'wp_footer', 'wp_zuyou_print_particle_canvas', 20 );

// カテゴリー絞込パラメータ
$cat_slug = isset( $_GET['cat'] ) ? sanitize_title( wp_unslash( $_GET['cat'] ) ) : '';

// ページ番号取得（リライトルール経由ではpaged変数を使用）
$paged      = max( 1, (int) get_query_var( 'paged' ) );
$query_args = array( 'posts_per_page' => 12, 'paged' => $paged );
if ( $cat_slug ) {
    $query_args['category_name'] = $cat_slug;
}
$news_query = new WP_Query( $query_args );
$max_pages  = (int) $news_query->max_num_pages;

// カテゴリー一覧（投稿があるもののみ）
$categories = get_categories( array( 'hide_empty' => true, 'orderby' => 'name', 'order' => 'ASC' ) );

// ページネーションHTML生成（カテゴリーパラメータを維持）
$pagination_html = '';
if ( $max_pages > 1 ) {
    $base      = trailingslashit( home_url( '/news' ) );
    $cat_param = $cat_slug ? '?cat=' . urlencode( $cat_slug ) : '';
    for ( $i = 1; $i <= $max_pages; $i++ ) {
        $url = ( $i === 1 ) ? $base . $cat_param : $base . 'page/' . $i . '/' . $cat_param;
        if ( $i === $paged ) {
            $pagination_html .= '<span class="pagination-item is-active">' . $i . '</span>' . "\n";
        } else {
            $pagination_html .= '<a href="' . esc_url( $url ) . '" class="pagination-item">' . $i . '</a>' . "\n";
        }
    }
}

$_t = get_template_directory_uri();
get_header(); ?>
<main>

  <section class="page-hero page-hero--particle">
    <canvas class="page-hero__canvas" id="js-hero-canvas"></canvas>
    <div class="page-hero__inner">
      <div class="container">
        <p class="page-hero__label">News</p>
        <div class="page-hero__container">
          <h1 class="page-hero__title">お知らせ一覧</h1>
          <p class="page-hero__sub">これまでのお知らせをカテゴリーやキーワードから一覧で確認できます。</p>
        </div>
      </div>
    </div>
  </section>

  <section class="news-page">
    <div class="news-container">
      <div class="contact-intro">
        <div class="contact-balloon">
          <p class="contact-balloon__text">各部署ごとの最新のお知らせを確認しましょう。</p>
        </div>
        <img src="<?php echo $_t; ?>/images/fm4-no-bg.png" alt="" class="contact-intro__img">
      </div>
      <div class="news-filter-row">
        <div class="news-filter">
          <a href="<?php echo esc_url( home_url( '/news/' ) ); ?>" class="news-filter__btn<?php echo $cat_slug === '' ? ' is-active' : ''; ?>">すべて</a>
          <?php foreach ( $categories as $cat ) : ?>
          <a href="<?php echo esc_url( add_query_arg( 'cat', $cat->slug, home_url( '/news/' ) ) ); ?>" class="news-filter__btn<?php echo $cat_slug === $cat->slug ? ' is-active' : ''; ?>"><?php echo esc_html( $cat->name ); ?></a>
          <?php endforeach; ?>
        </div>
        <form class="news-search" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" role="search">
          <input class="news-search__input" type="search" name="s" placeholder="キーワードで検索" value="<?php echo esc_attr( get_search_query() ); ?>">
          <button class="news-search__btn" type="submit" aria-label="検索">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          </button>
        </form>
      </div>
      <div class="news-grid">
        <?php if ( $news_query->have_posts() ) : while ( $news_query->have_posts() ) : $news_query->the_post();
        $cats     = get_the_category();
        $cat_name = $cats ? esc_html( $cats[0]->name ) : 'お知らせ';
        ?>
        <a href="<?php the_permalink(); ?>" class="news-card">
          <div class="news-card__thumbnail">
            <?php if ( has_post_thumbnail() ) : ?>
              <?php the_post_thumbnail( 'medium_large' ); ?>
            <?php else : ?>
              <img src="<?php echo get_template_directory_uri(); ?>/images/default.webp" alt="">
            <?php endif; ?>
          </div>
          <div class="news-card__body">
            <div class="news-card__meta">
              <time class="news-date"><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></time>
              <span class="news-category"><?php echo $cat_name; ?></span>
            </div>
            <h3 class="news-card__title"><?php echo esc_html( get_the_title() ); ?></h3>
          </div>
        </a>
        <?php endwhile; wp_reset_postdata(); else : ?>
        <p style="text-align:center; padding: 40px 0; grid-column: 1/-1;">お知らせはありません。</p>
        <?php endif; ?>
      </div>
      <?php if ( $pagination_html ) : ?>
      <div class="news-pagination">
        <?php echo $pagination_html; ?>
      </div>
      <?php endif; ?>
    </div>
  </section>

</main>
<?php get_footer(); ?>
