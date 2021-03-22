<?php

namespace Gaumap\Taxonomies;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

class GauMapBaseTaxonomy {
    
    public $taxonomy = 'category';
    
    public $slug = 'category';
    
    public $postTypes = ['post'];
    
    public $singular = 'Chuyên mục';
    
    public $plural = 'Categories';
    
    public $hierarchy = true;
    
    /**
     * The name of the custom meta box to use on the post editing screen for this taxonomy
     *
     * @var string
     *
     * 'radio' - a meta box with radio inputs
     * 'simple' - a meta box with a simplified list of checkboxes
     * 'dropdown' - a meta box with a dropdown menu
     * 'custom_callback_function' - pass the name of a callback function, eg my_super_meta_box()
     * 'false' - Boolean to remove the meta box completely
     * 'null' (default) - the standard WordPress meta box is used
     */
    public $metaBox = 'simple';
    
    /**
     * Whether to always show checked terms at the top of the meta box. This allows you to override WordPress' default behaviour if necessary.
     *
     * @var bool
     *
     * 'false' - Default if using a custom_callback_function in the meta_box arguments
     * 'true' - Default if not using a custom_callback_function in the meta_box arguments
     */
    public $checkOnTop = true;
    
    /**
     * Whether to show this taxonomy on the 'At a Glance' section of the admin dashboard
     *
     * @var bool
     */
    public $dashboardGlance = false;
    
    public function __construct() {
        add_action('init', function() {
            register_extended_taxonomy(
                $this->taxonomy,
                $this->postTypes,
                [
                    'meta_box'         => $this->metaBox,
                    'checked_ontop'    => $this->checkOnTop,
                    'dashboard_glance' => $this->dashboardGlance,
                    'allow_hierarchy'  => $this->hierarchy,
                ],
                [
                    'singular' => $this->singular,
                    'plural'   => $this->plural,
                    'slug'     => $this->taxonomy,
                ]);
        });
        
        $filename = dirname(__FILE__) . '/../../' . ($this->taxonomy === 'category' ? 'category.php' : 'taxonomy-' . $this->taxonomy . '.php');
        if(!file_exists($filename)) file_put_contents($filename, "<?php phpinfo() ?>");
    
        Container::make('term_meta', __('Advanced', 'gaumap'))
                 ->where('term_taxonomy', '=', $this->taxonomy)
                 ->add_fields([
                                  Field::make('checkbox', 'show_homepage', __('Hiển thị ngoài trang chủ', 'gaumap')),
                                  Field::make('text', 'thu_tu', __('Thứ tự', 'gaumap'))->set_attribute('type', 'number'),
                              ]);
    }
    
    public function getList($args = []) {
        return get_terms($this->taxonomy, $args);
    }
    
    public function sidebarListTaxonomies() {
        $terms = $this->getList([
                                    'hide_empty' => true,
                                    'order'      => 'ASC',
                                    'orderby'    => 'meta_value_num',
                                    'meta_key'   => '_thu_tu',
                                ]); ?>
        <div class="gm-sidebar--container">
            <div class="gm-sidebar--header">
                <h4 class="gm-sidebar--title">
                    <?php echo $this->singular ?>
                </h4>
            </div>
            <div class="gm-sidebar--content">
                <?php if(count($terms) > 0) : ?>
                    <ul class="gm-sidebar--list">
                        <?php foreach($terms as $term) : ?>
                            <li><a href="<?php echo get_term_link($term) ?>"><?php echo $term->name ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    <?php }
}