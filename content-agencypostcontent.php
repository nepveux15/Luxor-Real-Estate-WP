<?php
/**
 * The default template for displaying an agent post.
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

<div class="container pm-containerPadding-top-80 pm-center">
        
    <div class="row">
        <div class="col-lg-12">
               
                <div class="pm-agencies-list-logo single-post">
                    <img src="<?php echo esc_html($pm_agencies_logo_meta); ?>" alt="CW Lorden Real Estate"/>
                </div>
                
                <div class="pm-agencies-list-info single-post">
                
                    <p class="pm-agencies-list-title"><?php the_title(); ?></p>
                    
                    <p class="pm-agencies-list-phone"><?php echo esc_attr($pm_agencies_phone_meta); ?></p>
                    <p class="pm-agencies-list-email"><a href="#"><?php echo esc_attr($pm_agencies_email_address_meta); ?></a></p>
                    
                    <p class="pm-agencies-list-address">
                        <?php echo esc_attr($pm_agencies_address_meta); ?> <?php echo esc_attr($pm_agencies_state_meta); ?>, <?php echo esc_attr($pm_agencies_country_meta); ?>
                    </p>
                </div>
            
        </div>
     </div>
                
</div>

<div class="container pm-containerPadding-top-40 pm-containerPadding-bottom-100">
        
    <div class="row">
        <div class="col-lg-12">
               
               <?php the_content(); ?>
            
        </div>
     </div>
                
</div>