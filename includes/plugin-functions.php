<?php

function create_post_type() {
	register_post_type( 'acme_product',
		array(
			'labels' => array(
				'name' => 'Products',
				'singular_name' => 'Product',
				'add_new' => 'Add New Product',
				'add_new_item' => 'Add New Product',
				'edit_item' => 'Edit Product',
				'new_item' => 'New Product',
				'all_items' => 'All Products',
				'view_item' => 'View Product',
				'search_items' => 'Search Products',
				'not_found' =>  'No Products Found',
				'not_found_in_trash' => 'No Products found in Trash',
				'parent_item_colon' => '',
				'menu_name' => 'Products',
			),
			'public' => true,
			'has_archive' => true,
			'supports' => array('title','thumbnail','editor'),
		)
	);
}

function Add_Product_Admin_Link()
{
	add_menu_page(
		'Products Settings',
		'Products Settings',
		'manage_options',
		'product_settings_admin',
		'product_settings_admin_page'
	);
	add_action( 'admin_init', 'register_plugin_settings' );
}

function register_product_settings() {
	register_setting( 'product-settings-group', 'product_price' );
	register_setting( 'product-settings-group', 'product_width' );
	register_setting( 'product-settings-group', 'product_height' );
	register_setting( 'product-settings-group', 'product_weight' );
	register_setting( 'product-settings-group', 'product_color' );
}

function product_settings_admin_page() {
	if (!current_user_can('manage_options')) {
		wp_die('Unauthorized user');
	}

	if (isset($_POST['product_price'])) {
		update_option('product_price', $_POST['product_price']);
	}
	if (isset($_POST['product_width'])) {
		update_option('product_width', $_POST['product_width']);
	}
	if (isset($_POST['product_height'])) {
		update_option('product_height', $_POST['product_height']);
	}
	if (isset($_POST['product_weight'])) {
		update_option('product_weight', $_POST['product_weight']);
	}
	if (isset($_POST['product_color'])) {
		update_option('product_color', $_POST['product_color']);
	}
	add_action( 'admin_enqueue_scripts', 'load_wp_media_files' );
	include 'admin-page.php';

}

function load_wp_media_files() {
	wp_enqueue_media();
}
