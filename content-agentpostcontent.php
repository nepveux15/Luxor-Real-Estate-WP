<?php
/**
 * The default template for displaying an agent post.
 */
?>

<?php       

	$enableTooltip = get_theme_mod('enableTooltip', 'on');
	
	$pm_agent_image_meta = get_post_meta(get_the_ID(), 'pm_agent_image_meta', true);
	$pm_agent_stat1_meta = get_post_meta(get_the_ID(), 'pm_agent_stat1_meta', true);
	$pm_agent_stat2_meta = get_post_meta(get_the_ID(), 'pm_agent_stat2_meta', true);
	$pm_agent_twitter_meta = get_post_meta(get_the_ID(), 'pm_agent_twitter_meta', true);
	$pm_agent_facebook_meta = get_post_meta(get_the_ID(), 'pm_agent_facebook_meta', true);
	$pm_agent_gplus_meta = get_post_meta(get_the_ID(), 'pm_agent_gplus_meta', true);
	$pm_agent_linkedin_meta = get_post_meta(get_the_ID(), 'pm_agent_linkedin_meta', true);
	$pm_agent_email_address_meta = get_post_meta(get_the_ID(), 'pm_agent_email_address_meta', true);
	$pm_agent_business_phone_meta = get_post_meta(get_the_ID(), 'pm_agent_business_phone_meta', true);
	$pm_agent_mobile_phone_meta = get_post_meta(get_the_ID(), 'pm_agent_mobile_phone_meta', true);
	$pm_agent_skype_meta = get_post_meta(get_the_ID(), 'pm_agent_skype_meta', true);
	
	$pm_agent_specialties_meta = get_post_meta(get_the_ID(), 'pm_agent_specialties_meta', true);
	$pm_agent_contact_form_meta = get_post_meta(get_the_ID(), 'pm_agent_contact_form_meta', true);
	
	$pm_agent_account_id_meta = get_post_meta(get_the_ID(), 'pm_agent_account_id_meta', true);
	
	$allowed_html = array(
		'a' => array(
			'href' => array(),
			'title' => array()
		),
		'br' => array(),
		'em' => array(),
		'strong' => array(),
		'h6' => array(),
		'p' => array(),
		'span' => array(),
	);
	
?>

