<?php

/*
Plugin Name: Agency Posts Widget 
Plugin URI: http://www.pulsarmedia.ca
Description: A widget that displays your agency posts
Version: 1.0
Author: Pulsar Media
Author URI: http://www.pulsarmedia.ca
License: GPLv2
*/

// use widgets_init action hook to execute custom function
add_action('widgets_init', 'pm_agency_posts_widget');

//register our widget
function pm_agency_posts_widget() {
	register_widget('pm_agency_posts_widget');
}

//pm_agency_posts_widget class
class pm_agency_posts_widget extends WP_Widget {
	
	//process the new widget
	function pm_agency_posts_widget() {
	
		$widget_ops = array(
			'classname' => 'pm_agency_posts_widget',
			'description' => esc_html__('Display agency posts with style.','luxortheme')
		);
		
		parent::__construct('pm_agency_posts_widget', esc_html__('[Micro Themes] - Agency Posts','luxortheme'), $widget_ops);
		
	}//end of pm_widget_my_info function
	
	//build the widget settings form
	function form($instance){
		
		$defaults = array( 
			'title' => esc_html__('Agency Posts', 'luxortheme'), 
			//'fa_icon' => 'fa fa-pencil',
			'numOfPosts' => '3',
			'postFilter' => 'no'
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = $instance['title'];
		$numOfPosts = $instance['numOfPosts'];
		
		?>
        
        	<p><?php esc_html_e('Title:', 'luxortheme') ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

            <p><?php esc_html_e('Number of Agencies to display:', 'luxortheme') ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('numOfPosts')); ?>" type="text" value="<?php echo esc_attr($numOfPosts); ?>" /></p>
           
                    
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
			'post_type' => 'post_agencies',
			'post_status' => 'publish',
			//'posts_per_page' => -1,
			'posts_per_page' => $numOfPosts,
			//'tag' => get_query_var('tag')
		);
	
		$query = new WP_Query($arguments);
	
		pm_ln_set_query($query);
		
		echo '<ul class="pm-agencies-list">';		
		
		if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
		
			$pm_agencies_logo_meta = get_post_meta(get_the_ID(), 'pm_agencies_logo_meta', true);
			$pm_agencies_phone_meta = get_post_meta(get_the_ID(), 'pm_agencies_phone_meta', true);
			$pm_agencies_email_address_meta = get_post_meta(get_the_ID(), 'pm_agencies_email_address_meta', true);
			$pm_agencies_address_meta = get_post_meta(get_the_ID(), 'pm_agencies_address_meta', true);
			$pm_agencies_state_meta = get_post_meta(get_the_ID(), 'pm_agencies_state_meta', true);
			$pm_agencies_country_meta = get_post_meta(get_the_ID(), 'pm_agencies_country_meta', true);
			$pm_agencies_zip_meta = get_post_meta(get_the_ID(), 'pm_agencies_zip_meta', true);
			$pm_agencies_address_lat_meta = get_post_meta(get_the_ID(), 'pm_agencies_address_lat_meta', true);
			$pm_agencies_address_long_meta = get_post_meta(get_the_ID(), 'pm_agencies_address_long_meta', true);
		
			echo '<li>';
				echo '<div class="pm-agencies-list-avatar">';
					echo '<a href="'.get_the_permalink().'"><img src="'. esc_html($pm_agencies_logo_meta) .'" alt="'. get_the_title() .'"/></a>';
				echo '</div>';
				echo '<div class="pm-agencies-list-details">';
					echo '<a href="'.get_the_permalink().'"><p class="name">'. get_the_title() .'</p></a>';
					echo '<p class="contact-number">'.esc_attr($pm_agencies_phone_meta).'</p>';
					echo '<a href="mailto:'.$pm_agencies_email_address_meta.'" class="contact-number">'.esc_attr($pm_agencies_email_address_meta).'</a>';
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