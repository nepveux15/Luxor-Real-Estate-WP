/**
 * File customize-preview.js.
 *
 * Instantly live-update customizer settings in the preview for improved user experience.
 */

(function( $ ) {

	// Collect information from customize-controls.js about which panels are opening.
	wp.customize.bind( 'preview-ready', function() {

		// Initially hide the theme option placeholders on load
		$( '.panel-placeholder' ).hide();

		wp.customize.preview.bind( 'section-highlight', function( data ) {

			// Only on the front page.
			if ( ! $( 'body' ).hasClass( 'procast_theme-front-page' ) ) {
				return;
			}

			// When the section is expanded, show and scroll to the content placeholders, exposing the edit links.
			if ( true === data.expanded ) {
				$( 'body' ).addClass( 'highlight-front-sections' );
				$( '.panel-placeholder' ).slideDown( 200, function() {
					$.scrollTo( $( '#panel1' ), {
						duration: 600,
						offset: { 'top': -70 } // Account for sticky menu.
					});
				});

			// If we've left the panel, hide the placeholders and scroll back to the top.
			} else {
				$( 'body' ).removeClass( 'highlight-front-sections' );
				// Don't change scroll when leaving - it's likely to have unintended consequences.
				$( '.panel-placeholder' ).slideUp( 200 );
			}
		});
	});
	
	//Header textfields
	wp.customize( 'headerPostsListSelector', function( value ) {
		value.bind( function( to ) {
			$( '#pro-cast-posts-selector li.activator' ).text( to );
		});
	});
	
	//Reviews textfields
	wp.customize( 'keyRating1Text', function( value ) {
		value.bind( function( to ) {
			$( '.pro-cast-review-rating-score-bar.level-one p' ).text( to );
		});
	});
	
	
	//Footer textfields
	wp.customize( 'newsletterFieldText', function( value ) {
		value.bind( function( to ) {
			$( '.pro-cast-newsletter-field' ).val( to );
		});
	});
		
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		});
	});
		
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		});
	});

	
	//Header options
	
	//Header Colors
	wp.customize( 'microNavColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pro-cast-header-row-wrapper-micro-nav' ).css({
					backgroundColor : to
				});	
				
				/*$( '.pro-cast-social-icons li' ).css({
					borderLeft : '1px solid' + to
					borderRight : '1px solid' + to
					borderBottom : '1px solid' + to
				});*/
				
				/*$( '.pro-cast-general-info' ).css({
					color : to
				});	*/
				
			}			
		});		
	});	
	//end Header Colors
	
	//Header slider options
	wp.customize( 'headerPadding', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
	
				$( 'header' ).css({
					paddingTop : to + 'px',
					paddingBottom : to  + 'px'
					//opacity : to / 100
				});				
			}			
		});		
	});
	
	//Global options
	wp.customize( 'primaryColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.woocommerce .widget_price_filter .ui-slider .ui-slider-range' ).css({
					backgroundColor : to
				});	
				
				$( '.woocommerce div.product form.cart .reset_variations' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce div.product p.price' ).css({
					color : to
				});
				
				$( '.woocommerce div.product span.price' ).css({
					color : to
				});
				
				$( 'header' ).css({
					borderBottom : "1px solid" + to
				});
				
				$( '.pm-form-textfield.security-field.property-post' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm-footer-copyright a' ).css({
					color : to
				});
				
				$( '.pm-widget-footer .pm-recent-blog-post-details a' ).css({
					color : to
				});
				
				$( '.pm-news-post-btn' ).css({
					borderLeft : "1px solid" + to
				});
				
				$( '.pm-property-status-list li' ).css({
					backgroundColor : to
				});
				
				$( '.pm-property-post-video-btn' ).css({
					backgroundColor : to
				});
				
				$( '.pm-property-post-map-btn' ).css({
					backgroundColor : to
				});
				
				$( '.pm-agent-form-response' ).css({
					color : to
				});
				
				$( '.result-message' ).css({
					color : to
				});
				
				$( '#pm-quick-message' ).css({
					color : to
				});
				
				$( '.pm-login-field.invalid_field' ).css({
					backgroundColor : to
				});
				
				$( '.pm-single-testimonial-avatar-icon' ).css({
					border : "3px solid" + to
				});
				
				$( '.pm-pricing-table-featured' ).css({
					borderTop : "80px solid" + to
				});
				
				$( '.pm-mobile-global-sign-in-fields p a' ).css({
					color : to
				});
				
				$( '.pm-mobile-global-registration-fields p a' ).css({
					color : to
				});
				
				$( '.pm-news-post-img-container' ).css({
					borderBottom : "4px solid" + to
				});
				
				$( '.pm-dropdown.pm-language-selector-menu .pm-dropmenu-active ul li' ).css({
					backgroundColor : to
				});
				
				$( '.pm-search-field-mobile' ).css({
					color : to
				});
				
				$( '.pm-column-title-divider-simple-end-point.primary' ).css({
					backgroundColor : to
				});
				
				$( '.pm-progress-bar-diamond' ).css({
					backgroundColor : to
				});
				
				$( '.pm-our-process-list li i' ).css({
					color : to
				});
				
				$( '.pm-progress-bar .pm-progress-bar-outer' ).css({
					backgroundColor : to
				});
				
				
				$( '.pm-our-process-divider-diamond' ).css({
					backgroundColor : to
				});
				
				$( '.pm-square-btn.filter' ).css({
					backgroundColor : to
				});
				
				$( '.pm-dropdown.pm-property-filter-system .pm-dropmenu .pm-menu-title' ).css({
					color : to
				});
				
				$( '.ui-widget-header' ).css({
					backgroundColor : to
				});
				
				$( '.pm-sub-header-info' ).css({
					borderBottom : "4px solid" + to
				});
				
				$( '.pm-featured-properties-list-thumb' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm-agencies-visual-layout-btn.active' ).css({
					color : to
				});
				
				$( '.pm-featured-properties-list-thumb a' ).css({
					backgroundColor : to
				});
				
				$( '.pm-widget-footer .pm-featured-properties-details a' ).css({
					color : to
				});
				
				$( '.pm-visual-layout-btn.active' ).css({
					color : to
				});
				
				$( '.pm-agencies-visual-layout-btn.active' ).css({
					color : to
				});
				
				$( '.pm-property-listing-ribbon' ).css({
					backgroundColor : to
				});
				
				$( '.pm-property-listings-btn' ).css({
					borderRightColor : to,
					borderBottomColor : to
				});
				
				$( '.pm-property-listings-img-container' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm-property-listing-divider' ).css({
					backgroundColor : to
				});
				
				$( '.pm-staff-profile-img-container-info p span' ).css({
					color : to
				});
				
				$( '.pm-staff-profile-img-container-info a' ).css({
					color : to
				});
				
				$( '.pm-image-gallery-lightbox-info-list li a' ).css({
					color : to
				});
				
				$( '.pm-image-gallery-lightbox-info-container' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm-image-gallery .pm-image-gallery-lightbox' ).css({
					borderRight : "1px solid" + to
				});
				
				$( '.pm-image-gallery .pm-image-gallery-close' ).css({
					backgroundColor : to
				});
				
				$( '.pm-image-gallery-lightbox-title-container a' ).css({
					backgroundColor : to
				});
				
				$( '.pm-image-gallery' ).css({
					borderLeft : "1px solid" + to,
					borderTop : "1px solid" + to
				});
				
				$( '.pm-image-gallery .pm-image-gallery-image' ).css({
					borderBottom : "1px solid" + to,
					borderRight : "1px solid" + to
				});
				
				$( '.pm-image-gallery-item-hover-btn' ).css({
					borderRightColor : to,
					borderBottomColor : to
				});
				
				$( '.pm-property-search-btn' ).css({
					backgroundColor : to
				});
				
				$( '.pm-dropdown.pm-filter-system .pm-dropmenu .pm-menu-title' ).css({
					color : to
				});
				
				$( '.pm-dropdown.pm-filter-system .pm-dropmenu i' ).css({
					color : to
				});
				
				$( '.pm-dropdown' ).css({
					borderBottom : "1px solid" + to
				});
				
				$( '.pm-property-search-system > li > .pm-property-search-text-field' ).css({
					borderBottom : "1px solid" + to,
					color : to
				});
				
				$( '.pm-testimonial-name' ).css({
					color : to
				});
				
				$( '.pm-column-title-divider-symbol' ).css({
					backgroundColor : to,
					border : "1px solid" + to,
				});
				
				$( '.pm-border-top' ).css({
					borderTop : "4px solid" + to,
				});
				
				$( '.pm-widget-footer .pm_quick_contact_submit' ).css({
					backgroundColor : to
				});
				
				$( '.pm-widget-footer .pm_mailchimp_submit' ).css({
					backgroundColor : to
				});
				
				$( '.pm_quick_contact_submit' ).css({
					backgroundColor : to
				});
				
				$( '.pm_mailchimp_submit' ).css({
					backgroundColor : to
				});
				
				$( '.pm-form-textfield-with-icon' ).css({
					border : "1px solid" + to,
				});
				
				$( '.pm-comment-header span' ).css({
					color : to
				});
				
				$( '.pm-single-post-category-link' ).css({
					borderRight : "3px solid" + to,
				});
				
				$( '.pm-news-post-details-link' ).css({
					backgroundColor : to
				});
				
				$( '.pm-comment-date .fn .url' ).css({
					color : to
				});
				
				$( '#cancel-comment-reply-link' ).css({
					color : to
				});
				
				$( '.pm-news-post-img-container' ).css({
					borderColor : to
				});
				
				$( '.pm-single-post-img-container' ).css({
					borderColor : to
				});
				
				$( '.pm-desktop-social-icons-list li a' ).css({
					color : to
				});
				
				$( '.flexslider .flex-prev' ).css({
					backgroundColor : to
				});
				
				$( '.flexslider .flex-next' ).css({
					backgroundColor : to
				});
				
				$( '.pm-fat-footer-title span' ).css({
					color : to
				});
				
				$( '.pm-widget-footer #wp-calendar tbody td' ).css({
					border : "1px solid" + to,
				});
				
				$( '.pm-widget-footer #wp-calendar tbody tr td#today' ).css({
					backgroundColor : to
				});
				
				$( '.pm-fat-footer-title-divider' ).css({
					backgroundColor : to
				});
				
				$( '.pm-fat-footer-title-divider-endpoint' ).css({
					backgroundColor : to
				});
				
				$( '.pm-caption h1 b' ).css({
					color : to
				});	
				
				$( '.pm-search-bar-btn' ).css({
					color : to
				});	
				
				$( '.pm-dots span.pm-currentDot' ).css({
					backgroundColor : to
				});		
				
				$( '.pm-nav-container-icons li a span' ).css({
					color : to
				});	
				
				$( '.pm-search-input-field' ).css({
					color : to
				});	
				
				$( '.pm-footer-back-to-top' ).css({
					borderBottom : "40px solid" + to,
				});
				
				$( 'footer' ).css({
					borderBottom : "4px solid" + to,
				});
				
				$( '.pm-news-post-divider' ).css({
					backgroundColor : to
				});	
				
				$( '.pm-footer-stats li span' ).css({
					color : to
				});	
				
				$( '.pm-nav-container-icons li a i' ).css({
					color : to
				});	
				
				$( '.pm-footer-copyright span' ).css({
					color : to
				});	
				
				$( '.pm-footer-contact-list li span' ).css({
					color : to
				});	
				
				$( '.pm-global-menu-social-icons li a' ).css({
					color : to
				});	
				
				$( '.pm-footer-social-icons li a' ).css({
					color : to
				});	
				
				$( '.pm-tweet-list ul li a' ).css({
					color : to
				});	
				
				$( '.widget_rss ul li a' ).css({
					color : to
				});	
				
				$( '.pagination_multi a li' ).css({
					backgroundColor : to
				});	
				
				$( '.pm-post-navigation li a' ).css({
					color : to
				});
				
				$( '.pm-sidebar-title-divider-symbol-shadow' ).css({
					borderTop : "18px solid" + to,
				});
				
				$( '.pm-sidebar .widget_categories ul li' ).css({
					color : to
				});
				
				$( '.pm_quick_contact_field.Light' ).css({
					border : "1px solid" + to,
				});
				
				$( '.pm_quick_contact_textarea.Light' ).css({
					border : "1px solid" + to,
				});
				
				$( '.pm-pagination li' ).css({
					border : "3px solid" + to,
					backgroundColor : to
				});
				
				$( '.pm-single-news-post-avatar-icon' ).css({
					border : "3px solid" + to
				});
				
				$( '.pm-comment-form-textfield' ).css({
					borderBottom : "3px solid" + to
				});
				
				$( '.pm-comment-form-textarea' ).css({
					borderBottom : "3px solid" + to
				});
				
				$( '.pm-square-btn' ).css({
					backgroundColor : to
				});
				
				$( '.pm-primary' ).css({
					color : to
				});
				
				$( '.pm-members-listing-searchfield' ).css({
					border : "1px solid" + to,
					color : to
				});
				
				$( '.pm-submit-listing-btn' ).css({
					backgroundColor : to
				});
				
				$( '.pm-owl-prev' ).css({
					color : to
				});
				
				$( '.pm-owl-next' ).css({
					color : to
				});
				
				$( '.pm-owl-play' ).css({
					color : to
				});
				
				$( '.pm-form-textfield.invalid_field' ).css({
					border : "1px solid" + to,
					backgroundColor : to
				});
				
				$( '.pm-form-textarea.invalid_field' ).css({
					border : "1px solid" + to,
					backgroundColor : to
				});
				
				$( '.pm-form-textarea.invalid_field' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm-form-textfield.invalid_field' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm-form-submit-btn' ).css({
					backgroundColor : to
				});
				
				$( '.tinynav' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm-square-btn.comments' ).css({
					backgroundColor : to
				});
				
				$( '.comment-reply-link' ).css({
					backgroundColor : to
				});
				
				$( '.form-submit .submit' ).css({
					backgroundColor : to
				});
				
				$( '.pm-fancy span' ).css({
					color : to
				});
				
				$( '.pm-fancy-title-endpoint' ).css({
					backgroundColor : to
				});
				
				$( '.pm-author-bio-img-container' ).css({
					border : "5px solid" + to
				});
				
				$( '.pm-author-bio-container .name' ).css({
					color : to
				});
				
				$( '.pm-author-bio-container a' ).css({
					color : to
				});
				
				$( '.pm-comment' ).css({
					borderTop : "1px solid" + to
				});
				
				$( '.pm-comment-avatar' ).css({
					border : "3px solid" + to
				});
	
				
			}			
		});		
	});	
					
	
	
	wp.customize( 'secondaryColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm-staff-profile-contact-list.author-profile > li > i' ).css({
					color : to
				});	
				
				$( '.pm-members-pagination li a.active' ).css({
					backgroundColor : to
				});	
				
				$( '.woocommerce .widget_price_filter .ui-slider .ui-slider-handle' ).css({
					backgroundColor : to
				});	
				
				$( '.woocommerce span.onsale' ).css({
					backgroundColor : to
				});	
				
				$( '.woocommerce ul.products li.product .price' ).css({
					color : to
				});	
				
				$( '.woocommerce div.product .woocommerce-tabs ul.tabs li.active > a' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce .star-rating span' ).css({
					color : to
				});	
				
				$( '.woocommerce p.stars a' ).css({
					color : to
				});	
				
				$( '.woocommerce-review-link' ).css({
					color : to
				});	
				
				$( '.woocommerce form .form-row.woocommerce-invalid .select2-container' ).css({
					borderColor : to
				});	
				
				$( '.woocommerce form .form-row.woocommerce-invalid input.input-text' ).css({
					borderColor : to
				});	
				
				$( '.woocommerce form .form-row.woocommerce-invalid select' ).css({
					borderColor : to
				});	
				
				$( '.woocommerce form .form-row.woocommerce-invalid label' ).css({
					color : to
				});	
				
				$( '.woocommerce form .form-row .required' ).css({
					color : to
				});	
				
				$( '.woocommerce a.remove' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce-error, .woocommerce-info' ).css({
					borderTop : "3px solid" + to
				});
				
				$( '.woocommerce-message' ).css({
					borderTop : "3px solid" + to
				});
				
				$( '.woocommerce ul.products li.product .price' ).css({
					color : to
				});	
				
				$( '.woocommerce form .form-row.woocommerce-validated .select2-container' ).css({
					borderColor : to
				});
				
				$( '.woocommerce form .form-row.woocommerce-validated input.input-text' ).css({
					borderColor : to
				});
				
				$( '.woocommerce form .form-row.woocommerce-validated select' ).css({
					borderColor : to
				});
				
				$( '.page-numbers.current' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce #respond input#submit.alt' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce a.button.alt' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce button.button.alt' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce input.button.alt' ).css({
					backgroundColor : to
				});
				
				$( '.product_meta > span > a' ).css({
					color : to
				});
				
				$( '.woocommerce #respond input#submit' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce a.button' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce button.button' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce input.button' ).css({
					backgroundColor : to
				});
				
				$( '.pm-newsletter-form-container input[type="text"]' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm-video-activator-btn' ).css({
					border : "3px solid" + to
				});
				
				$( '.pm_quick_contact_field.Dark.invalid_field' ).css({
					backgroundColor : to
				});
				
				$( '.pm-news-post-title i' ).css({
					color : to
				});
				
				$( '.pm-news-post-btn' ).css({
					color : to
				});
				
				$( '.pm-news-post-date i' ).css({
					color : to
				});
				
				$( '.pm-property-contact-agent-btn' ).css({
					backgroundColor : to
				});
				
				$( '.pm-property-post-video-btn.active' ).css({
					backgroundColor : to
				});
				
				$( '.pm-property-post-map-btn.active' ).css({
					backgroundColor : to
				});
				
				$( '.pm-property-listing-excerpt a' ).css({
					color : to
				});
				
				$( '.pm-icon-btn' ).css({
					backgroundColor : to
				});
				
				$( '.pm-single-testimonial-img-bg' ).css({
					border : "5px solid" + to
				});
				
				$( '.pm-nav-tabs > li > a' ).css({
					backgroundColor : to
				});
				
				$( '.pm-icon-bundle' ).css({
					backgroundColor : to
				});
				
				$( '.pm-contact-google-text-overlay a' ).css({
					backgroundColor : to
				});
				
				$( '.panel-title i' ).css({
					backgroundColor : to
				});
				
				$( '.pm-agencies-list-email a' ).css({
					color : to
				});
				
				$( '.pm-agencies-list-address a' ).css({
					color : to
				});
				
				$( '.pm-column-title-divider-simple-end-point' ).css({
					backgroundColor : to
				});
				
				$( '.pm-agencies-list-details .name' ).css({
					color : to
				});
				
				$( '.pm-progress-bar-diamond' ).css({
					border : "3px solid" + to
				});
				
				$( '.pm-interactive-title-divider-endpoint.left' ).css({
					backgroundColor : to
				});
				
				$( '.pm-interactive-title-divider-endpoint.right' ).css({
					backgroundColor : to
				});
				
				$( '.pm-interactive-title-icon-container-hover' ).css({
					backgroundColor : to
				});
				
				$( '.pm-interactive-title-icon-container i' ).css({
					color : to
				});
				
				$( 'a.pm-secondary' ).css({
					color : to
				});
				
				$( '.pm-dropdown.widget.pm-property-filter-system .pm-dropmenu .pm-menu-title' ).css({
					color : to
				});
				
				$( '.pm-top-agents-details .name' ).css({
					color : to
				});
				
				$( '.pm-top-agents-details-btn' ).css({
					color : to
				});
				
				$( '.pm-dropdown.pm-agencies-filter-options .pm-dropmenu .pm-menu-title' ).css({
					color : to
				});
				
				$( '.pm-dropdown.pm-agencies-filter-options .pm-dropmenu i' ).css({
					color : to
				});
				
				$( '.pm-dropdown.pm-agencies-filter-options' ).css({
					borderBottom : "1px solid" + to
				});
				
				$( '.pm-agencies-list-title a' ).css({
					color : to
				});
				
				$( '.pm-form-textfield' ).css({
					color : to
				});
				
				$( '.pm-form-textarea' ).css({
					color : to
				});
				
				$( '.pm-staff-profile-name' ).css({
					color : to
				});
				
				$( '.pm-featured-properties-details a' ).css({
					color : to
				});
				
				$( '.pm-featured-properties-details a' ).css({
					color : to
				});
				
				$( '.pm-dropdown.pm-property-filter-options .pm-dropmenu .pm-menu-title' ).css({
					color : to
				});
				
				$( '.pm-dropdown.pm-property-filter-options' ).css({
					borderBottom : "1px solid" + to
				});
				
				$( '.pm-dropdown.pm-property-filter-options .pm-dropmenu i' ).css({
					color : to
				});
				
				$( '.pm-post-loaded-info li:first-child span' ).css({
					color : to
				});
				
				$( '.pm-post-loaded-info li:first-child strong' ).css({
					color : to
				});
				
				$( '.pm-post-loaded-info li a' ).css({
					color : to
				});
				
				$( '.pm-staff-profile-social-list li a' ).css({
					color : to,
					border : "1px solid" + to
				});
				
				$( '.pm-staff-profile-img-border-endpoint' ).css({
					backgroundColor : to
				});
				
				$( '.pm-staff-profile-img-container-btn' ).css({
					border : "3px solid" + to
				});
				
				$( '.pm-staff-profile-img-container-btn i' ).css({
					color : to
				});
				
				$( '.pm-property-search-btn-border' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm-property-search-btn-endpoint' ).css({
					backgroundColor : to
				});
				
				$( '.pm-dropdown.widget' ).css({
					borderBottom : "1px solid" + to
				});
				
				$( '.pm-property-search-text-field.widget' ).css({
					color : to,
					borderBottom : "1px solid" + to
				});
				
				$( '.pm-column-title-divider-end-point' ).css({
					backgroundColor : to
				});
				
				$( '.pm-recent-blog-post-details a' ).css({
					color : to
				});
				
				$( '.pm-news-post-info-container .meta-info a' ).css({
					color : to
				});
				
				$( '.pm-news-post-info-container .meta-like a' ).css({
					color : to
				});
				
				$( '.pm-news-post-info-container .title' ).css({
					color : to
				});
				
				$( '.post-date' ).css({
					color : to
				});
				
				$( '.pm-sidebar .pm-widget .tagcloud a' ).css({
					backgroundColor : to
				});
				
				$( '.tag-cloud-link' ).css({
					backgroundColor : to
				});
				
				$( '.pagination_multi li' ).css({
					backgroundColor : to
				});
				
				$( '.pm-single-post-social-icons li' ).css({
					border : "2px solid" + to
				});
				
				$( '.pm-single-post-social-icons li a' ).css({
					color : to
				});
				
				$( '.pm_quick_contact_field.invalid_field' ).css({
					border : "2px solid" + to
				});
				
				$( '.pm_quick_contact_textarea.invalid_field' ).css({
					border : "2px solid" + to
				});
				
				$( '.pm-widget-footer .tagcloud a' ).css({
					backgroundColor : to
				});
				
				$( '.pm-pagination li.current' ).css({
					backgroundColor : to,
					border : "3px solid" + to
				});
				
				$( '.pm-sidebar .pm-widget h6 span' ).css({
					color : to
				});
				
				$( '.widget.woocommerce > h6 span' ).css({
					color : to
				});
				
				$( '.pm-sidebar-title-divider-end-point' ).css({
					backgroundColor : to
				});
				
				$( '#pm-sidebar .pm-sidebar-search-field' ).css({
					color : to
				});
				
				$( '.pm-search-error span' ).css({
					color : to
				});
				
				$( '.pm-comment-header h3' ).css({
					color : to
				});
				
				$( '.pm-rounded-submit-btn' ).css({
					backgroundColor : to
				});
				
				$( '#place_order' ).css({
					backgroundColor : to
				});
				
				$( '.lost_reset_password input[type="submit"]' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce .form-row input[type="submit"]' ).css({
					backgroundColor : to
				});
				
				$( '.pm-secondary' ).css({
					color : to
				});
				
				$( '.pm-members-area-title' ).css({
					color : to
				});
				
				$( '.pm-members-form-font' ).css({
					color : to
				});
				
				$( '.pm-members-form-amenities label' ).css({
					color : to
				});
				
				$( '.pm-members-form-agent-info label' ).css({
					color : to
				});
				
				$( '.pm-single-post-tags p a' ).css({
					color : to
				});
				
				$( '.pm-single-post-like-feature a' ).css({
					color : to
				});
				
				$( '.pm-single-post-share-icons-divider-endpoint' ).css({
					backgroundColor : to
				});
				
				$( '.pm-fancy.secondary .pm-fancy-title-endpoint' ).css({
					backgroundColor : to
				});
				
				$( '.pm-fancy.secondary span' ).css({
					color : to
				});
				
				
			}			
		});		
	});	
					
					
					
					
	wp.customize( 'menuBorderColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-form-textfield.security-field' ).css({
					border : "1px solid" + to
				});	
				
				$( '.form-group.security-question' ).css({
					borderBottom : "1px solid" + to
				});	
				
				$( '.pm-mobile-global-menu' ).css({
					borderLeft : "1px solid" + to
				});	
				
				$( '.pm-search-field-mobile' ).css({
					borderTop : "1px solid" + to
				});	
				
				/*$( '.sf-menu li' ).css({
					borderTop : "1px solid" + to
				});	*/
				
				$( '.sf-menu.pm-desktop-nav .sub-menu li' ).css({
					borderTop : "1px solid" + to
				});		
				
				$( '.sf-menu.pm-desktop-nav li' ).css({
					borderLeft : "1px solid" + to
				});	
				
				$( '.sf-menu.pm-desktop-nav .sub-menu li' ).css({
					borderRight : "1px solid" + to
				});
				
				$( '.pm-desktop-nav-container' ).css({
					borderBottom : "1px solid" + to,
				});
				
				$( '.pm-mobile-global-registration-fields' ).css({
					borderTop : "1px solid" + to,
				});
				
				$( '.pm-register-message' ).css({
					borderTop : "1px solid" + to,
				});
				
				$( '.pm-mobile-global-sign-in-fields' ).css({
					borderTop : "1px solid" + to,
				});	
				
				$( '.pm-desktop-social-icons-list li' ).css({
					borderRight : "1px solid" + to,
				});	
				
			}			
		});		
	});	
	
	wp.customize( 'subpageHeaderBackgroundColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-sub-header-container' ).css({
					backgroundColor : to
				});	
				
			}			
		});		
	});	
	
	wp.customize( 'fatFooterBackgroundColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-fat-footer' ).css({
					backgroundColor : to
				});	
				
			}			
		});		
	});
	
	wp.customize( 'boxedModeContainerColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-boxed-mode' ).css({
					backgroundColor : to
				});	
				
			}			
		});		
	});	
	
	
	wp.customize( 'dividerColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-nav-tabs' ).css({
					borderBottom : "1px solid" + to
				});	
				
				$( '.pm-sidebar-title-divider' ).css({
					borderTop : "1px solid" + to
				});
				
				$( '.pm-sidebar .widget_meta ul li' ).css({
					borderBottom : "1px solid" + to
				});	
				
				$( '.pm-widget-footer .widget_categories ul li' ).css({
					borderBottom : "1px solid" + to
				});	
				
				$( '.pm-sidebar .widget_categories ul li' ).css({
					borderBottom : "1px solid" + to
				});	
				
				$( '.pm-sidebar .widget_archive ul li' ).css({
					borderBottom : "1px solid" + to
				});	
				
				$( '.pm-sidebar .widget_pages ul li' ).css({
					borderBottom : "1px solid" + to
				});	
				
				$( '.widget_recent_entries .pm-widget-spacer ul li' ).css({
					borderBottom : "1px solid" + to
				});
				
				$( '.pm-page-share-options' ).css({
					borderTop : "1px solid" + to
				});	
				
				$( '.pm-members-area-divider' ).css({
					backgroundColor : to
				});	
				
				$( '.pm-textfield.members' ).css({
					border : "1px solid" + to
				});	
				
				$( '.pm-members-form-submission-divider' ).css({
					backgroundColor : to
				});
				
				$( '.pm-members-form-submission-divider' ).css({
					backgroundColor : to
				});
				
				$( '.pm-form-textfield' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm-form-textarea' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm-single-post-share-icons-divider' ).css({
					backgroundColor : to
				});
				
			}			
		});		
	});	
	
	wp.customize( 'authorCommentsBoxColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				
				$( '#pm-author-column' ).css({
					backgroundColor : to
				});
				
				$( '#pm-comments-column' ).css({
					backgroundColor : to
				});
				
			}			
		});		
	});	
	
	wp.customize( 'featuredPropertyRibbon', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				
				$( '.pm-featured-label-content' ).css({
					backgroundColor : to
				});
				
				$( '.pm-featured-label-left' ).css({
					borderBottomColor : to
				});
				
				$( '.pm-featured-label-right' ).css({
					borderLeftColor : to
				});
				
			}			
		});		
	});	
	
	wp.customize( 'accordionContentBgColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				
				$( '.panel-collapse' ).css({
					backgroundColor : to
				});
				
			}			
		});		
	});	
		
		
	wp.customize( 'tabContentBgColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				
				$( '.pm-tab-content' ).css({
					backgroundColor : to
				});
				
			}			
		});		
	});	
	
	wp.customize( 'data_table_title_color', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				
				$( '.pm-workshop-table-title' ).css({
					backgroundColor : to
				});
				
			}			
		});		
	});				
			
	wp.customize( 'data_table_info_color', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				
				$( '.pm-workshop-table-content' ).css({
					backgroundColor : to
				});
				
			}			
		});		
	});	
	
	wp.customize( 'testimonials_carousel_color', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				
				$( '.pm-testimonials-arrows a' ).css({
					color : to
				});
				
				$( '.pm-testimonial-img' ).css({
					border : "5px solid" + to
				});
				
			}			
		});		
	});	
	
	wp.customize( 'timetable_font_color', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				
				$( '.pm-timetable-panel-content-body ul li' ).css({
					color : to
				});
				
				$( '.pm-timetable-panel-title a' ).css({
					color : to
				});
				
				$( '.pm-timetable-accordion-panel .pm-timetable-panel-heading a.pm-accordion-horizontal-open' ).css({
					color : to
				});
				
			}			
		});		
	});	
	
	wp.customize( 'timetable_border_color', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				
				$( '.pm-timetable-panel-content-body ul li' ).css({
					borderBottom : "1px solid" + to
				});
				
				
			}			
		});		
	});	
	
	wp.customize( 'alert_success_color', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				
				$( '.alert-success' ).css({
					backgroundColor : to
				});
				
				
			}			
		});		
	});	
	
	wp.customize( 'alert_warning_color', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				
				$( '.alert-warning' ).css({
					backgroundColor : to
				});
				
				
			}			
		});		
	});	
	
	
	wp.customize( 'alert_danger_color', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				
				$( '.alert-danger' ).css({
					backgroundColor : to
				});
				
				
			}			
		});		
	});	
	
	
	wp.customize( 'alert_info_color', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				
				$( '.alert-info' ).css({
					backgroundColor : to
				});
				
				
			}			
		});		
	});	
	
	
	wp.customize( 'alert_notice_color', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				
				$( '.alert-notice' ).css({
					backgroundColor : to
				});
				
				
			}			
		});		
	});	
	
			
	
	
	//Footer options		

	//Footer slider options		
	wp.customize( 'fatFooterPadding', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-fat-footer' ).css({
					paddingTop : to + 'px',
					paddingBottom : to  + 'px'
					//opacity : to / 100
				});				
			}			
		});		
	});	

	// Page layouts.
	/*wp.customize( 'page_layout', function( value ) {
		value.bind( function( to ) {
			if ( 'one-column' === to ) {
				$( 'body' ).addClass( 'page-one-column' ).removeClass( 'page-two-column' );
			} else {
				$( 'body' ).removeClass( 'page-one-column' ).addClass( 'page-two-column' );
			}
		} );
	} );*/
	
	//convertHex('#A7D136',50)
	function convertHex(hex,opacity){
		hex = hex.replace('#','');
		r = parseInt(hex.substring(0,2), 16);
		g = parseInt(hex.substring(2,4), 16);
		b = parseInt(hex.substring(4,6), 16);
	
		result = 'rgba('+r+','+g+','+b+','+opacity/100+')';
		return result;
	}

	// Whether a header image is available.
	function hasHeaderImage() {
		var image = wp.customize( 'header_image' )();
		return '' !== image && 'remove-header' !== image;
	}

	// Whether a header video is available.
	function hasHeaderVideo() {
		var externalVideo = wp.customize( 'external_header_video' )(),
			video = wp.customize( 'header_video' )();

		return '' !== externalVideo || ( 0 !== video && '' !== video );
	}

	// Toggle a body class if a custom header exists.
	/*$.each( [ 'external_header_video', 'header_image', 'header_video' ], function( index, settingId ) {
		wp.customize( settingId, function( setting ) {
			setting.bind(function() {
				if ( hasHeaderImage() ) {
					$( document.body ).addClass( 'has-header-image' );
				} else {
					$( document.body ).removeClass( 'has-header-image' );
				}

				if ( ! hasHeaderVideo() ) {
					$( document.body ).removeClass( 'has-header-video' );
				}
			} );
		} );
	} );*/

} )( jQuery );