<?php
/* Template Name: 記事一覧 */  
get_template_part("/parts/parts_head"); 

function getArticleList($categoryName) {

  global $ARTICLE_PUBLICATION_DEADLINE;
  $limitDate = date("ymd", mktime(0, 0, 0, date("m"), date("d") - $ARTICLE_PUBLICATION_DEADLINE,   date("Y")));

  echo '<ul class="articles__list swiper-wrapper js-slideList">';

  $args = array(
      'post_type' => ['post', 'video'],
      'posts_per_page' => 12,
      'category_name' => $categoryName,
      'meta_query' => array(array(
        'key' => 'priority_category_top',
        'value' => $categoryName,
        'compare'=>'LIKE'
      ))
   );
  $the_query = new WP_Query($args);
  if ($the_query->have_posts()) {
    while ($the_query->have_posts()) {
      $the_query->the_post();
      $date = get_the_date('Y.m.d');
      $readTime = get_field('read_time');
      $writerInfoId = get_field('writer')[0];
      $writerInfoName = get_field('writer_name',$writerInfoId);
      $writerInfoThumbURL = get_field('writer_thumb',$writerInfoId);
      $postThumbnail = get_the_post_thumbnail(null, 'medium_large');

      $postTitle = get_the_title();
      $isDot = mb_strlen($postTitle) > 45;
      $postTitle = mb_substr($postTitle, 0, 45);
      if($isDot) {
        $postTitle = $postTitle. "...";
      }
      // 期限切れフラグ（true：切れ）
      $isExpired = false;
      if(get_the_date('ymd') <= $limitDate) $isExpired = true;
      
      // 全分表示フラグ
      $labLabel = '';
      $type = get_field('type');
      switch ($type) {
        case 'limit30':
          if($isExpired) $labLabel =  'c-label-lab';
          break;
        case 'lab':
          $labLabel =  'c-label-lab';
          break;
        default:
          break;
      }

      echo '<li class="articles__item swiper-slide js-slideItem">';
      echo  '<a class="itemLink" href="', the_permalink(), '">';
      echo    '<div class="itemThumb">', $postThumbnail, '</div>';
      echo    '<div class="itemBody">';
      echo      '<h3 class="ttl '. $labLabel. '">', $postTitle, '</h3>';
      echo      '<div class="c-writeInfo">';
      echo        '<div class="writer">';
      echo          '<div class="writerImg" data-src-bg="', $writerInfoThumbURL , '" alt="', $writerInfoName, '"></div>';
      echo        '</div>';
      echo        '<div class="writeInfo__body">';
      echo          '<p class="name">', $writerInfoName, '</p>';
      echo          '<p class="subInfo"><span class="date">', $date, '</span> / <span class="readTime">', $readTime , '</span>min read</p>';
      echo        '</div>';
      echo      '</div>';
      echo    '</div>';
      echo  '</a>';
      echo '</li>';

    }
  }
  echo '</ul>';
}

?>


