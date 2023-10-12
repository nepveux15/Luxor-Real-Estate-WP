<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_countdown extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"el_id" => 1,
			"el_date" => '2017/08/25',	
			"el_text_color" => '#000000',
			"el_text_size" => '24',
			"el_text_align" => 'center'
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
       <div class="pm-countdown-container" id="pm-countdown-container-<?php esc_attr_e($el_id); ?>" style="color:<?php esc_attr_e($el_text_color); ?>; font-size:<?php esc_attr_e($el_text_size); ?>px; text-align:<?php esc_attr_e($el_text_align); ?>;"></div>
	   
	   <?php 
	   
	   		echo '<script type="text/javascript">(function($) { $(document).ready(function(e) { $("#pm-countdown-container-'.esc_attr($el_id).'").countdown("'.esc_attr($el_date).'", function(event) { $(this).html(event.strftime("%w weeks %d days %H:%M:%S")); }); }); })(jQuery);</script>';
	   
	   ?>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_countdown",
    "name"      => __("Countdown", 'luxortheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Luxor Shortcodes", 'luxortheme'),
    "params"    => array(

		array(
            "type" => "dropdown",
            "heading" => __("Element ID", 'luxortheme'),
            "param_name" => "el_id",
            "description" => __("Assign a unique numeric ID value to prevent conflicts with multiple countdowns on a single page.", 'luxortheme'),
			"value"      => array( '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10' ), //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Date", 'luxortheme'),
            "param_name" => "el_date",
            "description" => __("Enter a date in the following format: 2016/08/25", 'luxortheme'),
			"value" => '2017/08/25'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Text Color", 'luxortheme'),
            "param_name" => "el_text_color",
            //"description" => __("Enter a date in the following format: 2016/08/25", 'luxortheme'),
			"value" => '#000000'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Text Size", 'luxortheme'),
            "param_name" => "el_text_size",
            "description" => __("Accepts a positive integer for the font size.", 'luxortheme'),
			"value" => '24'
        ),
				
		array(
            "type" => "dropdown",
            "heading" => __("Text Alignment", 'luxortheme'),
            "param_name" => "el_text_align",
            "description" => __("Set the alignment of the text.", 'luxortheme'),
			"value"      => array( 'left' => 'left', 'center' => 'center', 'right' => 'right' ), //Add default value in $atts
        ),
		
		

    )

));