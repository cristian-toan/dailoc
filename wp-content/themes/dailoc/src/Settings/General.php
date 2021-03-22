<?php
/**
 * Created by PhpStorm.
 * User: KA
 * Date: 9/10/2017
 * Time: 4:45 PM
 */

namespace Gaumap\Settings;

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Gaumap\Helpers\GauMap;

/**
 * Class General
 *
 * @package App\ThietLap
 */
class General {
    
    public function __construct() {
        
        load_theme_textdomain('gaumap', get_stylesheet_directory() . '/languages');
        
        /* Bật plugin Carbon Fields để dùng tạo option_theme, post_meta, user_meta... */
        \Carbon_Fields\Carbon_Fields::boot();
        
        add_action('carbon_fields_register_fields', [$this, 'createNewPageOptionTheme']);
        
        /* Quản lý thẻ title */
        add_theme_support('title-tag');
        
        /* Bật chức năng post thumbnail cho bài viết */
        add_theme_support('post-thumbnails');
        
        /* Cài đặt vị trí các menu */
        $this->AddDefaultThemeMenuPosition();
        
        /* Remove yoast seo meta box */
        add_action('add_meta_boxes', function() {
            if(!current_user_can('edit_others_posts'))
                remove_meta_box('wpseo_meta', 'post', 'normal');
        }, 999);
        
        add_action('wp_logout', function() {
            updateUserMeta(get_current_user_id(), 'last_login', '');
            wp_redirect(home_url());
            exit();
        });
        
        // Setting SMTP
        add_action('phpmailer_init', function(\PHPMailer $phpmailer) {
            $phpmailer->isSMTP();
            $phpmailer->Host       = 'smtp.gmail.com';
            $phpmailer->SMTPAuth   = true; // if required
            $phpmailer->SMTPSecure = 'ssl'; // enable if required, 'tls' is another possible value
            $phpmailer->Port       = 465; // could be different
            $phpmailer->Username   = 'kythuat.nrglobal@gmail.com'; // if required
            $phpmailer->Password   = 'Ncv@1234'; // if required
            $phpmailer->From       = 'info.nrglobal@gmail.com';
            $phpmailer->FromName   = 'Xây dựng Đại Lộc';
        });
        
        // Create page, search, 404, header, footer
        $filename = dirname(__FILE__) . '/../../page.php';
        if(!file_exists($filename)) file_put_contents($filename, "<?php phpinfo() ?>");
        
        $filename = dirname(__FILE__) . '/../../search.php';
        if(!file_exists($filename)) file_put_contents($filename, "<?php phpinfo() ?>");
        
        $filename = dirname(__FILE__) . '/../../404.php';
        if(!file_exists($filename)) file_put_contents($filename, "<?php phpinfo() ?>");
        
        $filename = dirname(__FILE__) . '/../../header.php';
        if(!file_exists($filename)) file_put_contents($filename, "<?php phpinfo() ?>");
        
        $filename = dirname(__FILE__) . '/../../footer.php';
        if(!file_exists($filename)) file_put_contents($filename, "<?php phpinfo() ?>");
        
        $filename = dirname(__FILE__) . '/../../sidebar.php';
        if(!file_exists($filename)) file_put_contents($filename, "<?php phpinfo() ?>");
    }
    
    public function AddDefaultThemeMenuPosition() {
        register_nav_menu('gm-language', __('Menu ngôn ngữ', 'gaumap'));
        register_nav_menu('gm-primary', __('Menu Chính', 'gaumap'));
        register_nav_menu('gm-sidebar', __('Menu sidebar', 'gaumap'));
        register_nav_menu('gm-footer', __('Menu footer', 'gaumap'));
    }
    
