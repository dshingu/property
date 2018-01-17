<?php

function property_setting(){
    
    $option = get_option('property_options');
    
?>
<div class="wrap">
    <form action="<?php echo get_bloginfo('url'); ?>/wp-admin/admin-post.php" method="post">
        <?php wp_nonce_field(); ?>
        <input type="hidden" name="action" value="save_property_setting" />
        <h1><?php echo __('Property Settings', 'property'); ?></h1>
        <table class="form-table">
            <tr>
                <th scope="row"><label for="property-api"><?php echo __('Google Map API Key', 'property'); ?></label></th>
                <td><input type="text" name="property_google_map_api" id="property-api" value="<?php echo $option['api']; ?>" class="regular-text"/></td>
            </tr>
            <tr>
                <th scope="row"><label for="property-cluster"><?php echo __('Cluster', 'property'); ?></label></th>
                <td>
                    <label for="property-cluster"><input type="checkbox" name="property_cluster" id="property-cluster" <?php echo ($option['cluster']) ? 'checked="checked"' : ''; ?> /> <?php echo __('Enable Marker clustering', 'property'); ?></label>
                    <p class="description"><?php echo __('A nice way of managing large amounts of markers on the map', 'property'); ?></p>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="property-cluster"><?php echo __('Marker Icon', 'property'); ?></label></th>
                <td>
                    <label>
                        <input type="text" name="property_marker_icon" id="property-marker-icon" value="<?php echo $option['marker_icon']; ?>" class="regular-text" />
                        <a class="button" id="browse-for-property-marker">Browse</a>
                        <?php if($option['marker_icon']): ?>
                            <img id="marker-icon-image" src="<?php echo $option['marker_icon']; ?>" width="32" height="32" />
                        <?php endif; ?>
                    </label>
                    <p class="description"><?php echo __('Set your custom marker icon', 'property'); ?></p>
                </td>
            </tr>
        </table>
        <p class="submit"><input type="submit" name="submit" class="button button-primary" value="Submit" /></p>
    </form>
</div>

<script type="text/javascript">
jQuery(document).ready(function(){
    
    jQuery('a#browse-for-property-marker').click(function(e){
    
        var frame = wp.media({
            
                button: {
                    text: 'Insert'
                },
                multiple: false
                
        });
        
        frame.on('select', function(){
           
           var attachment = frame.state().get('selection').first().toJSON();
           var image      = jQuery('img#marker-icon-image');
           
           jQuery('input#property-marker-icon').val(attachment.url);
           
           if ( image.length > 0 ) {
            
            image.attr('src', attachment.url );
            
           }else{
            
            jQuery('a#browse-for-property-marker').after('<img id="marker-icon-image" src="'+ attachment.url +'" width="32" height="32" style="position:absolute; margin-left:10px;" />');
            
           }
           
        });
        
        frame.open();
    
    });
    
});
</script>

<?php
}