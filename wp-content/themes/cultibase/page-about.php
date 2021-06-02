<?php
  /* Template Name: アバウト */
  get_template_part("/parts/parts_head"); ?>
<body>
    <?php get_template_part("/parts/parts_gtm_body_under"); ?>
    <div class="l-app">
      <main>
        <div class="l-contents js-pjax-contents" data-scroll-section>
          <div class="l-content js-pjax-content" id="about">
          <?php get_header(); ?>
          <div class="l-content__in">
              <section class="s-aboutIntro">
                <div class="aboutIntro__inner">
                  <h2 class="aboutIntro__headline"><span class="en">About</span><span class="logo"><span class="u-pc-only">
                        <svg class="c-logo" xmlns="http://www.w3.org/2000/svg" width="300" height="49" viewBox="0 0 275.04 44.03" id="">
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
                        <svg class="c-logo" xmlns="http://www.w3.org/2000/svg" width="225" height="37" viewBox="0 0 275.04 44.03" id="">
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
                        </svg></span></span></h2>
                  <p class="aboutIntro__txt">CULTIBASE（カルティベース）は、「組織ファシリテーションの知を耕す学びの場」です。<br><br>組織や事業を取り巻く複雑な悩みの真因を探ると、必ずと行っていいほど、人とチームの「創造性」の問題に行き着きます。<br><br>これらの問題は、MBAなどの専門知識を学んでも、なかなか解決されません。なぜならば、トップダウン型の経営戦略やオペレーションだけでなく、人間の心理やチームの関係性のメカニズムに基づくボトムアップ型のファシリテーションの技術を駆使する必要があるからです。<br><br>“組織ファシリテーション”の技術は、いわゆる会議やワークショップのファシリテーションのテクニックにとどまらず、最新のマネジメント論、企業のイノベーションの原理、人間の創造性と学習のメカニズム、デザインやアートの考え方など、幅広い知識に支えられています。<br><br>CULTIBASEでは、「イノベーション」「経営・マネジメント」「デザイン」「学習・人材育成」「ファシリテーション」を切り口として、人と組織の「ポテンシャル」を引き出し、クリエイティビティ溢れる組織づくりやイノベーティブな事業の創出に役立つ様々な考え方やノウハウを紹介していきます。<br><br>この学びの場に来られる方が、ご自身の専門性を高めるナレッジを得たり、異なる分野の最新のトピック・背景理論に日々触れたりすることで、持論を豊かに発展させ続けていけることを目指しています。</p>
                </div>
                <div class="aboutIntro__thumb">
                  <div class="thumbBg" data-src-bg="<?php bloginfo('template_url'); ?>/assets/images/device/about/img_abotu.jpg"></div>
                </div>
              </section>
              <section class="s-member">
                <div class="c-inner--s">
                  <h2 class="member__ttl">CULTIBASE編集部</h2>
                  <ul class="member__list">
                    <li class="member__item">
                      <div class="itemThumb"><img data-src="<?php bloginfo('template_url'); ?>/assets/images/pc/about/member_anzai.jpg"></div>
                      <div class="itemBody">
                        <p class="name">安斎勇樹 / 編集長</p>
                        <p class="descript">株式会社MIMIGURI 代表取締役Co-CEO<br>東京大学大学院 情報学環 特任助教<br>書籍『問いのデザイン：創造的対話のファシリテーション』『ワークショップデザイン論―創ることで学ぶ』『リサーチ・ドリブン・イノベーション：「問い」を起点にアイデアを探究する』著者</p>
                      </div>
                    </li>
                    <li class="member__item">
                      <div class="itemThumb"><img data-src="<?php bloginfo('template_url'); ?>/assets/images/pc/about/member_tonan.jpg"></div>
                      <div class="itemBody">
                        <p class="name">東南裕美 / 副編集長</p>
                        <p class="descript">株式会社MIMIGURI マネージャー / リサーチャー</p>
                      </div>
                    </li>
                    <li class="member__item">
                      <div class="itemThumb"><img data-src="<?php bloginfo('template_url'); ?>/assets/images/pc/about/member_morijunya.jpg"></div>
                      <div class="itemBody">
                        <p class="name">モリジュンヤ / 編集パートナー</p>
                        <p class="descript">株式会社inquire CEO<br>NPO法人soar副代表</p>
                      </div>
                    </li>
                    <li class="member__item">
                      <div class="itemThumb"><img data-src="<?php bloginfo('template_url'); ?>/assets/images/pc/about/member_endo.jpg"></div>
                      <div class="itemBody">
                        <p class="name">遠藤雅俊</p>
                        <p class="descript">株式会社MIMIGURI リードエンジニア</p>
                      </div>
                    </li>
                    <li class="member__item">
                      <div class="itemThumb"><img data-src="<?php bloginfo('template_url'); ?>/assets/images/pc/about/member_mizunami.png"></div>
                      <div class="itemBody">
                        <p class="name">水波洸/ 編集者</p>
                        <p class="descript">株式会社MIMIGURI エディター</p>
                      </div>
                    </li>
                    <li class="member__item">
                      <div class="itemThumb"><img data-src="<?php bloginfo('template_url'); ?>/assets/images/pc/about/member_oda.jpg"></div>
                      <div class="itemBody">
                        <p class="name">小田裕和</p>
                        <p class="descript">株式会社MIMIGURI マネージャー / デザインリサーチャー<br>『リサーチ・ドリブン・イノベーション：「問い」を起点にアイデアを探究する』著者</p>
                      </div>
                    </li>
                    <li class="member__item">
                      <div class="itemThumb"><img data-src="<?php bloginfo('template_url'); ?>/assets/images/pc/about/member_marina.jpg"></div>
                      <div class="itemBody">
                        <p class="name">夏川真里奈</p>
                        <p class="descript">株式会社MIMIGURI アートエデュケーター</p>
                      </div>
                    </li>
                    <li class="member__item">
                      <div class="itemThumb"><img data-src="<?php bloginfo('template_url'); ?>/assets/images/pc/about/member_minabe.jpg"></div>
                      <div class="itemBody">
                        <p class="name">ミナベトモミ</p>
                        <p class="descript">株式会社MIMIGURI 代表取締役Co-CEO</p>
                      </div>
                    </li>
                    <li class="member__item">
                      <div class="itemThumb"><img data-src="<?php bloginfo('template_url'); ?>/assets/images/pc/about/member_taki.jpg"></div>
                      <div class="itemBody">
                        <p class="name">瀧知惠美</p>
                        <p class="descript">株式会社MIMIGURI ディレクター / エクスペリエンスデザイナー</p>
                      </div>
                    </li>
                    <li class="member__item">
                      <div class="itemThumb"><img data-src="<?php bloginfo('template_url'); ?>/assets/images/pc/about/member_yoshino.jpg"></div>
                      <div class="itemBody">
                        <p class="name">吉野拓人</p>
                        <p class="descript">株式会社MIMIGURI リードデザイナー</p>
                      </div>
                    </li>
                    <li class="member__item">
                      <div class="itemThumb"><img data-src="<?php bloginfo('template_url'); ?>/assets/images/pc/about/member_naoki.jpg"></div>
                      <div class="itemBody">
                        <p class="name">吉田直記</p>
                        <p class="descript">株式会社MIMIGURI アートディレクター</p>
                      </div>
                    </li>
                </div>
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
