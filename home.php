<?php
/*
Template Name: Home
*/
get_header();
?>
    <section id="intro" class="row-fluid">
        <div id="introContent" class="inner">
            <?php
                while ( have_posts() ) : the_post();
                	the_content();
                endwhile; wp_reset_query(); 
            ?>
        </div>
    </section>
    <section>
        <div id="homeWork" class="row-fluid">
            <div id="workInner" class="inner clearfix">
                <div id="workMsg" class="column left">
                    <?php 
                        $args = array( 'pagename' => 'work');
                    
                        $workPage_query = new WP_Query( $args );
                        while ( $workPage_query->have_posts() ) : $workPage_query->the_post(); ?>
                            <h1 class="heading shadowTextDark"><a href="<?php the_permalink(); ?>">RECENT WORK</a></h1>
                            <p><?php print_excerpt(400); ?></p>
                        
                    <?php endwhile;  wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </section>
    
    <section>
        <div id="homeWords" class="row-fluid">
            <div class="inner">
                <div id="wordMsg" class="column right">
                    <h1 class="heading shadowTextLight">RECENT WORDS</h1>
                    <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                </div>
                <div id="workFeatured" class="column right">
                
                </div>
            </div>
        </div>        
    </section>
<?php get_footer(); ?>