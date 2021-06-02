<?php
//===========================
// Meta情報を設定する
//===========================
function echo_meta($name){
  global $post;

  switch($name){
    case 'title':
      if(is_home()){
        $title = get_bloginfo('name');
      }else{
        $title = get_post_meta($post->ID, 'meta_title', true);

        if(empty($title)){
          $title = wp_title('', false);
        }

        $title .= ' | ' . get_bloginfo('name');
      }

      echo $title;

      break;
    case 'description':
      if(is_home()){
        $description = get_bloginfo('description');
      // }else if(get_post_type() == 'project' && is_archive()){
      //   $description ="アーカイブ記事のデスクリプション";
      // }else if(get_post_type() == 'news' && is_archive()){
      //   $description ="アーカイブ記事のデスクリプション";
      // }else if(is_single()){
      } else {
        $description = get_post_meta($post->ID, 'meta_description', true);
        if(empty($description)){
          $description = get_bloginfo('description');
        }
      }

      echo $description;

      break;
    case 'og_url':
      if(is_home()){
        $og_url = 'https://cultibase.jp/';
      }else{
        $og_url = get_permalink($post->id);
      }

      echo $og_url;

      break;
    case 'og_image':
      if(is_single()){
        $postType = get_post_type();
        if($postType == 'radio') {
          $radioTypeId = get_field('radio_type');
          $og_image = get_field('tectangle_thumb', $radioTypeId);
        } else {
          $og_image = the_post_thumbnail_url('full');
          
        }
        
      }else{
        $og_image = bloginfo('template_url').'/assets/images/common/og_image.png';
      }

      echo $og_image;

      break;
  }
}
?>