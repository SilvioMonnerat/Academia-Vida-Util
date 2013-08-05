<?php 
/*

	Template Name: Agenda

*/

?>

<?php get_header() ?>

<?php 
	$thumb  = '';
	$width  = 1170;
	$height = 400;
	$title  = get_the_title();
	$img    = get_post_image_src($post->ID);
	//d($img);
	$default_attr = array(
		'src'   => $src,
		'class' => "attachment-$size",
		'alt'   => trim(strip_tags( $attachment->post_excerpt )),
		'title' => trim(strip_tags( $attachment->post_title )),
	);
	$thumbnail = get_the_post_thumbnail($width,$height);
	$thumb = $thumbnail["thumb"];
?>       
				
	<div class="container">
		<div class="main-area span9">
			<article id="post-<?php the_ID(); ?>" <?php post_class('entry clearfix'); ?>>

				<?php if(have_posts()): while(have_posts()):the_post(); ?>

				<?php endwhile; ?>
				<?php endif; wp_reset_query(); ?>				

			</article>

		</div>
				
		<?php get_sidebar(); ?>

		<?php get_template_part( 'comments' ) ?>

	</div>


<?php get_footer() ?>