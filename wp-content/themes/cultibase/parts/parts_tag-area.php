<section class="c-tagArea">
  <h2 class="headline"><span class="en">Tag</span><span class="ja">人気のタグ</span></h2>
  
  <?php
    $args = array(
    'orderby' => 'count',
    'order' => 'DESC',
    'number'=>'10',
    );
    $posttags = get_tags( $args );
  ?>

  <ul class="tag__list">
    <?php foreach($posttags as $tag):?>
      <li class="tag__item"><a class="itemLink" href="<?php echo get_tag_link( $tag->term_id );?>"><span class="hash">＃</span><span class="tagName"><?php echo $tag->name?></span></a></li>
    <?php endforeach;?>
    </ul><a class="link" href="/tag-list"><span class="link__txt">タグ一覧へ</span><span class="link__icn">
      <svg class="c-nextIcon" xmlns="http://www.w3.org/2000/svg" width="10" height="11" viewBox="0 0 10 11" id="">
        <path d="M4.24264 1.00003L8.48528 5.24268L4.24264 9.48532" stroke="black" stroke-width="2" fill="none"></path>
      </svg></span></a>
</section>