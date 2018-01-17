<?php

function property_plugin_activate(){
    
    if( version_compare( get_bloginfo('version'), '4.2', '<') ){
        wp_die( __('You must update Wordpress to use this plugin', 'recipe') );
    }
    
    global $property_category;
    
    // Create Property Parent Category
    $featured_category = wp_create_category('Featured Property');
    $property_category = wp_create_category('Parish');
    
    // Options from datasource if exists
    
    $options = get_option('property_options');
    
    // Create Options, if not exists
    
    if( !$options ){
    
        $options = [
            'cluster'       => false,
            'marker_icon'   => '',
            'api'           => '',
            'parent_cat'    => $property_category,
            'featured_cat'  => $featured_category
        ];
        
        add_option('property_options', $options);
    
    }
    
    // Define child categories for our properties post type
    
    $parishes = [
        'Kingston',
        'St. Andrew',
        'Portland',
        'St. Thomas',
        'St. Catherine',
        'St. Mary',
        'St. Ann',
        'Manchester',
        'Clarendon',
        'Hanover',
        'Westmoreland',
        'St. James',
        'Trelawny',
        'St. Elizabeth'
    ];
    
    
    
    array_walk( $parishes, 'create_property_categories' );
    
    // Create our interactive map page
    
    global $user_ID;
    
    $new_post = [
        'post_title' => 'Interactive Map',
        'post_content' => 'Some text',
        'post_status' => 'publish',
        'post_date' => date('Y-m-d H:i:s'),
        'post_author' => $user_ID,
        'post_type' => 'page',
        'post_category' => array(0)
    ];
    
    $post_id = wp_insert_post($new_post);
    
    if ( !$post_id ) {
        
        wp_die('Error creating template page');
        
    } else {
        
        update_post_meta($post_id, '_wp_page_template', 'interactive-map.php');
        
    }
    
}

function create_property_categories( &$parish ){
    
    global $property_category;
    
    wp_create_category( $parish, $property_category );
    
}