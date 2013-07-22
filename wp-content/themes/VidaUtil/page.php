<?php get_header() ?>


	<div id="content">             
		<article id="post-<?php the_ID(); ?>" class="container clearfix"> 
			<?php if(have_posts()): while(have_posts()):the_post(); ?>
				<h1><?php the_title() ?></h1>
			<?php endwhile; ?>
			<?php else: ?>
				<?php include( TEMPLATEPATH . '404.php' ); ?>
			<?php endif; ?>
			
		</section>
	</div>


<?php get_footer() ?>