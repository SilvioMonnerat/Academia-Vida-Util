<?php get_header();?>
    <!-- Content -->
    <div id="content">

      <?php include (TEMPLATEPATH.'/leftbar.php');?>
      <!-- Main Content -->
      <div id="maincontent" class="grid_10">
        <div class="content">
          <h2><?php the_title();?></h2>
          <?php 
            global $post;
            if (have_posts()) :
            while (have_posts()) : the_post();
            $image_thumbnail = get_post_meta($post->ID, '_image_thumbnail', true );
          ?>
          <div class="newspost-alt">
            
            <?php 
            
              $img_height = 139;
              $img_width  = 182;
              
              if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {
                filter_imgvid_source(thumb_url(),$img_width,$img_height,"alignleft");  
              } else {
                filter_imgvid_source($image_thumbnail,$img_width,$img_height,"alignleft");
              }
            ?>
            <div class="post-alt">
            <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
            <p><?php excerpt(50);?></p>
            </div>
            <div class="topmeta">
              <span class="datepost"><?php echo __('Postado em','ezine');?> <?php the_time('F d, Y');?> <?php echo __('por ','ezine');?><?php the_author_posts_link();?></span>
              <span class="commentpost"><?php comments_popup_link(__('Seja o primeiro a comentar','ezine'), __('1 comentário','ezine'), __('% comentários','ezine')); ?></span>
              <div class="clear"></div>
            </div>
            <div class="bottommeta-alt">
              <span class="categorypost"><?php echo __('Categoria','ezine');?> : <?php the_category(',');?></span>
              <div class="bookmarkpost">
                <?php if (function_exists('social_bookmarks')) social_bookmarks();?>
                <div class="clear"></div>
              </div>
            </div>          
          </div>
          <?php endwhile;?>
          <?php else : ?>
          <h2><?php echo __('Nenhum post encontrado para "'.$s.'"!','ezine');?></h2>
          <h4><?php echo __('Deseja tentar uma nova busca ?','ezine');?></h4>
          <?php get_search_form();?>		  
          
          <?php endif;?>          
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