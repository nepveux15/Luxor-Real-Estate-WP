<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_alert extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"close" => 'true',
			"bg_color" => '#2C5E83',
			"icon" => 'typcn typcn-tick',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="alert alert-dismissible" role="alert" style="background-color:<?php esc_attr_e($bg_color); ?>;">
        
          <?php if($close == 'true') { ?>
          
             <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only"><?php esc_html_e('Close', 'luxortheme') ?></span></button>
             
          <?php } ?>
          
          <i class="<?php esc_attr_e($icon); ?>"></i>
          
          <?php echo $content; ?>
          
        </div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_alert",
    "name"      => __("Alert Message", 'luxortheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Luxor Shortcodes", 'luxortheme'),
    "params"    => array(
			
		array(
            "type" => "colorpicker",
            "heading" => __("Background Color", 'luxortheme'),
            "param_name" => "bg_color",
            //"description" => __("Enter a typicon icon value.", 'luxortheme'),
			"value" => '#2C5E83',
        ),
			
		array(
            "type" => "dropdown",
            "heading" => __("Display close button?", 'luxortheme'),
            "param_name" => "close",
            //"description" => __("Choose the divider style you desire.", 'luxortheme'),
			"value"      => array( 'true' => 'true', 'false' => 'false' ), //Add default value in $atts
        ),
			
		/*array(
            "type" => "dropdown",
            "heading" => __("Alert type", 'luxortheme'),
            "param_name" => "alert",
            "description" => __("Select your desired alert type.", 'luxortheme'),
			"value"      => array( 'success' => 'success', 'info' => 'info', 'warning' => 'warning', 'danger' => 'danger' ), //Add default value in $atts
        ),*/
				
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'luxortheme'),
            "param_name" => "icon",
            "description" => __("Enter a typicon icon value.", 'luxortheme'),
			"value" => 'typcn typcn-tick',
        ),
		
		array(
            "type" => "textarea_html",
            "heading" => __("Content", 'luxortheme'),
            "param_name" => "content",
            //"description" => __("Enter a typicon icon value.", 'luxortheme'),
        ),

    )

));