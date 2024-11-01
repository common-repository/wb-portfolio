<?php
// Custom Post Type Setup
function wbportfolio_post_type() {
	$labels = array(
		'name' => __('All Portfolios', 'wb-Portfolio'),
		'singular_name' => __('WB Portfolio', 'wb-Portfolio'),
		'add_new' => __('Add New Portfolio', 'wb-Portfolio'),
		'all_items' => __('All Portfolios', 'wb-Portfolio' ),
		'add_new_item' => __('Add New Portfolio', 'wb-Portfolio'),
		'edit_item' => __('Edit Portfolio', 'wb-Portfolio'),
		'new_item' => __('New Portfolio', 'wb-Portfolio'),
		'view_item' => __('View Portfolio', 'wb-Portfolio'),
		'search_items' => __('Search Portfolio', 'wb-Portfolio'),
		'not_found' => __('No Portfolio', 'wb-Portfolio'),
		'not_found_in_trash' => __('No Portfolio found in Trash', 'wb-Portfolio'),
		'parent_item_colon' => '',
		'menu_name' => __('WB Portfolio', 'wb-Portfolio') // this name will be shown on the menu
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'page',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => 5,
		'menu_icon' =>'dashicons-portfolio',
		'supports' => array('title','editor','thumbnail', 'page-attributes')
	);
	register_post_type('wbportfolio', $args);
}
 add_action( 'init', 'wbportfolio_post_type' );

// Adding a taxonomy for the Portfolio post type

function wbportfolio_taxonomy() {
	  $args = array('hierarchical' => true);
		register_taxonomy( 'wbportfolio_category', 'wbportfolio', $args );
	}
 add_action( 'init', 'wbportfolio_taxonomy', 0 );
