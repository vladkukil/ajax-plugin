<?php

/*
Plugin Name: Ajax
Plugin URI:
Description: Ajax Plugin for W4P.
Version: 1.0
Author: Vladyslav Kukil
*/

add_action( 'wp_enqueue_scripts', 'my_scripts_method' );
function my_scripts_method(){
    wp_enqueue_script( 'jquery' );
}

require_once 'class-ajax-search-widget.php';

add_action('wp_ajax_getposttitle', 'get_title_func');
add_action('wp_ajax_nopriv_getposttitle', 'get_title_func');

$admin_url = admin_url('admin-ajax.php');

function get_title_func(){
    global $wpdb;
    $post_title = !empty($_POST['post_title']) ? $_POST['post_title'] : 0;
    $post_date = ! empty($_POST['post_date']) ? intval($_POST['post_date']) : 0;
    $query = $wpdb->prepare('SELECT * FROM wp_w42405vkpposts WHERE post_title = %s', $post_title);
    $posts = $wpdb->get_results($query);

    if( $posts ){
        foreach ($posts as $post) {
            $url = get_post_permalink($post);
            if($post->post_date > $post_date ) { ?>
                <a href="<?php echo $url; ?>"><?php _e($post->post_title); ?></a><br>
                <?php
            } else{
                echo '__(Post not found)'  . '<br>';
            }
            wp_die();
        }
    } else {
        echo '__(Not found)' . '<br>';
        wp_die();
    }
}

add_action( 'wp_enqueue_scripts', 'my_wp_ajax_script' );

function my_wp_ajax_script(){
    wp_enqueue_script( 'ajax', plugins_url()  . '/ajax-plugin/ajax.js');
}


?>

<div class="admin-ajax" data-attr="<?php echo $admin_url ?>"></div>
