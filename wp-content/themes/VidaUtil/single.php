<?php get_header() ?>


	<div id="content">
		<article id="post-<?php the_ID(); ?>" class="container clearfix">
			<?php  comments_template('', true); ?>
		</section>
	</div>


<?php get_footer() ?>