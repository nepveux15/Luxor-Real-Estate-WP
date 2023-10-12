<?php

/* Add filters, actions, and theme-supported features after theme is loaded */
add_action( 'after_setup_theme', 'pm_ln_theme_setup' );

if( !function_exists('pm_ln_theme_setup') ){

	function pm_ln_theme_setup() {
		
		//Define content width
		if ( !isset( $content_width ) ) $content_width = 1170;
		
		/***** LOAD REDUX FRAMEWORK ******/
		
		if ( !class_exists( 'ReduxFramework' ) && file_exists( get_template_directory() . '/ReduxFramework/ReduxCore/framework.php' ) ) {
			require_once( get_template_directory() . '/ReduxFramework/ReduxCore/framework.php' );
		}
		if ( !isset( $redux_demo ) && file_exists( get_template_directory() . '/ReduxFramework/luxor/luxor-config.php' ) ) {
			require_once( get_template_directory() . '/ReduxFramework/luxor/luxor-config.php' );
		}
		
			
		/***** REQUIRED INCLUDES ***************************************************************************************************/
		
		//Widgets
		include_once(get_template_directory() . "/includes/widget-twitter.php"); //twitter
		include_once(get_template_directory() . "/includes/widget-facebook.php"); //facebook
		include_once(get_template_directory() . "/includes/widget-video.php"); //video
		include_once(get_template_directory() . "/includes/widget-flickr.php"); //flickr
		include_once(get_template_directory() . "/includes/widget-mailchimp.php"); //mailchimp
		include_once(get_template_directory() . "/includes/widget-quickcontact.php"); //quick contact form
		include_once(get_template_directory() . "/includes/widget-recentposts.php"); //recent posts
		include_once(get_template_directory() . "/includes/widget-agencies.php"); //agency posts
		include_once(get_template_directory() . "/includes/widget-agents.php"); //agent posts
		include_once(get_template_directory() . "/includes/widget-properties.php"); //properties posts
		include_once(get_template_directory() . "/includes/widget-propertysearch.php"); //properties search
		
		//Theme update notifications library
		require_once(get_template_directory() . "/includes/theme-update-checker.php");
		
		//TGM plugin
		require_once(get_template_directory() . "/includes/tgm/class-tgm-plugin-activation.php");
		
		//Bootstrap 3 nav support
		include_once(get_template_directory() . '/includes/pm_ln_bootstrap_navwalker.php');
		
		//Customizer class
		include_once(get_template_directory() . "/includes/classes/PM_LN_Customizer.class.php");
		
		//Custom functions
		include_once(get_template_directory() . "/includes/wp-functions.php");
		
		//Theme metaboxes
		include_once(get_template_directory() . "/includes/theme-metaboxes.php");
		
		//Private Members Area
		include_once(get_template_directory() . "/includes/members/members.php");
		
		
		/***** CUSTOM VISUAL COMPOSER SHORTCODES ********************************************************************************/
		if ( pm_ln_is_plugin_active( 'visual-composer/js_composer.php' ) || pm_ln_is_plugin_active( 'js_composer/js_composer.php' ) ) {

			if(!class_exists('WPBakeryShortCode')) return;
		
			$de_block_dir = get_template_directory().'/includes/vc_blocks/';
		
			require_once( $de_block_dir . 'recent_properties.php' );
			require_once( $de_block_dir . 'divider.php' );
			require_once( $de_block_dir . 'video_box.php' );
			require_once( $de_block_dir . 'newsletter_registration.php' );
			require_once( $de_block_dir . 'action_button.php' );
			require_once( $de_block_dir . 'property_search.php' );
			require_once( $de_block_dir . 'properties_gallery.php' );
			require_once( $de_block_dir . 'testimonial_profile.php' );
			require_once( $de_block_dir . 'post_items.php' );
			require_once( $de_block_dir . 'vimeo_video.php' );
			require_once( $de_block_dir . 'youtube_video.php' );
			require_once( $de_block_dir . 'html_video.php' );
			require_once( $de_block_dir . 'agent_profile.php' );
			require_once( $de_block_dir . 'pricing_table.php' );
			require_once( $de_block_dir . 'panels_carousel.php' );
			require_once( $de_block_dir . 'client_carousel.php' );
			require_once( $de_block_dir . 'testimonials.php' );
			require_once( $de_block_dir . 'progress_bar.php' );
			require_once( $de_block_dir . 'icon_element.php' );
			require_once( $de_block_dir . 'google_map.php' );
			require_once( $de_block_dir . 'standard_button.php' );
			require_once( $de_block_dir . 'countdown.php' );
			require_once( $de_block_dir . 'milestone.php' );
			require_once( $de_block_dir . 'piechart.php' );
			require_once( $de_block_dir . 'contact_form.php' );
			require_once( $de_block_dir . 'alert.php' );
			require_once( $de_block_dir . 'quote_box.php' );
			
			//Nested elements go last
			require_once( $de_block_dir . 'process_list.php' );
			require_once( $de_block_dir . 'info_list.php' );
			require_once( $de_block_dir . 'timetable_group.php' );
			require_once( $de_block_dir . 'accordion_group.php' );
			require_once( $de_block_dir . 'datatable_group.php' );
			require_once( $de_block_dir . 'tab_group.php' );
			require_once( $de_block_dir . 'slider_carousel.php' );

				
		
		}
			
		/***** MENUS ***************************************************************************************************/
		
		register_nav_menu('main_menu', 'Main Menu');
		register_nav_menu('footer_menu', 'Footer Menu');
		
		/***** THEME SUPPORT ***************************************************************************************************/
		
		add_theme_support('post-thumbnails');
		add_theme_support('automatic-feed-links');
		add_theme_support('custom-header');
		add_theme_support('custom-background');	
		add_theme_support('title-tag');
			
		/***** CUSTOM FILTERS AND HOOKS ***************************************************************************************************/
					
		//Add your sidebars function to the 'widgets_init' action hook.
		add_action( 'widgets_init', 'pm_ln_register_custom_sidebars' );
		
		//Load front-end scripts
		add_action( 'wp_enqueue_scripts', 'pm_ln_scripts_styles' );
		
		//Load admin scripts
		add_action( 'admin_enqueue_scripts', 'pm_ln_load_admin_scripts' );
		
		add_filter('excerpt_more', 'pm_ln_new_excerpt_more');
			
		//Add content and widget text shortcode support
		add_filter('the_content', 'do_shortcode');
		add_filter('widget_text', 'do_shortcode');
		
		//Show Post ID's
		add_filter('manage_posts_columns', 'pm_ln_posts_columns_id', 5);
		add_action('manage_posts_custom_column', 'pm_ln_posts_custom_id_columns', 5, 2);
		
		//Show Page ID's
		add_filter('manage_pages_columns', 'pm_ln_posts_columns_id', 5);
		add_action('manage_pages_custom_column', 'pm_ln_posts_custom_id_columns', 5, 2);
				
		//Custom paginated posts
		add_filter('wp_link_pages_args','pm_ln_custom_nextpage_links');
		
		//Remove REL tag from posts (this will eliminate HTML5 validation error) 
		add_filter( 'wp_list_categories', 'pm_ln_remove_category_list_rel' );
		add_filter( 'the_category', 'pm_ln_remove_category_list_rel' );
		
		//Remove title attributes from WordPress navigation
		add_filter( 'wp_list_pages', 'pm_ln_remove_title_attributes' );
		
		//Ajax loader function
		add_action('wp_ajax_pm_ln_load_more', 'pm_ln_load_more');
		add_action('wp_ajax_nopriv_pm_ln_load_more', 'pm_ln_load_more');
		
		add_action('wp_ajax_pm_ln_load_more_posts', 'pm_ln_load_more_posts');
		add_action('wp_ajax_nopriv_pm_ln_load_more_posts', 'pm_ln_load_more_posts');
		
		//Ajax Contact form
		add_action('wp_ajax_send_contact_form', 'pm_ln_send_contact_form');
		add_action('wp_ajax_nopriv_send_contact_form', 'pm_ln_send_contact_form');
		
		//Ajax Agent form
		add_action('wp_ajax_send_agent_form', 'pm_ln_send_agent_form');
		add_action('wp_ajax_nopriv_send_agent_form', 'pm_ln_send_agent_form');
		
		//Ajax Property Agent form
		add_action('wp_ajax_send_property_agent_form', 'pm_ln_send_property_agent_form');
		add_action('wp_ajax_nopriv_send_property_agent_form', 'pm_ln_send_property_agent_form');
		
		//Ajax Quick Contact form
		add_action('wp_ajax_send_quick_contact_form', 'pm_ln_send_quick_contact_form');
		add_action('wp_ajax_nopriv_send_quick_contact_form', 'pm_ln_send_quick_contact_form');
		
		//Like feature
		add_action('wp_ajax_pm_ln_retrieve_likes', 'pm_ln_retrieve_likes');
		add_action('wp_ajax_nopriv_pm_ln_retrieve_likes', 'pm_ln_retrieve_likes');
		
		add_action('wp_ajax_pm_ln_like_feature', 'pm_ln_like_feature');
		add_action('wp_ajax_nopriv_pm_ln_like_feature', 'pm_ln_like_feature');
		
		
		//Log post views
		add_action('wp_head', 'pm_ln_log_post_views');
		
		//Output buffer
		add_action('init', 'app_output_buffer');
		
		//Custom login styles
		//add_action('login_head', 'pm_ln_custom_login');
		
		/**** THEME CUSTOMIZER ****/
			
		//Output CSS to head section
		add_action ('wp_head', 'pm_ln_customizer_css');
		add_action( 'customize_preview_init', 'pm_ln_customize_preview_js' );
		//add_action( 'customize_controls_enqueue_scripts', 'pm_ln_panels_js' );
		
		//Ajax Scripts
		add_action('wp_enqueue_scripts', 'pm_ln_register_user_scripts');
		
		//Ajax Registration
		add_action('wp_ajax_register_user', 'pm_ln_register_new_user');
		add_action('wp_ajax_nopriv_register_user', 'pm_ln_register_new_user');
		
		//Ajax Login
		add_action('wp_ajax_validate_quick_login', 'pm_ln_validate_quick_login');
		add_action('wp_ajax_nopriv_validate_quick_login', 'pm_ln_validate_quick_login');
		
		/**** WOOCOMMERCE ***/
	
		//Declare Woocommerce support
		add_theme_support('woocommerce');
		
		//Woocommerce gallery support for version 3.0
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
		
		//Remove Woocommerce breadcrumbs
		add_action( 'init', 'pm_ln_remove_wc_breadcrumbs' );
		
		//Remove default Woocommerce wrapper
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
		
		//Add wrapper to Woocommerce pages - applies to product-archive.php and single-product.php
		add_action('woocommerce_before_main_content', 'pm_ln_woo_wrapper_start', 10);
		add_action('woocommerce_after_main_content', 'pm_ln_woo_wrapper_end', 10);
		
		//Display empty star rating
		add_filter('woocommerce_product_get_rating_html', 'pm_ln_woo_get_rating_html', 10, 2);
		
		//Display number of items per page
		$products_per_page = get_theme_mod('products_per_page', 8);
		add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$products_per_page.';' ), 20 );
		
		//Dashboard customization
		add_filter( 'admin_footer_text', 'pm_ln_remove_footer_admin' );//footer info
		add_action( 'login_enqueue_scripts', 'pm_ln_login_logo' );//login logo
		add_filter( 'login_headerurl', 'pm_ln_login_logo_url' );//login logo url
		add_filter( 'login_headertitle', 'pm_ln_login_logo_url_title' );//login logo title
		
		//TGM plugin activation
		add_action( 'tgmpa_register', 'pm_ln_register_required_plugins' );
		
		//Theme updates
		//add_action('init', 'pm_ln_check_for_theme_updates');
		
		//Custom settings page for purchase verification
		add_action( 'admin_menu', 'pm_ln_theme_settings_admin_menu' );
		
		//Create theme update options
		add_option('pm_ln_theme_marketplace','');
		add_option('pm_ln_micro_themes_user_email','');
		add_option('pm_ln_micro_themes_purchase_code_themeforest','');
		add_option('pm_ln_micro_themes_purchase_code_mojo','');
					
	}//end of after_theme_setup

}



//localization support - NOTE: This has to be a seperate after theme setup method in order to work - THEMEFOREST reviewers do not pick up on this!
add_action('after_setup_theme', 'pm_ln_localization_setup');

if( !function_exists('pm_ln_customize_preview_js') ) {
	
	function pm_ln_customize_preview_js() {
		wp_enqueue_script( 'procast-theme-customize-preview', get_theme_file_uri( '/js/customize-preview.js' ), array( 'customize-preview' ), '1.0', true );
	}
	
}

if( !function_exists('pm_ln_panels_js') ) {
	
	function pm_ln_panels_js() {
		wp_enqueue_script( 'procast-theme-customize-controls', get_theme_file_uri( '/js/customize-controls.js' ), array(), '1.0', true );
	}
	
}

if ( ! function_exists( 'pm_ln_remove_wc_breadcrumbs' ) ) {
	
	function pm_ln_remove_wc_breadcrumbs() {
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
	}
	
}



if ( ! function_exists( 'pm_ln_woo_wrapper_start' ) ) {
	
	function pm_ln_woo_wrapper_start() {
		
		  $woocommShopLayout = get_theme_mod('woocommShopLayout', 'no-sidebar');
		
		  echo '<div class="container pm-containerPadding-top-80 pm-containerPadding-bottom-80">';
			 echo '<div class="row">';
			 
				if( $woocommShopLayout === 'left-sidebar' ) {
					get_sidebar('woocommerce');
				}
			 
				echo '<div class="col-lg-'. ( $woocommShopLayout === 'no-sidebar' ? '12' : '8' ) .' col-md-'. ( $woocommShopLayout === 'no-sidebar' ? '12' : '8' ) .' col-sm-12">';	  
		  
		  echo ''; 
	  
	}
	
}

if ( ! function_exists( 'pm_ln_woo_wrapper_end' ) ) {
	
	function pm_ln_woo_wrapper_end() {
		
		$woocommShopLayout = get_theme_mod('woocommShopLayout', 'no-sidebar');
		
	  		echo '</div>';
			
			if( $woocommShopLayout === 'right-sidebar' ) {
				get_sidebar('woocommerce');
			}
			
	  	 echo '</div>';
	  echo '</div>';
	  echo ''; 
	  
	}
	
}


if( !function_exists('pm_ln_woo_get_rating_html') ){
	
	function pm_ln_woo_get_rating_html($rating_html, $rating) {
	
		if ( $rating > 0 ) {
			$title = sprintf( __( 'Rated %s out of 5', 'woocommerce' ), $rating );
		} else {
			$title = 'Not yet rated';
			$rating = 0;
		}
	
		$rating_html  = '<div class="star-rating" title="' . $title . '">';
		$rating_html .= '<span style="width:' . ( ( $rating / 5 ) * 100 ) . '%"><strong class="rating">' . $rating . '</strong> ' . __( 'out of 5', 'woocommerce' ) . '</span>';
		$rating_html .= '</div>';
		
		return $rating_html;
		
	}
	
}

