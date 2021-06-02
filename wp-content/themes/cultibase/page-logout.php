<?php
  /* Template Name: ログアウト */

  // セッションよりアドレスとキーを取得
  $email = getSessionEmail();
  $delKey = getSessionDelKey();

  // DBをログアウトの状態に更新する（成功の場合1が返る）
  $logoutResult = selectUpdateLogout($email, $delKey);

  // セッション情報をクリアする
  clearSessionAll();

  // トップへ戻す
  header( "Location: /");
  

  get_template_part("/parts/parts_head"); ?>
<body>
  <?php get_template_part("/parts/parts_gtm_body_under"); ?>
  <div class="l-app">
      <main>
          <div class="l-contents js-pjax-contents" data-scroll-section>
            <div class="l-content js-pjax-content" id="logout">
              <?php get_header(); ?>
              <div class="l-content__in">
              </div>
            </div>
          </div>
        </main>
        <div class="js-pjax-sub-content1"></div>
      </div>
      <?php get_template_part("/parts/parts_scripts"); ?>
    </body>
  </html>
