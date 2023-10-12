<?php

if(!class_exists('WPBakeryShortCode')) return;

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_pm_ln_datatable_group extends WPBakeryShortCodesContainer {
		
		protected function content($atts, $content = null) {

			//$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;
	
			extract(shortcode_atts(array(
				'el_id' => '',
				'el_title_bg_color' => '#7F6631',
				'el_title_color' => '#ffffff',
				'el_content_bg_color' => '#F4F4F4',
				'el_content_color' => '#ffffff',
			), $atts));
	
	
			/* ================  Render Shortcodes ================ */
	
			ob_start();
			
			$GLOBALS['pm_date_table_item_id'] = (int) $el_id;
			$GLOBALS['pm_date_table_item_count'] = 0;
			
			do_shortcode( $content );
	
			?>
			
            <!-- Element Code start -->
            
			<?php 
				//$img = wp_get_attachment_image_src($el_image, "large"); 
				//$imgSrc = $img[0];
				
				if( is_array( $GLOBALS['dataTableItems'. $GLOBALS['pm_date_table_item_id']] ) ){
	
					foreach( $GLOBALS['dataTableItems'. $GLOBALS['pm_date_table_item_id']] as $tableItem ){
						
						$items[] = '<div class="row"><div class="col-lg-4 col-md-4 col-sm-12 pm-workshop-table-title" style="background-color:'. esc_attr($el_title_bg_color) .';"><p style="color:'. esc_attr($el_title_color) .';">'.$tableItem['title'].'</p></div><div class="col-lg-8 col-md-8 col-sm-12 pm-workshop-table-content" style="background-color:'. esc_attr($el_content_bg_color) .';"><p style="color:'. esc_attr($el_content_color) .';">'.$tableItem['content'].'</p></div></div>';
						
					}
					
					//return wrapper plus dataTableItems
					echo '<div class="pm-workshop-table">'.implode( "\n", $items ).'</div>';
					
				}
				
			?>
            
			<!-- Element Code / END -->
	
			<?php
	
			$output = ob_get_clean();
	
			/* ================  Render Shortcodes ================ */
	
			return $output;
	
		}
		
    }
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_pm_ln_datatable_group_item extends WPBakeryShortCode {
		
		protected function content($atts, $content = null) {

			//$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;
	
			extract(shortcode_atts(array(
				"el_title" => '',
				), 
			$atts));
	
	
			/* ================  Render Shortcodes ================ */
	
			ob_start();
			
			$x = $GLOBALS['pm_date_table_item_count'];
	
			?>
			
			<?php 
				//$img = wp_get_attachment_image_src($el_image, "large"); 
				//$imgSrc = $img[0];
			?>
	
			<!-- Element Code start -->
			<?php 
			
				$x = $GLOBALS['pm_date_table_item_count'];

				$GLOBALS['dataTableItems' . $GLOBALS['pm_date_table_item_id']][$x] = array( 'title' => sprintf( $el_title, $GLOBALS['pm_date_table_item_count'] ), 'content' =>  do_shortcode($content) );
			
				$GLOBALS['pm_date_table_item_count']++;
			
			?>
            
			<!-- Element Code / END -->
	
			<?php
	
			$output = ob_get_clean();
	
			/* ================  Render Shortcodes ================ */
	
			return $output;
	
		}
		
    }
}


vc_map( array(
    "name" => __("Data Table", 'luxortheme'),
    "base" => "pm_ln_datatable_group",
	"category"  => __("Luxor Shortcodes", 'luxortheme'),
    "as_parent" => array('only' => 'pm_ln_datatable_group_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "show_settings_on_create" => false,
    "is_container" => true,
    "params" => array(
	
        // add params same as with any other content element	
		array(
            "type" => "dropdown",
            "heading" => __("Element ID", 'luxortheme'),
            "param_name" => "el_id",
            "description" => __("Assign a unique number value for this Data Table Menu. If you are creating multiple Data Table menus on a single page please make sure each Data Table menu has a unique number assigned to it to avoid any possible conflicts between Data table menus.", 'luxortheme'),
			"value"      => array( '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10' ), //Add default value in $atts
        ),

		
		array(
            "type" => "colorpicker",
            "heading" => __("Title Background Color", 'luxortheme'),
            "param_name" => "el_title_bg_color",
			"value" => '#7F6631'
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'luxortheme')
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Title Color", 'luxortheme'),
            "param_name" => "el_title_color",
			"value" => '#ffffff'
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'luxortheme')
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Content Background Color", 'luxortheme'),
            "param_name" => "el_content_bg_color",
			"value" => '#F4F4F4'
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'luxortheme')
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Content Color", 'luxortheme'),
            "param_name" => "el_content_color",
			"value" => '#ffffff'
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'luxortheme')
        ),
		
		
    ),
    "js_view" => 'VcColumnView'
) );

vc_map( array(
    "name" => __("Data Table Item", 'luxortheme'),
    "base" => "pm_ln_datatable_group_item",
	"category"  => __("Luxor Shortcodes", 'luxortheme'),
    "content_element" => true,
    "as_child" => array('only' => 'pm_ln_datatable_group'), // Use only|except attributes to limit parent (separate multiple values with comma)
    "params" => array(
	
        // add params same as with any other content element
        array(
            "type" => "textfield",
            "heading" => __("Title", 'luxortheme'),
            "param_name" => "el_title",
            //"description" => __("Enter a title", 'luxortheme'),
			"value" => ''
        ),
		
		array(
            "type" => "textarea_html",
            "heading" => __("Content", 'luxortheme'),
            "param_name" => "content",
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'luxortheme')
        ),
		
		
				
		
    )
) );