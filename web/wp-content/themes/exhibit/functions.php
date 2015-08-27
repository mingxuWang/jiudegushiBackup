<?php
/*

 It's not recommended to add functions to this file, as it will be lost if you ever update this child theme.
 Instead, consider adding your function into a plugin using Pluginception: https://wordpress.org/plugins/pluginception/
 
 */
 
if ( function_exists( 'generate_blog_get_defaults' ) ) :
	if ( !function_exists( 'exhibit_new_blog_defaults' ) ) :
		add_filter( 'generate_blog_option_defaults','exhibit_new_blog_defaults' );
		function exhibit_new_blog_defaults()
		{
			$new_defaults = array(
				'excerpt_length' => '55',
				'read_more' => __('Read more...','generate_blog'),
				'masonry' => 'false',
				'masonry_width' => 'width2',
				'masonry_most_recent_width' => 'width4',
				'masonry_load_more' => __('+ More','generate_blog'),
				'masonry_loading' => 'Loading...',
				'post_image' => 'true',
				'post_image_position' => 'post-image-above-header',
				'post_image_alignment' => 'post-image-aligned-center',
				'post_image_width' => '',
				'post_image_height' => '',
				'date' => 'true',
				'author' => 'true',
				'categories' => 'true',
				'tags' => 'true',
				'comments' => 'true'
			);
			
			return $new_defaults;
		}
	endif;
endif;

add_action( 'admin_notices', 'exhibit_reset_customizer_settings' );
function exhibit_reset_customizer_settings() {
	global $pagenow;
	$generate_settings = get_option('generate_settings');
	
	if ( empty($generate_settings) )
		return;
		
	if ( is_admin() && $pagenow == "themes.php" && isset( $_GET['activated'] ) ) {
		echo '<div class="updated below-h2">';
			echo '<p>';
				_e('<strong>Almost done!</strong> Previous GeneratePress options detected in your database. Please <a href="' . admin_url('themes.php?page=generate-options#gen-delete') . '">click here</a> and delete your current options for new to take full effect.','generate');
			echo '</p>';
		echo '</div>';
	}
}

/**
 * Remove unnecessary actions
 */
add_action('wp','exhibit_setup');
function exhibit_setup()
{
	if ( !function_exists( 'generate_blog_get_defaults' ) ) :
		remove_action( 'generate_after_entry_header', 'generate_post_image' );
		
		if ( function_exists('generate_page_header') ) :
			remove_action( 'generate_after_entry_header', 'generate_page_header_post_image' );
			add_action( 'generate_before_content', 'generate_page_header_post_image' );
		endif;
	endif;
}

/**
 * Enqueue scripts and styles
 */
add_action( 'wp_enqueue_scripts', 'exhibit_scripts' );
function exhibit_scripts() {

	// Generate scripts
	wp_enqueue_script( 'stickynav', get_stylesheet_directory_uri() . '/js/scripts.js', array(), GENERATE_VERSION, true );

}

if ( !function_exists( 'exhibit_exhibit_defaults' ) ) :
	add_filter( 'generate_option_defaults','exhibit_exhibit_defaults' );
	function exhibit_exhibit_defaults()
	{
		$exhibit_defaults = array(
			'hide_title' => '',
			'hide_tagline' => '',
			'logo' => '',
			'container_width' => '1220',
			'header_layout_setting' => 'fluid-header',
			'center_header' => 'true',
			'center_nav' => 'true',
			'nav_alignment_setting' => 'center',
			'header_alignment_setting' => 'center',
			'nav_layout_setting' => 'fluid-nav',
			'nav_position_setting' => 'nav-below-header',
			'nav_search' => 'enable',
			'content_layout_setting' => 'separate-containers',
			'layout_setting' => 'right-sidebar',
			'blog_layout_setting' => 'right-sidebar',
			'single_layout_setting' => 'right-sidebar',
			'post_content' => 'full',
			'footer_layout_setting' => 'fluid-footer',
			'footer_widget_setting' => '3',
			'background_color' => '#9e9e9e',
			'text_color' => '#3a3a3a',
			'link_color' => '#1e73be',
			'link_color_hover' => '#222222',
			'link_color_visited' => '',
		);
		
		return $exhibit_defaults;
	}
endif;

/**
 * Set default options
 */
