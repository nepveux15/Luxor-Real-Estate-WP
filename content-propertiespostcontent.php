<?php
/**
 * The default template for displaying a property post item.
 */
?>

<?php 

	$pm_properties_image_meta = get_post_meta(get_the_ID(), 'pm_properties_image_meta', true);
	
	$pm_properties_rental_type_meta = get_post_meta(get_the_ID(), 'pm_properties_rental_type_meta', true);
	$pm_properties_price_meta = get_post_meta(get_the_ID(), 'pm_properties_price_meta', true);
	
	if( $pm_properties_price_meta !== '' ){
		$formattedPrice = number_format($pm_properties_price_meta);
	} else {
		$formattedPrice = 0;	
	}
	
	$currencySymbol = get_theme_mod('currencySymbol', '$');
	$pm_properties_size_meta = get_post_meta(get_the_ID(), 'pm_properties_size_meta', true);
	$pm_properties_status_meta = get_post_meta(get_the_ID(), 'pm_properties_status_meta', true);
	
	$terms = get_the_terms( get_the_ID(), 'propertycats' );
	$pm_properties_category_meta = '';
	if ( $terms && ! is_wp_error( $terms ) ) : 
		foreach ( $terms as $term ) {
			$pm_properties_category_meta = $term->name;
		}
	endif;
	
	$saleTypes = get_the_terms( get_the_ID(), 'propertysaletypes' );
	$pm_properties_type_meta = '';
	if ( $saleTypes && ! is_wp_error( $saleTypes ) ) : 
		foreach($saleTypes as $type) {
			$pm_properties_type_meta = $type->term_id; 
		}
	endif;	
	
	$pm_properties_address_meta = get_post_meta(get_the_ID(), 'pm_properties_address_meta', true);
	$pm_properties_city_meta = get_post_meta(get_the_ID(), 'pm_properties_city_meta', true);
	$pm_properties_state_meta = get_post_meta(get_the_ID(), 'pm_properties_state_meta', true);
	$pm_properties_country_meta = get_post_meta(get_the_ID(), 'pm_properties_country_meta', true);
	$pm_properties_zip_meta = get_post_meta(get_the_ID(), 'pm_properties_zip_meta', true);
	$pm_properties_address_lat_meta = get_post_meta(get_the_ID(), 'pm_properties_address_lat_meta', true);
	$pm_properties_address_long_meta = get_post_meta(get_the_ID(), 'pm_properties_address_long_meta', true);
	
	$pm_enable_slider_system = get_post_meta(get_the_ID(), 'pm_enable_slider_system', true);
	$pm_properties_slides = get_post_meta(get_the_ID(), 'pm_properties_slides', true);
	$pm_enable_video_mode = get_post_meta(get_the_ID(), 'pm_enable_video_mode', true);
	$pm_featured_video_url = get_post_meta(get_the_ID(), 'pm_featured_video_url', true);
	
	$pm_property_bedrooms_meta = get_post_meta( get_the_ID(), 'pm_property_bedrooms_meta', true );
	$pm_property_bathrooms_meta = get_post_meta( get_the_ID(), 'pm_property_bathrooms_meta', true );
	$pm_property_garages_meta = get_post_meta( get_the_ID(), 'pm_property_garages_meta', true );
	
	$pm_properties_amenities_meta = get_post_meta(get_the_ID(), 'pm_properties_amenities_meta', true);
	
	$pm_page_print_share_meta = get_post_meta(get_the_ID(), 'pm_page_print_share_meta', true);
	
	//Check for display status
	$pm_properties_display_price_meta = get_option('pm_properties_display_price_meta');
	
	$currenySymbolPosition = get_theme_mod('currenySymbolPosition', 'left');
	
?>

<?php 
        
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

