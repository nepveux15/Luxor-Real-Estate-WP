<?php

/*

Plugin Name: MailChimp Widget 
Plugin URI: http://www.pulsarmedia.ca
Description: A widget that displays a mailchimp newsletter signup form
Version: 1.0
Author: Pulsar Media
Author URI: http://www.pulsarmedia.ca
License: GPLv2

*/

// use widgets_init action hook to execute custom function
add_action('widgets_init', 'pm_newsletter_widget');

//register our widget
function pm_newsletter_widget() {
	register_widget('pm_mailchimp_widget');
}

//pm_mailchimp_widget class
class pm_mailchimp_widget extends WP_Widget {
	
	//process the new widget
	function pm_mailchimp_widget() {
	
		$widget_ops = array(
			'classname' => 'pm_mailchimp_widget',
			'description' => esc_html__('Setup a mailchimp powered newsletter signup form','luxortheme')
		);
		
		parent::__construct('pm_mailchimp_widget', esc_html__('[Micro Themes] - Mailchimp Newsletter Form','luxortheme'), $widget_ops);
		
	}//end of pm_widget_my_info function
	
	//build the widget settings form
	function form($instance){
		
		$defaults = array( 
			'title' => esc_html__('Subscribe to our newsletter', 'luxortheme'),  
			//'subtitle' => 'Stay up to date',
			'desc' => '',
			'color' => 'Light',
			'url' => '',
			'unsuburl' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = $instance['title'];
		//$subtitle = $instance['subtitle'];
		$desc = $instance['desc'];
		$color = $instance['color'];
		$url = $instance['url'];
		$unsuburl = $instance['unsuburl'];
		
		?>
        
        
        	<p><?php esc_html_e('Title','luxortheme') ?>: <input class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
            
            
            <p><?php esc_html_e('Description','luxortheme') ?>: <textarea class="widefat" name="<?php echo esc_attr($this->get_field_name('desc')); ?>" cols="3" rows="3"><?php echo esc_attr($desc); ?></textarea></p>
            
            <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'color' )); ?>"><?php esc_html_e('Form Color:', 'luxortheme') ?></label>
            <select id="<?php echo esc_attr($this->get_field_id( 'color' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'color' )); ?>" class="widefat">
                <option <?php if ( 'Light' == $instance['color'] ) echo 'selected="selected"'; ?>><?php esc_html_e('Light', 'luxortheme') ?></option>
                <option <?php if ( 'Dark' == $instance['color'] ) echo 'selected="selected"'; ?>><?php esc_html_e('Dark', 'luxortheme') ?></option>
            </select>
            </p>
            <p><?php esc_html_e('Newsletter URL','luxortheme') ?>: <input class="widefat" name="<?php echo esc_attr($this->get_field_name('url')); ?>" type="text" value="<?php echo esc_attr($url); ?>" /></p>
            <p><?php esc_html_e('Unsubscribe URL','luxortheme') ?>: <input class="widefat" name="<?php echo esc_attr($this->get_field_name('unsuburl')); ?>" type="text" value="<?php echo esc_attr($unsuburl); ?>" /></p>
                    
        <?php
		
	}//end of form function
	
	//save the widget settings
	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		//$instance['subtitle'] = strip_tags( $new_instance['subtitle'] );
		$instance['desc'] = strip_tags( $new_instance['desc'] );
		$instance['color'] = strip_tags( $new_instance['color'] );
		$instance['url'] = strip_tags( $new_instance['url'] );
		$instance['unsuburl'] = strip_tags( $new_instance['unsuburl'] );
		
		return $instance;
		
	}//end of update function
	
	//display the widget
	function widget($args, $instance){
		
		extract($args);
		
		echo $before_widget;
		$title = apply_filters( 'widget_title', $instance['title'] );
		//$subtitle = $instance['subtitle'];
		$desc = empty( $instance['desc'] ) ? '' : $instance['desc'];
		$color = $instance['color'];
		$url = empty( $instance['url'] ) ? '' : $instance['url'];
		$unsuburl = empty( $instance['unsuburl'] ) ? '' : $instance['unsuburl'];
		
		if( !empty($title) ){
			
			echo  $before_title . $title . $after_title;
			
		}//end of if
		
		echo '<div class="pm-sidebar-padding">';
		
		//form code here
		if(trim($desc) !== ''){
			echo '<p style="margin-bottom:20px;">'.$desc.'</p>';
		}
		
		echo '<form action="'.htmlspecialchars(esc_html($url)).'" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>  
			<input name="MERGE1" type="text" class="pm_quick_contact_field '.esc_attr($color).'" id="MERGE1" placeholder="'.esc_html__('first name','luxortheme').'">
			<input name="MERGE0" type="email" class="pm_quick_contact_field '.esc_attr($color).'" id="MERGE0" placeholder="'.esc_html__('email address','luxortheme').'">
			<input name="subscribe" id="mc-embedded-subscribe" type="submit" value="'.esc_html__('Subscribe','luxortheme').'" class="pm_mailchimp_submit">
		</form>';
		
		echo '
			<p class="pm-center" style="margin-top:10px; font-size:12px;">'.esc_html__('To unsubscribe', 'luxortheme').' <a href="'.esc_html($unsuburl).'" class="pm-secondary" style="font-size:12px;" target="_blank">'.esc_html__('click here', 'luxortheme').'</a></p></div>
		';
				
		echo $after_widget;
		
	}//end of widget function
	
}//end of class

?>