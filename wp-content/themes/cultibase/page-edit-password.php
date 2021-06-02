<?php
  /* Template Name: パスワード変更 */

  // セッションから必要情報取得
  $loginFlg = getSessionLoginFlg();
  $memberId = getSessionMemberId();

  if(!$loginFlg && $memberId == '') {
    // 未ログイン状態の場合
    // ログイン画面へ遷移
    header( "Location: /login");
  } else {
    // ログイン状態の場合

    // IDをもとに、ユーザ情報を取得する
    $userInfo = getUserInfoByMemberId($memberId);
    // セッション情報を更新する
    setSessionAll($userInfo);

    // ページ内の表示に使用する情報取得
    // ページ内の表示に使用する情報取得
    $delKey = $userInfo['delKey'];
    $email = $userInfo['email'];
  }

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
                    <h2 class="ttl">パスワード変更</h2>
                  </div>
                  <div class="form__main">
                    <!-- SMP_TEMPLATE_FORM start-->
                    <form method="post" action="<?php echo $ACTION_URL; ?>">
                      <div class="smp_tmpl">
                        <dl class="cf">
                          <dt class="title">パスワード<span class="need">*</span></dt>
                          <dd class="data">
                            <input class="input" type="password" name="password" value="" maxlength="128" placeholder="パスワード">
                            <p class="complement">半角英数字8〜16文字で入力してください。</p>
                          </dd>
                        </dl>
                      </div>
                      <input type="hidden" name="detect" value="判定">
                      <!-- 管理ID-->
                      <input type="hidden" name="SMPFORM" value="<?php echo $SMPFORM_VALUE_EDIT_PASSWORD; ?>">
                      <input type="hidden" name="email" value="<?php echo $email; ?>">
                      <input type="hidden" name="delKey" value="<?php echo $delKey; ?>">
                      <input class="submit" type="submit" name="submit" value="保存する">
                    </form><a class="backToAccountBtn" href="/account">アカウント設定に戻る</a>
                    <!-- SMP_TEMPLATE_FOOTER start-->
                    <!-- SMP_TEMPLATE_FOOTER end-->
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