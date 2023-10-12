<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_agent_profile extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"el_id" => '',
			"el_class" => ''
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

		$queried_post = get_post($el_id);
		$postID = $queried_post->ID;
		$postLink = get_post_permalink($postID);
		$postTitle = $queried_post->post_title;
		//$postTags = get_the_tags($postID);
		$postExcerpt = $queried_post->post_excerpt;
		$shortExcerpt = pm_ln_string_limit_words($postExcerpt, 20);
		
		$pm_agent_image_meta = get_post_meta($postID, 'pm_agent_image_meta', true);
		$pm_agent_stat1_meta = get_post_meta($postID, 'pm_agent_stat1_meta', true);
		$pm_agent_stat2_meta = get_post_meta($postID, 'pm_agent_stat2_meta', true);
		$pm_agent_twitter_meta = get_post_meta($postID, 'pm_agent_twitter_meta', true);
		$pm_agent_facebook_meta = get_post_meta($postID, 'pm_agent_facebook_meta', true);
		$pm_agent_gplus_meta = get_post_meta($postID, 'pm_agent_gplus_meta', true);
		$pm_agent_linkedin_meta = get_post_meta($postID, 'pm_agent_linkedin_meta', true);
		$pm_agent_email_address_meta = get_post_meta($postID, 'pm_agent_email_address_meta', true);
		$pm_agent_profile_btn_text_meta = get_option('pm_agent_profile_btn_text_meta');
		
		$enableTooltip = get_theme_mod('enableTooltip', 'on');

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm-staff-profile-container <?php esc_attr_e($el_class); ?>" data-wow-duration="1s" data-wow-offset="50" data-wow-delay="0.3s">
                    	
            <p class="pm-staff-profile-name"><a href="<?php echo esc_url($postLink); ?>"><?php esc_attr_e($postTitle); ?></a></p>
                
            <?php  if($pm_agent_image_meta !== '') : ?>
            
                <div class="pm-staff-profile-img-container">
                    <span class="overlay"></span>
                    <div class="pm-staff-profile-img-container-info">
                    
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
                    
                        <p><?php echo wp_kses($pm_agent_stat1_meta, $allowed_html); ?></p>
                        <p><?php echo wp_kses($pm_agent_stat2_meta, $allowed_html); ?></p>
                        <?php if( $pm_agent_profile_btn_text_meta !== '' ) { ?>
                            <a href="<?php echo esc_url($postLink); ?>"><?php esc_attr_e($pm_agent_profile_btn_text_meta); ?></a>
                        <?php } ?>
                    </div>
                    <a href="#" class="pm-staff-profile-img-container-btn"><i class="fa fa-chevron-up"></i></a>
                    <img src="<?php echo esc_url($pm_agent_image_meta); ?>" width="217" height="217" alt="<?php esc_attr_e($postTitle); ?>"/>
                </div>
                
                <div class="pm-staff-profile-img-border">
                    <div class="pm-staff-profile-img-border-endpoint left"></div>
                    <div class="pm-staff-profile-img-border-endpoint right"></div>
                </div>
            
            <?php endif; ?>
                    
            <p class="pm-staff-profile-excerpt"><?php esc_attr_e($shortExcerpt); ?></p>
            
            <ul class="pm-staff-profile-social-list">
            
                <?php if($pm_agent_twitter_meta !== '') : ?>
                    
                    <li <?php echo ($enableTooltip === 'on' ? 'class="pm_tip_static_top pm_tip_arrow_bottom" title="Twitter" data-tip-offset-x="23" data-tip-offset-y="5"' : ''); ?>><a href="<?php esc_html_e($pm_agent_twitter_meta); ?>" class="fa fa-twitter"></a></li>
                
                <?php endif; ?>
            
                <?php if($pm_agent_facebook_meta !== '') : ?>
                    
                    <li <?php echo ($enableTooltip === 'on' ? 'class="pm_tip_static_top pm_tip_arrow_bottom" title="Facebook" data-tip-offset-x="28" data-tip-offset-y="5"' : ''); ?>><a href="<?php esc_html_e($pm_agent_facebook_meta); ?>" class="fa fa-facebook"></a></li>
                
                <?php endif; ?>
                
                <?php if($pm_agent_gplus_meta !== '') : ?>
                    
                    <li <?php ($enableTooltip === 'on' ? 'class="pm_tip_static_top pm_tip_arrow_bottom" title="Google Plus" data-tip-offset-x="36" data-tip-offset-y="5"' : ''); ?>><a href="<?php esc_html_e($pm_agent_gplus_meta); ?>" class="fa fa-google-plus"></a></li>
                
                <?php endif; ?>
                
                <?php if($pm_agent_linkedin_meta !== '') : ?>
                    
                    <li <?php echo ($enableTooltip === 'on' ? 'class="pm_tip_static_top pm_tip_arrow_bottom" title="Linkedin" data-tip-offset-x="23" data-tip-offset-y="5"' : ''); ?>><a href="<?php esc_html($pm_agent_linkedin_meta); ?>" class="fa fa-linkedin"></a></li>
                
                <?php endif; ?>
                
                <?php if($pm_agent_email_address_meta !== '') : ?>
                    
                    <li <?php echo ($enableTooltip === 'on' ? 'class="pm_tip_static_top pm_tip_arrow_bottom" title="Email me!" data-tip-offset-x="25" data-tip-offset-y="5"' : ''); ?>><a href="mailto:<?php esc_attr_e($pm_agent_email_address_meta); ?>" class="fa fa-envelope"></a></li>
                
                <?php endif; ?>
                
            </ul>
            
        </div>	
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_agent_profile",
    "name"      => __("Agent Profile", 'luxortheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Luxor Shortcodes", 'luxortheme'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Agent Post ID", 'luxortheme'),
            "param_name" => "el_id",
            "description" => __("Enter the post ID assigned to your Agent profile.", 'luxortheme')
        ),
	
		array(
            "type" => "textfield",
            "heading" => __("Class", 'luxortheme'),
            "param_name" => "el_class",
            "description" => __("Apply a custom CSS class if required.", 'luxortheme')
        ),
				

    )

));