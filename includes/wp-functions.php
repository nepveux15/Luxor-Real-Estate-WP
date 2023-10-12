<?php 


if( !function_exists('pm_ln_is_plugin_active') ){
	
	function pm_ln_is_plugin_active($plugin) {

		include_once (ABSPATH . 'wp-admin/includes/plugin.php');
	
		return is_plugin_active($plugin);
	
	}
	
}

if( !function_exists('pm_ln_has_shortcode') ){
	
	function pm_ln_has_shortcode($shortcode = '') {
     
		$post_to_check = get_post(get_the_ID());
		 
		// false because we have to search through the post content first
		$found = false;
		 
		// if no short code was provided, return false
		if (!$shortcode) {
			return $found;
		}
		// check the post content for the short code
		if ( stripos($post_to_check->post_content, '[' . $shortcode) !== false ) {
			// we have found the short code
			$found = true;
		}
		 
		// return our final results
		return $found;
	}
	
}

if( !function_exists('pm_ln_get_avatar_url') ){
	
	//Extract avatar URL
	function pm_ln_get_avatar_url($get_avatar){
		preg_match("/src='(.*?)'/i", $get_avatar, $matches);
		return $matches[1];
	}
	
}




if( !function_exists('pm_ln_validate_email') ){
	
	function pm_ln_validate_email($email){
			
		return filter_var($email, FILTER_VALIDATE_EMAIL);
		
	}//end of validate_email()
	
}




if( !function_exists('pm_ln_icl_post_languages') ){
	
	//WPML custom language selector
	function pm_ln_icl_post_languages(){
		
	  if( function_exists('icl_get_languages') ){
		  
		  $languages = icl_get_languages('skip_missing=1');
	  
		  if(1 < count($languages)){
					  
				echo '<div class="pm-dropdown pm-language-selector-menu">';
					echo '<div class="pm-dropmenu">';
						echo '<p class="pm-menu-title">'.esc_html__('Language','luxortheme').'</p>';
						echo '<i class="fa fa-angle-down"></i>';
					echo '</div>';
					echo '<div class="pm-dropmenu-active">';
						echo '<ul>';
						   foreach($languages as $l){
							if(!$l['active']) echo '<li><img src="'.$l['country_flag_url'].'" alt="'.$l['translated_name'].'" /><a href="'.$l['url'].'">'.$l['translated_name'].'</a></li>';
						   }
						echo '</ul>';
					echo '</div>';
				echo '</div>';
			 ;
			
			//echo join(', ', $langs);
			
		  }
		  
	  }//end of check function
	  
	}
	
}




if( !function_exists('pm_ln_set_query') ){
	
	//Custom WordPress functions
	function pm_ln_set_query($custom_query=null) { 
		global $wp_query, $wp_query_old, $post, $orig_post;
		$wp_query_old = $wp_query;
		$wp_query = $custom_query;
		$orig_post = $post;
	}
	
}




if( !function_exists('pm_ln_restore_query') ){
	
	function pm_ln_restore_query() {  
		global $wp_query, $wp_query_old, $post, $orig_post;
		$wp_query = $wp_query_old;
		$post = $orig_post;
		setup_postdata($post);
	}
	
}




if( !function_exists('pm_ln_string_limit_words') ){
	
	//Limit words in paragraphs
	function pm_ln_string_limit_words($string, $word_limit){
	  $words = explode(' ', $string, ($word_limit + 1));
	  if(count($words) > $word_limit)
	  array_pop($words);
	  return implode(' ', $words);
	}
	
}




if( !function_exists('pm_ln_set_primary_words') ){
	
	//Apply primary color to the first two words in a news post title
	function pm_ln_set_primary_words($title = ''){
		
		$ARR_title = explode(" ", $title);
	
		if(sizeof($ARR_title) > 2 ){
			$ARR_title[0] = "<span>".$ARR_title[0];
			$ARR_title[1] = $ARR_title[1]."</span>";
			return implode(" ", $ARR_title);
		} else {
			return $title;
		}
	  
	}
	
}




if( !function_exists('pm_ln_get_posts_count_by_tag') ){
	
	//Count all posts related to current tag
	function pm_ln_get_posts_count_by_tag($tag_name){
		$tags = get_tags(array ('search' => $tag_name) );
		foreach ($tags as $tag) {
		  //if ($tag->name == $tag_name) {}
		  return $tag->count;
		}
		return 0;
	}
	
}



if( !function_exists('pm_ln_get_posts_count_by_category') ){
	
	//Count all posts related to current category
	function pm_ln_get_posts_count_by_category($category_name){
		$categories = get_categories(array ('search' => $category_name) );
		foreach ($categories as $category) {
			//if ($category->name == $category_name) {}
			return $category->count;
		}
		return 0;
	}
	
}




