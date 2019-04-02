<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- SITE META -->
<title><?php bloginfo('name'); ?> <?php wp_title(' | ', true, 'left'); ?></title>
<?php if(get_option('reedwan_feedburner')): ?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php echo get_option('reedwan_feedburner'); ?>" /> 
<?php endif; ?>
<?php if(get_option('reedwan_favicon')): ?>
<link rel="shortcut icon" href="<?php echo get_option('reedwan_favicon'); ?>" />
<?php endif; ?>

    <!-- FAVICONS -->
    <link rel="shortcut icon" href="<?php bloginfo("template_url"); ?>/<?php bloginfo("template_url"); ?>/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo("template_url"); ?>/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo("template_url"); ?>/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo("template_url"); ?>/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo("template_url"); ?>/css/colors.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo("template_url"); ?>/css/custom.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo("template_url"); ?>/style.css">
        <link rel="stylesheet" type="text/css" href="<?php bloginfo("template_url"); ?>/css/nusantara.css">
         <link rel="stylesheet" type="text/css" href="<?php bloginfo("template_url"); ?>/css/jquery.slide.css">



    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<?php wp_head(); ?>
</head>
<body>

    <!-- PRELOADER -->
        <div class="cssload-container">
            <div class="cssload-loader"></div>
        </div>
    <!-- end PRELOADER -->
    
    <!-- START SITE -->
        <div id="wrapper">
            <div class="topbar">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 center-xs">
                            <p class="topbar-text">
                           <?php echo get_option('reedwan_header_phone'); ?> 
                               
                            </p>
                        </div><!-- end col -->

                        <div class="col-md-6 col-sm-12 center-xs text-right">
                                <ul class="list-inline social-small">
                                      <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('icons')): endif;?>
                                </ul>
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->
                </div><!-- end container -->
            </div><!-- end topbar -->

            <header class="header">
                <div class="container-fluid">
                    <nav class="navbar navbar-default yamm">
                        <div class="container">
                            <div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
</button>                   
<a class="navbar-brand" title="" href="index.html">  <?php if(get_option('reedwan_header_logo')) { $logo = get_option('reedwan_fheader_logo');} else { $logo = get_template_directory_uri() . '/images/logo.png';	 } ?></a>
<a class="navbar-brand" href='<?php echo home_url(); ?>'><img src="<?php echo $logo; ?>" alt="<?php bloginfo('name'); ?>"  class="img-responsive"/></a>
  
                            </div>
                            <!-- end navbar header -->



 <?php
        wp_nav_menu( 
            array(
                'menu'              => 'primary',
                'theme_location'    => 'primary',
                'depth'             => 2,
                'container'         => 'div',
                'container_class'   => 'navbar-collapse collapse',
                'container_id'      => 'navbar',
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
            )
        );
?>
 
 
 
 
                            <!--/.nav-collapse -->
                        </div>
                        <!--/.container-fluid -->
                    </nav>
                    <!-- end nav -->
                </div>
                <!-- end container -->
            </header>
            <!-- end header -->



          