<?php
    // Add metabox
    function dfw_slideshow_metabox() {
        add_meta_box(
            'dfw-metabox',
            'Slideshow',
            'dfw_slideshow_metabox_content',
            'post',
            'side'
        );
    }
    add_action('admin_init', 'dfw_slideshow_metabox');
     
    // Add contant for metabox
    function dfw_slideshow_metabox_content() {
        global $post;
        wp_nonce_field(__FILE__, 'slideshow_metabox_nonce');
?>
     
    <div id="dfw-ahhc-side-wrap">
        <label for="dfw_slideshow" style="margin-right:5px;"><?php _e('Exibir post no slideshow:'); ?></label>
        <input type="checkbox" id="dfw_slideshow" name="dfw_slideshow" value="1" <?php checked(get_post_meta($post->ID, 'dfw_slideshow', true), 1); ?> />
    </div>
    
<?php
    }
     
    // Save metabox
    function dfw_slideshow_save_metabox($post_id) {
     
        if (isset($_POST['slideshow_metabox_nonce']) && !wp_verify_nonce($_POST['slideshow_metabox_nonce'], __FILE__))
            return;
     
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post_id;
     
        if (!current_user_can('edit_post', $post_id))
            return $post_id;
     
        if (get_post_type($post_id) == 'post' && $_POST) {
            // Save custom fields
            $value_new = esc_attr($_POST['dfw_slideshow']);
            update_post_meta($post_id, 'dfw_slideshow', $value_new);
        }
     
        return $post_id;
    }
    add_action('save_post', 'dfw_slideshow_save_metabox');
 
?>