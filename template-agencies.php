<?php /* Template Name: Agencies Template */ ?>
<?php get_header(); ?>

<?php if(post_type_exists("post_agencies")) : ?>

    <?php 
        $agencies_posts_per_load = get_theme_mod('agencies_posts_per_load', '4');
    ?>

    <?php

        //global $paged;	
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        
        $order = 'DESC';
        
        if( isset( $_GET['order'] ) ) {
            $order = $_GET['order'];
        }

        $arguments = array(
            'post_type' => 'post_agencies',
            'post_status' => 'publish',
            'paged' => $paged,
            'order' => (string) $order,
            //'posts_per_page' => -1,
            'posts_per_page' => $agencies_posts_per_load,
            //'tag' => get_query_var('tag')
        );

        $blog_query = new WP_Query($arguments);

        pm_ln_set_query($blog_query);
        
        $count_posts = wp_count_posts('post_agencies');
        $published_posts = $count_posts->publish;
        
    ?>


    <!-- PANEL 1 -->
    <div class="container pm-containerPadding-top-120 pm-containerPadding-bottom-100">

        <div class="row">
        
            <div class="col-lg-6 col-md-6 col-sm-12">
                        
                
                <?php get_template_part( 'content', 'agencyfilter' ); ?>
                        
                <ul class="pm-agencies-posts-list isotope" id="pm-isotope-item-container">
            
                    <?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                    
                        <?php get_template_part( 'content', 'agenciespost' ); ?>
                    
                    <?php endwhile; else: ?>
                        <li><p><?php esc_html_e('No agencies were found.', 'luxortheme'); ?></p></li>
                    <?php endif; ?>
                
                </ul>
                            
                <?php pm_ln_restore_query(); ?>
                            
                
                <?php if($agencies_posts_per_load !== '-1') : ?>

                    <!-- Load more -->
                    <ul class="pm-post-loaded-info properties">
                    
                        <?php if($published_posts > $agencies_posts_per_load) { ?>
                        
                            <li>
                                <p><?php esc_html_e('Viewing', 'luxortheme') ?> <span class="pm-load-more-container-current-count"><strong><?php echo esc_attr($agencies_posts_per_load); ?></strong></span> <?php esc_html_e('of', 'luxortheme') ?> <strong><?php echo esc_attr($published_posts); ?></strong> <?php esc_html_e('agencies', 'luxortheme') ?></p>
                            </li>
                        
                            <li>
                                <a href="#" class="fa fa-cloud-download" id="pm-load-more" data-name="agencies" data-order="<?php echo $order; ?>"></a>
                            </li>
                        
                        <?php } else { ?>
                        
                            <li>
                                <p><?php esc_html_e('Viewing', 'luxortheme') ?> <span class="pm-load-more-container-current-count"><strong><?php echo esc_attr($published_posts); ?></strong></span> <?php esc_html_e('of', 'luxortheme') ?> <strong><?php echo esc_attr($published_posts); ?></strong> <?php esc_html_e('agencies', 'luxortheme') ?></p>
                            </li>
                            
                            <li style="display:none;"></li>
                        
                        <?php }  ?>
                        
                    </ul>
                    <!-- Load more -->
                
                <?php endif; ?>
                
            </div>
            
            <div class="col-lg-6 col-md-6 col-sm-12">
                
                <div class="pm-agencies-gmap-container" id="pm-agencies-gmap-container">
                    
                </div>
                
            </div>
            
        </div>
                    
    </div>
    <!-- PANEL 1 end -->

<?php endif; ?>




<?php get_footer(); ?>