<?php
  $loginFlg = getSessionLoginFlg();
  global $ARTICLE_PUBLICATION_DEADLINE;
  $limitDate = date("ymd", mktime(0, 0, 0, date("m"), date("d") - $ARTICLE_PUBLICATION_DEADLINE,   date("Y")));
?>
<?php get_template_part("/parts/parts_head"); ?>
<body>
  <?php get_template_part("/parts/parts_gtm_body_under"); ?>
  <div class="l-app">
    <main>
      <div class="l-contents js-pjax-contents" data-scroll-section>
        <div class="l-content js-pjax-content" id="feature-single">
          <?php get_header(); ?>
          <div class="l-content__in">
            <?php while ( have_posts() ) : the_post();
                  $title = get_the_title();
                  // $date = get_the_date('Y.m.d');
                  // 読むのにかかる時間
                  $thumbForList = get_field('thumb_for_list');
                  $updateDate = get_the_modified_date("Y.m.d");
                  $featureDescription = get_field("feature_description");
                  $featureArticles = get_field("feature_article");

                ?>
              <section class="s-featureIntro">
                <div class="featureIntro__bg" data-src-bg="<?php echo $thumbForList; ?>"></div>
                <div class="featureIntro__inner c-inner">
                  <div class="featureIntro__thumb">
                  <?php if(has_post_thumbnail()): ?>
                    <?php the_post_thumbnail(); ?>
                  <?php endif; ?>
                  </div>
                  <div class="featureIntro__body">
                    <h2 class="ttl"><?php echo $title;?></h2>
                    <p class="update">UPDATE : <?php echo $updateDate;?></p>
                    <p class="txt"><?php echo $featureDescription;?></p>
                    <div class="p-snsShareTopArea u-pc-only">
                      <ul class="sns__list">
                        <li class="sns__item"><a class="snsIcn" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_fb.png" alt=""></a></li>
                          <li class="sns__item"><a class="snsIcn" href="https://twitter.com/share?text=<?php echo $title; ?>&amp;url=<?php the_permalink(); ?> @cultibase" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_tw.png" alt=""></a></li>
                          <li class="sns__item"><a class="snsIcn" href="https://social-plugins.line.me/lineit/share?url=<?php the_permalink(); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_line.png" alt=""></a></li>
                          <li class="sns__item"><a class="snsIcn" href="https://b.hatena.ne.jp/entry/panel/?url=<?php the_permalink(); ?>&amp;btitle=<?php echo $title; ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_b.png" alt=""></a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </section>
              <section class="s-featureArticles">
                <div class="c-inner">
                  <div class="p-snsShareTopArea u-sp-only">
                    <ul class="sns__list">
                    <li class="sns__item"><a class="snsIcn" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_fb.png" alt=""></a></li>
                          <li class="sns__item"><a class="snsIcn" href="https://twitter.com/share?text=<?php echo $title; ?>&amp;url=<?php the_permalink(); ?> @cultibase" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_tw.png" alt=""></a></li>
                          <li class="sns__item"><a class="snsIcn" href="https://social-plugins.line.me/lineit/share?url=<?php the_permalink(); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_line.png" alt=""></a></li>
                          <li class="sns__item"><a class="snsIcn" href="https://b.hatena.ne.jp/entry/panel/?url=<?php the_permalink(); ?>&amp;btitle=<?php echo $title; ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_b.png" alt=""></a></li>
                          
                    </ul>
                  </div>
                  <ul class="c-article-box__list">
                    <?php foreach((array)$featureArticles as $featureArticle):
                    

                    $post = get_post( $featureArticle->ID );
                    $writerInfoId = get_field('writer')[0];
                    $writerInfoName = get_field('writer_name',$writerInfoId);
                    $writerInfoThumbURL = get_field('writer_thumb',$writerInfoId);
                    $date = get_the_date('Y.m.d', $featureArticle->ID);
                    $readTime = get_field('read_time', $featureArticle->ID);

                    $postTitle = $featureArticle->post_title;
                    $isDot = mb_strlen($postTitle) > 45;
                    $postTitle = mb_substr($postTitle, 0, 45);
                    if($isDot) {
                      $postTitle = $postTitle. "...";
                    }
                    // 期限切れフラグ（true：切れ）
                    $isExpired = false;
                    if(get_the_date('ymd') <= $limitDate) $isExpired = true;
                      // 全分表示フラグ
                      $isShowLong =  false;
                      $type = get_field('type');
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
                    <li class="c-article-box__item --col3"><a class="itemLink" href="<?php echo get_the_permalink($featureArticle->ID); ?>">
                        <div class="itemThumb">
                          <img src="<?php echo get_the_post_thumbnail_url($featureArticle->ID); ?>" alt=""/>
                        </div>
                        <div class="itemBody">
                          <h3 class="ttl <?php echo $labLabel;?>"><?php echo $postTitle; ?></h3>
                          <div class="c-writeInfo writeInfo">
                          <div class="writer">
                            <div class="writerImg" data-src-bg="<?php echo $writerInfoThumbURL; ?>" alt="<?php echo $writerInfoName;?>"></div>
                            </div>
                            <div class="writeInfo__body">
                              <p class="name"><?php echo $writerInfoName;?></p>
                              <p class="subInfo"><span class="date"><?php echo $date;?></span>/ <span class="readTime"><?php echo $readTime;?></span>min read</p>
                            </div>
                          </div>
                        </div>
                      </a>
                      </li>
                    <?php endforeach; ?>
                    
                  </ul>
                  <div class="line"></div><a class="backLink" href="/feature-list">特集一覧へ戻る</a>
                </div>
              </section>
              <?php endwhile; ?>
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
