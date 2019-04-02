<?php 
/*Template Name: Home Page Theme */ 
get_header(); ?>

 
<?php include_once('slider.php'); ?>
<div class="section lb">
<div class="container">
<?php include_once('includes/welcome.php'); ?>
<?php include_once('includes/our-service.php'); ?>
</div><!-- end section -->
</div>


<div class="section wb">
<div class="container">
<div class="section-title text-center clearfix">
<?php if (query_posts('cat=2&showposts=2')) : ?>
<h4><?php single_cat_title( '', true ); ?></h4><hr>
</div>
<div class="row whoweare">
<?php while (have_posts()) : the_post(); ?> 
<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumbnails-sq' );?>              
<div class="col-md-6">

<div class="row">
<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-thumbnails-sq'); ?>
<?php if(has_post_thumbnail()): ?>
<div class="col-md-5">
<a class="standard-format-icon-orange"  <?php echo $format_icon; ?> href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'>
<img class="img-responsive img-rounded" src="<?php echo $image[0]; ?>"/></a>
</div>            
<?php else: ?>
<div class="col-md-5">
<img src="<?php bloginfo("template_url"); ?>/images/thumbnail-sar.jpg" alt="" class="img-responsive img-rounded">
</div>
<?php endif; ?>


<div class="col-md-7">
<div class="about-widget">
<h5><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h5>
<p><?php echo string_limit_words(get_the_excerpt(), 15); ?>...</p>	
<a class="btn btn-primary" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Read More</a>
</div>
</div>
</div><!-- end row -->  
</div>
<?php endwhile; ?>
<?php endif; ?>                       
</div><!-- end row -->
</div><!-- end container -->
</div><!-- end section -->

<?php get_footer(); ?>