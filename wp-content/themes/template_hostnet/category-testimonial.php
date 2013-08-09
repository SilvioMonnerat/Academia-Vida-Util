<?php get_header();?>
    <!-- Content -->
    <div id="content">

      <?php include (TEMPLATEPATH.'/leftbar.php');?>
      <!-- Main Content -->
      <div id="maincontent" class="grid_10">
        <div class="content">
          <h2><?php single_cat_title();?></h2>
          <h4><?php echo __('O que nossos clientes dizem','ezine');?></h4>
        
            <?php 
            if (have_posts()) : while (have_posts()) : the_post();
            $image_thumbnail = get_post_meta($post->ID, '_image_thumbnail', true );
            ?>
            <div class="testibox">
            <?php 
              $img_height = 60;
              $img_width  = 60;
              
              if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {
                filter_imgvid_source(thumb_url(),$img_width,$img_height,"alignleft");  
              } else {
                filter_imgvid_source($image_thumbnail,$img_width,$img_height,"alignleft");
              }
            ?>       
              <blockquote><?php the_content();?></blockquote>
              <p class="testiname"><strong><?php the_title();?></strong></p>
            </div>
        <?php endwhile;endif;?>
        </div>
      </div>
      <!-- Content End -->      
      
    <?php wp_reset_query();?>
    <?php get_sidebar();?>
    
  </div>
  <!-- Content End -->
</div>
<!-- Wrapper End -->
<div class="clear"></div>

<?php get_footer();?>