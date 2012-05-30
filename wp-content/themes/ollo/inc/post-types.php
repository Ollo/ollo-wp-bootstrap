<?php 
/* 
* Custom Post types for our theme 
*
*/

// sample that needs mod for portfolio post type 

/*
function register_splash_posts() {

	$labels = array(
		'name' => _x('Splash Posts', 'post type general name'),
		'singular_name' => _x('Splash Page', 'post type singular name'),
		'add_new' => _x('Add New', 'Splash Post'),
		'add_new_item' => __('Add New Splash Post'),
		'edit_item' => __('Edit Splash Post'),
		'new_item' => __('New Splash Post'),
		'view_item' => __('View Splash Post'),
		'search_items' => __('Search Splash Post'),
		'not_found' =>  __('No Splash Post Found'),
		'not_found_in_trash' => __('No Splash Post Found In Trash'),
		'parent_item_colon' => ''
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		//'menu_icon' => get_stylesheet_directory_uri() . '/eventicon.png', <- include this line to add custom icons for menu item
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','custom-fields')
	  );

	register_post_type( 'splash' , $args );

}

add_action ('init', 'register_splash_posts');

*/
?>