</div> <!-- end div .content-area -->
	<footer id="footer">
		<section class="container clearfix">
			<div class="span3">
				<?php copyright(); ?>
			</div>
			<div class="span5">
				<?php 
					wp_nav_menu( 
						array(
							'theme_location'  => 'footer_menu',
							'container_class' => 'menu'
						)
					);
				?>
			</div>
			<div class="icons span3">
				<?php iconSociais(); ?>
			</div>
		</section>
	</footer> <!-- end of #footer -->

	<?php wp_footer() ?>
</body>
</html>