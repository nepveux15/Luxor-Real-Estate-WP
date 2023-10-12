<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_micro_slider extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			'el_class' => '',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();
		
		$enableFixedHeight = get_theme_mod('enableFixedHeight', 'true');
		global $luxor_options;
		$slides = '';
	
        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <?php 
			if( isset($luxor_options['opt-pulse-slides']) && !empty($luxor_options['opt-pulse-slides']) ){
				$slides = $luxor_options['opt-pulse-slides'];
			} 
		?>
        
        <?php 
		
		if(is_array($slides)) :
                    
            $sliderCounter = 0;
    
            if(count($slides) > 0){
                
                echo '<div class="pm-pulse-container" id="pm-pulse-container">';
                
                    echo '<div id="pm-pulse-loader"><img src="'.get_template_directory_uri().'/js/pulse/img/ajax-loader.gif" alt="'.esc_html__('slider loading', 'luxortheme').'" /></div>';
                    
                    echo '<div id="pm-slider" class="pm-slider'. ($enableFixedHeight === 'false' ? ' scalable' : '') .'">';
                    
                        echo '<div id="pm-slider-progress-bar"></div>';
                        
                        echo '<ul class="pm-slides-container" id="pm_slides_container">';
                        
                            foreach($slides as $s) {
                                
                                $title = '';
                                $subTitle = '';
                                $btnText = '';
                                $btnUrl = '';
                                                                    
                                if(!empty($s['title'])){
                                    $titlePieces = explode(" - ", $s['title']);
                                    $title = $titlePieces[0];
                                    $subTitle = $titlePieces[1];
                                }
                                
                                if(!empty($s['url'])){
                                    $pieces = explode(" - ", $s['url']);
                                    $btnText = $pieces[0];
                                    $btnUrl = $pieces[1];
                                }
                                
                                echo '<li data-thumb="'.$s['image'].'" class="pmslide_'.$sliderCounter.'"><img src="'.$s['image'].'" alt="Slider image '.$sliderCounter.'" />';
                
                                    echo '<div class="pm-holder'. ($enableFixedHeight === 'false' ? ' scalable' : '') .'">';
                                        echo '<div class="pm-caption'. ($enableFixedHeight === 'false' ? ' scalable' : '') .'">';
                                        
                                              if( !empty($s['title']) ) :
                                                  echo '<h1>'.esc_html__($title, 'luxortheme').'</h1>';
                                              endif;
                                              
                                              if( !empty($s['title']) ) :
                                              
                                                  echo '<span class="pm-caption-decription'. ($enableFixedHeight === 'false' ? ' scalable' : '') .'">';
                                                    echo esc_html__($subTitle, 'luxortheme');
                                                  echo '</span>';
                                                  
                                              endif;
                                              
                                              if( !empty($s['description']) ) :
                                              
                                                  echo '<span class="pm-caption-excerpt'. ($enableFixedHeight === 'false' ? ' scalable' : '') .'">';
                                                    echo esc_html__($s['description'], 'luxortheme');
                                                  echo '</span>';
                                              
                                              endif;
                                              
                                              if( !empty($s['description']) ) :
                                              
                                                  echo '<a href="'.$btnUrl.'" class="pm-slide-btn'. ($enableFixedHeight === 'false' ? ' scalable' : '') .'">'.esc_html__($btnText, 'luxortheme').' <i class="fa fa-plus"></i></a>';
                                                
                                              endif;
                                              
                                              
                                        echo '</div>';
                                    echo '</div>';
                                
                                echo '</li> ';
                                
                                $sliderCounter++;
                                        
                            }
                                                        
                        echo '</ul>';
                    
                    echo '</div>';
                
                echo '</div>';
                
            }//end of if		
        
        endif;//endif 
		
		?>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_micro_slider",
    "name"      => __("Micro Slider", 'luxortheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Luxor Shortcodes", 'luxortheme'),
    "params"    => array(
	
		/*array(
            "type" => "textfield",
            "heading" => __("Class", 'luxortheme'),
            "param_name" => "el_class",
            "description" => __("Enter a CSS class if required.", 'luxortheme')
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Divider Style", 'luxortheme'),
            "param_name" => "divider_style",
            "description" => __("Choose the divider style you desire.", 'luxortheme'),
			"value"      => array( 'simple' => 'simple', 'title' => 'title', 'column' => 'column', 'fancy' => 'fancy' ), //Add default value in $atts
        ),
		
		array(
            "type" => "textarea",
            "heading" => __("Description", 'luxortheme'),
            "param_name" => "el_description",
            "description" => __("Enter a short description for your service.", 'luxortheme')
        ),
		
		array(
            "type" => "textarea_html",
            "heading" => __("Description", 'luxortheme'),
            "param_name" => "el_description",
            "description" => __("Enter a short description for your service.", 'luxortheme')
        ),
		
		array(
            "type" => "attach_image",
            "heading" => __("Image", 'luxortheme'),
            "param_name" => "el_image",
            "description" => __("Enter an image path for the image you would like to represent your service.", 'luxortheme')
        ),*/

    )

));