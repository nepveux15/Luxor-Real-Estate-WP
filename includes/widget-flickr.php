<?php 

add_action('widgets_init','pulsar_flickr');

function pulsar_flickr() {
	register_widget('pulsar_flickr');
	
	}

class pulsar_flickr extends WP_Widget {
	function pulsar_flickr() {
			
		$widget_ops = array('classname' => 'flickr','description' => esc_html__('Flickr Widget - displays Flickr photos','luxortheme'));
		parent::__construct('flickr-photo',esc_html__('[Micro Themes] - Flickr','luxortheme'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		//$fa_icon = '<i class="'. (empty( $instance['fa_icon'] ) ? 'fa fa-flickr' : $instance['fa_icon']) .' pm-sidebar-icon"></i> ';
		$flickrID = $instance['flickrID'];
		$count = $instance['count'];
		$type = $instance['type'];
		$display = $instance['display'];


		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
		?>
		<div class="flickr_badge_wrapper clearfix">
	
			<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo esc_attr($count); ?>&amp;display=<?php echo esc_attr($display); ?>&amp;size=s&amp;layout=x&amp;source=<?php echo esc_attr($type); ?>&amp;<?php echo esc_attr($type) ?>=<?php echo esc_attr($flickrID); ?>"></script><!-- flickr size params size=s, size=t, size=m -->
		
		</div>
	
			
<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		//$instance['fa_icon'] = strip_tags( $new_instance['fa_icon'] );
		$instance['flickrID'] = strip_tags( $new_instance['flickrID'] );
		$instance['count'] = $new_instance['count'];
		$instance['type'] = $new_instance['type'];
		$instance['display'] = $new_instance['display'];

		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 
			'title' => esc_html__('Flickr','luxortheme'), 
			'flickrID' => '95484010@N06',
			//'fa_icon' => '',
			'count' => '9',
			'type' => 'user',
			'display' => 'latest'
 		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Title:', 'luxortheme') ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
	</p>

	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'flickrID' )); ?>"><?php esc_html_e('Flickr ID:', 'luxortheme') ?> (<a href="http://idgettr.com/">idGettr</a>)</label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'flickrID' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'flickrID' )); ?>" value="<?php echo esc_attr($instance['flickrID']); ?>" />
	</p>
	
	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'count' )); ?>"><?php esc_html_e('Number of Photos:', 'luxortheme') ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'count' )); ?>" value="<?php echo esc_attr($instance['count']); ?>" />
	</p>
	
	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'type' )); ?>"><?php esc_html_e('Type (user or group):', 'luxortheme') ?></label>
		<select id="<?php echo esc_attr($this->get_field_id( 'type' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'type' )); ?>" class="widefat">
			<option <?php if ( 'user' == $instance['type'] ) echo 'selected="selected"'; ?>><?php esc_html_e('user', 'luxortheme') ?></option>
			<option <?php if ( 'group' == $instance['type'] ) echo 'selected="selected"'; ?>><?php esc_html_e('group', 'luxortheme') ?></option>
		</select>
	</p>
	
	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'display' )); ?>"><?php esc_html_e('Display (random or latest):', 'luxortheme') ?></label>
		<select id="<?php echo esc_attr($this->get_field_id( 'display' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'display' )); ?>" class="widefat">
			<option <?php if ( 'random' == $instance['display'] ) echo 'selected="selected"'; ?>><?php esc_html_e('random', 'luxortheme') ?></option>
			<option <?php if ( 'latest' == $instance['display'] ) echo 'selected="selected"'; ?>><?php esc_html_e('latest', 'luxortheme') ?></option>
		</select>
	</p>
        
   <?php 
}
	} //end class