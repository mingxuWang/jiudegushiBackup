<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Corbusier
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		
		<div class="footer-wrapper">
		
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer") ) : ?>
		
		<?php endif; ?>
		
		</div>
		
		<div class="site-info">
			
			<div id="site-info-words">
				<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'corbusier' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'corbusier' ), 'WordPress' ); ?></a>
				<span class="sep"> | </span>
				<?php printf( __( 'Theme: %1$s by %2$s.', 'corbusier' ), 'Corbusier', '<a href="http://www.arcimedia.co.uk/">Arcimedia</a>' ); ?>
			</div>
			
		</div><!-- .site-info -->
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
