<?php 

	$enableLoginBtn = get_theme_mod('enableLoginBtn', 'on');
	$enableRegisterBtn = get_theme_mod('enableRegisterBtn', 'on');
	
	$membersAccountSlug = get_option('pm_members_account_template_slug');
	$logoutURL = get_option('pm_custom_logout_url');
	
	$businessPhone = get_theme_mod('businessPhone', '1-888-555-6548');
	$businessEmail = get_theme_mod('businessEmail', 'info@luxorrealty.com');
	
?>

<!-- Floating Menu container -->
<div class="pm-float-menu-container" id="pm-float-menu-container">
    
    <ul class="pm-nav-container-icons float-menu">
    
   		<li><a href="#" class="pm-mobile-menu-trigger"><span><?php esc_html_e('Menu', 'luxortheme') ?></span> <i class="fa fa-bars"></i></a></li>
        
        <?php if ( !empty($businessPhone) ) : ?>
        
        	<li><a href="tel:<?php echo esc_html($businessPhone); ?>"><span><?php esc_html_e('Phone', 'luxortheme') ?></span> <i class="fa fa-phone"></i></a></li>
        
        <?php endif; ?>
        
        <?php if ( !empty($businessEmail) ) : ?>
        
        	<li><a href="mailto:<?php echo esc_html($businessEmail); ?>"><span><?php esc_html_e('Email', 'luxortheme') ?></span> <i class="fa fa-envelope"></i></a></li>
        
        <?php endif; ?>
        
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
<!-- Floating Menu container end -->