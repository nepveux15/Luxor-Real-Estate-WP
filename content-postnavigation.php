<?php if(is_single()) : ?>

	<ul class="pm-post-navigation">
    
		<?php 
            $prev_post = get_adjacent_post(false, '', true);						
        ?>
        
        <?php if(!empty($prev_post)) : ?>
                        
            <?php $title = pm_ln_string_limit_words($prev_post->post_title, 4); ?>
        
            <li>
                <a href="<?php echo get_permalink($prev_post->ID) ?>" class="pm-post-nav-btn"><i class="fa fa-angle-left"></i>&nbsp; <?php echo esc_attr($title); ?>...</a>
            </li>
        
        <?php endif; ?>
        
        
        <?php 
            $next_post = get_adjacent_post(false, '', false);
        ?>
        
        <?php if(!empty($next_post)) : ?>
                        
            <?php $next_title = pm_ln_string_limit_words($next_post->post_title, 4); ?>
        
            <li>
                <a href="<?php echo get_permalink($next_post->ID) ?>" class="pm-post-nav-btn"><?php echo esc_attr($next_title); ?>... &nbsp;<i class="fa fa-angle-right"></i> </a>
            </li>
        
        <?php endif; ?>
    
    </ul>

<?php endif; ?>