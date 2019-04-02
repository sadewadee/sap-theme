<?php get_header(); ?>
 
<?php include_once('includes/slider-content.php'); ?>

    <div class="section lb">
        <div class="container">
            <div class="row">
                <div class="content col-md-8"> 
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="blog-widget single-blog">
                    <h1 class="title"><?php the_title(); ?></h1>
                    <?php the_content(); ?>
                    <div class="edit"> <?php edit_post_link('Edit this entry', '<p>', '</p>'); ?></div>
                    <?php endwhile; endif; ?> 
                    </div>
                </div>
                <?php get_sidebar(); ?>
            </div><!-- end row -->  
        </div><!-- end container -->
    </div><!-- end section -->
<?php get_footer(); ?>      