<?php 
// Habilitando o uso das imagens destacadas ou post thumbnails
if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );
    add_image_size('banner-slider', 960, 350, true);
    add_image_size('thumbnail', 140, 140, true);
    add_image_size('thumb', 60, 60, true);
}
 
//Custom post Slide
add_action( 'init', 'QDSliderInit' );
function QDSliderInit() { global $qd_Slider; $qd_Slider = new QDSlider(); }
 
class QDSlider {
 
                function QDSlider() {
                register_post_type( 'slider',
                    array(
                        'label' => __( 'Slider' ),
                        'singular_label' => __( 'Slider' ),
                        'public' => true,
                        'menu_position' => 5,
                        'query_var' => true,
                        'supports' => array('title','thumbnail','excerpt'),
                        'rewrite' => array('slug'=>'slider')
                        //'taxonomies' => array('post_tag')
                    )
                );
 
                add_action("admin_init", array(&$this, "admin_init"));
                add_action('save_post', array(&$this, 'save_post_data'));
 
                // Add custom post navigation columns
                add_filter("manage_edit-Slider_columns", array(&$this, "nav_columns"));
                add_action("manage_posts_custom_column", array(&$this, "custom_nav_columns"));
 
                // If you want to use a custom template name
                add_action("template_redirect", array(&$this, 'template_redirect'));    
        }
 
        function admin_init(){
                add_meta_box("slider-url-meta", "URL do Banner", array(&$this, "slider_url_meta_box"), "slider", "normal", "high");
                add_meta_box("slider-target-meta", "Modo de abertura do link", array(&$this, "slider_target_meta_box"), "slider", "normal", "high");
        }
 
        function slider_url_meta_box() {
            global $post;
            $meta_qd_slider_url = get_post_meta($post->ID, 'qd_slider_url', true);
 
            // Verify
            echo'<input type="hidden" name="qd_slider_url_noncename" id="qd_slider_url_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
 
            // Fields entry   
            echo '<p><label>URL (http://):<br />';
            echo '<input type="text" name="qd_slider_url" size="100" value="'.$meta_qd_slider_url.'" />';
        }            
 
        function slider_target_meta_box() {
           global $post;
            $meta_qd_slider_target = get_post_meta($post->ID, 'qd_slider_target', true);
 
            // Verify
            echo'<input type="hidden" name="qd_slider_target_noncename" id="qd_slider_target_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />'; 
 
            //Field entry
            echo '<select name="qd_slider_target" >';
            if($meta_qd_slider_target == 0){ echo '<option selected="selected" value="0">Abrir na mesma janela</option>';  } else { echo '<option value="0">Abrir na mesma janela</option>'; }
            if($meta_qd_slider_target == 1){ echo '<option selected="selected" value="1">Abrir em nova janela</option>';  } else { echo '<option value="1">Abrir em nova janela</option>'; }
            echo '</select>';
        }
 
        function save_post_data( $post_id ) {
                global $post;
 
                // Verify slider url
                if ( !wp_verify_nonce( $_POST["qd_slider_url_noncename"], plugin_basename(__FILE__) )) {
                        return $post_id;
                }
                if ( 'page' == $_POST['post_type'] ) {
                        if ( !current_user_can( 'edit_page', $post_id ))
                                return $post_id;
                } else {
                        if ( !current_user_can( 'edit_post', $post_id ))
                                return $post_id;
                }
 
                $data = $_POST['qd_slider_url'];                    
                // New, Update, and Delete
                if(get_post_meta($post_id, 'qd_slider_url') == "") 
                        add_post_meta($post_id, 'qd_slider_url', $data, true);
                elseif($data != get_post_meta($post_id, 'qd_slider_url', true))
                        update_post_meta($post_id, 'qd_slider_url', $data); 
                elseif($data == "")
                        delete_post_meta($post_id, 'qd_slider_url', get_post_meta($post_id, 'qd_slider_url', true));                            
 
 
                // Verify slider target
                if ( !wp_verify_nonce( $_POST["qd_slider_target_noncename"], plugin_basename(__FILE__) )) {
                        return $post_id;
                }
                if ( 'page' == $_POST['post_type'] ) {
                        if ( !current_user_can( 'edit_page', $post_id ))
                                return $post_id;
                } else {
                        if ( !current_user_can( 'edit_post', $post_id ))
                                return $post_id;
                }
 
                $data = $_POST['qd_slider_target'];                    
                // New, Update, and Delete
                if(get_post_meta($post_id, 'qd_slider_target') == "") 
                        add_post_meta($post_id, 'qd_slider_target', $data, true);
                elseif($data != get_post_meta($post_id, 'qd_slider_target', true))
                        update_post_meta($post_id, 'qd_slider_target', $data); 
                elseif($data == "")
                        delete_post_meta($post_id, 'qd_slider_target', get_post_meta($post_id, 'qd_slider_target', true));        
        }
 
        function nav_columns($columns) {
                $columns = array(
                        "cb" => "<input type=\"checkbox\" />",
                        "title" => "T&iacute;tulo do slider",
                        "slider_url" => "URL",
                        "slider_image" => "Imagem",
                );
 
                return $columns;
        }
 
        function custom_nav_columns($column) {
                global $post;
                switch ($column) {
                        case "slider_url":
                                $meta = get_post_custom();
                                echo $meta["qd_slider_url"][0];
                                break;
                        case "slider_image":
                                echo '<style type="text/css">.slider-img img{width:350px; height:auto;}</style>';
                                echo '<span class="slider-img">';
                                the_post_thumbnail('medium');
                                echo '</span>';
                                break;
                }
        }
 
        // If you want to use a custom template name you can use template_redirect()
        // WP defaults to single-"custom-post-name".php
        function template_redirect() {
                global $wp;
                if ($wp->query_vars["post_type"] == "slider") {
                        include(TEMPLATEPATH . "/single-slider.php");
                        die();
                }
        }
}
// End Slider Panel

// Esse codigo será posto aonde você quer que apareça o slide
<?php if (is_home() && (strpos ($_SERVER['REQUEST_URI'], 'page') === false)){ ?>
        <section class="slider">
            <div class="flexslider">
                
                <ul class="slides">
                    <?php
                        $loop = new WP_Query( 
                            array( 
                                'post_type' => 'Slider',
                                'showposts' => 4,
                                )
                            );
                        while ( $loop->have_posts() ) : $loop->the_post();
                        $custom = get_post_custom($post->ID);  
                        $qd_slider_url = $custom["qd_slider_url"][0];
                        $qd_slider_target = $custom["qd_slider_target"][0];
                            if($qd_slider_target == 0){ $qd_slider_target = "_top";}
                                if($qd_slider_target == 1){ $qd_slider_target = "_blank";}
*/                    ?>
                        <li>
                            <a href="<?php echo $qd_slider_url; ?>" target="<?php echo $qd_slider_target; ?>">
                                <?php the_post_thumbnail('banner-slider'); ?>
                            </a>
                        </li>

                    <?php endwhile; ?>
                <?php endif; ?>
                </ul>
            </div>
        </section>
    <?php } ?>  <!-- end of slider -->


 ?>