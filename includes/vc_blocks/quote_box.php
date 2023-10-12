<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_quote_box extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"author_name" => '',
			"author_title" => '',
			"avatar" => '',
			"text_color" => 'white',
			"name_color" => '#4D4D4D'
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			$img = wp_get_attachment_image_src($avatar, "large"); 
			$avatar = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm-single-testimonial-container">
            <div class="pm-single-testimonial-box">
                <p style="color:<?php esc_attr_e($text_color); ?>;"><?php echo $content ?></p>
            </div>
            <div class="pm-single-testimonial-author-container">
                <div class="pm-single-testimonial-author-avatar">
                    <img src="<?php echo esc_url($avatar); ?>" width="74" height="74" alt="avatar">
                </div>
                <div class="pm-single-testimonial-author-info">
                    <p class="name" style="color:<?php esc_attr_e($name_color); ?>;"><?php esc_attr_e($author_name); ?></p>
                    <p class="title" style="color:<?php esc_attr_e($name_color); ?>;"><?php esc_attr_e($author_title); ?></p>
                </div>
            </div>
        </div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_quote_box",
    "name"      => __("Quote Box", 'luxortheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Luxor Shortcodes", 'luxortheme'),
    "params"    => array(

		array(
            "type" => "textfield",
            "heading" => __("Author Name", 'luxortheme'),
            "param_name" => "author_name",
            //"description" => __("Enter a CSS class if required.", 'luxortheme'),
			"value" => ''
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Author Title", 'luxortheme'),
            "param_name" => "author_title",
            //"description" => __("Enter a CSS class if required.", 'luxortheme'),
			"value" => ''
        ),
		
		array(
            "type" => "attach_image",
            "heading" => __("Avatar", 'luxortheme'),
            "param_name" => "avatar",
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'luxortheme')
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Text Color", 'luxortheme'),
            "param_name" => "text_color",
			"value" => '#ffffff'
            //"description" => __("Enter a short description for your service.", 'luxortheme')
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Name Color", 'luxortheme'),
            "param_name" => "name_color",
			"value" => '#4D4D4D'
            //"description" => __("Enter a short description for your service.", 'luxortheme')
        ),
		
		array(
            "type" => "textarea_html",
            "heading" => __("Content", 'luxortheme'),
            "param_name" => "content",
            //"description" => __("Enter a CSS class if required.", 'luxortheme'),
        ),

    )

));