
<?php $slideshow_home = ( array(  'posts_per_page' => '5','post_type' => 'slideshow_home' )); query_posts( $slideshow_home ); ?>
<div class="slide"  >
    <ul>
<?php if (have_posts()) : while (have_posts()) : the_post();  ?>
<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'slideshow_home' );?>
   <li data-bg="<?php echo $thumb['0'];?>" class="parallax section homehero"  >   
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                
                <div class="home-message">
                                <h1><?php the_title(); ?></h1>
                                
                                <p><?php the_excerpt(); ?></p> 
                                <div class="svg-wrapper">
                                    <div class="ttext">
                                        <a class="btn btn-custom" href="#">View All Jobs <span class="fa fa-angle-right"></span></a>
                                    </div>
                                    <svg height="57" width="200" xmlns="http://www.w3.org/2000/svg">
                                        <rect class="shape" height="57" width="200" />
                                    </svg>
                                </div>
                            </div>
                            
                            </div>
                            </div>
                            </div>
     </li>  
<?php endwhile; endif; ?>
    </ul>
</div>
<?php  wp_reset_query(); ?> 
