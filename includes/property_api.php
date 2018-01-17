<?php


include('property_api_methods.php');

/**
 *
 *  Register api routes for our plugin
 *
 **/

function property_api() {
    
    register_rest_route('v2', 'property', [
        'method'        => 'GET',
        'callback'      => 'property_api_get'
    ]);
    
    register_rest_route('v2', 'property/(?P<pid>\d+)', [
        'method'        => 'GET',
        'callback'      => 'property_api_get',
        'args'          => [
                                'pid'   => [
                                    'required'  => true
                                ] 
                            ]
    ]);
    
    
}