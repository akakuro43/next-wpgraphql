<?php
/* Template Name: ブックレビュー */  
get_template_part("/parts/parts_head"); ?>
<body>
    <?php get_template_part("/parts/parts_gtm_body_under"); ?> 
    <div class="l-app">
      <main>
        <div class="l-contents js-pjax-contents" data-scroll-section>
          <div class="l-content js-pjax-content" id="book-review">
            <?php get_header(); ?>
            <div class="l-content__in is-dark">
              <section class="s-videoIntro">
                <div class="c-inner">
                  <h2 class="c-page-title-en-jp--center"><span class="en">Book Review</span><span class="ja">講師陣による書評解説</span></h2>
                </div>
              </section>
              <section class="s-books">
                <div class="c-inner">
                  <ul class="bookList">
                    <?php
                    $args = array(
                      'post_type' => ['book-review'],
                      'posts_per_page' => 12,
                   );
                  $the_query = new WP_Query($args);
                    while ($the_query->have_posts()): $the_query->the_post();                      
                      $id = get_the_id();
                      $date = get_the_date('Y.m.d');
                      $playbackTime = get_field('playback_time');
                      $writerInfoId = get_field('writer')[0];
                      $writerInfoName = get_field('writer_name',$writerInfoId);
                      $writerInfoThumbURL = get_field('writer_thumb',$writerInfoId);
                      $postThumbnail = get_the_post_thumbnail_url($id, 'large');
                
                      $postTitle = get_the_title();
                      $isDot = mb_strlen($postTitle) > 45;
                      $postTitle = mb_substr($postTitle, 0, 45);
                      if($isDot) {
                        $postTitle = $postTitle. "...";
                      }

                      // カテゴリー配列
                      $categoryIdArry = Array(); 
                      $categories = get_the_category($id);
                      // 投稿タイプ
                      // $postType = get_post_type( $videoId );
                      // $labLabel = ($postType != 'free-video') ? 'c-label-lab' : '';

                    ?>
                    <li class="bookItem"><a href="<?php echo the_permalink(); ?>">
                        <div class="bookItem__thumb"><img src="<?php echo $postThumbnail; ?>"/>
                          <p class="time"><?php echo $playbackTime; ?></p>
                          <svg class="c-playMark" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 48 48" id="">
                            <path d="M48 24C48 37.2548 37.2548 48 24 48C10.7452 48 0 37.2548 0 24C0 10.7452 10.7452 0 24 0C37.2548 0 48 10.7452 48 24Z" fill="white"></path>
                            <path d="M31.5 21.4019C33.5 22.5566 33.5 25.4434 31.5 26.5981L22.5 31.7942C20.5 32.9489 18 31.5056 18 29.1962L18 18.8038C18 16.4944 20.5 15.0511 22.5 16.2058L31.5 21.4019Z" fill="#302D2A"></path>
                          </svg>
                        </div>
                        <div class="bookItem__content">
                          <ul class="c-category__list">
                          <?php
                            if ( $categories ) :
                              foreach ( $categories as $category ) :
                                $catName = $category->name;
                                $catSlug = $category->slug;
                                $categoryIdArry = array_merge($categoryIdArry, array($category->term_id));
                          ?>
                            <li class="c-category__item">
                              <p class="is-dark category category-<?php echo $catSlug; ?>"><?php echo $catName; ?></p>
                            </li>
                          <?php endforeach; endif; ?>
                          </ul>
                          <h3 class="bookItem__title c-label-lab"><?php echo $postTitle; ?></h3>
                          <div class="c-writeInfo">
                            <div class="writer">
                              <div class="writerImg" data-src-bg="<?php echo $writerInfoThumbURL; ?>" alt=""></div>
                            </div>
                            <div class="writeInfo__body">
                              <p class="name"><?php echo $writerInfoName; ?></p>
                              <p class="subInfo"><span class="date"><?php echo $date; ?></span></p>
                            </div>
                          </div>
                        </div></a></li>
                      <?php endwhile; ?>
                  </ul>
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