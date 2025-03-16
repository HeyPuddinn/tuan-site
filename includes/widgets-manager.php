<?php
namespace HelloElementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Widgets_Manager {
    
    private static $_instance = null;
    
    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    public function __construct() {
        add_action('elementor/widgets/register', [$this, 'register_widgets']);
        add_action('elementor/frontend/after_register_scripts', [$this, 'register_frontend_scripts']);
        add_action('elementor/frontend/after_register_styles', [$this, 'register_frontend_styles']);
        add_action('elementor/elements/categories_registered', [$this, 'add_elementor_widget_categories']);
    }
    
    public function register_widgets($widgets_manager) {
        // Auto load all widgets
        $widget_directories = glob(HELLO_ELEMENTOR_WIDGETS_PATH . 'widgets/*', GLOB_ONLYDIR);
        
        foreach ($widget_directories as $widget_dir) {
            $widget_name = basename($widget_dir);
            
            // Include widget class file
            $class_file = $widget_dir . '/class-' . $widget_name . '.php';
            if (file_exists($class_file)) {
                require_once $class_file;
                $class_name = '\HelloElementor\Widgets\\' . str_replace('-', '_', ucwords($widget_name, '-'));
                if (class_exists($class_name)) {
                    $widgets_manager->register(new $class_name());
                }
            }
        }
    }
    
    public function register_frontend_scripts() {
        // Common scripts for all widgets
        wp_register_script(
            'gsap',
            'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js',
            [],
            '3.12.2',
            true
        );

        wp_register_script(
            'scrolltrigger',
            'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js',
            ['gsap'],
            '3.12.2',
            true
        );

        wp_register_script(
            'swiper',
            'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js',
            [],
            '10.0.0',
            true
        );

        // Auto register all widget scripts
        $widget_directories = glob(HELLO_ELEMENTOR_WIDGETS_PATH . 'widgets/*', GLOB_ONLYDIR);
        foreach ($widget_directories as $widget_dir) {
            $widget_name = basename($widget_dir);
            $js_file = $widget_dir . '/assets/js/' . $widget_name . '.js';
            
            if (file_exists($js_file)) {
                wp_register_script(
                    $widget_name . '-script',
                    plugins_url('widgets/' . $widget_name . '/assets/js/' . $widget_name . '.js', HELLO_ELEMENTOR_WIDGETS_FILE),
                    ['jquery', 'gsap', 'scrolltrigger', 'swiper'],
                    HELLO_ELEMENTOR_WIDGETS_VERSION,
                    true
                );
            }
        }
    }
    
    public function register_frontend_styles() {
        // Common styles for all widgets
        wp_register_style(
            'swiper',
            'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css',
            [],
            '10.0.0'
        );

        // Register custom.css
        wp_register_style(
            'hello-elementor-custom',
            plugins_url('assets/css/custom.css', HELLO_ELEMENTOR_WIDGETS_FILE),
            [],
            HELLO_ELEMENTOR_WIDGETS_VERSION
        );
        wp_enqueue_style('hello-elementor-custom');

        // Auto register all widget styles
        $widget_directories = glob(HELLO_ELEMENTOR_WIDGETS_PATH . 'widgets/*', GLOB_ONLYDIR);
        foreach ($widget_directories as $widget_dir) {
            $widget_name = basename($widget_dir);
            $css_file = $widget_dir . '/assets/css/' . $widget_name . '.css';
            
            if (file_exists($css_file)) {
                wp_register_style(
                    $widget_name . '-style',
                    plugins_url('widgets/' . $widget_name . '/assets/css/' . $widget_name . '.css', HELLO_ELEMENTOR_WIDGETS_FILE),
                    ['swiper'],
                    HELLO_ELEMENTOR_WIDGETS_VERSION
                );
            }
        }
    }

    public function add_elementor_widget_categories($elements_manager) {
        $elements_manager->add_category(
            'hello-elementor-widgets',
            [
                'title' => esc_html__('Hello Elementor Widgets', 'hello-elementor-widgets'),
                'icon' => 'fa fa-plug',
            ]
        );
    }
} 