if( !function_exists('pm_ln_hex2rgb') ){
	
	//Convert HEX to RGB
	function pm_ln_hex2rgb($hex) {
	   $hex = str_replace("#", "", $hex);
	
	   if(strlen($hex) == 3) {
		  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
		  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
		  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
		  $r = hexdec(substr($hex,0,2));
		  $g = hexdec(substr($hex,2,2));
		  $b = hexdec(substr($hex,4,2));
	   }
	   $rgb = array($r, $g, $b);
	   //return implode(",", $rgb); // returns the rgb values separated by commas
	   return $rgb; // returns an array with the rgb values
	}
	
}




if( !function_exists('pm_ln_parse_yturl') ){
	
	//YOUTUBE Thumbnail Extract
	function pm_ln_parse_yturl($url) {
		$pattern = '#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x';
		preg_match($pattern, $url, $matches);
		return (isset($matches[1])) ? $matches[1] : false;
	}
	
}




if( !function_exists('pm_ln_breadcrumbs') ){
	
	//Breadcrumb
	function pm_ln_breadcrumbs() {
		
		global $post;
		
		echo '<ul class="pm-breadcrumbs">';	
		
		if (!is_home()) {
			echo '<li><a href="'.home_url('/').'"> '. esc_attr__('Home', 'luxortheme') .'</a></li>';
			
			if (is_single() && get_post_type() == 'staff_member' ) { //Wordpress doesnt support custom post types for breadcrumbs
			
				echo '<li>';
				the_title();
				echo '</li>';
			
			} else if (is_single()) {
				
				echo '<li>';
				the_title();
				echo '</li>';
				
			} else if (is_404()) {
				
				echo '<li> '.esc_html__('404 Error', 'luxortheme').'</li>';
			
			} else if (is_category()) {	
			
				echo '<li>';
				
				//the_category('</li><li class="separator"> / </li><li>', 'single');
				
				$cat = get_category( get_query_var( 'cat' ) ); 
				echo esc_attr($cat->name);
				echo '</li>';
					
			} elseif (is_page()) {
				
				if($post->post_parent){
					$anc = get_post_ancestors( $post->ID );
					$title = get_the_title();
					foreach ( $anc as $ancestor ) {
						$output = '<li><a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a></li> <li><i class="fa fa-angle-right"></i></li>';
					}
					echo $output;
					echo '<li title="'.$title.'"> '.$title.'</li>';
				} else {
					echo '<li> ';
					echo the_title();
					echo '</li>';
				}
			} 
			elseif (is_tag()) {
				echo '<li>'; 
				single_tag_title();
				echo '</li>';
			}
			elseif (is_day()) {
				echo"<li>".esc_html__('Archive for', 'luxortheme')." "; the_time('F jS, Y'); echo'</li>';
			}
			elseif (is_month()) {
				echo"<li>".esc_html__('Archive for', 'luxortheme')." "; the_time('F, Y'); echo'</li>';
			}
			elseif (is_year()) {
				echo"<li>".esc_html__('Archive for', 'luxortheme')." "; the_time('Y'); echo'</li>';
			}
			elseif (is_author()) {
				echo"<li>".esc_html__('Author Profile', 'luxortheme').""; echo'</li>';
			}
			elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {exit;
				echo "<li>".esc_html__('Blog Archives', 'luxortheme').""; echo'</li>';
			}
			elseif (is_search()) {
				//echo"<li>Search Results"; echo'</li>';
			}
		}
		
		echo '</ul>';
		
	}
	
}



if( !function_exists('pm_ln_mytheme_comment') ){
	
	//COMMENTS CONTROL
	function pm_ln_mytheme_comment($comment, $args, $depth) {
		
		$GLOBALS['comment'] = $comment; ?>
		<li <?php comment_class('pm-comment-box-container'); ?> id="li-comment-<?php comment_ID() ?>">
		
		<div class="pm-comment-box-container" id="comment-<?php comment_ID(); ?>">
		
			<div class="comment-author vcard pm-comment-box-avatar-container">
		
				<div class="pm-comment-avatar">
					<?php echo get_avatar($comment,$size='70'); ?>
				</div>
				
				<ul class="pm-comment-author-list">
					<li><p class="pm-comment-name"><?php comment_author(); ?></p></li>
					<li><p class="pm-comment-date">
					<?php printf(__('<cite class="fn">%s</cite>', 'luxortheme'), get_comment_author_link()) ?> <a href="<?php echo htmlspecialchars(get_comment_link( $comment->comment_ID )) ?>"> <?php printf(__('%1$s at %2$s', 'luxortheme'), get_comment_date(),get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)', 'luxortheme'),' ','') ?>
					</p></li>
				</ul>
					   
			<!-- Leave this space empty (no closing div tag here) -->
		
		</div>
		
		<?php if ($comment->comment_approved == '0') : ?>
			<em style="margin-top:20px; display:block;"><?php _e('Your comment is awaiting moderation.', 'luxortheme') ?></em>
		<?php endif; ?>
		 
		 
		<div class="pm-comment"><?php comment_text() ?></div>
		
			<?php if($args['max_depth']!=$depth) { ?>
				<div class="pm-comment-reply-btn">
					<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div>
			<?php } ?>
		
		</div>
		<?php
		
		//echo '<div class="pm-comment-reply-form">';
		
			//Required for Themeforest regulations.
			$comments_args = array(
			  'title_reply'       => esc_html__( 'Leave a Reply', 'luxortheme' ),
			  'title_reply_to'    => esc_html__( 'Leave a Reply to %s', 'luxortheme' ),
			  'cancel_reply_link' => esc_html__( 'Cancel Reply', 'luxortheme' ),
			  'label_submit'      => esc_html__( 'Post Comment', 'luxortheme' ),
			);
		
		
		//echo '</div>';
			
	}//end of comments control
	
}



