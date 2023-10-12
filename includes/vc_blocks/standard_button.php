<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_standard_button extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"el_link" => '#',
			"el_text" => '',
			"el_margin_top" => 0,
			"el_margin_bottom" => 0,
			"el_target" => '_self',
			"el_icon" => 'fa fa-chevron-right',
			"el_color" => '#7F6631',
			"el_style" => 'Style 1',
			"el_icon_position" => '40',
			"el_class" => ''
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
       <?php  if($el_style === 'Style 1') { ?>
		
            <a href="<?php echo esc_url($el_link); ?>" target="<?php esc_attr_e($el_target); ?>" class="pm-square-btn no-border <?php esc_attr_e($el_class); ?>" style="margin-top:<?php esc_attr_e($el_margin_top); ?>px; margin-bottom:<?php esc_attr_e($el_margin_bottom); ?>px;"><?php esc_attr_e($el_text); ?></a>
            
        <?php } else { ?>
            
            <a class="pm-tri-btn centered <?php esc_attr_e($el_class); ?>" href="<?php echo esc_url($el_link); ?>" target="<?php esc_attr_e($el_target); ?>" style="margin-top:<?php esc_attr_e($el_margin_top); ?>px; margin-bottom:<?php esc_attr_e($el_margin_bottom); ?>px; border: 2px solid <?php esc_attr_e($el_color); ?>;"><i class="<?php esc_attr_e($el_icon); ?>" style="color:<?php esc_attr_e($el_color); ?>; left:<?php esc_attr_e($el_icon_position); ?>%;"></i></a><p class="pm-btn-text" style="color:<?php esc_attr_e($el_color); ?>;"><?php esc_attr_e($el_text); ?></p>
            
       <?php } ?>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_standard_button",
    "name"      => __("Button", 'luxortheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Luxor Shortcodes", 'luxortheme'),
    "params"    => array(

	
		array(
            "type" => "textfield",
            "heading" => __("Link", 'luxortheme'),
            "param_name" => "el_link",
            //"description" => __("Enter a CSS class if required.", 'luxortheme'),
			"value" => '#'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Button Text", 'luxortheme'),
            "param_name" => "el_text",
            //"description" => __("Enter a CSS class if required.", 'luxortheme'),
			"value" => ''
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Margin Top", 'luxortheme'),
            "param_name" => "el_margin_top",
            "description" => __("Enter a positive integer value.", 'luxortheme'),
			"value" => 0
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Margin Bottom", 'luxortheme'),
            "param_name" => "el_margin_bottom",
            "description" => __("Enter a positive integer value.", 'luxortheme'),
			"value" => 0
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Target Window", 'luxortheme'),
            "param_name" => "el_target",
            "description" => __("Set the target window for the button.", 'luxortheme'),
			"value"      => array( '_self' => '_self', '_blank' => '_blank' ), //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'luxortheme'),
            "param_name" => "el_icon",
            "description" => __("Enter a FontAwesome 4 icon value.", 'luxortheme'),
			"value" => 'fa fa-chevron-right'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Color", 'luxortheme'),
            "param_name" => "el_color",
            //"description" => __("Enter an icon value.", 'luxortheme'),
			"value" => '#7F6631'
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Button Style", 'luxortheme'),
            "param_name" => "el_style",
            "description" => __("Choose between two different button styles.", 'luxortheme'),
			"value"      => array( 'Style 1' => 'Style 1', 'Style 2' => 'Style 2' ), //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Icon position", 'luxortheme'),
            "param_name" => "el_icon_position",
            "description" => __("Enter a positive integer value.", 'luxortheme'),
			"value" => '40'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Class", 'luxortheme'),
            "param_name" => "el_class",
            "description" => __("Apply a custom CSS class if required.", 'luxortheme'),
			"value" => ''
        ),


    )

));