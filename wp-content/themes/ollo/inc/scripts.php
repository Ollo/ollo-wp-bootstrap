<?php

// queue up the scripts 

function registerScripts() {
if(!is_admin()){
    
    // kick off the jquery jams 
     wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
        wp_enqueue_script( 'jquery' );
    
    // modernizer for html5 goodnes 
    wp_register_script('modernizer', get_bloginfo('template_directory') .'/js/modernizr.js','jquery','', 'true'); 
    wp_enqueue_script('modernizer'); 
    
    // google pretify
    wp_register_script('prettyprint', get_bloginfo('template_directory') .'/js/prettify.js','jquery','', 'true'); 
    wp_enqueue_script('prettyprint');

    // bootstrap stuff 
    wp_register_script('carousel', get_bloginfo('template_directory') .'/js/bootstrap-carousel.js','jquery' ,'', 'true'); 
    wp_enqueue_script('carousel');


    // the main js file to house local functions 
    wp_register_script('main', get_bloginfo('template_directory') . '/js/main.js','jquery','', 'true');
    wp_enqueue_script('main');
    
	}
	
	// 

}

add_action( 'init', 'registerScripts' );

?>