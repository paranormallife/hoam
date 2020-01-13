<?php

/**
 * @package WordPress
 * @subpackage asw_template
 */

// Thumbnails
add_theme_support('post-thumbnails');



//menus
add_action( 'init', 'register_my_menus' );
function register_my_menus() {
	register_nav_menus(
		array(
			'nav1' => __( 'Main Navigation' )
		)
	);
}


// Register custom post types and taxonomies
function js_init() {
	asw_register_custom_types(); // Register Custom Post Types
	asw_register_taxonomies(); // Register Custom Taxonomies
  }
  
  add_action('init', 'js_init');

// Custom Taxonomies (Should be above Custom Post Types)
function asw_register_taxonomies() {
	
}

function asw_widgets_init() {

	register_sidebar( array(
		'name'          => 'Home Sections',
		'id'            => 'home_sections',
		'before_widget' => '<section class="home-section">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'asw_widgets_init' );

// Custom Post Types

function asw_register_custom_types() {
	
// No custom post types right now.

	flush_rewrite_rules();
}

function mytheme_setup() {
    // Add support for Block Styles
	add_theme_support( 'wp-block-styles' );
	// Add Color Palettes
	add_theme_support( 'editor-color-palette', array(
		array(
			'name' => __( 'Black' ),
			'slug' => 'black',
			'color' => '#000',
		),
		array(
			'name' => __( 'White' ),
			'slug' => 'white',
			'color' => '#FFF',
		),
		array(
			'name' => __( 'Purple' ),
			'slug' => 'purple',
			'color' => 'var(--purple)',
		),
		array(
			'name' => __( 'Gold' ),
			'slug' => 'gold',
			'color' => 'var(--gold)',
		),
	) );
	add_theme_support( 'disable-custom-colors' );
	add_theme_support('disable-custom-font-sizes');
}
add_action( 'after_setup_theme', 'mytheme_setup' );

// Add Widgets
include_once( get_template_directory() . '/widgets/parallax_section.php' );

?>