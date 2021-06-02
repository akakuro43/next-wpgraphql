<?php

// アイキャッチの使用
add_theme_support('post-thumbnails');

// 設定ファイル
include 'app/config.php';
// Meta
include 'app/meta.php';
// Pager
include 'app/pager.php';
// Session関連
include 'app/session.php';
// 会員情報DB操作系
include 'app/memberInfo.php';;

/**
 * Wppからwp_query用args取得.
 * wppでもwp_queryと同じ感覚で出力できるようidを取得し、wp_queryで用いる形でargsを出力します.
 *
 * @param string $post_type カスタム投稿を指定。デフォルトnull.
 * @param string $range |day|weekly|month|から集計期間を選択.
 * @param int    $limit 取得する件数のリミットを指定.
 * @return $wpp_id idを返す.
 */
function c_get_wpp_args( $post_types = [''], $range = 'weekly', $limit = 5 ) {
    $wpp_id = array();
    foreach($post_types as $post_type){
        $wpp_id = array_merge(
            $wpp_id,
            get_wpp_post_id($post_type, $range, $limit)
        );
    }

    $args = array(
        'post_type'      => $post_type,
        'posts_per_page' => $limit,
        'orderby'        => 'post__in',
        'order'          => 'DESC',
        'post_status'    => 'publish',
        'post__in'       => $wpp_id,
        'post__not_in'   => get_option( 'sticky_posts' ),
    );

    return $args;
}

function get_wpp_post_id( $post_type = '', $range = 'weekly', $limit = 5 ) {
    $wpp_args = array(
        'range'     => $range,
        'order_by'  => 'views',
        'post_type' => $post_type,
        'limit'     => $limit,
    );

    $wpp_query = new WPP_Query( $wpp_args );
    $wpp_posts = $wpp_query->get_posts();

    $wpp_id = array();
    if ( $wpp_posts ) {
        foreach ( $wpp_posts as $value ) {
            array_push( $wpp_id, intval( $value->id ) );
        }
    }
    return $wpp_id;
}

?>
