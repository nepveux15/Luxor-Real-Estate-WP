<?php

require_once( ABSPATH . WPINC . '/class-wp-customize-control.php' );

class PM_LN_Customizer {
	
	public static function register ( $wp_customize ) {
		
		/*** Remove default wordpress sections ***/
		$wp_customize->remove_section('background_image');
		$wp_customize->remove_section('colors');
		$wp_customize->remove_section('header_image');
		
			
		/**** Google Options ****/
		$wp_customize->add_section( 'google_options' , array(
			'title'    => esc_html__( 'Google Options', 'luxortheme' ),
			'priority' => 1,
		));
		
		$wp_customize->add_setting(
			'googleAPIKey', array(
				'default' => "",
				'sanitize_callback' => 'esc_attr'
			)
		);

		$wp_customize->add_control(
			'googleAPIKey',
			 array(
				'label' => esc_html__( 'API KEY', 'luxortheme' ),
			 	'section' => 'google_options',
				'description' => __('Insert your Google API key (browser key) to activate Google services such as Google Maps and Google Places.', 'luxortheme'),
				'priority' => 1,
			 )
		);
				
		$wp_customize->add_setting( 'googleMapsMarkerImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'googleMapsMarkerImage', 
			array(
				'label'    => esc_html__( 'Google Maps Marker Image', 'luxortheme' ),
				'section'  => 'google_options',
				'settings' => 'googleMapsMarkerImage',
				'priority' => 2,
				) 
			) 
		);
		
		
		
		
			
		/**** Header Options ****/
		$wp_customize->add_section( 'header_options' , array(
			'title'    => esc_html__( 'Header Options', 'luxortheme' ),
			'priority' => 20,
		));
		
