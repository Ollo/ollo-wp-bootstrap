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
    <title> <?php wp_title( '|', true, 'right' ); ?> </title>

    <link rel="profile" href="http://gmpg.org/xfn/11" />

    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>

    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php
    	wp_head();
    ?>
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
	