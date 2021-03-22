<?php

namespace Gaumap\PostTypes;

use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;

/**
 * Class Post
 *
 * @package app\PostTypes
 */
class Post extends GauMapBaseModel {
    
    /**
     * @var null $post_type
     */
    public $post_type = 'post';
    
    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $this->singularName = __('Bài viết', 'gaumap');
        $this->pluralName   = __('Bài viết', 'gaumap');
    }
    
    public function createCustomMeta() {
          Container::make('post_meta', __('Tin tức nổi bật', 'gaumap'))
                 ->set_context('carbon_fields_after_title')// normal, advanced, side or carbon_fields_after_title
                 ->set_priority('high')// high, core, default or low
                 ->where('post_type', 'IN', [$this->post_type])
                 ->add_fields([
                                   Field::make('checkbox', 'feature', __('Nổi bật', 'gaumap')),
                                  ]);
    }
}