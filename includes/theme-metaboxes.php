<?php

//News posts meta options
add_action( 'add_meta_boxes', 'add_post_metaoptions' );

//Page meta options
add_action( 'add_meta_boxes', 'add_page_metaoptions' );

//Sidebar selector meta box for posts and pages
//add_action( 'add_meta_boxes', 'pm_ln_add_sidebar_metabox' );

//Save custom post/page data
add_action( 'save_post', 'save_postdata' );
//add_action( 'save_post', 'pm_ln_save_sidebar_postdata' );

//Rewrite default WordPress Featured image box
add_action('do_meta_boxes', 'pm_ln_render_new_post_thumbnail_meta_box');



/* Prints the sidebar meta box content */
function pm_ln_custom_sidebar_callback( $post ){
	
    global $wp_registered_sidebars;
     
    $custom = get_post_custom($post->ID);
     
    if(isset($custom['custom_sidebar']))
        $val = $custom['custom_sidebar'][0];
    else
        $val = "default";
 
    // Use nonce for verification
    wp_nonce_field( 'custom_sidebar', 'custom_sidebar_nonce' );
 
    // The actual fields for data entry
    $output = '<p><label for="myplugin_new_field">'.esc_html__("Choose a sidebar to display", 'luxortheme' ).'</label></p>';
    $output .= "<select name='custom_sidebar'>";
 
    // Add a default option
    $output .= "<option";
    if($val == "default")
        $output .= " selected='selected'";
    $output .= " value='default'>".esc_html__('No Sidebar', 'luxortheme')."</option>";
     
    // Fill the select element with all registered sidebars
    foreach($wp_registered_sidebars as $sidebar_id => $sidebar)
    {
        $output .= "<option";
        if($sidebar['name'] == $val)
            $output .= " selected='selected'";
        $output .= " value='".$sidebar['name']."'>".$sidebar['name']."</option>";
    }
   
    $output .= "</select>";
     
    echo $output;
}

/*** NEW FEATURED IMAGE FOR POSTS WITH DETAILS *****/
function pm_ln_new_post_thumbnail_meta_box() {
	
    global $post; // we know what this does
     
    echo '<p>Recommended size: 1170x400px</p>';
     
    $thumbnail_id = get_post_meta( $post->ID, '_thumbnail_id', true ); // grabing the thumbnail id of the post
    echo _wp_post_thumbnail_html( $thumbnail_id ); // echoing the html markup for the thumbnail
     
    //echo '<p>Content below the image.</p>';
}

function pm_ln_render_new_post_thumbnail_meta_box() {
	
    global $post_type; // lets call the post type 
     
    // remove the old meta box
    remove_meta_box( 'postimagediv','post','side' );
             
    // adding the new meta box.
    add_meta_box('postimagediv', esc_html__('Featured Image', 'luxortheme'), 'pm_ln_new_post_thumbnail_meta_box', 'post', 'side', 'low');
	
}


/*** POST META OPTIONS & FUNCTIONS *****/
function add_post_metaoptions() {
	
	//Header Image
	add_meta_box( 
		'pm_header_image_meta', //ID
		esc_html__( 'Post Header Image' , 'luxortheme' ),  //label
		'pm_header_image_meta_function' , //function
		'post', //Post type
		'normal', 
		'high' 
	);

	
}

function pm_header_image_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_header_image_meta = get_post_meta( $post->ID, 'pm_header_image_meta', true );
		

	//HTML code
	?>
    	<p><?php esc_html_e('Recommended size: 1920x500px', 'luxortheme') ?></p>
		<input type="text" value="<?php echo esc_html($pm_header_image_meta); ?>" name="post-header-image" id="img-uploader-field" class="pm-admin-upload-field" />
		<input id="upload_image_button" type="button" value="<?php esc_html_e('Media Library Image', 'luxortheme'); ?>" class="button-primary" />
        <div class="pm-admin-upload-field-preview"></div>
        
        <?php if($pm_header_image_meta) : ?>
        	<input id="remove_page_header_button" type="button" value="<?php esc_html_e('Remove Image', 'luxortheme'); ?>" class="button-primary" />
        <?php endif; ?>        
        
        
    
    <?php
	
}

