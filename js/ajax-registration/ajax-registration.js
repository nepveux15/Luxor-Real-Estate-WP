(function($) {

	$(document).ready(function(e) {

	  /**
	   * When user clicks on button - retrieve data from form and send request to WordPres
	   *
	   */
	  $('#pm-register-account-btn').click( function(e) {
		  		  	
		
		e.preventDefault();
		
		var $this = $(this);
		
		$('.result-message').html( wordpressOptionsObject.fieldValidation );
	
		// Collect data from inputs
		var reg_nonce = $('#pm_ln_new_user_nonce').val();
		var reg_user_first_name = $('#pm_user_first_name').val();
		var reg_user_last_name = $('#pm_user_last_name').val();
		var reg_mail = $('#pm_user_email').val();
		var reg_pass = $('#pm_user_password').val();
		var reg_username = $('#pm_username').val();
		var reg_confirm_pass = $('#pm_user_confirm_password').val();
		var reg_security_answer_input = $('#pm_form_security_question').val();
		var reg_security_answer_validate = $('#pm_form_security_answer').val();

	
		/**
		 * AJAX URL where to send data 
		 * (from localize_script)
		 */
		var ajax_url = pm_ln_register_vars.pm_ln_ajax_url;
	
		// Data to send
		data = {
		  action: 'register_user',
		  nonce: reg_nonce,
		  firstName: reg_user_first_name,
		  lastName: reg_user_last_name,
		  mail: reg_mail,
		  username: reg_username,
		  pass: reg_pass,
		  confirmPass: reg_confirm_pass,	
		  security_answer_input: reg_security_answer_input,
		  security_answer_validate: reg_security_answer_validate
		};
	
		// Do AJAX request
		$.post( ajax_url, data, function(response) {
	
		  // If we have response
		  if(response) {
			  				
			if(response === 'first_name_error') {
			  
			  $('.result-message').html(wordpressOptionsObject.reg1);
			  
			  $('#pm_user_first_name').addClass('invalid_field');
			  $('#pm_user_first_name').focus(function(e) {
				$(this).removeClass('invalid_field');
			  });
			  
			} else if( response === 'last_name_error' ){
				
			  $('.result-message').html(wordpressOptionsObject.reg2);
			  $('.result-message').show();
			  
			  $('#pm_user_last_name').addClass('invalid_field');
			  $('#pm_user_last_name').focus(function(e) {
				$(this).removeClass('invalid_field');
			  });  
			
			  
			} else if( response === 'email_error' ){
				
			  $('.result-message').html(wordpressOptionsObject.reg3);
			  $('.result-message').show();
			  
			  $('#pm_user_email').addClass('invalid_field');
			  $('#pm_user_email').focus(function(e) {
				$(this).removeClass('invalid_field');
			  });
			  
			} else if( response === 'username_error' ){
				
			  $('.result-message').html(wordpressOptionsObject.reg8);
			  $('.result-message').show();
			  
			  $('#pm_username').addClass('invalid_field');
			  $('#pm_username').focus(function(e) {
				$(this).removeClass('invalid_field');
			  });
			  
			} else if( response === 'password_error' ){
				
			  $('.result-message').html(wordpressOptionsObject.reg4);
			  $('.result-message').show();
			  
			  $('#pm_user_password').addClass('invalid_field');
			  $('#pm_user_password').focus(function(e) {
				$(this).removeClass('invalid_field');
			  });
			  
			} else if( response === 'confirm_password_error' ){
				
			  $('.result-message').html(wordpressOptionsObject.reg5);
			  $('.result-message').show();
			  
			  $('#pm_user_confirm_password').addClass('invalid_field');
			  $('#pm_user_confirm_password').focus(function(e) {
				$(this).removeClass('invalid_field');
			  });
			  
			} else if( response === 'security_error' ){
				
			  $('.result-message').html(wordpressOptionsObject.securityError);
			  $('.result-message').show();
			  
			  
			}  else if( response === 'success' ){
				
			  $('.result-message').html(wordpressOptionsObject.reg6);
			  $('#btn-new-user').fadeOut(700);
			  $('.result-message').show();
			  $('#pm-register-account-btn').fadeOut(700);
			  
			} else if( response === 'form_error' ){
				
			  $('.result-message').html(wordpressOptionsObject.reg7);
			  $('.result-message').show();
				
			} else {
			  $('.result-message').html( response );
			  $('.result-message').show();
			}
		  }
		});
		
	  });
	});
	

	
})(jQuery);

