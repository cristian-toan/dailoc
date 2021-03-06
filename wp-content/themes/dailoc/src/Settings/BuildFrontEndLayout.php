<?php
/**
 * Created by PhpStorm.
 * User: KA
 * Date: 9/23/2017
 * Time: 2:19 PM
 */

namespace Gaumap\Settings;

use Gaumap\Helpers\GauMap;

/**
 * Class BuildFrontEndLayout
 *
 * @package Gaumap\Settings
 */
class BuildFrontEndLayout {
    
    protected $theme_styles;
    
    protected $theme_styles_uri;
    
    protected $theme_core_scripts;
    
    protected $theme_core_scripts_uri;
    
    protected $theme_scripts;
    
    protected $theme_scripts_uri;
    
    public function __construct() {
        $this->theme_styles      = get_stylesheet_directory() . '/public/css';
        $this->theme_scripts     = get_stylesheet_directory() . '/public/js';
        $this->theme_styles_uri  = get_stylesheet_directory_uri() . '/public/css/';
        $this->theme_scripts_uri = get_stylesheet_directory_uri() . '/public/js/';
        if(!is_admin()) {
            add_action('wp_enqueue_scripts', [$this, 'loadFrontEndScripts'], 1);
        }
        
        add_action('after_setup_theme', function() {
            add_theme_support('custom-logo', [
                'height'      => 100,
                'width'       => 400,
                'flex-height' => true,
                'flex-width'  => true,
                'header-text' => ['site-title', 'site-description'],
            ]);
        });
        
        add_action('wp_head', function() {
            $faviconUrl = wp_get_attachment_image_url(carbon_get_theme_option('favicon'));
            echo '
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=1">
                <meta name="resource-type" content="document"/>
                <meta name="distribution" content="global"/>
                <meta name="rating" content="general"/>
                <meta name="robots" content="index, follow"/>
                <meta name="revisit-after" content="1 days"/>
                <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE"/>
                <meta content="telephone=no" name="format-detection"/>
                <meta name="author" content="' . get_bloginfo('name') . '" />
                <meta name="copyright" content="' . get_bloginfo('name') . ' [' . get_bloginfo('admin_email') . ']" />
                <link rel="icon" href="' . $faviconUrl . '" type="image/x-icon"/>
                <link rel="shortcut icon" href="' . $faviconUrl . '" type="image/x-icon" />
                <link rel="apple-touch-icon" href="' . $faviconUrl . '" type="image/x-icon" />
                <!--[if lt IE 9]>
                <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
                <![endif]-->
                ';
            echo carbon_get_theme_option('header_scripts');
        }, PHP_INT_MAX);
        
        add_action('wp_footer', function() {
            echo carbon_get_theme_option('footer_scripts'); ?>
            <script>
                $(document).ready(function () {
                    // $('#gmContactForm').submit();
                });

                $(document).on('submit', '#gmContactForm', function (e) {
                    e.preventDefault();
                    let form = jQuery(this);
                    form.validate({
                        rules   : {
                            email  : {required: true},
                            name   : {required: true},
                            tel    : {required: true},
                            message: {required: true},
                        },
                        messages: {
                            email  : {required: "?????a ch??? email kh??ng ???????c ????? tr???ng"},
                            name   : {required: "H??? v?? t??n kh??ng ???????c ????? tr???ng"},
                            tel    : {required: "??i???n tho???i kh??ng ???????c ????? tr???ng"},
                            message: {required: "N???i dung kh??ng ???????c ????? tr???ng"},
                        }
                    });
                    if (form.valid()) {
                        submitForm(e, form);
                    }
                });

                $(document).on('submit', '#gmSubmitEmail', function (e) {
                    e.preventDefault();
                    submitForm(e, jQuery(this));
                });

                function submitForm(e, form) {
                    let buttonText = form.find('[type=submit]').html();
                    form.ajaxSubmit({
                        before : function () {
                            form.find('input').attr('readonly', true);
                            form.find('button').attr('disabled', true);
                            form.find('button').html('<i class="fa fa-refresh fa-spin"></i> ??ang x??? l??');
                        },
                        success: function (response) {
                            if (response.code === 200) {
                                swal(response.message.title, response.message.detail, 'success');
                            } else {
                                swal(response.message.title, response.message.detail, 'error');
                            }
                            form.find('button').attr('disabled', false);
                            form.find('input').attr('readonly', false);
                            form.find('input').val('');
                            form.find('button').html(buttonText);
                        },
                        error  : function (res) {
                            console.log(res);
                            form.find('button').attr('disabled', false);
                            form.find('input').attr('readonly', false);
                            // form.find('input').val('');
                            form.find('button').html(buttonText);
                        },
                    });
                }
            </script>
        <?php }, PHP_INT_MAX);
        
        add_action('wp_ajax_submit_contact_form', [$this, 'submitContactForm']);
        add_action('wp_ajax_nopriv_submit_contact_form', [$this, 'submitContactForm']);
        add_action('wp_ajax_registration_of_consultants', [$this, 'submitRegistrationOfConsultants']);
        add_action('wp_ajax_nopriv_registration_of_consultants', [$this, 'submitRegistrationOfConsultants']);
    
        /* Th??m class active v??o menu ??ang ch???n */
        add_filter('nav_menu_css_class', [$this, 'AddActiveClassToCurrentMenu'], 10, 2);
    }
    
