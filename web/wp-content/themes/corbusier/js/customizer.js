/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );
	// Navigation link text color.
	wp.customize( 'link_textcolor', function( value ) {
		value.bind( function( to ) {
			//$( '.main-navigation a' ).css( { 'color': to } );
			$( '#content a, #content a:visited' ).css( { 'color': to } );
			$( '.main-navigation li:hover > a' ).css( { 'border-bottom-color': to } );
			$( '#secondary a' ).css( { 'color': to } );
			$( '.tagcloud a:hover' ).css( { 'background-color': to } );			
			$( '.tags-links a' ).css( { 'color': to } );
			$( '.comments-link a' ).css( { 'color': to } );
			$( 'button,input[type="button"],input[type="reset"],input[type="submit"]' ).css( { 'background-color': to, 'border-color': to } );
			//$( 'li:hover > a' ).css( { 'color': to } );
			//$( 'li:hover > a' ).css( { 'border-bottom-color': to } );
		} );
	} );
	// Banner height
	wp.customize( 'banner_height', function( value ) {
		value.bind( function( to ) {
			$( '#content' ).css( { 'margin-top': to } );
		} );
	} );
	// Main Content Opacity
	wp.customize( 'main_content_opacity', function( value ) {
		value.bind( function( to ) {
			$( '#content' ).css( { 'opacity': to } );
		} );
	} );
	// Light or dark theme
	wp.customize( 'light_dark', function( value ) {
		value.bind( function( to ) {
			if ( to == 'dark' ) {
				$( 'body, button, input, select, textarea' ).css( { 'color': '#eeeeee' } );
				$( '#masthead' ).css( { 'background-color': '#2A2A2A' } );
				$( '#content' ).css( { 'background-color': '#2A2A2A' } );
				$( '.site-title a, a:visited' ).css( { 'color': '#eeeeee' } );
				$( '.entry-title a, a:visited' ).css( { 'color': '#eeeeee' } );
				$( '.entry-meta a, a:visited' ).css( { 'color': '#eeeeee' } );
				$( '.main-navigation li a, .main-navigation li a:visited' ).css( { 'color': '#eeeeee' } );
				$( '.main-navigation li ul li a, .main-navigation li ul li a:visited' ).css( { 'color': '#eeeeee' } );
				$( '.nav-links a' ).css( { 'color': '#eeeeee' } );
				$( '.cat-links a' ).css( { 'color': '#eeeeee' } );
				$( '.search-field' ).css( { 'color': '#444444' } );
			}
			else {
				$( 'body, button, input, select, textarea' ).css( { 'color': '#444444' } );
				$( '#masthead' ).css( { 'background-color': '#ffffff' } );
				$( '#content' ).css( { 'background-color': '#ffffff' } );
				$( '.site-title a, a:visited' ).css( { 'color': '#555555' } );
				$( '.entry-title a, a:visited' ).css( { 'color': '#555555' } );
				$( '.entry-meta a, a:visited' ).css( { 'color': '#555555' } );
				$( '.main-navigation li a, .main-navigation li a:visited' ).css( { 'color': '#555555' } );
				$( '.main-navigation li ul li a, .main-navigation li ul li a:visited' ).css( { 'color': '#eeeeee' } );
				$( '.nav-links a' ).css( { 'color': '#555555' } );
				$( '.cat-links a' ).css( { 'color': '#555555' } );
				$( '.search-field' ).css( { 'color': '#999999' } );
			}
		} );
	} );
	
} )( jQuery );