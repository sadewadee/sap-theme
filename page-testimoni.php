<?php 
/*Template Name: Testimoni Page Theme */ 
get_header(); 
?>
<?php $testimonial = ( array(  'posts_per_page' => '10','post_type' => 'testimonial' )); query_posts( $testimonial ); ?>
<?php include_once('includes/slider-content.php'); ?>


<div class="section wb">
<div class="container">
<div class="row">
<div class="section-title text-center clearfix" style="background:#FFFFFF; margin-bottom:0; padding-top:60px">
<h4>Testimonial</h4><hr>
</div>

<div class="col-md-12">
<div class="row testimonials">
<?php $testimonial = ( array(  'posts_per_page' => '10','post_type' => 'testimonial' )); query_posts( $testimonial ); ?>
<?php if (have_posts()) : while (have_posts()) : the_post();  ?>
<div class="col-sm-4">
<blockquote>
<p class="clients-words"><?php echo string_limit_words(get_the_excerpt(), 20); ?></p>
<span class="clients-name text-primary">- <?php the_title(); ?></span>
<?php if(has_post_thumbnail()): ?>
<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'testi-thumbnails'); ?>
<img class="img-circle img-thumbnail" src="<?php echo $image[0]; ?>"/>
<?php else: ?>
<img src="<?php bloginfo("template_url"); ?>/images/testi.png" alt="" class="img-circle img-thumbnail">
<?php endif; ?>
</blockquote>
</div>
<?php endwhile; ?>
<?php endif; ?>    
</div>
</div><!--/.col-->  
</div><!--/.row-->
</div><!-- end container -->
</div>
<?php  wp_reset_query(); ?>   
<?php get_footer(); ?>      