<?php get_header();?>
    <!-- Content -->
    <div id="content">
    <?php
      $portfolio_cats_include = get_option('ezine_portfolio_cats_include');
      if(is_array($portfolio_cats_include)) {
        $portfolio_include = implode(",",$portfolio_cats_include);
      }     
    ?>
      <?php include (TEMPLATEPATH.'/leftbar.php');?>
      <!-- Main Content -->
      <div id="maincontent" class="grid_10">
        <div class="content">
          <h2 class="posttitle"><?php the_title();?></h2>
          <?php 
            if (have_posts()) : 
            while (have_posts()) : the_post();
            $image_thumbnail = get_post_meta($post->ID, '_image_thumbnail', true );
            $portfolio_link = get_post_meta($post->ID, '_portfolio_link', true );
          ?>
            <?php 
              $img_height = 345;
              $img_width  = 576;
              
              if (in_category($portfolio_include)) {
                $detail_link = $portfolio_link ? $portfolio_link :  $image_thumbnail;
              ?>
              <?php 
                if ($detail_link) {
                  if (is_youtube($detail_link)) { ?>
                    <div class="movie_container"><a href="<?php echo $detail_link;?>"  rel="youtube"></a></div>
                  <?php
                  } else if (is_vimeo($detail_link)) { ?>
                    <div class="movie_container"><a href="<?php echo $detail_link;?>"  rel="vimeo"></a></div>    
                  <?php  
                  } else if (is_quicktime($detail_link)) { 
                    ?>
                    <div class="movie_container"><a href="<?php echo $detail_link;?>"  rel="quicktime"></a></div>
                    <?php
                  } else if (is_flash($detail_link)) { ?>
                    <div class="movie_container"><a href="<?php echo $detail_link;?>"  rel="flash"></a></div>
                    <?php
                  } else {
                            
                    if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {
                      filter_imgvid_source(thumb_url(),$img_width,$img_height);  
                    } else {
                      filter_imgvid_source($image_thumbnail,$img_width,$img_height);
                    }
                  }
                } else {
                  if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {
                    filter_imgvid_source(thumb_url(),$img_width,$img_height);  
                  } else {
                    filter_imgvid_source($image_thumbnail,$img_width,$img_height);
                  }
                }
              ?>                   
              <?php  
              } else {
                if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {
                  filter_imgvid_source(thumb_url(),$img_width,$img_height);  
                } else {
                  filter_imgvid_source($image_thumbnail,$img_width,$img_height);
                }
              }
            ?> 
            <div class="topmeta">
              <span class="datepost"><?php echo __('Postado em','ezine');?> <?php the_time( get_option('date_format') ); ?> <?php echo __('por ','ezine');?><?php the_author_posts_link();?></span>
              <span class="commentpost"><?php comments_popup_link(__('Seja o primeiro a comentar','ezine'), __('1 comentário','ezine'), __('% comentários','ezine')); ?></span>
              <div class="clear"></div>
            </div>
                                 
            <?php the_content();?>
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
            <span class="posttags"><?php the_tags();?></span>
			     <div class="clear"></div>
            <div class="bottommeta">
              <span class="categorypost"><?php echo __('Categoria','ezine');?> : <?php the_category(',');?></span>       
              <?php $enable_sb= get_option('ezine_disable_sb');?>
    					<?php if ($enable_sb== "false") { ?>              
              <div class="bookmarkpost">
              <?php if (function_exists('social_bookmarks')) social_bookmarks();?>
                <div class="clear"></div>
              </div>
              <?php } ?>
            </div>
              <?php $enable_authorbox = get_option('ezine_disable_authorbox');?>
    					<?php if ($enable_authorbox == "false") { ?>
                <div id="authorbox">
                  <h3>Sobre <a href="<?php the_author_url(); ?>"><?php the_author_meta('display_name'); ?></a></h3>
                  <div class="blockavatar">
                    <?php if (function_exists('get_avatar')) { echo get_avatar(get_the_author_meta('user_email'), '48'); }?>
                  </div>
                   <div class="detail">
                      <p><?php the_author_meta('description'); ?></p>
                      <div class="clear"></div>
                   </div>
                   <div class="clear"></div>
                </div> 
    					<?php } ?>
          <div class="clear"></div>          
          <?php $disable_relatedpost = get_option('ezine_disable_relatedpost');?>
          <?php if ($disable_relatedpost == "false") { ?>
            <?php if (function_exists('get_related_post')) get_related_post();?>
          <?php } ?>
          <div class="clear"></div>
          <div id="commentwrapper">
          <?php comments_template('', true); ?>
          </div>          
          <?php
            endwhile; 
            endif;
          ?>
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