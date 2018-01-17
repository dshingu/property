<?php

/**
 *
 *  Create our property api methods
 *
 **/

function property_api_get($request) {
    
    return $request->get_param('pid');
}