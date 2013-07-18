
<?php get_header(); ?>

	<section class="slider">
		<?php echo do_shortcode( '[layerslider id="1"]' ) ?>
	</section>

	<div id="content">
		<article id="post-<?php the_ID(); ?>" class="container">
			<?php
				$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
				$featured = new WP_Query(
					array(
				    	'post_type'      =>'page',
				    	'posts_per_page' => '3',
				    	'showposts'      => '3',
				    	'paged'          => $paged
  					)
				);
			?>
			<ul class="">
			    <?php while ($featured -> have_posts()) : $featured -> the_post(); ?>
			    <?php //if(get_post_meta($post->ID)): ?>
			    <?php 
					$thumb  = '';
					$width  = 120;
					$height = 120;
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
			        <li class="span3">
			        	<p class="thumb row">
			        		<?php if(has_post_thumbnail()): ?>
				                 <a href="<?php the_permalink(); ?>">
				                    <?php 
				                    	the_crop_image($img, "&amp;w=$width&amp;h=$height&amp;zc=1"); 
				                    	//the_post_thumbnail('featured');
				                    ?>
				                </a> 
			                <?php endif; ?>
			        	</p>
			        	<p class="title row"><a href="<?php the_permalink() ?>"><?php echo $title; ?></a></p>			            
			            <p class="text row"><a href="<?php the_permalink() ?>"><?php the_content_limit('13'); ?></a></p>
			            <p class="readmore row"><?php echo readMore(); ?></p>
			        </li>
			    <?php //else: ?>

			    <?php //endif; ?>
			    <?php endwhile;?> <!-- end loop of featured -->
			</ul>

			<hr class="row">

		</section>
	</div> <!-- end of #content -->

	<div id="sidebar"></div> <!-- end of #sidebar -->

	<footer id="footer" class="">
		<section class="container">
			<?php echo copyright(); ?>
		</section>
	</footer> <!-- end of #footer -->

	<?php wp_footer() ?>
</body>
</html>