<!-- PANEL 1 -->
<div class="container pm-containerPadding-top-120 pm-containerPadding-bottom-100">

    <div class="row">
        <div class="col-lg-12">
            
            <p class="pm-property-post-listing-id"><?php esc_html_e('Listing ID','luxortheme') ?> #<?php echo get_the_ID(); ?></p>
            
            <?php 
				
				$pm_properties_featured_meta = get_post_meta(get_the_ID(), 'pm_properties_featured_meta', true);
				
			?>
            
            <?php if($pm_properties_featured_meta === 'yes') : ?>
            
            	<div class="pm-property-featured-display"><i class="fa fa-star"></i> Featured</div>
            
            <?php endif; ?>
            
            <div class="pm-column-title-divider-simple property-info">
            </div>
            
            <ul class="pm-property-post-header-list">
                <li>
                    <p class="pm-property-post-address"><?php echo esc_attr($pm_properties_address_meta); ?></p>
                    <p class="pm-property-post-address small"><?php echo esc_attr($pm_properties_city_meta); ?>, <?php echo esc_attr($pm_properties_state_meta); ?> <?php echo esc_attr($pm_properties_country_meta); ?> <?php echo esc_attr($pm_properties_zip_meta); ?></p>
                                        
                </li>
                <li>
                                    
                    <a href="#" class="pm-property-post-video-btn pm_tip_static_top pm_tip_arrow_bottom" title="<?php _e('Toggle Video','luxortheme') ?>" data-tip-offset-x="36" data-tip-offset-y="-2" id="pm-property-post-video-btn" <?php echo esc_attr($pm_enable_video_mode) !== 'yes' ? 'style="visibility:hidden;"' : '' ?>></a>
                    
                    <?php if($pm_properties_address_lat_meta !== '' && $pm_properties_address_long_meta !== '') : ?>
                    
                    	<a href="#" class="pm-property-post-map-btn pm_tip_static_top pm_tip_arrow_bottom" title="<?php _e('Toggle Map','luxortheme') ?>" data-tip-offset-x="31" data-tip-offset-y="-2" id="pm-property-post-map-btn" data-gmap-latitude="<?php echo esc_attr($pm_properties_address_lat_meta); ?>" data-gmap-longitude="<?php echo esc_attr($pm_properties_address_long_meta); ?>" data-address="<?php echo esc_attr($pm_properties_address_meta); ?> <?php echo esc_attr($pm_properties_state_meta); ?> <?php echo esc_attr($pm_properties_country_meta); ?> <?php echo esc_attr($pm_properties_zip_meta); ?>"></a>
                        
                    <?php endif; ?>
                                        
                    
                </li>
            </ul>	
            
                        
            <div class="pm-property-post-carousel-container">
            
                <div class="pm-property-post-dynamic-content-container" id="pm-property-post-dynamic-content-container"></div>
                
                <?php if($pm_enable_video_mode === 'yes') : ?>
                
                    <div class="pm-property-post-video-container" id="pm-property-post-video-container">
                        <iframe src="https://www.youtube.com/embed/<?php echo esc_attr($pm_featured_video_url); ?>" allowfullscreen></iframe>
                    </div>
                
                <?php endif; ?>
                                
                <?php if($pm_enable_slider_system === 'yes') { ?>
                    
                    <div class="flexslider" id="pm-property-post-slider">
                        <ul class="slides">
                        
                        	<?php if( is_array($pm_properties_slides) ) : ?>
                            
								<?php 
                                
                                    foreach($pm_properties_slides as $img) {
                                        echo '<li><img src="'.esc_html($img).'" alt="slider"></li>';	
                                    }
                                
                                ?>
                            
                            <?php endif; ?>
                            
                        </ul>
                    </div>
                
                <?php } else { ?>
                    
                    <?php if($pm_properties_image_meta !== '') : ?>
                    	<img src="<?php echo esc_html($pm_properties_image_meta); ?>" class="img-responsive" alt="<?php the_title(); ?>" />
                    <?php endif; ?>
                             
                <?php } ?>
                
            </div>
            
            
            <ul class="pm-property-status-list">
            
            	<?php $term_value = get_term( $pm_properties_type_meta, 'propertysaletypes' ); ?>
            	
				<?php if( $pm_properties_type_meta !== '' ) : ?>                	
                
                    <li> <?php echo esc_attr(ucfirst($term_value->name)); ?></li>
                    
                <?php endif; ?>
                
                <?php if( $pm_properties_status_meta !== '' ) : ?>
                                
                    <li class="status"> <?php esc_html_e('Status:','luxortheme'); ?> <?php echo esc_attr($pm_properties_status_meta); ?></li>
                    
                <?php endif; ?>
                
                <li><a href="#pm-author-column" class="pm-property-contact-agent-btn pm-page-scroll"><?php esc_html_e('Contact the Agent', 'luxortheme'); ?> <i class="fa fa-user"></i></a></li>
                
            </ul>
            
            
            
            <h6 class="pm-property-post-title-info"><?php esc_html_e('Property Information','luxortheme'); ?></h6>
                        
            <div class="pm-column-title-divider-simple property">
                <div class="pm-column-title-divider-simple-end-point"></div>
            </div>
            
            <ul class="pm-property-post-summary-list">
            <?php 
                            
                if($pm_properties_category_meta !== '') :
                    echo '<li> '.esc_html__('Property Type:','luxortheme').' '.esc_attr($pm_properties_category_meta).'</li>';
                endif;
            
				if( $pm_properties_display_price_meta === 'no' ) {
					
					//public
					if( $formattedPrice !== 0 ) :
						echo '<li> '.esc_html__('Price:','luxortheme').' '. ($currenySymbolPosition == 'left' ? $currencySymbol . esc_attr($formattedPrice) : esc_attr($formattedPrice) . $currencySymbol) .'</li>';
					endif;
					
				} else {
					
					//private
					if( is_user_logged_in() ) {
						
						if( $formattedPrice !== 0 ) :
							echo '<li> '.esc_html__('Price:','luxortheme').' '. ($currenySymbolPosition == 'left' ? $currencySymbol . esc_attr($formattedPrice) : esc_attr($formattedPrice) . $currencySymbol) .'</li>';
						endif;
						
					}
					
				}
                
				
				if( trim($term_value->description) === 'activate-payment-terms' ) :
				
					$pm_properties_rental_type_meta_formatted = implode('-', array_map('ucfirst', explode('-', $pm_properties_rental_type_meta)));
                    
                    echo '<li> '.esc_html__('Payment Term:','luxortheme').' '. esc_attr($pm_properties_rental_type_meta_formatted) .'</li>';					
                    
                endif;
                
                if( $pm_properties_size_meta !== '' ) :
                    echo '<li> '.esc_html__('Size:','luxortheme').' '.esc_attr($pm_properties_size_meta).'</li>';
                endif;	               
                
            
                if( $pm_property_bedrooms_meta !== '' ) :
                    echo '<li>'.esc_attr($pm_property_bedrooms_meta).'</li>';
                endif;
                
                if( $pm_property_bathrooms_meta !== '' ) :
                    echo '<li>'.esc_attr($pm_property_bathrooms_meta).'</li>';
                endif;
                
                if( $pm_property_garages_meta !== '' ) :
                    echo '<li>'.esc_attr($pm_property_garages_meta).'</li>';
                endif;
                
            ?>
            </ul>
                        
            
            <?php the_content(); ?>
            
            <br />
            
            <?php if(count($pm_properties_amenities_meta) > 0) : ?>
            
            	<h6 class="pm-property-post-title-amenities"><?php esc_html_e('Amenities','luxortheme'); ?></h6>
                
                <div class="pm-column-title-divider-simple property">
                    <div class="pm-column-title-divider-simple-end-point"></div>
                </div>
                
                <ul class="pm-property-post-amenities-list">
                
                	<?php 
						
						foreach($pm_properties_amenities_meta as $amenity) {
							echo '<li>'.esc_attr($amenity).'</li>';	
						}
						
					?>

                </ul>
            
            <?php endif; ?>
            
            <?php if($pm_page_print_share_meta === 'on') : ?>
            
            	<br>
            
            	<p class="pm-center"><?php esc_html_e('Share this listing','luxortheme'); ?></p>
                
                <ul class="pm-single-post-social-icons">
                    <li><a class="fa fa-twitter" href="https://twitter.com/share?url=<?php echo urlencode(get_the_permalink()); ?>&amp;text=<?php echo urlencode(get_the_title()); ?>" target="_blank"></a></li>
                    <li><a class="fa fa-facebook" href="http://www.facebook.com/share.php?u=<?php echo urlencode(get_the_permalink()); ?>" target="_blank"></a></li>
                    <li><a class="fa fa-google-plus" href="https://plus.google.com/share?url=<?php echo urlencode(get_the_permalink()); ?>" target="_blank"></a></li>
                </ul>
            
            <?php endif; ?>
            
        </div>
    </div>
                
