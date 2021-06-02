<?php
  /* Template Name: タグ一覧 */
  get_template_part("/parts/parts_head"); ?>
  <body>
    <?php get_template_part("/parts/parts_gtm_body_under"); ?>
    <div class="l-app">
      <main>
        <div class="l-contents js-pjax-contents" data-scroll-section>
          <div class="l-content js-pjax-content" id="tag-list">
            <?php get_header(); ?>
            <div class="l-content__in">
              <div class="frame">
                <div class="frame__main">
                  <section class="s-tagList">
                    <div class="c-main-inner">
                      <h2 class="tagList__ttl">タグ一覧</h2>
                    </div>
                  </section>
                  <section class="s-tags">
                    <div class="c-main-inner">
                      <ul class="tag__list">
                        <?php
                          $term_list = get_terms('post_tag');
                          foreach ($term_list as $term) :
                            $u = (get_term_link( $term, 'post_tag' ));
                        ?>
                          <li class="tag__item"><a class="itemLink" href="<?php echo $u; ?>"><span class="hash">＃</span><span class="tagName"><?php echo $term->name; ?></span><span class="num">(<?php echo $term->count; ?>)</span></a></li>
                        <?php endforeach; ?>
                        
                        
                      </ul>
                      <!-- <div class="c-pager"><span class="page-numbers current" aria-current="page">1</span><a class="page-numbers" href="#">2</a><a class="page-numbers" href="#">3</a><a class="next page-numbers" href="#"></a></div> -->
                    </div>
                  </section>
                </div>
                <div class="frame__sub">
                  <?php get_template_part("/parts/parts_side-about"); ?>
                  <?php get_template_part("/parts/parts_ranking-article"); ?>
                  <?php get_template_part("/parts/parts_tag-area"); ?>                  
                </div>
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