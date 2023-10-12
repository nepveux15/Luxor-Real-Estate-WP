<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_testimonial_profile extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"el_name" => '',
			"el_title" => '',
			"el_date" => '',
			"el_image" => '',
			"el_icon_image" => ''
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			$img = wp_get_attachment_image_src($el_image, "large"); 
			$imgSrc = $img[0];
			
			$icon_img = wp_get_attachment_image_src($el_icon_image, "large"); 
			$iconImgSrc = $icon_img[0];
		?>

        <!-- Element Code start -->
        <div class="pm-single-testimonial-shortcode">
            <div style="background-image:url(<?php echo esc_url($imgSrc); ?>);" class="pm-single-testimonial-img-bg">
                
            <?php if($iconImgSrc !== '') : ?>
                <div class="pm-single-testimonial-avatar-icon">
                    <img width="33" height="41" class="img-responsive" src="<?php echo esc_url($iconImgSrc); ?>" alt="<?php esc_attr_e($el_title); ?>">
                </div>
            <?php endif; ?>
                
            </div>
            <p class="name"><?php esc_attr_e($el_name); ?></p>
            <p class="title"><?php esc_attr_e($el_title); ?></p>
            <div class="pm-single-testimonial-divider"></div>
            <p class="quote"><?php echo $content; ?></p>
            <div class="pm-single-testimonial-divider"></div>
            <p class="date"><?php esc_attr_e($el_date); ?></p>
        
        </div>
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_testimonial_profile",
    "name"      => __("Testimonial Profile", 'luxortheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Luxor Shortcodes", 'luxortheme'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Name", 'luxortheme'),
            "param_name" => "el_name",
			"value" => ''
            //"description" => __("Enter a CSS class if required.", 'luxortheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Title", 'luxortheme'),
            "param_name" => "el_title",
			"value" => '',
            //"description" => __("Enter a CSS class if required.", 'luxortheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Date", 'luxortheme'),
            "param_name" => "el_date",
			"value" => '',
            "description" => __("Enter a date if required.", 'luxortheme')
        ),

		
		array(
            "type" => "attach_image",
            "heading" => __("Avatar", 'luxortheme'),
            "param_name" => "el_image",
            "description" => __("Upload an avatar for your testimonial. Recommended size 230x230px", 'luxortheme')
        ),
		
		array(
            "type" => "attach_image",
            "heading" => __("Avatar Icon", 'luxortheme'),
            "param_name" => "el_icon_image",
            "description" => __("Upload an icon for your avatar.", 'luxortheme')
        ),
		
		array(
            "type" => "textarea_html",
            "heading" => __("Description", 'luxortheme'),
            "param_name" => "content",
            "description" => __("Enter your testimonial quote.", 'luxortheme')
        ),
		
		

    )

));