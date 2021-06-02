<?php
/* Template Name: 動画コンテンツ一覧 */  
get_template_part("/parts/parts_head");

function getVideoList($categoryName) {
  echo '<ul class="videoList swiper-wrapper js-slideList">';

  $args = array(
      'post_type' => ['free-video', 'paid-video'],
      'posts_per_page' => 12,
      'category_name' => $categoryName,
      'meta_query' => array(array(
        'key' => 'priority_category',
        'value' => $categoryName,
        'compare'=>'LIKE'
      ))
   );
  $the_query = new WP_Query($args);
  if ($the_query->have_posts()) {
    while ($the_query->have_posts()) {
      $the_query->the_post();
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
      // 投稿タイプ
      $postType = get_post_type( $videoId );
      $labLabel = ($postType != 'free-video') ? 'c-label-lab' : '';

echo '<li class="videoItem swiper-slide js-slideItem">';
echo  '<a href="', the_permalink(), '">';
echo     '<div class="videoItem__thumb">';
echo      '<img src="', $postThumbnail, '"/>';
if($playbackTime) {
  echo       '<p class="time">', $playbackTime ,'</p>';
  echo       '<svg class="c-playMark" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 48 48" id="">';
  echo         '<path d="M48 24C48 37.2548 37.2548 48 24 48C10.7452 48 0 37.2548 0 24C0 10.7452 10.7452 0 24 0C37.2548 0 48 10.7452 48 24Z" fill="white"></path>';
  echo         '<path d="M31.5 21.4019C33.5 22.5566 33.5 25.4434 31.5 26.5981L22.5 31.7942C20.5 32.9489 18 31.5056 18 29.1962L18 18.8038C18 16.4944 20.5 15.0511 22.5 16.2058L31.5 21.4019Z" fill="#302D2A"></path>';
  echo       '</svg>';
}
echo     '</div>';
echo     '<div class="videoItem__content">';
echo       '<h3 class="videoItem__title ', $labLabel, '">', $postTitle, '</h3>';
echo       '<div class="c-writeInfo">';
echo         '<div class="writer">';
echo           '<div class="writerImg" data-src-bg="', $writerInfoThumbURL , '"></div>';
echo         '</div>';
echo         '<div class="writeInfo__body">';
echo           '<p class="name">', $writerInfoName, '</p>';
echo           '<p class="subInfo"><span class="date">', $date, '</span></p>';
echo         '</div>';
echo       '</div>';
echo     '</div>';
echo   '</a>';
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
          <div class="l-content js-pjax-content" id="video-list">
            <?php get_header(); ?>
            <div class="l-content__in is-dark">
              <section class="s-videoIntro">
                <div class="c-inner">
                  <h2 class="c-page-title-en-jp--center"><span class="en">Video</span><span class="ja">観る</span></h2>
                </div>
              </section>
              <section class="s-videos">
                <div class="new-video">
                  <div class="c-inner">
                    <h2 class="new-video__ttl">最新動画</h2>
                  </div>
                  <?php get_template_part("/parts/parts_new-video"); ?>
                </div>
                <div class="popular-video">
                  <div class="c-inner">
                    <h2 class="popular-video__ttl">よく観られている動画</h2>
                  </div>
                  <?php get_template_part("/parts/parts_popular-video"); ?>
                </div>
                <ul class="byCategory__list">
                  <li class="byCategory__item">
                    <div class="c-inner">
                      <div class="c-headlineArea">
                        <h2 class="c-headline--category"><span class="headline__line headline__line--category1"></span><span class="headline__txt"><span class="en">Innovation</span><span class="ja">イノベーション</span></span></h2><a class="c-detailLink detailLink" href="/category/innovation?type=video"><span class="detailLink__txt">もっと見る</span><span class="detailLink__icn">
                            <svg class="c-nextIcon" xmlns="http://www.w3.org/2000/svg" width="10" height="11" viewBox="0 0 10 11" id="">
                              <path d="M4.24264 1.00003L8.48528 5.24268L4.24264 9.48532" stroke="white" stroke-width="2" fill="none"></path>
                            </svg></span></a>
                      </div>
                    </div>
                    <div class="c-videos videos--for-lab videos">
                      <div class="swiper-video swiper-container">
                        <?php getVideoList('innovation'); ?>
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
                        <h2 class="c-headline--category"><span class="headline__line headline__line--category2"></span><span class="headline__txt"><span class="en">Management</span><span class="ja">経営・マネジメント</span></span></h2><a class="c-detailLink detailLink" href="/category/management?type=video"><span class="detailLink__txt">もっと見る</span><span class="detailLink__icn">
                            <svg class="c-nextIcon" xmlns="http://www.w3.org/2000/svg" width="10" height="11" viewBox="0 0 10 11" id="">
                              <path d="M4.24264 1.00003L8.48528 5.24268L4.24264 9.48532" stroke="white" stroke-width="2" fill="none"></path>
                            </svg></span></a>
                      </div>
                    </div>
                    <div class="c-videos videos--for-lab videos">
                      <div class="swiper-video swiper-container">
                        <?php getVideoList('management'); ?>
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
                        <h2 class="c-headline--category"><span class="headline__line headline__line--category3"></span><span class="headline__txt"><span class="en">Design</span><span class="ja">デザイン</span></span></h2><a class="c-detailLink detailLink" href="/category/design?type=video"><span class="detailLink__txt">もっと見る</span><span class="detailLink__icn">
                            <svg class="c-nextIcon" xmlns="http://www.w3.org/2000/svg" width="10" height="11" viewBox="0 0 10 11" id="">
                              <path d="M4.24264 1.00003L8.48528 5.24268L4.24264 9.48532" stroke="white" stroke-width="2" fill="none"></path>
                            </svg></span></a>
                      </div>
                    </div>
                    <div class="c-videos videos--for-lab videos">
                      <div class="swiper-video swiper-container">
                      <?php getVideoList('design'); ?>
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
                        <h2 class="c-headline--category"><span class="headline__line headline__line--category4"></span><span class="headline__txt"><span class="en">Learning</span><span class="ja">学習・人材育成</span></span></h2><a class="c-detailLink detailLink" href="/category/learning?type=video"><span class="detailLink__txt">もっと見る</span><span class="detailLink__icn">
                            <svg class="c-nextIcon" xmlns="http://www.w3.org/2000/svg" width="10" height="11" viewBox="0 0 10 11" id="">
                              <path d="M4.24264 1.00003L8.48528 5.24268L4.24264 9.48532" stroke="white" stroke-width="2" fill="none"></path>
                            </svg></span></a>
                      </div>
                    </div>
                    <div class="c-videos videos--for-lab videos">
                      <div class="swiper-video swiper-container">
                        <?php getVideoList('learning'); ?>
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
                        <h2 class="c-headline--category"><span class="headline__line headline__line--category5"></span><span class="headline__txt"><span class="en">Facilitation</span><span class="ja">ファシリテーション</span></span></h2><a class="c-detailLink detailLink" href="/category/facilitation?type=video"><span class="detailLink__txt">もっと見る</span><span class="detailLink__icn">
                            <svg class="c-nextIcon" xmlns="http://www.w3.org/2000/svg" width="10" height="11" viewBox="0 0 10 11" id="">
                              <path d="M4.24264 1.00003L8.48528 5.24268L4.24264 9.48532" stroke="white" stroke-width="2" fill="none"></path>
                            </svg></span></a>
                      </div>
                    </div>
                    <div class="c-videos videos--for-lab videos">
                      <div class="swiper-video swiper-container">
                        <?php getVideoList('facilitation'); ?>
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
              <section class="s-book-review">
                <div class="c-inner">
                  <h2 class="section-title"><span class="en">Book Review</span><span class="ja">講師陣による書評解説</span></h2>
                </div>
                <div class="c-videos videos--for-lab videos">
                  <div class="swiper-video swiper-container">
                  <?php get_template_part("/parts/parts_book-review"); ?>
                    <div class="swiper-button-prev">
                      <div class="arrow"></div>
                    </div>
                    <div class="swiper-button-next">
                      <div class="arrow"></div>
                    </div>
                  </div>
                </div><a class="btn" href="/book-review">BOOK一覧へ</a>
              </section>
              <section class="s-mostPopularAndTag">
                <div class="mostPopularAndTag__inner">
                  <?php get_template_part("/parts/parts_ranking-video-for-pc"); ?>
                  <?php get_template_part("/parts/parts_ranking-video"); ?>
                  <?php get_template_part("/parts/parts_tag-area"); ?>
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