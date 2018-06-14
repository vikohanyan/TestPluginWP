<?php
function create_table_test_plugin () {

	global  $wpdb;
	$defaultImg      = plugins_url( 'img/image.png', __FILE__ );
	$table_name = $wpdb->prefix . "test_plugin";
	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
		$sql = "CREATE TABLE ". $table_name ." (
			id mediumint(1) NOT NULL AUTO_INCREMENT,
		    price INT(1) DEFAULT 1 NOT NULL,
		    height INT(1) DEFAULT 1 NOT NULL,
		    width INT(1) DEFAULT 1 NOT NULL,
		    weight INT(1) DEFAULT 1 NOT NULL,
		    color INT(1) DEFAULT 1 NOT NULL,
	        url varchar(150) DEFAULT '". $defaultImg ."' NOT NULL,
	        UNIQUE KEY id (id)
		);";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}
}

function drop_table_test_plugin(){
	if( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) exit();
	global $wpdb;
	$table_name = $wpdb->prefix . "test_plugin";
	$wpdb->query( "DROP TABLE IF EXISTS ".$table_name );
}

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
			'supports' => array( 'title', 'editor', 'thumbnail'),
		)
	);
	add_action( 'admin_init', 'update_post_price_info' );
}
if( !function_exists("update_post_price_info") ) {
	function update_post_price_info() {
		register_setting( 'product-post-settings', 'price_visibility' );
	}
}

function product_fields() {
	add_meta_box( "product_field_price", "Price", "fields_price_box", "acme_product", "normal", "high" );
	add_meta_box( "product_field_width", "width", "fields_width_box", "acme_product", "normal", "high" );
	add_meta_box( "product_field_height", "height", "fields_height_box", "acme_product", "normal", "high" );
	add_meta_box( "product_field_weight", "weight", "fields_weight_box", "acme_product", "normal", "high" );
	add_meta_box( "product_field_color", "color", "fields_color_box", "acme_product", "normal", "high" );
}
function fields_price_box(){
	global $post;
	$custom = get_post_custom($post->ID);
	?>
	<input type="number" name="product_price" value="<?= $custom["product_price"][0]?>" >
	<?php
}

function fields_width_box(){
	global $post;
	$custom = get_post_custom($post->ID);
	?>
	<input type="number" name="product_width" value="<?= $custom["product_width"][0]?>" >
	<?php
}
function fields_height_box(){
	global $post;
	$custom = get_post_custom($post->ID);
	?>
	<input type="number" name="product_height" value="<?= $custom["product_height"][0]?>" >
	<?php
}
function fields_weight_box(){
	global $post;
	$custom = get_post_custom($post->ID);
	?>
	<input type="number" name="product_weight" value="<?= $custom["product_weight"][0]?>" >
	<?php
}
function fields_color_box(){
	global $post;
	$custom = get_post_custom($post->ID);
	?>
	<input type="color" name="product_color" value="<?= $custom["product_color"][0]?>" >
	<?php
}

function save_product_meta_box( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return false;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return false;
	}
//	global $post;
	var_dump($post_id);
		update_post_meta( $post_id, "product_price", $_POST["product_price"] );
		update_post_meta( $post_id, "product_width", $_POST["product_width"] );
		update_post_meta( $post_id, "product_height", $_POST["product_height"] );
		update_post_meta( $post_id, "product_weight", $_POST["product_weight"] );
		update_post_meta( $post_id, "product_color", $_POST["product_color"] );
}
function load_scripts_admin() {
	wp_enqueue_media();
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
	add_action( 'admin_init', 'register_product_settings' );
}
function register_product_settings() {
	register_setting( 'product-settings-group', 'product_price' );
	register_setting( 'product-settings-group', 'product_width' );
	register_setting( 'product-settings-group', 'product_height' );
	register_setting( 'product-settings-group', 'product_weight' );
	register_setting( 'product-settings-group', 'product_color' );
	register_setting( 'product-settings-group', 'product_img' );

	add_option("product_price", "", "", "yes");
	add_option("product_width", "", "", "yes");
	add_option("product_height", "", "", "yes");
	add_option("product_weight", "", "", "yes");
	add_option("product_color", "", "", "yes");
	add_option("product_img", "", "", "yes");
}


function product_settings_admin_page() {
	include 'admin-page.php';
}
function load_wp_media_files() {
	wp_enqueue_media();
}


