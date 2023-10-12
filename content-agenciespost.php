<?php
/**
 * The default template for displaying a property post item.
 */
?>

<?php 

	$pm_agencies_logo_meta = get_post_meta(get_the_ID(), 'pm_agencies_logo_meta', true);
	$pm_agencies_phone_meta = get_post_meta(get_the_ID(), 'pm_agencies_phone_meta', true);
	$pm_agencies_email_address_meta = get_post_meta(get_the_ID(), 'pm_agencies_email_address_meta', true);
	$pm_agencies_address_meta = get_post_meta(get_the_ID(), 'pm_agencies_address_meta', true);
	$pm_agencies_state_meta = get_post_meta(get_the_ID(), 'pm_agencies_state_meta', true);
	$pm_agencies_country_meta = get_post_meta(get_the_ID(), 'pm_agencies_country_meta', true);
	$pm_agencies_zip_meta = get_post_meta(get_the_ID(), 'pm_agencies_zip_meta', true);
	$pm_agencies_address_lat_meta = get_post_meta(get_the_ID(), 'pm_agencies_address_lat_meta', true);
	$pm_agencies_address_long_meta = get_post_meta(get_the_ID(), 'pm_agencies_address_long_meta', true);
	
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

<!-- Agency post -->
<li>
    <div class="pm-agencies-list-logo">
        <img src="<?php echo esc_html($pm_agencies_logo_meta); ?>" alt="<?php the_title(); ?>"/>
    </div>
    <div class="pm-agencies-list-info">
    
        <p class="pm-agencies-list-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
        
        <p class="pm-agencies-list-phone"><?php echo esc_attr($pm_agencies_phone_meta); ?></p>
        <p class="pm-agencies-list-email"><a href="#"><?php echo esc_attr($pm_agencies_email_address_meta); ?></a></p>
        
        <p class="pm-agencies-list-address">
			<a href="#" data-gmap-latitude="<?php echo esc_attr($pm_agencies_address_lat_meta); ?>" data-gmap-longitude="<?php echo esc_attr($pm_agencies_address_long_meta); ?>" data-logo-url="<?php echo esc_html($pm_agencies_logo_meta); ?>" data-phone="<?php echo esc_attr($pm_agencies_phone_meta); ?>" data-address="<?php echo esc_attr($pm_agencies_address_meta); ?> <?php echo esc_attr($pm_agencies_state_meta); ?>, <?php echo esc_attr($pm_agencies_country_meta); ?>" class="pm-agencies-address-btn">
				<?php echo esc_attr($pm_agencies_address_meta); ?> <?php echo esc_attr($pm_agencies_state_meta); ?>, <?php echo esc_attr($pm_agencies_country_meta); ?>
            </a>
        </p>
    </div>
</li>  
<!-- Agency post end -->