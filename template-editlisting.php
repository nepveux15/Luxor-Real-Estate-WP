<?php /* Template Name: Members Edit Listing Template */ ?>
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

	//Check if delete form was submitted
	if( isset($_POST['pm-delete-property-form-submitted']) ){
		
		//verify nonce
		if ( !isset( $_POST['pm_property_form_delete_nonce'] ) || !wp_verify_nonce( $_POST['pm_property_form_delete_nonce'], 'pm-delete-property-form-submitted' ) ) {
			return;
		}
		
		wp_delete_post( $_SESSION['post_id'], true );
		
		//Remove folder
		$folderPath = 'uploads/properties/property_'.$_SESSION['post_id'];
		$folder_url = content_url($folderPath);
		
		include_once(get_template_directory() . '/includes/classes/cleardirectory.class.php');
		
		$clearDir = ClearDirectory::getInstance();
		$clearDir->deleteAll($folder_url);
				
		//Fetch property listings page for redirect option
		$pm_members_property_listings_slug = get_option('pm_members_property_listings_slug');
		
		?>
        
        <div class="container pm-containerPadding100">
        
            <div class="row">
            
                <div class="col-lg-12">
                
                    <p class="pm-success-message"><?php esc_html_e('Post successfully removed.', 'luxortheme'); ?></p>
                    
                    <br>
                    
                    <a href="<?php echo site_url($pm_members_property_listings_slug); ?>"><?php esc_html_e('Return to Property Listings', 'luxortheme'); ?></a>
                
                </div><!-- /.col -->
            
            </div><!-- /.row -->
        
        </div>
        
        <?php
		
		
	} else {
		
	
?>  

<?php 

	if( isset($_GET['property']) ) {
		
		//echo 'property = ' . $_GET['property'];
		
		$post_id = $_GET['property'];
		$_SESSION['post_id'] = $post_id;
		$post_object = get_post( $post_id ); //Fetch post properties
		
		if(!$post_object){
			
			//post object doesnt exist - redirect to account page
			$pm_members_account_template_slug = get_option('pm_members_account_template_slug');
			wp_redirect( site_url($pm_members_account_template_slug) );
			exit;
			
		}
		
		//print_r($post_object);
		$categories = get_the_terms( $post_id, 'propertycats' );
		$cat_ids = array();  
		if(!empty($categories)){
			foreach($categories as $cat) {
				$cat_ids[] = $cat->term_id; 
			}
		}
		
		
		$saleTypes = get_the_terms( $post_id, 'propertysaletypes' );
		$saleTypes_ids = array();  
		if(!empty($saleTypes)){
			foreach($saleTypes as $type) {
				$saleTypes_ids[] = $type->term_id; 
			}
		}
		
				
		//Fetch property data and store into session vars
		$_SESSION['edit_pm_properties_title_meta'] = $post_object->post_title;
		$_SESSION['edit_pm_properties_address_meta'] = get_post_meta( $post_id, 'pm_properties_address_meta', true );
		$_SESSION['edit_pm_properties_state_meta'] = get_post_meta( $post_id, 'pm_properties_state_meta', true );
		$_SESSION['edit_pm_properties_city_meta'] = get_post_meta( $post_id, 'pm_properties_city_meta', true );
		$_SESSION['edit_pm_properties_country_meta']  = get_post_meta( $post_id, 'pm_properties_country_meta', true );
		$_SESSION['edit_pm_properties_zip_meta'] = get_post_meta( $post_id, 'pm_properties_zip_meta', true );
		
		$_SESSION['edit_pm_properties_amenities_meta'] = get_post_meta( $post_id, 'pm_properties_amenities_meta', true ); 
		
		if( !is_array($_SESSION['edit_pm_properties_amenities_meta']) ){
			$_SESSION['edit_pm_properties_amenities_meta'] = array();//Array value
		} 
		
		$_SESSION['edit_pm_properties_type_meta'] = (int) $saleTypes_ids[0];
		
		$_SESSION['edit_pm_properties_rental_type_meta'] = get_post_meta( $post_id, 'pm_properties_rental_type_meta', true );
		$_SESSION['edit_pm_properties_status_meta'] = get_post_meta( $post_id, 'pm_properties_status_meta', true );
		
		$_SESSION['edit_pm_properties_description'] = $post_object->post_content;//gets inserted through wp_post_insert
		$_SESSION['edit_pm_properties_category_meta'] = (int) $cat_ids[0];//gets inserted through wp_post_insert
		$_SESSION['edit_pm_properties_price_meta'] = get_post_meta( $post_id, 'pm_properties_price_meta', true );
		$_SESSION['edit_pm_properties_size_meta'] = get_post_meta( $post_id, 'pm_properties_size_meta', true );
		
		$_SESSION['edit_pm_property_bedrooms_meta'] = get_post_meta( $post_id, 'pm_property_bedrooms_meta', true );
		$_SESSION['edit_pm_property_bathrooms_meta'] = get_post_meta( $post_id, 'pm_property_bathrooms_meta', true );
		$_SESSION['edit_pm_property_garages_meta'] = get_post_meta( $post_id, 'pm_property_garages_meta', true );		
		$_SESSION['edit_pm_featured_video_url'] = get_post_meta( $post_id, 'pm_featured_video_url', true );
		$_SESSION['edit_pm_enable_video_mode'] = get_post_meta( $post_id, 'pm_enable_video_mode', true );
		$_SESSION['edit_pm_page_print_share_meta'] = get_post_meta( $post_id, 'pm_page_print_share_meta', true );
		
		$_SESSION['edit_pm_properties_featured_meta'] = get_post_meta( $post_id, 'pm_properties_featured_meta', true );
		
		$_SESSION['edit_pm_properties_address_lat_meta'] = get_post_meta( $post_id, 'pm_properties_address_lat_meta', true );
		$_SESSION['edit_pm_properties_address_long_meta'] = get_post_meta( $post_id, 'pm_properties_address_long_meta', true );
		
		//Property images
		$_SESSION['edit_pm_properties_thumb_image_meta'] = get_post_meta( $post_id, 'pm_properties_thumb_image_meta', true );
		$_SESSION['edit_pm_properties_image_meta'] = get_post_meta( $post_id, 'pm_properties_image_meta', true );

				
		//Carousel images
		$_SESSION['edit_pm_enable_slider_system'] = get_post_meta( $post_id, 'pm_enable_slider_system', true );
		$_SESSION['edit_pm_properties_slides'] = get_post_meta( $post_id, 'pm_properties_slides', true );
		
		
	}

?>



<div class="container pm-containerPadding-top-100">
    <div class="row">
        <div class="col-lg-12">
        
        	<p class="pm-secondary"><?php esc_html_e('Editing property listing','luxortheme'); ?> #<?php echo $_SESSION['post_id']; ?> - <a href="<?php echo get_permalink($post_object->ID); ?>" target="_blank"><?php esc_html_e('View Property','luxortheme'); ?> </a></p>
        
        </div>
    </div>                 
</div>


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
		$_SESSION['edit_pm_properties_title_meta'] = sanitize_text_field($_POST['pm_properties_title_meta']);//gets inserted through wp_post_insert
		$_SESSION['edit_pm_properties_address_meta'] = sanitize_text_field($_POST['pm_properties_address_meta']);
		$_SESSION['edit_pm_properties_state_meta'] = sanitize_text_field($_POST['pm_properties_state_meta']);
		$_SESSION['edit_pm_properties_city_meta'] = sanitize_text_field($_POST['pm_properties_city_meta']);
		$_SESSION['edit_pm_properties_country_meta'] = sanitize_text_field($_POST['pm_properties_country_meta']);
		$_SESSION['edit_pm_properties_zip_meta'] = sanitize_text_field($_POST['pm_properties_zip_meta']);
		
		//$_SESSION['edit_pm_properties_description'] = wp_kses($_POST['pm_properties_description'], $allowed_html);//gets inserted through wp_post_insert
		$_SESSION['edit_pm_properties_description'] = $_POST['pm_properties_description'];//gets inserted through wp_post_insert
		
		if( isset($_POST['pm_properties_amenities_meta']) ){
			$_SESSION['edit_pm_properties_amenities_meta'] = $_POST['pm_properties_amenities_meta'];//Array value
		} else {
			$_SESSION['edit_pm_properties_amenities_meta'] = array();	
		}
		
		$_SESSION['edit_pm_properties_type_meta'] = intval($_POST['pm_properties_type_meta']);
		$_SESSION['edit_pm_properties_rental_type_meta'] = $_POST['pm_properties_rental_type_meta'];
		$_SESSION['edit_pm_properties_status_meta'] = $_POST['pm_properties_status_meta'];
		$_SESSION['edit_pm_properties_category_meta'] =  intval($_POST['pm_properties_category_meta']);//gets inserted through wp_post_insert
		$_SESSION['edit_pm_properties_price_meta'] = sanitize_text_field($_POST['pm_properties_price_meta']);
		$_SESSION['edit_pm_properties_size_meta'] = sanitize_text_field($_POST['pm_properties_size_meta']);
		$_SESSION['edit_pm_property_bedrooms_meta'] = sanitize_text_field($_POST['pm_property_bedrooms_meta']);
		$_SESSION['edit_pm_property_bathrooms_meta'] = sanitize_text_field($_POST['pm_property_bathrooms_meta']);
		$_SESSION['edit_pm_property_garages_meta'] = sanitize_text_field($_POST['pm_property_garages_meta']);
		$_SESSION['edit_pm_featured_video_url'] = sanitize_text_field($_POST['pm_featured_video_url']);
		$_SESSION['edit_pm_enable_video_mode'] = $_POST['pm_enable_video_mode'];
		$_SESSION['edit_pm_page_print_share_meta'] = $_POST['pm_page_print_share_meta'];
		
		$_SESSION['edit_pm_properties_featured_meta'] = $_POST['pm_properties_featured_meta'];
		
		$_SESSION['edit_pm_properties_address_lat_meta'] = sanitize_text_field($_POST['pm_properties_address_lat_meta']);
		$_SESSION['edit_pm_properties_address_long_meta'] = sanitize_text_field($_POST['pm_properties_address_long_meta']);
		
		
		//Save data first so we can get post ID for folder creation
		
		$post_slug = str_replace(" ", "-", strtolower($_SESSION['edit_pm_properties_title_meta']) ); //required for post slug name
		
		$post_args = array(
		  'ID'             => $_SESSION['post_id'], // Are you updating an existing post?
		  'post_content'   => $_SESSION['edit_pm_properties_description'] ,// The full text of the post.
		  'post_name'      => $post_slug, // The name (slug) for your post
		  'post_title'     => $_SESSION['edit_pm_properties_title_meta'], // The title of your post.
		  //'post_author'    => $current_user->ID,  // The user ID number of the author. Default is the current user ID.
		  //'post_date'      => date('Y-m-d H:i:s'), // The time post was made.
		  //'post_date_gmt'  => date('Y-m-d H:i:s'), // The time post was made, in GMT.
		  //'comment_status' => 'closed', // Default is the option 'default_comment_status', or 'closed'.
		  //'post_category'  => array($_SESSION['edit_pm_properties_category_meta']), // Default empty.
		  //'tags_input'     => [ '<tag>, <tag>, ...' | array ] // Default empty.
		  //'tax_input'      => array( 'propertycats' => $_SESSION['edit_pm_properties_category_meta'] ) // For custom taxonomies. Default empty.    propertycats
		  //'page_template'  => [ <string> ] // Requires name of template file, eg template.php. Default empty.
		); 
		
		$post_id = wp_update_post( $post_args, true );
		
		if($post_id){
			
			//Save the category relationship
			wp_set_object_terms( $_SESSION['post_id'], array($_SESSION['edit_pm_properties_category_meta']), 'propertycats');
			
			wp_set_object_terms( $_SESSION['post_id'], array($_SESSION['edit_pm_properties_type_meta']), 'propertysaletypes');
			
			echo '<div class="container">';
				echo '<div class="row">';
					echo '<div class="col-lg-12">';
						echo '<p class="pm-success-message">'.esc_html__('Post has been successfully updated.','luxortheme').'</p>';
					echo '</div>';
				echo '</div>';              
			echo '</div>';
			
			
			
			//Save meta data
			update_post_meta($post_id, "pm_properties_address_meta", $_SESSION['edit_pm_properties_address_meta']);
			update_post_meta($post_id, "pm_properties_state_meta", $_SESSION['edit_pm_properties_state_meta']);
			update_post_meta($post_id, "pm_properties_city_meta", $_SESSION['edit_pm_properties_city_meta']);
			update_post_meta($post_id, "pm_properties_country_meta", $_SESSION['edit_pm_properties_country_meta']);
			update_post_meta($post_id, "pm_properties_zip_meta", $_SESSION['edit_pm_properties_zip_meta']);
			update_post_meta($post_id, "pm_properties_type_meta", $_SESSION['edit_pm_properties_type_meta']);
			update_post_meta($post_id, "pm_properties_rental_type_meta", $_SESSION['edit_pm_properties_rental_type_meta']);
			update_post_meta($post_id, "pm_properties_status_meta", $_SESSION['edit_pm_properties_status_meta']);
			update_post_meta($post_id, "pm_featured_video_url", $_SESSION['edit_pm_featured_video_url']);
			update_post_meta($post_id, "pm_enable_video_mode", $_SESSION["edit_pm_enable_video_mode"]);
			update_post_meta($post_id, "pm_page_print_share_meta", $_SESSION["edit_pm_page_print_share_meta"]);
			
			update_post_meta($post_id, "pm_properties_type_meta", $_SESSION["edit_pm_properties_type_meta"]); //Store a reference to taxonomy id so we can use it anywhere with get_terms method
			
			update_post_meta($post_id, "pm_properties_featured_meta", $_SESSION["edit_pm_properties_featured_meta"]);
			
			update_post_meta($post_id, "pm_properties_address_lat_meta", $_SESSION["edit_pm_properties_address_lat_meta"]);
			update_post_meta($post_id, "pm_properties_address_long_meta", $_SESSION["edit_pm_properties_address_long_meta"]);
			update_post_meta($post_id, "pm_properties_price_meta", $_SESSION["edit_pm_properties_price_meta"]);
			update_post_meta($post_id, "pm_properties_size_meta", $_SESSION["edit_pm_properties_size_meta"]);
			
			update_post_meta($post_id, "pm_property_bedrooms_meta", $_SESSION['edit_pm_property_bedrooms_meta']);
			update_post_meta($post_id, "pm_property_bathrooms_meta", $_SESSION['edit_pm_property_bathrooms_meta']);
			update_post_meta($post_id, "pm_property_garages_meta", $_SESSION['edit_pm_property_garages_meta']);
			
			update_post_meta($post_id, "pm_properties_amenities_meta", $_SESSION["edit_pm_properties_amenities_meta"]);

			
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
					$_SESSION['edit_pm_properties_thumb_image_meta'] = $content_url;
						
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
					$_SESSION['edit_pm_properties_image_meta'] = $content_url;
						
				}
				
			}//end if
			
			
		} else {
			
			echo '<div class="container">';
				echo '<div class="row">';
					echo '<div class="col-lg-12 pm-column-spacing">';
						echo '<p class="pm-error-message">'.esc_html__('A post error occurred - please try saving your submission again.','luxortheme').'</p>';
					echo '</div>';
				echo '</div>   ';              
			echo '</div>';
			
		}
		
	}//end if
	
