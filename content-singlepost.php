<?php
/**
 * The default template for displaying a single post.
 */
?>

<?php 

	 $enableTooltip = get_theme_mod('enableTooltip', 'on');

	 $categories = get_the_category();
	 
	 if ( has_post_thumbnail()) {
	   $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
	 }
	 
	$num_comments = get_comments_number(); // get_comments_number returns only a numeric value
	$comments = '';

	$displayAuthorProfile = get_theme_mod('displayAuthorProfile', 'on');
	$displaySocialFeatures = get_theme_mod('displaySocialFeatures', 'on');
	$displayRelatedPosts = get_theme_mod('displayRelatedPosts', 'on');
	$displayComments = get_theme_mod('displayComments', 'on');
	              
?>

<!-- PANEL 1 -->
<div class="container pm-containerPadding-top-110 pm-containerPadding-bottom-100">

    <div class="row">
        <div class="col-lg-12">
            
            <?php if(has_post_thumbnail()) : ?>
            
            	<!-- Post image -->
                <div class="pm-single-post-img-container">
                    <div class="pm-single-post-category-container">
                    
                    	<?php 
							foreach ( $categories as $category ) {
								$cat = get_category( $category );
								echo '<a href="'.get_category_link( $cat->term_id ).'" class="pm-single-post-category-link">'.$cat->cat_name.'</a>';	
							}
						?>
                        
                    </div>
                    <img alt="<?php the_title(); ?>" src="<?php echo esc_html($image_url[0]); ?>">
                </div>
                <!-- Post image end -->
            
            <?php endif; ?>
            
            
            <!-- Post info -->
            <div class="pm-single-post-article">
                <?php the_content(); ?>
                <?php 
    
					$pag_defaults = array(
							'before'           => '<p>' . esc_html__( 'READ MORE:', 'luxortheme' ),
							'after'            => '</p>',
							'link_before'      => '',
							'link_after'       => '',
							'next_or_number'   => 'number',
							'separator'        => ' ',
							'nextpagelink'     => '',
							'previouspagelink' => '',
							'pagelink'         => '%',
							'echo'             => 1
						);
					
					wp_link_pages($pag_defaults); 
				
				?>
            </div>
            
            <!-- Post info end -->
            
            <!-- Post info and tags -->
            <div class="pm-single-post-social-features" id="pm-single-post-social-features">
            
                <div class="pm-single-post-share-icons">
                
                    <div class="pm-single-post-share-icons-divider">
                        <div class="pm-single-post-share-icons-divider-endpoint left"></div>
                        <div class="pm-single-post-share-icons-divider-endpoint right"></div>
                    </div>
                                    
                    
                    <p <?php echo esc_attr($displaySocialFeatures) === 'off' ? 'style="visibility:hidden";' : '' ?>  class="pm-share-title"><?php esc_html_e('Share with colleagues', 'luxortheme'); ?></p>
                
                    <ul class="pm-single-post-social-icons" <?php echo esc_attr($displaySocialFeatures) === 'off' ? 'style="visibility:hidden";' : '' ?>>
                    
                        <li> 
                            <a href="https://twitter.com/share?url=<?php echo urlencode(get_the_permalink()); ?>&amp;text=<?php echo urlencode(get_the_title()); ?>" class="fa fa-twitter" target="_blank"></a>
                        </li>
                        
                        <li>
                            <a href="http://www.facebook.com/share.php?u=<?php echo urlencode(get_the_permalink()); ?>" class="fa fa-facebook" target="_blank"></a>
                        </li>
                    
                        <li> 
                            <a href="https://plus.google.com/share?url=<?php echo urlencode(get_the_permalink()); ?>" class="fa fa-google-plus" target="_blank"></a>
                        </li>
                    
                    </ul>
                    
                    
                </div>
            
                <div class="pm-single-post-tags">
                    <p class="tags"><?php esc_html_e('Tagged in', 'luxortheme'); ?>: <?php the_tags('', ', ', ''); ?></p>
                </div>
                
                <?php $likes = get_post_meta(get_the_ID(), 'pm_total_likes', true); ?>
                
                <div class="pm-single-post-like-feature">
                    <a href="#" class="pm-single-post-like-btn pm-like-this-btn fa fa-thumbs-up" id="<?php echo get_the_ID(); ?>"></a>
                    <span id="pm-post-total-likes-count-<?php echo get_the_ID(); ?>"><?php echo esc_attr($likes); ?></span>
                </div>
                                  
                
            </div>
            <!-- Post info and tags end -->
            
            
        </div>
    </div>

</div>
<!-- PANEL 1 end -->

<?php
    
	//author info
	$display_name = get_the_author_meta('display_name');
	$first_name = get_the_author_meta('first_name');
	$last_name = get_the_author_meta('last_name');
	$author_title = get_the_author_meta( 'author_title' ); 
	$description = get_the_author_meta('description');
	$url = get_the_author_meta('url');
	$finalURL = str_replace("http://", "", $url); 
	
	$authorBackgroundImage = get_theme_mod('authorBackgroundImage');
	$commentsBackgroundImage = get_theme_mod('commentsBackgroundImage');
	$toggleParallaxAuthor = get_theme_mod('toggleParallaxAuthor', 'on');
	
?> 

