(function($) {
	
	//var displayPercent = "-60px",
	//hidePercent = "-370px"; 

	$(document).ready(function(e) {
		
	    $('#pm_quick_username').focus(function(e) {
			$('#pm-quick-message').html('');
			$(this).removeClass('invalid_field');
		});
		
		$('#pm_quick_password').focus(function(e) {
			$('#pm-quick-message').html('');
			$(this).removeClass('invalid_field');
		});
		
		$('#pm_login_form_security_question').focus(function(e) {
			$(this).removeClass('invalid_field');
		});


	  $('#btn-quick-login').click( function(e) {

		e.preventDefault();
		
		$('#pm-quick-message').html( wordpressOptionsObject.fieldValidation );
	
		// Collect data from inputs
		var reg_login_nonce = $('#pm_ln_quick_login_nonce').val();
		var reg_quickuser  = $('#pm_quick_username').val();
		var reg_quickpass  = $('#pm_quick_password').val();
		var $closeTag = "<i class='typcn typcn-times' id='pm-quick-message-close'></i>";
		var $cancelTag = "<i class='typcn typcn-cancel' id='pm-quick-message-close'></i>";
		var reg_login_form_security_question = $('#pm_login_form_security_question').val();
		var reg_login_form_security_answer = $('#pm_login_form_security_answer').val();
	
		/**
		 * AJAX URL where to send data 
		 * (from localize_script)
		 */
		var ajax_url = pm_ln_register_vars.pm_ln_ajax_url;
		console.log('ajax_url = ' + ajax_url);
	
		//Data to send
		data = {
		  action: 'validate_quick_login',
		  nonce: reg_login_nonce,
		  quickuser: reg_quickuser,
		  quickpass: reg_quickpass,
		  login_form_security_question: reg_login_form_security_question,
		  login_form_security_answer: reg_login_form_security_answer
		};
	
		// Do AJAX request
		$.post( ajax_url, data, function(response) {
	
		  // If we have response
		  if( response ) {
			  			  
			if( response === 'username_error' ){
				
				$('#pm-quick-message').html(wordpressOptionsObject.loginMessageUsername);
				$('#pm_quick_username').addClass('invalid_field');
			  
			} else if( response === 'password_error' ){
				
				$('#pm-quick-message').html(wordpressOptionsObject.loginMessagePassword);
				$('#pm_quick_password').addClass('invalid_field');
				
			} else if( response === 'security_error' ){
				
			  	$('#pm-quick-message').html(wordpressOptionsObject.securityError);
				$('#pm_login_form_security_answer').addClass('invalid_field');
			
			} else if( response === 'login_success' ){

				$('#pm-quick-message').html(wordpressOptionsObject.loginMessageSuccess);
				
				$('#btn-quick-login').fadeOut(700);
				$('#forgot-password-btn').fadeOut(700);
			  
			    setTimeout(function(){
				   //window.location.replace('http://dev.pulsarmedia.ca/forums');
				   location.reload(); 
			    }, 4000);	
			  
			} else if( response === 'login_failed' ){ //system error notice

				$('#pm-quick-message').html(wordpressOptionsObject.failedMessage);
				
			  
			} else if( response === 'credentials_failed' ){ //bad credentials
				
				$('#pm-quick-message').html(wordpressOptionsObject.loginMessageInvalid);
								
			} else {
				
			  //do nothing
			  
			}
		  }
		});
		
	  });
	});
	
	var methods = {
	
		resetMessage : function(e) {
						
			var $message = $('#pm-quick-message');
			
			setTimeout(function(){
			   
			   $message.css({
					'right' : hidePercent
			   });
			   
		    }, 4000);	
			
			
		},
				
		
	};

	
})(jQuery);

