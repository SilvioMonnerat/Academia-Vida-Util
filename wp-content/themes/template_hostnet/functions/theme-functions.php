<?php

/* Theme Functions  */
function excerpt($excerpt_length) {
  global $post;
	$content = $post->post_content;
	$words = explode(' ', $content, $excerpt_length + 1);
	if(count($words) > $excerpt_length) :
		array_pop($words);
		array_push($words, '...');
		$content = implode(' ', $words);
	endif;
  
  $content = strip_tags($content);
  
	echo do_shortcode($content);

}
//Callback functions for comment output

// Custom Comments Display
function ezine_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment-body">
			<?php echo get_avatar($comment,$size='50'); ?>
			<div class="comment-author vcard cleafix">
				<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
			</div>			
			<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)','ezine'),'  ','') ?>
			</div>
			<div class="clear"></div>
			<?php if ($comment->comment_approved == '0') : ?>
			<em><?php echo __('Your comment is awaiting moderation.','ezine');?></em>
			<div class="clear"></div>
			<?php endif; ?>
			
			<div class="comment-text"><?php comment_text() ?></div>		
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>	
		</div>
<?php
}

// Output the styling for the seperated Pings
function ezine_list_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment; ?>
<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
<?php }


function ezine_add_javascript() {
  wp_enqueue_script('jquery');
  wp_enqueue_script( 'jquery.prettyPhoto', get_bloginfo('template_directory').'/js/jquery.prettyPhoto.js', array('jquery'));
  wp_enqueue_script( 'jquery.jcarousel.min', get_bloginfo('template_directory').'/js/jquery.jcarousel.min.js', array( 'jquery' ) );
  wp_enqueue_script( 'jquery.twitter', get_bloginfo('template_directory').'/js/jquery.twitter.js', array('jquery'));
  wp_enqueue_script( 'jqueryslidemenu', get_bloginfo('template_directory').'/js/jqueryslidemenu.js', array('jquery'));
  wp_enqueue_script( 'jquery.nivo.slider.pack', get_bloginfo('template_directory').'/js/jquery.nivo.slider.pack.js', array('jquery'));
  wp_enqueue_script( 'jquery.tipsy.js', get_bloginfo('template_directory').'/js/jquery.tipsy.js', array('jquery'));
  wp_enqueue_script( 'functions', get_bloginfo('template_directory').'/js/functions.js', array( 'jquery' ) );
}

if (!is_admin()) {
  add_action( 'wp_print_scripts', 'ezine_add_javascript' ); 
}

add_action('wp_head', 'ezine_add_stylesheet');

function ezine_add_stylesheet() { 
  ?>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/prettyPhoto.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/fonts.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/skin.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/custom_style.php" type="text/css" media="screen" />
<?php 
}

add_action('wp_head', 'ezine_add_stylesheet');

function get_tiny_url($url) {
 
 if (function_exists('curl_init')) {
   $url = 'http://tinyurl.com/api-create.php?url=' . $url;
 
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_HEADER, 0);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_URL, $url);
   $tinyurl = curl_exec($ch);
   curl_close($ch);
 
   return $tinyurl;
 }
 
 else {
   # cURL disabled on server; Can't shorten URL
   # Return long URL instead.
   return $url;
 }
 
}

function get_related_post() {
  global $post;  
  
  $relatedposts_num = (get_option('ezine_relatedposts_num')) ? get_option('ezine_relatedposts_num') : 4 ;
  $original_post = $post;
  $tags = wp_get_post_tags($post->ID);
  if ($tags) {
    $first_tag = $tags[0]->term_id;
    $args=array(
      'tag__in' => array($first_tag),
      'post__not_in' => array($post->ID),
      'showposts'=>$relatedposts_num,
      'caller_get_posts'=>1
     );
     ?>
    
    <!-- Related Posts Start //-->
    <?php
    echo '<div id="relatedposts-wrapper">';
    echo '<h3 class="bodytitle">'.__('Posts relacionados','ezine').'</h3>';      
    $my_query = new WP_Query($args);
    if( $my_query->have_posts() ) {
      echo "<ul class=\"relatedposts\">";
      $counter = 0;
      while ($my_query->have_posts()) : $my_query->the_post();
      $counter++; 
      $image_thumbnail = get_post_meta($post->ID, '_image_thumbnail', true );
      
      ?>
          <li <?php if ($counter % 2 == 0) echo 'class="last"';?>>
             <?php 
              $img_height = 48;
              $img_width  = 48;
                          
              if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {
                filter_imgvid_source(thumb_url(),$img_width,$img_height,"alignleft imgbox");  
              } else {
                filter_imgvid_source($image_thumbnail,$img_width,$img_height,"alignleft imgbox");
              }
            ?>
            <strong><a href="<?php the_permalink();?>"><?php the_title();?></a></strong>
            <p><?php excerpt(8);?></p>
            <div class="clear"></div>
          </li>
      <?php endwhile;
    }
    echo '</ul></div><div class="clear"></div>';
  }
  $post = $original_post;
  wp_reset_query();  
}

