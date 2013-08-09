<?php 
/*

	Template Name: Agenda

*/

?>

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

	$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

?>       
	<div class="container">
		<div class="main-area span9">
			<article id="post-<?php the_ID(); ?>" <?php post_class('entry clearfix'); ?>>

				<?php
					$agenda = new WP_Query(
						array(
					    	'post_type'      => 'agenda',
					    	'posts_per_page' => '5',
					    	'showposts'      => '5',
					    	'paged'          => $paged
	  					)
					);
				?>
				<div class="content-agenda">
					<table summary="">
						<caption class="title-agenda">SPINNING</caption>
							<tr>
								<th id="post-<?php the_ID() ?>">HORÁRIO</th>
								<th id="post-<?php the_ID() ?>">SEGUNDA</th>
								<th id="post-<?php the_ID() ?>">TERÇA</th>
								<th id="post-<?php the_ID() ?>">QUARTA</th>
								<th id="post-<?php the_ID() ?>">QUINTA</th>
								<th id="post-<?php the_ID() ?>">SEXTA</th>								
							</tr>
							<tr>
								<th>07:00</td>
								<td><label>JUMP</label><label>FERNADA</label></td>
								<td><label></label><label></label></td>
								<td><label>JUMP</label><label>FERNADA</label></td>
								<td><label></label><label></label></td>
								<td><label>JUMP</label><label>FERNADA</label></td>
							</tr>
							<tr>
								<th>08:00</td>
								<td><label>GA</label><label>FERNANDA</label></td>
								<td><label>LOCAL</label><label>IZABELLE</label> </td>
								<td><label>GA</label><label>FERNANDA</label></td>
								<td><label>LOCAL</label><label>IZABELLE</label> </td>
								<td><label>GA</label><label>FERNANDA</label> </td>
							</tr>
							<tr>
								<th>17:00</td>
								<td><label>GAP</label><label>IZABELLE</label> </td>
								<td><label></label><label></label></td>
								<td><label>GAP</label><label>IZABELLE</label> </td>
								<td><label></label><label></label></td>
								<td><label>GAP</label><label>IZABELLE</label> </td>
							</tr>
							<tr>
								<th>18:00</td>
								<td><label>LOCAL</label><label>IZABELLE</label> </td>
								<td><label>JUMP</label><label>FERNANDA</label> </td>
								<td><label>LOCAL</label><label>IZABELLE</label> </td>
								<td><label>JUMP</label><label>FERNANDA</label> </td>
								<td><label>LOCAL</label><label>IZABELLE</label> </td>
							</tr>
							<tr>
								<th>19:00</td>
								<td><label>GA</label><label>IZABELLE</label> </td>
								<td><label>JUMP</label><label>FERNANDA</label> </td>
								<td><label>GA</label><label>IZABELLE</label> </td>
								<td><label>JUMP</label><label>FERNANDA</label> </td>
								<td><label>GA</label><label>IZABELLE</label> </td>
							</tr>
					</table>

					<table summary="">
						<caption class="title-agenda">SPINNING</caption>
							<tr>
								<th id="post-<?php the_ID() ?>">HORÁRIO</th>
								<th id="post-<?php the_ID() ?>">SEGUNDA</th>
								<th id="post-<?php the_ID() ?>">TERÇA</th>
								<th id="post-<?php the_ID() ?>">QUARTA</th>
								<th id="post-<?php the_ID() ?>">QUINTA</th>
								<th id="post-<?php the_ID() ?>">SEXTA</th>								
							</tr>
							<tr>
								<th>07:00</td>
								<td>HAROLDO</td>
								<td>CAROL</td>
								<td>CAROL</td>
								<td>CAROL</td>
								<td>CAROL</td>
							</tr>
							<tr>
								<th>09:00</td>
								<td>FERNANDA</td>
								<td></td>
								<td>FERNANDA</td>
								<td> </td>
								<td>FERNANDA</td>
							</tr>
							<tr>
								<th>11:30</td>
								<td> </td>
								<td>DANIELA</td>
								<td> </td>
								<td>DANIELA</td>
								<td> </td>
							</tr>
							<tr>
								<th>12:30</td>
								<td>DANIELA</td>
								<td> </td>
								<td>DANIELA</td>
								<td> </td>
								<td>DANIELA</td>
							</tr>
							<tr>
								<th>17:00</td>
								<td>HAROLDO</td>
								<td>FLÁVIA</td>
								<td>HAROLDO</td>
								<td>FLÁVIA</td>
								<td>HAROLDO</td>
							</tr>
							<tr>
								<th>18:00</td>
								<td>HAROLDO</td>
								<td>FLÁVIA</td>
								<td>HAROLDO</td>
								<td>FLÁVIA</td>
								<td>HAROLDO</td>
							</tr>
							<tr>
								<th>19:00</td>
								<td>CAROL</td>
								<td>FLÁVIA</td>
								<td>CAROL</td>
								<td>FLÁVIA</td>
								<td>CAROL</td>
							</tr>
							<tr>
								<th>20:00</td>
								<td>CAROL</td>
								<td>FERNANDA</td>
								<td>CAROL</td>
								<td>FERNANDA</td>
								<td>CAROL</td>
							</tr>
					</table>
							<?php
								if($agenda->have_posts()): while($agenda->have_posts()): $agenda->the_post();								
							?>
							<tr>
								<td></td>
							</tr>
							<?php endwhile; endif; wp_reset_query(); ?>					
				</div>

				<?php wp_link_pages(array('before' => '<p><strong>'.esc_attr__('Pages', 'VidaUtil').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

			</article>

		</div>
				
		<?php get_sidebar(); ?>

		<?php get_template_part( 'comments' ) ?>

	</div>


<?php get_footer() ?>