<?php

  echo '<ul class="videoList swiper-wrapper js-slideList">';

  $args = array(
      'post_type' => ['book-review'],
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
      // カテゴリー配列
      $categoryIdArry = Array(); 
      $categories = get_the_category($videoId);

echo '<li class="videoItem swiper-slide js-slideItem">';
echo  '<a href="', the_permalink(), '">';
echo     '<div class="videoItem__thumb">';
echo      '<img src="', $postThumbnail, '"/>';
echo       '<p class="time">', $playbackTime ,'</p>';
echo       '<svg class="c-playMark" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 48 48" id="">';
echo         '<path d="M48 24C48 37.2548 37.2548 48 24 48C10.7452 48 0 37.2548 0 24C0 10.7452 10.7452 0 24 0C37.2548 0 48 10.7452 48 24Z" fill="white"></path>';
echo         '<path d="M31.5 21.4019C33.5 22.5566 33.5 25.4434 31.5 26.5981L22.5 31.7942C20.5 32.9489 18 31.5056 18 29.1962L18 18.8038C18 16.4944 20.5 15.0511 22.5 16.2058L31.5 21.4019Z" fill="#302D2A"></path>';
echo       '</svg>';
echo     '</div>';
echo     '<div class="videoItem__content">';
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

?>

