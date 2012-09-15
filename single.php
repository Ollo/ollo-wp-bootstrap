<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage ollomedia
 */

get_header(); ?>

    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <div id="content" class="inner">
    	<h1 class="heading"><?php the_title(); ?></h1>
    	<h4 class="postCreds heading">Posted: <?php the_date();?> By: <?php the_author(); ?></h4>
    	<div class="theTags">
    	    <h4 class="heading left">Tagged in:</h4>
    	    <?php the_tags('<ul><li class="label">','</li><li class="label">','</li></ul>'); ?>
        </div>
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
			<hr />  
        <div id="authBio" class="span6 clearfix">
            <?php // If a user has filled out their description, show a bio on their entries ?>
            <div class="left">
        	    <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'ollomedia_author_bio_avatar_size', 80 ) ); ?>
        	</div>
        	<div class="span4">
                <?php if ( get_the_author_meta( 'description' ) ) : ?>
    		        <h3 class="heading"><?php printf( esc_attr__( 'Who is %s', 'ollomedia' ), get_the_author() ); ?></h3>
    		        <?php the_author_meta( 'description' ); ?>
    		        <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
    		        <?php printf( __( 'More Posts', 'ollomedia' ), get_the_author() ); ?>
    		        </a>
                <?php endif; ?>
            </div>
        </div>
    <div class="clearfix">        
        <div class="left">
		    <?php comments_template( '', true ); ?>
        </div>
        
    </div>
    <?php endwhile; // end of the loop. ?>
    </div>
<?php get_footer(); ?>