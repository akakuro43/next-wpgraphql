<?php

function pagination($pages, $paged) {
  $pages = ( int ) $pages;
  $paged = $paged ?: 1;

  if ($pages === 1) {
    // echo '<div class="pagination m-pagination"><span class="current pager">1</span></div>';
    return;
  }

  if (1 !== $pages) {
    echo '<div class="c-pager">';

    // PREVボタンの設置
    if( 1 < $paged) {
      echo '<a class="prev page-numbers js-pjax-exclude" href="', get_pagenum_link( $paged - 1 ) ,'"></a>';
    }

    for($i = 1; $i <= $pages; $i++){
      if($paged === $i){
        echo '<span class="page-numbers current" aria-current="page">', $i ,'</span>';
      }else {
        echo '<a href="', get_pagenum_link( $i ) ,'" class="page-numbers js-pjax-exclude">', $i ,'</a>';
      }
    }

    // NEXTボタンの設置
    if( $paged < $pages) {
      echo '<a class="next page-numbers js-pjax-exclude" href="', get_pagenum_link( $paged + 1 ) ,'"></a>';
    }
    echo '</div>';
  }
}
?>