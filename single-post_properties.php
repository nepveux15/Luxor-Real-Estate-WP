<?php get_header(); ?>

<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
	<?php get_template_part( 'content', 'propertiespostcontent' ); ?>
<?php endwhile; else: ?>
     <p><?php esc_html_e('No content was found.', 'luxortheme'); ?></p>
<?php endif; ?> 

<?php get_footer(); ?>