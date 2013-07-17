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
	<title>Document</title>
	<link rel="icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" type="image/x-icon"/>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css">

	<script type="text/javascript">
		$(document).ready(function(){
			$("#contactForm").validate();
		});
	</script>

	<?php wp_head() ?>
</head>
<body <?php body_class() ?>>
	
	<header id="header">
		<section role="header" class="container">
			<div class="logo span2">
				<?php
					$logo = new WP_Query(
						array(
					    	'post_type'=>'logo'
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
		</section>
	</header>

	<div id="content">
		
	</div> <!-- end of #content -->

	<div id="sidebar"></div> <!-- end of #sidebar -->

	<div id="footer"></div> <!-- end of #footer -->

	<?php wp_footer() ?>
</body>
</html>