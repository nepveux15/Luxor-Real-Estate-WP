<?php /* Template Name: Members Account Template */ ?>
<?php get_header(); ?>

<!-- MEMBERS NAVIGATION -->
<?php get_template_part('content', 'membersnav'); ?>
<!-- MEMBERS NAVIGATION end -->

<?php 

	//Are we logged in?
	if ( is_user_logged_in() ) { 
	
		//Image handling
		include_once(get_template_directory() . '/includes/classes/upload.class.php');
				
		$img_error_status = '';
		$form_error = '';
	
		//Member area parameters
		$alertStatus = get_option('pm_member_email_alerts');
		$alertEmail = get_option('pm_admin_email_address');
	
		$form_success = true;
		$avatar_success = false;
		$bg_success = false;
		
		$my_info_success = false;
		
		//flag inappropriate fields
		$email_error = '';
		
		//user is logged in, retrive user info
		$current_user = wp_get_current_user();
		
		//capture changed information for email notification
		$info_array = array();
		$address_array = array();
		
		//wp_kses args
		$allowed_html = array(
			'a' => array(
				'href' => array(),
				'title' => array()
			),
			'br' => array(),
			'em' => array(),
			'strong' => array()
		);
		
		//echo 'Fax number = ' . $current_user->user_faxnumber;
		
		//$current_user->user_login //username
		//$current_user->user_email
		//$current_user->user_firstname
		//$current_user->user_lastname
		//$current_user->display_name
		//$current_user->ID 
		//$current_user->user_url
		//$current_user->user_pass
		//$current_user->user_identity
		
		//$current_user->user_prefix
		//$current_user->user_designation
		//$current_user->user_title
		//$current_user->user_organization
		//$current_user->user_workphone
		//$current_user->user_homephone
		//$current_user->user_faxnumber
		//$current_user->user_address
		//$current_user->user_city
		//$current_user->user_state
		//$current_user->user_zip
		//$current_user->user_country
		
		
		$user_roles = $current_user->roles;
		$user_role = array_shift($user_roles);
		$user_role = str_replace('_', ' ', $user_role);
		$user_role = strtoupper($user_role);
		
		//Retrieve Member account info from ota_membersinfo and store it in a session
		global $wpdb;
		
		$_SESSION['user_prefix'] = get_user_meta($current_user->ID, 'user_prefix', true);			
		$_SESSION['user_firstname'] = $current_user->user_firstname;
		$_SESSION['user_lastname'] = $current_user->user_lastname;
		$_SESSION['user_email'] = $current_user->user_email;
		$_SESSION['user_workphone'] = get_user_meta($current_user->ID, 'user_workphone', true);
		$_SESSION['user_homephone'] = get_user_meta($current_user->ID, 'user_homephone', true);
		
		$_SESSION['user_faxnumber'] = get_user_meta($current_user->ID, 'user_faxnumber', true);
		$_SESSION['user_url'] = $current_user->user_url;
		$_SESSION['user_organization'] = get_user_meta($current_user->ID, 'user_organization', true);
		$_SESSION['user_designation'] = get_user_meta($current_user->ID, 'user_designation', true);
		$_SESSION['user_title'] = get_user_meta($current_user->ID, 'user_title', true);
		$_SESSION['user_address'] = get_user_meta($current_user->ID, 'user_address', true);
		
		$_SESSION['user_city'] = get_user_meta($current_user->ID, 'user_city', true);
		$_SESSION['user_state'] = get_user_meta($current_user->ID, 'user_state', true);
		$_SESSION['user_zip'] = get_user_meta($current_user->ID, 'user_zip', true);
		$_SESSION['user_country'] = get_user_meta($current_user->ID, 'user_country', true);
		
		$_SESSION['user_bio'] = $current_user->user_description;
			
		$_SESSION['user_avatar'] = get_the_author_meta( 'user_avatar', $current_user->ID ); 
		$_SESSION['user_background_image'] = get_the_author_meta( 'user_background_image', $current_user->ID );
		
		//Social Media fields
		$_SESSION['user_twitter_account'] = get_user_meta($current_user->ID, 'user_twitter_account', true); 
		$_SESSION['user_facebook_account'] = get_user_meta($current_user->ID, 'user_facebook_account', true); 
		$_SESSION['user_linkedin_account'] = get_user_meta($current_user->ID, 'user_linkedin_account', true); 
		$_SESSION['user_google_plus_account'] = get_user_meta($current_user->ID, 'user_google_plus_account', true); 
		$_SESSION['user_instagram_account'] = get_user_meta($current_user->ID, 'user_instagram_account', true); 
		$_SESSION['user_youtube_account'] = get_user_meta($current_user->ID, 'user_youtube_account', true); 
		
		
		/* 
		
			WP validation methods 
			
			data type where input neccessary (string) or (int) or (absint)
			
			is_email( $email_address )
			sanitize_text_field( $str )
			esc_url( $url ) - use to sanitize $current_user->user_url
			esc_html($url) - escape any HTML characters (converts < > & " ') to character codes
			wp_kses($data) - strips evil scripts and untrusted HTML
			
				
		*/
				
		
	} else {
		
		//redirect page back to homepage
		wp_redirect( home_url('/') );
		exit;
		
	}

