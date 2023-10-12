<?php 
	
	$desktopNavPosition = get_theme_mod('desktopNavPosition', 'bottom');
	
?>

<div class="pm-desktop-nav-container <?php echo $desktopNavPosition === 'bottom' ? 'relative' : ''; ?>" id="pm-desktop-nav-container">

    <?php 
                                
        wp_nav_menu(array(
            'container' => '',
            'container_class' => '',
            'menu_class' => 'sf-menu pm-desktop-nav',
            'menu_id' => '',
            'theme_location' => 'main_menu',
            'fallback_cb' => 'pm_ln_main_menu',
           )
        );
        
    ?>
    
    <?php 
	
		$enableMenuSocialIcons = get_theme_mod('enableMenuSocialIcons', 'on');
    
        //Business Info
        $facebooklink = get_theme_mod('facebooklink', 'http://www.facebook.com');
        $twitterlink = get_theme_mod('twitterlink', 'http://www.twitter.com');
        $googlelink = get_theme_mod('googlelink', 'http://www.googleplus.com');
        $linkedinLink = get_theme_mod('linkedinLink', 'http://www.linkedin.com');
        $vimeolink = get_theme_mod('vimeolink', 'http://www.vimeo.com');
        $youtubelink = get_theme_mod('youtubelink', 'http://www.youtube.com');
        $dribbblelink = get_theme_mod('dribbblelink', 'http://www.dribbble.com');
        $pinterestlink = get_theme_mod('pinterestlink', 'http://www.pinterest.com');
        $instagramlink = get_theme_mod('instagramlink', 'http://www.instagram.com');
        $skypelink = get_theme_mod('skypelink', '');
        $flickrlink = get_theme_mod('flickrlink', 'http://www.flickr.com');
        $tumblrlink = get_theme_mod('tumblrlink', 'http://www.tumblr.com');
        $stumbleuponlink = get_theme_mod('stumbleuponlink', 'http://www.stumbleupon.com');
        $redditlink = get_theme_mod('redditlink', 'http://www.reddit.com');
        $rssLink = get_theme_mod('rssLink', '');
        
    ?>
    
    <?php if($enableMenuSocialIcons === 'on') : ?>
    
        <ul class="pm-desktop-social-icons-list">
                        
            <?php if($facebooklink !== '') : ?>
        
                <li><a class="fa fa-facebook" href="<?php echo esc_html($facebooklink); ?>" target="_blank"></a></li>
            
            <?php endif; ?>
            
            <?php if($twitterlink !== '') : ?>
            
                <li><a class="fa fa-twitter" href="<?php echo esc_html($twitterlink); ?>" target="_blank"></a></li>
            
            <?php endif; ?>
            
            <?php if($googlelink !== '') : ?>
            
                <li><a class="fa fa-google-plus" href="<?php echo esc_html($googlelink); ?>" target="_blank"></a></li>
            
            <?php endif; ?>
            
            <?php if($linkedinLink !== '') : ?>
            
                <li><a class="fa fa-linkedin" href="<?php echo esc_html($linkedinLink); ?>" target="_blank"></a></li>
            
            <?php endif; ?>
            
            <?php if($vimeolink !== '') : ?>
            
                <li><a class="fa fa-vimeo-square" href="<?php echo esc_html($vimeolink); ?>" target="_blank"></a></li>
            
            <?php endif; ?>
            
            <?php if($youtubelink !== '') : ?>
            
                <li><a class="fa fa-youtube" href="<?php echo esc_html($youtubelink); ?>" target="_blank"></a></li>
            
            <?php endif; ?>
            
            <?php if($dribbblelink !== '') : ?>
            
                <li><a class="fa fa-dribbble" href="<?php echo esc_html($dribbblelink); ?>" target="_blank"></a></li>
            
            <?php endif; ?>
            
            <?php if($pinterestlink !== '') : ?>
            
                <li><a class="fa fa-pinterest" href="<?php echo esc_html($pinterestlink); ?>" target="_blank"></a></li>
            
            <?php endif; ?>
            
            <?php if($instagramlink !== '') : ?>
            
                <li><a class="fa fa-instagram" href="<?php echo esc_html($instagramlink); ?>" target="_blank"></a></li>
            
            <?php endif; ?>
            
            <?php if($skypelink !== '') : ?>
            
                <li><a class="fa fa-skype" href="skype:<?php echo esc_attr($skypelink); ?>?call"></a></li>
            
            <?php endif; ?>
            
            <?php if($flickrlink !== '') : ?>
            
                <li><a class="fa fa-flickr" href="<?php echo esc_html($flickrlink); ?>" target="_blank"></a></li>
            
            <?php endif; ?>
            
            <?php if($tumblrlink !== '') : ?>
            
                <li><a class="fa fa-tumblr" href="<?php echo esc_html($tumblrlink); ?>" target="_blank"></a></li>
            
            <?php endif; ?>
            
            <?php if($stumbleuponlink !== '') : ?>
            
                <li><a class="fa fa-stumbleupon" href="<?php echo esc_html($stumbleuponlink); ?>" target="_blank"></a></li>
            
            <?php endif; ?>
            
            <?php if($redditlink !== '') : ?>
            
                <li><a class="fa fa-reddit" href="<?php echo esc_html($redditlink); ?>" target="_blank"></a></li>
            
            <?php endif; ?>
            
            <?php if($rssLink !== '') : ?>
            
                <li><a class="fa fa-rss" href="<?php echo esc_html($rssLink); ?>" target="_blank"></a></li>
                
            <?php endif; ?>
            
        </ul>
    
    <?php endif; ?>
    
    

</div>