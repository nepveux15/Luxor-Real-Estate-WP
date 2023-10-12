<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"> <h1 style="color:grey;">UNSUPPORTED BROWSER. PLEASE UPGRADE YOUR BROWSER TO <a href="http://windows.microsoft.com/en-CA/internet-explorer/downloads/ie-9/worldwide-languages">IE 9 OR HIGHER</a></h1> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <h1 style="color:grey;">UNSUPPORTED BROWSER. PLEASE UPGRADE YOUR BROWSER TO <a href="http://windows.microsoft.com/en-CA/internet-explorer/downloads/ie-9/worldwide-languages">IE 9 OR HIGHER</a></h1> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"> <h1 style="color:grey;">UNSUPPORTED BROWSER. PLEASE UPGRADE YOUR BROWSER TO <a href="http://windows.microsoft.com/en-CA/internet-explorer/downloads/ie-9/worldwide-languages">IE 9 OR HIGHER</a></h1> <![endif]-->
<html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<!-- Atoms & Pingback -->
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
    <link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
    <link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />    
                            
    <?php wp_head(); ?>
</head>

<?php 

global $luxor_options;

//Luxor options
$customSlider = $luxor_options['opt-custom-slider'];

//Global options
$enableTooltip = get_theme_mod('enableTooltip', 'on');

//Layout Options
$enableBoxMode = get_theme_mod('enableBoxMode', 'off');

//Pulse slider options
$enablePulseSlider = get_theme_mod('enablePulseSlider', 'on');

$woocommShopLayout = get_theme_mod('woocommShopLayout', 'no-sidebar');
$woocommLayout = 'woocomm-' . $woocommShopLayout;

?>

<body <?php body_class($woocommLayout); ?>>

<?php get_template_part('content', 'floatingmenu'); ?>

<?php if($enableBoxMode === 'on') { ?>
     <div class="pm-boxed-mode" id="pm_layout_wrapper">
<?php } else { ?>
     <div class="pm-full-mode" id="pm_layout_wrapper">
<?php }?>
        
    <?php get_template_part('content', 'mainmenu'); ?>
      
    <!-- Header area -->
    <?php get_template_part('content', 'header'); ?>
    <!-- /Header area end -->

    
    <?php if(is_home() || is_front_page()) {//Display Pulse Slider ?>
    
    
    	<?php if($enablePulseSlider === 'on') : ?>
        
        	<?php 
				global $luxor_options;
				
				$allowed_html = array(
					'b' => array(),
					'em' => array(),
					'strong' => array(),
					'span' => array(),
				);
				
				$slides = '';
				
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
							
							echo '<div id="pm-slider" class="pm-slider">';
							
								echo '<div id="pm-slider-progress-bar"></div>';
								
								echo '<ul class="pm-slides-container" id="pm_slides_container">';
								
									foreach($slides as $s) {
										
										$title = '';
										$subTitle = '';
										$btnText1 = '';
										$btnText2 = '';
										$btnUrl = '';
																			
										if(!empty($s['title'])){
											$titlePieces = explode(" - ", $s['title']);
											$title = $titlePieces[0];
										}
										
										if(!empty($s['url'])){
											$pieces = explode(" - ", $s['url']);
											$btnText1 = $pieces[0];
											$btnText2 = $pieces[1];
											$btnUrl = $pieces[2];
										}
										
										echo '<li data-thumb="'.$s['image'].'" class="pmslide_'.$sliderCounter.'"><img src="'.$s['image'].'" alt="Slider image '.$sliderCounter.'" />';
						
											echo '<div class="pm-holder">';
												echo '<div class="pm-caption">';
												
													  if( !empty($s['title']) ) :
														  echo '<h1>'. wp_kses( $title, $allowed_html ) .'</h1>';
													  endif;
													  
													  if( !empty($s['title']) ) :
													  
														  echo '<span class="pm-caption-decription">';
															echo wp_kses( $subTitle, $allowed_html );
														  echo '</span>';
														  
													  endif;
													  
													  if( !empty($s['description']) ) :
													  
														  echo '<span class="pm-caption-excerpt">';
															echo wp_kses( $s['description'], $allowed_html );
														  echo '</span>';
													  
													  endif;
													  
													  if( !empty($s['url']) ) :
														  
														  echo '<a href="'. esc_attr($btnUrl) .'" class="pm-slide-btn">';
															echo '<div class="pm-slider-btn-faceflip-top">';
																echo '<p>'. esc_attr($btnText1) .'</p>';
															echo '</div>';
															echo '<div class="pm-slider-btn-faceflip-bottom">';
																echo '<p>' . esc_attr($btnText2) .' &nbsp; <i class="fa fa-angle-right"></i></p>';
															echo '</div>';
														  echo '</a>';
														
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
        
        <?php endif; ?>
        
        <?php 
		
			if($customSlider !== '' && $enablePulseSlider === 'off') { 
        	   echo do_shortcode($customSlider);
        	} 
			
		?>
    
            
    <?php } else {//display sub-header ?>
        
        <?php $displaySubHeader = get_theme_mod('displaySubHeader', 'on'); ?>
        
    	<?php 
		
			if($displaySubHeader === 'on') :
				get_template_part('content', 'subheader'); 
			endif;
		
		?>
    
<?php } ?>