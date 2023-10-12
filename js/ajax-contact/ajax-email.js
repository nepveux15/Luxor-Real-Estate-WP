(function($) {

	$('#pm_s_first_name').focus(function(e) {
		$(this).removeClass('invalid_field');
	});
	
	$('#pm_s_last_name').focus(function(e) {
		$(this).removeClass('invalid_field');
	});
	
	$('#pm_s_email_address').focus(function(e) {
		$(this).removeClass('invalid_field');
	});

	$('#pm_s_message').focus(function(e) {
		$(this).removeClass('invalid_field');
	});
	
	$('#pm_contact_form_security_question').focus(function(e) {
		$(this).removeClass('invalid_field');
	});
	
	
	$('#pm-contact-form-btn').on('click', function(e) {
							
		e.preventDefault();
								
		//var $this = $(this);
		
		$('#pm-contact-form-response').html(wordpressOptionsObject.fieldValidation);
		
		// Collect data from inputs
		var reg_nonce = $('#pm_ln_send_contact_nonce').val();
		var reg_first_name = $('#pm_s_first_name').val();
		var reg_last_name = $('#pm_s_last_name').val();
		var reg_email_address =  $('#pm_s_email_address').val();
		var reg_phone_number =  $('#pm_s_phone_number').val();
		var reg_message =  $('#pm_s_message').val();
		var reg_recipient_email =  $('#pm_s_email_address_contact').val();
		var reg_contact_form_security_question = $('#pm_contact_form_security_question').val();
		var reg_contact_form_security_answer = $('#pm_contact_form_security_answer').val();
		
		var reg_consent_box = 'null';
		
		if($('#pm_contact_consent_box').length > 0) {
			reg_consent_box = $('#pm_contact_consent_box').attr('checked') ? 'checked' : 'unchecked';
		}
				
		/**
		 * AJAX URL where to send data 
		 * (from localize_script)
		 */
		var ajax_url = pm_ln_register_vars.pm_ln_ajax_url;
	
		// Data to send
		
		var data = {
		  action: 'send_contact_form',
		  nonce: reg_nonce,
		  first_name: reg_first_name,
		  last_name: reg_last_name,
		  email_address: reg_email_address,
		  phone_number: reg_phone_number,
		  message: reg_message,
		  recipient: reg_recipient_email,
		  contact_form_security_question: reg_contact_form_security_question,
		  contact_form_security_answer: reg_contact_form_security_answer,
		  consent: reg_consent_box
		};	
				
		
		// Do AJAX request
		$.post( ajax_url, data, function(response) {
	
		  // If we have response
		  if(response) {
			  			  				
			if(response === 'first_name_error') {
			  
				$('#pm-contact-form-response').html(wordpressOptionsObject.contactForm1);
				$('#pm_s_first_name').addClass('invalid_field');
			  
			} else if( response === 'last_name_error' ){
				
			    $('#pm-contact-form-response').html(wordpressOptionsObject.contactForm2);
				$('#pm_s_last_name').addClass('invalid_field');
			
			} else if( response === 'email_error' ){
				
			    $('#pm-contact-form-response').html(wordpressOptionsObject.contactForm3);
				$('#pm_s_email_address').addClass('invalid_field');

			} else if( response === 'message_error' ){
				
			  	$('#pm-contact-form-response').html(wordpressOptionsObject.contactForm4);
				$('#pm_s_message').addClass('invalid_field');
				
			} else if( response === 'consent_error' ){
				
			  	$('#pm-contact-form-response').html(wordpressOptionsObject.consentError);
				
			} else if( response === 'security_error' ){
				
			  	$('#pm-contact-form-response').html(wordpressOptionsObject.securityError);
				$('#pm_contact_form_security_question').addClass('invalid_field');

			}  else if( response === 'success' ){
				
			  	$('#pm-contact-form-response').html(wordpressOptionsObject.successMessage);
				$('#pm-contact-form-btn').fadeOut();
			  
			} else if( response === 'failed' ){
				
				$('#pm-contact-form-response').html(wordpressOptionsObject.failedMessage);
				$('#pm-contact-form-btn').fadeOut();
				
			} else {
			  $('.result-message').html( response );
			  $('.result-message').show();
			}
		  }
		});
		
		
	});
	
})(jQuery);