if( !function_exists('pm_ln_main_menu') ){
	
	//Menu functions
	function pm_ln_main_menu() {
		echo '<ul class="sf-menu pm-nav">';
			  wp_list_pages('title_li=&depth=1'); //http://codex.wordpress.org/Function_Reference/wp_list_pages
		echo '</ul>';
	}
	
}


if( !function_exists('pm_ln_footer_menu') ){
	
	function pm_ln_footer_menu() {
		echo '<ul class="pm-footer-navigation" id="pm-footer-nav">';
			  wp_list_pages('title_li=&depth=1'); //http://codex.wordpress.org/Function_Reference/wp_list_pages
		echo '</ul>';
	}
	
}


if( !function_exists('pm_ln_footer_menu_centered') ){
	
	function pm_ln_footer_menu_centered() {
		echo '<ul class="pm-footer-navigation centered" id="pm-footer-nav">';
			  wp_list_pages('title_li=&depth=1'); //http://codex.wordpress.org/Function_Reference/wp_list_pages
		echo '</ul>';
	}
	
}



if( !function_exists('pm_ln_validate_quick_login') ){
	
	/* Quick login validation */
	function pm_ln_validate_quick_login() {
		
		// Verify nonce
		if( isset( $_POST['pm_ln_quick_login_nonce'] ) ) {
		
		  if ( !wp_verify_nonce( $_POST['pm_ln_quick_login_nonce'], 'pm_ln_nonce_action' ) ) {
			  die( 'A system error has occurred, please try again later.' );
		  }	   
		  
		}
		
		
		 //Post values
		$username = sanitize_text_field($_POST['quickuser']);
		$password = sanitize_text_field($_POST['quickpass']);
		
		$login_form_security_question = $_POST['login_form_security_question'];
		$login_form_security_answer = $_POST['login_form_security_answer'];
		
		if( empty($username) ){
			
			echo 'username_error';
			die();
			
		} elseif( empty($password) ){
			
			echo 'password_error';
			die();
			
		} elseif($login_form_security_question !== $login_form_security_answer) {
			
			echo 'security_error';
			die();
			
		}
		
		//Verify credentials
		$user = get_user_by( 'login', $username );
		if ( $user && wp_check_password( $password, $user->data->user_pass, $user->ID) ) {
		   
		   $creds = array();
		   $creds['user_login'] = $username;
		   $creds['user_password'] = $password;
		   $creds['remember'] = false;
		   
		   //Authenticate user
		   $auth = wp_signon($creds, false );
		   if( is_wp_error($auth) ) {      
				echo "login_failed";
				die();
		   } else {
				echo "login_success";
				die();
		   }
		   
		} else {
			
		   echo "credentials_failed";
		   exit;
		   
		}
		die();
		
	}
	
}


if( !function_exists('pm_ln_quick_login_form') ){
	
	//Quick login form
	function pm_ln_quick_login_form() { ?>
	
		<div class="pm-ln-quick-login-form">
		
			<form class="form-horizontal registraion-form" role="form">
			
				<ul class="pm-ln-quick-login-list">
			
					<li>
						<input type="text" name="pm_quick_username" id="pm_quick_username" value="" placeholder="<?php esc_html_e('Username','luxortheme'); ?>" maxlength="70" class="pm-ln-quick-login-textfield" />
					</li>
					<li>
						<input type="password" name="pm_quick_password" id="pm_quick_password" value="" placeholder="<?php esc_html_e('Password','luxortheme'); ?>" maxlength="70" class="pm-ln-quick-login-textfield" />
					</li>
					<li>
						<input type="submit" value="<?php esc_html_e('Sign in','luxortheme'); ?>" id="btn-quick-login" class="pm-base-btn pm-header-btn pm-register-btn">
					</li>
				
				</ul>
				
				<?php 
				wp_nonce_field('pm_ln_nonce_action','pm_ln_quick_login_nonce'); 
				?>
			
			</form>
			
		</div>
	
	<?php
	}
	
}



