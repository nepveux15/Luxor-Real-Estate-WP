<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_post_items extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"el_num_of_posts" => '4',
			"el_post_order" => 'DESC',
			"el_tag" => '',
			"el_category" => '',
			"el_class" => ''
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();
		
		
		//Fetch data
		if($el_tag !== ''){
			
			$arguments = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'order' => (string) $el_post_order,
				'tax_query' => array(
						array(
							'taxonomy' => 'post_tag',
							'field' => 'slug',
							'terms' => array( $el_tag )
						)
				),
				'posts_per_page' => $el_num_of_posts,
				//'post_count' => $el_num_of_posts,
				'ignore_sticky_posts' => 1
				//'tag' => get_query_var('tag')
			);
			
		} else if($el_category !== '') {
			
			$arguments = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'order' => (string) $el_post_order,
				'tax_query' => array(
						array(
							'taxonomy' => 'category',
							'field' => 'slug',
							'terms' => array( $el_category )
						)
				),
				'posts_per_page' => $el_num_of_posts,
				//'post_count' => $el_num_of_posts,
				'ignore_sticky_posts' => 1
				//'tag' => get_query_var('tag')
			);
			
		} else {
			
			$arguments = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				//'posts_per_page' => -1,
				'order' => (string) $el_post_order,
				'posts_per_page' => $el_num_of_posts,
				'ignore_sticky_posts' => 1
				//'tag' => get_query_var('tag')
			);
			
		}	
		
		$displayPostIcon = get_theme_mod('displayPostIcon', 'on');
	
		$post_query = new WP_Query($arguments);
	
		$animationCounter = 3;

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div<?php echo ($el_num_of_posts > 3 ? ' id="pm-postItems-carousel"' : ''); ?>>
		
            <?php if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post(); ?>
            
                <?php
				
                $categories = get_the_category();
         
                $likes = get_post_meta(get_the_ID(), 'pm_total_likes', true);
         
                if ( has_post_thumbnail()) {
                  $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
                }			
                
                if($el_num_of_posts == "1"){
                    echo '<div class="col-lg-12">';
                } elseif($el_num_of_posts == "2") { 
                    echo '<div class="col-lg-6 col-md-6 col-sm-12">';
                } elseif($el_num_of_posts == "3") { 
                   echo '<div class="col-lg-4 col-md-4 col-sm-12"> ';
                } else { 
                   echo '<div class="pm-postItem-carousel-item">';
                }
				
				?>
                
                    <article class="pm-column-spacing <?php esc_attr_e($el_class); ?>" data-wow-delay="0.'.$animationCounter.'s" data-wow-offset="50" data-wow-duration="1s">
                        
                        <?php if ( has_post_thumbnail()) { ?>
                          
                           <div class="pm-news-post-img-container">
                            <div class="pm-news-post-category-container">
                            
                                <?php 
								
								if($categories){
                                    foreach($categories as $category) {
                                        echo '<a href="'. get_category_link( $category->term_id ) .'" class="pm-news-post-category-link">'. $category->cat_name .'</a>';
                                    }
                                }
								?>
                            
                                <a href="<?php the_permalink(); ?>" class="pm-news-post-details-link fa fa-bars"></a>
                            </div>
                            <img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php the_title(); ?>" />
                          </div>
                          
                       <?php } ?>
                        
                        <div class="pm-news-post-info-container">
                            
                            <h2><a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a></h2>
                            
                            <?php $the_excerpt = get_the_excerpt(); ?>
                            <p class="excerpt"><?php echo pm_ln_string_limit_words($the_excerpt, 15); ?><a href="<?php the_permalink(); ?>"> [...]</a></p>
                            
                            <div class="pm-news-post-divider"></div>
                            
                            <p class="meta-info"><?php echo get_the_author().' / '.get_the_time( 'M' ).' '.get_the_time( 'd' ).', '.get_the_time( 'Y' ); ?>  / <a href="https://twitter.com/share?url=<?php urlencode(get_the_permalink()); ?>&amp;text=<?php urlencode(get_the_title()); ?>" class="fa fa-twitter pm_tip_static_top pm_tip_arrow_bottom" data-tip-offset-y="-20" data-tip-offset-x="16" title="<?php esc_html_e('Tweet This!','luxortheme'); ?>" target="_blank"></a></p>
                            
                            <p class="meta-like"><a href="#" class="fa fa-thumbs-up pm_tip_static_top pm_tip_arrow_bottom pm-like-this-btn" data-tip-offset-y="-25" data-tip-offset-x="12" title="<?php esc_html_e('Like This!', 'luxortheme'); ?>" id="<?php echo get_the_ID(); ?>"></a> / <span id="pm-post-total-likes-count-<?php echo get_the_ID(); ?>"><?php esc_attr_e($likes); ?></span></p>
                            
                        </div>
                        
                    </article>
                    
                    <?php $animationCounter += 3; ?>
                
                </div>
            
            <?php endwhile; else: ?>
                <div class="col-lg-12 pm-column-spacing">
                 <p><?php esc_html_e('No posts were found.', 'luxortheme'); ?></p>
                </div>
            <?php endif; ?>
        
        </div>
                    
        <?php wp_reset_postdata(); ?>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_post_items",
    "name"      => __("News Posts", 'luxortheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Luxor Shortcodes", 'luxortheme'),
    "params"    => array(

		
		array(
            "type" => "dropdown",
            "heading" => __("Amount of News Posts to display:", 'luxortheme'),
            "param_name" => "el_num_of_posts",
            "description" => __("Choose how many news posts you would like to display.", 'luxortheme'),
			"value"      => array( '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10' ), //Add default value in $atts
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Post Order", 'luxortheme'),
            "param_name" => "el_post_order",
            "description" => __("Set the order in which news posts will be displayed.", 'luxortheme'),
			"value"      => array( 'DESC' => 'DESC', 'ASC' => 'ASC'), //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Tag slug", 'luxortheme'),
            "param_name" => "el_tag",
            "description" => __("Enter a tag slug to display news posts by a specific tag.", 'luxortheme'),
			"value"      => '', //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Category slug", 'luxortheme'),
            "param_name" => "el_category",
            "description" => __("Enter a category slug to display news posts by a specific category.", 'luxortheme'),
			"value"      => '', //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Class", 'luxortheme'),
            "param_name" => "el_class",
            "description" => __("Apply a custom CSS class if required.", 'luxortheme'),
			"value"      => '', //Add default value in $atts
        ),

    )

));