function pm_header_message_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_header_message_meta = get_post_meta( $post->ID, 'pm_header_message_meta', true );
		

	//HTML code
	?>
    
		<input type="text" value="<?php echo esc_attr($pm_header_message_meta); ?>" name="pm_header_message_meta" class="pm-admin-text-field" />
    
    <?php
	
}

function pm_post_layout_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_post_layout_meta = get_post_meta( $post->ID, 'pm_post_layout_meta', true );
	
	?>
        <p><?php esc_html_e('Select your desired layout for this post.', 'luxortheme'); ?></p>
        <select id="pm_post_layout_meta" name="pm_post_layout_meta" class="pm-admin-select-list">  
            <option value="no-sidebar" <?php selected( $pm_post_layout_meta, 'no-sidebar' ); ?>><?php esc_html_e('No Sidebar', 'luxortheme') ?></option>
            <option value="left-sidebar" <?php selected( $pm_post_layout_meta, 'left-sidebar' ); ?>><?php esc_html_e('Left Sidebar', 'luxortheme') ?></option>
            <option value="right-sidebar" <?php selected( $pm_post_layout_meta, 'right-sidebar' ); ?>><?php esc_html_e('Right Sidebar', 'luxortheme') ?></option>
        </select>
        
        
    
    <?php
	
}


/*** PAGE META OPTIONS & FUNCTIONS *****/
function add_page_metaoptions() {
	
	//Header Image
	add_meta_box( 
		'pm_header_image_meta', //ID
		esc_html__( 'Page Header Image', 'luxortheme' ),
		'pm_header_image_meta_function' , //function
		'page', //Post type
		'normal', 
		'high' 
	);
	
	//Page layout
	add_meta_box( 
		'pm_page_layout_meta', //ID
		esc_html__( 'Page Layout', 'luxortheme' ),
		'pm_page_layout_meta_function' , //function
		'page', //Post type
		'side'
	);
	
	//Sidebar selector
	add_meta_box(
        'custom_sidebar',
        esc_html__( 'Custom Sidebar', 'luxortheme' ),
        'pm_ln_custom_sidebar_callback',
        'page',
        'side'
    );
		
	//Disable Container
	add_meta_box( 
		'pm_page_disable_container_meta', //ID
		esc_html__( 'Disable Bootstrap container for full width content?', 'luxortheme' ),
		'pm_page_disable_container_meta_function' , //function
		'page', //Post type
		'side'
	);
	
	//Container Padding
	add_meta_box( 
		'pm_bootstrap_container_padding', //ID
		esc_html__( 'Bootstrap Container Padding Amount' , 'luxortheme' ),  //label
		'pm_bootstrap_container_padding_function' , //function
		'page', //Post type
		'side'
		//'high' 
	);
	
	//Print and Share
	add_meta_box( 
		'pm_page_print_share_meta', //ID
		esc_html__( 'Enable Print and Share options?' , 'luxortheme' ),  //label
		'pm_page_print_share_meta_function' , //function
		'page', //Post type
		'side'
		//'high' 
	);
	
	
	
	//Header Message
	add_meta_box( 
		'pm_header_message_meta', //ID
		esc_html__( 'Page Header Message' , 'luxortheme' ),  //label
		'pm_header_message_meta_function' , //function
		'page', //Post type
		'normal', 
		'high' 
	);
	
	
}

function pm_page_layout_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_page_layout_meta = get_post_meta( $post->ID, 'pm_page_layout_meta', true );
	
	?>
            
        <select id="pm_page_layout_meta" name="pm_page_layout_meta" class="pm-admin-select-list">  
            <option value="no-sidebar" <?php selected( $pm_page_layout_meta, 'no-sidebar' ); ?>><?php esc_html_e('No Sidebar', 'luxortheme') ?></option>
            <option value="left-sidebar" <?php selected( $pm_page_layout_meta, 'left-sidebar' ); ?>><?php esc_html_e('Left Sidebar', 'luxortheme') ?></option>
            <option value="right-sidebar" <?php selected( $pm_page_layout_meta, 'right-sidebar' ); ?>><?php esc_html_e('Right Sidebar', 'luxortheme') ?></option>
        </select>
    
    <?php
	
}

