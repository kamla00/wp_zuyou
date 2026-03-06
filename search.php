<?php
add_action( 'wp_head', function () { ?>
<style>
.news-page { padding: 80px 0 120px; background-color: #fff; }
.news-container { max-width: 1400px; margin: 0 auto; padding: 0 20px; }
.news-grid { display: grid; grid-template-columns: 1fr; }
@media (min-width: 640px) { .news-grid { grid-template-columns: repeat(2, 1fr); column-gap: 60px; } }
@media (min-width: 960px) { .news-grid { grid-template-columns: repeat(3, 1fr); column-gap: 80px; } }
@media (min-width: 1200px) { .news-grid { grid-template-columns: repeat(4, 1fr); column-gap: 80px; } }
.news-card { display: flex; align-items: flex-start; gap: 20px; padding: 28px 0; background: transparent; border-radius: 0; box-shadow: none; border-top: 1px solid var(--mh--color--primary-100); border-bottom: 1px solid var(--mh--color--primary-100); margin-bottom: -1px; width: 100%; text-decoration: none; color: inherit; transition: background 0.2s; }
.news-card:hover { background: var(--mh--color--primary-50); }
.news-card:hover .news-card__dot { background: var(--mh--color--primary-600); transform: scale(1.4); }
.news-card:hover .news-card__title { color: var(--mh--color--primary-500); text-decoration: underline; text-underline-offset: 3px; }
.news-card__dot { transition: background 0.2s, transform 0.2s; }
.news-card__title { transition: color 0.2s; }
.news-card__dot { flex-shrink: 0; width: 14px; height: 14px; background: var(--mh--color--primary-400); border-radius: 50%; margin-top: 10px; }
.news-card__body { flex: 1; min-width: 0; }
.news-card__meta { display: flex; align-items: center; gap: 8px; margin-bottom: 8px; flex-wrap: wrap; }
.news-card__title { font-size: 1.6rem; font-weight: 700; color: var(--mh--color--primary-800); line-height: 1.5; margin: 0; }
.search-header { margin-bottom: 40px; }
.search-header { display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap; margin-bottom: 30px; }
.search-header__left { flex: 1; }
.search-header__query { font-size: 2rem; font-weight: 700; color: var(--mh--color--primary-800); }
.search-header__query span { color: var(--mh--color--primary-500); }
.search-header__count { font-size: 1.5rem; color: var(--mh--color--grayscale-600); margin-top: 6px; }
.news-filter { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 40px; }
.news-filter__btn { padding: 8px 22px; border-radius: 20px; border: 1px solid var(--mh--color--primary-200); color: var(--mh--color--primary-500); text-decoration: none; font-size: 1.5rem; font-weight: 500; transition: background 0.25s, color 0.25s, border-color 0.25s; white-space: nowrap; }
.news-filter__btn:hover, .news-filter__btn.is-active { background: var(--mh--color--primary-500); color: #fff; border-color: var(--mh--color--primary-500); }
.news-search-bar { display: flex; align-items: center; border: 1px solid var(--mh--color--primary-200); border-radius: 20px; overflow: hidden; background: #fff; max-width: 400px; margin-bottom: 40px; }
.news-search-bar__input { border: none; outline: none; padding: 10px 18px; font-size: 1.5rem; color: var(--mh--color--primary-800); flex: 1; background: transparent; }
.news-search-bar__btn { border: none; background: none; cursor: pointer; padding: 10px 16px; color: var(--mh--color--primary-400); display: flex; align-items: center; transition: color 0.2s; }
.news-search-bar__btn:hover { color: var(--mh--color--primary-600); }
.news-pagination { margin-top: 60px; display: flex; justify-content: center; gap: 10px; }
.pagination-item { display: flex; justify-content: center; align-items: center; width: 40px; height: 40px; border-radius: 50%; border: 1px solid var(--mh--color--primary-200); color: var(--mh--color--primary-500); text-decoration: none; transition: all 0.3s; font-weight: 500; }
.pagination-item:hover, .pagination-item.is-active { background-color: var(--mh--color--primary-500); color: #fff; border-color: var(--mh--color--primary-500); }
</style>
<?php }, 20 );
add_action( 'wp_footer', 'wp_zuyou_print_particle_canvas', 20 );

$search_query = get_search_query();
$paged        = max( 1, (int) get_query_var( 'paged' ) );
$search_wp    = new WP_Query( array(
    's'              => $search_query,
    'posts_per_page' => 12,
    'paged'          => $paged,
) );
$max_pages  = (int) $search_wp->max_num_pages;
$categories = get_categories( array( 'hide_empty' => true, 'orderby' => 'name', 'order' => 'ASC' ) );

// ページネーション
$pagination_html = '';
if ( $max_pages > 1 ) {
    for ( $i = 1; $i <= $max_pages; $i++ ) {
        $url = add_query_arg( array( 's' => $search_query, 'paged' => $i ), home_url( '/' ) );
        if ( $i === $paged ) {
            $pagination_html .= '<span class="pagination-item is-active">' . $i . '</span>' . "\n";
        } else {
            $pagination_html .= '<a href="' . esc_url( $url ) . '" class="pagination-item">' . $i . '</a>' . "\n";
        }
    }
}

get_header(); ?>
<main>

  <section class="page-hero page-hero--particle">
    <canvas class="page-hero__canvas" id="js-hero-canvas"></canvas>
    <div class="page-hero__inner">
      <div class="container">
        <p class="page-hero__label">Search</p>
        <div class="page-hero__container">
          <h1 class="page-hero__title">検索結果</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="news-page">
    <div class="news-container">

      <div class="search-header">
        <div class="search-header__left">
          <p class="search-header__query">「<span><?php echo esc_html( $search_query ); ?></span>」の検索結果</p>
          <p class="search-header__count"><?php echo $search_wp->found_posts; ?> 件見つかりました</p>
        </div>
      </div>

      <div class="news-filter">
        <a href="<?php echo esc_url( home_url( '/news/' ) ); ?>" class="news-filter__btn">すべて</a>
        <?php foreach ( $categories as $cat ) : ?>
        <a href="<?php echo esc_url( add_query_arg( 'cat', $cat->slug, home_url( '/news/' ) ) ); ?>" class="news-filter__btn"><?php echo esc_html( $cat->name ); ?></a>
        <?php endforeach; ?>
      </div>

      <form class="news-search-bar" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" role="search">
        <input class="news-search-bar__input" type="search" name="s" placeholder="キーワードで再検索" value="<?php echo esc_attr( $search_query ); ?>">
        <button class="news-search-bar__btn" type="submit" aria-label="検索">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        </button>
      </form>

      <div class="news-grid">
        <?php if ( $search_wp->have_posts() ) : while ( $search_wp->have_posts() ) : $search_wp->the_post();
          $cats     = get_the_category();
          $cat_name = $cats ? esc_html( $cats[0]->name ) : '';
        ?>
        <a href="<?php the_permalink(); ?>" class="news-card">
          <span class="news-card__dot"></span>
          <div class="news-card__body">
            <div class="news-card__meta">
              <time class="news-date"><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></time>
              <?php if ( $cat_name ) : ?>
              <span class="news-category"><?php echo $cat_name; ?></span>
              <?php endif; ?>
            </div>
            <h3 class="news-card__title"><?php echo esc_html( get_the_title() ); ?></h3>
          </div>
        </a>
        <?php endwhile; wp_reset_postdata(); else : ?>
        <p style="text-align:center; padding: 60px 0; grid-column: 1/-1; font-size: 1.6rem; color: var(--mh--color--grayscale-600);">
          該当する記事が見つかりませんでした。
        </p>
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
