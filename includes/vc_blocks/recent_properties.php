<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_recent_properties extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        $custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			'num_of_posts' => 3,

        ), $atts));


        /* ================  Render Shortcode ================ */

        ob_start();
		
		$recent_args = array(
			'post_type' => 'post_properties',
			'post_status' => 'publish',
			//'posts_per_page' => -1,
			'order' => 'DESC',
			'posts_per_page' => $num_of_posts,
			'ignore_sticky_posts' => 1
			//'tag' => get_query_var('tag')
		);
		
		$query = new WP_Query($recent_args);		
		//pm_ln_set_query($query);		
		$currencySymbol = get_theme_mod('currencySymbol', '$');

        ?>

        <!-- Element Code start -->
        
        <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
        
        	<?php 
			
				$pm_properties_thumb_image_meta = get_post_meta($query->post->ID, 'pm_properties_thumb_image_meta', true);
				$pm_properties_type_meta = get_post_meta($query->post->ID, 'pm_properties_type_meta', true);
				$pm_properties_rental_type_meta = get_post_meta($query->post->ID, 'pm_properties_rental_type_meta', true);
				$pm_properties_size_meta = get_post_meta($query->post->ID, 'pm_properties_size_meta', true);
				$pm_properties_status_meta = get_post_meta($query->post->ID, 'pm_properties_status_meta', true);
				$pm_properties_featured_meta = get_post_meta($query->post->ID, 'pm_properties_featured_meta', true);
				$pm_properties_price_meta = get_post_meta($query->post->ID, 'pm_properties_price_meta', true);				
				$pm_properties_display_price_meta = get_option('pm_properties_display_price_meta');
				
				$currenySymbolPosition = get_theme_mod('currenySymbolPosition', 'left');
				
				if($pm_properties_price_meta !== ''){
					$formattedPrice = number_format($pm_properties_price_meta);
				} else {
					$formattedPrice = 0;
				}
			
			?>
            
            <div class="col-lg-4 col-md-4 col-sm-12 pm-column-spacing pm-recent-property-shortcode-post">

                <div class="pm-property-listings-img-container related">
        
                    <div class="pm-property-listing-ribbon"><?php echo esc_attr($pm_properties_status_meta) ?></div>
                    <div class="pm-property-listing-ribbon-shadow"></div>
                    
                    <?php if($pm_properties_featured_meta === 'yes') : ?>
                    
                        <div class="pm-featured-label">
                            <div class="pm-featured-label-left"></div>
                            <div class="pm-featured-label-content"><span class="fa fa-star"></span></div>
                            <div class="pm-featured-label-right"></div>
                            <div class="clearfix"></div>
                        </div>
                    
                    <?php endif; ?>
                    
                    <a class="pm-property-listings-btn" href="<?php the_permalink() ?>"></a>
                    <div class="pm-property-listings-btn-shadow"></div>
                
                    <div class="pm-property-listings-img">
                        <img src="<?php echo esc_html($pm_properties_thumb_image_meta) ?>" alt="<?php the_title() ?>" />
                    </div>
                    
                </div>
                
                <div class="pm-property-listings-info-container related">
                    
                    <a href="<?php the_permalink(); ?>" class="pm-property-listing-title"><?php the_title() ?></a>
                    
                    <?php $excerpt = get_the_excerpt(); ?>
                    
                    <p class="pm-property-listing-excerpt"><?php echo pm_ln_string_limit_words($excerpt, 15) ?> <a href="<?php the_permalink() ?>">[...]</a></p>
                    
                    <div class="pm-property-listing-divider"></div>
                    
                    <ul class="pm-property-listings-info-list">
                    
                        <?php $term_value = get_term( $pm_properties_type_meta, 'propertysaletypes' ); ?>				
                                        
                        <?php if( $pm_properties_display_price_meta === 'no' ){ ?>						
                            
                            <?php if( $term_value ) { ?>
                                <li><?php echo esc_attr(ucfirst($term_value->name)) .' '. ($formattedPrice !== 0 ? '&bull;' : '') ?></li>
                            <?php } ?>
                            
                            <!-- Display prices to all users -->
                            <?php if( $formattedPrice !== 0 ) { ?>
                            
                                <li>
                                
                                	<?php if($currenySymbolPosition === 'left') { ?>
                                    	<?php echo esc_attr($currencySymbol) . esc_attr($formattedPrice) .' '. ($pm_properties_rental_type_meta === 'default' ? '' : '/'. $pm_properties_rental_type_meta.'') ?>
                                    <?php } else { ?>
                                    	<?php echo esc_attr($formattedPrice) . esc_attr($currencySymbol) .' '. ($pm_properties_rental_type_meta === 'default' ? '' : '/'. $pm_properties_rental_type_meta.'') ?>
                                    <?php } ?>
									
                                </li>
                                
                            <?php } ?>
                            
                        <?php } else { ?>                            
                                                    
                            <!-- Display prices to logged in users only -->
                            <?php if( is_user_logged_in() ){ ?>
                                
                                <?php if( $term_value ) { ?>
                                    <li><?php echo esc_attr(ucfirst($term_value->name)) .' '. ($formattedPrice !== 0 ? '&bull;' : '') ?></li>
                                <?php } ?>
                                
                                <?php if( $formattedPrice !== 0 ){ ?>
                                
                                    <li>
                                    
                                    	<?php if($currenySymbolPosition === 'left') { ?>
											<?php echo esc_attr($currencySymbol) . esc_attr($formattedPrice) .' '. ($pm_properties_rental_type_meta === 'default' ? '' : '/'. $pm_properties_rental_type_meta.'') ?>
                                        <?php } else { ?>
                                            <?php echo esc_attr($formattedPrice) . esc_attr($currencySymbol) .' '. ($pm_properties_rental_type_meta === 'default' ? '' : '/'. $pm_properties_rental_type_meta.'') ?>
                                        <?php } ?>                                    
									
                                    </li>
                                    
                                <?php } ?>
                                
                            <?php } else { ?>
                                
                                <?php if( $term_value ) { ?>
                                    <li><?php echo esc_attr(ucfirst($term_value->name)) ?></li>
                                <?php } ?>
                                
                            <?php } ?>
                            
                        <?php }	?>			
                        
                        <li><?php echo esc_attr($pm_properties_size_meta) ?></li>
                    </ul>
                    
                </div>
            
            </div>
        	
            <?php wp_reset_postdata(); ?>
        
        <?php endwhile; else: ?>
        
        	<p><?php esc_html__('No recent properties were found.', 'luxortheme') ?></p>
        
        <?php endif; ?>
        
		
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcode ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_recent_properties",
    "name"      => __("Recent Properties", 'luxortheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Luxor Shortcodes", 'luxortheme'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Number of Properties to display", 'luxortheme'),
            "param_name" => "num_of_posts",
            "description" => __("Enter a positive integer.", 'luxortheme')
        ),
		
		/*array(
            "type" => "textarea",
            "heading" => __("Description", 'luxortheme'),
            "param_name" => "el_description",
            "description" => __("Enter a short description for your service.", 'luxortheme')
        ),*/
		
		/*array(
            "type" => "textarea_html",
            "heading" => __("Description", 'luxortheme'),
            "param_name" => "el_description",
            "description" => __("Enter a short description for your service.", 'luxortheme')
        ),*/
		
		/*array(
            "type" => "attach_image",
            "heading" => __("Image", 'luxortheme'),
            "param_name" => "el_image",
            "description" => __("Enter an image path for the image you would like to represent your service.", 'luxortheme')
        ),*/

    )

));