function pm_page_disable_container_meta_function($post) {

	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_page_disable_container_meta = get_post_meta( $post->ID, 'pm_page_disable_container_meta', true );
	
	?>
            
        <select id="pm_page_disable_container_meta" name="pm_page_disable_container_meta" class="pm-admin-select-list"> 
        	<option value="no" <?php selected( $pm_page_disable_container_meta, 'no' ); ?>><?php esc_html_e('No', 'luxortheme') ?></option> 
            <option value="yes" <?php selected( $pm_page_disable_container_meta, 'yes' ); ?>><?php esc_html_e('Yes', 'luxortheme') ?></option>
        </select>
    
    <?php
	
}

function pm_bootstrap_container_padding_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_bootstrap_container_padding_meta = get_post_meta( $post->ID, 'pm_bootstrap_container_padding_meta', true );
	
	?>
            
        <select id="pm_bootstrap_container_padding_meta" name="pm_bootstrap_container_padding_meta" class="pm-admin-select-list"> 
        	<option value="120" <?php selected( $pm_bootstrap_container_padding_meta, '120' ); ?>>120</option>
        	<option value="110" <?php selected( $pm_bootstrap_container_padding_meta, '110' ); ?>>110</option>
            <option value="100" <?php selected( $pm_bootstrap_container_padding_meta, '100' ); ?>>100</option>
            <option value="90" <?php selected( $pm_bootstrap_container_padding_meta, '90' ); ?>>90</option>
            <option value="80" <?php selected( $pm_bootstrap_container_padding_meta, '80' ); ?>>80</option>
            <option value="70" <?php selected( $pm_bootstrap_container_padding_meta, '70' ); ?>>70</option>
            <option value="60" <?php selected( $pm_bootstrap_container_padding_meta, '60' ); ?>>60</option>
            <option value="50" <?php selected( $pm_bootstrap_container_padding_meta, '50' ); ?>>50</option>
            <option value="40" <?php selected( $pm_bootstrap_container_padding_meta, '40' ); ?>>40</option>
            <option value="30" <?php selected( $pm_bootstrap_container_padding_meta, '30' ); ?>>30</option>
            <option value="20" <?php selected( $pm_bootstrap_container_padding_meta, '20' ); ?>>20</option>
        	<option value="10" <?php selected( $pm_bootstrap_container_padding_meta, '10' ); ?>>10</option> 
        	<option value="0" <?php selected( $pm_bootstrap_container_padding_meta, '0' ); ?>>0</option> 
        	
        </select>
    
    <?php
	
}


function pm_page_print_share_meta_function($post) {

	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_page_print_share_meta = get_post_meta( $post->ID, 'pm_page_print_share_meta', true );
	
	?>
            
        <select id="pm_page_print_share_meta" name="pm_page_print_share_meta" class="pm-admin-select-list"> 
        	<option value="on" <?php selected( $pm_page_print_share_meta, 'on' ); ?>><?php esc_html_e('ON', 'luxortheme') ?></option> 
            <option value="off" <?php selected( $pm_page_print_share_meta, 'off' ); ?>><?php esc_html_e('OFF', 'luxortheme') ?></option>
        </select>
    
    <?php
	
}

function pm_display_header_meta_function($post) {

	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_display_header_meta = get_post_meta( $post->ID, 'pm_display_header_meta', true );
	
	?>
            
        <select id="pm_display_header_meta" name="pm_display_header_meta" class="pm-admin-select-list"> 
        	<option value="on" <?php selected( $pm_display_header_meta, 'on' ); ?>><?php esc_html_e('ON', 'luxortheme') ?></option> 
            <option value="off" <?php selected( $pm_display_header_meta, 'off' ); ?>><?php esc_html_e('OFF', 'luxortheme') ?></option>
        </select>
    
    <?php
	
}



function pm_disable_share_feature_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_disable_share_feature = get_post_meta( $post->ID, 'pm_disable_share_feature', true );
	
	?>
        <select id="pm_disable_share_feature" name="pm_disable_share_feature" class="pm-admin-select-list">  
            <option value="no" <?php selected( $pm_disable_share_feature, 'no' ); ?>><?php esc_html_e('No', 'luxortheme') ?></option>
            <option value="yes" <?php selected( $pm_disable_share_feature, 'yes' ); ?>><?php esc_html_e('Yes', 'luxortheme') ?></option>
        </select>
            
    <?php
	
}





