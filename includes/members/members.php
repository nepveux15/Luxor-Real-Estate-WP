<?php

//Restrict site login to administrators only
function pm_restrict_admin($user) {
		
	if( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		return;
	}
	
	if ( !current_user_can( 'manage_options' ) && !current_user_can('moderate_comments') && !current_user_can('edit_posts') && '/wp-admin/admin-ajax.php' != $_SERVER['PHP_SELF'] ) {
          wp_redirect( site_url() );
	}

}

//Check for failed login attempt and redirect user back to members login page
function pm_login_failed( $user ) {
	
	if( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		return;
	}
	
  	// check what page the login attempt is coming from
  	$referrer = $_SERVER['HTTP_REFERER'];

  	// check that were not on the default login page
	if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') && $user!=null ) {
		// make sure we don't already have a failed login attempt
		if ( !strstr($referrer, '?login=failed' )) {
			// Redirect to the login page and append a querystring of login failed
	    	wp_redirect( $referrer . '?login=failed');
	    } else {
	      	wp_redirect( $referrer );
	    }

	    exit;
	}
}

//Check for a blank login
function pm_check_login( $user, $username, $password ){
	
	if( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		return;
	}
	
  	// check what page the login attempt is coming from
	$referrer = '';
	
	if(isset($_SERVER['HTTP_REFERER'])) {
      $referrer = $_SERVER['HTTP_REFERER'];
    }
  	
  	$error = false;
  	
	if(isset($_POST['log'])){
		if($_POST['log'] == '' || $_POST['pwd'] == '') {
			$error = true;
		}
	}

  	// check that were not on the default login page
  	if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') && $error ) {

  		// make sure we don't already have a failed login attempt
    	if ( !strstr($referrer, '?login=failed') ) {
    		// Redirect to the login page and append a querystring of login failed
        	wp_redirect( $referrer . '?login=failed' );
      	} else {
        	wp_redirect( $referrer );
      	}

    	exit;

  	}
	
	//Set Session variables
	//$user = get_user_by('login', $username);
    //$_SESSION['user_avatar' ] = get_the_author_meta( 'user_avatar', $user->ID ); 
	
}

//Start a session if required
function pm_session_manager($user) {
	
	if ( function_exists('session_status') ) { //PHP >= 5.4.0
		
		 if (session_status() == PHP_SESSION_NONE) {
			session_start();
			
			/*$userID = get_current_user_id();
			$_SESSION['profile_avatar'] = get_the_author_meta( 'user_avatar', $userID );
			$_SESSION['profile_background_image'] = get_the_author_meta( 'user_background_image', $userID );*/
			
			//$_SESSION['test'] = 'User id =  ' . get_current_user_id();
			
		 }
		
	} else {
		
		if (!session_id()) { //PHP < 5.4.0
			session_start();
			
			$_SESSION['test'] = 'Testing session var 2';
			
		}
		
	}
   
}


/*function pm_set_session_vars($user) {
		
	$_SESSION['user_avatar'] = get_the_author_meta( 'user_avatar', $user->ID ); 
	$_SESSION['user_background_image'] = get_the_author_meta( 'user_background_image', $user->ID );
		
}*/

