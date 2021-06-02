
<?php get_template_part("/parts/parts_head");
  $searchWord = '';
  $url = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  parse_str(parse_url($url, PHP_URL_QUERY), $query);
  if (isset($query)) {
    $contentsType = $query['type'];
    $searchWord = $query['s'];
  }
  $contentsType = $contentsType == null ? 'all' : $contentsType;

  $resultPostIdAry = [];
  $numAll = $numArticle = $numVideo = $numRadio = $numEvent = 0;
  while ( have_posts() ) : the_post();

    $postTypeName;
    $postType = get_post_type();
    switch ($postType) {
      case 'free-video':
      case 'paid-video':
      case 'book-review':
        $postTypeName = 'video';
        $numVideo++;
        break;
      case 'radio':
        $postTypeName = 'radio';
        $numRadio++;
        break;
      case 'live-event':
      case 'watch-party':
        $postTypeName = 'event';
        $numEvent++;
        break;
      case 'post':
        $postTypeName = 'article';
        $numArticle++;
        break;
      default:
        $postTypeName = 'other';
        break;
    }

    // 記事、動画、ラジオ、イベント以外ならリターン
    if($postTypeName == 'other') continue;
    // 各タブを選択した際の絞り込み
    if($contentsType == 'video') {
      if($postTypeName != 'video') continue;
    } else if($contentsType == 'article') {
      if($postTypeName != 'article') continue;
    } else if($contentsType == 'radio') {
      if($postTypeName != 'radio') continue;
    } else if($contentsType == 'event') {
      if($postTypeName != 'event') continue;
    }
    $post_id = get_the_ID();
    array_push($resultPostIdAry,$post_id);
    $numAll++;
  endwhile;
?>
  <body>
    <?php get_template_part("/parts/parts_gtm_body_under"); ?>
    <div class="l-app">
      <main>
      <p>search.phpファイル</p>
      <h2><?php the_search_query(); ?>の検索結果 : <?php echo $wp_query->found_posts; ?>件</h2>

        <div class="l-contents js-pjax-contents" data-scroll-section>
          <div class="l-content js-pjax-content" id="tag-single">
            <?php get_header(); ?>
            <div class="l-content__in">
              <div class="frame">
                <div class="frame__main">
                <section class="s-tagSingle">
                  <?php

                  ?>
                    <div class="c-main-inner">
                    </div>
                    <div class="c-tabarea" style="margin-top: 0px;">
                      <ul class="tabs tabs--<?php echo $contentsType; ?>">
                        <li class="tab tab--all"><a class="link" href="/?s=<?php echo $searchWord; ?>">全て</a></li>
                        <?php if($numArticle > 0): ?><li class="tab tab--article"><a class="link" href="/?s=<?php echo $searchWord; ?>&type=article">記事</a></li><?php endif; ?>
                        <?php if($numVideo > 0): ?><li class="tab tab--video"><a class="link" href="/?s=<?php echo $searchWord; ?>&type=video">動画</a></li><?php endif; ?>
                        <?php if($numRadio > 0): ?><li class="tab tab--radio"><a class="link" href="/?s=<?php echo $searchWord; ?>&type=radio">ラジオ</a></li><?php endif; ?>
                        <?php if($numEvent > 0): ?><li class="tab tab--event"><a class="link" href="/?s=<?php echo $searchWord; ?>&type=event">イベント</a></li><?php endif; ?>
                      </ul>
                    </div>
                    <div class="c-articles-horizontal articles-horizontal">
                      <div class="c-main-inner">
                      <?php
                        ?>
                        <p class="hit-num"><?php echo $numAll; ?>件</p>
                        <ul class="article__list">
                          <?php
                            foreach ($resultPostIdAry as $id) :
                            $postTypeName;
                            $labLabel = '';
                            $postType = get_post_type($id);
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
                              case 'post':
                                $postTypeName = 'Article';
                                break;
                              default:
                                $postTypeName = 'other';
                                break;
                            }
                            // カテゴリー配列
                            $categories = get_the_category($id);
                            // タイトル
                            $postTitle = get_the_title($id);
                            $isDot = mb_strlen($postTitle) > 56;
                            $postTitle = mb_substr($postTitle, 0, 56);
                            if($isDot) {
                              $postTitle = $postTitle. "...";
                            }

                            $date = get_the_date('Y.m.d',$id);

                            $thumb = null;
                            if($postType == "radio") {
                              $radioTypeId= get_field('radio_type',$id);
                              $thumb = get_field('tectangle_thumb', $radioTypeId);
                            } else {
                              $thumb = get_the_post_thumbnail_url($id);
                            }

                          ?>
                          <li class="article__item"><a class="itemLink" href="<?php echo get_the_permalink($id); ?>">
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

                                  <p class="radio-info"><span class="date-playback-time"><?php echo $date;?> / <?php echo get_field('playback_time',$id);?></span></p>
                                <?php elseif ($postTypeName == 'Event'): ?>
                                  <p class="event-info"><span class="date">日時：<?php echo date_format(date_create(get_field('date', $id)),'Y/m/d'); ?></span><span class="time"><?php echo get_field('start_time', $id); ?> - <?php echo get_field('end_time', $id); ?></span></p>
                                <?php
                                  else:
                                  // ライター情報
                                  $writerInfoId = get_field('writer', $id)[0];
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
                            endforeach;
                          ?>
                        </ul>
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
