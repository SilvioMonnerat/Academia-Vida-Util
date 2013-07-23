<!DOCTYPE html>
<!--[if !IE]>      <html class="no-js non-ie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="no-js ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<html <?php language_attributes(); ?> xmlns:fb="http://ogp.me/ns/fb#" >
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title(''); ?></title>
	<link rel="icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" type="image/x-icon"/>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css">
	<!--[if lt IE 9]>
	<script src="<?php echo $protocol; ?>://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<script>window.html5 || document.write('<script src="<?php echo WM_ASSETS_THEME; ?>js/html5.js"><\/script>')</script>
	<script src="<?php echo $protocol; ?>://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->
	<script type="text/javascript">
		$(document).ready(function(){
			$("#contactForm").validate();
		});
	</script>

	<?php wp_head() ?>
</head>
<body <?php body_class() ?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1&appId=272438806229311";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>


	<header id="header">
		<section role="header" class="container clearfix">
			<div class="logo span2">
				<?php
					$logo = new WP_Query(
						array(
					    	'post_type'=>'logo',
					    	'paged' => get_query_var( 'paged' )
						)
					);
					while ($logo->have_posts()) : $logo->the_post(); 
				        global $post;
				        $meta = get_post_meta( $post->ID, 'upload_file', true );
				?>
				<a href="<?php bloginfo('home') ?>"><img src="<?php echo $meta; ?>"></a>
				<?php 
					endwhile; 
					wp_reset_query(); 
				?>
			</div>
			<nav class="menu_header span7">
				<?php 
					wp_nav_menu( 
						array(
							'theme_location'  => 'header_menu',
							'container_class' => 'menu'
						)
					); 
				?>
			</nav>
			<div class="search span3">
				<?php search_form(); ?>
			</div>
		</section>
	</header>