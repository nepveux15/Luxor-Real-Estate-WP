<?php
	//The default template for retrieving related properties
	
	//$cats = wp_get_post_categories(get_the_ID());  
		
	$cats = get_the_terms($post->ID, 'propertycats' );
	
	$relatedPropertiesTitle = get_theme_mod('relatedPropertiesTitle', esc_html__("Similar Properties", 'luxortheme'));
	
	//print_r($cats);
	
?>

<?php if (!empty($cats)) { ?>

	<div class="container pm-containerPadding-top-100 pm-containerPadding-bottom-70">
        <div class="row">
            <div class="col-lg-12">
            
            	<?php if( $relatedPropertiesTitle !== '' ) : ?>
                	<h4 class="pm-single-post-section-title"><?php esc_attr_e($relatedPropertiesTitle); ?></h4>
                <?php endif; ?>
                
                <br />
                
                <div class="row">
    
        
                        <?php  
                        
                            //print_r($cats);
                                        
                            $cat_ids = array();  
                        
                            foreach($cats as $individual_cat) {
                                $cat_ids[] = $individual_cat->term_id; 
                            }
							
							//print_r($cat_ids);
							
							$args = array(   
                                'posts_per_page' => 3, // Number of related posts to display.  
								'post_type' => 'post_properties',
								'post__not_in' => array(get_the_ID()),
								'tax_query' => array(
									array(
										'taxonomy' => 'propertycats',
										'field' => 'id',
										'terms' => $cat_ids,
										'operator' => 'IN' //Or 'AND' or 'NOT IN'
									),
								),
                            ); 
							
                          
                            $my_query = new wp_query( $args );  
                            
                            if(!$my_query->have_posts()){
                                echo '<div class="col-lg-12"><p>'.esc_html__('There are currently no properties related to this post.', 'luxortheme').'</p></div>';	
                            }
							
								$categories = wp_get_post_categories(get_the_id());
                            
                      
                                while( $my_query->have_posts() ) {  
                                    $my_query->the_post();  
                                    
									$pm_properties_thumb_image_meta = get_post_meta(get_the_ID(), 'pm_properties_thumb_image_meta', true);
									//$pm_properties_type_meta = get_post_meta(get_the_ID(), 'pm_properties_type_meta', true);
									$pm_properties_rental_type_meta = get_post_meta(get_the_ID(), 'pm_properties_rental_type_meta', true);
									$pm_properties_size_meta = get_post_meta(get_the_ID(), 'pm_properties_size_meta', true);
									$pm_properties_status_meta = get_post_meta(get_the_ID(), 'pm_properties_status_meta', true);
									$pm_properties_price_meta = get_post_meta(get_the_ID(), 'pm_properties_price_meta', true);
									$pm_properties_featured_meta = get_post_meta(get_the_ID(), 'pm_properties_featured_meta', true);
									
									$currenySymbolPosition = get_theme_mod('currenySymbolPosition', 'left');
									
									if( $pm_properties_price_meta !== '' ){
										$formattedPrice = number_format($pm_properties_price_meta);
									} else {
										$formattedPrice = 0;	
									}
									
									$currencySymbol = get_theme_mod('currencySymbol', '$');
                                    
                                ?>  
                                <div class="col-lg-4 col-md-4 col-sm-12 pm-column-spacing">
                                	<!-- Post -->
                                    <div class="pm-property-listings-img-container related">
                        
                                        <div class="pm-property-listing-ribbon"><?php echo esc_attr($pm_properties_status_meta); ?></div>
                                        <div class="pm-property-listing-ribbon-shadow"></div>
                                        
                                        <?php if($pm_properties_featured_meta === 'yes') : ?>
        
                                            <div class="pm-featured-label">
                                                <div class="pm-featured-label-left"></div>
                                                <div class="pm-featured-label-content"><span class="fa fa-star"></span></div>
                                                <div class="pm-featured-label-right"></div>
                                                <div class="clearfix"></div>
                                            </div>
                                        
                                        <?php endif; ?>
                                        
                                        <a class="pm-property-listings-btn" href="<?php the_permalink(); ?>"></a>
                                        <div class="pm-property-listings-btn-shadow"></div>
                                    
                                        <div class="pm-property-listings-img">
                                            <img src="<?php echo esc_html($pm_properties_thumb_image_meta); ?>" alt="<?php the_title(); ?>" />
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="pm-property-listings-info-container related">
                                        
                                        <a href="<?php the_permalink(); ?>" class="pm-property-listing-title"><?php the_title(); ?></a>
                                        
                                        <?php $excerpt = get_the_excerpt(); ?>
                                        
                                        <p class="pm-property-listing-excerpt"><?php echo pm_ln_string_limit_words($excerpt, 30); ?> <a href="<?php the_permalink(); ?>">[...]</a></p>
                                        
                                        <div class="pm-property-listing-divider"></div>
                                        
                                        <ul class="pm-property-listings-info-list">
                                        
                                        	<?php 
											
												$saleTypes = get_the_terms( get_the_ID(), 'propertysaletypes' );
												$pm_properties_type_meta = '';
												if ( $saleTypes && ! is_wp_error( $saleTypes ) ) : 
													foreach($saleTypes as $type) {
														$pm_properties_type_meta = $type->term_id; 
													}
												endif;	
												
												$term_value = get_term( $pm_properties_type_meta, 'propertysaletypes' );
											
											?>
                                        
                                            <li><?php echo esc_attr(ucfirst($term_value->name)); ?></li>
                                            
                                            <li><?php echo ($currenySymbolPosition == 'left' ? $currencySymbol . esc_attr($formattedPrice) : esc_attr($formattedPrice) . $currencySymbol); ?><?php echo esc_attr($pm_properties_rental_type_meta) === 'default' ? '' : '/'.esc_attr($pm_properties_rental_type_meta).'' ?></li>
                                            
                                            <li><?php echo esc_attr($pm_properties_size_meta); ?></li>
                                        </ul>
                                        
                                    </div>
                              	</div>
                                <?php } 
                            
                            
                            wp_reset_postdata(); //recommended by the WordPress codex if wp_query is being called within a template file                                      
                             
                        ?>
                
                </div>
                    
            </div>
        </div>
    </div>

<?php } else { ?>

	<div class="container pm-containerPadding-top-100 pm-containerPadding-bottom-70">
        <div class="row">
            <div class="col-lg-12">
            
                <h4 class="pm-single-post-section-title"><?php esc_html_e('Similar Properties', 'luxortheme'); ?></h4>
                
                <br />
                
                <?php echo '<p>'.esc_html__('No properties found.', 'luxortheme').'</p>'; ?>
                
            </div>
        </div>
    </div>

<?php } ?>