<?php 
	$searchFieldText = get_theme_mod('searchFieldText', 'Search Articles...');
?>

<div class="pm-sidebar-search-container">
    <i class="fa fa-search pm-sidebar-search-icon-btn"></i>
    <form method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    	<input type="text" class="pm-sidebar-search-field" name="s" id="s" placeholder="<?php echo esc_attr($searchFieldText); ?>" />
    </form>
</div>