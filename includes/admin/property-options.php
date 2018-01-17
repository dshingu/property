<?php

 function property_location_mb( $post ){
  
  $property_data = get_post_meta( $post->ID, 'property_data', true );
  
?>
<div id="map-canvas"></div>
<input type="hidden" name="property_latitude" id="property_latitude" value="<?php echo isset($property_data['latitude']) ? $property_data['latitude'] : ''; ?>" />
<input type="hidden" name="property_longitude" id="property_longitude" value="<?php echo isset($property_data['longitude']) ? $property_data['longitude'] : ''; ?>" />
<script type="text/javascript">
 
 $(document).ready(function(window, mapster){
    
    var marker         = null;
    var markerPosition = null;
    
    <?php if( isset( $property_data['latitude'] ) && isset( $property_data['longitude'] ) ): ?>
     markerPosition = {
      lat: <?php echo $property_data['latitude']; ?>,
      lng: <?php echo $property_data['longitude']; ?> 
     }
    <?php endif; ?>
    
    var $location_map = $('#map-canvas').mapster({
           center: {
               lat: <?php echo isset($property_data['latitude']) ? $property_data['latitude'] : '37.791350'; ?>,
               lng: <?php echo isset($property_data['longitude']) ? $property_data['longitude'] : '-122.435883'; ?>
           },
           zoom: 6,
           events:[
               {
                   name: 'click',
                   callback: function(e){
                       
                       if (marker) {
                             marker.setPosition({
                               lat: e.latLng.lat(),
                               lng: e.latLng.lng()
                           });
                           
                           $('#property_latitude').val(e.latLng.lat());
                           $('#property_longitude').val(e.latLng.lng());  
                           
                       }else{
                           marker = $location_map.mapster('addMarker', {
                                       lat: e.latLng.lat(),
                                       lng: e.latLng.lng(),
                                       draggable: true
                           });
                           
                           $('#property_latitude').val(e.latLng.lat());
                           $('#property_longitude').val(e.latLng.lng());
                           
                       }
                       
                   }
               }
           ]
       });
    
    
    if( markerPosition ){
    
      marker = $location_map.mapster( 'addMarker', markerPosition );
       
    }
       
   });
</script>
<?php
 }
 
function property_information_mb($post){
 
 $property_data = get_post_meta( $post->ID, 'property_data', true );
 
?>
<table class="form-table">
 <tr>
  <td class="scope">
   <label for="property-address"><?php echo __('Property Address:', 'property'); ?></label>
   <input type="text" name="property_address" id="property-address" value="<?php echo isset($property_data['address']) ? $property_data['address'] : ''; ?>" class="large-text" />
  </td>
 </tr>
 </tr>
 <td class="scope">
   <label for="property-location"><?php echo __('Property Location:', 'property'); ?></label>
   <textarea name="property_location" id="property-location" class="large-text"><?php echo isset($property_data['location']) ? $property_data['location'] : ''; ?></textarea>
  </td>
 </tr>
 </tr>
 <td class="scope">
   <label for="property-amenities"><?php echo __('Property Amenities:', 'property'); ?></label>
   <textarea name="property_amenities" id="property-amenities" class="large-text"><?php echo isset($property_data['amenities']) ? $property_data['amenities'] : ''; ?></textarea>
  </td>
 </tr>
 </tr>
 <td class="scope">
   <label for="property-available-units"><?php echo __('Property Available Units:', 'property'); ?></label>
   <input type="number" name="property_available_units" id="property-amenities" value="<?php echo isset($property_data['available_units']) ? $property_data['available_units'] : ''; ?>" class="large-text" />
  </td>
 </tr>
 </tr>
 <td class="scope">
   <label for="property-total-sqft"><?php echo __('Property Total Square Ft:', 'property'); ?></label>
   <input type="number" name="property_total_sqft" id="property-total-sqft" value="<?php echo isset($property_data['total_sqft']) ? $property_data['total_sqft'] : ''; ?>" class="large-text" />
  </td>
 </tr>
 <td class="scope">
   <label for="property-type"><?php echo __('Property Type:', 'property'); ?></label>
   <input type="text" name="property_type" id="property-type" value="<?php echo isset($property_data['type']) ? $property_data['type'] : ''; ?>" class="large-text" />
  </td>
 </tr>
 </tr>
 <td class="scope">
   <label for="property-occupancy"><?php echo __('Occupancy:', 'property'); ?></label>
   <select class="large-text" name="property_occupancy" id="property-occupancy">
    <option value="">Select</option>
    <option value="Vacant">Vacant</option>
    <option value="Occupied">Occupied</option>
   </select>
  </td>
 </tr>
</table>

<?php
}

function property_gallery_mb( $post ){
  
  $upload_link = esc_url( get_upload_iframe_src( 'image', $post->ID) );
  
  $property_data = get_post_meta( $post->ID, 'property_data', true );
  $image_ids     = isset($property_data['image_ids']) ? $property_data['image_ids'] : null;
  $image_ids_arr = explode( ',', $image_ids );
  
?>
 <div class="custom-img-container">
  <?php if(  is_array( $image_ids_arr ) ): ?>
   <ul>
   <?php foreach($image_ids_arr as $key => $value): ?>
   
    <li data-id="<?php echo $value; ?>">
    <?php
     $image = wp_get_attachment_image_src( $value, 'full' );
    ?>
     <img src="<?php echo $image[0]; ?>" />
     <span class="dashicons dashicons-dismiss property-admin-remove"></span>
    </li>
    
   <?php endforeach; ?>
   </ul>
   <br class="clear" />
  <?php endif; ?>
 </div>
 <p class="hide-if--no-js">
  <a class="upload-custom-image" href="<?php echo $upload_link; ?>"><?php _e('Add property gallery images', 'property'); ?></a>
 </p>
 <input type="hidden" class="property_gallery_image_ids" value="<?php echo ( isset( $image_ids ) ) ? $image_ids : ''; ?>" name="property_gallery_image_ids" />
 <?php
}