?>



<!-- PANEL 1 -->
<div class="container pm-containerPadding-top-120 pm-containerPadding-bottom-50">

    <div class="row">
        <div class="col-lg-12 pm-center">
            
            <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
		    	<?php the_content(); ?>
            <?php endwhile; else: ?>
            	<p><?php echo esc_html_e('No content was found.', 'luxortheme'); ?></p>
            <?php endif; ?>
            
        </div>
    </div>
                
</div>
<!-- PANEL 1 end -->

<!-- PANEL 2 -->
<div class="container pm-containerPadding-bottom-110">
    <div class="row">
        
        <div class="col-lg-12 pm-column-spacing">
            
            
            <h6 class="pm-members-area-title"><?php esc_html_e('My Account Type','luxortheme'); ?></h6>
            <div class="pm-members-area-divider"></div>
            
            <p><span class="pm-secondary"><?php esc_html_e('Agent ID','luxortheme'); ?>:</span> <?php echo esc_attr($current_user->ID); ?> &nbsp; <span class="pm-secondary"><?php esc_html_e('Member Type','luxortheme'); ?>:</span> <?php echo esc_attr($user_role); ?></p>
            
            <br />
            
            <h6 class="pm-members-area-title"><?php esc_html_e('Personal Information','luxortheme'); ?></h6>
            <div class="pm-members-area-divider"></div>
            
            <?php

				//My Information form validation
				if( isset($_POST['pm-my-info-submitted']) ){
					
					//verify nonce
					if ( !isset( $_POST['pm_account_form_nonce'] ) || !wp_verify_nonce( $_POST['pm_account_form_nonce'], 'pm-my-info-submitted' ) ) {
						return;
					}
					
					//capture POST fields first
					$p_user_prefix = $_POST['user_prefix'];
					$p_user_firstname = sanitize_text_field($_POST['user_firstname']);
					$p_user_lastname = sanitize_text_field($_POST['user_lastname']);
					$p_user_email = sanitize_text_field($_POST['user_email']);
					$p_user_workphone = sanitize_text_field($_POST['user_workphone']);
					$p_user_homephone = sanitize_text_field($_POST['user_homephone']);
					
					$p_user_faxnumber = sanitize_text_field($_POST['user_faxnumber']);
					$p_user_url = wp_kses($_POST['user_url'], $allowed_html);
					$p_user_organization = sanitize_text_field($_POST['user_organization']);
					$p_user_designation = sanitize_text_field($_POST['user_designation']);
					$p_user_title = sanitize_text_field($_POST['user_title']);
					$p_user_address = sanitize_text_field($_POST['user_address']);
					
					$p_user_city = sanitize_text_field($_POST['user_city']);
					$p_user_state = sanitize_text_field($_POST['user_state']);
					$p_user_zip = sanitize_text_field($_POST['user_zip']);
					$p_user_country = sanitize_text_field($_POST['user_country']);
					
					$p_user_bio = sanitize_text_field($_POST['user_bio']);
					
					//Social media fields
					$p_user_twitter_account = sanitize_text_field($_POST['user_twitter_account']);
					$p_user_facebook_account = sanitize_text_field($_POST['user_facebook_account']);
					$p_user_linkedin_account = sanitize_text_field($_POST['user_linkedin_account']);
					$p_user_google_plus_account = sanitize_text_field($_POST['user_google_plus_account']);
					$p_user_instagram_account = sanitize_text_field($_POST['user_instagram_account']);
					$p_user_youtube_account = sanitize_text_field($_POST['user_youtube_account']);
					
					
					
					//Check and capture which fields have been changed for email notification
					if($p_user_prefix !== $_SESSION['user_prefix']){
						$info_array['Prefix'] = $p_user_prefix;
					}
					if($p_user_firstname !== $_SESSION['user_firstname']){
						$info_array['First Name'] = $p_user_firstname;
					}
					if($p_user_lastname !== $_SESSION['user_lastname']){
						$info_array['Last Name'] = $p_user_lastname;
					}
					if($p_user_email !== $_SESSION['user_email']){
						$info_array['Email'] = $p_user_email;
					}
					if($p_user_workphone !== $_SESSION['user_workphone']){
						$info_array['Work Phone'] = $p_user_workphone;
					}
					if($p_user_homephone !== $_SESSION['user_homephone']){
						$info_array['Home Phone'] = $p_user_homephone;
					}
					
					if($p_user_faxnumber !== $_SESSION['user_faxnumber']){
						$info_array['Fax Number'] = $p_user_faxnumber;
					}
					if($p_user_url !== $_SESSION['user_url']){
						$info_array['Website'] = $p_user_url;
					}
					if($p_user_organization !== $_SESSION['user_organization']){
						$info_array['Organization'] = $p_user_organization;
					}
					if($p_user_designation !== $_SESSION['user_designation']){
						$info_array['Designation'] = $p_user_designation;
					}
					if($p_user_title !== $_SESSION['user_title']){
						$info_array['Title'] = $p_user_title;
					}
					if($p_user_address !== $_SESSION['user_address']) {
						$info_array['Address'] = $p_user_address;
					}
					
					if($p_user_city !== $_SESSION['user_city']) {
						$info_array['City'] = $p_user_city;
					}
					if($p_user_state !== $_SESSION['user_state']) {
						$info_array['State/Pro'] = $p_user_state;
					}
					if($p_user_zip !== $_SESSION['user_zip']) {
						$info_array['Zip/Postal'] = $p_user_zip;
					}
					if($p_user_country !== $_SESSION['user_country']) {
						$info_array['Country'] = $p_user_country;
					}
					
					if($p_user_bio !== $_SESSION['user_bio']) {
						$info_array['Bio'] = $p_user_bio;
					}
					
					//Social media fields
					if($p_user_twitter_account !== $_SESSION['user_twitter_account']) {
						$info_array['Twitter account'] = $p_user_twitter_account;
					}
					if($p_user_facebook_account !== $_SESSION['user_facebook_account']) {
						$info_array['Facebook account'] = $p_user_facebook_account;
					}
					if($p_user_linkedin_account !== $_SESSION['user_linkedin_account']) {
						$info_array['Linkedin account'] = $p_user_linkedin_account;
					}
					if($p_user_google_plus_account !== $_SESSION['user_google_plus_account']) {
						$info_array['Google Plus account'] = $user_google_plus_account;
					}
					if($p_user_instagram_account !== $_SESSION['user_instagram_account']) {
						$info_array['Instagram account'] = $p_user_instagram_account;
					}
					if($p_user_youtube_account !== $_SESSION['user_instagram_account']) {
						$info_array['Youtube account'] = $p_user_youtube_account;
					}
					
								
					//Update session vars
					$_SESSION['user_prefix'] = $p_user_prefix;
					$_SESSION['user_firstname'] = $p_user_firstname;
					$_SESSION['user_lastname'] = $p_user_lastname;
					$_SESSION['user_email'] = $p_user_email;
					$_SESSION['user_workphone'] = $p_user_workphone;
					$_SESSION['user_homephone'] = $p_user_homephone;
					$_SESSION['user_faxnumber'] = $p_user_faxnumber;
					$_SESSION['user_url'] = $p_user_url;
					$_SESSION['user_organization'] = $p_user_organization;
					$_SESSION['user_designation'] = $p_user_designation;
					$_SESSION['user_title'] = $p_user_title;
					$_SESSION['user_address'] = $p_user_address;
					$_SESSION['user_city'] = $p_user_city;
					$_SESSION['user_state'] = $p_user_state;
					$_SESSION['user_zip'] = $p_user_zip;
					$_SESSION['user_country'] = $p_user_country;
					$_SESSION['user_bio'] = $p_user_bio;
					
					//Social media fields
					$_SESSION['user_twitter_account'] = $p_user_twitter_account;
					$_SESSION['user_facebook_account'] = $p_user_facebook_account;
					$_SESSION['user_linkedin_account'] = $p_user_linkedin_account;
					$_SESSION['user_google_plus_account'] = $p_user_google_plus_account;
					$_SESSION['user_instagram_account'] = $p_user_instagram_account;
					$_SESSION['user_youtube_account'] = $p_user_youtube_account;					
					
					if( !is_email($_SESSION['user_email']) ) {
						$form_success = false;
						$email_error = '<p style="color:red; font-size:12px; text-align:center;">'.esc_html__('*Invalid email address. Please provide a valid email address.','luxortheme').'</p>';
					}
					
					if($form_success){
						
						$users_table_query = wp_update_user( array ( 
																	'ID' => $current_user->ID, 
																	'user_url' => $_SESSION['user_url'], 
																	'user_email' => $_SESSION['user_email'],
																	'description' => $_SESSION['user_bio']
																	) 
																);
						if($users_table_query){
							$my_info_success = true;
						}
						
						$user_meta_first_name = update_user_meta( $current_user->ID, 'first_name', $_SESSION['user_firstname']);
						if($user_meta_first_name){
							$my_info_success = true;
						}
						
						$user_meta_last_name = update_user_meta( $current_user->ID, 'last_name', $_SESSION['user_lastname']);
						if($user_meta_last_name){
							$my_info_success = true;
						}
						
						//Sanitize vars for SQL injection
						$user_prefix = esc_sql($_SESSION['user_prefix']);
						$user_designation = esc_sql($_SESSION['user_designation']);
						$user_title = esc_sql($_SESSION['user_title']);
						$user_organization = esc_sql($_SESSION['user_organization']);
						$user_workphone = esc_sql($_SESSION['user_workphone']);
						$user_homephone = esc_sql($_SESSION['user_homephone']);
						$user_faxnumber = esc_sql($_SESSION['user_faxnumber']);						
						$user_address = esc_sql($_SESSION['user_address']);
						$user_city = esc_sql($_SESSION['user_city']);
						$user_state = esc_sql($_SESSION['user_state']);
						$user_zip = esc_sql($_SESSION['user_zip']);
						$user_country = esc_sql($_SESSION['user_country']);	
						
						//Social media fields
						$user_twitter_account = esc_sql($_SESSION['user_twitter_account']);	
						$user_facebook_account = esc_sql($_SESSION['user_facebook_account']);	
						$user_linkedin_account = esc_sql($_SESSION['user_linkedin_account']);	
						$user_google_plus_account = esc_sql($_SESSION['user_google_plus_account']);	
						$user_instagram_account = esc_sql($_SESSION['user_instagram_account']);		
						$user_youtube_account = esc_sql($_SESSION['user_youtube_account']);		
											
						
						update_user_meta($current_user->ID, 'user_prefix', $user_prefix);
						update_user_meta($current_user->ID, 'user_designation', $user_designation);
						update_user_meta($current_user->ID, 'user_title', $user_title);
						update_user_meta($current_user->ID, 'user_organization', $user_organization);
						update_user_meta($current_user->ID, 'user_workphone', $user_workphone);
						update_user_meta($current_user->ID, 'user_homephone', $user_homephone);
						update_user_meta($current_user->ID, 'user_faxnumber', $user_faxnumber);						
						update_user_meta($current_user->ID, 'user_address', $user_address);
						update_user_meta($current_user->ID, 'user_city', $user_city);
						update_user_meta($current_user->ID, 'user_state', $user_state);
						update_user_meta($current_user->ID, 'user_zip', $user_zip);
						update_user_meta($current_user->ID, 'user_country', $user_country);
						
						update_user_meta($current_user->ID, 'user_twitter_account', $user_twitter_account);
						update_user_meta($current_user->ID, 'user_facebook_account', $user_facebook_account);
						update_user_meta($current_user->ID, 'user_linkedin_account', $user_linkedin_account);
						update_user_meta($current_user->ID, 'user_google_plus_account', $user_google_plus_account);
						update_user_meta($current_user->ID, 'user_instagram_account', $user_instagram_account);
						update_user_meta($current_user->ID, 'user_youtube_account', $user_youtube_account);
						
						
						
						if($my_info_success){
							echo '<p style="color:green; text-align:left;">'.esc_html__('Your information has been saved.','luxortheme').'</p>';	
							
							//Send email to OTA administrator
							if($alertStatus === 'on'){
								sendEmail("personal", $alertEmail, $info_array);
							}
							
																			
						}
						
					} else {
						
						echo esc_attr($email_error);
							
					}
					
				}
		
			?>
            
            <form action="<?php echo get_permalink(); ?>" method="post">
            
                <div class="row">
                                        
                        <div class="col-lg-4 col-md-4 col-sm-4">
                        	<select name="user_prefix">
                              <option selected><?php esc_html_e('Prefix', 'luxortheme') ?></option>
                              <option value="mr" <?php selected( $_SESSION['user_prefix'], 'mr' ); ?>><?php esc_html_e('Mr.','luxortheme'); ?></option>
              				  <option value="ms" <?php selected( $_SESSION['user_prefix'], 'ms' ); ?>><?php esc_html_e('Ms.','luxortheme'); ?></option>
                            </select>

                            
                            <input name="user_firstname" class="pm-textfield members" type="text" placeholder="<?php esc_html_e('First name','luxortheme'); ?>" value="<?php echo $_SESSION['user_firstname']; ?>">
                            <input name="user_lastname" class="pm-textfield members" type="text" placeholder="<?php esc_html_e('Last name','luxortheme'); ?>" value="<?php echo $_SESSION['user_lastname']; ?>">
                            <input name="user_email" class="pm-textfield members" type="text" placeholder="<?php esc_html_e('Email','luxortheme'); ?>" value="<?php echo $_SESSION['user_email']; ?>">
                            <input name="user_workphone" class="pm-textfield members" type="text" placeholder="<?php esc_html_e('Work Phone','luxortheme'); ?>" value="<?php echo $_SESSION['user_workphone']; ?>">
                            <input name="user_homephone" class="pm-textfield members" type="text" placeholder="<?php esc_html_e('Home Phone','luxortheme'); ?>" value="<?php echo $_SESSION['user_homephone']; ?>">
                                                       
                        </div>
                        
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            
                            <input name="user_faxnumber" class="pm-textfield members" type="text" placeholder="<?php esc_html_e('Fax Number','luxortheme'); ?>" value="<?php echo $_SESSION['user_faxnumber']; ?>">
                            <input name="user_url" class="pm-textfield members" type="text" placeholder="<?php esc_html_e('Website','luxortheme'); ?>" value="<?php echo $_SESSION['user_url']; ?>">
                            <input name="user_organization" class="pm-textfield members" type="text" placeholder="<?php esc_html_e('Organization','luxortheme'); ?>" value="<?php echo $_SESSION['user_organization']; ?>">
                            <input name="user_designation" class="pm-textfield members" type="text" placeholder="<?php esc_html_e('Designation','luxortheme'); ?>" value="<?php echo $_SESSION['user_designation']; ?>">
                            <input name="user_title" class="pm-textfield members" type="text" placeholder="<?php esc_html_e('Title','luxortheme'); ?>" value="<?php echo $_SESSION['user_title']; ?>">
                            <input name="user_address" class="pm-textfield members" type="text" placeholder="<?php esc_html_e('Address','luxortheme'); ?>" value="<?php echo $_SESSION['user_address']; ?>">
                            
                        </div>
                        
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            
                            <input name="user_city" class="pm-textfield members" type="text" placeholder="<?php esc_html_e('City','luxortheme'); ?>" value="<?php echo $_SESSION['user_city']; ?>">
                            <input name="user_state" class="pm-textfield members" type="text" placeholder="<?php esc_html_e('State/Province','luxortheme'); ?>" value="<?php echo $_SESSION['user_state']; ?>">
                            <input name="user_zip" class="pm-textfield members" type="text" placeholder="<?php esc_html_e('Zip/Postal','luxortheme'); ?>" value="<?php echo $_SESSION['user_zip']; ?>">
                            <input name="user_country" class="pm-textfield members" type="text" placeholder="<?php esc_html_e('Country','luxortheme'); ?>" value="<?php echo $_SESSION['user_country']; ?>">
                            
                            <textarea name="user_bio" placeholder="<?php esc_html_e('Profile Bio','luxortheme'); ?>" rows="3" cols="5" class="pm-textfield members textarea"><?php echo $_SESSION['user_bio']; ?></textarea>
                            
                        </div>
                                                                   
                </div><!-- /row -->
                
                
                <div class="row">
                
                	<div class="col-lg-12 pm-containerPadding-top-20">
                    	<h6 class="pm-members-area-title"><?php esc_html_e('Social Media Information','luxortheme'); ?></h6>
                		<div class="pm-members-area-divider"></div>
                    </div>
                	
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <input name="user_twitter_account" class="pm-textfield members" type="text" placeholder="<?php esc_html_e('Twitter Account','luxortheme'); ?>" value="<?php echo $_SESSION['user_twitter_account']; ?>">
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <input name="user_facebook_account" class="pm-textfield members" type="text" placeholder="<?php esc_html_e('Facebook Account','luxortheme'); ?>" value="<?php echo $_SESSION['user_facebook_account']; ?>">
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <input name="user_linkedin_account" class="pm-textfield members" type="text" placeholder="<?php esc_html_e('Linkedin Account','luxortheme'); ?>" value="<?php echo $_SESSION['user_linkedin_account']; ?>">
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <input name="user_google_plus_account" class="pm-textfield members" type="text" placeholder="<?php esc_html_e('Google Plus Account','luxortheme'); ?>" value="<?php echo $_SESSION['user_google_plus_account']; ?>">
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <input name="user_instagram_account" class="pm-textfield members" type="text" placeholder="<?php esc_html_e('Instagram Account','luxortheme'); ?>" value="<?php echo $_SESSION['user_instagram_account']; ?>">
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <input name="user_youtube_account" class="pm-textfield members" type="text" placeholder="<?php esc_html_e('Youtube Account','luxortheme'); ?>" value="<?php echo $_SESSION['user_youtube_account']; ?>">
                    </div>
                
                </div><!-- /row -->
                
                
                <div class="row">
                    <div class="col-lg-12 pm-containerPadding-top-40">
                         <input type="submit" class="pm-square-btn comments" value="<?php esc_html_e('Save Profile','luxortheme'); ?>" />
                    </div>
                </div>
                
                <?php wp_nonce_field( 'pm-my-info-submitted', 'pm_account_form_nonce' ); ?>

				<input type="hidden" name="pm-my-info-submitted" />            	
            
            </form>
            
            <br><br>
            
            <h6 class="pm-members-area-title"><?php esc_html_e('Profile Images','luxortheme'); ?></h6>
            <div class="pm-members-area-divider"></div>
            
            <?php 
							
				//Check if images form submitted
				if( isset($_POST['pm-images-submitted']) ){
					
					//verify nonce
					if ( !isset( $_POST['pm_account_form_images_nonce'] ) || !wp_verify_nonce( $_POST['pm_account_form_images_nonce'], 'pm-images-submitted' ) ) {
						return;
					}
					
					//Grab values from post fields
					$p_user_avatar = $_FILES['user_avatar']['name']; //File upload field
					$p_user_background_image = $_FILES['user_background_image']['name']; //File upload field
					
					//Validate Avatar
					if($p_user_avatar !== $_SESSION['user_avatar']){
						
						//File names don't match, proceed to upload
						if ( $_FILES["user_avatar"]["size"] != 0 ) {
						
							if( uploadImage($_FILES['user_avatar'], './wp-content/uploads/profile_avatars/') == false ){
								
								$form_success = false;
								
								$form_error = '<p style="color:red; font-size:14px; margin-bottom:20px; text-align:center;">'.esc_html__('*A file error was detected. Please ensure both images you are uploading have the correct extension.','luxortheme').' (.jpg, .gif or .png).</p>';
								
							} else {
								
								$avatar_success = true;
									
							}
							
						}//end of if
							
					}//end of if
										
					//Validate Bg image
					if($p_user_background_image !== $_SESSION['user_background_image']){
						
						if ( $_FILES["user_background_image"]["size"] != 0 ) {
						
							if( uploadImage($_FILES['user_background_image'], './wp-content/uploads/profile_bgs/') == false ){
								$form_success = false;
								$form_error = '<p style="color:red; font-size:14px; margin-bottom:20px; text-align:center;">'.esc_html__('*A file error was detected. Please ensure both images you are uploading have the correct extension.','luxortheme').' (.jpg, .gif or .png).</p>';
								
							} else {
								
								$bg_success = true;
									
							}
							
						}//end of if
						
					}//end if
										
					
					if($avatar_success){
												
						//Proceed to save avatar value
						$_SESSION['user_avatar'] = esc_sql($p_user_avatar);						
						$avatar_path = content_url() . '/uploads/profile_avatars/' . $_SESSION['user_avatar'];	
						$_SESSION['user_avatar'] = $avatar_path;				
						update_user_meta($current_user->ID, 'user_avatar', $avatar_path);
												
					}//end if
					
					if($bg_success){
												
						//Proceed to save bg image value
						$_SESSION['user_background_image'] = esc_sql($p_user_background_image);
						$bg_path = content_url() . '/uploads/profile_bgs/' . $_SESSION['user_background_image'];	
						$_SESSION['user_background_image'] = $bg_path;
						update_user_meta($current_user->ID, 'user_background_image', $bg_path);
						
						
					}//end if
					
					
					if(!$form_success){ 
						
						echo $form_error;
						
					} 
					
				}
				
			
			?>
            
            <form action="<?php echo get_permalink(); ?>" method="post" enctype="multipart/form-data">
            	
                <div class="row">
                	
                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        
                    	<label class="pm-acount-form-label"><strong><?php esc_html_e('Profile Avatar','luxortheme'); ?></strong> (.jpg, .gif or .png) <br /><?php esc_html_e('220x220px recommended','luxortheme'); ?></label>
                        <br /><br />
                        <input type="file" name="user_avatar">
                        
                        <div class="pm-member-img-preview">
                        
                            <?php if($_SESSION['user_avatar'] !== '') { ?>
                            
                                <p><?php esc_html_e( 'Current Avatar:', 'luxortheme' ); ?></p>
                                
                                <img src="<?php echo esc_html($_SESSION['user_avatar']); ?>" />
                            
                            <?php } else { ?>
                            
                                <p><?php esc_html_e( 'There is currently no profile avatar attached to this account.', 'luxortheme' ); ?></p>
                            
                            <?php } ?>
                                            
                        </div>
                        
                        <?php if( $avatar_success ) : ?>
                                                
                        	<p style="color:green;"><?php esc_html_e( 'Profile image successfully saved.', 'luxortheme' ); ?></p>
                        
                        <?php endif; ?>
                    
                    </div>
                    
                    <div class="col-lg-8 col-md-6 col-sm-12">
                                        
                    	<label class="pm-acount-form-label"><strong><?php esc_html_e('Profile Background Image','luxortheme'); ?></strong> (.jpg, .gif or .png) <br /><?php esc_html_e('1920x500px recommended','luxortheme'); ?></label>
                        <br /><br />
                        <input type="file" name="user_background_image">
                        
                        <div class="pm-member-img-preview bg">
                        
                            <?php if($_SESSION['user_background_image'] !== '') { ?>
                            
                                <p><?php esc_html_e( 'Current Profile Background Image:', 'luxortheme' ); ?></p>
                                
                                <img src="<?php echo esc_html($_SESSION['user_background_image']); ?>" />
                            
                            <?php } else { ?>
                            
                                <p><?php esc_html_e( 'There is currently no background image attached to this account.', 'luxortheme' ); ?></p>
                            
                            <?php } ?>
                                            
                        </div>
                        
                        <?php if( $bg_success ) : ?>
                                                    
                            <p style="color:green;"><?php esc_html_e( 'Background image successfully saved.', 'luxortheme' ); ?></p>
                        
                        <?php endif; ?>
                        
                    </div>
                    
                </div>
                
                <input type="submit" class="pm-square-btn comments" value="<?php esc_html_e('Upload Images','luxortheme'); ?>" />
                
                <?php wp_nonce_field( 'pm-images-submitted', 'pm_account_form_images_nonce' ); ?>

				<input type="hidden" name="pm-images-submitted" />
                
            </form>
            
            <br><br>
            
            <h6 class="pm-members-area-title"><?php esc_html_e('Reset / Change Password','luxortheme'); ?></h6>
            <div class="pm-members-area-divider"></div>
            
            <?php 

				if( isset($_POST['pm-password-submitted']) ){
					
					//verify nonce
					if ( !isset( $_POST['pm_account_form_password_nonce'] ) || !wp_verify_nonce( $_POST['pm_account_form_password_nonce'], 'pm-password-submitted' ) ) {
						return;
					}
					
					//Validate current password first
					$validate_password = wp_check_password( $_POST['pm_current_password'], $current_user->user_pass, $current_user->ID );
					
					if($validate_password){
						
						//Confirm passwords
						$pass1 = $_POST['pm_new_password'];
						$pass2 = $_POST['pm_confirm_new_password'];
						
						if( empty($pass1) || empty($pass2) ) {
							
							echo '<p style="color:red; text-align:left;">'.esc_html__('Empty password field detected - please fill in all the fields.','luxortheme').'</p>';	
														
						} else {
							
							if($pass1 === $pass2){
							
								//Save new password
								wp_set_password( $pass1, $current_user->ID );
								echo '<p style="color:green;">'.esc_html__('Your Password has been updated.','luxortheme').'</p>';
								
								//Send email to OTA administrator
								if($alertStatus === 'on'){
									sendEmail("password", $alertEmail);
								}
								
							} else {
								echo '<p style="color:red; text-align:left;">'.esc_html__('Passwords do not match. Please try again.','luxortheme').'</p>';	
							}
							
						}						
						
					} else {
						echo '<p style="color:red; text-align:left;">'.esc_html__('Current password does not match.','luxortheme').'</p>';	
					}
					
				}
			
			?>
            
            <div class="row">
            
            	<form action="<?php echo get_permalink(); ?>" method="post" class="pm-members-account-info-form">
                
                    <div class="col-lg-6">
                        
                        <input name="pm_current_password" class="pm-textfield members" type="password" placeholder="<?php esc_html_e('Current Password','luxortheme'); ?>">
                        <input name="pm_new_password" class="pm-textfield members" type="password" placeholder="<?php esc_html_e('New Password','luxortheme'); ?>">
                        <input name="pm_confirm_new_password" class="pm-textfield members" type="password" placeholder="<?php esc_html_e('Confirm Password','luxortheme'); ?>">
                        <br><br>
                        <input type="submit" class="pm-square-btn comments" value="<?php esc_html_e('Update Password','luxortheme'); ?>" />
                        
                   
                    </div>
                    
                    <?php wp_nonce_field( 'pm-password-submitted', 'pm_account_form_password_nonce' ); ?>

					<input type="hidden" name="pm-password-submitted" />
                                            
                </form>
                                
            </div><!-- /row -->
            
        </div><!-- /col -->
                        
    </div><!-- /row -->
