<?php

// Custom backend & login page
new \Gaumap\Settings\CustomLoginForm();
new \Gaumap\Settings\CustomBackEnd();

// Core class
new \Gaumap\Helpers\RequirePlugins();
new \Gaumap\Helpers\TuDongLuuHinhAnh();
new \Gaumap\Settings\General();
new \Gaumap\Settings\BuildFrontEndLayout();

// Custom post type & taxonomy
new \Gaumap\PostTypes\Post();
new \Gaumap\PostTypes\Product();
new \Gaumap\Taxonomies\Category();
new \Gaumap\Taxonomies\ProductCat();

// Hide admin bar
add_filter('show_admin_bar', '__return_false');

function crb_get_i18n_suffix() {
    if(!defined('ICL_LANGUAGE_CODE')) return '';
    return '_' . ICL_LANGUAGE_CODE;
}

function adminAsset($path) { return get_stylesheet_directory_uri() . '/src/assets/' . $path; }

function asset($path) { return get_stylesheet_directory_uri() . '/public/' . $path; }

function theAsset($path) { echo get_stylesheet_directory_uri() . '/public/' . $path; }

function gmTemplate($name) { get_template_part('gm-templates/' . $name); }

/**
 * function update_post_meta by gaumap
 *
 * @param        $post_id
 * @param        $field_name
 * @param string $value
 *
 * @return bool|false|int
 */
function updatePostMeta($post_id, $field_name, $value = '') {
    if(empty($value)) {
        return delete_post_meta($post_id, $field_name);
    } else if(!get_post_meta($post_id, $field_name)) {
        return add_post_meta($post_id, $field_name, $value);
    } else {
        return update_post_meta($post_id, $field_name, $value);
    }
}

/**
 * Hàm updateUserMeta
 *
 * @param $idUser
 * @param $key
 * @param $value
 *
 * @return bool|false|int
 */
function updateUserMeta($idUser, $key, $value) {
    if(empty($value)) {
        return delete_user_meta($idUser, $key);
    } else if(!get_user_meta($idUser, $key)) {
        return add_user_meta($idUser, $key, $value);
    } else {
        return update_user_meta($idUser, $key, $value);
    }
}

function formatHummanTime($thoiGian) {
    $seconds = \Carbon\Carbon::now()->diffInSeconds(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $thoiGian));
    $minutes = round($seconds / 60);           // value 60 is seconds
    $hours   = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec
    $days    = round($seconds / 86400);          //86400 = 24 * 60 * 60;
    $weeks   = round($seconds / 604800);          // 7*24*60*60;
    $months  = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60
    $years   = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60
    if($seconds <= 60) {
        return "Just Now";
    } else if($minutes <= 60) {
        if($minutes == 1) {
            return "an minute ago";
        } else {
            return "$minutes minutes ago";
        }
    } else if($hours <= 24) {
        if($hours == 1) {
            return "an hour ago";
        } else {
            return "$hours hours ago";
        }
    } else if($days <= 7) {
        if($days == 1) {
            return "yesterday";
        } else {
            return "$days days ago";
        }
    } else if($weeks <= 4.3) {  //4.3 == 52/12
        if($weeks == 1) {
            return "last week";
        } else {
            return "$weeks weeks ago";
        }
    } else if($months <= 12) {
        if($months == 1) {
            return "last month";
        } else {
            return "$months months ago";
        }
    } else {
        if($years == 1) {
            return "last year";
        } else {
            return "$years years ago";
        }
    }
}

function getOption($name) { return carbon_get_theme_option($name); }

function theOption($name) { echo carbon_get_theme_option($name); }

function theCompanyName() { echo carbon_get_theme_option('company_name' . crb_get_i18n_suffix()); }

function getAllAddresses() {
    return carbon_get_theme_option('company_address');
}

function getMainAddress() {
    $addresses = carbon_get_theme_option('company_address');
    foreach($addresses as $address) {
        if($address['is_main_address']) return $address;
    }
}

function getSubAddress() {
    $addresses = carbon_get_theme_option('company_address');
    foreach($addresses as $key => $address) {
        if($address['is_main_address']) unset($addresses[$key]);
    }
    
    return $addresses;
}

function theAddress() { echo carbon_get_theme_option('address'); }

