<?php
  /* Template Name: メール通知設定 */

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
    $mailMagazineFlg = getMailMagazineFlg($memberId);
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
                    <h2 class="ttl">メール通知設定</h2>
                  </div>
                  <div class="form__main">
                    <!-- SMP_TEMPLATE_FORM start-->
                    <form method="post" action="<?php echo $ACTION_URL; ?>">
                      <div class="smp_tmpl">
                      <dl class="cf">
                          <dt class="title">
                            <p class="subTxt">メール配信停止を希望される場合は、チェックを外してください。</p>
                          </dt>
                          <dd class="data multi2">
                            <ul class="cf checkbox__list">
                              <li class="checkbox__item">
                                <label>
                                  <input class="input-checkbox" type="checkbox" <?php if($mailMagazineFlg == "1" ) echo "checked"; ?> value="1" name="mailMagazineFlg"><span class="checkbox__txt">お知らせを受け取る</span>
                                </label>
                              </li>
                            </ul>
                            <input type="hidden" value="" name="mailMagazineFlg">
                          </dd>
                        </dl>
                      </div>
                      <input type="hidden" name="detect" value="判定">
                      <!-- 管理ID-->
                      <input type="hidden" name="SMPFORM" value="<?php echo $SMPFORM_VALUE_SETTING_MAIL_MAGAZINE; ?>">
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