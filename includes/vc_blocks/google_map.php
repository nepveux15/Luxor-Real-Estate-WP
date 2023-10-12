<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_google_map extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"el_id" => 'map1', 
			"el_latitude" => '0', 
			"el_longitude" => '0', 
			"el_full_address" => '',
			"el_logo" => '',
			"el_type" => 'ROADMAP',
			"el_zoom" => '13',
			"el_height" => '450',
			"el_disable_overlay" => 'yes'
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();


        ?>
        
        <?php 
			$img = wp_get_attachment_image_src($el_logo, "large"); 
			$el_logo = $img[0];
		?>

        <!-- Element Code start -->
        
        <?php if( $el_disable_overlay !== 'yes' ) { ?>        
			
			<div class="pm-google-map-container">
            
            	<div data-overlay="false" data-id="<?php esc_attr_e($el_id); ?>" data-latitude="<?php esc_attr_e($el_latitude); ?>" data-longitude="<?php esc_attr_e($el_longitude); ?>" data-mapType="<?php esc_attr_e($el_type); ?>" data-mapZoom="<?php esc_attr_e($el_zoom); ?>" data-message="<?php esc_attr_e($el_full_address); ?>" data-logo-url="<?php echo esc_url($el_logo); ?>" style="width:100%; height:<?php esc_attr_e($el_height); ?>px;" id="<?php esc_attr_e($el_id); ?>" class="pm-googleMap"></div>
            </div>
			
		<?php } else { ?>
			
			<div class="pm-google-map-container">
            
            	<div class="pm-contact-google-text-overlay">
                
                <p><?php esc_attr_e($el_full_address); ?></p>
                
                <a data-address="<?php esc_attr_e($el_full_address); ?>" data-logo-url="<?php echo esc_url($el_logo); ?>" data-longitude="<?php esc_attr_e($el_longitude); ?>" data-latitude="<?php esc_attr_e($el_latitude); ?>" class="fa fa-map-marker pm-contact-google-map-reset" href="#"></a>
                
                </div>
                
                <div class="pm-contact-google-map-overlay"></div><div class="pm-contact-google-map-overlay-shadow"></div>
                
                <div data-id="<?php esc_attr_e($el_id); ?>" data-latitude="<?php esc_attr_e($el_latitude); ?>" data-longitude="<?php esc_attr_e($el_longitude); ?>" data-mapType="<?php esc_attr_e($el_type); ?>" data-mapZoom="<?php esc_attr_e($el_zoom); ?>" data-logo-url="<?php echo esc_url($el_logo); ?>" data-overlay="true" data-message="<?php esc_attr_e($el_full_address); ?>" style="width:100%; height:<?php esc_attr_e($el_height); ?>px;" id="<?php esc_attr_e($el_id); ?>" class="pm-googleMap"></div>
            
            </div>
			
		<?php } ?>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_google_map",
    "name"      => __("Google Map", 'luxortheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Luxor Shortcodes", 'luxortheme'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Map ID", 'luxortheme'),
            "param_name" => "el_id",
            "description" => __("Enter a unique map ID value - this will prevent conflicts with multiple Google Maps on the same page.", 'luxortheme'),
			"value" => 'map1'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Latitude", 'luxortheme'),
            "param_name" => "el_latitude",
            "description" => __("Enter the latitude for your map. Visit www.latlong.net to generate your latitude.", 'luxortheme'),
			"value" => '0'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Longitude", 'luxortheme'),
            "param_name" => "el_longitude",
            "description" => __("Enter the longitude for your map. Visit www.latlong.net to generate your longitude.", 'luxortheme'),
			"value" => '0'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Address", 'luxortheme'),
            "param_name" => "el_full_address",
            "description" => __("Enter your complete address for your map - this will appear in the map marker.", 'luxortheme'),
			"value" => ''
        ),
		
		array(
            "type" => "attach_image",
            "heading" => __("Logo", 'luxortheme'),
            "param_name" => "el_logo",
            "description" => __("Upload an image for the map marker.", 'luxortheme')
        ),
		
		
		/*array(
            "type" => "dropdown",
            "heading" => __("Map Type", 'luxortheme'),
            "param_name" => "el_type",
            "description" => __("Choose the map type rendering.", 'luxortheme'),
			"value"      => array('ROADMAP' => 'ROADMAP', 'SATELLITE' => 'SATELLITE', 'TERRAIN' => 'TERRAIN', 'HYBRID' => 'HYBRID' ), //Add default value in $atts
        ),*/
		
		/*array(
            "type" => "textfield",
            "heading" => __("Zoom level", 'luxortheme'),
            "param_name" => "el_zoom",
            "description" => __("Set your zoom level - accepts a positive integer value.", 'luxortheme'),
			"value" => '13'
        ),*/
		
		array(
            "type" => "textfield",
            "heading" => __("Map Height", 'luxortheme'),
            "param_name" => "el_height",
            //"description" => __("Set your zoom level - accepts a positive integer value.", 'luxortheme'),
			"value" => '450'
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Display overlay?", 'luxortheme'),
            "param_name" => "el_disable_overlay",
            //"description" => __("Choose the divider style you desire.", 'luxortheme'),
			"value"      => array( 'yes' => 'yes', 'no' => 'no' ), //Add default value in $atts
        ),		
	

    )

));