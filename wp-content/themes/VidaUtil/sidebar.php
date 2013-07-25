<aside id="sidebar" class="span3">
	<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'sidebar' ) ) : ?>
	
		<li>			
			<ul>
				<li>
					<h3 class="widget-title">Galeria de Fotos</h3>
					<a href="">Bem vindo a acadeia Vida Útil</a>
				</li>
				<li>
					<h3 class="widget-title">Busca no Site</h3>
					<?php search_form(); ?>
				</li>
			</ul>
		</li>
	
	<?php endif;  ?>
</aside> 