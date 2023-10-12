<?php /* Template Name: Members Logout Template */ ?>
<?php get_header(); ?>

<?php 
	
	$membersAreaSlug = get_option('pm_members_area_template_slug');
	
	//Are we logged in?
	if ( is_user_logged_in() ) {
		
		//redirect to members area page
		wp_redirect( site_url($membersAreaSlug) );
		exit;	
		
	}
	
	$getBootstrapContainerPadding = get_post_meta(get_the_ID(), 'pm_bootstrap_container_padding_meta', true);
	$bootstrapContainerPadding = $getBootstrapContainerPadding !== '' ? $getBootstrapContainerPadding : '80';
	
?>

<div class="container pm-containerPadding<?php echo esc_attr($bootstrapContainerPadding); ?>">
    <div class="row">
        <div class="col-lg-12">
        
        	<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
				<?php the_content(); ?>
            <?php endwhile; else: ?>
                <p><?php echo esc_html_e('You have successfully signed out of your account.', 'luxortheme'); ?></p>
            <?php endif; ?>
        
        </div>
    </div>                 
</div>

<?php get_footer(); ?>