function theSlogan() { echo carbon_get_theme_option('slogan'); }

function theMap() { echo carbon_get_theme_option('map'); }

function theWeb() { echo carbon_get_theme_option('web'); }

function thePhone() { echo carbon_get_theme_option('phone'); }

function getPhone() { return str_replace([' ', '.'], '', carbon_get_theme_option('phone')); }

function theHotLine() { echo carbon_get_theme_option('hotline'); }

function getHotLine() { return str_replace([' ', ',', '.'], '', carbon_get_theme_option('hotline')); }

function theEmail() { echo carbon_get_theme_option('email'); }

function theSkype() { echo carbon_get_theme_option('skype'); }

function theFacebook() { echo carbon_get_theme_option('fanpage'); }

function theGooglePlus() { echo carbon_get_theme_option('google_plus'); }

function theContactPageGoogleMap() { echo carbon_get_theme_option('contact_us_google_map'); }

function theTwitter() { echo carbon_get_theme_option('twitter'); }

function thePinterest() { echo carbon_get_theme_option('pinterest'); }

function theInstagram() { echo carbon_get_theme_option('instagram'); }

function theYoutube() { echo carbon_get_theme_option('youtube'); }

function inFaviconUrl() { echo carbon_get_theme_option('favicon'); }

function theLogoUrl() { echo wp_get_attachment_image_url(carbon_get_theme_option('logo_full' . crb_get_i18n_suffix()), 'full'); }

function getLogoUrl() { return wp_get_attachment_image_url(carbon_get_theme_option('logo_full' . crb_get_i18n_suffix())); }

function theBannerUrl() { echo wp_get_attachment_image_url(carbon_get_theme_option('banner' . crb_get_i18n_suffix()), 'full'); }

function theCustomPageUrl($name) {
    $postId = carbon_get_theme_option($name . crb_get_i18n_suffix());
    if(count($postId) > 0)
        echo get_permalink($postId[0]['id']);
    else
        echo get_permalink(1);
}

function getPageContactUs() { return carbon_get_theme_option('page_contact_us' . crb_get_i18n_suffix())[0]; }

function thePageContactUsUrl() { echo get_permalink(carbon_get_theme_option('page_contact_us' . crb_get_i18n_suffix())[0]['id']); }

function getPageAboutUs() {
    $postId = carbon_get_theme_option('page_about_us' . crb_get_i18n_suffix());
    if(count($postId) > 0)
        return get_post($postId[0]['id']);
    else
        return get_post(1);
}

function thePageUrl($name) { return get_permalink(carbon_get_theme_option($name . crb_get_i18n_suffix())[0]['id']); }

function getSlideShow() { return carbon_get_theme_option('main_slider'); }

function thePostThumbnailUrl($size = 'thumbnail') {
    $url = get_the_post_thumbnail_url(get_the_ID(), $size);
    echo (empty($url)) ? wp_get_attachment_image_url(carbon_get_theme_option('no_image')) : $url;
}

function getThePostThumbnailUrl($id, $size = 'thumbnail') {
    $url = get_the_post_thumbnail_url($id, $size);
    return (empty($url)) ? wp_get_attachment_image_url(carbon_get_theme_option('no_image')) : $url;
}

function theExcerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if(count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt) . '...';
    } else {
        $excerpt = implode(" ", $excerpt);
    }
    $excerpt = preg_replace('`[[^]]*]`', '', $excerpt);
    echo '<p>' . $excerpt . '</p>';
}

function getExcerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if(count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt) . '...';
    } else {
        $excerpt = implode(" ", $excerpt);
    }
    return preg_replace('`[[^]]*]`', '', $excerpt);
}

function theContent() {
    $content = get_the_content();
    echo !empty($content) ? $content : __('Đang cập nhật', 'gaumap');
}

function getCarbonPostMeta($name) { return carbon_get_post_meta(get_the_ID(), $name); }

function theCarbonPostMeta($name) { echo carbon_get_post_meta(get_the_ID(), $name); }

function theCarbonOptionField($name) { echo carbon_get_theme_option($name); }

function getCarbonOptionField($name) { return carbon_get_theme_option($name); }

function theCarbonOptionImageUrl($name, $size = 'full') { echo wp_get_attachment_image_url(carbon_get_theme_option($name), $size); }