function social_bookmarks() { ?>
  <ul class="bookmarklist">
    <li><a target="_blank" href="http://twitter.com/home/?status=<?php the_title(); ?> : <?php echo get_tiny_url(get_permalink($post->ID)); ?>" title="Tweet this!"><img src="<?php bloginfo('template_directory'); ?>/images/twitter.png" alt="twitter" /></a></li>
    <li><a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;amp;t=<?php the_title(); ?>" title="Share on Facebook."><img src="<?php bloginfo('template_directory'); ?>/images/facebook.png" alt="facebook" /></a></li>
    <li><a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>&amp;source="  title="Share on Linkedin"><img src="<?php bloginfo('template_directory'); ?>/images/linkedin.png" alt="linkedin" /></a></li>
    <li><a target="_blank" href="http://del.icio.us/post?url=<?php the_permalink(); ?>&amp;amp;title=<?php the_title(); ?>" title="Bookmark on Delicious."><img src="<?php bloginfo('template_directory'); ?>/images/delicious.png" alt="delicious" /></a></li>
    <li><a target="_blank" href="http://digg.com/submit?phase=2&amp;amp;url=<?php the_permalink(); ?>&amp;amp;title=<?php the_title(); ?>" title="Digg this!"><img src="<?php bloginfo('template_directory'); ?>/images/digg.png" alt="digg" /></a></li> 
  </ul>    
  <?php
}

/* Register Nav Menu Features For Wordpress 3.0 */
if (function_exists('register_nav_menus')) {
  register_nav_menus( array(
  	'topnav' => __( 'Main Navigation'),
    'category_menu' => __( 'Category Menu'),
    'footer_menu' => __( 'Footer Menu')
  ) );
}

/* Remove Default Container for Nav Menu Features */
function ezine_nav_menu_args( $args = '' ) {
	$args['container'] = false;
	return $args;
} 
add_filter( 'wp_nav_menu_args', 'ezine_nav_menu_args' );

class description_walker extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth, $args)
    {
         global $wp_query;
         $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

         $class_names = $value = '';

         $classes = empty( $item->classes ) ? array() : (array) $item->classes;

         $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
         $class_names = ' class="'. esc_attr( $class_names ) . '"';

         $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

         $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
         $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
         $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
         $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

         $prepend = '';
         $append = '';
         $description  = ! empty( $item->description ) ? '<span class="menudesc">'.esc_attr( $item->description ).'</span>' : '';

         if($depth != 0)
         {
            $description = $append = $prepend = "";
         }

    		$item_output = $args->before;
    		$item_output .= '<a'. $attributes .'>';
    		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
    		$item_output .= '</a>';
    		$item_output .= $description.$args->link_after;
    		$item_output .= $args->after;

          $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
          }
}

/* Native Nagivation Pages List for Main Menu */
function ezine_topmenu_pages() {
  global $excludeinclude_pages;
  
  $excludeinclude_pages = get_option('ezine_excludeinclude_pages');
  if(is_array($excludeinclude_pages)) {
    $page_exclusions = implode(",",$excludeinclude_pages);
  }
?>
	<ul>
  	<li <?php if (is_home() || is_front_page()) echo 'class="current"';?>><a href="<?php bloginfo('url');?>">Home</a></li>
  	<?php wp_list_pages('title_li=&sort_column=menu_order&depth=3&exclude='.$page_exclusions);?>
  </ul>

<?php
}

