<?php /* Template Name: Members Property Search Template */ ?>
<?php get_header(); ?>

<?php if(post_type_exists("post_properties")) : ?>

	<?php 

		if ( is_user_logged_in() ) { 
		
			//user is logged in, retrive user info
			$current_user = wp_get_current_user();
						
			$user_roles = $current_user->roles;
			$user_role = array_shift($user_roles);
			$user_role = str_replace('_', ' ', $user_role);
			$user_role = strtoupper($user_role);
		
		} else {
			wp_redirect( home_url('/') );
			exit;	
		}

	?>

	<?php

		//global $paged;	
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		
		$property_id = 0;
		
		if( isset( $_GET['property_id'] ) ) {
			$property_id = (int) $_GET['property_id'];
		}

		//echo '$property_id = ' . $property_id;
		
		//$post = get_post( $property_id ); 
		//print_r($post);

		$arguments = array(
			'author' => $current_user->ID,
			'post_type' => 'post_properties',
			'post_status' => 'publish',
			'p' => $property_id,
			//'paged' => $paged,
			//'order' => (string) $order,
			'posts_per_page' => '-1',
		);

		$query = new WP_Query($arguments);

		pm_ln_set_query($query);
		
		
	?>

	<?php get_template_part('content', 'membersnav'); ?>

	<div class="container pm-containerPadding-top-100 pm-containerPadding-bottom-80 pm-property-posts-no-sidebar">

		<div class="row">
					
			<div class="col-lg-12">
			
				<?php 
					$totalPosts = $query->found_posts;
				?>
				
				<?php if($totalPosts == 0) { ?>
					<h5 class="pm-property-search-results-title"><?php esc_html_e('No results found.','luxortheme'); ?></h5>
				<?php } elseif($totalPosts == 1) { ?>
					<h5 class="pm-property-search-results-title"><?php esc_html_e('Displaying','luxortheme'); ?> "<?php echo $query->found_posts; ?>" <?php esc_html_e('property search result','luxortheme'); ?></h5>
				<?php } else { ?>
					<h5 class="pm-property-search-results-title"><?php esc_html_e('Displaying','luxortheme'); ?> "<?php echo $query->found_posts; ?>" <?php esc_html_e('property search results','luxortheme'); ?></h5>
				<?php } ?>
	
				
				<div class="pm-property-search-results-divider"></div>           
				
				<ul class="pm-property-listings-list isotope" id="pm-isotope-item-container">
				
					<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
						
						<?php get_template_part( 'content', 'propertiesposteditable' ); ?>
					
					<?php endwhile; else: ?>
					<?php endif; ?>
				
				</ul>            
						
			</div>
				
		</div>

	</div>

	<?php pm_ln_restore_query(); ?>

<?php endif; ?>

<?php get_footer(); ?>