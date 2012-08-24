<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package WordPress
 * @subpackage ollomedia
 */

get_header(); ?>
<div id="content" class="inner">

				<h1><?php
					printf( __( 'Tagged =  %s', 'ollomedia' ), '' . single_tag_title( '', false ) . '' );
				?></h1>

<?php
 get_template_part( 'loop', 'tag' );
?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>