</div>
<!-- PANEL 1 end -->

<?php
    
	//author info
	$author_id = get_the_author_meta('ID');
	$display_name = get_the_author_meta('display_name');
	$first_name = get_the_author_meta('first_name');
	$last_name = get_the_author_meta('last_name');
	$author_title = get_the_author_meta( 'author_title' ); 
	$description = get_the_author_meta('description');
	$email = get_the_author_meta('email');
	$authorBackgroundImage = get_theme_mod('authorBackgroundImage');
	$commentsBackgroundImage = get_theme_mod('commentsBackgroundImage');
	$toggleParallaxAuthor = get_theme_mod('toggleParallaxAuthor', 'on');
	
?> 

<!-- PANEL 2 -->
<div class="pm-column-container pm-parallax-panel <?php echo esc_attr($toggleParallaxAuthor) === 'on' ? 'pm-parallax-panel' : '' ?>" id="pm-author-column" <?php echo esc_attr($authorBackgroundImage) !== '' ? 'style="background-image:url('.esc_html($authorBackgroundImage).')"' : '' ?> <?php echo esc_attr($toggleParallaxAuthor) === 'on' ? 'data-stellar-background-ratio="0.5"' : '' ?>>

    <div class="container pm-containerPadding-bottom-50 pm-containerPadding-top-130">
        <div class="row">
            <div class="col-lg-12">
                                        
                <p class="pm-fancy-title pm-fancy">
                    <i class="pm-fancy-title-endpoint left"></i>
                        <span class="pm-fancy-author-title"><?php esc_html_e('Contact the Agent','luxortheme'); ?></span>
                    <i class="pm-fancy-title-endpoint right"></i>
                </p>
                
                <div class="row pm-containerPadding-top-60">
                    
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        
                        <div class="pm-author-bio-container">
                        
                            <div class="pm-author-bio-img-container">
                                <?php 
								
									//$avatar = pm_ln_get_avatar_url(get_avatar( get_the_author_meta( 'ID' ), 190 )); 
									$avatar = get_user_meta( get_the_author_meta( 'ID' ), 'user_avatar', true ); 
									$avatar_admin = get_user_meta(get_the_author_meta( 'ID' ), 'user_avatar_updated_in_admin', true);
								
								?>
                                
                                <?php if( $avatar != '' ) { ?>
                                	<img src="<?php echo esc_html($avatar); ?>" class="img-responsive" alt="<?php echo esc_attr($author_title); ?>" />
                                <?php } else { ?>
                                	<img src="<?php echo get_template_directory_uri(); ?>/img/default_avatar.jpg" class="img-responsive" alt="<?php echo esc_attr($author_title); ?>" />
                                <?php } ?>                                
                                
                            </div>
                            
                            <p class="name"><?php echo esc_attr($first_name); ?> <?php echo esc_attr($last_name); ?></p>
                            <a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>"><?php esc_html_e('View Profile', 'luxortheme'); ?></a>
                            
                        </div>
                                                        
                    </div>
                    
                    <?php 
					
						$consent_checkbox = get_theme_mod('displayConsentCheckbox', 'off');
						$consentMessage = get_theme_mod('consentMessage');
					
					?>
                    
                    <div class="col-lg-8 col-md-8 col-sm-12 pm-author-bio">
                        
                        <!-- Contact form -->
                        <div class="row">
                    
                            <div class="pm-contact-form-container">
                                <form id="pm-agent-property-contact-form" method="post" action="#">
                                
                                    <div class="col-lg-12">
                                        <input type="text" placeholder="<?php esc_html_e('Full Name *', 'luxortheme'); ?>" class="pm-form-textfield" id="pm_s_full_name" name="pm_s_full_name">
                                    </div>
                                    
                                    <div class="col-lg-12">
                                        <input type="text" placeholder="<?php esc_html_e('Email Address *', 'luxortheme'); ?>" class="pm-form-textfield" id="pm_s_email_address" name="pm_s_email_address">
                                    </div>
                                    
                                    <div class="col-lg-12">
                                        <input type="text" placeholder="<?php esc_html_e('Phone Number', 'luxortheme'); ?>" class="pm-form-textfield" id="pm_s_phone_number" name="pm_s_phone_number">
                                    </div>
                                                                                
                                    <div class="col-lg-12 pm-clear-element">
                                        <textarea placeholder="<?php esc_html_e('Message *', 'luxortheme'); ?>" rows="5" cols="50" class="pm-form-textarea" id="pm_s_message" name="pm_s_message"></textarea>
                                    </div>
                                    
                                    <?php if($consent_checkbox === 'on') : ?>
                    
                    					<div class="col-lg-12 pm-containerPadding-top-30">
                                            <div class="form-group pm-center">
                                                <input type="checkbox" name="pm_agent_property_consent_box" id="pm_agent_property_consent_box" />
                                                <span class="pm-form-security-question"><?php echo $consentMessage ?></span>
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
                                        
                                        <p class="pm-form-security-question pm-center"><?php esc_attr_e('Security question', 'luxortheme') ?>: </p>
                                        <div class="form-group security-question-property-post">		
                                            <p class="pm-form-security-question-input"><strong><?php echo esc_attr($randNum1); ?></strong> + <strong><?php echo  esc_attr($randNum2); ?></strong> = <input type="text" maxlength="2" class="pm-form-textfield security-field property-post" name="pm_property_form_security_question" id="pm_property_form_security_question" /></p>
                                    	</div>
                                    
                                    	<input type="hidden" value="<?php echo esc_attr($randNum1) + esc_attr($randNum2) ?>" id="pm_property_form_security_answer" name="pm_property_form_security_answer">
                                    </div>
                                                                    
                                    <div class="col-lg-12 pm-center">
                                        <input type="button" id="pm-agent-property-contact-form-btn" class="pm-form-submit-btn property-post" name="pm-form-submit-btn" value="<?php esc_html_e('Submit', 'luxortheme'); ?>">
                                        <div id="pm-property-agent-form-response" class="pm-agent-form-response" style="margin-top:10px;"></div>
                                    </div>
                                    
                                    <input type="hidden" value="<?php esc_attr_e(get_the_title()); ?>" name="pm_property_title" id="pm_property_title">
                                    <input type="hidden" value="<?php esc_attr_e(get_the_ID()); ?>" name="pm_property_id" id="pm_property_id">
                                    
                                    <input type="hidden" value="<?php esc_attr_e($email); ?>" name="pm_s_email_address_contact" id="pm_s_email_address_contact">
                                    
                                    <?php wp_nonce_field('pm_ln_nonce_action','pm_ln_send_property_agent_form_nonce');  ?>
                                    
                                </form>
                            </div>
                        
                        </div><!-- /.row -->
                        
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>

</div>
<!-- PANEL 2 end -->

<!-- PANEL 3 -->
<?php get_template_part('content','relatedproperties'); ?>
<!-- PANEL 3 end-->