function randomString($length = 65) {
    $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString     = '';
    for($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    
    return $randomString;
}

function thePagination($query = null) {
    if(empty($query)) {
        global $wp_query;
        $query = $wp_query;
    }
    
    $paged = (get_query_var('paged') == 0) ? 1 : get_query_var('paged');
    $pages = paginate_links([
                                'base'      => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                                'format'    => '?paged=%#%',
                                'current'   => $paged,
                                'total'     => $query->max_num_pages,
                                'type'      => 'array',
                                'prev_next' => true,
                            ]
    );
    if(is_array($pages)) {
        $pagination = '<ul class="pagination">';
        foreach($pages as $page) $pagination .= "<li>$page</li>";
        $pagination .= '</ul>';
        echo $pagination;
    }
}


// Remove default jquery scripts
if(!is_admin()) add_action("wp_enqueue_scripts", "deRegisterScripts", 11);
function deRegisterScripts() {
    wp_deregister_script('jquery');
}

// Remove version from scripts
add_filter('script_loader_src', '_remove_script_version', 15, 1);
add_filter('style_loader_src', '_remove_script_version', 15, 1);
function _remove_script_version($src) {
    $parts = explode('?ver', $src);
    return $parts[0];
}


add_action('wp_enqueue_scripts', function() {
    //    global $wp_styles;
    //    $wp_styles->all_deps($wp_styles->queue);
    //    $merged_file_location = get_stylesheet_directory() . '/public/css/gaumap-style.css';
    //    $merged_script        = '';
    //    foreach($wp_styles->to_do as $handle) {
    //        $src = strtok($wp_styles->registered[$handle]->src, '?');
    //        if(strpos($src, 'http') !== false) {
    //            $site_url = site_url();
    //            if(strpos($src, $site_url) !== false)
    //                $js_file_path = str_replace($site_url, '', $src);
    //            else
    //                $js_file_path = $src;
    //            $js_file_path = ltrim($js_file_path, '/');
    //        } else {
    //            $js_file_path = ltrim($src, '/');
    //        }
    //
    //        if(file_exists($js_file_path)) {
    //            $localize = '';
    //            if(@key_exists('data', $wp_styles->registered[$handle]->extra)) $localize = $obj->extra['data'] . ';';
    //            $merged_script .= $localize . file_get_contents($js_file_path) . ';';
    //        }
    //        wp_deregister_style($handle);
    //    }
    //
    //    file_put_contents($merged_file_location, $merged_script);
    //    wp_enqueue_style('merged-style', get_stylesheet_directory_uri() . '/public/css/gaumap-style.css');
    //
    //
    //    global $wp_scripts;
    //    $wp_scripts->all_deps($wp_scripts->queue);
    //    $merged_file_location = get_stylesheet_directory() . '/public/js/gaumap-script.js';
    //    $merged_script        = '';
    //    foreach($wp_scripts->to_do as $handle) {
    //        $src = strtok($wp_scripts->registered[$handle]->src, '?');
    //        if(strpos($src, 'http') !== false) {
    //            $site_url = site_url();
    //            if(strpos($src, $site_url) !== false)
    //                $js_file_path = str_replace($site_url, '', $src);
    //            else
    //                $js_file_path = $src;
    //            $js_file_path = ltrim($js_file_path, '/');
    //        } else {
    //            $js_file_path = ltrim($src, '/');
    //        }
    //
    //        if(file_exists($js_file_path)) {
    //            $localize = '';
    //            if(@key_exists('data', $wp_scripts->registered[$handle]->extra)) $localize = $obj->extra['data'] . ';';
    //            $merged_script .= $localize . file_get_contents($js_file_path) . ';';
    //        }
    //        wp_deregister_script($handle);
    //    }
    //    //    $merged_script = str_replace(' ', '', $merged_script);
    //    file_put_contents($merged_file_location, $merged_script);
    //    wp_enqueue_script('merged-script', get_stylesheet_directory_uri() . '/gaumap-script.js');
}, 9999);

//add_action('wp_footer', function() {
//    echo '<script type="text/javascript" defer="defer">' . file_get_contents(get_stylesheet_directory() . '/public/js/gaumap-script.js') . '</script>';
//});