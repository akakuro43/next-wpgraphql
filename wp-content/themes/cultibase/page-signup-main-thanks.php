<?php
  /* Template Name: 新規会員登録（本登録）_サンクス画面 */


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
                  <h2 class="ttl">会員情報の登録が<br>完了いたしました</h2>
                  <a class="btn js-btn-back" href="<?php echo $HOME_URL; ?>">閲覧ページに戻る</a>
                  <script>
                    let url = localStorage.getItem("beforeLoginURL");
                    document.querySelector('.js-btn-back').href = url;
                  </script>
                  <a class="btn btn-mt" href="<?php echo $HOME_URL; ?>">トップに戻る</a>
                  </div>
                  <div class="form__footer"></div>
                </section>
              </div>
            </div>
          </div>
        </div>
      </main>
      <div class="js-pjax-sub-content1">
      <div class="form__bgImg" data-src-bg="<?php bloginfo('template_url'); ?>/assets/images/pc/login/bg_login1.jpg"></div>
      </div>
    </div>
    <?php get_template_part("/parts/parts_scripts"); ?>
  </body>
</html>