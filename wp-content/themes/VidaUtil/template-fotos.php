<?php 
	/*
		Template Name: Galeria de Fotos
	*/
?>
<?php get_header(); ?>
	<div class="container">
		<div class="main-area span9">
			<article id="post-<?php the_ID(); ?>" <?php post_class('entry clearfix'); ?>>
			</article>
		</div>				
		<?php get_sidebar(); ?>
		<?php get_template_part( 'comments' ) ?>
	</div>
