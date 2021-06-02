<?php
/* Template Name: イベント一覧 */  
get_template_part("/parts/parts_head"); 
date_default_timezone_set('Asia/Tokyo');

// 先々月
// $beforelastmonth = date("y.m.01", mktime(0, 0, 0, date("m")-2, date("d"),   date("Y")));
// 先月
$lastmonthMaterial = mktime(0, 0, 0, date("m")-1, 1,   date("Y"));
$lastmonth_YMD = date("y.m.01", $lastmonthMaterial);
$lastmonth_M = date("m", $lastmonthMaterial);

// 今月
$thismonthMaterial = mktime(0, 0, 0, date("m"), 1,   date("Y"));
$thismonth_YMD = date("y.m.01", $thismonthMaterial);
$thismonth_M = date("m", $thismonthMaterial);
//　翌月
$nextmonthMaterial = mktime(0, 0, 0, date("m")+1, 1,   date("Y"));
$nextmonth_YMD = date("y.m.01", $nextmonthMaterial);
$nextmonth_M = date("m", $nextmonthMaterial);
// 翌々月
$afternextmonth_YMD = date("y.m.01", mktime(0, 0, 0, date("m")+2, 1,   date("Y")));

// echo $lastmonth_YMD;
// echo $thismonth_YMD;
// echo $nextmonth_YMD;
date_default_timezone_set('UTC');