if ( !function_exists( 'exhibit_get_color_defaults' ) ) :
	add_filter( 'generate_color_option_defaults','exhibit_get_color_defaults' );
	function exhibit_get_color_defaults()
	{
		$exhibit_color_defaults = array(
			'header_background_color' => '#222222',
			'header_text_color' => '#ffffff',
			'header_link_color' => '#ffffff',
			'header_link_hover_color' => '#efefef',
			'site_title_color' => '#ffffff',
			'site_tagline_color' => '#bcbcbc',
			'navigation_background_color' => '#ffffff',
			'navigation_text_color' => '#5b5b5b',
			'navigation_background_hover_color' => '#1e72bd',
			'navigation_text_hover_color' => '#ffffff',
			'navigation_background_current_color' => '#1e72bd',
			'navigation_text_current_color' => '#ffffff',
			'subnavigation_background_color' => '#1e72bd',
			'subnavigation_text_color' => '#ffffff',
			'subnavigation_background_hover_color' => '#1e72bd',
			'subnavigation_text_hover_color' => '#2d2d2d',
			'subnavigation_background_current_color' => '#1e72bd',
			'subnavigation_text_current_color' => '#2d2d2d',
			'content_background_color' => '#FFFFFF',
			'content_text_color' => '#3a3a3a',
			'content_link_color' => '',
			'content_link_hover_color' => '',
			'content_title_color' => '',
			'blog_post_title_color' => '#1E72BD',
			'blog_post_title_hover_color' => '#222222',
			'entry_meta_text_color' => '#888888',
			'entry_meta_link_color' => '#666666',
			'entry_meta_link_color_hover' => '#1E72BD',
			'h1_color' => '',
			'h2_color' => '',
			'h3_color' => '',
			'sidebar_widget_background_color' => '#FFFFFF',
			'sidebar_widget_text_color' => '#3a3a3a',
			'sidebar_widget_link_color' => '#686868',
			'sidebar_widget_link_hover_color' => '#1e73be',
			'sidebar_widget_title_color' => '#000000',
			'footer_widget_background_color' => '#ffffff',
			'footer_widget_text_color' => '#222222',
			'footer_widget_link_color' => '',
			'footer_widget_link_hover_color' => '',
			'footer_widget_title_color' => '#222222',
			'footer_background_color' => '#222222',
			'footer_text_color' => '#ffffff',
			'footer_link_color' => '#ffffff',
			'footer_link_hover_color' => '#f5f5f5',
			'form_background_color' => '#FAFAFA',
			'form_text_color' => '#666666',
			'form_background_color_focus' => '#FFFFFF',
			'form_text_color_focus' => '#666666',
			'form_border_color' => '#CCCCCC',
			'form_border_color_focus' => '#BFBFBF',
			'form_button_background_color' => '#666666',
			'form_button_background_color_hover' => '#606060',
			'form_button_text_color' => '#FFFFFF',
			'form_button_text_color_hover' => '#FFFFFF'
		);
		
		return $exhibit_color_defaults;
	}
endif;

/**
 * Set default options
 */
if ( !function_exists('exhibit_get_default_fonts') ) :
	add_filter( 'generate_font_option_defaults','exhibit_get_default_fonts' );
	function exhibit_get_default_fonts()
	{
		$exhibit_font_defaults = array(
			'font_body' => 'Roboto:100,100italic,300,300italic,regular,italic,500,500italic,700,700italic,900,900italic',
			'body_font_weight' => '300',
			'body_font_transform' => 'none',
			'body_font_size' => '16',
			'font_site_title' => 'inherit',
			'site_title_font_weight' => '300',
			'site_title_font_transform' => 'none',
			'site_title_font_size' => '78',
			'font_site_tagline' => 'inherit',
			'site_tagline_font_weight' => '300',
			'site_tagline_font_transform' => 'none',
			'site_tagline_font_size' => '15',
			'font_navigation' => 'inherit',
			'navigation_font_weight' => '300',
			'navigation_font_transform' => 'none',
			'navigation_font_size' => '15',
			'font_widget_title' => 'inherit',
			'widget_title_font_weight' => '300',
			'widget_title_font_transform' => 'none',
			'widget_title_font_size' => '20',
			'widget_content_font_size' => '16',
			'font_heading_1' => 'inherit',
			'heading_1_weight' => '300',
			'heading_1_transform' => 'none',
			'heading_1_font_size' => '40',
			'font_heading_2' => 'inherit',
			'heading_2_weight' => '300',
			'heading_2_transform' => 'none',
			'heading_2_font_size' => '30',
			'font_heading_3' => 'inherit',
			'heading_3_weight' => 'normal',
			'heading_3_transform' => 'none',
			'heading_3_font_size' => '20',
			'font_heading_4' => 'inherit',
			'heading_4_weight' => 'normal',
			'heading_4_transform' => 'none',
			'heading_4_font_size' => '15',
		);
		
		return $exhibit_font_defaults;
	}
endif;

/**
 * Set default options
 */
if ( !function_exists( 'exhibit_get_spacing_defaults' ) ) :
	add_filter( 'generate_spacing_option_defaults','exhibit_get_spacing_defaults' );
	function exhibit_get_spacing_defaults()
	{
		$exhibit_spacing_defaults = array(
			'header_top' => '70',
			'header_right' => '40',
			'header_bottom' => '70',
			'header_left' => '40',
			'menu_item' => '30',
			'menu_item_height' => '60',
			'sub_menu_item_height' => '10',
			'content_top' => '40',
			'content_right' => '40',
			'content_bottom' => '40',
			'content_left' => '40',
			'separator' => '10',
			'left_sidebar_width' => '25',
			'right_sidebar_width' => '25',
			'widget_top' => '40',
			'widget_right' => '40',
			'widget_bottom' => '40',
			'widget_left' => '40',
			'footer_widget_container_top' => '40',
			'footer_widget_container_right' => '0',
			'footer_widget_container_bottom' => '40',
			'footer_widget_container_left' => '0',
			'footer_top' => '20',
			'footer_right' => '0',
			'footer_bottom' => '20',
			'footer_left' => '0',
		);
		
		return $exhibit_spacing_defaults;
	}
