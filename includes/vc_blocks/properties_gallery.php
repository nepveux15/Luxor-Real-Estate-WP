<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_properties_gallery extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"el_post_order" => 'DESC',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
			
			//Fetch data
			$properties_arguments = array(
				'post_type' => 'post_properties',
				'post_status' => 'publish',
				'posts_per_page' => 12,
				'order' => (string) $el_post_order,
				//'post_count' => 12,
				//'meta_key' => 're_start_date_event',
				'meta_query' => array(
					array(
						'key' => 'pm_properties_featured_meta',
						'value' => 'yes',
						'compare' => '==',
					)
				),
			);
			
			$pm_properties_display_price_meta = get_option('pm_properties_display_price_meta');
			
			$properties_query = new WP_Query($properties_arguments);
					
			$dataColumn = 1;
			$dataIndex = 0;
		?>

        <!-- Element Code start -->
        
        <div class="pm-image-gallery" id="pm-image-gallery">
	
            <div class="image-gallery-inner">
            
                <?php if ($properties_query->have_posts()) : while ($properties_query->have_posts()) : $properties_query->the_post(); ?>
                    
                    <?php 
                    
                    if($dataColumn > 6){
                        $dataColumn = 1;
                    }
                
                    $pm_properties_thumb_image_meta = get_post_meta(get_the_ID(), 'pm_properties_thumb_image_meta', true);
                    $pm_properties_image_meta = get_post_meta(get_the_ID(), 'pm_properties_image_meta', true);
                    $pm_properties_type_meta = get_post_meta(get_the_ID(), 'pm_properties_type_meta', true);
                    $pm_properties_rental_type_meta = get_post_meta(get_the_ID(), 'pm_properties_rental_type_meta', true);
                    
                    $pm_properties_price_meta = get_post_meta(get_the_ID(), 'pm_properties_price_meta', true);
                    
                    if($pm_properties_price_meta !== ''){
                        $formattedPrice = number_format($pm_properties_price_meta);
                    } else {
                        $formattedPrice = 0;
                    }
                    
                    $currencySymbol = get_theme_mod('currencySymbol', '$');
					$currenySymbolPosition = get_theme_mod('currenySymbolPosition', 'left');
                    $pm_properties_address_meta = get_post_meta(get_the_ID(), 'pm_properties_address_meta', true);
                    $pm_properties_state_meta = get_post_meta(get_the_ID(), 'pm_properties_state_meta', true);
                    $pm_properties_city_meta = get_post_meta(get_the_ID(), 'pm_properties_city_meta', true);
                    $pm_properties_country_meta = get_post_meta(get_the_ID(), 'pm_properties_country_meta', true);
                    $pm_properties_zip_meta = get_post_meta(get_the_ID(), 'pm_properties_zip_meta', true);
                    $pm_properties_address_lat_meta = get_post_meta(get_the_ID(), 'pm_properties_address_lat_meta', true);
                    $pm_properties_address_long_meta = get_post_meta(get_the_ID(), 'pm_properties_address_long_meta', true);
                    $pm_properties_status_meta = get_post_meta(get_the_ID(), 'pm_properties_status_meta', true);
                    
                    $title = get_the_title();
					
					?>
                
                    <div class="pm-image-gallery-image">
                        <img src="<?php esc_html_e($pm_properties_thumb_image_meta); ?>" alt="<?php echo $title; ?>" />
                        <span></span>
                        
                        <?php if( $pm_properties_display_price_meta === 'no' ) { ?>
                            
                            <?php if( $formattedPrice !== 0 ) { ?>
                                
                                <a class="pm-image-gallery-item-hover-btn" href="#" data-index="<?php echo $dataIndex; ?>" data-big-image="<?php esc_html_e($pm_properties_image_meta); ?>" data-post-url="<?php echo the_permalink(); ?>" data-post-title="<?php echo $title; ?>" data-sale-price="&bull; <?php echo ($currenySymbolPosition == 'left' ? $currencySymbol . esc_attr($formattedPrice) : esc_attr($formattedPrice) . $currencySymbol) . ($pm_properties_rental_type_meta === 'default' ? '' : '/'.$pm_properties_rental_type_meta.''); ?>" data-sale-status="<?php esc_attr_e($pm_properties_status_meta); ?>" data-gmap-latitude="<?php esc_attr_e($pm_properties_address_lat_meta); ?>" data-gmap-longitude="<?php esc_attr_e($pm_properties_address_long_meta); ?>" data-address="<?php esc_attr_e($pm_properties_address_meta).' '.esc_attr($pm_properties_city_meta).', '.esc_attr($pm_properties_state_meta).' '.esc_attr($pm_properties_country_meta).' '.esc_attr($pm_properties_zip_meta); ?>" data-column="<?php echo $dataColumn; ?>"></a>
                                
                            <?php } else { ?>
                                
                                <a class="pm-image-gallery-item-hover-btn" href="#" data-index="<?php echo $dataIndex; ?>" data-big-image="<?php esc_html_e($pm_properties_image_meta); ?>" data-post-url="<?php the_permalink(); ?>" data-post-title="<?php echo $title; ?>" data-sale-price="" data-sale-status="<?php esc_attr_e($pm_properties_status_meta); ?>" data-gmap-latitude="<?php esc_attr_e($pm_properties_address_lat_meta); ?>" data-gmap-longitude="<?php esc_attr_e($pm_properties_address_long_meta); ?>" data-address="<?php esc_attr_e($pm_properties_address_meta).' '.esc_attr($pm_properties_city_meta).', '.esc_attr($pm_properties_state_meta).' '.esc_attr($pm_properties_country_meta).' '.esc_attr($pm_properties_zip_meta); ?>" data-column="<?php echo $dataColumn ?>"></a>
                                
                            <?php } ?>
                            
                        <?php } else { ?>
                        
                            <?php if( is_user_logged_in() ){ ?>
                                
                                <?php if( $formattedPrice !== 0 ) { ?>
                                
                                    <a class="pm-image-gallery-item-hover-btn" href="#" data-index="<?php echo $dataIndex ?>" data-big-image="<?php esc_html_e($pm_properties_image_meta); ?>" data-post-url="<?php the_permalink(); ?>" data-post-title="<?php echo $title; ?>" data-sale-price="&bull; <?php echo ($currenySymbolPosition == 'left' ? $currencySymbol . esc_attr($formattedPrice) : esc_attr($formattedPrice) . $currencySymbol) . ($pm_properties_rental_type_meta === 'default' ? '' : '/'.$pm_properties_rental_type_meta.''); ?>" data-sale-status="<?php esc_attr_e($pm_properties_status_meta); ?>" data-gmap-latitude="<?php esc_attr_e($pm_properties_address_lat_meta); ?>" data-gmap-longitude="<?php esc_attr($pm_properties_address_long_meta); ?>" data-address="<?php esc_attr_e($pm_properties_address_meta).' '.esc_attr($pm_properties_city_meta).', '.esc_attr($pm_properties_state_meta).' '.esc_attr($pm_properties_country_meta).' '.esc_attr($pm_properties_zip_meta); ?>" data-column="<?php echo $dataColumn; ?>"></a>
                                    
                                <?php } else { ?>
                                    
                                    <a class="pm-image-gallery-item-hover-btn" href="#" data-index="<?php echo $dataIndex; ?>" data-big-image="<?php esc_html_e($pm_properties_image_meta); ?>" data-post-url="<?php the_permalink(); ?>" data-post-title="<?php echo $title; ?>" data-sale-price="" data-sale-status="<?php esc_attr_e($pm_properties_status_meta); ?>" data-gmap-latitude="<?php esc_attr_e($pm_properties_address_lat_meta); ?>" data-gmap-longitude="<?php esc_attr_e($pm_properties_address_long_meta); ?>" data-address="<?php esc_attr($pm_properties_address_meta).' '.esc_attr($pm_properties_city_meta).', '.esc_attr($pm_properties_state_meta).' '.esc_attr($pm_properties_country_meta).' '.esc_attr($pm_properties_zip_meta); ?>" data-column="<?php echo $dataColumn; ?>"></a>
                                    
                                <?php } ?>
                                
                            <?php } else { ?>
                                
                                <a class="pm-image-gallery-item-hover-btn" href="#" data-index="'.$dataIndex.'" data-big-image="<?php esc_html_e($pm_properties_image_meta); ?>" data-post-url="<?php the_permalink(); ?>" data-post-title="<?php echo $title; ?>" data-sale-price="" data-sale-status="<?php esc_attr_e($pm_properties_status_meta); ?>" data-gmap-latitude="'.esc_attr($pm_properties_address_lat_meta).'" data-gmap-longitude="<?php esc_attr_e($pm_properties_address_long_meta); ?>" data-address="<?php esc_attr_e($pm_properties_address_meta).' '. esc_attr_e($pm_properties_city_meta).', '.esc_attr_e($pm_properties_state_meta).' '.esc_attr_e($pm_properties_country_meta).' '.esc_attr_e($pm_properties_zip_meta); ?>" data-column="<?php echo $dataColumn; ?>"></a>
                                
                            <?php } ?>
                            
                        <?php } ?>
                        
                        <div class="pm-image-gallery-item-hover-btn-shadow"></div>
                    </div>
                    
                    <?php
						$dataColumn++;
						$dataIndex++;
					?>
                
                <?php endwhile; else: ?>
                     <p><?php esc_html_e('No featured properties were found.', 'luxortheme'); ?></p>
                <?php endif; ?>
                
                <?php wp_reset_postdata(); ?>
                
            </div>
            
            <div class="pm-image-gallery-lightbox" id="pm-image-gallery-lightbox">
                <div class="pm-image-gallery-lightbox-gmap-container" id="pm-image-gallery-lightbox-gmap-container"></div>
                <div class="pm-image-gallery-lightbox-title-container">
                    <span id="pm_image_gallery_title"></span>
                    <a href="#" id="pm-gallery-lightbox-url-btn" class="fa fa-bars"></a>
                </div>
                <div class="pm-image-gallery-lightbox-info-container">
                    <ul class="pm-image-gallery-lightbox-info-list">
                        <li id="sale_status"></li>
                        <li id="sale_price"></li>
                        <li><a href="#" id="lightbox_map_btn"><?php esc_html_e('View Map','luxortheme'); ?></a></li>
                    </ul>
                </div>
                <div class="inner"></div>
                <a class="pm-image-gallery-close" href="#">&times;</a>
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

    "base"      => "pm_ln_properties_gallery",
    "name"      => __("Properties Gallery", 'luxortheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Luxor Shortcodes", 'luxortheme'),
    "params"    => array(

		
		array(
            "type" => "dropdown",
            "heading" => __("Post Order", 'luxortheme'),
            "param_name" => "el_post_order",
            "description" => __("Set the order in which the property posts are displayed.", 'luxortheme'),
			"value"      => array( 'DESC' => 'DESC', 'ASC' => 'ASC' ), //Add default value in $atts
        ),
		
		

    )

));