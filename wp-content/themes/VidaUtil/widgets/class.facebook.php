<?php 
	class facebook extends WP_Widget{
		function facebook(){
			$wgDesc = array('description' => 'Insere uma box do facebook com opçao de curtir a fan-page.');
			$wgDime = array('width' => '400', 'height' => '300');
			parent::WP_Widget(false, $name = 'Facebook Like Box', $wgDesc, $wgDime);
		}

		// Exibe o Widget no front-end
		function frontWidgetFacebook(){
			
		}

		// salva as configurações
		function saveWidgetFacebook(){

		}

		// Cria o formulário para o widget no back-end
		function backWidgetFacebook(){
			//Defaults
			$instance = wp_parse_args( (array) $instance, array('title'=>'Like Box Facebook') );

			$title = esc_attr($instance['title']);
			$posts_number = (int) $instance['posts_number'];
			$blog_category = (int) $instance['blog_category'];

			# Title
			echo '<p><label for="'.$this->get_field_id('title').'">'.'Title:'.'</label><input class="widefat" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$title.'" /></p>';
			# Number Of Posts
			echo '<p><label for="' . $this->get_field_id('posts_number') . '">' . 'Números de posts:' . '</label><input class="widefat" id="' . $this->get_field_id('posts_number') . '" name="' . $this->get_field_name('posts_number') . '" type="text" value="' . $posts_number . '" /></p>';
			# Category ?>
			<?php 
				$cats_array = get_categories('hide_empty=0');
			?>
			<p>
				<label for="<?php echo $this->get_field_id('blog_category'); ?>">Categoria</label>
				<select name="<?php echo $this->get_field_name('blog_category'); ?>" id="<?php echo $this->get_field_id('blog_category'); ?>" class="widefat">
					<?php foreach( $cats_array as $category ) { ?>
						<option value="<?php echo $category->cat_ID; ?>"<?php selected( $instance['blog_category'], $category->cat_ID ); ?>><?php echo $category->cat_name; ?></option>
					<?php } ?>
				</select>
			</p> 
			<?php
		}
		}		
	} 

	// Registra o widget
	function facebookInit(){
		register_widget( 'facebook' );
	} add_action( 'widgets_init', 'facebookInit' );