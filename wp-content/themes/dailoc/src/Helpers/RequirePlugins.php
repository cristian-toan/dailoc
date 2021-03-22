<?php
/**
 * Created by PhpStorm.
 * User: ADMIN
 * Date: 2/17/2017
 * Time: 8:05 PM
 */

namespace Gaumap\Helpers;

class RequirePlugins {
    
    function __construct() {
        require_once 'Include/PluginActivator/class-tgm-plugin-activation.php';
        require_once 'Include/TinyMceAdvanced/tinymce-advanced.php';
        add_action('tgmpa_register', [$this, 'registerRequirePlugins']);
    }
    
    function registerRequirePlugins() {
        
        $plugins = [
            [
                'name'               => 'Yoast SEO', // The plugin name.
                'slug'               => 'wordpress-seo', // The plugin slug (typically the folder name).
                'required'           => true, // If false, the plugin is only 'recommended' instead of required.
                'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
                'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            ],
            //                [
            //                    'name'               => 'Page Builder by SiteOrigin', // The plugin name.
            //                    'slug'               => 'siteorigin-panels', // The plugin slug (typically the folder name).
            //                    'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            //                    'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            //                    'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            //                ],
            //				[
            //					'name'               => 'Contact form 7', // The plugin name.
            //					'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
            //					'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            //					'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            //					'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            //				],
            //                [
            //                    'name'               => 'WP statistics', // The plugin name.
            //                    'slug'               => 'wp-statistics', // The plugin slug (typically the folder name).
            //                    'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            //                    'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            //                    'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            //                ],
            
            //                [
            //                    'name'               => 'WP-PageNavi', // The plugin name.
            //                    'slug'               => 'wp-pagenavi', // The plugin slug (typically the folder name).
            //                    'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            //                    'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            //                    'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            //                ],
            //				array(
            //					'name'               => 'Advanced Code Editor', // The plugin name.
            //					'slug'               => 'advanced-code-editor', // The plugin slug (typically the folder name).
            //					'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            //					'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            //					'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            //				),
            // array(
            // 	'name'               => 'Visual Composer', // The plugin name.
            // 	'slug'               => 'visual-composer', // The plugin slug (typically the folder name).
            // 	'source'             => get_template_directory() . '/CoreFunctions/Plugins/js_composer.zip', // The plugin source.
            // 	'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            // 	'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            // 	'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            // ),
            // array(
            // 	'name'               => 'Visual Composer Extend', // The plugin name.
            // 	'slug'               => 'ts-visual-composer-extend', // The plugin slug (typically the folder name).
            // 	'source'             => get_template_directory() . '/CoreFunctions/Plugins/ts-visual-composer-extend.zip', // The plugin source.
            // 	'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            // 	'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            // 	'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            // ),
            // array(
            // 	'name'               => 'Visual Composer Bundle', // The plugin name.
            // 	'slug'               => 'ts-visual-composer-bundle', // The plugin slug (typically the folder name).
            // 	'source'             => get_template_directory() . '/CoreFunctions/Plugins/vc-extensions-bundle.zip', // The plugin source.
            // 	'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            // 	'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            // 	'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            // ),
            // array(
            // 	'name'               => 'Visual Composer Addons', // The plugin name.
            // 	'slug'               => 'visual-composer-addons', // The plugin slug (typically the folder name).
            // 	'source'             => get_template_directory() . '/CoreFunctions/Plugins/ultimate_vc_addons.zip', // The plugin source.
            // 	'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            // 	'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            // 	'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            // ),
            // array(
            // 	'name'               => 'Ultimate Layouts Visual Composer', // The plugin name.
            // 	'slug'               => 'ultimate-layouts-visual-composer', // The plugin slug (typically the folder name).
            // 	'source'             => get_template_directory() . '/CoreFunctions/Plugins/ultimate-layouts-vc-2.0.0.zip', // The plugin source.
            // 	'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            // 	'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            // 	'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            // ),
            // array(
            // 	'name'               => 'Youtube Gallery Visual Composer', // The plugin name.
            // 	'slug'               => 'youtube-gallery-visual-composer', // The plugin slug (typically the folder name).
            // 	'source'             => get_template_directory() . '/CoreFunctions/Plugins/youtube-gallery-vc-1.0.1.zip', // The plugin source.
            // 	'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            // 	'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            // 	'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            // ),
            // array(
            // 	'name'               => 'Power addons Visual Composer', // The plugin name.
            // 	'slug'               => 'power-addons-visual-composer', // The plugin slug (typically the folder name).
            // 	'source'             => get_template_directory() . '/CoreFunctions/Plugins/power-vc.zip', // The plugin source.
            // 	'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            // 	'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            // 	'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            // ),
            // array(
            // 	'name'               => 'Mega Extensions Visual Composer', // The plugin name.
            // 	'slug'               => 'mega-extensions-visual-composer', // The plugin slug (typically the folder name).
            // 	'source'             => get_template_directory() . '/CoreFunctions/Plugins/mega_main_extensions.zip', // The plugin source.
            // 	'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            // 	'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            // 	'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            // ),
        ];
        
        $config = [
            'id'           => 'gaumap',                 // Unique ID for hashing notices for multiple instances of TGMPA.
            'default_path' => '',                      // Default absolute path to bundled plugins.
            'menu'         => 'tgmpa-install-plugins', // Menu slug.
            'parent_slug'  => 'themes.php',            // Parent menu slug.
            'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
            'has_notices'  => true,                    // Show admin notices or not.
            'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
            'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => false,                   // Automatically activate plugins after installation or not.
            'message'      => '',                      // Message to output right before the plugins table.
            
            
            'strings' => [
                'page_title'                      => __('Vui lòng cài đặt các gói mở rộng cần thiết', 'gaumap'),
                'menu_title'                      => __('Gói mở rộng', 'gaumap'),
                'installing'                      => __('Đang cài gói mở rộng: %s', 'gaumap'),
                'updating'                        => __('Đang cập nhật gói mở rộng: %s', 'gaumap'),
                'oops'                            => __('Có lỗi xảy ra trong quá trình giao tiếp với API của gói mở rộng.', 'gaumap'),
                'notice_can_install_required'     => _n_noop('Bộ giao diện này yêu cầu cần phải cài đặt các gói mở rộng sau: %1$s.', 'Bộ giao diện này yêu cầu cần phải cài đặt các gói mở rộng sau: %1$s.', 'gaumap'),
                'notice_can_install_recommended'  => _n_noop('Bộ giao diện này đề xuất cài đặt và sử dụng các gói mở rộng sau: %1$s.', 'Bộ giao diện này đề xuất cài đặt và sử dụng các gói mở rộng sau: %1$s.', 'gaumap'),
                'notice_ask_to_update'            => _n_noop(
                    'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
                    'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
                    'gaumap'
                ),
                'notice_ask_to_update_maybe'      => _n_noop(
                    'There is an update available for: %1$s.',
                    'There are updates available for the following plugins: %1$s.',
                    'gaumap'
                ),
                'notice_can_activate_required'    => _n_noop(
                    'The following required plugin is currently inactive: %1$s.',
                    'The following required plugins are currently inactive: %1$s.',
                    'gaumap'
                ),
                'notice_can_activate_recommended' => _n_noop(
                    'The following recommended plugin is currently inactive: %1$s.',
                    'The following recommended plugins are currently inactive: %1$s.',
                    'gaumap'
                ),
                'install_link'                    => _n_noop(
                    'Begin installing plugin',
                    'Begin installing plugins',
                    'gaumap'
                ),
                'update_link'                     => _n_noop(
                    'Begin updating plugin',
                    'Begin updating plugins',
                    'gaumap'
                ),
                'activate_link'                   => _n_noop(
                    'Begin activating plugin',
                    'Begin activating plugins',
                    'gaumap'
                ),
                'return'                          => __('Return to Required Plugins Installer', 'gaumap'),
                'plugin_activated'                => __('Plugin activated successfully.', 'gaumap'),
                'activated_successfully'          => __('The following plugin was activated successfully:', 'gaumap'),
                'plugin_already_active'           => __('No action taken. Plugin %1$s was already active.', 'gaumap'),
                'plugin_needs_higher_version'     => __('Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'gaumap'),
                'complete'                        => __('All plugins installed and activated successfully. %1$s', 'gaumap'),
                'dismiss'                         => __('Dismiss this notice', 'gaumap'),
                'notice_cannot_install_activate'  => __('There are one or more required or recommended plugins to install, update or activate.', 'gaumap'),
                'contact_admin'                   => __('Please contact the administrator of this site for help.', 'gaumap'),
                'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
            ],
        
        ];
        
        tgmpa($plugins, $config);
    }
    
}

new RequirePlugins();