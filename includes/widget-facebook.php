<?php 

add_action('widgets_init','fb_likebox_widget');

function fb_likebox_widget() {
	register_widget('fb_likebox_widget');
	
	}

class fb_likebox_widget extends WP_Widget {
	function fb_likebox_widget() {
			
		$widget_ops = array('classname' => 'Like-box','description' => esc_html__('Facebook Like Box','luxortheme'));

		parent::__construct('Like-box',esc_html__('[Micro Themes] - Facebook Likebox','luxortheme'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		//$fa_icon = '<i class="'. (empty( $instance['fa_icon'] ) ? 'fa fa-facebook' : $instance['fa_icon']) .' pm-sidebar-icon"></i> ';
		$minimize_header = $instance['minimize_header'];
		$show_faces = $instance['show_faces'];
		$show_cover = $instance['show_cover'];
		$show_stream = $instance['show_stream'];
		$height = $instance['height'];
		$page = $instance['page'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
			
?>
        <div class="like_box_footer">
        
        	<div class="fb-page" data-href="<?php echo esc_attr($page); ?>" data-tabs="<?php echo $show_stream == 1 ? 'timeline' : '' ?>" data-small-header="<?php echo $minimize_header == 1 ? 'true' : 'false' ?>" data-adapt-container-width="true" data-hide-cover="<?php echo $show_cover == 1 ? 'false' : 'true' ?>" data-height="<?php echo esc_attr($height); ?>" data-show-facepile="<?php echo esc_attr($show_faces) == 1 ? 'true' : 'false' ?>"></div>
        
		</div><!--like_box_footer-->
        
        <div id="fb-root"></div>
        
		<script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9&appId=730937867073016";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
			
<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		//$instance['fa_icon'] = strip_tags( $new_instance['fa_icon'] );
		$instance['minimize_header'] = strip_tags($new_instance['minimize_header']);
		$instance['show_faces'] = strip_tags($new_instance['show_faces']);
		$instance['show_cover'] = strip_tags($new_instance['show_cover']);
		$instance['show_stream'] = strip_tags($new_instance['show_stream']);
		$instance['height'] = strip_tags($new_instance['height']);
		$instance['page'] = $new_instance['page'];

		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'title' => esc_html__('Facebook','luxortheme'),
			//'fa_icon' => '',
			'page' => 'https://www.facebook.com/MicroThemes',
			'minimize_header' => 0,
			'show_faces' => 0,
			'show_cover' => 0,
			'show_stream' => 0,
			'height' => 258,
			
 			);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Title:', 'luxortheme') ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>

		<p>  
            <input id="<?php echo esc_attr($this->get_field_id('minimize_header')); ?>" name="<?php echo esc_attr($this->get_field_name('minimize_header')); ?>" type="checkbox" value="1" <?php checked( '1', $instance['minimize_header'] ); ?>/>   
            <label for="<?php echo esc_attr($this->get_field_id( 'minimize_header' )); ?>"><?php esc_html_e('Minimize feader?', 'luxortheme'); ?></label>  
        </p>  
        
        <p>  
            <input id="<?php echo esc_attr($this->get_field_id('show_faces')); ?>" name="<?php echo esc_attr($this->get_field_name('show_faces')); ?>" type="checkbox" value="1" <?php checked( '1', $instance['show_faces'] ); ?>/>   
            <label for="<?php echo esc_attr($this->get_field_id( 'show_faces' )); ?>"><?php esc_html_e('Display faces?', 'luxortheme'); ?></label>  
        </p> 
        
        <p>  
            <input id="<?php echo esc_attr($this->get_field_id('show_cover')); ?>" name="<?php echo esc_attr($this->get_field_name('show_cover')); ?>" type="checkbox" value="1" <?php checked( '1', $instance['show_cover'] ); ?>/>   
            <label for="<?php echo esc_attr($this->get_field_id( 'show_cover' )); ?>"><?php esc_html_e('Display cover?', 'luxortheme'); ?></label>  
        </p> 
        
        <p>  
            <input id="<?php echo esc_attr($this->get_field_id('show_stream')); ?>" name="<?php echo esc_attr($this->get_field_name('show_stream')); ?>" type="checkbox" value="1" <?php checked( '1', $instance['show_stream'] ); ?>/>   
            <label for="<?php echo esc_attr($this->get_field_id( 'show_stream' )); ?>"><?php esc_html_e('Display stream?', 'luxortheme'); ?></label>  
        </p>  

    	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'height' )); ?>"><?php esc_html_e('Height:', 'luxortheme') ?></label>
		<input id="<?php echo esc_attr($this->get_field_id( 'height' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'height' )); ?>" value="<?php echo esc_attr($instance['height']); ?>"  class="widefat" />
		</p>

    	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'page' )); ?>"><?php esc_html_e('Facebook Page URL:', 'luxortheme') ?></label>
		<input id="<?php echo esc_attr($this->get_field_id( 'page' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'page' )); ?>" value="<?php echo esc_attr($instance['page']); ?>"  class="widefat" />
		</p>
        
   <?php 
}
	} //end class