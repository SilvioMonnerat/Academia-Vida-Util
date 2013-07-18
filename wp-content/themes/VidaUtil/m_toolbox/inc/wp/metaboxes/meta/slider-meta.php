<?php
global $wpalchemy_media_access;
 ?>
<div class="my_meta_control">
	<div id="sliderProperties">
		<label>Adicionar slides</label>
		<?php while($metabox->have_fields_and_multi('docs')): ?>
		<?php $metabox -> the_group_open(); ?>

		<?php $metabox -> the_field('imgurl'); ?>
		<?php $wpalchemy_media_access -> setGroupName('img-n' . $metabox -> get_the_index()) -> setInsertButtonLabel('Insert'); ?>

		<p><label >URL: </label>
			<?php echo $wpalchemy_media_access -> getField(array('name' => $metabox -> get_the_name(), 'value' => $metabox -> get_the_value())); ?>
			<?php echo $wpalchemy_media_access -> getButton(); ?>
		</p>

        <?php $metabox->the_field('title'); ?>
        <label for="<?php $metabox->the_name(); ?>">Description:</label>
        <p><textarea id="<?php $metabox->the_name(); ?>" name="<?php $metabox->the_name(); ?>" ><?php $metabox->the_value(); ?></textarea></p>


		<?php $metabox -> the_group_close(); ?>
		<?php endwhile; ?>
		<p style="padding:8px; border-top: 1px solid #DFDFDF;"><a href="#" class="docopy-docs button">Add</a><a href="#" class="dodelete-docs button">Remove All</a></p>
	</div>
</div>
<div class="clear"></div>