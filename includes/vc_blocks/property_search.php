<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_property_search extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        extract(shortcode_atts(array(
			"el_title" => '',
			"el_results_page" => 'property-search',
			"el_text_color" => '#ffffff',
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
        
        <div class="pm-property-search-column <?php esc_attr_e($el_class); ?>">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 pm-center">
                        <h4 style="color:<?php esc_attr_e($el_text_color); ?>"><?php esc_attr_e($el_title); ?></h4>
                        <p style="color:<?php esc_attr_e($el_text_color); ?>"><?php echo $content; ?></p>
                        <form id="pm-property-search-module" action="<?php echo site_url(''.$el_results_page.''); ?>" method="get">
                            <ul class="pm-property-search-system">
                                <li><input type="text" name="city" placeholder="<?php  esc_html_e('City', 'luxortheme'); ?>" class="pm-property-search-text-field" id="search_city"></li>
                                <li>
                                    <div class="pm-dropdown pm-filter-system category">
                                        <div class="pm-dropmenu">
                                            <p class="pm-menu-title"><?php esc_html_e('Property Type','luxortheme'); ?></p>
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                        <div class="pm-dropmenu-active" id="pm-property-search-module-category-list" style="display: none;">
                                            <ul>
                                               <?php $propertyCategories = get_terms( 'propertycats', array( 'hide_empty' => 1 ) );	?>									
                                               <?php  foreach($propertyCategories as $cat) { ?>
                                                   <li><a href="#" data-option="<?php esc_attr_e($cat->name) ?>"><?php esc_attr_e($cat->name); ?></a></li> 
                                               <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="pm-dropdown pm-filter-system type">
                                        <div class="pm-dropmenu">
                                            <p class="pm-menu-title"><?php esc_html_e('Sale Type','luxortheme'); ?></p>
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                        <div class="pm-dropmenu-active" id="pm-property-search-module-type-list" style="display: none;">
                                            <ul>
                                               <?php $propertySaleTypes = get_terms( 'propertysaletypes', array( 'hide_empty' => 1 ) );	?>									
                                               <?php foreach($propertySaleTypes as $type) { ?>
                                                   <li><a href="#" data-option="<?php esc_attr_e($type->term_id) ?>" data-name="<?php esc_attr_e($type->name); ?>"><?php esc_attr_e($type->name); ?></a></li> 
                                               <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li><input type="text" name="min_price" placeholder="<?php esc_html_e('Min. Price','luxortheme'); ?>" class="pm-property-search-text-field"></li>
                                <li><input type="text" name="max_price" placeholder="<?php esc_html_e('Max. Price','luxortheme'); ?>" class="pm-property-search-text-field"></li>
                            </ul>
                            <input type="hidden" name="type" value="" id="pm-property-search-type-field">
                            <input type="hidden" name="category" value="" id="pm-property-search-category-field">
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="pm-property-search-btn-container">
                <div class="pm-property-search-btn">
                    <div class="pm-property-search-btn-border"></div>
                    <div class="pm-property-search-btn-endpoint top-left"></div>
                    <div class="pm-property-search-btn-endpoint top-right"></div>
                    <div class="pm-property-search-btn-endpoint bottom-left"></div>
                    <div class="pm-property-search-btn-endpoint bottom-right"></div>
                </div>
                <a href="#" class="pm-property-search-btn-link"><?php esc_html_e('Search','luxortheme'); ?></a>
            </div>
            <div class="pm-property-search-btn-shadow"></div>
        </div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_property_search",
    "name"      => __("Property Search", 'luxortheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Luxor Shortcodes", 'luxortheme'),
    "params"    => array(
	
		
		
		array(
            "type" => "textfield",
            "heading" => __("Title", 'luxortheme'),
            "param_name" => "el_title",
            "description" => __("Enter a title if required", 'luxortheme'),
			"value"      => '', //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Results Page", 'luxortheme'),
            "param_name" => "el_results_page",
            "description" => __("Enter the URL slug for the property search results template page.", 'luxortheme'),
			"value"      => 'property-search', //Add default value in $atts
        ),
		
		array(
            "type" => "textarea_html",
            "heading" => __("Message", 'luxortheme'),
            "param_name" => "content",
            "description" => __("Enter a message if required.", 'luxortheme'),
			"value"      => '', //Add default value in $atts
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Text Color", 'luxortheme'),
            "param_name" => "el_text_color",
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'luxortheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Class", 'luxortheme'),
            "param_name" => "el_class",
            "description" => __("Apply a CSS class to the parent container if required.", 'luxortheme')
        ),

    )

));