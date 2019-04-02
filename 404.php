<?php get_header(); ?>
<?php include_once('includes/slider-content.php'); ?>
    <div class="section lb">
        <div class="container">
            <div class="row">
                <div class="content col-md-8"> 
                  
    <h1 class="text-center">
    <?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'ultrabootstrap' ); ?>
    </h1>
    
    <div class="<?php echo $class;?> detail-content">
    <div class="not-found">
    <p class="text-center"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'ultrabootstrap' ); ?></p>
     <?php get_search_form(); ?>
    </div>
    </div>
 
                </div>
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
<?php get_footer(); ?>      