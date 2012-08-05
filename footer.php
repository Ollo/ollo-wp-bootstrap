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
            <div class="credits left heading">
		        <a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a> 
		        is Proudly Powered by <a href="http://wordpress.org" title="the semantic publishing platform">WordPress</a> 
		        and <a href="" title="">Twitter Bootstrap</a>
		    </div>
		    
		    <ul id="social" class="right">
		        <li><a href="http://twitter.com/pdxollo" target="_blank" class="twitter btnHover" title="Twitter Feed for updates"></a></li>
            	<li><a href="https://forrst.com/people/Ollo" class="forrst btnHover" target="_blank" title="Forrst Development and Design Community"></a></li>
            	<li><a href="http://www.linkedin.com/in/pdxollo" class="linkedin btnHover" target="_blank" title="LinkedIn Professional Profile"></a></li>
            	<li><a href="https://github.com/ollo" class="github btnHover" target="_blank" title="Github Projects"></a></li>		        
		    </ul>
		</div>
    </section>
<?php

	wp_footer();
?>
</body>
</html>