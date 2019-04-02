<div class="section footer">
                <div class="container">
                    <div class="row">
                     <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer')): endif;?>

                        <div class="col-md-4 col-sm-12">
                            <div class="widget clearfix">
                                <div class="widget-title">
                                <?php if(get_option('reedwan_footer_logo')) { $logo = get_option('reedwan_footer_logo');} else { $logo = get_template_directory_uri() . '/images/logo.png';	 } ?>
                                <a href='<?php echo home_url(); ?>'><img class="flogo" src="<?php echo $logo; ?>" alt="<?php bloginfo('name'); ?>" /></a>
                                </div>
                                
                                <div class="text-widget">   
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 1')): endif;?>
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('icons')): endif;?>
                                </div>
                            </div>
                        </div>
                        
                    </div><!-- end row -->
                </div><!-- end container -->
</div><!-- end footer -->

            <div id="sitefooter-wrap" class="stickyfooter">
                <div id="sitefooter" class="container">
                    <div id="copyright" class="row">
                        <div class="col-md-6 col-sm-12 text-left">
                            <p>Copyright &copy; 2019 <a href="<?php bloginfo('home'); ?>"><?php bloginfo('name'); ?></a> - <?php bloginfo('description'); ?>.</p>
                        </div>
                        
                        <div class="col-md-6 col-sm-12">
<?php  wp_nav_menu(  array('menu'   => 'menufooter', 'theme_location'    => 'menufooter','menu_class' => 'list-inline text-right',) ); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dmtop"><i class="fa fa-angle-up"></i></div>

            <!-- /.modal -->
        </div><!-- end wrapper -->
    <!-- /END SITE -->






    <!-- ******************************************
    DEFAULT JAVASCRIPT FILES
    ********************************************** -->
    <script src="<?php bloginfo("template_url"); ?>/js/jquery.js"></script>
    <script src="<?php bloginfo("template_url"); ?>/js/bootstrap.min.js"></script>
    <script src="<?php bloginfo("template_url"); ?>/js/all.js"></script>
    <script src="<?php bloginfo("template_url"); ?>/js/custom.js"></script>


   <!-- ******************************************
    ADD YOUR CUSTOM JAVASCRIPT FILES HERE
    ********************************************** -->
    <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
    <!-- MAP & CONTACT -->
    <script src="<?php bloginfo("template_url"); ?>/js/map-job.js"></script>
    <script src="<?php bloginfo("template_url"); ?>/js/map-upload.js"></script>


 <script src="<?php bloginfo("template_url"); ?>/js/jquery.slide.js"></script>
    <script type="text/javascript">
      $(function() {
        $('.slide').slide({
          'slideSpeed': 3000,
          'isShowArrow': true,
          'dotsEvent': 'mouseenter',
          'isLoadAllImgs': true
        });
      });
    </script> 

</body>
<?php  wp_footer();	?> 
</html>