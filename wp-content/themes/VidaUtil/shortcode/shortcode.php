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

	function gdb_fb_like( $atts ){
		extract( shortcode_atts( 
			array(
				'width'  => '292',
				'url'    => 'FacebookDevelopers',
				'faces'  => 'true',
				'header' => 'true',
				'align'  => 'none',
				'send'   => 'false',
				'layout' => '',
				'stream' => 'false'
			), $atts ) 
		);

		return '<div class="fb-like" data-href="http://www.facebook.com/' .$url. '" data-send="'.$send.'" data-layout="'.$layout.'" data-width="'.$width.'" data-show-faces="'.$faces.'" data-stream="'.$stream.'">' ;
		
	} add_shortcode('like-box', 'gdb_fb_like');  // [like-box url="guiadoblogueiro" width="300" align="right" faces="true" header="true"]