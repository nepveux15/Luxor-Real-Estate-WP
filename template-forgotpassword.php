<?php /* Template Name: Forgot Password Template */ ?>
<?php get_header(); ?>


<div class="container pm-containerPadding-top-80">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; else: ?>
            <?php endif; ?>                                    
        </div>
    </div>
</div>

<div class="container pm-containerPadding-top-20 pm-containerPadding-bottom-80">
    <div class="row">
        
        <div class="col-lg-12">
            <?php get_template_part('content', 'forgotpassword'); ?>
        </div>

        
    </div>
</div>


<?php get_footer(); ?>