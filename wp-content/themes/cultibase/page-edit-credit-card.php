<?php
  /* Template Name: クレジットカード変更 */

  // セッションから必要情報取得
  $loginFlg = getSessionLoginFlg();
  $memberId = getSessionMemberId();

  if(!$loginFlg && $memberId == '') {
    // 未ログイン状態の場合
    // ログイン画面へ遷移
    header( "Location: /login");
  } else {
    // ログイン状態の場合

    // 決済情報を取得する。
    $paymentInfo = getPaymentInfo($memberId);
    // 決済番号
    $paymentGid = $paymentInfo['paymentGid'];
    // 自動課金番号
    $paymentAcid = $paymentInfo['paymentAcid'];
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
                    <h2 class="ttl">クレジットカード情報の変更</h2>
                    <p class="txt">クレジットカード情報の変更はロボットペイメントが提供する画面で行います。以下の手順で行ってください。</p>
                  </div>
                  <div class="form__main">
                    <ul class="flow">
                      <li class="item">①<a class="link" href="https://credit.j-payment.co.jp/gateway/cardinfo.aspx?aid=117059&amp;tid=<?php echo $paymentGid; ?>" target="_blank">カード情報変更フォーム</a>へアクセスしてください。</li>
                      <li class="item">②下記の自動課金番号を入力しログインしてください。
                        <p class="auto-no">お客様の自動課金番号 : <?php echo $paymentAcid; ?></p>
                        <p class="notes">※自動課金番号とは、CULTIBASE Lab登録の決済時に発行された専用の番号となります。</p>
                      </li>
                      <li class="item">③カード情報を入力し、変更ボタンをクリックしてください。</li>
                      <li class="item">④「カード情報変更は正常に終了いたしました。」と表示されれば変更完了です。</li>
                    </ul><a class="backToAccountBtn" href="/account">アカウント設定に戻る</a>
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