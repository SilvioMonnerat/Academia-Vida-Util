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
					$width = 250;
            		$height = 250;
					$project_gallery = get_post_meta($post->ID, 'theme_project_gallery', true);
					//the_crop_image($item['theme_project_item_image'], "&amp;w=$width&amp;h=$height&amp;zc=1")
				?>
				<div id="gallery" class="row">
					<?php 
					    if($project_gallery){
					        $before = '
					            <div id="gallery" class="span3">
					                <ul>
					        ';
					        foreach( $project_gallery as $item ){
					            if( $item['theme_project_item_image'] ){
					                $output = '
					                    <li class="">
					                        <a href="'.the_crop_image($item['theme_project_item_image'], "&amp;w=$width&amp;h=$height&amp;zc=1").'" rel="lightbox">
					                        	<img class="" src="'.$item['theme_project_item_image'].'"  alt="" />
					                        </a>
					                    </li>
					                ';
					            }
					            if( $item['theme_project_item_video'] ){
					                $output .= '
					                    <li>'.
					                        wp_oembed_get($item['theme_project_item_video'], array('width'=> ''. $item['theme_project_item_size'] .''))
					                    .'</li>
					                ';
					            }
					        }
					        $after = '
					                </ul>
					            </div>
					        ';					        
					    }
					    print $before . $output . $after;
					?>
		        </div>
				<?php endwhile; ?>
				<?php endif; ?>
			</article>
		</div>		
			
		<?php get_sidebar(); ?>
		<?php get_template_part( 'comments' ) ?>
	</div>
