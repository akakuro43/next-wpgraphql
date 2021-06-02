<?php
  /* Template Name: プロフィール変更 */

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
    $profileInfo = getProfileInfo($memberId);
    // セッション情報を更新する
    setSessionAll($userInfo);

    // ページ内の表示に使用する情報取得
    $userName = $userInfo['userName'];
    $delKey = $userInfo['delKey'];
    $email = $userInfo['email'];
    $company = $profileInfo['company'];
    $jobType = $profileInfo['jobType'];
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
                    <h2 class="ttl">プロフィールの変更</h2>
                  </div>
                  <div class="form__main">
                    <!-- SMP_TEMPLATE_FORM start-->
                    <form method="post" action="<?php echo $ACTION_URL; ?>">
                      <div class="smp_tmpl">
                        <dl class="cf">
                          <dt class="title">お名前（漢字）<span class="need">*</span></dt>
                          <dd class="data data-name">
                            <input class="input $errorInputColor:userName$" type="text" name="userName" value="<?php echo $userName;?>" maxlength="32">
                          </dd>
                        </dl>
                        <dl class="cf">
                          <dt class="title">会社名<span class="need">*</span></dt>
                          <dd class="data data-name">
                            <input class="input $errorInputColor:company$" type="text" name="company" value="<?php echo $company;?>" maxlength="64">
                          </dd>
                        </dl>
                        <dl class="cf">
                          <dt class="title">職種<span class="need">*</span></dt>
                          <dd class="data data-select">
                            <select class="select $errorInputColor:jobType$" name="jobType">
                              <option value="1" <?php if($jobType == 1) echo 'selected'; ?> $jobtype:1$="">営業・販売・サービス</option>
                              <option value="2" <?php if($jobType == 2) echo 'selected'; ?> $jobtype:2$="">企画・広報・マーケティング</option>
                              <option value="3" <?php if($jobType == 3) echo 'selected'; ?> $jobtype:3$="">人事・人材育成</option>
                              <option value="4" <?php if($jobType == 4) echo 'selected'; ?> $jobtype:4$="">エンジニア・技術職</option>
                              <option value="5" <?php if($jobType == 5) echo 'selected'; ?> $jobtype:5$="">デザイン・クリエイティブ</option>
                              <option value="6" <?php if($jobType == 6) echo 'selected'; ?> $jobtype:6$="">医療・看護・福祉</option>
                              <option value="7" <?php if($jobType == 7) echo 'selected'; ?> $jobtype:7$="">事務・総務</option>
                              <option value="8" <?php if($jobType == 8) echo 'selected'; ?> $jobtype:8$="">教育・公務員</option>
                              <option value="9" <?php if($jobType == 9) echo 'selected'; ?> $jobtype:9$="">専門職（研究者・専門事務所等）</option>
                              <option value="10" <?php if($jobType == 10) echo 'selected'; ?> $jobtype:10$="">コンサルタント</option>
                              <option value="11" <?php if($jobType == 11) echo 'selected'; ?> $jobtype:11$="">学生</option>
                              <option value="12" <?php if($jobType == 12) echo 'selected'; ?> $jobtype:12$="">その他</option>
                            </select>
                          </dd>
                        </dl>
                      </div>
                      <input type="hidden" name="detect" value="判定">
                      <!-- 管理ID-->
                      <input type="hidden" name="SMPFORM" value="<?php echo $SMPFORM_VALUE_EDIT_PROFILE; ?>">
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