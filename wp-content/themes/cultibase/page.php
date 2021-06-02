<?php get_template_part("/parts/parts_head"); ?>
<body>
  <?php get_template_part("/parts/parts_gtm_body_under"); ?>
  <div class="l-page">
    <?php get_header(); ?>
    <main class="l-contents">
      <?php $slug_name = $post->post_name; ?>
      <h2><?php echo $slug_name; ?></h2>
      <?php while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; ?>
    </main>
    <?php get_footer(); ?>
  </div>
  <?php get_template_part("/parts/parts_scripts"); ?>
</body>
</html>
