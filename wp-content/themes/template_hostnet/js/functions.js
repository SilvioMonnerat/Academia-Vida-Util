  jQuery(document).ready(function($) {
    
    /* Animate Portfolio Items */
    if ($.browser.msie && $.browser.version < 7) return;
    $(".imgportfolio").fadeTo(1, 1);
    $(".imgportfolio").hover(
      function () {
        $(this).fadeTo("fast", 0.66)
      },
      function () {
        $(this).fadeTo("slow", 1);
      }
    );
    
    
    /* initialize prettyphoto */
    $("a[rel^='prettyPhoto']").prettyPhoto({
  		theme: 'light_square'
    });
    
    /* initialize Tool tips */
    $('.zoom .tips').tipsy({gravity: 's'});
    
    $('.scrolltips').tipsy({gravity: 's'});
    
    $('#custom_nivoslider').nivoSlider({controlNav:true});
    
    $('#mycarousel').jcarousel({
        auto: 3,
        wrap: 'both',
        vertical: true,
        scroll: 2,
        initCallback: mycarousel_initCallback
    });
        
    
	});	
	
function mycarousel_initCallback(carousel)
{
    // Disable autoscrolling if the user clicks the prev or next button.
    carousel.buttonNext.bind('click', function() {
        carousel.startAuto(0);
    });

    carousel.buttonPrev.bind('click', function() {
        carousel.startAuto(0);
    });

    // Pause autoscrolling if the user moves with the cursor over the clip.
    carousel.clip.hover(function() {
        carousel.stopAuto();
    }, function() {
        carousel.startAuto();
    });
};
	
(function($){
	function detectVideo(){
		var flash_object = '<object style="z-index:0;" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="580" height="345"><param name="wmode" value="transparent" /><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="{path}" /><embed src="{path}" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="580" height="345" wmode="transparent"></embed></object>';
		var quicktime_object = '<object classid="clsid:02bf25d5-8c17-4b23-bc80-d3488abddc6b" codebase="http://www.apple.com/qtactivex/qtplugin.cab#version=6,0,2,0" height="345" width="580"><param name="src" value="{path}"><param name="autoplay" value="false"><param name="scale" value="tofit"><param name="type" value="video/quicktime"><embed src="{path}" scale="tofit" height="345" width="580" autoplay="false" type="video/quicktime" pluginspage="http://www.apple.com/quicktime/download/"></embed></object>';
		var toInject = "";
		
		var divWrapper = $('.movie_container');
		var ObjectP = divWrapper.find('a');
		
		switch(ObjectP.attr('rel')){
		  
					case 'youtube':
						movie = 'http://www.youtube.com/v/'+igrab_param('v', ObjectP.attr('href'));
						toInject = flash_object.replace(/{path}/g,movie);
					break;
					
					case 'vimeo':
						movie_id = ObjectP.attr('href');
						movie = "http://vimeo.com/moogaloop.swf?clip_id="+ movie_id.replace('http://vimeo.com/','');
					  toInject = flash_object.replace(/{path}/g,movie);
					break;
					
          case 'flash':
						movie = ObjectP.attr('href');
						toInject = flash_object.replace(/{path}/g,movie);
					break;
					
					case 'quicktime':
						movie = ObjectP.attr('href');
						toInject = quicktime_object.replace(/{path}/g,movie);
					break;
		}
		
		divWrapper.html(toInject);
		
	function igrab_param(name,url){
	  name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
	  var regexS = "[\\?&]"+name+"=([^&#]*)";
	  var regex = new RegExp( regexS );
	  var results = regex.exec( url );
	  if( results == null )
	    return "";
	  else
	    return results[1];
	}	
	
  }
  $(document).ready(function(){detectVideo();});
	
})(jQuery); 


	
// Image loader
function imageLoader() {
  
    jQuery('.loader').each(function () {
					  
        var loader = jQuery(this);
        var pathToImage = loader.attr('title');
        var img = new Image();	  
        jQuery(img).css("opacity", "0.0").load(function () {

            loader.removeClass('bgimage');
            loader.removeClass('bgvideo');          
				    loader.append(this).removeAttr('title');
		
            jQuery(this).css("margin", "0px").css("opacity", "0.0").animate({
											     
                opacity: 1.0
		    
            },400, function () {
			
                loader.css({ "background-image": "none", "background-color": "transparent" });
		    
            });
		
        }).attr('src', pathToImage);
	  
    });
    
}		
 	