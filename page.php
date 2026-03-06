<?php get_header(); ?>

<main>
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <section class="page-hero page-hero--particle">
      <div class="page-hero__inner">
        <div class="page-hero__container">
          <p class="page-hero__label"><?php echo strtoupper( get_post_field( 'post_name', get_post() ) ); ?></p>
          <h1 class="page-hero__title"><?php the_title(); ?></h1>
        </div>
      </div>
      <canvas id="particleCanvas" class="page-hero__canvas"></canvas>
    </section>

    <div class="page-content">
      <div class="u-container">
        <?php the_content(); ?>
      </div>
    </div>
  <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
