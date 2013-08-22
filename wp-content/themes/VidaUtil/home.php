
<?php get_header(); ?>

	<section class="slider" role="slider">
		<?php
			$img      = get_template_directory_uri()."/images/spinning.jpg";
			$timthumb = get_template_directory_uri()."/m_toolbox/timthumb/timthumb.php";
			$slider   = '[layerslider id="3"]';
			if($slider){
				echo do_shortcode( $slider );
			} else{
				$output = '
					<img src="'.$timthumb.'?src=/'.$img.'&h=600&w=1170&zc=1" />
				';
				print $output;
			}
		?>
	</section>

	<div class="content">
		<article id="post-<?php the_ID(); ?>" class="container clearfix">
			<?php
				$featured = new WP_Query(
					array(
				    	'post_type'      => 'page',
				    	'posts_per_page' => '3',
				    	'showposts'      => '3',
				    	'orderby'        => 'rand'
  					)
				);
			?>
			<ul>
			    <?php while ($featured -> have_posts()) : $featured -> the_post(); ?>
			    <?php 
					$thumb  = '';
					$width  = 250;
					$height = 250;
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

					$fixeIMG = get_template_directory_uri()."/images/featured.jpg";
				?>					
			        <li class="span3">
			        	<p class="thumb row">
			                 <a href="<?php the_permalink(); ?>">			                
				                <?php 					
									if(has_post_thumbnail()){
										the_crop_image($img, "&amp;w=$width&amp;h=$height&amp;zc=1"); 
									}else{
										the_crop_image($fixeIMG, "&amp;w=$width&amp;h=$height&amp;zc=1"); 
									}
								?>
							</a>
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
				<div class="fb-like-box" data-href="https://www.facebook.com/wordpress" data-width="1170" data-height="200" data-show-faces="true" data-stream="false" data-show-border="false" data-header="false"></div>
			</div>
		
		</article>
	</div> <!-- end of #content -->

	<div id="sidebar"></div> <!-- end of #sidebar -->

<?php get_footer() ?>