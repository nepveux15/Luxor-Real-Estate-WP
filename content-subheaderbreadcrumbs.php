<?php $enableBreadCrumbs = get_theme_mod('enableBreadCrumbs', 'on'); ?>




<!-- Breadcrumbs -->
<?php if( function_exists('is_shop') ) {//Woocommerce enabled ?>

	<?php if( is_shop() || is_product() || is_product_category() || is_product_tag()  ) { ?>
	
		<?php if($enableBreadCrumbs === 'on') : ?>
        
                
                <?php				
                    $args = array(
                            'delimiter' => '',
                            'wrap_before' => '<ul class="pm-breadcrumbs">',
                            'wrap_after' => '</ul>',
                            'before' => '<li>',
                            'after' => '</li>',
                    );
                ?>
                
                <?php woocommerce_breadcrumb( $args ); ?>
                        
        <?php endif; ?>
		
	<?php } else { ?>
	
		<?php if( !is_tax('gallerycats') && !is_tax('gallerytags') ) : ?>
			
			<?php if($enableBreadCrumbs === 'on'){ ?>       
                                    
				<?php pm_ln_breadcrumbs();  ?>
                
                    
			<?php } ?>
		
		<?php endif ?>    
	
	<?php } ?>	

<?php } else {//Woocommerce not enabled ?>

	<?php if( !is_tax('gallerycats') && !is_tax('gallerytags') ) : ?>
		
		<?php if($enableBreadCrumbs === 'on'){ ?>
				
                <ul class="pm-breadcrumbs">
                    
                    <li><a href="<?php echo site_url(); ?>"><i class="fa fa-home"></i></a></li>
                    
                    <?php if( 'post_properties' == get_post_type() ) { ?>
            
                        <li><?php esc_html_e('Properties', 'luxortheme') ?></li>
                        
                        <li><?php $the_title = get_the_title(); echo esc_attr($the_title); ?></li>
                        
                     <?php } elseif( 'post_agents' == get_post_type() ) { ?>
            
                        <li><?php esc_html_e('Agents', 'luxortheme') ?></li>
                        
                        <li><?php $the_title = get_the_title(); echo esc_attr($the_title); ?></li>
                        
                    <?php } elseif( 'post_agencies' == get_post_type() ) { ?>
            
                        <li><?php esc_html_e('Agencies', 'luxortheme') ?></li>
                        
                        <li><?php $the_title = get_the_title(); echo esc_attr($the_title); ?></li>
                    
                    <?php } elseif(is_category()) { ?>
            
                        <li><?php esc_html_e('Category', 'luxortheme') ?></li>
                        
                        <li><?php $cat = get_category( get_query_var( 'cat' ) ); echo esc_attr($cat->name); ?></li>
                    
                    <?php } elseif(is_single()) { ?>
                    
                    	<li><?php esc_html_e('News', 'luxortheme') ?></li>
                    
                        <li><?php $the_title = get_the_title(); echo esc_attr($the_title); ?></li>
                        
                    <?php } elseif(is_tag()) { ?>
                    
                        <li><?php esc_html_e('Tag', 'luxortheme') ?></li>
                        
                        <li><?php echo get_query_var('tag'); ?></li>
                        
                    <?php } elseif(is_404()) { ?>
                
                        <li><?php esc_html_e('404 Error', 'luxortheme'); ?></li>
                        
                    <?php } elseif(is_search()) { ?>
                
                        <li>"<?php echo get_search_query(); ?>"</li>
                        
                    <?php } elseif(is_archive()) { ?>
                    
                            <li><?php esc_html_e('Archive', 'luxortheme') ?></li>
                            
                            <li>"<?php single_tag_title(); ?>"</li>
                        
                    <?php } else { ?>
                    
                        <li><?php $the_title = get_the_title(); echo esc_attr($the_title); ?></li>
                    
                    <?php } ?>
                    
                </ul>         
                
		<?php } ?>
	
	<?php endif ?>  

<?php } ?>