<?php
/**
 * The default template for displaying a staff post item.
 */
?>

<?php 

	$enableTooltip = get_theme_mod('enableTooltip', 'on');
            
	$pm_agent_image_meta = get_post_meta(get_the_ID(), 'pm_agent_image_meta', true);
	$pm_agent_stat1_meta = get_post_meta(get_the_ID(), 'pm_agent_stat1_meta', true);
	$pm_agent_stat2_meta = get_post_meta(get_the_ID(), 'pm_agent_stat2_meta', true);
	$pm_agent_message_meta = get_post_meta(get_the_ID(), 'pm_agent_message_meta', true);
	
	$pm_agent_twitter_meta = get_post_meta(get_the_ID(), 'pm_agent_twitter_meta', true);
	$pm_agent_facebook_meta = get_post_meta(get_the_ID(), 'pm_agent_facebook_meta', true);
	$pm_agent_gplus_meta = get_post_meta(get_the_ID(), 'pm_agent_gplus_meta', true);
	$pm_agent_linkedin_meta = get_post_meta(get_the_ID(), 'pm_agent_linkedin_meta', true);
	$pm_agent_email_address_meta = get_post_meta(get_the_ID(), 'pm_agent_email_address_meta', true);
	
	$pm_agent_profile_btn_text_meta = get_option('pm_agent_profile_btn_text_meta');
	
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

<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 pm-column-spacing staff isotope-item">
                	
    <div class="pm-staff-profile-container">
                    	
        <p class="pm-staff-profile-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
        
        <div class="pm-staff-profile-img-container">
            <span class="overlay"></span>
            <div class="pm-staff-profile-img-container-info">
                <p><?php echo wp_kses($pm_agent_stat1_meta, $allowed_html); ?></p>
                <p><?php echo wp_kses($pm_agent_stat2_meta, $allowed_html); ?></p>
                
                <a href="<?php the_permalink(); ?>"><?php echo $pm_agent_profile_btn_text_meta !== '' ? $pm_agent_profile_btn_text_meta : ''; ?></a>
                
            </div>
            <a href="#" class="pm-staff-profile-img-container-btn"><i class="fa fa-chevron-up"></i></a>
            <img src="<?php echo esc_html($pm_agent_image_meta); ?>" width="217" height="217" alt="<?php the_title(); ?>"/>
        </div>
        
        <div class="pm-staff-profile-img-border">
            <div class="pm-staff-profile-img-border-endpoint left"></div>
            <div class="pm-staff-profile-img-border-endpoint right"></div>
        </div>
        
        <?php $excerpt = get_the_excerpt(); ?>
        
        <p class="pm-staff-profile-excerpt"><?php echo pm_ln_string_limit_words($excerpt, 20) ?>...</p>
        
        <ul class="pm-staff-profile-social-list">
        
        	<?php if($pm_agent_twitter_meta !== '') : ?>
            
            	<li <?php echo esc_attr($enableTooltip) === 'on' ? 'class="pm_tip_static_top pm_tip_arrow_bottom" title="'.esc_html__('Twitter','luxortheme').'" data-tip-offset-x="23" data-tip-offset-y="5"' : '' ?>><a href="<?php echo esc_html($pm_agent_twitter_meta); ?>" class="fa fa-twitter" target="_blank"></a></li>
            
            <?php endif; ?>
            
            <?php if($pm_agent_facebook_meta !== '') : ?>
            
            	<li <?php echo esc_attr($enableTooltip) === 'on' ? 'class="pm_tip_static_top pm_tip_arrow_bottom" title="'.esc_html__('Facebook','luxortheme').'" data-tip-offset-x="23" data-tip-offset-y="5"' : '' ?>><a href="<?php echo esc_html($pm_agent_facebook_meta); ?>" class="fa fa-facebook" target="_blank"></a></li>
            
            <?php endif; ?>
            
            <?php if($pm_agent_gplus_meta !== '') : ?>
            
            	<li <?php echo esc_attr($enableTooltip) === 'on' ? 'class="pm_tip_static_top pm_tip_arrow_bottom" title="'.esc_html__('Google Plus','luxortheme').'" data-tip-offset-x="23" data-tip-offset-y="5"' : '' ?>><a href="<?php echo esc_html($pm_agent_gplus_meta); ?>" class="fa fa-google-plus" target="_blank"></a></li>
            
            <?php endif; ?>
            
            <?php if($pm_agent_linkedin_meta !== '') : ?>
            
            	<li <?php echo esc_attr($enableTooltip) === 'on' ? 'class="pm_tip_static_top pm_tip_arrow_bottom" title="'.esc_html__('Linkedin','luxortheme').'" data-tip-offset-x="23" data-tip-offset-y="5"' : '' ?>><a href="<?php echo esc_html($pm_agent_linkedin_meta); ?>" class="fa fa-linkedin" target="_blank"></a></li>
            
            <?php endif; ?>
            
            <?php if($pm_agent_email_address_meta !== '') : ?>
            
            	<li <?php echo esc_attr($enableTooltip) === 'on' ? 'class="pm_tip_static_top pm_tip_arrow_bottom" title="'.esc_html__('Email me!','luxortheme').'" data-tip-offset-x="23" data-tip-offset-y="5"' : '' ?>><a href="mailto:<?php echo esc_attr($pm_agent_email_address_meta); ?>" class="fa fa-envelope"></a></li>
            
            <?php endif; ?>            
            
        </ul>
        
    </div><!-- /.pm-staff-profile-container -->
    
</div>