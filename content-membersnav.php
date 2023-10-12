<?php
	
	$current_user = wp_get_current_user();
	
	//$current_user->user_login
	//$current_user->user_email
	//$current_user->user_firstname
	//$current_user->user_lastname
	//$current_user->display_name
	//$current_user->ID 
	
	$user_roles = $current_user->roles;
	$user_role = array_shift($user_roles);
	
	//Redux options
	global $luxor_options;
	
	$membersAccountSlug = get_option('pm_members_account_template_slug');
	$membersAreaSlug = get_option('pm_members_area_template_slug');
	$membersPropertyListingsSlug = get_option('pm_members_property_listings_slug');
	$membersSubmitListingSlug = get_option('pm_members_submit_listing_slug');
	
	$member_data = get_userdata($current_user->ID);
	
	$user_avatar = get_the_author_meta( 'user_avatar', $current_user->ID ); 
	$user_background_image = get_the_author_meta( 'user_background_image', $current_user->ID); 
	
	$logoutURL = get_option('pm_custom_logout_url');

	
?>


<!-- MEMBERS PANEL -->
<div class="pm-column-container pm-members-area-interface" <?php echo esc_attr($user_background_image) !== '' ? 'style="background-image:url('. esc_html($user_background_image) .');"' : '' ?>>

    <div class="container pm-containerPadding-top-80 pm-containerPadding-bottom-50">
    
        <div class="row">
        
            <div class="col-lg-3 col-md-3 col-sm-12 pm-center-mobile">
                
                <div class="pm-author-bio-container members-area">
                        
                    <div class="pm-author-bio-img-container members-area">
                    
                    	<?php if($user_avatar !== ''){ ?>
                        
                        	<img src="<?php echo esc_html($user_avatar); ?>" alt="<?php echo esc_attr($current_user->user_firstname); ?> <?php echo esc_attr($current_user->user_lastname); ?>" class="img-responsive">
                        
						<?php } else {//No image detected - show placholder avatar ?>
                        
                        	<img src="<?php echo get_template_directory_uri() ?>/img/default_avatar.jpg" alt="<?php echo esc_attr($current_user->user_firstname); ?> <?php echo esc_attr($current_user->user_lastname); ?>" class="img-responsive">
                        <?php } ?>
                        
                    </div>
                    
                    <a href="<?php echo site_url($membersAccountSlug); ?>" class="name"><?php echo esc_attr($current_user->user_firstname); ?> <?php echo esc_attr($current_user->user_lastname); ?></a>
                    <p class="pm-admin-welcome-message"><?php esc_html_e('Member ID', 'luxortheme'); ?> # <?php echo esc_attr($current_user->ID); ?></p>
                    
                    <a href="<?php echo esc_url( get_author_posts_url( $current_user->ID ) ); ?>"><?php esc_html_e('View Public Profile', 'luxortheme'); ?></a>
                    
                </div>
                
            </div>
            
            <div class="col-lg-5 col-md-5 col-sm-12">
                
                <div class="pm-members-area-navigation-spacing">
                
                	<p class="pm-admin-welcome-message"><?php esc_html_e('Welcome back', 'luxortheme'); ?>, <?php echo esc_attr($current_user->user_firstname); ?></p>
                
                    <ul class="pm-members-area-navigation">
                    	
                        <?php if( $membersAreaSlug !== '' ) : ?>
                        
                        	<li><a href="<?php echo site_url($membersAreaSlug); ?>"><?php echo ucwords(str_replace('-', ' ', $membersAreaSlug)); ?></a></li>
                        
                        <?php endif; ?>
                    
                    	<?php if( $membersPropertyListingsSlug !== '' ) : ?>
                        
                        	<li><a href="<?php echo site_url($membersPropertyListingsSlug); ?>"><?php echo ucwords(str_replace('-', ' ', $membersPropertyListingsSlug)); ?></a></li>
                        
                        <?php endif; ?>
                    
                        
                        <?php if( $membersAccountSlug !== '' ) : ?>
                        
                        	<li><a href="<?php echo site_url($membersAccountSlug); ?>"><?php echo ucwords(str_replace('-', ' ', $membersAccountSlug)); ?></a></li>
                        
                        <?php endif; ?>

                        
                        <?php if($logoutURL !== '') { ?>
                            <li><a href="<?php echo wp_logout_url( site_url($logoutURL) ); ?>"><?php esc_html_e('Sign Out', 'luxortheme'); ?></a></li>
                        <?php } else { ?>
                            <li><a href="<?php echo wp_logout_url( site_url('/login/') ); ?>"><?php esc_html_e('Sign Out', 'luxortheme'); ?></a></li>
                        <?php } ?>
                        
                    </ul>
                    
                    <?php $pm_members_property_search_slug = get_option('pm_members_property_search_slug'); ?>
                    
                    <div class="pm-members-property-search-form-container">
                    	<form action="<?php echo site_url('/'.$pm_members_property_search_slug.'') ?>" id="pm-members-property-search-form" method="get">
                            <input type="text" name="property_id" class="pm-members-listing-searchfield" value="" placeholder="<?php esc_html_e('retrieve listing by id #', 'luxortheme'); ?>" />
                            <a href="#" class="fa fa-search" id="pm-members-property-search-form-btn"></a>
                        </form>
                    </div>
                
                </div>
                
            </div>
            
            <div class="col-lg-4 col-md-4 col-sm-12 pm-center">
                
                <?php if( !is_page_template('template-submitlisting.php') ) : ?>
                
                	<?php if( $membersSubmitListingSlug !== '' ) : ?>
                    
                    	<div class="pm-members-area-submit-listing-spacing">
                
                            <p><?php echo ucwords(str_replace('-', ' ', esc_attr($membersSubmitListingSlug))); ?></p>
                            
                            <a href="<?php echo site_url($membersSubmitListingSlug);  ?>" class="fa fa-plus pm-submit-listing-btn"></a>
                        
                        </div>
                    
                    <?php endif; ?>
                
                <?php endif; ?>
                
            </div>
        
        </div>
    
    </div>

</div>

<!-- MEMBERS PANEL end -->