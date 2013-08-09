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

	$fixeIMG = get_template_directory_uri()."/images/page-acedmia.jpg";

	$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
?>       
				
	<div class="container">
		<div class="main-area span9">
			<article id="post-<?php the_ID(); ?>" <?php post_class('entry clearfix'); ?>>

				<?php if(have_posts()): while(have_posts()):the_post(); ?>

					<div class="page-thumbnail">
						<?php 					
							if(has_post_thumbnail()){
								the_crop_image($img, "&amp;w=$width&amp;h=$height&amp;zc=1"); 
							}else{
								the_crop_image($fixeIMG, "&amp;w=$width&amp;h=$height&amp;zc=1"); 
							}
						?>
					</div> <!-- end .page-thumbnail -->

					<div class="blogmeta">
						<ul>
							<li><h1 class="title"><?php the_title() ?></h1></li>
							<li><?php esc_html_e('Página criada'); ?> <?php esc_html_e('por:'); ?> <?php the_author_posts_link(); ?></li>
							<li><?php esc_html_e('em:'); ?> <?php the_time(get_option('date_format')); ?> - </li>
							<li><?php the_breadcrumb(); ?></li>
						</ul>						
					</div> <!-- end .blogmeta -->

					<div class="content-page">
						<p class="row"><?php the_content(); ?></p> 
					</div>

				<?php endwhile; ?>
				<?php endif; wp_reset_query(); ?>				

			</article>

		</div>
				
		<?php get_sidebar(); ?>

		<?php get_template_part( 'comments' ) ?>

	</div>


<?php get_footer() ?>