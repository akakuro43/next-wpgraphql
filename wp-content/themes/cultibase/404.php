<?php get_template_part("/parts/parts_head"); ?>
<body>
<?php get_template_part("/parts/parts_gtm_body_under"); ?>
  <div class="l-page">
    <?php get_header(); ?>
    <main class="page-notfound">
      <img class="page-notfound__img" src="<?php bloginfo('template_url'); ?>/assets/images/common/404.png">
      <div class="page-notfound__content">
        <p>お探しのページは見つかりませんでした。</p>
        <p class="page-notfound__text">
          あなたがアクセスしようとしたページは削除されたか<br>
          URLが変更されているため、見つけることができません。<br>
          お手数ですが、以下の方法でページをお探しください。
        </p>
        <div>
          <a class="page-notfound__btn" href="/">サイトTOPへ戻る</a>
        </div>
      </div>
    </main>
  </div>
  <?php get_template_part("parts_scripts"); ?>
</body>
</html>
