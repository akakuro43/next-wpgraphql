<div class="l-app">
    <main>
      <div class="l-contents js-pjax-contents" data-scroll-section>
        <div class="l-content js-pjax-content" id="event-detail">
          <?php
            get_header();
            $loginFlg = getSessionLoginFlg();
          ?>
          <div class="l-content__in is-dark">
            <?php while ( have_posts() ) : the_post();
                  $title = get_the_title();
                  $postId = get_the_ID();
                  $labFlag = get_field('lab_flag');
                  $labLabel = $labFlag ? 'label-lab' : '';

                  $eventDate = date_create(get_field('date'));
                  $week = array("日", "月", "火", "水", "木", "金", "土");
                  $w = (int)date_format($eventDate, 'w');
                  $youbi = $week[$w];

                  $endEventFlg = false;
                  date_default_timezone_set('Asia/Tokyo');
                  $today = date("Y/m/d");
                  date_default_timezone_set('UTC');
                  $target_day = date_format($eventDate,'Y/m/d');               
                  if(strtotime($today) > strtotime($target_day)){
                    $endEventFlg = true;
                  }
                  $startTime = get_field('start_time');
                  $endTime = get_field('end_time');
                  $eventType = get_field('type');
                  
                  $eventTypeValue = $eventType['value'];
                  $eventTypeLabel = $eventType['label'];
                  $useZoomFlg = $eventTypeValue != 'youtube';
                  $eventUrl = get_field('event_url');
                  $archiveVideoId = get_field('archive_video');
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
                  $liveEventFlag = $currentPostType == 'live-event';
                  $eventName = $liveEventFlag ? 'LIVE EVENT' : 'WATCH PARTY';
                  

                  $thumb = get_the_post_thumbnail_url();
              ?>
              <section class="s-event">
                <div class="event__bg" data-src-bg="<?php bloginfo('template_url'); ?>/assets/images/device/event/bg_event.jpg"></div>
                <div class="event__inner">
                  <div class="eventThumb"><img src="<?php echo $thumb; ?>" alt=""></div>
                  <div class="eventContents">
                    <p class="forLab"><?php if($labFlag):?><span class="forLab_txt">Lab会員向け</span><?php endif;?><span class="forLab_label"><?php echo $eventName; ?></span>
                      <?php if($liveEventFlag): ?>
                      <svg class="c-live-event-icn" xmlns="http://www.w3.org/2000/svg" width="14" height="17" viewBox="0 0 14 17" id="">
                        <g clip-path="url(#clip0)">
                          <path d="M10.5116 16.6667L9.00391 15.1671C10.8131 13.3676 11.847 10.9254 11.847 8.35476C11.847 5.78406 10.8562 3.3419 9.00391 1.54242L10.5116 0C12.7516 2.22793 13.9578 5.18423 13.9578 8.31191C13.9578 11.4396 12.7516 14.4387 10.5116 16.6667Z" fill="#F0B707"></path>
                          <path d="M7.49597 13.6247L5.98828 12.1251C8.09905 10.0257 8.09905 6.64096 5.98828 4.54156L7.49597 3.04199C10.4252 5.95545 10.4252 10.7112 7.49597 13.6247Z" fill="#F0B707"></path>
                          <path d="M2.15385 10.4542C3.34338 10.4542 4.30769 9.49505 4.30769 8.31192C4.30769 7.12879 3.34338 6.16968 2.15385 6.16968C0.96431 6.16968 0 7.12879 0 8.31192C0 9.49505 0.96431 10.4542 2.15385 10.4542Z" fill="#F0B707"></path>
                        </g>
                        <defs>
                          <clippath id="clip0">
                            <rect width="14" height="16.6667" fill="white"></rect>
                          </clippath>
                        </defs>
                      </svg>
                      <?php else: ?>
                      <svg class="c-watch-party-icn" xmlns="http://www.w3.org/2000/svg" width="14" height="15" viewBox="0 0 33 34" id="">
                        <path d="M13.3542 11.1752L13.3542 11.1751L13.3495 11.1708C13.1112 10.9531 12.8069 10.8683 12.4934 10.9103L12.4911 10.9107C12.1821 10.955 11.9016 11.152 11.7502 11.4345L11.75 11.4349L0.907725 31.7485C0.907506 31.7489 0.907288 31.7493 0.907069 31.7497C0.685106 32.1563 0.703822 32.6284 0.928895 32.9997C1.25781 33.5557 2.01494 33.802 2.64707 33.4136C2.64749 33.4133 2.64792 33.4131 2.64834 33.4128L22.3517 21.5975C22.3521 21.5973 22.3526 21.597 22.353 21.5968C22.6118 21.4446 22.8086 21.1637 22.8339 20.8324C22.8748 20.5233 22.763 20.2165 22.5273 19.9997L13.3542 11.1752ZM5.71949 27.0427L6.8458 24.9368L14.1404 24.1658L9.94664 26.6762C9.9453 26.6763 9.94399 26.6764 9.94271 26.6765L9.78536 26.6896C9.65209 26.7009 9.46454 26.7169 9.24102 26.7362C8.79395 26.7747 8.20251 26.8261 7.61269 26.8775L5.9937 27.0187L5.71949 27.0427ZM18.2246 21.6808L7.99617 22.7447L9.33076 20.2383L18.9938 19.389L20.1736 20.5225C20.1474 20.5387 20.1195 20.5558 20.0902 20.5737C19.8795 20.7024 19.5979 20.8713 19.315 21.0396C19.0323 21.2078 18.7491 21.375 18.5358 21.5C18.429 21.5626 18.3401 21.6144 18.2776 21.6504C18.2565 21.6625 18.2388 21.6727 18.2246 21.6808ZM10.4794 18.1178L12.9183 13.572L17.0587 17.5478L10.4794 18.1178ZM4.57161 29.18L5.97399 29.0566L4.01066 30.237L4.57161 29.18Z" fill="#F0B707" stroke="#F0B707" stroke-width="0.5"></path>
                        <path d="M19.2803 10.7879L17.9228 9.81817L16.3527 10.3935C15.9275 10.5578 15.4204 10.3935 15.1588 10.0318C14.9625 9.75242 14.8971 9.42368 15.0116 9.09494L15.5186 7.50057L14.4882 6.18562C14.2429 5.87332 14.1938 5.44596 14.3737 5.08435C14.5536 4.72274 14.8971 4.49262 15.306 4.49262L16.9742 4.47618L17.9064 3.09549C18.1027 2.79962 18.4298 2.63525 18.7733 2.63525C19.2312 2.63525 19.6238 2.93112 19.7709 3.35848L20.2943 4.95285L21.8971 5.41308C22.2897 5.52814 22.5677 5.84044 22.6331 6.23493C22.6985 6.62941 22.5513 7.0239 22.2242 7.27045L20.8831 8.2731L20.9322 9.94966C20.9485 10.2291 20.834 10.5085 20.6378 10.7058C20.278 11.0345 19.7055 11.1002 19.2803 10.7879ZM17.9882 8.22379C18.2008 8.22379 18.4135 8.28954 18.5934 8.42103L19.3621 8.97989L19.3294 8.02655C19.313 7.68137 19.4766 7.35264 19.7546 7.13896L20.5233 6.5801L19.6074 6.31711C19.2803 6.21849 19.0186 5.97194 18.9041 5.6432L18.6097 4.73917L18.0864 5.52814C17.8901 5.80757 17.5793 5.98838 17.2359 5.98838H16.2873L16.8761 6.74447C17.0887 7.0239 17.1541 7.36907 17.056 7.69781L16.7616 8.60184L17.6611 8.2731C17.7429 8.25666 17.8737 8.22379 17.9882 8.22379Z" fill="#F0B707"></path>
                        <path d="M29.2822 21.1395L27.9248 20.1697L26.3547 20.745C25.9294 20.9094 25.4224 20.745 25.1607 20.3834C24.9645 20.104 24.899 19.7752 25.0135 19.4465L25.5205 17.8521L24.4902 16.5372C24.2448 16.2249 24.1958 15.7975 24.3757 15.4359C24.5556 15.0743 24.899 14.8442 25.3079 14.8442L26.9762 14.8277L27.9084 13.447C28.1047 13.1512 28.4318 12.9868 28.7752 12.9868C29.2332 12.9868 29.6257 13.2827 29.7729 13.71L30.2963 15.3044L31.8991 15.7646C32.2916 15.8797 32.5697 16.192 32.6351 16.5865C32.7005 16.981 32.5533 17.3755 32.2262 17.622L30.8851 18.6247L30.9341 20.3012C30.9505 20.5806 30.836 20.8601 30.6397 21.0573C30.2799 21.3861 29.7075 21.4518 29.2822 21.1395ZM27.9902 18.5754C28.2028 18.5754 28.4154 18.6411 28.5953 18.7726L29.364 19.3314L29.3313 18.3781C29.315 18.0329 29.4785 17.7042 29.7565 17.4905L30.5252 16.9317L29.6093 16.6687C29.2822 16.5701 29.0206 16.3235 28.9061 15.9948L28.6117 15.0907L28.0883 15.8797C27.892 16.1591 27.5813 16.3399 27.2378 16.3399H26.2892L26.878 17.096C27.0906 17.3755 27.1561 17.7206 27.0579 18.0494L26.7635 18.9534L27.6631 18.6247C27.7448 18.6082 27.8757 18.5754 27.9902 18.5754Z" fill="#F0B707"></path>
                        <path d="M22.7688 11.5644L22.9352 11.3778L22.7688 11.5644C22.9192 11.6985 23.1187 11.7635 23.3064 11.7789C23.4952 11.7943 23.7001 11.762 23.8735 11.6692L23.8735 11.6692L23.878 11.6667C29.6206 8.43971 29.346 3.45255 28.2494 1.49195L28.2495 1.49193L28.2471 1.48791C28.1454 1.31363 27.9704 1.20199 27.791 1.14671C27.6092 1.09069 27.4003 1.08478 27.2018 1.14378C27.008 1.20139 26.8376 1.31516 26.7391 1.47789C26.6358 1.6486 26.6231 1.85893 26.7329 2.04854C27.5603 3.51854 27.8469 7.81404 22.9142 10.5823C22.7369 10.678 22.6052 10.8358 22.571 11.0294C22.5356 11.2289 22.6117 11.4243 22.7688 11.5644Z" fill="#F0B707" stroke="#F0B707" stroke-width="0.5"></path>
                      </svg>
                      <?php endif;?>
                    </p>
                    <div class="datetime">
                      <p class="date"><?php echo date_format($eventDate,'m月d日'); ?>(<?php echo $youbi; ?>)</p>
                      <p class="time"><?php echo $startTime; ?>-<?php echo $endTime; ?></p>
                    </div>
                    <?php if(!$loginFlg && $labFlag): ?>
                      <p class="txt">このイベントにご参加いただくには、<br/><span class="red">CULTIBASE Lab会員登録</span>が必要です。</p>
                      <a class="c-btnMemberRegist btnMemberRegist" href="/lab"><span class="regist__txt"><span class="t">Lab会員登録</span><span class="s">初月無料トライアルに申し込む</span></span></a>
                      <a class="c-btnLogin btnLogin" href="/login">ログイン</a>
                    <?php else: ?>
                      <?php if ($archiveVideoId) : ?>
                        <a class="zoomBtn" href="<?php echo the_permalink($archiveVideoId); ?>"><span class="zoomBtn__txt">アーカイブ動画はこちら</span></a>
                      <?php elseif(!$endEventFlg) :?>
                        <a class="zoomBtn" href="<?php echo $eventUrl?>" target="_blank"><span class="zoomBtn__txt">参加する(<?php echo $useZoomFlg ? 'zoom' : 'Youtubeへ'?>)</span></a>
                      <?php else: ?>
                        <span class="zoomBtn"><span class="zoomBtn__txt">アーカイブ動画準備中</span></span>
                      <?php endif; ?>
                      <p class="memo"><?php echo $endEventFlg ? 'このイベントは終了しています': '開始5分前から参加いただけます' ?></p>
                      <?php if(!$endEventFlg): ?>
                      <a class="btn-regist-calendar" href="https://www.google.com/calendar/render?action=TEMPLATE&amp;text=<?php echo $title; ?>&amp;dates=<?php echo date_format($eventDate,'Ymd'); ?>T<?php echo str_replace(':','',$startTime); ?>00/<?php echo date_format($eventDate,'Ymd'); ?>T<?php echo str_replace(':','',$endTime); ?>00&amp;location=<?php echo $eventUrl?>&amp;trp=true&amp;trp=undefined&amp;trp=true&amp;sprop=" target="_blank"><span class="icn">
                          <svg class="c-calendar" xmlns="http://www.w3.org/2000/svg" width="17" height="15" viewBox="0 0 13 11" id="">
                            <path d="M9.53407 7.64431V8.92303C9.53407 9.4234 9.1171 9.84037 8.61673 9.84037H5.05855H1.91734C1.41697 9.84037 1 9.4234 1 8.92303V2.19585C1 1.69548 1.41697 1.2785 1.91734 1.2785H3.05707" stroke="white" stroke-width="0.8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M7.50391 1.2785H8.64364C9.14401 1.2785 9.56098 1.69548 9.56098 2.19585V4.86448" stroke="white" stroke-width="0.8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M3.05859 1.2785H7.50632" stroke="white" stroke-width="0.8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M1 3.64148H9.53407" stroke="white" stroke-width="0.8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M3.05859 1.86232V0.666992" stroke="white" stroke-width="0.8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M7.50391 1.86232V0.666992" stroke="white" stroke-width="0.8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M8.86503 8.31153L11.895 5.28151C12.034 5.14252 12.034 4.92014 11.895 4.78115L11.0055 3.9194C10.8665 3.78041 10.6441 3.78041 10.5051 3.9194L7.50291 6.94941L7.08594 8.7285L8.86503 8.31153Z" stroke="white" stroke-width="0.8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M9.72656 4.69772L11.0887 6.08764" stroke="white" stroke-width="0.8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M7.50391 6.94937L8.86602 8.31149" stroke="white" stroke-width="0.8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                          </svg></span><span class="txt">Goolge カレンダーに登録</span>
                        </a>
                      <?php endif; ?>
                    <?php endif;?>
                  </div>
                </div>
              </section>
              <section class="s-infoArea">
                <div class="infoArea__inner">
                  <div class="infoArea__main">
                    <div class="head">
                      <div class="tag">
                        <p class="tagTxt">Event</p>
                      </div>
                      <p class="createAt"><?php echo date_format($eventDate,'Y.m.d'); ?></p>
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
                    <p class="live-event-info"><span class="live-event_ttl"><?php echo $eventName; ?></span>
                    <?php if($liveEventFlag): ?>
                      <svg class="c-live-event-icn" xmlns="http://www.w3.org/2000/svg" width="14" height="17" viewBox="0 0 14 17" id="">
                        <g clip-path="url(#clip0)">
                          <path d="M10.5116 16.6667L9.00391 15.1671C10.8131 13.3676 11.847 10.9254 11.847 8.35476C11.847 5.78406 10.8562 3.3419 9.00391 1.54242L10.5116 0C12.7516 2.22793 13.9578 5.18423 13.9578 8.31191C13.9578 11.4396 12.7516 14.4387 10.5116 16.6667Z" fill="#F0B707"></path>
                          <path d="M7.49597 13.6247L5.98828 12.1251C8.09905 10.0257 8.09905 6.64096 5.98828 4.54156L7.49597 3.04199C10.4252 5.95545 10.4252 10.7112 7.49597 13.6247Z" fill="#F0B707"></path>
                          <path d="M2.15385 10.4542C3.34338 10.4542 4.30769 9.49505 4.30769 8.31192C4.30769 7.12879 3.34338 6.16968 2.15385 6.16968C0.96431 6.16968 0 7.12879 0 8.31192C0 9.49505 0.96431 10.4542 2.15385 10.4542Z" fill="#F0B707"></path>
                        </g>
                        <defs>
                          <clippath id="clip0">
                            <rect width="14" height="16.6667" fill="white"></rect>
                          </clippath>
                        </defs>
                      </svg>
                      <?php else: ?>
                      <svg class="c-watch-party-icn" xmlns="http://www.w3.org/2000/svg" width="14" height="15" viewBox="0 0 33 34" id="">
                        <path d="M13.3542 11.1752L13.3542 11.1751L13.3495 11.1708C13.1112 10.9531 12.8069 10.8683 12.4934 10.9103L12.4911 10.9107C12.1821 10.955 11.9016 11.152 11.7502 11.4345L11.75 11.4349L0.907725 31.7485C0.907506 31.7489 0.907288 31.7493 0.907069 31.7497C0.685106 32.1563 0.703822 32.6284 0.928895 32.9997C1.25781 33.5557 2.01494 33.802 2.64707 33.4136C2.64749 33.4133 2.64792 33.4131 2.64834 33.4128L22.3517 21.5975C22.3521 21.5973 22.3526 21.597 22.353 21.5968C22.6118 21.4446 22.8086 21.1637 22.8339 20.8324C22.8748 20.5233 22.763 20.2165 22.5273 19.9997L13.3542 11.1752ZM5.71949 27.0427L6.8458 24.9368L14.1404 24.1658L9.94664 26.6762C9.9453 26.6763 9.94399 26.6764 9.94271 26.6765L9.78536 26.6896C9.65209 26.7009 9.46454 26.7169 9.24102 26.7362C8.79395 26.7747 8.20251 26.8261 7.61269 26.8775L5.9937 27.0187L5.71949 27.0427ZM18.2246 21.6808L7.99617 22.7447L9.33076 20.2383L18.9938 19.389L20.1736 20.5225C20.1474 20.5387 20.1195 20.5558 20.0902 20.5737C19.8795 20.7024 19.5979 20.8713 19.315 21.0396C19.0323 21.2078 18.7491 21.375 18.5358 21.5C18.429 21.5626 18.3401 21.6144 18.2776 21.6504C18.2565 21.6625 18.2388 21.6727 18.2246 21.6808ZM10.4794 18.1178L12.9183 13.572L17.0587 17.5478L10.4794 18.1178ZM4.57161 29.18L5.97399 29.0566L4.01066 30.237L4.57161 29.18Z" fill="#F0B707" stroke="#F0B707" stroke-width="0.5"></path>
                        <path d="M19.2803 10.7879L17.9228 9.81817L16.3527 10.3935C15.9275 10.5578 15.4204 10.3935 15.1588 10.0318C14.9625 9.75242 14.8971 9.42368 15.0116 9.09494L15.5186 7.50057L14.4882 6.18562C14.2429 5.87332 14.1938 5.44596 14.3737 5.08435C14.5536 4.72274 14.8971 4.49262 15.306 4.49262L16.9742 4.47618L17.9064 3.09549C18.1027 2.79962 18.4298 2.63525 18.7733 2.63525C19.2312 2.63525 19.6238 2.93112 19.7709 3.35848L20.2943 4.95285L21.8971 5.41308C22.2897 5.52814 22.5677 5.84044 22.6331 6.23493C22.6985 6.62941 22.5513 7.0239 22.2242 7.27045L20.8831 8.2731L20.9322 9.94966C20.9485 10.2291 20.834 10.5085 20.6378 10.7058C20.278 11.0345 19.7055 11.1002 19.2803 10.7879ZM17.9882 8.22379C18.2008 8.22379 18.4135 8.28954 18.5934 8.42103L19.3621 8.97989L19.3294 8.02655C19.313 7.68137 19.4766 7.35264 19.7546 7.13896L20.5233 6.5801L19.6074 6.31711C19.2803 6.21849 19.0186 5.97194 18.9041 5.6432L18.6097 4.73917L18.0864 5.52814C17.8901 5.80757 17.5793 5.98838 17.2359 5.98838H16.2873L16.8761 6.74447C17.0887 7.0239 17.1541 7.36907 17.056 7.69781L16.7616 8.60184L17.6611 8.2731C17.7429 8.25666 17.8737 8.22379 17.9882 8.22379Z" fill="#F0B707"></path>
                        <path d="M29.2822 21.1395L27.9248 20.1697L26.3547 20.745C25.9294 20.9094 25.4224 20.745 25.1607 20.3834C24.9645 20.104 24.899 19.7752 25.0135 19.4465L25.5205 17.8521L24.4902 16.5372C24.2448 16.2249 24.1958 15.7975 24.3757 15.4359C24.5556 15.0743 24.899 14.8442 25.3079 14.8442L26.9762 14.8277L27.9084 13.447C28.1047 13.1512 28.4318 12.9868 28.7752 12.9868C29.2332 12.9868 29.6257 13.2827 29.7729 13.71L30.2963 15.3044L31.8991 15.7646C32.2916 15.8797 32.5697 16.192 32.6351 16.5865C32.7005 16.981 32.5533 17.3755 32.2262 17.622L30.8851 18.6247L30.9341 20.3012C30.9505 20.5806 30.836 20.8601 30.6397 21.0573C30.2799 21.3861 29.7075 21.4518 29.2822 21.1395ZM27.9902 18.5754C28.2028 18.5754 28.4154 18.6411 28.5953 18.7726L29.364 19.3314L29.3313 18.3781C29.315 18.0329 29.4785 17.7042 29.7565 17.4905L30.5252 16.9317L29.6093 16.6687C29.2822 16.5701 29.0206 16.3235 28.9061 15.9948L28.6117 15.0907L28.0883 15.8797C27.892 16.1591 27.5813 16.3399 27.2378 16.3399H26.2892L26.878 17.096C27.0906 17.3755 27.1561 17.7206 27.0579 18.0494L26.7635 18.9534L27.6631 18.6247C27.7448 18.6082 27.8757 18.5754 27.9902 18.5754Z" fill="#F0B707"></path>
                        <path d="M22.7688 11.5644L22.9352 11.3778L22.7688 11.5644C22.9192 11.6985 23.1187 11.7635 23.3064 11.7789C23.4952 11.7943 23.7001 11.762 23.8735 11.6692L23.8735 11.6692L23.878 11.6667C29.6206 8.43971 29.346 3.45255 28.2494 1.49195L28.2495 1.49193L28.2471 1.48791C28.1454 1.31363 27.9704 1.20199 27.791 1.14671C27.6092 1.09069 27.4003 1.08478 27.2018 1.14378C27.008 1.20139 26.8376 1.31516 26.7391 1.47789C26.6358 1.6486 26.6231 1.85893 26.7329 2.04854C27.5603 3.51854 27.8469 7.81404 22.9142 10.5823C22.7369 10.678 22.6052 10.8358 22.571 11.0294C22.5356 11.2289 22.6117 11.4243 22.7688 11.5644Z" fill="#F0B707" stroke="#F0B707" stroke-width="0.5"></path>
                      </svg>
                      <?php endif;?>
                      <span class="message"><?php echo $liveEventFlag ? $eventTypeLabel. 'のイベントです': '配信したコンテンツを題材に、参加者同士で楽しく学ぶイベントです' ?></span>
                    </p>
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
                      <?php the_content(); ?>
                    </div>
                    <div class="footer">
                      <?php if(!$loginFlg && $labFlag): ?>
                        <div class="btnArea">
                          <p class="txt">このイベントにご参加いただくには、<br/><span class="red">CULTIBASE Lab会員登録</span>が必要です。</p>
                          <div class="btnArea__inner">
                            <a class="c-btnMemberRegist btnMemberRegist" href="/lab"><span class="regist__txt"><span class="t">Lab会員登録</span><span class="s">初月無料トライアルに申し込む</span></span></a>
                            <a class="c-btnLogin btnLogin" href="/login">ログイン</a>
                          </div>
                        </div>
                      <?php else: ?>                        
                        <?php if ($archiveVideoId) : ?>
                          <a class="zoomBtn" href="<?php echo the_permalink($archiveVideoId); ?>"><span class="zoomBtn__txt">アーカイブ動画はこちら</span></a>
                        <?php elseif(!$endEventFlg) :?>
                          <a class="zoomBtn" href="<?php echo $eventUrl ?>" target="_blank"><span class="zoomBtn__txt">参加する(<?php echo $useZoomFlg ? 'zoom' : 'Youtubeへ'?>)</span></a>
                        <?php else: ?>
                          <span class="zoomBtn"><span class="zoomBtn__txt">アーカイブ動画準備中</span></span>
                        <?php endif; ?>
                        
                        <p class="memo"><?php echo $endEventFlg ? 'このイベントは終了しています': '開始5分前から参加いただけます' ?></p>
                      <?php endif; ?>
                    </div>
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
                              <!-- <p class="position"><?php // echo $writerInfoPosition; ?></p> -->
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