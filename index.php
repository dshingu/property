<?php

/**
 *
 *  Plugin Name: Property
 *  Description: Wordpress Property plugin that utlizes google map api to pinpoint location of properties across a geographical area
 *  Version: 1.0
 *  Author: Dane Shingu
 *  Text Domain: property
 *
 */

 if( !function_exists('add_action') ){
 
    echo "Not allowed";
    exit;
 
 }
 
// Setup
define( 'PLUGIN_DIR', __DIR__ );
$property_category = null;
$featured_category = null;
 
 
// Includes
include('includes/helper.php');
include('includes/activate.php');
include('includes/init.php');
include('includes/admin/init.php');
include('includes/admin/enqueue.php');
include('includes/property_api.php');
include('includes/admin/menu.php');
include('includes/shortcode.php');
include('includes/filters.php');
include('includes/enqueue.php');
include('process/save-property.php');
include('process/delete-property.php');
 
// Hooks & Filters
register_activation_hook(  __FILE__, 'property_plugin_activate' );
add_action('init', 'property_init');
add_action('admin_enqueue_scripts', 'property_admin_enqueue');
add_action('wp_enqueue_scripts', 'property_enqueue');
add_action('admin_init', 'property_admin_init');
add_action('admin_menu', 'property_setting_menu');
add_action('save_post_property', 'save_property_admin', 10, 3);
add_action('admin_post_save_property_setting', 'save_property_setting');
add_action('rest_api_init', 'property_api');
add_action('delete_post_property', 'save_property_admin', 10, 3);
add_filter( 'single_template', 'property_single_template_filter');
add_filter('archive_template', 'property_archive_template_filter');
add_filter( 'page_template', 'property_interactive_map_template');
add_filter('map_category_filter', 'property_map_category_filter');
add_filter('single_property_slider_filter', 'single_property_slider_filter');
add_filter('map_get_properties', 'get_properties');
add_filter('property_single_featured_properties', 'property_single_featured_properties');


 
// Shortcode
add_shortcode('property', 'property_shortcode');