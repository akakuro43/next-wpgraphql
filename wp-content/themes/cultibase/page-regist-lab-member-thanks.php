<?php
  /* Template Name: Lab会員登録完了 */

  // 注文番号
  $orderID = $_GET["orderID"];
  // 決済結果
  $paymentResult = $_GET["rst"];
  // 決済番号
  $gid = $_GET["gid"];
  // 自動課金番号
  $acid = $_GET["acid"];

  // 決済成功の場合
  if($paymentResult == "1") {      
    // オーダーIDをもとにユーザー情報を取得する
    $userInfo = getUserInfoByOrderId($orderID);
    $memberId = $userInfo["memberId"];
    
    // ユーザー情報の更新（決済結果、ログインフラグ）
    $result = upgradeLabStatus($memberId, $paymentResult, $gid, $acid);
    // メールアドレスの更新
    $userInfo["loginFlg"] = 1;
    
    // セッション情報を更新する
    setSessionAll($userInfo);
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
                  <?php if($paymentResult == '1'): ?>
                    <div class="form__header">
                      <h2 class="ttl">Lab会員の登録が<br>完了いたしました</h2>
                      <p class="txt txt--center">CULTIBASE Labにご参加いただき、<br>ありがとうございます。</p>
                      <p class="txt txt--center">はじめに、CULTIBASE Labのご利用ガイド「<a class="link" href="/how-to-enjoy">CULTIBASE Labの歩き方</a>」をご覧ください。</p>
                      <a class="bnrImg--how-to-enjoy" href="/how-to-enjoy"><img src="<?php bloginfo('template_url'); ?>/assets/images/pc/common/img_side_how_to.jpg"></a><a class="btn" href="https://staging.cultibase.jp/">トップページに戻る</a>
                      <div class="sns__area">
                        <p class="sns__txt">各種SNSより最新情報を発信しています。<br>よろしければ、ぜひフォローください。</p>
                        <ul class="sns__list">
                          <li class="sns__item"><a class="snsIcn" href="https://www.facebook.com/cultibase.jp/" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_fb.png" alt=""></a>
                            <p class="snsTxt snsTxt--fb">FACEBOOK</p>
                          </li>
                          <li class="sns__item"><a class="snsIcn" href="https://twitter.com/cultibase" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_tw.png" alt=""></a>
                            <p class="snsTxt snsTxt--tw">TWITTER</p>
                          </li>
                          <li class="sns__item"><a class="snsIcn" href="https://lin.ee/yrkfUcU" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/common/icn_line.png" alt=""></a>
                            <p class="snsTxt snsTxt--line">LINE</p>
                          </li>
                        </ul>
                      </div>
                    </div>
                  <?php else: ?>
                    <div class="form__header">
                      <h2 class="ttl">決済、会員登録に<br class="u-sp-only">失敗しました。</h2>
                      <p class="txt">再度初めから実施ください。<br>なお、解決しない場合はお問い合わせください。</p>
                      <a href="<?php echo $SPIRAL_REGIST_URL; ?>" class="btn">はじめから会員登録を行う</a>
                    </div>
                    
                  <?php endif; ?>
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