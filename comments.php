<?php

/**

 * @package WordPress
 * @subpackage Default_Theme
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<div class="pm-comment-header">
            <h3><?php comments_number('No Responses', 'One Response', '% Responses' );?> to &#8220;<?php the_title(); ?>&#8221;</h3>
        </div>

		 <ol class="commentlist" style="margin:0; padding:0;">
			<?php wp_list_comments('callback=pm_ln_mytheme_comment'); ?>
        </ol>
        
        <div class="navigation">
            <div class="alignleft"><?php previous_comments_link() ?></div>
            <div class="alignright"><?php next_comments_link() ?></div>
        </div>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'luxortheme' ); ?></p>
        
	<?php endif; ?>
    
    <?php 
	
		$args = array(
                        
			  'id_form'           => 'commentform',
			  'class_form'      => 'comment-form',
			  'id_submit'         => 'submit',
			  'class_submit'      => 'submit',
			  'name_submit'       => 'submit',
			  'title_reply'       => esc_html__( 'Leave a Reply', 'luxortheme' ),
			  'title_reply_to'    => esc_html__( 'Leave a Reply to %s', 'luxortheme' ),
			  'cancel_reply_link' => esc_html__( 'Cancel Reply', 'luxortheme' ),
			  'label_submit'      => esc_html__( 'Post Comment', 'luxortheme' ),
			  'format'            => 'xhtml',
			  
			  
			  'fields' => apply_filters( 'comment_form_default_fields', 
			  
				  array(
				
					'author' =>
					  '<div class="col-lg-4 col-md-4 col-sm-12 pm-form-clear-left-padding"><input required id="author" name="author" type="text" class="respond_author pm-comment-form-textfield" size="22" value=""  placeholder="'. esc_html__('Name *', 'luxortheme') .'" /></div>',
				
					'email' =>
					  '<div class="col-lg-4 col-md-4 col-sm-12 pm-form-clear-mobile-padding"><input required id="email" name="email" type="text" class="respond_email pm-comment-form-textfield" size="22" value=""  placeholder="'. esc_html__('Email *', 'luxortheme') .'" /></div>',
				
					'url' =>
					  '<div class="col-lg-4 col-md-4 col-sm-12 pm-form-clear-right-padding"><input id="url" name="url" type="text" value="" size="30" class="respond_url pm-comment-form-textfield" placeholder="'. esc_html__('Website', 'luxortheme') .'" /></div>'
					)//end of array
				
				),//end of apply_filters
				
				'comment_field' => '<div class="col-lg-12 pm-form-clear-padding pm-clear-element pm-form-margin-spacing"><textarea id="comment" class="pm-comment-form-textarea" name="comment" cols="45" rows="8" aria-required="true" placeholder="'. esc_html__('Comment...', 'luxortheme') .'"></textarea></div>',
			
			);
	
	?>

	<?php comment_form($args); ?>

</div><!-- .comments-area -->