		//Upload Options
		$wp_customize->add_setting( 'companyLogo', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'companyLogo', 
			array(
				'label'    => esc_html__( 'Header Logo', 'luxortheme' ),
				'section'  => 'header_options',
				'settings' => 'companyLogo',
				'priority' => 1,
				) 
			) 
		);
		
		$wp_customize->add_setting( 'menuLogo', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'menuLogo', 
			array(
				'label'    => esc_html__( 'Menu Logo', 'luxortheme' ),
				'section'  => 'header_options',
				'settings' => 'menuLogo',
				'priority' => 2,
				) 
			) 
		);
		
		$wp_customize->add_setting( 'globalHeaderImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'globalHeaderImage', 
			array(
				'label'    => esc_html__( 'Global Header Image (Pages and Posts)', 'luxortheme' ),
				'section'  => 'header_options',
				'settings' => 'globalHeaderImage',
				'priority' => 3,
				) 
			) 
		);
		
		$wp_customize->add_setting( 'globalHeaderImage2', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'globalHeaderImage2', 
			array(
				'label'    => esc_html__( 'Global Header Image (Archives, 404, etc.)', 'luxortheme' ),
				'section'  => 'header_options',
				'settings' => 'globalHeaderImage2',
				'priority' => 4,
				) 
			) 
		);
		
		
		//Radio Options							
		$wp_customize->add_setting('enableBreadCrumbs', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableBreadCrumbs', array(
			'label'      => esc_html__('Display Breadcrumbs?', 'luxortheme'),
			'section'    => 'header_options',
			'settings'   => 'enableBreadCrumbs',
			'priority' => 5,
			'type'       => 'radio',
			'choices'    => array(
				'on'   =>  esc_html__( 'ON', 'luxortheme' ),
				'off'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));

		
		$wp_customize->add_setting('enableLanguageSelector', array(
			'default' => 'off',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableLanguageSelector', array(
			'label'      => esc_html__('Display WPML Language selector?', 'luxortheme'),
			'section'    => 'header_options',
			'settings'   => 'enableLanguageSelector',
			'priority' => 6,
			'type'       => 'radio',
			'choices'    => array(
				'on'   =>  esc_html__( 'ON', 'luxortheme' ),
				'off'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));

				
		
		$wp_customize->add_setting('enableSearch', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableSearch', array(
			'label'      => esc_html__('Display Search Field?', 'luxortheme'),
			'section'    => 'header_options',
			'settings'   => 'enableSearch',
			'priority' => 7,
			'type'       => 'radio',
			'choices'    => array(
				'on'   =>  esc_html__( 'ON', 'luxortheme' ),
				'off'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));
		
		
		$wp_customize->add_setting('enableLoginBtn', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableLoginBtn', array(
			'label'      => esc_html__('Display Login Button?', 'luxortheme'),
			'section'    => 'header_options',
			'settings'   => 'enableLoginBtn',
			'priority' => 8,
			'type'       => 'radio',
			'choices'    => array(
				'on'   =>  esc_html__( 'ON', 'luxortheme' ),
				'off'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));
		
		$wp_customize->add_setting('enableRegisterBtn', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableRegisterBtn', array(
			'label'      => esc_html__('Display Register Button?', 'luxortheme'),
			'section'    => 'header_options',
			'settings'   => 'enableRegisterBtn',
			'priority' => 9,
			'type'       => 'radio',
			'choices'    => array(
				'on'   =>  esc_html__( 'ON', 'luxortheme' ),
				'off'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));
		
		$wp_customize->add_setting('enableMenuSocialIcons', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableMenuSocialIcons', array(
			'label'      => esc_html__('Display Menu Social Icons?', 'luxortheme'),
			'section'    => 'header_options',
			'settings'   => 'enableMenuSocialIcons',
			'priority' => 10,
			'type'       => 'radio',
			'choices'    => array(
				'on'   =>  esc_html__( 'ON', 'luxortheme' ),
				'off'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));
		
		$wp_customize->add_setting('displaySubHeader', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('displaySubHeader', array(
			'label'      => esc_html__('Display Sub-Header?', 'luxortheme'),
			'section'    => 'header_options',
			'settings'   => 'displaySubHeader',
			'priority' => 11,
			'type'       => 'radio',
			'choices'    => array(
				'on'   =>  esc_html__( 'ON', 'luxortheme' ),
				'off'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));
		
		$wp_customize->add_setting('headerNavigationMode', array(
			'default' => 'minimized',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('headerNavigationMode', array(
			'label'      => esc_html__('Navigation Mode', 'luxortheme'),
			'section'    => 'header_options',
			'settings'   => 'headerNavigationMode',
			'description' => __('Choose between a minimized Hamburger style menu or full desktop menu.', 'luxortheme'),
			'priority' => 12,
			'type'       => 'radio',
			'choices'    => array(
				'minimized'   => __('Minimized', 'luxortheme'),
				'desktop'  => __('Desktop', 'luxortheme'),
			),
		));
		
		$wp_customize->add_setting('desktopNavPosition', array(
			'default' => 'bottom',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('desktopNavPosition', array(
			'label'      => esc_html__('Desktop Nav Position', 'luxortheme'),
			'section'    => 'header_options',
			'settings'   => 'desktopNavPosition',
			'description' => __('Position the desktop navigation above or below the header area. (Only applies if Desktop Navigation mode is active)', 'luxortheme'),
			'priority' => 13,
			'type'       => 'radio',
			'choices'    => array(
				'top'   => __('Top', 'luxortheme'),
				'bottom'  => __('Bottom', 'luxortheme'),
			),
		));
		
		$wp_customize->add_setting('desktopStickyNav', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('desktopStickyNav', array(
			'label'      => esc_html__('Enable stickiness?', 'luxortheme'),
			'section'    => 'header_options',
			'settings'   => 'desktopStickyNav',
			'description' => __('Only applies to desktop menu.', 'luxortheme'),
			'priority' => 14,
			'type'       => 'radio',
			'choices'    => array(
				'on'   =>  esc_html__( 'ON', 'luxortheme' ),
				'off'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));
		
		
		//Textfields
		$wp_customize->add_setting(
			'searchFieldText', array(
				'default' => esc_html__( 'Search Articles...', 'luxortheme' ),
				'sanitize_callback' => 'esc_attr'
			)
		);

		$wp_customize->add_control(
			'searchFieldText',
			 array(
				'label' => esc_html__( 'Search field text (applies globally)', 'luxortheme' ),
			 	'section' => 'header_options',
				'priority' => 15,
			 )
		);

		
		$wp_customize->add_setting(
			'companyLogoAltTag', array(
				'default' => "",
				'sanitize_callback' => 'esc_attr'
			)
		);

		$wp_customize->add_control(
			'companyLogoAltTag',
			 array(
				'label' => esc_html__( 'Company Logo Alt Tag', 'luxortheme' ),
			 	'section' => 'header_options',
				'priority' => 16,
			 )
		);
		
		$wp_customize->add_setting(
			'companyLogoURL', array(
				'default' => "",
				'sanitize_callback' => 'esc_html'
			)
		);

		$wp_customize->add_control(
			'companyLogoURL',
			 array(
				'label' => esc_html__( 'Company Logo URL', 'luxortheme' ),
			 	'section' => 'header_options',
				'priority' => 17,
			 )
		);	

		
		$wp_customize->add_setting( 'headerBgOpacity', array(
			'default' => 80,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'headerBgOpacity', array(
			'type' => 'range',
			'section' => 'header_options',
			'label'   => esc_html__( 'Header Background opacity', 'luxortheme' ),
			'description' => esc_html__('Adjust the background opacity of the header area. (Requires window refresh)', 'luxortheme'),
			'priority' => 18,
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		
		$wp_customize->add_setting( 'mainNavBgOpacity', array(
			'default' => 90,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'mainNavBgOpacity', array(
			'type' => 'range',
			'section' => 'header_options',
			'label'   => esc_html__( 'Menu Background opacity', 'luxortheme' ),
			'description' => esc_html__('Adjust the background opacity of the main navigation. (Requires window refresh)', 'luxortheme'),
			'priority' => 19,
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );

		
		$wp_customize->add_setting( 'headerPadding', array(
			'default' => 25,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'headerPadding', array(
			'type' => 'range',
			'section' => 'header_options',
			'label'   => esc_html__( 'Header Padding', 'luxortheme' ),
			'description' => esc_html__('Adjust the vertical padding of the header area.', 'luxortheme'),
			'priority' => 20,
			'input_attrs' => array(
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		
		
		
				
		//Header Option Colors
		$headerOptionColors = array();
		
		$headerOptionColors[] = array(
			'slug'=>'mainNavBackgroundColor', 
			'default' => '#000000',
			'transport' => 'refresh',
			'label' => esc_html__('Header Background Color', 'luxortheme'),
			'description' => esc_html__('Adjust the background color of the header area. (Requires window refresh)', 'luxortheme')
		);
		$headerOptionColors[] = array(
			'slug'=>'menuBorderColor', 
			'default' => '#353535',
			'transport' => 'postMessage',
			'label' => esc_html__('Menu Border Color', 'luxortheme'),
			'description' => esc_html__('Adjust the border color of the main navigation.', 'luxortheme')
		);
		$headerOptionColors[] = array(
			'slug'=>'subpageHeaderBackgroundColor', 
			'default' => '#3f3f3f',
			'transport' => 'postMessage',
			'label' => esc_html__('Subpage Header Background Color', 'luxortheme'),
			'description' => esc_html__('Adjust the background color of the sub-header area.', 'luxortheme')
		);
		
		$headerOptionColors[] = array(
			'slug'=>'pageTitleBackgroundColor', 
			'default' => '#000000',
			'transport' => 'refresh',
			'label' => esc_html__('Page Title/Message Background Color', 'luxortheme'),
			'description' => esc_html__('Adjust the background color of the page title and message. (Requires window refresh)', 'luxortheme')
		);
				
		$priorityHeaderColors = 50;
		
		foreach( $headerOptionColors as $color ) {
			
			$priorityHeaderColors += 10;
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'transport' => $color['transport'],
					'description' => $color['description'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr',
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'section' => 'header_options',
					'priority' => $priorityHeaderColors,
					'transport' => $color['transport'],
					'description' => $color['description'],
					'settings' => $color['slug'])
				)
			);
			
			$priorityHeaderColors++;
			
		}//end of foreach
		
		
			
		/**** Layout Options ****/
		$wp_customize->add_section( 'layout_options' , array(
			'title'    => esc_html__( 'Layout Options', 'luxortheme' ),
			'priority' => 60,
		));
		
		//Radio Options
		$wp_customize->add_setting('enableBoxMode',  array(
			'default' => 'off',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableBoxMode', array(
			'label'      => esc_html__('1170 Boxed Mode', 'luxortheme'),
			'section'    => 'layout_options',
			'settings'   => 'enableBoxMode',
			'priority' => 10,
			'type'       => 'radio',
			'choices'    => array(
				'on'   =>  esc_html__( 'ON', 'luxortheme' ),
				'off'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));
		
		$wp_customize->add_setting(
			'homepageLayout', array(
				'default' => 'no-sidebar',
				'sanitize_callback' => 'esc_attr'
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Radio_Control( 
			$wp_customize, 'homepageLayout', 
				array(
					'label'   => esc_html__( 'Homepage Layout', 'luxortheme' ),
					'section' => 'layout_options',
					'settings'   => 'homepageLayout',
					'type'     => 'radio',
					'mode'     => 'image',
					'choices'  => array(
						'no-sidebar' => get_template_directory_uri() . '/css/img/layouts/no-sidebar.png',
						'left-sidebar' => get_template_directory_uri() . '/css/img/layouts/left-sidebar.png',
						'right-sidebar' => get_template_directory_uri() . '/css/img/layouts/right-sidebar.png',
					),
				) 
			) 
		);
		
		$wp_customize->add_setting(
			'universalLayout', array(
				'default' => 'no-sidebar',
				'sanitize_callback' => 'esc_attr'
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Radio_Control( 
			$wp_customize, 'universalLayout', 
				array(
					'label'   => esc_html__( 'Universal Layout (Tag - Archive - Category)', 'luxortheme' ),
					'section' => 'layout_options',
					'settings'   => 'universalLayout',
					'type'     => 'radio',
					'mode'     => 'image',
					'choices'  => array(
						'no-sidebar' => get_template_directory_uri() . '/css/img/layouts/no-sidebar.png',
						'left-sidebar' => get_template_directory_uri() . '/css/img/layouts/left-sidebar.png',
						'right-sidebar' => get_template_directory_uri() . '/css/img/layouts/right-sidebar.png',
					),
				) 
			) 
		);
		
		$wp_customize->add_setting(
			'footerLayout', array(
				'default' => 'footer-four-columns',
				'sanitize_callback' => 'esc_attr'
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Radio_Control( 
			$wp_customize, 'footerLayout', 
				array(
					'label'   => esc_html__( 'Footer Layout', 'luxortheme' ),
					'section' => 'layout_options',
					'settings'   => 'footerLayout',
					'type'     => 'radio',
					'mode'     => 'image',
					'choices'  => array(
						'footer-one-column' => get_template_directory_uri() . '/css/img/layouts/footer-one-column.png',
						'footer-two-columns' => get_template_directory_uri() . '/css/img/layouts/footer-two-columns.png',
						'footer-three-columns' => get_template_directory_uri() . '/css/img/layouts/footer-three-columns.png',
						'footer-four-columns' => get_template_directory_uri() . '/css/img/layouts/footer-four-columns.png',
						'footer-three-wide-left' => get_template_directory_uri() . '/css/img/layouts/footer-three-wide-left.png',
						'footer-three-wide-right' => get_template_directory_uri() . '/css/img/layouts/footer-three-wide-right.png',
					),
				) 
			) 
		);
		
		
		/**** Footer Options ****/
		$wp_customize->add_section( 'footer_options' , array(
			'title'    => esc_html__( 'Footer Options', 'luxortheme' ),
			'priority' => 70,
		));
			
		//Images
		$wp_customize->add_setting( 'footerLogo', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'footerLogo', 
			array(
				'label'    => esc_html__( 'Footer Logo', 'luxortheme' ),
				'section'  => 'footer_options',
				'settings' => 'footerLogo',
				'priority' => 1,
				) 
			) 
		);
		
		$wp_customize->add_setting( 'fatFooterBackgroundImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'fatFooterBackgroundImage', 
			array(
				'label'    => esc_html__( 'Footer Background Image', 'luxortheme' ),
				'section'  => 'footer_options',
				'settings' => 'fatFooterBackgroundImage',
				'priority' => 2,
				) 
			) 
		);

			
		//Radio Options
		$wp_customize->add_setting('toggle_footer', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('toggle_footer', array(
			'label'      => esc_html__('Display Footer?', 'luxortheme'),
			'section'    => 'footer_options',
			'settings'   => 'toggle_footer',
			'type'       => 'radio',
			'priority' => 3,
			'choices'    => array(
				'on'   =>  esc_html__( 'ON', 'luxortheme' ),
				'off'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));
		
		
		$wp_customize->add_setting('toggleParallaxFooter', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('toggleParallaxFooter', array(
			'label'      => esc_html__('Run Parallax on Footer?', 'luxortheme'),
			'section'    => 'footer_options',
			'settings'   => 'toggleParallaxFooter',
			'type'       => 'radio',
			'priority' => 4,
			'choices'    => array(
				'on'   =>  esc_html__( 'ON', 'luxortheme' ),
				'off'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));
		
		$wp_customize->add_setting('toggle_footerWidgets', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('toggle_footerWidgets', array(
			'label'      => esc_html__('Display Footer Widgets?', 'luxortheme'),
			'section'    => 'footer_options',
			'settings'   => 'toggle_footerWidgets',
			'type'       => 'radio',
			'priority' => 5,
			'choices'    => array(
				'on'   =>  esc_html__( 'ON', 'luxortheme' ),
				'off'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));

		$wp_customize->add_setting('toggle_footer_socialIcons', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('toggle_footer_socialIcons', array(
			'label'      => esc_html__('Display Social Icons?', 'luxortheme'),
			'section'    => 'footer_options',
			'settings'   => 'toggle_footer_socialIcons',
			'type'       => 'radio',
			'priority' => 6,
			'choices'    => array(
				'on'   =>  esc_html__( 'ON', 'luxortheme' ),
				'off'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));
		
		$wp_customize->add_setting('displayFooterLogo', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('displayFooterLogo', array(
			'label'      => esc_html__('Display Footer Logo?', 'luxortheme'),
			'section'    => 'footer_options',
			'settings'   => 'displayFooterLogo',
			'type'       => 'radio',
			'priority' => 7,
			'choices'    => array(
				'on'   =>  esc_html__( 'ON', 'luxortheme' ),
				'off'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));
		
		$wp_customize->add_setting('displayFooterStats', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('displayFooterStats', array(
			'label'      => esc_html__('Display Footer Stats?', 'luxortheme'),
			'section'    => 'footer_options',
			'settings'   => 'displayFooterStats',
			'type'       => 'radio',
			'priority' => 8,
			'choices'    => array(
				'on'   =>  esc_html__( 'ON', 'luxortheme' ),
				'off'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));
		
		$wp_customize->add_setting('displayCopyright', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('displayCopyright', array(
			'label'      => esc_html__('Display Copyright?', 'luxortheme'),
			'section'    => 'footer_options',
			'settings'   => 'displayCopyright',
			'type'       => 'radio',
			'priority' => 9,
			'choices'    => array(
				'on'   =>  esc_html__( 'ON', 'luxortheme' ),
				'off'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));
		
		$wp_customize->add_setting('displayBusinessInfo', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('displayBusinessInfo', array(
			'label'      => esc_html__('Display Business Info?', 'luxortheme'),
			'section'    => 'footer_options',
			'settings'   => 'displayBusinessInfo',
			'type'       => 'radio',
			'priority' => 10,
			'choices'    => array(
				'on'   =>  esc_html__( 'ON', 'luxortheme' ),
				'off'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));
		
		$wp_customize->add_setting('displayLoginButton', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('displayLoginButton', array(
			'label'      => esc_html__('Display Login Button?', 'luxortheme'),
			'section'    => 'footer_options',
			'settings'   => 'displayLoginButton',
			'type'       => 'radio',
			'priority' => 11,
			'choices'    => array(
				'on'   =>  esc_html__( 'ON', 'luxortheme' ),
				'off'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));
		
		$wp_customize->add_setting('toggle_footerNav', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('toggle_footerNav', array(
			'label'      => esc_html__('Display Footer Navigation?', 'luxortheme'),
			'section'    => 'footer_options',
			'settings'   => 'toggle_footerNav',
			'type'       => 'radio',
			'priority' => 12,
			'choices'    => array(
				'on'   =>  esc_html__( 'ON', 'luxortheme' ),
				'off'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));
		
		$wp_customize->add_setting('toggle_backtotop', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('toggle_backtotop', array(
			'label'      => esc_html__('Display Back To Top Button?', 'luxortheme'),
			'section'    => 'footer_options',
			'settings'   => 'toggle_backtotop',
			'type'       => 'radio',
			'priority' => 13,
			'choices'    => array(
				'on'   =>  esc_html__( 'ON', 'luxortheme' ),
				'off'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));

		//Textfields
		$wp_customize->add_setting(
			'statInfo1', array(
				'default' => '786 Agents Worldwide',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'statInfo1', array(
			'label'   => esc_html__( 'Stat info 1', 'luxortheme' ),
			'section' => 'footer_options',
			'settings' => 'statInfo1',
			'type'    => 'text',
			'priority' => 14,
		) );
		
		$wp_customize->add_setting(
			'statInfo2', array(
				'default' => '3,344,543 Homes for sale',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'statInfo2', array(
			'label'   => esc_html__( 'Stat info 2', 'luxortheme' ),
			'section' => 'footer_options',
			'settings' => 'statInfo2',
			'type'    => 'text',
			'priority' => 15,
		) );
		
		
		$wp_customize->add_setting(
			'businessPhoneIcon', array(
				'default' => 'fa fa-mobile',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'businessPhoneIcon', array(
			'label'   => esc_html__( 'Business Phone Icon', 'luxortheme' ),
			'section' => 'footer_options',
			'settings' => 'businessPhoneIcon',
			'type'    => 'text',
			'priority' => 17,
		) );
		
		
		$wp_customize->add_setting(
			'businessEmailIcon', array(
				'default' => 'fa fa-inbox',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'businessEmailIcon', array(
			'label'   => esc_html__( 'Business Email Icon', 'luxortheme' ),
			'section' => 'footer_options',
			'settings' => 'businessEmailIcon',
			'type'    => 'text',
			'priority' => 18,
		) );


		//Slider elements	
		$wp_customize->add_setting( 'fatFooterPadding', array(
			'default' => 100,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'fatFooterPadding', array(
			'type' => 'range',
			'section' => 'footer_options',
			'label'   => esc_html__( 'Fat Footer Padding', 'luxortheme' ),
			'description' => esc_html__('Adjust the vertical padding of the fat footer area.', 'luxortheme'),
			'priority' => 18,
			'input_attrs' => array(
				'min' => 0,
				'max' => 120,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		
		
		$FooterColors = array();

		$FooterColors[] = array(
			'slug'=>'fatFooterBackgroundColor', 
			'default' => '#191B27',
			'transport' => 'postMessage',
			'label' => esc_html__('Fat Footer Background Color.', 'luxortheme'),
			'description' => esc_html__('Adjust the background color of the header area. (Requires window refresh)', 'luxortheme')
		);
		
		$priorityFooterCounter = 50;
		
		foreach( $FooterColors as $color ) {
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'transport' => $color['transport'],
					'description' => $color['description'],
					'type' => 'option', 
					'sanitize_callback' => 'esc_attr',
					'capability' => 'edit_theme_options'
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'section' => 'footer_options',
					'transport' => $color['transport'],
					'description' => $color['description'],
					'priority' => $priorityFooterCounter,
					'settings' => $color['slug'])
				)
			);
			
			$priorityFooterCounter++;
			
		}//end of foreach
		
		
		/**** Global Options ****/
		$wp_customize->add_section( 'global_options' , array(
			'title'    => esc_html__( 'Global Options', 'luxortheme' ),
			'priority' => 80,
		));
	
		
		$wp_customize->add_setting( 'pageBackgroundImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'pageBackgroundImage', 
			array(
				'label'    => esc_html__( 'Background image', 'luxortheme' ),
				'section'  => 'global_options',
				'settings' => 'pageBackgroundImage',
				'priority' => 2,
				) 
			) 
		);
		
		$wp_customize->add_setting('repeatBackground',  array(
			'default' => 'repeat',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('repeatBackground', array(
			'label'      => esc_html__('Background Repeat', 'luxortheme'),
			'section'    => 'global_options',
			'settings'   => 'repeatBackground',
			'priority' => 3,
			'type'       => 'radio',
			'choices'    => array(
				'repeat'  => 'Repeat',
				'repeat-x'  => 'Repeat X',
				'repeat-y'  => 'Repeat Y',
				'no-repeat'   => 'No Repeat',
			),
		));

		
		$wp_customize->add_setting('enableTooltip', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableTooltip', array(
			'label'      => esc_html__('ToolTip', 'luxortheme'),
			'section'    => 'global_options',
			'settings'   => 'enableTooltip',
			'type'       => 'radio',
			'priority' => 4,
			'choices'    => array(
				'on'   =>  esc_html__( 'ON', 'luxortheme' ),
				'off'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));


		$wp_customize->add_setting('retinaSupport',  array(
			'default' => 'off',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('retinaSupport', array(
			'label'      => esc_html__('Retina Support', 'luxortheme'),
			'section'    => 'global_options',
			'settings'   => 'retinaSupport',
			'priority' => 7,
			'type'       => 'radio',
			'choices'    => array(
				'on'   =>  esc_html__( 'ON', 'luxortheme' ),
				'off'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));		
		
		
		$wp_customize->add_setting('currenySymbolPosition',  array(
			'default' => 'left',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('currenySymbolPosition', array(
			'label'      => esc_html__('Currency Symbol Position', 'luxortheme'),
			'section'    => 'global_options',
			'settings'   => 'currenySymbolPosition',
			'priority' => 7,
			'type'       => 'radio',
			'choices'    => array(
				'left'   =>  esc_html__( 'Left', 'luxortheme' ),
				'right'  => esc_html__( 'Right', 'luxortheme' ),
			),
		));
		
		
		
		
		$wp_customize->add_setting('displayConsentCheckbox',  array(
			'default' => 'off',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('displayConsentCheckbox', array(
			'label'      => esc_html__('Consent Checkbox', 'luxortheme'),
			'section'    => 'global_options',
			'settings'   => 'displayConsentCheckbox',
			'description' => esc_attr__('Use this option to enable a consent checkbox for all contact forms. This was added on May 26, 2018 for GDPR compliancy in Europe.', 'luxortheme' ),
			'priority' => 8,
			'type'       => 'radio',
			'choices'    => array(
				'on'   =>  esc_html__( 'ON', 'luxortheme' ),
				'off'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));
		
		$wp_customize->add_setting(
			'consentMessage', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
		
		$wp_customize->add_control( 'consentMessage', array(
			'label'   => esc_html__('Consent Message', 'luxortheme'),
			'section' => 'global_options',
			'description' => esc_attr__('Add a message for the consent checkbox to all contact forms. NOTE: Only applies if "Consent Checkbox" option is set to ON', 'luxortheme' ),
			'settings' => 'consentMessage',
			'priority' => 9,
			'type'    => 'textarea',
		) );
		
		
		$wp_customize->add_setting(
			'ulListIcon', array(
				'default' => 'f105',
				'sanitize_callback' => 'esc_attr'
			)
		);
		
		$wp_customize->add_control( 'ulListIcon', array(
			'label'   => esc_html__('UL List Icon', 'luxortheme'),
			'section' => 'global_options',
			'settings' => 'ulListIcon',
			'priority' => 10,
			'type'    => 'text',
		) );
		
		$wp_customize->add_setting(
			'currencySymbol', array(
				'default' => '$',
				'sanitize_callback' => 'esc_attr'
			)
		);
		
		$wp_customize->add_control( 'currencySymbol', array(
			'label'   => esc_html__('Currency Symbol', 'luxortheme'),
			'section' => 'global_options',
			'settings' => 'currencySymbol',
			'priority' => 11,
			'type'    => 'text',
		) );
		
		$wp_customize->add_setting('globalPageContainerPadding',
			array(
				'default' => 'default',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control('globalPageContainerPadding',
			array(
				'type' => 'select',
				'priority' => 12,
				'label' => esc_attr__('Global Bootstrap Container Padding', 'luxortheme' ),
				'description' => esc_attr__('Use this option to apply a global container padding across all pages. The "Default padding" option will apply the actual page bootstrap container padding amount instead.', 'luxortheme' ),
				'section' => 'global_options',
				'choices' => array(
					'default' => 'Default padding',
					0 => 0,
					10 => 10,
					20 => 20,
					30 => 30,
					40 => 40,
					50 => 50,
					60 => 60,
					70 => 70,
					80 => 80,
					90 => 90,
					100 => 100,
					110 => 110,
					120 => 120,
				),
			)
		);
		
		$GlobalColors = array();
		
		$GlobalColors[] = array(
			'slug'=>'pageBackgroundColor', 
			'default' => '#FFFFFF',
			'label' => esc_html__('Background Color', 'luxortheme')
		);
		$GlobalColors[] = array(
			'slug'=>'boxedModeContainerColor', 
			'default' => '#FFFFFF',
			'transport' => 'postMessage',
			'label' => esc_html__('Boxed Mode Container Color', 'luxortheme'),
			'description' => esc_html__('Adjust the background color of the boxed mode container. Only applies if Boxed Mode is enabled.', 'luxortheme')
		);
		$GlobalColors[] = array(
			'slug'=>'primaryColor', 
			'default' => '#ffe1a0',
			'transport' => 'postMessage',
			'label' => esc_html__('Primary Color', 'luxortheme'),
			'description' => esc_html__('Adjust the primary color of the Luxor theme. This color gets applied to multiple elements for a consistent design. Please note not all elements get updated in real-time - please save your settings and review the final changes on the front-end.', 'luxortheme'),
		);
		$GlobalColors[] = array(
			'slug'=>'secondaryColor', 
			'default' => '#7f6631',
			'transport' => 'postMessage',
			'label' => esc_html__('Secondary Color', 'luxortheme'),
			'description' => esc_html__('Adjust the secondary color of the Luxor theme. This color gets applied to multiple elements for a consistent design. Please note not all elements get updated in real-time - please save your settings and review the final changes on the front-end.', 'luxortheme'),
		);
		$GlobalColors[] = array(
			'slug'=>'dividerColor', 
			'default' => '#8e8e8e',
			'transport' => 'postMessage',
			'label' => esc_html__('Divider/Border Color', 'luxortheme'),
			'description' => esc_html__('Adjust the divider/border color of the Luxor theme. Applies to multiple elements throughout the theme.', 'luxortheme')
		);
		$GlobalColors[] = array(
			'slug'=>'tooltipColor', 
			'default' => '#ffe1a0',
			'transport' => 'refresh',
			'label' => esc_html__('ToolTip Color', 'luxortheme'),
			'description' => esc_html__('Adjust the color of the tooltip popup. (Requires window refresh)', 'luxortheme')
		);
		$GlobalColors[] = array(
			'slug'=>'blockQuoteColor', 
			'default' => '#ffe1a0',
			'transport' => 'refresh',
			'label' => esc_html__('Blockquote Color', 'luxortheme'),
			'description' => esc_html__('Adjust the color of the blockquote element. (Requires window refresh)', 'luxortheme')
		);
		$GlobalColors[] = array(
			'slug'=>'ulListIconColor', 
			'default' => '#ffe1a0',
			'transport' => 'refresh',
			'label' => esc_html__('UL List icon color', 'luxortheme'),
			'description' => esc_html__('Adjust the color of the unordered list element icon. (Requires window refresh)', 'luxortheme')
		);
		
		$priority = 100;
		
		foreach( $GlobalColors as $color ) {
			
			$priority = $priority + 1;
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'transport' => $color['transport'],
					'description' => $color['description'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr'
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'section' => 'global_options',
					'settings' => $color['slug'],
					'transport' => $color['transport'],
					'description' => $color['description'],
					'priority' => $priority,
					)
				)
			);
		}//end of foreach
					
				
		/**** Business Info ****/
		$wp_customize->add_setting('enableBusinessInfoHeader', array(
			'default' => 'off',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableBusinessInfoHeader', array(
			'label'      => esc_html__('Display phone and email in header area?', 'luxortheme'),
			'section'    => 'business_info',
			'settings'   => 'enableBusinessInfoHeader',
			'priority' => 1,
			'type'       => 'radio',
			'choices'    => array(
				'on'   =>  esc_html__( 'ON', 'luxortheme' ),
				'off'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));
		
		$wp_customize->add_section( 'business_info' , array(
			'title'    => esc_html__( 'Business Info', 'luxortheme' ),
			'priority' => 100,
		));
		
		//Textfields
		$wp_customize->add_setting(
			'businessPhone', array(
				'default' => '1-888-555-6548',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'businessPhone', array(
			'label'   => esc_html__( 'Business Phone', 'luxortheme' ),
			'section' => 'business_info',
			'settings' => 'businessPhone',
			'type'    => 'text',
		) );
		
		$wp_customize->add_setting(
			'businessEmail', array(
				'default' => 'info@luxorrealty.com',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'businessEmail', array(
			'label'   => esc_html__( 'Email Address', 'luxortheme' ),
			'section' => 'business_info',
			'settings' => 'businessEmail',
			'type'    => 'text',
		) );
		
		//Facebook Icon
		$wp_customize->add_setting(
			'facebooklink', array(
				'default' => 'http://www.facebook.com',
				'sanitize_callback' => 'esc_html'
			)
		);
				
		$wp_customize->add_control( 'facebooklink', array(
			'label'   => esc_html__( 'Facebook URL', 'luxortheme' ),
			'section' => 'business_info',
			'settings' => 'facebooklink',
			'type'    => 'text',
		) );
		
		//Twitter Icon
		$wp_customize->add_setting(
			'twitterlink', array(
				'default' => 'http://www.twitter.com',
				'sanitize_callback' => 'esc_html'
			)
		);
				
		$wp_customize->add_control( 'twitterlink', array(
			'label'   => esc_html__( 'Twitter URL', 'luxortheme' ),
			'section' => 'business_info',
			'settings' => 'twitterlink',
			'type'    => 'text',
		) );
		
		//Google Plus Icon
		$wp_customize->add_setting(
			'googlelink', array(
				'default' => 'http://www.googleplus.com',
				'sanitize_callback' => 'esc_html'
			)
		);
				
		$wp_customize->add_control( 'googlelink', array(
			'label'   => esc_html__( 'Google Plus URL', 'luxortheme' ),
			'section' => 'business_info',
			'settings' => 'googlelink',
			'type'    => 'text',
		) );
		
		//Linkedin Icon
		$wp_customize->add_setting(
			'linkedinLink', array(
				'default' => 'http://www.linkedin.com',
				'sanitize_callback' => 'esc_html'
			)
		);
				
		$wp_customize->add_control( 'linkedinLink', array(
			'label'   => esc_html__( 'Linkedin URL', 'luxortheme' ),
			'section' => 'business_info',
			'settings' => 'linkedinLink',
			'type'    => 'text',
		) );
		
		//Vimeo Icon
		$wp_customize->add_setting(
			'vimeolink', array(
				'default' => 'http://www.vimeo.com',
				'sanitize_callback' => 'esc_html'
			)
		);
				
		$wp_customize->add_control( 'vimeolink', array(
			'label'   => esc_html__( 'Vimeo URL', 'luxortheme' ),
			'section' => 'business_info',
			'settings' => 'vimeolink',
			'type'    => 'text',
		) );
		
		//Youtube Icon
		$wp_customize->add_setting(
			'youtubelink', array(
				'default' => 'http://www.youtube.com',
				'sanitize_callback' => 'esc_html'
			)
		);
				
		$wp_customize->add_control( 'youtubelink', array(
			'label'   => esc_html__( 'YouTube URL', 'luxortheme' ),
			'section' => 'business_info',
			'settings' => 'youtubelink',
			'type'    => 'text',
		) );
		
		//Dribbble Icon
		$wp_customize->add_setting(
			'dribbblelink', array(
				'default' => 'http://www.dribbble.com',
				'sanitize_callback' => 'esc_html'
			)
		);
				
		$wp_customize->add_control( 'dribbblelink', array(
			'label'   => esc_html__( 'Dribbble URL', 'luxortheme' ),
			'section' => 'business_info',
			'settings' => 'dribbblelink',
			'type'    => 'text',
		) );
		
		//Pinterest Icon
		$wp_customize->add_setting(
			'pinterestlink', array(
				'default' => 'http://www.pinterest.com',
				'sanitize_callback' => 'esc_html'
			)
		);
				
		$wp_customize->add_control( 'pinterestlink', array(
			'label'   => esc_html__( 'Pinterest URL', 'luxortheme' ),
			'section' => 'business_info',
			'settings' => 'pinterestlink',
			'type'    => 'text',
		) );
		
		//Instagram Icon
		$wp_customize->add_setting(
			'instagramlink', array(
				'default' => 'http://www.instagram.com',
				'sanitize_callback' => 'esc_html'
			)
		);
				
		$wp_customize->add_control( 'instagramlink', array(
			'label'   => esc_html__( 'Instagram URL', 'luxortheme' ),
			'section' => 'business_info',
			'settings' => 'instagramlink',
			'type'    => 'text',
		) );

		
		//Skype Icon
		$wp_customize->add_setting(
			'skypelink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'skypelink', array(
			'label'   => esc_html__( 'Skype Name', 'luxortheme' ),
			'section' => 'business_info',
			'settings' => 'skypelink',
			'type'    => 'text',
		) );
		
		//Flickr Icon
		$wp_customize->add_setting(
			'flickrlink', array(
				'default' => 'http://www.flickr.com',
				'sanitize_callback' => 'esc_html'
			)
		);
				
		$wp_customize->add_control( 'flickrlink', array(
			'label'   => esc_html__( 'Flickr URL', 'luxortheme' ),
			'section' => 'business_info',
			'settings' => 'flickrlink',
			'type'    => 'text',
		) );
		
		//Tumblr Icon
		$wp_customize->add_setting(
			'tumblrlink', array(
				'default' => 'http://www.tumblr.com',
				'sanitize_callback' => 'esc_html'
			)
		);
				
		$wp_customize->add_control( 'tumblrlink', array(
			'label'   => esc_html__( 'Tumblr URL', 'luxortheme' ),
			'section' => 'business_info',
			'settings' => 'tumblrlink',
			'type'    => 'text',
		) );
		
		//Stumbleupon
		$wp_customize->add_setting(
			'stumbleuponlink', array(
				'default' => 'http://www.stumbleupon.com',
				'sanitize_callback' => 'esc_html'
			)
		);
				
		$wp_customize->add_control( 'stumbleuponlink', array(
			'label'   => esc_html__( 'StumbleUpon URL', 'luxortheme' ),
			'section' => 'business_info',
			'settings' => 'stumbleuponlink',
			'type'    => 'text',
		) );
		
		//Reddit
		$wp_customize->add_setting(
			'redditlink', array(
				'default' => 'http://www.reddit.com',
				'sanitize_callback' => 'esc_html'
			)
		);
				
		$wp_customize->add_control( 'redditlink', array(
			'label'   => esc_html__( 'Reddit URL', 'luxortheme' ),
			'section' => 'business_info',
			'settings' => 'redditlink',
			'type'    => 'text',
		) );
		
		//RSS Icon
		$wp_customize->add_setting(
			'rssLink', array(
				'default' => '',
				'sanitize_callback' => 'esc_html'
			)
		);
				
		$wp_customize->add_control( 'rssLink', array(
			'label'   => esc_html__( 'RSS URL', 'luxortheme' ),
			'section' => 'business_info',
			'settings' => 'rssLink',
			'type'    => 'text',
		) );
		
		
		
		/**** Post Options ****/
		$wp_customize->add_section( 'post_options' , array(
			'title'    => esc_html__( 'Post Options', 'luxortheme' ),
			'priority' => 120,
		));
		
		/* Upload options */
		$wp_customize->add_setting( 'authorBackgroundImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'authorBackgroundImage', 
			array(
				'label'    => esc_html__( 'Author Background Image', 'luxortheme' ),
				'section'  => 'post_options',
				'settings' => 'authorBackgroundImage',
				'priority' => 1,
				) 
			) 
		);
		
		$wp_customize->add_setting( 'commentsBackgroundImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'commentsBackgroundImage', 
			array(
				'label'    => esc_html__( 'Comments Background Image', 'luxortheme' ),
				'section'  => 'post_options',
				'settings' => 'commentsBackgroundImage',
				'priority' => 1,
				) 
			) 
		);
						
		//Textfields
		
		//Radio options
		$wp_customize->add_setting('displayAuthorProfile', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('displayAuthorProfile', array(
			'label'      => esc_html__('Display Author Profile?', 'luxortheme'),
			'section'    => 'post_options',
			'settings'   => 'displayAuthorProfile',
			'type'       => 'radio',
			'priority' => 3,
			'choices'    => array(
				'on'   =>  esc_html__( 'ON', 'luxortheme' ),
				'off'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));
		
		$wp_customize->add_setting('toggleParallaxAuthor', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('toggleParallaxAuthor', array(
			'label'      => esc_html__('Enable Parallax on Author and Comments?', 'luxortheme'),
			'section'    => 'post_options',
			'settings'   => 'toggleParallaxAuthor',
			'type'       => 'radio',
			'priority' => 4,
			'choices'    => array(
				'on'   =>  esc_html__( 'ON', 'luxortheme' ),
				'off'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));
		
		$wp_customize->add_setting('displaySocialFeatures', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('displaySocialFeatures', array(
			'label'      => esc_html__('Display Social Features?', 'luxortheme'),
			'section'    => 'post_options',
			'settings'   => 'displaySocialFeatures',
			'type'       => 'radio',
			'priority' => 5,
			'choices'    => array(
				'on'   =>  esc_html__( 'ON', 'luxortheme' ),
				'off'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));
		
		$wp_customize->add_setting('displayRelatedPosts', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('displayRelatedPosts', array(
			'label'      => esc_html__('Display Related Posts?', 'luxortheme'),
			'section'    => 'post_options',
			'settings'   => 'displayRelatedPosts',
			'type'       => 'radio',
			'priority' => 6,
			'choices'    => array(
				'on'   =>  esc_html__( 'ON', 'luxortheme' ),
				'off'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));
		
		$wp_customize->add_setting('displayComments', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('displayComments', array(
			'label'      => esc_html__('Display Comments?', 'luxortheme'),
			'section'    => 'post_options',
			'settings'   => 'displayComments',
			'type'       => 'radio',
			'priority' => 7,
			'choices'    => array(
				'on'   =>  esc_html__( 'ON', 'luxortheme' ),
				'off'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));


		$wp_customize->add_setting(
			'relatedPropertiesTitle', array(
				'default' => esc_html__("Similar Properties", 'luxortheme'),
				'sanitize_callback' => 'esc_attr'
			)
		);

		$wp_customize->add_control(
			'relatedPropertiesTitle',
			 array(
				'label' => esc_html__( 'Related Properties title', 'luxortheme' ),
			 	'section' => 'post_options',
				'priority' => 8,
			 )
		);
		
		
		$PostColors = array();
		
		
		$PostColors[] = array(
			'slug'=>'authorCommentsBoxColor', 
			'default' => '#2B2B2B',
			'transport' => 'postMessage',
			'label' => esc_html__('Author/Comments Box Color', 'luxortheme'),
			'description' => esc_html__('Adjust the background color of the author profile container and the comments box container.', 'luxortheme')
		);
		
		$PostColors[] = array(
			'slug'=>'featuredPropertyRibbon', 
			'default' => '#EA3D36',
			'transport' => 'postMessage',
			'label' => esc_html__('Featured Property Ribbon', 'luxortheme'),
			'description' => esc_html__('Adjust the color of the ribbon which appears on featured properties.', 'luxortheme')
		);
				
		foreach( $PostColors as $color ) {
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'transport' => $color['transport'],
					'description' => $color['description'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr'
				)
			);
			
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'transport' => $color['transport'],
					'description' => $color['description'],
					'section' => 'post_options',
					'settings' => $color['slug'],
					)
				)
			);
			
		}//end of foreach
		
		
		/**** Custom Post Type Options ****/
		$wp_customize->add_section( 'custom_post_type_options' , array(
			'title'    => esc_html__( 'Custom Post Type Options', 'luxortheme' ),
			'priority' => 130,
		));
				
		$wp_customize->add_setting('agent_posts_per_load',
			array(
				'default' => '3',
				'sanitize_callback' => 'esc_attr'
			)
		);
		
		$wp_customize->add_control('agent_posts_per_load',
			array(
				'type' => 'select',
				'priority' => 4,
				'label' => esc_html__( 'Agent Posts Per Load', 'luxortheme' ),
				'section' => 'custom_post_type_options',
				'choices' => array(
					'3' => '3',
					'6' => '6',
					'9' => '9',
					'12' => '12',
					'15' => '15',
					'-1' => esc_html__('View All','luxortheme')
				),
			)
		);
		
		$wp_customize->add_setting('agentPostOrder', array(
			'default' => 'DESC',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('agentPostOrder', array(
			'label'      => esc_html__('Agent Post Order', 'luxortheme'),
			'section'    => 'custom_post_type_options',
			'settings'   => 'agentPostOrder',
			'type'       => 'radio',
			'priority' => 5,
			'choices'    => array(
				'ASC'   => esc_html__('Ascending','luxortheme'),
				'DESC'  => esc_html__('Descending','luxortheme')
			),
		));
		
		$wp_customize->add_setting('properties_posts_per_load',
			array(
				'default' => '4',
				'sanitize_callback' => 'esc_attr'
			)
		);
		
		$wp_customize->add_control('properties_posts_per_load',
			array(
				'type' => 'select',
				'priority' => 6,
				'label' => esc_html__( 'Property Posts Per Load', 'luxortheme' ),
				'section' => 'custom_post_type_options',
				'choices' => array(
					'4' => '4',
					'8' => '8',
					'12' => '12',
					'16' => '16',
					'19' => '19',
					'21' => '21',
					'-1' => esc_html__('View All','luxortheme')
				),
			)
		);
		
		$wp_customize->add_setting('agencies_posts_per_load',
			array(
				'default' => '4',
				'sanitize_callback' => 'esc_attr'
			)
		);
		
		$wp_customize->add_control('agencies_posts_per_load',
			array(
				'type' => 'select',
				'priority' => 7,
				'label' => esc_html__( 'Agencies Posts Per Load', 'luxortheme' ),
				'section' => 'custom_post_type_options',
				'choices' => array(
					'4' => '4',
					'8' => '8',
					'12' => '12',
					'16' => '16',
					'19' => '19',
					'21' => '21',
					'-1' => esc_html__('View All','luxortheme')
				),
			)
		);
						
		
		/**** Shortcode Options ****/
		$wp_customize->add_section( 'shortcode_options' , array(
			'title'    => esc_html__( 'Shortcode Options', 'luxortheme' ),
		));
		
		/* Upload options */
		
		
		//slider options
		$wp_customize->add_setting( 'postCarouselSpeed', array(
			'default' => 0,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'postCarouselSpeed', array(
			'type' => 'range',
			'section' => 'shortcode_options',
			'label'   => esc_html__( 'Post Items Carousel Speed', 'luxortheme' ),
			'description' => esc_html__('Adjust the carousel speed of the news posts shortcode. Leave this value all the way to the left to disable the carousel feature. (Requires window refresh)', 'luxortheme'),
			'priority' => 8,
			'input_attrs' => array(
				'min' => 0,
				'max' => 10000,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		
				
		//Shortcode Option Colors
		$shortcodeOptionColors = array();

		$shortcodeOptionColors[] = array(
			'slug'=>'accordionContentBgColor', 
			'default' => '#f4f4f4',
			'transport' => 'postMessage',
			'label' => esc_html__('Accordion content background color', 'luxortheme'),
			'description' => esc_html__('Adjust the background color of the accordion menu content area.', 'luxortheme')
		);
		
		$shortcodeOptionColors[] = array(
			'slug'=>'tabContentBgColor', 
			'default' => '#f4f4f4',
			'transport' => 'postMessage',
			'label' => esc_html__('Tab content background color', 'luxortheme'),
			'description' => esc_html__('Adjust the background color of the tab system content area.', 'luxortheme')
		);
		
		$shortcodeOptionColors[] = array(
			'slug'=>'quote_box_color', 
			'default' => '#7f6631',
			'transport' => 'refresh',
			'label' => esc_html__('Quote box color', 'luxortheme'),
			'description' => esc_html__('Adjust the background color of the quote box shortcode. (Requires window refresh)', 'luxortheme')
		);
		
		$shortcodeOptionColors[] = array(
			'slug'=>'data_table_title_color', 
			'default' => '#7f6631',
			'transport' => 'postMessage',
			'label' => esc_html__('Data Table title color', 'luxortheme'),
			'description' => esc_html__('Adjust the background color of the data table title column.', 'luxortheme')
		);
		
		$shortcodeOptionColors[] = array(
			'slug'=>'data_table_info_color', 
			'default' => '#f4f4f4',
			'transport' => 'postMessage',
			'label' => esc_html__('Data Table info color', 'luxortheme'),
			'description' => esc_html__('Adjust the background color of the data table info column.', 'luxortheme')
		);
		
		$shortcodeOptionColors[] = array(
			'slug'=>'testimonials_carousel_color', 
			'default' => '#ffffff',
			'transport' => 'postMessage',
			'label' => esc_html__('Testimonials Carousel color', 'luxortheme'),
			'description' => esc_html__('Adjust the color of the testimonials carousel.', 'luxortheme')
		);
		
		$shortcodeOptionColors[] = array(
			'slug'=>'timetable_font_color', 
			'default' => '#ffffff',
			'transport' => 'postMessage',
			'label' => esc_html__('Time Table font color', 'luxortheme'),
			'description' => esc_html__('Adjust the color of the time table content.', 'luxortheme')
		);
		
		$shortcodeOptionColors[] = array(
			'slug'=>'timetable_border_color', 
			'default' => '#efefef',
			'transport' => 'postMessage',
			'label' => esc_html__('Time Table border color', 'luxortheme'),
			'description' => esc_html__('Adjust the border color of the time table shortcode.', 'luxortheme')
		);

				
		$shortcodeOptionColorsCounter = 50;
				
		foreach( $shortcodeOptionColors as $color ) {
			
			$shortcodeOptionColorsCounter += 10;
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'transport' => $color['transport'],
					'description' => $color['description'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr'
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'section' => 'shortcode_options',
					'transport' => $color['transport'],
					'description' => $color['description'],
					'priority' => $shortcodeOptionColorsCounter,
					'settings' => $color['slug'])
				)
			);
		}//end of foreach
		
		
		/**** Woocommerce Options ****/
		 
		$wp_customize->add_section( 'woo_options' , array(
			'title'    => esc_attr__( 'Woocommerce Options', 'luxortheme' ),
			'priority' => 100,
		));
		
		$wp_customize->add_setting('products_per_page',
			array(
				'default' => '8',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control('products_per_page',
			array(
				'type' => 'select',
				'label' => esc_attr__( 'Products Per Page', 'luxortheme' ),
				'section' => 'woo_options',
				'choices' => array(
					'4' => '4',
					'8' => '8',
					'12' => '12',
					'16' => '16',
					'20' => '20',
					'24' => '24',
					'28' => '28',
					'32' => '32',
				),
			)
		);
		
		
		//Radio Options		
		$wp_customize->add_setting(
			'woocommShopLayout', array(
				'default' => 'no-sidebar',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Radio_Control( 
			$wp_customize, 'woocommShopLayout', 
				array(
					'label'   => esc_attr__('Woocommerce layout', 'luxortheme' ),
					'section' => 'woo_options',
					'settings'   => 'woocommShopLayout',
					'type'     => 'radio',
					'mode'     => 'image',
					'description' => esc_attr__('Applies to all Woocommerce templates.', 'luxortheme' ),
					'choices'  => array(
						'no-sidebar' => get_template_directory_uri() . '/css/img/layouts/no-sidebar.png',
						'left-sidebar' => get_template_directory_uri() . '/css/img/layouts/left-sidebar.png',
						'right-sidebar' => get_template_directory_uri() . '/css/img/layouts/right-sidebar.png',
					),
				) 
			) 
		);
		
		
		//Upload Options
		$wp_customize->add_setting( 'wooCategoryHeaderImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'wooCategoryHeaderImage', 
			array(
				'label'    => esc_attr__( 'Category/Tag Page Header Image', 'luxortheme' ),
				'section'  => 'woo_options',
				'settings' => 'wooCategoryHeaderImage',
				) 
			) 
		);
		
		
		/**** Alert Options ****/
		$wp_customize->add_section( 'alert_options' , array(
			'title'    => esc_html__( 'Alert Options', 'luxortheme' ),
		));
				
		$alertColors = array();
		
		$alertColors[] = array(
			'slug'=>'alert_success_color', 
			'default' => '#2c5e83',
			'transport' => 'postMessage',
			'label' => esc_html__('Success Color', 'luxortheme'),
			'description' => esc_html__('Adjust the background color of the success alert element.', 'luxortheme')
		);
		$alertColors[] = array(
			'slug'=>'alert_info_color', 
			'default' => '#cbb35e',
			'transport' => 'postMessage',
			'label' => esc_html__('Info Color', 'luxortheme'),
			'description' => esc_html__('Adjust the background color of the info alert element.', 'luxortheme')
		);
		$alertColors[] = array(
			'slug'=>'alert_warning_color', 
			'default' => '#ea6872',
			'transport' => 'postMessage',
			'label' => esc_html__('Warning Color', 'luxortheme'),
			'description' => esc_html__('Adjust the background color of the warning alert element.', 'luxortheme')
		);
		$alertColors[] = array(
			'slug'=>'alert_danger_color', 
			'default' => '#5f3048',
			'transport' => 'postMessage',
			'label' => esc_html__('Danger Color', 'luxortheme'),
			'description' => esc_html__('Adjust the background color of the danger alert element.', 'luxortheme')
		);
		$alertColors[] = array(
			'slug'=>'alert_notice_color', 
			'default' => '#49c592',
			'transport' => 'postMessage',
			'label' => esc_html__('Notice Color', 'luxortheme'),
			'description' => esc_html__('Adjust the background color of the notice alert element.', 'luxortheme')
		);
		
		$alertColorsCounter = 50;
		
		foreach( $alertColors as $color ) {
			
			$alertColorsCounter += 10;
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'transport' => $color['transport'],
					'description' => $color['description'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr'
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'section' => 'alert_options',
					'transport' => $color['transport'],
					'description' => $color['description'],
					'settings' => $color['slug'],
					'priority' => $alertColorsCounter,
					)
				)
			);
		}//end of foreach
		
		/**** Micro Slider Options ****/
		$wp_customize->add_section( 'pulseslider_options' , array(
			'title'    => esc_html__( 'Micro Slider Options', 'luxortheme' ),
		));
		
		//Upload Options
		$wp_customize->add_setting( 'sliderBackgroundImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);

		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'sliderBackgroundImage', 
			array(
				'label'    => esc_html__( 'Slider Background Image', 'luxortheme' ),
				'section'  => 'pulseslider_options',
				'settings' => 'sliderBackgroundImage',
				'priority' => 1,
				) 
			) 
		);		
		
		$wp_customize->add_setting('enablePulseSlider', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enablePulseSlider', array(
			'label'      => esc_html__('Enable Micro Slider?', 'luxortheme'),
			'section'    => 'pulseslider_options',
			'settings'   => 'enablePulseSlider',
			'priority' => 2,
			'type'       => 'radio',
			'choices'    => array(
				'on'   =>  esc_html__( 'ON', 'luxortheme' ),
				'off'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));

		
		$wp_customize->add_setting('enableSlideShow', array(
			'default' => 'true',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableSlideShow', array(
			'label'      => esc_html__('Enable SlideShow?', 'luxortheme'),
			'section'    => 'pulseslider_options',
			'settings'   => 'enableSlideShow',
			'priority' => 3,
			'type'       => 'radio',
			'choices'    => array(
				'true'   =>  esc_html__( 'ON', 'luxortheme' ),
				'false'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));
		
		$wp_customize->add_setting('slideLoop', array(
			'default' => 'true',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('slideLoop', array(
			'label'      => esc_html__('Loop Slides?', 'luxortheme'),
			'section'    => 'pulseslider_options',
			'settings'   => 'slideLoop',
			'priority' => 4,
			'type'       => 'radio',
			'choices'    => array(
				'true'   =>  esc_html__( 'ON', 'luxortheme' ),
				'false'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));

		$wp_customize->add_setting('enableControlNav', array(
			'default' => 'true',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableControlNav', array(
			'label'      => esc_html__('Enable Bullets?', 'luxortheme'),
			'section'    => 'pulseslider_options',
			'settings'   => 'enableControlNav',
			'priority' => 5,
			'type'       => 'radio',
			'choices'    => array(
				'true'   =>  esc_html__( 'ON', 'luxortheme' ),
				'false'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));
		
		$wp_customize->add_setting('pauseOnHover', array(
			'default' => 'true',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('pauseOnHover', array(
			'label'      => esc_html__('Pause on hover?', 'luxortheme'),
			'section'    => 'pulseslider_options',
			'settings'   => 'pauseOnHover',
			'priority' => 6,
			'type'       => 'radio',
			'choices'    => array(
				'true'   =>  esc_html__( 'ON', 'luxortheme' ),
				'false'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));
		
		$wp_customize->add_setting('showArrows', array(
			'default' => 'true',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('showArrows', array(
			'label'      => esc_html__('Display arrows?', 'luxortheme'),
			'section'    => 'pulseslider_options',
			'settings'   => 'showArrows',
			'priority' => 7,
			'type'       => 'radio',
			'choices'    => array(
				'true'   =>  esc_html__( 'ON', 'luxortheme' ),
				'false'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));
		
		$wp_customize->add_setting('showBulletThumbs', array(
			'default' => 'true',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('showBulletThumbs', array(
			'label'      => esc_html__('Display Bullet Thumbs?', 'luxortheme'),
			'section'    => 'pulseslider_options',
			'settings'   => 'showBulletThumbs',
			'priority' => 8,
			'type'       => 'radio',
			'choices'    => array(
				'true'   =>  esc_html__( 'ON', 'luxortheme' ),
				'false'  => esc_html__( 'OFF', 'luxortheme' ),
			),
		));

		$wp_customize->add_setting('animationType', array(
			'default' => 'slide',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('animationType', array(
			'label'      => esc_html__('Animation Type', 'luxortheme'),
			'section'    => 'pulseslider_options',
			'settings'   => 'animationType',
			'priority' => 9,
			'type'       => 'radio',
			'choices'    => array(
				'fade'   =>  esc_html__( 'Fade', 'luxortheme' ),
				'slide'  =>  esc_html__( 'Slide', 'luxortheme' ),
			),
		));

		
		
		$wp_customize->add_setting( 'slideShowSpeed', array(
			'default' => 8000,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'slideShowSpeed', array(
			'type' => 'range',
			'section' => 'pulseslider_options',
			'label'   => esc_html__( 'Slide Show Speed', 'luxortheme' ),
			'description' => esc_html__('Adjust the slideshow speed of the Micro Slider. Only applies if the Slideshow option is enabled. (Requires window refresh)', 'luxortheme'),
			'priority' => 10,
			'input_attrs' => array(
				'min' => 1000,
				'max' => 10000,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
	
		
		$wp_customize->add_setting( 'slideSpeed', array(
			'default' => 800,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'slideSpeed', array(
			'type' => 'range',
			'section' => 'pulseslider_options',
			'label'   => esc_html__( 'Slide Speed', 'luxortheme' ),
			'description' => esc_html__('Adjust the slide speed of the Micro Slider. (Requires window refresh)', 'luxortheme'),
			'priority' => 11,
			'input_attrs' => array(
				'min' => 500,
				'max' => 1000,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		

		
		$wp_customize->add_setting( 'sliderTitleOpacity', array(
			'default' => 100,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'sliderTitleOpacity', array(
			'type' => 'range',
			'section' => 'pulseslider_options',
			'label'   => esc_html__( 'Title / Sub-Title opacity', 'luxortheme' ),
			'description' => esc_html__('Adjust the background opacity of the slider title and message. (Requires window refresh)', 'luxortheme'),
			'priority' => 12,
			'input_attrs' => array(
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		
		$wp_customize->add_setting( 'sliderButtonBGOpacity', array(
			'default' => 0,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'sliderButtonBGOpacity', array(
			'type' => 'range',
			'section' => 'pulseslider_options',
			'label'   => esc_html__( 'Button Background Opacity', 'luxortheme' ),
			'description' => esc_html__('Adjust the background opacity of the slider button. (Requires window refresh)', 'luxortheme'),
			'priority' => 13,
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		
		
				
		$PulseSliderColors = array();
		
		$PulseSliderColors[] = array(
			'slug'=>'sliderTitleBackgroundColor', 
			'default' => '#000000',
			'transport' => 'refresh',
			'label' => esc_html__('Title / Message background color', 'luxortheme'),
			'description' => esc_html__('Adjust the background color of the Micro Slider title and message. (Requires window refresh)', 'luxortheme')
		);
				
		$PulseSliderColors[] = array(
			'slug'=>'sliderButtonColor', 
			'default' => '#ffffff',
			'transport' => 'refresh',
			'label' => esc_html__('Button color', 'luxortheme'),
			'description' => esc_html__('Adjust the color of the Micro Slider button. (Requires window refresh)', 'luxortheme')
		);
		
		$PulseSliderColors[] = array(
			'slug'=>'sliderButtonBGColor', 
			'default' => '#000000',
			'transport' => 'refresh',
			'label' => esc_html__('Button Background color', 'luxortheme'),
			'description' => esc_html__('Adjust the background color of the Micro Slider button. (Requires window refresh)', 'luxortheme')
		);
		
		$PulseSliderColorsCounter = 50;
				
		foreach( $PulseSliderColors as $color ) {
			
			$PulseSliderColorsCounter += 10;
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'transport' => $color['transport'],
					'description' => $color['description'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr'
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'transport' => $color['transport'],
					'description' => $color['description'],
					'section' => 'pulseslider_options',
					'priority' => $PulseSliderColorsCounter,
					'settings' => $color['slug'])
				)
			);
		}//end of foreach
				
   }//end of function
     
}//end of class


if (class_exists('WP_Customize_Control')) {
	
	//Custom radio with image support
	class pm_ln_Customize_Radio_Control extends WP_Customize_Control {

		public $type = 'radio';
		public $description = '';
		public $mode = 'radio';
		public $subtitle = '';
	
		public function enqueue() {
	
			if ( 'buttonset' == $this->mode || 'image' == $this->mode ) {
				wp_enqueue_script( 'jquery-ui-button' );
				wp_register_style('customizer-styles', get_template_directory_uri() . '/css/customizer/pulsar-customizer.css');  
				wp_enqueue_style('customizer-styles');
			}
	
		}
	
		public function render_content() {
	
			if ( empty( $this->choices ) ) {
				return;
			}
	
			$name = '_customize-radio-' . $this->id;
	
			?>
			<span class="customize-control-title">
				<?php echo esc_html( $this->label ); ?>
			</span>
            
            <?php if ( isset( $this->description ) && '' != $this->description ) { ?>
                <p><?php echo strip_tags( esc_html( $this->description ) ); ?></p>
            <?php } ?>
	
			<div id="input_<?php echo $this->id; ?>" class="<?php echo $this->mode; ?>">
				<?php if ( '' != $this->subtitle ) : ?>
					<div class="customizer-subtitle"><?php echo $this->subtitle; ?></div>
				<?php endif; ?>
				<?php
	
				// JqueryUI Button Sets
				if ( 'buttonset' == $this->mode ) {
	
					foreach ( $this->choices as $value => $label ) : ?>
						<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo $this->id . $value; ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
							<label for="<?php echo $this->id . $value; ?>">
								<?php echo esc_html( $label ); ?>
							</label>
						</input>
						<?php
					endforeach;
	
				// Image radios.
				} elseif ( 'image' == $this->mode ) {
	
					foreach ( $this->choices as $value => $label ) : ?>
						<input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo $this->id . $value; ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
							<label for="<?php echo $this->id . $value; ?>">
								<img src="<?php echo esc_html( $label ); ?>">
							</label>
						</input>
						<?php
					endforeach;
	
				// Normal radios
				} else {
	
					foreach ( $this->choices as $value => $label ) :
						?>
						<label class="customizer-radio">
							<input class="kirki-radio" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
							<?php echo esc_html( $label ); ?><br/>
						</label>
						<?php
					endforeach;
	
				}
				?>
			</div>
			<?php if ( 'buttonset' == $this->mode || 'image' == $this->mode ) { ?>
				<script>
				jQuery(document).ready(function($) {
					$( '[id="input_<?php echo $this->id; ?>"]' ).buttonset();
				});
				</script>
			<?php }
	
		}
	}
	
	//jQuery UI Slider class
	class pm_ln_Customize_Sliderui_Control extends WP_Customize_Control {

		public $type = 'slider';
		public $description = '';
		public $subtitle = '';
	
		public function enqueue() {
	
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-ui-slider' );
	
		}
	
		public function render_content() { ?>
			<label>
	
				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
					<?php if ( isset( $this->description ) && '' != $this->description ) { ?>
						<a href="#" class="button tooltip" title="<?php echo strip_tags( esc_html( $this->description ) ); ?>">?</a>
					<?php } ?>
				</span>
	
				<?php if ( '' != $this->subtitle ) : ?>
					<div class="customizer-subtitle"><?php echo $this->subtitle; ?></div>
				<?php endif; ?>
	
				<input type="text" class="kirki-slider" id="input_<?php echo $this->id; ?>" disabled value="<?php echo $this->value(); ?>" <?php $this->link(); ?>/>
	
			</label>
	
			<div id="slider_<?php echo $this->id; ?>" class="ss-slider"></div>
			<script>
			jQuery(document).ready(function($) {
				$( '[id="slider_<?php echo $this->id; ?>"]' ).slider({
						value : <?php echo $this->value(); ?>,
						min   : <?php echo $this->choices['min']; ?>,
						max   : <?php echo $this->choices['max']; ?>,
						step  : <?php echo $this->choices['step']; ?>,
						slide : function( event, ui ) { $( '[id="input_<?php echo $this->id; ?>"]' ).val(ui.value).keyup(); }
				});
				$( '[id="input_<?php echo $this->id; ?>"]' ).val( $( '[id="slider_<?php echo $this->id; ?>"]' ).slider( "value" ) );
			});
			</script>
			<?php
	
		}
	}
	
	//Custom classes for extending the theme customizer
	class pm_ln_Customize_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';
	 
		public function render_content() {
			?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
				</label>
			<?php
		}
	}

}


add_action( 'customize_register' , array( 'PM_LN_Customizer' , 'register' ) );

?>