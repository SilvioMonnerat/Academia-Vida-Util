<?php get_header();?>
    <!-- Content -->
    <div id="content">

      <?php include (TEMPLATEPATH.'/leftbar.php');?>
      
      <!-- Main Content -->
      <div id="maincontent" class="grid_10">
        
        <?php if (is_home()) include (TEMPLATEPATH.'/slideshow.php');?>
        
        <div class="clear"></div>
        
        <!-- News List -->
        <div id="newslist">
        
          <?php 
            $testi_cid = get_option('ezine_testimonial_cid');
            $testicid  = get_cat_ID($testi_cid);
            
            $post_excerpt_num = get_option('ezine_post_excerpt_num') ? get_option('ezine_post_excerpt_num') : 40;
            
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            query_posts('paged='.$paged);
            if (have_posts()) : 
            while (have_posts()) : the_post(); 
            $image_thumbnail = get_post_meta($post->ID, '_image_thumbnail', true );
            
          ?>
          <div class="newspost">
            <?php if (!in_category($testicid)) { ?>
             <?php 
            
              $img_height = 345;
              $img_width  = 576;
              
              if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {
               filter_imgvid_source(thumb_url(),$img_width,$img_height);
              } else {
                filter_imgvid_source($image_thumbnail,$img_width,$img_height);
              }
            ?>
            <?php } ?>
            <div class="topmeta">
              <span class="datepost"><?php echo __('Postado em','ezine');?> <?php the_time( get_option('date_format') ); ?> <?php echo __('por ','ezine');?><?php the_author_posts_link();?></span>
              <span class="commentpost">
              <?php comments_popup_link(__('Seja o primeiro a comentar','ezine'), __('1 comentário','ezine'), __('% comentários','ezine')); ?></span>
              <div class="clear"></div>
            </div>
            <div class="post">
              <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
              <p><?php excerpt($post_excerpt_num);?></p>
              <span class="social-share">
              <?php 
              $disable_tweetbutton = get_option('ezine_disable_tweetbutton');
              $disable_fblikebutton = get_option('ezine_disable_fblikebutton');
              ?>
              <?php if ($disable_tweetbutton != "true") { ?>
              <script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
              <a href="http://twitter.com/share" class="twitter-share-button" 
                data-url="<?php the_permalink(); ?>"
                data-text="<?php the_title(); ?>">Tweet</a>
              <?php } ?>
              <?php if ($disable_fblikebutton != "true") { ?>
              <iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink($post->ID)); ?>&amp;layout=button_count&amp;show_faces=false&amp;width=80&amp;action=like&amp;font&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:21px;" allowTransparency="true"></iframe>
              <?php } ?>
              </span>
              <div class="clear"></div>
            </div>
            <div id="slidedivider"></div>
            <div class="bottommeta">
              <span class="categorypost"><?php echo __('Categoria','ezine');?> : <?php the_category(',');?></span>
              <div class="bookmarkpost">
              <?php if (function_exists('social_bookmarks')) social_bookmarks();?>
                <div class="clear"></div>
              </div>
            </div>
          </div>
          <?php endwhile;?>
          <?php wp_reset_query();?>
          <?php endif;?>
          
      		<div class="navigation">
            <div class="alignleft"><?php next_posts_link(__('&laquo; Páginas anteriores','ezine')) ?></div>
            <div class="alignright"><?php previous_posts_link(__('Próximas páginas &raquo;','ezine')) ?></div>      			
            <div class="clear"></div>
      		</div>      
        </div>
        <!-- News List End -->
      </div>
      <!-- Main Content -->
    <?php wp_reset_query();?>
    <?php get_sidebar();?>
    
  </div>


<?php get_footer();?>