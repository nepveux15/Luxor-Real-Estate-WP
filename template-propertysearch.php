<?php /* Template Name: Property Search Results Template */ ?>
<?php get_header(); ?>

<?php if(post_type_exists("post_galleries")) : ?>

	<?php

		//global $paged;	
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		
		$city = '';
		$category = '';
		$type = '';
		$min_price = '';
		$max_price = '';
		$min_price_default = 0;
		$max_price_default = 0;
		
		if( isset( $_GET['city'] ) ) {
			$city = (string) $_GET['city'];
		}
		
		if( isset( $_GET['category'] ) ) {		
			$category = (string) $_GET['category'];		
		}
		
		if( isset( $_GET['type'] ) ) {
			$type = (string) $_GET['type'];
		}
		
		if( isset( $_GET['min_price'] ) ) {		
			$min_price = (int) $_GET['min_price'] > 0 ? (int) $_GET['min_price'] : (int) $min_price_default;
			//echo '$min_price = ' . $min_price;		
		} 
		
		if( isset( $_GET['max_price'] ) ) {			
			$max_price = (int) $_GET['max_price'] > 0 ? (int) $_GET['max_price'] : (int) $max_price_default;
			//echo '$max_price = ' . $max_price;		
		}

		//echo 'city = ' . $city . ' category = ' . $category . ' type = ' . $type . ' min_price = ' . $min_price . ' max_price = ' . $max_price;

		if( $min_price > 0 && $max_price > 0 ) {
			
			$arguments = array(
				'post_type' => 'post_properties',
				'post_status' => 'publish',
				//'paged' => $paged,
				//'order' => (string) $order,
				'posts_per_page' => '-1',
				'meta_query' => array(
					//'relation' => 'LIKE',
					array(
					'key'   => 'pm_properties_type_meta', 
					'value' => $type,
					'compare' => 'AND'
					),
					array(
					'key'   => 'pm_properties_city_meta', 
					'value' => $city !== '' ? $city : '',
					'compare' => 'LIKE'
					),
					array(
					'key'     => 'pm_properties_price_meta',
					'value'   => array( intval($min_price), intval($max_price) ),
					'compare' => 'BETWEEN',
					'type'    => 'NUMERIC' //NUMERIC
					) 
				),		
				'tax_query' => array(
					//'relation' => 'AND',
					array(
					'taxonomy' => 'propertycats',
					'field' => 'slug',
					'terms' => $category,
					'compare' => 'LIKE'
					)
				),		
				//'tag' => get_query_var('tag')
			);
			
		} else {
			
			$arguments = array(
				'post_type' => 'post_properties',
				'post_status' => 'publish',
				//'paged' => $paged,
				//'order' => (string) $order,
				'posts_per_page' => '-1',
				'meta_query' => array(
					//'relation' => 'LIKE',
					array(
					'key'   => 'pm_properties_type_meta', 
					'value' => $type,
					'compare' => 'AND'
					),
					array(
					'key'   => 'pm_properties_city_meta', 
					'value' => $city !== '' ? $city : '',
					'compare' => 'LIKE'
					),
				),		
				'tax_query' => array(
					//'relation' => 'AND',
					array(
					'taxonomy' => 'propertycats',
					'field' => 'slug',
					'terms' => $category,
					'compare' => 'LIKE'
					)
				),		
				//'tag' => get_query_var('tag')
			);
			
		}

		

		$query = new WP_Query($arguments);

		pm_ln_set_query($query);
		
		
	?>

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
					
				<?php if($totalPosts > 0) : ?>
					<?php get_template_part( 'content', 'propertyfiltersearch' ); ?>
				<?php endif; ?>
				
				<div class="pm-property-search-results-divider"></div>           
				
				<ul class="pm-property-listings-list isotope" id="pm-isotope-item-container">
				
					<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
						
						<?php get_template_part( 'content', 'propertiespost' ); ?>
					
					<?php endwhile; else: ?>
					<?php endif; ?>
				
				</ul>            
						
			</div>
				
		</div>

	</div>

	<?php pm_ln_restore_query(); ?>

<?php endif; ?>

<?php get_footer(); ?>