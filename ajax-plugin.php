<?php

/*
Plugin Name: Ajax
Plugin URI:
Description: Ajax Plugin for W4P.
Version: 1.0
Author: Vladyslav Kukil
*/

require_once 'class-ajax-search-widget.php';

add_action('wp_ajax_getposttitle', 'get_title_func');
add_action('wp_ajax_nopriv_getposttitle', 'get_title_func');

function get_title_func(){
    global $wpdb;
    $post_title = !empty($_POST['post_title']) ? $_POST['post_title'] : 0;
    $post_date = ! empty($_POST['post_date']) ? intval($_POST['post_date']) : 0;
    $posts = $wpdb->get_results("SELECT * FROM wp_w42405vkpposts WHERE post_title = '$post_title '");

    if( $posts ){
        foreach ($posts as $post) {
            $url = get_post_permalink($post);
            if($post->post_date > $post_date ) { ?>
                <a href="<?php echo $url; ?>"><?php echo $post->post_title; ?></a><br>
                <?php
            } else{
                echo "Post not found"  . '<br>';
            }
            die();
        }
    } else {
        echo 'Not found' . '<br>';
        die();
    }
}