//Triggers for logouts
function pm_session_logout() {
	
	$_SESSION['logged_out'] = 'true';
	
	if(isset($_SESSION['user_firstname'])){
		unset($_SESSION['user_firstname']);
	}
	if(isset($_SESSION['user_prefix'])){
		unset($_SESSION['user_prefix']);
	}
	if(isset($_SESSION['user_middlename'])){
		unset($_SESSION['user_middlename']);
	}
	if(isset($_SESSION['user_lastname'])){
		unset($_SESSION['user_lastname']);
	}
	if(isset($_SESSION['user_suffix'])){
		unset($_SESSION['user_suffix']);
	}
	if(isset($_SESSION['user_designation'])){
		unset($_SESSION['user_designation']);
	}
	if(isset($_SESSION['user_title'])){
		unset($_SESSION['user_title']);
	}
	if(isset($_SESSION['user_organization'])){
		unset($_SESSION['user_organization']);
	}
	if(isset($_SESSION['user_email'])){
		unset($_SESSION['user_email']);
	}
	if(isset($_SESSION['user_workphone'])){
		unset($_SESSION['user_workphone']);
	}
	if(isset($_SESSION['user_homephone'])){
		unset($_SESSION['user_homephone']);
	}
	if(isset($_SESSION['user_faxnumber'])){
		unset($_SESSION['user_faxnumber']);
	}
	if(isset($_SESSION['user_website'])){
		unset($_SESSION['user_website']);
	}
	if(isset($_SESSION['user_address'])){
		unset($_SESSION['user_address']);
	}
	if(isset($_SESSION['user_city'])){
		unset($_SESSION['user_city']);
	}
	if(isset($_SESSION['user_state'])){
		unset($_SESSION['user_state']);
	}
	if(isset($_SESSION['user_zip'])){
		unset($_SESSION['user_zip']);
	}
	if(isset($_SESSION['user_country'])){
		unset($_SESSION['user_country']);
	}
	if(isset($_SESSION['user_avatar'])){
		unset($_SESSION['user_avatar']);
	}
	if(isset($_SESSION['user_background_image'])){
		unset($_SESSION['user_background_image']);
	}
	if(isset($_SESSION['user_twitter_account'])){
		unset($_SESSION['user_twitter_account']);
	}
	if(isset($_SESSION['user_facebook_account'])){
		unset($_SESSION['user_facebook_account']);
	}
	if(isset($_SESSION['user_linkedin_account'])){
		unset($_SESSION['user_linkedin_account']);
	}
	if(isset($_SESSION['user_google_plus_account'])){
		unset($_SESSION['user_google_plus_account']);
	}
	if(isset($_SESSION['user_instagram_account'])){
		unset($_SESSION['user_instagram_account']);
	}
	if(isset($_SESSION['user_youtube_account'])){
		unset($_SESSION['user_youtube_account']);
	}
	
    
	//Submit listing vars
	if(isset($_SESSION['pm_properties_title_meta'])){
		unset($_SESSION['pm_properties_title_meta']);
	}
	if(isset($_SESSION['pm_properties_address_meta'])){
		unset($_SESSION['pm_properties_address_meta']);
	}
	if(isset($_SESSION['pm_properties_state_meta'])){
		unset($_SESSION['pm_properties_state_meta']);
	}
	if(isset($_SESSION['pm_properties_city_meta'])){
		unset($_SESSION['pm_properties_city_meta']);
	}
	if(isset($_SESSION['pm_properties_country_meta'])){
		unset($_SESSION['pm_properties_country_meta']);
	}
	if(isset($_SESSION['pm_properties_zip_meta'])){
		unset($_SESSION['pm_properties_zip_meta']);
	}
	if(isset($_SESSION['pm_properties_description'])){
		unset($_SESSION['pm_properties_description']);
	}
	if(isset($_SESSION['pm_properties_amenities_meta'])){
		unset($_SESSION['pm_properties_amenities_meta']);
	}
	if(isset($_SESSION['pm_properties_type_meta'])){
		unset($_SESSION['pm_properties_type_meta']);
	}
	if(isset($_SESSION['pm_properties_rental_type_meta'])){
		unset($_SESSION['pm_properties_rental_type_meta']);
	}
	if(isset($_SESSION['pm_properties_status_meta'])){
		unset($_SESSION['pm_properties_status_meta']);
	}
	if(isset($_SESSION['pm_properties_category_meta'])){
		unset($_SESSION['pm_properties_category_meta']);
	}
	if(isset($_SESSION['pm_properties_price_meta'])){
		unset($_SESSION['pm_properties_price_meta']);
	}
	if(isset($_SESSION['pm_properties_size_meta'])){
		unset($_SESSION['pm_properties_size_meta']);
	}
	if(isset($_SESSION['pm_property_bedrooms_meta'])){
		unset($_SESSION['pm_property_bedrooms_meta']);
	}
	if(isset($_SESSION['pm_property_bathrooms_meta'])){
		unset($_SESSION['pm_property_bathrooms_meta']);
	}
	if(isset($_SESSION['pm_property_garages_meta'])){
		unset($_SESSION['pm_property_garages_meta']);
	}
	if(isset($_SESSION['pm_featured_video_url'])){
		unset($_SESSION['pm_featured_video_url']);
	}
	if(isset($_SESSION['pm_enable_video_mode'])){
		unset($_SESSION['pm_enable_video_mode']);
	}
	if(isset($_SESSION['pm_properties_address_lat_meta'])){
		unset($_SESSION['pm_properties_address_lat_meta']);
	}
	if(isset($_SESSION['pm_properties_address_long_meta'])){
		unset($_SESSION['pm_properties_address_long_meta']);
	}
	if(isset($_SESSION['new_post_id'])){
		unset($_SESSION['new_post_id']);
	}
	
	/*if(isset($_SESSION[''])){
		unset($_SESSION['']);
	}*/
	
	//session_destroy();
}


