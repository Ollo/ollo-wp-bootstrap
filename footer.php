<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage ollomedia
 */
?>
</div><!-- close wrapper -->
    <div class="push"></div>
    <section id="footer">        
        <div id="footerText" class="inner clearfix">
		    <a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a> is Proudly Powered by <a href="http://wordpress.org" title="the semantic publishing platform">WordPress</a> and <a href="" title="">Twitter Bootstrap</a>
		    
		    <ul id="social" class="right">
		        <li><a href="#" class="twitter" title="Twitter"></a></li>
            	<li><a href="#" class="forrst" title="Forrst"></a></li>
            	<li><a href="#" class="linkedin" title="LinkedIn"></a></li>
            	<li><a href="#" class="feed" title="RSS Feed"></a></li>		        
		    </ul>
		</div>
    </section>
<?php

	wp_footer();
?>
</body>
</html>