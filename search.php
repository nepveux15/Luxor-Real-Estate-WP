<?php get_header(); ?>
<div class="container pm-containerPadding100">
    <div class="row">
    
    	<div class="col-lg-12 col-md-12 col-sm-12 pm-news-posts-container">
        
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                                         
                <?php get_template_part( 'content', 'post' ); ?>
            
            <?php endwhile; else: ?>
            
            	<p class="pm-search-error"><?php esc_html_e('Your search entry for', 'luxortheme'); ?> <span>"<?php echo get_search_query(); ?>"</span> <?php esc_html_e('yielded no results.', 'luxortheme'); ?> </p>
                
                <br />

                <p><?php esc_html_e('Try a new search query:', 'luxortheme'); ?></p>
                                
                <form action="<?php echo home_url( '/' ); ?>" method="get" id="search-form-page">
                    <input class="pm-form-textfield-with-icon" type="text" name="s" placeholder="<?php esc_html_e('Type keywords...', 'luxortheme') ?>">

                    <!--<input name="pm-email-field" type="text" class="pm-form-textfield-with-icon" placeholder="email address">-->
                    <br /><br />
                    <input name="" type="button" class="comment-reply-link" id="pm-search-submit-page" value="<?php esc_html_e('Search', 'luxortheme') ?>">
                </form>
                 
            <?php endif; ?> 
            
            <?php get_template_part( 'content', 'pagination' ); ?>
        
        </div>
    </div>
</div>
<?php get_footer(); ?>