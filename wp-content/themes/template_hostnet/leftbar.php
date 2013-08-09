      <!-- Left Bar -->
      <div id="leftbar" class="grid_3">
        <div id="leftmenu">
        <!-- Category Menu -->
          <?php
            if (function_exists('wp_nav_menu')) { 
              wp_nav_menu( array('container_id'=>'','menu_id'=>'menu', 'menu_class' => '', 'theme_location' => 'category_menu','fallback_cb'=>'ezine_menu_categories','sort_column' => 'menu_order') );
            } else {  
              ezine_menu_categories();
            } ?>      
        <!-- Category Menu End -->
        </div>
        <?php
          if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Left Column Sidebar')) :
              $testi_cid = get_cat_ID(get_option('ezine_testimonial_cid'));?>
              <div class="leftbox">
                <h3>Tags</h3>
                <?php wp_tag_cloud(); ?>
              </div>
              <?php
          endif;        
        ?>
      </div>
      <!-- Left Bar End -->