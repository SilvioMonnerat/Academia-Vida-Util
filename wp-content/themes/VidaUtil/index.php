<?php get_header() ?>

	<article id="post-<?php the_ID(); ?>" class="container clearfix">
		<div id="content">
			<?php include( TEMPLATEPATH . 'home.php' ); ?>
		</div>
	</section>

<?php get_footer() ?>