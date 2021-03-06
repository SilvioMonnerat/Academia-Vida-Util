<!DOCTYPE html>
<!--[if !IE]>      <html class="no-js non-ie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7"    <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8"    <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="no-js ie9"    <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"    <?php language_attributes(); ?>> <!--<![endif]-->
<html <?php language_attributes(); ?> xmlns:fb="http://ogp.me/ns/fb#" >
<!--<![endif]-->
<head>

	<meta property="og:title" content="" />
    <meta property="og:image" content="" />
    <meta property="og:description" content="" />    
   	<meta property="og:url" content="" />
    <meta property="fb:app_id" content="">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="viewport" content="user-scalable=no, width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<meta charset="<?php bloginfo( 'charset' ); ?>" />

	<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>

	<link rel="icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" type="image/x-icon"/>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css">
	<!--[if lt IE 9]>
	<script src="<?php echo $protocol; ?>://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<script src="<?php echo $protocol; ?>://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>

	<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}
	</style>

	<?php wp_head() ?>
</head>
<body <?php body_class() ?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1&appId=";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>

	<header id="header">
		<section role="header" class="container clearfix">
			<div class="logo span2">

				<?php $logo = new WP_Query( 'post_type=logo' );	?>

				<?php while($logo->have_posts()) : $logo->the_post(); ?>

					<?php $logo_meta_box = get_post_meta( $post->ID, 'theme_logo_meta_box', true ); ?>

						<?php foreach($logo_meta_box as $item): ?>

							<a href="<?php bloginfo('home') ?>"><img src="<?php echo $item['logo_meta_box_image']; ?>"></a>

						<?php endforeach; ?>

				<?php endwhile; wp_reset_query(); ?>

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

	<div class="content-area">
	