<?php 
/* 
* Custom Post types for our theme 
*
*/
function register_portfolio_posts() {

	$labels = array(
		'name' => _x('Portfolio Posts', 'post type general name'),
		'singular_name' => _x('Portfolio Page', 'post type singular name'),
		'add_new' => _x('Add New', 'Portfolio Post'),
		'add_new_item' => __('Add New Portfolio Post'),
		'edit_item' => __('Edit Portfolio Post'),
		'new_item' => __('New Portfolio Post'),
		'view_item' => __('View Portfolio Post'),
		'search_items' => __('Search Portfolio Post'),
		'not_found' =>  __('No Portfolio Post Found'),
		'not_found_in_trash' => __('No Portfolio Post Found In Trash'),
		'parent_item_colon' => ''
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_position' => 5,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','excerpt'),
		'rewrite' => array('slug' => 'work')
	  );

	register_post_type( 'portfolio' , $args );

}

add_action ('init', 'register_portfolio_posts');

?>