(function() {  

	
	//////////////////// RECENT PROPERTIES
    tinymce.create('tinymce.plugins.recentProperties', {  

        init : function(ed, url) {  

            ed.addButton('recentProperties', {  

                title : 'Recent Properties',  

                image : url+'/buttons/recent-properties.gif',  

                onclick : function() {  

                     ed.selection.setContent('[recentProperties num_of_posts="3" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('recentProperties', tinymce.plugins.recentProperties);


	//////////////////// COUNTDOWN
    tinymce.create('tinymce.plugins.countdown', {  

        init : function(ed, url) {  

            ed.addButton('countdown', {  

                title : 'Countdown',  

                image : url+'/buttons/countdown.gif',  

                onclick : function() {  

                     ed.selection.setContent('[countdown id="1" date="2016/08/25" text_color="#000000" text_size="24" text_align="center" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('countdown', tinymce.plugins.countdown); 
	

	////////////////////// INFO LIST
	tinymce.create('tinymce.plugins.infoList', {  

        init : function(ed, url) {  

            ed.addButton('infoList', {  

                title : 'Info List',  

                image : url+'/buttons/featuredProperties.gif',  

                onclick : function() {  

                     ed.selection.setContent('[infoList][infoListItem title="" icon="" class="" animation_delay="0.3" /][/infoList]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('infoList', tinymce.plugins.infoList);
	
	////////////////////// PROCESS LIST
	tinymce.create('tinymce.plugins.processList', {  

        init : function(ed, url) {  

            ed.addButton('processList', {  

                title : 'Process List',  

                image : url+'/buttons/processList.gif',  

                onclick : function() {  

                     ed.selection.setContent('[processList][processListItem title="" icon="" class="" animation_delay="0.3" /][/processList]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('processList', tinymce.plugins.processList);
	

	////////////////////// FEATURED PROPERTIES
	tinymce.create('tinymce.plugins.propertiesGallery', {  

        init : function(ed, url) {  

            ed.addButton('propertiesGallery', {  

                title : 'Properties Gallery',  

                image : url+'/buttons/featuredProperties.gif',  

                onclick : function() {  

                     ed.selection.setContent('[propertiesGallery post_order="DESC" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('propertiesGallery', tinymce.plugins.propertiesGallery); 


	////////////////////// PROPERTY SEARCH
	tinymce.create('tinymce.plugins.propertySearch', {  

        init : function(ed, url) {  

            ed.addButton('propertySearch', {  

                title : 'Property Seach',  

                image : url+'/buttons/lightbox.gif',  

                onclick : function() {  

                     ed.selection.setContent('[propertySearch results_page="property-search" title="FIND YOUR DREAM HOME TODAY" message="Instantly find your desired home with your expected location, price and other criteria just by starting your search now" text_color="#ffffff" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('propertySearch', tinymce.plugins.propertySearch); 

	////////////////////// BOX BUTTON
	tinymce.create('tinymce.plugins.iconBox', {  

        init : function(ed, url) {  

            ed.addButton('iconBox', {  

                title : 'Icon Box',  

                image : url+'/buttons/button2.gif',  

                onclick : function() {  

                     ed.selection.setContent('[iconBox margin_top="0" margin_bottom="0" icon="typcn typcn-map" color="#7d7d7d" border_radius="0" center="off" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('iconBox', tinymce.plugins.iconBox); 
	

	//////////////////// AGENT PROFILE
    tinymce.create('tinymce.plugins.agentProfile', {  

        init : function(ed, url) {  

            ed.addButton('agentProfile', {  

                title : 'Agent Profile',  

                image : url+'/buttons/staffProfile.gif',  

                onclick : function() {  

                     ed.selection.setContent('[agentProfile id="" class="wow flipInY" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('agentProfile', tinymce.plugins.agentProfile);


	//////////////////// PRICING TABLE
    tinymce.create('tinymce.plugins.pricingTable', {  

        init : function(ed, url) {  

            ed.addButton('pricingTable', {  

                title : 'Pricing Table',  

                image : url+'/buttons/pricingTable.gif',  

                onclick : function() {  

                     ed.selection.setContent('[pricingTable title="Silver" featured="yes" price="19" currency_symbol="$" subscript="/mo" message="" button_text="Purchase Plan" button_link="#" bg_image="" header_color="#0db7c4" button_color="#0db7c4" text_color="#cccccc"]' + ed.selection.getContent() + '[/pricingTable]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('pricingTable', tinymce.plugins.pricingTable);


	//////////////////// DATA TABLE GROUP
    tinymce.create('tinymce.plugins.dataTableGroup', {  

        init : function(ed, url) {  

            ed.addButton('dataTableGroup', {  

                title : 'Data Table',  

                image : url+'/buttons/dataTable.gif',  

                onclick : function() {  

                     ed.selection.setContent('[dataTableGroup id="1"]<br />[dataTableItem title="Column Title"]' + ed.selection.getContent() + '[/dataTableItem]<br />[/dataTableGroup]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('dataTableGroup', tinymce.plugins.dataTableGroup);
	
	
	//////////////////// NEWSLETTER SIGNUP
    tinymce.create('tinymce.plugins.newsletterSignup', {  

        init : function(ed, url) {  

            ed.addButton('newsletterSignup', {  

                title : 'Newsletter form',  

                image : url+'/buttons/newsletterSignup.gif',  

                onclick : function() {  

                     ed.selection.setContent('[newsletterSignup mailchimp_url="" name_placeholder="Your Name" email_placeholder="Email Address" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('newsletterSignup', tinymce.plugins.newsletterSignup); 
	 

	//////////////////// QUOTE BOX
    tinymce.create('tinymce.plugins.quoteBox', {  

        init : function(ed, url) {  

            ed.addButton('quoteBox', {  

                title : 'Quote Box',  

                image : url+'/buttons/quoteBox.gif',  

                onclick : function() {  

                     ed.selection.setContent('[quoteBox author_name="Jane Tolman" author_title="Visual Designer, Academix Systems" avatar="" text_color="#ffffff" name_color="#9c8d00"]' + ed.selection.getContent() + '[/quoteBox]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('quoteBox', tinymce.plugins.quoteBox);  

	
	//////////////////// PIE CHART
    tinymce.create('tinymce.plugins.piechart', {  

        init : function(ed, url) {  

            ed.addButton('piechart', {  

                title : 'Pie Chart',  

                image : url+'/buttons/counter.gif',  

                onclick : function() {  

                     ed.selection.setContent('[piechart bar_size="220" line_width="12" track_color="#464646" bar_color="#FFE1A0" text_color="#ffffff" percentage="75" caption="" font_size="40" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('piechart', tinymce.plugins.piechart);  
	
	
	//////////////////// MILESTONE
    tinymce.create('tinymce.plugins.milestone', {  

        init : function(ed, url) {  

            ed.addButton('milestone', {  

                title : 'Milestone',  

                image : url+'/buttons/milestone.gif',  

                onclick : function() {  

                     ed.selection.setContent('[milestone speed="2000" stop="75" caption="" icon="typcn typcn-cog" icon_color="#ffffff" bg_color="#FFE1A0" border_color="#7F6631" text_color="#7F6631" text_size="16" padding="10" font_size="90" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('milestone', tinymce.plugins.milestone);  
	
	
	//////////////////// COUNTDOWN
    tinymce.create('tinymce.plugins.countdown', {  

        init : function(ed, url) {  

            ed.addButton('countdown', {  

                title : 'Countdown',  

                image : url+'/buttons/countdown.gif',  

                onclick : function() {  

                     ed.selection.setContent('[countdown id="1" date="2015/11/25" text_size="30" text_color="#333333" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('countdown', tinymce.plugins.countdown);  		
	

	//////////////////// COLUMN CONTAINER
    tinymce.create('tinymce.plugins.bootstrapContainer', {  

        init : function(ed, url) {  

            ed.addButton('bootstrapContainer', {  

                title : 'Bootstrap Container',  

                image : url+'/buttons/cc.gif',  

                onclick : function() {  

                     ed.selection.setContent('[bootstrapContainer fullscreen="off" fullscreen_container="on" bg_color="transparent" bg_image="" bg_position="static" bg_repeat="repeat-x" alignment="left" padding_top="60" padding_bottom="60"  parallax="off" class="" id=""]' + ed.selection.getContent() + '[/bootstrapContainer]');  


                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('bootstrapContainer', tinymce.plugins.bootstrapContainer);  	
	
	
	//////////////////// CONTAINER
	tinymce.create('tinymce.plugins.bootstrapRow', {  

        init : function(ed, url) {  

            ed.addButton('bootstrapRow', {  

                title : 'Bootstrap Row',  

                image : url+'/buttons/container.gif',  

                onclick : function() {  

                     ed.selection.setContent('[bootstrapRow class=""]' + ed.selection.getContent() + '[/bootstrapRow]');

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;

        },  

    });  

    tinymce.PluginManager.add('bootstrapRow', tinymce.plugins.bootstrapRow); 
	 
	
	//////////////////// COLUMN
    tinymce.create('tinymce.plugins.bootstrapColumn', {  

        init : function(ed, url) {  

            ed.addButton('bootstrapColumn', {  

                title : 'Bootstrap Column',  

                image : url+'/buttons/column.gif',  

                onclick : function() {  

                     ed.selection.setContent('[bootstrapColumn col_large="12" col_medium="12" col_small="12" col_extrasmall="12" class="" animation_delay="0.3"]' + ed.selection.getContent() + '[/bootstrapColumn]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('bootstrapColumn', tinymce.plugins.bootstrapColumn); 

	
	////////////////////// CLIENT CAROUSEL
	
	tinymce.create('tinymce.plugins.clientCarousel', {  

        init : function(ed, url) {  

            ed.addButton('clientCarousel', {  

                title : 'Client Carousel',  

                image : url+'/buttons/clientCarousel.gif',  

                onclick : function() {  

                     ed.selection.setContent('[clientCarousel target="_blank" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

	tinymce.PluginManager.add('clientCarousel', tinymce.plugins.clientCarousel);
	
	
	////////////////////// PANELS CAROUSEL
	
	tinymce.create('tinymce.plugins.panelsCarousel', {  

        init : function(ed, url) {  

            ed.addButton('panelsCarousel', {  

                title : 'Panels Carousel',  

                image : url+'/buttons/panelsCarousel.gif',  

                onclick : function() {  

                     ed.selection.setContent('[panelsCarousel target="_self" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

	tinymce.PluginManager.add('panelsCarousel', tinymce.plugins.panelsCarousel);
	

    ////////////////////// SLIDER CAROUSEL
	
	tinymce.create('tinymce.plugins.sliderCarousel', {  

        init : function(ed, url) {  

            ed.addButton('sliderCarousel', {  

                title : 'Slider Carousel',  

                image : url+'/buttons/slider.gif',  

                onclick : function() {  

                     ed.selection.setContent('[sliderCarousel animation="slide"]<br />[sliderItem img="" title="" /]<br />[/sliderCarousel]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

	tinymce.PluginManager.add('sliderCarousel', tinymce.plugins.sliderCarousel);
    

	////////////////////// CTA BOX
	
	/*tinymce.create('tinymce.plugins.ctaBox', {  

        init : function(ed, url) {  

            ed.addButton('ctaBox', {  

                title : 'Call To Action Box',  

                image : url+'/buttons/ctaBox.gif',  

                onclick : function() {  

                     ed.selection.setContent('[ctaBox title="" text_color="#ffffff" link="" button_text="Purchase Now" button_text_color="#000000" target="_blank"]' + ed.selection.getContent() + '[/ctaBox]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

	tinymce.PluginManager.add('ctaBox', tinymce.plugins.ctaBox); */


	////////////////////// DIVIDER
	
	tinymce.create('tinymce.plugins.divider', {  

        init : function(ed, url) {  

            ed.addButton('divider', {  

                title : 'Content divider',  

                image : url+'/buttons/divider.gif',  

                onclick : function() {  

                     ed.selection.setContent('[divider margin_top="20" margin_bottom="20" divider_style="title" fancy_title="" color_mode="primary" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

	tinymce.PluginManager.add('divider', tinymce.plugins.divider); 

	////////////////////// ALERT
	
	tinymce.create('tinymce.plugins.alert', {  

        init : function(ed, url) {  

            ed.addButton('alert', {  

                title : 'Alert Box',  

                image : url+'/buttons/alert.png',  

                onclick : function() {  

                     ed.selection.setContent('[alert close="true" type="success" icon=""]' + ed.selection.getContent() + '[/alert]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

	tinymce.PluginManager.add('alert', tinymce.plugins.alert); 

	////////////////////// GOOGLE MAP
	
	tinymce.create('tinymce.plugins.googleMap', {  

        init : function(ed, url) {  

            ed.addButton('googleMap', {  

                title : 'Google Map',  

                image : url+'/buttons/google-map.png',  

                onclick : function() {  

                     ed.selection.setContent('[googleMap id="map1" latitude="43.656885" longitude="-79.383904" full_address="" logo="" height="570" disable_overlay="true" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('googleMap', tinymce.plugins.googleMap); 
	

	////////////////////// PANEL HEADER
	
	tinymce.create('tinymce.plugins.panelHeader', {  

        init : function(ed, url) {  

            ed.addButton('panelHeader', {  

                title : 'Panel Header',  

                image : url+'/buttons/panel-header.gif',  

                onclick : function() {  

                     ed.selection.setContent('[panelHeader panel_style="1" link="" target="_self" color="" show_button="true" button_text="" margin_bottom="10" icon="fa-angle-right" tip="" bg_color="transparent" ]' + ed.selection.getContent() + '[/panelHeader]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('panelHeader', tinymce.plugins.panelHeader); 
	
	////////////////////// COLUMN HEADER
	
	tinymce.create('tinymce.plugins.columnHeader', {  

        init : function(ed, url) {  

            ed.addButton('columnHeader', {  

                title : 'Column Header',  

                image : url+'/buttons/column-header.gif',  

                onclick : function() {  

                     ed.selection.setContent('[columnHeader color="" margin_bottom="0"]' + ed.selection.getContent() + '[/columnHeader]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('columnHeader', tinymce.plugins.columnHeader); 
	

	////////////////////// STANDARD BUTTON
	
	tinymce.create('tinymce.plugins.standardButton', {  

        init : function(ed, url) {  

            ed.addButton('standardButton', {  

                title : 'Standard Button',  

                image : url+'/buttons/button.gif',  

                onclick : function() {  

                     ed.selection.setContent('[standardButton link="#" margin_top="0" margin_bottom="0" target="_self" icon="fa fa-chevron-right" color="#7F6631" style="1" icon_position="40" class=""]' + ed.selection.getContent() + '[/standardButton]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('standardButton', tinymce.plugins.standardButton); 
	
	
	////////////////////// ACTION BUTTON
	
	tinymce.create('tinymce.plugins.actionButton', {  

        init : function(ed, url) {  

            ed.addButton('actionButton', {  

                title : 'Action Button',  

                image : url+'/buttons/actionButton.gif',  

                onclick : function() {  

                     ed.selection.setContent('[actionButton link="#" title="" margin_top="0" margin_bottom="0" target="_self" icon="icon-pointer" position="right" class="wow flipInX" animation_delay="0.3"]' + ed.selection.getContent() + '[/actionButton]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('actionButton', tinymce.plugins.actionButton); 
	
	
	 /////////////////// PROGRESS BAR
	
     tinymce.create('tinymce.plugins.progressBar', {  

        init : function(ed, url) {  

            ed.addButton('progressBar', {  

                title : 'Progress bar',  

                image : url+'/buttons/progress-bar.gif',  

                onclick : function() {  

                     ed.selection.setContent('[progressBar id="1" percentage="75" text="Increased Productivity" text_color="#ffffff"  bg_color="#4a3c1e" percent_color="#000000" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('progressBar', tinymce.plugins.progressBar);  
	
	
	//////////////////// SINGLE POST
	
	
     tinymce.create('tinymce.plugins.singlepost', {  

        init : function(ed, url) {  

            ed.addButton('singlepost', {  

                title : 'Single Post',  

                image : url+'/buttons/single-post.gif',  

                onclick : function() {  

                     ed.selection.setContent('[singlePost id="1" /]');  

  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('singlepost', tinymce.plugins.singlepost); 
		
	
	//////////////////// ICON
    tinymce.create('tinymce.plugins.iconElement', {  

        init : function(ed, url) {  

            ed.addButton('iconElement', {  

                title : 'Icon Element',  

                image : url+'/buttons/icon.gif',  

                onclick : function() {  

                     ed.selection.setContent('[iconElement link="" target="_blank" icon="fa fa-twitter" icon_color="#ffffff" /]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('iconElement', tinymce.plugins.iconElement);
	
	
	//////////////////// YOUTUBE
    tinymce.create('tinymce.plugins.youtubeVideo', {  

        init : function(ed, url) {  

            ed.addButton('youtubeVideo', {  

                title : 'Youtube Video',  

                image : url+'/buttons/youtube.png',  

                onclick : function() {  

                     ed.selection.setContent('[youtubeVideo id="0" height="250" /]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('youtubeVideo', tinymce.plugins.youtubeVideo);
	
	
	
	//////////////////// VIMEO
    tinymce.create('tinymce.plugins.vimeoVideo', {  

        init : function(ed, url) {  

            ed.addButton('vimeoVideo', {  

                title : 'Vimeo Video',  

                image : url+'/buttons/vimeo.png',  

                onclick : function() {  

                     ed.selection.setContent('[vimeoVideo id="0" height="250" /]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('vimeoVideo', tinymce.plugins.vimeoVideo);
	
	
	//////////////////// HTML5 VIDEO


    tinymce.create('tinymce.plugins.html5Video', {  

        init : function(ed, url) {  

            ed.addButton('html5Video', {  

                title : 'HTML5 Video',  

                image : url+'/buttons/html5-video.png',  

                onclick : function() {  

                     ed.selection.setContent('[html5Video webm="" mp4="" ogg=""][/html5Video]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('html5Video', tinymce.plugins.html5Video);
	
	
	//////////////////// TAB GROUP
    tinymce.create('tinymce.plugins.timeTableGroup', {  

        init : function(ed, url) {  

            ed.addButton('timeTableGroup', {  

                title : 'Time Table Group',  

                image : url+'/buttons/time-table-group.gif',  

                onclick : function() {  

                     ed.selection.setContent('[timeTableGroup id="1"]<br />[timeTableItem title="Sample Title" icon="fa fa-clock-o" bg_color="#3dc5d0"]' + ed.selection.getContent() + '[/timeTableItem]<br />[/timeTableGroup]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('timeTableGroup', tinymce.plugins.timeTableGroup);
	
	
	//////////////////// TAB GROUP
    tinymce.create('tinymce.plugins.tabGroup', {  

        init : function(ed, url) {  

            ed.addButton('tabGroup', {  

                title : 'Tab Group',  

                image : url+'/buttons/tab-group.gif',  

                onclick : function() {  

                     ed.selection.setContent('[tabGroup id="1"]<br />[tabItem title="Tab"]' + ed.selection.getContent() + '[/tabItem]<br />[/tabGroup]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('tabGroup', tinymce.plugins.tabGroup);
	
	
	//////////////////// ACCORDION GROUP


    tinymce.create('tinymce.plugins.accordionGroup', {  

        init : function(ed, url) {  

            ed.addButton('accordionGroup', {  

                title : 'Accordion Group',  

                image : url+'/buttons/accordion.gif',  

                onclick : function() {  

                     ed.selection.setContent('[accordionGroup id="1"]<br />[accordionItem title="Accordion Item 1" button_color="#ffe1a0" button_text_color="#000000"]' + ed.selection.getContent() + '[/accordionItem]<br />[/accordionGroup]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('accordionGroup', tinymce.plugins.accordionGroup);
	
	
	//////////////////// FEATURED GALLERY
	
    /*tinymce.create('tinymce.plugins.featuredGallery', {  

        init : function(ed, url) {  

            ed.addButton('featuredGallery', {  

                title : 'Featured Gallery',  

                image : url+'/buttons/posts.gif',  

                onclick : function() {  

                     ed.selection.setContent('[featuredGallery items="4" order_by="DESC" padding_top="20" padding_bottom="20" /]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('featuredGallery', tinymce.plugins.featuredGallery);*/
	
	
	//////////////////// TESTIMONIALS


    tinymce.create('tinymce.plugins.testimonials', {  

        init : function(ed, url) {  

            ed.addButton('testimonials', {  

                title : 'Testimonials',  

                image : url+'/buttons/testimonials.gif',  

                onclick : function() {  

                     ed.selection.setContent('[testimonials /]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('testimonials', tinymce.plugins.testimonials);
	
	
	//////////////////// CONTACT FORM


    tinymce.create('tinymce.plugins.contactForm', {  

        init : function(ed, url) {  

            ed.addButton('contactForm', {  

                title : 'Contact Form',  

                image : url+'/buttons/contact-form.gif',  

                onclick : function() {  

                     ed.selection.setContent('[contactForm recipient_email="name@yourdomain.com" text_color="#fff" response_color="#7F6631" message="Fields marked with * are required" disable_captcha="false" /]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('contactForm', tinymce.plugins.contactForm);
	
	
	//////////////////// IMAGE PANEL
    tinymce.create('tinymce.plugins.imagePanel', {  

        init : function(ed, url) {  

            ed.addButton('imagePanel', {  

                title : 'Image Panel',  

                image : url+'/buttons/image-panel.gif',  

                onclick : function() {  

                     ed.selection.setContent('[imagePanel icon="fa fa-link" link="#" image="" /]');   

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('imagePanel', tinymce.plugins.imagePanel);
	
		
	////////////////////// VIDEO BOX
	tinymce.create('tinymce.plugins.videoBox', {  

        init : function(ed, url) {  

            ed.addButton('videoBox', {  

                title : 'Video Box',  

                image : url+'/buttons/videoBox.gif',  

                onclick : function() {  

                     ed.selection.setContent('[videoBox icon="fa fa-play" video_link="" video_image="" link="on" link_text="View our properties" link_url="" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

	tinymce.PluginManager.add('videoBox', tinymce.plugins.videoBox);
	
	//////////////////// POST ITEMS
    tinymce.create('tinymce.plugins.postItems', {  

        init : function(ed, url) {  

            ed.addButton('postItems', {  

                title : 'Post Items',  

                image : url+'/buttons/post-items.gif',  

                onclick : function() {  

                     ed.selection.setContent('[postItems num_of_posts="3" post_order="DESC" category="" tag="" class="" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('postItems', tinymce.plugins.postItems);
	
	
	
	//////////////////// SINGLE TESTIMONIAL
    tinymce.create('tinymce.plugins.testimonialProfile', {  

        init : function(ed, url) {  

            ed.addButton('testimonialProfile', {  

                title : 'Testimonial Profile',

                image : url+'/buttons/single-testimonial.gif',

                onclick : function() {  

                     ed.selection.setContent('[testimonialProfile name="" title="" date="" image="" icon_image=""]' + ed.selection.getContent() + '[/testimonialProfile]');  

                }

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('testimonialProfile', tinymce.plugins.testimonialProfile);

    
})();  