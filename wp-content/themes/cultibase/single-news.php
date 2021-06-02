<?php
  // $loginFlg = getSessionLoginFlg();
?>
<?php get_template_part("/parts/parts_head"); ?>
<body>
  <?php get_template_part("/parts/parts_gtm_body_under"); ?>
  <div class="l-app">
    <main>
      <div class="l-contents js-pjax-contents" data-scroll-section>
        <div class="l-content js-pjax-content" id="news-detail">
          <?php get_header(); ?>
          <div class="l-content__in">
            <div class="c-inner--s">
              <?php while ( have_posts() ) : the_post();
                  $title = get_the_title();
                  $date = get_the_date('Y.m.d');
                  $newsCategory = get_field('news_category');

              ?>
                <section class="s-news">
                  <div class="news_header">
                    <p class="tag <?php echo $newsCategory['value']; ?>"><?php echo $newsCategory['label']; ?></p>
                    <h2 class="ttl"><?php echo $title; ?></h2>
                    <p class="datetime"><?php echo $date; ?></p>
                  </div>
                  <div class="news_body">
                    <?php the_content(); ?>
                  </div>
                </section>
                <?php endwhile; ?>
              </div>
            </div>
          <?php get_footer(); ?>
        </div>
      </div>
    </main>
    <div class="js-pjax-sub-content1">
    </div>
  </div>
  <?php get_template_part("/parts/parts_scripts"); ?>
</body>
</html>
