<?php
/**
 * Plugin Name: Guestbook Revival
 * Description: Makes your WordPress site web-1.0-compliant.
 * Author: Julien Desrosiers
 * Text Domain: guestbook-revival
 * Domain Path: /languages
 * License: GPLv2
 */

defined( 'ABSPATH' ) or die( 'I got your IP, and I just called the cops.' );

// Register Custom Taxonomy
function gbr_register_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Guestbook Tags', 'Taxonomy General Name', 'guestbook-revival' ),
		'singular_name'              => _x( 'Guestbook Tag', 'Taxonomy Singular Name', 'guestbook-revival' ),
		'menu_name'                  => __( 'Guestbook Tag', 'guestbook-revival' ),
		'all_items'                  => __( 'All Guestbook Tags', 'guestbook-revival' ),
		'parent_item'                => __( 'Parent Guestbook Tag', 'guestbook-revival' ),
		'parent_item_colon'          => __( 'Guestbook Tag:', 'guestbook-revival' ),
		'new_item_name'              => __( 'New Guestbook Tag Name', 'guestbook-revival' ),
		'add_new_item'               => __( 'Add New Guestbook Tag', 'guestbook-revival' ),
		'edit_item'                  => __( 'Edit Guestbook Tag', 'guestbook-revival' ),
		'update_item'                => __( 'Update Guestbook Tag', 'guestbook-revival' ),
		'view_item'                  => __( 'View Guestbook Tag', 'guestbook-revival' ),
		'separate_items_with_commas' => __( 'Separate tags with commas', 'guestbook-revival' ),
		'add_or_remove_items'        => __( 'Add or remove Guestbook Tag', 'guestbook-revival' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'guestbook-revival' ),
		'popular_items'              => __( 'Popular Guestbook Tags', 'guestbook-revival' ),
		'search_items'               => __( 'Search Guestbook Tags', 'guestbook-revival' ),
		'not_found'                  => __( 'Not Found', 'guestbook-revival' ),
		'no_terms'                   => __( 'No guestbook tags', 'guestbook-revival' ),
		'items_list'                 => __( 'Guestbook tags list', 'guestbook-revival' ),
		'items_list_navigation'      => __( 'Guestbook Tags list navigation', 'guestbook-revival' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'update_count_callback'      => 'gbr_taxonomy_update_count_callback',
		'show_in_rest'               => false,
	);
	register_taxonomy( 'gbr_guestbook_tag', array( 'guestbook_entry' ), $args );

}
add_action( 'init', 'gbr_register_taxonomy', 0 );

// Register Custom Post Type
function gbr_register_post_type() {

	$labels = array(
		'name'                  => _x( 'Guestbook Entries', 'Post Type General Name', 'guestbook-revival' ),
		'singular_name'         => _x( 'Guestbook Entry', 'Post Type Singular Name', 'guestbook-revival' ),
		'menu_name'             => __( 'Guestbook Entries', 'guestbook-revival' ),
		'name_admin_bar'        => __( 'Guestbook Entry', 'guestbook-revival' ),
		'archives'              => __( 'Guestbook Entry Archives', 'guestbook-revival' ),
		'attributes'            => __( 'Guestbook Entry Attributes', 'guestbook-revival' ),
		'parent_item_colon'     => __( 'Parent Guestbook Entry:', 'guestbook-revival' ),
		'all_items'             => __( 'All Guestbook Entries', 'guestbook-revival' ),
		'add_new_item'          => __( 'Add New Guestbook Entry', 'guestbook-revival' ),
		'add_new'               => __( 'Add New', 'guestbook-revival' ),
		'new_item'              => __( 'New Guestbook Entry', 'guestbook-revival' ),
		'edit_item'             => __( 'Edit Guestbook Entry', 'guestbook-revival' ),
		'update_item'           => __( 'Update Guestbook Entry', 'guestbook-revival' ),
		'view_item'             => __( 'View Guestbook Entry', 'guestbook-revival' ),
		'view_items'            => __( 'View Guestbook Entries', 'guestbook-revival' ),
		'search_items'          => __( 'Search Guestbook Entry', 'guestbook-revival' ),
		'not_found'             => __( 'Not found', 'guestbook-revival' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'guestbook-revival' ),
		'featured_image'        => __( 'Featured Image', 'guestbook-revival' ),
		'set_featured_image'    => __( 'Set featured image', 'guestbook-revival' ),
		'remove_featured_image' => __( 'Remove featured image', 'guestbook-revival' ),
		'use_featured_image'    => __( 'Use as featured image', 'guestbook-revival' ),
		'insert_into_item'      => __( 'Insert into guestbook entry', 'guestbook-revival' ),
		'uploaded_to_this_item' => __( 'Uploaded to this guestbook entry', 'guestbook-revival' ),
		'items_list'            => __( 'Guestbook Entries list', 'guestbook-revival' ),
		'items_list_navigation' => __( 'Guestbook Entries list navigation', 'guestbook-revival' ),
		'filter_items_list'     => __( 'Filter guestbook entries list', 'guestbook-revival' ),
	);
	$args = array(
		'label'                 => __( 'Guestbook Entry', 'guestbook-revival' ),
		'description'           => __( 'A message someone left into our guestbook.', 'guestbook-revival' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor' ),
		'taxonomies'            => array( 'gbr_guestbook_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 25,
		'menu_icon'             => 'dashicons-book',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => false,
	);
	register_post_type( 'guestbook_entry', $args );

}
add_action( 'init', 'gbr_register_post_type', 0 );