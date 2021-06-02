<?php
$loginFlg = getSessionLoginFlg();
global $SPIRAL_REGIST_URL;
global $SPIRAL_CONTACT_URL;
global $SPIRAL_MAIL_MAGAZINE_URL;
global $SPIRAL_REGIST_TO_BE_URL;
// wp_head();
?>
<header class="l-header">
  <div class="headerTopBar">
                <div class="headerTopBar__inner">
                  <div class="search-area js-search-area u-sp-only">
                      <?php get_search_form(); ?>
                      <?php echo do_shortcode('[searchandfilter fields="search"]'); ?>
                      <div class="closeBtn">
                        <div class="icn">
                          <div class="close-line close-line1">
                            <div class="line"></div>
                          </div>
                          <div class="close-line close-line2">
                            <div class="line"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <h1 class="siteLogo"><a class="siteLogo__link js-no-remove-handler" href="/"><span class="u-pc-only">
                        <svg class="c-logo" xmlns="http://www.w3.org/2000/svg" width="163" height="27" viewBox="0 0 275.04 44.03" id="">
                          <polygon class="cls-1" points="267.99 3.39 260.93 0 260.93 6.06 267.99 9.44 275.04 6.06 275.04 0 267.99 3.39"></polygon>
                          <path class="cls-1" d="M0,26C0,15.83,7.19,7.78,18.66,7.78c4.49,0,7.86,1,10.71,3.06v5.5h-.05A15,15,0,0,0,18.66,12C10.2,12,5.05,18.74,5.05,26S10.2,39.85,18.66,39.85a15.76,15.76,0,0,0,10.92-4.28h.1l-.31,5.3A18.72,18.72,0,0,1,18.61,44C7.14,44,0,36.18,0,26Z"></path>
                          <path class="cls-1" d="M66.39,10.12V41.74c0,1.22.41,1.43.81,1.48v.05H61.44v-5c-2.29,3.47-6,5.66-11.22,5.66-9.13,0-13.51-5.2-13.51-15.5V10.12c0-1.22-.41-1.42-.82-1.48V8.59h6.58v.05c-.41.06-.82.26-.82,1.48V28.38c0,7.14,3.32,11.37,9.74,11.37s10-4.23,10-11.37V10.12c0-1.22-.41-1.42-.82-1.48V8.59H67.2v.05C66.8,8.7,66.39,8.9,66.39,10.12Z"></path>
                          <path class="cls-1" d="M76.3,43.22c.41,0,.87-.26.87-1.48V10.12c0-1.22-.46-1.42-.87-1.48V8.59H83v.05c-.41.06-.87.26-.87,1.48V39.34H93.54c1.17,0,1.37-.4,1.48-.81h0v4.74H76.3Z"></path>
                          <path class="cls-1" d="M104.25,43.22c.41,0,.87-.26.87-1.48V12.52h-10c-1.22,0-1.37.36-1.47.76h0V8.13h0c.15.41.25.46,1.47.46H120c1.23,0,1.33-.1,1.48-.46h0v5.15h0c-.15-.45-.25-.76-1.48-.76h-10V41.74c0,1.22.46,1.43.86,1.48v.05h-6.68Z"></path>
                          <path class="cls-1" d="M127.57,43.22c.41,0,.72-.26.72-1.48V10.12c0-1.22-.31-1.42-.72-1.48V8.59H134v.05c-.41.06-.72.26-.72,1.48V41.74c0,1.22.31,1.43.72,1.48v.05h-6.38Z"></path>
                          <path class="cls-1" d="M143,43.22c.41,0,.87-.26.87-1.48V10.12c0-1.22-.46-1.42-.87-1.48V8.59h9.79c6.48,0,10.61,3.11,10.61,8.32a8.48,8.48,0,0,1-4.69,7.64c4.12,1,7.65,3.68,7.65,8.88,0,5.71-4.3,9.84-11.53,9.84H143Zm8.87-19.53c4.49,0,6.84-2.6,6.84-6s-2.35-5.3-6.84-5.3h-3.06V23.69Zm2.66,15.81c4.45,0,6.87-2.76,6.87-6.17,0-3.62-2.83-6.28-7.33-6.28h-5.26V39.5Z"></path>
                          <path class="cls-1" d="M206,40.72V35.21h.1c2.67,2.71,5.65,4.9,9,4.9,3.51,0,5.78-2.25,5.78-5.56,0-8-14.53-6.58-14.53-17.19,0-5.6,3.83-9.43,10.35-9.43a14.36,14.36,0,0,1,7.5,2.24v5.21h-.1c-1.58-1.53-4.34-3.68-7.6-3.68a4.85,4.85,0,0,0-5.2,5.1c0,7.65,14.58,6.53,14.58,17.19,0,6-4.36,9.94-10.83,9.94A14.76,14.76,0,0,1,206,40.72Z"></path>
                          <path class="cls-1" d="M231.91,43.22c.41,0,.87-.26.87-1.48V10.12c0-1.22-.46-1.42-.87-1.48V8.59h18.31v4.69h-.05c0-.4-.26-.76-1.48-.76h-11v11h10.76c1.23,0,1.43-.35,1.48-.76h0v5.41h0c-.05-.41-.25-.77-1.48-.77H237.72V39.34H249.3c1.12,0,1.38-.25,1.58-.66h.05l-.46,4.59H231.91Z"></path>
                          <path class="cls-1" d="M204.8,43.25v0a2.16,2.16,0,0,1-1.37-1.33L187,8.24h-1.43L169.08,42a2.07,2.07,0,0,1-1.22,1.23v.05h6.82v-.05c-.41-.1-.82-.51-.46-1.33h0l4.91-10.8h14.06l4.88,10.65h0c.41.87.36,1.43-.36,1.48v.05h7.2Zm-24-15.93,5.31-11.63,5.31,11.63Z"></path>
                        </svg></span><span class="u-sp-only">
                        <svg class="c-logo" xmlns="http://www.w3.org/2000/svg" width="130" height="21" viewBox="0 0 275.04 44.03" id="">
                          <polygon class="cls-1" points="267.99 3.39 260.93 0 260.93 6.06 267.99 9.44 275.04 6.06 275.04 0 267.99 3.39"></polygon>
                          <path class="cls-1" d="M0,26C0,15.83,7.19,7.78,18.66,7.78c4.49,0,7.86,1,10.71,3.06v5.5h-.05A15,15,0,0,0,18.66,12C10.2,12,5.05,18.74,5.05,26S10.2,39.85,18.66,39.85a15.76,15.76,0,0,0,10.92-4.28h.1l-.31,5.3A18.72,18.72,0,0,1,18.61,44C7.14,44,0,36.18,0,26Z"></path>
                          <path class="cls-1" d="M66.39,10.12V41.74c0,1.22.41,1.43.81,1.48v.05H61.44v-5c-2.29,3.47-6,5.66-11.22,5.66-9.13,0-13.51-5.2-13.51-15.5V10.12c0-1.22-.41-1.42-.82-1.48V8.59h6.58v.05c-.41.06-.82.26-.82,1.48V28.38c0,7.14,3.32,11.37,9.74,11.37s10-4.23,10-11.37V10.12c0-1.22-.41-1.42-.82-1.48V8.59H67.2v.05C66.8,8.7,66.39,8.9,66.39,10.12Z"></path>
                          <path class="cls-1" d="M76.3,43.22c.41,0,.87-.26.87-1.48V10.12c0-1.22-.46-1.42-.87-1.48V8.59H83v.05c-.41.06-.87.26-.87,1.48V39.34H93.54c1.17,0,1.37-.4,1.48-.81h0v4.74H76.3Z"></path>
                          <path class="cls-1" d="M104.25,43.22c.41,0,.87-.26.87-1.48V12.52h-10c-1.22,0-1.37.36-1.47.76h0V8.13h0c.15.41.25.46,1.47.46H120c1.23,0,1.33-.1,1.48-.46h0v5.15h0c-.15-.45-.25-.76-1.48-.76h-10V41.74c0,1.22.46,1.43.86,1.48v.05h-6.68Z"></path>
                          <path class="cls-1" d="M127.57,43.22c.41,0,.72-.26.72-1.48V10.12c0-1.22-.31-1.42-.72-1.48V8.59H134v.05c-.41.06-.72.26-.72,1.48V41.74c0,1.22.31,1.43.72,1.48v.05h-6.38Z"></path>
                          <path class="cls-1" d="M143,43.22c.41,0,.87-.26.87-1.48V10.12c0-1.22-.46-1.42-.87-1.48V8.59h9.79c6.48,0,10.61,3.11,10.61,8.32a8.48,8.48,0,0,1-4.69,7.64c4.12,1,7.65,3.68,7.65,8.88,0,5.71-4.3,9.84-11.53,9.84H143Zm8.87-19.53c4.49,0,6.84-2.6,6.84-6s-2.35-5.3-6.84-5.3h-3.06V23.69Zm2.66,15.81c4.45,0,6.87-2.76,6.87-6.17,0-3.62-2.83-6.28-7.33-6.28h-5.26V39.5Z"></path>
                          <path class="cls-1" d="M206,40.72V35.21h.1c2.67,2.71,5.65,4.9,9,4.9,3.51,0,5.78-2.25,5.78-5.56,0-8-14.53-6.58-14.53-17.19,0-5.6,3.83-9.43,10.35-9.43a14.36,14.36,0,0,1,7.5,2.24v5.21h-.1c-1.58-1.53-4.34-3.68-7.6-3.68a4.85,4.85,0,0,0-5.2,5.1c0,7.65,14.58,6.53,14.58,17.19,0,6-4.36,9.94-10.83,9.94A14.76,14.76,0,0,1,206,40.72Z"></path>
                          <path class="cls-1" d="M231.91,43.22c.41,0,.87-.26.87-1.48V10.12c0-1.22-.46-1.42-.87-1.48V8.59h18.31v4.69h-.05c0-.4-.26-.76-1.48-.76h-11v11h10.76c1.23,0,1.43-.35,1.48-.76h0v5.41h0c-.05-.41-.25-.77-1.48-.77H237.72V39.34H249.3c1.12,0,1.38-.25,1.58-.66h.05l-.46,4.59H231.91Z"></path>
                          <path class="cls-1" d="M204.8,43.25v0a2.16,2.16,0,0,1-1.37-1.33L187,8.24h-1.43L169.08,42a2.07,2.07,0,0,1-1.22,1.23v.05h6.82v-.05c-.41-.1-.82-.51-.46-1.33h0l4.91-10.8h14.06l4.88,10.65h0c.41.87.36,1.43-.36,1.48v.05h7.2Zm-24-15.93,5.31-11.63,5.31,11.63Z"></path>
                        </svg></span></a></h1>
                        <nav class="gnav u-pc-only">
                          <ul class="gnav__list">
                            <li class="gnav__item"><a class="itemLink" href="/articles"><span class="en">Article</span><span class="ja">読む</span></a></li>
                            <li class="gnav__item"><a class="itemLink" href="/video"><span class="en">Video</span><span class="ja">観る</span></a></li>
                            <li class="gnav__item"><a class="itemLink" href="/radio"><span class="en">Radio</span><span class="ja">聴く</span></a></li>
                            <li class="gnav__item"><a class="itemLink" href="/event"><span class="en">Event</span><span class="ja">参加する</span></a>
                            <li class="gnav__item"><a class="itemLink" href="/set-list"><span class="en">Package</span><span class="ja">コンテンツパッケージ</span></a></li>
                            <!-- <li class="gnav__item"><a class="itemLink" href="/about"><span class="en">About</span><span class="ja">メディアについて</span></a></li> -->
                          </ul>
                        </nav>
                        <div class="menu-right u-pc-only">
                          <div class="search-area">
                            <?php get_search_form(); ?>
                            <?php echo do_shortcode('[searchandfilter fields="search"]'); ?>
                          </div>
                          
                          <?php if($loginFlg) : ?>
                          <button class="accountIcn js-accountIcnBtn"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_login.png" /></button>
                          <ul class="account__list js-accountIcnList">
                              <li class="account__item"><a class="itemList" href="/news">お知らせ</a></li>
                            <li class="account__item"><a class="itemList" href="/account">アカウント設定</a></li>
                            <li class="account__item"><a class="itemList" href="/logout">ログアウト</a></li>
                          </ul>
                          <?php else : ?>
                            <a class="labBtn" href="/lab"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/btn_lab.png" /></a>
                            <a class="loginBtn js-menu-close" href="/login">ログイン</a>
                          <?php endif; ?>
                        </div>
                        <button class="searchOpenBtn js-searchOpenBtn u-sp-only">
                          <svg class="c-search" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" id="">
                            <circle cx="8.48528" cy="9.40686" r="5" transform="rotate(-45 8.48528 9.40686)" stroke="#302D2A" stroke-width="2"></circle>
                            <line x1="13.076" y1="13.3788" x2="16.4347" y2="16.7376" stroke="#302D2A" stroke-width="2" stroke-linecap="round"></line>
                          </svg>
                        </button>
                        <button class="hambugerIconBtn u-sp-only"><span class="hambugerIcon"><span class="menu-line menu-line1"><span class="line"></span></span><span class="menu-line menu-line2"><span class="line"></span></span><span class="menu-line menu-line3"><span class="line"></span></span><span class="menu-line menu-line4"><span class="line"></span></span><span class="menu-line menu-line5"><span class="line"></span></span></span></button>
                        <div class="gnavArea">
                          <div class="gnavBg u-sp-only"></div>
                          <div class="gnavBg2 u-sp-only"></div>
                          <div class="gnav u-sp-only">
                            <div class="gnav__inner">
                              <?php if(!$loginFlg): ?>
                                  <a class="loginBtn js-menu-close" href="/login">ログイン</a>'
                                  <a class="labBtn js-menu-close" href="/lab" data-src-bg="<?php bloginfo('template_url'); ?>/assets/images/sp/common/bg_lab_btn.png"><span class="ttl__main">CULTIBASE Lab</span><span class="ttl__sub">有料プランについて</span></a>
                              <?php else :?>
                                  <a class="accountBtn js-menu-close" href="/account">アカウント設定</a>
                              <?php endif; ?>
                              <ul class="mainNav__list">
                                <li class="mainNav__item js-menu-close"><a class="itemLink" href="/articles"><span class="en">Article</span><span class="ja">読む </span></a></li>
                                <li class="mainNav__item js-menu-close"><a class="itemLink" href="/video"><span class="en">Video</span><span class="ja">観る</span></a></li>
                                <li class="mainNav__item js-menu-close"><a class="itemLink" href="/radio"><span class="en">Radio</span><span class="ja">聴く</span></a></li>
                                <li class="mainNav__item js-menu-close"><a class="itemLink" href="/event"><span class="en">Event</span><span class="ja">参加する</span></a></li>
                                <li class="mainNav__item js-menu-close"><a class="itemLink" href="/set-list"><span class="en">Package</span><span class="ja">コンテンツパッケージ</span></a></li>
                                <?php if($loginFlg) : ?>
                                  <li class="mainNav__item js-menu-close"><a class="itemLink" href="/how-to-enjoy"><span class="en">How to enjoy</span><span class="ja">CULTIBASE Labの歩き方</span></a></li>
                                <?php endif; ?>
                              </ul>
                              <ul class="subNav__list">
                                <li class="subNav__item js-menu-close"><a class="itemLink" href="/about">このメディアについて</a></li>
                                <?php if($loginFlg) : ?>
                                  <li class="subNav__item js-menu-close"><a class="itemLink" href="/news">お知らせ</a></li>
                                <?php endif; ?>
                                <li class="subNav__item js-menu-close"><a class="itemLink" href="/faq">よくある質問</a></li>
                                <li class="subNav__item js-menu-close"><a class="itemLink" href="<?php echo $SPIRAL_REGIST_TO_BE_URL; ?>">法人プラン</a></li>
                                <li class="subNav__item js-menu-close"><a class="itemLink" href="<?php echo $SPIRAL_MAIL_MAGAZINE_URL; ?>">メルマガ登録</a></li>
                                <?php
                                  if($loginFlg) {
                                    echo '<li class="subNav__item js-menu-close"><a class="itemLink" href="/logout">ログアウト</a></li>';
                                  }
                                ?>
                                
                                <li class="subNav__item subNav__item--policy s js-menu-close"><a class="itemLink" href="/policy">プライバシーポリシー</a></li>
                                <li class="subNav__item s js-menu-close"><a class="itemLink" href="/terms">利用規約</a></li>
                                <li class="subNav__item s js-menu-close"><a class="itemLink" href="/tokushoho">特定商取引法に基づく表記</a></li>
                                <li class="subNav__item s js-menu-close"><a class="itemLink" href="https://mimiguri.co.jp" target="_blank">運営会社</a></li>
                                <li class="subNav__item s js-menu-close"><a class="itemLink" href="<?php echo $SPIRAL_CONTACT_URL;?>">お問い合わせ</a></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </header>
