<?php get_header();?>
    <!-- Content -->
    <div id="content">

      <?php include (TEMPLATEPATH.'/leftbar.php');?>
      <!-- Main Content -->
      <div id="maincontent" class="grid_10">
        <div class="content">
          <h2><?php single_cat_title();?></h2>
          <ul id="portfoliolist">     
            <?php 
            $counter = 0;
            while ( have_posts() ) : the_post();
            $counter++;
            $image_thumbnail = get_post_meta($post->ID, '_image_thumbnail', true );
            $portfolio_link = get_post_meta($post->ID, '_portfolio_link', true );
            $portfolio_url = get_post_meta($post->ID, '_portfolio_url', true );
            $image_link = ($portfolio_link) ? $portfolio_link : $image_thumbnail;
          	?>               
            <li <?php if ($counter %2 == 0) echo 'class="last"';?>>
              <div class="zoom">
                <a href="<?php echo $image_link;?>" rel="prettyPhoto[portfolio]">
              <?php 
                $img_height = 166;
                $img_width  = 276;
    
                
                if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {
                  filter_imgvid_source(thumb_url(),$img_width,$img_height);  
                } else {
                  filter_imgvid_source($image_thumbnail,$img_width,$img_height);
                }
              ?> 
                </a>
              </div>
              <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
              <p><?php excerpt(20);?></p>
              <a href="<?php the_permalink();?>" class="button-blue"><?php echo __('Ver detalhes','ezine');?></a> 
              <?php if ($portfolio_url) : ?><a href="<?php echo $portfolio_url;?>" class="button-red"><?php echo __('Acessar o site','ezine');?></a><?php endif;?>
            </li>
            <?php endwhile;?>
          </ul>
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