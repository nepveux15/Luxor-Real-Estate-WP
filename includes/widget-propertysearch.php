<?php

/*
Plugin Name: Property Search Widget 
Plugin URI: http://www.pulsarmedia.ca
Description: A widget that displays a property search module
Version: 1.0
Author: Pulsar Media
Author URI: http://www.pulsarmedia.ca
License: GPLv2
*/

// use widgets_init action hook to execute custom function
add_action('widgets_init', 'pm_property_search_widget');

//register our widget
function pm_property_search_widget() {
	register_widget('pm_property_search_widget');
}

//pm_property_search_widget class
class pm_property_search_widget extends WP_Widget {
	
	//process the new widget
	function pm_property_search_widget() {
	
		$widget_ops = array(
			'classname' => 'pm_property_search_widget',
			'description' => esc_html__('Property Search Module.','luxortheme')
		);
		
		parent::__construct('pm_property_search_widget', esc_html__('[Micro Themes] - Property Search Module','luxortheme'), $widget_ops);
		
	}//end of pm_widget_my_info function
	
	//build the widget settings form
	function form($instance){
		
		$defaults = array( 
			'title' => esc_html__('Search Properties', 'luxortheme'), 
			//'fa_icon' => 'fa fa-pencil',
			'results_page' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = $instance['title'];
		$results_page = $instance['results_page'];
		
		?>
        
        	<p><?php esc_html_e('Title:', 'luxortheme') ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
        
        	<p><?php esc_html_e('Results Page', 'luxortheme') ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('results_page')); ?>" type="text" value="<?php echo esc_attr($results_page); ?>" /></p>

                    
        <?php
		
	}//end of form function
	
	//save the widget settings
	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		//$instance['fa_icon'] = strip_tags( $new_instance['fa_icon'] );
		$instance['results_page'] = strip_tags( $new_instance['results_page'] );
		
		return $instance;
		
	}//end of update function
	
	//display the widget
	function widget($args, $instance){
		
		extract($args);
		
		echo $before_widget;
		$title = apply_filters( 'widget_title', $instance['title'] );
		//$fa_icon = '<i class="'. (empty( $instance['fa_icon'] ) ? 'fa fa-pencil' : $instance['fa_icon']) .' pm-sidebar-icon"></i> ';
		$results_page = empty( $instance['results_page'] ) ? '' : $instance['results_page'];
		
		if( !empty($title) ){
			
			echo $before_title . $title . $after_title;
			
		}//end of if
		
		
		echo '<div class="pm-sidebar-padding">';
			echo '<div class="pm-property-filter-container" id="pm-property-filter-container">';
			
				echo '<form id="pm-property-search-module-widget" action="'.site_url(''.$results_page.'').'" method="get">';
				
					echo '<input type="text" name="city" placeholder="City" class="pm-property-search-text-field widget" id="pm-property-search-city-field" />';
					
					echo '<div class="pm-dropdown widget pm-property-filter-system category" id="pm-property-filter-property-type">';
						echo '<div class="pm-dropmenu">';
							echo '<p class="pm-menu-title">'.esc_html__('Property Type','luxortheme').'</p>';
							echo '<i class="fa fa-angle-down"></i>';
						echo '</div>';
						echo '<div class="pm-dropmenu-active" id="pm-property-search-module-category-list">';
							echo '<ul id="pm-property-filter-type-list">';
							
							   $propertyCategories = get_terms( 'propertycats', array( 'hide_empty' => 1 ) );										
							   foreach($propertyCategories as $cat){
								   echo '<li><a href="#" data-option="'.$cat->name.'">'.$cat->name.'</a></li>'; 
							   }
							
							echo '</ul>';
						echo '</div>';
					echo '</div>';
					
					echo '<div class="pm-dropdown widget pm-property-filter-system type" id="pm-property-filter-property-status">';
						echo '<div class="pm-dropmenu">';
							echo '<p class="pm-menu-title">'.esc_html__('Sale Type','luxortheme').'</p>';
							echo '<i class="fa fa-angle-down"></i>';
						echo '</div>';
						echo '<div class="pm-dropmenu-active" id="pm-property-search-module-type-list">';
							echo '<ul id="pm-property-filter-status-list">';
							
								$propertySaleTypes = get_terms( 'propertysaletypes', array( 'hide_empty' => 1 ) );										
							    foreach($propertySaleTypes as $type){
								   echo '<li><a href="#" data-option="'.esc_attr($type->term_id).'" data-name="'.esc_attr($type->name).'">'.esc_attr($type->name).'</a></li>'; 
							    } 
							   
							echo '</ul>';
						echo '</div>';
					echo '</div>';
					
					echo '<input type="text" id="pm-amount-slider" readonly>';
					echo '<div id="pm-slider-range"></div>';
					echo '<input type="button" value="'.esc_html__('Search','luxortheme').'" class="pm-square-btn filter" id="pm-property-filter-submit-btn">';
					echo '<input type="hidden" name="type" value="" id="pm-property-search-type-field">';
					echo '<input type="hidden" name="category" value="" id="pm-property-search-category-field">';
					echo '<input type="hidden" name="min_price" value="1" id="pm-property-search-min-price-field">';
					echo '<input type="hidden" name="max_price" value="10000000" id="pm-property-search-max-price-field">';
				echo '</form>';
			echo '</div>';
		echo '</div>';
								
		echo $after_widget;
				
	}//end of widget function
	
}//end of class

?>