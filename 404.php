<?php get_header(); ?>

<div class="container pm-containerPadding100">
    <div class="row">
		
        <div class="col-lg-12"> 
        
        	<p class="pm-404-error"><?php esc_html_e("The page you we're looking could not be found.", 'luxortheme'); ?></p>
            
            <p><?php esc_html_e("Check the URL entered and ensure it is correct.", 'luxortheme'); ?></p>
            <br />
            <a class="pm-square-btn no-border" href="<?php echo site_url(); ?>"><?php esc_html_e("Return home", 'luxortheme'); ?> </a>
            
		</div>
        
	</div>
</div>

<?php get_footer(); ?>