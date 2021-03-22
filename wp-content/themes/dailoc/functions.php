<?php

/* Gọi đến file này để khởi động các package cần sử dụng */
require_once(get_template_directory() . '/vendor/autoload.php');

add_action('pre_get_posts', function($query) {
    if($query->is_search() && !$query->is_admin() && $query->is_main_query()) {
        $query->set('post_type', 'product');
    }
});

add_filter('woocommerce_checkout_fields', function($fields) {
    foreach($fields as &$fieldset) {
        foreach($fieldset as &$field) {
            // if you want to add the form-group class around the label and the input
            $field['class'][] = 'form-group';
    
            // add form-control to the actual input
            $field['input_class'][] = 'form-control';
        }
    }
    return $fields;
});


add_theme_support('woocommerce');
add_theme_support('wc-product-gallery-zoom');
add_theme_support('wc-product-gallery-lightbox');
add_theme_support('wc-product-gallery-slider');

function getPostViews($postID){
     $count_key = 'post_views_count';
     $count = get_post_meta($postID, $count_key, true);
     if($count==''){
         delete_post_meta($postID, $count_key);
         add_post_meta($postID, $count_key, '0');
         return "0 View";
     }
     return $count;
}
function setPostViews($postID) {
     $count_key = 'post_views_count';
     $count = get_post_meta($postID, $count_key, true);
     if($count==''){
         $count = 0;
         delete_post_meta($postID, $count_key);
         add_post_meta($postID, $count_key, '0');
     }else{
        $count++;
         update_post_meta($postID, $count_key, $count);
     }
 }