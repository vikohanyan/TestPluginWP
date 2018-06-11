<?php
/*
Plugin Name: TestPlugin
Description: Test Plugin for manage products.
Version:  1.0
*/
require_once plugin_dir_path(__FILE__) . 'includes/Plugin-functions.php';

function create_post_type() {
	register_post_type( 'acme_product',
		array(
			'labels' => array(
				'name' => __( 'Products' ),
				'singular_name' => __( 'Product' )
			),
			'public' => true,
			'has_archive' => true,
		)
	);
}
add_action( 'init', 'create_post_type' );

function product_install()
{
	create_post_type();

	flush_rewrite_rules();

}
register_activation_hook( __FILE__, 'product_install' );

function product_deactivation()
{
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'product_deactivation' );

