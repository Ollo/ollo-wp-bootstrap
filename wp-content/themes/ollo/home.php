<?php
/*
Template Name: Home
*/

get_header();

?>

    <section id="intro" class="row-fluid">
        <div id="introContent" class="inner">
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
    </section>
    <section id="homeWork" class="row-fluid">
        <div id="workInner" class="inner clearfix">
            <div id="workMsg" class="column left">
                <h1 class="heading">RECENT WORK</h1>
                <p>Donec sed odio dui. Sed posuere consectetur est at lobortis. Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Aenean lacinia bibendum nulla sed consectetur.

                Cras justo odio, dapibus ac facilisis in, egestas eget quam. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Maecenas sed diam eget risus varius blandit sit amet non magna. Donec sed odio dui. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
            </div>
            
            <div id="workSlider" class="carousel slide  column right">
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
                      <!-- Carousel items -->
                      <div class="carousel-inner">
                        <div class="item ">
                            <?php the_post_thumbnail('medium'); ?>
                            <div class="carousel-caption">
                                <h4><?php the_title(); ?></h4>
                                <p><?php the_excerpt(); ?></p>
                            </div>
                        </div>
                      </div>
                      <!-- Carousel nav -->
                      <a class="carousel-control left" href="#workSlider" data-slide="prev">&lsaquo;</a>
                      <a class="carousel-control right" href="#workSlider" data-slide="next">&rsaquo;</a>            
                <?php    
                endwhile;

                // Reset Post Data
                wp_reset_postdata();

              ?>
              </div>  
        </div>
    </section>
    
    <section id="homeWords" class="row-fluid">
        <div class="inner">
            <div id="wordMsg" class="column right">
                <h1 class="heading">RECENT WORDS</h1>
                <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            </div>
            <div id="workFeatured" class="column right">
                
            </div>
        </div>        
    </section>

<?php get_footer(); ?>