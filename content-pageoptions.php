<?php 

	$displaySocialFeatures = get_theme_mod('displaySocialFeatures', 'on');
	              
?>

<div class="pm-page-social-features">
            
    <div class="pm-single-post-share-icons">
    
        <div class="pm-single-post-share-icons-divider">
            <div class="pm-single-post-share-icons-divider-endpoint left"></div>
            <div class="pm-single-post-share-icons-divider-endpoint right"></div>
        </div>
                        
        
        <p class="pm-share-title"><?php esc_html_e('Share with colleagues', 'luxortheme'); ?></p>
    
        <ul class="pm-single-post-social-icons" <?php echo esc_attr($displaySocialFeatures) === 'off' ? 'style="visibility:hidden";' : '' ?>>
        
            <li> 
                <a href="https://twitter.com/share?url=<?php echo urlencode(get_the_permalink()); ?>&amp;text=<?php echo urlencode(get_the_title()); ?>" class="fa fa-twitter" target="_blank"></a>
            </li>
            
            <li>
                <a href="http://www.facebook.com/share.php?u=<?php echo urlencode(get_the_permalink()); ?>" class="fa fa-facebook" target="_blank"></a>
            </li>
        
            <li> 
                <a href="https://plus.google.com/share?url=<?php echo urlencode(get_the_permalink()); ?>" class="fa fa-google-plus" target="_blank"></a>
            </li>
            
            <li> 
                <a href="#" id="pm-print-btn" class="fa fa-print" target="_blank"></a>
            </li>
        
        </ul>
        
        
    </div>

</div>
<!-- Post info and tags end -->

