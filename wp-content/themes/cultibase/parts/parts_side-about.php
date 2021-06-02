<?php
  $loginFlg = getSessionLoginFlg();
  if($loginFlg) : 
?>
  <a class="c-sideAbout u-pc-only" href="/how-to-enjoy">
    <div class="sideAbout__img"><img src="<?php bloginfo('template_url'); ?>/assets/images/pc/common/img_side_how_to.jpg" alt="CULTIBASELabの歩き方">
    </div>
  </a>
<?php else : ?>
  <a class="c-sideAbout u-pc-only" href="/lab">
    <div class="sideAbout__img"><img src="<?php bloginfo('template_url'); ?>/assets/images/pc/common/img_side_lab.jpg" alt="CULTIBASELabの紹介">
    </div>
  </a>
<?php endif; ?>