/* When the post is saved, saves our custom data */
function save_postdata( $post_id ) {
	
    // verify if this is an auto save routine.
    // If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return;
 
    // verify this came from our screen and with proper authorization,
    // because save_post can be triggered at other times
 	
	if(isset($_POST['post_meta_nonce'])){
		
		if ( !wp_verify_nonce( $_POST['post_meta_nonce'], 'theme_metabox' ) )
		    return;
	 
		if ( !current_user_can( 'edit_page', $post_id ) )
			return;
			
		//Check for post values
		if(isset($_POST['post-header-image'])){
			$postHeaderImage = $_POST['post-header-image'];
			update_post_meta($post_id, "pm_header_image_meta", $postHeaderImage);
		}		
		if(isset($_POST['pm_header_message_meta'])){
			$pmHeaderMessageMeta = $_POST['pm_header_message_meta'];
			update_post_meta($post_id, "pm_header_message_meta", $pmHeaderMessageMeta);
		}
	 
	 	if(isset($_POST['pm_post_layout_meta'])){
			$pmPostLayoutMeta = $_POST['pm_post_layout_meta'];
			update_post_meta($post_id, "pm_post_layout_meta", $pmPostLayoutMeta);
		}
		
		if(isset($_POST['pm_post_featured_meta'])){
			$pmPostFeaturedMeta = $_POST['pm_post_featured_meta'];
			update_post_meta($post_id, "pm_post_featured_meta", $pmPostFeaturedMeta);
		}
		
		if(isset($_POST['pm_post_visibility'])){
			$pmPostVisibility = $_POST['pm_post_visibility'];
			update_post_meta($post_id, "pm_post_visibility", $pmPostVisibility);
		}
				
		//Check for page values
		if(isset($_POST['pm_header_image_meta'])){
			$pmPageHeaderImageMeta = $_POST['pm_header_image_meta'];
			update_post_meta($post_id, "pm_header_image_meta", $pmPageHeaderImageMeta);
		}
		
		if(isset($_POST['pm_page_layout_meta'])){
			$pmPageLayoutMeta = $_POST['pm_page_layout_meta'];
			update_post_meta($post_id, "pm_page_layout_meta", $pmPageLayoutMeta);
		}
		
		if(isset($_POST['pm_page_disable_container_meta'])){
			$pmPageDisableContainerMeta = $_POST['pm_page_disable_container_meta'];
			update_post_meta($post_id, "pm_page_disable_container_meta", $pmPageDisableContainerMeta);
		}
		
		if(isset($_POST['pm_bootstrap_container_padding_meta'])){
			update_post_meta($post_id, "pm_bootstrap_container_padding_meta", $_POST['pm_bootstrap_container_padding_meta']);
		}
		
		if(isset($_POST['pm_page_print_share_meta'])){
			$pmPagePrintShareMeta = $_POST['pm_page_print_share_meta'];
			update_post_meta($post_id, "pm_page_print_share_meta", $pmPagePrintShareMeta);
		}
		
		if(isset($_POST['pm_display_header_meta'])){
			$pmDisplayHeaderMeta = $_POST['pm_display_header_meta'];
			update_post_meta($post_id, "pm_display_header_meta", $pmDisplayHeaderMeta);
		}	
		
		if(isset($_POST['custom_sidebar'])){
			update_post_meta($post_id, "custom_sidebar", $_POST['custom_sidebar']);
		}		
			 
		
				
			
	} else {
		return;
	}	
    
}

/* When the post is saved, saves our custom data */
function pm_ln_save_sidebar_postdata( $post_id ) {
	
    // verify if this is an auto save routine.
    // If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return;
 
    // verify this came from our screen and with proper authorization,
    // because save_post can be triggered at other times
 	
	if(isset($_POST['custom_sidebar_nonce'])){
		
		if ( !wp_verify_nonce( $_POST['custom_sidebar_nonce'], 'custom_sidebar' ) )
		    return;
	 
		if ( !current_user_can( 'edit_page', $post_id ) )
			return;
	 
		$data = $_POST['custom_sidebar'];
	 
		update_post_meta($post_id, "custom_sidebar", $data);
	
	} else {
		return;
	}	
	
    
}


?>