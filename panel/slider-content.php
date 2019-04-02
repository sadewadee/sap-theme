    <!--div class="section db">
        <div class="container">
            <div class="page-title text-center">
                <div class="heading-holder">
                    <h1><?php the_title(); ?></h1>
                </div>
                <p class="lead">Latest Trends, Our News, Tips & Tricks</p>
            </div>
        </div>
    </div-->
    
<?php if (has_post_thumbnail()) : ?>
<div  style="position:relative">
<div class="slide slider-content">
<ul>
<?php if (have_posts()) : while (have_posts()) : the_post();  ?>
<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'slideshow_home' );?>
 <li data-bg="<?php echo $thumb['0'];?>"><span>    
 </li>
<?php endwhile; endif; ?>
</ul>
</div>
<?php  wp_reset_query(); ?> 
</div>
    
    
<?php else : ?>

<div  style="position:relative">
<?php $slideshow_home = ( array(  'posts_per_page' => '5','post_type' => 'slideshow_home' )); query_posts( $slideshow_home ); ?>
<div class="slide slider-content">
    <ul>
<?php if (have_posts()) : while (have_posts()) : the_post();  ?>
<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'slideshow_home' );?>
   <li data-bg="<?php echo $thumb['0'];?>"><span>
      
   </li>
<?php endwhile; endif; ?>
    </ul>
</div>
<?php  wp_reset_query(); ?> 
</div>
<?php endif; ?>  

