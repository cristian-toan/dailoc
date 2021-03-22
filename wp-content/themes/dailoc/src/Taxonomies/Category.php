<?php

namespace Gaumap\Taxonomies;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

class Category extends GauMapBaseTaxonomy {
    
    public function __construct() {
        parent::__construct();
        $this->singular = __('Chuyên mục', 'gaumap');
        $this->plural   = __('Chuyên mục', 'gaumap');
    }
    
}