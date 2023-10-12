<?php 

	$order = 'DESC';
	
	if( isset( $_GET['order'] ) ) {
		$order = $_GET['order'];
	}

?>

<!-- Property Filter -->
<ul class="pm-property-filter-options-list" id="pm-property-filter-options-list">
    <li>
        <div class="pm-dropdown pm-property-filter-options">
            <div class="pm-dropmenu">
            
            	<?php if($order === 'price_ascending') { ?>
                
                	<p class="pm-menu-title"><?php esc_html_e('Price: Highest to Lowest', 'luxortheme'); ?></p>
                    
                <?php } elseif($order === 'price_descending') { ?>
                
                	<p class="pm-menu-title"><?php esc_html_e('Price: Lowest to Highest', 'luxortheme'); ?></p>
                
                <?php } elseif($order === 'recent') { ?>
                	<p class="pm-menu-title"><?php esc_html_e('Recently listed', 'luxortheme'); ?></p>
                
                <?php } elseif($order === 'chronological') { ?>
                
                	<p class="pm-menu-title"><?php esc_html_e('Chronological', 'luxortheme'); ?></p>
                    
                <?php } else { ?>
                
                	<p class="pm-menu-title"><?php esc_html_e('Chronological', 'luxortheme'); ?></p>
                
                <?php } ?>     
                
                <i class="fa fa-angle-down"></i>
            </div>
            <div class="pm-dropmenu-active pm-property-filter-options-list">
                <ul>
                   <li><a href="#" data-option="chronological" data-lang="<?php echo isset($_GET['lang']) ? ''. (string) $_GET['lang'] .'' : '' ?>"><?php esc_html_e('Chronological', 'luxortheme'); ?></a></li>
                   <li><a href="#" data-option="recent" data-lang="<?php echo isset($_GET['lang']) ? ''. (string) $_GET['lang'] .'' : '' ?>"><?php esc_html_e('Recently listed', 'luxortheme'); ?></a></li>
                   <li><a href="#" data-option="price_ascending" data-lang="<?php echo isset($_GET['lang']) ? ''. (string) $_GET['lang'] .'' : '' ?>"><?php esc_html_e('Price: Highest to Lowest', 'luxortheme'); ?></a></li>
                   <li><a href="#" data-option="price_descending" data-lang="<?php echo isset($_GET['lang']) ? ''. (string) $_GET['lang'] .'' : '' ?>"><?php esc_html_e('Price: Lowest to Highest', 'luxortheme'); ?></a></li>
                </ul>
            </div>
        </div>
    </li>
    <li><?php esc_html_e('Visual layout','luxortheme'); ?> <a href="#" class="fa fa-list-ul pm-visual-layout-btn active" id="pm-list-mode"></a> <a href="#" class="fa fa-th-large pm-visual-layout-btn" id="pm-grid-mode"></a></li>
</ul>
<!-- Property Filter end -->

