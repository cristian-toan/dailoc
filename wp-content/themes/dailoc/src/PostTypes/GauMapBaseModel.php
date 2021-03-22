<?php

namespace Gaumap\PostTypes;

use Illuminate\Database\Eloquent\Model;

class GauMapBaseModel extends Model {
    
    const CREATED_AT = 'post_date';
    const UPDATED_AT = 'post_modified';
    
    /**
     * @var null $post_type
     */
    public $post_type = 'post';
    
    /**
     * Name for one object of this post type.
     *
     * @var string
     */
    public $singularName = 'Default post';
    
    /**
     * Name for one object of this post type in plural
     *
     * @var string
     */
    public $pluralName = 'Default posts';
    
    /**
     * A short descriptive summary of what the post type is.
     *
     * @var string
     */
    public $description = 'Default description';
    
    /**
     * Whether to exclude posts with this post type from front end search results.
     * Note: If you want to show the posts's list that are associated to taxonomy's terms, you must set exclude_from_search to false
     * (ie : for call site_domaine/?taxonomy_slug=term_slug or site_domaine/taxonomy_slug/term_slug).
     * If you set to true, on the taxonomy page (ex: taxonomy.php) WordPress will not find your posts and/or pagination will make 404 error...
     * 'false' - site/?s=search-term will include posts of this post type.
     * 'true' - site/?s=search-term will not include posts of this post type.
     *
     * @var bool
     */
    public $excludeFromSearch = false;
    
    /**
     * Whether queries can be performed on the front end as part of parse_request().
     * Note: The queries affected include the following (also initiated when rewrites are handled). If query_var is empty, null, or a boolean FALSE,
     * WordPress will still attempt to interpret it (4.2.2) and previews/views of your custom post will return 404s.
     * ?post_type={post_type_key}
     * ?{post_type_key}={single_post_slug}
     * ?{post_type_query_var}={single_post_slug}
     *
     * @var bool
     */
    public $publiclyQueryable = true;
    
    /**
     * Whether to generate a default UI for managing this post type in the admin.
     * Note: _built-in post types, such as post and page, are intentionally set to false.
     * 'false' - do not display a user-interface for this post type
     * 'true' - display a user-interface (admin panel) for this post type
     *
     * @var bool
     */
    public $showUi = true;
    
    /**
     * Whether post_type is available for selection in navigation menus.
     *
     * @var bool
     */
    public $showInNavMenus = true;
    
    /**
     * Where to show the post type in the admin menu. show_ui must be true.
     * Note: When using 'some string' to show as a submenu of a menu page created by a plugin, this item will become the first submenu item, and replace the location of the top-level link. If this isn't desired, the plugin that creates the menu page needs to set the add_action priority for admin_menu to 9 or lower.
     * Note: As this one inherits its value from show_ui, which inherits its value from public, it seems to be the most reliable property to determine, if a post type is meant to be publicly useable. At least this works for _builtin post types and only gives back post and page.
     * 'false' - do not display in the admin menu
     * 'true' - display as a top level menu
     * 'some string' - If an existing top level page such as 'tools.php' or 'edit.php?post_type=page', the post type will be placed as a sub menu of that.
     *
     * @var bool|string
     */
    public $showInMenu = true;
    
    /**
     * Whether to make this post type available in the WordPress admin bar.
     *
     * @var bool
     */
    public $show_in_admin_bar = true;
    
    /**
     * The position in the menu order the post type should appear. show_in_menu must be true.
     *
     * @var int
     * 5 - below Posts
     * 10 - below Media
     * 15 - below Links
     * 20 - below Pages
     * 25 - below comments
     * 60 - below first separator
     * 65 - below Plugins
     * 70 - below Users
     * 75 - below Tools
     * 80 - below Settings
     * 100 - below second separator
     */
    public $menuPosition = 5;
    
