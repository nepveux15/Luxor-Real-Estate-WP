<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_milestone extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"speed" => "",
			"stop" => "",
			"caption" => "",
			"icon" => "",
			"icon_color" => '#fff',
			"bg_color" => '#FFE1A0',
			"border_color" => '#7F6631',
			"text_color" => '#7F6631',
			"text_size" => '24',
			"border_radius" => '0',
			"padding" => '10',
			"width" => "160",
			"height" => "160",
			"font_size" => 60,
			"style" => 'Style 1'
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <?php if( $style === 'Style 1' ){ ?>
		
            <div class="milestone">
            
                <?php  if($icon !== '') : ?>
                
                <div class="milestone-icon-container" style="background-color:<?php esc_attr_e($bg_color); ?>; border-color:<?php esc_attr_e($border_color); ?>; border-width:6px; border-style:solid; width:<?php esc_attr_e($width); ?>px; height:<?php esc_attr_e($height); ?>px;"><i class="<?php esc_attr_e($icon); ?>" style="color:<?php  esc_attr_e($icon_color); ?>; padding:<?php  esc_attr_e($padding); ?>px; font-size:<?php esc_attr_e($font_size); ?>px;"></i></div>';
                
                <?php endif; ?>
                
                <div class="milestone-content" style="font-size:<?php esc_attr_e($font_size); ?>px;">                         
                    <span data-speed="<?php esc_attr_e($speed); ?>" data-stop="<?php esc_attr_e($stop); ?>" class="milestone-value" style="color:<?php esc_attr_e($text_color); ?>; font-size:<?php esc_attr_e($text_size); ?>px;"></span>
                    <div class="milestone-description" style="font-size:<?php  esc_attr_e($text_size); ?>px;"><?php esc_attr_e($caption); ?></div>
                </div>
            </div>
            
        <?php } else { ?>
        
            <div class="milestone alt" style="background-color:<?php esc_attr_e($bg_color); ?>; border-color:<?php  esc_attr_e($border_color); ?>;">
                <i class="<?php esc_attr_e($icon); ?>" style="color:<?php  esc_attr_e($icon_color); ?>; font-size:<?php esc_attr_e($font_size); ?>px;"></i>
                <div class="milestone-content" style="font-size:<?php esc_attr_e($font_size); ?>px;">                         
                    <span data-speed="<?php esc_attr_e($speed); ?>" data-stop="<?php esc_attr_e($stop); ?>" class="milestone-value" style="color:<?php esc_attr_e($text_color); ?>; font-size:<?php esc_attr_e($text_size); ?>px;"></span><?php echo ($style == 'Style 1' ? '%' : ''); ?>
                    <div class="milestone-description"><?php  esc_attr_e($caption); ?></div>
                </div>
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

    "base"      => "pm_ln_milestone",
    "name"      => __("Milestone", 'luxortheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Luxor Shortcodes", 'luxortheme'),
    "params"    => array(
	

		array(
            "type" => "textfield",
            "heading" => __("Speed", 'luxortheme'),
            "param_name" => "speed",
            "description" => __("Enter a positive integer value.", 'luxortheme'),
			"value" => ''
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Stop value", 'luxortheme'),
            "param_name" => "stop",
            "description" => __("Enter a positive integer value.", 'luxortheme'),
			"value" => ''
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Caption", 'luxortheme'),
            "param_name" => "caption",
            "description" => __("Enter a short caption.", 'luxortheme'),
			"value" => ''
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'luxortheme'),
            "param_name" => "icon",
            "description" => __("Enter an icon value.", 'luxortheme'),
			"value" => ''
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Icon Color", 'luxortheme'),
            "param_name" => "icon_color",
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'luxortheme'),
			"value" => '#ffffff'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Background Color", 'luxortheme'),
            "param_name" => "bg_color",
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'luxortheme'),
			"value" => '#FFE1A0'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Border Color", 'luxortheme'),
            "param_name" => "border_color",
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'luxortheme'),
			"value" => '#7F6631'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Text Color", 'luxortheme'),
            "param_name" => "text_color",
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'luxortheme'),
			"value" => '#7F6631'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Text Size", 'luxortheme'),
            "param_name" => "text_size",
            "description" => __("Enter a positive integer value.", 'luxortheme'),
			"value" => '24'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Border Radius", 'luxortheme'),
            "param_name" => "border_radius",
            "description" => __("Enter a positive integer value between 0 and 99px.", 'luxortheme'),
			"value" => '0'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Padding", 'luxortheme'),
            "param_name" => "padding",
            "description" => __("Enter a positive integer value.", 'luxortheme'),
			"value" => '10'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Width", 'luxortheme'),
            "param_name" => "width",
            "description" => __("Enter a positive integer value.", 'luxortheme'),
			"value" => '160'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Height", 'luxortheme'),
            "param_name" => "height",
            "description" => __("Enter a positive integer value.", 'luxortheme'),
			"value" => '160'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Font Size", 'luxortheme'),
            "param_name" => "font_size",
            "description" => __("Enter a positive integer value.", 'luxortheme'),
			"value" => 60
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Milestone Style", 'luxortheme'),
            "param_name" => "style",
            "description" => __("Choose the Milestone style you desire.", 'luxortheme'),
			"value"      => array( 'Style 1' => 'Style 1', 'Style 2' => 'Style 2' ), //Add default value in $atts
        ),
				

    )

));