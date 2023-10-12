<?php /* Template Name: Properties Template */ ?>
<?php get_header(); ?>

<?php if(post_type_exists("post_properties")) : ?>

    <?php 
        $properties_posts_per_load = get_theme_mod('properties_posts_per_load', '4');
        $getPageLayout = get_post_meta(get_the_ID(), 'pm_page_layout_meta', true);
        $pageLayout = $getPageLayout !== '' ? $getPageLayout : 'no-sidebar';
        $getBootstrapContainerPadding = get_post_meta(get_the_ID(), 'pm_bootstrap_container_padding_meta', true);
        $bootstrapContainerPadding = $getBootstrapContainerPadding !== '' ? $getBootstrapContainerPadding : '80';
    ?>

    <?php

        //global $paged;	
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        
        $order = 'DESC';
        
        if( isset( $_GET['order'] ) ) {
            
            $order = (string) $_GET['order'];
            
            if($order === 'price_ascending'){
                
                $arguments = array(
                    'post_type' => 'post_properties',
                    'post_status' => 'publish',
                    'paged' => $paged,
                    //'order' => $order,
                    //'posts_per_page' => -1,
                    'meta_key' => 'pm_properties_price_meta',
                    'orderby' => 'meta_value_num',
                    'order' => 'DESC',
                    'posts_per_page' => $properties_posts_per_load,
                    //'tag' => get_query_var('tag')
                );
                            
            }
            
            if($order === 'price_descending'){
                
                $arguments = array(
                    'post_type' => 'post_properties',
                    'post_status' => 'publish',
                    'paged' => $paged,
                    //'order' => $order,
                    //'posts_per_page' => -1,
                    'meta_key' => 'pm_properties_price_meta',
                    'orderby' => 'meta_value_num',
                    'order' => 'ASC',
                    'posts_per_page' => $properties_posts_per_load,
                    //'tag' => get_query_var('tag')
                );
                
            }
            
            if($order === 'recent'){
                
                $arguments = array(
                    'post_type' => 'post_properties',
                    'post_status' => 'publish',
                    'paged' => $paged,
                    //'order' => $order,
                    //'posts_per_page' => -1,
                    'order' => 'DESC',
                    'posts_per_page' => $properties_posts_per_load,
                    //'tag' => get_query_var('tag')
                );
                
            }
            
            if($order === 'chronological'){
                
                $arguments = array(
                    'post_type' => 'post_properties',
                    'post_status' => 'publish',
                    'paged' => $paged,
                    'order' => $order,
                    //'posts_per_page' => -1,
                    'order' => 'ASC',
                    'posts_per_page' => $properties_posts_per_load,
                    //'tag' => get_query_var('tag')
                );
                
            }
            
        } else {
            
            $arguments = array(
                'post_type' => 'post_properties',
                'post_status' => 'publish',
                'paged' => $paged,
                'order' => $order,
                //'posts_per_page' => -1,
                'posts_per_page' => $properties_posts_per_load,
                //'tag' => get_query_var('tag')
            );
        
        }
        

        $blog_query = new WP_Query($arguments);

        pm_ln_set_query($blog_query);
        
        $count_posts = wp_count_posts('post_properties');
        $published_posts = $count_posts->publish;
        
    ?>

    <?php if($pageLayout === 'no-sidebar') : //Render col-lg-12 ?>

        <!-- PANEL 2 -->
        <?php if($properties_posts_per_load !== '-1') { ?>
        <div class="container pm-containerPadding-top-<?php echo esc_attr($bootstrapContainerPadding); ?> pm-containerPadding-bottom-10 pm-property-posts-no-sidebar">
        <?php } else { ?>
        <div class="container pm-containerPadding<?php echo esc_attr($bootstrapContainerPadding); ?> pm-property-posts-no-sidebar">
        <?php } ?>
        
        
            <div class="row">
                    
                <div class="col-lg-12">
                
                    <?php get_template_part( 'content', 'propertyfilter' ); ?>
                        
                    <ul class="pm-property-listings-list isotope pm-list-mode" id="pm-isotope-item-container">
                
                        <?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                        
                            <?php get_template_part( 'content', 'propertiespost' ); ?>
                        
                        <?php endwhile; else: ?>
                            <li><p><?php esc_html_e('No properties were found.', 'luxortheme'); ?></p></li>
                        <?php endif; ?>
                    
                    </ul>
                                
                    <?php pm_ln_restore_query(); ?> 
                
                </div>
            
            </div>
        
        </div>
        
        <?php if($properties_posts_per_load !== '-1') : ?>

            <!-- Load more -->
            <div class="container pm-containerPadding-bottom-80">
                <div class="row">
                    <div class="col-lg-12">
                        
                        <ul class="pm-post-loaded-info">
                        
                            <?php if($published_posts > $properties_posts_per_load) { ?>
                            
                                <li>
                                    <p><?php esc_html_e('Viewing', 'luxortheme') ?> <span class="pm-load-more-container-current-count"><strong><?php echo esc_attr($properties_posts_per_load); ?></strong></span> <?php esc_html_e('of', 'luxortheme') ?> <strong><?php echo esc_attr($published_posts); ?></strong> <?php esc_html_e('properties', 'luxortheme') ?></p>
                                </li>
                            
                                <li>
                                    <a href="#" class="fa fa-cloud-download" id="pm-load-more" data-name="properties" data-order="<?php echo esc_attr($order); ?>"></a>
                                </li>
                            
                            <?php } else { ?>
                            
                                <li>
                                    <p><?php esc_html_e('Viewing', 'luxortheme') ?> <span class="pm-load-more-container-current-count"><strong><?php echo esc_attr($published_posts); ?></strong></span> <?php esc_html_e('of', 'luxortheme') ?> <strong><?php echo esc_attr($published_posts); ?></strong> <?php esc_html_e('properties', 'luxortheme') ?></p>
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



    <?php if($pageLayout === 'left-sidebar') { ?>

            <div class="container pm-containerPadding<?php echo esc_attr($bootstrapContainerPadding); ?>">
            
                <div class="row">
                
                    <?php get_sidebar(); ?>
                
                    <div class="col-lg-8 col-md-8 col-sm-12">
                    
                        <?php get_template_part( 'content', 'propertyfilter' ); ?>
            
                        
                        <ul class="pm-property-listings-list isotope pm-list-mode" id="pm-isotope-item-container">
                        
                            <?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                    
                                <?php get_template_part( 'content', 'propertiespost' ); ?>
                            
                            <?php endwhile; else: ?>
                                <li><p><?php esc_html_e('No properties were found.', 'luxortheme'); ?></p></li>
                            <?php endif; ?>
                        
                        </ul>
                                    
                        <?php pm_ln_restore_query(); ?> 
                        
                        
                        <?php if($properties_posts_per_load !== '-1') : ?>

                            <!-- Load more -->
                            <ul class="pm-post-loaded-info">
                            
                                <?php if($published_posts > $properties_posts_per_load) { ?>
                                
                                    <li>
                                        <p><?php esc_html_e('Viewing', 'luxortheme') ?> <span class="pm-load-more-container-current-count"><strong><?php echo esc_attr($properties_posts_per_load); ?></strong></span> <?php esc_html_e('of', 'luxortheme') ?> <strong><?php echo esc_attr($published_posts); ?></strong> <?php esc_html_e('properties', 'luxortheme') ?></p>
                                    </li>
                                
                                    <li>
                                        <a href="#" class="fa fa-cloud-download" id="pm-load-more" data-name="properties" data-order="<?php echo esc_attr($order); ?>"></a>
                                    </li>
                                
                                <?php } else { ?>
                                
                                    <li>
                                        <p><?php esc_html_e('Viewing', 'luxortheme') ?> <span class="pm-load-more-container-current-count"><strong><?php echo esc_attr($published_posts); ?></strong></span> <?php esc_html_e('of', 'luxortheme') ?> <strong><?php echo esc_attr($published_posts); ?></strong> <?php esc_html_e('properties', 'luxortheme') ?></p>
                                    </li>
                                    
                                    <li style="display:none;"></li>
                                
                                <?php }  ?>
                                
                            </ul>
                            <!-- Load more -->
                        
                        <?php endif; ?>
                    
                    </div><!-- /.col -->
                
                </div><!-- /.row -->
                
            </div><!-- /.container -->

    <?php } ?>


    <?php if($pageLayout === 'right-sidebar') { ?>

            <div class="container pm-containerPadding<?php echo esc_attr($bootstrapContainerPadding); ?> pm-sidebar-on">
            
                <div class="row">
                
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        
                        <?php get_template_part( 'content', 'propertyfilter' ); ?>
            
                        
                        <ul class="pm-property-listings-list isotope pm-list-mode" id="pm-isotope-item-container">
                    
                            <?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                        
                                <?php get_template_part( 'content', 'propertiespost' ); ?>
                            
                            <?php endwhile; else: ?>
                                <li><p><?php esc_html_e('No properties were found.', 'luxortheme'); ?></p></li>
                            <?php endif; ?>
                        
                        </ul>
                        
                        <?php pm_ln_restore_query(); ?> 
                        
                        
                        <?php if($properties_posts_per_load !== '-1') : ?>

                            <!-- Load more -->
                            <ul class="pm-post-loaded-info">
                            
                                <?php if($published_posts > $properties_posts_per_load) { ?>
                                
                                    <li>
                                        <p><?php esc_html_e('Viewing', 'luxortheme') ?> <span class="pm-load-more-container-current-count"><strong><?php echo esc_attr($properties_posts_per_load); ?></strong></span> <?php esc_html_e('of', 'luxortheme') ?> <strong><?php echo esc_attr($published_posts); ?></strong> <?php esc_html_e('properties', 'luxortheme') ?></p>
                                    </li>
                                
                                    <li>
                                        <a href="#" class="fa fa-cloud-download" id="pm-load-more" data-name="properties" data-order="<?php echo esc_attr($order); ?>"></a>
                                    </li>
                                
                                <?php } else { ?>
                                
                                    <li>
                                        <p><?php esc_html_e('Viewing', 'luxortheme') ?> <span class="pm-load-more-container-current-count"><strong><?php echo esc_attr($published_posts); ?></strong></span> <?php esc_html_e('of', 'luxortheme') ?> <strong><?php echo esc_attr($published_posts); ?></strong> <?php esc_html_e('properties', 'luxortheme') ?></p>
                                    </li>
                                    
                                    <li style="display:none;"></li>
                                
                                <?php }  ?>
                                
                            </ul>
                            <!-- Load more -->
                        
                        <?php endif; ?>
                    
                    </div><!-- /.col -->
                    
                    <?php get_sidebar(); ?>
                
                </div><!-- /.row -->
                
            </div><!-- /.container -->

    <?php } ?>

<?php endif; ?>


<?php get_footer(); ?>