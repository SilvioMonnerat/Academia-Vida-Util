<?php
/*
*****************************************************
* WEBMAN'S WORDPRESS THEME FRAMEWORK
* Created by WebMan - www.webmandesign.eu
*
* Recent tweets
*****************************************************
*/

/*
*****************************************************
*      ACTIONS AND FILTERS
*****************************************************
*/
add_action( 'widgets_init', 'reg_wm_twitter' );



/*
* Widget registration
*/
function reg_wm_twitter() {
	register_widget( 'wm_twitter' );
} // /reg_wm_contact_info





/*
*****************************************************
*      WIDGET CLASS
*****************************************************
*/
class wm_twitter extends WP_Widget {
	/*
	*****************************************************
	*      widget constructor
	*****************************************************
	*/
	function __construct() {
		$id     = 'wm-twitter';
		$prefix = ( wm_option( 'branding-panel-no-logo' ) || ! strpos( wm_option( 'branding-panel-logo' ), 'logo-' . WM_THEME_SHORTNAME . '-admin.png' ) ) ? ( '' ) : ( WM_THEME_NAME . ' ' );
		$name   = '<span>' . $prefix . __( 'Twitter', 'atlantes_domain_adm' ) . '</span>';
		$widget_ops = array(
			'classname'   => 'wm-twitter',
			'description' => __( 'Seus tweets recentes', 'atlantes_domain_adm' )
			);
		$control_ops = array();

		//$this->WP_Widget( $id, $name, $widget_ops, $control_ops );
		parent::__construct( $id, $name, $widget_ops, $control_ops );
	} // /__construct



	/*
	*****************************************************
	*      widget options form in admin
	*****************************************************
	*/
	function form( $instance ) {
		extract( $instance );
		$title    = ( isset( $title ) ) ? ( $title ) : ( null );
		$username = ( isset( $username ) ) ? ( $username ) : ( null );
		$count    = ( isset( $count ) && 0 < absint( $count ) ) ? ( absint( $count ) ) : ( 3 );
		$userinfo = ( isset( $userinfo ) ) ? ( $userinfo ) : ( null );

		//HTML to display widget settings form
		?>
		<p class="wm-desc"><?php _e( 'Exibe tweets recentes da conta do Twitter específico. Também exibe detalhes da conta do Twitter. Tweets são sendo armazenados em cache para reduzir o carregamento da página.', 'atlantes_domain_adm' ) ?></p>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Título:', 'atlantes_domain_adm' ) ?></label><br />
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e( 'Usuário do Twitter:', 'atlantes_domain_adm' ) ?></label><br />
			<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" type="text" value="<?php echo esc_attr( $username ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Número de tweets para exibir:', 'atlantes_domain_adm' ) ?></label><br />
			<input class="text-center" type="number" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $count; ?>" size="5" maxlength="2" min="1" max="10" />
		</p>

		<p>
			<input id="<?php echo $this->get_field_id( 'userinfo' ); ?>" name="<?php echo $this->get_field_name( 'userinfo' ); ?>" type="checkbox" <?php checked( $userinfo, 'on' ); ?>/>
			<label for="<?php echo $this->get_field_id( 'userinfo' ); ?>"><?php _e( 'Desativar Twitter informações de usuário', 'atlantes_domain_adm' ); ?></label>
		</p>
		<?php
	} // /form



	/*
	*****************************************************
	*      process and save the widget options
	*****************************************************
	*/
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title']    = $new_instance['title'];
		$instance['username'] = sanitize_title( strip_tags( $new_instance['username'] ) ); //remove non-alfanumeric characters
		$count                = ( 0 < absint( $new_instance['count'] ) ) ? ( absint( $new_instance['count'] ) ) : ( 3 );
		$instance['count']    = $count;
		$instance['userinfo'] = $new_instance['userinfo'];

		return $instance;
	} // /update



	/*
	*****************************************************
	*      output the widget content
	*****************************************************
	*/
	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		$username = ( isset( $username ) ) ? ( trim( $username ) ) : ( wm_option( 'twitterUsername' ) );
		$count    = ( isset( $count ) && 0 < absint( $count ) ) ? ( absint( $count ) ) : ( 3 );
		if ( 10 < $count )
			$count = 10;

		$out = $before_widget;

		//if the title is not filled, no title will be displayed
		if ( isset( $title ) && '' != $title && ' ' != $title )
			$out .= $before_title . apply_filters( 'widget_title', $title ) . $after_title;

		$out .= $this->wm_get_tweet( $count, $username, $userinfo );

