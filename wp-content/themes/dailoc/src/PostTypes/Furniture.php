<?php

namespace Gaumap\PostTypes;


use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;

class Furniture extends GauMapBaseModel {
    
    public $post_type = 'noi-that';
    
    public $menuIcon = 'dashicons-editor-table';
    
    public $supports = [
        'title',
        'editor',
        'thumbnail',
        'excerpt',
    ];
    
    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $this->singularName = __('Nội thất', 'gaumap');
        $this->pluralName   = __('Nội thất', 'gaumap');
    }
    
    public function createCustomMeta() {
        Container::make('post_meta', __('Advanced', 'gaumap'))
                 ->set_context('carbon_fields_after_title')// normal, advanced, side or carbon_fields_after_title
                 ->set_priority('high')// high, core, default or low
                 ->where('post_type', 'IN', [$this->post_type])
                 ->add_fields([
                                  Field::make('text', 'customer', __('Khách hàng', 'gaumap')),
                                  Field::make('text', 'domain', __('Tên miền', 'gaumap')),
                                  Field::make('date', 'date_publish', __('Ngày phát hành', 'gaumap')),
                                  Field::make('text', 'location', __('Địa chỉ', 'gaumap')),
                              ]);
    }
    
}