function restrict_dashboard() {
	if ( current_user_can( 'manage_options' ) ) {
		show_admin_bar(false);
	}	
}

//Custom admin fields
function pm_show_extra_profile_fields( $user ) { ?>

	<?php 
	
	$user_prefix = get_user_meta($user->ID, 'user_prefix', true); 
	$user_workphone = get_user_meta($user->ID, 'user_workphone', true); 
	$user_homephone = get_user_meta($user->ID, 'user_homephone', true); 
	$user_faxnumber = get_user_meta($user->ID, 'user_faxnumber', true); 
	$user_organization = get_user_meta($user->ID, 'user_organization', true); 
	$user_designation = get_user_meta($user->ID, 'user_designation', true); 
	$user_title = get_user_meta($user->ID, 'user_title', true); 
	$user_address = get_user_meta($user->ID, 'user_address', true); 
	$user_city = get_user_meta($user->ID, 'user_city', true); 
	$user_state = get_user_meta($user->ID, 'user_state', true); 
	$user_zip = get_user_meta($user->ID, 'user_zip', true); 
	$user_country = get_user_meta($user->ID, 'user_country', true); 
	$author_profile_url = get_user_meta($user->ID, 'author_profile_url', true); 
	
	$user_twitter_account = get_user_meta($user->ID, 'user_twitter_account', true); 
	$user_facebook_account = get_user_meta($user->ID, 'user_facebook_account', true); 
	$user_linkedin_account = get_user_meta($user->ID, 'user_linkedin_account', true); 
	$user_google_plus_account = get_user_meta($user->ID, 'user_google_plus_account', true); 
	$user_instagram_account = get_user_meta($user->ID, 'user_instagram_account', true); 
	$user_youtube_account = get_user_meta($user->ID, 'user_youtube_account', true); 
	
	$user_avatar = get_the_author_meta( 'user_avatar', $user->ID ); 
	$user_background_image = get_the_author_meta( 'user_background_image', $user->ID ); 
	
	$_SESSION['saved_user_avatar'] = $user_avatar;
	$_SESSION['saved_user_background_image'] = $user_background_image;
	
	
	?>

    <h3><?php esc_html_e('Member profile information', 'luxortheme'); ?></h3>

	<table class="form-table">

		<tr>
			<th><label for="author_title"><?php esc_html_e('Member ID #', 'luxortheme') ?></label></th>
			<td>
				<p><?php echo esc_attr($user->ID); ?></p>
			</td>
		</tr>

		<tr>
			<th><label for="user_prefix"><?php esc_html_e('Prefix','luxortheme'); ?></label></th>

			<td>
				<select name="user_prefix">
                  <option selected><?php esc_html_e('Prefix', 'luxortheme') ?></option>
                  <option value="mr" <?php selected( $user_prefix, 'mr' ); ?>><?php esc_html_e('Mr.','luxortheme'); ?></option>
                  <option value="ms" <?php selected( $user_prefix, 'ms' ); ?>><?php esc_html_e('Ms.','luxortheme'); ?></option>
                </select>
			</td>
		</tr>
        
        <tr>
			<th><label for="user_workphone"><?php esc_html_e('Work Phone','luxortheme'); ?></label></th>
			<td>
                <input name="user_workphone" class="regular-text" type="text" value="<?php echo esc_attr($user_workphone); ?>">
			</td>
		</tr>
        
        <tr>
			<th><label for="user_homephone"><?php esc_html_e('Home Phone','luxortheme'); ?></label></th>
			<td>
                <input name="user_homephone" class="regular-text" type="text" value="<?php echo esc_attr($user_homephone); ?>">
			</td>
		</tr>
        
        <tr>
			<th><label for="user_faxnumber"><?php esc_html_e('Fax Number','luxortheme'); ?></label></th>
			<td>
                <input name="user_faxnumber" class="regular-text" type="text" value="<?php echo esc_attr($user_faxnumber); ?>">
			</td>
		</tr>        
        
        <tr>
			<th><label for="user_organization"><?php esc_html_e('Organization','luxortheme'); ?></label></th>
			<td>
                <input name="user_organization" class="regular-text" type="text" value="<?php echo esc_attr($user_organization); ?>">
			</td>
		</tr>
        
        <tr>
			<th><label for="user_designation"><?php esc_html_e('Designation','luxortheme'); ?></label></th>
			<td>
                <input name="user_designation" class="regular-text" type="text" value="<?php echo esc_attr($user_designation); ?>">
			</td>
		</tr>
        
        <tr>
			<th><label for="user_title"><?php esc_html_e('Title','luxortheme'); ?></label></th>
			<td>
                <input name="user_title" class="regular-text" type="text" value="<?php echo esc_attr($user_title); ?>">
			</td>
		</tr>
        
        <tr>
			<th><label for="user_address"><?php esc_html_e('Address','luxortheme'); ?></label></th>
			<td>
                <input name="user_address" class="regular-text" type="text" value="<?php echo esc_attr($user_address); ?>">
			</td>
		</tr>
        
        <tr>
			<th><label for="user_city"><?php esc_html_e('City','luxortheme'); ?></label></th>
			<td>
                <input name="user_city" class="regular-text" type="text" value="<?php echo esc_attr($user_city); ?>">
			</td>
		</tr>
        
        <tr>
			<th><label for="user_state"><?php esc_html_e('State/Province','luxortheme'); ?></label></th>
			<td>
                <input name="user_state" class="regular-text" type="text" value="<?php echo esc_attr($user_state); ?>">
			</td>
		</tr>
        
        <tr>
			<th><label for="user_zip"><?php esc_html_e('Zip/Postal','luxortheme'); ?></label></th>
			<td>
                <input name="user_zip" class="regular-text" type="text" value="<?php echo esc_attr($user_zip); ?>">
			</td>
		</tr>
        
        <tr>
			<th><label for="user_country"><?php esc_html_e('Country','luxortheme'); ?></label></th>
			<td>
                <input name="user_country" class="regular-text" type="text" value="<?php echo esc_attr($user_country); ?>">
			</td>
		</tr> 
        
        
        <!-- Social Media fields -->
        <tr>
			<th><label for="user_twitter_account"><?php esc_html_e('Twitter Account','luxortheme'); ?></label></th>
			<td>
                <input name="user_twitter_account" class="regular-text" type="text" value="<?php echo esc_attr($user_twitter_account); ?>">
			</td>
		</tr> 
        
        <tr>
			<th><label for="user_facebook_account"><?php esc_html_e('Facebook Account','luxortheme'); ?></label></th>
			<td>
                <input name="user_facebook_account" class="regular-text" type="text" value="<?php echo esc_attr($user_facebook_account); ?>">
			</td>
		</tr> 
        
        <tr>
			<th><label for="user_linkedin_account"><?php esc_html_e('Linkedin Account','luxortheme'); ?></label></th>
			<td>
                <input name="user_linkedin_account" class="regular-text" type="text" value="<?php echo esc_attr($user_linkedin_account); ?>">
			</td>
		</tr> 
        
        <tr>
			<th><label for="user_google_plus_account"><?php esc_html_e('Google Plus Account','luxortheme'); ?></label></th>
			<td>
                <input name="user_google_plus_account" class="regular-text" type="text" value="<?php echo esc_attr($user_google_plus_account); ?>">
			</td>
		</tr> 
        
        <tr>
			<th><label for="user_instagram_account"><?php esc_html_e('Instagram Account','luxortheme'); ?></label></th>
			<td>
                <input name="user_instagram_account" class="regular-text" type="text" value="<?php echo esc_attr($user_instagram_account); ?>">
			</td>
		</tr> 
        
        <tr>
			<th><label for="user_youtube_account"><?php esc_html_e('Youtube Account','luxortheme'); ?></label></th>
			<td>
                <input name="user_youtube_account" class="regular-text" type="text" value="<?php echo esc_attr($user_youtube_account); ?>">
			</td>
		</tr> 
        
        

        
        <tr>
			<th><label for="user_avatar"><?php esc_html_e('Profile Avatar','luxortheme'); ?> (.jpg, .gif or .png)  <br /><br /><?php esc_html_e('220x220px recommended','luxortheme'); ?></label></th>
			<td>
            
            	<input type="text" name="user_avatar" id="user_avatar" value="<?php echo esc_html($user_avatar); ?>" class="regular-text" style="width:40%;" />
            
            	<input type='button' class="user-avatar-image button-primary" value="<?php esc_html_e( 'Upload Image', 'luxortheme' ); ?>" id="user-avatar-image"/>
            
                <div class="pm-elite-member-logo-preview">
                
                    <?php if($user_avatar !== '') { ?>
                    
                        <p><?php esc_html_e( 'Current Avatar:', 'luxortheme' ); ?></p>
                        
                        <img src="<?php echo esc_html($user_avatar); ?>" />
                    
                    <?php } else { ?>
                    
                        <p><?php esc_html_e( 'There is currently no profile avatar attached to this account.', 'luxortheme' ); ?></p>
                    
                    <?php } ?>
                                    
                </div>
			</td>
		</tr>   
        
        
        <tr>
			<th><label for="user_background_image"><?php esc_html_e('Profile Background Image','luxortheme'); ?> (.jpg, .gif or .png) <br /><br /><?php esc_html_e('1920x500px recommended','luxortheme'); ?></label></th>
			<td>
            
            	<input type="text" name="user_background_image" id="user_background_image" value="<?php echo esc_html($user_background_image); ?>" class="regular-text" style="width:40%;" />
            
            	<input type='button' class="user-background-image button-primary" value="<?php esc_html_e( 'Upload Image', 'luxortheme' ); ?>" id="user-background-image"/>
            
                <div class="pm-user-admin-image-preview-container">
                
                    <?php if($user_background_image !== '') { ?>
                    
                        <p><?php esc_html_e( 'Current Background Image:', 'luxortheme' ); ?></p>
                        
                        <img src="<?php echo esc_html($user_background_image); ?>" />
                    
                    <?php } else { ?>
                    
                        <p><?php esc_html_e( 'There is currently no profile background image attached to this account.', 'luxortheme' ); ?></p>
                    
                    <?php } ?>
                                    
                </div>
			</td>
		</tr>     

	</table>
	
<?php }

