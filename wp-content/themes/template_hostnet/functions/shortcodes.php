<?php

/* List Styles */
function ezinechecklist( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="checklist">', do_shortcode($content));
	return $content;
	
}
add_shortcode('checklist', 'ezinechecklist');

function ezineitemlist( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="itemlist">', do_shortcode($content));
	return $content;
	
}
add_shortcode('itemlist', 'ezineitemlist');

function ezinebulletlist( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="bulletlist">', do_shortcode($content));
	return $content;
	
}
add_shortcode('bulletlist', 'ezinebulletlist');

function ezinearrowlist( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="arrowlist">', do_shortcode($content));
	return $content;
	
}
add_shortcode('arrowlist', 'ezinearrowlist');


/* Messages Box */

function ezine_warningbox( $atts, $content = null ) {
   return '<div class="warning">' . do_shortcode($content) . '</div>';
}
add_shortcode('warning', 'ezine_warningbox');


function ezine_infobox( $atts, $content = null ) {
   return '<div class="info">' . do_shortcode($content) . '</div>';
}
add_shortcode('info', 'ezine_infobox');

function ezine_successbox( $atts, $content = null ) {
   return '<div class="success">' . do_shortcode($content) . '</div>';
}
add_shortcode('success', 'ezine_successbox');

function ezine_errorbox( $atts, $content = null ) {
   return '<div class="error">' . do_shortcode($content) . '</div>';
}
add_shortcode('error', 'ezine_errorbox');

//************************************* Pullquotes

function ezine_pullquote_right( $atts, $content = null ) {
   return '<span class="pullquote_right">' . do_shortcode($content) . '</span>';
}
add_shortcode('pullquote_right', 'ezine_pullquote_right');


function ezine_pullquote_left( $atts, $content = null ) {
   return '<span class="pullquote_left">' . do_shortcode($content) . '</span>';
}
add_shortcode('pullquote_left', 'ezine_pullquote_left');

/* Dropcap */
function ezine_drop_cap( $atts, $content = null ) {
   return '<span class="dropcap">' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap', 'ezine_drop_cap');

/* Highlight */
function ezine_highlight_yellow( $atts, $content = null ) {
   return '<span class="highlight-yellow">' . do_shortcode($content) . '</span>';
}
add_shortcode('highlight_yellow', 'ezine_highlight_yellow');

function ezine_highlight_dark( $atts, $content = null ) {
   return '<span class="highlight-dark">' . do_shortcode($content) . '</span>';
}
add_shortcode('highlight_dark', 'ezine_highlight_dark');

function ezine_highlight_green( $atts, $content = null ) {
   return '<span class="highlight-green">' . do_shortcode($content) . '</span>';
}
add_shortcode('highlight_green', 'ezine_highlight_green');

function ezine_highlight_red( $atts, $content = null ) {
   return '<span class="highlight-red">' . do_shortcode($content) . '</span>';
}
add_shortcode('highlight_red', 'ezine_highlight_red');


/* Columns */
/* 1/2 column */
function ezine_col_12( $atts, $content = null ) {
   return '<div class="grid_8 first">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_12', 'ezine_col_12');

function ezine_col_12_last( $atts, $content = null ) {
   return '<div class="grid_8 last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('col_12_last', 'ezine_col_12_last');

/* 1/4 column */
function ezine_col_14_first( $atts, $content = null ) {
   return '<div class="grid_4 first">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_14_first', 'ezine_col_14_first');

function ezine_col_14( $atts, $content = null ) {
   return '<div class="grid_4">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_14', 'ezine_col_14');

function ezine_col_14_last( $atts, $content = null ) {
   return '<div class="grid_4 last">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_14_last', 'ezine_col_14_last');

/* 3/4 column */
function ezine_col_34_first( $atts, $content = null ) {
   return '<div class="grid_12 first">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_34_first', 'ezine_col_34_first');

function ezine_col_34_last( $atts, $content = null ) {
   return '<div class="grid_12 last">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_34_last', 'ezine_col_34_last');

/* Button */
function ezine_button( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'link'      => '#',
    ), $atts));

	$out = "<a class=\"button\" href=\"" .$link. "\"><span>" .do_shortcode($content). "</span></a>";
    
    return $out;
}
add_shortcode('button', 'ezine_button');

