<?php

function property_init(){
    
    $labels = array(
		'name'               => __( 'Properties', 'property' ),
		'singular_name'      => __( 'Property', 'property' ),
		'menu_name'          => __( 'Properties','property' ),
		'name_admin_bar'     => __( 'Property', 'property' ),
		'add_new'            => __( 'Add New', 'property' ),
		'add_new_item'       => __( 'Add New Property', 'property' ),
		'new_item'           => __( 'New Property', 'property' ),
		'edit_item'          => __( 'Edit Property', 'property' ),
		'view_item'          =>  __( 'View Property', 'property' ),
		'all_items'          => __( 'All Properties', 'property' ),
		'search_items'       => __( 'Search Properties', 'property' ),
		'parent_item_colon'  => __( 'Parent Properties:', 'property' ),
		'not_found'          => __( 'No properties found.', 'property' ),
		'not_found_in_trash' => __( 'No properties found in Trash.', 'property' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'A custom post type for propertiess', 'property' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => [ 'slug' => 'property' ],
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'menu_icon'			 => 'dashicons-location-alt',
		'supports'           => [ 'title', 'author', 'excerpt', 'comments' ],
        'taxonomies'         => [ 'category' ]
	);
    
    register_post_type( 'property', $args );
    
}