<?php
/*
Template Name: Portfolio
*/
?>

<?php get_header();?>
    <!-- Content -->
    <div id="content">

      <?php include (TEMPLATEPATH.'/leftbar.php');?>
      <!-- Main Content -->
      <div id="maincontent" class="grid_10">
        <div class="content">
          <h2><?php the_title();?></h2>
          <?php
            $portfolio_cats_include = get_option('ezine_portfolio_cats_include');
            if(is_array($portfolio_cats_include)) {
              $portfolio_include = implode(",",$portfolio_cats_include);
            } 
            $porto_num = get_option('ezine_porto_num') ? get_option('ezine_porto_num') : get_option('posts_per_page');
            $portfolio_desc = get_option('ezine_portfolio_desc');
            $portfolio_order = get_option('ezine_portfolio_order') ? get_option('ezine_portfolio_order') : "date";
            $portfolio_readmore = get_option('ezine_portfolio_readmore');
            $portfolio_visitsite = get_option('ezine_portfolio_visitsite');          
          ?>
          <p><?php if ($portfolio_desc) echo stripslashes($portfolio_desc);?></p>
          <ul id="portfoliolist">     
            <?php 
            $counter = 0;
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            
            query_posts('cat='.$portfolio_include.'&showposts='.$porto_num.'&paged='.$paged.'&orderby='.$portfolio_order);
            
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
                  filter_imgvid_source(thumb_url(),$img_width,$img_height,"imgportfolio");  
                } else {
                  filter_imgvid_source($image_thumbnail,$img_width,$img_height,"imgportfolio");
                }
              ?>
                  
                </a>
              </div>
              <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
              <p><?php excerpt(20);?></p>
              <a href="<?php the_permalink();?>" class="button-blue"><?php echo ($portfolio_readmore) ? $portfolio_readmore : __('Ver detalhes','ezine');?></a> 
              <?php if ($portfolio_url) : ?><a href="<?php echo $portfolio_url;?>" class="button-red"><?php echo ($portfolio_visitsite) ? $portfolio_visitsite : __('Acessar o site','ezine');?></a><?php endif;?>
            </li>
            <?php endwhile;?>
          </ul>
          <div class="clear"></div>
      		<div class="navigation">
            <div class="alignleft"><?php next_posts_link(__('&laquo; Página anterior','ezine')) ?></div>
            <div class="alignright"><?php previous_posts_link(__('Próxima página &raquo;','ezine')) ?></div>      			
            <div class="clear"></div>
      		</div> 
                    
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