<?php
    /**
     * Created by PhpStorm.
     * User: triet
     * Date: 5/24/2018
     * Time: 2:30 PM
     */
    
    namespace Gaumap\Settings;
    
    use Gaumap\Helpers\GauMap;
    
    class CustomLoginForm {
        
        public function __construct() {
            add_action('login_enqueue_scripts', function() {
                wp_enqueue_style('custom-login', adminAsset('css/customLoginForm.css'));
                wp_enqueue_script('custom-login', adminAsset('js/customLoginForm.js'));
            });
        }
        
    }