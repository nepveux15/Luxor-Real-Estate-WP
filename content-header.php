<?php 
$companyLogo = get_theme_mod('companyLogo');
$companyLogoAltTag = get_theme_mod('companyLogoAltTag', '');
$companyLogoURL = get_theme_mod('companyLogoURL', '');

//Header options
$enableSearch = get_theme_mod('enableSearch', 'on');
$enableLoginBtn = get_theme_mod('enableLoginBtn', 'on');
$enableRegisterBtn = get_theme_mod('enableRegisterBtn', 'on');

$searchFieldText = get_theme_mod('searchFieldText', 'Search Articles...');
$enableLanguageSelector = get_theme_mod('enableLanguageSelector', 'off');

$membersAccountSlug = get_option('pm_members_account_template_slug');
$logoutURL = get_option('pm_custom_logout_url');

$enableMenuSocialIcons = get_theme_mod('enableMenuSocialIcons', 'on');
$headerNavigationMode = get_theme_mod('headerNavigationMode', 'minimized');

$desktopNavPosition = get_theme_mod('desktopNavPosition', 'bottom');

$enableBusinessInfoHeader = get_theme_mod('enableBusinessInfoHeader', 'off');

?>

<?php if($headerNavigationMode === 'desktop' && $desktopNavPosition === 'top') : ?>

	<?php get_template_part('content', 'desktopnav'); ?>
	
<?php endif; ?>

<header>
        
    <div class="pm-logo-container">
        <a href="<?php echo esc_attr($companyLogoURL) !== '' ? esc_html($companyLogoURL) : site_url() ?>"><img src="<?php echo esc_attr($companyLogo) !== '' ? esc_html($companyLogo) : get_template_directory_uri() . '/img/luxor-realty.png'; ?>" alt="<?php echo esc_attr($companyLogoAltTag); ?>" class="img-responsive" /></a>
        
        <?php if($enableBusinessInfoHeader === 'on') : ?>
        
        	<?php 
			
				$businessPhone = get_theme_mod('businessPhone', '1-888-555-6548');
				$businessEmail = get_theme_mod('businessEmail', 'info@luxorrealty.com');
			
			?>
        
        	<ul class="pm-header-business-info-list">
            
            	<?php if($businessPhone !== '') : ?>
                
                	<li><a href="tel:<?php echo esc_html($businessPhone); ?>"><?php echo esc_html($businessPhone); ?></a></li>
                
                <?php endif; ?>
                
                
                <?php if($businessEmail !== '') : ?>
                
                	<li><a href="mailto:<?php echo esc_html($businessEmail); ?>"><?php echo esc_html($businessEmail); ?></a></li>
                
                <?php endif; ?>
                
            </ul>
        
        <?php endif; ?>
        
    </div>         
    
    <div class="pm-nav-container">
    
    	<?php if($enableSearch === 'on') : ?>
            <div class="pm-nav-search-bar-container">
                <a href="#" id="header-search-form-btn" class="pm-search-bar-btn fa fa-search pm-sidebar-search-icon-btn"></a>
                <form method="get" id="headerSearchForm" action="<?php echo home_url( '/' ); ?>">
                    <input type="text" name="s" class="pm-search-input-field" placeholder="<?php echo esc_attr($searchFieldText); ?>" />
                </form>
            </div>
        <?php endif; ?>
        
        
        <?php if($enableLanguageSelector === 'on') : ?>
            <?php pm_ln_icl_post_languages(); ?> 
        <?php endif; ?>        
        
        
        <ul class="pm-nav-container-icons">
        
            <li><a href="#" class="pm-mobile-menu-trigger"><span><?php esc_html_e('Menu', 'luxortheme') ?></span> <i class="fa fa-bars"></i></a></li>
            
            <?php if ( is_user_logged_in() ) { ?>
            
            	<?php if($membersAccountSlug !== '') : ?>
                    <li><a href="<?php echo site_url($membersAccountSlug); ?>"><span><?php esc_html_e('Account', 'luxortheme') ?></span> <i class="fa fa-user"></i></a></li>
                <?php endif; ?>
            
				<?php if($logoutURL !== '') { ?>
                    <li><a href="<?php echo wp_logout_url( site_url($logoutURL) ); ?>"><span><?php esc_html_e('Sign Out', 'luxortheme'); ?></span> <i class="fa fa-sign-in"></i></a></li>
                <?php } else { ?>
                    <li><a href="<?php echo wp_logout_url( site_url('/login/') ); ?>"><span><?php esc_html_e('Sign Out', 'luxortheme'); ?></span> <i class="fa fa-sign-in"></i></a></li>
                <?php } ?>
            
            <?php } else { ?>
            
                <?php if($enableLoginBtn === 'on') : ?>
                    <li><a href="#" class="pm-mobile-login-trigger"><span><?php esc_html_e('Sign in', 'luxortheme') ?></span> <i class="fa fa-sign-in"></i></a></li>
                <?php endif; ?>
                
                <?php if($enableRegisterBtn === 'on') : ?>
                    <li><a href="#" class="pm-mobile-registration-trigger"><span><?php esc_html_e('Register', 'luxortheme') ?></span> <i class="fa fa-user"></i></a></li>
                <?php endif; ?>
            
            <?php } ?>
            
        </ul>
    </div>      
            
</header>

<?php if($headerNavigationMode === 'desktop' && $desktopNavPosition === 'bottom') : ?>

	<?php get_template_part('content', 'desktopnav'); ?>
	
<?php endif; ?>