<?php
/* Template Name: ラジオ一覧 */  
get_template_part("/parts/parts_head"); ?>
<body>
    <?php get_template_part("/parts/parts_gtm_body_under"); ?> 
    <div class="l-app">
      <main>
        <div class="l-contents js-pjax-contents" data-scroll-section>
          <div class="l-content js-pjax-content" id="radio-list">
            <?php get_header(); ?>
            <div class="l-content__in is-dark">
              <section class="s-radio">
                <div class="c-inner">
                  <h2 class="c-page-title-en-jp--center"><span class="en">Radio</span><span class="ja">聴く</span></h2>
                  <ul class="radioList"> 
                    <?php
                      // ラジオ種別を取得する
                      $query = new WP_Query(array(
                        'post_type' => ['radio-type'],
                        'orderby' => 'menu_order',
                        'order' => 'ASC',
                        'paged' => get_query_var('paged'),
                      ));
                      while($query -> have_posts()): $query -> the_post();
                      $ttl = get_field('title');
                      $description = get_field('description');
                      $squareThumbUrl = get_field('square_thumb');
                      
                      $Id = get_the_id();
                    // ラジオ種別のIDから最新のラジオコンテンツを取得する
                    $the_query = new WP_Query(
                      array(
                        'post_type' => ['radio'],
                        'posts_per_page' => 1,
                        'meta_query' => array(array(
                          'key' => 'radio_type',
                          'value' => $Id,
                      ))
                     )
                    );
                    if ($the_query->have_posts()) :
                      while ($the_query->have_posts()) : $the_query->the_post();
                      // $postTitle = get_the_title();
                      // echo $postTitle
                      $link = get_the_permalink();
                    ?>
                      <li class="radioItem"><a class="radioLink" href="<?php echo $link;?>">
                          <div class="radioThumb"><img src="<?php echo $squareThumbUrl;?>"></div>
                          <div class="radioBody">
                            <p class="radioTtl"><?php echo $ttl; ?></p>
                            <p class="description"><?php echo $description; ?></p>
                          </div>
                        </a></li>
                          
                    <?php 
                      endwhile;
                      endif;
                      endwhile; 
                    ?>
                  </ul>
                  <div class="radio__info">
                    <img class="radio__info-thumb" src="<?php bloginfo('template_url'); ?>/assets/images/pc/radio-list/cultibase_radio.png">
                    <div class="radio__info-wrap">
                      <h3 class="radio__info-title">CULTIBASE Radio</h3>
                      <p class="radio__info-desc">組織ファシリテーションの知を耕すウェブメディア『CULTIBASE』によるラジオです。人やチームの創造性を高める知見を音声でお届けします。</p>
                      <div class="radio__info-external-wrap">
                        <a class="btn" href="https://podcasts.apple.com/jp/podcast/cultibase-radio/id1528643484" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/pc/radio-list/apple_podcasts.png" /></a>
                        <a class="btn" href="https://open.spotify.com/show/0EVGGZqraiaYdCo6hlVBfN" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/pc/radio-list/spotify.png" /></a>
                    </div>
                  </div>
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