<?php /* Template Name: Members Submit Listing Template */ ?>
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
		$thumbnail_success = '';
		$featured_image_success = '';
		$form_success = null;
		
		//user is logged in, retrive user info
		$current_user = wp_get_current_user();
					
		$user_roles = $current_user->roles;
		$user_role = array_shift($user_roles);
		$user_role = str_replace('_', ' ', $user_role);
		$user_role = strtoupper($user_role);
						
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
			
		
	} else {
		
		//redirect page back to homepage
		wp_redirect( home_url('/') );
		exit;
		
	}

?>

<?php 
	
	//Check if form was submitted
	if( isset($_POST['pm-property-form-submitted']) ){
		
		//verify nonce
		if ( !isset( $_POST['pm_property_form_nonce'] ) || !wp_verify_nonce( $_POST['pm_property_form_nonce'], 'pm-property-form-submitted' ) ) {
			return;
		}
		
		$allowed_html = array(
			'a' => array(
				'href' => array(),
				'title' => array()
			),
			'br' => array(),
			'em' => array(),
			'strong' => array(),
			'h4' => array(),
			'p' => array(),
			'b' => array(),
			'i' => array(),
			'span' => array(),
		);
			
		//Capture fields into session vars
		$_SESSION['pm_properties_title_meta'] = sanitize_text_field($_POST['pm_properties_title_meta']);//gets inserted through wp_post_insert
		
		$_SESSION['pm_properties_address_meta'] = sanitize_text_field($_POST['pm_properties_address_meta']);
		$_SESSION['pm_properties_state_meta'] = sanitize_text_field($_POST['pm_properties_state_meta']);
		$_SESSION['pm_properties_city_meta'] = sanitize_text_field($_POST['pm_properties_city_meta']);
		$_SESSION['pm_properties_country_meta'] = sanitize_text_field($_POST['pm_properties_country_meta']);
		$_SESSION['pm_properties_zip_meta'] = sanitize_text_field($_POST['pm_properties_zip_meta']);
		
		//$_SESSION['pm_properties_description'] = wp_kses($_POST['pm_properties_description'], $allowed_html);//gets inserted through wp_post_insert
		$_SESSION['pm_properties_description'] = $_POST['pm_properties_description'];//gets inserted through wp_post_insert
		
		
		if( isset($_POST['pm_properties_amenities_meta']) ){
			$_SESSION['pm_properties_amenities_meta'] = $_POST['pm_properties_amenities_meta'];//Array value
		} else {
			$_SESSION['pm_properties_amenities_meta'] = array();//Array value
		}
				
		$_SESSION['pm_properties_type_meta'] = intval($_POST['pm_properties_type_meta']);
		
		$_SESSION['pm_properties_rental_type_meta'] = $_POST['pm_properties_rental_type_meta'];
		$_SESSION['pm_properties_status_meta'] = $_POST['pm_properties_status_meta'];
		
		$_SESSION['pm_properties_category_meta'] = intval($_POST['pm_properties_category_meta']);//gets inserted after post is created - intval method is required in order for category to get saved correctly
		
		$_SESSION['pm_properties_price_meta'] = sanitize_text_field($_POST['pm_properties_price_meta']);
		$_SESSION['pm_properties_size_meta'] = sanitize_text_field($_POST['pm_properties_size_meta']);
		$_SESSION['pm_property_bedrooms_meta'] = sanitize_text_field($_POST['pm_property_bedrooms_meta']);
		$_SESSION['pm_property_bathrooms_meta'] = sanitize_text_field($_POST['pm_property_bathrooms_meta']);
		$_SESSION['pm_property_garages_meta'] = sanitize_text_field($_POST['pm_property_garages_meta']);
		
		$_SESSION['pm_featured_video_url'] = sanitize_text_field($_POST['pm_featured_video_url']);
		$_SESSION['pm_enable_video_mode'] = $_POST['pm_enable_video_mode'];
		$_SESSION['pm_page_print_share_meta'] = $_POST['pm_page_print_share_meta'];
		
		$_SESSION['pm_properties_featured_meta'] = $_POST['pm_properties_featured_meta'];
		
		$_SESSION['pm_properties_address_lat_meta'] = sanitize_text_field($_POST['pm_properties_address_lat_meta']);
		$_SESSION['pm_properties_address_long_meta'] = sanitize_text_field($_POST['pm_properties_address_long_meta']);
		
		$_SESSION['pm_assign_agent_meta'] = sanitize_text_field($_POST['pm_assign_agent_meta']);
		
		
		//Save data first so we can get post ID for folder creation
		
		$post_slug = str_replace(" ", "-", strtolower($_SESSION['pm_properties_title_meta']) ); //required for post slug name
		
		$post = array(
		  //'ID'             => [ <post id> ] // Are you updating an existing post?
		  'post_content'   => $_SESSION['pm_properties_description'] ,// The full text of the post.
		  'post_name'      => $post_slug, // The name (slug) for your post
		  'post_title'     => $_SESSION['pm_properties_title_meta'], // The title of your post.
		  'post_status'    => 'publish', // Default 'draft'.
		  'post_type'      => 'post_properties', // Default 'post'.
		  'post_author'    => $current_user->ID,  // The user ID number of the author. Default is the current user ID.
		  'ping_status'    => 'closed', // Pingbacks or trackbacks allowed. Default is the option 'default_ping_status'.
		  //'post_parent'    => [ <post ID> ] // Sets the parent of the new post, if any. Default 0.
		  //'menu_order'     => [ <order> ] // If new post is a page, sets the order in which it should appear in supported menus. Default 0.
		  //'to_ping'        => // Space or carriage return-separated list of URLs to ping. Default empty string.
		  //'pinged'         => // Space or carriage return-separated list of URLs that have been pinged. Default empty string.
		  //'post_password'  => [ <string> ] // Password for post, if any. Default empty string.
		  //'guid'           => // Skip this and let Wordpress handle it, usually.
		  //'post_content_filtered' => // Skip this and let Wordpress handle it, usually.
		  //'post_excerpt'   => [ <string> ] // For all your post excerpt needs.
		  'post_date'      => date('Y-m-d H:i:s'), // The time post was made.
		  'post_date_gmt'  => date('Y-m-d H:i:s'), // The time post was made, in GMT.
		  'comment_status' => 'closed', // Default is the option 'default_comment_status', or 'closed'.
		  //'post_category'  => array($_SESSION['pm_properties_category_meta']), // Default empty.
		  //'tags_input'     => [ '<tag>, <tag>, ...' | array ] // Default empty.
		  //'tax_input'      => array( 'propertycats' => $_SESSION['pm_properties_category_meta'] ) // For custom taxonomies. Default empty.    propertycats
		  //'page_template'  => [ <string> ] // Requires name of template file, eg template.php. Default empty.
		);  
		
		$post_id = wp_insert_post( $post, true );
		
		if($post_id){
			
			//echo 'Post has been saved.';
			$_SESSION['new_post_id'] = $post_id;
			
			//Save the category relationship - this method is required for users who do not have high enough priveleges
			wp_set_object_terms( $_SESSION['new_post_id'], array($_SESSION['pm_properties_category_meta']), 'propertycats');
			wp_set_object_terms( $_SESSION['new_post_id'], array($_SESSION['pm_properties_type_meta']), 'propertysaletypes');
			
			//Save meta data
			update_post_meta($post_id, "pm_properties_address_meta", $_SESSION['pm_properties_address_meta']);
			update_post_meta($post_id, "pm_properties_state_meta", $_SESSION['pm_properties_state_meta']);
			update_post_meta($post_id, "pm_properties_city_meta", $_SESSION['pm_properties_city_meta']);
			update_post_meta($post_id, "pm_properties_country_meta", $_SESSION['pm_properties_country_meta']);
			update_post_meta($post_id, "pm_properties_zip_meta", $_SESSION['pm_properties_zip_meta']);
			
			update_post_meta($post_id, "pm_properties_type_meta", $_SESSION['pm_properties_type_meta']); //Store a reference to taxonomy id so we can use it anywhere with get_terms method
			update_post_meta($post_id, "pm_properties_rental_type_meta", $_SESSION['pm_properties_rental_type_meta']);
			
			update_post_meta($post_id, "pm_properties_status_meta", $_SESSION['pm_properties_status_meta']);
			update_post_meta($post_id, "pm_featured_video_url", $_SESSION['pm_featured_video_url']);
			update_post_meta($post_id, "pm_enable_slider_system", 'no');
			update_post_meta($post_id, "pm_enable_video_mode", $_SESSION["pm_enable_video_mode"]);
			update_post_meta($post_id, "pm_page_print_share_meta", $_SESSION["pm_page_print_share_meta"]);
			
			update_post_meta($post_id, "pm_properties_featured_meta", $_SESSION["pm_properties_featured_meta"]);
						
			update_post_meta($post_id, "pm_properties_address_lat_meta", $_SESSION["pm_properties_address_lat_meta"]);
			update_post_meta($post_id, "pm_properties_address_long_meta", $_SESSION["pm_properties_address_long_meta"]);
			update_post_meta($post_id, "pm_properties_price_meta", $_SESSION["pm_properties_price_meta"]);
			update_post_meta($post_id, "pm_properties_size_meta", $_SESSION["pm_properties_size_meta"]);
			
			update_post_meta($post_id, "pm_property_bedrooms_meta", $_SESSION['pm_property_bedrooms_meta']);
			update_post_meta($post_id, "pm_property_bathrooms_meta", $_SESSION['pm_property_bathrooms_meta']);
			update_post_meta($post_id, "pm_property_garages_meta", $_SESSION['pm_property_garages_meta']);
			
			//Only save amenities if it is an array
			update_post_meta($post_id, "pm_properties_amenities_meta", $_SESSION["pm_properties_amenities_meta"]);
			
			//ARE WE ASSIGNING THIS POST TO AN AGENT?
			update_post_meta($post_id, "pm_assign_agent_meta", $_SESSION['pm_assign_agent_meta']); //Keep track of whom we've assigned the post to
			
			if( $_SESSION['pm_assign_agent_meta'] !== 'default' ) {
				
				//Assign post to agent
				
				// update the post
				$args = array('ID' => $post_id, 'post_author' => $_POST['pm_assign_agent_meta']);
				
				// update the post, which calls save_post again
				wp_update_post( $args );
				
			}
						
			//UPLOAD IMAGES
			
			//Create property directory first to store all properties in - this is required
			$uploader = Uploader::getInstance();	
			$uploader->setUploadDirectory('./wp-content/uploads/properties/');
						
			if ( $_FILES["pm_properties_thumb_image_meta"]["size"] != 0 ) {//check if image is present
				
				if( uploadImage($_FILES['pm_properties_thumb_image_meta'], './wp-content/uploads/properties/property_'.$post_id.'') == false ){
													
					$thumbnail_success = false;
					
				} else {
					
					$thumbnail_success = true;
					$filePath = 'uploads/properties/property_'.$post_id.'/' . $_FILES['pm_properties_thumb_image_meta']['name'];
					$content_url = content_url($filePath);
					update_post_meta($post_id, "pm_properties_thumb_image_meta", $content_url);
						
				}
				
			}//end if
			
			if ( $_FILES["pm_properties_image_meta"]["size"] != 0 ) {//check if image is present
				
				if( uploadImage($_FILES['pm_properties_image_meta'], './wp-content/uploads/properties/property_'.$post_id.'') == false ){
													
					$featured_image_success = false;
					
				} else {
					
					$featured_image_success = true;
					$filePath = 'uploads/properties/property_'.$post_id.'/' . $_FILES['pm_properties_image_meta']['name'];
					$content_url = content_url($filePath);
					update_post_meta($post_id, "pm_properties_image_meta", $content_url);
						
				}
				
			}//end if
			
			$form_success = true;
			
		} else {
		
			$form_success = false;
			
		}
		
	}//end if
	
