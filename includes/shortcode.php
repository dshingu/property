<?php

function property_shortcode(){
    $html = wp_remote_retrieve_body( wp_remote_get(plugins_url('/property/page-template.php')) );
    return $html;
}