<div class="container pm-containerPadding-top-120 pm-containerPadding-bottom-100">
        
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            
            <div class="pm-staff-profile-container">
                
                <p class="pm-staff-profile-name"><?php the_title(); ?></p>
                    
                <div class="pm-staff-profile-img-container">
                    <span class="overlay"></span>
                    <div class="pm-staff-profile-img-container-info">
                        <p><?php echo wp_kses($pm_agent_stat1_meta, $allowed_html); ?></p>
                        <p><?php echo wp_kses($pm_agent_stat2_meta, $allowed_html); ?></p>
                    </div>
                    <a href="#" class="pm-staff-profile-img-container-btn"><i class="fa fa-chevron-up"></i></a>
                    <img src="<?php echo esc_attr($pm_agent_image_meta); ?>" width="217" height="217" alt="<?php the_title(); ?>"/>
                </div>
                
                <div class="pm-staff-profile-img-border">
                    <div class="pm-staff-profile-img-border-endpoint left"></div>
                    <div class="pm-staff-profile-img-border-endpoint right"></div>
                </div>
                
                <ul class="pm-staff-profile-contact-list">
                	<?php if($pm_agent_mobile_phone_meta !== '') : ?>
                    	<li><i class="fa fa-mobile mobile-icon"></i><?php esc_html_e('Mobile','luxortheme'); ?> <span><?php echo esc_attr($pm_agent_mobile_phone_meta); ?></span></li>
                    <?php endif; ?>
                    <?php if($pm_agent_business_phone_meta !== '') : ?>
                    	<li><i class="fa fa-phone phone-icon"></i><?php esc_html_e('Phone','luxortheme'); ?> <span><?php echo esc_attr($pm_agent_business_phone_meta); ?></span></li>
                    <?php endif; ?>
                    <?php if($pm_agent_skype_meta !== '') : ?>
                    	<li><i class="fa fa-skype skype-icon"></i><?php esc_html_e('Skype','luxortheme'); ?> <span><a href="skype:<?php echo esc_attr($pm_agent_skype_meta); ?>?call"><?php echo esc_attr($pm_agent_skype_meta); ?></a></span></li> 
                    <?php endif; ?>                    
                </ul>
                                        
                <ul class="pm-staff-profile-social-list single">
                
                    <?php if($pm_agent_twitter_meta !== '') : ?>
            
                        <li <?php echo esc_attr($enableTooltip) === 'on' ? 'class="pm_tip_static_top pm_tip_arrow_bottom" title="'.esc_html__('Twitter','luxortheme').'" data-tip-offset-x="23" data-tip-offset-y="5"' : '' ?>><a href="<?php echo esc_html($pm_agent_twitter_meta); ?>" class="fa fa-twitter" target="_blank"></a></li>
                    
                    <?php endif; ?>
                    
                    <?php if($pm_agent_facebook_meta !== '') : ?>
                    
                        <li <?php echo esc_attr($enableTooltip) === 'on' ? 'class="pm_tip_static_top pm_tip_arrow_bottom" title="'.esc_html__('Facebook','luxortheme').'" data-tip-offset-x="23" data-tip-offset-y="5"' : '' ?>><a href="<?php echo esc_html($pm_agent_facebook_meta); ?>" class="fa fa-facebook" target="_blank"></a></li>
                    
                    <?php endif; ?>
                    
                    <?php if($pm_agent_gplus_meta !== '') : ?>
                    
                        <li <?php echo esc_attr($enableTooltip) === 'on' ? 'class="pm_tip_static_top pm_tip_arrow_bottom" title="'.esc_html__('Linkedin','luxortheme').'" data-tip-offset-x="23" data-tip-offset-y="5"' : '' ?>><a href="<?php echo esc_html($pm_agent_gplus_meta); ?>" class="fa fa-linkedin" target="_blank"></a></li>
                    
                    <?php endif; ?>
                    
                    <?php if($pm_agent_linkedin_meta !== '') : ?>
                    
                        <li <?php echo esc_attr($enableTooltip) === 'on' ? 'class="pm_tip_static_top pm_tip_arrow_bottom" title="'.esc_html__('Google Plus','luxortheme').'" data-tip-offset-x="23" data-tip-offset-y="5"' : '' ?>><a href="<?php echo esc_html($pm_agent_linkedin_meta); ?>" class="fa fa-google-plus" target="_blank"></a></li>
                    
                    <?php endif; ?>
                    
                    <?php if($pm_agent_email_address_meta !== '') : ?>
                    
                        <li <?php echo esc_attr($enableTooltip) === 'on' ? 'class="pm_tip_static_top pm_tip_arrow_bottom" title="'.esc_html__('Email me!','luxortheme').'" data-tip-offset-x="23" data-tip-offset-y="5"' : '' ?>><a href="mailto:<?php echo esc_attr($pm_agent_email_address_meta); ?>" class="fa fa-envelope"></a></li>
                    
                    <?php endif; ?> 
                    
                </ul>
                
            </div><!-- /.pm-staff-profile-container -->
            
            <?php 
                    
				$name = get_the_title();
				$first_name = explode(" ", $name);
			
			?>
            
            <?php if($pm_agent_account_id_meta !== '') : ?>
            
            	<div class="pm-staff-profile-recent-properties-container">
                    
                    <p class="pm-staff-profile-column-title"><?php esc_html_e('Recent Properties listed by','luxortheme'); ?> <?php echo esc_attr($first_name[0]); ?></p>
                    
                    <?php 
                        
                        $args = array(
                            'author' => esc_attr($pm_agent_account_id_meta),
                            'post_type' => 'post_properties',
                            'posts_per_page' => 3
                        );
                        
                        $author_posts = new WP_Query( $args );
                        
                        pm_ln_set_query($author_posts);
                                        
                    ?>
                    <ul class="pm-featured-properties-list">
                    <?php if ($author_posts->have_posts()) : while ($author_posts->have_posts()) : $author_posts->the_post(); ?>
                    
                    <?php 
    
                        $pm_properties_thumb_image_meta = get_post_meta(get_the_ID(), 'pm_properties_thumb_image_meta', true);
                        $pm_properties_type_meta = get_post_meta(get_the_ID(), 'pm_properties_type_meta', true);
						$pm_properties_rental_type_meta = get_post_meta(get_the_ID(), 'pm_properties_rental_type_meta', true);
                        $pm_properties_size_meta = get_post_meta(get_the_ID(), 'pm_properties_size_meta', true);
                        $pm_properties_status_meta = get_post_meta(get_the_ID(), 'pm_properties_status_meta', true);
                        $pm_properties_price_meta = get_post_meta(get_the_ID(), 'pm_properties_price_meta', true);	
						
						if( $pm_properties_price_meta !== '' ){
							$formattedPrice = number_format($pm_properties_price_meta);
						} else {
							$formattedPrice = 0;	
						}
									
						$currencySymbol = get_theme_mod('currencySymbol', '$');
						$currenySymbolPosition = get_theme_mod('currenySymbolPosition', 'left');
                        
                    ?>
                        
                        <!-- Post -->
                        <li>
                            
                            <div class="pm-featured-properties-list-thumb" style="background-image:url(<?php echo esc_html($pm_properties_thumb_image_meta); ?>);">
                            
                            	<div class="pm-property-listing-ribbon"><?php echo esc_attr($pm_properties_status_meta) ?></div>
        						<div class="pm-property-listing-ribbon-shadow"></div>
                            
                                <a class="fa fa-bars" href="<?php the_permalink(); ?>"></a>
                            </div>
                            <div class="pm-featured-properties-details">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                
                                <?php 
																		
									$term_value = get_term( $pm_properties_type_meta, 'propertysaletypes' );
									//echo '$pm_properties_type_meta = ' . $pm_properties_type_meta;
								
								?>
                                
                                <p class="price"> <?php echo esc_attr(ucfirst($term_value->name)); ?> &bull; <?php echo ($currenySymbolPosition == 'left' ? $currencySymbol . esc_attr($formattedPrice) : esc_attr($formattedPrice) . $currencySymbol); ?><?php echo esc_attr($pm_properties_rental_type_meta) === 'default' ? '' : '/'.esc_attr($pm_properties_rental_type_meta).'' ?></p>
                                <p class="footage"><?php echo esc_attr($pm_properties_size_meta); ?></p>
                            </div>
                        </li>
                        <!-- Post end -->
                                        
                    <?php endwhile; else: ?>
                    <?php endif; ?>
                    </ul>
                
                    <?php pm_ln_restore_query(); ?> 
                
                </div> 
            
            <?php endif; ?>
                             
            
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12">
            
            <?php the_content(); ?>
            
            <br />
            
            <?php if($pm_agent_specialties_meta !== '') : ?>
            
            	<p class="pm-fancy-title pm-fancy secondary">
                    <i class="pm-fancy-title-endpoint left"></i>
                        <span><?php esc_html_e('Specialties','luxortheme'); ?></span>
                    <i class="pm-fancy-title-endpoint right"></i>
                </p>
                            
                <ul>
                <?php 
				
					$agentSpecialties = explode(",", $pm_agent_specialties_meta);
					
					foreach($agentSpecialties as $specialty) {
						echo '<li>'.$specialty.'</li>';	
					}
					
				?>
                </ul>
                
                <br />
            
            <?php endif; ?>

			<?php if($pm_agent_contact_form_meta === 'on') : ?>
            
            	<?php 
					
					$consent_checkbox = get_theme_mod('displayConsentCheckbox', 'off');
					$consentMessage = get_theme_mod('consentMessage');
				
				?>
            
            	<p class="pm-fancy-title pm-fancy secondary">
                    <i class="pm-fancy-title-endpoint left"></i>
                        <span><?php esc_html_e('Contact','luxortheme'); ?> <?php echo esc_attr($first_name[0]); ?></span>
                    <i class="pm-fancy-title-endpoint right"></i>
                </p>
                
                <br />
                
                <!-- Contact form -->
                <div class="row">
            
                    <div class="pm-contact-form-container">
                        <form id="pm-agent-contact-form" method="post" action="#">
                        
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <input type="text" placeholder="<?php esc_html_e('First Name','luxortheme'); ?> *" class="pm-form-textfield" id="pm_s_first_name" name="pm_s_first_name">
                            </div>
                            
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <input type="text" placeholder="<?php esc_html_e('Last Name','luxortheme'); ?> *" class="pm-form-textfield" id="pm_s_last_name" name="pm_s_last_name">
                            </div>
                            
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <input type="text" placeholder="<?php esc_html_e('Email Address','luxortheme'); ?> *" class="pm-form-textfield" id="pm_s_email_address" name="pm_s_email_address">
                            </div>
                            
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <input type="tel" placeholder="<?php esc_html_e('Phone Number','luxortheme'); ?>" class="pm-form-textfield" name="pm_s_phone_number" id="pm_s_phone_number">
                            </div>
                            
                            <div class="col-lg-12 pm-clear-element">
                                <textarea placeholder="<?php esc_html_e('Message','luxortheme'); ?> *" rows="5" cols="50" class="pm-form-textarea" name="pm_s_message" id="pm_s_message"></textarea>
                            </div>
                            
                            <?php if($consent_checkbox === 'on') : ?>
                    
                                <div class="col-lg-12 pm-containerPadding-top-30">
                                    <div class="form-group pm-center">
                                        <input type="checkbox" name="pm_agent_profile_consent_box" id="pm_agent_profile_consent_box" />
                                        <?php echo $consentMessage ?>
                                    </div>
                                </div>
                            
                            <?php endif; ?> 
                            
                            
                            <div class="col-lg-12 pm-clear-element">
                                    
                                <br>
                            
                                <!-- Security question goes here -->  
                                <?php 
                                    $randNum1 = rand(5, 15);
                                    $randNum2 = rand(5, 15);
                                ?>
                                
                                <p class="pm-center"><?php esc_attr_e('Security question', 'luxortheme') ?>: </p>
                                <div class="form-group security-question-property-post">		
                                    <p><strong><?php echo esc_attr($randNum1); ?></strong> + <strong><?php echo  esc_attr($randNum2); ?></strong> = <input type="text" maxlength="2" class="pm-form-textfield security-field property-post" name="pm_agent_form_security_question" id="pm_agent_form_security_question" /></p>
                                </div>
                            
                                <input type="hidden" value="<?php echo esc_attr($randNum1) + esc_attr($randNum2) ?>" id="pm_agent_form_security_answer" name="pm_agent_form_security_answer">
                            </div>
                            
                                                            
                            <div class="col-lg-12 pm-center">
                                <input type="button" id="pm-agent-contact-form-btn" style="margin-top:0px;" class="pm-form-submit-btn" name="pm-form-submit-btn" value="Submit">
                                <div id="pm-contact-form-response-agent"></div>
                            </div>
                            
                            <input type="hidden" value="<?php echo esc_attr($pm_agent_email_address_meta); ?>" name="pm_s_email_address_contact" id="pm_s_email_address_contact">
                            
                            <?php wp_nonce_field('pm_ln_nonce_action','pm_ln_send_agent_form_nonce');  ?>
                            
                        </form>
                    </div>
                
                </div><!-- /.row -->
            
            <?php endif; ?>
            
        </div>
    </div>
                
</div>