function pm_ln_login_logo_url() {
	return esc_url( 'https://www.pulsarmedia.ca' );
}

function pm_ln_login_logo_url_title() {
	return esc_html__('Pulsar Media :: Interactive Design Studio', "luxortheme");
}

function pm_ln_login_logo() { ?>
	<style type="text/css">
		body.login div#login h1 a {
			background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/pulsar-media-login.png );
			padding-bottom: 0px;
			width:321px !important;
			background-size:100%;
		}
	</style>
<?php }

function pm_ln_remove_footer_admin () {
	echo '<span id="footer-thankyou">'. esc_html__('Developed by', "luxortheme") .' <a href="http://www.pulsarmedia.ca/" target="_blank">'. esc_html__('Pulsar Media', "luxortheme") .'</a> :: '. esc_html__('Interactive Design Studio', "luxortheme") .' - '. esc_html__('Visit our', "luxortheme") .' <a href="https://github.com/PulsarMedia" target="_blank">'. esc_html__('GitHub account', "luxortheme") . '</a> ' . esc_html__('for more FREE WordPress themes and plugins', 'luxortheme');
}



if( !function_exists('pm_ln_remove_dashboard_widget') ){

	function pm_ln_remove_dashboard_widget () {
		remove_meta_box ( 'dashboard_quick_press', 'dashboard', 'side' );
		
		remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
	}

}


if( !function_exists('pm_ln_add_dashboard_widgets') ){

	function pm_ln_add_dashboard_widgets() {
		wp_add_dashboard_widget(
			'pm_ln_dashboard_widget', // Widget slug.
			esc_html__('Micro Themes - Latest News', 'luxortheme'), // Title.
			'pm_ln_dashboard_widget_function' // Display function.
		);
	}

}


if( !function_exists('pm_ln_dashboard_widget_function') ){

	function pm_ln_dashboard_widget_function() {
	
		$news_file = wp_remote_get( 'https://www.microthemes.ca/files/theme-news/news.html' );
		
		if( is_array($news_file) ) {
							
		  $header = $news_file['headers']; // array of http header lines
		  $body = $news_file['body']; // use the content
		  
		  $args = array(
				'a' => array(
					'href' => array(),
					'title' => array()
				),
				'br' => array(),
				'em' => array(),
				'strong' => array(),
				'p' => array(),
				'h2' => array(),
			);
		  
		  echo wp_kses($body, $args) ;
		  
		}
		
	}

}

if( !function_exists('pm_ln_check_for_theme_updates') ){
	
	function pm_ln_check_for_theme_updates() {
	
		$theme_update_checker = new ThemeUpdateChecker(
			'luxor-theme',
			'http://updates.microthemes.ca/theme-updates/luxor-theme-updater.php'
		);
		
		$theme_update_checker->checkForUpdates();
			
	}
	
}


if( !function_exists('pm_ln_theme_settings_admin_menu') ){	
	function pm_ln_theme_settings_admin_menu() {	
		add_options_page( esc_attr__('Theme Updates', 'luxortheme'), esc_attr__('Theme Updates', 'luxortheme'), 'manage_options', 'myplugin/myplugin-admin-page.php', 'pm_ln_theme_settings_admin_page', 'dashicons-tickets', 6 );
	}
}


if( !function_exists('pm_ln_theme_settings_admin_page') ){

	function pm_ln_theme_settings_admin_page(){		

		if(isset($_POST['pm_ln_verify_account_update'])){			
			update_option('pm_ln_theme_marketplace', sanitize_text_field($_POST['pm_ln_theme_marketplace']));
			update_option('pm_ln_micro_themes_user_email', sanitize_text_field($_POST['pm_ln_micro_themes_user_email']));
			update_option('pm_ln_micro_themes_purchase_code_themeforest', sanitize_text_field($_POST['pm_ln_micro_themes_purchase_code_themeforest']));
			update_option('pm_ln_micro_themes_purchase_code_mojo', sanitize_text_field($_POST['pm_ln_micro_themes_purchase_code_mojo']));
			update_option('pm_ln_micro_themes_purchased_product', 5);//Corresponds to products array in verify account script
						
		}

		$pm_ln_micro_themes_user_email = get_option('pm_ln_micro_themes_user_email');
		$pm_ln_theme_marketplace = get_option('pm_ln_theme_marketplace');
		$pm_ln_micro_themes_purchase_code_themeforest = get_option('pm_ln_micro_themes_purchase_code_themeforest');	
		$pm_ln_micro_themes_purchase_code_mojo = get_option('pm_ln_micro_themes_purchase_code_mojo');	
		$pm_ln_micro_themes_purchased_product = get_option('pm_ln_micro_themes_purchased_product');
		
		//Validate account
		$queryArgs = array();
		$queryArgs['customer_email'] = $pm_ln_micro_themes_user_email;	
		$queryArgs['customer_marketplace'] = $pm_ln_theme_marketplace;
		$queryArgs['customer_themeforest_purchase_code'] = $pm_ln_micro_themes_purchase_code_themeforest;
		$queryArgs['customer_mojo_purchase_code'] = $pm_ln_micro_themes_purchase_code_mojo;
		$queryArgs['customer_product'] = $pm_ln_micro_themes_purchased_product;
		
		$account_valid = false;
		
		//args for wp_remote_get
		$options = array(
			'timeout' => 10, //seconds
		);
		
		$url = 'http://updates.microthemes.ca/theme-updates/verify-account.php'; 
		if ( !empty($queryArgs) ){
			$url = add_query_arg($queryArgs, $url); //rebuild url with arguments
		}
		
		//Send the request to Micro Themes
		$response = wp_remote_get($url, $options);
						
		if( is_array($response) ) {
			
		  $header = $response['headers']; // array of http header lines
		  $body = $response['body']; // use the content
		  		  
		  if( strstr($body, "success") ){
			  $account_valid = true;
		  }
		  
		}

		?>

		<div class="wrap">
        
        	<div class="wpmm-wrapper">
            
            	<div id="content" class="wrapper-cell">
            
					<?php if(isset($_POST['pm_ln_verify_account_update'])){?>
    
                        <div class="notice notice-success is-dismissible">
                            <p><?php esc_attr_e('Your settings were updated', 'luxortheme'); ?></p>
                        </div>
                        
                    <?php } ?>	
        
                    <h2><?php esc_attr_e('Theme verification', 'luxortheme'); ?></h2>
                    <p><?php esc_attr_e('Use the form below to verify your Micro Themes account - this will verify your account for automatic updates.', 'luxortheme'); ?></p>            
        
                    <form method="post" action="">            
        
                        <p><label><?php esc_attr_e('Select your marketplace for purchase verification', 'luxortheme'); ?>:</label></p>                
        
                        <select name="pm_ln_theme_marketplace" id="pm_ln_verify_marketplace_selection">
                            <option value="default" <?php if ( 'default' == $pm_ln_theme_marketplace ) echo 'selected="selected"'; ?>>-- <?php esc_attr_e('Choose Marketplace', 'luxortheme'); ?> --</option>
                            <option value="microthemes" <?php if ( 'microthemes' == $pm_ln_theme_marketplace ) echo 'selected="selected"'; ?>><?php esc_attr_e('Micro Themes', 'luxortheme'); ?></option>
                            <option value="themeforest" <?php if ( 'themeforest' == $pm_ln_theme_marketplace ) echo 'selected="selected"'; ?>><?php esc_attr_e('Themeforest', 'luxortheme'); ?></option>
                            <option value="mojo" <?php if ( 'mojo' == $pm_ln_theme_marketplace ) echo 'selected="selected"'; ?>><?php esc_attr_e('Mojo Marketplace', 'luxortheme'); ?></option>
                        </select>                
        
                        <div id="pm_ln_micro_themes_purchase_code_themeforest" class="pm_ln_micro_themes_purchase_code <?php echo $pm_ln_theme_marketplace == 'themeforest' ? 'active' : ''; ?>">
                            <p><label><?php esc_attr_e('Themeforest item purchase code', 'luxortheme'); ?>:</label></p>
                            <input class="pm-admin-theme-verify-text-field" type="text" name="pm_ln_micro_themes_purchase_code_themeforest" value="<?php esc_attr_e($pm_ln_micro_themes_purchase_code_themeforest); ?>" maxlength="200" />
                        </div> 
                        
                        <div id="pm_ln_micro_themes_purchase_code_mojo" class="pm_ln_micro_themes_purchase_code <?php echo $pm_ln_theme_marketplace == 'mojo' ? 'active' : ''; ?>">
                            <p><label><?php esc_attr_e('Mojo item purchase code', 'luxortheme'); ?>:</label></p>
                            <input class="pm-admin-theme-verify-text-field" type="text" name="pm_ln_micro_themes_purchase_code_mojo" value="<?php esc_attr_e($pm_ln_micro_themes_purchase_code_mojo); ?>" maxlength="200" />
                        </div>                
        
                        <p><label><?php esc_attr_e('Micro Themes account email address', 'luxortheme'); ?>:</label></p>
                        <input class="pm-admin-theme-verify-text-field" type="text" value="<?php esc_attr_e($pm_ln_micro_themes_user_email); ?>" name="pm_ln_micro_themes_user_email" maxlength="200" />             
        
                        <input type="hidden" name="pm_ln_micro_themes_installed_theme" value="Medical-Link" />    
                        <p id="pm_ln_micro_themes_verfication_status"><?php esc_attr_e('Account status', 'luxortheme'); ?>: <span><b><?php echo $account_valid == true ? esc_attr('Verified', 'luxortheme') : esc_attr('Unverified', 'luxortheme'); ?></b></span></p>
        
                        <br />                
        
                        <input name="pm_ln_verify_account_update" class="button button-primary button-large" value="<?php esc_attr_e('Verify Account', 'luxortheme'); ?>" type="submit">            
        
                    </form>
                
                </div><!-- /.wrapper-cell -->
    
                <div id="sidebar" class="wrapper-cell">
                
                    <div class="sidebar_box themes_box">
                        <h3><?php esc_attr_e('More Themes by Micro Themes', 'luxortheme'); ?>:</h3>
                        <div class="inside">
                            <ul>
                            	<li>
                                	<a href="http://demos.microthemes.ca/?product=hope" target="_blank" title="Hope WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/hope.jpg" alt="Hope WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=quantum" target="_blank" title="Quantum WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/quantum.jpg" alt="Quantum WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=vienna" target="_blank" title="Vienna WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/vienna.jpg" alt="Vienna WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=medical-link" target="_blank" title="Medical-Link WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/medical-link.jpg" alt="Medical-Link WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=energy" target="_blank" title="Energy WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/energy.jpg" alt="Energy WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=luxor" target="_blank" title="Luxor WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/luxor.jpg" alt="Luxor WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=moxie" target="_blank" title="Moxie WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/moxie.jpg" alt="Moxie WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=pro-cast" target="_blank" title="Pro-Cast WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/pro-cast.jpg" alt="Pro-Cast WordPress Themes"></a>
                                </li>	
                                			
                            </ul>
                        </div>
                        
                        <h3><?php esc_attr_e('Plug-ins by Micro Themes', 'luxortheme'); ?>:</h3>
                        <div class="inside">
                            <ul>
                            	<li>
                                	<a href="http://demos.microthemes.ca/?product=easy-social-stream" target="_blank" title="Easy Social Stream"><img src="http://microthemes.ca/images/theme-ads/easy-social-stream.jpg" alt="Easy Social Stream"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=easy-social-login" target="_blank" title="Easy Social Login"><img src="http://microthemes.ca/images/theme-ads/easy-social-login.jpg" alt="Easy Social Login"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=premium-presentations" target="_blank" title="Premium Presentations"><img src="http://microthemes.ca/images/theme-ads/premium-presentations.jpg" alt="Premium Presentations"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=premium-paypal-manager" target="_blank" title="Premium Paypal Manager"><img src="http://microthemes.ca/images/theme-ads/premium-paypal-manager.jpg" alt="Premium Paypal Manager"></a>
                                </li>                                			
                            </ul>
                        </div>
                        
                    </div>
                
                </div><!-- /.wrapper-cell #sidebar -->
            
            </div><!-- /.wpmm-wrapper -->

		</div><!-- /.wrap -->

		<?php
	}
}



if( !function_exists('pm_ln_log_post_views') ){

	/******* Log post views *****/
	function pm_ln_log_post_views() {
	   if(is_single()) {
		  global $post;
		  $count = get_post_meta($post->ID, 'post_views', true);
		  ++$count;
	
		  update_post_meta($post->ID, 'post_views', $count);
	   }
	}

}


if( !function_exists('pm_ln_register_user_scripts') ){

	function pm_ln_register_user_scripts() {
	
	  // Enqueue script
	  wp_enqueue_script( 'pm-ln-register-script', get_template_directory_uri() . '/js/ajax-registration/ajax-registration.js', array('jquery'), '1.0', true );
	  wp_enqueue_script( 'pm-ln-quick-login-script', get_template_directory_uri() . '/js/ajax-login/ajax-login.js', array('jquery'), '1.0', true );
	  
	  $js_file = get_template_directory_uri() . '/js/wordpress.js'; 
	  wp_enqueue_script( 'pm_ln_register_script', $js_file );
		$array = array( 
			'pm_ln_ajax_url' => admin_url('admin-ajax.php'),
		);
		
	  wp_localize_script( 'pm_ln_register_script', 'pm_ln_register_vars', $array );
	
	}

}


if( !function_exists('pm_ln_remove_title_attributes') ){

	/******* Remove title atts from WordPress nav *****/
	function pm_ln_remove_title_attributes($input) {
		return preg_replace('/\s*title\s*=\s*(["\']).*?\1/', '', $input);
	}

}


if( !function_exists('app_output_buffer') ){

	function app_output_buffer() {
	  ob_start();
	}

}


if( !function_exists('pm_ln_remove_category_list_rel') ){

	//Remove REL tag from posts (this will eliminate HTML5 validation error)
	function pm_ln_remove_category_list_rel( $output ) {
		// Remove rel attribute from the category list
		return str_replace( ' rel="category tag"', '', $output );
	}

}


if( !function_exists('pm_ln_posts_columns_id') ){

	//Show Post ID's
	function pm_ln_posts_columns_id($defaults){
		$defaults['wps_post_id'] = esc_html__('ID', 'luxortheme');
		return $defaults;
	}

}


if( !function_exists('pm_ln_posts_custom_id_columns') ){

	function pm_ln_posts_custom_id_columns($column_name, $id){
			if($column_name === 'wps_post_id'){
					echo $id;
		}
	}

}


if( !function_exists('pm_ln_new_excerpt_more') ){

	//Excerpt filters
	function pm_ln_new_excerpt_more($more) {
		global $post;
		return '... <a href="'. get_permalink($post->ID) . '" class="readmore">'.esc_html__('Read More', 'luxortheme').' &raquo</a>';
	}

}


