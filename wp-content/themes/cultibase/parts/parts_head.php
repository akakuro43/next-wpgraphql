<!DOCTYPE html>
<?php 
$loginFlg = getSessionLoginFlg();
?>
<html lang="ja" class="<?php if($loginFlg) echo 'is-login' ?>">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Language" content="ja">
  <title><?php echo_meta('title'); ?></title>
  <meta name="description" content="<?php echo_meta('description'); ?>">
  <meta property="og:title" content="<?php echo_meta('title'); ?>">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?php echo_meta('og_url'); ?>">
  <meta property="og:site_name" content="">
  <meta property="og:description" content="<?php echo_meta('description'); ?>">
  <meta property="og:locale" content="ja_JP">
  <meta property="og:image" content="<?php echo_meta('og_image'); ?>">
  <meta property="fb:app_id" content="146752389058128">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?php echo_meta('title'); ?>">
  <meta name="twitter:description" content="<?php echo_meta('description'); ?>">
  <meta name="twitter:image" content="<?php echo_meta('og_image'); ?>">
  <meta name="twitter:url" content="<?php echo_meta('og_url'); ?>">
  <meta name="format-detection" content="telephone=no">
  <meta name="robots" content="<?php if(!get_field('noindex')): ?>all<?php else: ?>none<?php endif; ?>">
  <link class="favicon" rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/assets/images/common/favicon.ico">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('template_url'); ?>/assets/images/common/app_icon.png" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0, shrink-to-fit=no">
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/main.css">
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-P84735C');</script>
  <!-- End Google Tag Manager -->
  <?php wp_head(); ?>
</head>
