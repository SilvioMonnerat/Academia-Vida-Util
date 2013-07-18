<?php 
	function cwc_youtube($atts) {
	    extract(shortcode_atts(array(
	        "value"             => 'http://',
	        "width"             => '560',
	        "height"            => '315',
	        "name"              => 'movie',
	        "allowFullScreen"   => 'true',
	        "allowScriptAccess" => 'always'
	    ), $atts));
	    return '<object style="height: '.$height.'px; width: '.$width.'px">
		       		<param name="'.$name.'" value="'.$value.'">
		    	    	<param name="allowFullScreen" value="'.$allowFullScreen.'">
		    	    	</param><param name="allowScriptAccess" value="'.$allowScriptAccess.'">
		    	    </param>
		    	    <embed src="'.$value.'" type="application/x-shockwave-flash" allowfullscreen="'.$allowFullScreen.'" allowScriptAccess="'.$allowScriptAccess.'" width="'.$width.'" height="'.$height.'">
		    	    </embed>
	    	    </object>';
	} add_shortcode("youtube", "cwc_youtube");  // ex.: [youtube value="http://www.youtube.com/watch?v=1aBSPn2P9bg"]

	function fb_like( $atts, $content=null ){
	    extract(shortcode_atts(array(
	            'send'        => 'false',
	            'layout'      => 'standard',
	            'show_faces'  => 'true',
	            'width'       => '400px',
	            'action'      => 'like',
	            'font'        => '',
	            'colorscheme' => 'light',
	            'ref'         => '',
	            'locale'      => 'pt_BR',
	            'appId'       => '' // Coloque o seu AppId aqui é que você tem um
	    ), $atts));
	    $fb_like_code = '
	        <div id="fb-root"></div><script src="http://connect.facebook.net/$locale/all.js#appId=$appId&amp;xfbml=1"></script>
	        <fb:like ref="$ref" href="$content" layout="$layout" colorscheme="$colorscheme" action="$action" send="$send" width="$width" show_faces="$show_faces" font="$font"></fb:like> 
	    ';
	    return $fb_like_code;
	} add_shortcode('fb', 'fb_like'); /* [fb layout='box_count'] <?php echo do_shortcode("[fb]"); ?> [fb action='recommend' layout='button_count']  */

/* <div class="fb-like-box" data-href="https://www.facebook.com/FacebookDevelopers" data-width="292" data-show-faces="true" data-stream="true" data-show-border="true" data-header="true"></div> */