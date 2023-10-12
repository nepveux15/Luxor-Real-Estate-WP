<?php 

//Redux options
global $luxor_options;
	
//Header options
$companyLogoAltTag = get_theme_mod('companyLogoAltTag', '');
$companyLogoURL = get_theme_mod('companyLogoURL', '');

$enableTooltip = get_theme_mod('enableTooltip', 'on');

//Business info
$businessPhone = get_theme_mod('businessPhone', '1-888-555-6548');
$businessEmail = get_theme_mod('businessEmail', 'info@luxorrealty.com');
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

//Footer Options
$footerLogo = get_theme_mod('footerLogo', '');
$toggle_footer = get_theme_mod('toggle_footer', 'on');
$toggle_footerWidgets = get_theme_mod('toggle_footerWidgets', 'on');

$toggle_footerNav = get_theme_mod('toggle_footerNav', 'on');
$toggle_footer_socialIcons = get_theme_mod('toggle_footer_socialIcons', 'on');

$toggleParallaxFooter = get_theme_mod('toggleParallaxFooter', 'on');
$displayFooterLogo = get_theme_mod('displayFooterLogo', 'on');
$displayFooterStats = get_theme_mod('displayFooterStats', 'on');
$displayCopyright = get_theme_mod('displayCopyright', 'on');
$displayBusinessInfo = get_theme_mod('displayBusinessInfo', 'on');
$displayLoginButton = get_theme_mod('displayLoginButton', 'on');

$toggle_backtotop = get_theme_mod('toggle_backtotop', 'on');

if( isset($luxor_options['opt-copyright-notice']) ){
	$copyrightInfo = $luxor_options['opt-copyright-notice'];
} else {
	$copyrightInfo = '';	
}



$statInfo1 = get_theme_mod('statInfo1', '786 Agents Worldwide');
$statInfo2 = get_theme_mod('statInfo2', '3,344,543 Homes for sale');

$businessPhoneIcon = get_theme_mod('businessPhoneIcon', 'fa fa-mobile');
$businessEmailIcon = get_theme_mod('businessEmailIcon', 'fa fa-inbox');

//Layout Options
$footerLayout = get_theme_mod('footerLayout', 'footer-four-columns');


