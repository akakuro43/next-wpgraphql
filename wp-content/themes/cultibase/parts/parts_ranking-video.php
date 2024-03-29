<section class="c-mostPopularArea">
  <div class="c-sub-inner">
    <div class="headlineArea">
      <h2 class="c-headline headline"><span class="en">Most Popular</span><span class="ja">ランキング トップ５</span></h2>
      <div class="switchBtns js-switchBtns is-weekly">
        <button class="switchBtn switchBtn--weekly js-switchBtn--weekly">Weekly</button>
        <button class="switchBtn switchBtn--monthly js-switchBtn--monthly">Monthly</button>
      </div>
    </div>
  </div>
  <div class="ranking">
    <ul class="ranking__list ranking__list--weekly js-ranking--weekly js-slideList is-ranking-in" data-slide-width="156" data-slide-offset="20">
    <li class="ranking__item js-slideItem">
        <ul class="tag__item-inner">
        <?php
          $args = c_get_wpp_args(['paid-video', 'free-video'], 'weekly', 5);
          $the_query = new WP_Query($args);
          while ($the_query->have_posts()):
            $the_query->the_post();
            $postThumbnail = get_the_post_thumbnail_url(null, 'medium_large');
      
            $postTitle = get_the_title();
            $isDot = mb_strlen($postTitle) > 45;
            $postTitle = mb_substr($postTitle, 0, 45);
            if($isDot) {
              $postTitle = $postTitle. "...";
            }
      
            // カテゴリー配列
            $categoryIdArry = Array(); 
            $categories = get_the_category();
        ?>
        <li class="ranking__item js-slideItem"><a href="<?php echo get_the_permalink(); ?>"><article class="itemLink">
        <div class="itemThumb">
          <img src="<?php echo $postThumbnail; ?>" alt=""/>
        </div>
        <div class="itemBody"><ul class="category__list u-pc-only ">
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
            <h3 class="ttl"><?php echo $postTitle; ?></h3></div>
            </article></a></li>
          <?php endwhile;?>
        </ul>
      </li>
    </ul>

    <ul class="ranking__list ranking__list--monthly js-ranking--monthly js-slideList" data-slide-width="156" data-slide-offset="20">
    <li class="ranking__item js-slideItem">
        <ul class="tag__item-inner">
        <?php
          $args = c_get_wpp_args(['paid-video', 'free-video'], 'monthly', 5);
          $the_query = new WP_Query($args);
          while ($the_query->have_posts()):
            $the_query->the_post();
            $postThumbnail = get_the_post_thumbnail_url(null, 'medium_large');
      
            $postTitle = get_the_title();
            $isDot = mb_strlen($postTitle) > 45;
            $postTitle = mb_substr($postTitle, 0, 45);
            if($isDot) {
              $postTitle = $postTitle. "...";
            }
      
            // カテゴリー配列
            $categoryIdArry = Array(); 
            $categories = get_the_category();
        ?>
        <li class="ranking__item js-slideItem"><a href="<?php echo get_the_permalink(); ?>"><article class="itemLink">
        <div class="itemThumb">
          <img src="<?php echo $postThumbnail; ?>" alt=""/>
        </div>
        <div class="itemBody"><ul class="category__list u-pc-only ">
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
            <h3 class="ttl"><?php echo $postTitle; ?></h3></div>
            </article></a></li>
          <?php endwhile;?>
        </ul>
      </li>
    </ul>
  </div>
</section>
