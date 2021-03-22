<?php

namespace Gaumap\PostTypes;

use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;

class Product extends GauMapBaseModel {
    
    public $post_type = 'san-pham';
    
    public $menuIcon = 'dashicons-layout';
    
    public $supports = [
        'title',
        'editor',
        'thumbnail',
        'excerpt',
    ];
    
    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $this->singularName = __('Sản phẩm', 'gaumap');
        $this->pluralName   = __('Sản phẩm', 'gaumap');
    }
    
    public function createCustomMeta() {
        Container::make('post_meta', __('Advanced', 'gaumap'))
                 ->set_context('carbon_fields_after_title')// normal, advanced, side or carbon_fields_after_title
                 ->set_priority('high')// high, core, default or low
                 ->where('post_type', 'IN', [$this->post_type])
                 ->add_fields([
                                  Field::make('text', 'price', __('Giá bán', 'gaumap'))->set_attributes(['type' => 'number']),
                                  Field::make('media_gallery', 'images', __('Thư viện ảnh', 'gaumap'))->set_type(['image']),
                              ]);
    }
    
}