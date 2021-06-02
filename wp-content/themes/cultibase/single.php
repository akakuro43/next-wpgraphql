<?php
  $loginFlg = getSessionLoginFlg();
?>
<?php get_template_part("/parts/parts_head"); ?>
<body>
  <?php get_template_part("/parts/parts_gtm_body_under"); ?>
  <div class="l-app">
    <main>
      <div class="l-contents js-pjax-contents" data-scroll-section>
        <div class="l-content js-pjax-content" id="single">
          <?php get_header(); ?>
          <div class="l-content__in">
            <div class="frame">
              <div class="frame__main">
                <section class="s-article">
                  <?php

                  $limitDate = date("ymd", mktime(0, 0, 0, date("m"), date("d") - $ARTICLE_PUBLICATION_DEADLINE,   date("Y")));
                  
                  while ( have_posts() ) : the_post();
                  $nowPostId = get_the_id();
                  $title = get_the_title();
                  $date = get_the_date('Y.m.d');
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

                  // 読むのにかかる時間
                  $readTime = get_field('read_time');
                  // ライター情報
                  $writerInfoId = get_field('writer')[0];
                  $writerInfoName = get_field('writer_name',$writerInfoId);
                  $writerInfoThumbURL = get_field('writer_thumb',$writerInfoId);
                  // カテゴリ
                  $categoryIdArry = Array(); 
                  // レコメンド
                  $recommendArry = Array();
                  // ポストタイプ
                  $postType = get_post_type();
                  // サムネイル
                  $thumb = null;
                  if($postType == "radio") {
                    $radioThumbs = get_field('radio_thumb');
                    $thumb = get_field('tectangle_thumb', $radioThumbs);
                  } else {
                    $thumb = get_the_post_thumbnail_url();
                  }
                  
                  // 連載
                  // 連載レコメンドの有無フラグ
                  $isRecommendSerialization = false;
                  $recommendSerializationArry = Array();
                  $recommendSerializationArryLength = 0;
                  $recommendSerializationID = get_field('recommend_serialization');
                  
                  if($recommendSerializationID != null) {
                    // 記事が連載であれば、情報の取得を行う
                    $recommendSerializationArry = get_field( 'summary', $recommendSerializationID );
                    $recommendSerializationArryLength = count($recommendSerializationArry);
                    if($recommendSerializationArryLength > 1) {
                      $isRecommendSerialization = true;
                    }                    
                    
                    for($i = 0; count($recommendSerializationArry) > $i; $i++) {
                      // echo $recommendSerializationArry[$i];
                      if($nowPostId == $recommendSerializationArry[$i]->ID) {
                        // 現在の記事IDと一致したら、レコメンドするIDを最大3つ取得
                        if(0 <= $i - 1) array_push($recommendArry, $recommendSerializationArry[$i - 1]->ID);
                        if(count($recommendSerializationArry) > $i + 1) array_push($recommendArry, $recommendSerializationArry[$i + 1]->ID);
                        if(count($recommendSerializationArry) > $i + 2) array_push($recommendArry, $recommendSerializationArry[$i + 2]->ID);
                        // print_r($recommendArry);
                        break;
                      } 
                    }
                  }

                  $shortContents = get_field('unregistered_contents');
                  $tags = get_the_tags();

                  $link = get_permalink();
                  $twShereLink = "https://twitter.com/share?text=". urlencode($title) . "&amp;url=" .$link ." @cultibase";

                ?>
                  <div class="article__header">
                    <div class="thumb">
                      <img src="<?php echo $thumb; ?>" alt="<?php echo $title;?>">
                    </div>
                    <div class="c-main-inner">
                      <div class="intro">
                        <ul class="category__list">
                          <?php
                            // カテゴリー配列
                            $categories = get_the_category();
                            if ( $categories ) :
                              foreach ( $categories as $category ) :
                                $catName = $category->name;
                                $catSlug = $category->slug;
                                $categoryIdArry = array_merge($categoryIdArry, array($category->term_id));
                          ?>
                            <li class="category__item">
                              <a class="category category-<?php echo $catSlug; ?>" href="/category/<?php echo $catSlug; ?>"><?php echo $catName; ?></a>
                            </li>
                          <?php endforeach; endif; ?>
                        </ul>
                        <h1 class="ttl"><?php echo $title;?></h1>
                        <ul class="p-tag__list">
                        <?php
                          if($tags) :
                            foreach ($tags as $tag): ?>
                          <li class="tag__item"><a class="itemLink" href="/tag/<?php echo $tag->slug;?>">＃<?php echo $tag->name;?></a></li>
                        <?php
                            endforeach;
                          endif;
                        ?>
                        </ul>
                        <div class="c-writeInfo writeInfo">
                          <div class="writer">
                            <div class="writerImg" data-src-bg="<?php echo $writerInfoThumbURL; ?>" alt="<?php echo $writerInfoName;?>"></div>
                          </div>
                          <div class="writeInfo__body">
                            <p class="name"><?php echo $writerInfoName;?></p>
                            <p class="subInfo"><span class="date"><?php echo $date;?></span>/ <span class="readTime"><?php echo $readTime;?></span>min read</p>
                          </div>
                        </div>
                        <div class="p-snsShareTopArea">
                          <ul class="sns__list">
                            <li class="sns__item"><a class="snsIcn" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_fb.png" alt=""></a></li>
                            <li class="sns__item"><a class="snsIcn" href="<?php echo $twShereLink; ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_tw.png" alt=""></a></li>
                            <li class="sns__item"><a class="snsIcn" href="https://social-plugins.line.me/lineit/share?url=<?php the_permalink(); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_line.png" alt=""></a></li>
                            <li class="sns__item"><a class="snsIcn" href="https://b.hatena.ne.jp/entry/panel/?url=<?php the_permalink(); ?>&amp;btitle=<?php echo $title; ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_b.png" alt=""></a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php if($isShowLong): ?>
                    <div class="article__main">
                      <div class="c-inner">
                        <?php the_content(); ?>
                      </div>
                    </div>
                  <?php else: ?>
                    <div class="article__main article__main--short">
                      <div class="c-main-inner">
                        <?php if($shortContents): ?>
                          <?php echo $shortContents; ?>
                        <?php else: ?>
                          <div class="article__main">
                            <div class="c-inner">
                              <?php the_content(); ?>
                            </div>
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>
                    <div class="memberSingup">
                      <p class="memberSingup__txt">続きをお読みいただくには、<br class="u-sp-only" /><span class="red">CULTIBASE Lab会員登録</span>が必要です。</p>
                      <a class="c-btnMemberRegist btnMemberRegist" href="/lab"><span class="regist__txt"><span class="t">Lab会員登録</span><span class="s">初月無料トライアルに申し込む</span></span></a>
                      <a class="c-btnLogin btnLogin" href="/login">ログイン</a>
                    </div>
                  <?php endif;?>
                  <div class="article__footer">
                    <div class="c-inner">
                      <ul class="p-tag__list tag__list">
                      <?php
                        if($tags):
                        foreach ($tags as $tag): ?>
                          <li class="tag__item"><a class="itemLink" href="/tag/<?php echo $tag->slug;?>">＃<?php echo $tag->name;?></a></li>
                        <?php endforeach; endif;?>
                      </ul>
                      <div class="p-snsShareBottomArea">
                        <ul class="sns__list">
                          <li class="sns__item"><a class="snsIcn" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_fb.png" alt=""></a></li>
                          <li class="sns__item"><a class="snsIcn" href="<?php echo $twShereLink; ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_tw.png" alt=""></a></li>
                          <li class="sns__item"><a class="snsIcn" href="https://social-plugins.line.me/lineit/share?url=<?php the_permalink(); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_line.png" alt=""></a></li>
                          <li class="sns__item"><a class="snsIcn" href="https://b.hatena.ne.jp/entry/panel/?url=<?php the_permalink(); ?>&amp;btitle=<?php echo $title; ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_b.png" alt=""></a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <?php endwhile; ?>
                </section>
                <section class="c-relatedPosts">
                  <div class="c-inner">
                    <h3 class="relatedPosts__headline">あわせて読みたい記事</h3>
                    <div class="c-articles-horizontal articles">
                      <ul class="article__list">
                      <ul class="article__list">
                        <?php
                          if($isRecommendSerialization) {
                            $query = new WP_Query(array(
                              'post_type' => ['post', 'video'],
                              'posts_per_page' => 3,
                              'order' => 'ASC',
                              'orderby' => 'date',
                              'post__in' => $recommendArry,
                            ));
                            while($query -> have_posts()): $query -> the_post();
                              get_template_part('/parts/article');
                            endwhile;
                          }
                        ?>
                        <?php
                          if(count($recommendArry) < 3) {
                            $query = new WP_Query(array(
                              'post_type' => ['post', 'video'],
                              'posts_per_page' => 3 - count($recommendArry),
                              'paged' => get_query_var('paged'),
                              'category__in' => $categoryIdArry,
                              'post__not_in' => array_merge(array($nowPostId), $recommendArry),
                            ));
                            while($query -> have_posts()): $query -> the_post();
                              get_template_part('/parts/article');
                            endwhile;
                          }
                        ?>
                      </ul>
                    </div>
                  </div>
                </section>
              </div>
              <div class="frame__sub">
                <?php get_template_part("/parts/parts_side-about"); ?>
                <?php get_template_part("/parts/parts_ranking-sidebar"); ?>
                <div class="frame__sub__line"></div>
                <?php get_template_part("/parts/parts_tag-area"); ?>
                <?php if($loginFlg == 1) : ?>
                  <?php get_template_part("/parts/parts_side-fb-group"); ?>
                <?php endif; ?>
                
              </div>
            </div>
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
