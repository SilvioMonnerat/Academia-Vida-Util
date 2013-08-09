      <!-- Right Bar -->
      <div id="rightbar" class="grid_3">
      <?php
        global $post;
        if (is_page()) { 
          $pageslist = get_pages('parent=0');
          foreach ($pageslist as $pageitem) {
            if (is_page($pageitem->ID) || $pageitem->ID == $post->post_parent) {
              $pagetitle = get_the_title($pageitem->ID);
              if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("$pagetitle")) {
                if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('General Sidebar')) :
                  include(TEMPLATEPATH.'/default-widgets.php');
                endif;                                    
              }  
            }
          }
        } else if (is_single()) {
          if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Single Post')) :
            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('General Sidebar')) :
              include(TEMPLATEPATH.'/default-widgets.php');
            endif;                                    
          endif;
        } else {
          if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('General Sidebar')) : 
            include(TEMPLATEPATH.'/default-widgets.php');
          endif;
        }
        ?>
        <div class="clear"></div>
    </div>
    <!-- Right Bar End -->