</div><!-- /col -->
<!-- PANEL 2 end -->




<?php 

function sendEmail($infoType, $email_address, $data = ''){
	
	$subject = esc_html__('Member account change: ', 'luxortheme') .' '. ucfirst($infoType) .' '. esc_html__('information updated', 'luxortheme');
	$sender = 'Member administration';
	$email = 'donotreply@memberadministration.com';
	//$cc = 'leo@pulsarmedia.ca';
	//$to = 'leo@pulsarmedia.ca';
	
	$message = '';
	
	$message .= esc_html__('The following member,', 'luxortheme') .' '. $_SESSION['user_firstname'] .' '. $_SESSION['user_lastname'] .', '.esc_html__('has updated there', 'luxortheme') .' '. $infoType .' '. esc_html__('information.', 'luxortheme').' <br /><br />';
		
	
	if($infoType === "personal"){		
		
		if( $data !== '' ){
			
			$message .= esc_html__('The following information was changed:', 'luxortheme') . '<br /><br />';
			
			//Append changed data to email message
			while (list($key, $value) = each($data)) {
				$message .= "$key: $value <br />";
			}
			
		}
		
	}
	
	$headers[] = 'MIME-Version: 1.0' . "\r\n";
	$headers[] = 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers[] = "X-Mailer: PHP \r\n";
	$headers[] = 'From: '.$sender.' <'.$email.'>' . "\r\n";
	//$headers[] = 'From: '.$sender.' <'.$email.'>' . "\r\n" . 'CC: '.$cc.'';
	
	$mail = wp_mail( $email_address, $subject, $message, $headers );
	
	
}


function uploadImage($file, $dir){
	
	global $pm_ln_account_error_messages;
		
	$pm_ln_account_error_messages = array(
		ERROR_MISSING_NAME	=>	'File missing a valid name.',
		ERROR_INVALID_EXT	=>	'File does not have a valid extension.',
		ERROR_SIZE_LIMIT	=>	'File exceeds maximum filesize.',
		ERROR_MOVE_ERROR	=>	'File cannot be uploaded.'
	);
		
	$uploader = Uploader::getInstance();		
		
	//$uploadDirectory = './wp-content/uploads/profile_avtars/';
	//$uploadDirectory = './wp-content/uploads/profile_bgs/';
	
	$uploader->setExtensionFilter(array('jpg', 'png', 'gif'));
	$uploader->setUploadDirectory($dir);
	$result = $uploader->upload($file);
	
	if( array_key_exists($result, $pm_ln_account_error_messages) ){
		
		$img_error_status = $pm_ln_account_error_messages[$result];
		return false;
		
	} 
	
	return true;
	
}

?>

<?php get_footer(); ?>