$postId = get_the_id();
$calendarImg = get_field('calendar_img', $postId);
?>
<body>
    <?php get_template_part("/parts/parts_gtm_body_under"); ?>
    <div class="l-app">
      <main>
        <div class="l-contents js-pjax-contents" data-scroll-section>
          <div class="l-content js-pjax-content" id="event">
            <?php get_header(); ?>
            <div class="l-content__in is-dark">
              <section class="s-eventIntro">
                <div class="c-inner">
                  <h2 class="c-page-title-en-jp--center"><span class="en">Event</span><span class="ja">参加する</span></h2>
                </div>
              </section>
              <section class="s-event event--live-event">
                <div class="c-inner">
                  <div class="event__header">
                    <div class="header__body">
                      <p class="forLab">
                        <span class="forLab_label">LIVE EVENT</span>
                        <svg class="c-live-event-icn" xmlns="http://www.w3.org/2000/svg" width="20" height="25" viewBox="0 0 14 17" id="">
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
                      </p>
                      <h2 class="headline">ライブイベント</h2>
                      <p class="txt">組織ファシリテーションのナレッジを学べるオンライン講義や、ゲストを招聘したイベント、対談などを配信します。リアルタイムで講師や参加者との意見交換もできます。</p>
                    </div>
                    <div class="header__bg"><img data-src="<?php bloginfo('template_url'); ?>/assets/images/pc/event/img_live_event.png" alt=""></div>
                  </div>
                  <div class="event__contents js-event__contents">
                    <div class="contents__header">
                      <p class="schedule__ttl u-pc-only">スケジュール</p>
                      <div class="change-btns js-change-btns--live-event">
                        <button class="change-btn btn-last-month" data-btn="last-month"><?php echo substr($lastmonth_M, 0, 1) === '0' ? mb_substr($lastmonth_M, 1) : $lastmonth_M; ?>月</button>
                        <button class="change-btn btn-this-month" data-btn="this-month"><?php echo substr($thismonth_M, 0, 1) === '0' ? mb_substr($thismonth_M, 1) : $thismonth_M; ?>月のイベント</button>
                        <button class="change-btn btn-next-month" data-btn="next-month"><?php echo substr($nextmonth_M, 0, 1) === '0' ? mb_substr($nextmonth_M, 1) : $nextmonth_M; ?>月</button>
                      </div>
                    </div>
                    <div class="contents__body">
                      <div class="calender js-calender-height">
                        <ul class="event__list" data-cal="last-month">
                        <?php
                            $query = new WP_Query(array(
                              'post_type' => ['live-event'],
                              'posts_per_page' => '-1',
                              'has_password' => false,
                              'orderby' => 'menu_order',
                              'order' => 'DESC',
                              'paged' => get_query_var('paged'),
                              'meta_query' => array(
                                'relation' => 'AND',
                                array(
                                  'key' => 'date',
                                  'value' => $lastmonth_YMD,
                                  'compare' => '>=',
                                  'type' => 'DATE'
                                ),
                                array(
                                  'key' => 'date',
                                  'value' => $thismonth_YMD,
                                  'compare' => '<',
                                  'type' => 'DATE'
                                ),
                              )
                                
                            ));
                            while($query -> have_posts()): $query -> the_post();
                              get_template_part('/parts/event-calendar');
                            endwhile;
                          ?>
                        </ul>
                        <ul class="event__list" data-cal="this-month">
                          <?php
                            $query = new WP_Query(array(
                              'post_type' => ['live-event'],
                              'posts_per_page' => '-1',
                              'has_password' => false,
                              'orderby' => 'menu_order',
                              'order' => 'DESC',
                              'paged' => get_query_var('paged'),
                              'meta_query' => array(
                                'relation' => 'AND',
                                array(
                                  'key' => 'date',
                                  'value' => $thismonth_YMD,
                                  'compare' => '>=',
                                  'type' => 'DATE'
                                ),
                                array(
                                  'key' => 'date',
                                  'value' => $nextmonth_YMD,
                                  'compare' => '<',
                                  'type' => 'DATE'
                                ),
                              )
                                
                            ));
                            while($query -> have_posts()): $query -> the_post();
                              get_template_part('/parts/event-calendar');
                            endwhile;
                          ?>
                        </ul>
                        <ul class="event__list" data-cal="next-month">
                        <?php
                            $query = new WP_Query(array(
                              'post_type' => ['live-event'],
                              'posts_per_page' => '-1',
                              'has_password' => false,
                              'orderby' => 'menu_order',
                              'order' => 'DESC',
                              'paged' => get_query_var('paged'),
                              'meta_query' => array(
                                'relation' => 'AND',
                                array(
                                  'key' => 'date',
                                  'value' => $nextmonth_YMD,
                                  'compare' => '>=',
                                  'type' => 'DATE'
                                ),
                                array(
                                  'key' => 'date',
                                  'value' => $afternextmonth_YMD,
                                  'compare' => '<',
                                  'type' => 'DATE'
                                ),
                              )
                                
                            ));
                            while($query -> have_posts()): $query -> the_post();
                              get_template_part('/parts/event-calendar');
                            endwhile;
                          ?>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <section class="s-event event--watch-party">
                <div class="c-inner">
                  <div class="event__header">
                    <div class="header__body">
                      <p class="forLab"><span class="forLab_label">WATCH PARTY</span>
                        <svg class="c-watch-party-icn" xmlns="http://www.w3.org/2000/svg" width="22" height="23" viewBox="0 0 33 34" id="">
                          <path d="M13.3542 11.1752L13.3542 11.1751L13.3495 11.1708C13.1112 10.9531 12.8069 10.8683 12.4934 10.9103L12.4911 10.9107C12.1821 10.955 11.9016 11.152 11.7502 11.4345L11.75 11.4349L0.907725 31.7485C0.907506 31.7489 0.907288 31.7493 0.907069 31.7497C0.685106 32.1563 0.703822 32.6284 0.928895 32.9997C1.25781 33.5557 2.01494 33.802 2.64707 33.4136C2.64749 33.4133 2.64792 33.4131 2.64834 33.4128L22.3517 21.5975C22.3521 21.5973 22.3526 21.597 22.353 21.5968C22.6118 21.4446 22.8086 21.1637 22.8339 20.8324C22.8748 20.5233 22.763 20.2165 22.5273 19.9997L13.3542 11.1752ZM5.71949 27.0427L6.8458 24.9368L14.1404 24.1658L9.94664 26.6762C9.9453 26.6763 9.94399 26.6764 9.94271 26.6765L9.78536 26.6896C9.65209 26.7009 9.46454 26.7169 9.24102 26.7362C8.79395 26.7747 8.20251 26.8261 7.61269 26.8775L5.9937 27.0187L5.71949 27.0427ZM18.2246 21.6808L7.99617 22.7447L9.33076 20.2383L18.9938 19.389L20.1736 20.5225C20.1474 20.5387 20.1195 20.5558 20.0902 20.5737C19.8795 20.7024 19.5979 20.8713 19.315 21.0396C19.0323 21.2078 18.7491 21.375 18.5358 21.5C18.429 21.5626 18.3401 21.6144 18.2776 21.6504C18.2565 21.6625 18.2388 21.6727 18.2246 21.6808ZM10.4794 18.1178L12.9183 13.572L17.0587 17.5478L10.4794 18.1178ZM4.57161 29.18L5.97399 29.0566L4.01066 30.237L4.57161 29.18Z" fill="#F0B707" stroke="#F0B707" stroke-width="0.5"></path>
                          <path d="M19.2803 10.7879L17.9228 9.81817L16.3527 10.3935C15.9275 10.5578 15.4204 10.3935 15.1588 10.0318C14.9625 9.75242 14.8971 9.42368 15.0116 9.09494L15.5186 7.50057L14.4882 6.18562C14.2429 5.87332 14.1938 5.44596 14.3737 5.08435C14.5536 4.72274 14.8971 4.49262 15.306 4.49262L16.9742 4.47618L17.9064 3.09549C18.1027 2.79962 18.4298 2.63525 18.7733 2.63525C19.2312 2.63525 19.6238 2.93112 19.7709 3.35848L20.2943 4.95285L21.8971 5.41308C22.2897 5.52814 22.5677 5.84044 22.6331 6.23493C22.6985 6.62941 22.5513 7.0239 22.2242 7.27045L20.8831 8.2731L20.9322 9.94966C20.9485 10.2291 20.834 10.5085 20.6378 10.7058C20.278 11.0345 19.7055 11.1002 19.2803 10.7879ZM17.9882 8.22379C18.2008 8.22379 18.4135 8.28954 18.5934 8.42103L19.3621 8.97989L19.3294 8.02655C19.313 7.68137 19.4766 7.35264 19.7546 7.13896L20.5233 6.5801L19.6074 6.31711C19.2803 6.21849 19.0186 5.97194 18.9041 5.6432L18.6097 4.73917L18.0864 5.52814C17.8901 5.80757 17.5793 5.98838 17.2359 5.98838H16.2873L16.8761 6.74447C17.0887 7.0239 17.1541 7.36907 17.056 7.69781L16.7616 8.60184L17.6611 8.2731C17.7429 8.25666 17.8737 8.22379 17.9882 8.22379Z" fill="#F0B707"></path>
                          <path d="M29.2822 21.1395L27.9248 20.1697L26.3547 20.745C25.9294 20.9094 25.4224 20.745 25.1607 20.3834C24.9645 20.104 24.899 19.7752 25.0135 19.4465L25.5205 17.8521L24.4902 16.5372C24.2448 16.2249 24.1958 15.7975 24.3757 15.4359C24.5556 15.0743 24.899 14.8442 25.3079 14.8442L26.9762 14.8277L27.9084 13.447C28.1047 13.1512 28.4318 12.9868 28.7752 12.9868C29.2332 12.9868 29.6257 13.2827 29.7729 13.71L30.2963 15.3044L31.8991 15.7646C32.2916 15.8797 32.5697 16.192 32.6351 16.5865C32.7005 16.981 32.5533 17.3755 32.2262 17.622L30.8851 18.6247L30.9341 20.3012C30.9505 20.5806 30.836 20.8601 30.6397 21.0573C30.2799 21.3861 29.7075 21.4518 29.2822 21.1395ZM27.9902 18.5754C28.2028 18.5754 28.4154 18.6411 28.5953 18.7726L29.364 19.3314L29.3313 18.3781C29.315 18.0329 29.4785 17.7042 29.7565 17.4905L30.5252 16.9317L29.6093 16.6687C29.2822 16.5701 29.0206 16.3235 28.9061 15.9948L28.6117 15.0907L28.0883 15.8797C27.892 16.1591 27.5813 16.3399 27.2378 16.3399H26.2892L26.878 17.096C27.0906 17.3755 27.1561 17.7206 27.0579 18.0494L26.7635 18.9534L27.6631 18.6247C27.7448 18.6082 27.8757 18.5754 27.9902 18.5754Z" fill="#F0B707"></path>
                          <path d="M22.7688 11.5644L22.9352 11.3778L22.7688 11.5644C22.9192 11.6985 23.1187 11.7635 23.3064 11.7789C23.4952 11.7943 23.7001 11.762 23.8735 11.6692L23.8735 11.6692L23.878 11.6667C29.6206 8.43971 29.346 3.45255 28.2494 1.49195L28.2495 1.49193L28.2471 1.48791C28.1454 1.31363 27.9704 1.20199 27.791 1.14671C27.6092 1.09069 27.4003 1.08478 27.2018 1.14378C27.008 1.20139 26.8376 1.31516 26.7391 1.47789C26.6358 1.6486 26.6231 1.85893 26.7329 2.04854C27.5603 3.51854 27.8469 7.81404 22.9142 10.5823C22.7369 10.678 22.6052 10.8358 22.571 11.0294C22.5356 11.2289 22.6117 11.4243 22.7688 11.5644Z" fill="#F0B707" stroke="#F0B707" stroke-width="0.5"></path>
                        </svg>
                      </p>
                      <h2 class="headline">ウォッチパーティ</h2>
                      <p class="txt">ライブイベントなどで配信したコンテンツを題材に、参加者同士での意見交換も交えながら、楽しく学べる企画をご用意しています。</p>
                    </div>
                    <div class="header__bg"><img data-src="<?php bloginfo('template_url'); ?>/assets/images/pc/event/img_watch_party.png" alt=""></div>
                  </div>
                  <div class="event__contents js-event__contents">
                    <div class="contents__header">
                      <p class="schedule__ttl u-pc-only">スケジュール</p>
                      <div class="change-btns js-change-btns--watch-event">
                        <button class="change-btn btn-last-month" data-btn="last-month"><?php echo substr($lastmonth_M, 0, 1) === '0' ? mb_substr($lastmonth_M, 1) : $lastmonth_M; ?>月</button>
                        <button class="change-btn btn-this-month" data-btn="this-month"><?php echo substr($thismonth_M, 0, 1) === '0' ? mb_substr($thismonth_M, 1) : $thismonth_M; ?>月のイベント</button>
                        <button class="change-btn btn-next-month" data-btn="next-month"><?php echo substr($nextmonth_M, 0, 1) === '0' ? mb_substr($nextmonth_M, 1) : $nextmonth_M; ?>月</button>
                      </div>
                    </div>
                    <div class="contents__body">
                      <div class="calender js-calender-height">
                      <ul class="event__list" data-cal="last-month">
                        <?php
                            $query = new WP_Query(array(
                              'post_type' => ['watch-party'],
                              'posts_per_page' => '-1',
                              'has_password' => false,
                              'orderby' => 'menu_order',
                              'order' => 'DESC',
                              'paged' => get_query_var('paged'),
                              'meta_query' => array(
                                'relation' => 'AND',
                                array(
                                  'key' => 'date',
                                  'value' => $lastmonth_YMD,
                                  'compare' => '>=',
                                  'type' => 'DATE'
                                ),
                                array(
                                  'key' => 'date',
                                  'value' => $thismonth_YMD,
                                  'compare' => '<',
                                  'type' => 'DATE'
                                ),
                              )
                                
                            ));
                            while($query -> have_posts()): $query -> the_post();
                              get_template_part('/parts/event-calendar');
                            endwhile;
                          ?>
                        </ul>
                        <ul class="event__list" data-cal="this-month">
                          <?php
                            $query = new WP_Query(array(
                              'post_type' => ['watch-party'],
                              'posts_per_page' => '-1',
                              'has_password' => false,
                              'orderby' => 'menu_order',
                              'order' => 'DESC',
                              'paged' => get_query_var('paged'),
                              'meta_query' => array(
                                'relation' => 'AND',
                                array(
                                  'key' => 'date',
                                  'value' => $thismonth_YMD,
                                  'compare' => '>=',
                                  'type' => 'DATE'
                                ),
                                array(
                                  'key' => 'date',
                                  'value' => $nextmonth_YMD,
                                  'compare' => '<',
                                  'type' => 'DATE'
                                ),
                              )
                                
                            ));
                            while($query -> have_posts()): $query -> the_post();
                              get_template_part('/parts/event-calendar');
                            endwhile;
                          ?>
                        </ul>
                        <ul class="event__list" data-cal="next-month">
                        <?php
                            $query = new WP_Query(array(
                              'post_type' => ['watch-party'],
                              'posts_per_page' => '-1',
                              'has_password' => false,
                              'orderby' => 'menu_order',
                              'order' => 'DESC',
                              'paged' => get_query_var('paged'),
                              'meta_query' => array(
                                'relation' => 'AND',
                                array(
                                  'key' => 'date',
                                  'value' => $nextmonth_YMD,
                                  'compare' => '>=',
                                  'type' => 'DATE'
                                ),
                                array(
                                  'key' => 'date',
                                  'value' => $afternextmonth_YMD,
                                  'compare' => '<',
                                  'type' => 'DATE'
                                ),
                              )
                                
                            ));
                            while($query -> have_posts()): $query -> the_post();
                              get_template_part('/parts/event-calendar');
                            endwhile;
                          ?>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <section class="s-event-calendar">
                <div class="event-calendar__img u-pc-only"><img src="<?php echo $calendarImg; ?>"></div><a class="btn" href="/event-archive/">過去のイベント情報</a>
              </section>
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