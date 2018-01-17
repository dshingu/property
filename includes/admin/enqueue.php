<?php

function property_admin_enqueue($hook){
    
    $option = get_option('property_options');
    
    wp_register_style('mapster-admin-style', plugins_url('/property/assets/css/mapster.admin.css'));
    
    wp_register_script('property_jquery', '//code.jquery.com/jquery-1.12.4.js');
    wp_register_script('property_jquery_ui', '//code.jquery.com/ui/1.12.1/jquery-ui.js');
    
    if( $option['api'] ){
        
        wp_register_script('property_gMap', '//maps.googleapis.com/maps/api/js?key='.$option['api']);
        
    }else{
        
        wp_register_script('property_gMap', '//maps.googleapis.com/maps/api/js?sensor=false');
        
    }
    wp_register_script('property_gMap', '//maps.googleapis.com/maps/api/js?sensor=false');
    wp_register_script('mapster-list', plugins_url('/property/assets/js/list.js'));
    wp_register_script('mapster', plugins_url('/property/assets/js/Mapster.js'));
    wp_register_script('mapsterui', plugins_url('/property/assets/js/jqueryui.mapster.js'));
    wp_register_script('mapster-admin', plugins_url('/property/assets/js/mapster.back.js'));
    
    if( isset($_GET['page']) && $_GET['page'] == 'property_setting'){
        wp_enqueue_media();
    }
    
    global $post;
    
    if( $hook == 'post-new.php' || $hook == 'post.php' ){
        
        if( $post->post_type == 'property' ){
            wp_register_script('property-gallery-upload', plugins_url('/property/assets/js/property-gallery-upload.js'));
            wp_register_style('property-gallery-upload', plugins_url('/property/assets/css/property-gallery-upload.css'));
            wp_enqueue_style('property-gallery-upload');
            wp_enqueue_script('property-gallery-upload');
        }
        
    }
    
    
    wp_enqueue_style('mapster-admin-style');
    wp_enqueue_script('property_jquery');
    wp_enqueue_script('property_jquery_ui');
    wp_enqueue_script('property_gMap');
    wp_enqueue_script('mapster-list');
    wp_enqueue_script('mapster');
    wp_enqueue_script('mapsterui');
    wp_enqueue_script('mapster-admin');
    
}