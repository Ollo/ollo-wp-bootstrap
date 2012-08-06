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
                        $args = array( 'post_type' => 'portfolio', 'posts_per_page' =>1, 'orderby' => 'rand');
                    
                        $workPage_query = new WP_Query( $args );
                        while ( $workPage_query->have_posts() ) : $workPage_query->the_post(); ?>
                            <h1 class="heading shadowTextDark"><a href="<?php the_permalink(); ?>">RECENT WORK</a></h1>
                                <h3 class="heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <p><?php print_excerpt(600); ?></p>
                        
                </div>
                <div class="column left">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('homepage-thumb', array('class' => 'featuredImgR')); ?>
                    </a>
                </div>
                    <?php endwhile;  wp_reset_postdata(); ?>    
            </div>
        </div>
    </section>
    <section>
        <div id="homeWords" class="row-fluid">
            <div id="wordsInner" class="inner clearfix">
                <div id="wordMsg" class="column right">
                    <?php
                        $wordargs = array( 'post_type' => 'post', 'posts_per_page' => 1, 'post__in'  => get_option( 'sticky_posts' ),
                        	'ignore_sticky_posts' => 1);
                        
                        $myposts = get_posts( $wordargs );
                        foreach( $myposts as $post ) :	setup_postdata($post); ?>
                            <h1 class="heading shadowTextLight"><a href="<?php the_permalink(); ?>">RECENT WORDS</a></h1>
                            <h3 class="heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p><?php print_excerpt(600); ?></p>
                            
                </div>
                <div class="column left">
                    <?php // the_post_thumbnail( $post->ID, 'homepage-thumb'); ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('homepage-thumb', array('class' => 'featuredImgL')); ?>
                    </a>
                </div>
                        <?php endforeach; ?>
            </div>
        </div>        
    </section>
<?php get_footer(); ?>