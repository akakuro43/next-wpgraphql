<?php
global $SPIRAL_REGIST_URL;
global $SPIRAL_CONTACT_URL;
global $SPIRAL_REGIST_TO_BE_URL;
global $SPIRAL_MAIL_MAGAZINE_URL;

$loginFlg = getSessionLoginFlg();
?>

<footer class="l-footer">
  <?php if(!$loginFlg) : ?>
  <div class="footer__signUp">
    <div class="signUp__bg" data-src-bg="<?php bloginfo('template_url'); ?>/assets/images/device/common/bg_footer_signin.png"></div>
    <div class="c-inner inner">
      <p class="caltibase__logo">
        <img src="<?php bloginfo('template_url'); ?>/assets/images/common/logo_cultibase_lab.png" alt=""/>
      </p>
      <p class="subCopy">人とチームのポテンシャルを活かす</p>
      <h2 class="mainCopy">“組織ファシリテーション”の<br class="u-sp-only">技を習得する</h2>
      <p class="txt">CULTIBASE Lab会員は、記事・イベント・動画・コンテンツパッケージをいつでも全て見放題</p><a class="c-btnMemberRegist btnMemberRegist" href="/lab"><span class="regist__txt"><span class="t">Lab会員登録</span><span class="s">初月無料トライアルに申し込む</span></span></a>
    </div>
  </div>
  <div class="footer__mailMagazine">
    <div class="c-inner inner">
      <h2 class="mailMagazine__ttl"><span class="en">Mail Magazine</span>
        <spna class="ja">メルマガ登録</spna>
      </h2>
      <p class="mailMagazine__txt">メルマガ登録をしていただくと、記事やイベントなどの最新情報が届きます</p><a class="c-detailLink detailLink" href="<?php echo $SPIRAL_MAIL_MAGAZINE_URL; ?>"><span class="detailLink__txt">メルマガ登録</span><span class="detailLink__icn">
          <svg class="c-nextIcon" xmlns="http://www.w3.org/2000/svg" width="14" height="16" viewBox="0 0 10 11" id="">
            <path d="M4.24264 1.00003L8.48528 5.24268L4.24264 9.48532" stroke="black" stroke-width="2" fill="none"></path>
          </svg></span></a>
    </div>
  </div>
  <?php endif; ?>
  <div class="footer__main">
    <div class="footer__bg" data-src-bg="<?php bloginfo('template_url'); ?>/assets/images/device/common/img_footer_bg.jpg"></div>
    <div class="footer__inner">
      <div class="footer__logo">
        <div class="caltibase">
        <p class="caltibase__logo"><span class="u-pc-only">
                          <svg class="c-logo" xmlns="http://www.w3.org/2000/svg" width="240" height="39" viewBox="0 0 275.04 44.03" id="">
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
                          <svg class="c-logo" xmlns="http://www.w3.org/2000/svg" width="180" height="29" viewBox="0 0 275.04 44.03" id="">
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
                          </svg></span></p>
          <p class="caltibase__copy">組織ファシリテーションの知を耕す。</p>
        </div>
      </div>
      <div class="footer__nav">
        <div class="navCategory">
          <h3 class="navCategory__ttl">Content</h3>
          <div class="nav__inner">
            <ul class="nav__list">
              <li class="nav__item"><a class="link" href="/articles">記事を読む</a></li>
              <li class="nav__item"><a class="link" href="/video">動画を観る</a></li>
              <li class="nav__item"><a class="link" href="/radio">ラジオを聴く</a></li>
              <li class="nav__item"><a class="link" href="/event">イベントに参加する</a></li>
              <li class="nav__item"><a class="link" href="/set-list">コンテンツパッケージ</a></li>
            </ul>
            <ul class="nav__list nav__list--ml">
              <li class="nav__item"><a class="link" href="/about">このメディアについて</a></li>
              <?php if($loginFlg) : ?>
                <li class="nav__item"><a class="link" href="/how-to-enjoy">CULTIBASE Labの歩き方</a></li>
                <li class="nav__item"><a class="link" href="/news">お知らせ</a></li>
              <?php endif; ?>
              <li class="nav__item"><a class="link" href="/faq">よくある質問</a></li>
            </ul>
          </div>
        </div>
        <div class="navCategory">
          <h3 class="navCategory__ttl">Register</h3>
          <div class="nav__inner">
            <ul class="nav__list">
              <li class="nav__item"><a class="link" href="/lab">CULTIBASE Lab会員</a></li>
              <li class="nav__item"><a class="link" href="<?php echo $SPIRAL_REGIST_TO_BE_URL; ?>">法人プラン</a></li>
              <li class="nav__item"><a class="link" href="<?php echo $SPIRAL_MAIL_MAGAZINE_URL; ?>">メルマガ登録</a></li>
            </ul>
          </div>
        </div>
        <div class="navCategory">
          <h3 class="navCategory__ttl">Company</h3>
          <div class="nav__inner">
            <ul class="nav__list">
              <li class="nav__item"><a class="link" href="https://mimiguri.co.jp/" target="_blank">運営会社</a></li>
              <li class="nav__item"><a class="link" href="/policy">プライバシーポリシー</a></li>
              <li class="nav__item"><a class="link" href="/terms">利用規約</a></li>
              <li class="nav__item"><a class="link" href="/tokushoho">特定商取引法に基づく表記</a></li>
              <li class="nav__item"><a class="link" href="<?php echo $SPIRAL_CONTACT_URL;?>">お問い合わせ</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="snsShare">
        <h2 class="snsShare__ttl">Follow
          <svg class="c-slash" xmlns="http://www.w3.org/2000/svg" width="6" height="9" viewBox="0 0 6 9" id="">
            <path d="M3.68945 0.0996094H5.07812L1.7207 9H0.34375L3.68945 0.0996094Z" fill="#302D2A"></path>
          </svg>
        </h2>
        <ul class="sns__list">
          <li class="sns__item"><a class="snsIcn" href="https://www.facebook.com/cultibase.jp" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_fb.png" alt=""></a></li>
          <li class="sns__item"><a class="snsIcn" href="https://twitter.com/cultibase" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_tw.png" alt=""></a></li>
          <li class="sns__item"><a class="snsIcn" href="https://lin.ee/yrkfUcU" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_line.png" alt=""></a></li>
        </ul>
      </div>
      <p class="copyright">©&nbsp;<a href="https://mimiguri.co.jp/" target="_blank">MIMIGURI</a>&nbsp;All rights reserved.</p>
    </div>
  </div>
</footer>