?>
      
      <?php if($toggle_footer === 'on') : ?>
      
      	<footer>
            
            <?php if($toggle_backtotop === 'on') : ?>
            	<a href="#" id="back-top" class="pm-footer-back-to-top"><i class="fa fa-chevron-up"></i></a>
            <?php endif; ?>
        
            <div class="pm-fat-footer <?php echo esc_attr($toggleParallaxFooter) === 'on' ? ' pm-parallax-panel' : ''; ?>" <?php echo esc_attr($toggleParallaxFooter) === 'on' ? 'data-stellar-background-ratio="0.5"' : ''; ?>>
                
                <div class="container">
                
                    <div class="row">
                        
                        <?php if($displayFooterLogo === 'on') : ?>
                        
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <a href="<?php echo esc_attr($companyLogoURL) ?>"><img src="<?php echo esc_html($footerLogo); ?>" alt="<?php echo esc_attr($companyLogoAltTag) ?>" class="img-responsive pm-footer-logo" /></a>
                            </div>
                        
                        <?php endif; ?>   
                        
                        <?php if($displayFooterStats === 'on') : ?>
                        
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <ul class="pm-footer-stats">
                                    <li><p><?php echo esc_attr($statInfo1); ?></p></li>
                                    <li><p><?php echo esc_attr($statInfo2); ?></p></li>
                                </ul>
                            </div>
                        
                        <?php endif; ?>   
                        
                    </div>
                    
                    <?php if($displayFooterLogo === 'on' || $displayFooterStats === 'on') : ?>
                        <div class="pm-footer-column-divider top"></div>
                    <?php endif; ?>                           
                    
                    <?php if($toggle_footerWidgets === 'on') : ?>
                    
                        <div class="row">
                    
                            <!-- Widget layouts -->   
                        
                            <?php if($footerLayout == 'footer-three-wide-left') { ?>
                            
								  <?php if( 
                                  is_active_sidebar( 'pm_ln_footer_column1_widget' ) || 
                                  is_active_sidebar( 'pm_ln_footer_column2_widget' ) || 
                                  is_active_sidebar( 'pm_ln_footer_column3_widget' ) || 
                                  is_active_sidebar( 'pm_ln_footer_column4_widget' )
                                  ) : ?>
                                  
                                    <div class="col-lg-6 col-md-6 col-sm-6 pm-widget-footer"> 
                                        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("pm_ln_footer_column1_widget")) ; ?>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 pm-widget-footer">
                                        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("pm_ln_footer_column2_widget")) ; ?>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 pm-widget-footer">
                                        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("pm_ln_footer_column3_widget")) ; ?>
                                    </div>
                                  
                                  <?php endif; ?>
                                                
                            <?php } ?>
                            
                            <?php if($footerLayout == 'footer-three-wide-right') { ?>
                            
                            	<?php if( 
                                  is_active_sidebar( 'pm_ln_footer_column1_widget' ) || 
                                  is_active_sidebar( 'pm_ln_footer_column2_widget' ) || 
                                  is_active_sidebar( 'pm_ln_footer_column3_widget' ) || 
                                  is_active_sidebar( 'pm_ln_footer_column4_widget' )
                                  ) : ?>
                                  
                                  	<div class="col-lg-3 col-md-3 col-sm-3 pm-widget-footer">
										<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("pm_ln_footer_column1_widget")) ; ?>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 pm-widget-footer">
                                        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("pm_ln_footer_column2_widget")) ; ?>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pm-widget-footer">
                                        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("pm_ln_footer_column3_widget")) ; ?>
                                    </div>
                                  
                                  <?php endif; ?>
                                                
                            <?php } ?>
                            
                            <?php if($footerLayout == 'footer-one-column') { ?>
                            
                            	<?php if( 
                                  is_active_sidebar( 'pm_ln_footer_column1_widget' ) || 
                                  is_active_sidebar( 'pm_ln_footer_column2_widget' ) || 
                                  is_active_sidebar( 'pm_ln_footer_column3_widget' ) || 
                                  is_active_sidebar( 'pm_ln_footer_column4_widget' )
                                  ) : ?>
                                  
                                      <div class="col-lg-12 pm-widget-footer">
                                        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("pm_ln_footer_column1_widget")) ; ?>
                                    </div>
                                  
                                  <?php endif; ?>
                                                
                            <?php } ?>
                            
                            <?php if($footerLayout == 'footer-two-columns') { ?>
                            
                            	<?php if( 
                                  is_active_sidebar( 'pm_ln_footer_column1_widget' ) || 
                                  is_active_sidebar( 'pm_ln_footer_column2_widget' ) || 
                                  is_active_sidebar( 'pm_ln_footer_column3_widget' ) || 
                                  is_active_sidebar( 'pm_ln_footer_column4_widget' )
                                  ) : ?>
                                  
                                  	<div class="col-lg-6 col-md-6 col-sm-6 pm-widget-footer">
										<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("pm_ln_footer_column1_widget")) ; ?>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pm-widget-footer">
                                        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("pm_ln_footer_column2_widget")) ; ?>
                                    </div>
                                  
                                  <?php endif; ?>
                                                
                            <?php } ?>
                        
                            <?php if($footerLayout == 'footer-three-columns') { ?>
                            
                            	<?php if( 
                                  is_active_sidebar( 'pm_ln_footer_column1_widget' ) || 
                                  is_active_sidebar( 'pm_ln_footer_column2_widget' ) || 
                                  is_active_sidebar( 'pm_ln_footer_column3_widget' ) || 
                                  is_active_sidebar( 'pm_ln_footer_column4_widget' )
                                  ) : ?>
                                  
                                  	<div class="col-lg-4 col-md-4 col-sm-4 pm-widget-footer">
										<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("pm_ln_footer_column1_widget")) ; ?>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 pm-widget-footer">
                                        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("pm_ln_footer_column2_widget")) ; ?>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 pm-widget-footer">
                                        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("pm_ln_footer_column3_widget")) ; ?>
                                    </div>
                                  
                                  <?php endif; ?>
                                                
                            <?php } ?>
                            
                            <?php if($footerLayout == 'footer-four-columns') { ?>
                            
                            	<?php if( 
                                  is_active_sidebar( 'pm_ln_footer_column1_widget' ) || 
                                  is_active_sidebar( 'pm_ln_footer_column2_widget' ) || 
                                  is_active_sidebar( 'pm_ln_footer_column3_widget' ) || 
                                  is_active_sidebar( 'pm_ln_footer_column4_widget' )
                                  ) : ?>
                                  
                                  	<div class="col-lg-3 col-md-3 col-sm-12 pm-widget-footer">
                                        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("pm_ln_footer_column1_widget")) ; ?>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 pm-widget-footer">
                                        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("pm_ln_footer_column2_widget")) ; ?>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 pm-widget-footer">
                                        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("pm_ln_footer_column3_widget")) ; ?>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 pm-widget-footer">
                                        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("pm_ln_footer_column4_widget")) ; ?>
                                    </div>
                                  
                                  <?php endif; ?>
                            
                            <?php } ?>
                            
                            <!-- Widget layouts end -->  
                            
                        </div><!-- end of footer widgets -->
                    
                    <?php endif; ?>    
                
                        <?php if($displayBusinessInfo !== 'off' || $displayLoginButton !== 'off' || $displayCopyright !== 'off') : ?>
                        <div class="row pm-footer-contact-row">
                        
                        	<div class="col-lg-7 col-md-7 col-sm-12">
                                <ul class="pm-footer-contact-list">
                                
                                    <?php if($displayBusinessInfo === 'on') : ?>
                                    
                                    	
                                    
                                        <li><p> <?php echo $businessPhoneIcon !== '' ? '<span><i class="'. esc_attr($businessPhoneIcon) .'"></i></span>' : '' ?>  <?php echo esc_attr($businessPhone); ?></p></li>
                                        <li><p> <?php echo $businessEmailIcon !== '' ? '<span><i class="'. esc_attr($businessEmailIcon) .'"></i></span>' : '' ?> <a href="mailto:<?php echo esc_attr($businessEmail); ?>"><?php echo esc_attr($businessEmail); ?></a></p></li>
                                    <?php endif; ?>
                                    
                                    <?php if($displayLoginButton === 'on') : ?>
                                    
                                    	<?php if( !is_user_logged_in() ) : ?>
                                    
                                        	<li><p><span><i class="fa fa-user"></i></span> <a href="#" class="pm-mobile-login-trigger"><?php esc_html_e('Client Login', 'luxortheme') ?></a></p></li>
                                        
                                        <?php endif; ?>    
                                        
                                    <?php endif; ?>                                
                                    
                                </ul>
                            </div>
                        
                        <?php endif; ?>
                        
                        
                        
                        <?php if($displayCopyright === 'on') : ?>
                        
                            <div class="col-lg-5 col-md-5 col-sm-12">
                        
                                <?php 
                                
                                    if($copyrightInfo !== ''){ ?>
                                        <p class="pm-footer-copyright"><span>&copy;</span> <?php echo date('Y'); ?> <?php echo $copyrightInfo; ?></p>
                                    <?php } else { ?>
                                        <p class="pm-footer-copyright"><span>&copy;</span> <?php echo date('Y'); ?> <?php bloginfo('name');  ?></p>
                                    <?php }
                                
                                ?>
                            
                            </div>
                            
                        </div>
                        <?php endif; ?>                       
                    
                    <?php if($toggle_footerNav === 'on' || $toggle_footer_socialIcons === 'on') : ?>
                    	<div class="pm-footer-column-divider bottom"></div>
                    <?php endif; ?>       
                    
                    <div class="row">
                    
                        <?php if($toggle_footerNav === 'on') : ?>
                        
                            <div class="col-lg-7 col-md-7 col-sm-12">
                        
                                <?php 
                                    
                                    wp_nav_menu(array(
                                        'container' => '',
                                        'container_class' => '',
                                        'menu_class' => 'pm-footer-navigation',
                                        'menu_id' => '',
                                        'theme_location' => 'footer_menu',
                                        'fallback_cb' => 'pm_ln_footer_menu',
                                       )
                                    );
                                    
                                ?>
                            
                            </div>
                        
                        <?php endif; ?>
                        
                        <?php if($toggle_footer_socialIcons === 'on') : ?>
                        
                            <div class="col-lg-5 col-md-5 col-sm-12">
                                <ul class="pm-footer-social-icons">
                                
                                	<li><p><?php esc_html_e('Follow Us', 'luxortheme'); ?></p></li>
                                    
                                    <?php if($facebooklink !== '') : ?>
            
                                        <li <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Facebook', 'luxortheme') .'"' : '' ?> class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top pm_tip_arrow_bottom' : '' ?>" data-tip-offset-x="21" data-tip-offset-y="-20"><a class="fa fa-facebook" href="<?php echo esc_html($facebooklink); ?>" target="_blank"></a></li>
                                    
                                    <?php endif; ?>
                                    
                                    <?php if($twitterlink !== '') : ?>
                                    
                                        <li <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Twitter', 'luxortheme') .'"' : '' ?> class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top pm_tip_arrow_bottom' : '' ?>" data-tip-offset-x="12" data-tip-offset-y="-20"><a class="fa fa-twitter" href="<?php echo esc_html($twitterlink); ?>" target="_blank"></a></li>
                                    
                                    <?php endif; ?>
                                    
                                    <?php if($googlelink !== '') : ?>
                                    
                                        <li <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Google Plus', 'luxortheme') .'"' : '' ?> class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top pm_tip_arrow_bottom' : '' ?>" data-tip-offset-x="27" data-tip-offset-y="-20"><a class="fa fa-google-plus" href="<?php echo esc_html($googlelink); ?>" target="_blank"></a></li>
                                    
                                    <?php endif; ?>
                                    
                                    <?php if($linkedinLink !== '') : ?>
                                    
                                        <li <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Linkedin', 'luxortheme') .'"' : '' ?> class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top pm_tip_arrow_bottom' : '' ?>" data-tip-offset-x="11" data-tip-offset-y="-20"><a class="fa fa-linkedin" href="<?php echo esc_html($linkedinLink); ?>" target="_blank"></a></li>
                                    
                                    <?php endif; ?>
                                    
                                    <?php if($vimeolink !== '') : ?>
                                    
                                        <li <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Vimeo', 'luxortheme') .'"' : '' ?> class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top pm_tip_arrow_bottom' : '' ?>" data-tip-offset-x="11" data-tip-offset-y="-20"><a class="fa fa-vimeo-square" href="<?php echo esc_html($vimeolink); ?>" target="_blank"></a></li>
                                    
                                    <?php endif; ?>
                                    
                                    <?php if($youtubelink !== '') : ?>
                                    
                                        <li <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Youtube', 'luxortheme') .'"' : '' ?> class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top pm_tip_arrow_bottom' : '' ?>" data-tip-offset-x="18" data-tip-offset-y="-20"><a class="fa fa-youtube" href="<?php echo esc_html($youtubelink); ?>" target="_blank"></a></li>
                                    
                                    <?php endif; ?>
                                    
                                    <?php if($dribbblelink !== '') : ?>
                                    
                                        <li <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Dribbble', 'luxortheme') .'"' : '' ?> class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top pm_tip_arrow_bottom' : '' ?>" data-tip-offset-x="17" data-tip-offset-y="-20"><a class="fa fa-dribbble" href="<?php echo esc_html($dribbblelink); ?>" target="_blank"></a></li>
                                    
                                    <?php endif; ?>
                                    
                                    <?php if($pinterestlink !== '') : ?>
                                    
                                        <li <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Pinterest', 'luxortheme') .'"' : '' ?> class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top pm_tip_arrow_bottom' : '' ?>" data-tip-offset-x="19" data-tip-offset-y="-20"><a class="fa fa-pinterest" href="<?php echo esc_html($pinterestlink); ?>" target="_blank"></a></li>
                                    
                                    <?php endif; ?>
                                    
                                    <?php if($instagramlink !== '') : ?>
                                    
                                        <li <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Instagram', 'luxortheme') .'"' : '' ?> class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top pm_tip_arrow_bottom' : '' ?>" data-tip-offset-x="20" data-tip-offset-y="-20"><a class="fa fa-instagram" href="<?php echo esc_html($instagramlink); ?>" target="_blank"></a></li>
                                    
                                    <?php endif; ?>
                                    
                                    <?php if($skypelink !== '') : ?>
                                    
                                        <li <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Skype', 'luxortheme') .'"' : '' ?> class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top pm_tip_arrow_bottom' : '' ?>" data-tip-offset-x="11" data-tip-offset-y="-20"><a class="fa fa-skype" href="skype:<?php echo esc_attr($skypelink); ?>?call"></a></li>
                                    
                                    <?php endif; ?>
                                    
                                    <?php if($flickrlink !== '') : ?>
                                    
                                        <li <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Flickr', 'luxortheme') .'"' : '' ?> class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top pm_tip_arrow_bottom' : '' ?>" data-tip-offset-x="11" data-tip-offset-y="-20"><a class="fa fa-flickr" href="<?php echo esc_html($flickrlink); ?>" target="_blank"></a></li>
                                    
                                    <?php endif; ?>
                                    
                                    <?php if($tumblrlink !== '') : ?>
                                    
                                        <li <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Tumblr', 'luxortheme') .'"' : '' ?> class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top pm_tip_arrow_bottom' : '' ?>" data-tip-offset-x="11" data-tip-offset-y="-20"><a class="fa fa-tumblr" href="<?php echo esc_html($tumblrlink); ?>" target="_blank"></a></li>
                                    
                                    <?php endif; ?>
                                    
                                    <?php if($stumbleuponlink !== '') : ?>
                                    
                                        <li <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('StumbleUpon', 'luxortheme') .'"' : '' ?> class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top pm_tip_arrow_bottom' : '' ?>" data-tip-offset-x="32" data-tip-offset-y="-20"><a class="fa fa-stumbleupon" href="<?php echo esc_html($stumbleuponlink); ?>" target="_blank"></a></li>
                                    
                                    <?php endif; ?>
                                    
                                    <?php if($redditlink !== '') : ?>
                                    
                                        <li <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Reddit', 'luxortheme') .'"' : '' ?> class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top pm_tip_arrow_bottom' : '' ?>" data-tip-offset-x="11" data-tip-offset-y="-20"><a class="fa fa-reddit" href="<?php echo esc_html($redditlink); ?>" target="_blank"></a></li>
                                    
                                    <?php endif; ?>
                                    
                                    <?php if($rssLink !== '') : ?>
                                    
                                        <li <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('RSS Feed', 'luxortheme') .'"' : '' ?> class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top pm_tip_arrow_bottom' : '' ?>" data-tip-offset-x="11" data-tip-offset-y="-20"><a class="fa fa-rss" href="<?php echo esc_html($rssLink); ?>" target="_blank"></a></li>
                                        
                                    <?php endif; ?>
                                    
                                </ul>
                            </div>
                        
                        <?php endif; ?>
                    
                    </div>
                    
                </div>
                
            </div>
            
        </footer>
      
        <?php endif;//end $toggle_footer ?>
        
        </div><!-- /pm_layout_wrapper -->
        
        <?php wp_footer(); ?> 
    </body>
</html>