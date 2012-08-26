<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package WordPress
 * @subpackage ollomedia
 */

get_header(); ?>

    <div id="content" class="inner">
        <div id="tagView">
                <h1 class="heading"><?php printf( __( 'Tagged in %s', 'ollomedia' ), '' . single_tag_title( '', false ) . '' ); ?></h1>
       <a class="btn btn-primary toTop right" href="<?php bloginfo('url') ?>/words/">Back to Recent Words</a>
                    <?php get_template_part( 'loop', 'tag' ); ?>            		
        </div>
    </div>
    
<?php get_footer(); ?>