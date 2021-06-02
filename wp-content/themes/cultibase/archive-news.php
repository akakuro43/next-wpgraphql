<?php
/* Template Name: お知らせ */  
get_template_part("/parts/parts_head"); ?>
<body>
    <?php get_template_part("/parts/parts_gtm_body_under"); ?> 
    <div class="l-app">
      <main>
        <div class="l-contents js-pjax-contents" data-scroll-section>
          <div class="l-content js-pjax-content" id="news">
            <?php get_header(); ?>
            <div class="l-content__in">
              <div class="c-inner">
                <section class="page-news__wrap">
                  <h2 class="page-news__title">CULTIBASEからのお知らせ</h2>
                  <ul>
                    <?php
                      $query = new WP_Query(array(
                        'post_type' => ['news'],
                        'posts_per_page' => '24',
                        'has_password' => false,
                        'paged' => get_query_var('paged'),
                      ));
                      while($query -> have_posts()): $query -> the_post();

                      $postTitle = get_the_title();
                      $date = get_the_date('Y.m.d');
                      $newsCategory = get_field('news_category');
                      // print_r($newsCategory);
                    ?>
                    <li class="page-news__item">
                      <a class="page-news__link" href="<?php the_permalink(); ?>">
                        <span class="page-news__item-tag <?php echo $newsCategory['value']; ?>"><?php echo $newsCategory['label']; ?></span>
                        <span class="page-news__item-datetime"><?php echo $date; ?></span>
                        <span class="page-news__content"><?php echo $postTitle; ?></span>
                      </a>
                    </li>
                    <?php endwhile; ?>
                  </ul>
                </section>
                <section class="page-news__pagination">
                  <?php pagination($query->max_num_pages, get_query_var( 'paged' )); ?>
                    <?php wp_reset_postdata(); ?>
                </section>
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