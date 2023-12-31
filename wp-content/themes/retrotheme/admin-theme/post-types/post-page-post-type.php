<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}

/* Enable post excerpt */
add_post_type_support( 'page', 'excerpt' );

/* Enable category on page */
function museum_settings() {

	// Add tag metabox to page
	register_taxonomy_for_object_type('post_tag', 'page');

	// Add category metabox to page
	register_taxonomy_for_object_type('category', 'page');
}

add_action( 'init', 'museum_settings' );

function enable_categories_for_island_complex() {
    register_taxonomy_for_object_type('category', 'otok-kompleksni');
}
add_action('init', 'enable_categories_for_island_complex');

function enable_categories_for_island_simple() {
    register_taxonomy_for_object_type('category', 'otok-jednostavni');
}
add_action('init', 'enable_categories_for_island_simple');

function enable_categories_for_region() {
    register_taxonomy_for_object_type('category', 'zupanije');
}
add_action('init', 'enable_categories_for_region');


