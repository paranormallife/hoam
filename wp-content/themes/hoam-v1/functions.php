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

	/* No Widgets */

}
add_action( 'widgets_init', 'asw_widgets_init' );

// Custom Post Types

function asw_register_custom_types() {
	
// FRONT PAGE HEADER/BANNER
register_post_type(
		'homepage_images', array(
			'labels' => array(
				'name' => 'Homepage Images', 
				'singular_name' => 'Homepage Image', 
				'add_new' => 'Add new Homepage Image', 
				'add_new_item' => 'Add new Homepage Image', 
				'new_item' => 'New Homepage Image', 
				'view_item' => 'View Homepage Images',
				'edit_item' => 'Edit Homepage Image',
				'not_found' =>  __('No Homepage Images found'),
				'not_found_in_trash' => __('No Homepage Images found in Trash')
			), 
			'menu_icon' => 'dashicons-camera',
			'public' => true,
			'publicly_queryable' => false,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'page',
			'exclude_from_search' => true, // If this is set to TRUE, Taxonomy pages won't work.
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array('title', 'thumbnail', 'excerpt')
		)
	);

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
			'name' => __( 'Light Blue' ),
			'slug' => 'light-blue',
			'color' => '#D5E2E9',
		),
		array(
			'name' => __( 'Dark Blue' ),
			'slug' => 'dark-blue',
			'color' => '#6B8293',
		),
	) );
	add_theme_support( 'disable-custom-colors' );
	add_theme_support('disable-custom-font-sizes');
}
add_action( 'after_setup_theme', 'mytheme_setup' );

?>