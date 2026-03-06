<?php get_header(); ?>

<main>
    <section class="page-hero page-hero--particle">
      <div class="page-hero__inner">
        <div class="page-hero__container">
          <p class="page-hero__label">News</p>
          <h1 class="page-hero__title">お知らせ</h1>
        </div>
      </div>
      <canvas id="particleCanvas" class="page-hero__canvas"></canvas>
    </section>

    <div class="news-page" style="padding: 80px 0 120px; background-color: #fff;">
      <div class="news-container" style="max-width: 1000px; margin: 0 auto; padding: 0 20px;">
        <div class="news-list">
          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div class="news-item">
              <button class="news-item__header" onclick="this.parentElement.classList.toggle('is-open')">
                <div class="news-item__main">
                  <div class="news-item__meta">
                    <span class="news-date"><?php echo get_the_date('Y.m.d'); ?></span>
                    <?php
                    $categories = get_the_category();
                    if ( ! empty( $categories ) ) {
                        echo '<span class="news-category">' . esc_html( $categories[0]->name ) . '</span>';
                    }
                    ?>
                  </div>
                  <h2 class="news-item__title"><?php the_title(); ?></h2>
                </div>
                <div class="news-item__icon"></div>
              </button>
              <div class="news-item__content">
                <?php the_content(); ?>
              </div>
            </div>
          <?php endwhile; endif; ?>
        </div>
        
        <div class="news-pagination">
          <?php
          echo paginate_links( array(
            'prev_text' => '&laquo;',
            'next_text' => '&raquo;',
            'type'      => 'list',
          ) );
          ?>
        </div>
      </div>
    </div>
</main>

<style>
    .news-item__content {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.3s ease-out, padding 0.3s ease-out;
      background-color: #f9fbfd;
    }
    .news-item.is-open .news-item__content {
      max-height: 1500px;
      padding: 20px 30px 40px;
      border-bottom: 2px solid var(--mh--color--primary-100);
    }
    .news-item.is-open .news-item__icon::after {
      transform: translate(-50%, -50%) rotate(0);
    }
    .news-item__icon::after {
      transform: translate(-50%, -50%) rotate(90deg);
      transition: transform 0.3s;
    }
    .news-pagination {
      margin-top: 60px;
      display: flex;
      justify-content: center;
    }
    .news-pagination ul {
        display: flex;
        gap: 10px;
        list-style: none;
    }
    .news-pagination .page-numbers {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      border: 1px solid var(--mh--color--primary-200);
      color: var(--mh--color--primary-500);
      text-decoration: none;
      transition: all 0.3s;
      font-weight: 500;
    }
    .news-pagination .page-numbers:hover, .news-pagination .page-numbers.current {
      background-color: var(--mh--color--primary-500);
      color: #fff;
      border-color: var(--mh--color--primary-500);
    }
</style>

<?php get_footer(); ?>
