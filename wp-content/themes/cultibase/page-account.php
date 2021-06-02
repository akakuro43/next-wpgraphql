<?php
  /* Template Name: アカウント */

  global $SPIRAL_CONTACT_URL;

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
    $password = getSessionPassword();
    $email = getSessionEmail();
    $memberPlan = $userInfo['memberPlan'];

  }

  get_template_part("/parts/parts_head");
?>  
  <body>
    <?php get_template_part("/parts/parts_gtm_body_under"); ?>
    <div class="l-app">
    
    <main>
        <div class="l-contents js-pjax-contents" data-scroll-section>
          <div class="l-content js-pjax-content" id="account">
            <?php get_header(); ?>
            <div class="l-content__in">
              <div class="frame">
                <section class="s-account">
                  <h2 class="account__ttl">アカウント設定</h2>
                  <p class="account__mail"><?php echo $email; ?></p>
                  <ul class="account__list">
                    <li class="account__item"><a class="itemLink" href="/edit-profile">プロフィール変更</a></li>
                    <?php if($memberPlan == 1): ?>
                      <li class="account__item"><a class="itemLink" href="/edit-mail">メールアドレス変更</a></li>
                    <?php endif; ?>
                    <li class="account__item"><a class="itemLink" href="/edit-password">パスワード変更</a></li>
                    <?php if($memberPlan == 1): ?>
                      <li class="account__item"><a class="itemLink" href="/edit-credit-card">クレジットカード情報の変更</a></li>
                    <?php endif; ?>
                    <li class="account__item"><a class="itemLink" href="/edit-mail-magazine">メール通知設定</a></li>
                  </ul>
                </section>
                <section class="s-others">
                  <h2 class="others__ttl">お問い合わせ・規約</h2>
                  <ul class="other__list">
                    <li class="other__item"><a class="itemLink" href="/faq">よくある質問</a></li>
                    <li class="other__item"><a class="itemLink" href="<?php echo $SPIRAL_CONTACT_URL;?>">お問い合わせ</a></li>
                    <li class="other__item"><a class="itemLink" href="/policy">プライバシーポリシー</a></li>
                    <li class="other__item"><a class="itemLink" href="/terms">利用規約</a></li>
                    <li class="other__item"><a class="itemLink" href="tokushoho">特定商取引法に基づく表記</a></li>
                  </ul>
                  <a class="logoutBtn" href="/logout">ログアウト</a>
                  <?php if($memberPlan != 3): ?>
                    <a class="withdrawalLink" href="/withdrawal">Lab会員の退会はこちら</a>
                  <?php endif; ?>
                </section>
              </div>
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