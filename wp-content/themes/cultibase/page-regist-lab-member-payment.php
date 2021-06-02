<?php
  /* Template Name: Lab会員登録決済 */

    // セッションから必要情報取得
    $loginFlg = getSessionLoginFlg();
    $memberId = getSessionMemberId();
    if(!$loginFlg && $memberId == '') {
      // 未ログイン状態の場合
      // ログイン画面へ遷移
      header( "Location: /login");
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
                    <h2 class="ttl">決済情報の入力</h2>
                    <p class="txt">本サイトでは、決済システムに外部サービスのロボットペイメントを使用しています。決済情報の入力はロボットペイメントが提供する画面で行います。</p>
                  </div>
                  <div class="form__main">
                    <form action="https://credit.j-payment.co.jp/gateway/payform.aspx" method="POST">
                      <input type="hidden" name="aid" value="<?php echo $ROBOTPAYMENT_AID; ?>" />
                      <input type="hidden" name="pt" value="<?php echo $ROBOTPAYMENT_PT; ?>" />
                      <input type="hidden" name="iid" value="<?php echo $ROBOTPAYMENT_IID; ?>" />
                      <input type="hidden" name="hogehoge" value="AAAAAA" />
                      <!-- 決済ページから戻すフォームのSMPFORMを設定-->
                      <!-- <input type="hidden" name="SMPFORM" value="pisc-ldscti-d204755ba260d21baae2c3bf005c9549" /> -->
                      <input class="submit" type="submit" name="submit" value="決済画面へ進む" />
                    </form>
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