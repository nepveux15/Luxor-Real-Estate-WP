<?php /* Template Name: Members Reports Template */ ?>
<?php get_header(); ?>

<?php if(post_type_exists("post_galleries")) : ?>

    <?php 

        //Are we logged in?
        if ( is_user_logged_in() ) {
            
        } else {
            //user not logged in, redirect page back to homepage
            wp_redirect( home_url('/') );
            exit;	
        }

    ?>

    <!-- MEMBERS NAVIGATION -->
    <?php get_template_part('content', 'membersnav'); ?>
    <!-- MEMBERS NAVIGATION end -->

    <?php 

        $arguments = array(
            'author' => $current_user->ID,
            'post_type' => 'post_properties',
            'post_status' => 'publish',
            'order' => 'DESC',
            'posts_per_page' => -1
            //'tag' => get_query_var('tag')
        );
        
        $blog_query = new WP_Query($arguments);

        pm_ln_set_query($blog_query);
        
        //$count_posts = count_user_posts($current_user->ID, 'post_properties');
        $published_posts = count_user_posts($current_user->ID, 'post_properties');
        
        $totalPostViews = 0;
        
        if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post();
        
            $post_views = get_post_meta(get_the_ID(), 'post_views', true);
            $totalPostViews += $post_views;
        
        endwhile; else:
        
        endif;
        
        pm_ln_restore_query();


    ?>

    <!-- PANEL 1 -->
    <div class="container pm-containerPadding-top-120 pm-containerPadding-bottom-100">

        <div class="row">
            <div class="col-lg-12 pm-center">
                
                <h4><?php esc_html_e('Viewings Report','luxortheme'); ?></h4>
                
                <div class="pm-column-title-divider">
                    <div class="pm-column-title-divider-symbol"></div>
                    <div class="pm-column-title-divider-end-point left"></div>
                    <div class="pm-column-title-divider-end-point right"></div>
                </div>
                
                <br><br>
                
                <p><?php esc_html_e('Total properties listed','luxortheme'); ?>: <strong><?php echo esc_attr($published_posts); ?></strong></p>
                <p><?php esc_html_e('Total views','luxortheme'); ?>: <strong><?php echo esc_attr($totalPostViews); ?></strong></p>
                
                <br><br>
                
                <?php if($published_posts > 0) : ?>
                
                    <a href="#" id="pm-member-report-breakdown-btn"><?php esc_html_e('View Details','luxortheme'); ?></a>
                
                    <br /><br />
                    
                    <div class="pm-members-breakdown-list-container" id="pm-members-breakdown-list-container">
                        
                        <ul class="pm-members-breakdown-list" id="pm-members-breakdown-list">
                        
                            <?php 
                            
                                pm_ln_set_query($blog_query);
                                
                                $totalPostViews = 0;
                                
                                if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post();
                                
                                    $post_views = get_post_meta(get_the_ID(), 'post_views', true);
                                    $post_views = $post_views === '' ? 0 : $post_views;
                                    $title = get_the_title();
                                
                                    echo '<li>';
                                        echo '<a href="'.get_the_permalink().'" class="pm-secondary" target="_blank">'.$title.'</a> <br /> Total Views: ' . $post_views;
                                    echo '</li>';
                                
                                endwhile; else:
                                
                                endif;
                                
                                pm_ln_restore_query();
                            
                            ?>
                        
                        </ul>
                        
                    </div>
                
                <?php endif; ?>
                
            </div>
        </div>
                    
    </div>
    <!-- PANEL 1 end -->

<?php endif; ?>

<?php get_footer(); ?>