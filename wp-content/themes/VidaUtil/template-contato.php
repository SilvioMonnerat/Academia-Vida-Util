<?php
	/*
		Template Name: Contato
	*/
?>
<?php get_header(); ?>

	<div class="maps">
		<?php echo do_shortcode( '[wpgmza id="1"]' ) ?>
	</div>

	<div class="container">
		<div class="main-area span9">
			<article id="post-<?php the_ID(); ?>" <?php post_class('entry clearfix'); ?>>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<div class="form span5">
						<?php echo do_shortcode( '[contact-form-7 id="152" title="contato"]' ) ?>
						<?php //echo do_shortcode( '[contact-form-7 id="128" title="Contato"]' ) ?>	
					</div>

					<div class="info span3">
						<label class="title"><?php echo __('Vida útil - Informações para contato') ?></label class="title">
						<label><strong>Telefone:</strong> 55 + 21 2621-4077</label>
						<label><strong>Celular:</strong> 55 + 21 9617-4887</label>
						<label><strong>Endereço:</strong> Rua da Conceição, 188 / 3° Piso  Niterói - Rio de Janeiro / <span>Niterói Shopping</span></label>
					</div>

				<?php endwhile; endif; ?>
			</article>
		</div>				
		<?php get_sidebar(); ?>
		<?php get_template_part( 'comments' ) ?>
	</div>
<?php get_footer(); ?>