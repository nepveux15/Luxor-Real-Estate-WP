(function($) {
	
	$('#pm_s_full_name').focus(function(e) {
		$(this).removeClass('invalid_field');
	});
	
	$('#pm_s_email_address').focus(function(e) {
		$(this).removeClass('invalid_field');
	});
	
	$('#pm_s_message').focus(function(e) {
		$(this).removeClass('invalid_field');
	});
	
	$('#pm_property_form_security_question').focus(function(e) {
		$(this).removeClass('invalid_field');
	});
	

	$('#pm-agent-property-contact-form-btn').on('click', function(e) {
							
		e.preventDefault();
								
		//var $this = $(this);
		
		$('#pm-property-agent-form-response').html(wordpressOptionsObject.fieldValidation);
		
		// Collect data from inputs
		var reg_nonce = $('#pm_ln_send_agent_form_nonce').val();
		var reg_full_name = $('#pm_s_full_name').val();
		var reg_email_address =  $('#pm_s_email_address').val();
		var reg_message =  $('#pm_s_message').val();
		var reg_recipient_email =  $('#pm_s_email_address_contact').val();
		var reg_property_title =  $('#pm_property_title').val();
		var reg_property_id =  $('#pm_property_id').val();
		var reg_pm_s_phone_number = $('#pm_s_phone_number').val();
		
		var reg_property_form_security_question = $('#pm_property_form_security_question').val();
		var reg_property_form_security_answer = $('#pm_property_form_security_answer').val();
		
		var reg_consent_box = 'null';
		
		if($('#pm_agent_property_consent_box').length > 0) {
			reg_consent_box = $('#pm_agent_property_consent_box').attr('checked') ? 'checked' : 'unchecked';
		}
		

		/**
		 * AJAX URL where to send data 
		 * (from localize_script)
		 */
		var ajax_url = pm_ln_register_vars.pm_ln_ajax_url;
	
		// Data to send
		
		var data = {
		  action: 'send_property_agent_form',
		  nonce: reg_nonce,
		  full_name: reg_full_name,
		  email_address: reg_email_address,
		  message: reg_message,
		  recipient: reg_recipient_email,
		  property_title: reg_property_title,
		  property_id: reg_property_id,
		  property_form_security_question: reg_property_form_security_question,
		  property_form_security_answer: reg_property_form_security_answer,
		  pm_s_phone_number: reg_pm_s_phone_number,
		  consent: reg_consent_box
		};	
				
		
		// Do AJAX request
		$.post( ajax_url, data, function(response) {
	
		  // If we have response
		  if(response) {
			  			  				
			if(response === 'full_name_error') {
			  
				$('#pm-property-agent-form-response').html(wordpressOptionsObject.contactForm1);
				$('#pm_s_full_name').addClass('invalid_field');

			} else if( response === 'email_error' ){
				
			    $('#pm-property-agent-form-response').html(wordpressOptionsObject.contactForm3);
				$('#pm_s_email_address').addClass('invalid_field');

			} else if( response === 'message_error' ){
				
			  	$('#pm-property-agent-form-response').html(wordpressOptionsObject.contactForm4);
				$('#pm_s_message').addClass('invalid_field');
				
			} else if( response === 'consent_error' ){
				
			  	$('#pm-property-agent-form-response').html(wordpressOptionsObject.consentError);
				
			} else if( response === 'security_error' ){
				
			  	$('#pm-property-agent-form-response').html(wordpressOptionsObject.securityError);
				$('#pm_property_form_security_question').addClass('invalid_field');

			}  else if( response === 'success' ){
				
			  	$('#pm-property-agent-form-response').html(wordpressOptionsObject.successMessage);
				$('#pm-agent-property-contact-form-btn').fadeOut();
			  
			} else if( response === 'failed' ){
				
				$('#pm-property-agent-form-response').html(wordpressOptionsObject.failedMessage);
				$('#pm-agent-property-contact-form-btn').fadeOut();
				
			} else {
			  $('.result-message').html( response );
			  $('.result-message').show();
			}
		  }
		});
		
		
	});
	
})(jQuery);