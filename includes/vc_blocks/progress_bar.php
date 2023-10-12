<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_progress_bar extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"el_id" => 1,
			"el_percentage" => '50',
			"el_text" => '',
			"el_text_color" => '#ffffff',
			"el_bg_color" => '#4a3c1e',
			"el_percent_color" => '#000000',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm-progress-bar-description" id="pm-progress-bar-desc-<?php esc_attr_e($el_id); ?>" style="color:<?php esc_attr_e($el_text_color); ?>;">
            <?php esc_attr_e($el_text); ?>
            <div class="pm-progress-bar-diamond"></div>
            <span style="color:<?php esc_attr_e($el_percent_color); ?>;"></span>
        </div>
        <div class="pm-progress-bar" style="background-color:<?php esc_attr_e($el_bg_color); ?>;">
            <span data-width="<?php esc_attr_e($el_percentage); ?>" class="pm-progress-bar-outer" id="pm-progress-bar-<?php esc_attr_e($el_id); ?>">
                <span class="pm-progress-bar-inner" ></span>
            </span>
        </div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_progress_bar",
    "name"      => __("Progress Bar", 'luxortheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Luxor Shortcodes", 'luxortheme'),
    "params"    => array(
		
		array(
            "type" => "dropdown",
            "heading" => __("Element ID Number", 'luxortheme'),
            "param_name" => "el_id",
            "description" => __("Enter a unique ID number to avoid conflicts with multiple progress bars on the same page.", 'luxortheme'),
			"value"      => array( '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10' ), //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Percentage", 'luxortheme'),
            "param_name" => "el_percentage",
            "description" => __("Enter a positive integer value between 0 and 100.", 'luxortheme'),
			"value" => '50'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Short Message", 'luxortheme'),
            "param_name" => "el_text",
            "description" => __("Enter a short message to display.", 'luxortheme'),
			"value" => ''
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Text Color", 'luxortheme'),
            "param_name" => "el_text_color",
            //"description" => __("Enter a short message to display.", 'luxortheme'),
			"value" => '#ffffff'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Background Color", 'luxortheme'),
            "param_name" => "el_bg_color",
            //"description" => __("Enter a short message to display.", 'luxortheme'),
			"value" => '#4a3c1e'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Percentage Color", 'luxortheme'),
            "param_name" => "el_percent_color",
            //"description" => __("Enter a short message to display.", 'luxortheme'),
			"value" => '#000000'
        ),
		
		

    )

));