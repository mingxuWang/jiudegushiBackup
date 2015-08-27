<?php
/**
 * Corbusier Theme Customizer
 *
 * @package Corbusier
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function corbusier_customize_register( $wp_customize ) {

	
	$wp_customize->add_section( 'theme_options', 
	   array(
	      'title' => __( 'Theme Options', 'corbusier' ), //Visible title of section
	      'priority' => 85, //Determines what order this appears in
	      'capability' => 'edit_theme_options', //Capability needed to tweak
	      'description' => __('Allows you to customize menu settings for Corbusier.', 'corbusier'), //Descriptive tooltip
	   ) 
	);
	
	$wp_customize->add_setting( 'link_textcolor', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
	   array(
		'sanitize_callback' => 'corbusier_sanitize_text',
		'default' => '#ae4b81', //Default setting/value to save
		'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
		'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
		'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
	   ) 
	);      
	      
	$wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
	   $wp_customize, //Pass the $wp_customize object (required)
	   'corbusier_link_textcolor', //Set a unique ID for the control
	   array(
	      'label' => __( 'Link Color', 'corbusier' ), //Admin-visible name of the control
	      'section' => 'theme_options', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
	      'settings' => 'link_textcolor', //Which setting to load and manipulate (serialized is okay)
	      'priority' => 10, //Determines the order this control appears in for the specified section
	   ) 
	) );
	
	
	$wp_customize->add_setting( 'banner_height', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
	   array(
		'sanitize_callback' => 'corbusier_sanitize_text',
		'default' => '350px', //Default setting/value to save
		'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
		'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
		'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
	   ) 
	);      
	
	$wp_customize->add_control(
		new WP_Customize_Control(
		    $wp_customize,
		    'corbusier_banner_height',
		    array(
			'label'          => __( 'Banner height', 'corbusier' ),
			'section'        => 'theme_options',
			'settings'       => 'banner_height',
			'type'           => 'text'
		    )
		)
	    );
	
	
	$wp_customize->add_setting( 'main_content_opacity', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
	   array(
		'sanitize_callback' => 'corbusier_sanitize_text',
		'default' => '0.9', //Default setting/value to save
		'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
		'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
		'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
	   ) 
	);   
	$wp_customize->add_control(
		new WP_Customize_Control(
		    $wp_customize,
		    'corbusier_main_content_opacity',
		    array(
			'label'          => __( 'Main Content Opacity', 'corbusier' ),
			'section'        => 'theme_options',
			'settings'       => 'main_content_opacity',
			'type'           => 'text'
		    )
		)
	    );
	
	$wp_customize->add_setting( 'light_dark', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
	   array(
		'sanitize_callback' => 'corbusier_sanitize_dark_light',
	      'default' => 'light', //Default setting/value to save
	      'type' => 'option', //Is this an 'option' or a 'theme_mod'?
	      'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
	      'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
	   ) 
	);  
	
	$wp_customize->add_control(
		new WP_Customize_Control(
		    $wp_customize,
		    'corbusier_light_dark',
		    array(
			'label'          => __( 'Dark or light theme version?', 'corbusier' ),
			'section'        => 'theme_options',
			'settings'       => 'light_dark',
			'type'           => 'radio',
			'choices'        => array(
				'dark'   => 'Dark',
				'light'  => 'Light'
			)
		    )
		)
	    );
	
	$wp_customize->add_setting( 'favicon', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
	   array(
	      'sanitize_callback' => 'esc_url_raw',
	      'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
	      'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
	      'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
	   ) 
	);  
	
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
		    $wp_customize,
		    'corbusier_favicon',
		    array(
			'label'      => __( 'Upload a favicon', 'corbusier' ),
			'section'    => 'theme_options',
			'settings'   => 'favicon',
			'context'    => 'favicon' 
		    )
		)
	    );
		
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'link_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'banner_height' )->transport = 'postMessage';
	$wp_customize->get_setting( 'main_content_opacity' )->transport = 'postMessage';
	$wp_customize->get_setting( 'light_dark' )->transport = 'postMessage';
}



/**
* This will output the custom WordPress settings to the live theme's WP head.
* 
* Used by hook: 'wp_head'
* 
* @see add_action('wp_head',$func)
* @since MyTheme 1.0
*/