if( !function_exists('pm_ln_register_new_user') ){
	
	/* New User registration - retrieves data from Ajax request */
	function pm_ln_register_new_user() {
	 
		// Verify nonce
		if( isset( $_POST['pm_ln_new_user_nonce'] ) ) {
		
		  if ( !wp_verify_nonce( $_POST['pm_ln_new_user_nonce'], 'pm_ln_nonce_action' ) ) {
			  die( 'A system error has occurred, please try again later.' );
		  }	   
		  
		}
		
	
		//Post values
		$firstName = sanitize_text_field($_POST['firstName']);
		$lastName = sanitize_text_field($_POST['lastName']);
		$mail = sanitize_text_field($_POST['mail']);
		$username = sanitize_text_field($_POST['username']);
		$password = sanitize_text_field($_POST['pass']);
		$confirmPass = sanitize_text_field($_POST['confirmPass']);
		
		$security_answer_input = $_POST['security_answer_input'];
		$security_answer_validate = $_POST['security_answer_validate'];
			
		//Server side validation
		if( empty($firstName) ){
			
			echo 'first_name_error';
			exit;
			
		} elseif( empty($lastName) ){
			
			echo 'last_name_error';
			exit;
			
		} elseif( pm_ln_validate_email($mail) == false ){
	
			echo 'email_error';
			exit;
			
		} elseif( empty($username) ){
	
			echo 'username_error';
			exit;
					
		} elseif( empty($password) ){
			
			echo 'password_error';
			exit;
			
		} elseif( empty($confirmPass) ){
			
			echo 'confirm_password_error';
			exit;
			
		} elseif( $password !== $confirmPass ){
			
			echo 'confirm_password_error';
			exit;
			
		} elseif( empty($security_answer_input) ){
		
			echo 'security_error';
			exit;
			
		} elseif($security_answer_input !== $security_answer_validate) {
			
			echo 'security_error';
			exit;
			
		} else {
		
			//ALL GOOD, REGISTER USER
			
			//Get the default role from Members area plug-in
			$default_role = get_option('pm_default_registration_role');
	
			if(!$default_role){
				$default_role = 'standard_member';	
			}
			
			$userdata = array(
				'user_login' => $username,
				'user_pass'  => $confirmPass,
				'user_email' => $mail,
				'first_name' => $firstName,
				'last_name' => $lastName,
				'role' => $default_role
			);
		
			$user_id = wp_insert_user( $userdata ) ;
			
			//$u = new WP_User( $user_id );
			//add_role( $role, $display_name, $capabilities ); // I assume $role, $display_name, $caps are already set before
			//$u->set_role( $role );
		
			//On success
			if( !is_wp_error($user_id) ) {
				
				echo 'success';
				exit;
				
			} else {
				
				echo 'form_error';
				exit;
				
			} 
			die();			
			
		}//end of if / else
		
	}//end of function
	
}



