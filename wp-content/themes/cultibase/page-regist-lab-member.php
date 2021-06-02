<?php
  /* Template Name: Lab会員登録 */

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
    $mail = getSessionEmail();
    $delKey = getSessionDelKey();
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
                    <h2 class="ttl">Lab会員登録</h2>
                  </div>
                  <div class="form__main">
                    <!-- SMP_TEMPLATE_FORM start-->
                    <form method="post" action="<?php echo $ACTION_URL; ?>">
                      <div class="smp_tmpl">
                        <dl class="cf">
                          <dt class="title">所属先</dt>
                          <dd class="data">
                            <input class="input" type="text" name="belongs" value="" maxlength="64"><br>
                          </dd>
                        </dl>
                      </div>
                      <input type="hidden" name="detect" value="判定">
                      <!-- 管理ID-->
                      <input type="hidden" name="SMPFORM" value="<?php echo $SMPFORM_VALUE_REGIST_LAB_MEMBER; ?>">
                      <input type="hidden" name="email" value="<?php echo $mail; ?>">
                      <input type="hidden" name="delKey" value="<?php echo $delKey; ?>">
                      <input class="submit" type="submit" name="submit" value="確認する">
                    </form><a class="backToAccountBtn" href="/lab-lp">Labについて詳しく知る</a>
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