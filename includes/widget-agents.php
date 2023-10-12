<?php

/*
Plugin Name: Agent Posts Widget 
Plugin URI: http://www.pulsarmedia.ca
Description: A widget that displays your agent posts
Version: 1.0
Author: Pulsar Media
Author URI: http://www.pulsarmedia.ca
License: GPLv2
*/

// use widgets_init action hook to execute custom function
add_action('widgets_init', 'pm_agent_posts_widget');

//register our widget
function pm_agent_posts_widget() {
	register_widget('pm_agent_posts_widget');
}

//pm_agent_posts_widget class
class pm_agent_posts_widget extends WP_Widget {
	
	//process the new widget
	function pm_agent_posts_widget() {
	
		$widget_ops = array(
			'classname' => 'pm_agent_posts_widget',
			'description' => esc_html__('Display agent posts with style.','luxortheme')
		);
		
		parent::__construct('pm_agent_posts_widget', esc_html__('[Micro Themes] - Agent Posts','luxortheme'), $widget_ops);
		
	}//end of pm_widget_my_info function
	
	//build the widget settings form
	function form($instance){
		
		$defaults = array( 
			'title' => esc_html__('Agent Posts', 'luxortheme'), 
			//'fa_icon' => 'fa fa-pencil',
			'numOfPosts' => '3',
			'postFilter' => 'no'
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = $instance['title'];
		$numOfPosts = $instance['numOfPosts'];
		
		?>
        
        	<p><?php esc_html_e('Title:', 'luxortheme') ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

            <p><?php esc_html_e('Number of Agents to display:', 'luxortheme') ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('numOfPosts')); ?>" type="text" value="<?php echo esc_attr($numOfPosts); ?>" /></p>
           
                    
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
			'post_type' => 'post_agents',
			'post_status' => 'publish',
			//'posts_per_page' => -1,
			'posts_per_page' => $numOfPosts,
			//'tag' => get_query_var('tag')
		);
	
		$query = new WP_Query($arguments);
	
		pm_ln_set_query($query);
		
		echo '<ul class="pm-top-agents-list">';		
		
		if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
		
			$pm_agent_image_meta = get_post_meta(get_the_ID(), 'pm_agent_image_meta', true);
			$pm_agent_business_phone_meta = get_post_meta(get_the_ID(), 'pm_agent_business_phone_meta', true);
			$pm_agent_email_address_meta = get_post_meta(get_the_ID(), 'pm_agent_email_address_meta', true);
		
			echo '<li>';
                                    	
				echo '<div class="pm-top-agents-avatar">';
					echo '<img src="'. esc_html($pm_agent_image_meta) .'" alt="'. get_the_title() .'" />';
				echo '</div>';
				echo '<div class="pm-top-agents-details">';
					echo '<p class="name">'.get_the_title().'</p>';
					echo '<p class="contact-number">'.esc_attr($pm_agent_business_phone_meta).'</p>';
					echo '<a href="mailto:'.esc_attr($pm_agent_email_address_meta).'">'.esc_attr($pm_agent_email_address_meta).'</a>';
					echo '<a href="'.get_the_permalink().'" class="pm-top-agents-details-btn">'.esc_html__('View Profile','luxortheme').'</a>';
				echo '</div>';
				echo '<div class="pm-top-agents-border"></div>';
			echo '</li>';
		
		endwhile; else:
		
		endif;
		
		echo '</ul>';
		
		pm_ln_restore_query(); 
						
		echo $after_widget;
				
	}//end of widget function
	
}//end of class

?>