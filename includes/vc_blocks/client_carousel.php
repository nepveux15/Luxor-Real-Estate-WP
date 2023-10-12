<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_client_carousel extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"el_target" => '_blank',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

		//Redux options
		global $luxor_options;
		
		$clients = '';
					
		if( isset($luxor_options['opt-client-slides']) && !empty($luxor_options['opt-client-slides']) ){
			$clients = $luxor_options['opt-client-slides']; //This should return an empty array if no slides are present...not an undefined index notice
		}

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <?php if(is_array($clients)) : ?>
	
            <div id="pm-brands-carousel" class="owl-carousel owl-theme">
            
                <?php foreach($clients as $c) { ?>
            
                    <div class="pm-brand-item">
                        <a href="<?php echo $c['description'] ?>" target="<?php esc_attr_e($el_target); ?>" class="pm_tip_static_top pm_tip_arrow_bottom" title="<?php esc_html_e('Visit us!', 'luxortheme'); ?>" data-tip-offset-x="27" data-tip-offset-y="-10"><i class="fa fa-globe"></i></a>
                        <img src="<?php echo $c['image']; ?>" width="263" height="67" alt="<?php echo $c['title']; ?>">
                    </div>
                
                <?php }//end of foreach ?>
                
            </div>
            
            <div class="pm-brand-carousel-btns">
                <a class="btn pm-owl-prev fa fa-chevron-left"></a>
                <a class="btn pm-owl-play fa fa-play" id="pm-owl-play"></a>
                <a class="btn pm-owl-next fa fa-chevron-right"></a>
            </div>
        
        <?php endif;//end of if ?>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_client_carousel",
    "name"      => __("Client Carousel", 'luxortheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Luxor Shortcodes", 'luxortheme'),
    "params"    => array(
	
		array(
            "type" => "dropdown",
            "heading" => __("Target Window", 'luxortheme'),
            "param_name" => "el_target",
            "description" => __("Set the target window panel link.", 'luxortheme'),
			"value"      => array( '_self' => '_self', '_blank' => '_blank' ), //Add default value in $atts
        ),

    )

));