<?php
  // global $ARTICLE_PUBLICATION_DEADLINE;
  $limitDate = date("ymd", mktime(0, 0, 0, date("m"), date("d") - $ARTICLE_PUBLICATION_DEADLINE,   date("Y")));
  $loginFlg = getSessionLoginFlg();
  $radioTypeId = '';
  $radioThumbUrl = '';
  $postId = '';
?>
<?php get_template_part("/parts/parts_head"); ?>
<body>
  <?php get_template_part("/parts/parts_gtm_body_under"); ?>
  <div class="l-app">
    <main>
      <div class="l-contents js-pjax-contents" data-scroll-section>
        <div class="l-content js-pjax-content" id="radio-detail">
          <?php get_header(); ?>
          <div class="l-content__in is-dark">
              <?php while ( have_posts() ) : the_post();
                  $title = get_the_title();
                  $postId = get_the_ID();
                  $anchorId = get_field('anchor_id');
                  $playbackTime = get_field('playback_time');
                  $applePodcastsUrl = get_field('apple_podcasts_url');
                  $spotifyUrl = get_field('spotify_url');
                  $youtubeUrl = get_field('youtube_url');
                  $updateDate = get_the_modified_date("Y.m.d");

                  $radioTypeId = get_field('radio_type');
                  $writerInfoIdAry = get_field('writer');
                  $radioTypeId = get_field('radio_type');
                  $radioTtl = get_field('title', $radioTypeId);
                  $radioThumbUrl = get_field('square_thumb', $radioTypeId);

                  // タグ
                  $tags = get_the_tags();
                  // カテゴリ
                  $categoryIdArry = Array(); 
                  $categories = get_the_category();
                  // 関連記事
                  $articleIdAry = get_field('articles');
              ?>
              <section class="s-fixedPlayer">
                <iframe src="<?php echo "https://anchor.fm/cultibase/embed/episodes/". $anchorId; ?>" height="98px" width="740px" frameborder="0" scrolling="no"></iframe>
              </section>
              <section class="s-mainRadio">
                <div class="c-inner inner">
                  <div class="mainRadio__thumb"><img class="img-thumb" src="<?php echo $radioThumbUrl;?>"></div>
                  <div class="mainRadio__content">
                    <div class="content__header">
                      <p class="raidoThemeName"><?php echo $radioTtl; ?></p>
                      <ul class="c-ownerInfoListSimpleForLab ownerInfoListSimpleForLab">
                        <?php 
                          foreach($writerInfoIdAry as $id):
                          $writerInfoName = get_field('writer_name', $id);
                          $writerInfoThumbURL = get_field('writer_thumb', $id);
                        ?>
                        <li class="ownerInfoItem">
                          <div class="ownerInfoItem__thumb">
                            <div class="bgImg" data-src-bg="<?php echo $writerInfoThumbURL; ?>" alt=""></div>
                          </div>
                          <p class="ownerInfoItem__name"><?php echo $writerInfoName; ?></p>
                        </li>
                        <?php 
                          endforeach;
                        ?>
                      </ul>
                    </div>
                    <div class="content__body">
                      <ul class="c-category__list category__list u-pc-only">
                        <?php
                          if ( $categories ) :
                            foreach ( $categories as $category ) :
                              $catName = $category->name;
                              $catSlug = $category->slug;
                              $categoryIdArry = array_merge($categoryIdArry, array($category->term_id));
                        ?>
                          <li class="c-category__item isn">
                            <p class="category category-<?php echo $catSlug; ?>"><?php echo $catName; ?></p>
                          </li>
                        <?php endforeach; endif; ?>
                      </ul>
                      <h2 class="radioTtl"><?php echo $title; ?></h2>
                      <p class="datetime"><span class="date"><?php echo $updateDate; ?></span>&nbsp;/&nbsp;<span class="time"><?php echo $playbackTime; ?></span></p>
                      <div class="outerLinkArea">
                        <ul class="outerMedia__list">
                          <?php if($applePodcastsUrl) :?>
                            <li class="outerMedia__item"><a class="outerMedia__link" href="<?php echo $applePodcastsUrl; ?>" target="_blank"><img class="outerMedia__btn" src="<?php bloginfo('template_url'); ?>/assets/images/common/btn_apple_podcasts.png"></a></li>
                          <?php endif; ?>
                          <?php if($spotifyUrl) :?>
                            <li class="outerMedia__item"><a class="outerMedia__link" href="<?php echo $spotifyUrl; ?>" target="_blank"><img class="outerMedia__btn" src="<?php bloginfo('template_url'); ?>/assets/images/common/btn_spotify.png"></a></li>
                          <?php endif; ?>
                          <?php if($youtubeUrl) :?>
                            <li class="outerMedia__item outerMedia__item--youtube"><a class="outerMedia__link" href="<?php echo $youtubeUrl; ?>" target="_blank"><img class="outerMedia__btn" src="<?php bloginfo('template_url'); ?>/assets/images/common/btn_youtube.png"></a></li>
                          <?php endif; ?>
                        </ul>
                        <div class="c-shareBtnForLab shareBtnForLab">
                          <div class="shareBtnForLab__inner">
                            <p class="shareTxt">Share</p>
                            <ul class="shareBtn__list">
                              <li class="shareBtn__item"><a class="shareBtn__link" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_share_fb_bk.png" alt=""/></a></li>
                              <li class="shareBtn__item"><a class="shareBtn__link" href="https://twitter.com/share?text=<?php echo urlencode($title); ?>&amp;url=<?php the_permalink(); ?> @cultibase" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_share_tw_bk.png" alt=""/></a></li>
                              <li class="shareBtn__item"><a class="shareBtn__link" href="https://b.hatena.ne.jp/entry/panel/?url=<?php the_permalink(); ?>&amp;btitle=<?php echo urlencode($title); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_share_hateb_bk.png" alt=""/></a></li>
                              <li class="shareBtn__item"><a class="shareBtn__link" href="https://social-plugins.line.me/lineit/share?url=<?php the_permalink(); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_share_line_bk.png" alt=""/></a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="radioDescription">
                        <?php the_content(); ?>
                      </div>
                      <ul class="radioCategoryList">
                        <?php
                          if($tags) :
                          foreach ($tags as $tag): 
                        ?>
                          <li class="tag__item"><a class="itemLink" href="/tag/<?php echo $tag->slug;?>">＃<?php echo $tag->name;?></a></li>
                        <?php
                          endforeach;
                          endif;
                        ?>
                      </ul>
                    </div>
                  </div>
                </div>
              </section>
              <section class="s-article">
                <div class="c-inner inner">
                  <h2 class="article__ttl">関連するおすすめ記事</h2>
                  <div class="c-articles articles--for-lab articles">
                    <div class="swiper-articles swiper-container">
                      <ul class="articles__list swiper-wrapper js-slideList">
                      <?php foreach($articleIdAry as $id):

                        // $post = get_post( $id );
                        $writerInfoId = get_field('writer', $id)[0];
                        $writerInfoName = get_field('writer_name',$writerInfoId);
                        $writerInfoThumbURL = get_field('writer_thumb',$writerInfoId);
                        $date = get_the_date('Y.m.d', $id);
                        $readTime = get_field('read_time', $id);

                        $postTitle = get_the_title($id);
                        $isDot = mb_strlen($postTitle) > 45;
                        $postTitle = mb_substr($postTitle, 0, 45);
                        if($isDot) {
                          $postTitle = $postTitle. "...";
                        }

                        // カテゴリ
                        $categoryIdArry = Array(); 
                        $categories = get_the_category($id);

                        // 期限切れフラグ（true：切れ）
                        $isExpired = false;
                        if(get_the_date('ymd', $id) <= $limitDate) $isExpired = true;
                        // 全分表示フラグ
                        $isShowLong =  false;
                        $type = get_field('type', $id);
                        switch ($type) {
                          case 'limit30':
                            if($loginFlg || !$isExpired) $isShowLong =  true;
                            break;
                          case 'free':
                            $isShowLong =  true;
                            break;
                          case 'lab':
                            if($loginFlg) $isShowLong =  true;
                            break;
                          default:
                            break;
                        }

                      ?>
                        <li class="articles__item swiper-slide js-slideItem"><a class="itemLink" href="<?php echo get_the_permalink($id); ?>">
                            <div class="itemThumb">
                            <img src="<?php echo get_the_post_thumbnail_url($id); ?>" alt=""/>
                            </div>
                            <ul class="c-category__list category__list">
                            <?php
                              // カテゴリー配列
                              $categories = get_the_category();
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
                              <h3 class="ttl <?php echo $labLabel; ?>"><?php echo $postTitle; ?></h3>
                              <div class="c-writeInfo">
                                <div class="writer">
                                  <div class="writerImg" data-src-bg="<?php echo $writerInfoThumbURL; ?>" alt=""></div>
                                </div>
                                <div class="writeInfo__body">
                                  <p class="name"><?php echo $writerInfoName;?></p>
                                  <p class="subInfo"><span class="date"><?php echo $date;?></span>&nbsp;/&nbsp;<span class="readTime"><?php echo $readTime;?></span>min</p>
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
                </div>
              </section>
              <?php endwhile; ?>
              <?php 
                $the_query = new WP_Query(
                  array(
                    'post_type' => ['radio'],
                    'posts_per_page' => 50,
                    'post__not_in'=> array($postId),
                    'meta_query' => array(array(
                      'key' => 'radio_type',
                      'value' => $radioTypeId,
                    ))
                )
                );
                if ($the_query->have_posts()) :
                  
              ?>
              <section class="s-spisodes">
                <div class="c-inner inner">
                  <h2 class="spisodes__ttl">Other Episodes</h2>
                  <ul class="spisodesList">
                    <?php 
                      while ($the_query->have_posts()) : $the_query->the_post();
                      $postTitle = get_the_title();
                      $link = get_the_permalink(); 
                      $playbackTime = get_field('playback_time');
                      $updateDate = get_the_modified_date("Y.m.d");
                      $writerInfoIdAry = get_field('writer');
                      $description = get_field('description');
                      // カテゴリ
                      $categoryIdArry = Array(); 
                      $categories = get_the_category();     
                      ?>
                    <li class="spisodesItem"><a class="spisodesItem__link" href="<?php echo $link; ?>">
                        <div class="spisodesItem__inner">
                          <div class="spisodesItem__thumb"><img class="imgThumb" src="<?php echo $radioThumbUrl; ?>"/><span class="playMark u-pc-only">
                              <svg class="c-playMark" xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" id="">
                                <path d="M48 24C48 37.2548 37.2548 48 24 48C10.7452 48 0 37.2548 0 24C0 10.7452 10.7452 0 24 0C37.2548 0 48 10.7452 48 24Z" fill="white"></path>
                                <path d="M31.5 21.4019C33.5 22.5566 33.5 25.4434 31.5 26.5981L22.5 31.7942C20.5 32.9489 18 31.5056 18 29.1962L18 18.8038C18 16.4944 20.5 15.0511 22.5 16.2058L31.5 21.4019Z" fill="#302D2A"></path>
                              </svg></span><span class="playMark u-sp-only">
                              <svg class="c-playMark" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48 48" id="">
                                <path d="M48 24C48 37.2548 37.2548 48 24 48C10.7452 48 0 37.2548 0 24C0 10.7452 10.7452 0 24 0C37.2548 0 48 10.7452 48 24Z" fill="white"></path>
                                <path d="M31.5 21.4019C33.5 22.5566 33.5 25.4434 31.5 26.5981L22.5 31.7942C20.5 32.9489 18 31.5056 18 29.1962L18 18.8038C18 16.4944 20.5 15.0511 22.5 16.2058L31.5 21.4019Z" fill="#302D2A"></path>
                              </svg></span></div>
                          <div class="spisodesItem__content">
                            <ul class="c-category__list category__list u-pc-only">
                              <?php
                                if ( $categories ) :
                                  foreach ( $categories as $category ) :
                                    $catName = $category->name;
                                    $catSlug = $category->slug;
                                    $categoryIdArry = array_merge($categoryIdArry, array($category->term_id));
                              ?>
                                <li class="c-category__item isn">
                                  <p class="category category-<?php echo $catSlug; ?>"><?php echo $catName; ?></p>
                                </li>
                              <?php endforeach; endif; ?>
                            </ul>
                            <h2 class="ttl"><?php echo $postTitle; ?></h2>
                            <p class="datetime"><span class="date"><?php echo $updateDate; ?></span>&nbsp;/&nbsp;<span class="time"><?php echo $playbackTime; ?></span></p>
                            <p class="descriptionTxt u-pc-only"><?php echo $description;?></p>
                            <div class="ownerInfo u-pc-only">
                              <ul class="c-ownerInfoListSimpleForLab ownerInfoListSimpleForLab">
                                <?php 
                                  foreach($writerInfoIdAry as $id):
                                  $writerInfoName = get_field('writer_name', $id);
                                  $writerInfoThumbURL = get_field('writer_thumb', $id);
                                ?>
                                <li class="ownerInfoItem">
                                  <div class="ownerInfoItem__thumb">
                                    <div class="bgImg" data-src-bg="<?php echo $writerInfoThumbURL; ?>" alt=""></div>
                                  </div>
                                  <p class="ownerInfoItem__name"><?php echo $writerInfoName; ?></p>
                                </li>
                                <?php 
                                  endforeach;
                                ?>
                              </ul>
                            </div>
                          </div>
                        </div>
                        <p class="descriptionTxt u-sp-only"><?php echo $description;?></p></a></li>
                    <?php endwhile; ?>
                  </ul>
                </div>
              </section>
              <?php endif; ?>
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
