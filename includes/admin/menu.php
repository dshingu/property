<?php

function property_setting_menu(){
    
    include('property-setting.php');
    
    add_submenu_page('edit.php?post_type=property', __('Property Settings', 'property'),  __('Settings', 'property'), 'publish_posts', 'property_setting', 'property_setting' );
    
}