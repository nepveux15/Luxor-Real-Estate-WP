<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_pricing_table extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"el_title" => 'Silver',
			"el_featured" => 'no',
			"el_price" => '19',
			"el_currency_symbol" => '$',
			"el_subscript" => '/mo',
			"el_message" => '',
			"el_button_text" => 'Purchase Plan',
			"el_button_link" => '#',
			"el_bg_image" => '',
			"el_header_color" => '#7F6631',
			"el_button_color" => '#7F6631',
			"el_text_color" => '#ffffff'
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			$img = wp_get_attachment_image_src($el_bg_image, "large"); 
			$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm-pricing-table-container">
            <div class="pm-pricing-table-title" style="background-color:<?php esc_attr_e($el_header_color); ?>;">
                <p><?php esc_attr_e($el_title); ?></p>
            </div>
            <div class="pm-pricing-table-price" <?php echo ($imgSrc !== '' ? 'style=background-image:url('. esc_url($imgSrc) .')' : ''); ?>>
            
                <?php if($el_featured === 'yes') : ?>
                    <div class="pm-pricing-table-featured"></div>
                    <i class="fa fa-thumbs-up"></i>
                <?php endif; ?>
                
                <p class="price" style="color:<?php esc_attr_e($el_text_color); ?>;"><sup><?php esc_attr_e($el_currency_symbol); ?></sup><?php esc_attr_e($el_price); ?><sub><?php esc_attr_e($el_subscript); ?></sub></p>
                <p class="details" style="color:<?php esc_attr_e($el_text_color); ?>;"><?php esc_attr_e($el_message); ?></p></div><?php echo $content ?>

            <?php if($el_button_text !== ''){ ?>
                <a href="<?php echo esc_url($el_button_link); ?>" class="pm-pricing-table-btn" style="background-color:<?php esc_attr_e($el_button_color); ?>;"><?php esc_attr_e($el_button_text); ?> &nbsp;<i class="fa fa-angle-right"></i></a>
            <?php }	?>
        </div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_pricing_table",
    "name"      => __("Pricing Table", 'luxortheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Luxor Shortcodes", 'luxortheme'),
    "params"    => array(
	
		array(
            "type" => "dropdown",
            "heading" => __("Featured?", 'luxortheme'),
            "param_name" => "el_featured",
            "description" => __("Display a featured icon symbol.", 'luxortheme'),
			"value"      => array( 'no' => 'no', 'yes' => 'yes' ), //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Title", 'luxortheme'),
            "param_name" => "el_title",
			"value" => ''
            //"description" => __("Enter a CSS class if required.", 'luxortheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Price", 'luxortheme'),
            "param_name" => "el_price",
			"value" => '19'
            //"description" => __("Enter a CSS class if required.", 'luxortheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Currency Symbol", 'luxortheme'),
            "param_name" => "el_currency_symbol",
			"value" => '$'
            //"description" => __("Enter a CSS class if required.", 'luxortheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Subscript", 'luxortheme'),
            "param_name" => "el_subscript",
			"value" => '/mo'
            //"description" => __("Enter a CSS class if required.", 'luxortheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Message", 'luxortheme'),
            "param_name" => "el_message",
			"value" => ''
            //"description" => __("Enter a CSS class if required.", 'luxortheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Button Text", 'luxortheme'),
            "param_name" => "el_button_text",
			"value" => 'Purchase Plan'
            //"description" => __("Enter a CSS class if required.", 'luxortheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Button URL", 'luxortheme'),
            "param_name" => "el_button_link",
			"value" => '#'
            //"description" => __("Enter a CSS class if required.", 'luxortheme')
        ),
		
		array(
            "type" => "attach_image",
            "heading" => __("Background Image", 'luxortheme'),
            "param_name" => "el_bg_image",
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'luxortheme')
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Header Color", 'luxortheme'),
            "param_name" => "el_header_color",
            //"description" => __("Choose the divider style you desire.", 'luxortheme'),
			"value"      => '#7F6631', //Add default value in $atts
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Button Color", 'luxortheme'),
            "param_name" => "el_button_color",
            //"description" => __("Choose the divider style you desire.", 'luxortheme'),
			"value"      => '#7F6631', //Add default value in $atts
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Text Color", 'luxortheme'),
            "param_name" => "el_text_color",
            //"description" => __("Choose the divider style you desire.", 'luxortheme'),
			"value"      => '#ffffff', //Add default value in $atts
        ),
		
		array(
            "type" => "textarea_html",
            "heading" => __("Content", 'luxortheme'),
            "param_name" => "content",
			"value" => '',
            "description" => __("Format your content in an unordered list for proper formatting.", 'luxortheme')
        ),
		

    )

));