function ezine_footer_pages() {
  global $excludeinclude_pages;
  
  $excludeinclude_pages = get_option('ezine_excludeinclude_pages');
  if(is_array($excludeinclude_pages)) {
    $page_exclusions = implode(",",$excludeinclude_pages);
  }
?>
	<ul class="footermenu grid_8">
  	<?php wp_list_pages('title_li=&sort_column=menu_order&depth=1&exclude='.$page_exclusions);?>
  </ul>

<?php
}
/* Native Nagivation Pages List for Main Menu */
function ezine_menu_categories() {
  global $excludeinclude_cats;
  
  $excludeinclude_cats = get_option('ezine_excludeinclude_cats');
  if(is_array($excludeinclude_cats)) {
    $cats_exclusions = implode(",",$excludeinclude_cats);
  }
?>
  <ul id="menu">
  <?php wp_list_categories('title_li=&exclude='.$cats_exclusions);?>
  </ul>
<?php
}

// Make theme available for translation
// Translations can be filed in the /languages/ directory
load_theme_textdomain( 'ezine', TEMPLATEPATH . '/languages' );

$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";
if ( is_readable( $locale_file ) )
	require_once( $locale_file );

function get_shortcode_name($name) {
  if (strstr(get_shortcode_regex(),$name)) {
    return true;
  }
}

        
function detect_ext($file) {
  $ext = pathinfo($file, PATHINFO_EXTENSION);
  return $ext;
}

function is_quicktime($file) {
  $quicktime_file = array("mov","3gp","mp4");
  if (in_array(pathinfo($file, PATHINFO_EXTENSION),$quicktime_file)) {
    return true;
  } else {
    return false;
  }
}

function is_flash($file) {
  if (pathinfo($file, PATHINFO_EXTENSION) == "swf") {
    return true;
  } else {
    return false;
  }
}

function is_youtube($file) {
  if (preg_match('/youtube/i',$file)) {
    return true;
  } else {
    return false;
  }
}

function is_vimeo($file) {
  if (preg_match('/vimeo/i',$file)) {
    return true;
  } else {
    return false;
  }
}
function is_image($_source) {
  if(preg_match_all('!.+\.(?:jpe?g|png|gif)!Ui',$_source,$matches)){
    return true;
  } 
}

function detect_video($_source,$width,$height) {
  
  if(preg_match_all('#http://(www.vimeo|vimeo)\.com(/|/clip:)(\d+)(.*?)#i',$_source,$matches)){
    $vimeo_vid = vimeo_videoID($_source);
    echo do_shortcode("[vimeo_video id=$vimeo_vid width=$width height=$height]");
  } 
  
  else if(preg_match( '#http://(www.youtube|youtube|[A-Za-z]{2}.youtube)\.com/(.*?)#i', $_source, $matches )){
    $youtube_vid = youtube_videoID($_source);
    echo do_shortcode("[youtube_video id=$youtube_vid width=$width height=$height]");
  }
}

/* Get vimeo Video ID */
function vimeo_videoID($url) {
	if ( 'http://' == substr( $url, 0, 7 ) ) {
		preg_match( '#http://(www.vimeo|vimeo)\.com(/|/clip:)(\d+)(.*?)#i', $url, $matches );
		if ( empty($matches) || empty($matches[3]) ) return __('Unable to parse URL', 'ezine');

		$videoid = $matches[3];
		return $videoid;
	}
}

function youtube_videoID($url) {
	preg_match( '#http://(www.youtube|youtube|[A-Za-z]{2}.youtube)\.com/(watch\?v=|w/\?v=|\?v=)([\w-]+)(.*?)#i', $url, $matches );
	if ( empty($matches) || empty($matches[3]) ) return __('Unable to parse URL', 'ezine');
  
  $videoid = $matches[3];
	return $videoid;
}

function social_profile($title="<h3>Get Connected</h3>") {
  
  echo $title;
  ?>
  
  <!-- Social Link -->
    <?php
      $twitter_id = get_option('ezine_twitter_id');
      $facebook_id = get_option('ezine_facebook_id');
      $linkedin_id = get_option('ezine_linkedin_id');
      $flickr_user = get_option('ezine_flickr_user');
    ?>                       
    <ul class="sociallink">
      <li><a href="http://facebook.com/<?php echo $facebook_id;?>" target="_blank"><img src="<?php bloginfo('template_directory');?>/images/social/facebook.png" alt="facebook" /></a></li>
      <li><a href="http://twitter.com/<?php echo $twitter_id;?>" target="_blank"><img src="<?php bloginfo('template_directory');?>/images/social/twitter.png" alt="twitter" /></a></li>
      <li><a href="http://id.linkedin.com/<?php echo $linkedin_id;?>" target="_blank"><img src="<?php bloginfo('template_directory');?>/images/social/linkedin.png" alt="linkedin" /></a></li>
      <li><a href="http://www.flickr.com/photos/<?php echo $flickr_user;?>" target="_blank"><img src="<?php bloginfo('template_directory');?>/images/social/flickr.png" alt="flickr" /></a></li>
    </ul>
    <div class="clear"></div>
  <!-- Social Link End -->
  <?php
}

