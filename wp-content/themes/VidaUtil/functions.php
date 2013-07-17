<?php 

	if ( ! function_exists( 'setup_theme' ) ){
		function setup_theme(){
			global $themename, $shortname, $store_options_in_one_row;
			$themename = 'VidaUtil';
			$shortname = 'VidaUtil';
			$store_options_in_one_row = true;

			load_theme_textdomain('VidaUtil',get_template_directory().'/languages');

			add_action('init', 'load_stylesheet_css');

			add_action( 'wp_enqueue_scripts', 'load_scripts_js' );

			add_action( 'wp_enqueue_scripts', 'add_google_fonts' );

			add_action( 'init', 'register_main_menus' );

			require_once(TEMPLATEPATH . '/shortcode/shortcode.php');

			require_once(TEMPLATEPATH . '/inc/metabox/metabox.php');

			require_once(TEMPLATEPATH . '/inc/custom_post/custom_post.php');

		}
	}add_action( 'after_setup_theme', 'setup_theme' );

	function load_stylesheet_css() {
		if( !is_admin() ){
			$template_dir = get_template_directory_uri();

			wp_enqueue_style( 'bootstrap',  $template_dir . "/css/bootstrap.css");
			wp_enqueue_style( 'bootstrap-responsive',  $template_dir . "/css/bootstrap-responsive.css");
			wp_enqueue_style( 'main',  $template_dir . "/css/main.css");
		}
		if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_style( 'comment-reply' );
	}


	function load_scripts_js(){
		if ( !is_admin() ){
			$template_dir = get_template_directory_uri();

			wp_enqueue_script( 'jquery ' );
			wp_enqueue_script('bootstrap', $template_dir . '/js/bootstrap.js', array('jquery'), '1.0', true);
			
		}
		if(is_page('contact')){
			wp_enqueue_script('jquery.validate', $template_dir . '/js/jquery.validate.js', array('jquery'), '1.0', true);
		}
		if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
	}

	function add_google_fonts(){
		wp_enqueue_style( 'google_font_Ubuntu', 'http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic' ); // font-family: 'Ubuntu', sans-serif;
		wp_enqueue_style( 'google_font_Ubuntu_Mono', 'http://fonts.googleapis.com/css?family=Ubuntu+Mono:400,700,400italic,700italic' ); // font-family: 'Ubuntu Mono', sans-serif;
		wp_enqueue_style( 'google_font_Ubuntu_Condensed', 'http://fonts.googleapis.com/css?family=Ubuntu+Condensed' ); // font-family: 'Ubuntu Condensed', sans-serif;
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
