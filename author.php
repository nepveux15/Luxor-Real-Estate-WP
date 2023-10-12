<?php
/* The template for displaying author profile */

get_header(); ?>

<?php 

if( is_user_logged_in() ) {
	$user = wp_get_current_user();
	$user_id = $user->ID;
	$friends_list = get_user_meta($user_id, 'pm_friends_list_ids', true); 	
}

$enableTooltip = get_theme_mod('enableTooltip', 'on');

//Get author info
$author = get_queried_object();

$author_id = $author->ID;
$author_firstname = $author->first_name;
$author_lastname = $author->last_name;
$author_email = $author->user_email; 
$author_bio = $author->user_description;
$author_url = get_the_author_meta('url', $author_id);

$author_title = get_the_author_meta('user_title', $author_id);
$author_workphone = get_the_author_meta('user_workphone', $author_id);
$author_homephone = get_the_author_meta('user_homephone', $author_id);
$author_faxnumber = get_the_author_meta('user_faxnumber', $author_id);
$author_avatar = get_the_author_meta( 'user_avatar', $author_id ); 

$user_twitter_account = get_the_author_meta( 'user_twitter_account', $author_id ); 
$user_facebook_account = get_the_author_meta( 'user_facebook_account', $author_id ); 
$user_linkedin_account = get_the_author_meta( 'user_linkedin_account', $author_id ); 
$user_google_plus_account = get_the_author_meta( 'user_google_plus_account', $author_id ); 
$user_instagram_account = get_the_author_meta( 'user_instagram_account', $author_id ); 
$user_youtube_account = get_the_author_meta( 'user_youtube_account', $author_id ); 

/*$user_twitter_account = get_user_meta($user->ID, 'user_twitter_account', true); 
$user_facebook_account = get_user_meta($user->ID, 'user_facebook_account', true); 
$user_linkedin_account = get_user_meta($user->ID, 'user_linkedin_account', true); 
$user_google_plus_account = get_user_meta($user->ID, 'user_google_plus_account', true); 
$user_instagram_account = get_user_meta($user->ID, 'user_instagram_account', true); 
$user_youtube_account = get_user_meta($user->ID, 'user_youtube_account', true); */
 

//$num_of_tag_posts =  get_theme_mod('num_of_tag_posts', 5);

/*$range = 'all'; //default
if( isset( $_GET['range'] ) ) {
	$range = sanitize_text_field($_GET['range']);
	//echo $range;
}

$postType = 'post'; //default
if( isset( $_GET['type'] ) ) {
	
	if( $_GET['type'] !== 'post' ) {
		$postType = 'post_' . sanitize_text_field($_GET['type']);
	} else {
		$postType = 'post';
	}
	//echo $postType;
	
}*/

?>

