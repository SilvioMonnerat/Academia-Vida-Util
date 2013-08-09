  <!-- Content End -->
  <div class="clear"></div>
</div>
<!-- Wrapper End -->
<div class="clear"></div>
<div id="footerwrapper">
  <!-- Footer -->
  <div id="footer" class="wrapper">
    <!-- Footer Box 1 -->
    <div class="footerbox grid_4">
      <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Bottom 1')) : ?>
      <div class="postlist">
        <?php recent_posts();?>
      </div>
      <?php endif;?>
    </div>
    <!-- Footer Box 1 End -->
    
    <!-- Footer Box 2 -->
    <div class="footerbox grid_4">
      <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Bottom 2')) : ?>
        <div class="postlist">
          <?php popular_posts();?>
        </div>
      <?php endif;?>
    </div>
    <!-- Footer Box 2 End -->
    
    <!-- Footer Box 3 -->
    <div class="footerbox grid_4">
      <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Bottom 3')) : ?>
      <div class="postlist">
        <?php random_posts();?>
      </div>
      <?php endif;?>
    </div>
    <!-- Footer Box 3 End -->
    
    <!-- Footer Box 4-->
    <div class="footerbox grid_4">
      <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Bottom 4')) : ?>
      <h3>Sobre <?php bloginfo('name');?></h3>
      <img src="<?php bloginfo('template_directory');?>/images/staff.jpg" class="alignleft imgbox" alt="" />
      <?php
      $aboutpage  = get_option('ezine_about_pid');
      $aboutpid   = get_page_by_title($aboutpage);       
      $about = new WP_Query();
      $about->query('page_id='.$aboutpid->ID);
      while ($about->have_posts()) : $about->the_post();
      ?>
      <p><?php excerpt(70);?><a href="<?php echo get_permalink($aboutpid->ID);?>"> Read more &raquo;</a></p>
      <?php endwhile;?>				
      <?php endif;?>
    </div>
    <!-- Footer Box 4 End -->
    <div class="clear"></div>
  </div>
  <!-- Footer End -->
  <div class="clear"></div>
  <!-- Bottom -->
  <div class="bottom">
    <div class="wrapper">
      <?php
      if (function_exists('wp_nav_menu')) { 
        wp_nav_menu( array('container_id'=>'','menu_id'=>'', 'menu_class' => 'footermenu grid_8', 'theme_location' => 'footer_menu','fallback_cb'=>'ezine_footer_pages','sort_column' => 'menu_order','depth'=> 1));
      } else {  
        ezine_footer_pages();
      } ?>          
      <div class="copyright grid_8">
        <h3>
          <?php $footer_text  = get_option('ezine_footer_text');?>
          <?php echo ($footer_text) ? stripslashes($footer_text) : "<a href=\"http://hostnet.com.br\">hostnet.com.br</a>";?>        
        </h3>
      </div>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>
  <div class="clear"></div>
  <!-- Bottom End -->
</div>
  <?php 
  $ga_code = get_option('ezine_ga_code');
  if ($ga_code) echo stripslashes($ga_code);
  ?>  
<?php wp_footer();?>
</body>
</html>