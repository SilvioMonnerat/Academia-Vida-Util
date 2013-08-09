<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>"  />
<title><?php if (is_home () ) { bloginfo('name'); echo " - "; bloginfo('description'); 
} elseif (is_category() ) {single_cat_title(); echo " - "; bloginfo('name');
} elseif (is_single() || is_page() ) {single_post_title(); echo " - "; bloginfo('name');
} elseif (is_search() ) {bloginfo('name'); echo " search results: "; echo wp_specialchars($s);
} else { wp_title('',true); }?></title>
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
<meta name="robots" content="follow, all" />
<?php $favico = get_option('ezine_custom_favicon');?>
<link rel="shortcut icon" href="<?php echo ($favico) ? $favico : get_bloginfo('template_directory').'/images/favicon.ico';?>"/>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" /> 
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" /> 
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" /> 
<?php wp_head(); ?>

<!--[if lt IE 8]>
  <style>ul.subscribenews li a { float: left;}</style>
<![endif]-->
<!-- Stylesheets End //-->
      <?php
      $nivo_transition = get_option('ezine_nivo_transition');
      $nivo_slices = get_option('ezine_nivo_slices');
      $nivo_animspeed = get_option('ezine_nivo_animspeed');
      $nivo_pausespeed = get_option('ezine_nivo_pausespeed');
      $nivo_directionNav = get_option('ezine_nivo_directionNav');
      $nivo_directionNavHide = get_option('ezine_nivo_directionNavHide');
      $nivo_controlNav = get_option('ezine_nivo_controlNav');  
      ?>
      <script type="text/javascript">
        jQuery(window).load(function($) {
          jQuery('#nivoslider').nivoSlider({
            effect:'<?php echo ($nivo_transition) ? $nivo_transition : "random";?>',
            slices:<?php echo ($nivo_slices) ? $nivo_slices : "15";?>,
            animSpeed:<?php echo ($nivo_animspeed) ? $nivo_animspeed : "500";?>, 
            pauseTime:<?php echo ($nivo_pausespeed) ? $nivo_pausespeed : "3000";?>,
            directionNav:<?php echo ($nivo_directionNav) ? $nivo_directionNav : "true";?>,
            directionNavHide:<?php echo ($nivo_directionNavHide) ? $nivo_directionNavHide : "true";?>,
            controlNav:<?php echo ($nivo_controlNav) ? $nivo_controlNav : "true";?>
          });
        });
        </script> 
<!--
<noscript>
<style type="text/css">#slideshow {display:none;}</style>
</noscript>
-->
</head>
<body>
  <div id="headerbar"></div>
  <!-- Page Wrapper -->
  <div id="wrapper" class="wrapper">
    <!-- Header -->
    <div id="header">
      <div class="headerleft grid_3">
        <!-- Logo -->
        <div id="logo">
          <div class="logo">
          <?php $logo_url  = get_option('ezine_logo');?>
            <a href="<?php bloginfo('url');?>"><img src="<?php if ($logo_url != "") {echo $logo_url;} else { echo bloginfo('template_directory').'/images/logo.png';}?>" alt="<?php bloginfo('blogname');?>" /></a>
          </div>
        </div>
        <!-- Logo End -->
      </div>
      <div class="headerright grid_13">
        <!-- Main Navigation -->
        <div id="menupages">
          <div id="myslidemenu" class="jqueryslidemenu">
          <!-- Main menu with short description Start //-->
            <?php
              if (function_exists('wp_nav_menu')) { 
                wp_nav_menu( array('container_id'=>'','menu_id'=>'', 'menu_class' => '', 'theme_location' => 'topnav','fallback_cb'=>'ezine_topmenu_pages','sort_column' => 'menu_order', 'walker' => new description_walker()
 ) );
              } else {  
                ezine_topmenu_pages();
              } ?>          
            <!-- Main menu with short description End  //-->
          </div>
        </div>
        <!-- Main Navigation End -->
        <div class="clear"></div>
        <!-- Slogan -->
        <div id="sitetag" class="grid_13">
          <h1><?php bloginfo('description');?></h1>
        </div>
        <!-- Slogan End -->
        
        <!-- Breadcrumbs -->
          <?php if (function_exists('ezine_breadcrumbs')) ezine_breadcrumbs();?>
        <!-- Breadcrumbs End -->
                
      </div>      
      <div class="clear"></div>      
    </div>
    <!-- Header End -->
    <div class="clear"></div>
    