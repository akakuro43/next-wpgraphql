<?php get_template_part("/parts/parts_head"); ?>
<body>
  <?php get_template_part("/parts/parts_gtm_body_under"); ?>
  <div class="l-page">
    <?php get_header(); ?>
    <main class="l-contents">
      <?php $slug_name = $post->post_name; ?>
      <h2>archive</h2>

      <?php
      /* （ステップ1）データの取得 WP_Queryを使用した場合サンプル */
      $query = new WP_Query(
      array(
         'posts_per_page' => 3, // Post数
      )
      );
      ?>

      <?php
      /* （ステップ2）データの表示 */
      if ( $query->have_posts() ) : ?>
        <?php while ( $query->have_posts() ) : $query->the_post();?>
          <?php the_content(); ?>
        <?php endwhile; ?>
      <?php endif; ?>
    </main>
    <?php get_footer(); ?>

  </div>
  <?php get_template_part("/parts/parts_scripts"); ?>
</body>
</html>
