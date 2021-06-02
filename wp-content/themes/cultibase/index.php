<?php get_template_part("/parts/parts_head");

$loginFlg = getSessionLoginFlg();

function getArticleList($categoryName) {
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

      echo '<li class="articles__item swiper-slide js-slideItem">';
      echo  '<a class="itemLink" href="', the_permalink(), '">';
      echo    '<div class="itemThumb">', $postThumbnail, '</div>';
      echo    '<div class="itemBody">';
      echo      '<h3 class="ttl">', $postTitle, '</h3>';
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
        <div class="l-content js-pjax-content" id="home">
          <?php get_header(); ?>
          <div class="l-content__in">
            <section class="s-pickup">
              <div class="pickup__bg" data-src-bg="<?php bloginfo('template_url'); ?>/assets/images/pc/top/bg_kv_img.png"></div>
              <div class="pickup__inner">
                <?php
                    $args = array(
                        'post_type' => ['post', 'video'],
                        'posts_per_page' => 1,
                        'meta_query' => array(array(
                          'key' => 'keyvisual_flag',
                          'value' => '1',
                      ))
                     );
                    $the_query = new WP_Query($args);
                    if ($the_query->have_posts()) :
                      while ($the_query->have_posts()) : $the_query->the_post();
                      $postTitle = get_the_title();
                      $keyvisualThumbPC = get_field('keyvisual_thumb_pc');
                      $keyvisualThumbSP = get_field('keyvisual_thumb_sp');
                  ?>
                <div class="pickup__main">
                  <a class="link" href="<?php the_permalink(); ?>">
                    <div class="pickup__mainThumb u-pc-only">
                      <img src="<?php echo $keyvisualThumbPC; ?>" alt="<?php echo $postTitle; ?>">
                    </div>
                    <div class="pickup__mainThumb u-sp-only">
                      <img src="<?php echo $keyvisualThumbSP; ?>" alt="<?php echo $postTitle; ?>">
                    </div>
                  </a>
                </div>
                <?php
                  endwhile;
                  endif;
                ?>
              </div>
            </section>
            <section class="s-recommendedEvents">
                <div class="c-inner inner">
                  <div class="c-headlineArea headlineArea">
                    <h2 class="c-headline u-pc-only">イベントのスケジュール</h2>
                    <h2 class="c-headline u-sp-only">イベントスケジュール</h2>
                      <a class="c-detailLink" href="/event">
                        <span class="detailLink__txt">もっと見る</span>
                        <span class="detailLink__icn">
                          <svg class="c-nextIcon" xmlns="http://www.w3.org/2000/svg" width="10" height="11" viewBox="0 0 10 11" id="">
                            <path d="M4.24264 1.00003L8.48528 5.24268L4.24264 9.48532" stroke="black" stroke-width="2" fill="none"></path>
                          </svg>
                        </span>
                    </a>
                  </div>
                  <div class="recommendedEvents swiper-articles--find-lab-theme swiper-container">
                    <ul class="recommendedEvents__list swiper-wrapper js-slideList">
                    <?php
                      $today = date("Y/m/d");
                      $query = new WP_Query(array(
                        'post_type' => ['live-event', 'watch-party'],
                        'posts_per_page' => '6',
                        'has_password' => false,
                        'paged' => get_query_var('paged'),
                        'meta_query' => array(array(
                          'key' => 'date',
                          'value' => $today,
                          'compare' => '>=',
                          'type' => 'DATE'
                        ))
                          
                      ));
                      while($query -> have_posts()): $query -> the_post();
                      $id = get_the_id();
                      $startTime = get_field('start_time');
                      $endTime = get_field('end_time');

                      $eventDate = date_create(get_field('date'));
                      $week = array("日", "月", "火", "水", "木", "金", "土");
                      $w = (int)date_format($eventDate, 'w');
                      $youbi = $week[$w];

                      $postThumbnail = get_the_post_thumbnail_url($id, 'large');

                      $labFlag = get_field('lab_flag');
                      $labLabel = $labFlag ? 'c-label-lab' : '';

                      $postTitle = get_the_title();
                      $isDot = mb_strlen($postTitle) > 45;
                      $postTitle = mb_substr($postTitle, 0, 45);
                      if($isDot) {
                        $postTitle = $postTitle. "...";
                      }

                      $eventUrl = get_field('event_url');
                      $youtube_liveUrl = get_field('youtube_live_url');
                      // print_r($newsCategory);
                    ?>
                      <li class="recommendedEvents__item swiper-slide js-slideItem">
                        <div class="recommendedEvents__datetime"><?php echo date_format($eventDate,'Y.m.d'); ?>(<?php echo $youbi; ?>)<span class="recommendedEvents__time"><?php echo $startTime; ?> ~ <?php echo $endTime; ?></span></div><a class="recommendedEvents__link" href="<?php echo the_permalink(); ?>"><img class="recommendedEvents__thumb" src="<?php echo $postThumbnail; ?>">
                          <div class="recommendedEvents__title <?php echo $labLabel; ?>"><?php echo $postTitle; ?></div></a>
                          <?php if($loginFlg) :?>
                          <a class="btn-regist-calendar" href="https://www.google.com/calendar/render?action=TEMPLATE&amp;text=<?php echo $postTitle; ?>&amp;dates=<?php echo date_format($eventDate,'Ymd'); ?>T<?php echo str_replace(':','',$startTime); ?>00/<?php echo date_format($eventDate,'Ymd'); ?>T<?php echo str_replace(':','',$endTime); ?>00&amp;location=<?php echo $eventUrl ?>&amp;trp=true&amp;trp=undefined&amp;trp=true&amp;sprop=" target="_blank"><span class="icn">
                            <svg class="c-calendar" xmlns="http://www.w3.org/2000/svg" width="11" height="10" viewBox="0 0 13 11" id="">
                              <path d="M9.53407 7.64431V8.92303C9.53407 9.4234 9.1171 9.84037 8.61673 9.84037H5.05855H1.91734C1.41697 9.84037 1 9.4234 1 8.92303V2.19585C1 1.69548 1.41697 1.2785 1.91734 1.2785H3.05707" stroke="white" stroke-width="0.8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path d="M7.50391 1.2785H8.64364C9.14401 1.2785 9.56098 1.69548 9.56098 2.19585V4.86448" stroke="white" stroke-width="0.8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path d="M3.05859 1.2785H7.50632" stroke="white" stroke-width="0.8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path d="M1 3.64148H9.53407" stroke="white" stroke-width="0.8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path d="M3.05859 1.86232V0.666992" stroke="white" stroke-width="0.8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path d="M7.50391 1.86232V0.666992" stroke="white" stroke-width="0.8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path d="M8.86503 8.31153L11.895 5.28151C12.034 5.14252 12.034 4.92014 11.895 4.78115L11.0055 3.9194C10.8665 3.78041 10.6441 3.78041 10.5051 3.9194L7.50291 6.94941L7.08594 8.7285L8.86503 8.31153Z" stroke="white" stroke-width="0.8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path d="M9.72656 4.69772L11.0887 6.08764" stroke="white" stroke-width="0.8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path d="M7.50391 6.94937L8.86602 8.31149" stroke="white" stroke-width="0.8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg></span><span class="txt">Goolge カレンダーに登録</span></a>
                          <?php endif; ?>
                      </li>
                      <?php endwhile; ?>
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
            <!--
              メインの記事
            -->
            <section class="s-mainArticles">
                <div class="c-headlineArea headlineArea">
                  <h2 class="c-headline headline"><span class="en">Article</span><span class="ja">読む</span></h2>
                </div>
                <div class="article-new-arrival-and-popularity">
                  <div class="new-arrival">
                    <div class="c-inner">
                      <div class="title">最新記事</div>
                    </div>
                    <?php get_template_part("/parts/parts_new-articles"); ?>
                  </div>
                  <div class="popularity">
                    <div class="c-inner">
                      <div class="title">よく読まれている記事</div>
                    </div>
                    <?php get_template_part("/parts/parts_popular-articles"); ?>
                  </div>
                </div><a class="btn" href="/articles/">記事一覧へ</a>
              </section>
              <?php get_template_part("/parts/parts_find_lab_theme"); ?>
              <section class="s-video">
                <div class="c-inner--s">
                  <?php if(!$loginFlg) : ?>
                    <a href="/lab" target="_blank"><img class="banner u-sp-only" src="<?php bloginfo('template_url'); ?>/assets/images/sp/top/img_video_section_banner.png" alt=""></a>
                  <?php endif; ?>
                  <div class="c-headlineArea headlineArea">
                    <h2 class="c-headline headline"><span class="en">Video</span><span class="ja">観る</span></h2>
                  </div>
                  <?php if(!$loginFlg) : ?>
                    <a href="/lab" target="_blank"><img class="banner u-pc-only" src="<?php bloginfo('template_url'); ?>/assets/images/pc/top/img_video_section_banner.png" alt=""></a>
                  <?php endif; ?>
                </div>
                <div class="video-list">
                  <div class="c-inner">
                    <h2 class="title">新着動画</h2>
                  </div>
                  <?php get_template_part("/parts/parts_new-video"); ?>
                </div>
                <div class="video-list">
                  <div class="c-inner">
                    <h2 class="title">人気動画</h2>
                  </div>
                  <?php get_template_part("/parts/parts_popular-video"); ?>
                </div><a class="btn" href="/video/">動画一覧へ</a>
              </section>
              <section class="s-radio">
                <div class="c-inner--s">
                  <div class="c-headlineArea headlineArea">
                    <h2 class="c-headline headline"><span class="en">Radio</span><span class="ja">聴いて学ぶ</span></h2>
                  </div>
                </div>
                <div class="c-inner--s inner">
                  <div class="radioArticles">
                    <ul class="radioArticle__list js-slideList" data-slide-width="160" data-slide-offset="-10">
                    <?php
                        $query = new WP_Query(array(
                          'post_type' => ['radio'],
                          'posts_per_page' => '4',
                          'has_password' => false,
                          'paged' => get_query_var('paged'),
                          'category_name' => get_query_var('category_name')
                        ));
                        while($query -> have_posts()): $query -> the_post();
                          //  日時
                          $date = get_the_date('Y.m.d');
                          // ライター情報
                          $writerInfo = get_field('writer')[0];
                          $writerInfoName = get_field('writer_name',$writerInfo);
                          $writerInfoThumbURL = get_field('writer_thumb',$writerInfo);
                          // サムネイル
                          // $radioThumbs = get_field('radio_thumb');
                          // $thumb = get_field('square_thumb', $radioThumbs);
                          $radioTypeId = get_field('radio_type');
                          // $radioTtl = get_field('title', $radioTypeId);
                          $radioThumbUrl = get_field('square_thumb', $radioTypeId);
                          // タイトル
                          $postTitle = get_the_title();
                          $isDot = mb_strlen($postTitle) > 56;
                          $postTitle = mb_substr($postTitle, 0, 56);
                          if($isDot) {
                            $postTitle = $postTitle. "...";
                          }
                        ?>
                      <li class="radioArticle__item js-slideItem"><a class="itemLink" href="<?php the_permalink(); ?>">
                          <div class="itemThumb">
                            <div class="itemThumb__bg" data-src-bg="<?php echo $radioThumbUrl; ?>"></div>
                          </div>
                          <div class="itemBody">
                            <h2 class="ttl"><?php echo $postTitle;?></h2>
                            <div class="c-writeInfo">
                              <div class="writer">
                                <div class="writerImg" data-src-bg="<?php echo $writerInfoThumbURL;?>" alt=""></div>
                              </div>
                              <div class="writeInfo__body">
                                <p class="name"><?php echo $writerInfoName;?></p>
                                <p class="subInfo"><span class="date"><?php echo $date; ?></span></p>
                              </div>
                            </div>
                          </div></a></li>
                          <?php endwhile; ?>
                    </ul>
                  </div><a class="btn" href="/radio/">ラジオ一覧へ</a>
                </div>
              </section>
              <!-- <section class="s-sns">
                <div class="c-inner--s inner">
                  <div class="sns_fb">
                    <h2 class="fb_ttl">FACEBOOK</h2>
                    <div class="sns_content">
                      <div id="fb-root"></div>
                      <script async="" defer="" crossorigin="anonymous" src="https://connect.facebook.net/ja_JP/sdk.js#xfbml=1&amp;version=v10.0" nonce="IV0tSOHO"></script>
                      <div class="fb-page" data-href="https://www.facebook.com/cultibase.jp" data-tabs="timeline" data-width="480" data-height="400" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                        <blockquote class="fb-xfbml-parse-ignore" cite="https://www.facebook.com/cultibase.jp"><a href="https://www.facebook.com/cultibase.jp">CULTIBASE</a></blockquote>
                      </div>
                    </div>
                  </div>
                  <div class="sns_tw">
                    <h2 class="tw_ttl">TWITTER</h2>
                    <div class="sns_content"><a class="twitter-timeline" href="https://twitter.com/cultibase?ref_src=twsrc%5Etfw">Tweets by cultibase</a>
                      <script async="" src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </div>
                  </div>
                </div>
              </section> -->
            </div>
          <?php get_footer(); ?>
        </div>
      </div>
    </main>
    <div class="js-pjax-sub-content1"></div>
  </div>
  <?php get_template_part("/parts/parts_scripts"); ?>
</body>
</html>
