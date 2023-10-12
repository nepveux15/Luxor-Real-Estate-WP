<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_testimonials extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			'el_icon_image' => '',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();
		
		global $luxor_options;
	
		$testimonials = '';
					
		if( isset($luxor_options['opt-testimonials-slides']) && !empty($luxor_options['opt-testimonials-slides']) ){
			$testimonials = $luxor_options['opt-testimonials-slides']; //This should return an empty array if no slides are present...not an undefined index notice
		}

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <?php if(is_array($testimonials)) : ?>
					
            <div class="pm-testimonials-carousel" id="pm-testimonials-carousel">
                <ul class="pm-testimonial-items">
                
                    <?php foreach($testimonials as $t) { ?>
                    
                        <li>
                        
                            <div class="pm-testimonial-img">
                                <img src="<?php echo esc_url($t['image']); ?>" alt="<?php  esc_html_e($t['title'],'luxortheme'); ?>" />
                            </div>
                            <p class="pm-testimonial-quote">
								<?php  esc_html_e($t['description'],'luxortheme'); ?>
                                <span class="pm-testimonial-name"><?php  esc_html_e($t['title'],'luxortheme'); ?> &bull; <?php  esc_html_e($t['url'],'luxortheme'); ?></span>
                            </p>
                            
                        </li>
                        
                    <?php }//end of foreach ?>					
                    
                </ul>
            </div>
            
        <?php endif; ?>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_testimonials",
    "name"      => __("Testimonials", 'luxortheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Luxor Shortcodes", 'luxortheme'),
    "params"    => array(
	
		/*array(
            "type" => "attach_image",
            "heading" => __("Icon", 'luxortheme'),
            "param_name" => "el_icon_image",
            "description" => __("Upload a custom icon image.", 'luxortheme')
        ),*/

    )

));