if( !function_exists('pm_ln_load_more') ){
	
	/* Load More AJAX Call */
	function pm_ln_load_more(){
		
		if(!wp_verify_nonce($_POST['nonce'], 'pulsar_ajax')) die('Invalid nonce');
		if( !is_numeric($_POST['page']) || $_POST['page'] < 0 ) die('Invalid page');
		
		$section = '';
			
		$args = '';
		if(isset($_POST['section']) && $_POST['section']){
			$section = $_POST['section'];
			$args = 'post_type=post_'.$_POST['section'].'&'; //match the post type name
		}
			
		if($section === 'properties'){
			
			$properties_posts_per_load = get_theme_mod('properties_posts_per_load', '4');
			
			$order = 'DESC';
		
			if( isset( $_POST['order'] ) ) {
				
				$order = (string) $_POST['order'];
				
				if($order === 'price_ascending'){
				
					$args = array(
						'post_type' => 'post_properties',
						'post_status' => 'publish',
						'paged' => $_POST['page'],
						//'order' => $order,
						//'posts_per_page' => -1,
						'meta_key' => 'pm_properties_price_meta',
						'orderby' => 'meta_value_num',
						'order' => 'DESC',
						'posts_per_page' => $properties_posts_per_load,
						//'tag' => get_query_var('tag')
					);
									
				} elseif($order === 'price_descending'){
					
					$args = array(
						'post_type' => 'post_properties',
						'post_status' => 'publish',
						'paged' => $_POST['page'],
						//'order' => $order,
						//'posts_per_page' => -1,
						'meta_key' => 'pm_properties_price_meta',
						'orderby' => 'meta_value_num',
						'order' => 'ASC',
						'posts_per_page' => $properties_posts_per_load,
						//'tag' => get_query_var('tag')
					);
					
				} elseif($order === 'recent'){
					
					$args = array(
						'post_type' => 'post_properties',
						'post_status' => 'publish',
						'paged' => $_POST['page'],
						//'order' => $order,
						//'posts_per_page' => -1,
						'order' => 'DESC',
						'posts_per_page' => $properties_posts_per_load,
						//'tag' => get_query_var('tag')
					);
					
				} elseif($order === 'chronological'){
					
					$args = array(
						'post_type' => 'post_properties',
						'post_status' => 'publish',
						'paged' => $_POST['page'],
						'order' => $order,
						//'posts_per_page' => -1,
						'order' => 'ASC',
						'posts_per_page' => $properties_posts_per_load,
						//'tag' => get_query_var('tag')
					);
					
				} else {
				
					$args = array(
						'post_type' => 'post_properties',
						'post_status' => 'publish',
						'paged' => $_POST['page'],
						'order' => $order,
						//'posts_per_page' => -1,
						'posts_per_page' => $properties_posts_per_load,
						//'tag' => get_query_var('tag')
					);
					
				}
				
			} else {
			
				$args = array(
					'post_type' => 'post_properties',
					'post_status' => 'publish',
					'paged' => $_POST['page'],
					'order' => $order,
					//'posts_per_page' => -1,
					'posts_per_page' => $properties_posts_per_load,
					//'tag' => get_query_var('tag')
				);
			
			}		
			
			//$args .= 'post_status=publish&posts_per_page='.$properties_posts_per_load.'&paged='. $_POST['page'];
		} elseif($section === 'propertieseditable'){//COMPLETED
		
			$properties_posts_per_load = get_theme_mod('properties_posts_per_load', '4');
			
			$order = 'DESC';
		
			if( isset( $_POST['order'] ) ) {
				
				$order = (string) $_POST['order'];
				$authorid = (int) $_POST['authorid'];
				
				if($order === 'price_ascending'){
				
					$args = array(
						'author' => $authorid,
						'post_type' => 'post_properties',
						'post_status' => 'publish',
						'paged' => $_POST['page'],
						//'order' => $order,
						//'posts_per_page' => -1,
						'meta_key' => 'pm_properties_price_meta',
						'orderby' => 'meta_value_num',
						'order' => 'DESC',
						'posts_per_page' => $properties_posts_per_load,
						//'tag' => get_query_var('tag')
					);
									
				} elseif($order === 'price_descending'){
					
					$args = array(
						'author' => $authorid,
						'post_type' => 'post_properties',
						'post_status' => 'publish',
						'paged' => $_POST['page'],
						//'order' => $order,
						//'posts_per_page' => -1,
						'meta_key' => 'pm_properties_price_meta',
						'orderby' => 'meta_value_num',
						'order' => 'ASC',
						'posts_per_page' => $properties_posts_per_load,
						//'tag' => get_query_var('tag')
					);
					
				} elseif($order === 'recent'){
					
					$args = array(
						'author' => $authorid,
						'post_type' => 'post_properties',
						'post_status' => 'publish',
						'paged' => $_POST['page'],
						//'order' => $order,
						//'posts_per_page' => -1,
						'order' => 'DESC',
						'posts_per_page' => $properties_posts_per_load,
						//'tag' => get_query_var('tag')
					);
					
				} elseif($order === 'chronological'){
					
					$args = array(
						'author' => $authorid,
						'post_type' => 'post_properties',
						'post_status' => 'publish',
						'paged' => $_POST['page'],
						'order' => $order,
						//'posts_per_page' => -1,
						'order' => 'ASC',
						'posts_per_page' => $properties_posts_per_load,
						//'tag' => get_query_var('tag')
					);
					
				} else {
				
					$args = array(
						'author' => $authorid,
						'post_type' => 'post_properties',
						'post_status' => 'publish',
						'paged' => $_POST['page'],
						'order' => $order,
						//'posts_per_page' => -1,
						'posts_per_page' => $properties_posts_per_load,
						//'tag' => get_query_var('tag')
					);
					
				}
				
			} else {
			
				$args = array(
					'author' => $authorid,
					'post_type' => 'post_properties',
					'post_status' => 'publish',
					'paged' => $_POST['page'],
					'order' => $order,
					//'posts_per_page' => -1,
					'posts_per_page' => $properties_posts_per_load,
					//'tag' => get_query_var('tag')
				);
			
			}
			
		} elseif($section === 'agents'){//COMPLETED
			
			$agent_posts_per_load = get_theme_mod('agent_posts_per_load', '3');
			$agentPostOrder = get_theme_mod('agentPostOrder', 'DESC');
					
			$args .= 'post_status=publish&order='.$agentPostOrder.'&posts_per_page='.$agent_posts_per_load.'&paged='. $_POST['page'];
			
		} elseif($section === 'agencies'){//COMPLETED
			
			$agencies_posts_per_load = get_theme_mod('agencies_posts_per_load', '4');
			
			$order = 'DESC';
		
			if( isset( $_POST['order'] ) ) {
				$order = (string) $_POST['order'];
			}
					
			//$args .= 'post_status=publish&order='.$agentPostOrder.'&posts_per_page='.$agent_posts_per_load.'&paged='. $_POST['page'];
			$args .= 'post_status=publish&posts_per_page='.$agencies_posts_per_load.'&order='.$order.'&paged='. $_POST['page'];
	
			
		} else {
			$args .= 'post_status=publish&posts_per_page=4&paged='. $_POST['page'];
		}
			
		ob_start();
		$query = new WP_Query($args);
		while( $query->have_posts() ){ $query->the_post();
			
			if($section === 'propertieseditable'){
				get_template_part( 'content', 'propertiesposteditable' );
			} else {
				get_template_part( 'content', $section.'post' );
			}
				
			
		}
		
		wp_reset_postdata();
		$content = ob_get_contents();
		ob_end_clean();
		
		echo json_encode(
			array(
				'pages' => $query->max_num_pages,
				'content' => $content
			)
		);
		
		exit;
	
	}
	
}


