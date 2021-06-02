<?php
/* Template Name: セット一覧 */  
get_template_part("/parts/parts_head"); ?>
<body>
    <?php get_template_part("/parts/parts_gtm_body_under"); ?> 
    <div class="l-app">
      <main>
        <div class="l-contents js-pjax-contents" data-scroll-section>
          <div class="l-content js-pjax-content" id="set-list">
            <?php get_header(); ?>
            <div class="l-content__in background-grid">
              <div class="c-inner">
                <section class="s-set-list">
                  <h1 class="ttl">コンテンツパッケージ</h1>
                  <p class="desc">CULTIBASE編集部がテーマごとに動画・記事・音声コンテンツを厳選してまとめました。</p>
                  <ul class="set-list">
                  <?php
                            $query = new WP_Query(array(
                              'post_type' => ['set-list'],
                              'posts_per_page' => '100',
                              'has_password' => false,
                              'paged' => get_query_var('paged'),
                              // 'category_name' => get_query_var('category_name')
                            ));
                            while($query -> have_posts()): $query -> the_post();
                            $postThumbnail = get_the_post_thumbnail_url(null, 'medium_large');
                            
                            $postTitle = get_the_title();
                            $description = get_field('description');
                            $isDot = mb_strlen($description) > 90;
                            $description = mb_substr($description, 0, 90);
                            if($isDot) {
                              $description = $description. "...";
                            }

                    ?>
                    <li class="set-item"><a class="wrap" href="<?php the_permalink(); ?>"><img class="thumb" src="<?php echo $postThumbnail;?>"/>
                        <div class="content">
                          <h3 class="title c-label-lab"><?php echo $postTitle; ?></h3>
                          <div class="desc"><?php echo $description; ?></div>
                        </div></a></li>
                    <?php
                      endwhile;
                    ?>
                  </ul>
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