
<?php get_template_part("/parts/parts_head"); 
  
  $cat = get_queried_object();
  $catName = $cat -> name;
  $catSlug = $cat -> slug;

  $url = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  parse_str(parse_url($url, PHP_URL_QUERY), $query);
  if (isset($query)) {
    $contentsType = $query['type'];
  }
  $postTypeAry;
  switch ($contentsType) {
    case 'article':
      $postTypeAry = ['post'];
      break;
    case 'video':
      $postTypeAry = ['paid-video', 'free-video', 'book-review'];
      break;
    case 'radio':
      $postTypeAry = ['radio'];
      break;
    case 'event':
      $postTypeAry = ['live-event', 'watch-party'];
      break;
    default:
      $contentsType = 'all';
      $postTypeAry = ['paid-video', 'free-video', 'book-review', 'live-event', 'watch-party', 'radio', 'post'];
      break;
  }

?>
  <body>
    <?php get_template_part("/parts/parts_gtm_body_under"); ?>
    <div class="l-app">
      
      <main>
        <div class="l-contents js-pjax-contents" data-scroll-section>
          <div class="l-content js-pjax-content" id="category">
            <?php get_header(); ?>
            <div class="l-content__in">
              <div class="frame">
                <div class="frame__main">
                  <section class="s-categoryTop">
                    <div class="c-main-inner">
                        <h2 class="categoryPageTtl">
                          <span class="categoryPageTtl__line categoryPageTtl__line-<?php echo $catSlug; ?>"></span>
                          <span class="categoryPageTtl__txt"><span class="en"><?php echo ucfirst(strtolower($catSlug)); ?></span>
                          <span class="ja"><?php echo $catName; ?></span></span>
                        </h2>
                    </div>
                  </section>
                  <section class="s-tabarea">
                    <div class="c-tabarea">
                      <ul class="tabs tabs--<?php echo $contentsType; ?>">
                        <li class="tab tab--all"><a class="link" href="/category/<?php echo $catSlug; ?>">全て</a></li>
                        <li class="tab tab--article"><a class="link" href="/category/<?php echo $catSlug; ?>?type=article">記事</a></li>
                        <li class="tab tab--video"><a class="link" href="/category/<?php echo $catSlug; ?>?type=video">動画</a></li>
                        <li class="tab tab--radio"><a class="link" href="/category/<?php echo $catSlug; ?>?type=radio">ラジオ</a></li>
                        <li class="tab tab--event"><a class="link" href="/category/<?php echo $catSlug; ?>?type=event">イベント</a></li>
                      </ul>
                    </div>
                  </section>
                  <section class="s-articles">
                    <div class="c-articles-horizontal">
                      <div class="c-main-inner">
                        <?php 
                          $query = new WP_Query(array(
                            'post_type' => $postTypeAry,
                            'posts_per_page' => 10,
                            'has_password' => false,
                            'orderby'          => 'date', // ソートの基準
                            'order'            => 'DESC', // DESC降順　ASC昇順
                            'paged' => get_query_var('paged'),
                            'category_name' => get_query_var('category_name')
                          ));
                          $all_num = $query->found_posts;
                        ?>
                        <p class="hit-num"><?php echo $all_num; ?>件</p>
                        <ul class="article__list">
                          <?php
                            while($query -> have_posts()): $query -> the_post();
                            
                            $postTypeName;
                            $labLabel = '';
                            $postType = get_post_type();
                            switch ($postType) {
                              case 'free-video':
                                $postTypeName = 'Video';
                                break;
                              case 'paid-video':
                              case 'book-review':
                                $postTypeName = 'Video';
                                $labLabel = 'c-label-lab';
                                break;
                              case 'radio':
                                $postTypeName = 'Radio';
                                break;
                              case 'live-event':
                              case 'watch-party':
                                $postTypeName = 'Event';
                                $labFlag = get_field('lab_flag');
                                $labLabel = $labFlag ? 'c-label-lab' : '';
                                break;
                              default:
                                $postTypeName = 'Article';
                                break;
                            }

                            // カテゴリー配列
                            $categories = get_the_category();
                            // タイトル
                            $postTitle = get_the_title();
                            $isDot = mb_strlen($postTitle) > 56;
                            $postTitle = mb_substr($postTitle, 0, 56);
                            if($isDot) {
                              $postTitle = $postTitle. "...";
                            }

                            $date = get_the_date('Y.m.d');

                            $thumb = null;
                            if($postType == "radio") {
                              $radioTypeId= get_field('radio_type');
                              $thumb = get_field('tectangle_thumb', $radioTypeId);
                            } else {
                              $thumb = get_the_post_thumbnail_url();
                            }

                          ?>
                          <li class="article__item"><a class="itemLink" href="<?php echo get_the_permalink(); ?>">
                              <div class="itemBody">
                                <div class="itemBody__inner">
                                  <p class="contents-type"><?php echo $postTypeName; ?></p>
                                  <ul class="c-category__list category__list u-pc-only">
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
                                </div>
                                <h3 class="ttl <?php echo $labLabel; ?>"><?php echo $postTitle; ?></h3>
                                <?php if($postTypeName == 'Radio'): ?>

                                  <p class="radio-info"><span class="date-playback-time"><?php echo $date;?> / <?php echo get_field('playback_time');?></span></p>
                                <?php elseif ($postTypeName == 'Event'): ?>
                                  <p class="event-info"><span class="date">日時：<?php echo date_format(date_create(get_field('date')),'Y/m/d'); ?></span><span class="time"><?php echo get_field('start_time'); ?> - <?php echo get_field('end_time'); ?></span></p>
                                <?php
                                  else:
                                  // ライター情報
                                  $writerInfoId = get_field('writer')[0];
                                  $writerInfoName = get_field('writer_name',$writerInfoId);
                                  $writerInfoThumbURL = get_field('writer_thumb',$writerInfoId);
                                
                                ?>
                                  <div class="c-writeInfo">
                                    <div class="writer">
                                      <div class="writerImg" data-src-bg="<?php echo $writerInfoThumbURL;?>" alt=""></div>
                                    </div>
                                    
                                    <div class="writeInfo__body">
                                      <p class="name"><?php echo $writerInfoName; ?></p>
                                      <p class="subInfo"><span class="date"><?php echo $date; ?></span></p>
                                    </div>
                                  </div>
                                <?php endif; ?>
                              </div>
                              <div class="itemThumb">
                                <div class="itemThumb__bg" data-src-bg="<?php echo $thumb; ?>"></div>
                              </div></a>
                            </li>
                          <?php
                            endwhile;
                          ?>
                        </ul>
                          <?php pagination($query->max_num_pages, get_query_var( 'paged' )); ?>
                          <?php wp_reset_postdata(); ?>
                      </div>
                    </div>
                  </section>
                </div>
                <div class="frame__sub">
                  <?php get_template_part("/parts/parts_tag-area"); ?>
                  <div class="frame__sub__line"></div>
                  <?php get_template_part("/parts/parts_ranking-sidebar"); ?>
                </div>
              </div>
            </div>
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