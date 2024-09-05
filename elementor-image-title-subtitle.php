<?php
/**
 * Plugin Name: Elementor Image Title Subtitle Addon
 * Description: A simple Elementor add-on to add an image, title, and subtitle widget.
 * Version: 1.0.0
 * Author: Soyeb Salar
 * Author URI: https://www.linkedin.com/in/soyebsalar/
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: elementor-image-title-subtitle
 * Donate link: https://www.soyebsalar.in/donate/
 * Requires Plugins: elementor
 */

if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly

define("EIT_PLUGIN_PATH", plugin_dir_path(__FILE__));
define("EIT_PLUGIN_URL", plugin_dir_url(__FILE__));
define("EIT_PLUGIN_BASENAME", plugin_basename(__FILE__));

// Register Widget Class
function register_eit_widget($widgets_manager)
{
    require_once EIT_PLUGIN_PATH . '/widgets/image-title-subtitle-widget.php';
    $widgets_manager->register(new \EIT_Image_Title_Subtitle_Widget());
}
add_action('elementor/widgets/register', 'register_eit_widget');

// Enqueue any CSS or JS
function eit_addon_widget_styles()
{
    wp_enqueue_style('eit-widget-style', EIT_PLUGIN_PATH . 'assets/css/style.css');
}
add_action('wp_enqueue_scripts', 'eit_addon_widget_styles');