<?php if($displayAuthorProfile === 'on') : ?>

	<!-- PANEL 2 -->
     <div id="pm-author-column" class="pm-column-container <?php echo esc_attr($toggleParallaxAuthor) === 'on' ? 'pm-parallax-panel' : '' ?>" <?php echo esc_attr($authorBackgroundImage) !== '' ? 'style="background-image:url('.esc_html($authorBackgroundImage).')"' : '' ?> <?php echo esc_attr($toggleParallaxAuthor) === 'on' ? 'data-stellar-background-ratio="0.5"' : '' ?>>
        
        <div class="container pm-containerPadding-bottom-110 pm-containerPadding-top-110">
            <div class="row">
                <div class="col-lg-12">
                                            
                    <p class="pm-fancy-title pm-fancy">
                        <i class="pm-fancy-title-endpoint left"></i>
                            <span class="pm-fancy-author-title"><?php esc_html_e('About the Author', 'luxortheme'); ?></span>
                        <i class="pm-fancy-title-endpoint right"></i>
                    </p>
                    
                    <div class="row pm-containerPadding-top-30">
                        
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            
                            <div class="pm-author-bio-container">
                            
                                <div class="pm-author-bio-img-container">
                                
                                	<?php $avatar = pm_ln_get_avatar_url(get_avatar( get_the_author_meta( 'ID' ), 190 )); ?>
                                                            
                                    <img src="<?php echo esc_html($avatar); ?>" class="img-responsive" alt="<?php echo esc_attr($author_title); ?>" />
                                </div>
                                
                                <p class="name"><?php echo esc_attr($first_name); ?> <?php echo esc_attr($last_name); ?></p>
                                
                                <?php if($finalURL !== '') : ?>
                                    <p class="url"><a href="<?php echo esc_html($url); ?>" target="_blank"><?php echo esc_html($finalURL); ?></a></p>
                                <?php endif; ?>
                                                                
                            </div>
                                                            
                        </div>
                        
                        <div class="col-lg-8 col-md-8 col-sm-12 pm-author-bio">
                        
                            <p><?php echo esc_attr($description); ?></p>
                            
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    
    </div>
    <!-- PANEL 2 end -->

<?php endif; ?>

<?php if($displayRelatedPosts === 'on') : ?>

	<!-- PANEL 3 -->
	<?php get_template_part('content', 'relatedposts'); ?>
    <!-- PANEL 3 end-->

<?php endif; ?>


<?php if($displayComments === 'on') : ?>

	<?php if ( comments_open() ) : ?>

		<?php if ($num_comments > 0 ) : ?>
        
            <!-- PANEL 4 -->
            
            <div id="pm-comments-column" class="pm-column-container pm-containerPadding80 <?php echo esc_attr($toggleParallaxAuthor) === 'on' ? 'pm-parallax-panel' : '' ?>" <?php echo esc_attr($commentsBackgroundImage) !== '' ? 'style="background-image:url('.esc_html($commentsBackgroundImage).')"' : '' ?> <?php echo esc_attr($toggleParallaxAuthor) === 'on' ? 'data-stellar-background-ratio="0.5"' : '' ?>>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            
                            <?php comments_template(); ?>
                            
                        </div>
                    </div>
                </div>
            
            </div>
            <!-- PANEL 4 end -->
        <?php endif; ?>
    
    <?php endif; ?>
    
    
    <!-- PANEL 5 -->

	<?php if ( comments_open() ) : ?>
        
        <div class="container pm-containerPadding-top-100 pm-containerPadding-bottom-80 container-scroll" id="submit-comment">
                
            <div class="row">
              
                
                <?php 
                
                    $args = array(
                        
                          'id_form'           => 'commentform',
                          'class_form'      => 'comment-form',
                          'id_submit'         => 'submit',
                          'class_submit'      => 'submit',
                          'name_submit'       => 'submit',
                          'title_reply'       => esc_html__( 'Leave a Reply', 'luxortheme' ),
                          'title_reply_to'    => esc_html__( 'Leave a Reply to %s', 'luxortheme' ),
                          'cancel_reply_link' => esc_html__( 'Cancel Reply', 'luxortheme' ),
                          'label_submit'      => esc_html__( 'Post Comment', 'luxortheme' ),
                          'format'            => 'xhtml',
                          
                          
                          'fields' => apply_filters( 'comment_form_default_fields', 
                          
                              array(
                            
                                'author' =>
                                  '<div class="col-lg-4 col-md-4 col-sm-12 pm-form-clear-left-padding"><input required id="author" name="author" type="text" class="respond_author pm-comment-form-textfield" size="22" value=""  placeholder="'. esc_html__('Name *', 'luxortheme') .'" /></div>',
                            
                                'email' =>
                                  '<div class="col-lg-4 col-md-4 col-sm-12 pm-form-clear-mobile-padding"><input required id="email" name="email" type="text" class="respond_email pm-comment-form-textfield" size="22" value=""  placeholder="'. esc_html__('Email *', 'luxortheme') .'" /></div>',
                            
                                'url' =>
                                  '<div class="col-lg-4 col-md-4 col-sm-12 pm-form-clear-right-padding"><input id="url" name="url" type="text" value="" size="30" class="respond_url pm-comment-form-textfield" placeholder="'. esc_html__('Website', 'luxortheme') .'" /></div>'
                                )//end of array
                            
                            ),//end of apply_filters
                            
                            'comment_field' => '<div class="col-lg-12 pm-form-clear-padding pm-clear-element pm-form-margin-spacing"><textarea id="comment" class="pm-comment-form-textarea" name="comment" cols="45" rows="8" aria-required="true" placeholder="'. esc_html__('Comment...', 'luxortheme') .'"></textarea></div>',
                        
                        );
                
                ?>      
        
                <?php comment_form($args); ?>
                
            
        </div>

    </div>
        
	<?php endif; ?>
    
<?php endif; ?>

<!-- PANEL 5 end-->