<?php get_header() ?>

	<div class="container">
		<div class="post-area span9">
			<article id="post-<?php the_ID(); ?>" <?php post_class('entry clearfix'); ?>>


			</article>

			<?php wp_link_pages( array(
				'before' => '<p><strong>'.esc_attr__('Pages','VidaUtil').':</strong> ',
				'after' => '</p>', 
				'next_or_number' => 'number'
				));
			 ?>
			<?php edit_post_link(esc_attr__('Editar está página','VidaUtil')); ?>

		</div>						
		
		<?php get_sidebar(); ?>

	</div>

<?php get_footer() ?>