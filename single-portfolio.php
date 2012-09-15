<?php
/**
 * The Template for displaying all single portfolio posts.
 *
 * @package WordPress
 * @subpackage ollomedia
 */

get_header(); ?>

    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <div id="content" class="inner">
    	<h1 class="heading"><?php the_title(); ?></h1>
    	<h4 class="postCreds heading">Posted: <?php the_date();?> By: <?php the_author(); ?></h4>
        <div class="wpContent clearfix">
            <?php the_content(); ?>
        </div>
            <hr />
        <div class="clearfix">
            <span class="left">
              <?php previous_post_link( '%link', '' . _x( '&larr;', 'Previous post link', 'ollomedia' ) . ' %title' ); ?>
            </span>
            <span class="right">
              <?php next_post_link( '%link', '%title ' . _x( '&rarr;', 'Next post link', 'ollomedia' ) . '' ); ?>
            </span>
        </div>

    <?php endwhile; // end of the loop. ?>
    </div>
<?php get_footer(); ?>