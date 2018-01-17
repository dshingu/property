<?php

function property_get_images ($post_id, $image_size) {
    
    $images = [];
    
    $data = get_post_meta($post_id, 'property_data', true);
    
    $tmp_array = explode(',', $data['image_ids']);
    
    if (is_array($tmp_array)) {
        
        foreach ($tmp_array as $index => $value) {
            
            $image = wp_get_attachment_image_src($value, $image_size);;
            
            $images[] = $image[0];
            
        }
        
        return $images;
        
    }
    
    return;
    
}