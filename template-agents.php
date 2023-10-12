<?php /* Template Name: Agents Template */ ?>
<?php get_header(); ?>


<?php if(post_type_exists("post_agents")) : ?>

    <?php 
        $agent_posts_per_load = get_theme_mod('agent_posts_per_load', '3');
    ?>

    <?php if($content = $post->post_content) { ?>

        <div class="container pm-containerPadding-top-80">
            <div class="row">
                <div class="col-lg-12">
                
                    <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
                        
                        <?php the_content(); ?>
                    
                    <?php endwhile; else: ?>
                        
                    <?php endif; ?> 
                
                </div>
            </div>
        </div>

    <?php } ?>

    <?php

        //global $paged;
        $agentPostOrder = get_theme_mod('agentPostOrder', 'DESC');
        
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $arguments = array(
            'post_type' => 'post_agents',
            'post_status' => 'publish',
            'paged' => $paged,
            'order' => $agentPostOrder,
            //'posts_per_page' => -1,
            'posts_per_page' => $agent_posts_per_load,
            //'tag' => get_query_var('tag')
        );

        $blog_query = new WP_Query($arguments);

        pm_ln_set_query($blog_query);
        
        $count_posts = wp_count_posts('post_agents');
        $published_posts = $count_posts->publish;
        
    ?>

    <!-- PANEL 2 -->
    <?php if($agent_posts_per_load === '-1') { ?>
        <div class="container pm-containerPadding-top-120 pm-containerPadding-bottom-80">
    <?php } else { ?>
        <div class="container pm-containerPadding-top-120">
    <?php } ?>


        <div class="row isotope" id="pm-isotope-item-container">
        
            <?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
            
                <?php get_template_part( 'content', 'agentspost' ); ?>
            
            <?php endwhile; else: ?>
                <p><?php esc_html_e('No Agent profiles were found.', 'luxortheme'); ?></p>
            <?php endif; ?>
                        
            <?php pm_ln_restore_query(); ?> 
        
        </div>

    </div>

    <?php if($agent_posts_per_load !== '-1') : ?>

        <!-- Load more -->
        <div class="container pm-containerPadding-bottom-80">
            <div class="row">
                <div class="col-lg-12">
                    
                    <ul class="pm-post-loaded-info">
                    
                        <?php if($published_posts > $agent_posts_per_load) { ?>
                        
                            <li>
                                <p><?php esc_html_e('Viewing', 'luxortheme') ?> <span class="pm-load-more-container-current-count"><strong><?php echo esc_attr($agent_posts_per_load); ?></strong></span> <?php esc_html_e('of', 'luxortheme') ?> <strong><?php echo esc_attr($published_posts); ?></strong> <?php esc_html_e('profiles', 'luxortheme') ?></p>
                            </li>
                            
                            <li>
                                <a href="#" class="fa fa-cloud-download" id="pm-load-more" data-name="agents"></a>
                            </li>
                        
                        <?php } else { ?>
                        
                            <li>
                                <p><?php esc_html_e('Viewing', 'luxortheme') ?> <span class="pm-load-more-container-current-count"><strong><?php echo esc_attr($published_posts); ?></strong></span> <?php esc_html_e('of', 'luxortheme') ?> <strong><?php echo esc_attr($published_posts); ?></strong> <?php esc_html_e('profiles', 'luxortheme') ?></p>
                            </li>
                            
                            <li style="display:none;"></li>
                        
                        <?php }  ?>
                        
                    </ul>
                    
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
        <!-- Load more -->

    <?php endif; ?>

<?php endif; ?>

<?php get_footer(); ?>