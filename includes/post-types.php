<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Hello_Elementor_Post_Types {
    public function __construct() {
        add_action('init', [$this, 'register_post_types']);
    }

    public function register_post_types() {
        // Register Gallery Post Type
        register_post_type('gallery',
            array(
                'labels' => array(
                    'name' => __('Gallery', 'hello-elementor-widgets'),
                    'singular_name' => __('Gallery Item', 'hello-elementor-widgets'),
                    'add_new' => __('Add New', 'hello-elementor-widgets'),
                    'add_new_item' => __('Add New Gallery Item', 'hello-elementor-widgets'),
                    'edit_item' => __('Edit Gallery Item', 'hello-elementor-widgets'),
                    'new_item' => __('New Gallery Item', 'hello-elementor-widgets'),
                    'view_item' => __('View Gallery Item', 'hello-elementor-widgets'),
                    'search_items' => __('Search Gallery Items', 'hello-elementor-widgets'),
                    'not_found' => __('No gallery items found', 'hello-elementor-widgets'),
                    'not_found_in_trash' => __('No gallery items found in trash', 'hello-elementor-widgets'),
                    'parent_item_colon' => '',
                    'menu_name' => __('Gallery', 'hello-elementor-widgets')
                ),
                'public' => true,
                'has_archive' => true,
                'show_in_menu' => true,
                'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
                'menu_icon' => 'dashicons-format-gallery',
                'rewrite' => array('slug' => 'gallery'),
                'show_in_rest' => true,
            )
        );
    }
}

new Hello_Elementor_Post_Types(); 