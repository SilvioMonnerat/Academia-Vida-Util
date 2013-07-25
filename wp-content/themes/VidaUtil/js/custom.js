(function ($) {

	$('input[name=s]').focus(function(){
	    if ($(this).val() == 'Search...')
	    	$(this).val('');
	});
	$('input[name=s]').blur(function(){
	    if ($(this).val() == '')
	    	$(this).val('Search...');
	});
})(jQuery);