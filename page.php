<?php
/**
 * The template for displaying all pages.
 *
 * @package WordPress
 * @subpackage ollomedia
 */

get_header(); ?>
<div id="content" class="inner">

    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        <div id="content" class="inner">
            <h1 class="heading"><?php the_title(); ?></h1>
            <?php the_content(); ?>

            <?php endwhile; ?>
        </div>
</div>
<?php get_footer(); ?>