    /**
     * The url to the icon to be used for this menu or the name of the icon from the icon font
     * Example:
     * 'dashicons-video-alt' (Uses the video icon from Dashicons[2])
     * 'get_template_directory_uri() . "/images/cutom-post_type-icon.png"' (Use a image located in the current theme)
     * More example at https://developer.wordpress.org/resource/dashicons/#format-image
     *
     * @var string
     */
    public $menuIcon = 'dashicons-admin-links';
    
    /**
     * Whether the post type is hierarchical (e.g. page). Allows Parent to be specified.
     * The 'supports' parameter should contain 'page-attributes' to show the parent select box on the editor page.
     * Note: this parameter was intended for Pages. Be careful when choosing it for your custom post type.
     * If you are planning to have very many entries (say - over 2-3 thousand), you will run into load time issues.
     * With this parameter set to true WordPress will fetch all IDs of that particular post type on each administration page load for your post type.
     * Servers with limited memory resources may also be challenged by this parameter being set to true.
     *
     * @var bool
     */
    public $hierarchical = false;
    
    /**
     * An alias for calling add_post_type_support() directly. As of 3.5, boolean false can be passed as value instead of an array to prevent default
     * (title and editor) behavior.
     *
     * @var array|boolean
     */
    public $supports = [
        'title',
        'editor',
        'author',
        'thumbnail',
        'excerpt',
        'trackbacks',
        'custom-fields',
        'comments',
        'revisions',
        'page-attributes',
        'post-formats',
    ];
    
    /**
     * Whether to expose this post type in the REST API.
     *
     * @var bool
     */
    public $showInRest = true;
    
    public $quickEdit = true;
    
    public $archiveNoPaging = false;
    
    /**
     * @var string $primaryKey
     */
    protected $primaryKey = 'ID';
    
    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        add_action('init', function() {
            register_extended_post_type(
                $this->post_type,
                [
                    'show_in_feed'        => true,
                    'archive'             => [
                        'nopaging' => $this->archiveNoPaging,
                    ],
                    'quick_edit'          => $this->quickEdit,
                    'labels'              => $this->getLabels(),
                    'menu_icon'           => $this->menuIcon,
                    'supports'            => $this->supports,
                    'description'         => $this->description,
                    'exclude_from_search' => $this->excludeFromSearch,
                    'publicly_queryable'  => $this->publiclyQueryable,
                    'hierarchical'        => $this->hierarchical,
                    'show_in_rest'        => $this->showInRest,
                    'rest_base'           => $this->post_type,
                ],
                [
                    'singular' => $this->singularName,
                    'plural'   => $this->pluralName,
                    'slug'     => $this->post_type,
                ]
            );
        });
        
        $this->createCustomMeta();
        
        add_filter('manage_' . $this->post_type . '_posts_columns', [$this, 'editAdminColumn']);
        add_action('manage_' . $this->post_type . '_posts_custom_column', [$this, 'editAdminColumnData'], 10, 2);
        add_action('admin_head', [$this, 'adminCustomColumnStyle'], 10, 2);
        
        /* Create template single, archive, content */
        $postType = $this->post_type === 'post' ? '' : '-' . $this->post_type;
        $filename = dirname(__FILE__) . '/../../archive' . $postType . '.php';
        if(!file_exists($filename)) file_put_contents($filename, "<?php phpinfo() ?>");
    
        $filename = dirname(__FILE__) . '/../../content' . $postType . '.php';
        if(!file_exists($filename)) file_put_contents($filename, "<?php phpinfo() ?>");
    