if( !function_exists('pm_ln_load_more_posts') ){
	
	function pm_ln_load_more_posts(){
	
		if(!wp_verify_nonce($_POST['nonce'], 'pulsar_ajax')) die('Invalid nonce');
		if( !is_numeric($_POST['page']) || $_POST['page'] < 0 ) die('Invalid page');
	
		$posts_per_load = get_theme_mod('posts_per_load', '3');
		
		$args = '';
	
		$args .= 'post_status=publish&posts_per_page='.$posts_per_load.'&paged='. $_POST['page'];
			
		ob_start();
		$query = new WP_Query($args);
		while( $query->have_posts() ){ $query->the_post();
					
			get_template_part( 'content', 'post' );	
			
		}
		
		wp_reset_postdata();
		$content = ob_get_contents();
		ob_end_clean();
		
		echo json_encode(
			array(
				'pages' => $query->max_num_pages,
				'content' => $content
			)
		);
		
		exit;
	
	}
	
}



if( !function_exists('pm_ln_retrieve_likes') ){
	
	function pm_ln_retrieve_likes() {
		//verify nonce (set in functions.php - line 636)
		if(!wp_verify_nonce($_POST['nonce'], 'pulsar_ajax')) die('Invalid nonce');
		if( !is_numeric($_POST['postID']) || $_POST['postID'] < 0 ) die('Invalid request');
		
		$postID = $_POST['postID'];
		
		$currentLikes = get_post_meta($postID, 'pm_total_likes', true);
		
		echo json_encode(
			array(
				'currentLikes' => $currentLikes,
			)
		);
		
		exit;
		
	}
	
}



if( !function_exists('pm_ln_like_feature') ){
	
	function pm_ln_like_feature() {
	
		//verify nonce (set in functions.php - line 636)
		if(!wp_verify_nonce($_POST['nonce'], 'pulsar_ajax')) die('Invalid nonce');
		if( !is_numeric($_POST['postID']) || $_POST['postID'] < 0 ) die('Invalid request');
		
		$postID = $_POST['postID'];
		$likes = (int) $_POST['likes'];
		
		//$newLikes = $likes + 1;
		
		update_post_meta($postID, 'pm_total_likes', $likes);
		
		exit;
		
	}
	
}




if( !function_exists('pm_ln_search_knowledge_base') ){
	
	function pm_ln_search_knowledge_base() {

		global $wpdb;
		$search_val_stripped = isset($_POST['search']) ? stripslashes($_POST['search']) : "";
		$search_val = sanitize_text_field($search_val_stripped);
		
		//$sql = "SELECT post_title, guid FROM ".$wpdb->prefix."posts WHERE post_content LIKE '%$search_val%' AND post_status = 'publish' AND post_type = 'post_knowledgebase'";
		
		//Test this for next update
		$sql = "SELECT post_title, guid FROM ".$wpdb->prefix."posts WHERE post_title LIKE '%$search_val%' OR post_content LIKE '%$search_val%' AND post_status = 'publish' AND post_type = 'post_knowledgebase'";
		
		$userresults = $wpdb->get_results($sql);
		$result = array();
		foreach ($userresults as $val) {
			array_push($result, array("title" => $val->post_title, "guid" => $val->guid));
		}
		echo json_encode($result);
		exit;
		
	}
	
}



