<?php get_header(); global $post; ?>
<div class="ui grid container">
    <div class="ui nine wide column">
        <div id="single-property-slider-area">
            <?php apply_filters('single_property_slider_filter', null); ?>    
        </div> 
    </div>
    <div class="ui six wide column">
        <div id="map-canvas" style="height:300px; width:100%;"></div>
        <div id="featured-property-area">
            <?php apply_filters('property_single_featured_properties', null); ?>
            <div class="featured-label"></div>
        </div>
    </div>
</div>
<?php get_footer(); ?>