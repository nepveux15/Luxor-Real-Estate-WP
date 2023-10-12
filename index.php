<?php /* Template Name: Blog Template */ ?>
<?php get_header(); ?>

<?php 
$homepageLayout = get_theme_mod('homepageLayout', 'no-sidebar');

?>

<div class="container pm-containerPadding-top-110 pm-containerPadding-bottom-90">
    <div class="row">

		<?php if($homepageLayout === 'no-sidebar') { ?>
        
        	<div class="col-lg-12 col-md-12 col-sm-12 pm-news-posts-container">
            
				<?php if (have_posts ()) { while (have_posts ()) { (the_post()); ?>
                
                    <?php get_template_part( 'content', 'post' ); ?>
                
                <?php }//end of posts ?>
        
                <?php } else { ?>
                     <p><?php esc_html_e('No posts were found.', 'luxortheme'); ?></p>
                <?php } ?> 
                
                <?php get_template_part( 'content', 'pagination' ); ?>
            
            </div>
        
        <?php } else if($homepageLayout === 'right-sidebar') {?>
                
            <!-- Retrive right sidebar post template -->
            <div class="col-lg-8 col-md-8 col-sm-12 pm-news-posts-container">
            
				<?php if (have_posts ()) { while (have_posts ()) { (the_post()); ?>
                
                    <?php get_template_part( 'content', 'post' ); ?>
                
                <?php }//end of posts ?>
        
                <?php } else { ?>
                     <p><?php esc_html_e('No posts were found.', 'luxortheme'); ?></p>
                <?php } ?> 
                
                <?php get_template_part( 'content', 'pagination' ); ?>
            
            </div>
            
             <!-- Right Sidebar -->
             <?php get_sidebar('home'); ?>
             <!-- /Right Sidebar -->
        
        <?php } else if($homepageLayout === 'left-sidebar') { ?>
                
        	 <!-- Left Sidebar -->
             <?php get_sidebar('home'); ?>
             <!-- /Left Sidebar -->
        
            <!-- Retrive right sidebar post template -->
            <div class="col-lg-8 col-md-8 col-sm-12 pm-news-posts-container">
            
				<?php if (have_posts ()) { while (have_posts ()) { (the_post()); ?>
                
                    <?php get_template_part( 'content', 'post' ); ?>
                
                <?php }//end of posts ?>
        
                <?php } else { ?>
                     <p><?php esc_html_e('No posts were found.', 'luxortheme'); ?></p>
                <?php } ?> 
                
                <?php get_template_part( 'content', 'pagination' ); ?>
            
            </div>
                    
        <?php } else {//default full width layout ?>
        
        	<div class="col-lg-12 col-md-12 col-sm-12 pm-news-posts-container">
            
				<?php if (have_posts ()) { while (have_posts ()) { (the_post()); ?>
                
                    <?php get_template_part( 'content', 'post' ); ?>
                
                <?php }//end of posts ?>
        
                <?php } else { ?>
                     <p><?php esc_html_e('No posts were found.', 'luxortheme'); ?></p>
                <?php } ?> 
                
                <?php get_template_part( 'content', 'pagination' ); ?>
            
            </div>
        
        <?php }  ?>
    
	</div> <!-- /row -->
</div> <!-- /container -->
<?php get_footer(); ?>