<?php
  /* Template Name: 退会の手続き */

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
    $withdrawalUserInfo = getWithdrawalUserInfo($memberId);
    
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
                    <h2 class="ttl">退会の手続き</h2>
                  </div>
                  <div class="form__main">
                    <!-- SMP_TEMPLATE_FORM start-->
                    <form method="post" action="<?php echo $ACTION_URL; ?>">
                    <div class="smp_tmpl">
                        <dl class="cf">
                          <dt class="title title-lg">満足度について
                            <p class="subTxt">提供サービスの満足度について教えてください。</p>
                          </dt>
                        </dl>
                        <dl class="cf">
                          <dt class="title">ライブイベント（毎週土曜日配信） <span class="need">＊</span></dt>
                          <dd class="data multi2 data-select">
                            <select class="select $errorInputColor:satisfaction1$" name="satisfaction1">
                              <option value="">-</option>
                              <option value="1" $satisfaction1:1$="">満足</option>
                              <option value="2" $satisfaction1:2$="">まま満足</option>
                              <option value="3" $satisfaction1:3$="">あまり満足していない</option>
                              <option value="4" $satisfaction1:4$="">全く満足していない</option>
                              <option value="5" $satisfaction1:5$="">利用したことがない</option>
                            </select>
                          </dd>
                        </dl>
                        <dl class="cf">
                          <dt class="title">ウォッチパーティー <span class="need">＊</span></dt>
                          <dd class="data multi2 data-select">
                            <select class="select $errorInputColor:satisfaction2$" name="satisfaction2">
                              <option value="">-</option>
                              <option value="1" $satisfaction2:1$="">満足</option>
                              <option value="2" $satisfaction2:2$="">まま満足</option>
                              <option value="3" $satisfaction2:3$="">あまり満足していない</option>
                              <option value="4" $satisfaction2:4$="">全く満足していない</option>
                              <option value="5" $satisfaction2:5$="">利用したことがない</option>
                            </select>
                          </dd>
                        </dl>
                        <dl class="cf">
                          <dt class="title">月初キックオフ<span class="need">＊</span></dt>
                          <dd class="data multi2 data-select">
                            <select class="select $errorInputColor:satisfaction3$" name="satisfaction3">
                              <option value="">-</option>
                              <option value="1" $satisfaction3:1$="">満足</option>
                              <option value="2" $satisfaction3:2$="">まま満足</option>
                              <option value="3" $satisfaction3:3$="">あまり満足していない</option>
                              <option value="4" $satisfaction3:4$="">全く満足していない</option>
                              <option value="5" $satisfaction3:5$="">利用したことがない</option>
                            </select>
                          </dd>
                        </dl>
                        <dl class="cf">
                          <dt class="title">メディア記事<span class="need">＊</span></dt>
                          <dd class="data multi2 data-select">
                            <select class="select $errorInputColor:satisfaction4$" name="satisfaction4">
                              <option value="">-</option>
                              <option value="1" $satisfaction4:1$="">満足</option>
                              <option value="2" $satisfaction4:2$="">まま満足</option>
                              <option value="3" $satisfaction4:3$="">あまり満足していない</option>
                              <option value="4" $satisfaction4:4$="">全く満足していない</option>
                              <option value="5" $satisfaction4:5$="">利用したことがない</option>
                            </select>
                          </dd>
                        </dl>
                        <dl class="cf">
                          <dt class="title">コンテンツパッケージ<span class="need">＊</span></dt>
                          <dd class="data multi2 data-select">
                            <select class="select $errorInputColor:satisfaction5$" name="satisfaction5">
                              <option value="">-</option>
                              <option value="1" $satisfaction5:1$="">満足</option>
                              <option value="2" $satisfaction5:2$="">まま満足</option>
                              <option value="3" $satisfaction5:3$="">あまり満足していない</option>
                              <option value="4" $satisfaction5:4$="">全く満足していない</option>
                              <option value="5" $satisfaction5:5$="">利用したことがない</option>
                            </select>
                          </dd>
                        </dl>
                        <dl class="cf">
                          <dt class="title">Facebookグループ<span class="need">＊</span></dt>
                          <dd class="data multi2 data-select">
                            <select class="select $errorInputColor:satisfaction6$" name="satisfaction6">
                              <option value="">-</option>
                              <option value="1" $satisfaction6:1$="">満足</option>
                              <option value="2" $satisfaction6:2$="">まま満足</option>
                              <option value="3" $satisfaction6:3$="">あまり満足していない</option>
                              <option value="4" $satisfaction6:4$="">全く満足していない</option>
                              <option value="5" $satisfaction6:5$="">利用したことがない</option>
                            </select>
                          </dd>
                        </dl>
                        <dl class="cf">
                          <dt class="title">プラットフォーム（CULTIBASE Webサイト）<span class="need">＊</span></dt>
                          <dd class="data multi2 data-select">
                            <select class="select $errorInputColor:satisfaction7$" name="satisfaction7">
                              <option value="">-</option>
                              <option value="1" $satisfaction7:1$="">満足</option>
                              <option value="2" $satisfaction7:2$="">まま満足</option>
                              <option value="3" $satisfaction7:3$="">あまり満足していない</option>
                              <option value="4" $satisfaction7:4$="">全く満足していない</option>
                              <option value="5" $satisfaction7:5$="">利用したことがない</option>
                            </select>
                          </dd>
                        </dl>
                        <dl class="cf">
                          <dt class="title title-lg">退会理由
                            <p class="subTxt">退会理由を教えてください。</p>
                          </dt>
                          <dd class="data multi2">
                            <ul class="cf checkbox__list">
                              <li class="checkbox__item">
                                <label>
                                  <input class="input-checkbox" type="checkbox" value="1" name="resonSelect"><span class="checkbox__txt">興味のあるコンテンツがない</span>
                                </label>
                              </li>
                              <li class="checkbox__item">
                                <label>
                                  <input class="input-checkbox" type="checkbox" value="2" name="resonSelect"><span class="checkbox__txt">知りたいナレッジが得られない</span>
                                </label>
                              </li>
                              <li class="checkbox__item">
                                <label>
                                  <input class="input-checkbox" type="checkbox" value="3" name="resonSelect"><span class="checkbox__txt">コンテンツを楽しむ時間がない</span>
                                </label>
                              </li>
                              <li class="checkbox__item">
                                <label>
                                  <input class="input-checkbox" type="checkbox" value="4" name="resonSelect"><span class="checkbox__txt">コンテンツを使いこなせない</span>
                                </label>
                              </li>
                              <li class="checkbox__item">
                                <label>
                                  <input class="input-checkbox" type="checkbox" value="5" name="resonSelect"><span class="checkbox__txt">学べている感覚がない</span>
                                </label>
                              </li>
                              <li class="checkbox__item">
                                <label>
                                  <input class="input-checkbox" type="checkbox" value="6" name="resonSelect"><span class="checkbox__txt">学びたいことを学びきった</span>
                                </label>
                              </li>
                              <li class="checkbox__item">
                                <label>
                                  <input class="input-checkbox" type="checkbox" value="7" name="resonSelect"><span class="checkbox__txt">ほかに優先して学びたいことができた</span>
                                </label>
                              </li>
                              <li class="checkbox__item">
                                <label>
                                  <input class="input-checkbox" type="checkbox" value="8" name="resonSelect"><span class="checkbox__txt">会社の業務が変更になり、必要なくなった</span>
                                </label>
                              </li>
                              <li class="checkbox__item">
                                <label>
                                  <input class="input-checkbox" type="checkbox" value="9" name="resonSelect"><span class="checkbox__txt">料金が高い</span>
                                </label>
                              </li>
                              <li class="checkbox__item">
                                <label>
                                  <input class="input-checkbox" type="checkbox" value="10" name="resonSelect"><span class="checkbox__txt">プラットフォームが使いづらい</span>
                                </label>
                              </li>
                              <li class="checkbox__item">
                                <label>
                                  <input class="input-checkbox" type="checkbox" value="11" name="resonSelect"><span class="checkbox__txt">その他（自由記入）</span>
                                </label>
                              </li>
                            </ul>
                            <input type="hidden" value="" name="resonSelect">
                          </dd>
                        </dl>
                        <dl class="cf">
                          <dt class="title mt-20px">その他（自由記入）</dt>
                          <dd class="data">
                            <textarea class="textarea" name="reasonTextArea" rows="4" wrap="soft" placeholder="退会理由の詳細など、差し支えない範囲で教えてください。また、サービス改善したほうがよいと思われる部分などもございましたらぜひお聞かせください。"></textarea>
                          </dd>
                        </dl>
                        <dl class="cf">
                          <dt class="title title-lg">ヒアリング協力
                            <p class="subTxt">サービス向上のため、退会された方何名かにオンラインで1時間程度ヒアリングさせていただいております。ヒアリング協力可能な方はチェックをつけてください。</p>
                          </dt>
                          <dd class="data multi2">
                            <ul class="cf checkbox__list">
                              <li class="checkbox__item">
                                <label>
                                  <input class="input-checkbox" type="checkbox" value="1" name="hearing"><span class="checkbox__txt">ヒアリングに協力可能</span>
                                </label>
                              </li>
                            </ul>
                            <input type="hidden" value="" name="hearing">
                          </dd>
                        </dl>
                      </div>
                      <input type="hidden" name="detect" value="判定">
                      <!-- 管理ID-->
                      <input type="hidden" name="SMPFORM" value="<?php echo $SMPFORM_VALUE_WITHDRAWAL; ?>">
                      <input type="hidden" name="registDate" value="<?php echo $withdrawalUserInfo['registDate']; ?>">
                      <input type="hidden" name="email" value="<?php echo $withdrawalUserInfo['email']; ?>">
                      <input type="hidden" name="memberId" value="<?php echo $withdrawalUserInfo['memberId']; ?>">
                      <input type="hidden" name="userName" value="<?php echo $withdrawalUserInfo['userName']; ?>">
                      <input type="hidden" name="birthday" value="<?php echo $withdrawalUserInfo['birthday']; ?>">
                      <input type="hidden" name="company" value="<?php echo $withdrawalUserInfo['company']; ?>">
                      <input type="hidden" name="jobType" value="<?php echo $withdrawalUserInfo['jobType']; ?>">
                      <input type="hidden" name="joinPoint" value="<?php echo $withdrawalUserInfo['joinPoint']; ?>">
                      <input type="hidden" name="delKey" value="<?php echo $withdrawalUserInfo['delKey']; ?>">
                      <input type="hidden" name="paymentGid" value="<?php echo $withdrawalUserInfo['paymentGid']; ?>">
                      <input type="hidden" name="paymentAcid" value="<?php echo $withdrawalUserInfo['paymentAcid']; ?>">
                      <input type="hidden" name="orderID" value="<?php echo $withdrawalUserInfo['orderID']; ?>">
                      <input class="submit" type="submit" name="submit" value="会員を退会する">
                    </form>
                    <a class="backToAccountBtn" href="/account">アカウント設定に戻る</a>
                    <!-- SMP_TEMPLATE_FORM end -->
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