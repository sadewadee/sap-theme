<div class="all-jobs job-listing clearfix">
<?php if (query_posts('cat=2')) : ?> 
<div class="section-title text-center clearfix" style="background:#FFFFFF; margin-bottom:0; padding-top:60px">
<h4><?php single_cat_title( '', true ); ?></h4><hr>
</div>

<?php while (have_posts()) : the_post(); ?> 
<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumbnails-sq' );?>           
<div class="job-tab">
<div class="row">

<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-thumbnails-sq'); ?>
<?php if(has_post_thumbnail()): ?>
<div class="col-md-3">
<a class="standard-format-icon-orange"  <?php echo $format_icon; ?> href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'>
<img class="img-responsive img-rounded" src="<?php echo $image[0]; ?>"/></a>
</div>            
<?php else: ?>
<div class="col-md-3">
<img src="<?php bloginfo("template_url"); ?>/images/thumbnail-sar.jpg" alt="" class="img-responsive img-rounded">
</div>
<?php endif; ?>



<h3 class="title"><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h3>
<p><?php echo string_limit_words(get_the_excerpt(), 40); ?>...</p>	
<a class="btn btn-primary" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Read More</a>  
</div><!-- end row -->
</div><!-- end job-tab -->
<?php endwhile; ?>
<?php endif; ?>                       
<!-- end alljobs -->

<div class="loadmorebutton text-center clearfix">
<a href="#" class="btn btn-primary" id="loadMore">Load More Jobs</a>
</div><!-- end loadmore -->
</div>