?>

<div class="container pm-containerPadding-top-100">
    <div class="row">
        <div class="col-lg-12">
        
        	<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
				<?php the_content(); ?>
            <?php endwhile; else: ?>
            <?php endif; ?>
        
        
        </div>
    </div>                 
</div>

<?php if( $form_success === true ) {//post and images were successfully saved ?>

	<!-- Success message -->
	<div class="container pm-containerPadding-top-20">
        <div class="row">
            <div class="col-lg-12">
            
                <p class="pm-center pm-success-message"><?php esc_html_e('Congratulations, your property has been submitted and is now live. Feel free to post a new submission.', 'luxortheme'); ?></p>
                
                <p class="pm-center"><a href="<?php echo get_permalink($_SESSION['new_post_id']); ?>" class="pm-secondary" target="_blank"><?php esc_html_e('View Property', 'luxortheme'); ?></a> 
                
                -
                
				<?php 
                    //Get edit property listing slug from members plugin
                    $pm_members_edit_listing_slug = get_option('pm_members_edit_listing_slug');
                    $editURL = $pm_members_edit_listing_slug . '/?property=' . $_SESSION['new_post_id'];
                ?>
                
                <a href="<?php echo site_url($editURL); ?>" class="pm-secondary"><?php esc_html_e('Edit Property','luxortheme'); ?></a></p>
                
                
                <?php if($_SESSION['pm_assign_agent_meta'] !== 'default') { //Post has been assigned to another agent - display message ?>
                
                	<?php 
						
						//Retrieve agent name
						$agent_args = array(  
                            'include' => array( $_SESSION['pm_assign_agent_meta'] )
                        );
                        $agent_query = new WP_User_Query($agent_args);
						
						if ( ! empty( $agent_query->results ) ) {
							foreach ( $agent_query->results as $user ) {								
								echo '<p class="pm-center">' . __('This property has been assigned to the following agent:', 'luxortheme') . ' ' . $user->display_name . '</p>';								
							}
						}
						
						
					?>
                
                	<?php //echo '<p class="pm-center">' . __('This property has been assigned to the following agent:', 'luxortheme') . $_SESSION['pm_assign_agent_meta'] . '</p>'; ?>
                
                <?php } else { ?>
                
                	<!-- - -->
                
					<?php 
                        //Get edit property listing slug from members plugin
                        //$pm_members_edit_listing_slug = get_option('pm_members_edit_listing_slug');
                        //$editURL = $pm_members_edit_listing_slug . '/?property=' . $_SESSION['new_post_id'];
                    ?>
                    
                    <!--<a href="<?php //echo site_url($editURL); ?>" class="pm-secondary"><?php //esc_html_e('Edit Property','luxortheme'); ?></a></p>-->
                
                <?php } ?>
                
                <?php if($thumbnail_success === false || $featured_image_success === false) { ?>

					<?php if($thumbnail_success === false) : ?>
                    
                    	<?php 
                        echo '<p class="pm-center pm-error-message">' . esc_html__('Invalid thumbnail image was detected during the save process. Please click on the "Edit Property" button and re-upload your property thumbnail image.','luxortheme') . '</p>';
						
                    ?>
                    
                    <?php endif; ?>
                    
                    <?php if($featured_image_success === false) : ?>
                    
                    	<?php 
                        echo '<p class="pm-center pm-error-message">' . esc_html__('Invalid property image was detected during the save process. Please click on the "Edit Property" button and re-upload your property image.','luxortheme') . '</p>';
						
                    ?>
                    
                    <?php endif; ?>
                
                <?php } ?>
            
            </div>
        </div>                 
    </div>
    <!-- Success message end -->

	<?php 
	
		//UNSET ALL SESSION VARS
		if( isset($_SESSION['pm_properties_title_meta']) ){
			unset($_SESSION['pm_properties_title_meta']);
		}
		
		if( isset($_SESSION['pm_properties_address_meta']) ){
			unset($_SESSION['pm_properties_address_meta']);
		}
		
		if( isset($_SESSION['pm_properties_state_meta']) ){
			unset($_SESSION['pm_properties_state_meta']);
		}
		
		if( isset($_SESSION['pm_properties_city_meta']) ){
			unset($_SESSION['pm_properties_city_meta']);
		}
		
		if( isset($_SESSION['pm_properties_country_meta']) ){
			unset($_SESSION['pm_properties_country_meta']);
		}
		
		if( isset($_SESSION['pm_properties_zip_meta']) ){
			unset($_SESSION['pm_properties_zip_meta']);
		}
		
		if( isset($_SESSION['pm_properties_description']) ){
			unset($_SESSION['pm_properties_description']);
		}
		
		if( isset($_SESSION['pm_properties_amenities_meta']) ){
			unset($_SESSION['pm_properties_amenities_meta']);
		}
		
		if( isset($_SESSION['pm_properties_type_meta']) ){
			unset($_SESSION['pm_properties_type_meta']);
		}
		
		if( isset($_SESSION['pm_properties_rental_type_meta']) ){
			unset($_SESSION['pm_properties_rental_type_meta']);
		}
		
		if( isset($_SESSION['pm_properties_status_meta']) ){
			unset($_SESSION['pm_properties_status_meta']);
		}
		
		if( isset($_SESSION['pm_properties_category_meta']) ){
			unset($_SESSION['pm_properties_category_meta']);
		}
		
		if( isset($_SESSION['pm_properties_price_meta']) ){
			unset($_SESSION['pm_properties_price_meta']);
		}
		
		if( isset($_SESSION['pm_properties_size_meta']) ){
			unset($_SESSION['pm_properties_size_meta']);
		}
		
		if( isset($_SESSION['pm_property_bedrooms_meta']) ){
			unset($_SESSION['pm_property_bedrooms_meta']);
		}
		
		if( isset($_SESSION['pm_property_bathrooms_meta']) ){
			unset($_SESSION['pm_property_bathrooms_meta']);
		}
		
		if( isset($_SESSION['pm_property_garages_meta']) ){
			unset($_SESSION['pm_property_garages_meta']);
		}
		
		if( isset($_SESSION['pm_featured_video_url']) ){
			unset($_SESSION['pm_featured_video_url']);
		}
		
		if( isset($_SESSION['pm_enable_video_mode']) ){
			unset($_SESSION['pm_enable_video_mode']);
		}
		
		if( isset($_SESSION['pm_page_print_share_meta']) ){
			unset($_SESSION['pm_page_print_share_meta']);
		}
		
		if( isset($_SESSION['pm_properties_featured_meta']) ){
			unset($_SESSION['pm_properties_featured_meta']);
		}	
		
		if( isset($_SESSION['pm_properties_address_lat_meta']) ){
			unset($_SESSION['pm_properties_address_lat_meta']);
		}
		
		if( isset($_SESSION['pm_properties_address_long_meta']) ){
			unset($_SESSION['pm_properties_address_long_meta']);
		}
		
		if( isset($_SESSION['pm_assign_agent_meta']) ){
			unset($_SESSION['pm_assign_agent_meta']);
		}
	
	?>
    
<?php } ?>