<body>
    <?php get_template_part("/parts/parts_gtm_body_under"); ?> 
    <div class="l-app">
      <main>
        <div class="l-contents js-pjax-contents" data-scroll-section>
          <div class="l-content js-pjax-content" id="articles">
            <?php get_header(); ?>
            <div class="l-content__in">
              <section class="s-mainArticles">
                <div class="c-inner">
                  <div class="c-headlineArea headlineArea">
                    <h2 class="c-headline headline"><span class="en">Article</span><span class="ja">読む</span></h2>
                  </div>
                </div>
                <div class="new-particles">
                  <div class="c-inner">
                    <h2 class="new-particles__ttl">最新記事</h2>
                  </div>
                  <?php get_template_part("/parts/parts_new-articles"); ?>
                </div>
                <div class="popular-particles">
                  <div class="c-inner">
                    <h2 class="popular-particles__ttl">よく読まれている記事</h2>
                  </div>
                  <?php get_template_part("/parts/parts_popular-articles"); ?>
                </div>
                <ul class="byCategory__list">
                  <li class="byCategory__item">
                    <div class="c-inner">
                      <div class="c-headlineArea">
                        <h2 class="c-headline--category"><span class="headline__line headline__line--category1"></span><span class="headline__txt"><span class="en">Innovation</span><span class="ja">イノベーション</span></span></h2><a class="c-detailLink detailLink" href="/category/innovation?type=article"><span class="detailLink__txt">もっと見る</span><span class="detailLink__icn">
                            <svg class="c-nextIcon" xmlns="http://www.w3.org/2000/svg" width="10" height="11" viewBox="0 0 10 11" id="">
                              <path d="M4.24264 1.00003L8.48528 5.24268L4.24264 9.48532" stroke="black" stroke-width="2" fill="none"></path>
                            </svg></span></a>
                      </div>
                    </div>
                    <div class="c-articles articles">
                      <div class="swiper-articles swiper-container">
                        <?php getArticleList('innovation'); ?>
                        <div class="swiper-button-prev">
                          <div class="arrow"></div>
                        </div>
                        <div class="swiper-button-next">
                          <div class="arrow"></div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="byCategory__item">
                    <div class="c-inner">
                      <div class="c-headlineArea">
                        <h2 class="c-headline--category"><span class="headline__line headline__line--category2"></span><span class="headline__txt"><span class="en">Management</span><span class="ja">経営・マネジメント</span></span></h2><a class="c-detailLink detailLink" href="/category/management?type=article"><span class="detailLink__txt">もっと見る</span><span class="detailLink__icn">
                            <svg class="c-nextIcon" xmlns="http://www.w3.org/2000/svg" width="10" height="11" viewBox="0 0 10 11" id="">
                              <path d="M4.24264 1.00003L8.48528 5.24268L4.24264 9.48532" stroke="black" stroke-width="2" fill="none"></path>
                            </svg></span></a>
                      </div>
                    </div>
                    <div class="c-articles articles">
                      <div class="swiper-articles swiper-container">
                        <?php getArticleList('management'); ?>
                        <div class="swiper-button-prev">
                          <div class="arrow"></div>
                        </div>
                        <div class="swiper-button-next">
                          <div class="arrow"></div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="byCategory__item">
                    <div class="c-inner">
                      <div class="c-headlineArea">
                        <h2 class="c-headline--category"><span class="headline__line headline__line--category3"></span><span class="headline__txt"><span class="en">Design</span><span class="ja">デザイン</span></span></h2><a class="c-detailLink detailLink" href="/category/design?type=article"><span class="detailLink__txt">もっと見る</span><span class="detailLink__icn">
                            <svg class="c-nextIcon" xmlns="http://www.w3.org/2000/svg" width="10" height="11" viewBox="0 0 10 11" id="">
                              <path d="M4.24264 1.00003L8.48528 5.24268L4.24264 9.48532" stroke="black" stroke-width="2" fill="none"></path>
                            </svg></span></a>
                      </div>
                    </div>
                    <div class="c-articles articles">
                      <div class="swiper-articles swiper-container">
                        <?php getArticleList('design'); ?>
                        <div class="swiper-button-prev">
                          <div class="arrow"></div>
                        </div>
                        <div class="swiper-button-next">
                          <div class="arrow"></div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="byCategory__item">
                    <div class="c-inner">
                      <div class="c-headlineArea">
                        <h2 class="c-headline--category"><span class="headline__line headline__line--category4"></span><span class="headline__txt"><span class="en">Learning</span><span class="ja">学習・人材育成</span></span></h2><a class="c-detailLink detailLink" href="/category/learning?type=article"><span class="detailLink__txt">もっと見る</span><span class="detailLink__icn">
                            <svg class="c-nextIcon" xmlns="http://www.w3.org/2000/svg" width="10" height="11" viewBox="0 0 10 11" id="">
                              <path d="M4.24264 1.00003L8.48528 5.24268L4.24264 9.48532" stroke="black" stroke-width="2" fill="none"></path>
                            </svg></span></a>
                      </div>
                    </div>
                    <div class="c-articles articles">
                      <div class="swiper-articles swiper-container">
                        <?php getArticleList('learning'); ?>
                        <div class="swiper-button-prev">
                          <div class="arrow"></div>
                        </div>
                        <div class="swiper-button-next">
                          <div class="arrow"></div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="byCategory__item">
                    <div class="c-inner">
                      <div class="c-headlineArea">
                        <h2 class="c-headline--category"><span class="headline__line headline__line--category5"></span><span class="headline__txt"><span class="en">Facilitation</span><span class="ja">ファシリテーション</span></span></h2><a class="c-detailLink detailLink" href="/category/facilitation?type=article"><span class="detailLink__txt">もっと見る</span><span class="detailLink__icn">
                            <svg class="c-nextIcon" xmlns="http://www.w3.org/2000/svg" width="10" height="11" viewBox="0 0 10 11" id="">
                              <path d="M4.24264 1.00003L8.48528 5.24268L4.24264 9.48532" stroke="black" stroke-width="2" fill="none"></path>
                            </svg></span></a>
                      </div>
                    </div>
                    <div class="c-articles articles">
                      <div class="swiper-articles swiper-container">
                        <?php getArticleList('facilitation'); ?>
                        <div class="swiper-button-prev">
                          <div class="arrow"></div>
                        </div>
                        <div class="swiper-button-next">
                          <div class="arrow"></div>
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
              </section>
              <section class="s-feature">
                <div class="c-inner--s">
                  <div class="c-headlineArea headlineArea">
                    <h2 class="c-headline headline"><span class="en">Feature</span><span class="ja">特集</span></h2><a class="c-detailLink u-sp-only" href="/feature-list"><span class="detailLink__txt">ブック一覧へ</span><span class="detailLink__icn">
                        <svg class="c-nextIcon" xmlns="http://www.w3.org/2000/svg" width="10" height="11" viewBox="0 0 10 11" id="">
                          <path d="M4.24264 1.00003L8.48528 5.24268L4.24264 9.48532" stroke="black" stroke-width="2" fill="none"></path>
                        </svg></span></a>
                  </div>
                </div>
                <div class="c-inner--s inner">
                  <div class="featureArticles">
                    <ul class="featureArticle__list js-slideList" data-slide-width="162" data-slide-offset="-10">
                    <?php
                          $query = new WP_Query(array(
                            'post_type' => 'features',
                            'posts_per_page' => '4',
                            'paged' => get_query_var('paged'),
                          ));
                          while($query -> have_posts()): $query -> the_post();
                          $thumbForList = get_field('thumb_for_list');

                    ?>
                      <li class="featureArticle__item js-slideItem">
                        <a class="itemLink" href="<?php the_permalink(); ?>">
                          <div class="itemThumb">
                          <img src="<?php echo $thumbForList; ?>" alt="<?php the_title(); ?>"/>
                          </div>
                          <div class="itemBody">
                            <h2 class="ttl"><?php the_title(); ?></h2>
                          </div>
                        </a>
                      </li>
                      <?php
                      endwhile;
                    ?>
                    </ul>
                  </div><a class="btn u-pc-only" href="/feature-list">ブック一覧へ</a>
                </div>
              </section>
            </div>
            <section class="s-mostPopularAndTag">
              <div class="mostPopularAndTag__inner">
                <?php get_template_part("/parts/parts_ranking-article-for-pc"); ?>
                <?php get_template_part("/parts/parts_ranking-article"); ?>
                <?php get_template_part("/parts/parts_tag-area"); ?>
              </div>
            </section>
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