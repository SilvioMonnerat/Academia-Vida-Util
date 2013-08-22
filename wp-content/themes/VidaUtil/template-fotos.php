<?php 
	/*
		Template Name: Galeria de Fotos
	*/
?>
<?php get_header(); ?>
	<div class="container">
		<div class="main-area span9">
			<article id="post-<?php the_ID(); ?>" <?php post_class('entry clearfix'); ?>>
				<?php 
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

					$projects = new WP_Query( 'post_type=galeria&posts_per_page=-1&showposts=9&paged=$paged' );
				?>

				<?php if($projects->have_posts()): while($projects->have_posts()): $projects->the_post(); ?>

				<?php
					$thumb  = '';
                    $width  = 230;
            		$height = 230;
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
	
					$project_gallery = get_post_meta($post->ID, 'theme_project_gallery', true);
					$timthumb = get_template_directory_uri(). 'timthumb.php';
					//the_crop_image($item['theme_project_item_image'], "&amp;w=$width&amp;h=$height&amp;zc=1")
				?>

				<div id="gallery" class="">
					<?php if( $project_gallery ) : ?>
					<div class="title"><?php the_title() ?></div>
			            <ul>
			            	<?php foreach( $project_gallery as $item ) : ?>
								<?php if( $item['theme_project_item_image'] ) : ?>
							        <li>
							        	<a class="fancybox" data-fancybox-group="gallery"  href="<?php echo $item['theme_project_item_image'] ?>" title="<?php echo $item['title'] ?>" >
							            	<img class="scale-with-grid" src="<?php echo $item['theme_project_item_image'] ?>" alt="" />
							        	</a>
							        </li>
								<?php endif; ?>
								<?php if( $item['theme_project_item_video'] ) : ?>
							        <li>
							            <?php echo wp_oembed_get( $item['theme_project_item_video'], array('width'=> ''. $item['theme_project_item_size'] .'') ); ?>
							        </li>
							    <?php endif; ?>
							<?php endforeach; ?>
			            </ul>
			        <?php endif; ?>
		        </div>
				<?php endwhile; ?>
				<?php endif; ?>
			</article>
		</div>		
			
		<?php get_sidebar(); ?>
		<?php get_template_part( 'comments' ) ?>
	</div>
<?php get_footer(); ?>
