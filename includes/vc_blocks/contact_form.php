<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_contact_form extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"recipient_email" => 'info@microthemes.ca',
			"text_color" => '#FFF',
			"response_color" => '#7F6631',
			"message" => 'Fields marked with * are required',
			"consent_checkbox" => 'off'
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm-contact-form-container">
        
			<?php if($message !== '') { ?>
				<p class="pm-required contact pm-center" style="color:<?php esc_attr_e($text_color); ?>;"><?php esc_attr_e($message); ?></p><br />
			<?php } ?>
            
			<form action="#" method="post" id="pm-contact-form">
				<div class="col-lg-6 col-md-6 col-sm-12">
					<input name="pm_s_first_name" id="pm_s_first_name" class="pm-form-textfield" type="text" placeholder="<?php esc_html_e('First Name *', 'luxortheme'); ?>">
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12">
					<input name="pm_s_last_name" id="pm_s_last_name" class="pm-form-textfield" type="text" placeholder="<?php esc_html_e('Last Name *', 'luxortheme'); ?>">
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12">
					<input name="pm_s_email_address" id="pm_s_email_address" class="pm-form-textfield" type="text" placeholder="<?php esc_html_e('Email Address *', 'luxortheme'); ?>">
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12">
					<input name="pm_s_phone_number" id="pm_s_phone_number" class="pm-form-textfield" type="tel" placeholder="<?php esc_html_e('Phone Number', 'luxortheme'); ?>">
				</div>
				<div class="col-lg-12 pm-clear-element">
					<textarea name="pm_s_message" id="pm_s_message" class="pm-form-textarea" cols="50" rows="10" placeholder="<?php esc_html_e('Message *', 'luxortheme'); ?>"></textarea>
				</div>
                
                <?php if($consent_checkbox === 'on') : ?>
                    
                    <div class="form-group pm-center">
                        <input type="checkbox" name="pm_contact_consent_box" id="pm_contact_consent_box" />
                        <?php echo $content ?>
                    </div>
                
                <?php endif; ?>
                
				<div class="col-lg-12 pm-clear-element">
					 
                    <?php
						$randNum1 = rand(5, 15);
						$randNum2 = rand(5, 15);
					?>
					
					<p class="pm-form-security-question pm-center" style="color:<?php esc_attr_e($text_color); ?>;"><?php esc_attr_e('Security question', 'luxortheme') ?> </p>
					<div class="form-group security-question-property-post">		
						<p class="pm-form-security-question-input" style="color:<?php esc_attr_e($text_color); ?>;"><strong><?php esc_attr_e($randNum1) ?></strong> + <strong><?php esc_attr_e($randNum2) ?></strong> = <input type="text" maxlength="2" class="pm-form-textfield security-field property-post" name="pm_contact_form_security_question" id="pm_contact_form_security_question" /></p>
					</div>
				
					<input type="hidden" value="<?php echo ($randNum1 + $randNum2) ?>" id="pm_contact_form_security_answer" name="pm_contact_form_security_answer">
				</div>
												
				<div class="col-lg-12 pm-center" style="margin-top:0px">
					
					<input type="button" value="<?php esc_html_e('Submit Form', 'luxortheme') ?>" name="pm-form-submit-btn" class="pm-form-submit-btn" id="pm-contact-form-btn" style="margin-top:0px">
					<div id="pm-contact-form-response" style="color:<?php esc_attr_e($response_color); ?>;"></div>	
				</div>
				<input type="hidden" name="pm_s_email_address_contact" id="pm_s_email_address_contact" value="<?php esc_attr_e($recipient_email); ?>" />
				
				<?php wp_nonce_field('pm_ln_nonce_action','pm_ln_send_contact_nonce'); ?>
				
			</form>
		</div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_contact_form",
    "name"      => __("Contact Form", 'luxortheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Luxor Shortcodes", 'luxortheme'),
    "params"    => array(

		array(
            "type" => "textfield",
            "heading" => __("Recipient email address", 'luxortheme'),
            "param_name" => "recipient_email",
            //"description" => __("Enter a CSS class if required.", 'luxortheme'),
			"value" => 'info@microthemes.ca'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Text Color", 'luxortheme'),
            "param_name" => "text_color",
            //"description" => __("Enter a CSS class if required.", 'luxortheme'),
			"value" => '#ffffff'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Response Color", 'luxortheme'),
            "param_name" => "response_color",
            //"description" => __("Enter a CSS class if required.", 'luxortheme'),
			"value" => '#7F6631'
        ),
		
		array(
            "type" => "textarea",
            "heading" => __("Message", 'luxortheme'),
            "param_name" => "message",
            //"description" => __("Enter a CSS class if required.", 'luxortheme'),
			"value" => 'Fields marked with * are required'
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Consent Checkbox", 'energytheme'),
            "param_name" => "consent_checkbox",
            //"description" => __("Choose the divider style you desire.", 'energytheme'),
			"value" => array( 'off' => 'off', 'on' => 'on' ),
        ),
		
		array(
            "type" => "textarea_html",
            "heading" => __("Consent Message", 'energytheme'),
            "param_name" => "content",
            //"description" => __("Enter a short description for your service.", 'energytheme')
        ),

    )

));