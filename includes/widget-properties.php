<?php

/*
Plugin Name: Properties Posts Widget 
Plugin URI: http://www.pulsarmedia.ca
Description: A widget that displays your property posts
Version: 1.0
Author: Pulsar Media
Author URI: http://www.pulsarmedia.ca
License: GPLv2
*/

// use widgets_init action hook to execute custom function
add_action('widgets_init', 'pm_properties_posts_widget');

//register our widget
function pm_properties_posts_widget() {
	register_widget('pm_properties_posts_widget');
}

//pm_properties_posts_widget class
class pm_properties_posts_widget extends WP_Widget {
	
	//process the new widget
	function pm_properties_posts_widget() {
	
		$widget_ops = array(
			'classname' => 'pm_properties_posts_widget',
			'description' => esc_html__('Display property posts with style.','luxortheme')
		);
		
		parent::__construct('pm_properties_posts_widget', esc_html__('[Micro Themes] - Property Posts','luxortheme'), $widget_ops);
		
	}//end of pm_widget_my_info function
	
	//build the widget settings form
	function form($instance){
		
		$defaults = array( 
			'title' => esc_html__('Property Posts', 'luxortheme'), 
			//'fa_icon' => 'fa fa-pencil',
			'numOfPosts' => '3',
			'postFilter' => 'no'
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = $instance['title'];
		$numOfPosts = $instance['numOfPosts'];
		
		?>
        
        	<p><?php esc_html_e('Title:', 'luxortheme') ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

            <p><?php esc_html_e('Number of Properties to display:', 'luxortheme') ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('numOfPosts')); ?>" type="text" value="<?php echo esc_attr($numOfPosts); ?>" /></p>
           
                    
        <?php
		
	}//end of form function
	
	//save the widget settings
	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		//$instance['fa_icon'] = strip_tags( $new_instance['fa_icon'] );
		$instance['numOfPosts'] = strip_tags( $new_instance['numOfPosts'] );
		
		return $instance;
		
	}//end of update function
	
	//display the widget
	function widget($args, $instance){
		
		extract($args);
		
		echo $before_widget;
		$title = apply_filters( 'widget_title', $instance['title'] );
		//$fa_icon = '<i class="'. (empty( $instance['fa_icon'] ) ? 'fa fa-pencil' : $instance['fa_icon']) .' pm-sidebar-icon"></i> ';
		$numOfPosts = empty( $instance['numOfPosts'] ) ? '3' : $instance['numOfPosts'];
		
		if( !empty($title) ){
			
			echo $before_title . $title . $after_title;
			
		}//end of if
		
		/*
		post_author 
		post_date
		post_date_gmt
		post_content
		post_title
		post_category
		post_excerpt
		post_status
		comment_status 
		ping_status
		post_name
		comment_count 
		*/
		
		//retrieve recent posts
		$arguments = array(
			'post_type' => 'post_properties',
			'post_status' => 'publish',
			//'posts_per_page' => -1,
			'posts_per_page' => $numOfPosts,
			//'tag' => get_query_var('tag')
		);
	
		$query = new WP_Query($arguments);
	
		pm_ln_set_query($query);
		
		echo '<ul class="pm-featured-properties-list">';		
		
		if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
		
			$pm_properties_thumb_image_meta = get_post_meta(get_the_ID(), 'pm_properties_thumb_image_meta', true);
			$pm_properties_type_meta = get_post_meta(get_the_ID(), 'pm_properties_type_meta', true);
			$pm_properties_rental_type_meta = get_post_meta(get_the_ID(), 'pm_properties_rental_type_meta', true);
			$pm_properties_size_meta = get_post_meta(get_the_ID(), 'pm_properties_size_meta', true);
			$pm_properties_status_meta = get_post_meta(get_the_ID(), 'pm_properties_status_meta', true);
			$pm_properties_price_meta = get_post_meta(get_the_ID(), 'pm_properties_price_meta', true);
			
			if($pm_properties_price_meta !== ''){
				$formattedPrice = number_format($pm_properties_price_meta);
			} else {
				$formattedPrice = 0;
			}
			
			$currencySymbol = get_theme_mod('currencySymbol', '$');
			$currenySymbolPosition = get_theme_mod('currenySymbolPosition', 'left');

		
			echo '<li>';                 	
				echo '<div class="pm-featured-properties-list-thumb" style="background-image:url('.esc_html($pm_properties_thumb_image_meta).')">';
				
					echo '<div class="pm-property-listing-ribbon">'. esc_attr($pm_properties_status_meta) .'</div>';
        			echo '<div class="pm-property-listing-ribbon-shadow"></div>';
				
					echo '<a href="'.get_the_permalink().'" class="fa fa-bars"></a>';
					
				echo '</div>';
				echo '<div class="pm-featured-properties-details">';
					echo '<a href="'.get_the_permalink().'">'. get_the_title() .'</a>';
					
					$term_value = get_term( $pm_properties_type_meta, 'propertysaletypes' );
					
					echo '<p class="price">'.esc_attr(ucfirst($term_value->name)).' <span>&bull;</span> '. ($currenySymbolPosition == 'left' ? $currencySymbol . esc_attr($formattedPrice) : esc_attr($formattedPrice) . $currencySymbol) .' '. ($pm_properties_rental_type_meta === 'default' ? '' : '/'.$pm_properties_rental_type_meta.'') .'</p>';
					
					echo '<p class="footage">'.esc_attr($pm_properties_size_meta).'</p>';
				echo '</div>';
			echo '</li>';
		
		endwhile; else:
		
		endif;
		
		echo '</ul>';
		
		pm_ln_restore_query(); 
						
		echo $after_widget;
				
	}//end of widget function
	
}//end of class

?>