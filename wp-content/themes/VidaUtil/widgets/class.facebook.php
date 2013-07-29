<?php 
	class facebook extends WP_Widget{
		function facebook(){
			$wgDesc = array('description' => 'Insere uma box do facebook com opçao de curtir a fan-page.');
			$wgDime = array('width' => '400', 'height' => '300');
			parent::WP_Widget(false, $name = 'Like Box Facebook Setting', $wgDesc, $wgDime);
		}

		// Cria o formulário para o widget no back-end
		function backWidgetFacebook($obj){
			$obj = wp_parse_args( (array) $obj, array(
				'title ' => 'Like Box Facebook Setting',
				'url'    => '',
				'width'  => '300',
				'height' => '300'
			));
			$title  = esc_attr( $obj['title'] );
			$url    = $obj['url'];
			$width  = $obj['width'];
			$height = $obj['height'];

			echo '<p><label for="' . $this->get_field_id('title') . '">' . 'Title:' . '</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></p>';
			echo '<p><label for="' . $this->get_field_id('url') . '">' . 'URL:' . '</label><input class="widefat" id="' . $this->get_field_id('url') . '" name="' . $this->get_field_name('url') . '" type="text" value="' . $url . '" /></p>';
			echo '<p><label for="' . $this->get_field_id('width') . '">' . 'width:' . '</label><input class="widefat" id="' . $this->get_field_id('width') . '" name="' . $this->get_field_name('width') . '" type="text" value="' . $width . '" /></p>';
			echo '<p><label for="' . $this->get_field_id('height') . '">' . 'height:' . '</label><input class="widefat" id="' . $this->get_field_id('height') . '" name="' . $this->get_field_name('height') . '" type="text" value="' . $height . '" /></p>';
		}

		// Exibe o Widget no front-end
		function frontWidgetFacebook($args, $obj){
			extract($args);
			$title  = apply_filters('widget_title', empty($obj['title']) ? 'Like Box Facebook Setting ' : $obj['title']);
			$url    = empty($obj['url']) ? '' : $obj['url'];
			$width  = empty($obj['width']) ? '' : (int) $obj['width'];
			$height = empty($obj['height']) ? '' : (int) $obj['height'];

			echo $before_widget;

			if ( $title )
				echo $before_title . $title . $after_title;
?>
			<div class="fb-like" data-href="<?php echo $obj['url'] ?>" data-send="true" data-width="<?php echo $obj['width'] ?>" data-show-faces="true"></div>
<?php
			echo $after_widget;
		}

		// salva as configurações
		function saveWidgetFacebook($update, $oldObj){
			$obj = $oldObj;
			$obj['title']  = stripslashes($update['title']);
			$obj['url']    = (int) $update['url'];
			$obj['width']  = (int) $update['width'];
			$obj['height'] = (int) $update['height'];

			return $obj;
		}	
	} 

	// Registra o widget
	function facebookInit(){
		register_widget( 'facebook' );
	} add_action( 'widgets_init', 'facebookInit' );