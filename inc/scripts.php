<?php

// queue up the scripts 

function registerScripts() {
    
    if(!is_admin()){    
        // kick off the jquery jams 
         wp_deregister_script( 'jquery' );
         wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
         wp_enqueue_script( 'jquery' );
    
        // modernizer for html5 goodnes 
        wp_register_script('modernizer', get_bloginfo('template_directory') .'/js/modernizr.js','jquery','', ''); 
        wp_enqueue_script('modernizer'); 
    
        // the main js file to house local functions 
        wp_register_script('main', get_bloginfo('template_directory') . '/js/main.js','jquery','', '');
        wp_enqueue_script('main');

    	// google font styles 
    	wp_register_style( 'googleFont', 'http://fonts.googleapis.com/css?family=Open+Sans:400,300' );
        wp_enqueue_style( 'googleFont' );     
    }
}

add_action( 'init', 'registerScripts' );

?>