if( !function_exists('pm_ln_custom_nextpage_links') ){

	//Custom paginated posts
	function pm_ln_custom_nextpage_links($defaults) {
		$args = array(
			'before' => '<div class="pm_paginated-posts"><p>'. esc_html__('Continue Reading: ', 'luxortheme') .'</p><ul class="pagination_multi clearfix">',
			'after' => '</ul></div>',
			'link_before'      => '<li>',
			'link_after'       => '</li>',
		);
		$r = wp_parse_args($args, $defaults);
		return $r;
	}

}


if( !function_exists('pm_ln_load_admin_scripts') ){

	//Enqueue scripts and styles for admin area
	function pm_ln_load_admin_scripts() {
		
		wp_enqueue_media();
		
		//Load Media uploader script for custom meta options
		wp_enqueue_script( 'pulsar-mediauploader', get_template_directory_uri() . '/js/media-uploader/pm-image-uploader.js', array('jquery'), '1.0', true );
		
		//Custom CSS for meta boxes
		wp_enqueue_style( 'pulsar-wpadmin', get_template_directory_uri() . '/js/wp-admin/wp-admin.css' );
		
		//Customizer CSS
		wp_enqueue_style( 'pulsar-customizer', get_template_directory_uri() . '/js/wp-admin/wp-admin.css' );
				
		//Date picker for Classes and Event post types
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_style( 'pulsar-datepicker', get_template_directory_uri() . '/css/datepicker/jquery-ui.min.css' );
		
		$admin_js = get_template_directory_uri() . '/js/wp-admin/wp-admin.js'; 
		
		//Pass admin path to JS
		wp_register_script( 'adminRoot', $admin_js  );
		wp_enqueue_script( 'adminRoot' );
		$array = array( 
			'adminRoot' => home_url('/'),
		);
		wp_localize_script( 'adminRoot', 'adminRootObject', $array ); 
		
	}

}


