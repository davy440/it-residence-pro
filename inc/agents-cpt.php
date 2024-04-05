<?php
/**
 *
 *  Regsiter Agents Custom Post Type
 *
 */

function itlst_agent_cpt() {

	$labels = array(
		'name'                  => _x( 'Agents', 'Post Type General Name', 'it-listings' ),
		'singular_name'         => _x( 'Agent', 'Post Type Singular Name', 'it-listings' ),
		'menu_name'             => __( 'Agents', 'it-listings' ),
		'name_admin_bar'        => __( 'Agent', 'it-listings' ),
		'archives'              => __( 'Agent Archives', 'it-listings' ),
		'attributes'            => __( 'Agent Attributes', 'it-listings' ),
		'parent_item_colon'     => __( 'Parent Agent:', 'it-listings' ),
		'all_items'             => __( 'All Agents', 'it-listings' ),
		'add_new_item'          => __( 'Add New Agent', 'it-listings' ),
		'add_new'               => __( 'Add New', 'it-listings' ),
		'new_item'              => __( 'New Agent', 'it-listings' ),
		'edit_item'             => __( 'Edit Agent', 'it-listings' ),
		'update_item'           => __( 'Update Agent', 'it-listings' ),
		'view_item'             => __( 'View Agent', 'it-listings' ),
		'view_items'            => __( 'View Agents', 'it-listings' ),
		'search_items'          => __( 'Search Agent', 'it-listings' ),
		'not_found'             => __( 'Not found', 'it-listings' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'it-listings' ),
		'featured_image'        => __( 'Featured Image', 'it-listings' ),
		'set_featured_image'    => __( 'Set featured image', 'it-listings' ),
		'remove_featured_image' => __( 'Remove featured image', 'it-listings' ),
		'use_featured_image'    => __( 'Use as featured image', 'it-listings' ),
		'insert_into_item'      => __( 'Insert into Agent', 'it-listings' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Agent', 'it-listings' ),
		'items_list'            => __( 'Items list', 'it-listings' ),
		'items_list_navigation' => __( 'Agents list navigation', 'it-listings' ),
		'filter_items_list'     => __( 'Filter agents list', 'it-listings' ),
	);
	$args = array(
		'label'                 => __( 'Agent', 'it-listings' ),
		'description'           => __( 'Agents Custom Post Type', 'it-listings' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'custom-fields', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-businessperson',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'agent', $args );

}
add_action( 'init', 'itlst_agent_cpt', 0 );
