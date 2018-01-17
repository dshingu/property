<?php

function property_admin_init(){
    include('create-metaboxes.php');
    include('property-options.php');
    include('columns.php');
    
    add_action('add_meta_boxes_property', 'property_create_metaboxes');
    add_filter('manage_edit-property_columns', 'manage_property_columns');
    add_action('manage_property_posts_custom_column', 'manage_property_columns_value', 10, 2);
}