        $filename = dirname(__FILE__) . '/../../single' . $postType . '.php';
        if(!file_exists($filename)) file_put_contents($filename, "<?php phpinfo() ?>");
    }
    
    /**
     * Custom style
     */
    public function adminCustomColumnStyle() {
        echo '<style>
                        .column-featured_image, .column-feature {
                            width:60px !important;
                        }
                        
                        .wp-list-table td {
                            vertical-align: middle;
                        }
                    </style>';
    }
    
    /**
     * Hook custom admin columns
     *
     * @param $columns
     *
     * @return array
     */
    public function editAdminColumn($columns) {
        return [
            'cb'             => '<input type="checkbox" />',
            'featured_image' => 'Image',
            'title'          => 'Title',
            'feature'   => 'Nổi bật',
            'comments'       => '<span class="vers"><div title="Comments" class="comment-grey-bubble"></div></span>',
            'date'           => 'Date',
        ];
    }
    
    /**
     * Hook custom admin column data
     *
     * @param $column
     * @param $postId
     */
    public function editAdminColumnData($column, $postId) {
        switch($column) {
            case 'featured_image':
                echo '<img src="' . getThePostThumbnailUrl($postId) . '" style="width:60px;height:60px;" />';
                break;
            case 'feature':
                $feature = carbon_get_post_meta($postId, 'feature');
                echo $feature ? 'Có' : 'Không';
                break;
        }
    }
    
    public function createCustomMeta() {
        
    }
    
    /**
     * Get array of post type label
     *
     * @return array
     */
    protected function getLabels() {
        return [
            'name'                  => $this->pluralName,
            'singular_name'         => $this->singularName,
            'add_new'               => __('Thêm mới', 'gaumap'),
            'add_new_item'          => __('Thêm mục mới', 'gaumap'),
            'edit_item'             => __('Sửa', 'gaumap'),
            'new_item'              => __('Mục mới', 'gaumap'),
            'view_item'             => __('Chi tiết', 'gaumap'),
            'search_items'          => __('Tìm kiếm', 'gaumap'),
            'not_found'             => __('Không tìm thấy', 'gaumap'),
            'not_found_in_trash'    => __('Không tìm thấy mục nào bị xóa', 'gaumap'),
            'parent_item_colon'     => __('Mục cha', 'gaumap'),
            'all_items'             => __('Xem tất cả', 'gaumap'),
            'archives'              => __('Các mục được lưu trữ', 'gaumap'),
            'insert_into_item'      => __('Chèn vào mục này', 'gaumap'),
            'uploaded_to_this_item' => __('Đính kèm vào mục này', 'gaumap'),
            'featured_image'        => __('Hình đại diện', 'gaumap'),
            'set_featured_image'    => __('Chọn hình đại diện này', 'gaumap'),
            'remove_featured_image' => __('Xóa hình đại diện', 'gaumap'),
            'use_featured_image'    => __('Sử dụng làm hình đại diện', 'gaumap'),
            'menu_name'             => $this->pluralName,
            'name_admin_bar'        => $this->singularName,
            //'filter_items_list' - String for the table views hidden heading.
            //'items_list_navigation' - String for the table pagination hidden heading.
            //'items_list' - String for the table hidden heading.
            //'name_admin_bar' - String for use in New in Admin menu bar. Default is the same as `singular_name`.
        ];
    }
    
    /**
     * Filter by post type
     *
     * @param        $query
     * @param string $type
     *
     * @return mixed
     */
    public function scopeType($query, $type = 'post') {
        return $query->where('post_type', '=', $type);
    }
    
    /**
     * Filter by post status
     *
     * @param        $query
     * @param string $status
     *
     * @return mixed
     */
    public function scopeStatus($query, $status = 'publish') {
        return $query->where('post_status', '=', $status);
    }
    
    /**
     * Filter by post author
     *
     * @param      $query
     * @param null $author
     *
     * @return mixed
     */
    public function scopeAuthor($query, $author = null) {
        if($author) {
            return $query->where('post_author', '=', $author);
        }
    }
    
    /**
     * Get comments from the post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments() {
        return $this->hasMany('WeDevs\ORM\WP\Comment', 'comment_post_ID');
    }
    
    /**
     * Get meta fields from the post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function meta() {
        return $this->hasMany('WeDevs\ORM\WP\PostMeta', 'post_id');
    }
    
    /**
     * get post thumbnail url
     *
     * @param string $size
     *
     * @return false|string
     */
    public function getThumbnailUri($size = 'thumbnail') {
        $thumbnailMeta = $this->getMeta('_thumbnail_id');
        
        return wp_get_attachment_image_url($thumbnailMeta->meta_value, $size);
    }
    
    /**
     * Get Meta By Key
     *
     * @param $key
     *
     * @return mixed
     */
    public function getMeta($key) {
        return $this->hasMany('WeDevs\ORM\WP\PostMeta', 'post_id')
                    ->where('meta_key', $key)->first();
    }
    
    /**
     * Lấy số bài viết liên quan
     *
     * @param $soBaiViet
     *
     * @return \WP_Query
     */
    public function getRelatePost($soBaiViet) {
        global $post;
        $postId      = $post->ID;
        $taxonomies  = get_post_taxonomies($postId);
        $arrTaxQuery = [];
        foreach($taxonomies as $taxonomy) {
            $arrTerm = [];
            $terms   = get_the_terms($postId, $taxonomy);
            if(!empty($terms)) {
                foreach($terms as $term) {
                    array_push($arrTerm, $term->term_id);
                }
                $arrTaxItem = [
                    'taxonomy'   => $taxonomy,
                    'field_name' => 'term_id',
                    'operator'   => 'IN',
                    'terms'      => $arrTerm,
                ];
                array_push($arrTaxQuery, $arrTaxItem);
            }
        }
        $posts = new \WP_Query([
                                   'post_type'      => $post->post_type,
                                   'post_status'    => 'publish',
                                   'posts_per_page' => $soBaiViet,
                                   'tax_query'      => $arrTaxQuery,
                               ]);
        return $posts;
    }
    
    /**
     * Lấy số bài viết sắp xếp theo số lượt xem
     *
     * @param $post_type
     *
     * @return mixed
     */
    public function layDanhSachBaiVietXemNhieu($post_type, $soLuong) {
        global $wpdb, $post;
        $query      = \DB::table('posts')
                         ->join('statistics_pages', 'posts.id', '=', 'statistics_pages.id')
                         ->where('posts.post_type', $post_type)
                         ->orderBy('statistics_pages.count', 'DESC')
                         ->select('posts.ID')
                         ->get();
        $arrPostIds = [];
        foreach($query as $item) {
            array_push($arrPostIds, $item->ID);
        }
        
        $posts = new \WP_Query([
                                   'post_type'      => $post_type,
                                   'post_status'    => 'publish',
                                   'posts_per_page' => $soLuong,
                                   'include'        => $arrPostIds,
                                   'exclude'        => [$post->ID],
                               ]);
        
        return $posts;
    }
    
    /**
     * Cập nhật số lượt xem của bài viết hiện tại
     */
    public function demSoLuotXem() {
        $postID = get_the_ID();
        if(!empty($postID)) {
            $count_key = 'gaumap_so_luot_xem';
            $count     = get_post_meta($postID, $count_key, true);
            if($count == '') {
                delete_post_meta($postID, $count_key);
                add_post_meta($postID, $count_key, 0);
            } else {
                $count++;
                update_post_meta($postID, $count_key, $count);
            }
        }
    }
    
    /**
     * Đọc số lượt xem của bài viết theo ID
     *
     * @param $postID
     *
     * @return int|mixed
     */
    public function docSoLuotXemCuaBaiViet($postID) {
        $count_key = 'gaumap_so_luot_xem';
        $count     = get_post_meta($postID, $count_key, true);
        if($count == '') {
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
            
            return 0;
        }
        
        return $count;
    }
    
    /**
     * Đọc số lượt xem của bài viết hiện tại
     *
     * @return int|mixed
     */
    public function docSoLuotXem() {
        $postID    = get_the_ID();
        $count_key = 'gaumap_so_luot_xem';
        $count     = get_post_meta($postID, $count_key, true);
        if($count == '') {
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
            
            return 0;
        }
        
        return $count;
    }
    
}