if( !function_exists('pm_ln_send_contact_form') ){
	
	function pm_ln_send_contact_form() {
			
		 // Verify nonce
		 if( isset( $_POST['pm_ln_send_contact_nonce'] ) ) {
		
		   if ( !wp_verify_nonce( $_POST['pm_ln_send_contact_nonce'], 'pm_ln_nonce_action' ) ) {
			   die( 'A system error has occurred, please try again later.' );
		   }	   
		  
		 }
	
		 //Post values
		 $first_name = sanitize_text_field($_POST['first_name']);
		 $last_name = sanitize_text_field($_POST['last_name']);
		 $email_address = sanitize_text_field($_POST['email_address']);
		 $message = sanitize_text_field($_POST['message']);
		 $phone_number = sanitize_text_field($_POST['phone_number']);
		 $recipient = sanitize_text_field($_POST['recipient']);
		 
		 $contact_form_security_question = $_POST['contact_form_security_question'];
		 $contact_form_security_answer = $_POST['contact_form_security_answer'];
		 
		 $consent = sanitize_text_field($_POST['consent']);
		 
		
		 if ( empty($first_name) ){
			
			echo 'first_name_error';
			die();
	
		} elseif( empty($last_name) ){
			
			echo 'last_name_error';
			die();
			
		} elseif( pm_ln_validate_email($email_address) == false ){
			
			echo 'email_error';
			die();
			
		} elseif( empty($message) ){
			
			echo 'message_error';
			die();
			
		} elseif( $consent === 'unchecked' ){
			
			echo 'consent_error';
			die();
			
		}  elseif($contact_form_security_question !== $contact_form_security_answer) {
			
			echo 'security_error';
			die();
			
		}
		
		
			
		//All good, send email
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= 'From: '.esc_attr__('donotreply', 'luxortheme').'@'. $_SERVER['SERVER_NAME'] .' <'.esc_attr__('donotreply', 'luxortheme').'@'. $_SERVER['SERVER_NAME'] .'>' . "\r\n";
		
		$multiple_recipients = array(
			$recipient
		);
			
		$subj = esc_html__('Contact Form Inquiry', 'luxortheme');
		
		
		$body = ' 
			
			  **** '. esc_html__('THIS IS AN AUTOMATED MESSAGE. PLEASE DO NOT REPLY DIRECTLY TO THIS EMAIL', 'luxortheme') .' **** 
			  
			  '. esc_html__('First Name', 'luxortheme') .': '.$first_name.'
			  '. esc_html__('Last Name', 'luxortheme') .': '.$last_name.'
			  '. esc_html__('Email Address', 'luxortheme') .': '.$email_address.'
			  '. esc_html__('Phone Number', 'luxortheme') .': '.$phone_number.'
			  '. esc_html__('Message', 'luxortheme') .': '.$message.'
			  
			';
	
		
		$send_mail = wp_mail( $multiple_recipients, $subj, $body);
		
		if($send_mail) {
			
			echo 'success';
			die();
			
		} else {
			
			echo 'failed';
			die();
				
		}
			
	}

	
}


if( !function_exists('pm_ln_send_agent_form') ){
	
	function pm_ln_send_agent_form() {
			
		 // Verify nonce
		 if( isset( $_POST['pm_ln_send_agent_form_nonce'] ) ) {
		
		   if ( !wp_verify_nonce( $_POST['pm_ln_send_agent_form_nonce'], 'pm_ln_nonce_action' ) ) {
			   die( 'A system error has occurred, please try again later.' );
		   }	   
		  
		 }
	
		 //Post values
		 $first_name = sanitize_text_field($_POST['first_name']);
		 $last_name = sanitize_text_field($_POST['last_name']);
		 $email_address = sanitize_text_field($_POST['email_address']);
		 $message = sanitize_text_field($_POST['message']);
		 $phone_number = sanitize_text_field($_POST['phone_number']);
		 $recipient = sanitize_text_field($_POST['recipient']);
		 
		 $agent_form_security_question = $_POST['agent_form_security_question'];
		 $agent_form_security_answer = $_POST['agent_form_security_answer'];
		 
		 $consent = sanitize_text_field($_POST['consent']);
		 
		
		 if ( empty($first_name) ){
			
			echo 'first_name_error';
			die();
	
		} elseif( empty($last_name) ){
			
			echo 'last_name_error';
			die();
			
		} elseif( pm_ln_validate_email($email_address) == false ){
			
			echo 'email_error';
			die();
			
		} elseif( empty($message) ){
			
			echo 'message_error';
			die();
			
		} elseif( $consent === 'unchecked' ){
			
			echo 'consent_error';
			die();
			
		} elseif($agent_form_security_question !== $agent_form_security_answer) {
			
			echo 'security_error';
			die();
			
		}
		
		//All good, send email
		$multiple_recipients = array(
			$recipient
		);
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= 'From: '.esc_attr__('donotreply', 'luxortheme').'@'. $_SERVER['SERVER_NAME'] .' <'.esc_attr__('donotreply', 'luxortheme').'@'. $_SERVER['SERVER_NAME'] .'>' . "\r\n";
		
		$subj = esc_html__('Agent Form Inquiry', 'luxortheme');
		
		
		$body = ' 
			
			  **** '. esc_html__('THIS IS AN AUTOMATED MESSAGE. PLEASE DO NOT REPLY DIRECTLY TO THIS EMAIL', 'luxortheme') .' **** 
			  
			  '. esc_html__('First Name', 'luxortheme') .': '.$first_name.'
			  '. esc_html__('Last Name', 'luxortheme') .': '.$last_name.'
			  '. esc_html__('Email Address', 'luxortheme') .': '.$email_address.'
			  '. esc_html__('Phone Number', 'luxortheme') .': '.$phone_number.'
			  '. esc_html__('Message', 'luxortheme') .': '.$message.'
			  
			';
		
		$send_mail = wp_mail( $multiple_recipients, $subj, $body );
		
		if($send_mail) {
			
			echo 'success';
			die();
			
		} else {
			
			echo 'failed';
			die();
				
		}
			
	}
	
}