		echo $out . $after_widget;
	} // /widget



	/*
	* Twitter main function
	*
	* $count           = # [number of tweets]
	* $username        = TEXT [Twitter username]
	* $no_userinfo     = BOOLEAN [whether to display Twitter user info or not]
	* $exclude_replies = BOOLEAN [excludes "@" Twitter replies]
	*/
	private function wm_get_tweet( $count, $username, $no_userinfo, $exclude_replies = true ) {
		$out = $outInfo = '';
		$userDetails = array();

		$cache = get_transient( WM_THEME_SHORTNAME . '_tweets_id_' . esc_attr( $username ) );

		if ( $cache ) {

			$userDetails = get_transient( WM_THEME_SHORTNAME . '_tweets_id_' . esc_attr( $username ) );
			$tweets = get_option( WM_THEME_SHORTNAME . '_tweets_' . esc_attr( $username ) );

		} else {

			$protocol = ( is_ssl() ) ? ( 'https' ) : ( 'http' );
			$response = wp_remote_get( $protocol . '://api.twitter.com/1/statuses/user_timeline.xml?include_rts=true&screen_name=' . esc_attr( $username ) );

			if ( ! is_wp_error( $response ) ) {
				$xml = simplexml_load_string( $response['body'] );

				if ( empty( $xml->error ) ) {
					if ( isset( $xml->status[0] ) ) {
						$tweets = array();

						$i = 0;
						foreach ( $xml->status as $tweet ) {
							if ( $i == $count )
								break;

							$text = (string) $tweet->text;
							if ( ! $exclude_replies || ( $exclude_replies && $text[0] != '@' ) ) {
								$i++;
								if ( ! $userDetails )
									$userDetails = array(
										'name'        => (string) $tweet->user->name,
										'screen_name' => (string) $tweet->user->screen_name,
										'image'       => (string) $tweet->user->profile_image_url,
										'description' => (string) $tweet->user->description,
										'utc_offset'  => ( isset( $tweet->user->utc_offset[0] ) ) ? ( (int) $tweet->user->utc_offset[0] ) : ( 0 ),
										'follower'    => (int) $tweet->user->followers_count
									);
								$tweets[] = array(
									'text'    => $this->wm_filter_tweet( $text ),
									'created' => strtotime( $tweet->created_at )
								);
							}
						}

						set_transient( WM_THEME_SHORTNAME . '_tweets_id_' . esc_attr( $username ), $userDetails, WM_TWITTER_CACHE_EXPIRATION );
						update_option( WM_THEME_SHORTNAME . '_tweets_' . esc_attr( $username ), $tweets );
					}
				}
			}

		}

		if ( ! isset( $tweets[0] ) )
			$tweets = get_option( WM_THEME_SHORTNAME . '_tweets_' . esc_attr( $username ) );

		if ( isset( $tweets[0] ) ) {
			$time_format = get_option( 'date_format' ) . ', ' . get_option( 'time_format' );

			$i = 0;
			foreach ( $tweets as $message ) {
				if ( $i++ == $count )
					break;

				$out .= '<li>' . $message['text'];
				$out .= ( $userDetails ) ? ( '<div class="tweet-time">' . date_i18n( $time_format, $message['created'] + $userDetails['utc_offset'] ) . '</div>' ) : ( '' );
				$out .= '</li>';
			}
		}

		if ( $out ) {
			if ( ! isset( $no_userinfo ) && ! empty( $userDetails ) ) {
				//$outInfo .= '<div class="user-info">';
				//$outInfo .= '<a href="http://twitter.com/' . $username . '"><img src="' . $userDetails['image'] . '" alt="' . $userDetails['screen_name'] . '" title="' . $userDetails['screen_name'] . '" /></a>';
				//$outInfo .= '<h3><a href="http://twitter.com/' . $username . '">' . $username . '</a></h3>';
				//$outInfo .= ( $userDetails['description'] ) ? ( $userDetails['description'] ) : ( '' );
				//$outInfo .= '</div>';
			}
			$out = $outInfo . '<ul>' . $out . '</ul>';
		} else {
			$out = do_shortcode( '[box color="red" icon="warning"]' . __( 'No tweets.', 'atlantes_domain' ) . '[/box]' );
		}

		$out .= "\r\n<!-- Tweets from: " . $protocol . '://api.twitter.com/1/statuses/user_timeline.xml?include_rts=true&screen_name=' . esc_attr( $username ) . " -->";

		return $out;
	} // /wm_get_tweet



	/*
	* Filter tweets
	*
	* $text = TEXT [text to process]
	*/
	private function wm_filter_tweet( $text ) {
		$text = preg_replace(
			'/\b([a-zA-Z]+:\/\/[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',
			"<a href=\"$1\" class=\"twitter-link\">$1</a>",
			$text );
		$text = preg_replace(
			'/\b(?<!:\/\/)(www\.[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',
			"<a href=\"http://$1\" class=\"twitter-link\">$1</a>",
			$text );
		$text = preg_replace(
			"/\b([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})\b/i",
			"<a href=\"mailto://$1\" class=\"twitter-link\">$1</a>",
			$text );
		$text = preg_replace(
			"/#(\w+)/",
			"<a class=\"twitter-link\" href=\"http://search.twitter.com/search?q=\\1\">#\\1</a>",
			$text );
		$text = preg_replace(
			"/@(\w+)/",
			"<a class=\"twitter-link\" href=\"http://twitter.com/\\1\">@\\1</a>",
			$text );

		return $text;
	} // /wm_filter_tweet
} // /wm_twitter

?>