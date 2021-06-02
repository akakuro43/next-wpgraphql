<?php
  /* Template Name: FAQ */
  get_template_part("/parts/parts_head");

  $loginFlg = getSessionLoginFlg();
  $postId = get_the_id();
  $faqGroups = get_field('faq_group', $postId);
  $no = 0
  
?>
<body>
    <?php get_template_part("/parts/parts_gtm_body_under"); ?>
    <div class="l-app">
      <main>
        <div class="l-contents js-pjax-contents" data-scroll-section>
          <div class="l-content js-pjax-content" id="faq">
          <?php get_header(); ?>
          <div class="l-content__in">
              <section>
                <div class="c-inner">
                  <h2 class="c-page-title-en-jp--center"><span class="en">FAQ</span><span class="ja">よくある質問</span></h2>
                </div>
              </section>
              <section class="s-faq">
                <div class="c-inner">
                  <?php foreach($faqGroups as $faqGroup):
                    $groupName = $faqGroup['group_ttl'];
                    $groupListIdAry = $faqGroup['faq_list'];
                  ?>
                    <div class="faq-group">
                      <h2 class="faq__ttl"><?php echo $groupName; ?></h2>
                      <ul class="page-faq__list">
                        <?php
                          foreach($groupListIdAry as $id):
                            $ttl = get_the_title($id);
                            $answer = get_field('answer', $id);
                            $type = get_field('type', $id);

                            if($loginFlg) {
                              if ($type == 'only-free') continue;
                            } else {
                              if ($type == 'only-lab') continue;
                            }
                            $no++;
                            // echo $type;
                        ?>
                        <li class="page-faq__list-item">
                          <input class="page-faq__list-input-check" id="faq-<?php echo $no; ?>" type="checkbox">
                          <label class="page-faq__list-title" for="faq-<?php echo $no; ?>"><?php echo $ttl; ?>
                            <div class="page-faq__list-icon">
                              <div class="plus-icon"></div>
                            </div>
                          </label>
                          <div class="page-faq__list-content"><?php echo $answer; ?></div>
                        </li>
                        <?php endforeach; ?>
                      </ul>
                    </div>
                  <?php endforeach; ?>
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
