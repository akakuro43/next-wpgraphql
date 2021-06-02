<div class="c-articles articles">
  <div class="swiper-articles swiper-container">
    <ul class="articles__list swiper-wrapper js-slideList">
<?php
  global $ARTICLE_PUBLICATION_DEADLINE;
  $limitDate = date("ymd", mktime(0, 0, 0, date("m"), date("d") - $ARTICLE_PUBLICATION_DEADLINE,   date("Y")));

  $args = array(
      'post_type' => ['post'],
      'posts_per_page' => 12,
      'orderby' => 'date',
      'post_status' => 'publish',
      'order' => 'DESC'
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

      // カテゴリー配列
      $categoryIdArry = Array(); 
      $categories = get_the_category();

      echo '<li class="articles__item swiper-slide js-slideItem">';
      echo  '<a class="itemLink" href="', the_permalink(), '">';
      echo    '<div class="itemThumb">', $postThumbnail, '</div>';
      echo       '<ul class="c-category__list">';
              if ( $categories ) :
                foreach ( $categories as $category ) :
                  $catName = $category->name;
                  $catSlug = $category->slug;
                  $categoryIdArry = array_merge($categoryIdArry, array($category->term_id));
      echo                '<li class="c-category__item">';
      echo                  '<p class="category category-'.$catSlug. '">'. $catName. '</p>';
      echo                 '</li>';
                endforeach; endif;
      echo            '</ul>';
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
?>  
    </ul>
    <div class="swiper-button-prev">
      <div class="arrow"></div>
    </div>
    <div class="swiper-button-next">
      <div class="arrow"></div>
    </div>
  </div>
</div>