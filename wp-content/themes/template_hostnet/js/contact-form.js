jQuery(document).ready(function($) {
  //Contact Form
  $('#buttonsend').click( function() {
	
		var name    = $('#name').val();
		var subject = $('#subject').val();
		var email   = $('#email').val();
		var message = $('#message').val();
		var siteurl = $('#siteurl').val();
		
		$('.loading').fadeIn('fast');
		
		if (name != "" && subject != "" && email != "" && message != "")
			{
				$.ajax(
					{
						url: siteurl+'/sendemail.php',
						type: 'POST',
						data: "name=" + name + "&subject=" + subject + "&email=" + email + "&message=" + message,
						success: function(result) 
						{
							$('.loading').fadeOut('fast');
							if(result == "email_error") {
								$('#email').css({"border":"1px solid #FF8C8C"}).next('.require').text(' !');
							} else {
								$('#name, #subject, #email, #message').val("");
								$('.mailsuccess').show().fadeOut(6000, function(){ $(this).remove(); });
							}
						}
					}
				);
				return false;
				
			} 
		else 
			{
				$('.loading').fadeOut('fast');
				if( name == "") $('#name').css({"border":"1px solid #FF8C8C"}).next('.require').text(' !');
				if(subject == "") $('#subject').css({"border":"1px solid #FF8C8C"}).next('.require').text(' !');
				if(email == "" ) $('#email').css({"border":"1px solid #FF8C8C"}).next('.require').text(' !');
				if(message == "") $('#message').css({"border":"1px solid #FF8C8C"}).next('.require').text(' !');
				return false;
			}
	});
	
	$('#name, #subject, #email, #message').focus(function(){
		$(this).css({"border":"1px solid #6a6a6a"}).next('.require').text(' *');
	});
	
	$('#name, #subject, #email, #message').blur(function(){
		$(this).css({"border":"1px solid #EEEEEE"}).next('.require').text(' *');
	});
});        
	