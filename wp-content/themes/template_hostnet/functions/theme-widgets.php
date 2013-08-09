<?php

/* Widgetable Functions  */

if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'ID' => 'sidebar',
    'name'=>'General Sidebar',
    'before_widget' => '<div class="sidebox"><div class="archivelist">',
    'after_widget' => '</div></div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));
  register_sidebar(array(
    'ID' => 'sidebar',
    'name'=>'Left Column Sidebar',
    'before_widget' => '<div class="leftbox"><div class="archivelist">',
    'after_widget' => '</div></div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));  
  register_sidebar(array(
    'ID' => 'sidebar',
    'name'=>'Single Post',
    'before_widget' => '<div class="sidebox"><div class="archivelist">',
    'after_widget' => '</div></div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));  
  register_sidebar(array(
    'ID' => 'bottom',
    'name'=>'Bottom 1',
    'before_widget' => '<div class="postlist">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));
  register_sidebar(array(
    'ID' => 'bottom',
    'name'=>'Bottom 2',
    'before_widget' => '<div class="postlist">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));
  register_sidebar(array(
    'ID' => 'bottom',
    'name'=>'Bottom 3',
    'before_widget' => '<div class="postlist">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));   
  register_sidebar(array(
    'ID' => 'bottom',
    'name'=>'Bottom 4',
    'before_widget' => '<div class="postlist">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));          
  $pageslist = get_pages('parent=0');
    foreach ($pageslist as $pagesitem) {
      register_sidebar(array(
      'ID' => 'sidebar',
      'name'=>get_the_title($pagesitem->ID),
      'before_widget' => '<div class="sidebox">',
      'after_widget' => '</div>',
      'before_title' => '<h3>',
      'after_title' => '</h3>'
    ));
  }


/* Recent Posts Widget */
class RecentPosts_Widget extends WP_Widget {
  
  function RecentPosts_Widget() {
    $widgets_opt = array('description'=>'Display most recent posts');
    parent::WP_Widget(false,$name= "ezine - Recent Posts",$widgets_opt);
  }
  
  function form($instance) {
    global $post;
    
    $recenttitle = esc_attr($instance['recenttitle']);
    $numrecent = esc_attr($instance['numrecent']);
    
  ?>
    <p><label for="recenttitle">Título:
  		<input id="<?php echo $this->get_field_id('recenttitle'); ?>" name="<?php echo $this->get_field_name('recenttitle'); ?>" type="text" class="widefat" value="<?php echo $recenttitle;?>" /></label></p>
    <p><label for="numrecent">Número de posts:
  		<input id="<?php echo $this->get_field_id('numrecent'); ?>" name="<?php echo $this->get_field_name('numrecent'); ?>" type="text" class="widefat" value="<?php echo $numrecent;?>" /></label></p>
    <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    $recenttitle = apply_filters('recenttitle',$instance['recenttitle']);
    $numrecent = apply_filters('numrecent',$instance['numrecent']);    
    
    if ($numrecent == "") $numrecent = 5;
    if ($recenttitle == "") $recenttitle = "Recent Posts";
    
    echo $before_widget;
    $title = $before_title.$recenttitle.$after_title;
    recent_posts($title,$numrecent)
    ?>
    <div class="clear"></div>
   <?php
   echo $after_widget;
  } 
}

add_action('widgets_init', create_function('', 'return register_widget("RecentPosts_Widget");'));

/* Popular Posts Widget */
class PopularPosts_Widget extends WP_Widget {
  
  function PopularPosts_Widget() {
    $widgets_opt = array('description'=>'Display most popular posts');
    parent::WP_Widget(false,$name= "ezine - Popular Posts",$widgets_opt);
  }
  
  function form($instance) {
    global $post;
    
    $populartitle = esc_attr($instance['populartitle']);
    $numpopular = esc_attr($instance['numpopular']);
    
  ?>
    <p><label for="recenttitle">Título:
  		<input id="<?php echo $this->get_field_id('populartitle'); ?>" name="<?php echo $this->get_field_name('populartitle'); ?>" type="text" class="widefat" value="<?php echo $populartitle;?>" /></label></p>
    <p><label for="numrecent">Número de posts:
  		<input id="<?php echo $this->get_field_id('numpopular'); ?>" name="<?php echo $this->get_field_name('numpopular'); ?>" type="text" class="widefat" value="<?php echo $numpopular;?>" /></label></p>
    <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    $populartitle = apply_filters('populartitle',$instance['populartitle']);
    $numpopular = apply_filters('numpopular',$instance['numpopular']);    
    
    if ($numpopular == "") $numpopular = 5;
    if ($populartitle == "") $populartitle = "Popular Posts";
    
    echo $before_widget;
    $title = $before_title.$populartitle.$after_title;
    popular_posts($title,$numpopular)
    ?>
    <div class="clear"></div>
   <?php
   echo $after_widget;
  } 
}

add_action('widgets_init', create_function('', 'return register_widget("PopularPosts_Widget");'));

/* Random Posts Widget */
class RandomPosts_Widget extends WP_Widget {
  
  function RandomPosts_Widget() {
    $widgets_opt = array('description'=>'Display posts randomly');
    parent::WP_Widget(false,$name= "ezine - Random Posts",$widgets_opt);
  }
  
  function form($instance) {
    global $post;
    
    $randomtitle = esc_attr($instance['randomtitle']);
    $numrandom = esc_attr($instance['numrandom']);
    
  ?>
    <p><label for="recenttitle">Título:
  		<input id="<?php echo $this->get_field_id('randomtitle'); ?>" name="<?php echo $this->get_field_name('randomtitle'); ?>" type="text" class="widefat" value="<?php echo $randomtitle;?>" /></label></p>
    <p><label for="numrecent">Número de posts:
  		<input id="<?php echo $this->get_field_id('numrandom'); ?>" name="<?php echo $this->get_field_name('numrandom'); ?>" type="text" class="widefat" value="<?php echo $numrandom;?>" /></label></p>
    <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    $randomtitle = apply_filters('randomtitle',$instance['randomtitle']);
    $numrandom = apply_filters('numrandom',$instance['numrandom']);    
    
    if ($numrandom == "") $numrandom = 5;
    if ($randomtitle == "") $randomtitle = "Random Posts";
    
    echo $before_widget;
    $title = $before_title.$randomtitle.$after_title;
    popular_posts($title,$numrandom)
    ?>
    <div class="clear"></div>
   <?php
   echo $after_widget;
  } 
}

add_action('widgets_init', create_function('', 'return register_widget("RandomPosts_Widget");'));

/* Testimonial Widget */

class Testimonial_Widget extends WP_Widget {
  function Testimonial_Widget() {
    $widgets_opt = array('description'=>'ezine Testimonial Theme Widget');
    parent::WP_Widget(false,$name= "ezine - Testimonial",$widgets_opt);
  }
  
  function form($instance) {
    global $post;
    
    $catid = esc_attr($instance['catid']);
    $testititle = esc_attr($instance['testititle']);
    $numtesti = esc_attr($instance['numtesti']);
    
    $categories_list = get_categories('hide_empty=0');
    
    $categories = array();
    foreach ($categories_list as $catlist) {
    	$categories[$catlist->cat_ID] = $catlist->cat_name;
    }

  ?>
    <p><label for="testititle">Title:
  		<input id="<?php echo $this->get_field_id('testititle'); ?>" name="<?php echo $this->get_field_name('testititle'); ?>" type="text" class="widefat" value="<?php echo $testititle;?>" /></label></p>  
	 <p><small>Please select category for <b>Testimonial</b>.</small></p>
		<select  name="<?php echo $this->get_field_name('catid'); ?>">  id="<?php echo $this->get_field_id('catid'); ?>" >
			<?php foreach ($categories as $opt => $val) { ?>
		<option value="<?php echo $opt ;?>" <?php if ( $catid  == $opt) { echo ' selected="selected" '; }?>><?php echo $val; ?></option>
		<?php } ?>
		</select>
		</label></p>	
    <p><label for="numtesti">Number to display:
  		<input id="<?php echo $this->get_field_id('numtesti'); ?>" name="<?php echo $this->get_field_name('numtesti'); ?>" type="text" class="widefat" value="<?php echo $numtesti;?>" /></label></p>
    <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    $catid = apply_filters('catid',$instance['catid']);
    $testititle = apply_filters('testititle',$instance['testititle']);
    $numtesti = apply_filters('numtesti',$instance['numtesti']);    
    
    if ($numtesti == "") $numtesti = 1;
    if ($testititle == "") $testititle = "Testimonial";
    echo $before_widget;
    $title = $before_title.$testititle.$after_title;
    if ($ID == "bottom") {
      ezine_testimonial($catid,$numtesti,$title,"bottom");
    } else {
      ezine_testimonial($catid,$numtesti,$title,"sidebar");
    }
   echo $after_widget;
  } 
}

add_action('widgets_init', create_function('', 'return register_widget("Testimonial_Widget");'));

/* Post to Homepage Box or Sidebar Box Widget */

class PostBox_Widget extends WP_Widget {
  function PostBox_Widget() {
    $widgets_opt = array('description'=>'Display Post as small box in sidebar');
    parent::WP_Widget(false,$name= "ezine - Post to Box",$widgets_opt);
  }
  
  function form($instance) {
    global $post;
    
    $postid = esc_attr($instance['postid']);
    $opt_thumbnail = esc_attr($instance['opt_thumbnail']);
    $postexcerpt = esc_attr($instance['postexcerpt']);
    
		$centitaposts = get_posts('numberposts=-1')
		?>  
	<p><label>Please select post display
			<select  name="<?php echo $this->get_field_name('postid'); ?>">  id="<?php echo $this->get_field_id('postid'); ?>" >
				<?php foreach ($centitaposts as $post) { ?>
			<option value="<?php echo $post->ID;?>" <?php if ( $postid  ==  $post->ID) { echo ' selected="selected" '; }?>><?php echo  the_title(); ?></option>
			<?php } ?>
			</select>
	</label></p>
  <p>
		<input class="checkbox" type="checkbox" <?php if ($opt_thumbnail == "on") echo "checked";?> id="<?php echo $this->get_field_id('opt_thumbnail'); ?>" name="<?php echo $this->get_field_name('opt_thumbnail'); ?>" />
		<label for="<?php echo $this->get_field_id('opt_thumbnail'); ?>"><small>display thumbnail?</small></label><br />
    </p>
    <p><label for="postexcerpt">Number of words for excerpt :
  		<input id="<?php echo $this->get_field_id('postexcerpt'); ?>" name="<?php echo $this->get_field_name('postexcerpt'); ?>" type="text" class="widefat" value="<?php echo $postexcerpt;?>" /></label></p>  
    <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    $postid = apply_filters('postid',$instance['postid']);
    $opt_thumbnail = apply_filters('opt_thumbnail',$instance['opt_thumbnail']);
    $postexcerpt = apply_filters('postexcerpt',$instance['postexcerpt']);
    if ($postexcerpt =="") $postexcerpt = 10;
    
    echo $before_widget;
    $postlist = new WP_Query('p='.$postid);
    
    while ($postlist->have_posts()) : $postlist->the_post();
    $image_thumbnail = get_post_meta($post->ID, '_image_thumbnail', true );
  	$img_height = 100;
  	$img_width  = 160;	
    ?>
      <h3><?php the_title();?></h3>
	  <?php 
	  if ($opt_thumbnail == "on") {
      $thumb = get_post_thumbnail_id(); 
      if ($thumb) {
        $image = vt_resize($thumb,'', $img_width,$img_height, true );
        echo '<img src="'.$image[url].'" width="'.$image[width].'" height="'.$image[height].'"  alt=""  class="aligncenter imgbox"/>';
      } else {
        if (is_image($image_thumbnail)) {
          $image = vt_resize('',$image_thumbnail, $img_width,$img_height, true );
          echo '<img src="'.$image[url].'" width="'.$image[width].'" height="'.$image[height].'"  alt=""  class="aligncenter imgbox"/>';
        } else {
          detect_video($image_thumbnail,$img_width,$img_height);
        }
      }
	  }
	  ?>
    <p><?php excerpt($postexcerpt);?><a href="<?php the_permalink();?>"  class="linkreadmore"> Read more &raquo;</a></p>
    <?php   
    endwhile;
    echo $after_widget;
  } 
}

add_action('widgets_init', create_function('', 'return register_widget("PostBox_Widget");'));


/* Search box Widget */
class searchbox_Widget extends WP_Widget {
  function searchbox_Widget () {
    $widgets_opt = array('description'=>'ezine search box widget');
    parent::WP_Widget(false,$name= "ezine - Search Box",$widgets_opt);
  }
  
  function form($instance) {
    global $post;
    
    $searchboxtitle = esc_attr($instance['searchboxtitle']);         
  ?>
    <p><label for="bannertitle">Title:
  		<input id="<?php echo $this->get_field_id('searchboxtitle'); ?>" name="<?php echo $this->get_field_name('searchboxtitle'); ?>" type="text" class="widefat" value="<?php echo $searchboxtitle;?>" /></label></p>       		
    <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    echo $before_widget;
    
    $searchboxtitle = apply_filters('searchboxtitle',$instance['searchboxtitle']);
    
    if ($searchboxtitle == "") $searchboxtitle = "Search";
    include(TEMPLATEPATH.'/searchbox.php');
    
    echo $after_widget; 
  } 
}

add_action('widgets_init', create_function('', 'return register_widget("searchbox_Widget");'));

/* Newsletter Widget */
class Newsletter_Widget extends WP_Widget {
  function Newsletter_Widget() {
    $widgets_opt = array('description'=>'ezine Newsletter (Feedburner ) Widget');
    parent::WP_Widget(false,$name= "ezine - Newsletter",$widgets_opt);
  }
  
  function form($instance) {
    global $post;
    
    $newslettertitle = esc_attr($instance['newslettertitle']);
    $feedburnerid = esc_attr($instance['feedburnerid']);

  ?>
    <p><label for="newslettertitle">Title:
  		<input id="<?php echo $this->get_field_id('newslettertitle'); ?>" name="<?php echo $this->get_field_name('newslettertitle'); ?>" type="text" class="widefat" value="<?php echo $newslettertitle;?>" /></label></p>
    <p><label for="feedburnerid">Feedburner ID:
  		<input id="<?php echo $this->get_field_id('feedburnerid'); ?>" name="<?php echo $this->get_field_name('feedburnerid'); ?>" type="text" class="widefat" value="<?php echo $feedburnerid;?>" /></label></p>            
	  <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    echo $before_widget;
    
    $newslettertitle = apply_filters('newslettertitle',$instance['newslettertitle']);
    $feedburnerid = apply_filters('feedburnerid',$instance['feedburnerid']);    
    if ($newslettertitle =="") $newslettertitle = "News Subscription";
    include(TEMPLATEPATH.'/newsletter.php');
    
    echo $after_widget;
  } 
}

add_action('widgets_init', create_function('', 'return register_widget("Newsletter_Widget");'));

/* Twitter Widget */
class Twitter_Widget extends WP_Widget {
  function Twitter_Widget() {
    $widgets_opt = array('description'=>'display your latest twitter feed');
    parent::WP_Widget(false,$name= "ezine - Twitter Update",$widgets_opt);
  }
  
  function form($instance) {
    global $post;
    
    $twittertitle = esc_attr($instance['twittertitle']);
    $twitternum = esc_attr($instance['twitternum']);

  ?>
    <p><label for="twittertitle">Title:
  		<input id="<?php echo $this->get_field_id('twittertitle'); ?>" name="<?php echo $this->get_field_name('twittertitle'); ?>" type="text" class="widefat" value="<?php echo $twittertitle;?>" /></label></p>
    <p><label for="twitternum">Number to dispay:
  		<input id="<?php echo $this->get_field_id('twitternum'); ?>" name="<?php echo $this->get_field_name('twitternum'); ?>" type="text" class="widefat" value="<?php echo $twitternum;?>" /></label></p>                            
	  <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    echo $before_widget;
    
    $twittertitle = apply_filters('twittertitle',$instance['twittertitle']);
    $twitternum = apply_filters('twitternum',$instance['twitternum']);
       
    if ($twittertitle =="") $twittertitle = "Twitter Update!";
    
    twitter_feed($twittertitle,$twitternum);
    
    echo $after_widget;
  } 
}

add_action('widgets_init', create_function('', 'return register_widget("Twitter_Widget");'));

/* Social Profile Widget */
class SocialProfile_Widget extends WP_Widget {
  function SocialProfile_Widget() {
    $widgets_opt = array('description'=>'display your social network profile link');
    parent::WP_Widget(false,$name= "ezine - Social Profile",$widgets_opt);
  }
  
  function form($instance) {
    global $post;
    
    $socialtitle = esc_attr($instance['socialtitle']);

  ?>
    <p><label for="socialtitle">Title:
  		<input id="<?php echo $this->get_field_id('socialtitle'); ?>" name="<?php echo $this->get_field_name('socialtitle'); ?>" type="text" class="widefat" value="<?php echo $socialtitle;?>" /></label></p>            
	  <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    echo $before_widget;
    
    $socialtitle = apply_filters('socialtitle',$instance['socialtitle']);    
    
    if ($socialtitle =="") $socialtitle = __("Fique informado",'ezine');
    
    $title = $before_title.$socialtitle.$after_title;
    
    social_profile($title);
    
    echo $after_widget;
  } 
}

add_action('widgets_init', create_function('', 'return register_widget("SocialProfile_Widget");'));

/* Flickr Widget */
class Flickr_Widget extends WP_Widget {
  function Flickr_Widget() {
    $widgets_opt = array('description'=>'display your latest twitter feed');
    parent::WP_Widget(false,$name= "ezine - Flickr Gallery",$widgets_opt);
  }
  
  function form($instance) {
    global $post;
    
    $flickrtitle = esc_attr($instance['flickrtitle']);
    $flickrnum = esc_attr($instance['flickrnum']);

  ?>
    <p><label for="flickrtitle">Title:
  		<input id="<?php echo $this->get_field_id('flickrtitle'); ?>" name="<?php echo $this->get_field_name('flickrtitle'); ?>" type="text" class="widefat" value="<?php echo $flickrtitle;?>" /></label></p>
    <p><label for="flickrnum">Number to dispay:
  		<input id="<?php echo $this->get_field_id('flickrnum'); ?>" name="<?php echo $this->get_field_name('flickrnum'); ?>" type="text" class="widefat" value="<?php echo $flickrnum;?>" /></label></p>                            
	  <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    echo $before_widget;
    
    $flickrtitle = apply_filters('flickrtitle',$instance['flickrtitle']);
    $flickrnum = apply_filters('flickrnum',$instance['flickrnum']);
    
    if ($flickrtitle =="") $flickrtitle = "Flickr Gallery!";
    if ($flickrnum == "") $flickrnum = 4;
    
    $title = $before_title.$flickrtitle.$after_title;
    
    $flickr_id = get_option('ezine_flickr_user');
    
    flickr_gallery($title,$flickr_id,$flickrnum);
    
    echo $after_widget;
  } 
}

add_action('widgets_init', create_function('', 'return register_widget("Flickr_Widget");'));
?>