function twitter_feed($title="Twitter Update!",$number=5) { ?>
  
  <?php $twitter_id = get_option('ezine_twitter_id');?>
  
  <!-- Twitter -->
    <h3 class="twitter_icon"><?php echo $title;?></h3>
    <div id="twitter"></div>
  <!-- Twitter End -->
  <script type="text/javascript">
  
  jQuery(document).ready(function($) {
		$("#twitter").getTwitter({
			userName: "<?php echo $twitter_id;?>",
			numTweets: <?php echo $number;?>,
			loaderText: "Loading tweets...",
			slideIn: true,
			showHeading: true,
			headingText: "",
			showProfileLink: true
		});
	});
  </script>     
  <?php
}

function flickr_gallery($title="<h3>Flickr Gallery</h3>",$flicker_id,$number=4) {
?>	  
      <!-- Flickr Gallery -->
        <?php echo $title;?>
        <div class="flickrgallery">
		<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number;?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $flicker_id;?>"></script>	
        </div>
        <div class="clear"></div>
      <!-- Flickr Gallery End --> 
<?php
}

function popular_posts($title="<h3>Posts mais vistos</h3>",$number=5) {
  global $wpdb,$post;
  
  echo $title;
  
  $result = $wpdb->get_results("SELECT comment_count,ID,post_date,post_title FROM $wpdb->posts ORDER BY comment_count DESC LIMIT 0 , $number");
  ?>
  <ul>
  <?php
    foreach ($result as $post) {
    setup_postdata($post);
    $postid = $post->ID;
    $post_title = $post->post_title;
    $commentcount = $post->comment_count;
    $image_thumbnail = get_post_meta($postid, '_image_thumbnail', true );
    if ($commentcount != 0) { ?>
    <li>
      <a href="<?php echo get_permalink($postid);?>" class="titlepost"><?php echo $post_title;?></a>
      <span class="listdatepost"><?php echo mysql2date(get_option('date_format'),$post->post_date) ?></span>
    </li>
    <?php } 
    } ?>
    </ul>
  <?php
}

function recent_posts($title="<h3>Posts recentes</h3>",$number=5) {
  global $post;
  
  echo $title;
  
  ?>
  <ul>
  <?php
  $testi_cid = get_option('ezine_testimonial_cid');
  $testicid  = get_cat_ID($testi_cid);
    
  query_posts('showposts='.$number);
  if (have_posts()) : 
  while (have_posts()) : the_post();  
  ?>
    <li>
      <a href="<?php the_permalink();?>"  class="titlepost"><?php the_title();?></a>
      <span class="listdatepost"><?php the_time( get_option('date_format') ); ?></span>
    </li>  
  <?php
  endwhile;
  endif;
  ?>
  </ul>
  <?php
}

function random_posts($title="<h3>Posts randômicos</h3>",$number=5) {
  global $post;
  
  echo $title;
  ?>
  <ul>
  <?php
  query_posts('showposts='.$number.'&orderby=rand');
  if (have_posts()) : 
  while (have_posts()) : the_post(); 
  ?>
    <li>
      <a href="<?php the_permalink();?>"  class="titlepost"><?php the_title();?></a>
      <span class="listdatepost"><?php the_time( get_option('date_format') ); ?></span>
    </li>  
  <?php
  endwhile;
  endif;
  ?>
  </ul>
  <?php
}

function ezine_breadcrumbs() {
 
  $delimiter = '&raquo;';
  $name = 'Home'; //text for the 'Home' link
  $currentBefore = '<span class="current">';
  $currentAfter = '</span>';
 
  if ( !is_home() && !is_front_page() || is_paged() ) {
    
    echo '<div class="breadcrumbs grid_13">';
 
    global $post;
    $home = get_bloginfo('url');
    echo '<a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $currentBefore . single_cat_title() . $currentAfter;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('d') . $currentAfter;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('F') . $currentAfter;
 
    } elseif ( is_year() ) {
      echo $currentBefore . get_the_time('Y') . $currentAfter;
 
    } elseif ( is_single() ) {
      $cat = get_the_category(); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_search() ) {
      echo $currentBefore . 'Resultados da busca para &#39;' . get_search_query() . '&#39;' . $currentAfter;
 
    } elseif ( is_tag() ) {
      echo $currentBefore . 'Posts tagueados com &#39;';
      single_tag_title();
      echo '&#39;' . $currentAfter;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $currentBefore . 'Artigos postados por ' . $userdata->display_name . $currentAfter;
 
    } elseif ( is_404() ) {
      echo $currentBefore . 'Erro 404' . $currentAfter;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</div>';
 
  }
}

