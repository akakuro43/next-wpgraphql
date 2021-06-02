<?php
  /* Template Name: ログイン */

  // エラーメッセージフラグ
  $isErrorMissmach = false;
  $isErrorInputID = false;
  $isErrorInputPW = false;
  $isErrorMismatchPW = false;;
  $isErrorNotFoundUser = false;
  $isErrorUnsubscribed = false;
  $isErrorUnsettled = false;
  // 既にログイン済みの場合は遷移前のページに戻す
  $loginFlg = getSessionLoginFlg();
  // echo $loginFlg;
  if($loginFlg) {
      // ログイン前の画面へ戻る
      echo '<script>location.href=localStorage.getItem("beforeLoginURL");</script>';
  }
    
  if(isset($_POST['email']) && isset($_POST['password'])){
      $email = $_POST['email'];
      $password = $_POST['password'];

      // メールアドレスで情報を取得する
      $isUser = hasUser($email);
      // echo $isUser;
      
      if($isUser) {
        // ユーザー存在する
        // ユーザ情報を取得する
        $userInfo = getUserInfo($email, $password);
        // echo $userInfo['email'];
        if($userInfo['email'] == $email) {
          // ユーザー情報取得

          // ステータス確認
          if($userInfo["memberStatus"] == 2) {
            //退会済みの場合
            $isErrorUnsubscribed = true;
          } else if($userInfo["memberStatus"] == 3) {
            //支払い滞納中の場合
            $isErrorUnsettled = true;
          } else if($userInfo["paymentResult"] != 1 && $userInfo["memberPlan"] == 1) {
              //決済失敗の場合
              $isErrorUnsettled = true;
          } else {
            // 入会中の場合：succcess
            // ログイン状態にDBを書き換える
            $loginResult = selectUpdateLogin($email);
            // echo $loginResult;
            // ログイン可否
            if($loginResult == 1) {
                // 成功の場合
                // セッションに情報を入れる
                $userInfo['loginFlg'] = 1;
                // print_r($userInfo);
                setSessionAll($userInfo);
                // ログイン前の画面へ戻る
                echo '<script>location.href=localStorage.getItem("beforeLoginURL");</script>';

            } else {
                // 失敗の場合：このケースはあり得ない
                // セッション情報の削除
                clearSessionAll();
                $isErrorMissmach = true;
            }
          }

        } else {
          // ユーザー情報取得できない場合（パスワード不一致）
          clearSessionAll();
          $isErrorMismatchPW = true;
        }        

      } else {
        // ユーザー存在しない
        $isErrorNotFoundUser = true;

      }
  } else if(!isset($_POST['email']) && isset($_POST['password'])) {
    $isErrorInputID = true;
  } else if(!isset($_POST['password']) && isset($_POST['email'])) {
    $isErrorInputPW = true;
  }
  
  get_template_part("/parts/parts_head"); ?>
  <body>
    <?php get_template_part("/parts/parts_gtm_body_under"); ?>
    <div class="l-app">
    <main>
        <div class="l-contents js-pjax-contents" data-scroll-section>
          <div class="l-content js-pjax-content" id="login">
            
            <div class="l-content__in">
              
                <section class="s-login">
                  <div class="login__logo"><span class="u-pc-only">
                    <img src="<?php bloginfo('template_url'); ?>/assets/images/common/logo_cultibase_lab.png" alt="CULTIBASELab" />
                  </div>
                  
                  <div class="login__inner">
                    <div class="login__header">
                      <h2 class="ttl">Lab会員ログイン</h2>
                    </div>
                    <div class="login__main">
                      <form action="/login/" method="post">
                        <dl class="cf">
                          <dt class="title">メールアドレス</dt>
                          <dd class="data">
                            <input class="input" type="text" name="email">
                          </dd>
                        </dl>
                        <dl class="cf">
                          <dt class="title">パスワード</dt>
                          <dd class="data">
                            <input class="input" type="password" name="password">
                          </dd>
                        </dl>
                        <?php if($isErrorMissmach) {
                            echo '<p class="msg">メールアドレスまたはパスワードが<br>正しくありません。</p>';
                        }
                        ?>
                        <?php if($isErrorNotFoundUser) {
                            echo '<p class="msg">ユーザーが存在しません。</p>';
                        }
                        ?>
                        <?php if($isErrorUnsubscribed) {
                            echo '<p class="msg">退会されています。<br>Lab会員登録を行ってください。</p>';
                        }
                        ?>
                        <?php if($isErrorInputID) {
                            echo '<p class="msg">メールアドレスを入力してください。</p>';
                        }
                        ?>
                        <?php if($isErrorUnsettled) {
                            echo '<p class="msg">決済が完了していないため、ログインできません。</p>';
                        }
                        ?>
                        
                        <?php if($isErrorInputPW) {
                            echo '<p class="msg">パスワードを入力してください。</p>';
                        }
                        ?>
                        <?php if($isErrorMismatchPW) {
                            echo '<p class="msg">パスワードが異なります。</p>';
                        }
                        ?>
                        
                        <button class="loginBtn js-loginBtn" type="submit">ログイン</button>
                      </form>
                      <p class="passwordLink"><a class="link" href="<?php echo $SPIRAL_REREGIST_PW_URL; ?>">パスワードをお忘れの方はこちら</a></p>
                      <div class="line"></div>
                      <div class="signup">
                        <p class="signup__txt">Lab会員登録がまだの方はこちら</p>
                        <a class="sideAbout__img" href="/lab"><img src="<?php bloginfo('template_url'); ?>/assets/images/pc/common/img_side_lab.jpg" alt="CULTIBASE Lab" /></a>
                      </div>
                    </div>
                  </div>
                </section>
            </div>
          </div>
        </div>
      </main>
      <div class="js-pjax-sub-content1">
        <div class="login__bg" data-src-bg="<?php bloginfo('template_url'); ?>/assets/images/pc/login/bg_login1.jpg"></div>
      </div>
    </div>
    <?php get_template_part("/parts/parts_scripts"); ?>
  </body>
</html>