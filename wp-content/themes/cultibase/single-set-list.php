<?php
  $loginFlg = getSessionLoginFlg();
?>
<?php get_template_part("/parts/parts_head"); ?>
<body>
  <?php get_template_part("/parts/parts_gtm_body_under"); ?>
  <div class="l-app">
    <main>
      <div class="l-contents js-pjax-contents" data-scroll-section>
        <div class="l-content js-pjax-content" id="set-detail">
          <?php get_header(); ?>
          <div class="l-content__in background-grid">
            <?php while ( have_posts() ) : the_post();
                  $nowPostId = get_the_id();
                  $title = get_the_title();
                  // ライター情報
                  $writerInfoId = get_field('writer')[0];
                  $writerInfoName = get_field('writer_name', $writerInfoId);
                  $writerInfoThumbURL = get_field('writer_thumb', $writerInfoId);
                  // 概要
                  $description = get_field('description');
                  // タグ
                  $tags = get_the_tags();
                  
                  // Video
                  $videoList = get_field("video");
                  // Article
                  $articleList = get_field("article");
                  // Radio
                  $radioList = get_field("radio");

              ?>
              <div class="c-inner">
                <div class="page-set-detail__main">
                  <h1 class="page-set-detail__main-title"><?php echo $title;?></h1>
                  <div class="writeInfo">
                    <div class="writer__thumb"><img data-src="<?php echo $writerInfoThumbURL; ?>" alt=""></div>
                    <p class="writer__name"><?php echo $writerInfoName; ?></p>
                  </div>
                  <div class="page-set-detail__main-desc">
                    <?php echo $description;?>
                  </div>
                </div>
                <section class="c-tagArea">
                  <ul class="tag__list">
                    <?php
                      $termAry = [];

                      if($videoList)  {                      
                        foreach ((array)$videoList as $videoId) {
                          $videoTags = get_the_tags($videoId); // A B C // A B 
                          //echo $videoTags;
                          foreach ($videoTags as $tag) {
                            $termId = $tag->term_id; // タームIDを取得する
                            array_push($termAry,$termId);
                          }
                        }
                       }
                       if($articleList)  {                      
                        foreach ((array)$articleList as $articleId) {
                          $articleTags = get_the_tags($articleId); // A B C // A B 
                          //echo $videoTags;
                          foreach ($articleTags as $tag) {
                            $termId = $tag->term_id; // タームIDを取得する
                            array_push($termAry,$termId);
                          }
                        }
                       }
                       if($radioList)  {                      
                        foreach ((array)$radioList as $radioId) {
                          $radioTags = get_the_tags($radioId); // A B C // A B 
                          //echo $videoTags;
                          foreach ($radioTags as $tag) {
                            $termId = $tag->term_id; // タームIDを取得する
                            array_push($termAry,$termId);
                          }
                        }
                       }

                      $termAry = array_unique($termAry); // 重複排除

                      foreach ($termAry as $termID):
                        // termIDからnameとslagを取得する
                        $term = get_term($termID);   //情報オブジェクトを取得
                        $name = $term->name;          
                        $slug = $term->slug;
                    ?>

                      <li class="tag__item"><a class="itemLink" href="/tag/<?php echo $slug;?>">＃<?php echo $name;?></a></li>
                    <?php
                        endforeach;
                    ?>
                  </ul>
                </section>
              </div>
              <?php if($videoList): ?>
              <?php if($loginFlg) : ?>
                <div class="informations">
              <?php else: ?>
                <div class="informations is-cover">
                  <div class="memberSingup">
                    <p class="memberSingup__txt">コンテンツパッケージをご覧いただくには、<br><span class="red">CULTIBASE Lab会員登録</span>が必要です。</p>
                    <a class="c-btnMemberRegist btnMemberRegist" href="/lab"><span class="regist__txt"><span class="t">Lab会員登録</span><span class="s">初月無料トライアルに申し込む</span></span></a>
                    <a class="c-btnLogin btnLogin" href="/login">ログイン</a>
                  </div>
              <?php endif;?>
                <section class="information">
                  <div class="c-inner">
                    <h2 class="information-title">Video</h2>
                  </div>
                  <div class="c-videos videos">
                    <div class="swiper-video swiper-container">
                      <ul class="videoList swiper-wrapper js-slideList">
                        <?php foreach((array)$videoList as $videoId):
                            $title = get_the_title($videoId);
                            $isDot = mb_strlen($title) > 45;
                            $title = mb_substr($title, 0, 45);
                            if($isDot) {
                              $title = $title. "...";
                            }
                            $date = get_the_date('Y.m.d', $videoId);
                            $postThumbnail = get_the_post_thumbnail_url($videoId, 'large');
                            // 再生時間
                            $playback_time = get_field('playback_time', $videoId);
                            // ライター情報
                            $writerInfoId = get_field('writer', $videoId)[0];
                            $writerInfoName = get_field('writer_name', $writerInfoId);
                            $writerInfoThumbURL = get_field('writer_thumb', $writerInfoId);
                            // カテゴリー配列
                            $categoryIdArry = Array(); 
                            $categories = get_the_category($videoId);
                            // 投稿タイプ
                            $postType = get_post_type( $videoId );

                          
                          ?>
                        <li class="videoItem swiper-slide js-slideItem"><a href="<?php the_permalink($videoId); ?>">
                            <div class="videoItem__thumb"><img src="<?php echo $postThumbnail; ?>"/>
                            <p class="time"><?php echo $playback_time; ?></p>
                              <svg class="c-playMark" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 48 48" id="">
                                <path d="M48 24C48 37.2548 37.2548 48 24 48C10.7452 48 0 37.2548 0 24C0 10.7452 10.7452 0 24 0C37.2548 0 48 10.7452 48 24Z" fill="white"></path>
                                <path d="M31.5 21.4019C33.5 22.5566 33.5 25.4434 31.5 26.5981L22.5 31.7942C20.5 32.9489 18 31.5056 18 29.1962L18 18.8038C18 16.4944 20.5 15.0511 22.5 16.2058L31.5 21.4019Z" fill="#302D2A"></path>
                              </svg>
                            </div>
                            <div class="videoItem__content">
                              <ul class="c-category__list">
                                <?php
                                    if ( $categories ) :
                                      foreach ( $categories as $category ) :
                                        $catName = $category->name;
                                        $catSlug = $category->slug;
                                        $categoryIdArry = array_merge($categoryIdArry, array($category->term_id));
                                  ?>
                                    <li class="c-category__item">
                                      <p class="category category-<?php echo $catSlug; ?>"><?php echo $catName; ?></p>
                                    </li>
                                  <?php endforeach; endif; ?>
                              </ul>
                              <h3 class="videoItem__title  <?php if($postType != 'free-video') echo 'c-label-lab' ;?>"><?php echo $title; ?></h3>
                              <div class="c-writeInfo">
                                <div class="writer">
                                  <div class="writerImg" data-src-bg="<?php echo $writerInfoThumbURL; ?>" alt=""></div>
                                </div>
                                <div class="writeInfo__body">
                                  <p class="name"><?php echo $writerInfoName;?></p>
                                  <p class="subInfo"><span class="date"><?php echo $date; ?></span></p>
                                </div>
                              </div>
                            </div></a></li>
                            <?php endforeach; ?>
                      </ul>
                      <div class="swiper-button-prev">
                        <div class="arrow"></div>
                      </div>
                      <div class="swiper-button-next">
                        <div class="arrow"></div>
                      </div>
                    </div>
                  </div>
                </section>
                <?php endif; ?>
                <?php if($articleList): ?>
                <section class="information">
                  <div class="c-inner">
                    <h2 class="information-title">Article</h2>
                  </div>
                  <div class="c-articles articles">
                    <div class="swiper-articles swiper-container">
                      <ul class="articles__list swiper-wrapper js-slideList">
                      <?php foreach((array)$articleList as $articleId):                                            
                          $title = get_the_title($articleId);
                          $isDot = mb_strlen($title) > 45;
                          $title = mb_substr($title, 0, 45);
                          if($isDot) {
                            $title = $title. "...";
                          }
                          $date = get_the_date('Y.m.d', $articleId);
                          $postThumbnail = get_the_post_thumbnail_url($articleId, 'large');
                          // Read Time
                          $readTime = get_field('read_time', $articleId);
                          // ライター情報
                          $writerInfoId = get_field('writer', $articleId)[0];
                          $writerInfoName = get_field('writer_name', $writerInfoId);
                          $writerInfoThumbURL = get_field('writer_thumb', $writerInfoId);
                          // カテゴリー配列
                          $categoryIdArry = Array(); 
                          $categories = get_the_category($articleId);

                        ?>
                        <li class="articles__item swiper-slide js-slideItem"><a class="itemLink" href="<?php the_permalink($articleId); ?>">
                            <div class="itemThumb"><img src="<?php echo $postThumbnail; ?>" alt=""/></div>
                            <ul class="c-category__list">
                                <?php
                                    if ( $categories ) :
                                      foreach ( $categories as $category ) :
                                        $catName = $category->name;
                                        $catSlug = $category->slug;
                                        $categoryIdArry = array_merge($categoryIdArry, array($category->term_id));
                                  ?>
                                    <li class="c-category__item">
                                      <p class="category category-<?php echo $catSlug; ?>"><?php echo $catName; ?></p>
                                    </li>
                                  <?php endforeach; endif; ?>
                              </ul>
                            <div class="itemBody">
                              <h3 class="ttl"><?php echo $title; ?></h3>
                              <div class="c-writeInfo">
                                <div class="writer">
                                  <div class="writerImg" data-src-bg="<?php echo $writerInfoThumbURL; ?>" alt=""></div>
                                </div>
                                <div class="writeInfo__body">
                                  <p class="name"><?php echo $writerInfoName; ?></p>
                                  <p class="subInfo"><span class="date"><?php echo $date; ?></span>&nbsp;/&nbsp;<span class="readTime"><?php echo $readTime; ?></span>min</p>
                                </div>
                              </div>
                            </div></a></li>
                          <?php endforeach; ?>
                      </ul>
                      <div class="swiper-button-prev">
                        <div class="arrow"></div>
                      </div>
                      <div class="swiper-button-next">
                        <div class="arrow"></div>
                      </div>
                    </div>
                  </div>
                </section>
                <?php endif; ?>
                <?php if($radioList): ?>
                  <section class="information">
                    <div class="c-inner">
                    <h2 class="information-title">Radio</h2>
                    <div class="page-set-detail__radio-slide">
                      <ul class="page-set-detail__radio js-slideList" data-slide-width="162">
                        <?php foreach((array)$radioList as $radioId):
                          $title = get_the_title($radioId);
                          $isDot = mb_strlen($title) > 45;
                          $title = mb_substr($title, 0, 45);
                          if($isDot) {
                            $title = $title. "...";
                          }
                          $date = get_the_date('Y.m.d', $radioId);
                          $postThumbnail = get_the_post_thumbnail_url($articleId, 'large');
                          // 再生時間
                          $playback_time = get_field('playback_time', $radioId);
                          // ライター情報
                          $writerInfoId = get_field('writer', $radioId)[0];
                          $writerInfoName = get_field('writer_name', $writerInfoId);
                          // ラジオタイプ
                          $radioType = get_field('radio_type', $radioId);
                          $squareThumb = get_field('square_thumb', $radioType)
                          
                          // $writerInfoThumbURL = get_field('writer_thumb', $writerInfoId);

                        ?>
                        <li class="js-slideItem"><a class="page-set-detail__radio-wrap" href="<?php the_permalink($radioId); ?>">
                            <div class="page-set-detail__radio-item"><img class="page-set-detail__radio-thumb" src="<?php echo $squareThumb; ?>"/>
                              <div class="page-set-detail__radio-content">
                                <h3 class="page-set-detail__radio-title"><?php echo $title; ?></h3>
                                <p class="page-set-detail__radio-speaker"><?php echo $writerInfoName; ?></p>
                                <p class="page-set-detail__radio-datetime"><?php echo $date; ?> / <?php echo $playback_time; ?></p>
                              </div>
                            </div></a></li>
                          <?php endforeach; ?>
                      </ul>
                    </div>
                    </div>
                  </section>
                <?php endif; ?>
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