<form action="<?php echo get_permalink(); ?>" method="post" enctype="multipart/form-data">

    <div class="container pm-containerPadding-top-50 pm-containerPadding-bottom-50">
    
    	<?php if($form_success === false) : ?>
            
            <div class="row">
            	<div class="col-lg-12 pm-column-spacing">
            		<p class="pm-center pm-error-message"><?php esc_html_e('A system error occurred. Please try your submission again.', 'luxortheme'); ?></p>
                </div>
        	</div>
            
        <?php endif; ?>
    
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 pm-column-spacing">
                
                <h2><?php esc_html_e('Property Information', 'luxortheme'); ?></h2>
                <div class="pm-column-title-divider-simple">
                    <div class="pm-column-title-divider-simple-end-point"></div>
                </div>
                
                <br>
                                
                <input type="text" class="pm-textfield members" value="<?php echo isset($_SESSION['pm_properties_title_meta']) ? $_SESSION['pm_properties_title_meta'] : '' ?>" name="pm_properties_title_meta" placeholder="<?php esc_html_e('Property Title', 'luxortheme'); ?>" required />
                                
                <input type="text" class="pm-textfield members" value="<?php echo isset($_SESSION['pm_properties_address_meta']) ? $_SESSION['pm_properties_address_meta'] : '' ?>" name="pm_properties_address_meta" placeholder="<?php esc_html_e('Street Address', 'luxortheme'); ?>" required />
                
                <input type="text" class="pm-textfield members" value="<?php echo isset($_SESSION['pm_properties_city_meta']) ? $_SESSION['pm_properties_city_meta'] : '' ?>" name="pm_properties_city_meta" placeholder="<?php esc_html_e('City', 'luxortheme'); ?>" required />
                
                <input type="text" class="pm-textfield members" value="<?php echo isset($_SESSION['pm_properties_state_meta']) ? $_SESSION['pm_properties_state_meta'] : '' ?>" name="pm_properties_state_meta" placeholder="<?php esc_html_e('State / Province', 'luxortheme'); ?>" required />
                
                <input type="text" class="pm-textfield members" value="<?php echo isset($_SESSION['pm_properties_country_meta']) ? $_SESSION['pm_properties_country_meta'] : '' ?>" name="pm_properties_country_meta" placeholder="<?php esc_html_e('Country', 'luxortheme'); ?>" required />
                

                <input type="text" class="pm-textfield members" value="<?php echo isset($_SESSION['pm_properties_zip_meta']) ? $_SESSION['pm_properties_zip_meta'] : '' ?>" name="pm_properties_zip_meta" placeholder="<?php esc_html_e('Zip / Postal Code', 'luxortheme'); ?>" required />
                
                <br><br>
                
                <p><?php esc_html_e('Property Details', 'luxortheme'); ?></p>
                
                <?php 
				
					$content = isset($_SESSION['pm_properties_description']) ? $_SESSION['pm_properties_description'] : '';
					$editor_id = 'property_post_editor';
					$args = array(
						'textarea_name' => 'pm_properties_description',
						'editor_height' => 130
					);
					
					wp_editor($content, $editor_id, $args); 
				
				?>
                                
                <!--<textarea class="pm-textarea members" name="pm_properties_description" placeholder="<?php //esc_html_e('Property Description', 'luxortheme'); ?>"><?php //echo isset($_SESSION['pm_properties_description']) ? $_SESSION['pm_properties_description'] : '' ?></textarea>
                
                <p class="pm-members-form-font"><?php //esc_html_e('Allowed Tags: a, br, em, strong, h4, p, b, i, span', 'luxortheme'); ?> </p>-->
                
            </div>
            
            <div class="col-lg-4 col-md-4 col-sm-12 pm-members-form-amenities pm-column-spacing">
                
                <h2><?php esc_html_e('Amenities', 'luxortheme'); ?></h2>
                <div class="pm-column-title-divider-simple">
                    <div class="pm-column-title-divider-simple-end-point"></div>
                </div>
                
                <br>
                
                <?php 
					//Retrieve amentities
					$amentities_type_terms = get_terms( 'propertyamenitiestypes', array(
						'orderby'    => 'count',
						'hide_empty' => 0 // 0 = false (shows all categories even if unassigned)
					) );
					
				?>
                
                <?php if( !empty($amentities_type_terms) ) { ?>
                                
                	<?php foreach ($amentities_type_terms as $term) { ?>

                        <label>
                            <input type="checkbox" name="pm_properties_amenities_meta[]" value="<?php echo $term->name; ?>">
                            <?php echo $term->name; ?>
                        </label>
                        <div class="pm-members-form-break"></div>
                    
                    <?php } ?>
                
                <?php } else { ?>
                
                	<?php echo esc_attr('No amentities were found.','luxortheme'); ?>
                
                <?php } ?>                
                  
            </div>
            
            <div class="col-lg-4 col-md-4 col-sm-12 pm-column-spacing">
                
                <h2><?php esc_html_e('Additional information', 'luxortheme'); ?></h2>
                <div class="pm-column-title-divider-simple">
                    <div class="pm-column-title-divider-simple-end-point"></div>
                </div>
                
                <br>
                
                <?php 
					$sale_type_terms = get_terms( 'propertysaletypes', array(
						'orderby'    => 'count',
						'hide_empty' => 0 // 0 = false (shows all categories even if unassigned)
					) );
					//print_r($terms);
				?>
                
                <select class="pm-admin-select-list" name="pm_properties_type_meta" id="pm_properties_type_select_meta" required>  
                
                    <option value="">-- <?php esc_html_e('Sale Type', 'luxortheme'); ?> --</option>
                    
                    <?php if( isset( $_SESSION['pm_properties_type_meta'] ) ) { ?>
                    
                    	<?php
							foreach ($sale_type_terms as $term) { ?>
								<option value="<?php echo esc_attr($term->term_id) ?>" data-showpaymentterms="<?php echo trim($term->description) ?>" <?php selected( $_SESSION['pm_properties_type_meta'], $term->term_id) ?>><?php echo ucfirst($term->name) ?></option>
							<?php }
						?>
                    
                    <?php } else { ?>
                    
                    	<?php
							foreach ($sale_type_terms as $term) { ?>
								<option value="<?php echo $term->term_id ?>" data-showpaymentterms="<?php echo trim($term->description) ?>"><?php echo ucfirst($term->name) ?></option>
							<?php }
						?>
                    
                    <?php } ?>
                                        
                </select>
                
                
                <?php 
					$payment_terms = get_terms( 'propertypaymentterms', array(
						'orderby'    => 'count',
						'hide_empty' => 0 // 0 = false (shows all categories even if unassigned)
					) );
					//print_r($terms);
				?>
                
                <?php if( isset( $_SESSION['pm_properties_rental_type_meta'] ) ) { ?>
                
                	<?php if( $_SESSION['pm_properties_rental_type_meta'] !== 'default' ) { ?>
                    	<select id="pm_properties_rental_type_meta" name="pm_properties_rental_type_meta" class="pm-admin-select-list pm-properties-rental-type-container visible">
                    <?php } else { ?>
                    	<select id="pm_properties_rental_type_meta" name="pm_properties_rental_type_meta" class="pm-admin-select-list pm-properties-rental-type-container hidden">
                    <?php } ?>
                    
                    	<option value="default">-- <?php esc_html_e('Payment Terms', 'luxortheme') ?> --</option>    
                        
                        
                        <?php if( isset( $_SESSION['pm_properties_rental_type_meta'] ) ) { ?>
                    
							<?php
                                foreach ($payment_terms as $term) {
                                    echo '<option value="'.$term->name.'" '. selected( $_SESSION['pm_properties_rental_type_meta'], $term->name ) .'>'.ucfirst($term->name).'</option>';	
                                }
                            ?>
                        
                        <?php } else { ?>
                        
                            <?php
                                foreach ($payment_terms as $term) {
                                    echo '<option value="'.$term->name.'">'.ucfirst($term->name).'</option>';	
                                }
                            ?>
                        
                        <?php } ?>                    
                                                
                        
                    </select>
                
                <?php } else { ?>
                
                	<select id="pm_properties_rental_type_meta" name="pm_properties_rental_type_meta" class="pm-admin-select-list pm-properties-rental-type-container hidden">
                    
                        <option value="default">-- <?php esc_html_e('Payment Terms', 'luxortheme') ?> --</option>
                        
                        <?php if( isset( $_SESSION['pm_properties_rental_type_meta'] ) ) { ?>
                    
							<?php
                                foreach ($payment_terms as $term) {
                                    echo '<option value="'.$term->name.'" '. selected( $_SESSION['pm_properties_rental_type_meta'], $term->name ) .'>'.ucfirst($term->name).'</option>';	
                                }
                            ?>
                        
                        <?php } else { ?>
                        
                            <?php
                                foreach ($payment_terms as $term) {
                                    echo '<option value="'.$term->name.'">'.ucfirst($term->name).'</option>';	
                                }
                            ?>
                        
                        <?php } ?>
                        
                    </select>
                
                <?php }  ?>
                
                
                <?php 
					$status_type_terms = get_terms( 'propertystatustypes', array(
						'orderby'    => 'count',
						'hide_empty' => 0 // 0 = false (shows all categories even if unassigned)
					) );
					//print_r($terms);
				?>
                
                <select class="pm-admin-select-list" name="pm_properties_status_meta" id="pm_properties_status_meta" required> 
                
                	<option value="">-- <?php esc_html_e('Property Status', 'luxortheme'); ?> --</option>
                    
                    <?php if( isset( $_SESSION['pm_properties_status_meta'] ) ) { ?>
                    
                    	<?php
							foreach ($status_type_terms as $term) {
								echo '<option value="'.$term->name.'" '. selected( $_SESSION['pm_properties_status_meta'], $term->name ) .'>'.ucfirst($term->name).'</option>';	
							}
						?>
                    
                    <?php } else { ?>
                    
                    	<?php
							foreach ($status_type_terms as $term) {
								echo '<option value="'.$term->name.'">'.ucfirst($term->name).'</option>';	
							}
						?>
                    
                    <?php } ?>
                    
                                        
                </select>
                
                <?php 
					$terms = get_terms( 'propertycats', array(
						'orderby'    => 'count',
						'hide_empty' => 0 // 0 = false (shows all categories even if unassigned)
					) );
					//print_r($terms);
				?>
                                
                <select class="pm-admin-select-list" name="pm_properties_category_meta" required>  
                	<option value="">-- <?php esc_html_e('Property Category', 'luxortheme'); ?> --</option>
                    
                    <?php if( isset( $_SESSION['pm_properties_category_meta'] ) ) { ?>
                    
                    	<?php
							foreach ($terms as $term) {
								echo '<option value="'.$term->term_id.'" '. selected( $_SESSION['pm_properties_category_meta'], $term->term_id ) .'>'.ucfirst($term->name).'</option>';	
							}
						?>
                    
                    <?php } else { ?>
                    
                    	<?php
							foreach ($terms as $term) {
								echo '<option value="'.$term->term_id.'">'.ucfirst($term->name).'</option>';	
							}
						?>
                    
                    <?php } ?>
                    
                    
                </select>
                
                <input type="text" class="pm-textfield members" value="<?php echo isset($_SESSION['pm_properties_price_meta']) ? $_SESSION['pm_properties_price_meta'] : '' ?>" name="pm_properties_price_meta" placeholder="<?php esc_html_e('Price (ex. 1299000)', 'luxortheme'); ?>" required />
                
                <input type="text" class="pm-textfield members" value="<?php echo isset($_SESSION['pm_properties_size_meta']) ? $_SESSION['pm_properties_size_meta'] : '' ?>" name="pm_properties_size_meta" placeholder="<?php esc_html_e('Area (in sq ft)', 'luxortheme'); ?>" />
                
                <input type="text" class="pm-textfield members" value="<?php echo isset($_SESSION['pm_property_bedrooms_meta']) ? $_SESSION['pm_property_bedrooms_meta'] : '' ?>" name="pm_property_bedrooms_meta" placeholder="<?php esc_html_e('Rooms (ex. 6+1 Rooms)', 'luxortheme'); ?>" />
                
                <input type="text" class="pm-textfield members" value="<?php echo isset($_SESSION['pm_property_bathrooms_meta']) ? $_SESSION['pm_property_bathrooms_meta'] : '' ?>" name="pm_property_bathrooms_meta" placeholder="<?php esc_html_e('Bathrooms (ex. 4 Bathrooms)', 'luxortheme'); ?>" />
                
                <input type="text" class="pm-textfield members" value="<?php echo isset($_SESSION['pm_property_garages_meta']) ? $_SESSION['pm_property_garages_meta'] : '' ?>" name="pm_property_garages_meta" placeholder="<?php esc_html_e('Garages (ex. 4 Garages)', 'luxortheme'); ?>" />
                

                <input type="text" class="pm-textfield members" value="<?php echo isset($_SESSION['pm_featured_video_url']) ? $_SESSION['pm_featured_video_url'] : '' ?>" name="pm_featured_video_url" placeholder="<?php esc_html_e('Youtube Video ID (ex. XFPLSUZBCB8)', 'luxortheme'); ?>" />
                
                
                
                <select class="pm-admin-select-list" name="pm_enable_video_mode">  
                	<option>-- <?php esc_html_e('Enable Video?', 'luxortheme'); ?> --</option>
                    
                    <?php if( isset( $_SESSION['pm_enable_video_mode'] ) ) { ?>
                    
                    	<option value="no" <?php selected( $_SESSION['pm_enable_video_mode'], 'no' ); ?>><?php esc_html_e('No', 'luxortheme'); ?></option>
                        <option value="yes" <?php selected( $_SESSION['pm_enable_video_mode'], 'yes' ); ?>><?php esc_html_e('Yes', 'luxortheme'); ?></option>
                    
                    <?php } else { ?>
                    
                    	<option value="no"><?php esc_html_e('No', 'luxortheme'); ?></option>
                    	<option value="yes"><?php esc_html_e('Yes', 'luxortheme'); ?></option>
                    
                    <?php } ?>
                </select>
                
                <select class="pm-admin-select-list" name="pm_page_print_share_meta">  
                	<option>-- <?php esc_html_e('Enable Share Options?', 'luxortheme'); ?> --</option>
                    
                    <?php if( isset( $_SESSION['pm_page_print_share_meta'] ) ) { ?>
                    
                    	<option value="off" <?php selected( $_SESSION['pm_page_print_share_meta'], 'off' ); ?>><?php esc_html_e('No', 'luxortheme'); ?></option>
                        <option value="on" <?php selected( $_SESSION['pm_page_print_share_meta'], 'on' ); ?>><?php esc_html_e('Yes', 'luxortheme'); ?></option>
                    
                    <?php } else { ?>
                    
                    	<option value="off"><?php esc_html_e('No', 'luxortheme'); ?></option>
                    	<option value="on"><?php esc_html_e('Yes', 'luxortheme'); ?></option>
                    
                    <?php } ?>
                </select>
                
                                
                <?php $pm_set_featured_property_meta = get_option('pm_set_featured_property_meta'); ?>
                
                <select class="pm-admin-select-list" name="pm_properties_featured_meta" <?php echo $pm_set_featured_property_meta === 'on' ? '' : 'style="display:none;"' ?>>  
                    <option>-- <?php esc_html_e('Set as featured?', 'luxortheme'); ?> --</option>
                    
                    <?php if( isset( $_SESSION['pm_properties_featured_meta'] ) ) { ?>
                    
                        <option value="no" <?php selected( $_SESSION['pm_properties_featured_meta'], 'no' ); ?>><?php esc_html_e('No', 'luxortheme'); ?></option>
                        <option value="yes" <?php selected( $_SESSION['pm_properties_featured_meta'], 'yes' ); ?>><?php esc_html_e('Yes', 'luxortheme'); ?></option>
                    
                    <?php } else { ?>
                    
                        <option value="no"><?php esc_html_e('No', 'luxortheme'); ?></option>
                        <option value="yes"><?php esc_html_e('Yes', 'luxortheme'); ?></option>
                    
                    <?php } ?>
                </select> 
                
                
                <?php  $pm_properties_display_assign_to_agent_meta = get_option('pm_properties_display_assign_to_agent_meta');  ?>
                                
                <?php if ( $pm_properties_display_assign_to_agent_meta === 'yes' ) : ?>
                
					<?php 
                                    
                        //Populate a list of registered users
                        $args = array(  
                            'role' => 'standard_member'
                        );
                        $user_query = new WP_User_Query($args);
                    
                    ?>
                    
                    <?php if ( !empty( $user_query->results ) ) { ?>
                    
                        <select class="pm-admin-select-list" name="pm_assign_agent_meta">  
                    
                            <option value="default">-- <?php esc_html_e('Assign to Agent', 'luxortheme'); ?> --</option>
                            
                            <?php 
							
								foreach ( $user_query->results as $user ) {
									
									if( isset($_SESSION['pm_assign_agent_meta']) ) {
										echo '<option value="'. $user->ID .'" '. selected( $_SESSION['pm_assign_agent_meta'], $user->ID ) .'>' . $user->display_name . '</option>';
									} else {
										echo '<option value="'. $user->ID .'">' . $user->display_name . '</option>';	
									}
									
								}
							
							?>
                            
                            
                        </select> 
                    
                    <?php } else { ?>
                    
                    	<?php echo __('No agents found in database.', 'luxortheme'); ?>
                    
                    <?php } ?>
                
                
                <?php endif; ?>                
                
            </div>
        </div>
    
    </div>
    
    <!-- PANEL 2 end -->
    
    
    <!-- PANEL 3 -->
    
    <div class="container">
    
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 pm-column-spacing">
                
                <h2><?php esc_html_e('Google Map Co-ordiantes', 'luxortheme'); ?></h2>
                <div class="pm-column-title-divider-simple">
                    <div class="pm-column-title-divider-simple-end-point"></div>
                </div>
                
                <br>
                
                <div class="row">
                    
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <input type="text" id="pm_properties_address_lat_meta" class="pm-textfield members" value="<?php echo isset($_SESSION['pm_properties_address_lat_meta']) ? $_SESSION['pm_properties_address_lat_meta'] : '' ?>" name="pm_properties_address_lat_meta" placeholder="<?php esc_html_e('Latitude', 'luxortheme'); ?>" />
                    </div>
                    
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <input type="text" id="pm_properties_address_long_meta" class="pm-textfield members" value="<?php echo isset($_SESSION['pm_properties_address_long_meta']) ? $_SESSION['pm_properties_address_long_meta'] : '' ?>" name="pm_properties_address_long_meta" placeholder="<?php esc_html_e('Longitude', 'luxortheme'); ?>" />
                    </div>
                    
                </div>
                
                <div class="row">
                    
                    <div class="col-lg-12 pm-containerPadding-top-30 pm-column-spacing">
                    
                    	<div class="pm-property-map-preview-container" id="pm-property-map-previewer"></div>
                    	<br />
                    	<a href="#" id="pm-property-map-preview-btn"><i class="fa fa-globe"></i> Preview Map</a>
                        
                        <div class="pm-submit-listing-lat-long-link"><a href="http://www.latlong.net/convert-address-to-lat-long.html" target="_blank">Lat/Long Finder Tool</a></div>
                        
                    </div>
                    
                </div>
                
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 pm-members-form-agent-info">
                
                <h2><?php esc_html_e('Images', 'luxortheme'); ?></h2>
                <div class="pm-column-title-divider-simple">
                    <div class="pm-column-title-divider-simple-end-point"></div>
                </div>
                
                <br>
                
                <p class="pm-members-form-font"><?php esc_html_e('Property Thumbnail Image', 'luxortheme'); ?> (.jpg, .gif or .png) <br> <?php esc_html_e('320x320px recommended', 'luxortheme'); ?>  - <?php esc_html_e('Maximum file size','luxortheme') ?>: 2mb</p>
                
                <input type="file" name="pm_properties_thumb_image_meta">
                
                <br>
                
                <p class="pm-members-form-font"><?php esc_html_e('Property Image', 'luxortheme'); ?> (.jpg, .gif or .png) <br> <?php esc_html_e('1000x900px recommended', 'luxortheme'); ?>  - <?php esc_html_e('Maximum file size','luxortheme') ?>: 2mb</p>
                
                <input type="file" name="pm_properties_image_meta">
                                                  
            </div>
        </div>
    
    </div>
    
    <!-- PANEL 3 end -->
    
    <!-- PANEL 4 -->
    
    <div class="container pm-containerPadding-bottom-110">
    
        <div class="row">
        
            <div class="col-lg-12">
            
                <div class="pm-members-form-submission-divider"></div>
            
                <input type="submit" value="<?php esc_html_e('Submit Property', 'luxortheme'); ?>" class="pm-square-btn comments" />
            
            </div>
        
        </div>
    
    </div>
    
    <?php wp_nonce_field( 'pm-property-form-submitted', 'pm_property_form_nonce' ); ?>
    
    <input type="hidden" name="pm-property-form-submitted" />

</form>

<?php

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
	
	$uploader->setExtensionFilter(array('jpg', 'png', 'gif', 'JPG', 'PNG', 'PNG'));
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