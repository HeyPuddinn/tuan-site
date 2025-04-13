<?php
/**
 * Plugin Name: Hello Elementor Widgets
 * Description: Custom widgets for Elementor
 * Version: 1.1.12
 * Author: Ethan
 * Text Domain: hello-elementor-widgets
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

define('HELLO_ELEMENTOR_WIDGETS_VERSION', '1.0.0');
define('HELLO_ELEMENTOR_WIDGETS_FILE', __FILE__);
define('HELLO_ELEMENTOR_WIDGETS_PATH', plugin_dir_path(HELLO_ELEMENTOR_WIDGETS_FILE));
define('HELLO_ELEMENTOR_WIDGETS_URL', plugins_url('/', HELLO_ELEMENTOR_WIDGETS_FILE));

// Load the Widgets Manager
require_once(HELLO_ELEMENTOR_WIDGETS_PATH . 'includes/widgets-manager.php');

function hello_elementor_widgets_init() {
    // Check if Elementor is installed and activated
    if (!did_action('elementor/loaded')) {
        add_action('admin_notices', function() {
            $message = sprintf(
                esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'hello-elementor-widgets'),
                '<strong>Hello Elementor Widgets</strong>',
                '<strong>Elementor</strong>'
            );
            printf('<div class="notice notice-error"><p>%1$s</p></div>', $message);
        });
        return;
    }

    // Initialize the plugin
    \HelloElementor\Widgets_Manager::instance();
}
add_action('plugins_loaded', 'hello_elementor_widgets_init'); 