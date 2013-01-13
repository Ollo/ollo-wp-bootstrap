<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="wrapper">
 *
 * @package WordPress
 * @subpackage ollomedia
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="msvalidate.01" content="EBF4239AED0E999C24FFA31135708BC2" />
    <title> <?php wp_title( '|', true, 'right' ); ?> </title>

    <link rel="profile" href="http://gmpg.org/xfn/11" />

    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    
    <?php
    	wp_head();
    ?>
    <script type="text/javascript">

      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-6384815-4']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();

    </script>
</head>
<body id="<?php echo basename(get_permalink()); ?>">

	<div id="access" role="navigation" class="navbar navbar-fixed-top">
	    <div class="navbar-inner">
	        <div class="container-fluid">
	            <div id="header" class="inner">
    	            <h1><a class="brand heading" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	    
        		    <?php wp_nav_menu( array( 'container_class' => ' ', 'theme_location' => 'primary', 'menu_class' => 'nav right' ) ); ?>
    		    </div>
    		</div>    
		</div>
	</div>
<div id="wrapper">	
	