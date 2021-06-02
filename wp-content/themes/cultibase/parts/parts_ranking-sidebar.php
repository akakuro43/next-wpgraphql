<?php 
 global $ARTICLE_PUBLICATION_DEADLINE;
 $limitDate = date("ymd", mktime(0, 0, 0, date("m"), date("d") - $ARTICLE_PUBLICATION_DEADLINE,   date("Y")));
?>
<section class="c-mostPopularSidebar">
  <div class="c-sub-inner">
    <div class="headlineArea">
      <h2 class="c-headline headline"><span class="en">Most Popular</span><span class="ja">ランキング トップ５</span></h2>
      <div class="switchBtns js-switchBtns is-article">
        <button class="switchBtn switchBtn--article js-switchBtn--article">Article</button>
        <button class="switchBtn switchBtn--video js-switchBtn--video">Video</button>
        <button class="switchBtn switchBtn--radio js-switchBtn--radio">Radio</button>
      </div>
    </div>
  </div>
  <div class="ranking">
    <ul class="ranking__list ranking__list--article js-ranking--article js-slideList is-ranking-in" data-slide-width="156" data-slide-offset="20">
      <?php
        $args = c_get_wpp_args(['post'], 'weekly', 5);
        $the_query = new WP_Query($args);
        while ($the_query->have_posts()):
          $the_query->the_post();
          $postThumbnail = get_the_post_thumbnail_url(null, 'medium_large');
      
          $postTitle = get_the_title();
          $isDot = mb_strlen($postTitle) > 28;
          $postTitle = mb_substr($postTitle, 0, 28);
          if($isDot) {
            $postTitle = $postTitle. "...";
          }
      
          // カテゴリー配列
          $categoryIdArry = Array(); 
          $categories = get_the_category();

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
      ?>
        <li class="ranking__item js-slideItem"><a class="itemLink" href="<?php echo get_the_permalink(); ?>">
            <div class="itemThumb"><img src="<?php echo $postThumbnail; ?>" alt=""></div>
            <div class="itemBody">
              <h3 class="ttl <?php echo $labLabel; ?>"><?php echo $postTitle; ?></h3>
              <p class="subInfo"><span class="date"><?php echo $date; ?></span> / <span class="readTime"><?php echo get_field('read_time'); ?></span>min read</p>
            </div></a></li>
      <?php endwhile;?>
    </ul>
    <ul class="ranking__list ranking__list--video js-ranking--video js-slideList" data-slide-width="156" data-slide-offset="20">
      <?php
        $args = c_get_wpp_args(['paid-video', 'free-video'], 'weekly', 5);
        $the_query = new WP_Query($args);
        while ($the_query->have_posts()):
          $the_query->the_post();
          $postThumbnail = get_the_post_thumbnail_url(null, 'medium_large');
      
          $postTitle = get_the_title();
          $isDot = mb_strlen($postTitle) > 28;
          $postTitle = mb_substr($postTitle, 0, 28);
          if($isDot) {
            $postTitle = $postTitle. "...";
          }
      
          // カテゴリー配列
          $categoryIdArry = Array(); 
          $categories = get_the_category();

          $date = get_the_date('Y.m.d');

          // 期限切れフラグ（true：切れ）
          $postType = get_post_type( $videoId );
          $labLabel = ($postType != 'free-video') ? 'c-label-lab' : '';
      ?>
        <li class="ranking__item js-slideItem"><a class="itemLink" href="<?php echo get_the_permalink(); ?>">
            <div class="itemThumb"><img src="<?php echo $postThumbnail; ?>" alt=""></div>
            <div class="itemBody">
              <h3 class="ttl <?php echo $labLabel; ?>"><?php echo $postTitle; ?></h3>
              <p class="subInfo"><span class="date"><?php echo $date; ?></span> / <span class="readTime"><?php echo get_field('playback_time');?></span></p>
            </div></a></li>
      <?php endwhile;?>
    </ul>
    <ul class="ranking__list ranking__list--radio js-ranking--radio js-slideList" data-slide-width="156" data-slide-offset="20">
      <?php
          $args = c_get_wpp_args(['radio'], 'weekly', 5);
          $the_query = new WP_Query($args);
          while ($the_query->have_posts()):
            $the_query->the_post();
            $postThumbnail = get_the_post_thumbnail_url(null, 'medium_large');
        
            $postTitle = get_the_title();
            $isDot = mb_strlen($postTitle) > 28;
            $postTitle = mb_substr($postTitle, 0, 28);
            if($isDot) {
              $postTitle = $postTitle. "...";
            }
        
            // カテゴリー配列
            $categoryIdArry = Array(); 
            $categories = get_the_category();

            $date = get_the_date('Y.m.d');

            $radioTypeId= get_field('radio_type');
            $thumb = get_field('tectangle_thumb', $radioTypeId);
        ?>
          <li class="ranking__item js-slideItem"><a class="itemLink" href="<?php echo get_the_permalink(); ?>">
              <div class="itemThumb"><img src="<?php echo $thumb; ?>" alt=""></div>
                <div class="itemBody">
                    <h3 class="ttl"><?php echo $postTitle; ?></h3>
                    <p class="subInfo"><span class="date"><?php echo $date; ?></span> / <span class="readTime"><?php echo get_field('playback_time');?></span></p>
          </div></a></li>
        <?php endwhile;?>
    </ul>
  </section>