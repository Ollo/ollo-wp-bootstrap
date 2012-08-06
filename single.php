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
    	    <?php $posttags = get_the_tags();
                if ($posttags) {
                    foreach($posttags as $tag) {
                        echo '<span class="label">' . $tag->name . '</span>'; 
                    }
                } 
            ?>
        </div>
        <div class="wpContent">
            <?php the_content(); ?>
        </div>
    	    <?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'ollomedia' ), 'after' => '' ) ); ?>

        <div id="authBio" class="span6 clearfix">
            <?php // If a user has filled out their description, show a bio on their entries ?>
            <div class="left">
        	    <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'ollomedia_author_bio_avatar_size', 100 ) ); ?>
        	</div>
        	<div class="span4">
                <?php if ( get_the_author_meta( 'description' ) ) : ?>
    		        <h3 class="heading"><?php printf( esc_attr__( 'Who is %s', 'ollomedia' ), get_the_author() ); ?></h3>
    		        <?php the_author_meta( 'description' ); ?>
    		        <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
    		        <?php printf( __( 'See All Posts', 'ollomedia' ), get_the_author() ); ?>
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