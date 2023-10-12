<?php 

	$order = 'DESC';
	
	if( isset( $_GET['order'] ) ) {
		$order = $_GET['order'];
	}

?>

<!-- Agencies Filter -->
<ul class="pm-property-filter-options-list agencies" id="pm-property-filter-options-list-agencies">
    <li>
        <div class="pm-dropdown pm-agencies-filter-options">
            <div class="pm-dropmenu">
            
            	
            
                <p class="pm-menu-title"><?php esc_html_e('Order By:', 'luxortheme'); ?> <?php echo esc_attr($order) === 'ASC' ? esc_html__('Ascending', 'luxortheme') : esc_html__('Descending', 'luxortheme') ; ?></p>
                <i class="fa fa-angle-down"></i>
            </div>
            <div class="pm-dropmenu-active pm-agencies-filter-options-list">
                <ul>
                   <li <?php echo esc_attr($order) === 'ASC' ? 'class="active"' : '' ?>><a href="#" data-option="ASC"><?php esc_html_e('Ascending Order', 'luxortheme'); ?></a></li>
                   <li <?php echo esc_attr($order) === 'DESC' ? 'class="active"' : '' ?>><a href="#" data-option="DESC"><?php esc_html_e('Descending Order', 'luxortheme'); ?></a></li>
                </ul>
            </div>
        </div>
    </li>
    <li><?php esc_html_e('Visual layout','luxortheme'); ?> <a href="#" class="fa fa-list-ul pm-agencies-visual-layout-btn active" id="pm-list-mode"></a> <a href="#" class="fa fa-th-large pm-agencies-visual-layout-btn" id="pm-grid-mode"></a></li>
</ul>
<!-- Agencies Filter end -->

