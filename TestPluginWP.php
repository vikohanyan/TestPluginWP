<?php
/*
Plugin Name: TestPlugin
Description: Test Plugin for manage products.
Version:  1.0
*/
require_once plugin_dir_path(__FILE__) . 'includes/plugin-functions.php';

add_action( 'admin_menu', 'Add_Product_Admin_Link' );
add_action( 'admin_enqueue_scripts', 'load_scripts_admin' );
add_action( 'init', 'create_post_type' );
add_action( 'init', 'create_table_test_plugin' );
add_action( 'admin_init', 'product_fields' );
add_action('save_post', 'save_product_meta_box', 0);
function product_install()
{
	create_table_test_plugin();
	create_post_type();
	flush_rewrite_rules();
}

function product_deactivation()
{
	flush_rewrite_rules();
}

function product_uninstall()
{
	drop_table_test_plugin();
}

register_activation_hook( __FILE__, 'product_install' );
register_deactivation_hook( __FILE__, 'product_deactivation' );
register_uninstall_hook(__FILE__,'product_uninstall' );