if( !function_exists('pm_ln_scripts_styles') ){

	//Enqueue scripts and styles
	function pm_ln_scripts_styles() {
			
		global $wp_styles;
		global $post;
	
		// Adds JavaScript to pages with the comment form to support sites with threaded comments (when in use).
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	
			//Adds JavaScript for handling the navigation menu hide-and-show behavior.
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-ui-datepicker' );
			
			wp_enqueue_script( 'pulsar-bootstrap', get_template_directory_uri() . '/bootstrap3/js/bootstrap.min.js', array('jquery'), '1.0', true );
			wp_enqueue_script( 'pulsar-modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', array('jquery'), '1.0', false );
			
			wp_enqueue_script( 'pulsar-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array('jquery'), '1.0', true );
			wp_enqueue_script( 'pulsar-superfish', get_template_directory_uri() . '/js/superfish/superfish.js', array('jquery'), '1.0', true );
			wp_enqueue_script( 'pulsar-hoverIntent', get_template_directory_uri() . '/js/superfish/hoverIntent.js', array('jquery'), '1.0', true );
			
			wp_enqueue_script( 'pulsar-tinynav', get_template_directory_uri() . '/js/tinynav.js', array('jquery'), '1.0', true );
					
			wp_enqueue_script( 'pulsar-easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array('jquery'), '1.0', true );
			
			//Flexslider
			wp_enqueue_script( 'pulsar-flexslider', get_template_directory_uri() . '/js/flexslider/jquery.flexslider-min.js', array('jquery'), '1.0', true );
			wp_enqueue_style( 'pulsar-flexslider', get_template_directory_uri() . '/js/flexslider/flexslider-post.css', array( 'pulsar-style' ), '20121010' );	
			
			//PrettyPhoto
			if( pm_ln_has_shortcode('videoBox') || pm_ln_is_plugin_active( 'visual-composer/js_composer.php' ) || pm_ln_is_plugin_active( 'js_composer/js_composer.php' ) ){
				wp_enqueue_style( 'pulsar-prettyPhoto', get_template_directory_uri() . '/js/prettyphoto/css/prettyPhoto.css', array( 'pulsar-style' ), '20121010' );
				wp_enqueue_script( 'pulsar-prettyphoto', get_template_directory_uri() . '/js/prettyphoto/js/jquery.prettyPhoto.js', array('jquery'), '1.0', true );
				wp_enqueue_script( 'pulsar-prettyphoto', get_template_directory_uri() . '/js/jquery-migrate-1.2.1.js', array('jquery'), '1.0', true );
			}
			
			
			$retinaSupport = get_theme_mod('retinaSupport', 'off');
			if($retinaSupport === 'on'){
				wp_enqueue_script( 'pulsar-retina', get_template_directory_uri() . '/js/retina.js', array('jquery'), '1.0', true );
			}
			
			//Testimonials
			if( pm_ln_has_shortcode('testimonials') || pm_ln_is_plugin_active( 'visual-composer/js_composer.php' ) || pm_ln_is_plugin_active( 'js_composer/js_composer.php' ) ){
				wp_enqueue_script( 'pulsar-testimonials', get_template_directory_uri() . '/js/jquery.testimonials.js', array('jquery'), '1.0', true );
			}
			
			//Jquery UI
			wp_enqueue_style( 'pulsar-jqueryui', get_template_directory_uri() . '/css/jquery-ui/jquery-ui.css', array( 'pulsar-style' ), '20121010' );
			
			
			if( is_single() || is_page() || is_home() ){
										
				//Load WOW
				wp_enqueue_style( 'animate', get_template_directory_uri() . '/js/wow/css/libs/animate.css', array( 'pulsar-style' ), '20121010' );
				wp_enqueue_script( 'wow', get_template_directory_uri() . '/js/wow/wow.min.js', array('jquery'), '1.0', true );
							
				
				//Load Viewport Selectors for jQuery
				wp_enqueue_script( 'viewport', get_template_directory_uri() . '/js/jquery.viewport.mini.js', array('jquery'), '1.0', true );	
				
				$googleAPIKey = get_theme_mod('googleAPIKey');
				
				//Google maps shortcode support
				wp_register_script('googlemaps', ('https://maps.google.com/maps/api/js?key='.$googleAPIKey.'&libraries=places'), false, null, true);
				wp_enqueue_script('googlemaps');
				
			}
			
			if( pm_ln_has_shortcode('clientCarousel') || pm_ln_has_shortcode('panelsCarousel') || pm_ln_has_shortcode('postItems') || pm_ln_is_plugin_active( 'visual-composer/js_composer.php' ) || pm_ln_is_plugin_active( 'js_composer/js_composer.php' ) ){
				//load owl carousel
				wp_enqueue_style( 'owl-carousel-css', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.css', array( 'pulsar-style' ), '20121010' );
				wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.js', array('jquery'), '1.0', true );
			}
			
			if( pm_ln_has_shortcode('milestone') || pm_ln_has_shortcode('piechart') || pm_ln_is_plugin_active( 'visual-composer/js_composer.php' ) || pm_ln_is_plugin_active( 'js_composer/js_composer.php' ) ){
				//Load Easypiechart
				wp_enqueue_script( 'easypiechart', get_template_directory_uri() . '/js/easypiechart/jquery.easypiechart.min.js', array('jquery'), '1.0', true );
			}
			
			if( pm_ln_has_shortcode('countdown') || pm_ln_is_plugin_active( 'visual-composer/js_composer.php' ) || pm_ln_is_plugin_active( 'js_composer/js_composer.php' ) ){
				//Load Countdown
				wp_enqueue_script( 'countdown', get_template_directory_uri() . '/js/countdown/countdown.js', array('jquery'), '1.0', true );
			}
			
			if( is_single() || is_page() || is_home() || is_front_page() || is_archive() || is_search() ){
				
				//Like feature
				wp_enqueue_script( 'pulsar-like', get_template_directory_uri() . '/js/ajax-like-feature/ajax-like-feature.js', array('jquery'), '1.0', true );
				$js_file = get_template_directory_uri() . '/js/wordpress.js'; 
				wp_enqueue_script( 'jcustom', $js_file );
				$array = array( 
					'ajaxurl' => admin_url('admin-ajax.php'),
					'nonce' => wp_create_nonce('pulsar_ajax'),
					'loading' => esc_html__('Loading...', 'luxortheme')
				);
				wp_localize_script( 'jcustom', 'pulsarajax', $array );
				
			}
			
			if( is_page_template('template-agents.php') || is_page_template('template-properties.php') || is_page_template('template-agencies.php') || is_page_template('template-propertysearch.php') || is_page_template('template-membersproperties.php' || is_page_template('template-memberspropertysearch.php')) ){
				
				//load isotope
				wp_enqueue_style( 'isotope-css', get_template_directory_uri() . '/js/isotope/isotope.css', array( 'pulsar-style' ), '20121010' );
				wp_enqueue_script( 'isotope-js', get_template_directory_uri() . '/js/isotope/jquery.isotope.min.js', array('jquery'), '1.0', true );
				
				//Load Ajax loader
				$js_file = get_template_directory_uri() . '/js/wordpress.js'; 
				
				wp_enqueue_script( 'jcustom', $js_file );
				$array = array( 
					'ajaxurl' => admin_url('admin-ajax.php'),
					'nonce' => wp_create_nonce('pulsar_ajax'),
					'loading' => esc_html__('Loading...', 'luxortheme')
				);
				wp_localize_script( 'jcustom', 'pulsarajax', $array );
				
			}
			
			
			//Load pulse slider
			if( is_home() || is_front_page() ) {
				wp_enqueue_script( 'pulseslider', get_template_directory_uri() . '/js/pulse/jquery.PMSlider.js', array('jquery'), '1.0', true );
				wp_enqueue_style( 'pulseslider-css', get_template_directory_uri() . '/js/pulse/pm-slider.css', array( 'pulsar-style' ), '20121010' );
			}
			
							
			//Agent contact form
			if( pm_ln_has_shortcode('contactForm') || pm_ln_is_plugin_active( 'visual-composer/js_composer.php' ) || pm_ln_is_plugin_active( 'js_composer/js_composer.php' ) ) {
				//Ajax contact form
				wp_enqueue_script( 'pulsar-ajaxemail', get_template_directory_uri() . '/js/ajax-contact/ajax-email.js', array('jquery'), '1.0', true );
			}
			
			//Agent contact form
			wp_enqueue_script( 'pulsar-agentcontactform', get_template_directory_uri() . '/js/ajax-agent-contact/ajax-email.js', array('jquery'), '1.0', true );
							
			//Property agent contact form
			wp_enqueue_script( 'pulsar-propertyagentcontactform', get_template_directory_uri() . '/js/ajax-property-agent-contact/ajax-email.js', array('jquery'), '1.0', true );
			
			//Ajax quick contact
			if(is_active_widget( '', '', 'pm_quickcontact_widget')) {
				wp_enqueue_script( 'pulsar-quickcontact', get_template_directory_uri() . '/js/ajax-quick-contact/ajax-quick-email.js', array('jquery'), '1.0', true );
			}
			
			//Property search widget
			if(is_active_widget( '', '', 'pm_property_search_widget')) {
				wp_enqueue_script( 'jquery-ui-core' );
				wp_enqueue_script( 'jquery-ui-mouse' );
				wp_enqueue_script( 'jquery-ui-slider' );			
			}
			
			//Pulsar Media plug-ins
			wp_enqueue_script( 'tooltip', get_template_directory_uri() . '/js/jquery.tooltip.js', array('jquery'), '1.0', true );
							
			//Load Stellar Parallax
			wp_enqueue_script( 'stellar', get_template_directory_uri() . '/js/stellar/jquery.stellar.js', array('jquery'), '1.0', true );
			
			//img preload
			wp_enqueue_script( 'imgpreload', get_template_directory_uri() . '/js/jquery.imgpreload.min.js', array('jquery'), '1.0', true );
			
			//css browser selector
			wp_enqueue_script( 'css_browser_selector', get_template_directory_uri() . '/js/css_browser_selector.js', array('jquery'), '1.0', true );
			
			//Load main theme script
			wp_enqueue_script( 'pulsar-main', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0', true );
							
			//twitterfetch
			if(is_active_widget( '', '', 'latest-tweets')) {
				wp_enqueue_script( 'twitterFetcher', get_template_directory_uri() . '/js/twitter-post-fetcher/twitterFetcher_min.js', array('jquery'), '1.0', true );
			}
			
					
			//Loads our main stylesheet.
			wp_enqueue_style( 'pulsar-style', get_stylesheet_uri() );
			
			wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/bootstrap3/css/bootstrap.min.css', array( 'pulsar-style' ), '20121010' );
			wp_enqueue_style( 'master-css', get_template_directory_uri() . '/css/master.css', array( 'pulsar-style' ), '20121010' );
		
			//Loads other stylesheets.
			wp_enqueue_style( 'superfish', get_template_directory_uri() . '/css/superfish/superfish.css', array( 'pulsar-style' ), '20121010' );
			wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/css/fontawesome/font-awesome.min.css', array( 'pulsar-style' ), '20121010' );
			wp_enqueue_style( 'typicons', get_template_directory_uri() . '/css/typicons/typicons.min.css', array( 'pulsar-style' ), '20121010' );
			wp_enqueue_style( 'simplelineicons', get_template_directory_uri() . '/css/lineicons/simple-line-icons.css', array( 'pulsar-style' ), '20121010' );
			
			//Responsive css - load this last
			wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css', array( 'pulsar-style' ), '20121010' );
									
			//Load ie9 specific css - use this to fix ie 9 issues
			/*wp_enqueue_style( 'ie-nine-css', get_stylesheet_directory_uri() . '/css/ie9.css', array( 'pulsar-style' ), '20121010' );
			$wp_styles->add_data( 'ie-nine-css', 'conditional', 'IE 9' );*/
			
			/****** JAVASCRIPT LOCALIZATION ********/
			
			//Redux options
			global $luxor_options;
			
			//Define a JS file to store variables
			$js_file = get_template_directory_uri() . '/js/wordpress.js'; 
			
			//Get Pulse slider settings for JS
			$enableSlideShow = get_theme_mod('enableSlideShow', 'true');
			$slideLoop = get_theme_mod('slideLoop', 'true');
			$enableControlNav = get_theme_mod('enableControlNav', 'true');
			$pauseOnHover = get_theme_mod('pauseOnHover', 'true');
			$showArrows = get_theme_mod('showArrows', 'true');
			$animationType = get_theme_mod('animationType', 'slide');
			$slideShowSpeed = get_theme_mod('slideShowSpeed', 8000);
			$slideSpeed = get_theme_mod('slideSpeed', 800);
			
			//Pass primary and secondary color to js
			$primaryColor1 = get_option('primaryColor', '#ffe1a0');
			$secondaryColor1 = get_option('secondaryColor', '#7f6631');
			
			//Pass post carousel options
			$postCarouselSpeed = get_theme_mod('postCarouselSpeed', 0);
					
			//Pass Google map marker to js
			$googleMapsMarkerImage = get_theme_mod('googleMapsMarkerImage');
					
			//Form translations
			
			/** Global messages **/
			$securityError = esc_html__('Security answer invalid. Please enter the correct answer.', 'luxortheme');
			$successMessage = esc_html__('Your inquiry has been received, thank you.', 'luxortheme');
			$failedMessage = esc_html__('A system error occurred. Please try again later.', 'luxortheme');
			$ajaxSearchResult = esc_html__('No results', 'luxortheme');
			$loginMessage = esc_html__('Validating credentials, please wait...', 'luxortheme');
			$loginMessageSuccess = esc_html__('Login successful, refreshing page...', 'luxortheme');
			$loginMessageInvalid = esc_html__('Invalid credentials, try again.', 'luxortheme');
			$loginMessageUsername = esc_html__('Please enter your username.', 'luxortheme');
			$loginMessagePassword = esc_html__('Please enter your password.', 'luxortheme');
			$consentError = esc_attr__('Please agree to give consent before submitting your personal information.', 'luxortheme');
			
			/** Contact form **/
			$contactForm1 = esc_html__('Please provide your first name.', 'luxortheme');
			$contactForm2 = esc_html__('Please provide your last name.', 'luxortheme');
			$contactForm3 = esc_html__('Please provide a valid email address.', 'luxortheme');
			$contactForm4 = esc_html__('Please provide a message for your inquiry.', 'luxortheme');
			
			/** Registration form **/
			$reg1 = esc_html__('Please enter your first name.', 'luxortheme');
			$reg2 = esc_html__('Please enter your last name.', 'luxortheme');
			$reg3 = esc_html__('Please enter a valid email address.', 'luxortheme');
			$reg4 = esc_html__('Please enter a password for your account.', 'luxortheme');
			$reg5 = esc_html__('Passwords do not match - please confirm your password.', 'luxortheme');
			$reg6 = esc_html__('Registration successful. You may now proceed to login.', 'luxortheme');
			$reg7 = esc_html__('Registration failed...try again later.', 'luxortheme');
			$reg8 = esc_html__('Please enter a username for your account.', 'luxortheme');
			
			/** Quick contact **/
			$quickContact1 = esc_html__('Please provide your full name.', 'luxortheme');
			$quickContact2 = esc_html__('Please provide a valid email address.', 'luxortheme');
			$quickContact3 = esc_html__('Please provide a message for your inquiry.', 'luxortheme');
			
			/** Search form **/
			$searchFormMessage = esc_html__('Please select a property type and sale type to conduct a search', 'luxortheme');
			
			/*** Members area ***/
			$membersAreaSlug = get_option('pm_members_area_template_slug');
			
			/*** Global options ***/
			$currencySymbol = get_theme_mod('currencySymbol', '$');
			
			/*** Header options ***/
			$desktopStickyNav = get_theme_mod('desktopStickyNav', 'on');
			
			//Javascript Object	
			$wordpressOptionsArray = array( 
				'urlRoot' => home_url('/'),
				'contentURL' => content_url(),
				'templateDir' => get_template_directory_uri(),
				'membersAreaSlug' => $membersAreaSlug,
				'securityError' => $securityError,
				'successMessage' => $successMessage,
				'failedMessage' => $failedMessage,
				'ajaxSearchResult' => $ajaxSearchResult,
				'contactForm1' => $contactForm1,
				'contactForm2' => $contactForm2,
				'contactForm3' => $contactForm3,
				'contactForm4' => $contactForm4,
				'reg1' => $reg1,
				'reg2' => $reg2,
				'reg3' => $reg3,
				'reg4' => $reg4,
				'reg5' => $reg5,
				'reg6' => $reg6,
				'reg7' => $reg7,
				'reg8' => $reg8,
				'quickContact1' => $quickContact1,
				'quickContact2' => $quickContact2,
				'quickContact3' => $quickContact3,
				'loginMessage' => $loginMessage,
				'loginMessageSuccess' => $loginMessageSuccess,
				'loginMessageInvalid' => $loginMessageInvalid,
				'loginMessageUsername' => $loginMessageUsername,
				'loginMessagePassword' => $loginMessagePassword,
				'marker' => $googleMapsMarkerImage,
				'autoPlay' => $postCarouselSpeed,
				'primaryColor' => $primaryColor1,
				'secondaryColor' => $secondaryColor1,
				'enableSlideShow' => $enableSlideShow,
				'slideLoop' => $slideLoop,
				'enableControlNav' => $enableControlNav,
				'animationType' => $animationType,
				'pauseOnHover' => $pauseOnHover,
				'showArrows' => $showArrows,
				'slideShowSpeed' => $slideShowSpeed,
				'slideSpeed' => $slideSpeed,
				'fieldValidation' => esc_attr__('Validating fields...', 'luxortheme'),
				'searchFormMessage' => $searchFormMessage,
				'viewVideoMessage' => esc_attr__('View Video', 'luxortheme'),
				'hideVideoMessage' => esc_attr__('Hide Video', 'luxortheme'),
				'viewMapMessage' => esc_attr__('View Map', 'luxortheme'),
				'hideMapMessage' => esc_attr__('Hide Map', 'luxortheme'),
				'currencySymbol' => esc_attr($currencySymbol),
				'desktopStickyNav' => $desktopStickyNav,
				'consentError' => $consentError
			);
			
			wp_enqueue_script('wordpressOptions', get_template_directory_uri() . '/js/wordpress.js');
			wp_localize_script( 'wordpressOptions', 'wordpressOptionsObject', $wordpressOptionsArray );
			
	}

}


if( !function_exists('pm_ln_register_custom_sidebars') ){

	function pm_ln_register_custom_sidebars() {
		
		if (function_exists('register_sidebar')) {
			
			//DEFAULT TEMPLATE
			register_sidebar(array(
									
									'name' => esc_html__('Default Template','luxortheme'),
									'id' => 'pm_ln_default_widget',
									'description'   => '',
									'class'         => '',
									'before_widget' => '<div id="%1$s" class="widget pm-widget %2$s"><div class="pm-widget-spacer">',
									'after_widget'  => '</div></div>',
									'before_title' => '<h6>',
									'after_title' => '</h6>',
			));
			
			//HOMEPAGE
			register_sidebar(array(
									
									'name' => esc_html__('Home Page','luxortheme'),
									'id' => 'pm_ln_home_page_widget',
									'description'   => '',
									'class'         => '',
									'before_widget' => '<div id="%1$s" class="widget pm-widget %2$s"><div class="pm-widget-spacer">',
									'after_widget'  => '</div></div>',
									'before_title' => '<h6>',
									'after_title' => '</h6>',
			));
	
			//NEWS POSTS PAGE
			register_sidebar(array(
									
									'name' => esc_html__('Blog Page','luxortheme'),
									'id' => 'pm_ln_blog_page_widget',
									'description'   => '',
									'class'         => '',
									'before_widget' => '<div id="%1$s" class="widget pm-widget %2$s"><div class="pm-widget-spacer">',
									'after_widget'  => '</div></div>',
									'before_title' => '<h6>',
									'after_title' => '</h6>',
			));
	
			
					
			//FOOTER
			register_sidebar(array(
									
									'name' => esc_html__('Footer Column 1','luxortheme'),
									'id' => 'pm_ln_footer_column1_widget',
									'description'   => '',
									'class'         => '',
									'before_widget' => '<div id="%1$s" class="widget %2$s">',
									'after_widget'  => '</div>',
									'before_title' => '<h6>',
									'after_title' => '</h6>',
			));
			
			register_sidebar(array(
									
									'name' => esc_html__('Footer Column 2','luxortheme'),
									'id' => 'pm_ln_footer_column2_widget',
									'description'   => '',
									'class'         => '',
									'before_widget' => '<div id="%1$s" class="widget %2$s">',
									'after_widget'  => '</div>',
									'before_title' => '<h6>',
									'after_title' => '</h6>',
			));
			
			register_sidebar(array(
									
									'name' => esc_html__('Footer Column 3','luxortheme'),
									'id' => 'pm_ln_footer_column3_widget',
									'description'   => '',
									'class'         => '',
									'before_widget' => '<div id="%1$s" class="widget %2$s">',
									'after_widget'  => '</div>',
									'before_title' => '<h6>',
									'after_title' => '</h6>',
			));
			
			register_sidebar(array(
									'name' => esc_html__('Footer Column 4','luxortheme'),
									'id' => 'pm_ln_footer_column4_widget',
									'description'   => '',
									'class'         => '',
									'before_widget' => '<div id="%1$s" class="widget %2$s">',
									'after_widget'  => '</div>',
									'before_title' => '<h6>',
									'after_title' => '</h6>',
			));
			
			register_sidebar(array(
									
									'name' => esc_html__('Properties Template','luxortheme'),
									'id' => 'pm_ln_properties_template',
									'description'   => '',
									'class'         => '',
									'before_widget' => '<div id="%1$s" class="widget %2$s">',
									'after_widget'  => '</div>',
									'before_title' => '<h6>',
									'after_title' => '</h6>',
			));
			
			register_sidebar(array(
								
								'name' => esc_attr__('Woocommerce',"luxortheme"),
								'id' => 'woocommerce_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget %2$s">',
								'after_widget'  => '</div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
			));
			
			
		}//end of if function_exists
		
	}//end of pm_ln_register_custom_sidebars

}


if( !function_exists('pm_ln_localization_setup') ){

	//localization support - Remember to define WPLANG in wp-config.php file -> define('WPLANG', 'ja');
	function pm_ln_localization_setup() {
		// Retrieve the directory for the localization files
		$lang_dir = get_template_directory() . '/languages';
		// Set the theme's text domain using the unique identifier from above
		load_theme_textdomain('luxortheme', $lang_dir);
	} // end custom_theme_setup

}



if( !function_exists('pm_ln_kriesi_pagination') ){

	//Custom Pagination - http://www.kriesi.at/archives/how-to-build-a-wordpress-post-pagination-without-plugin
	function pm_ln_kriesi_pagination($style = '', $pages = '', $range = 2){
		
		 $showitems = ($range * 2)+1;
	
		 global $paged;
		 if(empty($paged)) $paged = 1;
	
		 if($pages == '')
		 {
			 global $wp_query;
			 $pages = $wp_query->max_num_pages;
			 if(!$pages)
			 {
				 $pages = 1;
			 }
		 }
	
		 if(1 != $pages){
			 
			 //echo '<div class="pm-pagination-page-counter"><p>Page '. $paged .' of '. $pages .'</p></div>';
			 
			 echo "<ul class='pm-pagination ".$style." clearfix reset-pulse-sizing'>";
			 
			 if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a class='button-small grey' href='".get_pagenum_link(1)."'>&laquo;</a></li>";
			 if($paged > 1 && $showitems < $pages) echo "<li><a class='button-small-theme' href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";
	
			 for ($i=1; $i <= $pages; $i++)
			 {
				 if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				 {
					 echo ($paged == $i)? "<li class='current'><span class='current'>".$i."</span></li>":"<li class='inactive'><a class='inactive' href='".get_pagenum_link($i)."' >".$i."</a></li>";
				 }
			 }
	
			 if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";
			 if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
					
			 
			 echo "</ul>\n";
			 
		 }
		 
		  $args = array(
				'before'           => '<li>' . esc_html__('Pages:', 'luxortheme'),
				'after'            => '</li>',
				'link_before'      => '',
				'link_after'       => '',
				'next_or_number'   => 'number',
				'nextpagelink'     => esc_html__('Next page', 'luxortheme'),
				'previouspagelink' => esc_html__('Previous page', 'luxortheme'),
				'pagelink'         => '%',
				'echo'             => 1
			);
			
		 
		 
	}

}


if( !function_exists('pm_ln_register_required_plugins') ){

	function pm_ln_register_required_plugins() {
		
		/*
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(
	
			// This is an example of how to include a plugin bundled with a theme.
			array(
				'name'               => 'Visual Composer', // The plugin name.
				'slug'               => 'visual-composer', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/codecanyon-242431-visual-composer-page-builder-for-wordpress-wordpress-plugin.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
	
			array(
				'name'               => 'Customizer Export/Import', // The plugin name.
				'slug'               => 'customizer-export-import', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/customizer-export-import.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
			
			array(
				'name'               => 'Premium Presentations', // The plugin name.
				'slug'               => 'premium-presentations', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/premium-presentations.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
			
			array(
				'name'               => 'Luxor Shortcode Pack', // The plugin name.
				'slug'               => 'luxor-shortcode-pack', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/shortcode_pack/shortcodes.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
			
			array(
				'name'               => 'Luxor Agency Listings', // The plugin name.
				'slug'               => 'luxor-agency-listings', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/custom_post_types/agencies.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
			
			array(
				'name'               => 'Luxor Agent Profiles', // The plugin name.
				'slug'               => 'luxor-agent-profiles', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/custom_post_types/agents.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
			
			array(
				'name'               => 'Luxor Property Listings', // The plugin name.
				'slug'               => 'luxor-property-listings', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/custom_post_types/premium-properties.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
			
			array(
				'name'               => 'Luxor Members Area', // The plugin name.
				'slug'               => 'luxor-members-area', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/custom_post_types/members-area.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
	
		);
	
		/*
		 * Array of configuration settings. Amend each line as needed.
		 *
		 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
		 * strings available, please help us make TGMPA even better by giving us access to these translations or by
		 * sending in a pull-request with .po file(s) with the translations.
		 *
		 * Only uncomment the strings in the config array if you want to customize the strings.
		 */
		$config = array(
			'id'           => 'luxortheme',                 // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'parent_slug'  => 'themes.php',            // Parent menu slug.
			'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
	
			/*
			'strings'      => array(
				'page_title'                      => __( 'Install Required Plugins', 'luxortheme' ),
				'menu_title'                      => __( 'Install Plugins', 'luxortheme' ),
				/* translators: %s: plugin name. * /
				'installing'                      => __( 'Installing Plugin: %s', 'luxortheme' ),
				/* translators: %s: plugin name. * /
				'updating'                        => __( 'Updating Plugin: %s', 'luxortheme' ),
				'oops'                            => __( 'Something went wrong with the plugin API.', 'luxortheme' ),
				'notice_can_install_required'     => _n_noop(
					/* translators: 1: plugin name(s). * /
					'This theme requires the following plugin: %1$s.',
					'This theme requires the following plugins: %1$s.',
					'luxortheme'
				),
				'notice_can_install_recommended'  => _n_noop(
					/* translators: 1: plugin name(s). * /
					'This theme recommends the following plugin: %1$s.',
					'This theme recommends the following plugins: %1$s.',
					'luxortheme'
				),
				'notice_ask_to_update'            => _n_noop(
					/* translators: 1: plugin name(s). * /
					'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
					'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
					'luxortheme'
				),
				'notice_ask_to_update_maybe'      => _n_noop(
					/* translators: 1: plugin name(s). * /
					'There is an update available for: %1$s.',
					'There are updates available for the following plugins: %1$s.',
					'luxortheme'
				),
				'notice_can_activate_required'    => _n_noop(
					/* translators: 1: plugin name(s). * /
					'The following required plugin is currently inactive: %1$s.',
					'The following required plugins are currently inactive: %1$s.',
					'luxortheme'
				),
				'notice_can_activate_recommended' => _n_noop(
					/* translators: 1: plugin name(s). * /
					'The following recommended plugin is currently inactive: %1$s.',
					'The following recommended plugins are currently inactive: %1$s.',
					'luxortheme'
				),
				'install_link'                    => _n_noop(
					'Begin installing plugin',
					'Begin installing plugins',
					'luxortheme'
				),
				'update_link' 					  => _n_noop(
					'Begin updating plugin',
					'Begin updating plugins',
					'luxortheme'
				),
				'activate_link'                   => _n_noop(
					'Begin activating plugin',
					'Begin activating plugins',
					'luxortheme'
				),
				'return'                          => __( 'Return to Required Plugins Installer', 'luxortheme' ),
				'plugin_activated'                => __( 'Plugin activated successfully.', 'luxortheme' ),
				'activated_successfully'          => __( 'The following plugin was activated successfully:', 'luxortheme' ),
				/* translators: 1: plugin name. * /
				'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'luxortheme' ),
				/* translators: 1: plugin name. * /
				'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'luxortheme' ),
				/* translators: 1: dashboard link. * /
				'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'luxortheme' ),
				'dismiss'                         => __( 'Dismiss this notice', 'luxortheme' ),
				'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'luxortheme' ),
				'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'luxortheme' ),
	
				'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
			),
			*/
		);
	
		tgmpa( $plugins, $config );
	}

}



if( !function_exists('pm_ln_customizer_css') ){

	/*** Theme Customizer CSS ****/
	function pm_ln_customizer_css(){
	?>
			<style type="text/css">
			<?php
			
				//Global Options & Colors
				$pageBackgroundImage = get_theme_mod('pageBackgroundImage');
				$repeatBackground = get_theme_mod('repeatBackground', 'repeat');
				$pageBackgroundColor = get_option('pageBackgroundColor', '#FFFFFF');
				$primaryColor = get_option('primaryColor', '#ffe1a0');
				$primaryColors = pm_ln_hex2rgb($primaryColor); //Array of colors R,G,B
				$secondaryColor = get_option('secondaryColor', '#7f6631');
				$secondaryColors = pm_ln_hex2rgb($secondaryColor); //Array of colors R,G,B
				
				$pageTitleBackgroundColor = get_option('pageTitleBackgroundColor', '#000000');
				$pageTitleBackgroundColors = pm_ln_hex2rgb($pageTitleBackgroundColor); //Array of colors R,G,B
				
				$dividerColor = get_option('dividerColor', '#8e8e8e');
				$tooltipColor = get_option('tooltipColor', '#ffe1a0');
				$blockQuoteColor = get_option('blockQuoteColor', '#ffe1a0');
				$commentBoxColor = get_option('commentBoxColor', '#f6f6f6');
				$commentShareBoxColor = get_option('commentShareBoxColor', '#adadad');
				$globalButtonBorderColor = get_option('globalButtonBorderColor', '#d9d9d9');
				$globalButtonBackgroundColor = get_option('globalButtonBackgroundColor', '#FFFFFF');
				$ulListIcon = get_theme_mod('ulListIcon', 'f105');
				$ulListIconColor = get_option('ulListIconColor', '#ffe1a0');
				$boxedModeContainerColor = get_option('boxedModeContainerColor', '#ffffff');
						
				//Header Options & Colors
				$mainNavBackgroundColor = get_option('mainNavBackgroundColor', '#000000');
				$mainNavBackgroundColors = pm_ln_hex2rgb($mainNavBackgroundColor);	
				$menuBorderColor = get_option('menuBorderColor', '#353535');
				$subpageHeaderBackgroundColor = get_option('subpageHeaderBackgroundColor', '#3f3f3f');
				
				$getHeaderBgOpacity = get_theme_mod('headerBgOpacity', 80);
				$headerBgOpacity = $getHeaderBgOpacity / 100;
				
				$getMainNavBgOpacity = get_theme_mod('mainNavBgOpacity', 90);
				$mainNavBgOpacity = $getMainNavBgOpacity / 100;
				$headerPadding = get_theme_mod('headerPadding', 25);
				$subHeaderHeight = get_theme_mod('subHeaderHeight', 225);
				
				echo '
				
					.pm-sub-header-container {
						background-color:'. $subpageHeaderBackgroundColor .';	
					}
				
					.pm-staff-profile-contact-list.author-profile > li > i {
						color:'. $secondaryColor .';	
					}
				
					.pm-members-pagination li a.active {
						background-color:'. $secondaryColor .';	
						color:white;	
					}
					
					.pm-members-pagination-page-counter {
						border-top: 1px solid '.$dividerColor.';
					}
									
					.woocommerce .widget_price_filter .ui-slider .ui-slider-handle {
						background-color:'. $secondaryColor .';	
					}
					
					.woocommerce .widget_price_filter .ui-slider .ui-slider-range {
						background-color:'. $primaryColor .';		
					}
				
					.woocommerce table.shop_table tbody th, .woocommerce table.shop_table tfoot td, .woocommerce table.shop_table tfoot th {
						border-top: 1px solid '.$dividerColor.' !important;	
					}
				
					.woocommerce .widget_shopping_cart .total, .woocommerce.widget_shopping_cart .total {
						border-top: 1px solid '.$dividerColor.';
					}
					
					.woocommerce .woocommerce-ordering select {
						border: 1px solid '.$dividerColor.';
					}
					
					.woocommerce #reviews #comment {
						border:1px solid '.$dividerColor.';
					}
					
					.input-text.qty.text {
						border:1px solid '.$dividerColor.';	
					}
					
					.woocommerce #reviews #comments ol.commentlist li .comment-text {
						border: 1px solid '.$dividerColor.';	
					}
					
					.woocommerce div.product form.cart .variations select {
						border:1px solid '.$dividerColor.';	
					}
					
					.woocommerce table.shop_table {
						border:1px solid '.$dividerColor.';	
					}
					
					.woocommerce table.shop_table td {
						border-top:1px solid '.$dividerColor.';	
					}
					
					.woocommerce form .form-row input.input-text, .woocommerce form .form-row textarea {
						border:1px solid '.$dividerColor.';	
					}
					
					#add_payment_method table.cart td.actions .coupon .input-text, .woocommerce-cart table.cart td.actions .coupon .input-text, .woocommerce-checkout table.cart td.actions .coupon .input-text {
					}
					
					.woocommerce form .form-row select {
						border:1px solid '.$dividerColor.';
					}	
					
					.woocommerce span.onsale {
						background-color:'. $secondaryColor .';
					}
					
					.woocommerce ul.products li.product .price {
						color:'. $secondaryColor .';
					}
					
					.woocommerce div.product .woocommerce-tabs ul.tabs li.active > a {
						background-color: '. $secondaryColor .' !important;	
					}
					
					.woocommerce .star-rating span {
						color:'. $secondaryColor .';	
					}
					
					.woocommerce p.stars a {
						color:'. $secondaryColor .';	
					}
					
					.woocommerce-review-link {
						color:'. $secondaryColor .' !important;	
					}
					
					.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover {
						background-color:'. $secondaryColor .';
						color:white;	
					}
					
					.woocommerce-info::before {
						color: '. $secondaryColor .';
					}
					
					.woocommerce-error::before {
						color: '. $secondaryColor .';
					}
	
					.woocommerce form .form-row.woocommerce-invalid .select2-container, .woocommerce form .form-row.woocommerce-invalid input.input-text, .woocommerce form .form-row.woocommerce-invalid select {
						border-color: '. $secondaryColor .';
					}
					
					.woocommerce form .form-row.woocommerce-invalid label {
						color: '. $secondaryColor .';	
					}
					
					.woocommerce form .form-row .required {
						color:'. $secondaryColor .';
					}
					
					.woocommerce a.remove {
						background-color: '. $secondaryColor .';
						color: white !important;
					}
					
					.woocommerce-error, .woocommerce-info, .woocommerce-message {
						border-top:3px solid '. $secondaryColor .';
					}
					
					.woocommerce-message::before {
						color:'. $secondaryColor .';
					}
					
					.woocommerce ul.products li.product .price {
						color:'. $secondaryColor .';
					}
					
					.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover {
						background-color: '. $secondaryColor .';
						color: #fff;
					}
					
					.product_meta > span > a:hover {
						color: '. $secondaryColor .';
					}
					
					.woocommerce div.product form.cart .reset_variations:hover {
						background-color: '. $secondaryColor .';
					}
					
					.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover {
						background-color: '. $secondaryColor .' !important;	
						color:white !important;
					}
					
					.woocommerce form .form-row.woocommerce-validated .select2-container, .woocommerce form .form-row.woocommerce-validated input.input-text, .woocommerce form .form-row.woocommerce-validated select {
						border-color:'. $secondaryColor .';
					}				
					
					.page-numbers.current, a.page-numbers:hover {
						background-color: '.$secondaryColor.' !important;
						color:white !important;		
					}
					
					
					.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt {
						background-color: '.$secondaryColor.';
					}
					
					.product_meta > span > a {
						color: '.$secondaryColor.';
					}
					
					
					.woocommerce #reviews #comment:focus {
						background-color:'.$primaryColor.';
					}
					
					.woocommerce div.product form.cart .reset_variations {
						background-color: '.$primaryColor.';
					}
					
					.woocommerce #respond input#submit.alt.disabled, .woocommerce #respond input#submit.alt.disabled:hover, .woocommerce #respond input#submit.alt:disabled, .woocommerce #respond input#submit.alt:disabled:hover, .woocommerce #respond input#submit.alt[disabled]:disabled, .woocommerce #respond input#submit.alt[disabled]:disabled:hover, .woocommerce a.button.alt.disabled, .woocommerce a.button.alt.disabled:hover, .woocommerce a.button.alt:disabled, .woocommerce a.button.alt:disabled:hover, .woocommerce a.button.alt[disabled]:disabled, .woocommerce a.button.alt[disabled]:disabled:hover, .woocommerce button.button.alt.disabled, .woocommerce button.button.alt.disabled:hover, .woocommerce button.button.alt:disabled, .woocommerce button.button.alt:disabled:hover, .woocommerce button.button.alt[disabled]:disabled, .woocommerce button.button.alt[disabled]:disabled:hover, .woocommerce input.button.alt.disabled, .woocommerce input.button.alt.disabled:hover, .woocommerce input.button.alt:disabled, .woocommerce input.button.alt:disabled:hover, .woocommerce input.button.alt[disabled]:disabled, .woocommerce input.button.alt[disabled]:disabled:hover {
						background-color:'.$secondaryColor.';
					}
					
					.woocommerce a.remove:hover {
						background-color: '.$primaryColor.';
					}
					
					.woocommerce form .form-row input.input-text:focus, .woocommerce form .form-row textarea:focus {
						border:1px solid '.$primaryColor.';	
						background-color:'.$primaryColor.';
					}
					
					.woocommerce div.product p.price, .woocommerce div.product span.price {
						color:'. $primaryColor .';	
					}	
				
					.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button {
						background-color: '.$secondaryColor.';	
						color:white !important;
					}
					
					.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover {
						background-color:'. $primaryColor .' !important;	
						color:black !important;
					}
				
					.woocommerce .woocommerce-breadcrumb a:hover, .breadcrumbs li a:hover {
						color: '. $secondaryColor .';
						text-decoration:none !important;
					}
					
				
				
					header {
						padding:'.$headerPadding.'px 50px;	
						background-color: rgba('.$mainNavBackgroundColors[0].', '.$mainNavBackgroundColors[1].', 0'.$mainNavBackgroundColors[2].', '.$headerBgOpacity.');
						border-bottom: 1px solid '.$primaryColor.';
					}
					
					.pm-staff-profile-name:hover, .pm-staff-profile-name:hover a {
						color:'.$primaryColor.';	
					}
					
					.pm-newsletter-form-container input[type="text"] {
						border:1px solid '.$secondaryColor.' !important;		
					}
					
					.pm-newsletter-form-container input[type="text"]:focus {
						border:1px solid '.$primaryColor.' !important;	
						background-color:'.$primaryColor.';	
						color:black;
					}
					
					.pm-video-activator-btn {
						border:3px solid '.$secondaryColor.';	
					}
					
					.pm-video-activator-btn:hover {
						background-color:'.$secondaryColor.';	
					}
					
					.pm_quick_contact_field.Dark.invalid_field {
						background-color:'.$secondaryColor.' !important;	
						border:0px solid black !important;
					}
					
					.pm-header-business-info-list li a:hover {
						color:'.$primaryColor.';	
					}
					
					.pm-header-business-info-list li a:before {
						color:'.$primaryColor.';	
					}
					
					.pm-form-textfield.security-field.property-post {
						border:1px solid '.$primaryColor.';	
						font-size:16px;
					}
					
					.pm-footer-copyright a {
						color:'.$primaryColor.' !important;	
					}
					
					.pm-footer-copyright a:hover {
						color:'.$secondaryColor.' !important;	
					}
					
					.pm-form-textfield.security-field {
						border:1px solid '.$menuBorderColor.';
					}
					
					.form-group.security-question {
						border-bottom:1px solid '.$menuBorderColor.';	
					}
					
					.pm-widget-footer .pm-recent-blog-post-details a {
						color:'.$primaryColor.' !important;	
					}
					
					.pm-widget-footer .pm-recent-blog-post-details a:hover {
						color:white !important;		
					}
					
					.pm-page-title:before, .pm-page-message:before, .pm-page-title.post:before {
						background-color: rgba('.$pageTitleBackgroundColors[0].', '.$pageTitleBackgroundColors[1].', 0'.$pageTitleBackgroundColors[2].', .8);
					}
					
					.pm-nav-container-icons.float-menu {
						background-color: rgba('.$mainNavBackgroundColors[0].', '.$mainNavBackgroundColors[1].', 0'.$mainNavBackgroundColors[2].', '.$headerBgOpacity.');	
					}
					
					.pm-footer-stats li:after {
						color:'.$primaryColor.';	
					}
					
					.comment-form-comment textarea:focus {
						background-color:'.$primaryColor.';
						color:black !important;		
					}
					
					.pm-news-post-title i {
						color:'.$secondaryColor.' !important;		
					}
									
					.pm-news-post-btn {
						border-left: 1px solid '.$primaryColor.';
					}
					
					.pm-news-post-btn {
						color:'.$secondaryColor.';		
					}
					
					.pm-news-post-btn:hover {
						color:'.$primaryColor.';		
					}
					
					.pm-news-post-date i {
						color:'.$secondaryColor.';	
					}
					
					.pm-pricing-table-container ul {
						border-left: 1px solid '.$dividerColor.';
						border-right: 1px solid '.$dividerColor.';
					}
					
					.pm-pricing-table-container ul li {
						border-bottom: 1px solid '.$dividerColor.';
					}
					
					.pm-property-listing-title:hover {
						color:'.$secondaryColor.';	
					}
					
					.pm-property-status-list li {
						background-color:'.$primaryColor.';	
						color:black;
					}
					
					.pm-property-contact-agent-btn {
						background-color:'.$secondaryColor.';		
					}
					
					.pm-property-contact-agent-btn:hover {
						background-color:'.$primaryColor.';		
						color:black;
					}
					
					.pm-property-post-video-btn, .pm-property-post-map-btn {
						background-color:'.$primaryColor.';	
					}
					
					.pm-property-post-video-btn:hover, .pm-property-post-map-btn:hover {
						background-color:'.$secondaryColor.';
						color:white !important;
					}
					
					.pm-property-post-video-btn.active, .pm-property-post-map-btn.active {
						background-color:'.$secondaryColor.';
						color:white !important;
					}
					
					.pm-property-listing-excerpt a {
						color: '.$secondaryColor.';
					}
					
					.pm-agent-form-response {
						color: '.$primaryColor.' !important;
					}
					
					.pm-author-bio-container .url a:hover {
						color: '.$primaryColor.' !important;
					}
					
					.result-message, #pm-quick-message {
						color: '.$primaryColor.' !important;
					}
					
					.pm-login-field.invalid_field {
						background-color: '.$primaryColor.';	
					}
					
					.pm-login-field:focus {
						background-color: '.$primaryColor.';
						color:black !important;
					}
					
					.pm-icon-btn {
						background-color: '.$secondaryColor.';	
					}
					
					.pm-icon-btn:hover {
						background-color: '.$primaryColor.';	
					}
					
					.pm-single-testimonial-img-bg {
						border: 5px solid '.$secondaryColor.';	
					}
					
					.pm-single-testimonial-avatar-icon {
						border: 3px solid '.$primaryColor.';
					}
					
					.pm-single-testimonial-shortcode .name, .pm-single-testimonial-shortcode .title, .pm-single-testimonial-shortcode .date {
						color: '.$secondaryColor.';	
					}
					
					.pm-pricing-table-featured {
						border-top: 80px solid '.$primaryColor.';
					}
					
					.pm-nav-tabs > li > a {
						background-color: '.$secondaryColor.';
						color: white !important;	
					}
					
					.pm-nav-tabs > li > a:hover {
						background-color: '.$primaryColor.';
						color: black !important;	
					}
					
					.pm-nav-tabs > li.active > a, .pm-nav-tabs > li.active > a:hover, .pm-nav-tabs > li.active > a:focus {
						background-color: '.$primaryColor.';
						color: black !important;	
					}
					
					.pm-icon-bundle {
						background-color: '.$secondaryColor.';
						border-color:'.$dividerColor.';	
					}
					
					.pm-icon-bundle:hover {
						background-color: '.$primaryColor.';
						color:black;	
					}
					
					.pm-mobile-global-sign-in-fields p a, .pm-mobile-global-registration-fields p a {
						color:'.$primaryColor.' !important;	
					}
					
					.pm-mobile-global-sign-in-fields p a:hover, .pm-mobile-global-registration-fields p a:hover {
						color:white !important;	
					}
					
					blockquote:before {
						color:'.$blockQuoteColor.' !important;	
					}
					
					.excerpt a {
						color:'.$secondaryColor.' !important;	
					}
					
					.excerpt a:hover {
						color:inherit !important;	
					}
					
					.pm-news-post-img-container {
						border-bottom:4px solid '.$primaryColor.';	
					}
					
					.pm-tweet-list ul li:before {
						color:'.$primaryColor.';
					}
					
					.pm-dropdown.pm-language-selector-menu .pm-dropmenu-active ul li {
						background-color:'.$primaryColor.';
					}
					
					.pm-dropdown.pm-language-selector-menu .pm-dropmenu-active ul li:hover {
						background-color:'.$secondaryColor.';	
					}
					
					.pm-contact-google-text-overlay a {
						background-color:'.$secondaryColor.';
					}
					
					.pm-contact-google-text-overlay a:hover {
						background-color:'.$primaryColor.';
						color:white;	
					}
					
					.panel-title i {
						background-color: '.$secondaryColor.';
					}
					
					.pm-search-field-mobile {
						color:'.$primaryColor.' !important;	
					}
					
					.pm-agencies-list-email a, .pm-agencies-list-address a {
						color:'.$secondaryColor.';
					}
					
					.pm-column-title-divider-simple {
						border-top: 1px solid '.$dividerColor.';	
					}
					
					.pm-column-title-divider-simple-end-point {
						background-color:'.$secondaryColor.';	
					}
					
					.pm-column-title-divider-simple-end-point.primary {
						background-color:'.$primaryColor.';	
					}
					
					.pm-agencies-list-details .name {
						color:'.$secondaryColor.';	
					}
					
					.pm-footer-contact-list li a:hover {
						color:'.$secondaryColor.';
					}
					
					.pm-progress-bar-diamond {
						background-color: '.$primaryColor.';
						border: 3px solid '.$secondaryColor.';	
					}
					
					.pm-our-process-list li i {
						color:'.$primaryColor.';
					}
					
					.pm-progress-bar .pm-progress-bar-outer {
						background-color: '.$primaryColor.';
						border: 1px solid '.$dividerColor.';	
					}
					
					.pm-line-icon {
						color:'.$primaryColor.';	
					}
					
					.pm-our-process-divider-diamond {
						background-color: '.$primaryColor.';	
					}
					
					.pm-interactive-title-divider-endpoint.left, .pm-interactive-title-divider-endpoint.right {
						background-color: '.$secondaryColor.';
					}
					
					.pm-interactive-title-icon-container-hover {
						background-color: '.$secondaryColor.';	
					}
					
					.pm-interactive-title-icon-container i {
						color: '.$secondaryColor.';	
					}
					
					a.pm-secondary {
						color:'.$secondaryColor.' !important;	
					}
													
					a.pm-secondary:hover {
						color:'.$primaryColor.' !important;	
					}
					
					.pm-square-btn.filter {
						background-color: '.$primaryColor.';	
					}
					
					.pm-dropdown.pm-property-filter-system .pm-dropmenu .pm-menu-title {
						color:'.$primaryColor.' !important;	
					}
					
					.pm-dropdown.widget.pm-property-filter-system .pm-dropmenu .pm-menu-title {
						color:'.$secondaryColor.' !important;	
					}
					
					.ui-widget-header {
						background-color: '.$primaryColor.';	
					}
					
					.pm-top-agents-details .name {
						color:'.$secondaryColor.';
					}
					
					.pm-top-agents-details-btn {
						color:'.$secondaryColor.' !important;	
					}
					
					.pm-top-agents-avatar {
						border: 1px solid '.$dividerColor.';	
					}
					
					.pm-top-agents-border {
						background-color: '.$dividerColor.';	
					}
					
					.pm-dropdown.pm-agencies-filter-options .pm-dropmenu .pm-menu-title {
						color:'.$secondaryColor.' !important;	
					}
					
					.pm-dropdown.pm-agencies-filter-options .pm-dropmenu i {
						color:'.$secondaryColor.' !important;	
					}
					
					.pm-dropdown.pm-agencies-filter-options {
						border-bottom: 1px solid '.$secondaryColor.' !important;	
					}
					
					.pm-agencies-posts-list li {
						border-bottom: 1px solid '.$dividerColor.';	
					}
					
					.pm-agencies-list-title a {
						color:'.$secondaryColor.' !important;	
					}
					
					.pm-agencies-list-phone:before, .pm-agencies-list-email:before, .pm-agencies-list-address:before {
						color:'.$secondaryColor.';
					}
					
					.pm-form-textfield {
						color:'.$secondaryColor.';	
					}
					
					.pm-form-textarea {
						color:'.$secondaryColor.';
					}	
					
					.pm-sub-header-info {
						border-bottom: 4px solid '.$primaryColor.';
					}
					
					.pm-breadcrumbs li:first-child a {
						color:'.$primaryColor.';	
					}
					
					.pm-breadcrumbs li:after {
						color:'.$primaryColor.';
					}
					
					.pm-featured-properties-list-thumb {
						border: 1px solid '.$primaryColor.';	
					}
					
					.pm-agencies-visual-layout-btn.active {
						color:'.$primaryColor.';
					}
					
					.pm-featured-properties-list-thumb a {
						background-color:'.$primaryColor.';	
					}
					
					.pm-featured-properties-list-thumb a:hover {
						background-color:'.$secondaryColor.';	
					}
					
					.pm-staff-profile-name {
						color:'.$secondaryColor.';		
					}
					
					.pm-featured-properties-details a {
						color:'.$secondaryColor.' !important;	
					}
					
					.pm-widget-footer .pm-featured-properties-details a {
						color:'.$primaryColor.' !important;	
					}
					
					.pm-widget-footer .pm-featured-properties-details .price, .pm-widget-footer .pm-featured-properties-details .footage {
						color:white;	
					}
					
					.pm-featured-properties-details a {
						color:'.$secondaryColor.' !important;	
					}
					
					.pm-featured-properties-details a:hover {
						color:'.$primaryColor.' !important;	
					}
					
					.pm-visual-layout-btn.active, .pm-agencies-visual-layout-btn.active {
						color:'.$primaryColor.';
					}
					
					.pm-dropdown.pm-property-filter-options .pm-dropmenu .pm-menu-title {
						color:'.$secondaryColor.' !important;	
					}
					
					.pm-dropdown.pm-property-filter-options {
						border-bottom: 1px solid '.$secondaryColor.' !important;			
					}
					
					.pm-dropdown.pm-property-filter-options .pm-dropmenu i {
						color:'.$secondaryColor.' !important;		
					}
					
					.pm-post-loaded-info li:first-child span, .pm-post-loaded-info li:first-child strong {
						color:'.$secondaryColor.';	
					}
		
					.pm-property-listing-ribbon {
						background-color: '.$primaryColor.';
					}
					
					.pm-property-listings-btn {
						border-color: transparent '.$primaryColor.' '.$primaryColor.' transparent;	
					}
					
					.pm-property-listings-btn:hover {
						border-color: transparent '.$secondaryColor.' '.$secondaryColor.' transparent;	
					}
					
					.pm-property-listings-img-container {
						border: 1px solid '.$primaryColor.';	
					}
					
					.pm-property-listing-divider {
						background-color: '.$primaryColor.';	
					}
					
					
					.pm-post-loaded-info li a {
						color:'.$secondaryColor.' !important;	
					}
					
					.pm-post-loaded-info li a:hover {
						color:'.$primaryColor.' !important;	
					}
					
					.pm-staff-profile-img-container-info p span {
						color: '.$primaryColor.';
					}
					
					.pm-staff-profile-img-container-info a {
						color: '.$primaryColor.';	
					}
					
					.pm-staff-profile-img-container-info a:hover {
						color: '.$secondaryColor.';	
					}
					
					.pm-dropmenu-active ul li:hover {
						background-color:'.$primaryColor.';
					}
					
					.pm-staff-profile-social-list li a {
						border: 2px solid '.$secondaryColor.';	
						color:'.$secondaryColor.';	
					}
					
					.pm-staff-profile-social-list li a:hover {
						background-color:'.$secondaryColor.';
					}
					
					.pm-title-divider {
						background-color: '.$dividerColor.';
					}
					
					.pm-staff-profile-img-border {
						 background-color: '.$dividerColor.';	
					}
					
					.pm-staff-profile-img-container {
						border: 1px solid '.$dividerColor.';
					}
					
					.pm-staff-profile-img-border-endpoint {
						background-color:'.$secondaryColor.';
					}
					
					.pm-staff-profile-img-container-btn {
						border: 3px solid '.$secondaryColor.';	
					}
					
					.pm-staff-profile-img-container-btn:hover {
						background-color:'.$secondaryColor.';	
					}
					
					.pm-staff-profile-img-container-btn i {
						color:'.$secondaryColor.';
					}
					
					.pm-image-gallery-lightbox-info-list li a:before {
						color: '.$primaryColor.';	
					}
					
					.pm-image-gallery-lightbox-info-list li a {
						color: '.$primaryColor.';
					}
					
					.pm-image-gallery-lightbox-info-list li a:hover {
						color: '.$secondaryColor.';
					}
					
					.pm-image-gallery-lightbox-info-container {
						border: 1px solid '.$primaryColor.';
					}
					
					.pm-image-gallery .pm-image-gallery-lightbox {
						border-right: 1px solid '.$primaryColor.';	
					}
					
					.pm-image-gallery .pm-image-gallery-close {
						background-color: '.$primaryColor.';	
					}
					
					.pm-image-gallery .pm-image-gallery-close:hover {
						background-color: '.$secondaryColor.';	
					}
					
					.pm-image-gallery-lightbox-title-container a {
						background-color: '.$primaryColor.';
					}
					
					.pm-image-gallery-lightbox-title-container a:hover {
						background-color: '.$secondaryColor.';
					}
					
					.pm-image-gallery {
						border-left: 1px solid '.$primaryColor.';
						border-top: 1px solid '.$primaryColor.';
					}
					
					.pm-image-gallery .pm-image-gallery-image {
						border-bottom: 1px solid '.$primaryColor.';
						border-right: 1px solid '.$primaryColor.';
					}
					
					
					.pm-image-gallery-item-hover-btn {
						 border-color: transparent '.$primaryColor.' '.$primaryColor.' transparent ;	
					}
					
					.pm-image-gallery-item-hover-btn:hover {
						 border-color: transparent '.$secondaryColor.' '.$secondaryColor.' transparent ;	
					}
					
					.pm-property-search-btn-border {
						border: 1px solid '.$secondaryColor.';
					}
					
					.pm-property-search-btn-endpoint {
						background-color: '.$secondaryColor.';	
					}
					
					.pm-property-search-btn {
						background-color: '.$primaryColor.';		
					}
					
					.pm-dropdown.pm-filter-system .pm-dropmenu .pm-menu-title {
						color: '.$primaryColor.';	
					}
					
					.pm-dropdown.pm-filter-system .pm-dropmenu i {
						color: '.$primaryColor.';		
					}
					
					.pm-dropdown {
						border-bottom: 1px solid '.$primaryColor.';
					}
					
					.pm-dropdown.widget {
						border-bottom: 1px solid '.$secondaryColor.' !important;
					}	
					
					.pm-property-search-system > li > .pm-property-search-text-field {
						color: '.$primaryColor.';	
						border-bottom:1px solid '.$primaryColor.';	
					}
					
					.pm-property-search-text-field.widget {
						color: '.$secondaryColor.' !important;	
						border-bottom:1px solid '.$secondaryColor.';	
					}
					
					.pm-testimonial-name {
						color: '.$primaryColor.' !important;	
					}
					
					.pm-column-title-divider-symbol {
						background-color: '.$secondaryColor.';
						border: 2px solid '.$primaryColor.';
					}
					
					.pm-border-top {
						border-top: 4px solid '.$primaryColor.';	
					}
					
					.pm-column-title-divider-end-point {
						background-color:'.$secondaryColor.';	
					}
					
					.pm-column-title-divider {
						border-top: 1px solid '.$dividerColor.';	
					}
					
					.pm-tri-btn:hover {
						background-color:'.$secondaryColor.';	
						border:2px solid '.$secondaryColor.' !important;
					}
					
					.pm-tri-btn:hover i {
						color:white !important;	
					}
					
					.pm-recent-blog-post-thumb {
						border: 1px solid '.$dividerColor.';	
					}
					
					.pm-widget-footer .pm_quick_contact_submit, .pm-widget-footer .pm_mailchimp_submit {
						background-color:'.$primaryColor.';	
					}
					
					.pm-widget-footer .pm_quick_contact_submit:hover, .pm-widget-footer .pm_mailchimp_submit:hover {
						background-color:'.$secondaryColor.';	
						color:white;
					}	
					
					.pm_quick_contact_submit, .pm_mailchimp_submit {
						background-color:'.$primaryColor.';	
					}
					
					.pm_quick_contact_submit:hover, .pm_mailchimp_submit:hover {
						background-color:'.$secondaryColor.';
						color:white;
					}
					
					.pm-form-textfield-with-icon {
						border:1px solid '.$primaryColor.';	
					}
					
					.pm-form-textfield-with-icon:focus {
						border:1px solid '.$primaryColor.';	
						background-color:'.$primaryColor.';	
						color:black;
					}
					
					.pm-comment-header span {
						color: '.$primaryColor.';	
					}
					
					.pm-single-post-category-link {
						border-right: 3px solid '.$primaryColor.';	
					}
					
					.pm-news-post-details-link {
						background-color: '.$primaryColor.';
					}
					
					.pm-news-post-details-link:hover {
						background-color: '.$secondaryColor.';
					}
									
					.pm-comment-date .fn .url {
						color: '.$primaryColor.' !important;
					}
					
					.pm-comment-date .fn .url:hover {
						color: '.$secondaryColor.' !important;
					}
					
					#cancel-comment-reply-link {
						color:'.$primaryColor.' !important;		
					}
					
					#cancel-comment-reply-link:hover {
						color:'.$secondaryColor.' !important;		
					}
					
					.pm-comment-date a:hover {
						color: '.$primaryColor.';	
					}
					
					.pm-news-post-img-container, .pm-single-post-img-container {
						border-color:'.$primaryColor.';
					}
					
					.pm-mobile-global-menu {
						background-color: rgba('.$mainNavBackgroundColors[0].', '.$mainNavBackgroundColors[1].', 0'.$mainNavBackgroundColors[2].', '.$mainNavBgOpacity.');	
					}
					
					.pm-mobile-global-menu {
						border-left: 1px solid '.$menuBorderColor.';	
					}
					
					.pm-search-field-mobile {
						border-top:1px solid '.$menuBorderColor.';		
					}
					
					.sf-menu li {
						border-top: 1px solid '.$menuBorderColor.';	
					}
					
					.sf-menu.pm-desktop-nav .sub-menu li {
						border-top: 1px solid '.$menuBorderColor.';	
					}
					
					.sf-menu.pm-desktop-nav li {
						border-left: 1px solid '.$menuBorderColor.';	
					}
					
					.sf-menu.pm-desktop-nav .sub-menu li {
						border-right: 1px solid '.$menuBorderColor.';	
					}
					
					.sf-menu.pm-desktop-nav .sub-menu li:last-child {
						border-bottom: 1px solid '.$menuBorderColor.';	
					}
					
					.sf-menu li:last-child {
						border-bottom: 1px solid '.$menuBorderColor.';	
					}
					
					.pm-desktop-nav-container {
						border-bottom: 1px solid '.$menuBorderColor.';	
						background-color: rgba('.$mainNavBackgroundColors[0].', '.$mainNavBackgroundColors[1].', 0'.$mainNavBackgroundColors[2].', '.$mainNavBgOpacity.');	
					}
					
					.pm-login-field, .pm-login-field:last-of-type {
						border-bottom:1px solid '.$menuBorderColor.';
					}
					
					.pm-mobile-global-registration-fields, .pm-register-message, .pm-mobile-global-sign-in-fields {
						border-top:1px solid '.$menuBorderColor.';
					}
					
					.pm-desktop-social-icons-list li {
						border-right:1px solid '.$menuBorderColor.';
					}
					
					.pm-desktop-social-icons-list li a {
						color:'.$primaryColor.';	
					}
					
					.pm-desktop-social-icons-list li a:hover {
						color:'.$secondaryColor.';	
					}
									
				';
				
				
				//Footer Options & Colors
				$fatFooterBackgroundColor = get_option('fatFooterBackgroundColor', '#191B27');
				$fatFooterBackgroundImage = get_theme_mod('fatFooterBackgroundImage');
				
				$fatFooterPadding = get_theme_mod('fatFooterPadding', 100);
				
				echo '
					.pm-fat-footer {
						background-color:'.$fatFooterBackgroundColor.';
						'.( $fatFooterBackgroundImage !== '' ? 'background-image:url('.$fatFooterBackgroundImage.')' : '' ).'
					}
					.pm-fat-footer {
						padding:'.$fatFooterPadding.'px 0;	
					}
				';
				
				
				
				//Global Options & Colors
				
				echo '
					body {
						background-repeat:'.$repeatBackground.';
						background-color:'.$pageBackgroundColor.';
						'. ( $pageBackgroundImage !== '' ? 'background-image:url('.$pageBackgroundImage.')' : '' ) .'	
					}
					
					a:hover {
						color:'.$primaryColor.';		
					}
					
					.pm-property-post-video-btn:after, .pm-property-post-map-btn:after {
						color:'.$primaryColor.';
					}
					
					.flexslider .flex-prev, .flexslider .flex-next {
						background-color:'.$primaryColor.';		
					}
					
					.pm-recent-blog-post-details a {
						color:'.$secondaryColor.' !important;	
					}
					
					.pm-recent-blog-post-details a:hover {
						color:'.$primaryColor.' !important;		
					}
					
					.pm-fat-footer-title span {
						color: '.$primaryColor.';	
					}
					
					.pm-widget-footer #wp-calendar tbody td {
						border: 1px solid '.$primaryColor.';	
					}
					
					.pm-widget-footer #wp-calendar tbody td:hover {
						background-color: '.$primaryColor.';	
					}
					
					.pm-widget-footer #wp-calendar tbody tr td#today {
						background-color: '.$primaryColor.';
					}
					
					.pm-fat-footer-title-divider, .pm-fat-footer-title-divider-endpoint {
						background-color: '.$primaryColor.';
					}
					
					.pm-slider div.pm-prev:hover, .pm-slider div.pm-next:hover {
						color: '.$primaryColor.';	
					}
					
					.pm-footer-navigation li a:hover {
						color: '.$secondaryColor.';	
					}
					
					.pm-caption h1 b {
						color: '.$primaryColor.' !important;
					}
					
					.pm-search-bar-btn {
						color: '.$primaryColor.';
					}
					
					.pm-search-bar-btn:hover {
						color: '.$secondaryColor.';
					}
					
					.pm-dots span.pm-currentDot {
						background-color: '.$primaryColor.';
					}
					
					.pm-dots span:hover {
						background-color: '.$primaryColor.';	
					}
					
					.sf-menu a:hover {
						color: '.$primaryColor.';	
					}
					
					.pm-nav-container-icons li a span {
						color: '.$primaryColor.';
					}
					
					.pm-search-input-field {
						color: '.$primaryColor.' !important;	
					}
					
					.pm-footer-back-to-top {
						border-bottom: 40px solid '.$primaryColor.';	
					}
					
					.pm-footer-back-to-top:hover {
						border-bottom: 40px solid '.$secondaryColor.';	
					}
					
					.pm-footer-column-divider {
						background-color: '.$dividerColor.';
					}
					
					footer {
						border-bottom: 4px solid '.$primaryColor.';
					}
					
					.pm-news-post-divider {
						background-color:'.$primaryColor.';	
					}
					
					.pm-footer-stats li span {
						color: '.$primaryColor.';
					}
					
					.pm-news-post-info-container .meta-info a, .pm-news-post-info-container .meta-like a {
						color: '.$secondaryColor.';
					}
					
					.pm-news-post-info-container .title {
						color: '.$secondaryColor.';	
					}
					
					.pm-news-post-info-container .title:hover {
						color: '.$primaryColor.';	
					}
					
					.pm-news-post-info-container .meta-info a:hover, .pm-news-post-info-container .meta-like a:hover {
						color: '.$primaryColor.';
					}
					
					.pm-nav-container-icons li a i {
						color: '.$primaryColor.';
					}
					
					.pm-nav-container-icons li a i:hover {
						color: '.$secondaryColor.';
					}
					
					.pm-footer-copyright span {
						color: '.$primaryColor.';
					}
	
					.pm-footer-contact-list li span {
						color: '.$primaryColor.';
					}
					
					.post-date {
						color:'.$secondaryColor.';		
					}
					
					.pm-sidebar .widget_pages ul li a:hover, .pm-sidebar .widget_meta ul li a:hover { 
						color:'.$secondaryColor.';	
					}
									
					.pm-sidebar .pm-widget .tagcloud a, .tag-cloud-link {
						background-color:'.$secondaryColor.';	
					}
					
					.pm-sidebar .pm-widget .tagcloud a:hover, .tag-cloud-link:hover {
						background-color:'.$primaryColor.' !important;	
					}
					
					.pm-global-menu-social-icons li a, .pm-footer-social-icons li a {
						color:'.$primaryColor.';
					}
					
					.pm-global-menu-social-icons li a:hover, .pm-footer-social-icons li a:hover {
						color:'.$secondaryColor.';
					}
					
					.pm-tweet-list ul li a {
						color:'.$primaryColor.';
					}
					.pm-boxed-mode {
						background-color:'.$boxedModeContainerColor.';
					}
					ul li:before {
						content: "\\'.$ulListIcon.'";
						color:'.$ulListIconColor.';
					}
					
					
					.widget_pages ul li:before, .widget_meta ul li:before, .widget_rss ul li:before {
						color:'.$primaryColor.' !important;		
					}
					.widget_rss ul li a {
						color:'.$primaryColor.' !important;	
					}
					.widget_rss ul li a:hover {
						color:'.$secondaryColor.' !important;	
					}
					
					.pagination_multi a li { 
						background-color:'.$primaryColor.' !important;
						color:black !important;
					}
					
					.pagination_multi a li:hover { 
						background-color:'.$secondaryColor.' !important;
						color:white !important;
					}
					
					.pagination_multi li {
						background-color: '.$secondaryColor.' !important;
						color: white !important;
					}
					
					.pm-single-post-social-icons li {
						border: 2px solid '.$secondaryColor.';	
					}
					
					.pm-single-post-social-icons li a {
						color:'.$secondaryColor.';	
					}
					
					.pm-single-post-social-icons li a:hover {
						color:'.$primaryColor.';	
					}
					
					.pm-nav-tabs {
						border-bottom: 1px solid '.$dividerColor.';	
					}
					.pm_quick_contact_field.invalid_field, .pm_quick_contact_textarea.invalid_field {
						border:1px solid '.$secondaryColor.' !important;	
					}
					
					.pm-post-navigation li a {
						color:'.$primaryColor.' !important;	
					}
									
					
					#pm_marker_tooltip_theme { 
						background-color:'.$tooltipColor.' !important;
					}
					
					#pm_marker_tooltip_theme.pm_tip_arrow_bottom { 
						background-color:'.$tooltipColor.';	
					}
					
					#pm_marker_tooltip_theme.pm_tip_arrow_top:after {
						border-top: 6px solid '.$tooltipColor.';	
					}
					
					#pm_marker_tooltip_theme.pm_tip_arrow_bottom:after {
						border-bottom: 8px solid '.$tooltipColor.';
					}
					
					.pm-widget-footer .widget_categories ul a:before, .pm-widget-footer .widget_pages ul li:before, .pm-widget-footer .widget_archive ul li:before, .pm-widget-footer .widget_recent_entries ul li span {
						color: '.$primaryColor.';
					}
					.pm-widget-footer a:hover {
						color:'.$primaryColor.' !important;	
					}
					.pm-widget-footer .tagcloud a {
						background-color:'.$secondaryColor.';	
					}
					.pm-widget-footer .tagcloud a:hover {
						background-color:'.$primaryColor.' !important;
						color:black !important;	
					}
					.pm-pagination li.current {
						background-color:'.$secondaryColor.';	
						border:3px solid '.$secondaryColor.';
						color:white;	
					}
					
					.pm-sidebar .pm-widget h6 span, .widget.woocommerce > h6 span {
						color:'.$secondaryColor.';	
					}
					
					.pm-sidebar-title-divider-symbol {
						border-top: 15px solid '.$secondaryColor.';
					}
					
					.pm-sidebar-title-divider-symbol-shadow {
						border-top: 18px solid '.$primaryColor.';	
					}
					
					.pm-sidebar-title-divider-end-point {
						background-color:'.$secondaryColor.';		
					}
					
					.pm-sidebar-title-divider {
						border-top: 1px solid '.$dividerColor.';	
					}
					
					.pm-sidebar .widget_meta ul li, .pm-widget-footer .widget_categories ul li, .pm-sidebar .widget_categories ul li, .pm-sidebar .widget_archive ul li, .pm-sidebar .widget_pages ul li, .widget_recent_entries .pm-widget-spacer ul li {
						border-bottom: 1px solid '.$dividerColor.';
					}
					
					#pm-sidebar .pm-sidebar-search-field {
						color:'.$secondaryColor.';		
					}
					
					.pm-sidebar-search-container i:hover {
						color: '.$primaryColor.';		
					}
					
					.pm-sidebar .widget_archive ul li:before, .pm-sidebar .widget_archive ul li {
						color: '.$primaryColor.';	
					}
					.pm-sidebar .widget_categories ul a:before {
						color: '.$primaryColor.';
					}
					
					.widget_recent_entries .pm-widget-spacer ul li a:hover {
						color: '.$secondaryColor.';	
					}
					
					.pm-sidebar .widget_categories ul li {
						color: '.$primaryColor.';	
					}
					.widget_nav_menu ul li:before {
						color: '.$primaryColor.';		
					}
					.pm-sidebar .widget_archive ul li a:hover, .pm-sidebar .widget_categories ul a:hover, .pm-sidebar .widget_nav_menu ul li a:hover {
						color:'.$secondaryColor.';		
					}
					
					.pm_quick_contact_field:focus, .pm_quick_contact_textarea:focus {
						background-color:'.$secondaryColor.' !important;	
						color:white;			
					}
					.pm_quick_contact_field.Light, .pm_quick_contact_textarea.Light {
						border:1px solid '.$primaryColor.';		
					}
					
					.pm-pagination li {
						border: 3px solid '.$primaryColor.';
						background-color:'.$primaryColor.';
					}
					.pm-pagination li.inactive:hover, .pm-pagination li:hover {
						background-color:'.$secondaryColor.';
						border:3px solid '.$secondaryColor.';
					}
					
					.pm-pagination li.inactive:hover a {
						color:white !important;	
					}
					
					.pm-pagination.pm-knowledge-base-pagination li.inactive:hover {
						border: 1px solid '.$secondaryColor.';		
						background-color:'.$secondaryColor.';			
					}
					
					.pm-breadcrumbs li a:hover {
						color:'.$secondaryColor.';
					}
					.pm-single-news-post-avatar-icon {
						border: 3px solid '.$primaryColor.';	
					}
					.pm-comment-form-textfield, .pm-comment-form-textarea {
						border-bottom:3px solid '.$primaryColor.';
					}
					.pm-comment-submit-btn.respond:hover {
						border: 3px solid '.$secondaryColor.';	
						background-color: '.$secondaryColor.';
					}
					.comment-reply-link:hover {
						background-color: '.$secondaryColor.';
					}
					.pm-comment-submit-btn:hover {
						background-color:'.$primaryColor.';
						border:3px solid '.$primaryColor.';
					}
					
					.pm-search-error span {
						color:'.$secondaryColor.' !important;	
					}
					
					.pm-square-btn {
						background-color:'.$primaryColor.';
					}	
					
					.pm-square-btn:hover {
						background-color:'.$secondaryColor.';	
						color:white;
					}
					
					.pm-comment-header h3 {
						color:'.$secondaryColor.' !important;		
					}
					
					
					.pm-page-share-options {
						border-top: 1px solid '.$dividerColor.';
					}
					.pm-rounded-submit-btn, #place_order, .lost_reset_password input[type="submit"], .woocommerce .form-row input[type="submit"] {
						background-color:'.$secondaryColor.';	
					}
					.pm-textfield:focus, .pm-textarea:focus {
						background-color:'.$primaryColor.';
						border-bottom:3px solid '.$primaryColor.';	
					}
					
					.pm-primary {
						color:'.$primaryColor.' !important;	
					}
					.pm-primary:hover {
						color:'.$secondaryColor.' !important;	
					}
					.pm-secondary {
						color:'.$secondaryColor.' !important;	
					}
					
					.pm-members-area-title {
						color:'.$secondaryColor.' !important;	
					}
					
					.pm-members-area-divider {
						background-color:'.$dividerColor.';	
					}
					
					.pm-textfield.members {
						border:1px solid '.$dividerColor.';
					}
					
					.pm-members-form-font { 
						color:'.$secondaryColor.';	
					}
					
					.pm-members-form-amenities label, .pm-members-form-agent-info label {
						color:'.$secondaryColor.';	
					}
					
					.pm-members-form-submission-divider {
						background-color:'.$dividerColor.';
					}
					
					.pm-members-area-navigation li a:hover {
						color:'.$primaryColor.';	
					}
		
					.pm-members-form-submission-divider {
						background-color:'.$dividerColor.';
					}
					
					.pm-members-listing-searchfield {
						color:'.$primaryColor.';	
						border:1px solid '.$primaryColor.';
					}
					
					.pm-submit-listing-btn {
						background-color:'.$primaryColor.';	
					}
					
					.pm-submit-listing-btn:hover {
						background-color:'.$secondaryColor.';
					}
									
					a.pm-standard-link:hover, a.pm-sidebar-link:hover {
						color:'.$primaryColor.';		
					}
					
					.owl-item .pm-brand-item a:hover {
						background-color:'.$secondaryColor.';
						border: 3px solid '.$secondaryColor.';				
					}
					.pm-owl-prev, .pm-owl-next, .pm-owl-play {
						color:'.$primaryColor.';			
					}
					.btn.pm-owl-prev:hover, .btn.pm-owl-next:hover, .pm-owl-play:hover {
						color:'.$secondaryColor.';			
					}
					
					.pm-form-textfield.invalid_field, .pm-form-textarea.invalid_field {
						background-color:'.$primaryColor.';		
						border:1px solid '.$primaryColor.' !important;
						color:white;
					}
					
					.pm-form-textarea.invalid_field, .pm-form-textfield.invalid_field {
						border:1px solid '.$primaryColor.';
					}
					.pm-form-textfield, .pm-form-textarea {
						border:1px solid '.$dividerColor.';	
					}
					.pm-form-textfield:focus, .pm-form-textarea:focus {
						background-color:'.$primaryColor.';		
						border:1px solid '.$primaryColor.';
						color:black;
					}
					
					.pm-form-submit-btn {
						background-color: '.$primaryColor.';	
					}
					
					.pm-form-submit-btn:hover {
						background-color: '.$secondaryColor.';	
					}
					
					.tinynav {
						border:1px solid '.$primaryColor.';	
					}
					
					.pm-comment-form-textfield:focus, .pm-comment-form-textarea:focus {
						background-color:'.$primaryColor.';	
						border-bottom:3px solid '.$primaryColor.';	
						color:black !important;
					}
					.pm-comment-form-textarea.respond:focus {
						background-color:'.$secondaryColor.';	
						border-bottom:3px solid '.$secondaryColor.';		
					}
					
					.pm-square-btn.comments, .comment-reply-link, .form-submit .submit {
						background-color:'.$primaryColor.';
						color:black !important;	
						line-height:24px !important;
					}
					
					.pm-square-btn.comments:hover, .comment-reply-link:hover, .form-submit .submit:hover {
						background-color:'.$secondaryColor.';	
						color:white !important;	
					}
					
					.pm-single-post-tags p a {
						color:'.$secondaryColor.' !important;	
					}
					
					.pm-single-post-tags p a:hover {
						color:'.$primaryColor.' !important;	
					}
					
					.pm-single-post-like-feature a {
						color:'.$secondaryColor.';		
					}
					
					.pm-single-post-like-feature a:hover {
						color:'.$primaryColor.';		
					}
					
					.pm-single-post-share-icons-divider {
						background-color: '.$dividerColor.';	
					}
					
					.pm-single-post-share-icons-divider-endpoint {
						background-color: '.$secondaryColor.';	
					}
					
					.pm-fancy span {
						color:'.$primaryColor.' !important;		
					}
					
					.pm-fancy span:before, .pm-fancy span:after {
						border-top: 1px solid '.$primaryColor.';
					}
					
					.pm-fancy.secondary span:before, .pm-fancy.secondary span:after {
						border-top: 1px solid '.$secondaryColor.';
					}
					
					
					
					.pm-fancy-title-endpoint {
						background-color:'.$primaryColor.';	
					}
					
					.pm-fancy.secondary .pm-fancy-title-endpoint {
						background-color:'.$secondaryColor.';	
					}
					
					.pm-fancy.secondary span {
						color:'.$secondaryColor.' !important;	
					}
					
					.pm-author-bio-img-container {
						border: 5px solid '.$primaryColor.';	
					}
					
					.pm-author-bio-container .name {
						color:'.$primaryColor.' !important;	
					}
					
					.pm-author-bio-container a {
						color:'.$primaryColor.';		
					}
						
					.pm-comment {
						border-top: 1px solid '.$primaryColor.';
					}
					
					.pm-comment-avatar {
						border: 3px solid '.$primaryColor.';
					}
					
				';
				
				
				//Post Options & Colors
				/*$postTitleColor = get_option('postTitleColor', '#48D3DE');
				$postTitleColors = pm_ln_hex2rgb($postTitleColor); //Array of colors R,G,B*/
				$authorCommentsBoxColor = get_option('authorCommentsBoxColor', '#2B2B2B');
				$featuredPropertyRibbon = get_option('featuredPropertyRibbon', '#EA3D36');
				/*$authorDividerColor = get_option('authorDividerColor', '#34ceda');
				$authorBorderColor = get_option('authorBorderColor', '#ffffff');*/
				
				echo '
					#pm-author-column, #pm-comments-column {
						background-color:'.$authorCommentsBoxColor.';	
					}
					
					.pm-featured-label-content {
						background-color:'.$featuredPropertyRibbon.';		
					}
					
					.pm-featured-label-left {
						border-color: transparent transparent '.$featuredPropertyRibbon.';	
					}
					
					.pm-featured-label-right {
						border-color: transparent transparent transparent '.$featuredPropertyRibbon.';	
					}
					
				';
				
				//Shortcode options
				$testimonials_carousel_color = get_option('testimonials_carousel_color', '#ffffff');
				$accordionContentBgColor = get_option('accordionContentBgColor', '#f4f4f4');
				$tabContentBgColor = get_option('tabContentBgColor', '#f4f4f4');
				$quote_box_color = get_option('quote_box_color', '#7f6631');
				$data_table_title_color = get_option('data_table_title_color', '#7f6631');
				$data_table_info_color = get_option('data_table_info_color', '#f4f4f4');
				$timetable_font_color = get_option('timetable_font_color', '#ffffff');
				$timetable_border_color = get_option('timetable_border_color', '#efefef');
				
				echo '
				
					.pm-tab-content {
						background-color:'.$tabContentBgColor.';		
					}
					.pm-workshop-table-title {
						background-color:'.$data_table_title_color.';	
					}
					.pm-workshop-table-content {
						background-color:'.$data_table_info_color.';		
					}
				
					.pm-testimonials-arrows a {
						color:'.$testimonials_carousel_color.';	
					}
					.pm-testimonial-img {
						border: 5px solid '.$testimonials_carousel_color.';	
					}
					.panel-collapse {
						background-color:'.$accordionContentBgColor.';	
					}
					.pm-single-testimonial-box:before {
						border-top: 8px solid '.$quote_box_color.';
					}
					.pm-single-testimonial-box {
						background-color:'.$quote_box_color.';		
					}
					.pm-timetable-panel-content-body ul li, .pm-timetable-panel-title a, .pm-timetable-accordion-panel .pm-timetable-panel-heading a.pm-accordion-horizontal-open {
						color:'.$timetable_font_color.' !important;	
					}
					.pm-timetable-panel-content-body ul li {
						border-bottom: 1px solid '.$timetable_border_color.';
					}
				';
				
				
				//Alert options
				$alert_success_color = get_option('alert_success_color', '#2c5e83');
				$alert_info_color = get_option('alert_info_color', '#cbb35e');
				$alert_warning_color = get_option('alert_warning_color', '#ea6872');
				$alert_danger_color = get_option('alert_danger_color', '#5f3048');
				$alert_notice_color = get_option('alert_notice_color', '#49c592');
				
				echo '
					.alert-warning {
						background-color:'.$alert_warning_color.';	
					}
					
					.alert-success {
						background-color:'.$alert_success_color.';	
					}
					
					.alert-danger {
						background-color:'.$alert_danger_color.';	
					}
					
					.alert-info {
						background-color:'.$alert_info_color.';	
					}
					
					.alert-notice {
						background-color:'.$alert_notice_color.';	
					}
		
				';
				
				
				//Pulse slider options
				$sliderBackgroundImage = get_theme_mod('sliderBackgroundImage');
				
				$getSliderTitleOpacity = get_theme_mod('sliderTitleOpacity', 100);
				$sliderTitleOpacity = $getSliderTitleOpacity / 100;
				
				$getSliderButtonBGOpacity = get_theme_mod('sliderButtonBGOpacity', 0);
				$sliderButtonBGOpacity = $getSliderButtonBGOpacity / 100;
				
				$sliderTitleBackgroundColor = get_option('sliderTitleBackgroundColor', '#000000');
				$sliderTitleBackgroundColors = pm_ln_hex2rgb($sliderTitleBackgroundColor);
				
				$sliderButtonColor = get_option('sliderButtonColor', '#ffffff');
				$sliderButtonBGColor = get_option('sliderButtonBGColor', '#000000');
				$sliderButtonBGColors = pm_ln_hex2rgb($sliderButtonBGColor);
				
				$showBulletThumbs = get_theme_mod('showBulletThumbs', 'true');
				
				if( $showBulletThumbs !== 'true' ) {
					
					echo '
						#pm_slider_tooltip {
							display:none;	
						}
					';
					
				}
				
				if($sliderBackgroundImage !== '') :
				
					echo '
						.pm-caption {
							background-image:url('.$sliderBackgroundImage.');	
						}
					';
				
				endif;
				
				echo '
						
						.pm-caption h1:before, .pm-caption-excerpt:before {
							background-color: rgba('.$sliderTitleBackgroundColors[0].', '.$sliderTitleBackgroundColors[1].', '.$sliderTitleBackgroundColors[2].', '.$sliderTitleOpacity.');
						}
						
						.pm-slider-btn-faceflip-top, .pm-slider-btn-faceflip-bottom {
							border: 3px solid '.$sliderButtonColor.';
							background-color:rgba('.$sliderButtonBGColors[0].', '.$sliderButtonBGColors[1].', '.$sliderButtonBGColors[2].','.$sliderButtonBGOpacity.');
						}
						
					';	
					
				$displaySubHeader = get_theme_mod('displaySubHeader', 'on');
				
				if($displaySubHeader === 'off') :
					
					echo '
						header {
							position:relative;
						}
					';
					
				endif;
				
				$enableLoginBtn = get_theme_mod('enableLoginBtn', 'on');
				$enableRegisterBtn = get_theme_mod('enableRegisterBtn', 'on');
				
				if( $enableLoginBtn === 'off' && $enableRegisterBtn === 'off' ) :
					
					echo '
						.pm-nav-container {
							min-width: 380px;
						}
					';
					
				endif;
				
				$headerNavigationMode = get_theme_mod('headerNavigationMode', 'minimized');
				$enableBusinessInfoHeader = get_theme_mod('enableBusinessInfoHeader', 'off');
				
				if($enableBusinessInfoHeader === 'on') {
						
					echo '
						.pm-nav-container {
							margin-top: '. ($enableBusinessInfoHeader === 'on' ? '20px' : '7px') .';
						}	
						';
						
				}
				
				if($headerNavigationMode === 'desktop') {
						
					echo '
						header {
							position:relative;
						}
						
						#pm-pulse-container {
							margin-top: '. ($enableBusinessInfoHeader === 'on' ? '-156px' : '-117px') .';
						}
						
						
						
						.sf-menu.pm-desktop-nav ul {
							overflow: hidden !important;
							position: absolute !important;
						}
						
						.pm-nav-container-icons li:first-child {
							display:none;	
						}
						
						.pm-nav-search-bar-container {
							min-width:340px;	
						}
						
						.pm-search-input-field {
							min-width:300px;	
						}
						.pm-float-menu-container {
							display:none;	
						}
						.pm-sub-header-info {
							margin-top: -117px;
						}
						.pm-sub-header-info {
							margin-top: '. ($enableBusinessInfoHeader === 'on' ? '-146px' : '-117px') .';
						}
					';
						
				}
				
				$desktopNavPosition = get_theme_mod('desktopNavPosition', 'bottom');
				
				if($desktopNavPosition === 'bottom') {
					echo '
						#pm-pulse-container {
							margin-top: 0px;
						}
					';
				}
				
				if( function_exists( 'is_shop' ) ) :
				
					echo '
						.pm-global-menu-social-icons {
							margin: 10px auto 0;
						}
					';
				
				endif;
				
				
							
			 ?>
		</style>
		
		<?php
	}

}