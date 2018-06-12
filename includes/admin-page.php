<div class="wrap">
    <h1>Products settings</h1>
    <h4>For add field to product check it</h4>
    <form method="post">
		<?php settings_fields( 'plugin-settings-group' ); ?>
		<?php do_settings_sections( 'plugin-settings-group' ); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Product price</th>
                <td><input type="checkbox" name="product_price" value="<?php echo esc_attr( get_option('product_price') ); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row">Product width</th>
                <td><input type="checkbox" name="product_width" value="<?php echo esc_attr( get_option('product_width') ); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row">Product height</th>
                <td><input type="checkbox" name="product_price" value="<?php echo esc_attr( get_option('product_height') ); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row">Product weight</th>
                <td><input type="checkbox" name="product_price" value="<?php echo esc_attr( get_option('product_weight') ); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row">Product color</th>
                <td><input type="checkbox" name="product_price" value="<?php echo esc_attr( get_option('product_color') ); ?>" /></td>
            </tr>
        </table>
		<?php submit_button(); ?>
    </form>
</div>

