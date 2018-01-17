<?php

function manage_property_columns( $columns ){
    
    $new_columns = [];
    
    $new_columns['cb']          = '<input type="checkbox" />';
    $new_columns['title']       = __('Title', 'property');
    $new_columns['parish']      = __('Parish', 'property');
    $new_columns['author']      = __('Author', 'property');
    $new_columns['date']        = __('Date', 'property');
    
    return $new_columns;
    
}

function manage_property_columns_value( $column_name, $id ){
    
    switch( $column_name ){
        
        case 'parish':
            
           $category = get_the_category( $id );
          echo $category[0]->name;
            
        break;
    
        default:
        break;
        
    }
    
}