<?php

function property_create_metaboxes(){
    add_meta_box('property_location_mb', __('Select Property location:', 'property'),  'property_location_mb', 'property', 'normal', 'high');
    add_meta_box('property_information_mb', __('Property Information:', 'property'),  'property_information_mb', 'property', 'normal', 'high');
    add_meta_box('property_gallery_mb', __('Property Gallery:', 'property'), 'property_gallery_mb', 'property', 'side', 'low');
}