endif;

/**
 * Prints the Post Image to post excerpts
 */
if ( ! function_exists( 'exhibit_post_image' ) && !function_exists( 'generate_blog_get_defaults' ) ) :
	add_action( 'generate_before_content', 'exhibit_post_image' );
	function exhibit_post_image()
	{
		if ( !has_post_thumbnail() )
			return;
			
		if ( 'post' == get_post_type() && !is_single() ) {
		?>
			<div class="post-image">
				<a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(); ?></a>
			</div>
		<?php
		}
	}
endif;

/**
 * Add page header above content
 * @since 1.0.2
 */
add_action( 'generate_before_content', 'exhibit_featured_page_header' );
function exhibit_featured_page_header()
{
	if ( function_exists('generate_page_header') )
		return;

	if ( is_page() ) :
		
		generate_featured_page_header_area('page-header-image');
	
	endif;
}

/**
 * Add dynamic CSS
 * @since 0.4
 */
function exhibit_custom_css()
{

	$generate_settings = wp_parse_args( 
		get_option( 'generate_settings', array() ), 
		generate_get_defaults() 
	);

	if ( function_exists( 'generate_spacing_get_defaults' ) ) :
		
		$spacing_settings = wp_parse_args( 
			get_option( 'generate_spacing_settings', array() ), 
			generate_spacing_get_defaults() 
		);
			
	endif;
	
	if ( function_exists( 'generate_blog_get_defaults' ) ) :
		
		$blog_settings = wp_parse_args( 
			get_option( 'generate_blog_settings', array() ), 
			generate_blog_get_defaults() 
		);
			
	endif;
	
	if ( function_exists('generate_spacing_get_defaults') ) :
		$top_padding = $spacing_settings['content_top'];
		$right_padding = $spacing_settings['content_right'];
		$bottom_padding = $spacing_settings['content_bottom'];
		$left_padding = $spacing_settings['content_left'];
		$menu_height = $spacing_settings['menu_item_height'];
	else :
		$top_padding = 40;
		$right_padding = 40;
		$bottom_padding = 40;
		$left_padding = 40;
		$menu_height = 50;
	endif;
	
	$return = '';
		
	if ( function_exists( 'generate_blog_get_defaults' ) ) :
		if ( '' == $blog_settings['post_image_position'] ) :
			$return .= '.separate-containers .post-image, .separate-containers .inside-article .page-header-image-single, .separate-containers .inside-article .page-header-image, .separate-containers .inside-article .page-header-content-single, .no-sidebar .inside-article .page-header-image-single, .no-sidebar .inside-article .page-header-image, article .inside-article .page-header-post-image { margin: ' . $bottom_padding . 'px -' . $right_padding . 'px ' . $bottom_padding . 'px -' . $left_padding . 'px }';
		else :
			$return .= '.separate-containers .post-image, .separate-containers .inside-article .page-header-image-single, .separate-containers .inside-article .page-header-image, .separate-containers .inside-article .page-header-content-single, .no-sidebar .inside-article .page-header-image-single, .no-sidebar .inside-article .page-header-image, article .inside-article .page-header-post-image { margin: -' . $top_padding . 'px -' . $right_padding . 'px ' . $bottom_padding . 'px -' . $left_padding . 'px }';
		endif;
	else :
		$return .= '.separate-containers .post-image, .separate-containers .inside-article .page-header-image-single, .separate-containers .inside-article .page-header-image, .separate-containers .inside-article .page-header-content-single, .no-sidebar .inside-article .page-header-image-single, .no-sidebar .inside-article .page-header-image, article .inside-article .page-header-post-image { margin: -' . $top_padding . 'px -' . $right_padding . 'px ' . $bottom_padding . 'px -' . $left_padding . 'px }';
	endif;
	
	$return .= '.nav-above-header {padding-top: ' . $menu_height . 'px}';
	$return .= '.stickynav.nav-below-header .site-header {margin-bottom: ' . $menu_height . 'px}';
	
	if ( 'contained-nav' == $generate_settings['nav_layout_setting'] ) :
		$return .= '@media screen and (min-width: 768px) { body.stickynav.nav-below-header #site-navigation, body.nav-above-header #site-navigation, body.stickynav.nav-above-header #site-navigation { left: 50%; width: 100%; max-width: ' . $generate_settings['container_width'] . 'px; margin-left: -' . $generate_settings['container_width'] / 2 . 'px; } }';
	endif;
	
	return $return;
}

/**
 * Enqueue scripts and styles
 */
add_action( 'wp_enqueue_scripts', 'exhibit_css', 50 );
function exhibit_css() {
	wp_add_inline_style( 'generate-style', exhibit_custom_css() );
}