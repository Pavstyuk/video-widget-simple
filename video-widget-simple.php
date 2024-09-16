<?php
/*
Plugin Name: Video Widget Simple Plugin
Plugin URI: https://pavstyuk.ru/
Description: Very Simple plugin to display video widget with presentation of business or any ideas on front page of your WordPress Site.
Version: 0.0.3
Requires at least: 5.8
Requires PHP: 5.6.20
Author: Mikhail Pavstyuk
Author URI: https://pavstyuk.ru/
License: GPLv2 or later
Text Domain: vws
Domain Path: /languages
*/

if (!function_exists('add_action')) {
    die('Nothing to do. Bye.');
}

define('VWS_VER', '0.0.3');
define('VWS_DIR', plugin_dir_path(__FILE__));

require_once VWS_DIR . "widget-functions.php";
require_once "widget-pages.php";

add_action("admin_enqueue_scripts", "vws_scripts_admin");
add_action("admin_init", "vws_add_settings");
add_action('plugin_loaded', 'vws_load_text_domain');
add_action("admin_menu", "vws_plugin_pages");
add_action('wp_print_footer_scripts', 'vws_scripts_front');
