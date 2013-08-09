<?php get_header();?>
    <!-- Content -->
    <div id="content">
    
      <?php include (TEMPLATEPATH.'/leftbar.php');?>
      
      <!-- Main Content -->
      <div id="maincontent" class="grid_10">
     	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
     	  <?php /* If this is a category archive */ if (is_category()) { ?>
    		<h3><?php echo __('Posts na categoria ','ezine');?>&#8216;<?php single_cat_title(); ?>&#8217;</h3>
     	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
    		<h3><?php echo __('Posts tagueados como','ezine');?>&#8216;<?php single_tag_title(); ?>&#8217;</h3>
     	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
    		<h3><?php echo __('Posts em ','ezine');?><?php the_time('F jS, Y'); ?></h3>
     	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
    		<h3><?php echo __('Posts em ','ezine');?><?php the_time('F, Y'); ?></h3>
     	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
    		<h3><?php echo __('Posts em','ezine');?> <?php the_time('Y'); ?></h3>
    	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
    		<h3><?php echo __('Posts do autor','ezine');?></h3>
     	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
    		<h3><?php echo __('Arquivos do blog','ezine');?></h3>
     	  <?php } ?>        
        
        <div class="clear"></div>
        
        <!-- News List -->
        <div id="newslist">
          <?php 
            global $post;
            $counter = 0; 
            
            $post_excerpt_num = get_option('ezine_post_excerpt_num') ? get_option('ezine_post_excerpt_num') : 40;
            
            if (have_posts()) :
            while (have_posts()) : the_post();
            $counter++; 
            $image_thumbnail = get_post_meta($post->ID, '_image_thumbnail', true );
            if ($counter == 1) : 
          ?>
          <div class="newspost">
             <?php 
            
              $img_height = 345;
              $img_width  = 576;
              
              if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {
                filter_imgvid_source(thumb_url(),$img_width,$img_height);  
              } else {
                filter_imgvid_source($image_thumbnail,$img_width,$img_height);
              }
            ?>
              
            <div class="topmeta">
              <span class="datepost"><?php echo __('Posted at','ezine');?> <?php the_time( get_option('date_format') ); ?> <?php echo __('by ','ezine');?><?php the_author_posts_link();?></span>
              <span class="commentpost"><?php comments_popup_link(__('Seja o primeiro a comentar','ezine'), __('1 comentário','ezine'), __('% comentários','ezine')); ?></span>
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
            <div class="bottommeta">
              <span class="categorypost"><?php echo __('Categoria','ezine');?> : <?php the_category(',');?></span>
              <div class="bookmarkpost">
              <?php if (function_exists('social_bookmarks')) social_bookmarks();?>
                <div class="clear"></div>
              </div>
            </div>
          </div>          
          <?php else : ?>
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
            <div class="topmeta">
              <span class="datepost"><?php echo __('Posted at','ezine');?> <?php the_time('F d, Y');?> <?php echo __('by ','ezine');?><?php the_author_posts_link();?></span>
              <span class="commentpost"><?php comments_popup_link(__('0 Comment','ezine'), __('1 Comment','ezine'), __('% Comments','ezine')); ?></span>
              <div class="clear"></div>
            </div>
            <div class="bottommeta-alt">
              <span class="categorypost"><?php echo __('Category','ezine');?> : <?php the_category(',');?></span>
              <div class="bookmarkpost">
                <?php if (function_exists('social_bookmarks')) social_bookmarks();?>
                <div class="clear"></div>
              </div>
            </div>          
          </div>
          <?php endif;?>
          <?php endwhile;?>
          <?php endif;?>
          
      		<div class="navigation">
            <div class="alignleft"><?php next_posts_link(__('&laquo; Previous Entries','ezine')) ?></div>
            <div class="alignright"><?php previous_posts_link(__('Next Entries &raquo;','ezine')) ?></div>      			
            <div class="clear"></div>
      		</div>      
        </div>
        <!-- News List End -->
      </div>
      <!-- Main Content -->
    
    <?php get_sidebar();?>
    
  </div>
  <!-- Content End -->
</div>
<!-- Wrapper End -->
<div class="clear"></div>

<?php get_footer();?>