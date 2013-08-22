<?php
	global $wpalchemy_media_access;
 ?>
<div class="my_meta_control">
	<div id="sliderProperties">
		<label>Adicionar Imagem</label>
		<?php while($mb->have_fields_and_multi('docs')): ?>

		<?php 
			//d($mb);
			$mb->the_group_open();
			$mb->the_field('imgurl');

			$wpalchemy_media_access->setGroupName('img-n'.$mb->get_the_index())->setInsertButtonLabel('Insert');
		?>
		<p>
			<label >URL: </label>
			<?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value(), 'style' => "width: 100%; min-width: 400px;")); ?>
			<?php echo $wpalchemy_media_access->getButton(); ?>
		</p>		

	    <?php $mb->the_field('title'); ?>
	    
		<p>
			<label for="<?php $mb->the_name(); ?>">Subtitlo: </label>
        	<input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" style="width: 100%; min-width: 400px;"/>
		</p>

		<?php $mb->the_group_close(); ?>
		<?php endwhile; ?>
		<p style="padding:8px; border-top: 1px solid #DFDFDF;"><a href="#" class="docopy-docs button">Mais</a><a href="#" class="dodelete-docs button">Apagar Tudo</a></p>
	</div>
</div>
<div class="clear"></div>