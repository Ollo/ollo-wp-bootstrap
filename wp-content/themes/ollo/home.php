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
    <div id="homeWork" class="row-fluid">
        <div id="workInner" class="span10 clearfix">
            <div id="workMsg" class="left span4">
                <h1>RECENT WORK</h1>
                <p>Donec sed odio dui. Sed posuere consectetur est at lobortis. Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Aenean lacinia bibendum nulla sed consectetur.

                Cras justo odio, dapibus ac facilisis in, egestas eget quam. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Maecenas sed diam eget risus varius blandit sit amet non magna. Donec sed odio dui. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.

                Donec id elit non mi porta gravida at eget metus. Nullam quis risus eget urna mollis ornare vel eu leo. Nullam quis risus eget urna mollis ornare vel eu leo. Maecenas faucibus mollis interdum. Nullam quis risus eget urna mollis ornare vel eu leo.

                Cras justo odio, dapibus ac facilisis in, egestas eget quam. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Nullam id dolor id nibh ultricies vehicula ut id elit. Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit sit amet non magna. Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
            </div>
    
            <?php 
                $args = array(
                    'post_count' => 5,
                    'post_type' => 'portfolio'
                );
    
                // the query 
                $work_query = new WP_Query( $args );

                // The Loop
                while ( $work_query->have_posts() ) : $work_query->the_post();
                ?>     
                    <div id="workSlider" class="carousel slide span5 right">
                      <!-- Carousel items -->
                      <div class="carousel-inner">
                        <div class="active item">…</div>
                        <?php echo get_the_post_thumbnail(); ?>
                        <div class="carousel-caption">
                            <h4><?php the_title(); ?></h4>
                            <p><?php the_excerpt(); ?></p>
                        </div>
                      </div>
                      <!-- Carousel nav -->
                      <a class="carousel-control left" href="#workSlider" data-slide="prev">&lsaquo;</a>
                      <a class="carousel-control right" href="#workSlider" data-slide="next">&rsaquo;</a>
                    </div>
            
            
                <?php    
                endwhile;

                // Reset Post Data
                wp_reset_postdata();

              ?>
        </div>
    </div>
    
    <div id="homeWords">
        
    </div>
</div>















<?php get_footer(); ?>