function pm_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'manage_options' )  )
		return false;

	/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
	update_user_meta( $user_id, 'user_prefix', $_POST['user_prefix'] );
	update_user_meta( $user_id, 'user_workphone', $_POST['user_workphone'] );
	update_user_meta( $user_id, 'user_homephone', $_POST['user_homephone'] );
	update_user_meta( $user_id, 'user_faxnumber', $_POST['user_faxnumber'] );
	update_user_meta( $user_id, 'user_organization', $_POST['user_organization'] );
	update_user_meta( $user_id, 'user_designation', $_POST['user_designation'] );
	update_user_meta( $user_id, 'user_title', $_POST['user_title'] );
	update_user_meta( $user_id, 'user_address', $_POST['user_address'] );
	update_user_meta( $user_id, 'user_city', $_POST['user_city'] );
	update_user_meta( $user_id, 'user_state', $_POST['user_state'] );
	update_user_meta( $user_id, 'user_zip', $_POST['user_zip'] );
	update_user_meta( $user_id, 'user_country', $_POST['user_country'] );
	update_user_meta( $user_id, 'author_profile_url', $_POST['author_profile_url'] );
	update_user_meta( $user_id, 'user_avatar', $_POST['user_avatar'] );
	update_user_meta( $user_id, 'user_background_image', $_POST['user_background_image'] );
	
	update_user_meta( $user_id, 'user_twitter_account', $_POST['user_twitter_account'] );
	update_user_meta( $user_id, 'user_facebook_account', $_POST['user_facebook_account'] );
	update_user_meta( $user_id, 'user_linkedin_account', $_POST['user_linkedin_account'] );
	update_user_meta( $user_id, 'user_google_plus_account', $_POST['user_google_plus_account'] );
	update_user_meta( $user_id, 'user_instagram_account', $_POST['user_instagram_account'] );
	update_user_meta( $user_id, 'user_youtube_account', $_POST['user_youtube_account'] );
	
	
}



function pm_redirect_user( $user_id ) {

    $membersAreaSlug = get_option('pm_members_area_template_slug');
	
	wp_redirect( site_url('/'.$membersAreaSlug) );
	exit;

}

//add_action( 'user_register', 'pm_redirect_user', 10, 1 );

//Restrict dashboard bar to administrators only
add_action('wp_login', 'restrict_dashboard', 1);

//Session management
add_action('init', 'pm_session_manager', 1);
add_action('wp_logout', 'pm_session_logout');
//add_action('wp_login', 'pm_set_session_vars');

//restrict admin to administrators only
add_action( 'admin_init', 'pm_restrict_admin', 1 );


//failed login check
add_action( 'wp_login_failed', 'pm_login_failed' ); 

//Empty username or password check
add_action( 'authenticate', 'pm_check_login', 10, 3); 

//Disable WP admin bar
//add_filter('show_admin_bar', '__return_false');

//Add new user profile fields
add_action( 'show_user_profile', 'pm_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'pm_show_extra_profile_fields' );

add_action( 'personal_options_update', 'pm_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'pm_save_extra_profile_fields' );

?>