<div class="l-app">
    <main>
      <div class="l-contents js-pjax-contents" data-scroll-section>
        <div class="l-content js-pjax-content" id="video-detail">
          <?php
            get_header();
            $loginFlg = getSessionLoginFlg();
          ?>
          <div class="l-content__in is-dark">
              <?php while ( have_posts() ) : the_post();
                  $title = get_the_title();
                  $postId = get_the_ID();
                  $playbackTime = get_field('playback_time');
                  $videoId = get_field('video_id');
                  $updateDate = get_the_modified_date("Y.m.d");
                  $writerInfoIdAry = get_field('writer');
                  
                  // タグ
                  $tags = get_the_tags();
                  // カテゴリ
                  $categoryIdArry = Array(); 
                  $categories = get_the_category();
                  // 関連記事
                  $articleIdAry = get_field('articles');
                  // ポストタイプ
                  $currentPostType = get_post_type();
                  // 有料コンテンツフラグ
                  $isPaidContents = $currentPostType != 'free-video';
                  $labLabel = $isPaidContents ? 'label-lab' : '';
                  
                  $thumb = get_the_post_thumbnail_url();
                  $shortContents = get_field('unregistered_contents');
              ?>
              <section class="s-video">
                <?php if($videoId == null): ?>
                  <div class="video__inner--image">
                    <div class="video-image"><img src="<?php echo $thumb; ?>" /></div>                    
                  </div>
                <?php elseif(!$isPaidContents || $loginFlg): ?>
                  <div class="video__inner">
                    <div class="video-frame">
                      <?php if($currentPostType != 'free-video') : ?>
                        <iframe src="https://player.vimeo.com/video/<?php echo $videoId; ?>?autoplay=1&amp;loop=1&amp;autopause=0" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen=""></iframe>
                      <?php else: ?>
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $videoId; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                      <?php endif ; ?>
                    </div>
                  </div>
                <?php else: ?>
                  <div class="video__inner--image">
                    <div class="video-image"><img src="<?php echo $thumb; ?>" /></div>
                    <div class="video-fillter"></div>
                    <div class="video-btnArea u-pc-only">
                      <div class="video-btnArea__inner">
                        <p class="txt">全ての動画をご覧いただくには、<br><span class="red">CULTIBASE Lab会員登録</span>が必要です。</p>
                        <a class="c-btnMemberRegist btnMemberRegist" href="/lab"><span class="regist__txt"><span class="t">Lab会員登録</span><span class="s">初月無料トライアルに申し込む</span></span></a>
                        <a class="c-btnLogin btnLogin" href="/login">ログイン</a>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>
              </section>
              <?php if($isPaidContents && !$loginFlg): ?>
                <section class="s-btnArea u-sp-only">
                  <div class="video-btnArea__inner">
                    <p class="txt">全ての動画をご覧いただくには、<br><span class="red">CULTIBASE Lab会員登録</span>が必要です。</p>
                    <a class="c-btnMemberRegist btnMemberRegist" href="/lab"><span class="regist__txt"><span class="t">Lab会員登録</span><span class="s">初月無料トライアルに申し込む</span></span></a>
                    <a class="c-btnLogin btnLogin" href="/login">ログイン</a>
                  </div>
                </section>
              <?php endif; ?>
              <section class="s-infoArea">
                <div class="infoArea__inner">
                  <div class="infoArea__main">
                    <div class="head">
                      <div class="tag">
                        <p class="tagTxt">Video</p>
                      </div>
                      <p class="createAt"><?php echo $updateDate; ?></p>
                      <div class="<?php echo $labLabel; ?>"></div>
                    </div>
                    <div class="category u-sp-only">
                      <ul class="category__list">
                      <?php
                          if ( $categories ) :
                            foreach ( $categories as $category ) :
                              $catName = $category->name;
                              $catSlug = $category->slug;
                              $categoryIdArry = array_merge($categoryIdArry, array($category->term_id));
                        ?>
                          <li class="category__item"><p class="category category-<?php echo $catSlug; ?>"><?php echo $catName; ?></p></li>
                        <?php endforeach; endif; ?>
                        
                      </ul>
                    </div>
                    <h1 class="ttl"><?php echo $title; ?></h1>
                    <div class="u-sp-only">
                      <div class="tag">
                        <ul class="tag__list">
                          <?php
                            if($tags) :
                            foreach ($tags as $tag): 
                          ?>
                            <li class="tag__item"><a class="itemLink" href="/tag/<?php echo $tag->slug;?>">＃<?php echo $tag->name;?></a></li>
                          <?php
                            endforeach;
                            endif;
                          ?>
                        </ul>
                      </div>
                      <div class="caster">
                        <ul class="caster__list">
                          <?php 
                            foreach($writerInfoIdAry as $id):
                            $writerInfoName = get_field('writer_name', $id);
                            $writerInfoThumbURL = get_field('writer_thumb', $id);
                            $writerInfoPosition = get_field('writer_position', $id);
                          ?>
                          <li class="caster__item">
                            <div class="casterImg" data-src-bg="<?php echo $writerInfoThumbURL; ?>" alt=""></div>
                            <div class="caster__body">
                              <p class="name"><?php echo $writerInfoName; ?></p>
                              <!-- <p class="position"><?php //echo $writerInfoPosition; ?></p> -->
                            </div>
                          </li>
                          <?php 
                            endforeach;
                          ?>
                        </ul>
                      </div>
                      <div class="c-shareBtnForLab shareBtnForLab">
                        <div class="shareBtnForLab__inner">
                          <p class="shareTxt">Share</p>
                          <ul class="shareBtn__list">
                            <li class="shareBtn__item"><a class="shareBtn__link" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_share_fb_bk.png" alt=""/></a></li>
                            <li class="shareBtn__item"><a class="shareBtn__link" href="https://twitter.com/share?text=<?php echo $title; ?>&amp;url=<?php the_permalink(); ?> @cultibase" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_share_tw_bk.png" alt=""/></a></li>
                            <li class="shareBtn__item"><a class="shareBtn__link" href="https://b.hatena.ne.jp/entry/panel/?url=<?php the_permalink(); ?>&amp;btitle=<?php echo $title; ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_share_hateb_bk.png" alt=""/></a></li>
                            <li class="shareBtn__item"><a class="shareBtn__link" href="https://social-plugins.line.me/lineit/share?url=<?php the_permalink(); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_share_line_bk.png" alt=""/></a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="body">
                      <?php 
                        if($isPaidContents) {
                          if($shortContents == null || $loginFlg) {
                            the_content();
                          } else {
                            echo $shortContents;
                          }
                        } else {
                          the_content();
                        }
                      ?>
                    </div>
                    <?php if($isPaidContents && !$loginFlg): ?>
                      <div class="btnArea">
                        <p class="txt">全ての動画をご覧いただくには、<br><span class="red">CULTIBASE Lab会員登録</span>が必要です。</p>
                        <div class="btnArea__inner">
                          <a class="c-btnMemberRegist btnMemberRegist" href="/lab"><span class="regist__txt"><span class="t">Lab会員登録</span><span class="s">初月無料トライアルに申し込む</span></span></a>
                          <a class="c-btnLogin btnLogin" href="/login">ログイン</a>
                        </div>
                      </div>
                      <?php endif; ?>
                    <?php if($loginFlg): ?>
                      <div class="bnrArea u-sp-only"><a class="fb-group" href="https://www.facebook.com/groups/cultibaselab" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/sp/common/bnr_fb_group.png"></a></div>
                    <?php endif; ?>
                  </div>
                  <div class="infoArea__side u-pc-only">
                    <div class="c-shareBtnForLab shareBtnForLab">
                      <div class="shareBtnForLab__inner">
                        <p class="shareTxt">Share</p>
                        <ul class="shareBtn__list">
                          <li class="shareBtn__item"><a class="shareBtn__link" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_share_fb_bk.png" alt=""/></a></li>
                          <li class="shareBtn__item"><a class="shareBtn__link" href="https://twitter.com/share?text=<?php echo $title; ?>&amp;url=<?php the_permalink(); ?> @cultibase" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_share_tw_bk.png" alt=""/></a></li>
                          <li class="shareBtn__item"><a class="shareBtn__link" href="https://b.hatena.ne.jp/entry/panel/?url=<?php the_permalink(); ?>&amp;btitle=<?php echo $title; ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_share_hateb_bk.png" alt=""/></a></li>
                          <li class="shareBtn__item"><a class="shareBtn__link" href="https://social-plugins.line.me/lineit/share?url=<?php the_permalink(); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_share_line_bk.png" alt=""/></a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="caster">
                      <h2 class="sideHeadline">出演者</h2>
                      <ul class="caster__list">
                          <?php 
                            foreach($writerInfoIdAry as $id):
                            $writerInfoName = get_field('writer_name', $id);
                            $writerInfoThumbURL = get_field('writer_thumb', $id);
                            $writerInfoPosition = get_field('writer_position', $id);
                          ?>
                          <li class="caster__item">
                            <div class="casterImg" data-src-bg="<?php echo $writerInfoThumbURL; ?>" alt=""></div>
                            <div class="caster__body">
                              <p class="name"><?php echo $writerInfoName; ?></p>
                              <!-- <p class="position"><?php //echo $writerInfoPosition; ?></p> -->
                            </div>
                          </li>
                          <?php 
                            endforeach;
                          ?>
                      </ul>
                    </div>
                    <div class="category">
                      <h2 class="sideHeadline">カテゴリー</h2>
                      <ul class="category__list">
                        <?php
                          if ( $categories ) :
                            foreach ( $categories as $category ) :
                              $catName = $category->name;
                              $catSlug = $category->slug;
                              $categoryIdArry = array_merge($categoryIdArry, array($category->term_id));
                        ?>
                          <li class="category__item"><p class="category category-<?php echo $catSlug; ?>"><?php echo $catName; ?></p></li>
                        <?php endforeach; endif; ?>
                      </ul>
                    </div>
                    <div class="tag">
                      <h2 class="sideHeadline">タグ</h2>
                      <ul class="tag__list">
                        <?php
                          if($tags) :
                          foreach ($tags as $tag): 
                        ?>
                          <li class="tag__item"><a class="itemLink" href="/tag/<?php echo $tag->slug;?>">＃<?php echo $tag->name;?></a></li>
                        <?php
                          endforeach;
                          endif;
                        ?>
                      </ul>
                    </div>
                    <?php if($loginFlg): ?>
                      <a class="fb-group" href="https://www.facebook.com/groups/cultibaselab" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/pc/common/bnr_fb_group.png"></a>
                    <?php endif; ?>
                  </div>
                </div>
              </section>
              <section class="c-lab-recommend">
                <div class="c-inner">
                  <h2 class="lab-recommend__ttl">関連するおすすめ</h2>
                  <p class="lab-recommend__txt">気になるコンテンツからチェックしてみてください。</p>
                </div>
                <div class="recomend-video">
                  <div class="c-inner">
                    <h3 class="ttl"><span class="en">Video</span><span class="ja">観る</span></h3>
                  </div>
                  <div class="c-videos videos--for-lab videos">
                    <div class="swiper-video swiper-container">
                      <ul class="videoList swiper-wrapper js-slideList">
                      <?php 
                          $query = new WP_Query(array(
                            // 'post_type' => [$currentPostType],
                            'post_type' => ['paid-video', 'free-video', 'book-review'],
                            'posts_per_page' => 6,
                            'paged' => get_query_var('paged'),
                            'category__in' => $categoryIdArry,
                            'post__not_in' => array_merge(array($postId)),
                          ));
                          while($query -> have_posts()): $query -> the_post();

                          $date = get_the_date('Y.m.d');
                          // 読むのにかかる時間
                          $readTime = get_field('read_time');
                          // ポストタイプ
                          $postType = get_post_type();
                          $labLabel = ($postType != 'free-video') ? 'c-label-lab' : '';
                          // echo $postType;
                          $playbackTime = get_field('playback_time');
                          // ライター情報
                          $writerInfoId = get_field('writer')[0];
                          $writerInfoName = get_field('writer_name',$writerInfoId);
                          $writerInfoThumbURL = get_field('writer_thumb',$writerInfoId);
                          // サムネイル
                          $thumb = get_the_post_thumbnail_url();
                          // カテゴリー配列
                          $categories = get_the_category();

                          $postTitle = get_the_title();
                          $isDot = mb_strlen($postTitle) > 56;
                          $postTitle = mb_substr($postTitle, 0, 56);
                          if($isDot) {
                            $postTitle = $postTitle. "...";
                          }
                        ?>
                        <li class="videoItem swiper-slide js-slideItem"><a href="<?php the_permalink(); ?>">
                            <div class="videoItem__thumb"><img src="<?php echo $thumb; ?>"/>
                              <p class="time"><?php echo $playbackTime; ?></p>
                              <svg class="c-playMark" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 48 48" id="">
                                <path d="M48 24C48 37.2548 37.2548 48 24 48C10.7452 48 0 37.2548 0 24C0 10.7452 10.7452 0 24 0C37.2548 0 48 10.7452 48 24Z" fill="white"></path>
                                <path d="M31.5 21.4019C33.5 22.5566 33.5 25.4434 31.5 26.5981L22.5 31.7942C20.5 32.9489 18 31.5056 18 29.1962L18 18.8038C18 16.4944 20.5 15.0511 22.5 16.2058L31.5 21.4019Z" fill="#302D2A"></path>
                              </svg>
                            </div>
                            <div class="videoItem__content">
                              <ul class="c-category__list">
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
                              <h3 class="videoItem__title <?php echo $labLabel; ?>"><?php echo $postTitle; ?></h3>
                              <div class="c-writeInfo">
                                <div class="writer">
                                  <div class="writerImg" data-src-bg="<?php echo $writerInfoThumbURL; ?>" alt=""></div>
                                </div>
                                <div class="writeInfo__body">
                                  <p class="name"><?php echo $writerInfoName; ?></p>
                                  <p class="subInfo"><span class="date"><?php echo $date; ?></span></p>
                                </div>
                              </div>
                            </div></a></li>
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
                </div>
                <div class="recomend-article">
                  <div class="c-inner">
                    <h3 class="ttl"><span class="en">Article</span><span class="ja">読む</span></h3>
                  </div>
                  <div class="c-articles articles--for-lab articles">
                    <div class="swiper-articles swiper-container">
                      <ul class="articles__list swiper-wrapper js-slideList">
                        <?php 
                          $limitDate = date("ymd", mktime(0, 0, 0, date("m"), date("d") - $ARTICLE_PUBLICATION_DEADLINE,   date("Y")));
                          $query = new WP_Query(array(
                            'post_type' => ['post'],
                            'posts_per_page' => 8,
                            'post_status' => 'publish',
                            'paged' => get_query_var('paged'),
                            'category__in' => $categoryIdArry,
                            'post__not_in' => array_merge(array($postId)),
                          ));
                          while($query -> have_posts()): $query -> the_post();

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
                          $thumb = get_the_post_thumbnail_url();
                          
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
                        <li class="articles__item swiper-slide js-slideItem">
                          <a class="itemLink" href="<?php the_permalink(); ?>">
                            <div class="itemThumb"><img src="<?php echo $thumb; ?>" alt=""/></div>
                            <ul class="c-category__list category__list">
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
                            <div class="itemBody">
                              <h3 class="ttl <?php echo $labLabel; ?>"><?php echo $postTitle; ?></h3>
                              <div class="c-writeInfo">
                                <div class="writer">
                                  <div class="writerImg" data-src-bg="<?php echo $writerInfoThumbURL; ?>" alt=""></div>
                                </div>
                                <div class="writeInfo__body">
                                  <p class="name"><?php echo $writerInfoName; ?></p>
                                  <p class="subInfo"><span class="date"><?php echo $date; ?></span>&nbsp;/&nbsp;<span class="readTime"><?php echo $readTime; ?></span>min</p>
                                </div>
                              </div>
                            </div>
                          </a>
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
                </div>
              </section>
              <?php endwhile; ?>
            </div>
            <?php get_template_part("/parts_find_lab_theme"); ?>
          <?php get_footer(); ?>
        </div>
      </div>
    </main>
    <div class="js-pjax-sub-content1">
    </div>
  </div>