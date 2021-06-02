<?php
  /* Template Name: Labの歩き方 */

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
          <div class="l-content js-pjax-content" id="how-to-enjoy">
          <?php get_header(); ?>
          <div class="l-content__in bg-black">
              <section class="first"><img class="first__bg-top" src="<?php bloginfo('template_url'); ?>/assets/images/pc/how-to-enjoy/first/top-bg.png">
                <div class="c-inner">
                  <p class="first__title brown">How to enjoy</p>
                  <h2 class="first__subtitle brown">CULTIBASE Lab の歩き方</h2>
                  <div class="first__desc">
                    <p class="first__desc-paragraph">CULTIBASE Labにご参加いただき、どうもありがとうございます。<br class="u-pc-only">一緒に組織ファシリテーションを探究できること、とても嬉しく思います！</p>
                    <p class="first__desc-paragraph">「<span class="u-strong">CULTIBASE Labの歩き方</span>」では、<br class="u-pc-only">新しくCULTIBASE Labにご参加いただいた方向けに、<br class="u-pc-only">CULTIBASE Labの楽しみ方や困ったときの対処方法をまとめています。<br class="u-pc-only">まずは一通りご覧ください。</p>
                  </div>
                </div><img class="first__bg-bottom" src="<?php bloginfo('template_url'); ?>/assets/images/pc/how-to-enjoy/first/bottom-bg.png">
              </section>
              <section class="about">
                <div class="c-inner inner"><img class="about__bg-kv" src="<?php bloginfo('template_url'); ?>/assets/images/pc/how-to-enjoy/about/kv.png">
                  <h3 class="about__title brown">CULTIBASE Lab<span class="about__title-small">とは</span></h3>
                  <div class="about__desc">
                    <p class="about__desc-paragraph">CULTIBASE Labは、<br class="u-pc-only">人とチームの創造性を活かす「組織ファシリテーション」の技術と真髄を総合的に探究し、<br class="u-pc-only">現場で実践するためのオンライン学習プログラムです。</p>
                    <p class="about__desc-paragraph">チームや組織で起こる問題の多くは、人とチームの「創造性」の問題に行き着きます。<br class="u-pc-only">これらの問題を解決するには、トップダウン型の経営戦略やオペレーションだけでなく、<br class="u-pc-only">人間の心理やチームの関係性のメカニズムに基づく<br class="u-pc-only">ボトムアップ型のファシリテーションの技術が必要不可欠です。</p>
                    <p class="about__desc-paragraph">CULTIBASE Labでは、最新の学術知見をもとに、<br class="u-pc-only">「組織ファシリテーション」の技を探究します。</p>
                  </div><img class="about__bg-bg u-pc-only" src="<?php bloginfo('template_url'); ?>/assets/images/pc/how-to-enjoy/about/bg.png">
                </div>
              </section>
              <section class="process">
                <div class="c-inner">
                  <h3 class="process__title brown">楽しみ方</h3>
                  <p class="process__content-number brown">01</p>
                  <div class="process__wrap">
                    <div class="process__content-heading">
                      <h4 class="process__content-title">イベントに参加する</h4><a class="process__content-more brown" href="/event" target="_blank">イベント一覧へ</a>
                    </div>
                    <div class="process__content-desc">
                      <div class="process__content-text">
                        <p class="process__content-paragraph">CULTIBASE Labでは、毎週土曜日にオンライン講義を配信し、翌水曜日には、土曜日に更新されたコンテンツを題材としたウォッチパーティを行っています。</p>
                        <p class="process__content-paragraph">オンライン講義とウォッチパーティを含む全てのイベントは、<a class="process__content-link" href="/event" target="_blank">イベント一覧ページ</a>から確認できます。まずはぜひ、興味のあるイベントをご自分のカレンダーに登録してお待ちください。</p>
                        <p class="process__content-paragraph">当日は、該当するイベントページの「参加する」ボタンを押してご参加ください。</p>
                      </div>
                      <div class="process__content-image-wrap"><img class="process__content-image" src="<?php bloginfo('template_url'); ?>/assets/images/pc/how-to-enjoy/process/event.png"></div>
                    </div><img class="process__bg-first" src="<?php bloginfo('template_url'); ?>/assets/images/pc/how-to-enjoy/process/bg/first.png">
                  </div>
                  <p class="process__content-number brown">02</p>
                  <div class="process__wrap">
                    <div class="process__content-heading">
                      <h4 class="process__content-title">コンテンツを視聴する</h4><a class="process__content-more brown" href="/set-list" target="_blank">コンテンツパッケージ一覧へ</a>
                    </div>
                    <div class="process__content-desc">
                      <div class="process__content-text">
                        <p class="process__content-paragraph">「新着イベントを楽しむまでに時間がある」「過去コンテンツから興味のあるものをコツコツ見ていきたい」という方は、テーマごとにLabコンテンツがセレクトされた<a class="process__content-link" href="/set-list" target="_blank">コンテンツパッケージ</a>から気になるテーマを選び、そのパッケージに入っているコンテンツを見て楽しんでいただけたらと思います。</p>
                        <p class="process__content-paragraph">「どのコンテンツから見たら良いか迷うな…」という方は、CULTIBASE Labでの学びのキーワードや考え方について紹介しているコンテンツがまとまった<a class="process__content-link" href="https://cultibase.jp/set-list/5310/" target="_blank">組織ファシリテーション入門パッケージ</a>がオススメです。</p>
                        <p class="process__content-paragraph">1つのパッケージを見終わった頃には、興味関心のあるテーマやキーワードがより精緻になっているはずです。</p>
                      </div>
                      <div class="process__content-list process__content-list--package">
                        <div class="process__content-list-heading">おすすめコンテンツパッケージ</div>
                        <ul class="package__list">
                          <li class="package__item"><a class="package__link" href="https://cultibase.jp/set-list/5310/" target="_blank">
                              <div class="thumb"><img src="<?php bloginfo('template_url'); ?>/assets/images/pc/lab/content/img_package1.jpg"></div>
                              <h4 class="title">組織ファシリテーション入門</h4>
                              <p class="description">組織の創造性の土壌を耕し、組織変革をボトムアップ的に起こしていくファシリテーターとして活躍するための入門編パッケージです。個人の衝動や興味・関心を、対話によって創造的なコラボレーションへと結びつけ、組織全体のポテンシャルを引き出していくための理論と方法論をお届けします。</p></a></li>
                          <li class="package__item"><a class="package__link" href="https://cultibase.jp/set-list/5320/" target="_blank">
                              <div class="thumb"><img src="<?php bloginfo('template_url'); ?>/assets/images/pc/lab/content/img_package2.jpg"></div>
                              <h4 class="title">マネジメント入門</h4>
                              <p class="description">マネジャーになった当初は誰でも、拡大する業務範囲に戸惑ったり、何から学び始めたらいいかわからず不安を感じたりすることも多いはず。これらの"駆け出しマネージャー”たちが、マネジメントの基礎を充分に理解し、自信を持って最初の一歩を踏み出すためのコンテンツをまとめています。</p></a></li>
                        </ul>
                      </div>
                    </div><img class="process__bg-second" src="<?php bloginfo('template_url'); ?>/assets/images/pc/how-to-enjoy/process/bg/second.png">
                  </div>
                  <p class="process__content-number brown">03</p>
                  <div class="process__wrap">
                    <div class="process__content-heading">
                      <h4 class="process__content-title">Facebookグループで<br class="u-sp-only">会員同士で情報交換</h4><a class="process__content-more brown" href="https://www.facebook.com/groups/cultibaselab" target="_blank">Facebookグループページへ</a>
                    </div>
                    <div class="process__content-desc">
                      <div class="process__content-text">
                        <p class="process__content-paragraph">CULTIBASE Labでは、コンテンツを味わうことはもちろん、会員同士のコミュニケーションにより、学びを深めていくことができます。</p>
                        <p class="process__content-paragraph">CULTIBASE Lab会員同士のコミュニケーションツールとしてFacebookグループを使用しています。運営チームからの新着コンテンツの関連情報共有、会員同士でトピックを決めての意見交換などを行っています。</p>
                      </div>
                      <div class="process__content-list">
                        <div class="process__content-list-heading">こんな方におすすめ</div>
                        <ul>
                          <li class="process__content-list-item brown">更新コンテンツの周辺情報をキャッチアップしたい方</li>
                          <li class="process__content-list-item brown">インプットだけではなくアウトプットもしたいという方</li>
                          <li class="process__content-list-item brown">会員同士の横の繋がりをつくりたいという方</li>
                        </ul><img class="process__content-image process__content-list-image" src="<?php bloginfo('template_url'); ?>/assets/images/pc/how-to-enjoy/process/facebook.png">
                      </div>
                    </div><img class="process__bg-third" src="<?php bloginfo('template_url'); ?>/assets/images/pc/how-to-enjoy/process/bg/third.png">
                  </div>
                </div>
              </section>
              <section class="ground-rule">
                <div class="c-inner">
                  <p class="ground-rule__announce">CULTIBASE Labでの活動全般に<br>以下の「<span class="u-strong">グランドルール</span>」を設けています。</p>
                  <h3 class="ground-rule__title brown">CULTIBASE Lab のグランドルール</h3>
                  <div class="ground-rule__heading">
                    <p class="ground-rule__heading-paragraph">意見が異なる相手にも、敬意と礼儀を。違いを楽しもう。</p>
                    <p class="ground-rule__heading-paragraph">仕事に役立てる学びだけでなく、予想外のテーマから、関心の枠を広げていこう。</p>
                    <p class="ground-rule__heading-paragraph">“生煮え“の思考や、素朴な「わからなさ」も積極的に共有しよう。</p>
                  </div>
                  <p class="ground-rule__text">「グランドルール」は、みなさんが安心して交流・情報交換をしていただくためのルールです。<br>Labコンテンツへの参加や、Facebook上でのコミュニケーションなど、こちらのグランドルールを意識していただければと思います。</p><img class="ground-rule__kv u-pc-only" src="<?php bloginfo('template_url'); ?>/assets/images/pc/how-to-enjoy/ground-rule/kv.png">
                </div>
              </section>
              <section class="faq">
                <div class="c-inner">
                  <h3 class="faq__title brown">困った時には</h3>
                  <p class="faq__desc">入会時によくいただくご質問をまとめました</p>
                  <div class="divider"></div>
                  <ul class="faq__list">
                    <li class="faq__item">
                      <div class="faq__question"><span class="faq__question-heading brown">Q</span>
                        <p class="faq__question-text">新着コンテンツはどこで見られるでしょうか？</p>
                      </div>
                      <div class="faq__answer"><span class="faq__answer-heading brown">A</span>
                        <p class="faq__answer-text">最新記事は<a class="faq__link" href="/articles" target="_blank">記事一覧ページ</a>から、最新の動画は<a class="faq__link" href="/video" target="_blank">動画コンテンツページ</a>からご覧いただけます。<br>また、今後開催予定のイベントは<a class="faq__link" href="/event" target="_blank">イベント一覧ページ</a>からご覧いただけます。</p>
                      </div>
                    </li>
                    <div class="divider"></div>
                    <li class="faq__item">
                      <div class="faq__question"><span class="faq__question-heading brown">Q</span>
                        <div class="faq__question-text">基本的に個人のペースで学習したいのですが、Facebookグループは参加推奨でしょうか？</div>
                      </div>
                      <div class="faq__answer"><span class="faq__answer-heading brown">A</span>
                        <div class="faq__answer-text">基本的にコンテンツはすべてこのプラットフォームを介して提供いたしますので、参加は必須ではありません。<br class="u-pc-only">参加を迷われる方はまずはご参加いただき、様子を見て参加する・しないを判断いただくのがオススメです。</div>
                      </div>
                    </li>
                    <div class="divider"></div>
                    <li class="faq__item">
                      <div class="faq__question"><span class="faq__question-heading brown">Q</span>
                        <div class="faq__question-text">月会費の引き落としはどのように行われていますか？</div>
                      </div>
                      <div class="faq__answer"><span class="faq__answer-heading brown">A</span>
                        <div class="faq__answer-text">毎月1日にその月の月会費の決済が行われます。ご入会いただいた月の課金は発生いたしませんので翌月1日に翌月分の会費が前払いで行われます。</div>
                      </div>
                    </li>
                    <div class="divider"></div>
                  </ul>
                  <div class="faq__announce">上記で解決しない質問は下記の「FAQ」をご覧ください。<br class="u-pc-only">FAQをご覧になっても問題が解決しない場合、「<a class="faq__announce-mailto" href="mailto:info@cultibase.jp">info@cultibase.jp</a>」まで問い合わせください。<br>※返信に最大で3営業日いただきます。</div><a class="faq__more brown" href="/faq" target="_blank">FAQページへ</a>
                </div>
              </section>
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