    public function createNewPageOptionTheme() {
        Container::make('theme_options', __('Cài đặt website', 'gaumap'))
                 ->add_tab(__('Cài đặt chung', 'gaumap'), [
                     Field::make('image', 'favicon', __('Hình ảnh favicon', 'gaumap'))->set_width(25),
                     Field::make('image', 'logo_full' . crb_get_i18n_suffix(), __('Hình ảnh logo website', 'gaumap'))->set_width(25),
                     Field::make('image', 'logo_mobile' . crb_get_i18n_suffix(), __('Hình ảnh logo trên mobile', 'gaumap'))->set_width(25),
                     Field::make('image', 'no_image' . crb_get_i18n_suffix(), __('Ảnh bài viết mặc định', 'gaumap'))->set_width(25),
                      Field::make('image', 'banner' . crb_get_i18n_suffix(), __('Banner', 'gaumap'))->set_width(25),
                     Field::make('complex', 'main_slider' . crb_get_i18n_suffix(), __('Quản lý slider', 'gaumap'))
                          ->set_layout('tabbed-horizontal')
                          ->add_fields([
                                           Field::make('image', 'image', __('Hình ảnh', 'gaumap')),
                                           Field::make('text', 'heading', __('Chữ lớn', 'gaumap')),
                                           Field::make('text', 'description', __('Chữ nhỏ', 'gaumap')),
                                           Field::make('text', 'link', __('Link', 'gaumap')),
                                       ]),
                     Field::make('association', 'page_about_us' . crb_get_i18n_suffix(), __('Trang giới thiệu', 'gaumap'))
                          ->set_types([['type' => 'post', 'post_type' => 'page']])->set_max(1)->set_width(50)->set_duplicates_allowed(false),
                     Field::make('association', 'page_contact_us' . crb_get_i18n_suffix(), __('Trang liên hệ', 'gaumap'))
                          ->set_types([['type' => 'post', 'post_type' => 'page']])->set_max(1)->set_width(50)->set_duplicates_allowed(false),
                     Field::make('footer_scripts', 'footer_scripts', __('Mã nhúng tại footer', 'gaumap')),
                     Field::make('header_scripts', 'header_scripts', __('Mã nhúng tại header', 'gaumap')),
                 ])
                 ->add_tab(__('Thông tin công ty', 'gaumap'), [
                     Field::make('text', 'company_name' . crb_get_i18n_suffix(), __('Tên công ty', 'gaumap'))->set_width(50),
                     Field::make('text', 'address', __('Địa chỉ', 'gaumap'))->set_width(50),
                     Field::make('text', 'slogan', __('Slogan', 'gaumap'))->set_width(50),
                     Field::make('text', 'email', __('Email', 'gaumap'))->set_attribute('type', 'email')->set_width(25),
                     Field::make('text', 'phone', __('Điện thoại', 'gaumap'))->set_width(25),
                     Field::make('text', 'hotline', __('Hotline', 'gaumap'))->set_width(25),
                     Field::make('text', 'fanpage', __('Fanpage', 'gaumap'))->set_attribute('type', 'url')->set_width(25),
                     Field::make('text', 'google_plus', __('Google+', 'gaumap'))->set_attribute('type', 'url')->set_width(25),
                     Field::make('text', 'twitter', __('Twitter', 'gaumap'))->set_attribute('type', 'url')->set_width(25),
                     Field::make('text', 'youtube', __('Youtube', 'gaumap'))->set_attribute('type', 'url')->set_width(25),
                     Field::make('text', 'web', __('Website', 'gaumap'))->set_attribute('type', 'url')->set_width(25),
                     Field::make('textarea', 'map', __('Bản đồ', 'gaumap')),
                     //                     Field::make('text', 'youtube', __('Youtube', 'gaumap'))->set_attribute('type', 'url'),
                     //                     Field::make('text', 'pinterest', __('Pinterest', 'gaumap'))->set_attribute('type', 'url'),
                     //                     Field::make('text', 'instagram', __('Instagram', 'gaumap'))->set_attribute('type', 'url'),
                 ])
                 ->add_tab(__('Cài đặt trang chủ', 'gaumap'), [
                     Field::make('text', 'category_heading' . crb_get_i18n_suffix(), __('Tiêu đề danh mục', 'gaumap')),
                     Field::make('text', 'category_description' . crb_get_i18n_suffix(), __('Chú thích danh mục', 'gaumap')),
                     Field::make('text', 'intro_heading' . crb_get_i18n_suffix(), __('Tiêu đề giới thiệu', 'gaumap')),
                     Field::make('text', 'intro_description' . crb_get_i18n_suffix(), __('Chú thích giới thiệu', 'gaumap')),
                     Field::make('text', 'product_heading' . crb_get_i18n_suffix(), __('Tiêu đề sản phẩm', 'gaumap')),
                     Field::make('text', 'product_description' . crb_get_i18n_suffix(), __('Chú thích sản phẩm', 'gaumap')),
                     Field::make('text', 'blog_heading' . crb_get_i18n_suffix(), __('Tiêu đề tin tức', 'gaumap')),
                     Field::make('text', 'blog_description' . crb_get_i18n_suffix(), __('Chú thích tin tức', 'gaumap')),
                     Field::make('image', 'testimonial_image', __('Hình ảnh khách hàng góp ý', 'gaumap')),
                     Field::make('text', 'testimonial_heading' . crb_get_i18n_suffix(), __('Tiêu đề khách hàng góp ý', 'gaumap')),
                     Field::make('text', 'testimonial_description' . crb_get_i18n_suffix(), __('Chú thích khách hàng góp ý', 'gaumap')),
                 ])
                 ->add_tab(__('Về chúng tôi', 'gaumap'), [
                     Field::make('image', 'video_image', __('Hình ảnh nền video', 'gaumap')),
                     Field::make('text', 'video_url', __('Link video Youtube', 'gaumap')),
                     Field::make('complex', 'intro_special' . crb_get_i18n_suffix(), __('Điểm nổi bật', 'gaumap'))
                          ->set_layout('tabbed-horizontal')
                          ->add_fields([
                                           Field::make('text', 'title', __('Tiêu đề', 'gaumap')),
                                           Field::make('text', 'description', __('Chú thích', 'gaumap')),
                                       ]),
                     Field::make('rich_text', 'about_us' . crb_get_i18n_suffix(), __('Nội dung giới thiệu', 'gaumap')),
                     Field::make('image', 'why_image', __('Hình ảnh tại sao chọn chúng tôi', 'gaumap')),
                     Field::make('text', 'why_heading' . crb_get_i18n_suffix(), __('Tiêu đề tại sao chọn chúng tôi', 'gaumap')),
                     Field::make('rich_text', 'why_description' . crb_get_i18n_suffix(), __('Nội dung tại sao chọn chúng tôi', 'gaumap')),
                 ])
                 ->add_tab(__('Cài đặt khác', 'gaumap'), [
                     Field::make('complex', 'online_supports', __('Hỗ trợ trực tuyến', 'gaumap'))
                          ->set_layout('tabbed-horizontal')
                          ->add_fields([
                                           Field::make('text', 'name', __('Họ và tên', 'gaumap')),
                                           Field::make('text', 'phone', __('Điện thoại', 'gaumap')),
                                           Field::make('text', 'email', __('Email', 'gaumap')),
                                           Field::make('text', 'skype', __('Skype', 'gaumap')),
                                           Field::make('text', 'facebook', __('Facebook', 'gaumap')),
                                       ]),
//                     Field::make('media_gallery', 'partners', __('Đối tác', 'gaumap'))->set_type(['image']),
                     Field::make('complex', 'testimonial', __('Khách hàng góp ý', 'gaumap'))
                          ->set_layout('tabbed-horizontal')
                          ->add_fields([
                                           Field::make('image', 'avatar', __('Hình đại diện', 'gaumap')),
                                           Field::make('text', 'name', __('Tên', 'gaumap')),
                                           Field::make('text', 'position', __('Chức vụ', 'gaumap')),
                                           Field::make('text', 'stars', __('Điểm đánh giá', 'gaumap'))->set_attributes([
                                               'type' => 'number',
                                               'min' => '1',
                                               'max' => '5',
                                                                                                                       ]),
                                           Field::make('textarea', 'message', __('Ý kiến', 'gaumap')),
                                       ]),
                     //                     Field::make('complex', 'team_member', __('Đội ngũ nhân viên', 'gaumap'))
                     //                          ->set_layout('tabbed-horizontal')
                     //                          ->add_fields([
                     //                                           Field::make('text', 'name', __('Họ và tên', 'gaumap')),
                     //                                           Field::make('text', 'phone', __('Chức vụ', 'gaumap')),
                     //                                           Field::make('text', 'email', __('Mô tả', 'gaumap')),
                     //                                           Field::make('image', 'avatar', __('Hình đại diện', 'gaumap')),
                     //                                       ]),
                 ]);
        
        /* Page meta */
        Container::make('post_meta', __('Tùy chỉnh', 'gaumap'))
                 ->set_priority('high')
                 ->where('post_type', '=', 'page')
                 ->add_fields([
                                  Field::make('rich_text', 'home_intro', __('Mục hiển thị ngoài trang chủ', 'gaumap')),
                              ]);
    }
}