<div class="container pm-containerPadding-top-120 pm-containerPadding-bottom-100">
        
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 pm-sticky-column">
            
            <div class="pm-staff-profile-container">
                
                <p class="pm-staff-profile-name"><?php echo esc_attr($author_firstname); ?> <?php echo esc_attr($author_lastname); ?></p>
                    
                <div class="pm-staff-profile-img-container">
                    <span class="overlay"></span>
                    
                    <img src="<?php echo esc_url($author_avatar); ?>" width="217" height="217" alt="<?php echo esc_attr($author_firstname); ?> <?php echo esc_attr($author_lastname); ?>"/>
                </div>
                
                <div class="pm-staff-profile-img-border">
                    <div class="pm-staff-profile-img-border-endpoint left"></div>
                    <div class="pm-staff-profile-img-border-endpoint right"></div>
                </div>
                
                <ul class="pm-staff-profile-contact-list author-profile">
                	<?php if($author_workphone !== '') : ?>
                    	<li><i class="fa fa-mobile mobile-icon"></i><?php esc_html_e('Business','luxortheme'); ?> <span><a href="tel:<?php echo esc_attr($author_workphone); ?>"><?php echo esc_attr($author_workphone); ?></a></span></li>
                    <?php endif; ?>
                    <?php if($author_homephone !== '') : ?>
                    	<li><i class="fa fa-phone phone-icon"></i><?php esc_html_e('Personal','luxortheme'); ?> <span><a href="tel:<?php echo esc_attr($author_homephone); ?>"><?php echo esc_attr($author_homephone); ?></a></span></li>
                    <?php endif; ?>
                    <?php if($author_faxnumber !== '') : ?>
                    	<li><i class="fa fa-fax fax-icon"></i><?php esc_html_e('Fax','luxortheme'); ?> <span><a href="tel:<?php echo esc_attr($author_faxnumber); ?>"><?php echo esc_attr($author_faxnumber); ?></a></span></li>
                    <?php endif; ?>                    
                </ul>
                                        
                <ul class="pm-staff-profile-social-list single">
                
                    <?php if($user_twitter_account !== '') : ?>
            
                        <li <?php echo esc_attr($enableTooltip) === 'on' ? 'class="pm_tip_static_top pm_tip_arrow_bottom" title="'.esc_html__('Twitter','luxortheme').'" data-tip-offset-x="23" data-tip-offset-y="5"' : '' ?>><a href="<?php echo esc_html($user_twitter_account); ?>" class="fa fa-twitter" target="_blank"></a></li>
                    
                    <?php endif; ?>
                    
                    <?php if($user_facebook_account !== '') : ?>
                    
                        <li <?php echo esc_attr($enableTooltip) === 'on' ? 'class="pm_tip_static_top pm_tip_arrow_bottom" title="'.esc_html__('Facebook','luxortheme').'" data-tip-offset-x="23" data-tip-offset-y="5"' : '' ?>><a href="<?php echo esc_html($user_facebook_account); ?>" class="fa fa-facebook" target="_blank"></a></li>
                    
                    <?php endif; ?>
                    
                    <?php if($user_linkedin_account !== '') : ?>
                    
                        <li <?php echo esc_attr($enableTooltip) === 'on' ? 'class="pm_tip_static_top pm_tip_arrow_bottom" title="'.esc_html__('Linkedin','luxortheme').'" data-tip-offset-x="23" data-tip-offset-y="5"' : '' ?>><a href="<?php echo esc_html($user_linkedin_account); ?>" class="fa fa-linkedin" target="_blank"></a></li>
                    
                    <?php endif; ?>
                    
                    <?php if($user_google_plus_account !== '') : ?>
                    
                        <li <?php echo esc_attr($enableTooltip) === 'on' ? 'class="pm_tip_static_top pm_tip_arrow_bottom" title="'.esc_html__('Google Plus','luxortheme').'" data-tip-offset-x="23" data-tip-offset-y="5"' : '' ?>><a href="<?php echo esc_html($user_google_plus_account); ?>" class="fa fa-google-plus" target="_blank"></a></li>
                    
                    <?php endif; ?>
                    
                    
                    <?php if($user_instagram_account !== '') : ?>
                    
                        <li <?php echo esc_attr($enableTooltip) === 'on' ? 'class="pm_tip_static_top pm_tip_arrow_bottom" title="'.esc_html__('Instagram','luxortheme').'" data-tip-offset-x="23" data-tip-offset-y="5"' : '' ?>><a href="<?php echo esc_html($user_instagram_account); ?>" class="fa fa-instagram" target="_blank"></a></li>
                    
                    <?php endif; ?>
                    
                    <?php if($user_youtube_account !== '') : ?>
                    
                        <li <?php echo esc_attr($enableTooltip) === 'on' ? 'class="pm_tip_static_top pm_tip_arrow_bottom" title="'.esc_html__('Youtube','luxortheme').'" data-tip-offset-x="23" data-tip-offset-y="5"' : '' ?>><a href="<?php echo esc_html($user_youtube_account); ?>" class="fa fa-youtube" target="_blank"></a></li>
                    
                    <?php endif; ?>
                    
                    <?php if($author_url !== '') : ?>
                    
                        <li <?php echo esc_attr($enableTooltip) === 'on' ? 'class="pm_tip_static_top pm_tip_arrow_bottom" title="'.esc_html__('Website','luxortheme').'" data-tip-offset-x="23" data-tip-offset-y="5"' : '' ?>><a href="<?php echo esc_html($author_url); ?>" class="fa fa-globe" target="_blank"></a></li>
                    
                    <?php endif; ?>
                    
                    
                    <?php if($author_email !== '') : ?>
                    
                        <li <?php echo esc_attr($enableTooltip) === 'on' ? 'class="pm_tip_static_top pm_tip_arrow_bottom" title="'.esc_html__('Email me!', 'luxortheme').'" data-tip-offset-x="23" data-tip-offset-y="5"' : '' ?>><a href="mailto:<?php echo esc_attr($author_email); ?>" class="fa fa-envelope"></a></li>
                    
                    <?php endif; ?> 
                    
                </ul>
                
            </div><!-- /.pm-staff-profile-container -->
            
            <?php 
                    
				$name = get_the_title();
				$first_name = explode(" ", $name);
			
			?>
            
            <?php if( $author_bio !== '' ) : ?>
            
            	<div class="pm-staff-profile-recent-properties-container author-profile">
                    
                    <p class="pm-staff-profile-name"><?php esc_html_e('Biography','luxortheme'); ?></p>
                    <p><?php echo esc_attr($author_bio); ?></p>
                
                </div> 
            
            <?php endif; ?>
                             
            
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12">
            
            <p class="pm-fancy-title pm-fancy secondary">
                <i class="pm-fancy-title-endpoint left"></i>
                    <span><?php esc_html_e('Listed Properties','luxortheme'); ?></span>
                <i class="pm-fancy-title-endpoint right"></i>
            </p>
                        
            <br />    
               
            <?php 
			
				//Paging
				if(isset($_GET['currPage'])){
		
					if($_GET['currPage'] == 0){
						wp_redirect( get_permalink() .'?currPage=1' );
					} else {
						$currPage = $_GET['currPage'];
					}
					
				} else {
					$currPage = 1;	
				}
			
				$currPage -= 1;
				$items_per_page = 5;
				$offset = $currPage * $items_per_page;
				$showeachside = 3;
				
				//****** Count how many properties there are ********//
				$count_args = array(
					'author' => esc_attr($author_id),
					'post_type' => 'post_properties',
				);
				// Create the WP_User_Query object
				$wp_count_query = new WP_Query($count_args);
				
				// Get the results
				$properties_count = $wp_count_query->post_count;
					
				//Calculate how many pages there will be
				$total_pages = ceil($properties_count / $items_per_page);
				
				//echo 'Total pages = ' . $total_pages;
				
				wp_reset_postdata();
				
			
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        
				$args = array(
					'author' => esc_attr($author_id),
					'post_type' => 'post_properties',
					'posts_per_page' => $items_per_page,
					//'number' => $items_per_page,
					'offset' => $offset,
				);
				
				$author_posts = new WP_Query( $args );
				
								
			?>
			<ul class="pm-featured-properties-list">
            
			<?php if ($author_posts->have_posts()) : while ($author_posts->have_posts()) : $author_posts->the_post(); ?>
			
			<?php 

				$pm_properties_image_meta = get_post_meta(get_the_ID(), 'pm_properties_image_meta', true);
				$pm_properties_type_meta = get_post_meta(get_the_ID(), 'pm_properties_type_meta', true);
				$pm_properties_rental_type_meta = get_post_meta(get_the_ID(), 'pm_properties_rental_type_meta', true);
				$pm_properties_size_meta = get_post_meta(get_the_ID(), 'pm_properties_size_meta', true);
				$pm_properties_status_meta = get_post_meta(get_the_ID(), 'pm_properties_status_meta', true);
				$pm_properties_price_meta = get_post_meta(get_the_ID(), 'pm_properties_price_meta', true);
				
				if( $pm_properties_price_meta !== '' ){
					$formattedPrice = number_format($pm_properties_price_meta);
				} else {
					$formattedPrice = 0;	
				}
							
				$currencySymbol = get_theme_mod('currencySymbol', '$');
				
			?>
				
				<!-- Post -->
				<li>
					
					<div class="pm-featured-properties-list-thumb author-profile">
                    
                    	<img src="<?php echo esc_html($pm_properties_image_meta); ?>" alt="<?php the_title(); ?>" />
					
						<div class="pm-property-listing-ribbon"><?php echo esc_attr($pm_properties_status_meta) ?></div>
						<div class="pm-property-listing-ribbon-shadow"></div>
					
						<a class="fa fa-bars" href="<?php the_permalink(); ?>"></a>
					</div>
					<div class="pm-featured-properties-details author-profile">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						
						<?php 
																
							$term_value = get_term( $pm_properties_type_meta, 'propertysaletypes' );
							//echo '$pm_properties_type_meta = ' . $pm_properties_type_meta;
						
						?>
						
                        <?php $pm_properties_display_price_meta = get_option('pm_properties_display_price_meta'); //Yes is display to members only ?>
                        
                        <?php if($pm_properties_display_price_meta === 'no') { ?>
                        
                            <p class="price"> <?php echo esc_attr(ucfirst($term_value->name)); ?> &bull; <?php echo esc_attr($currencySymbol) . esc_attr($formattedPrice); ?><?php echo esc_attr($pm_properties_rental_type_meta) === 'default' ? '' : '/'.esc_attr($pm_properties_rental_type_meta).'' ?></p>
                        
                        <?php } else { ?>
                        
                        	<?php if( is_user_logged_in() ) { ?>
                            
                            	<p class="price"> <?php echo esc_attr(ucfirst($term_value->name)); ?> &bull; <?php echo esc_attr($currencySymbol) . esc_attr($formattedPrice); ?><?php echo esc_attr($pm_properties_rental_type_meta) === 'default' ? '' : '/'.esc_attr($pm_properties_rental_type_meta).'' ?></p>
                            	
                            <?php } else { ?>
                            
                            	<p class="price"> <?php echo esc_attr(ucfirst($term_value->name)); ?> </p>
                            
                            <?php } ?>                        	
                        
                        <?php } ?>                        
                        
                        
						<p class="footage"><?php echo esc_attr($pm_properties_size_meta); ?></p>
					</div>
				</li>
				<!-- Post end -->
								
			<?php endwhile; else: ?>
			<?php endif; ?>
			</ul>
                        
            <?php
			
				//PAGING SYSTEM
				if( $total_pages > 1 ){
					
					$author_url = esc_url( get_author_posts_url( $author_id ) ); 
					
					echo '<div class="pm-members-pagination-page-counter"><p>Page '.($currPage + 1).' of '.$total_pages.'</p></div>';
					
					echo '<ul class="pm-members-pagination">';
					
						//Build the first page Link
						if( ($currPage + 1 ) > 1 ) {
							
							if(isset($_GET['order'])){
								echo '<li><a href="'.$author_url.'?currPage=1&amp;order='.$_GET['order'].'"> &lt;&lt; </a></li>';
							} else {
								echo '<li><a href="'.$author_url.'?currPage=1"> &lt;&lt; </a></li>';
							}
							
						}
						
						//Build the Previous Link
						if( ($currPage + 1 ) > 1 ) {
							
							if(isset($_GET['order'])){
								echo '<li><a href="'.$author_url.'?currPage='.$currPage.'&amp;order='.$_GET['order'].'"> &lt; </a></li>';
							} else {
								echo '<li><a href="'.$author_url.'?currPage='.$currPage.'"> &lt; </a></li>';
							}
							
						}
						
						//Build the pages links
						for( $i = 1; $i <= $total_pages; $i++ ){
							
							//determines which pages to display in paging system
							if ( ($i > ($currPage - $showeachside)) && ($i < ($currPage + $showeachside)) ){
								
								if(isset($_GET['order'])){
									
									if(($currPage + 1) == $i){
										echo '<li><a href="'.$author_url.'?currPage='.$i.'&amp;order='.$_GET['order'].'" class="active"> '.$i.' </a>  </li>';
									} else {
										echo '<li><a href="'.$author_url.'?currPage='.$i.'&amp;order='.$_GET['order'].'"> '.$i.' </a>  </li>';	
									}                                                
									
								} else {
									
									if(($currPage + 1) == $i){
										echo '<li><a href="'.$author_url.'?currPage='.$i.'" class="active"> '.$i.' </a>  </li>';
									} else {
										echo '<li><a href="'.$author_url.'?currPage='.$i.'"> '.$i.' </a>  </li>';
									}
									
									
									
								}
								
							}//end of if()
							
						}//end of for loop
						
						//Build the Next Link
						if( ($currPage + 1 ) < $total_pages ) {
							
							if(isset($_GET['order'])){
								echo '<li><a href="'.$author_url.'?currPage='.($currPage + 2).'&amp;order='.$_GET['order'].'"> &gt; </a></li>';
							} else {
								echo '<li><a href="'.$author_url.'?currPage='.($currPage + 2).'"> &gt; </a></li>';
							}
							
						}
						
						//Build the Last page Link
						if( ($currPage + 1 ) < $total_pages ) {
							
							if(isset($_GET['order'])){
								echo '<li><a href="'.$author_url.'?currPage='.$total_pages.'&amp;order='.$_GET['order'].'"> &gt;&gt; </a>  </li>';
							} else {
								echo '<li><a href="'.$author_url.'?currPage='.$total_pages.'"> &gt;&gt; </a>  </li>';
							}
							
						}
															
						//PAGING SYSTEM END	
					
					echo '</ul>';
							
					
				}//end of paging system
			
			?>
            
		
        	<?php wp_reset_postdata(); ?>
            
            
        </div>
    </div>
                
</div>

<?php get_footer();
