<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_content_divider extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $margin_top = $margin_bottom = $divider_style = $fancy_title = $color_selection = '' ;

        extract(shortcode_atts(array(  
			"margin_top" => '',
			"margin_bottom" => '',
			"divider_style" => 'simple',
			"fancy_title" => '',
			"color_selection" => 'primary',
		), $atts)); 


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>

        <!-- Element Code start -->
        
       <?php if($divider_style === 'simple') { ?>
		
           <div class="pm-title-divider <?php echo $color_selection; ?>" style="margin-top:<?php echo $margin_top; ?>px; margin-bottom:<?php echo $margin_bottom; ?>px;"></div>
            
        
        <?php } elseif($divider_style === 'title') { ?>
            
           <div class="pm-column-title-divider <?php echo $color_selection; ?>" style="margin-top:<?php echo $margin_top; ?>px; margin-bottom:<?php echo $margin_bottom; ?>px;">
               <div class="pm-column-title-divider-symbol"></div>
               <div class="pm-column-title-divider-end-point left"></div>
               <div class="pm-column-title-divider-end-point right"></div>
           </div>
            
        
        <?php } elseif($divider_style === 'column') { ?>
            
           <div class="pm-column-title-divider-simple <?php echo $color_selection; ?>" style="margin-top:<?php echo $margin_top; ?>px; margin-bottom:<?php echo $margin_bottom; ?>px;">
               <div class="pm-column-title-divider-simple-end-point <?php echo $color_selection; ?>"></div>
           </div>
            
        
        <?php } elseif($divider_style === 'fancy') { ?>
            
           <p class="pm-fancy-title pm-fancy <?php echo $color_selection; ?>" style="margin-top:<?php echo $margin_top; ?>px; margin-bottom:<?php echo $margin_bottom; ?>px;">
               <i class="pm-fancy-title-endpoint left"></i>
                   <span><?php echo $fancy_title; ?></span>
               <i class="pm-fancy-title-endpoint right"></i>
           </p>
            
        <?php } ?>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_content_divider",
    "name"      => __("Content Divider", 'luxortheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Luxor Shortcodes", 'luxortheme'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Top Margin", 'luxortheme'),
            "param_name" => "margin_top",
            "description" => __("Enter a positive integer for the top margin spacing.", 'luxortheme'),
			"value" => 20
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Bottom Margin", 'luxortheme'),
            "param_name" => "margin_bottom",
            "description" => __("Enter a positive integer for the bottom margin spacing.", 'luxortheme'),
			"value" => 20
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Divider Style", 'luxortheme'),
            "param_name" => "divider_style",
            "description" => __("Choose the divider style you desire.", 'luxortheme'),
			"value"      => array( 'simple' => 'simple', 'title' => 'title', 'column' => 'column', 'fancy' => 'fancy' ),
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Fancy Title", 'luxortheme'),
            "param_name" => "fancy_title",
            "description" => __("Enter a value for the Fancy Title - only applies if you've selected Fancy as the divider style.", 'luxortheme'),
			"value" => ''
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Color Mode", 'luxortheme'),
            "param_name" => "color_selection",
            "description" => __("Choose between primary or secondary color - applies to the Column and Fancy title styles only.", 'luxortheme'),
			"value"      => array( 'primary' => 'primary', 'secondary' => 'secondary' ),
        ),
		

    )

));