function ezine_button_white( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'link'      => '#',
    ), $atts));

	$out = "<a class=\"button button-white\" href=\"" .$link. "\"><span>" .do_shortcode($content). "</span></a>";
    
    return $out;
}
add_shortcode('button_white', 'ezine_button_white');

/* Divider */
function ezine_divider( $atts, $content = null ) {
   return '<div class="divider"></div>';
}
add_shortcode('divider', 'ezine_divider');

#### Vimeo eg http://vimeo.com/5363880 id="5363880"
function vimeo_code($atts,$content = null){

	extract(shortcode_atts(array(  
		"id" 		=> '',
		"width"		=> $width, 
		"height" 	=> $height
	), $atts)); 
	 
	$data = "<object
		width='$width'
		height='$height'
		data='http://vimeo.com/moogaloop.swf?clip_id=$id&amp;server=vimeo.com'
		type='application/x-shockwave-flash'>
			<param name='allowfullscreen' value='true' />
			<param name='allowscriptaccess' value='always' />
			<param name='movie' value='http://vimeo.com/moogaloop.swf?clip_id=$id&amp;server=vimeo.com' />
		</object>";
	return $data;
} 
add_shortcode("vimeo_video", "vimeo_code"); 

#### YouTube eg http://www.youtube.com/v/MWYi4_COZMU&hl=en&fs=1& id="MWYi4_COZMU&hl=en&fs=1&"
function youTube_code($atts,$content = null){

	extract(shortcode_atts(array(  
      "id" 		=> '',
  		"width"		=> $width, 
  		"height" 	=> $height
		 ), $atts)); 
	 
	$data = "<object
		width='$width'
		height='$height'
		data='http://www.youtube.com/v/$id' 
		type='application/x-shockwave-flash'>
			<param name='allowfullscreen' value='true' />
			<param name='allowscriptaccess' value='always' />
			<param name='FlashVars' value='playerMode=embedded' />
			<param name='movie' value='http://www.youtube.com/v/$id' />
		</object>";
	return $data;
} 
add_shortcode("youtube_video", "youTube_code");

function ezine_custom_slideshow($atts,$content = null) {
  global $post;
  
	extract(shortcode_atts(array(  
  		"category"		=> $category, 
  		"number" 	=> $number,
  		"width" 	=> 576,
  		"height" 	=> 345
		 ), $atts)); 
  
  $category_id  = get_cat_ID($category);
  $img_width = $width;
  $img_height = $height;
  
  $out = '<div id="custom_nivoslider" style="width:'.$img_width.'px;height:'.$img_height.'px;">';
    query_posts('cat='.$category_id.'&showposts='.$number);
    if (have_posts()) :
      while (have_posts() ) : the_post();
        $image_thumbnail = get_post_meta($post->ID, '_image_thumbnail', true );
        $portfolio_link = get_post_meta($post->ID, '_portfolio_link', true );
        $image_link = ($portfolio_link) ? $portfolio_link : $image_thumbnail; 
                  
        $thumb = get_post_thumbnail_id();
        
        $out .= '<a href="'.$image_link.'" rel="prettyPhoto[custom_slideshow]">'; 
        if ($thumb) {
          $image = vt_resize($thumb,'', $img_width,$img_height, true );
        } else {
          $image = vt_resize('',$image_thumbnail, $img_width,$img_height, true );  
        }
        $out .= '<img src="'.$image[url].'" width="'.$image[width].'" height="'.$image[height].'"  title="'.get_the_title().'"/>';
        $out .= '</a>';
        
      endwhile;endif;
      wp_reset_query();
  $out .= '</div><style type="text/css">.nivo-caption {width:'.$img_width.'px};</style>';
  
  return $out;  
}
add_shortcode("ezine_slideshow", "ezine_custom_slideshow");

function ezine_carousel_gallery($atts,$content = null) {
  global $post;
  
	extract(shortcode_atts(array(  
  		"category"		=> $category, 
  		"number" 	=> $number,
  		"lightbox" => $lightbox
		 ), $atts)); 

    $gallery_number = ($number) ? $number : 10;

    carousel_gallery($category,$gallery_number,$lightbox);
}

add_shortcode("carousel_gallery", "ezine_carousel_gallery");
?>