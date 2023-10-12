<?php /* Template Name: Members Property Listings Template */ ?>
<?php get_header(); ?>


<?php if(post_type_exists("post_properties")) : ?>

	<?php 
		$properties_posts_per_load = get_theme_mod('properties_posts_per_load', '4');
		//$getPageLayout = get_post_meta(get_the_ID(), 'pm_page_layout_meta', true);
		//$getBootstrapContainerPadding = get_post_meta(get_the_ID(), 'pm_bootstrap_container_padding_meta', true);
		$bootstrapContainerPadding = '100';
	?>

	<!-- MEMBERS NAVIGATION -->
	<?php get_template_part('content', 'membersnav'); ?>
	<!-- MEMBERS NAVIGATION end -->

	<?php 

		//Are we logged in?
		if ( is_user_logged_in() ) { 
		
			//Image handling
			include_once(get_template_directory() . '/includes/classes/upload.class.php');

			$img_error_status = '';
			$form_error = '';
		
			//Member area parameters
			$alertStatus = get_option('pm_member_email_alerts');
			$alertEmail = get_option('pm_admin_email_address');
		
			$form_success = true;
			$avatar_success = false;
			$bg_success = false;
			
			$my_info_success = false;
			
			//flag inappropriate fields
			$email_error = '';
			
			//user is logged in, retrive user info
			$current_user = wp_get_current_user();
			
			//capture changed information for email notification
			$info_array = array();
			$address_array = array();
			
			//wp_kses args
			$allowed_html = array(
				'a' => array(
					'href' => array(),
					'title' => array()
				),
				'br' => array(),
				'em' => array(),
				'strong' => array()
			);
			
			//echo 'Fax number = ' . $current_user->user_faxnumber;
			
			//$current_user->user_login //username
			//$current_user->user_email
			//$current_user->user_firstname
			//$current_user->user_lastname
			//$current_user->display_name
			//$current_user->ID 
			//$current_user->user_url
			//$current_user->user_pass
			//$current_user->user_identity
			
			//$current_user->user_prefix
			//$current_user->user_designation
			//$current_user->user_title
			//$current_user->user_organization
			//$current_user->user_workphone
			//$current_user->user_homephone
			//$current_user->user_faxnumber
			//$current_user->user_address
			//$current_user->user_city
			//$current_user->user_state
			//$current_user->user_zip
			//$current_user->user_country

			
		} else {
			
			//redirect page back to homepage
			wp_redirect( home_url('/') );
			exit;
			
		}

	?>

	<?php

		//global $paged;	
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		
		$order = 'DESC';
		
		if( isset( $_GET['order'] ) ) {
			
			$order = (string) $_GET['order'];
			
			if($order === 'price_ascending'){
				
				$arguments = array(
					'author' => $current_user->ID,
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
					'author' => $current_user->ID,
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
					'author' => $current_user->ID,
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
					'author' => $current_user->ID,
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
				'author' => $current_user->ID,
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
		
		//$count_posts = count_user_posts($current_user->ID, 'post_properties');
		$published_posts = count_user_posts($current_user->ID, 'post_properties');
		
	?>



	<!-- PANEL 2 -->
	<?php if($properties_posts_per_load !== '-1') { ?>
	<div class="container pm-containerPadding-top-<?php echo esc_attr($bootstrapContainerPadding); ?> pm-containerPadding-bottom-40 pm-property-posts-no-sidebar">
	<?php } else { ?>
	<div class="container pm-containerPadding<?php echo esc_attr($bootstrapContainerPadding); ?> pm-property-posts-no-sidebar">
	<?php } ?>


		<div class="row">
				
			<div class="col-lg-12">
			
				<?php if($published_posts > 0) : ?>
					<?php get_template_part( 'content', 'propertyfilter' ); ?>
				<?php endif; ?>
				
					
				<ul class="pm-property-listings-list isotope pm-list-mode" id="pm-isotope-item-container">
			
					<?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
					
						<?php get_template_part( 'content', 'propertiesposteditable' ); ?>
					
					<?php endwhile; else: ?>
						<li><p><?php esc_html_e('No properties were found.', 'luxortheme'); ?></p></li>
					<?php endif; ?>
				
				</ul>
							
				<?php pm_ln_restore_query(); ?> 
			
			</div>
		
		</div>

	</div>

	<?php if($published_posts > 0) : ?>

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
									<a href="#" class="fa fa-cloud-download" id="pm-load-more" data-name="propertieseditable" data-order="<?php echo esc_attr($order); ?>" data-authorid="<?php echo esc_attr($current_user->ID); ?>"></a>
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

<?php endif; ?>


<?php get_footer(); ?>