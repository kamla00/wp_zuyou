<?php
add_action( 'wp_footer', 'wp_zuyou_print_particle_canvas', 20 );
get_header(); ?>

<main>
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <section class="page-hero page-hero--particle">
      <canvas class="page-hero__canvas" id="js-hero-canvas"></canvas>
      <div class="page-hero__inner">
        <div class="container">
          <p class="page-hero__label">News</p>
          <div class="page-hero__container">
            <h1 class="page-hero__title"><?php the_title(); ?></h1>
          </div>
        </div>
      </div>
    </section>

    <div class="page-content" style="padding: 80px 0 120px; background-color: #fff;">
      <div class="u-container" style="max-width: 1000px; margin: 0 auto; padding: 0 20px;">
        <div class="news-item__meta" style="display: flex; align-items: center; gap: 12px; margin-bottom: 32px; padding-bottom: 24px; border-bottom: 1px solid var(--mh--color--primary-100);">
          <time class="news-date" style="font-size: 1.8rem;"><?php echo esc_html( get_the_date('Y.m.d') ); ?></time>
          <?php
          $categories = get_the_category();
          if ( $categories ) :
            foreach ( $categories as $cat ) :
              $cat_url = add_query_arg( 'cat', $cat->slug, get_page_link( get_page_by_path('news') ) );
          ?>
            <a href="<?php echo esc_url( $cat_url ); ?>" class="news-category" style="font-size: 1.4rem; padding: 4px 14px; text-decoration: none;"><?php echo esc_html( $cat->name ); ?></a>
          <?php endforeach; endif; ?>
        </div>
        <div class="entry-content" style="font-size: 1.7rem; line-height: 1.9; color: var(--mh--color--grayscale-900);">
            <?php the_content(); ?>
        </div>
        <div style="margin-top: 60px; text-align: center;">
            <a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>" class="btn btn-outline">お知らせ一覧へ戻る</a>
        </div>
      </div>
    </div>
  <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