if( !function_exists('pm_ln_send_property_agent_form') ){
	
	function pm_ln_send_property_agent_form() {
			
		 // Verify nonce
		 if( isset( $_POST['pm_ln_send_property_agent_form_nonce'] ) ) {
		
		   if ( !wp_verify_nonce( $_POST['pm_ln_send_property_agent_form_nonce'], 'pm_ln_nonce_action' ) ) {
			   die( 'A system error has occurred, please try again later.' );
		   }	   
		  
		 }
	
		 //Post values
		 $full_name = sanitize_text_field($_POST['full_name']);
		 $email_address = sanitize_text_field($_POST['email_address']);
		 $message = sanitize_text_field($_POST['message']);
		 $recipient = sanitize_text_field($_POST['recipient']);
		 $property_title = sanitize_text_field($_POST['property_title']);
		 $property_id = sanitize_text_field($_POST['property_id']);
		 $pm_s_phone_number = sanitize_text_field($_POST['pm_s_phone_number']);
		 
		 $property_form_security_question = $_POST['property_form_security_question'];
		 $property_form_security_answer = $_POST['property_form_security_answer'];
		 
		 $consent = sanitize_text_field($_POST['consent']);
		 
		
		 if ( empty($full_name) ){
			
			echo 'full_name_error';
			die();
	
		} elseif( pm_ln_validate_email($email_address) == false ){
			
			echo 'email_error';
			die();
			
		} elseif( empty($message) ){
			
			echo 'message_error';
			die();
			
		} elseif( $consent === 'unchecked' ){
			
			echo 'consent_error';
			die();
			
		} elseif($property_form_security_question !== $property_form_security_answer) {
			
			echo 'security_error';
			die();
			
		}
		
		//All good, send email
		$multiple_recipients = array(
			$recipient
		);
		
		//Headers not being used
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= 'From: '.esc_attr__('donotreply', 'luxortheme').'@'. $_SERVER['SERVER_NAME'] .' <'.esc_attr__('donotreply', 'luxortheme').'@'. $_SERVER['SERVER_NAME'] .'>' . "\r\n";
		
		$subj = esc_html__('Property Form Inquiry', 'luxortheme');
		
		$body = ' 
			
			  **** '. esc_html__('THIS IS AN AUTOMATED MESSAGE. PLEASE DO NOT REPLY DIRECTLY TO THIS EMAIL', 'luxortheme') .' ****
			  
			  '. esc_html__('Property Title', 'luxortheme') .': '.$property_title.'
			  '. esc_html__('Property Post ID', 'luxortheme') .': '.$property_id.'
			  '. esc_html__('Name', 'luxortheme') .': '.$full_name.'
			  '. esc_html__('Phone Number', 'luxortheme') .': '.$pm_s_phone_number.'
			  '. esc_html__('Email Address', 'luxortheme') .': '.$email_address.'
			  '. esc_html__('Message', 'luxortheme') .': '.$message.'
			  
			';
		
		$send_mail = wp_mail( $multiple_recipients, $subj, $body );
		
		if($send_mail) {
			
			echo 'success';
			die();
			
		} else {
			
			echo 'failed';
			die();
				
		}
			
	}
	
}


if( !function_exists('pm_ln_send_quick_contact_form') ){
	
	function pm_ln_send_quick_contact_form() {
			
		 // Verify nonce
		 if( isset( $_POST['pm_ln_send_quick_contact_nonce'] ) ) {
		
		   if ( !wp_verify_nonce( $_POST['pm_ln_send_quick_contact_nonce'], 'pm_ln_nonce_action' ) ) {
			   die( 'A system error has occurred, please try again later.' );
		   }	   
		  
		 }
	
		 //Post values
		 $full_name = sanitize_text_field($_POST['full_name']);
		 $email_address = sanitize_text_field($_POST['email_address']);
		 $message = sanitize_text_field($_POST['message']);
		 $recipient = sanitize_text_field($_POST['recipient']);
		 
		
		 if ( empty($full_name) ){
			
			echo 'full_name_error';
			die();
	
			
		} elseif( pm_ln_validate_email($email_address) == false ){
			
			echo 'email_error';
			die();
			
		} elseif( empty($message) ){
			
			echo 'message_error';
			die();
			
		} 
		
		//All good, send email
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= 'From: '.esc_attr__('donotreply', 'luxortheme').'@'. $_SERVER['SERVER_NAME'] .' <'.esc_attr__('donotreply', 'luxortheme').'@'. $_SERVER['SERVER_NAME'] .'>' . "\r\n";
		
		$multiple_recipients = array(
			$recipient
		);
		
		$subj = esc_html__('Quick Contact Form Inquiry', 'luxortheme');
		
		$body = ' 
			
			  **** '. esc_html__('THIS IS AN AUTOMATED MESSAGE. PLEASE DO NOT REPLY DIRECTLY TO THIS EMAIL', 'luxortheme') .' **** 
			  
			  '. esc_html__('Name', 'luxortheme') .': '.$full_name.'
			  '. esc_html__('Email Address', 'luxortheme') .': '.$email_address.'
			  '. esc_html__('Message', 'luxortheme') .': '.$message.'
			  
			';
		
		$send_mail = wp_mail( $multiple_recipients, $subj, $body );
		
		if($send_mail) {
			
			echo 'success';
			die();
			
		} else {
			
			echo 'failed';
			die();
				
		}
			
	}
	
}





?>