<?php
/**
 * Plugin Name: Hello Elementor Custom Widgets
 * Description: Custom Elementor widgets collection
 * Plugin URI:  https://github.com/HeyPuddinn/tuan-site
 * Version:     1.0.0
 * Author:      HeyPuddinn
 * Author URI:  https://github.com/HeyPuddinn
 * Text Domain: hello-elementor-widgets
 * GitHub Plugin URI: https://github.com/HeyPuddinn/tuan-site
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Load Plugin Update Checker
require_once plugin_dir_path(__FILE__) . 'includes/plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

final class Hello_Elementor_Widgets {
    // Plugin version
    const VERSION = '1.0.0';
    const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

    // Plugin instance
    private static $_instance = null;

    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        // Initialize plugin
        add_action('plugins_loaded', [$this, 'init']);

        // Setup auto-update from GitHub
        $this->setup_auto_update();
    }

    private function setup_auto_update() {
        $updateChecker = PucFactory::buildUpdateChecker(
            'https://github.com/HeyPuddinn/tuan-site',
            __FILE__,
            'hello-elementor-widgets'
        );

        // Set the branch that contains the stable release
        $updateChecker->setBranch('main');
    }

    public function init() {
        // Check if Elementor installed and activated
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_elementor']);
            return;
        }

        // Check for required Elementor version
        if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
            return;
        }

        // Add Plugin actions
        add_action('elementor/widgets/register', [$this, 'register_widgets']);
        add_action('wp_enqueue_scripts', [$this, 'widget_styles']);
    }

    public function admin_notice_missing_elementor() {
        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'hello-elementor-widgets'),
            '<strong>' . esc_html__('Hello Elementor Custom Widgets', 'hello-elementor-widgets') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'hello-elementor-widgets') . '</strong>'
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    public function admin_notice_minimum_elementor_version() {
        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'hello-elementor-widgets'),
            '<strong>' . esc_html__('Hello Elementor Custom Widgets', 'hello-elementor-widgets') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'hello-elementor-widgets') . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    public function register_widgets($widgets_manager) {
        // Auto load all widgets
        $widget_directories = glob(plugin_dir_path(__FILE__) . 'widgets/*', GLOB_ONLYDIR);
        
        foreach ($widget_directories as $widget_dir) {
            $widget_name = basename($widget_dir);
            
            // Register widget assets
            $this->register_widget_assets($widget_name);
            
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

    private function register_widget_assets($widget_name) {
        // Register CSS
        $css_file = plugin_dir_path(__FILE__) . 'widgets/' . $widget_name . '/assets/css/' . $widget_name . '.css';
        if (file_exists($css_file)) {
            wp_register_style(
                $widget_name . '-style',
                plugins_url('/widgets/' . $widget_name . '/assets/css/' . $widget_name . '.css', __FILE__),
                [],
                self::VERSION
            );
        }

        // Register JS
        $js_file = plugin_dir_path(__FILE__) . 'widgets/' . $widget_name . '/assets/js/' . $widget_name . '.js';
        if (file_exists($js_file)) {
            wp_register_script(
                $widget_name . '-script',
                plugins_url('/widgets/' . $widget_name . '/assets/js/' . $widget_name . '.js', __FILE__),
                ['jquery'],
                self::VERSION,
                true
            );
        }
    }

    public function widget_styles() {
        // Auto enqueue all widget styles
        $widget_directories = glob(plugin_dir_path(__FILE__) . 'widgets/*', GLOB_ONLYDIR);
        
        foreach ($widget_directories as $widget_dir) {
            $widget_name = basename($widget_dir);
            wp_enqueue_style($widget_name . '-style');
            wp_enqueue_script($widget_name . '-script');
        }
    }
}

// Initialize plugin
Hello_Elementor_Widgets::instance(); 