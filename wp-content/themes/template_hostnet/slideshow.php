 <!-- Slideshow -->
        <div id="slideshow">
          <div id="featuredbox"><h4><?php echo __('Destaques','ezine');?></h4></div>
            <div id="nivowrapper">
              <div id="nivoslider">
                <?php 
                $featured_cat = get_option('ezine_featured_cat'); 
                $enable_caption = get_option('ezine_nivo_caption');
                if (featured_cat) : 
                $featured_cid = get_cat_ID($featured_cat);
                $featured_num = get_option('ezine_featured_number') ?  get_option('ezine_featured_number') : 4;
                $featured_slide = new WP_Query('cat='.$featured_cid.'&showposts='.$featured_num);
                while ($featured_slide->have_posts()) : $featured_slide->the_post();
                  $image_thumbnail = get_post_meta($post->ID, '_image_thumbnail', true );
                  ?>
                  <a href="<?php the_permalink();?>">
                   <?php 
                  
                    $img_height = 345;
                    $img_width  = 576;
                    
                    if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {
                      filter_imgvid_source(thumb_url(),$img_width,$img_height);  
                    } else {
                      filter_imgvid_source($image_thumbnail,$img_width,$img_height);
                    }
                  ?>
                 </a>
                <?php endwhile; 
                  else :  ?>
                    <a href="#"><img src="<?php bloginfo('template_directory');?>/images/slide7.jpg" alt="" title="Destaques" class="imgbox"/></a>
                  <?php
                  endif;
                ?>
              </div>
            </div>
          <div class="clear"></div>
          <div id="slidedivider"></div>
        </div>
        <!-- Slideshow End -->