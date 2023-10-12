<?php
/**
 * The default template for displaying a property post item.
 */
?>

<?php 

	$pm_properties_thumb_image_meta = get_post_meta(get_the_ID(), 'pm_properties_thumb_image_meta', true);
	$pm_properties_type_meta = get_post_meta(get_the_ID(), 'pm_properties_type_meta', true);
	$pm_properties_rental_type_meta = get_post_meta(get_the_ID(), 'pm_properties_rental_type_meta', true);
	$pm_properties_size_meta = get_post_meta(get_the_ID(), 'pm_properties_size_meta', true);
	$pm_properties_status_meta = get_post_meta(get_the_ID(), 'pm_properties_status_meta', true);
	$pm_properties_price_meta = get_post_meta(get_the_ID(), 'pm_properties_price_meta', true);
	$pm_properties_featured_meta = get_post_meta(get_the_ID(), 'pm_properties_featured_meta', true);
	
	if( $pm_properties_price_meta !== '' ){
		$formattedPrice = number_format($pm_properties_price_meta);
	} else {
		$formattedPrice = 0;	
	}
	
	//Get edit property listing slug from members plugin
	$pm_members_edit_listing_slug = get_option('pm_members_edit_listing_slug');
	
	$currencySymbol = get_theme_mod('currencySymbol', '$');
	
?>

<?php 
        
	$allowed_html = array(
		'a' => array(
			'href' => array(),
			'title' => array()
		),
		'br' => array(),
		'em' => array(),
		'strong' => array(),
		'h6' => array(),
		'p' => array(),
		'span' => array(),
	);

?>

<!-- Property post -->
<li>

    
    <div class="pm-property-listings-img-container">
    
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
    
    <div class="pm-property-listings-info-container">
        
        <a href="<?php the_permalink(); ?>"><p class="pm-property-listing-title"><?php the_title(); ?></p></a>
        
        <?php $excerpt = get_the_excerpt(); ?>
        
        <p class="pm-property-listing-excerpt"><?php echo pm_ln_string_limit_words($excerpt, 30); ?> <a href="<?php the_permalink(); ?>" class="pm-secondary">[...]</a></p>
        
        <div class="pm-property-listing-divider"></div>
        
        <ul class="pm-property-listings-info-list">
        
            <?php 
											
				/*$saleTypes = get_the_terms( get_the_ID(), 'propertysaletypes' );
				$pm_properties_type_meta = '';
				if ( $saleTypes && ! is_wp_error( $saleTypes ) ) : 
					foreach($saleTypes as $type) {
						$pm_properties_type_meta = $type->term_id; 
					}
				endif;	*/
				
				$term_value = get_term( $pm_properties_type_meta, 'propertysaletypes' );
			
			?>
		
			<li><?php echo esc_attr(ucfirst($term_value->name)); ?></li>
            
            <li><?php echo esc_attr($currencySymbol) . esc_attr($formattedPrice); ?><?php echo esc_attr($pm_properties_rental_type_meta) === 'default' ? '' : '/'.esc_attr($pm_properties_rental_type_meta).'' ?></li>
            <li><?php echo esc_attr($pm_properties_size_meta); ?></li>
        </ul>
        
    </div>

    <div class="pm-property-listings-edit-options">
        <p><?php esc_html_e('Published','luxortheme'); ?> <b class="pm-secondary"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) ; ?></b>  <?php esc_html_e('ago','luxortheme'); ?></p>
        
        <?php $total_views = get_post_meta(get_the_ID(), 'post_views', true); ?>
        <p><?php esc_html_e('Total page views','luxortheme'); ?>: <b class="pm-secondary"><?php echo esc_attr($total_views) !== '' ? esc_attr($total_views) : '0'; ?></b></p>
        
        <?php $editURL = $pm_members_edit_listing_slug . '/?property=' . get_the_ID(); ?>
        <a href="<?php echo site_url($editURL); ?>" class="pm-edit-listing-btn pm-secondary">edit listing</a>
    </div>
    
</li>
<!-- Property post end -->