<?php
/**
 * The default template for displaying a single post.
 */
?>

<?php 

	 //$category = get_the_category();
	 $categories = wp_get_post_categories(get_the_id());
	 
	 $num_comments = get_comments_number();
	 $comments = '';
	 
	 if ( has_post_thumbnail()) {
	   $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
	 }
	 
	 $post_classes = array(
		'pm-column-spacing',
		'news-post',
	 );

	$likes = get_post_meta(get_the_ID(), 'pm_total_likes', true);
	              
?>

<article <?php post_class(); ?>>
    
    <?php if ( has_post_thumbnail()) : ?>
    
    	<div class="pm-news-post-img-container">
        
        	<?php if( is_sticky() ) : ?>
 				
                <div class="pm-news-post-sticky-icon-container">
                	<i class="fa fa-thumb-tack"></i>
                </div>
                
            <?php endif; ?>
                   
            <div class="pm-news-post-category-container">
                <?php 
         
                    foreach ( $categories as $category ) {
                        $cat = get_category( $category );
                        echo '<a href="'.get_category_link( $cat->term_id ).'" class="pm-news-post-category-link">'.$cat->cat_name.'</a>';	
                    }
                 
                ?>
                <a href="<?php the_permalink(); ?>" class="pm-news-post-details-link fa fa-bars"></a>
            </div>
            <img src="<?php echo esc_html($image_url[0]) ?>" alt="<?php the_title(); ?>" />
        </div>
    
    <?php endif; ?>
        
    <div class="pm-news-post-title-container">
    
        <h2 class="pm-news-post-title">
            <?php if( is_sticky() && !has_post_thumbnail()) : ?>
                <i class="fa fa-thumb-tack pm-primary pm-sticky-icon"></i>&nbsp;
            <?php endif; ?>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>
        
        <p class="pm-news-post-date"><i class="fa fa-clock-o"></i> &nbsp;<?php the_time( 'M' ); ?> <?php the_time( 'd' ); ?>, <?php the_time( 'Y' ); ?> &nbsp; <i class="fa fa-user"></i> &nbsp;<?php the_author(); ?>
            &nbsp; <a href="#" class="fa fa-thumbs-up pm-like-this-btn" id="<?php echo get_the_ID(); ?>"></a> <span id="pm-post-total-likes-count-<?php echo get_the_ID(); ?>"><?php echo esc_attr($likes) !== '' ? esc_attr($likes) : '0'; ?></span>
        </p>
    </div>
    
    <div class="pm-news-post-divider no-margin-bottom"></div>
    
    <a href="<?php the_permalink(); ?>" class="pm-news-post-btn fa fa-arrow-circle-o-right"></a>
    
    <p class="pm-news-post-excerpt"><?php $excerpt = get_the_excerpt(); echo pm_ln_string_limit_words($excerpt, 30); ?> <a href="<?php the_permalink(); ?>">[...]</a></p>
    
    <a href="<?php the_permalink(); ?>" class="pm-news-post-btn-mobile fa fa-arrow-circle-o-right"></a>
    
    
    
</article>