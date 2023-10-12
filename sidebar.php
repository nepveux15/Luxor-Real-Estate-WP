<?php 

$options = '';
$sidebar_choice = '';

if(function_exists('is_shop')){
	
	if( is_shop() ){
		$options = get_post_custom(get_option( 'woocommerce_shop_page_id' ));	
	} else {
		$options = get_post_custom($post->ID);
	}
	
} else {
	$options = get_post_custom($post->ID);
}

if(isset($options['custom_sidebar'][0])){
	$sidebar_choice = $options['custom_sidebar'][0];
}


?>

<?php if( is_active_sidebar( 'pm_ln_default_widget' ) || 
		  is_active_sidebar( 'pm_ln_home_page_widget' ) || 
		  is_active_sidebar( 'pm_ln_blog_page_widget' ) || 
		  is_active_sidebar( 'pm_ln_footer_column1_widget' ) || 
		  is_active_sidebar( 'pm_ln_footer_column2_widget' ) || 
		  is_active_sidebar( 'pm_ln_footer_column3_widget' ) || 
		  is_active_sidebar( 'pm_ln_footer_column4_widget' ) || 
		  is_active_sidebar( 'pm_ln_properties_template' )
		  ) : ?>
        
        <aside>
            <div class="col-lg-4 col-md-4 col-sm-12 pm-sidebar" id="pm-sidebar">
                <div class="pm-widget">
                    <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar($sidebar_choice) ) : ?>
                    <?php endif; ?>
                </div>
            </div><!-- /.col -->
        </aside>

<?php endif; ?>

