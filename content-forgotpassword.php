<?php
/**
 * The default template for displaying the reset password page for members
 */
?>

<?php 

	//Redux options	
	$pm_members_account_template_slug = get_option('pm_members_account_template_slug');

	if(is_user_logged_in()) {
		
		if($pm_members_account_template_slug !== ''){
			wp_redirect( site_url($pm_members_account_template_slug) );
		} else {
			wp_redirect( site_url('members-account') );	
		}
		
		exit;
	}

?>

    
<?php
	global $wpdb;

	$error = '';
	$success = '';
	
	// check if we're in reset form
	if( isset( $_POST['action'] ) && 'reset' == $_POST['action'] )
	{
		$email = $wpdb->escape(trim($_POST['user_email_address']));
		
		if( empty( $email ) ) {
			$error = esc_html__('Enter your e-mail address.', 'luxortheme');
		} else if( ! is_email( $email )) {
			$error =  esc_html__('Invalid e-mail address.', 'luxortheme');
		} else if( ! email_exists( $email ) ) {
			$error = esc_html__('There is no user registered with that email address.', 'luxortheme');
		} else {
		
			$random_password = wp_generate_password( 12, false );
			$user = get_user_by( 'email', $email );
			
			$update_user = wp_update_user( array (
					'ID' => $user->ID,
					'user_pass' => $random_password
				)
			);
			
			// if update user return true then lets send user an email containing the new password
			if( $update_user ) {
								
				$to = $email;
				$subject = esc_html__('Member Password Reset', 'luxortheme');
				$sender = get_option('name');
				
				$message = esc_html__('You have requested to have your password reset. Your new membership password is:', 'luxortheme') .' '. $random_password;
				
				$headers[] = 'MIME-Version: 1.0' . "\r\n";
				$headers[] = 'Content-type: text/html; charset=utf-8' . "\r\n";
				$headers[] = "X-Mailer: PHP \r\n";
				$headers[] = 'From: '.$sender.' <'.$email.'>' . "\r\n";
				
				$mail = wp_mail( $to, $subject, $message, $headers );
				if( $mail ) {
					$success = esc_html__('Check your email address for your new password.', 'luxortheme');
				} else {
					$error = esc_html__('Oops something went wrong updating your account. Please try again.', 'luxortheme');
				}
					
			} else {
				$error = esc_html__('Oops something went wrong updating your account. Please try again.', 'luxortheme');
			}

		}
		
		if( ! empty( $error ) ) {
			echo '<div class="alert alert-warning" style="margin-bottom:20px;"><i class="typcn typcn-warning"></i> <strong>ERROR:</strong> '. $error .'</div>';
		}
		
		if( ! empty( $success ) ) {
			echo '<div class="alert alert-success" style="margin-bottom:20px;"><i class="typcn typcn-tick"></i> '. $success .'</div>';
		}
	}
?>

<p></p>

<!--html code-->
<form method="post">
	<fieldset>
		<p>
			<input type="text" class="pm-form-textfield" name="user_email_address" placeholder="<?php esc_html_e('Email Address', 'luxortheme'); ?>"  value="" /></p>
		<p>
			<input type="hidden" name="action" value="reset" />
			<input type="submit" value="<?php esc_html_e('Get New Password','luxortheme') ?>" class="pm-form-submit-btn" id="submit" />
		</p>
	</fieldset>
</form>