?>

<form action="<?php echo get_permalink(); ?>?property=<?php echo $_SESSION['post_id']; ?>" method="post" enctype="multipart/form-data">

    <div class="container pm-containerPadding-top-20 pm-containerPadding-bottom-50">
    
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 pm-column-spacing">
                
                <h2><?php esc_html_e('Property Information', 'luxortheme'); ?></h2>
                <div class="pm-column-title-divider-simple">
                    <div class="pm-column-title-divider-simple-end-point"></div>
                </div>
                
                <br>
                                
                <input required type="text" class="pm-textfield members" value="<?php echo isset($_SESSION['edit_pm_properties_title_meta']) ? $_SESSION['edit_pm_properties_title_meta'] : '' ?>" name="pm_properties_title_meta" placeholder="<?php esc_html_e('Property Title', 'luxortheme'); ?>" />
                                
                <input required type="text" class="pm-textfield members" value="<?php echo isset($_SESSION['edit_pm_properties_address_meta']) ? $_SESSION['edit_pm_properties_address_meta'] : '' ?>" name="pm_properties_address_meta" placeholder="<?php esc_html_e('Street Address', 'luxortheme'); ?>" />
                
                <input required type="text" class="pm-textfield members" value="<?php echo isset($_SESSION['edit_pm_properties_city_meta']) ? $_SESSION['edit_pm_properties_city_meta'] : '' ?>" name="pm_properties_city_meta" placeholder="<?php esc_html_e('City', 'luxortheme'); ?>" />
                
                <input required type="text" class="pm-textfield members" value="<?php echo isset($_SESSION['edit_pm_properties_state_meta']) ? $_SESSION['edit_pm_properties_state_meta'] : '' ?>" name="pm_properties_state_meta" placeholder="<?php esc_html_e('State / Province', 'luxortheme'); ?>" />
                
                <input required type="text" class="pm-textfield members" value="<?php echo isset($_SESSION['edit_pm_properties_country_meta']) ? $_SESSION['edit_pm_properties_country_meta'] : '' ?>" name="pm_properties_country_meta" placeholder="<?php esc_html_e('Country', 'luxortheme'); ?>" />
                
                <input required type="text" class="pm-textfield members" value="<?php echo isset($_SESSION['edit_pm_properties_zip_meta']) ? $_SESSION['edit_pm_properties_zip_meta'] : '' ?>" name="pm_properties_zip_meta" placeholder="<?php esc_html_e('Zip / Postal Code', 'luxortheme'); ?>" />
                                
                <br><br>
                
                <p><?php esc_html_e('Property Details', 'luxortheme'); ?></p>
                        
                <?php 
				
					$content = isset($_SESSION['edit_pm_properties_description']) ? $_SESSION['edit_pm_properties_description'] : '';
					$editor_id = 'property_post_editor';
					$args = array(
						'textarea_name' => 'pm_properties_description',
						'editor_height' => 130
					);
					
					wp_editor($content, $editor_id, $args); 
				
				?>
                
                                
                <!--<textarea class="pm-textarea members" name="pm_properties_description" placeholder="<?php //esc_html_e('Property Description', 'luxortheme'); ?>"><?php //echo isset($_SESSION['edit_pm_properties_description']) ? $_SESSION['edit_pm_properties_description'] : '' ?></textarea>
                
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
                            <input type="checkbox" name="pm_properties_amenities_meta[]" value="<?php echo $term->name; ?>" <?php echo in_array($term->name, $_SESSION['edit_pm_properties_amenities_meta']) ? 'checked="checked"' : '' ?>>
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
                    
                    <?php if( isset( $_SESSION['edit_pm_properties_type_meta'] ) ) { ?>
                    
                    	<?php
							
							foreach ($sale_type_terms as $term) { ?>
                
                                <option value="<?php echo esc_attr($term->term_id) ?>" data-showpaymentterms="<?php echo trim($term->description) ?>" <?php selected( $_SESSION['edit_pm_properties_type_meta'], $term->term_id ) ?>> <?php echo ucfirst($term->name) ?></option>	
                                
                            <?php }
							
						?>
                    
                    <?php } else { ?>
                    
                    	<?php
						
							foreach ($sale_type_terms as $term) { ?>
                
                                <option value="<?php echo esc_attr($term->term_id) ?>" data-showpaymentterms="<?php echo trim($term->description) ?>"> <?php echo ucfirst($term->name) ?></option>	
                                
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
                
                
                <?php if( isset( $_SESSION['edit_pm_properties_rental_type_meta'] ) ) { ?>
                
                	<?php if( $_SESSION['edit_pm_properties_rental_type_meta'] !== 'default' ) { ?>
                    	<select id="pm_properties_rental_type_meta" name="pm_properties_rental_type_meta" class="pm-admin-select-list pm-properties-rental-type-container visible">
                    <?php } else { ?>
                    	<select id="pm_properties_rental_type_meta" name="pm_properties_rental_type_meta" class="pm-admin-select-list pm-properties-rental-type-container hidden">
                    <?php } ?>
                    
                    	<option value="default">-- <?php esc_html_e('Payment Terms', 'luxortheme') ?> --</option>                        
                        
                        <?php if( isset( $_SESSION['edit_pm_properties_rental_type_meta'] ) ) { ?>
                    
							<?php
							
								foreach ($payment_terms as $term) { ?>
                                    <option value="<?php echo esc_attr($term->name); ?>" <?php selected( $_SESSION['edit_pm_properties_rental_type_meta'], $term->name ); ?>><?php echo ucfirst($term->name); ?></option>	
                                <?php }
								
                            ?>
                        
                        <?php } else { ?>
                        
                            <?php
							
								foreach ($payment_terms as $term) { ?>
                                    <option value="<?php echo esc_attr($term->name); ?>"><?php echo ucfirst($term->name); ?></option>	
                                <?php }
							
                            ?>
                        
                        <?php } ?> 
                        
                    </select>
                
                <?php } else { ?>
                
                	<select id="pm_properties_rental_type_meta" name="pm_properties_rental_type_meta" class="pm-admin-select-list pm-properties-rental-type-container hidden">
                    
                        <option value="default">-- <?php esc_html_e('Payment Terms', 'luxortheme') ?> --</option>
                        
                        <?php if( isset( $_SESSION['edit_pm_properties_rental_type_meta'] ) ) { ?>
                    
							<?php
                                foreach ($payment_terms as $term) {
                                    echo '<option value="'.$term->name.'" '. selected( $_SESSION['edit_pm_properties_rental_type_meta'], $term->name ) .'>'.ucfirst($term->name).'</option>';	
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
					
					//echo '$_SESSION["edit_pm_properties_status_meta"] = ' . $_SESSION['edit_pm_properties_status_meta'];
				?>
                
                <select class="pm-admin-select-list" name="pm_properties_status_meta" id="pm_properties_status_meta" required>  
                
                	<option value="">-- <?php esc_html_e('Property Status', 'luxortheme'); ?> --</option>
                    
                    <?php if( isset( $_SESSION['edit_pm_properties_status_meta'] ) ) { ?>
                    
                    	<?php
							foreach ($status_type_terms as $term) { ?>
								<option value="<?php echo $term->name ?>" <?php selected( $_SESSION['edit_pm_properties_status_meta'], $term->name ) ?>><?php echo ucfirst($term->name) ?></option>
							<?php }
						?>
                    
                    <?php } else { ?>
                    
                    	<?php
							foreach ($status_type_terms as $term) { ?>
								<option value="<?php echo $term->name ?>"><?php echo ucfirst($term->name) ?></option>
							<?php }
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
                    
                    <?php if( isset( $_SESSION['edit_pm_properties_category_meta'] ) ) { ?>
                    	
                    	<?php
							foreach ($terms as $term) {
																
								if($_SESSION['edit_pm_properties_category_meta'] === (int) $term->term_id){
									echo '<option value="'.$term->term_id.'" selected="selected">'.ucfirst($term->name).'</option>';
								} else {
									echo '<option value="'.$term->term_id.'">'.ucfirst($term->name).'</option>';
								}							
								
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
                
                <input required type="text" class="pm-textfield members" value="<?php echo isset($_SESSION['edit_pm_properties_price_meta']) ? $_SESSION['edit_pm_properties_price_meta'] : '' ?>" name="pm_properties_price_meta" placeholder="<?php esc_html_e('Price (ex. 1299000)', 'luxortheme'); ?>" />
                
                <input type="text" class="pm-textfield members" value="<?php echo isset($_SESSION['edit_pm_properties_size_meta']) ? $_SESSION['edit_pm_properties_size_meta'] : '' ?>" name="pm_properties_size_meta" placeholder="<?php esc_html_e('Area (in sq ft)', 'luxortheme'); ?>" />
                
                <input type="text" class="pm-textfield members" value="<?php echo isset($_SESSION['edit_pm_property_bedrooms_meta']) ? $_SESSION['edit_pm_property_bedrooms_meta'] : '' ?>" name="pm_property_bedrooms_meta" placeholder="<?php esc_html_e('Rooms (ex. 6+1 Rooms)', 'luxortheme'); ?>" />
                
                <input type="text" class="pm-textfield members" value="<?php echo isset($_SESSION['edit_pm_property_bathrooms_meta']) ? $_SESSION['edit_pm_property_bathrooms_meta'] : '' ?>" name="pm_property_bathrooms_meta" placeholder="<?php esc_html_e('Bathrooms (ex. 4 Bathrooms)', 'luxortheme'); ?>" />
                
                <input type="text" class="pm-textfield members" value="<?php echo isset($_SESSION['edit_pm_property_garages_meta']) ? $_SESSION['edit_pm_property_garages_meta'] : '' ?>" name="pm_property_garages_meta" placeholder="<?php esc_html_e('Garages (ex. 4 Garages)', 'luxortheme'); ?>" />
                
                <input type="text" class="pm-textfield members" value="<?php echo isset($_SESSION['edit_pm_featured_video_url']) ? $_SESSION['edit_pm_featured_video_url'] : '' ?>" name="pm_featured_video_url" placeholder="<?php esc_html_e('Youtube Video ID (ex. XFPLSUZBCB8)', 'luxortheme'); ?>" />
                
                
                
                <select class="pm-admin-select-list" name="pm_enable_video_mode">  
                	<option>-- <?php esc_html_e('Enable Video?', 'luxortheme'); ?> --</option>
                    
                    <?php if( isset( $_SESSION['edit_pm_enable_video_mode'] ) ) { ?>
                    
                    	<option value="no" <?php selected( $_SESSION['edit_pm_enable_video_mode'], 'no' ); ?>><?php esc_html_e('No', 'luxortheme'); ?></option>
                        <option value="yes" <?php selected( $_SESSION['edit_pm_enable_video_mode'], 'yes' ); ?>><?php esc_html_e('Yes', 'luxortheme'); ?></option>
                    
                    <?php } else { ?>
                    
                    	<option value="no"><?php esc_html_e('No', 'luxortheme'); ?></option>
                    	<option value="yes"><?php esc_html_e('Yes', 'luxortheme'); ?></option>
                    
                    <?php } ?>
                </select>
                
                
                <select class="pm-admin-select-list" name="pm_page_print_share_meta">  
                	<option>-- <?php esc_html_e('Enable Share Options?', 'luxortheme'); ?> --</option>
                    
                    <?php if( isset( $_SESSION['edit_pm_page_print_share_meta'] ) ) { ?>
                    
                    	<option value="off" <?php selected( $_SESSION['edit_pm_page_print_share_meta'], 'off' ); ?>><?php esc_html_e('No', 'luxortheme'); ?></option>
                        <option value="on" <?php selected( $_SESSION['edit_pm_page_print_share_meta'], 'on' ); ?>><?php esc_html_e('Yes', 'luxortheme'); ?></option>
                    
                    <?php } else { ?>
                    
                    	<option value="off"><?php esc_html_e('No', 'luxortheme'); ?></option>
                    	<option value="on"><?php esc_html_e('Yes', 'luxortheme'); ?></option>
                    
                    <?php } ?>
                </select>
                
                
                <?php $pm_set_featured_property_meta = get_option('pm_set_featured_property_meta'); ?>
                
                <select class="pm-admin-select-list" name="pm_properties_featured_meta" <?php echo $pm_set_featured_property_meta === 'on' ? '' : 'style="display:none;"' ?>>  
                    <option>-- <?php esc_html_e('Set as featured?', 'luxortheme'); ?> --</option>
                    
                    <?php if( isset( $_SESSION['edit_pm_properties_featured_meta'] ) ) { ?>
                    
                        <option value="no" <?php selected( $_SESSION['edit_pm_properties_featured_meta'], 'no' ); ?>><?php esc_html_e('No', 'luxortheme'); ?></option>
                        <option value="yes" <?php selected( $_SESSION['edit_pm_properties_featured_meta'], 'yes' ); ?>><?php esc_html_e('Yes', 'luxortheme'); ?></option>
                    
                    <?php } else { ?>
                    
                        <option value="no"><?php esc_html_e('No', 'luxortheme'); ?></option>
                        <option value="yes"><?php esc_html_e('Yes', 'luxortheme'); ?></option>
                    
                    <?php } ?>
                </select>                
                
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
                        <input type="text" id="pm_properties_address_lat_meta" class="pm-textfield members" value="<?php echo isset($_SESSION['edit_pm_properties_address_lat_meta']) ? $_SESSION['edit_pm_properties_address_lat_meta'] : '' ?>" name="pm_properties_address_lat_meta" placeholder="<?php esc_html_e('Latitude', 'luxortheme'); ?>" />
                    </div>
                    
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <input type="text" id="pm_properties_address_long_meta" class="pm-textfield members" value="<?php echo isset($_SESSION['edit_pm_properties_address_long_meta']) ? $_SESSION['edit_pm_properties_address_long_meta'] : '' ?>" name="pm_properties_address_long_meta" placeholder="<?php esc_html_e('Longitude', 'luxortheme'); ?>" />
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
                
                <h2><?php esc_html_e('Property Images', 'luxortheme'); ?></h2>
                <div class="pm-column-title-divider-simple">
                    <div class="pm-column-title-divider-simple-end-point"></div>
                </div>
                
                <br>
                
                <?php 
					if($thumbnail_success) {						
						echo '<p class="pm-success-message">' . esc_html__('Your thumbnail image has been successfully saved.','luxortheme') . '</p>';	
					} elseif($thumbnail_success === false) {
						echo '<p class="pm-error-message">' . esc_html__('Invalid file. Please ensure your file has the correct extension and the file size is under 2MB.','luxortheme') . '</p>';	
					}
				?>
                
				<?php if( $_SESSION['edit_pm_properties_thumb_image_meta'] !== '' ) : ?>
                    <div class="pm-members-edit-listing-img-preview">
                        <img src="<?php echo esc_html($_SESSION['edit_pm_properties_thumb_image_meta']) ?>" alt="thumbnail" />
                    </div>
                <?php endif; ?>
                
                <p class="pm-members-form-font" style="margin:0px;"><?php esc_html_e('Property Thumbnail Image', 'luxortheme'); ?> (.jpg, .gif or .png) <br> <?php esc_html_e('320x320px recommended', 'luxortheme'); ?> - <?php esc_html_e('Maximum file size','luxortheme') ?>: 2mb</p>
                
                <input type="file" name="pm_properties_thumb_image_meta">
                
                <br>
                <br>
                
                <?php 
					if($featured_image_success) {
						echo '<p class="pm-success-message">' . esc_html__('Your property image has been successfully saved.','luxortheme') . '</p>';	
					} elseif($featured_image_success === false) {
						echo '<p class="pm-error-message">' . esc_html__('Invalid file. Please ensure your file has the correct extension and the file size is under 2MB.','luxortheme') . '</p>';	
					}
				?>
                        
				<?php if( $_SESSION['edit_pm_properties_image_meta'] !== '' ) : ?>
                    <div class="pm-members-edit-listing-img-preview">
                        <img src="<?php echo esc_html($_SESSION['edit_pm_properties_image_meta']) ?>" alt="thumbnail" />
                    </div>
                <?php endif; ?>
                
                <p class="pm-members-form-font" style="margin:0px;"><?php esc_html_e('Property Image', 'luxortheme'); ?> (.jpg, .gif or .png) <br> <?php esc_html_e('1000x900px recommended', 'luxortheme'); ?> - <?php esc_html_e('Maximum file size','luxortheme') ?>: 2mb</p>
                
                <input type="file" name="pm_properties_image_meta">
                                  
            </div>
        </div>
    
    </div>
    
    <!-- PANEL 3 end -->
    
    <!-- PANEL 4 -->
    
    <div class="container pm-containerPadding-bottom-60">
    
        <div class="row">
        
            <div class="col-lg-12">
            
                <div class="pm-members-form-submission-divider"></div>
            
                <input type="submit" value="<?php esc_html_e('Save Property', 'luxortheme'); ?>" class="pm-square-btn comments" />
            
            </div>
        
        </div>
    
    </div>
    
    <?php wp_nonce_field( 'pm-property-form-submitted', 'pm_property_form_nonce' ); ?>
    
    <input type="hidden" name="pm-property-form-submitted" />

</form>



<form action="<?php echo get_permalink(); ?>?property=<?php echo $_SESSION['post_id']; ?>" method="post" enctype="multipart/form-data">

	<div class="container pm-containerPadding-bottom-80">
    
        <div class="row">
        
            <div class="col-lg-12">
            
            	<h2><?php esc_html_e('Carousel System', 'luxortheme'); ?></h2>
                <div class="pm-column-title-divider-simple">
                    <div class="pm-column-title-divider-simple-end-point"></div>
                </div>
            
            	<br />
                
                <?php 

				//Check if form was submitted
				if( isset($_POST['pm-property-carousel-form-submitted']) ){
					
					//verify nonce
					if ( !isset( $_POST['pm_property_carousel_form_nonce'] ) || !wp_verify_nonce( $_POST['pm_property_carousel_form_nonce'], 'pm-property-carousel-form-submitted' ) ) {
						return;
					}
					
					//Upload Images first the save data
					$valid_formats = array('jpg', 'png', 'gif', 'JPG', 'jpeg');
					$max_file_size = 1024*2000; //2mb
					
					$carousel_error = false;
					$carousel_success = false;
					
					$filePath = './wp-content/uploads/properties/property_'.$_SESSION['post_id'].'/';
					//$content_url = content_url($filePath);
					$path = $filePath; // Upload directory
					$count = 0;
					$images = array();
					$counter = 0;
					
					// Loop $_FILES to exeicute all files
					if( isset($_FILES['propertyfiles']) ){
						
						foreach ($_FILES['propertyfiles']['name'] as $f => $name) {   
				  
							if ($_FILES['propertyfiles']['error'][$f] == 4) {
								continue; // Skip file if any error found
							}	       
					
							if ($_FILES['propertyfiles']['error'][$f] == 0) {
								   
								if ($_FILES['propertyfiles']['size'][$f] > $max_file_size) {
									
									$carousel_error = true;
									//$message[] = "$name is too large!.";
									//continue; // Skip large files
									
								} elseif( !in_array( pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
									
									$carousel_error = true;
									//$message[] = "$name is not a valid format";
									//continue; // Skip invalid file formats
								
								} else { // No error found! Move uploaded files 
							
									if (!file_exists($filePath)) { 
										mkdir($filePath, 0777); 
										//echo "The directory {$dir_cleaned} was successfully created."; 
									}
							
									if(move_uploaded_file($_FILES["propertyfiles"]["tmp_name"][$f], $path.$name))
									$count++; // Number of successfully uploaded file
																		
									$carousel_success = true;
									
									//create image path and store it in database
									$imagePath = 'uploads/properties/property_'.$_SESSION['post_id'].'/' . $_FILES['propertyfiles']['name'][$f];
									$c_url = content_url($imagePath);
									$images[$counter] = $c_url;
									
									$counter++;
									
								}
							}
							
							$_SESSION['edit_pm_properties_slides'] = $images;
							
						}
						
					}
					
					
					//Save data!							
					update_post_meta($_SESSION['post_id'], "pm_properties_slides", $_SESSION['edit_pm_properties_slides']);
					update_post_meta($_SESSION['post_id'], "pm_enable_slider_system", $_POST["pm_enable_slider_system"]);
					$_SESSION['edit_pm_enable_slider_system'] = $_POST["pm_enable_slider_system"];
					
					
					//echo '$carousel_error = ' . $carousel_error;
					if($carousel_error) {
						echo '<p class="pm-error-message">' . esc_html__('A file error was detected during upload - all of your images may not have been saved.','luxortheme') . '</p>';	
						echo '<p class="pm-error-message">' . esc_html__('Please ensure your files have the correct extension and are below 2 megabytes in size.','luxortheme') . '</p>';	
					} else {
						echo '<p class="pm-success-message">' . esc_html__('Your carousel has been successfully saved.','luxortheme') . '</p>';		
					}
											
				}
				
				?>                                
            
            </div><!-- /.col -->
        
        </div><!-- /.row -->
        
        <div class="row">
        
        	<div class="col-lg-4 pm-column-spacing">
            
            	<select class="pm-admin-select-list" name="pm_enable_slider_system">  
                	<option>-- <?php esc_html_e('Enable Carousel?', 'luxortheme'); ?> --</option>
                    
                    <?php if( isset( $_SESSION['edit_pm_enable_slider_system'] ) ) { ?>
                    
                    	<option value="no" <?php selected( $_SESSION['edit_pm_enable_slider_system'], 'no' ); ?>><?php esc_html_e('No', 'luxortheme'); ?></option>
                        <option value="yes" <?php selected( $_SESSION['edit_pm_enable_slider_system'], 'yes' ); ?>><?php esc_html_e('Yes', 'luxortheme'); ?></option>
                    
                    <?php } else { ?>
                    
                    	<option value="no"><?php esc_html_e('No', 'luxortheme'); ?></option>
                    	<option value="yes"><?php esc_html_e('Yes', 'luxortheme'); ?></option>
                    
                    <?php } ?>
                    
                </select>
            
            </div><!-- /.col -->
        
        </div><!-- /.row -->
        
        
        
        <div class="row">
        
        	<div class="col-lg-12 pm-column-spacing">
            
            		<p class="pm-members-form-font"><?php esc_html_e('Allowed file types','luxortheme') ?>: (.jpg, .gif or .png) <br> <?php esc_html_e('Recommended size','luxortheme') ?>: 780x400px - <?php esc_html_e('Maximum file size per image','luxortheme') ?>: 2mb</p>
                    
                    <!-- Image previews -->
                    <?php if( is_array( $_SESSION['edit_pm_properties_slides'] ) ) : ?>
                    
                    	<ul class="pm-slider-system-field-img-preview-list">
							<?php 
                                                                
                                foreach($_SESSION['edit_pm_properties_slides'] as $val) {
                                    
                                    echo '<li><img src="'.esc_html($val).'" /></li>';
                                    
                                }
                                
                            ?>
                   		</ul>
                        
                    <?php endif; ?>
                    
                    
                    <input type="file" id="file" name="propertyfiles[]" multiple accept="image/*" />
                                
            
            </div><!-- /.col -->
        
        </div><!-- /.row -->
        
        
        <div class="row">
        
        	<div class="col-lg-4">
            
            	<input type="submit" value="<?php esc_html_e('Save Carousel', 'luxortheme'); ?>" class="pm-square-btn comments" />
            
            </div><!-- /.col -->
        
        </div><!-- /.row -->
    
    </div>
    
    <?php wp_nonce_field( 'pm-property-carousel-form-submitted', 'pm_property_carousel_form_nonce' ); ?>
    
    <input type="hidden" name="pm-property-carousel-form-submitted" />

</form>



<form action="<?php echo get_permalink(); ?>?property=<?php echo $_SESSION['post_id']; ?>" method="post">

	<div class="container pm-containerPadding-bottom-80">
        
        <div class="row">
        
        	<div class="col-lg-12">
            
            	<div class="pm-column-title-divider-simple">
                    <div class="pm-column-title-divider-simple-end-point"></div>
                </div>
                
                <br>
            
            	<input type="submit" value="<?php esc_html_e('Delete Property?', 'luxortheme'); ?>" class="pm-square-btn comments" />
            
            </div><!-- /.col -->
        
        </div><!-- /.row -->
    
    </div>
    
    <?php wp_nonce_field( 'pm-delete-property-form-submitted', 'pm_property_form_delete_nonce' ); ?>
    
    <input type="hidden" name="pm-delete-property-form-submitted" />

</form>

<?php }//end of if delete submitted ?>

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
	
	$uploader->setExtensionFilter(array('jpg', 'png', 'gif'));
	$uploader->setUploadDirectory($dir);
	$result = $uploader->upload($file);
	
	if( array_key_exists($result, $pm_ln_account_error_messages) ){
		
		$img_error_status = $pm_ln_account_error_messages[$result];
		return false;
		
	} 
	
	return true;
	
}

function deleteFolder($path) {
	
    if (is_dir($path) === true)
    {
        $files = array_diff(scandir($path), array('.', '..'));

        foreach ($files as $file)
        {
            Delete(realpath($path) . '/' . $file);
        }

        return rmdir($path);
    }

    else if (is_file($path) === true)
    {
        return unlink($path);
    }

    return false;
}

?>

<?php get_footer(); ?>