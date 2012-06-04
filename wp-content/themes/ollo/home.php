<?php
/*
Template Name: Home
*/

get_header();

?>

<div id="content" class="container-fluid">
    <div id="intro">
    <?php

        // The Query
        query_posts();

            // The Loop
            while ( have_posts() ) : the_post();
            	the_content();
            endwhile;

        // Reset Query
        wp_reset_query();

    ?>
    </div>
    <div id="homeWork">
    <?php 
        $args = array(
            
        );
    
        // the query 
        $work_query = new WP_Query( $args );

        // The Loop
        while ( $work_query->have_posts() ) : $work_query->the_post();
            
            
            
            
            
        endwhile;

        // Reset Post Data
        wp_reset_postdata();

      ?>
    </div>
    
    <div id="homeWords">
        
    </div>
</div>















<?php get_footer(); ?>