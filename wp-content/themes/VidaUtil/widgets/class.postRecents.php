<?php 
class postRecents extends WP_Widget {
    function postRecents(){
		$widget_ops = array('description' => 'Displays recent posts from any category');
		$control_ops = array('width' => 400, 'height' => 300);
		parent::WP_Widget(false,$name='Posts mais lidos',$widget_ops,$control_ops);
    }

  /* Displays the Widget in the front-end */
    function widget($args, $instance){
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? 'Posts mais lidos ' : $instance['title']);
		$posts_number = empty($instance['posts_number']) ? '' : (int) $instance['posts_number'];
		$blog_category = empty($instance['blog_category']) ? '' : (int) $instance['blog_category'];

		echo $before_widget;

		if ( $title )
		echo $before_title . $title . $after_title;
?>
	<ul>
		<?php
			$query = new WP_query( 
				array( 
					//'post_type'      => 'page',
                    'posts_per_page' => '3',
                    'showposts'      => '3',
                    'orderby'        => 'rand'
                     )
				); 

			if($query->have_posts()) : while($query->have_posts()) : $query->the_post();
		?>
			<li class="post-recents">
				<?php 
                    $thumb  = '';
                    $width  = 60;
                    $height = 60;
                    $title  = get_the_title();
                    $img = get_post_image_src($post->ID);
                    $default_attr = array(
                        'src'   => $src,
                        'class' => "attachment-$size",
                        'alt'   => trim(strip_tags( $attachment->post_excerpt )),
                        'title' => trim(strip_tags( $attachment->post_title )),
                    );
                    $thumbnail = get_the_post_thumbnail($width,$height);
                    $thumb = $thumbnail["thumb"];
                 ?>

                 <?php if(has_post_thumbnail()): ?>
	                 <a href="<?php the_permalink(); ?>">
	                    <?php the_crop_image($img, "&amp;w=$width&amp;h=$height&amp;zc=1");  ?>
	                </a> 
                <?php endif; ?>

					<p class="post-content">
						<a href="<?php the_permalink(); ?>"><?php the_title_limit('30'); ?></a>
						<a href="<?php the_permalink(); ?>"><?php the_content_limit('10'); ?></a>
					</p>
				</li>
			<?php
				$j++;
				endwhile; endif; wp_reset_postdata(); 
			?>
		</ul>
<?php
		echo $after_widget;
	}

  /*Saves the settings. */
    function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = stripslashes($new_instance['title']);
		$instance['posts_number'] = (int) $new_instance['posts_number'];
		$instance['blog_category'] = (int) $new_instance['blog_category'];

		return $instance;
	}

  /*Creates the form for the widget in the back-end. */
    function form($instance){
		//Defaults
		$instance = wp_parse_args( (array) $instance, array('title'=>'Posts mais lidos ', 'posts_number'=>'5', 'blog_category'=>'') );

		$title = esc_attr($instance['title']);
		$posts_number = (int) $instance['posts_number'];
		$blog_category = (int) $instance['blog_category'];

		# Title
		echo '<p><label for="' . $this->get_field_id('title') . '">' . 'Title:' . '</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></p>';
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

}// end ETRecentFromWidget class

function postRecentsInit() {
  register_widget('postRecents');
}

add_action('widgets_init', 'postRecentsInit');