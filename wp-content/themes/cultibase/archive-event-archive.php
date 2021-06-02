<?php
/* Template Name: イベントアーカイブ */  
get_template_part("/parts/parts_head"); ?>
<body>
    <?php get_template_part("/parts/parts_gtm_body_under"); ?> 
    <div class="l-app">
      <main>
        <div class="l-contents js-pjax-contents" data-scroll-section>
          <div class="l-content js-pjax-content" id="event-archive">
            <?php get_header(); ?>
            <div class="l-content__in is-dark">
              <section class="s-eventIntro">
                <div class="c-inner">
                  <h2 class="c-page-title-en-jp--center"><span class="en">Event Archive</span><span class="ja">イベントアーカイブ</span></h2>
                </div>
              </section>
              <section class="s-events">
                <div class="c-inner">
                  <ul class="event__list">
                  <?php
                      $today = date("Y/m/d");
                      $query = new WP_Query(array(
                        'post_type' => ['live-event', 'watch-party'],
                        'posts_per_page' => '16',
                        'has_password' => false,
                        'paged' => get_query_var('paged'),
                        'meta_query' => array(array(
                          'key' => 'date',
                          'value' => $today,
                          'compare' => '<',
                          'type' => 'DATE'
                        ))
                      ));
                      while($query -> have_posts()): $query -> the_post();
                      $id = get_the_id();
                      // $postTitle = get_the_title();
                      // $date = get_the_date('Y.m.d');
                      // $date = get_field('date');
                      $eventDate = date_create(get_field('date'));
                      $startTime = get_field('start_time');
                      $endTime = get_field('end_time');

                      $postThumbnail = get_the_post_thumbnail_url($id, 'large');

                      $postTitle = get_the_title();
                      $isDot = mb_strlen($postTitle) > 45;
                      $postTitle = mb_substr($postTitle, 0, 45);
                      if($isDot) {
                        $postTitle = $postTitle. "...";
                      }
                      // print_r($newsCategory);
                    ?>
                    <li class="event__item"><a class="itemLink" href="<?php echo the_permalink(); ?>">
                        <div class="itemThumb"><img src="<?php echo $postThumbnail; ?>"/></div>
                        <div class="itemBody">
                          <h2 class="ttl"><?php echo $postTitle; ?></h2>
                          <p class="datetimeArea">日時：<span class="date"><?php echo date_format($eventDate,'Y.m.d'); ?></span><span class="time"><?php echo $startTime; ?> - <?php echo $endTime; ?></span></p>
                        </div></a></li>
                    <?php endwhile; ?>
                  </ul>
                  <?php pagination($query->max_num_pages, get_query_var( 'paged' )); ?>
                  <?php wp_reset_postdata(); ?>
                </div>
              </section>
            </div>
            <?php get_template_part("/parts/parts_find_lab_theme"); ?>
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