function carousel_gallery($category="",$num=10,$lightbox=false) { 
  global $post;
  ?>
  
  <div id="carousel-wrapper">
  <ul id="mycarousel" class="jcarousel jcarousel-skin-tango">
    <?php
      $gallery_catid = get_cat_ID($category);
      query_posts('cat='.$gallery_catid.'&showposts='.$num);
      while ( have_posts() ) : the_post();
      $counter++;
      $image_thumbnail = get_post_meta($post->ID, '_image_thumbnail', true );
      $portfolio_link = get_post_meta($post->ID, '_portfolio_link', true );
      $image_link = ($portfolio_link) ? $portfolio_link : $image_thumbnail;      
    	?>               
      <li>
        <?php if ($lightbox == true ) : ?>
        <a rel="prettyPhoto[gallery]" href="<?php echo $image_link;?>">
        <?php else : ?>
        <a href="<?php get_permalink();?>">
        <?php endif;?>
          <?php 
            $img_height = 90;
            $img_width  = 135;
            
            $thumb = get_post_thumbnail_id(); 
            if ($thumb) {
              $image = vt_resize($thumb,'', $img_width,$img_height, true );
              echo '<img src="'.$image[url].'" width="'.$image[width].'" height="'.$image[height].'"  alt=""  title="'.get_the_title().'" class="imgportfolio tips"/>';
            } else {
              if (is_image($image_thumbnail)) {
                $image = vt_resize('',$image_thumbnail, $img_width,$img_height, true );
                echo '<img src="'.$image[url].'" width="'.$image[width].'" height="'.$image[height].'"  alt="" title="'.get_the_title().'"   class="imgportfolio tips"/>';
              } else {
                detect_video($image_thumbnail,$img_width,$img_height);
              }
            } 
            ?> 
          </a>
      </li>
      <?php endwhile;?>
  </ul>        
</div>
<?php
}

function ezine_testimonial($cat,$num=1,$title,$place="") {
  global $post;
  
  echo $title;
  ?>
  <ul class="testibox">
  <?php
    if (!is_numeric($cat))
      $testicatid = get_cat_ID($cat); 
    else 
      $testicatid = $cat;
    
    query_posts('cat='.$testicatid.'&showposts='.$num.'&orderby=rand');
    
    while ( have_posts() ) : the_post();
    $image_thumbnail = get_post_meta($post->ID, '_image_thumbnail', true );
    ?>
    <li>
      <?php 
        $img_height = 60;
        $img_width  = 60;
        
        if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {
          filter_imgvid_source(thumb_url(),$img_width,$img_height,"alignleft");  
        } else {
          filter_imgvid_source($image_thumbnail,$img_width,$img_height,"alignleft");
        }
      ?>             
        <img src="<?php echo $image[url];?>" width="<?php echo $image[width];?>" height="<?php echo $image[height];?>"  alt=""  class="alignright imgbox"/>
        <blockquote><p><?php the_content(0);?></p></blockquote>
      <p class="testiname"><strong><a href="<?php echo (get_category_link($testicatid));?>"><?php the_title();?></a></strong></p>
    </li>    
    <?php endwhile;wp_reset_query();?>
    </ul>    
  <?php
}

// Use shortcodes in text widgets.
add_filter('widget_text', 'do_shortcode');


/*
 * Resize images dynamically using wp built in functions
 * Victor Teixeira
 *
 * php 5.2+
 *
 * Exemplo de uso:
 * 
 * <?php 
 * $thumb = get_post_thumbnail_id(); 
 * $image = vt_resize( $thumb, '', 140, 110, true );
 * ?>
 * <img src="<?php echo $image[url]; ?>" width="<?php echo $image[width]; ?>" height="<?php echo $image[height]; ?>" />
 *
 * @param int $attach_id
 * @param string $img_url
 * @param int $width
 * @param int $height
 * @param bool $crop
 * @return array
 */
