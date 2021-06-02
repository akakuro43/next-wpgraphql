<section class="s-findLaboTheme">
  <div class="c-inner">
    <div class="s-findLaboTheme__top u-sp-only">CULTIBASE編集部がテーマごとに<br>動画・記事・音声コンテンツを<br>厳選してまとめました。</div>
    <div class="c-headlineArea__Lab">
      <h2 class="s-findLaboTheme__heading">コンテンツパッケージ</span></h2>
      <div class="s-findLaboTheme__note">
        <p class="u-pc-only">CULTIBASE編集部がテーマごとに動画・記事・音声コンテンツを厳選してまとめました。</p><a class="c-detailLink" href="/set-list/"><span class="detailLink__txt">もっと見る</span><span class="detailLink__icn">
            <svg class="c-nextIcon" xmlns="http://www.w3.org/2000/svg" width="10" height="11" viewBox="0 0 10 11" id="">
              <path d="M4.24264 1.00003L8.48528 5.24268L4.24264 9.48532" stroke="black" stroke-width="2" fill="none"></path>
            </svg></span></a>
      </div>
    </div>
    <div class="swiper-articles--find-lab-theme swiper-container">
      <ul class="swiper-wrapper find-lab-theme-list js-slideList" data-slide-width="256" data-slide-offset="10">
      <?php
        $query = new WP_Query(array(
          'post_type' => ['set-list'],
          'posts_per_page' => '6',
          'has_password' => false,
          'paged' => get_query_var('paged'),
          // 'category_name' => get_query_var('category_name')
        ));
        while($query -> have_posts()): $query -> the_post();
        $postThumbnail = get_the_post_thumbnail_url(null, 'medium_large');
        
        $postTitle = get_the_title();
        
        $description = get_field('description');
        $isDot = mb_strlen($description) > 90;
        $description = mb_substr($description, 0, 90);
        if($isDot) {
          $description = $description. "...";
        }
      ?>
        <li class="labItem swiper-slide js-slideItem"><a class="labItem__wrap" href="<?php the_permalink(); ?>"><img class="labItem__thumb" src="<?php echo $postThumbnail; ?>">
            <div class="labItem__content">
              <h3 class="labItem__title c-label-lab"><?php echo $postTitle; ?></h3>
              <p class="labItem__desc"><? echo $description; ?></p>
            </div></a></li>
      <?php
        endwhile;
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
</section>