function corbusier_header_output() {
	?>
	
	<link rel="shortcut icon" href="<?php echo get_theme_mod('favicon'); ?>" />
	
	<!--Customizer CSS--> 
	<style type="text/css">
		/*.main-navigation a { color:<?php echo get_theme_mod('link_textcolor'); ?>; }*/
		.main-navigation li:hover > a { color:<?php echo get_theme_mod('link_textcolor'); ?>;border-bottom: 3px solid <?php echo get_theme_mod('link_textcolor'); ?>; }
		
		@media screen and (max-width: 768px) { 
			.main-navigation li:hover > a{
				border-bottom: none;
			} 
		}
		
		#content a, #content a:visited { color:<?php echo get_theme_mod('link_textcolor'); ?>; }
		#secondary a { color:<?php echo get_theme_mod('link_textcolor'); ?>; }
		.tagcloud a:hover { background-color:<?php echo get_theme_mod('link_textcolor'); ?>; }
		.tags-links a { color:<?php echo get_theme_mod('link_textcolor'); ?>; }
		.entry-footer a { color:<?php echo get_theme_mod('link_textcolor'); ?>; }
		.comments-link a { color:<?php echo get_theme_mod('link_textcolor'); ?>; }
		button,input[type="button"],input[type="reset"],input[type="submit"] { background-color:<?php echo get_theme_mod('link_textcolor'); ?>;border-color: <?php echo get_theme_mod('link_textcolor'); ?> }
		li:hover > a { color:<?php echo get_theme_mod('link_textcolor'); ?>; }
		li:hover > a { border-bottom-color:<?php echo get_theme_mod('link_textcolor'); ?>; }
		
		#content { margin-top:<?php echo get_theme_mod('banner_height'); ?>; }
		#content { opacity:<?php echo get_theme_mod('main_content_opacity'); ?>; }
	</style>
	<!--/Customizer CSS-->
	<?php
	//echo 'THEME COLOR = '.get_option('light_dark');
	if ( get_option('light_dark') == 'dark' ) {
		?>
		<style type="text/css">
			#content { background-color: #2A2A2A; }
			#masthead { background-color: #2A2A2A; }
			.site-title a, .site-title a:visited { color: #eeeeee; }
			.entry-title a, .entry-title a:visited { color: #eeeeee; }
			.entry-meta a, .entry-meta a:visited { color: #eeeeee; }
			.main-navigation li a, li a:visited { color: #eeeeee; }
			.main-navigation li ul li a, .main-navigation li ul li a:visited { color: #eeeeee; }
			.nav-links a { color: #eeeeee; }
			.cat-links a { color: #eeeeee; }
			body, button, input, select, textarea { color: #eeeeee; }
			.search-field { color: #444444; }
		</style>
		<?php
		}
	else {
		?>
		<style type="text/css">
			#masthead { background-color: #ffffff; }
			#content { background-color: #ffffff; }
			.site-title a, .site-title a:visited { color: #555555; }
			.entry-title a, .entry-title a:visited { color: #555555; }
			.entry-meta a, .entry-meta a:visited { color: #555555; }
			.main-navigation li a, li a:visited { color: #555555; }
			.main-navigation li ul li a, .main-navigation li ul li a:visited { color: #eeeeee; }		
			.nav-links a { color: #555555; }
			.cat-links a { color: #555555; }
			body, button, input, select, textarea { color: #444444; }
			.search-field { color: #444444; }
		</style>
	<?php
	}
}

function corbusier_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

function corbusier_sanitize_dark_light( $input ) {
    $valid = array(
        'dark'   => 'Dark',
	'light'  => 'Light'
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

add_action( 'customize_register', 'corbusier_customize_register' );

// Output custom CSS to live site
add_action( 'wp_head' , 'corbusier_header_output' );
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function corbusier_customize_preview_js() {
	wp_enqueue_script( 'corbusier_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'corbusier_customize_preview_js' );
