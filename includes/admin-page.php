<div class="wrap">
    <h1>Products settings</h1>
    <h4>Please choose specification that you need in widget</h4>
    <form method="post" action="options.php">
		<?php settings_fields( 'plugin-settings-group' ); ?>
		<?php do_settings_sections( 'plugin-settings-group' ); ?>
        <div class="form-table">
            <div >
                <p>Product price</p>
                <div><input type="checkbox" name="product_price" value="<?php echo esc_attr( get_option('product_price') ); ?>" /></div>
            </div>
            <div>
                <p>Product width</p>
                <div><input type="checkbox" name="product_width" value="<?php echo esc_attr( get_option('product_width') ); ?>" /></div>
            </div>
            <div>
                <p>Product height</p>
                <div><input type="checkbox" name="product_price" value="<?php echo esc_attr( get_option('product_height') ); ?>" /></div>
            </div>
            <div>
                <p>Product weight</p>
                <div><input type="checkbox" name="product_price" value="<?php echo esc_attr( get_option('product_weight') ); ?>" /></div>
            </div>
            <div>
                <p>Product color</p>
                <div><input type="checkbox" name="product_price" value="<?php echo esc_attr( get_option('product_color') ); ?>" /></div>
            </div>
        </div>
	    <?php
	    wp_enqueue_script('jquery');
	    wp_enqueue_media();
	    ?>
        <h3>Select default feature image for products </h3>
        <div class="flex">
            <label for="image_url">default feature image</label>
            <img id="demoImg" src="<?=plugins_url( 'img/image.png', __FILE__ )?>" height="150px" width="150px" alt="default feature image">
            <input type="hidden" name="image_url" id="image_url" class="regular-text">
            <input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Upload Image">

        </div>
        <script type="text/javascript">
            jQuery(document).ready(function($){
                $('#upload-btn').click(function(e) {
                    e.preventDefault();
                    var image = wp.media({
                        title: 'Upload Image',
                        // mutiple: true if you want to upload multiple files at once
                        multiple: false
                    }).open()
                        .on('select', function(e){
                            // This will return the selected image from the Media Uploader, the result is an object
                            var uploaded_image = image.state().get('selection').first();
                            console.log(uploaded_image);
                            var image_url = uploaded_image.toJSON().url;
                            $('#image_url').val(image_url);
                            $('#demoImg').attr('src',image_url);
                        });
                });
            });
        </script>
		<?php submit_button(); ?>
    </form>
</div>

<script>
    jQuery('.upload_image_button').click(function() {
        var send_attachment_bkp = wp.media.editor.send.attachment;
        var button = $(this);
        wp.media.editor.send.attachment = function(props, attachment) {
            $(button).parent().prev().attr('src', attachment.url);
            $(button).prev().val(attachment.id);
            wp.media.editor.send.attachment = send_attachment_bkp;
        }
        wp.media.editor.open(button);
        return false;
    });
    jQuery('.remove_image_button').click(function() {
        var answer = confirm('Are you sure?');
        if (answer == true) {
            var src = $(this).parent().prev().attr('data-src');
            $(this).parent().prev().attr('src', src);
            $(this).prev().prev().val('');
        }
        return false;
    });
</script>
<style>
    .flex {
        display: flex;
        width: 280px;
        justify-content: center;
        flex-direction: column;
        align-items: center;
    }
    .flex label {
        margin-bottom: 15px;
    }
    #upload-btn{
        margin-top:15px;
    }
    .form-table {
        width: 30%;
        float: left;
    }
    .form-table>div {
        width: 200px;
        margin: auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>
