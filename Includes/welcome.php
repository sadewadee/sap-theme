<?php
$the_query = new WP_Query( array( 'page_id' => 8 ) );
if ( $the_query->have_posts() ) {
while ( $the_query->have_posts() ) {
$the_query->the_post();
?>                         
<div class="section-title text-center clearfix">
<h4><?php the_title(); ?></h4>
<hr>
<p class="lead"><?php echo string_limit_words(get_the_excerpt(), 100); ?></p>
<br />
<a class="btn btn-primary" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Read More</a> 
</div>       
<?php }} else { }?>                   
                    
                    
           