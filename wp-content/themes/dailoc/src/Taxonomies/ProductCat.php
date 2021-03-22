<?php

namespace Gaumap\Taxonomies;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

class ProductCat extends GauMapBaseTaxonomy {
    
    public $metaBox = null;
    
    public $taxonomy = 'danh-muc';
    
    public function __construct() {
        parent::__construct();
        $this->singular  = __('Danh mục sản phẩm', 'gaumap');
        $this->plural    = __('Danh mục sản phẩm', 'gaumap');
        $this->postTypes = ['san-pham'];
    }
    
    public function getHomepageCategory(){
        $rootTerms = get_terms($this->taxonomy, [
            'hide_empty' => false,
            'parent'     => 0,
            'order'      => 'ASC',
            'orderby'    => 'meta_value_num',
            'meta_key'   => '_thu_tu',
            'meta_query' => [
                [
                    'key' => '_show_homepage',
                    'value' => 'yes'
                ],
            ],
        ]);
        return $rootTerms;
    }
    
}