    public function submitContactForm() {
        if(!wp_verify_nonce($_POST['_wpnonce'], get_bloginfo('url') . '_submit_contact')) \Gaumap\Helpers\Response::badRequest();
        if(empty($_POST['name'])) \Gaumap\Helpers\Response::badRequest(__('Vui l??ng ??i???n v??o h??? v?? t??n.', 'gaumap'));
        if(empty($_POST['email'])) \Gaumap\Helpers\Response::badRequest(__('Vui l??ng ??i???n v??o email.', 'gaumap'));
        if(empty($_POST['message'])) \Gaumap\Helpers\Response::badRequest(__('Vui l??ng ??i???n v??o n???i dung.', 'gaumap'));
        
        $to      = get_option('admin_email');
        $subject = __('Th??ng tin li??n h??? t??? website ', 'gaumap') . get_bloginfo('name');
        $headers = [
            'Content-Type: text/html; charset=UTF-8',
            'From: ' . $_POST['email'],
        ];
        $body    = '
        <div style="margin:auto;width:100%">
            <div style="background:#6C9FCE;color:white;padding:15px;text-align:center">
                <a style="color:white" href=' . get_bloginfo('url') . '>' . get_bloginfo('name') . '</a>
            </div>
            <div style="text-align:center;">
                <img src="' . getLogoUrl() . '" alt="logo" style="height:250px">
            </div>
            <p>Hello!</p>
            <p>B???n v???a g???i y??u c???u li??n h??? t??? website <a href=' . get_bloginfo('url') . '>' . get_bloginfo('url') . '</a>. D?????i ????y l?? th??ng tin li??n h??? c???a kh??ch h??ng:</p>
            <p>H??? v?? t??n: ' . $_POST['name'] . '</p>
            <p>S??? ??i???n tho???i: ' . $_POST['tel'] . '</p>
            <p>Email: ' . $_POST['email'] . '</p>
            <p>N???i dung:</p>
            <p>' . $_POST['message'] . '</p>
            <p>Xin c???m ??n.</p>
            <div style="background:#6C9FCE;color:white;padding:30px 15px;text-align:center">
               B???n quy???n ?? 2018 thu???c v??? <a style="color:white" href=' . get_bloginfo('url') . '>' . get_bloginfo('name') . '</a>. T???t c??? c??c quy???n ???????c b???o h???.
            </div>
        </div>
    ';
        
        $sendMailCustomer = wp_mail($to, $subject, $body, $headers);
        
        if($sendMailCustomer) {
            \Gaumap\Helpers\Response::message(__('B???n ???? g???i li??n h??? th??nhh c??ng, ch??ng t??i s??? ch??? ?????ng li??n h??? v???i b???n trong th???i gian s???m nh???t, xin c???m ??n.', 'gaumap'));
        } else {
            \Gaumap\Helpers\Response::error(__('Hi???n t???i h??? th???ng kh??ng th??? x??? l?? y??u c???u c???a ban, xin vui l??ng th??? l???i trong ??t ph??t n???a.', 'gaumap'));
            //        \Gaumap\Helpers\Response::data('', $sendMailCustomer);
        }
    }
    
