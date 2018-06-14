<?php
function display_price_meta_box($post) {
	?>
	<table>
		<tr>
			<td style="width: 100%">Price</td>
			<td><input type="number" size="80" name="product_price" value="<?= get_post_meta($post->id,'product_price') ?>" /></td>
		</tr>
		<tr>
			<td style="width: 100%">Width</td>
			<td><input type="number" size="80" name="product_width" value="<?= get_post_meta($post->id,'product_width') ?>" /></td>
		</tr>
		<tr>
			<td style="width: 100%">Height</td>
			<td><input type="number" size="80" name="product_height" value="<?= get_post_meta($post->id,'product_height') ?>" /></td>
		</tr>
		<tr>
			<td style="width: 100%">Weight</td>
			<td><input type="number" size="80" name="product_weight" value="<?= get_post_meta($post->id,'product_weight') ?>" /></td>
		</tr>
		<tr>
			<td style="width: 100%">Color</td>
			<td><input type="color" size="80" name="product_color" value="<?= get_post_meta($post->id,'product_color') ?>" /></td>
		</tr>
	</table>
	<?php
	add_action( 'save_post', 'add_product_fields', 10, 2 );
}