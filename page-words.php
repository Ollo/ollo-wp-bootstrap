<?php 
/*
Template Name: Words
*/
get_header();
?>
    <section>
        <div id="content" class="inner clearfix">
            <div class="pageIntro">
                <h1 class="heading">RECENT WORDS</h1>
                <?php
                while ( have_posts() ) : the_post();
                	the_content();
                endwhile; wp_reset_query(); ?>
            </div>
            
            <div id="blogFeed">
                 <?php
                    
                    $paged = get_query_var('paged');                 
                    $args = array( 
                        'posts_per_page'   => 5,
                        'order'         => 'DESC',
                        'ignore_sticky_posts' => true,
                        'paged' => $paged
                    );
                    
                    $wp_query = new WP_Query( $args );
                    while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                 	
                 	<div class="blogPost clearfix">
                 	    <h2 class="heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                 	    <h4 class="heading">Written by : <?php the_author(); ?> on : <?php the_date(); ?></h4>
                 	    <div class="theTags">
                    	    <h4 class="heading left">Tagged in:</h4>
                    	    <?php the_tags('<ul><li class="label">','</li><li class="label">','</li></ul>'); ?>
                        </div>
                        <div class="postContent left">
                 	        <a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
                 	            <?php the_post_thumbnail('thumbnail', array('class' => 'postThumb left')); ?>
                 	        </a>
                 	        <p class="left"><?php print_excerpt(600); ?></p>
                 	        <a class="btn btn-primary left" href="<?php the_permalink(); ?>">Read More</a>
                 	    </div>
                    </div>
                    <hr />
                 <?php endwhile; wp_reset_postdata();?>
                 <div class="navigation">
                     <div class="left"><?php next_posts_link('&laquo; Older Entries') ?></div>
                     <div class="right"><?php previous_posts_link('Newer Entries &raquo;') ?>
                 </div>
         	    
            </div> 
    </section>
<?php get_footer(); ?>