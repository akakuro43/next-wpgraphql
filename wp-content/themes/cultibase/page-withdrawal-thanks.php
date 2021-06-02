<?php
  /* Template Name: 退会の手続き_サンクス画面 */

// セッションよりアドレスとキーを取得
$email = getSessionEmail();
$delKey = getSessionDelKey();
// DBをログアウトの状態に更新する（成功の場合1が返る）
$logoutResult = selectUpdateLogout($email, $delKey);

// セッション情報をクリアする
clearSessionAll();

get_template_part("/parts/parts_head");
?>
  <body>
    <?php get_template_part("/parts/parts_gtm_body_under"); ?>
    <div class="l-app">
    <main>
        <div class="l-contents js-pjax-contents" data-scroll-section>
          <div class="l-content js-pjax-content" id="form">
            <?php get_header(); ?>
            <div class="l-content__in">
              <div class="frame">
                <section class="s-form">
                  <div class="form__header">
                    <p class="txt">退会手続きが完了しました。</p><a class="btn" href="<?php echo $HOME_URL; ?>">トップページに戻る</a>
                  </div>
                  <div class="form__footer"></div>
                </section>
              </div>
            </div>
          </div>
        </div>
      </main>
      <div class="js-pjax-sub-content1">
      </div>
    </div>
    <?php get_template_part("/parts/parts_scripts"); ?>
  </body>
</html>