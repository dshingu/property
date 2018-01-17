<?php

function property_enqueue(){
    
    $option = get_option('property_options'); 
    
    wp_register_style('interactive-map', plugins_url('/property/assets/css/interactive-map.css'));
    wp_register_style('slick-style', plugins_url('/property/assets/css/slick-theme.css'));
    wp_register_style('slick', plugins_url('/property/assets/css/slick.css'));
    
    wp_register_script('property_jquery', '//code.jquery.com/jquery-1.12.4.js');
    wp_register_script('property_jquery_ui', '//code.jquery.com/ui/1.12.1/jquery-ui.js');
    wp_register_script('slick-script', plugins_url('/property/assets/js/slick.min.js'));
    
    if( $option['api'] ){
        
        wp_register_script('property_gMap', '//maps.googleapis.com/maps/api/js?key='.$option['api']);
        
    }else{
        
        wp_register_script('property_gMap', '//maps.googleapis.com/maps/api/js?key=sensor=false');
        
    }
    
    wp_register_script('mapster-list', plugins_url('/property/assets/js/list.js'));
    wp_register_script('mapster', plugins_url('/property/assets/js/Mapster.js'));
    wp_register_script('mapsterui', plugins_url('/property/assets/js/jqueryui.mapster.js'));
    
    wp_enqueue_style('interactive-map');
    wp_enqueue_style('slick');
    wp_enqueue_style('slick-style');
    wp_enqueue_script('property_jquery');
    wp_enqueue_script('property_jquery_ui');
    wp_enqueue_script('property_gMap');
    wp_enqueue_script('mapster-list');
    wp_enqueue_script('mapster');
    wp_enqueue_script('mapsterui');
    wp_enqueue_script('slick-script');
    
}