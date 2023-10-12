<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_piechart extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"bar_size" => 220,
			"line_width" => 12,
			"track_color" => "#dbdbdb",
			"bar_color" => "#2B5C84", 
			"text_color" => "#ffffff",
			"percentage" => 75,
			"caption" => "Cost Reduction",
			"overlay_mode" => "off",
			"font_size" => 40
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div data-barsize="<?php esc_attr_e($bar_size); ?>" data-linewidth="<?php esc_attr_e($line_width); ?>" data-trackcolor="<?php esc_attr_e($track_color); ?>" data-barcolor="<?php esc_attr_e($bar_color); ?>" data-percent="<?php esc_attr_e($percentage); ?>" class="pm-pie-chart">
            <div class="pm-pie-chart-percent <?php echo ($overlay_mode === 'on' ? 'dark' : '') ?>" style="font-size:<?php esc_attr_e($font_size); ?>px; color:<?php esc_attr_e($text_color); ?>">
                <span <?php echo ($overlay_mode === 'on' ? '' : 'style="color:'. esc_attr_e($text_color) .'"') ?>></span>%
            </div>			
        </div>
        <div class="pm-pie-chart-description <?php  ($overlay_mode === 'on' ? 'dark' : '') ?>" style="color:<?php esc_attr_e($text_color); ?>;">
            <?php esc_attr_e($caption); ?>
        </div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_piechart",
    "name"      => __("Pie Chart", 'luxortheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Luxor Shortcodes", 'luxortheme'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Bar Size", 'luxortheme'),
            "param_name" => "bar_size",
            "description" => __("Enter a positive numeric value to set the size of the track bar.", 'luxortheme'),
			"value" => 220
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Line Width", 'luxortheme'),
            "param_name" => "line_width",
            "description" => __("Enter a positive numeric value to set the size of the line bar.", 'luxortheme'),
			"value" => 12
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Track Color", 'luxortheme'),
            "param_name" => "track_color",
            //"description" => __("Enter a positive numeric value to set the size of the line bar.", 'luxortheme'),
			"value" => "#dbdbdb"
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Bar Color", 'luxortheme'),
            "param_name" => "bar_color",
            //"description" => __("Enter a positive numeric value to set the size of the line bar.", 'luxortheme'),
			"value" => "#2B5C84"
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Text Color", 'luxortheme'),
            "param_name" => "text_color",
            //"description" => __("Enter a positive numeric value to set the size of the line bar.", 'luxortheme'),
			"value" => "#ffffff"
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Percentage", 'luxortheme'),
            "param_name" => "percentage",
            "description" => __("Enter a positive numeric value.", 'luxortheme'),
			"value" => 75
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Caption", 'luxortheme'),
            "param_name" => "caption",
            "description" => __("Enter a short caption.", 'luxortheme'),
			"value" => "Cost Reduction"
        ),
		
		/*array(
            "type" => "dropdown",
            "heading" => __("Display Overlay?", 'luxortheme'),
            "param_name" => "overlay_mode",
            "description" => __("Choose the divider style you desire.", 'luxortheme'),
			"value"      => array( 'on' => 'on', 'off' => 'off' ), //Add default value in $atts
        ),*/
		
		array(
            "type" => "textfield",
            "heading" => __("Font Size", 'luxortheme'),
            "param_name" => "font_size",
            "description" => __("Enter a positive numeric value.", 'luxortheme'),
			"value" => 40
        ),

    )

));