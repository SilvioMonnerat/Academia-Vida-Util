<?php
/**
 * WTester Tabbed Settings Page
 */

add_action( 'init', 'wptester_admin_init' );
add_action( 'admin_menu', 'wptester_settings_page_init' );

function wptester_admin_init() {
	$settings = get_option( "wptester_theme_settings" );
	if ( empty( $settings ) ) {
		$settings = array(
			'wptester_intro' => 'Some intro text for the home page',
			'wptester_tag_class' => false,
			'wptester_ga' => false
		);
		add_option( "wptester_theme_settings", $settings, '', 'yes' );
	}	
}

function wptester_settings_page_init() {
	$theme_data = get_theme_data( TEMPLATEPATH . '/style.css' );
	$settings_page = add_theme_page( $theme_data['Name']. ' Theme Settings', $theme_data['Name']. ' Theme Settings', 'edit_theme_options', 'theme-settings', 'wptester_settings_page' );
	add_action( "load-{$settings_page}", 'wptester_load_settings_page' );
}

function wptester_load_settings_page() {
	if ( $_POST["wptester-settings-submit"] == 'Y' ) {
		check_admin_referer( "wptester-settings-page" );
		wptester_save_theme_settings();
		$url_parameters = isset($_GET['tab'])? 'updated=true&tab='.$_GET['tab'] : 'updated=true';
		wp_redirect(admin_url('themes.php?page=theme-settings&'.$url_parameters));
		exit;
	}
}

function wptester_save_theme_settings() {
	global $pagenow;
	$settings = get_option( "wptester_theme_settings" );
	
	if ( $pagenow == 'themes.php' && $_GET['page'] == 'theme-settings' ){ 
		if ( isset ( $_GET['tab'] ) )
	        $tab = $_GET['tab']; 
	    else
	        $tab = 'homepage'; 

	    switch ( $tab ){ 
	        case 'general' :
				$settings['wptester_tag_class']	  = $_POST['wptester_tag_class'];
			break; 
	        case 'footer' : 
				$settings['wptester_ga']  = $_POST['wptester_ga'];
			break;
			case 'homepage' : 
				$settings['wptester_intro']	  = $_POST['wptester_intro'];
			break;
	    }
	}
	
	if( !current_user_can( 'unfiltered_html' ) ){
		if ( $settings['wptester_ga']  )
			$settings['wptester_ga'] = stripslashes( esc_textarea( wp_filter_post_kses( $settings['wptester_ga'] ) ) );
		if ( $settings['wptester_intro'] )
			$settings['wptester_intro'] = stripslashes( esc_textarea( wp_filter_post_kses( $settings['wptester_intro'] ) ) );
	}

	$updated = update_option( "wptester_theme_settings", $settings );
}

function wptester_admin_tabs( $current = 'homepage' ) { 
    $tabs = array( 'homepage' => 'Home', 'general' => 'General', 'footer' => 'Footer' ); 
    $links = array();
    echo '<div id="icon-themes" class="icon32"><br></div>';
    echo '<h2 class="nav-tab-wrapper">';
    foreach( $tabs as $tab => $name ){
        $class = ( $tab == $current ) ? ' nav-tab-active' : '';
        echo "<a class='nav-tab$class' href='?page=theme-settings&tab=$tab'>$name</a>";
        
    }
    echo '</h2>';
}

function wptester_settings_page() {
	global $pagenow;
	$settings = get_option( "wptester_theme_settings" );
	$theme_data = get_theme_data( TEMPLATEPATH . '/style.css' );
	?>
	
	<div class="wrap">
		<h2><?php echo $theme_data['Name']; ?> Theme Settings</h2>
		
		<?php
			if ( 'true' == esc_attr( $_GET['updated'] ) ) echo '<div class="updated" ><p>Theme Settings updated.</p></div>';
			
			if ( isset ( $_GET['tab'] ) ) wptester_admin_tabs($_GET['tab']); else wptester_admin_tabs('homepage');
		?>

		<div id="poststuff">
			<form method="post" action="<?php admin_url( 'themes.php?page=theme-settings' ); ?>">
				<?php
				wp_nonce_field( "wptester-settings-page" ); 
				
				if ( $pagenow == 'themes.php' && $_GET['page'] == 'theme-settings' ){ 
				
					if ( isset ( $_GET['tab'] ) ) $tab = $_GET['tab']; 
					else $tab = 'homepage'; 
					
					echo '<table class="form-table">';
					switch ( $tab ){
						case 'general' :
							?>
							<tr>
								<th><label for="wptester_tag_class">Tags with CSS classes:</label></th>
								<td>
									<input id="wptester_tag_class" name="wptester_tag_class" type="checkbox" <?php if ( $settings["wptester_tag_class"] ) echo 'checked="checked"'; ?> value="true" /> 
									<span class="description">Output each post tag with a specific CSS class using its slug.</span>
								</td>
							</tr>
	
							<?php
						break; 
						case 'footer' : 
							?>
							<tr>
								<th><label for="wptester_ga">Insert tracking code:</label></th>
								<td>
									<textarea id="wptester_ga" name="wptester_ga" cols="60" rows="5"><?php echo esc_html( stripslashes( $settings["wptester_ga"] ) ); ?></textarea><br/>
									<span class="description">Enter your Google Analytics tracking code:</span>
								</td>
							</tr>
							<?php
						break;
						case 'homepage' : 
							?>
							<tr>
								<th><label for="wptester_intro">Introduction</label></th>
								<td>
									<textarea id="wptester_intro" name="wptester_intro" cols="60" rows="5" ><?php echo esc_html( stripslashes( $settings["wptester_intro"] ) ); ?></textarea><br/>
									<span class="description">Enter the introductory text for the home page:</span>
								</td>
							</tr>
							<?php
						break;
					}
					echo '</table>';
				}
				?>
				<p class="submit" style="clear: both;">
					<input type="submit" name="Submit"  class="button-primary" value="Update Settings" />
					<input type="hidden" name="wptester-settings-submit" value="Y" />
				</p>
			</form>
			
			<!-- <p><?php echo $theme_data['Name'] ?> theme by <a href="http://wpmidia.com.br/">wpmidia</a> | <a href="http://twitter.com/wpmidia">Follow me on Twitter</a>! | Join <a href="http://on.fb.me/MithfF">wpmidia on Facebook</a>!</p> -->
		</div>

	</div>
<?php
}