<?php 
  global $ARTICLE_PUBLICATION_DEADLINE;
  $limitDate = date("ymd", mktime(0, 0, 0, date("m"), date("d") - $ARTICLE_PUBLICATION_DEADLINE,   date("Y")));

  $date = get_the_date('Y.m.d');
  // 読むのにかかる時間
  $readTime = get_field('read_time');
  // ポストタイプ
  $postType = get_post_type();
  // echo $postType;
  // ライター情報
  $writerInfoId = get_field('writer')[0];
  $writerInfoName = get_field('writer_name',$writerInfoId);
  $writerInfoThumbURL = get_field('writer_thumb',$writerInfoId);

  // サムネイル
  $thumb = null;
  if($postType == "radio") {
    $radioThumbs = get_field('radio_thumb');
    $thumb = get_field('square_thumb', $radioThumbs);
  } else {
    $thumb = get_the_post_thumbnail_url();
  }
  

  // カテゴリー配列
  $categories = get_the_category();

  $postTitle = get_the_title();
  $isDot = mb_strlen($postTitle) > 56;
  $postTitle = mb_substr($postTitle, 0, 56);
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

<li class="article__item <?php if($postType == "radio") { echo "article__item--radio"; } ?>">
  <a class="itemLink" href="<?php the_permalink(); ?>">
    <div class="itemBody">
      <ul class="c-category__list u-pc-only">
        <?php 
          if ( $categories ) :
            foreach ( $categories as $category ) :
              $catName = $category->name;
              $catSlug = $category->slug;
        ?>
          <li class="c-category__item">
            <p class="category category-<?php echo $catSlug; ?>"><?php echo $catName; ?></p>
          </li>
        <?php endforeach; endif; ?>
      </ul>
      <h3 class="ttl <?php echo $labLabel; ?>"><?php echo $postTitle; ?></h3>
      <div class="c-writeInfo">
        <div class="writer">
          <div class="writerImg" data-src-bg="<?php echo $writerInfoThumbURL; ?>" alt="<?php echo $writerInfoName; ?>"></div>
        </div>
        <div class="writeInfo__body">
          <p class="name"><?php echo $writerInfoName; ?></p>
          <p class="subInfo">
            <span class="date"><?php echo $date; ?></span>
            <?php if($postType != "radio" && $readTime) : ?>
              <span> / <span class="readTime"><?php echo $readTime; ?></span>min read</span>
            <?php endif; ?>
          </p>
        </div>
      </div>
    </div>
    <div class="itemThumb">
      <div class="itemThumb__bg" data-src-bg="<?php echo $thumb; ?>"></div>
    </div>
  </a>
</li>