<?php

/*
Plugin Name: Recent Posts Widget 
Plugin URI: http://www.pulsarmedia.ca
Description: A widget that displays your most recent posts
Version: 1.0
Author: Pulsar Media
Author URI: http://www.pulsarmedia.ca
License: GPLv2
*/

// use widgets_init action hook to execute custom function
add_action('widgets_init', 'pm_recent_posts_widget');

//register our widget
function pm_recent_posts_widget() {
	register_widget('pm_recentposts_widget');
}

//pm_recentposts_widget class
class pm_recentposts_widget extends WP_Widget {
	
	//process the new widget
	function pm_recentposts_widget() {
	
		$widget_ops = array(
			'classname' => 'pm_recentposts_widget',
			'description' => esc_html__('Display recent posts with style.','luxortheme')
		);
		
		parent::__construct('pm_recentposts_widget', esc_html__('[Micro Themes] - Recent Posts','luxortheme'), $widget_ops);
		
	}//end of pm_widget_my_info function
	
	//build the widget settings form
	function form($instance){
		
		$defaults = array( 
			'title' => esc_html__('Recent Posts', 'luxortheme'), 
			//'fa_icon' => 'fa fa-pencil',
			'numOfPosts' => '3',
			'postFilter' => 'no'
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = $instance['title'];
		$numOfPosts = $instance['numOfPosts'];
		$postFilter = $instance['postFilter'];
		
		?>
        
        	<p><?php esc_html_e('Title:', 'luxortheme') ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

            <p><?php esc_html_e('Number of Posts to display:', 'luxortheme') ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('numOfPosts')); ?>" type="text" value="<?php echo esc_attr($numOfPosts); ?>" /></p>
            <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'postFilter' )); ?>"><?php esc_html_e('Order posts by most likes?', 'luxortheme'); ?></label>
            <select id="<?php echo esc_attr($this->get_field_id( 'postFilter' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'postFilter' )); ?>" class="widefat">
                <option <?php if ( 'no' == $instance['postFilter'] ) echo 'selected="selected"'; ?> value="no"><?php esc_html_e('No', 'luxortheme') ?></option>
                <option <?php if ( 'yes' == $instance['postFilter'] ) echo 'selected="selected"'; ?> value="yes"><?php esc_html_e('Yes', 'luxortheme') ?></option>
            </select>
            </p>
                    
        <?php
		
	}//end of form function
	
	//save the widget settings
	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		//$instance['fa_icon'] = strip_tags( $new_instance['fa_icon'] );
		$instance['numOfPosts'] = strip_tags( $new_instance['numOfPosts'] );
		$instance['postFilter'] = $new_instance['postFilter'];
		
		return $instance;
		
	}//end of update function
	
	//display the widget
	function widget($args, $instance){
		
		extract($args);
		
		echo $before_widget;
		$title = apply_filters( 'widget_title', $instance['title'] );
		//$fa_icon = '<i class="'. (empty( $instance['fa_icon'] ) ? 'fa fa-pencil' : $instance['fa_icon']) .' pm-sidebar-icon"></i> ';
		$numOfPosts = empty( $instance['numOfPosts'] ) ? '3' : $instance['numOfPosts'];
		$postFilter = empty( $instance['postFilter'] ) ? 'no' : $instance['postFilter'];
		
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
		if($postFilter === 'yes'){
			
			//filter by most likes
			$args = array(
					'numberposts' => $numOfPosts,
					'offset' => 0,
					'category' => 0,
					'order' => 'DESC',
					'include' => '',
					'exclude' => '',
					'meta_key' => 'pm_total_likes',
					'orderby' => 'meta_value_num',
					'post_type' => 'post',
					'post_status' => 'publish',
					'suppress_filters' => true 
			);
			
		} else {
		
			//filter by most recent
			$args = array(
					'numberposts' => $numOfPosts,
					'offset' => 0,
					'category' => 0,
					'orderby' => 'post_date',
					'order' => 'DESC',
					'include' => '',
					'exclude' => '',
					'meta_key' => '',
					'meta_value' => '',
					'post_type' => 'post',
					'post_status' => 'publish',
					'suppress_filters' => true 
			);
			
		}
				
						
		$recent_posts = wp_get_recent_posts($args, ARRAY_A);
		
		echo '<ul class="pm-recent-blog-posts">';
		
		//front-end widget code here
		foreach( $recent_posts as $recent ){
			
			$featuredPostThumb = wp_get_attachment_image_src( get_post_thumbnail_id( $recent["ID"] ), 'featured-thumb' );
			//$featuredPostThumb = wp_get_attachment_thumb_url( get_post_thumbnail_id( $recent["ID"] ), 'full' );
			$excerpt = $recent["post_excerpt"];
			$title = $recent["post_title"];
			$excerpt = $recent["post_excerpt"];
			$date = $recent["post_date"];
			$month = date("M", strtotime($date));
			$day = date("d", strtotime($date));
			$year = date("Y", strtotime($date));
			$author = $recent["post_author"];
			$user_info = get_userdata($author);
			
			echo '<li>';
				if($featuredPostThumb !== '') :
					echo '<div class="pm-recent-blog-post-thumb" style="background-image:url('.$featuredPostThumb[0].');"></div>';
				endif; 
				echo '<div class="pm-recent-blog-post-details">';
					echo '<a href="'.get_permalink($recent["ID"]).'">'.pm_ln_string_limit_words($title,9) .'</a>';
					
					if($user_info){
						echo '<p class="pm-date-published">'. $user_info->display_name  .' / '.$month.' '.$day.' '.$year.' / <a href="https://twitter.com/share?url='. urlencode(get_permalink($recent["ID"])) .'&amp;text='. urlencode(get_the_title($recent["ID"])) .'" target="_blank" class="fa fa-twitter pm_tip_static_top pm_tip_arrow_bottom" data-tip-offset-y="-15" data-tip-offset-x="18" title="'. esc_html__('Tweet This!', 'luxortheme') .'"></a> </p>';
					} else {
						echo '<p class="pm-date-published">'.$month.' '.$day.' '.$year.' / <a href="https://twitter.com/share?url='. urlencode(get_permalink($recent["ID"])) .'&amp;text='. urlencode(get_the_title($recent["ID"])) .'" target="_blank" class="fa fa-twitter pm_tip_static_top pm_tip_arrow_bottom" data-tip-offset-y="-15" data-tip-offset-x="18" title="'. esc_html__('Tweet This!', 'luxortheme') .'"></a></p>';	
					}
					
					
				echo '</div>';
			echo '</li>';
			
		}//end of foreach
		
		echo '</ul>';
						
		echo $after_widget;
				
	}//end of widget function
	
}//end of class

?>