function vt_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false ) {

	// this is an attachment, so we have the ID
	if ( $attach_id ) {
	
		$image_src = wp_get_attachment_image_src( $attach_id, 'full' );
		$file_path = get_attached_file( $attach_id );
	
	// this is not an attachment, let's use the image url
	} else if ( $img_url ) {
		
		$file_path = parse_url( $img_url );
		$file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];
		
		//$file_path = ltrim( $file_path['path'], '/' );
		//$file_path = rtrim( ABSPATH, '/' ).$file_path['path'];
		
		$orig_size = getimagesize( $file_path );
		
		$image_src[0] = $img_url;
		$image_src[1] = $orig_size[0];
		$image_src[2] = $orig_size[1];
	}
	
	$file_info = pathinfo( $file_path );
	$extension = '.'. $file_info['extension'];

	// the image path without the extension
	$no_ext_path = $file_info['dirname'].'/'.$file_info['filename'];

	$cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;

	// checking if the file size is larger than the target size
	// if it is smaller or the same size, stop right here and return
	if ( $image_src[1] > $width || $image_src[2] > $height ) {

		// the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
		if ( file_exists( $cropped_img_path ) ) {

			$cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );
			
			$vt_image = array (
				'url' => $cropped_img_url,
				'width' => $width,
				'height' => $height
			);
			
			return $vt_image;
		}

		// $crop = false
		if ( $crop == false ) {
		
			// calculate the size proportionaly
			$proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
			$resized_img_path = $no_ext_path.'-'.$proportional_size[0].'x'.$proportional_size[1].$extension;			

			// checking if the file already exists
			if ( file_exists( $resized_img_path ) ) {
			
				$resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );

				$vt_image = array (
					'url' => $resized_img_url,
					'width' => $proportional_size[0],
					'height' => $proportional_size[1]
				);
				
				return $vt_image;
			}
		}

		// no cache files - let's finally resize it
		$new_img_path = image_resize( $file_path, $width, $height, $crop );
		$new_img_size = getimagesize( $new_img_path );
		$new_img = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );

		// resized output
		$vt_image = array (
			'url' => $new_img,
			'width' => $new_img_size[0],
			'height' => $new_img_size[1]
		);
		
		return $vt_image;
	}

	// default output - without resizing
	$vt_image = array (
		'url' => $image_src[0],
		'width' => $image_src[1],
		'height' => $image_src[2]
	);
	
	return $vt_image;
}

function resize_image($image_source,$width,$height,$class="") {
  global $post;
  
  echo '<img src="'.get_bloginfo('template_directory').'/timthumb.php?src='.$image_source.'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1" alt="" title="'.get_the_title().'" class="'.$class.' imgbox"/>';
}

function filter_imgvid_source($slideshow_source,$width,$height,$class="") {
  
  if(preg_match_all('!.+\.(?:jpe?g|png|gif)!Ui',$slideshow_source,$matches)){
    resize_image($slideshow_source,$width,$height,$class);
  } 
  else if(preg_match_all('#http://(www.vimeo|vimeo)\.com(/|/clip:)(\d+)(.*?)#i',$slideshow_source,$matches)){
    $vimeo_vid = vimeo_videoID($slideshow_source);
    echo do_shortcode("[vimeo_video id=$vimeo_vid width=$width height=$height]");
  } 
  
  else if(preg_match( '#http://(www.youtube|youtube|[A-Za-z]{2}.youtube)\.com/(.*?)#i', $slideshow_source, $matches )){
    $youtube_vid = youtube_videoID($slideshow_source);
    echo do_shortcode("[youtube_video id=$youtube_vid width=$width height=$height]");
  }
}

/* Enable Post Thumbnail Feature */
if (function_exists('add_theme_support')) {
	add_theme_support( 'post-thumbnails');
	set_post_thumbnail_size( 200, 200 );
	add_image_size('post_thumb', 800, 800, true);
}

function thumb_url(){  
  $thumb_src= wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), array( 2100,2100 ));
  return $thumb_src[0];
}

/*
add_action('pre_get_posts', 'remove_testimonial_cat' );

function remove_testimonial_cat( $notused )
{
  global $wp_query;
  
  $testi_cid = get_option('ezine_testimonial_cid');
  $testicid  = get_cat_ID($testi_cid);
  
  // Figure out if we need to exclude glossary - exclude from
  // archives (except category archives), feeds, and home page
  if( is_home()) {
     $wp_query->query_vars['cat'] = '-' . $testicid;
  }
}
*/
?>