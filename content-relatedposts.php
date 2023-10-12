<?php
	//The default template for retrieving related blog post(s)
	
	$tags = wp_get_post_tags(get_the_ID());  
	
?>

<?php if (!empty($tags)) : ?>

	<div class="container pm-containerPadding-top-100 pm-containerPadding-bottom-70">
        <div class="row">
            <div class="col-lg-12">
            
                <h4 class="pm-single-post-section-title"><?php esc_html_e('Related Articles', 'luxortheme'); ?></h4>
                
                <div class="pm-single-blog-post-related-posts">
    
        
                        <?php  
                        
                            //print_r($tags);
                                        
                            $tag_ids = array();  
                        
                            foreach($tags as $individual_tag) {
                                $tag_ids[] = $individual_tag->term_id; 
                            }
                         
                            $args = array(  
                                'tag__in' => $tag_ids,  
                                'post__not_in' => array(get_the_ID()),  
                                'posts_per_page' => 3, // Number of related posts to display.  
                                'ignore_sticky_posts' => 1  
                            );  
                          
                            $my_query = new wp_query( $args );  
                            
                            if(!$my_query->have_posts()){
                                echo '<p>'.esc_html__('There are currently no articles related to this post.', 'luxortheme').'</p>';	
                            }
							
							$categories = wp_get_post_categories(get_the_id());
                            
                            echo '<ul class="pm-related-blog-posts">';
                      
                                while( $my_query->have_posts() ) {  
                                    $my_query->the_post();  
                                    
                                    if ( has_post_thumbnail() ) {
                                       $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'small');
                                    }
                                    
                                ?>  
                                
                                	<!-- Post -->
                                    <li>
                                        <article>
                            				
                                            <?php if(has_post_thumbnail()) : ?>
                                            
                                            	<div class="pm-news-post-img-container">
                                                    <div class="pm-news-post-category-container">
                                                    
                                                    	<?php 
         
															foreach ( $categories as $category ) {
																$cat = get_category( $category );
																echo '<a href="'.get_category_link( $cat->term_id ).'" class="pm-news-post-category-link">'.$cat->cat_name.'</a>';	
															}
														 
														?>
                                                    
                                                        
                                                        <a href="<?php the_permalink()?>" class="pm-news-post-details-link fa fa-bars"></a>
                                                    </div>
                                                    <img src="<?php echo esc_html($image_url[0]); ?>" alt="<?php the_title()?>" />
                                                </div>
                                            
                                            <?php endif; ?>
                                            
                                            
                                            <div class="pm-news-post-info-container">
                                                
                                                <h6><a href="<?php the_permalink()?>" class="title"><?php the_title()?></a></h6>
                                                
                                                <?php $excerpt = get_the_excerpt(); ?>
                                                
                                                <p class="excerpt"><?php echo pm_ln_string_limit_words($excerpt, 20); ?> <a href="<?php the_permalink()?>">[...]</a></p>
                                                
                                                <div class="pm-news-post-divider"></div>
                                                
                                                <p class="meta-info"><?php the_author(); ?> / <?php the_time( 'M' ); ?> <?php the_time( 'd' ); ?>, <?php the_time( 'Y' ); ?>  / <a href="#" class="fa fa-twitter pm_tip_static_top pm_tip_arrow_bottom" data-tip-offset-y="-20" data-tip-offset-x="16" title="<?php esc_html_e('Tweet This!', 'luxortheme'); ?>"></a></p>
                                                
                                                <?php $likes = get_post_meta(get_the_ID(), 'pm_total_likes', true); ?>
                                                
                                                <p class="meta-like"><a href="#" class="fa fa-thumbs-up pm_tip_static_top pm_tip_arrow_bottom pm-like-this-btn" id="<?php echo get_the_ID(); ?>" data-tip-offset-y="-20" data-tip-offset-x="16" title="<?php esc_html_e('Like This!', 'luxortheme'); ?>"></a> / <span id="pm-post-total-likes-count-<?php echo get_the_ID(); ?>"><?php echo esc_attr($likes); ?></span></p>
                                                
                                            </div>
                                            
                                        </article>
                                    </li>
                                    <!-- Post end -->
                              
                                <?php } 
                            
                            echo '</ul>'; 
                            
                            wp_reset_postdata(); //recommended by the WordPress codex if wp_query is being called within a template file                    
                             
                        ?>
                
                </div>
                    
            </div>
        </div>
    </div>

<?php endif; ?>