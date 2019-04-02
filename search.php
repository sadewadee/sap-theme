<?php get_header(); ?>
<?php include_once('includes/slider-content.php'); ?>

    <div class="section lb">
        <div class="container">
        <div class="row">

<?php if (have_posts()) : ?>
<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
<?php /* If this is a category archive */ if (is_category()) { ?>
<?php } ?>
<div class="col-xs-12 col-sm-12 col-md-12 aligncenter">
<h1 class="title"><?php printf( esc_html__( 'Search Results for: %s', 'ultrabootstrap' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
</div> 
<?php while (have_posts()) : the_post(); ?>

<div class="job-tab">
<div class="row">
<?php if(has_post_thumbnail()): ?>
<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-thumbnails-sq'); ?>
<div class="col-md-3">
<a class="standard-format-icon-orange"  <?php echo $format_icon; ?> href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img class="fadeover" src="<?php echo $image[0]; ?>"  width='300' height='300' /></a>
</div>               
<?php else: ?>
<div class="col-md-3">
<img src="<?php bloginfo("template_url"); ?>/images/thumbnail-sar.jpg" alt="" class="img-responsive img-rounded">
</div>
<?php endif; ?>
<h3 class="title"><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h3>
<p><?php echo string_limit_words(get_the_excerpt(), 20); ?>...</p>	
<a class="button orange" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Selengkapnya</a>  
</div><!-- end row -->
</div>



<?php endwhile; ?>
        <div class="navigation">
        <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
        <div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
        <div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
        <?php } ?>
        </div>
<?php else : ?>

<div class="col-sm-12"><h2 class="pagetitle">No posts found. Try a different search ?</h2>
<?php get_search_form(); ?></div>
<?php endif; ?>

</div>
        
        
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