    public function submitRegistrationOfConsultants() {
        if(!wp_verify_nonce($_POST['_wpnonce'], get_bloginfo('url') . '_submit_email')) \Gaumap\Helpers\Response::badRequest();
        if(empty($_POST['email'])) \Gaumap\Helpers\Response::badRequest(__('Vui l??ng ??i???n v??o email.', 'gaumap'));
        
        $to      = get_option('admin_email');
        $subject = __('????ng k?? nh???n tin t???c khuy???n m??i t??? website ', 'gaumap') . get_bloginfo('name');
        $headers = [
            'Content-Type: text/html; charset=UTF-8',
            'From: ' . get_option('admin_email'),
        ];
        $body    = '
        <div style="margin:auto;width:500px;">
            <div style="background:#6C9FCE;color:white;padding:15px;text-align:center">
                <a style="color:white" href=' . get_bloginfo('url') . '>' . get_bloginfo('name') . '</a>
            </div>
            <div style="text-align:center;">
                <img src="' . getLogoUrl() . '" alt="logo" style="max-width:200px;">
            </div>
            <p>Hello!</p>
            <p>B???n v???a nh???n ???????c y??u c???u ????ng k?? nh???n khuy???n m??i t??? website <a href=' . get_bloginfo('url') . '>' . get_bloginfo('url') . '</a> t??? email <strong>' . $_POST['email'] . '</strong>.</p>
            <p>Xin c???m ??n.</p>
            <div style="background:#6C9FCE;color:white;padding:30px 15px;text-align:center">
               B???n quy???n ?? 2018 thu???c v??? <a style="color:white" href=' . get_bloginfo('url') . '>' . get_bloginfo('name') . '</a>. T???t c??? c??c quy???n ???????c b???o h???.
            </div>
        </div>
    ';
        
        $sendMailCustomer = wp_mail($to, $subject, $body, $headers);
        
        if($sendMailCustomer) {
            \Gaumap\Helpers\Response::message(__('Y??u c???u c???a b???n ???? ???????c h??? th???ng ghi nh???n, ch??ng t??i s??? ch??? ?????ng li??n h??? v???i b???n trong ??t ph??t n???a, xin c???m ??n.', 'gaumap'));
        } else {
            \Gaumap\Helpers\Response::error(__('Hi???n t???i h??? th???ng kh??ng th??? x??? l?? y??u c???u c???a ban, xin vui l??ng th??? l???i trong ??t ph??t n???a.', 'gaumap'));
        }
        
    }
    
    public function loadFrontEndScripts() {
        $this->loadCustomStyleSheetFiles([
                                            asset('css/_1_UTMAvo.css'),
                                            asset('css/carousels.slider.css'),
                                            asset('js/owlcarousel2/assets/owlcarousel/assets/owl.carousel.min.css'),
                                            asset('js/owlcarousel2/assets/owlcarousel/assets/owl.theme.default.min.css'),
                                            asset('css/bxslider.css'),
                                            asset('css/font-awesome.css'),
                                            asset('css/mmenu.css'),
                                            asset('css/popup.boxes.css'),
                                            asset('css/animate.css'),
                                            asset('bootstrap/bootstrap.min.css'),
                                            asset('css/_style.css'),
                                         ]);
        
        $this->LoadCustomJavascriptFile([
            
                                            asset('js/jquery/jquery-1.11.0.js'),
                                            asset('js/modernizr.custom.js'),
                                            asset('js/jquery.slider/jssor.js'),
                                            asset('js/jquery.slider/jssor.slider.js'),
                                            asset('js/jquery.slider/jquery.bxslider.js'),
                                            asset('js/jquery.mmenu.min.all.js'),
                                            asset('js/jquery.easing.js'),
                                            asset('js/jquery.mousewheel.js'),
                                            asset('js/jquery.carousels-slider.min.js'),
                                            asset('js/jquery.slimscroll.min.js'),
                                            asset('js/fancybox/jquery.fancybox.js'),
                                            asset('js/auto-numeric.js'),
                                            asset('js/wow.min.js'),
                                            asset('js/jquery.jcarousellite.min.js'),
                                            asset('js/owlcarousel2/assets/owlcarousel/owl.carousel.js'),
                                            asset('js/bootstrap.js'),
                                            asset('js/bootstrap.min.js'),
                                            'https://cdn.jsdelivr.net/npm/sweetalert2',
                                            'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js',
                                            adminAsset('js/jquery.ajax-submit.min.js'),
                                            asset('js/script.js'),
                                        ]);
    }
    
    /**
     * Load custom path css file
     *
     * @param $files
     */
    public function loadCustomStyleSheetFiles($files) {
        foreach($files as $file)
            wp_enqueue_style(randomString(15), $file, [], '0.1.0', 'all');
        
        wp_enqueue_style(randomString(15), get_stylesheet_directory_uri() . '/style.css', [], '0.1.0', 'all');
    }
    
    /**
     * Load custom path javascript file
     *
     * @param $files
     */
    public function LoadCustomJavascriptFile($files) {
        foreach($files as $file) {
            wp_enqueue_script(randomString(15), $file, [], '0.1.0', true);
        }
    }
    
    /**
     * Th??m class active v??o current menu
     *
     * @param $classes
     *
     * @return array
     */
    public function AddActiveClassToCurrentMenu($classes) {
        if(in_array('current-menu-item', $classes))
            $classes[] = 'activem ';
        return $classes;
    }
}