<?php 	

	if ( ! function_exists( 'setup_theme' ) ){
		function setup_theme(){
			global $themename, $shortname, $store_options_in_one_row;
			$themename = 'VidaUtil';
			$shortname = 'VidaUtil';
			$store_options_in_one_row = true;

			require_once(TEMPLATEPATH . '/shortcode/shortcode.php');

			require_once(TEMPLATEPATH . '/inc/metabox/metabox.php');

			require_once(TEMPLATEPATH . '/inc/custom_post/custom_post.php');

			require_once(TEMPLATEPATH . '/m_toolbox/m_toolbox.php');

			require_once(TEMPLATEPATH . '/Admin/admin_settings.php');

			require_once(TEMPLATEPATH . '/widgets/widgets.php');

			require_once(TEMPLATEPATH . '/inc/breadcrumb.php' );

			load_theme_textdomain('VidaUtil',get_template_directory().'/languages');

			add_action('init', 'load_stylesheet_css');

			add_action( 'wp_enqueue_scripts', 'load_scripts_js' );

			add_action( 'wp_enqueue_scripts', 'add_google_fonts' );

			add_action( 'init', 'register_main_menus' );

			add_action( 'init', 'sidebar_widgets' ); 

			add_theme_support( 'post-thumbnails' );

			add_image_size( 'featured', 300, 300 );

			add_theme_support( 'post-thumbnails', array( 'page', 'post' ) );

			add_filter('excerpt_more', 'readMore');

			add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );

			add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

		}
	}add_action( 'after_setup_theme', 'setup_theme' );

	function load_stylesheet_css() {
		if( !is_admin() ){
			$template_dir = get_template_directory_uri();

			wp_enqueue_style( 'bootstrap',  $template_dir . "/css/bootstrap.css");
			wp_enqueue_style( 'bootstrap-responsive',  $template_dir . "/css/bootstrap-responsive.css");
			wp_enqueue_style( 'main',  $template_dir . "/css/main.css");
		}
	}


	function load_scripts_js(){
			$template_dir = get_template_directory_uri();

			wp_enqueue_script( 'jquery ' );
			wp_enqueue_script('bootstrap', $template_dir . '/js/bootstrap.js', array('jquery'), '1.0', true);
			wp_enqueue_script('custom', $template_dir . '/js/custom.js', array('jquery'), '1.0', true);
		if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
	}

	function add_google_fonts(){
		wp_enqueue_style( 'google_font_Ubuntu', 'http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic' ); // font-family: 'Ubuntu', sans-serif;
		wp_enqueue_style( 'google_font_Ubuntu_Mono', 'http://fonts.googleapis.com/css?family=Ubuntu+Mono:400,700,400italic,700italic' ); // font-family: 'Ubuntu Mono', sans-serif;
		wp_enqueue_style( 'google_font_Ubuntu_Condensed', 'http://fonts.googleapis.com/css?family=Ubuntu+Condensed' ); // font-family: 'Ubuntu Condensed', sans-serif;
	}

	function remove_width_attribute( $html ) {
	   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
	   return $html;
	}

	function toASCII( $str ) { 
	    return strtr(utf8_decode($str),  
	        utf8_decode( 
	        'ŠŒŽšœžŸ¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ'), 
	        'SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy'); 
	}


	function register_main_menus() {
		register_nav_menus(
			array(
				'header_menu'  => __( 'Header Menu', 'VidaUtil' ),
				'sidebar_menu' => __( 'Sidebar Menu', 'VidaUtil' ),
				'footer_menu'  => __( 'Footer Menu', 'VidaUtil' )
			)
		);
	}

	function the_content_limit($num) {
		$theContent = get_the_content();
		$output     = preg_replace('/<img[^>]+./','', $theContent);
		$output     = preg_replace( '/<blockquote>.*<\/blockquote>/', '', $output );
		$output     = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $output );
		$limit      = $num+1;
		$content    = explode(' ', $output, $limit);
		array_pop($content);
		$content    = implode(" ",$content)."...";
		echo $content;
	}

	function the_title_limit($num) { 
		$limit = $num+1;		 
		$title = str_split(get_the_title());		 
		$length = count($title);		 
		if ($length>=$num) {		 
			$title = array_slice( $title, 0, $num);		 
			$title = implode("",$title)."...";		 
			echo $title;		 
		} else {		 
			the_title();		 
		}
		 
	}
	
	function readMore() {
		global $post;
		return '<a href="'.get_permalink($post->ID).'">'.esc_attr__( 'Read More &raquo;' ).'</a>';
	}

	function copyright(){
		print __( '&copy; 2013 - All rights reserved.' );
	}

	function iconSociais(){
		$url_facebook = "http://wwww.facebook.com/";
		$url_twitter  = "http://wwww.twitter.com/";
		$url_rss      = site_url()."/rss";
		$url_email    = "mailto:silvio@cabanacriacao.com?subject=Contato";
		$imgURL       = get_template_directory_uri()."/images/";

		$output= '
			<ul>
				<li class="iconFacebook"><a href="'.$url_facebook.'" target="_blank"><img src="'.$imgURL.'/icon-facebook.png" /></a></li>
				<li class="iconTwitter"><a href="'.$url_twitter.'" target="_blank"><img src="'.$imgURL.'/icon-twitter.png" /></a></li>
				<li class="iconRSS"><a href="'.$url_rss.'" target="_blank"><img src="'.$imgURL.'/icon-rss.png" /></a></li>
				<li class="iconRSS"><a href="'.$url_email.'" target="_blank"><img src="'.$imgURL.'/icon-email.png" /></a></li>
			</ul>
		';

		echo $output;
	}

	function search_form() {
	    $output = '
	    	<form role="search" method="get" action="'.home_url().'/" id="searchsubmit">
	  			<input type="text" name="s" id="s" placeholder="'.esc_attr__( 'Search' ).'" />
			</form>
		';
	    print $output;
	}
 	
	function sidebar_widgets() {
		 register_sidebar( array (
			 'name'          => 'Sidebar',
			 'id'            => 'sidebar',
			 'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			 'after_widget'  => "</li>",
			 'before_title'  => '<h3 class="widget-title">',
			 'after_title'   => '</h3>',
		  ) );
	}