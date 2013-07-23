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

	<div id="content">             
		<article id="post-<?php the_ID(); ?>" class="container clearfix"> 
			<?php if(have_posts()): while(have_posts()):the_post(); ?>
			
				<?php 
					if(has_post_thumbnail()){
						the_crop_image($img, "&amp;w=$width&amp;h=$height&amp;zc=1"); 
					}
				?>

				<div class="span2">
					<h1 class="title"><?php the_title() ?></h1>
				</div>
			
				<div class="span6">
					<p class=""><?php the_content(); ?></p> 
				</div>
								

			<?php endwhile; ?>

			<?php endif; wp_reset_query(); ?>

			
			<?php get_sidebar(); ?>

		</article>
	</div>


<?php get_footer() ?>