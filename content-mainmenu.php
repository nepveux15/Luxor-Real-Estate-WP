<?php 

$menuLogo = get_theme_mod('menuLogo');
$companyLogoAltTag = get_theme_mod('companyLogoAltTag', '');
$companyLogoURL = get_theme_mod('companyLogoURL', '');

$enableSearch = get_theme_mod('enableSearch', 'on');
$searchFieldText = get_theme_mod('searchFieldText', 'Search Articles...');

$enableMenuSocialIcons = get_theme_mod('enableMenuSocialIcons', 'on');
$enableTooltip = get_theme_mod('enableTooltip', 'on');

//Business Info
$businessPhone = get_theme_mod('businessPhone', '');
$businessEmail = get_theme_mod('businessEmail', '');
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

$headerNavigationMode = get_theme_mod('headerNavigationMode', 'minimized');

?>

<!-- Main slide out menu -->
  <div class="pm-mobile-menu-overlay" id="pm-mobile-menu-overlay"></div>
  <div class="pm-mobile-menu-hover-close-btn" id="pm-mobile-menu-hover-close-btn"><i class="fa fa-close"></i></div>
  
  <div class="pm-mobile-global-menu" id="pm-mobile-global-menu">
  
    
    <div class="pm-mobile-global-menu-logo">
        <a href="<?php echo esc_attr($companyLogoURL) !== '' ? esc_html($companyLogoURL) : site_url() ?>"><img src="<?php echo esc_attr($menuLogo) !== '' ? esc_html($menuLogo) : get_template_directory_uri() . '/img/luxor-realty.png'; ?>" alt="<?php echo esc_attr($companyLogoAltTag); ?>" class="img-responsive"></a> 
    </div>
    
    
    <?php if($enableMenuSocialIcons === 'on') : ?>
    
    	<ul class="pm-global-menu-social-icons">
        
        	<?php if($facebooklink !== '') : ?>
            
            	<li <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Facebook', 'luxortheme') .'"' : '' ?> class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top pm_tip_arrow_bottom' : '' ?>" data-tip-offset-x="20" data-tip-offset-y="-15"><a class="fa fa-facebook" href="<?php echo esc_html($facebooklink); ?>" target="_blank"></a></li>
            
            <?php endif; ?>
            
            <?php if($twitterlink !== '') : ?>
            
            	<li <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Twitter', 'luxortheme') .'"' : '' ?> class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top pm_tip_arrow_bottom' : '' ?>" data-tip-offset-x="11" data-tip-offset-y="-15"><a class="fa fa-twitter" href="<?php echo esc_html($twitterlink); ?>" target="_blank"></a></li>
            
            <?php endif; ?>
            
            <?php if($googlelink !== '') : ?>
            
            	<li <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Google Plus', 'luxortheme') .'"' : '' ?> class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top pm_tip_arrow_bottom' : '' ?>" data-tip-offset-x="21" data-tip-offset-y="-15"><a class="fa fa-google-plus" href="<?php echo esc_html($googlelink); ?>" target="_blank"></a></li>
            
            <?php endif; ?>
            
            <?php if($linkedinLink !== '') : ?>
            
            	<li <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Linkedin', 'luxortheme') .'"' : '' ?> class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top pm_tip_arrow_bottom' : '' ?>" data-tip-offset-x="11" data-tip-offset-y="-15"><a class="fa fa-linkedin" href="<?php echo esc_html($linkedinLink); ?>" target="_blank"></a></li>
            
            <?php endif; ?>
            
            <?php if($vimeolink !== '') : ?>
            
            	<li <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Vimeo', 'luxortheme') .'"' : '' ?> class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top pm_tip_arrow_bottom' : '' ?>" data-tip-offset-x="11" data-tip-offset-y="-15"><a class="fa fa-vimeo-square" href="<?php echo esc_html($vimeolink); ?>" target="_blank"></a></li>
            
            <?php endif; ?>
            
            <?php if($youtubelink !== '') : ?>
            
            	<li <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Youtube', 'luxortheme') .'"' : '' ?> class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top pm_tip_arrow_bottom' : '' ?>" data-tip-offset-x="11" data-tip-offset-y="-15"><a class="fa fa-youtube" href="<?php echo esc_html($youtubelink); ?>" target="_blank"></a></li>
            
            <?php endif; ?>
            
            <?php if($dribbblelink !== '') : ?>
            
            	<li <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Dribbble', 'luxortheme') .'"' : '' ?> class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top pm_tip_arrow_bottom' : '' ?>" data-tip-offset-x="17" data-tip-offset-y="-15"><a class="fa fa-dribbble" href="<?php echo esc_html($dribbblelink); ?>" target="_blank"></a></li>
            
            <?php endif; ?>
            
            <?php if($pinterestlink !== '') : ?>
            
            	<li <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Pinterest', 'luxortheme') .'"' : '' ?> class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top pm_tip_arrow_bottom' : '' ?>" data-tip-offset-x="19" data-tip-offset-y="-15"><a class="fa fa-pinterest" href="<?php echo esc_html($pinterestlink); ?>" target="_blank"></a></li>
            
            <?php endif; ?>
            
            <?php if($instagramlink !== '') : ?>
            
            	<li <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Instagram', 'luxortheme') .'"' : '' ?> class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top pm_tip_arrow_bottom' : '' ?>" data-tip-offset-x="20" data-tip-offset-y="-15"><a class="fa fa-instagram" href="<?php echo esc_html($instagramlink); ?>" target="_blank"></a></li>
            
            <?php endif; ?>
            
            <?php if($skypelink !== '') : ?>
            
            	<li <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Skype', 'luxortheme') .'"' : '' ?> class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top pm_tip_arrow_bottom' : '' ?>" data-tip-offset-x="11" data-tip-offset-y="-15"><a class="fa fa-skype" href="skype:<?php echo esc_attr($skypelink); ?>?call"></a></li>
            
            <?php endif; ?>
            
            <?php if($flickrlink !== '') : ?>
            
            	<li <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Flickr', 'luxortheme') .'"' : '' ?> class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top pm_tip_arrow_bottom' : '' ?>" data-tip-offset-x="11" data-tip-offset-y="-15"><a class="fa fa-flickr" href="<?php echo esc_html($flickrlink); ?>" target="_blank"></a></li>
            
            <?php endif; ?>
            
            <?php if($tumblrlink !== '') : ?>
            
            	<li <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Tumblr', 'luxortheme') .'"' : '' ?> class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top pm_tip_arrow_bottom' : '' ?>" data-tip-offset-x="11" data-tip-offset-y="-15"><a class="fa fa-tumblr" href="<?php echo esc_html($tumblrlink); ?>" target="_blank"></a></li>
            
            <?php endif; ?>
            
            <?php if($stumbleuponlink !== '') : ?>
            
            	<li <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('StumbleUpon', 'luxortheme') .'"' : '' ?> class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top pm_tip_arrow_bottom' : '' ?>" data-tip-offset-x="32" data-tip-offset-y="-15"><a class="fa fa-stumbleupon" href="<?php echo esc_html($stumbleuponlink); ?>" target="_blank"></a></li>
            
            <?php endif; ?>
            
            <?php if($redditlink !== '') : ?>
            
            	<li <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Reddit', 'luxortheme') .'"' : '' ?> class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top pm_tip_arrow_bottom' : '' ?>" data-tip-offset-x="11" data-tip-offset-y="-15"><a class="fa fa-reddit" href="<?php echo esc_html($redditlink); ?>" target="_blank"></a></li>
            
            <?php endif; ?>
            
            <?php if($rssLink !== '') : ?>
            
            	<li <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('RSS Feed', 'luxortheme') .'"' : '' ?> class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top pm_tip_arrow_bottom' : '' ?>" data-tip-offset-x="11" data-tip-offset-y="-15"><a class="fa fa-rss" href="<?php echo esc_html($rssLink); ?>" target="_blank"></a></li>
            	
            <?php endif; ?>
            
        </ul>
        
    <?php endif; ?>    
    
    <?php if( function_exists( 'is_shop' ) ) : ?>
    	
        <?php global $woocommerce; ?>
    
    	<ul class="pm-cart-info">
        	<li><a href="<?php echo site_url('cart'); ?>" class="typcn typcn-shopping-cart"></a></li>
            <li><p>(<span class="pm-nav-cart-item-count"><?php echo $woocommerce->cart->cart_contents_count; ?></span>) <span class="pm-nav-cart-total"><?php echo $woocommerce->cart->get_cart_total(); ?></span></p></li>
            
        </ul>

    
    <?php endif; ?>
    
    <!-- Registration menu -->        
    <div class="pm-mobile-global-registration-container">
    
        <div class="pm-register-message">
            <p><?php esc_html_e('Use the form below to register your account.', 'luxortheme'); ?></p>
        </div>
        
        <div class="pm-mobile-global-registration-fields">
        
            <form action="#" method="post" id="pm-ajax-registration-form">
                <input name="pm_register_first_name" id="pm_user_first_name" type="text" class="pm-login-field" placeholder="<?php esc_html_e('First Name', 'luxortheme'); ?>">
                <input name="pm_register_last_name" id="pm_user_last_name" type="text" class="pm-login-field" placeholder="<?php esc_html_e('Last Name', 'luxortheme'); ?>">
                <input name="pm_register_email_address" id="pm_user_email" type="text" class="pm-login-field" placeholder="<?php esc_html_e('Email Address', 'luxortheme'); ?>">
                <input name="pm_register_username" id="pm_username" type="text" class="pm-login-field" placeholder="<?php esc_html_e('Username', 'luxortheme'); ?>">
                <input name="pm_register_password" id="pm_user_password" type="password" class="pm-login-field" placeholder="<?php esc_html_e('Password', 'luxortheme'); ?>">
                <input name="pm_register_confirm_password" id="pm_user_confirm_password" type="password" class="pm-login-field" placeholder="<?php esc_html_e('Confirm Password', 'luxortheme'); ?>">
                
                <!-- Security question goes here -->  
                <?php 
					$randNum1 = rand(5, 15);
					$randNum2 = rand(5, 15);
				?>
				
				<p class="pm-form-security-question"><?php esc_attr_e('Security question', 'luxortheme') ?>: </p>
				<div class="form-group security-question">		
					<p class="pm-form-security-question-input"><strong><?php echo esc_attr($randNum1); ?></strong> + <strong><?php echo  esc_attr($randNum2); ?></strong> = <input type="text" maxlength="2" class="pm-form-textfield security-field" name="pm_form_security_question" id="pm_form_security_question" /></p>
				</div>
				
				<input type="hidden" value="<?php echo esc_attr($randNum1) + esc_attr($randNum2) ?>" id="pm_form_security_answer" name="pm_form_security_answer">
                           
                                
            </form>
            
            <div class="result-message"></div>
            
            <p><a href="#" id="pm-register-account-btn"> <?php esc_html_e('Register Account', 'luxortheme'); ?> <i class="fa fa-user"></i></a></p>
            
        </div>
        
    </div>
    <!-- Registration menu end -->
    
    <!-- Sign in menu -->        
    <div class="pm-mobile-global-sign-in-container">
    
        <div class="pm-register-message">
            <p><?php esc_html_e('Insert your credentials below to access your account.', 'luxortheme'); ?></p>
        </div>
        
        <div class="pm-mobile-global-sign-in-fields">
            <form action="#" method="post">
                <input name="pm_username" id="pm_quick_username" type="text" class="pm-login-field" maxlength="40" placeholder="<?php esc_html_e('Username', 'luxortheme'); ?>">
                <input name="pm_password" id="pm_quick_password" type="password" class="pm-login-field" maxlength="40" placeholder="<?php esc_html_e('Password', 'luxortheme'); ?>">
                
                <!-- Security question goes here -->  
                <?php 
					$randNum1 = rand(5, 15);
					$randNum2 = rand(5, 15);
				?>
				
				<p class="pm-form-security-question"><?php esc_attr_e('Security question', 'luxortheme') ?>: </p><br>
				<div class="form-group security-question">		
					<p class="pm-form-security-question-input"><strong><?php echo esc_attr($randNum1); ?></strong> + <strong><?php echo  esc_attr($randNum2); ?></strong> = <input type="text" maxlength="2" class="pm-form-textfield security-field" name="pm_login_form_security_question" id="pm_login_form_security_question" /></p>
				</div>
				
				<input type="hidden" value="<?php echo esc_attr($randNum1) + esc_attr($randNum2) ?>" id="pm_login_form_security_answer" name="pm_login_form_security_answer">
                
            </form>
            
            <div id="pm-quick-message"></div>
            
            <p><a href="#" id="btn-quick-login"><?php esc_html_e('Sign in', 'luxortheme'); ?></a></p>
            
            <?php $pm_members_forgot_password_template_slug = get_option('pm_members_forgot_password_template_slug'); ?>
            <p><a href="<?php echo esc_attr($pm_members_forgot_password_template_slug); ?>" id="forgot-password-btn"><?php esc_html_e('Forgot Password?', 'luxortheme'); ?></a></p>
            
        </div>
        
    </div>
    <!-- Sign in menu end -->        
        
    <!-- Main navigation menu -->        
    <div class="pm-mobile-global-menu-container active">
    
        <?php if($enableSearch === 'on') : ?>
        
        	<div class="pm-mobile-global-menu-search">
                <form method="get" id="searchformenu" action="<?php echo home_url( '/' ); ?>">
                    <input name="s" type="text" class="pm-search-field-mobile" placeholder="<?php echo esc_attr($searchFieldText); ?>">
                </form>
            </div>
        
        <?php endif; ?>
        
        <?php 
                                    
			wp_nav_menu(array(
				'container' => '',
				'container_class' => '',
				'menu_class' => 'sf-menu pm-nav',
				'menu_id' => '',
				'theme_location' => 'main_menu',
				'fallback_cb' => 'pm_ln_main_menu',
			   )
			);
			
		?>
            
    </div><!-- /.pm-mobile-global-menu-container -->
    
    <!-- Main navigation menu end -->        
        
  </div>
  <!-- /.pm-mobile-global-menu -->