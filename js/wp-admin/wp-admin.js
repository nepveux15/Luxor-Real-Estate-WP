// JavaScript Document

(function($) {
	
	$(window).load(function(e) {
		
		if( $('.redux-notice').length > 0 ){
			
			$('.redux-notice').css({
				'display' : 'none',
				'visibility' : 'hidden'	
			});
				
		}
		
		
	});
	
	$(document).ready(function(e) {		
		
		//Author profile image uploader
		var author_image_uploader,
			author_background_uploader;
		
		$('#user-avatar-image').on('click', function(e) {
											
			 e.preventDefault();

			 //If the uploader object has already been created, reopen the dialog
			 if (author_image_uploader) {
				 author_image_uploader.open();
				 return;
			 }
			 
			 //Extend the wp.media object
			 author_image_uploader = wp.media.frames.file_frame = wp.media({
				title: 'Choose Image',
				button: {
					text: 'Choose Image'
				},
				 multiple: false
			 });	
			 
			 //When a file is selected, grab the URL and set it as the text field's value
			 author_image_uploader.on('select', function() {
									 
				var attachment = author_image_uploader.state().get('selection').first().toJSON();
				var url = '';
				url = attachment['url'];
									
				$('#user_avatar').val(url);
				$('.pm-elite-member-logo-preview').html('<img src="'+ url +'" />');
	
			 });
			 
			 //Finally, open the modal on click
			 author_image_uploader.open();
			
		});	


		
		
		$('#user-background-image').on('click', function(e) {
											
			 e.preventDefault();

			 //If the uploader object has already been created, reopen the dialog
			 if (author_background_uploader) {
				 author_background_uploader.open();
				 return;
			 }
			 
			 //Extend the wp.media object
			 author_background_uploader = wp.media.frames.file_frame = wp.media({
				title: 'Choose Image',
				button: {
					text: 'Choose Image'
				},
				 multiple: false
			 });	
			 
			 //When a file is selected, grab the URL and set it as the text field's value
			 author_background_uploader.on('select', function() {
									 
				var attachment = author_background_uploader.state().get('selection').first().toJSON();
				var url = '';
				url = attachment['url'];
									
				$('#user_background_image').val(url);
				$('.pm-user-admin-image-preview-container').html('<img src="'+ url +'" />');
	
			 });
			 
			 //Finally, open the modal on click
			 author_background_uploader.open();
			
		});	
		
		
		
		
		
		        
		//Header image preview
		if( $('.pm-admin-upload-field').length > 0 ){
	
			var value = $('.pm-admin-upload-field').val();
			
			if (value !== '') {
				
				$('.pm-admin-upload-field-preview').html('<img src="'+ value +'" />');
				
			}
	
		}
		
		//Featured Post image preview
		if( $('.pm-featured-image-upload-field').length > 0 ){
	
			var value = $('.pm-featured-image-upload-field').val();
			
			if (value !== '') {
				
				$('.pm-featured-image-preview').html('<img src="'+ value +'" />');
				
			}
	
		}
		
		//Staff image preview
		if( $('.pm-admin-upload-field').length > 0 ){
	
			var value = $('.pm-admin-upload-field').val();
			
			if (value !== '') {
				
				$('.pm-admin-upload-staff-preview').html('<img src="'+ value +'" />');
				
			}
	
		}
		
		//Gallery image preview
		if( $('.featured-img-uploader-field').length > 0 ){
	
			var value = $('.featured-img-uploader-field').val();
			
			if (value !== '') {
				
				$('.pm-admin-gallery-image-preview').html('<img src="'+ value +'" />');
				
			}
	
		}
		
		//Remove page header button
		if( $('#remove_page_header_button').length > 0 ){
	
			$('#remove_page_header_button').click(function(e) {
				
				$('#img-uploader-field').val('');
				$('.pm-admin-upload-field-preview').empty();
				
			});
	
		}
		
		//Remove woocomm header image
		if( $('#remove_woocom_header_image_button').length > 0 ){
	
			$('#remove_woocom_header_image_button').click(function(e) {
				
				$('#img-uploader-field').val('');
				$('.pm-admin-upload-field-preview').empty();
				
			});
	
		}		
		
		
		//Remove gallery image button
		if( $('#remove_gallery_image_button').length > 0 ){
	
			$('#remove_gallery_image_button').click(function(e) {
				
				$('#featured-img-uploader-field').val('');
				$('.pm-admin-gallery-image-preview').empty();
				
			});
	
		}

		//Remove staff image button
		if( $('#remove_staff_image_button').length > 0 ){
	
			$('#remove_staff_image_button').click(function(e) {
				
				$('#img-uploader-field').val('');
				$('.pm-admin-upload-staff-preview').empty();
				
			});
	
		}
				
		//Datepicker
		$( "#datepicker" ).datepicker();
		
		//Theme verification - marketplace selection
		if( $('#pm_ln_verify_marketplace_selection').length > 0 ){
	
			$('#pm_ln_verify_marketplace_selection').on('change', function(e) {		
			
				
				var val = $(this).val();
				
				if(val === 'themeforest'){
					
					$('#pm_ln_micro_themes_purchase_code_themeforest').addClass('active');
					$('#pm_ln_micro_themes_purchase_code_mojo').removeClass('active');		
									
					
				} else if(val === 'mojo') {
					
					$('#pm_ln_micro_themes_purchase_code_mojo').addClass('active');	
					$('#pm_ln_micro_themes_purchase_code_themeforest').removeClass('active');			
							
				} else {
					
					$('#pm_ln_micro_themes_purchase_code_themeforest').removeClass('active');
					$('#pm_ln_micro_themes_purchase_code_mojo').removeClass('active');	
						
				}
				
			});
	
		}
		
		
    });
	
})(jQuery);