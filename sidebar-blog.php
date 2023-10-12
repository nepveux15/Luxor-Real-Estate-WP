<?php if( is_active_sidebar( 'pm_ln_blog_page_widget' ) ) : ?>
       
   <div class="col-lg-4 col-md-4 col-sm-12 pm-sidebar" id="pm-sidebar">
        <div class="pm-widget">
            <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('pm_ln_blog_page_widget') ) : ?>
            <?php endif; ?>
        </div>
    </div><!-- /.col -->
          
<?php endif; ?>