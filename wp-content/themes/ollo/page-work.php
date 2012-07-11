<?php
/*
Template Name: Work
*/

get_header();

?>
    <section id="workPageContent" class="inner">
        <div id="workPageInner" class="clearfix">
            <div class="pageIntro">
                <h1 class="heading">RECENT WORK</h1>
                <?php
                        while ( have_posts() ) : the_post();
                        	the_content();
                        endwhile;

                    // Reset Query
                    wp_reset_query();
                 ?>
             </div>
             <?php   
                // args for the portfolio query 
                $args = array(
                    'post_count' => 9,
                    'post_type' => 'portfolio'
                );
    
                // the query 
                $workPage_query = new WP_Query( $args );

                // The Loop
                while ( $workPage_query->have_posts() ) : $workPage_query->the_post();
                ?>
                <div class="single left">
                    <h3 class="heading workTitle"><?php the_title(); ?></h3>
                    <div class="workThumb">
                        <?php the_post_thumbnail('medium'); ?>                
                    </div>
                </div>
                <?php    
                endwhile;

                // Reset Post Data
                wp_reset_postdata();

                ?>
          </div>  
    </section>
    
<?php get_footer(); ?>