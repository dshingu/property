<?php

function save_property_admin($post_id, $post, $update){
    if( !$update ){
        return;
    }
    
    if( isset($_GET['action']) && ( $_GET['action'] == 'trash' || $_GET['action'] == 'untrash' )){
        
        return;
        
    }
    

    $property_data = [];

    $property_data['latitude']          = sanitize_text_field( $_POST['property_latitude'] );
    $property_data['longitude']         = sanitize_text_field( $_POST['property_longitude'] );
    $property_data['address']           = sanitize_text_field( $_POST['property_address'] );
    $property_data['location']          = sanitize_text_field( $_POST['property_location'] );
    $property_data['amenities']         = sanitize_text_field( $_POST['property_amenities'] );
    $property_data['image_ids']         = sanitize_text_field( $_POST['property_gallery_image_ids'] );
    $property_data['available_units']   = sanitize_text_field( $_POST['property_available_units'] );
    $property_data['total_sqft']        = sanitize_text_field( $_POST['property_total_sqft'] );
    $property_data['type']              = sanitize_text_field( $_POST['property_type'] );
    $property_data['occupancy']         = sanitize_text_field( $_POST['property_occupancy'] );
    
    update_post_meta( $post_id, 'property_data', $property_data );
    
}


function save_property_setting(){

    $option = get_option('property_options');
    
    $option['marker_icon']  = $_POST['property_marker_icon'];
    $option['api']          =  $_POST['property_google_map_api'];
    $option['cluster']      = 0;
    
    if( isset($_POST['property_cluster']) ){
        
        $option['cluster'] = 1;
        
    }
    
    update_option('property_options', $option);
    
    wp_redirect( $_POST['_wp_http_referer'] );
    
}