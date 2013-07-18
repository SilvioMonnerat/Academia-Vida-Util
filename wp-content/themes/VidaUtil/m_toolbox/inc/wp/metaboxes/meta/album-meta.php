<?php
global $wpalchemy_media_access;
 ?>
<div class="my_meta_control">
	<div id="sliderProperties">
		<label>Adicionar Imagem</label>
		<?php while($metabox->have_fields_and_multi('docs')): ?>
		<?php $metabox -> the_group_open(); ?>

		<?php $metabox -> the_field('imgurl'); ?>
		<?php $wpalchemy_media_access -> setGroupName('img-n' . $metabox -> get_the_index()) -> setInsertButtonLabel('Insert'); ?>
		
		<p><label >URL: </label><?php echo $wpalchemy_media_access -> getField(array('name' => $metabox -> get_the_name(), 'value' => $metabox -> get_the_value(), 'style' => "width: 100%; min-width: 400px;")); ?>
		<?php echo $wpalchemy_media_access -> getButton(); ?></p>

	    <?php $metabox->the_field('title'); ?>
	    
		<p>
			<label for="<?php $metabox->the_name(); ?>">Subtitlo: </label><?php //echo $wpalchemy_media_access -> getField(array('name' => $metabox -> get_the_name(), 'value' => $metabox -> get_the_value(), 'style' => "width: 100%; min-width: 400px;")); ?>

        	<input type="text" id="<?php $metabox->the_name(); ?>" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" style="width: 100%; min-width: 400px;"/>
		</p>

		<?php $metabox -> the_group_close(); ?>
		<?php endwhile; ?>
		<p style="padding:8px; border-top: 1px solid #DFDFDF;"><a href="#" class="docopy-docs button">Mais</a><a href="#" class="dodelete-docs button">Apagar Tudo</a></p>
	</div>
</div>
<div class="clear"></div>