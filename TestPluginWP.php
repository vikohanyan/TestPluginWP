<?php
/*
Plugin Name: TestPlugin
Description: Test Plugin for manage products.
Version:  1.0
*/
require_once plugin_dir_path(__FILE__) . 'includes/plugin-functions.php';

add_action( 'init', 'create_post_type' );

function product_install()
{
	create_post_type();

	flush_rewrite_rules();

	add_action('add_meta_boxes', 'wporg_add_custom_box');

}
register_activation_hook( __FILE__, 'product_install' );

function product_deactivation()
{
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'product_deactivation' );


add_action( 'admin_menu', 'Add_Product_Admin_Link' );

