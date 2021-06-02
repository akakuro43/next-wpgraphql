<?php
/* Template Name: 特集一覧 */  
get_template_part("/parts/parts_head"); ?>
<body>
    <?php get_template_part("/parts/parts_gtm_body_under"); ?>
    <div class="l-app">
      <main>
        <div class="l-contents js-pjax-contents" data-scroll-section>
          <div class="l-content js-pjax-content" id="feature-list">
            <?php get_header(); ?>
            <div class="l-content__in">
              <section class="s-featureList">
                <h2 class="featureList__ttl"><span class="en">Feature</span><span class="ja">特集</span></h2>
                <div class="c-inner--s">
                  <ul class="featureArticle__list">
                  <?php
                    $query = new WP_Query(array(
                      'post_type' => 'features',
                      'posts_per_page' => '12',
                      'paged' => get_query_var('paged'),
                    ));
                    while($query -> have_posts()): $query -> the_post();
                    $thumbForList = get_field('thumb_for_list');
                    $updateDate = get_the_modified_date("Y.m.d");

                    ?>
                    <li class="featureArticle__item">
                      <div class="itemThumb">
                        <img src="<?php echo $thumbForList; ?>" alt="<?php the_title(); ?>"/>
                      </div>
                      <div class="itemBody">
                        <h2 class="ttl"><?php the_title(); ?></h2>
                        <p class="update">UPDATE :<span class="dateTxt"><?php echo $updateDate; ?></span></p>
                      </div><a class="itemLink" href="<?php the_permalink(); ?>"></a>
                    </li>
                    <?php
                      endwhile;
                    ?>
                </ul>
                  <!-- <div class="c-pager"><span class="page-numbers current" aria-current="page">1</span><a class="page-numbers" href="#">2</a><a class="page-numbers" href="#">3</a><a class="next page-numbers" href="#"></a></div> -->
                  <?php pagination($wp_query->max_num_pages, get_query_var( 'paged' )); ?>
                  <?php wp_reset_postdata(); ?>
                </div>
              </section>
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