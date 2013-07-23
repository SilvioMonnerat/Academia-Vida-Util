
<?php get_header(); ?>

	<section role="slider">
		<?php echo do_shortcode( '[layerslider id="1"]' ) ?>
	</section>

	<div id="content">
		<article id="post-<?php the_ID(); ?>" class="container clearfix">
			<?php
				$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
				$featured = new WP_Query(
					array(
				    	'post_type'      =>'page',
				    	'posts_per_page' => '3',
				    	'showposts'      => '3',
				    	'paged'          => $paged,
				    	'orderby'        => 'rand'
  					)
				);
			?>
			<ul>
			    <?php while ($featured -> have_posts()) : $featured -> the_post(); ?>
			    <?php 
					$thumb  = '';
					$width  = 210;
					$height = 210;
					$title  = get_the_title();
					$img    = get_post_image_src($post->ID);
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
			<hr class="line clearfix">

			<div class="likeBox span12">
				<div class="fb-like-box" data-href="https://www.facebook.com/FacebookDevelopers" data-width="1170" data-height="200" data-show-faces="true" data-stream="false" data-show-border="false" data-header="false"></div>
			</div>
		
		</article>
	</div> <!-- end of #content -->

	<div id="sidebar"></div> <!-- end of #sidebar -->

<?php get_footer() ?>